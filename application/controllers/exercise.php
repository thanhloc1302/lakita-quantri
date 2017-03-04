<?php

//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Exercise extends CI_Controller {

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

        $this->load->library('pagination');
        $per_page = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $total = $this->lib_mod->count('exercise', array());
        $data['rows'] = $this->lib_mod->load_all('exercise', '', array(), $per_page, $this->uri->segment(3), array('id' => 'desc'));
        $base_url = site_url('exercise/index/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'exercise/index';
        $data['exercise'] = $this->lib_mod->load_all('exercise', 'id, student_id, course_id, learn_id, full_path, file_name, note, time', '', '', '', array('time' => 'desc'));
        $data['student'] = $this->lib_mod->load_all('student', 'id, name', '', '', '', '');
        $data['bai']= $this->lib_mod->load_all('learn', 'id, name', '', '', '', '', '');
        $data['khoa']=  $this->lib_mod->load_all('courses','id,name', '', '', '', '', '');
        $this->load->view('template', $data);
    }
    
    function action_upload() {
        $user_id = $this->input->post('student_id');
        if ($this->input->post("ok") == 'Upload') {
           
            $dir = 'data/source/student/repair_exercise/'. $user_id;
            
            
            //kiem tra folder co to tai khong
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            }
            $data['exe_id'] = $this->input->post('exe_id');
            $data['note'] = $this->input->post('note');
             

            
            $config['upload_path'] =$dir;
            $config['allowed_types'] = 'xls|xlsx|mp4';
            $config['max_size'] = '9000000000';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('bai_chua')) {
                $check = $this->upload->data();
                $data['url_bai_chua'] = $user_id . '/'. $check['file_name'];
                
                if ($this->upload->do_upload('dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_chua_chuan'] = $user_id . '/'. $check1['file_name'];

                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;
                    }  else {
                     $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;  
                    }
                
                } else {
                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;
                    }  else {
                     $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;  
                    }
                }
            } elseif ($this->upload->do_upload('dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_chua_chuan'] = $user_id . '/'. $check1['file_name'];

                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;
                    }  else {
                     $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;  
                    }
                
                } else {
                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;
                    }  else{
                        if (empty ($data['note'])) {
                        echo '<script>alert("Bạn chưa chọn file để upload hoặc tạo nhận xét cho bài chữa !"); </script>';
                        echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        die;  
                        }
                    }
                }             
        }
    }
    
    
    
    
    
}