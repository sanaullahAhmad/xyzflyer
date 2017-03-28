<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_designer_settings extends CI_Controller {
    
        public function __construct() {
        parent::__construct();
        if(xyzAccesscontrol('flyer_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
        }
        $this->load->model('frontend/commonmodel');
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0)
        // {
        //     $this->commonmodel->no_permissions();
        // }
    }

    public function index() {

        $this->commonmodel->permissions_check();
         $data = '';
        $this->commonmodel->adminloadLayout($data,'admin/home/designer_settings');
        
    }

}
