<?php
/**
* New design Congtroller
*/
class Email_test extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('frontend/commonmodel'));
		$this->load->model('Users_model');
		$this->load->model('Subscriber_model');
	}

	public function index()
	{
		
		$this->load->helper('send_mail');
	
		_sendMail('talston01@gmail.com', 'test', 'test');

	}

	public function template($name, $send=0)
	{
		$data['header'] = 'emails/style1/incs/header';
		$data['footer'] = 'emails/style1/incs/footer';
		$data['body'] = '';
		if($send!=1)
		$this->load->view('emails/style1/'.$name, $data);
		else{
			$this->load->helper('send_mail');
			if(_sendMail('talston01@gmail.com', $name, $this->load->view('emails/style1/'.$name, $data, true))) echo 'success';

		}

	}
}  
?>