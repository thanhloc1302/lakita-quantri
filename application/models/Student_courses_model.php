<?php

class Student_courses_model extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->table = 'student_courses';
    }


}
