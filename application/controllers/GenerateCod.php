<?php

class GenerateCod extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function index() {
        if ($this->admin_id != 36 && $this->admin_id != 35 && $this->admin_id != 38) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        $data['activity'] = 0;
        $data['generated'] = 0;
        //$data['courses'] = $this->lib_mod->load_all('courses', 'name, id', array('status' => 1), '', '', '');
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'generateCod/index';
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
        $this->load->view('template', $data);
    }

    function generate() {
        if ($this->admin_id != 36 && $this->admin_id != 35) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $prefix = array(37 => 'E100', 41 => 'E200', 16 => 'E300', 10 => 'E110', 65 => 'TC100',
            66 => 'KT100', 67 => 'E400', 68 => 'KT200', 69 => 'E130', 71 => 'KT300', 72 => 'KT500',
            73 => 'KT400', 74 => 'KT600', 75 => 'EM100', 77 => 'KT800', 78 => 'KT210', 80 => 'KT120', 'combo' => 'CB100');
        $methodID = array('cod' => 1, 'bank' => 2, 'direct' => 3);
        $courseID = $this->input->post('courseID');
        $method = $this->input->post('method');
        $number = $this->input->post('number');
        $reason = $this->input->post('reason');
        $trial_learn = $this->input->post('trial_learn');
        $this->load->library('generate');
        for ($i = 0; $i < intval($number); $i++) {
            // $randStr = sha1(rand() . time());
            // $randStr = substr($randStr, rand(0, 30), 7);
            $search_array = array('first' => 1, 'second' => 4);
            if (array_key_exists($courseID, $prefix)) {
                $randStr = $prefix[$courseID] . $this->generate->generateRandomString(5, TRUE);
            } else {
                $randStr = 'KHC' . $this->generate->generateRandomString(5, TRUE);
            }
            while (count($this->lib_mod->load_all('cod_course', '', array('cod' => $randStr), '', '', '')) > 0) {
                $randStr = $prefix[$courseID] . $this->generate->generateRandomString(5, TRUE);
            }
            $param['cod'] = $randStr;
            $param['course_id'] = ($courseID == 'combo') ? 67 : $courseID;
            $param['status'] = 0;
            $param['method'] = $methodID[$method];
            $param['admin_id'] = $this->admin_id;
            $param['trial_learn'] = $trial_learn;
            $param['time'] = time();
            if ($courseID == 'combo')
                $param['combo_course_id'] = 65;
            $this->db->insert('cod_course', $param);
            $action = 'Sinh mã cod "' . $randStr . '". Lý do: ' . $reason;
            $this->lib_mod->insert_log($action);
            $codInserted[] = $randStr;
        }
        $data['activity'] = 0;
        $data['generated'] = 1;
        $data['codInserted'] = $codInserted;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'generateCod/index';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

    function checkCod() {
        if ($this->admin_id != 38 && $this->admin_id != 35) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        //codStt 
        $data['generated'] = 0;
        $data['activity'] = 1;
        $cod = $this->input->post('cod');
        $detail = $this->lib_mod->load_all('cod_course', '', array('cod' => $cod), '', '', '');
        if (count($detail) == 0)
            $data['codStt'] = 'notValid';
        else {
            if ($detail[0]['status'] == 0) {
                $data['codStt'] = 'notActive';
                $courseDetail = $this->lib_mod->load_all('courses', '', array('id' => $detail[0]['course_id']), '', '', '');
                $data['courseNotactive'] = $courseDetail[0]['name'];
                $data['trial_learn'] = $detail[0]['trial_learn'];
            } else {
                $codDetail = $this->lib_mod->load_all('student_courses', '', array('cod' => $cod), '', '', '');
                $studentDetail = $this->lib_mod->load_all('student', '', array('id' => $codDetail[0]['student_id']), '', '', '');
                $courseDetail = $this->lib_mod->load_all('courses', '', array('id' => $codDetail[0]['courses_id']), '', '', '');
                $data['codStt'] = 'actived';
                $data['activedDetail'] = array('studentEmail' => $studentDetail[0]['email'], 'time' => $codDetail[0]['create_date'], 'courseName' => $courseDetail[0]['name']);
                $data['trial_learn'] = $detail[0]['trial_learn'];
            }
        }
        $data['cod'] = $cod;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'generateCod/index';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

    function generateVoucher() {
        $data['genVoucher'] = 0;
        if ($this->input->post('submitGenVoucher') != '') {
            $data['genVoucher'] = 1;
            $courseID = $this->input->post('courseID');
            $number = $this->input->post('number');
            $merchantID = $this->input->post('merchantID');
            $money = $this->input->post('money');
            $this->load->library('generate');
            for ($i = 0; $i < intval($number); $i++) {
                $randStr = $this->generate->generateRandomString(6, true);
                while (count($this->lib_mod->load_all('coupon', '', array('name' => $randStr), '', '', '')) > 0) {
                    $randStr = $prefix[$courseID] . $this->generate->generateRandomString(6, true);
                }
                $param['name'] = $randStr;
                $param['courseID'] = $courseID;
                $param['merchantID'] = $merchantID;
                $param['money'] = $money;
                $param['create_date'] = time();
                $this->db->insert('coupon', $param);
                $voucherInserted[] = $randStr;
                $data['voucherInserted'] = $voucherInserted;
            }
        }
        if ($this->admin_id != 36 && $this->admin_id != 35 && $this->admin_id != 38) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $data['courses'] = $this->lib_mod->load_all('courses', 'name, id', array(), '', '', '');
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'generateCod/voucher';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

    function generateCombo() {
        if ($this->admin_id != 36 && $this->admin_id != 35) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $coursecombo = $this->input->post('courseIDcb');
        $coursecombo = implode(',', $coursecombo);
        $coursecombo_id = substr($coursecombo, 3, strlen($coursecombo));
        $coursecombo_arr = explode(',', $coursecombo);
        $num_course = count($coursecombo_arr);
        $prefix = 'CB' . $num_course . '00';
        $methodID = array('cod' => 1, 'bank' => 2, 'direct' => 3);
        $courseID = $coursecombo_arr[0];
        $method = $this->input->post('method');
        $number = $this->input->post('number');
        $reason = $this->input->post('reason');
        $trial_learn = $this->input->post('trial_learn');
        $this->load->library('generate');
        for ($i = 0; $i < intval($number); $i++) {
            // $randStr = sha1(rand() . time());
            // $randStr = substr($randStr, rand(0, 30), 7);
            $randStr = $prefix . $this->generate->generateRandomString(5, TRUE);
            while (count($this->lib_mod->load_all('cod_course', '', array('cod' => $randStr), '', '', '')) > 0) {
                $randStr = $prefix . $this->generate->generateRandomString(5, TRUE);
            }
            $param['cod'] = $randStr;
            $param['course_id'] = $courseID;
            $param['status'] = 0;
            $param['method'] = $methodID[$method];
            $param['admin_id'] = $this->admin_id;
            $param['trial_learn'] = $trial_learn;
            $param['time'] = time();
            $param['combo_course_id'] = $coursecombo_id;
            $this->db->insert('cod_course', $param);
            $action = 'Sinh mã cod "' . $randStr . '". Lý do: ' . $reason;
            $this->lib_mod->insert_log($action);
            $codInserted[] = $randStr;
        }
        $data['activity'] = 2;
        $data['generated'] = 1;
        $data['codInserted'] = $codInserted;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'generateCod/index';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }
    
    
    
    
}
