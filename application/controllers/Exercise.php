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
        $data['student'] = $this->lib_mod->load_all('student', 'id, name', '', '', '', '');
        $data['bai']= $this->lib_mod->load_all('learn', 'id, name', '', '', '', '', '');
        $data['khoa']=  $this->lib_mod->load_all('courses','id,name', array('status' => 1), '', '', '', '');
        $data['bai_chua']= $this->lib_mod->load_all('exercise_repair', 'exe_id, note', '', '', '', '', '');
        $this->load->view('template', $data);
    }
    
    function action_upload() {
        
        $a=$this->input->post('exe_id');
        $kiemtra = $this->lib_mod->detail('exercise_repair', array('exe_id' => $a));
        echo '<pre>';
        print_r($this->input->post());
        die;
        
        if(!empty($kiemtra)){
            $note_repair = $this->input->post('note_repair');
            $user_id = $this->input->post('student_id');
        if ($this->input->post("ok") == 'Upload') {
            
            $dir = 'data/source/student/repair_exercise/'. $user_id;
            
            
            //kiem tra folder co to tai khong
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            }
            $data['exe_id'] = $this->input->post('exe_id');
            
             

            
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

                    $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;
                    }  else {
                     $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;  
                    }
                
                } else {
                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;
                    }  else {
                     $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
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

                    $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;
                    }  else {
                     $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;  
                    }
                
                } else {
                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    die;
                    }  else{
                        if (empty($note_repair)) {
                            $data['note'] = $this->input->post('note');
                            $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                        echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        die;  
                        } 
                    }
                }             
            } 
            
        }else{
            
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


function search() {
        $courses_id = $this->input->post('courses_id');
        if (empty($courses_id))
            $courses_id = 0;
        else
            $courses_id = $courses_id;

       if( $this->admin_id  != 35 &&  $this->admin_id !=37)
        {
            header('Content-Type: text/html; charset=utf-8');            
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $key_word = $this->lib_mod->make_url(trim($this->input->post('key_word')));
        if (empty($key_word))
            $key_word = 'empty';
        $status = $this->input->post('status');
        $search = array('key_word' => $key_word, 'status' => $status, 'courses_id' => $courses_id);
        $param = $this->uri->assoc_to_uri($search);
        $param = str_replace('//', '/0/', $param);
        redirect('exercise/result_search/' . $param);
    }

    function result_search() {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

       
        
        if (!isset($result[4]) || !isset($result[6]) || !isset($result[8])) {
            redirect('exercise/index');
        } else {
            $data['key_word'] = $key_word = $result[4];
            $data['status'] = $status = $result[6];
            $data['courses_id'] = $courses_id = $result[8];

            $this->load->library('pagination');
            $per_page = 10;
            $session_per_page = $this->session->userdata('session_per_page');
            if (isset($session_per_page) && $session_per_page > 0)
                $per_page = $session_per_page;

            if ($this->uri->segment(9) == null || $this->uri->segment(9) == 1) {
                $offset = 0;
            } else {
                $offset = $this->uri->segment(9);
            }
            $total = $this->search_mod->exercise_count_courses($key_word, $courses_id);
            $data['rows'] = $this->search_mod->exercise_load_courses($key_word, $courses_id, $per_page, $offset);

            $base_url = site_url('exercise/result_search/key_word/' . $key_word . '/status/' . $status . '/courses_id/' . $courses_id . '/');
            $config['base_url'] = $base_url;
            $config['per_page'] = $per_page;
            $config['total_rows'] = $total;
            $config['uri_segment'] = 9;
            $data['paging'] = $this->pagination->create_links();
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();
            $data['total'] = $total;
            $data['is_search'] = 1;
            $data['header'] = 'list_base_header';
            $data['footer'] = 'list_base_footer';
            $data['content'] = 'exercise/index';
            $data['student'] = $this->lib_mod->load_all('student', 'id, name', '', '', '', '');
            $data['bai']= $this->lib_mod->load_all('learn', 'id, name', '', '', '', '', '');
            $data['khoa']=  $this->lib_mod->load_all('courses','id,name', array('status' => 1), '', '', '', '');
            $data['bai_chua']= $this->lib_mod->load_all('exercise_repair', 'exe_id, note', '', '', '', '', '');
            $this->load->view('template', $data);
        }
    }

    function download($filename) {
        if (!isset($filename) && empty($filename)) {
            redirect(site_url());
        }
        $user_id = $this->session->userdata('user_id');
        if (!isset($user_id)) {
            die('Xin lỗi, bạn không có quyền truy cập vào khu vực này!');
        }
        $file = base64_decode($filename);
        $file_path = 'C:\xampp\htdocs\lakita_git\lakita\data\source\student\upload_exercise\\' . $file;
        if (!is_file($file_path)) {
            die('Không tìm thấy file');
        }
        $this->load->helper('download');
        force_download($file_path, NULL);
    }
    
    
    
    
    
    
    
    
    
}
