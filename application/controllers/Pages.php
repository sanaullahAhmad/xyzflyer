<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once "recaptchalib.php";


class Pages extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('frontend/commonmodel'));
		
	}
	
	 public function cookiepolicy() {
      
		$data['cookie']=$this->commonmodel->getSingleRecord('SELECT * FROM `tbl_page` WHERE page_title = "cookiespolicy"');
		//print_r($data);exit;
		$this->load->view('new_frontend/cookiepolicy', $data);
		
    }
	
	public function privaypolicy() {
        
        $data['privacy']=$this->commonmodel->getSingleRecord('SELECT * FROM `tbl_page` WHERE page_title = "privacypolicy"');
        $this->load->view('new_frontend/privacypolicy', $data);
    }
	
	public function disclaimer() {
        
        $data['disclaimer']=$this->commonmodel->getSingleRecord('SELECT * FROM `tbl_page` WHERE page_title = "disclaimer"');
        $this->load->view('new_frontend/disclaimer', $data);
    }
	
	public function terms() {
        
        $data['terms']=$this->commonmodel->getSingleRecord('SELECT * FROM `tbl_page` WHERE page_title = "termsandconditions"');
        $this->load->view('new_frontend/terms', $data);
    }
	
	public function sitemap() {
        
        $data['sitemap']=$this->commonmodel->getSingleRecord('SELECT * FROM `tbl_page` WHERE page_title = "sitemap"');
        $this->load->view('new_frontend/sitemap', $data);
    }

}
?>