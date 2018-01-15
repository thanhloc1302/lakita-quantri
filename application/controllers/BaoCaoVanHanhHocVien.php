<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BaoCaoVanHanhHocVien extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('report_mod');

        ini_set('memory_limit', '1024M');
        $this->load->database();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }

    public function index() {
        $admin_id = $this->session->userdata('admin_id');
        if (!isset($admin_id) || empty($admin_id))
            redirect('home/login');

        $admin = $this->lib_mod->detail('admin', array('admin_id' => $admin_id));
        if (empty($admin))
            redirect('home/login');

        $data = array();
        $current_day = date('d/m/Y');
        $ngay = date_parse_from_format('d/m/Y', $current_day);
        $time1 = mktime(0, 0, 0, $ngay['month'], $ngay['day'], $ngay['year']);
        $time2 = mktime(24, 0, 0, $ngay['month'], $ngay['day'], $ngay['year']);
        $start = $time1;
        $end = $time2;

        $day1 = $this->input->post('date1');
        $day2 = $this->input->post('date2');
        if ($day1) {
            $date1 = date_parse_from_format('d/m/Y', $day1);
            $timeStampe1 = mktime(0, 0, 0, $date1['month'], $date1['day'], $date1['year']);
            $start = $timeStampe1;
        }
        if ($day2) {
            $date1 = date_parse_from_format('d/m/Y', $day2);
            $timeStampe2 = mktime(24, 0, 0, $date1['month'], $date1['day'], $date1['year']);
            $end = $timeStampe2;
        }
        $list = $this->report_mod->tongkh($start, $end);
        $list2 = $this->report_mod->motvideo($start, $end);
        $list3 = $this->report_mod->muoivideo($start, $end);
        $list4 = $this->report_mod->allvideo($start, $end);
        $list5 = $this->report_mod->cmt_support($start, $end);
        $list12 = $this->report_mod->cmt_nosupport($start, $end);
        $list6 = $this->report_mod->camnhan($start, $end);
        $list7 = $this->report_mod->fivestar($start, $end);
        $list8 = $this->report_mod->forstar($start, $end);
        $list9 = $this->report_mod->threestar($start, $end);
        $list10 = $this->report_mod->twostar($start, $end);
        $list11 = $this->report_mod->onestar($start, $end);
        $data['start'] = $day1;
        $data['end'] = $day2;
        $data['motvideo'] = $list2;
        $data['muoivideo'] = $list3;
        $data['allvideo'] = $list4;
        $data['cmt_support'] = $list5;
        $data['cmt_nosupport'] = $list12;
        $data['camnhan'] = $list6;
        $data['fivestar'] = $list7;
        $data['forstar'] = $list8;
        $data['threestar'] = $list9;
        $data['twostar'] = $list10;
        $data['onestar'] = $list11;
        $data['tongkh'] = ($list);

        $this->load->view('BaoCaoVanHanhHocVien/baocao', $data);
    }

    function in() {
        die;
        $this->load->model('loc_test_model');
        $this->load->model('courses_model');
        $this->load->model('student_model');
        $this->load->model('student_courses_model');
        $this->load->model('student_learn_model');
        $contact = array();
        $input['order'] = array('date_reg' => 'DESC');
        //$input['limit'] = array('100', '0');
        $contact = $this->loc_test_model->load_all($input);

        $locnt = array();


        foreach ($contact as $k_contact => $v_contact) {
            $student_id = $this->check_active($v_contact['email'], $v_contact['phone']);
            if ($student_id != '') {
                $courses = $this->student_courses_model->load_all(array('select' => 'courses_id', 'where' => array('student_id' => $student_id)));
                foreach ($courses as $c_key => $c_value) {
                    $locnt[] = array(
                        'name' => $v_contact['name'],
                        'phone' => $v_contact['phone'],
                        'email' => $v_contact['email'],
                        'date_reg' => $v_contact['date_reg'],
                        'active' => 'x',
                        'create_date' => $this->get_create_date($v_contact['email'], $v_contact['phone']),
                        'course' => $this->get_course_name($c_value['courses_id']),
                        'learn' => $this->check_course_done($student_id, $c_value['courses_id']),
                        'last_log_in' => $this->get_last_log_in($student_id)
                    );
                }
            } else {
                $locnt[] = array(
                    'name' => $v_contact['name'],
                    'phone' => $v_contact['phone'],
                    'email' => $v_contact['email'],
                    'date_reg' => $v_contact['date_reg'],
                    'active' => '',
                    'create_date' => '0',
                    'course' => '',
                    'learn' => '',
                    'last_log_in' => '0'
                );
            }
        }

//        echo "<pre>";
//        print_r($locnt);
//        die;
        $data['ketqua'] = $locnt;


        $data['content'] = 'BaoCaoVanHanhHocVien/index';
        $data['header'] = 'dash_header';
        $data['footer'] = 'list_base_footer';
        $this->load->view('template', $data);
    }

    function check_active($email, $phone) {
        $this->load->model('student_model');
        if ($email != '' && $phone != '' && strtolower($email) != 'lakitavn@gmail.com') {
            $input['like_before'] = array('phone' => $phone);
            $input['or_where'] = array('email' => $email);
        } elseif ($phone != '' && $email == '') {
            $input['like_before'] = array('phone' => $phone);
        } elseif ($email != ''&& strtolower($email) != 'lakitavn@gmail.com' && $phone == '') {
            $input['where'] = array('email' => $email);
        } else {
            $input['like_before'] = array('phone' => $phone);
        }
        $active = $this->student_model->load_all($input);

        if (!empty($active)) {
            return $active[0]['id'];
        } else {
            return '';
        }
    }

    function get_create_date($email, $phone) {
        $this->load->model('student_model');
        if ($email != '' && $phone != '' && strtolower($email) != 'lakitavn@gmail.com') {
            $input['like_before'] = array('phone' => $phone);
            $input['or_where'] = array('email' => $email);
        } elseif ($phone != '' && $email == '') {
            $input['like_before'] = array('phone' => $phone);
        } elseif ($email != ''&& strtolower($email) != 'lakitavn@gmail.com' && $phone == '') {
            $input['where'] = array('email' => $email);
        } else {
            $input['like_before'] = array('phone' => $phone);
        }
        $active = $this->student_model->load_all($input);
        if (!empty($active)) {
            return $active[0]['createdate'];
        }
    }

    function get_last_log_in($student_id) {
        $this->load->model('watching_model');
        $input['where'] = array('student_id' => $student_id);
        $time = $this->watching_model->load_all($input);
        if (!empty($time)) {
            return $time[0]['time'];
        } else {
            return '0';
        }
    }

    function check_course_done($student_id, $course_id) {
        $this->load->model('courses_model');
        $this->load->model('student_learn_model');
        $this->load->model('learn_model');


        //đếm số bài đã học
        $input_learn['where'] = array('student_id' => $student_id, 'courseID' => $course_id);
        $learned = count($this->student_learn_model->load_all($input_learn));

        //đếm số bài của khóa
        $input_course['where'] = array('courses_id' => $course_id, 'status' => '1');
        $learn_total = count($this->learn_model->load_all($input_course));

        if ($learned == $learn_total) {
            return 'hoàn thành';
        } else {
            return $learned;
        }
    }
    
    function get_course_name($course_id){
        $this->load->model('courses_model');
        $input['where'] = array('id' => $course_id);
        $course = $this->courses_model->load_all($input);
        return $course[0]['name'];
    }
    
}
