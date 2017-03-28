<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Search extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(xyzAccesscontrol('user_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
		$this->load->model('frontend/commonmodel');
		$check = $this->commonmodel->permissions_check();
		$this->load->model('admin/SearchModel');
		  $this->load->model('Users_activity_model');
		
	}

	public function index($filter=Null)
	{
		
		$data['us_state']=$this->commonmodel->state_list;
		$this->commonmodel->adminloadLayout($data,'admin/search');
	}

	public function searchAction(){
		$this->load->library('form_validation');
		$result=null;
		$query=$this->input->post('query');
		
		$result=$this->SearchModel->serachByFilter($query);
	
		  $data['us_state']=$this->commonmodel->state_list;
		  $data['users_data'] =$result;		 
		  $data['results_for'] =$this->input->post();
		  $this->commonmodel->adminloadLayout($data,'admin/search');			
	}
	
	public function detailSearch(){
		$data['us_state']=$this->commonmodel->state_list;
		$this->commonmodel->adminloadLayout($data,'admin/DetailSearch');
	}
	public function detailSearchaction(){
		if($_GET){
			$result=null;
		    $query=array();
			foreach($this->input->get() as $name=>$value ){
				if ($value != ''){
					$value=trim($value,"'");
					array_push($query,array($name=>$value));
				}	
			}
			
			$data=array();
			$value=trim($value,"'");
			
			$result=$this->SearchModel->detailsearch($query);
		 
			if($result){
				$id = $result[0]->userId;
				
				$data['us_state']=$this->commonmodel->state_list;
				$data['users_data'] =$result;		 
				$data['results_for'] =$query;
			  // echo "<pre>";print_r($data);exit;
			  $this->commonmodel->adminloadLayout($data,'admin/DetailSearch');	
			}else{
				 $data['us_state']=$this->commonmodel->state_list;
				 $data['message']= "No Record Found";
				 $this->commonmodel->adminloadLayout($data,'admin/DetailSearch');
			}
		}else{
			 $data['us_state']=$this->commonmodel->state_list;
			 $data['message']= "Please Enter Search";
			 $this->commonmodel->adminloadLayout($data,'admin/DetailSearch');
		}	
					
	}
	
	public function Search_read(){
		if($_GET){
			$result=null;
		    $query=array();
			foreach($this->input->get() as $name=>$value ){
				if ($value != ''){
					$value=trim($value,"'");
					array_push($query,array($name=>$value));
				}	
			}
			
			$data=array();
			$value=trim($value,"'");
			
			$result=$this->SearchModel->detailsearch($query);
		 
			if($result){
				$this->breadcrumbs->push('Search', '/search/');
				$this->breadcrumbs->push('Detail', '/search/x');
				$id = $result[0]->userId;
				//////////////////// order Data /////////////////////
			  $data['order_data'] = $this->SearchModel->getOrders($id);
			  $data['UserActivity']= $this->Users_activity_model->get_all_by_user($id);
			 
			  $data['us_state']=$this->commonmodel->state_list;
			  $data['users_data'] =$result;		 
			  $data['results_for'] =$this->input->get();
			  if(isset($_SERVER["HTTP_REFERER"])){
			   $data['button_url'] =$_SERVER["HTTP_REFERER"];
			  }else{
				  $data['button_url'] = base_url()."/admin/search";
			  }
			  // echo "<pre>";print_r($data);exit;
			  $this->commonmodel->adminloadLayout($data,'admin/search_read');	
			}else{
				 $data['us_state']=$this->commonmodel->state_list;
				 $data['message']= "No Record Found";
				 $this->commonmodel->adminloadLayout($data,'admin/search_read');
			}
		}else{
			 $data['us_state']=$this->commonmodel->state_list;
			 $data['message']= "Please Enter Search";
			 $this->commonmodel->adminloadLayout($data,'admin/search_read');
		}	
					
	}
	
}