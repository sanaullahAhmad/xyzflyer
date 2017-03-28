<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('frontend/commonmodel', 'ci');
    }

    public function index() {
        $check = $this->ci->permissions_check();
        if($check=='0')
        {
            $data['check'] = true;
            $data['super_admins'] = $this->ci->total_super_admins();
            $data['template_designers'] = $this->ci->total_template_designers();
            $data['accounts_manager'] = $this->ci->total_accounts_manager();
            $data['sales_manager'] = $this->ci->total_sales_manager();
            $data['active_users'] = $this->ci->total_active_users();
            $data['unverified_users'] = $this->ci->total_unverified_users();
            $data['suspended_users'] = $this->ci->total_suspended_users();
        }else{
            $data['check'] = null;
        }
         if($this->session->userdata('admin_data')['pk_my_type']==1){
            $this->ci->adminloadLayout($data,'admin/home/designer_settings');
            
        }else{
            $this->ci->adminloadLayout($data,'admin/home/admin_dashboard');
        }    
    }
    public function designer_settings()
    {
        $data = '';
        $this->ci->adminloadLayout($data,'admin/home/designer_settings');
    }

    public function account_closed()
    {
        $this->ci->check_admin_login();
        $data = '';
        $this->ci->adminloadLayout($data, 'admin/account_closed', null);
    }

    public function ajax_get_sales_by_region(){
        $this->load->model('Admins_model');
        echo json_encode($this->Admins_model->get_sales_by_region()->result_array());

    }

    public function ajax_get_sales_by_region_county(){
        $this->load->model('Admins_model');
        $state = $_POST['state'];
        echo json_encode($this->Admins_model->get_sales_by_region_county($state)->result_array());

    }

    public function ajax_get_recent_users(){

        $this->load->model('Admins_model');
        $res = $this->Admins_model->get_recent_users_data();
        echo json_encode($res);
    }

}
