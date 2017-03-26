<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BaoCaoVanHanhHocVien extends CI_Controller {

    function index() {
        $admin_id = $this->session->userdata('admin_id');
        if (!isset($admin_id) || empty($admin_id))
            redirect('home/login');

        $admin = $this->lib_mod->detail('admin', array('admin_id' => $admin_id));
        if (empty($admin))
            redirect('home/login');

        $data['content'] = 'BaoCaoVanHanhHocVien/index';
        $data['header'] = 'dash_header';
        $data['footer'] = 'dash_footer';
        $this->load->view('template', $data);
    }

    
    
    
    }
