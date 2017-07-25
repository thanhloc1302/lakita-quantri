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



//        $c1 = 'SELECT * FROM `tbl_locnt`';
//        $c2 = $this->db->query($c1);
//        $locnt = $c2->result_array();
//
//        $b1 = 'SELECT * FROM `tbl_student`';
//        $b2 = $this->db->query($b1);
//        $student = $b2->result_array();
//
//
////        $a1 = 'SELECT DISTINCT tbl FROM `tbl_student_courses` ';
////        $a2 = $this->db->query($a1);
////        $student_courses = $a2->result_array();
//
//
//
//        $d1 = 'SELECT DISTINCT tbl_student_learn.student_id FROM `tbl_student_learn`';
//        $d2 = $this->db->query($d1);
//        $student_learn = $d2->result_array();
//
//
//        $e1 = 'SELECT DISTINCT tbl_comment.student_id FROM `tbl_comment`';
//        $e2 = $this->db->query($e1);
//        $comment = $e2->result_array();
//
//        
//        $f1 = 'SELECT DISTINCT tbl_exercise.student_id FROM `tbl_exercise`';
//        $f2 = $this->db->query($f1);
//        $exercise = $f2->result_array();
        
        $g1='SELECT DISTINCT tbl_student.name,tbl_student.email,tbl_student.phone FROM tbl_student_courses,tbl_student WHERE tbl_student.id = tbl_student_courses.student_id ORDER BY tbl_student.id DESC';
        $g2=$this->db->query($g1);
        $data['ketqua'] = $g2->result_array();
//        $data['keyqua']=array();
//         
//        foreach ($locnt as $k_locnt => $v_locnt){
//            
//            $data['keyqua'][$k_locnt] = $v_locnt;
//            foreach ($student as $k_student=> $v_student){
//                if( ($v_locnt['email'] == $v_student['email'])||($v_locnt['sdt'] == $v_student['phone'])){
//                    foreach ($student_courses as $k_student_courses => $v_student_courses){
//                        if( $v_student['id'] == $v_student_courses['student_id'] ){
//                            $data['keyqua'][$k_locnt]['dakichhoat'] = 'x';
//                        }else{
//                            $data['keyqua'][$k_locnt]['dakichhoat'] = '';
//                        }
//                    }
//                    foreach ($student_learn as $k_student_learn => $v_student_learn){
//                        if( $v_student['id'] == $v_student_learn['student_id'] ){
//                            $data['keyqua'][$k_locnt]['daxemvideo'] = 'x';
//                        }else{
//                            $data['keyqua'][$k_locnt]['daxemvideo'] = '';
//                        }
//                    }
//                    foreach ($comment as $k_comment => $v_comment){
//                        if( $v_student['id'] == $v_comment['student_id'] ){
//                            $data['keyqua'][$k_locnt]['dacmt'] = 'x';
//                        }else{
//                            $data['keyqua'][$k_locnt]['dacmt'] = '';
//                        }
//                    }
//                    foreach ($exercise as $k_exercise => $v_exercise){
//                        if( $v_student['id'] == $v_exercise['student_id'] ){
//                            $data['keyqua'][$k_locnt]['dalambai'] = 'x';
//                        }else{
//                            $data['keyqua'][$k_locnt]['dalambai'] = '';
//                        }
//                    }
//                    
//                }
//            }
//        }
        
        


//        $c = 'UPDATE tbl_student_courses
//SET tbl_student_courses.courses_id = 81
//WHERE tbl_student_courses.courses_id = 71 and tbl_student_courses.student_id IN ('.$b.')';
//        $c2 = $this->db->query($c);



        
        
        $data['content'] = 'BaoCaoVanHanhHocVien/index';
        $data['header'] = 'dash_header';
        $data['footer'] = 'list_base_footer';
        $this->load->view('template', $data);
    }

}
