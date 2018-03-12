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
    
    public function index(){
        $admin_id = $this->session->userdata('admin_id');
        if (!isset($admin_id) || empty($admin_id))
            redirect('home/login');

        $admin = $this->lib_mod->detail('admin', array('admin_id' => $admin_id));
        if (empty($admin))
            redirect('home/login');
        
$data= array();
$current_day = date('d/m/Y');
 $ngay = date_parse_from_format('d/m/Y',  $current_day);
$time1 = mktime(0,0,0, $ngay['month'], $ngay['day'], $ngay['year']);
$time2 = mktime(24,0,0, $ngay['month'], $ngay['day'], $ngay['year']);
$start=$time1;
$end=$time2;

      $day1=  $this->input->post('date1');
       $day2= $this->input->post('date2');
        if($day1){
    $date1 = date_parse_from_format('d/m/Y',  $day1);
    $timeStampe1 = mktime(0,0,0, $date1['month'], $date1['day'], $date1['year']);
   $start= $timeStampe1;
    }
    if($day2){
    $date1 = date_parse_from_format('d/m/Y',  $day2);
    $timeStampe2 = mktime(24,0,0, $date1['month'], $date1['day'], $date1['year']);
    $end= $timeStampe2;
    }
       $list=$this->report_mod->tongkh($start,$end);
       $list2=$this->report_mod->motvideo($start, $end);
       $list3=$this->report_mod->muoivideo($start, $end);
       $list4=$this->report_mod->allvideo($start, $end);
       $list5=$this->report_mod->cmt_support($start, $end);
       $list12=$this->report_mod->cmt_nosupport($start, $end);
       $list6=$this->report_mod->camnhan($start, $end);
       $list7=$this->report_mod->fivestar($start, $end);
       $list8=$this->report_mod->forstar($start, $end);
       $list9=$this->report_mod->threestar($start, $end);
       $list10=$this->report_mod->twostar($start, $end);
       $list11=$this->report_mod->onestar($start, $end);
$data['start']=$day1;
$data['end']=$day2;      
       $data['motvideo']=$list2;
       $data['muoivideo']=$list3;
       $data['allvideo']=$list4;
       $data['cmt_support']=$list5;
       $data['cmt_nosupport']=$list12;
       $data['camnhan']=$list6;
       $data['fivestar']=$list7;
       $data['forstar']=$list8;
       $data['threestar']=$list9;
       $data['twostar']=$list10;
       $data['onestar']=$list11;
        $data['tongkh']=($list);
        
        $this->load->view('BaoCaoVanHanhHocVien/baocao',$data);
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
//    function index() {
//        
//        $admin_id = $this->session->userdata('admin_id');
//        if (!isset($admin_id) || empty($admin_id))
//            redirect('home/login');
//
//        $admin = $this->lib_mod->detail('admin', array('admin_id' => $admin_id));
//        if (empty($admin))
//            redirect('home/login');
//
//        
//        
//        $khoaExcel = array(37,41,67,16);
//        $khoaKetoan = array(73,72,71,68,66);
//        
//        //số tài khoản đã kích hoạt
//        $data['active_course_E'] = $this->report_mod->count_distinct('student_courses', 'student_id', array('trial_learn'=>0), array('courses_id'=> $khoaExcel));
//        $data['active_course_KT'] = $this->report_mod->count_distinct('student_courses', 'student_id', array('trial_learn'=>0), array('courses_id'=> $khoaKetoan));
//        
////        $data['active_course_E'] = $this->report_mod->count('student_courses', array('trial_learn'=>0), array('courses_id'=> $khoaExcel));
////        $data['active_course_KT'] = $this->report_mod->count('student_courses', array('trial_learn'=>0), array('courses_id'=> $khoaKetoan));
////        
//        
//        //số vote
//        for($i=1;$i<=5;$i++){
//        $data['voteE'.$i] = $this->report_mod->count('vote', array('vote_star_number'=>$i), array('courseID'=> $khoaExcel));
//        $data['voteKT'.$i] = $this->report_mod->count('vote', array('vote_star_number'=>$i), array('courseID'=> $khoaKetoan));
//        }
//        
//        //số cảm nhận
//        $data['vote_descriptionE'] = $this->report_mod->count('vote', array('vote_description !=' => ''), array('courseID'=> $khoaExcel));
//        $data['vote_descriptionKT'] = $this->report_mod->count('vote', array('vote_description !=' => ''), array('courseID'=> $khoaKetoan));
//        
//        //số comment chưa trả lời khóa học excel
//        $queryE1 = 'select * from `tbl_comment` as cmt where cmt.`courses_id` IN (37,41,67,16) AND cmt.`id` not in (select distinct cmt2.`parent` from `tbl_comment` as cmt2) '
//                    . 'and cmt.`student_id`!= 3073 and cmt.`student_id` != 4909 ';
//        $queryE2 = $this->db->query($queryE1);
//        $data['no_replyE'] = count($queryE2->result_array());
//        
//        //số comment chưa trả lời khóa học kế toán
//        $queryKT1 = 'select * from `tbl_comment` as cmt where cmt.`courses_id` IN (73,72,71,68,66) AND cmt.`id` not in (select distinct cmt2.`parent` from `tbl_comment` as cmt2) '
//                    . 'and cmt.`student_id`!= 3073 and cmt.`student_id` != 4909 ';
//        $queryKT2 = $this->db->query($queryKT1);
//        $data['no_replyKT'] = count($queryKT2->result_array());
//        
//        //số comment đã được trả lời
//        $data['replyE'] = $this->report_mod->count('comment',array('parent' => ''),array('courses_id'=>$khoaExcel));
//        $data['replyKT'] = $this->report_mod->count('comment',array('parent' => ''),array('courses_id'=>$khoaKetoan));
//        
//        
//        //số học viên viết cảm nhận
//        $data['rateE'] = $this->report_mod->count('rate', '',array('course_id'=>$khoaExcel));
//        $data['rateKT'] = $this->report_mod->count('rate', '',array('course_id'=>$khoaKetoan));
//        
//        //$data['test'] = $this->report_mod->get_course('student_id,courses_id', $khoaExcel, array('student_id'=> 'DESC'));
//
//        //tạo view số bài đã học khóa excel
//        $sqlE = 'CREATE or replace view tbl_sum_learn_E AS select student_id,COUNT(learn_ID) as `sum_learn` FROM tbl_student_learn,tbl_courses WHERE
// tbl_student_learn.CourseiD = tbl_courses.ID and tbl_courses.ID in ('.implode(",",$khoaExcel) .')'
// .'GROUP by student_id';
//        
//        $this->db->query($sqlE);
//        //đếm 10 bài
//        $sql1 = 'SELECT student_id from tbl_sum_learn_E WHERE tbl_sum_learn_E.sum_learn >=10';
//        $sql2 = $this->db->query($sql1); 
//        $data['E10video']= count($sql2->result_array());
//        //đếm 1 bài excel
//        $sql11 = 'SELECT student_id from tbl_sum_learn_E WHERE tbl_sum_learn_E.sum_learn >=1';
//        $sql12 = $this->db->query($sql11); 
//        $data['E1video']= count($sql12->result_array());
//        
//        //tạo view số bài đã học khóa kê toán
//        $sqlKT = 'CREATE or replace view tbl_sum_learn_KT AS select student_id,COUNT(learn_ID) as `sum_learn` FROM tbl_student_learn,tbl_courses WHERE
// tbl_student_learn.CourseiD = tbl_courses.ID and tbl_courses.ID in ('.implode(",",$khoaKetoan) .')'
// .'GROUP by student_id';
//        
//        $this->db->query($sqlKT);
//        //đếm 10 bài kế toán
//        $sql3= 'SELECT student_id from tbl_sum_learn_KT WHERE tbl_sum_learn_KT.sum_learn >=10';
//        $sql4 = $this->db->query($sql3); 
//        $data['KT10video']= count($sql4->result_array());
//        //đếm 1 bài kế toán
//        $sql15= 'SELECT student_id from tbl_sum_learn_KT WHERE tbl_sum_learn_KT.sum_learn >=1';
//        $sql16 = $this->db->query($sql15); 
//        $data['KT1video']= count($sql16->result_array());
//        
//        //tạo view đếm số bài học viên phải học để hoàn thành khóa học EXcel tính trên tổng số khóa học viên đã mua
//        $sql5 = 'CREATE or replace view tbl_sum_learn_all_E AS select tbl_student_courses.student_id, COUNT(tbl_learn.id) as `sum_learn` 
//FROM tbl_courses,tbl_student_courses, tbl_learn
//WHERE tbl_student_courses.courses_id = tbl_learn.courses_id AND tbl_courses.id = tbl_learn.courses_id AND tbl_learn.trial_learn = 0 AND tbl_student_courses.courses_id IN ('.implode(",",$khoaExcel) .')'
//.'GROUP BY tbl_student_courses.student_id';
//        $this->db->query($sql5);
//        //đếm số học viên học hết
//        $sql6= 'SELECT tbl_sum_learn_E.Student_id from tbl_sum_learn_E,tbl_sum_learn_all_E WHERE tbl_sum_learn_E.Student_id = tbl_sum_learn_all_E.student_id and tbl_sum_learn_E.sum_learn = tbl_sum_learn_all_E.sum_learn';
//        $sql7 = $this->db->query($sql6); 
//        $data['Eallvideo']= count($sql7->result_array());
//        
//       
//        
//        //tạo view đếm số bài học viên phải học để hoàn thành khóa học Kế Toán tính trên tổng số khóa học viên đã mua
//        $sql8 = 'CREATE or replace view tbl_sum_learn_all_KT AS select tbl_student_courses.student_id, COUNT(tbl_learn.id) as `sum_learn` 
//FROM tbl_courses,tbl_student_courses, tbl_learn
//WHERE tbl_student_courses.courses_id = tbl_learn.courses_id AND tbl_courses.id = tbl_learn.courses_id AND tbl_learn.trial_learn = 0 AND tbl_student_courses.courses_id IN ('.implode(",",$khoaKetoan) .')'
//.'GROUP BY tbl_student_courses.student_id';
//        $this->db->query($sql8);
//        //đếm số học viên học hết
//        $sql9= 'SELECT tbl_sum_learn_KT.student_id from tbl_sum_learn_KT,tbl_sum_learn_all_KT WHERE tbl_sum_learn_KT.student_id = tbl_sum_learn_all_KT.student_id and tbl_sum_learn_KT.sum_learn = tbl_sum_learn_all_KT.sum_learn';
//        $sql10 = $this->db->query($sql9); 
//        $data['KTallvideo']= count($sql10->result_array());
//        
//        
//        
////        
////        $a1 = 'SELECT * FROM `locnt`';
////        $a2 = $this->db->query($a1);
////        $data['loc']  = $a2->result_array();
////        
////        $b1 = 'SELECT DISTINCT locnt.email
////FROM locnt,tbl_student,tbl_student_learn
////WHERE locnt.email=tbl_student.email AND tbl_student.id = tbl_student_learn.student_id';
////        $b2 = $this->db->query($b1);
////        $data['xem'] = $b2->result_array();
////        
////        $c1 = 'SELECT DISTINCT locnt.email
////FROM locnt,tbl_student,tbl_comment
////WHERE locnt.email=tbl_student.email AND tbl_student.id = tbl_comment.student_id';
////        $c2 = $this->db->query($c1);
////        $data['comment'] = $c2->result_array();
////        
////        $d1 = 'SELECT DISTINCT locnt.email
////FROM locnt,tbl_student,tbl_exercise
////WHERE locnt.email=tbl_student.email AND tbl_student.id = tbl_exercise.student_id';
////        $d2 = $this->db->query($d1);
////        $data['bt'] = $d2->result_array();
////        
////        $e1 = 'SELECT DISTINCT locnt.email
////FROM locnt,tbl_student_courses,tbl_student
////WHERE locnt.email=tbl_student.email AND tbl_student.id = tbl_student_courses.student_id and tbl_student_courses.trial_learn = 0';
////        $e2 = $this->db->query($e1);
////        $data['kich_hoat'] = $e2->result_array();
//        
//       
//        
//        $data['content'] = 'BaoCaoVanHanhHocVien/index';
//        $data['header'] = 'dash_header';
//        $data['footer'] = 'list_base_footer';
//        $this->load->view('template', $data);
//    }

    
    
    
    
//    function filter($start_date ='0', $end_date ='0'){
//
//        $admin_id = $this->session->userdata('admin_id');
//        if (!isset($admin_id) || empty($admin_id))
//            redirect('home/login');
//
//        $admin = $this->lib_mod->detail('admin', array('admin_id' => $admin_id));
//        if (empty($admin))
//            redirect('home/login');
//
//        $data['filter'] = $this->input->get('filter');
//        
//        
//        if($this->input->get('start_date')){
//        $start_date = strtotime($this->input->get('start_date'));
//        }
//        
//      
//        if($this->input->get('end_date')){
//            $end_date = strtotime($this->input->get('end_date'));
//        }
//       
//        $ngay_hien_tai = getdate()[0];
//        
//        
//        if( ($end_date < $start_date) && $end_date !== '0'  ){
//            echo ' <script>alert("Ngày bắt đầu không được lớn hơn ngày kết thúc !!!!")</script>';
//            echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
//            die;
//        }
//        
//        if($start_date !== 0 && $end_date == '0'){
//            $dk_ngay1 = array('createdate >=' => $start_date ,'createdate <=' => $ngay_hien_tai );
//            $dk_ngay2 = 'AND createdate >= '.$start_date.' AND createdate <= '.$ngay_hien_tai;
//            $dk_ngay3 = array('time >=' => $start_date ,'time <=' => $ngay_hien_tai );
//            $dk_ngay4 = array('create_date >=' => $start_date ,'create_date <=' => $ngay_hien_tai );
//            $dk_ngay5 = 'AND tbl_student_learn.time >= '.$start_date.' AND tbl_student_learn.time <= '.$ngay_hien_tai;
//            $dk_ngay6 = 'AND tbl_student_courses.create_date >= '.$start_date.' AND tbl_student_courses.create_date <= '.$ngay_hien_tai;
//        } elseif ($start_date == '0' && $end_date !== 0) {
//            $dk_ngay1 = array('createdate >=' => 0 ,'createdate <=' => $end_date );
//            $dk_ngay2 = 'AND createdate >= 0 AND createdate <= '.$end_date;
//            $dk_ngay3 = array('time >=' => 0 ,'time <=' => $end_date );
//            $dk_ngay4 = array('create_date >=' => 0 ,'create_date <=' => $end_date );
//            $dk_ngay5 = 'AND tbl_student_learn.time >= 0 AND tbl_student_learn.time <= '.$end_date;
//            $dk_ngay6 = 'AND tbl_student_courses.create_date >= 0 AND tbl_student_courses.create_date <= '.$end_date;
//        } elseif ($start_date !== 0 && $end_date !== 0) {
//            $dk_ngay1 = array('createdate >=' => $start_date ,'createdate =<' => $end_date );
//            $dk_ngay2 = 'AND createdate >= '.$start_date.' AND createdate <= '.$end_date;
//            $dk_ngay3 = array('time >=' => $start_date ,'time <=' => $end_date );
//            $dk_ngay4 = array('create_date >=' => $start_date ,'create_date <=' => $end_date );
//            $dk_ngay5 = 'AND tbl_student_learn.time >= '.$start_date.' AND tbl_student_learn.time <= '.$end_date;
//            $dk_ngay6 = 'AND tbl_student_courses.create_date >= '.$start_date.' AND tbl_student_courses.create_date <= '.$end_date;
//        } else {
//            $dk_ngay1 = array('createdate >=' => 0 ,'createdate <=' => $ngay_hien_tai );
//            $dk_ngay2 = '';
//            $dk_ngay3 = array('time >=' => 0 ,'time <=' => $ngay_hien_tai );
//            $dk_ngay4 = array('create_date >=' => 0 ,'create_date <=' => $ngay_hien_tai );
//            $dk_ngay5 = 'AND tbl_student_learn.time >= 0 AND tbl_student_learn.time <= '.$ngay_hien_tai;
//            $dk_ngay6 = 'AND tbl_student_courses.create_date >= 0 AND tbl_student_courses.create_date <= '.$ngay_hien_tai;
//        }
//        
//        
//        
//        
//        $khoaExcel = array(37,41,67,16);
//        $khoaKetoan = array(73,72,71,68,66);
//        
//        //số tài khoản đã kích hoạt
//        
//        $data['active_course_E'] = $this->report_mod->count_distinct('student_courses','student_id', array_merge(array('trial_learn'=>0),$dk_ngay4), array('courses_id'=> $khoaExcel));
//        $data['active_course_KT'] = $this->report_mod->count_distinct('student_courses','student_id', array_merge(array('trial_learn'=>0),$dk_ngay4), array('courses_id'=> $khoaKetoan));
//        
//        //số vote
//        for($i=1;$i<=5;$i++){
//        $data['voteE'.$i] = $this->report_mod->count('vote', array_merge(array('vote_star_number'=>$i),$dk_ngay3), array('courseID'=> $khoaExcel));
//        $data['voteKT'.$i] = $this->report_mod->count('vote', array_merge(array('vote_star_number'=>$i),$dk_ngay3), array('courseID'=> $khoaKetoan));
//        }
//        
//     
//        //số comment chưa trả lời khóa học excel
//        $queryE1 = 'select * from `tbl_comment` as cmt where cmt.`courses_id` IN (37,41,67,16) AND cmt.`id` not in (select distinct cmt2.`parent` from `tbl_comment` as cmt2) '
//                    . 'and cmt.`student_id`!= 3073 and cmt.`student_id` != 4909 '.$dk_ngay2;
//        $queryE2 = $this->db->query($queryE1);
//        $data['no_replyE'] = count($queryE2->result_array());
//        
//        //số comment chưa trả lời khóa học kế toán
//        $queryKT1 = 'select * from `tbl_comment` as cmt where cmt.`courses_id` IN (73,72,71,68,66) AND cmt.`id` not in (select distinct cmt2.`parent` from `tbl_comment` as cmt2) '
//                    . 'and cmt.`student_id`!= 3073 and cmt.`student_id` != 4909 '.$dk_ngay2;
//        $queryKT2 = $this->db->query($queryKT1);
//        $data['no_replyKT'] = count($queryKT2->result_array());
//        
//        //số comment đã được trả lời
//        $data['replyE'] = $this->report_mod->count('comment', array_merge(array('parent' => ''),$dk_ngay1), array('courses_id'=>$khoaExcel));
//        $data['replyKT'] = $this->report_mod->count('comment', array_merge(array('parent' => ''),$dk_ngay1), array('courses_id'=>$khoaKetoan));
//        
//        //số khách đã xem 1 video
////        $data['E1video'] = $this->report_mod->count_distinct('student_learn', 'student_id', $dk_ngay3, array('courseID'=>$khoaExcel));
////        $data['KT1video'] = $this->report_mod->count_distinct('student_learn', 'student_id', $dk_ngay3, array('courseID'=>$khoaKetoan));
////        
//        //số học viên viết cảm nhận
//        $data['rateE'] = $this->report_mod->count('rate', $dk_ngay4,array('course_id'=>$khoaExcel));
//        $data['rateKT'] = $this->report_mod->count('rate', $dk_ngay4,array('course_id'=>$khoaKetoan));
//        
//        //$data['test'] = $this->report_mod->get_course('student_id,courses_id', $khoaExcel, array('student_id'=> 'DESC'));
//
//        //tạo view số bài đã học khóa excel
//        $sqlE = 'CREATE or replace view tbl_sum_learn_E AS select student_id,COUNT(learn_ID) as `sum_learn` FROM tbl_student_learn,tbl_courses WHERE
// tbl_student_learn.CourseiD = tbl_courses.ID '.$dk_ngay5.' and tbl_courses.ID in ('.implode(",",$khoaExcel) .')'
// .'GROUP by student_id';
//        
//        $this->db->query($sqlE);
//        //đếm 10 bài excel
//        $sql1 = 'SELECT student_id from tbl_sum_learn_E WHERE tbl_sum_learn_E.sum_learn >=10';
//        $sql2 = $this->db->query($sql1); 
//        $data['E10video']= count($sql2->result_array());
//        //đếm 1 bài excel
//        $sql11 = 'SELECT student_id from tbl_sum_learn_E WHERE tbl_sum_learn_E.sum_learn >=1';
//        $sql12 = $this->db->query($sql11); 
//        $data['E1video']= count($sql12->result_array());
//        
//        
//        //tạo view số bài đã học khóa kê toán
//        $sqlKT = 'CREATE or replace view tbl_sum_learn_KT AS select student_id,COUNT(learn_ID) as `sum_learn` FROM tbl_student_learn,tbl_courses WHERE
// tbl_student_learn.CourseiD = tbl_courses.ID '.$dk_ngay5.' and tbl_courses.ID in ('.implode(",",$khoaKetoan) .')'
// .'GROUP by student_id';
//        
//        $this->db->query($sqlKT);
//        //đếm 10 bài kế toán
//        $sql3= 'SELECT student_id from tbl_sum_learn_KT WHERE tbl_sum_learn_KT.sum_learn >=10';
//        $sql4 = $this->db->query($sql3); 
//        $data['KT10video']= count($sql4->result_array());
//        //đếm 1 bài kế toán
//        $sql15= 'SELECT student_id from tbl_sum_learn_KT WHERE tbl_sum_learn_KT.sum_learn >=1';
//        $sql16 = $this->db->query($sql15); 
//        $data['KT1video']= count($sql16->result_array());
//        
//        
//        //tạo view đếm số bài học viên phải học để hoàn thành khóa học EXcel tính trên tổng số khóa học viên đã mua
//        $sql5 = 'CREATE or replace view tbl_sum_learn_all_E AS select tbl_student_courses.student_id, COUNT(tbl_learn.id) as `sum_learn` 
//FROM tbl_courses,tbl_student_courses, tbl_learn
//WHERE tbl_student_courses.courses_id = tbl_learn.courses_id AND tbl_courses.id = tbl_learn.courses_id AND tbl_learn.trial_learn = 0 '.$dk_ngay6.' AND tbl_student_courses.courses_id IN ('.implode(",",$khoaExcel) .')'
//.'GROUP BY tbl_student_courses.student_id';
//        $this->db->query($sql5);
//        //đếm số học viên học hết
//        $sql6= 'SELECT tbl_sum_learn_E.Student_id from tbl_sum_learn_E,tbl_sum_learn_all_E WHERE tbl_sum_learn_E.Student_id = tbl_sum_learn_all_E.student_id and tbl_sum_learn_E.sum_learn = tbl_sum_learn_all_E.sum_learn';
//        $sql7 = $this->db->query($sql6); 
//        $data['Eallvideo']= count($sql7->result_array());
//        
//       
//        
//        //tạo view đếm số bài học viên phải học để hoàn thành khóa học Kế Toán tính trên tổng số khóa học viên đã mua
//        $sql8 = 'CREATE or replace view tbl_sum_learn_all_KT AS select tbl_student_courses.student_id, COUNT(tbl_learn.id) as `sum_learn` 
//FROM tbl_courses,tbl_student_courses, tbl_learn
//WHERE tbl_student_courses.courses_id = tbl_learn.courses_id AND tbl_courses.id = tbl_learn.courses_id AND tbl_learn.trial_learn = 0 '.$dk_ngay6.' AND tbl_student_courses.courses_id IN ('.implode(",",$khoaKetoan) .')'
//.'GROUP BY tbl_student_courses.student_id';
//        $this->db->query($sql8);
//        //đếm số học viên học hết
//        $sql9= 'SELECT tbl_sum_learn_KT.student_id from tbl_sum_learn_KT,tbl_sum_learn_all_KT WHERE tbl_sum_learn_KT.student_id = tbl_sum_learn_all_KT.student_id and tbl_sum_learn_KT.sum_learn = tbl_sum_learn_all_KT.sum_learn';
//        $sql10 = $this->db->query($sql9); 
//        $data['KTallvideo']= count($sql10->result_array());
//        
//        
//        
//         
//        
//        $data['content'] = 'BaoCaoVanHanhHocVien/index';
//        $data['header'] = 'dash_header';
//        $data['footer'] = 'dash_footer';
//        $this->load->view('template', $data);
//    }
    
//    function update_time_learn(){
//        $a = $this->lib_mod->load_all('student_learn', '', array('time' => NULL), '', '', '');
//       //$b = count($a);
//        var_dump($a);die;
// 
//        foreach ($a as $key => $value){
//            if($value['time'] == NULL){
//                $this->lib_mod->update('student_learn', array('student_id' => $value['student_id']), array('time' => 0));
//            }
//        }
//        echo "<script>alert('da xong !!')</script>";
//        
//    }
    
            
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
    }
