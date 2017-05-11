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
        $data['checkCod'] = 0;
        $data['generated'] = 0;
        $data['courses'] = $this->lib_mod->load_all('courses', 'name, id', array(), '', '', '');
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'generateCod/index';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

    function generate() {
        if ($this->admin_id != 36 && $this->admin_id != 35) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $methodID = array('cod' => 1, 'bank' => 2, 'direct' => 3);
        $courseID = $this->input->post('courseID');
        $prefix = $this->_find_course_code($courseID);
        $method = $this->input->post('method');
        $number = $this->input->post('number');
        $reason = $this->input->post('reason');
        $trial_learn = $this->input->post('trial_learn');
        $this->load->library('generate');
        for ($i = 0; $i < intval($number); $i++) {
            // $randStr = sha1(rand() . time());
            // $randStr = substr($randStr, rand(0, 30), 7);
            $search_array = array('first' => 1, 'second' => 4);
            $randStr = $prefix . $this->generate->generateRandomString(5, TRUE);
            while (count($this->lib_mod->load_all('cod_course', '', array('cod' => $randStr), '', '', '')) > 0) {
                $randStr = $prefix . $this->generate->generateRandomString(5, TRUE);
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
        $data['checkCod'] = 0;
        $data['generated'] = 1;
        $data['codInserted'] = $codInserted;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'generateCod/index';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

    private function _find_course_code($cod) {
        if ($cod == 'combo')
            return 'CB100';
        $course_cod = $this->lib_mod->load_all('courses', '', array("id" => $cod), '', '', '');
        if (!empty($course_cod))
            return $course_cod[0]['course_code'];
        else
            return 'L999';
    }

    function checkCod() {
        if ($this->admin_id != 38 && $this->admin_id != 35) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        //codStt 
        $data['generated'] = 0;
        $data['checkCod'] = 1;
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

}
