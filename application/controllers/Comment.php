<?php

//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Comment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function index() {
       if( $this->admin_id  != 35 &&  $this->admin_id !=37)
        {
            header('Content-Type: text/html; charset=utf-8');            
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }
        
    //$data['cmt_tra_loi'] = $this->lib_mod->load_all('comment', 'parent', array('parent !=' => 0), '', '', '');
        
        $this->load->library('pagination');
        $per_page = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $total = $this->lib_mod->count('comment', array());
        $data['rows'] = $this->lib_mod->dung_cho_comment('comment', '', array('student_id !=' => 4909), array('student_id !=' => 3073), $per_page, $this->uri->segment(3), array('id' => 'desc'),'');
        $base_url = site_url('comment/index/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'comment/index';
        $data['student'] = $this->lib_mod->load_all('student','id,name','' , '', '', '');
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', '', '', '', '');
        $data['learn'] = $this->lib_mod->load_all('learn', 'id, name', '', '', '', '');
        $this->load->view('template', $data);
    }
}