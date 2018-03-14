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
//        $a1= 'SELECT * FROM `tbl_student`';
//        $a2 = $this->db->query($a1);
//        $data['student']  = $a2->result_array();
//        
//        $e1='SELECT student_id,courseID, COUNT(*) AS dem FROM `tbl_student_learn` WHERE courseID IN (72,71,66) GROUP BY student_id,courseID';
//        $e2 = $this->db->query($e1);
//        $data['dem_bai'] = $e2->result_array();
//        $b1='SELECT * FROM `tbl_student_courses` where `courses_id` = 72';
//        $b2 = $this->db->query($b1);
//        $data['khoa72']  = $b2->result_array();
//        $c1='SELECT * FROM `tbl_student_courses` where `courses_id` = 71';
//        $c2 = $this->db->query($c1);
//        $data['khoa72']  = $c2->result_array();
//        $d1='SELECT * FROM `tbl_student_courses` where `courses_id` = 66';
//        $d2 = $this->db->query($d1);
//        $data['khoa72']  = $d2->result_array();



        $data['content'] = 'BaoCaoVanHanhHocVien/index';
        $data['header'] = 'dash_header';
        $data['footer'] = 'list_base_footer';
        $this->load->view('template', $data);
    }

    function report_active_cod() {
        $admin_id = $this->session->userdata('admin_id');
        if (!isset($admin_id) || empty($admin_id))
            redirect('home/login');

        $admin = $this->lib_mod->detail('admin', array('admin_id' => $admin_id));
        if (empty($admin))
            redirect('home/login');

        $data = array();

//        $this->load->model('contact_model');
//        $input['select'] = 'name, email, phone, course_code, price_purchase, date_rgt, date_receive_lakita, date_receive_cod, cod_status_id, id_lakita';
//       // $input['where'] = array('email' => 'sonhoa.1978@gmail.com');
//        $input['where'] = array('date_rgt >=' => 1519750800, 'cod_status_id >' => 1,'cod_status_id <' => 4);
//      //  $input['where'] = array('date_rgt >=' => 1519750800);
//        // $input['limit'] = array(10, 0);
//
//        $input['order'] = array('date_rgt' => 'desc');
//        $contact = $this->contact_model->load_all($input);

        $contact = file_get_contents('http://thanhloc.com/lakita-crm/api/get_contact?s=date');
        $contact = json_decode($contact, true);
//        echo '<pre>';
//        print_r($contact);
//        print_r($contacts);die;
        //$contact = $this->contact_model->load_all($input);  
//        echo '<pre>';
//        print_r($contact);die;
//        $this->load->model('courses_model');
//        $course = $this->courses_model->load_all(array('where' => array('course_code' => $contact[0]['course_code'])));
//        echo $course[0]['id'];
//        var_dump($course);die;
        $student = array();


        foreach ($contact as $key => $value) {


            if ($this->_checkactive($value['email'], $value['phone'], $value['course_code']) != FALSE) {
                $contact[$key]['active'] = 'x';
                $contact[$key]['student_id'] = $this->_checkactive($value['email'], $value['phone'], $value['course_code']);

                $da_kich_hoat = $this->_checkactive($value['email'], $value['phone'], $value['course_code']);
                $student_id = array_shift($da_kich_hoat);
                foreach ($da_kich_hoat as $key1 => $value1) {
                    $student1 = array();
                    $student1['name'] = $value['name'];
                    $student1['email'] = $value['email'];
                    $student1['phone'] = $value['phone'];
                    $student1['active'] = 'x';
                    $student1['student_id'] = $student_id;
                    $student1['course_code'] = $this->_getcoursecode($value1);
                    $student1['count_learn'] = $this->_count_learn($student_id, $value1);
                    if ($student1['course_code'] == $value['course_code']) {
                        $student1['price_purchase'] = $value['price_purchase'];
                        $student1['date_rgt'] = $value['date_rgt'];
                        if ($value['date_receive_lakita'] != 0) {
                            $student1['date'] = $value['date_receive_lakita'];
                        } elseif ($value['date_receive_cod'] != 0) {
                            $student1['date'] = $value['date_receive_cod'];
                        } else {
                            $student1['date'] = 0;
                        }
                    }

                    $student[] = $student1;
                }
            } else {
                $student1 = array();
                $student1['name'] = $value['name'];
                $student1['email'] = $value['email'];
                $student1['phone'] = $value['phone'];
                $student1['active'] = '';
                $student1['student_id'] = '';
                $student1['course_code'] = $value['course_code'];
                $student1['count_learn'] = 0;
                $student1['price_purchase'] = $value['price_purchase'];
                $student1['date_rgt'] = $value['date_rgt'];
                if ($value['date_receive_lakita'] != 0) {
                    $student1['date'] = $value['date_receive_lakita'];
                } elseif ($value['date_receive_cod'] != 0) {
                    $student1['date'] = $value['date_receive_cod'];
                } else {
                    $student1['date'] = 0;
                }
                $student[] = $student1;
            }
        }


        $data['content'] = 'baocaovanhanhhocvien/report_active_cod';
        $data['header'] = 'edit_base_header';
        $data['footer'] = 'edit_base_footer';
        $data['student'] = $student;
        $this->load->view('template', $data);
    }

    function _getcoursecode($course_id) {
        $this->load->model('courses_model');
        $input['where'] = array('id' => $course_id);
        $input['select'] = 'course_code';
        $code = $this->courses_model->load_all($input);
        return $code[0]['course_code'];
    }

    function _checkactive($email = '', $phone, $course_code) {
        $this->load->model('student_model');
        $this->load->model('courses_model');

        $course = $this->courses_model->load_all(array('where' => array('course_code' => $course_code)));

        if (empty($course)) {
            return FALSE;
        }


        $input['select'] = 'id';
        if ($email != '' && $email != 'lakita.vn@gmail.com' && $email != 'lakitavn@gmail.com' && $email != 'lakita@lakita.vn' && $email != 'LAKITAVN@GMAIL.COM' && $email != 'VN' && $phone != '') {
            $input['where'] = array('email' => $email);
            $input['or_where'] = array('phone' => $phone);
        } elseif ($email != '' && $email != 'lakita.vn@gmail.com' && $email != 'lakitavn@gmail.com' && $email != 'lakita@lakita.vn' && $email != 'LAKITAVN@GMAIL.COM' && $email != 'VN') {
            $input['where'] = array('email' => $email);
        } elseif ($phone != '') {
            $input['where'] = array('phone' => $phone);
        }
        $student_id = $this->student_model->load_all($input);
        if (!empty($student_id)) {
            $this->load->model('student_courses_model');
            $input_student_course['where'] = array('student_id' => $student_id[0]['id'], 'courses_id' => $course[0]['id']);
            $student_courses = $this->student_courses_model->load_all($input_student_course);
            if (!empty($student_courses)) {
                $test = array();
                $test[] = $student_id[0]['id'];
                foreach ($student_courses as $key => $value) {
                    $test[] = $value['courses_id'];
                }
                return $test;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function _checkcomment($student_id) {
        $this->load->model('comment_model');
        $input['select'] = 'id';
        $input['where'] = array('student_id' => $student_id);
        $input['limit'] = array(1, 0);
        $comment = $this->comment_model->load_all($input);
        if (!empty($comment)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _checkexercise($student_id) {
        $this->load->model('exercise_model');
        $input['select'] = 'id';
        $input['where'] = array('student_id' => $student_id);
        $input['limit'] = array(1, 0);
        $exercise = $this->exercise_model->load_all($input);
        if (!empty($exercise)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _count_learn($student_id, $course_code) {
        $this->load->model('student_learn_model');
        $this->load->model('learn_model');
        $learn_num = $this->learn_model->load_all(array('where' => array('courses_id' => $course_code, 'status' => 1)));

        $input['select'] = 'id';
        $input['where'] = array('student_id' => $student_id, 'courseID' => $course_code);
        $learn = $this->student_learn_model->load_all($input);
        return round((count($learn) / count($learn_num)), 2) * 100;
    }

}
