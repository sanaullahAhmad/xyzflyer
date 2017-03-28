<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_logs extends CI_Controller {
    
        public function __construct() {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0)
        // {
        //     $this->commonmodel->no_permissions();
        // }
    }
 
    public function index() {

        $this->commonmodel->permissions_check();
        $this->load->model('admins_model');
        $this->load->model('users_model');
        $data['admins'] = $this->admins_model->get_all_admins();
        $data['users'] = $this->users_model->get_all_users();
        
        $this->commonmodel->adminloadLayout($data,'admin/home/admin_logs');
        
    }

}
