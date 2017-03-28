<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Email_databaseManagement extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('frontend/Commonmodel');
		$this->load->model('Email_management_model');
		$this->load->library('breadcrumbs');
		$this->load->library('form_validation');
	}
	
	function dashboard(){
		$data=null;
		$this->Commonmodel->adminloadLayout($data,'admin/email_management/email_mange_dashboard');
	}
	public function index() {
		$query = "SELECT * FROM `campaign_emails` WHERE `Agency_Name` = 'Sitka Realty'";
		//$query1 = "select count(email_address) as total from campaign_emails";
		//$data['StateEmail'] = $this->cm->getMultipleRecords($query);
		
		 $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
		$per_page=$this->input->get('records');
        if ($q <> '') {
            $config['base_url'] = base_url() . 'Email_databaseManagement/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Email_databaseManagement/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Email_databaseManagement/index?records='.urlencode($per_page);
            $config['first_url'] = base_url() . 'Email_databaseManagement/index?records='.urlencode($per_page);
        }
			if($this->input->get('records')){
				$per_page=$this->input->get('records');
				$config['per_page'] = $per_page;
			}else{
				
				$config['per_page'] = 10;
			}
			
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Email_management_model->total_rows($q);
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$emails = $this->Email_management_model->get_limit_data($config['per_page'], $start ,$q);
			
			$data = array(
				'emails' => $emails,
				'q' => $q,
				'records' => $per_page,
				'per_page'=>$per_page,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
			);
			
		
		$this->breadcrumbs->push('Email Management', '/emailmanagement');
		$this->breadcrumbs->push('Emails List', '/Email_databaseManagement/index');
		 $this->Commonmodel->adminloadLayout($data,'admin/email_management/list_all');
	}
	
	 public function delete($id)
    {
        $row = $this->Email_management_model->get_by_id($id);

        if ($row) {
            $this->Email_management_model->delete($id);
            $this->session->set_flashdata('message', '<span class="alert-success">Delete Record Success</span>');
            redirect(site_url('Email_databaseManagement'));
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('Email_databaseManagement'));
        }
    }
	
	 public function read($id)
    {
        $row = $this->Email_management_model->get_by_id($id);
		$this->breadcrumbs->push('Emails List', 'Email_databaseManagement/');
		$this->breadcrumbs->push('Detail', '/admins/read');
		
        if ($row) {
            $data = array(
					'Agency_Name' => $row->Agency_Name,
					'First_Name' =>$row->First_Name,
					'Last_Name' =>$row->Last_Name,
					'Full_Name' =>$row->Full_Name,
					'email_address' => $row->email_address,
				 	'City' => $row->City,
					'State' => $row->State,
				//	'ZIPCode' => $row->ZIPCode,
				//	'Address' => $row->Address,
					'County' => $row->County,
				//	'StateFIPS' => $row->StateFIPS,
				//	'Website' => $row->Website,
				//	'Phone_Number' =>$row->Phone_Number,
				//	'Fax_Number' => $row->Fax_Number,
				//	'Timezone' => $row->Timezone,
				//	'Latitude' => $row->Latitude,
				//	'ZIPType' => $row->ZIPType,
				//	'CityType' =>$row->CityType,
				//	'CountyFIPS' =>$row->CountyFIPS,
				//	'UTC' => $row->UTC,
					'unsubscribed' =>$row->unsubscribed
              );
			
            $this->Commonmodel->adminloadLayout($data,'admin/email_management/email_read');
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found<span>');
            redirect(site_url('Email_databaseManagement'));
        }
    }
	
	 public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('Email_databaseManagement/create_action'),
			'email_id' => site_url('email_id'),
			'Agency_Name' => set_value('Agency_Name'),
			'First_Name' => set_value('First_Name'),
			'Last_Name' => set_value('Last_Name'),
           // 'Full_Name' => set_value('Full_Name'),
            'email_address' => set_value('email_address'),
            'City' => set_value('City'),
			'County'=>set_value('County'),
			//'StateFIPS'=>set_value('StateFIPS'),
            //'Address' => set_value('Address'),
            'State' => set_value('State'),
            //'ZIPCode' => set_value('ZIPCode'),
         //   'Phone_Number' => set_value('Phone_Number'),
          //  'Fax_Number' => set_value('Fax_Number'),
         //   'Timezone' => set_value('Timezone'),
        //    'Latitude' => set_value('Latitude'),
         //   'Longitude' => set_value('Longitude'),
         //   'Website' => set_value('Website'),
         //   'ZIPType' => set_value('ZIPType'),
          //  'CityType' => set_value('CityType'),
          //  'CountyFIPS' => set_value('CountyFIPS'),
         //   'StateName' => set_value('StateName'),
            'UTC' => set_value('UTC'),
            'unsubscribed' => set_value('unsubscribed')
            
            );
		$this->breadcrumbs->push('Emails List', '/Email_databaseManagement');
		$this->breadcrumbs->push('Add Email', '/Email_databaseManagement/create');
		$data['us_state']=$this->Commonmodel->state_list;
        $this->Commonmodel->adminloadLayout($data,'admin/email_management/email_form');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			exit;
            $this->create();
        } else {
			$state  = $this->input->post('State');
			$state_name = explode("_", $state);
			
            $data = array(
				'Agency_Name' =>$this->input->post('Agency_Name',TRUE),
				'First_Name' => $this->input->post('First_Name',TRUE),
				'Last_Name' => $this->input->post('Last_Name',TRUE),
				//'Full_Name' => $this->input->post('Full_Name',TRUE),
				'email_address' => $this->input->post('email_address',TRUE),
				'City' => $this->input->post('City',TRUE),
				'County'=>$this->input->post('County',TRUE),
				//'StateFIPS'=>$this->input->post('StateFIPS',TRUE),
				//'Address' => $this->input->post('Address',TRUE),
				'State' => $state,
				//'ZIPCode' => $this->input->post('ZIPCode',TRUE),
				//'Phone_Number' => $this->input->post('Phone_Number',TRUE),
				//'Fax_Number' => $this->input->post('Fax_Number',TRUE),
				//'Timezone' => $this->input->post('Timezone',TRUE),
				//'Latitude' => $this->input->post('Latitude',TRUE),
				//'Longitude' => $this->input->post('Longitude',TRUE),
				//'ZIPType' => $this->input->post('ZIPType',TRUE),
				//'CityType' => $this->input->post('CityType',TRUE),
				//'CountyFIPS' => $this->input->post('CountyFIPS',TRUE),
				//'Website' => $this->input->post('Website',TRUE),
				// 'StateName' =>$state_name[1],
				//'UTC' => $this->input->post('UTC',TRUE),
				'unsubscribed' => $this->input->post('unsubscribed',TRUE)
                 );

            $this->Email_management_model->insert_email($data);
            $this->session->set_flashdata('message', '<span class="alert-success"> Email Added Successfully </span>');
            redirect(site_url('Email_databaseManagement/'));
        }
    }

    public function update($id)
    {
        $row = $this->Email_management_model->get_by_id($id);
		$this->breadcrumbs->push('Email Management', '/Email_databaseManagement');
		$this->breadcrumbs->push('Email Update', '/Email_databaseManagement/update');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Email_databaseManagement/update_action'),
                'email_id' => site_url('email_id',$row->emailId),
				'Agency_Name' => set_value('Agency_Name',$row->Agency_Name),
				'First_Name' => set_value('First_Name',$row->First_Name),
				'Last_Name' => set_value('Last_Name',$row->Last_Name),
				//'Full_Name' => set_value('Full_Name',$row->Full_Name),
				'email_address' => set_value('email_address',$row->email_address),
				'City' => set_value('City',$row->City),
				'County'=>set_value('County',$row->County),
				//'StateFIPS'=>set_value('StateFIPS',$row->StateFIPS),
				//'Address' => set_value('Address',$row->Address),
				'State' => set_value('State',$row->State),
				//'ZIPCode' => set_value('ZIPCode',$row->ZIPCode),
				//'Phone_Number' => set_value('Phone_Number',$row->Phone_Number),
				//'Fax_Number' => set_value('Fax_Number',$row->Fax_Number),
				//'Timezone' => set_value('Timezone',$row->Timezone),
				//'Latitude' => set_value('Latitude',$row->Latitude),
				//'Longitude' => set_value('Longitude',$row->Longitude),
				//'ZIPType' => set_value('ZIPType',$row->ZIPType),
				//'CityType' => set_value('CityType',$row->CityType),
				//'CountyFIPS' => set_value('CountyFIPS',$row->CountyFIPS),
				//'Website' => set_value('Website',$row->Website),
				 //'StateName' => set_value('StateName',$row->StateName),
				//'UTC' => set_value('UTC',$row->UTC),
				'unsubscribed' => set_value('unsubscribed',$row->unsubscribed)
				
                );
			$data['us_state']=$this->Commonmodel->state_list;
            $this->Commonmodel->adminloadLayout($data,'admin/email_management/email_form');
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('Email_databaseManagement'));
        }
    }

    public function update_action()
    {
		
        $this->_update_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('email_id', TRUE));

        } else {
				$state  = $this->input->post('State');
				$state_name = explode("_", $state);
				
                $data = array(
				'Agency_Name' =>$this->input->post('Agency_Name',TRUE),
				'First_Name' => $this->input->post('First_Name',TRUE),
				'Last_Name' => $this->input->post('Last_Name',TRUE),
				'Full_Name' => $this->input->post('Full_Name',TRUE),
				'email_address' => $this->input->post('email_address',TRUE),
				'City' => $this->input->post('City',TRUE),
				'County'=>$this->input->post('County',TRUE),
				//'StateFIPS'=>$this->input->post('StateFIPS',TRUE),
				//'Address' => $this->input->post('Address',TRUE),
				'State' => $state,
				//'ZIPCode' => $this->input->post('ZIPCode',TRUE),
				//'Phone_Number' => $this->input->post('Phone_Number',TRUE),
				//'Fax_Number' => $this->input->post('Fax_Number',TRUE),
				///'Timezone' => $this->input->post('Timezone',TRUE),
				//'Latitude' => $this->input->post('Latitude',TRUE),
				//'Longitude' => $this->input->post('Longitude',TRUE),
				//'ZIPType' => $this->input->post('ZIPType',TRUE),
				//'CityType' => $this->input->post('CityType',TRUE),
				//'CountyFIPS' => $this->input->post('CountyFIPS',TRUE),
				//'Website' => $this->input->post('Website',TRUE),
				// 'StateName' => $state_name[1],
				//'UTC' => $this->input->post('UTC',TRUE),
				'unsubscribed' => $this->input->post('unsubscribed',TRUE)
                 );
			
            $this->Email_management_model->update($this->input->post('email_id', TRUE), $data);
            $this->session->set_flashdata('message', '<span class="alert-success">Successfully Updated</span>');
            redirect(site_url('Email_databaseManagement'));
        }
    }
	
	public function _update_rules()
    {   
		//$this->form_validation->set_rules('Agency_Name','Agency_Name', 'trim|required');
		$this->form_validation->set_rules(  'First_Name','First_Name', 'trim|required');
		$this->form_validation->set_rules(	'Last_Name' , 'Last_Name', 'trim|required');
		//$this->form_validation->set_rules(	'Full_Name' ,'Full_Name', 'trim|required');
		$this->form_validation->set_rules(	'email_address'  , 'email_address', 'trim|required');
		//$this->form_validation->set_rules(	'City'   , 'City', 'trim|required');
		$this->form_validation->set_rules(	'County' , 'County', 'trim|required');
		//$this->form_validation->set_rules(	'StateFIPS', 'StateFIPS', 'trim|required');
		//$this->form_validation->set_rules(	'Address', 'Address', 'trim|required');
		$this->form_validation->set_rules(	'State', 'State', 'trim|required');
		//$this->form_validation->set_rules(	'ZIPCode' , 'ZIPCode', 'trim|required');
		//$this->form_validation->set_rules(	'Phone_Number'  , 'Phone_Number', 'trim|required');
		//$this->form_validation->set_rules(	'Fax_Number' , 'Fax_Number', 'trim|required');
		//$this->form_validation->set_rules(	'Timezone' , 'Timezone' ,'trim|required');
		//$this->form_validation->set_rules(	'Latitude' , 'Latitude', 'trim|required');
		//$this->form_validation->set_rules(	'Longitude' , 'Longitude', 'trim|required');
		//$this->form_validation->set_rules(  'ZIPType'  , 'ZIPType', 'trim|required');
		//$this->form_validation->set_rules(  'CityType'   , 'CityType', 'trim|required');
		//$this->form_validation->set_rules(  'CountyFIPS'  , 'CountyFIPS', 'trim|required');
		//$this->form_validation->set_rules(	'Website'  , 'Website', 'trim|required');
		//$this->form_validation->set_rules(	 'StateName'  , 'StateName', 'trim|required');
		//$this->form_validation->set_rules(	'UTC'  ,'UTC', 'trim|required');
		$this->form_validation->set_rules(	'unsubscribed', 'trim|required');
		$this->form_validation->set_rules('email_id', 'email_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function _rules()
    {
      //  $this->form_validation->set_rules(  'Agency_Name','Agency_Name', 'trim|required');
		$this->form_validation->set_rules(  'First_Name','First_Name', 'trim|required');
		$this->form_validation->set_rules(	'Last_Name' , 'Last_Name', 'trim|required');
		//$this->form_validation->set_rules(	'Full_Name' ,'Full_Name', 'trim|required');
		$this->form_validation->set_rules(	'email_address'  , 'email_address', 'trim|required');
	//	$this->form_validation->set_rules(	'City'   , 'City', 'trim|required');
		$this->form_validation->set_rules(	'County' , 'County', 'trim|required');
		//$this->form_validation->set_rules(	'StateFIPS', 'StateFIPS', 'trim|required');
		//$this->form_validation->set_rules(	'Address', 'Address', 'trim|required');
		$this->form_validation->set_rules(	'State', 'State', 'trim|required');
		//$this->form_validation->set_rules(	'ZIPCode' , 'ZIPCode', 'trim|required');
		//$this->form_validation->set_rules(	'Phone_Number'  , 'Phone_Number', 'trim|required');
		//$this->form_validation->set_rules(	'Fax_Number' , 'Fax_Number', 'trim|required');
		//$this->form_validation->set_rules(	'Timezone' , 'Timezone' ,'trim|required');
		//$this->form_validation->set_rules(	'Latitude' , 'Latitude', 'trim|required');
		//$this->form_validation->set_rules(	'Longitude' , 'Longitude', 'trim|required');
		//$this->form_validation->set_rules(  'ZIPType'  , 'ZIPType', 'trim|required');
		//$this->form_validation->set_rules(  'CityType'   , 'CityType', 'trim|required');
		//$this->form_validation->set_rules(  'CountyFIPS'  , 'CountyFIPS', 'trim|required');
		//$this->form_validation->set_rules(	'Website'  , 'Website', 'trim|required');
		
		//$this->form_validation->set_rules(	'UTC'  ,'UTC', 'trim|required');
		$this->form_validation->set_rules('unsubscribed', 'trim|required');
		$this->form_validation->set_rules('email_id', 'email_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

   }
	
}