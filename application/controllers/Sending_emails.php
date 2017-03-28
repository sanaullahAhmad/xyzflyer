<?php
/**
* New design Congtroller
*/
class Sending_emails extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->user_data)redirect(site_url('login'));
		$this->load->model(array('frontend/commonmodel'));
		$this->load->model('Users_model');
		$this->load->model('Subscriber_model');
		$this->load->helper('send_mail');
	}

	public function index()
	{
		echo 'nothing here';

	}

	public function send($template, $subject, $userId)
	{
		$row = $this->Users_model->get_by_id($userId);
		$data['header'] = 'emails/style1/incs/header';
		$data['footer'] = 'emails/style1/incs/footer';
		$data['body'] = '';
		if(_sendMail($row->userEmail, $subject, $this->load->view('emails/style1/'.$template, $data, true))) echo 'success';
	}
}  
?>