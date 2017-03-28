<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin_subscription extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(xyzAccesscontrol('user_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
		$this->load->model('frontend/Commonmodel');
		$this->load->model('Email_management_model');
		$this->load->library('breadcrumbs');
		$this->load->library('form_validation');
		
	}

	public function index($filter=Null)
	{	
		$q=null;
		$search=null;
		if($this->input->get('q')){
			$q = urldecode($this->input->get('q', TRUE));
			$search="search";
		}
        $start = intval($this->input->get('start'));
		$per_page=$this->input->get('records');
        if ($q <> '') {
            $config['base_url'] = base_url() . 'Admin_subscription/index.aspx?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Admin_subscription/index.aspx?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Admin_subscription/index.aspx?records='.urlencode($per_page);
            $config['first_url'] = base_url() . 'Admin_subscription/index.aspx?records='.urlencode($per_page);
        }
			if($this->input->get('records')){
				$per_page=$this->input->get('records');
				$config['per_page'] = $per_page;
			}else{
				
				$config['per_page'] = 10;
			}
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Email_management_model->all_rows($q);
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$subscriber = $this->Email_management_model->get_subscriber_data($config['per_page'], $start ,$q);
			
			$data = array(
				'subscriber' => $subscriber,
				'records' => $per_page,
				 'q' => $search,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
			);
		$this->breadcrumbs->push('Email Management', '/emailmanagement');
		$this->breadcrumbs->push('Subscriber email', '/Admin_subscription/index');
		$this->Commonmodel->adminloadLayout($data,'admin/email_management/subsription_list');
	}

	public function email_unsubscribers($value='')
	{
		$q=null;
		$search=null;
		if($this->input->get('q')){
			$q = urldecode($this->input->get('q', TRUE));
			$search="search";
		}
        $start = intval($this->input->get('start'));
		$per_page=$this->input->get('records');
        if ($q <> '') {
            $config['base_url'] = base_url() . 'email_unsubscribers/index.aspx?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'email_unsubscribers/index.aspx?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'email_unsubscribers/index.aspx?records='.urlencode($per_page);
            $config['first_url'] = base_url() . 'email_unsubscribers/index.aspx?records='.urlencode($per_page);
        }
			
		$config['per_page'] = ((intval($per_page) >= 10) ? intval($per_page) : 10);
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = count($this->Email_management_model->get_unsubscriber_data($config['per_page'], $start ,$q));
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$unsubscriber = $this->Email_management_model->get_unsubscriber_data($config['per_page'], $start ,$q);

		$data = array(
			'subscriber' => $unsubscriber,
			'records' => $per_page,
			'q' => $search,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
		);
		$this->breadcrumbs->push('Email Management', '/emailmanagement');
		$this->breadcrumbs->push('Unsubscriber Emails', '/Admin_subscription/index');
		$this->Commonmodel->adminloadLayout($data,'admin/email_management/unsubsription_list');
	}


	
}