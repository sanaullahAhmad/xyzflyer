<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once "recaptchalib.php";

class Admin_newsletter extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('frontend/Commonmodel'));
		$this->load->model('Admin_newsletter_model');
	}

	public function index()
	{
		$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
		$per_page=$this->input->get('records');
        if ($q <> '') {
            $config['base_url'] = base_url() . 'Admin_newsletter/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Admin_newsletter/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Admin_newsletter/index?records='.urlencode($per_page);
            $config['first_url'] = base_url() . 'Admin_newsletter/index?records='.urlencode($per_page);
        }
			if($this->input->get('records')){
				$per_page=$this->input->get('records');
				$config['per_page'] = $per_page;
			}else{
				
				$config['per_page'] = 10;
			}
			
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Admin_newsletter_model->total_rows($q);
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$emails = $this->Admin_newsletter_model->get_limit_data($config['per_page'], $start ,$q);
			
			$data = array(
				'emails' => $emails,
				'q' => $q,
				'records' => $per_page,
				'per_page'=>$per_page,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
			);
			
		
		$this->breadcrumbs->push('Newsletter Subscription', '/newsletter_management');
		$this->breadcrumbs->push('Emails', '/newsletter_management/index');
		 $this->Commonmodel->adminloadLayout($data,'admin/newsletter_management/list_all');
	}
	
	 public function update($id)
    {
        $row = $this->Admin_newsletter_model->get_by_id($id);
		$this->breadcrumbs->push('Newsletter Subscription', '/newsletter_management');
		$this->breadcrumbs->push('Email Update', '/Admin_newsletter/update');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Admin_newsletter/update_action'),
                'id' => site_url('id',$row->id),
				'email' => set_value('verification_status',$row->email),
				'verification_status' => set_value('verification_status',$row->verification_status),
				'history_ip' => set_value('history_ip',$row->history_ip),
				'history_browser_info' => set_value('history_browser_info',$row->history_browser_info),
				'history_referer' => set_value('history_referer',$row->history_referer),
				'history_date' => set_value('history_date',$row->history_date)			
                );
            $this->Commonmodel->adminloadLayout($data,'admin/newsletter_management/email_form');
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('Admin_newsletter'));
        }
    }

    public function update_action()
    {
		$this->form_validation->set_rules('email','Email', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));

        } else {
			 $data = array(
				'email' =>$this->input->post('email',TRUE)
			);
            $this->Admin_newsletter_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', '<span class="alert-success">Record has been updated Successfully</span>');
            redirect(site_url('Admin_newsletter'));
        }
    }
	
	 public function delete($id)
    {
        $row = $this->Admin_newsletter_model->get_by_id($id);

        if ($row) {
            $this->Admin_newsletter_model->delete($id);
            $this->session->set_flashdata('message', '<span class="alert-success">Record has been deleted Successfully</span>');
            redirect(site_url('Admin_newsletter'));
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('Admin_newsletter'));
        }
    }
}

?>