<?php

class Testing extends CI_Controller{

	function __construct()
	{
		/*phpinfo();
		exit;*/
		parent::__construct();
	}

	function index()
	{
		$this->load->view('version_check');
	}

	public function testMTA()
	{
		$this->load->library('email');
		$config = Array(
			'protocol' => 'smpt',
			'smtp_host' => 'xyzflyers.com',
			'smtp_port' => 465,
			'smtp_user' => 'admin@xyzflyers.com',
			'smtp_pass' => 'admin@xyz786',
			'validate'	=> true,
			'mailpath'  => 'mail',
			'mailtype'  => 'text', 
			'charset'   => 'iso-8859-1'
			);

	   /* $config=array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_user' => 'pakipreneurs786@gmail.com',
			'smtp_pass' => 'paki@786',
			'smtp_port' => 465,
			'smtp_timeout' => '7',
			'charset' => 'utf-8',
			'newline' => "\r\n",
			'mailtype' => 'html',
			'validation'=> false
		);*/
		 	/*$config = array();
		    $config['mailpath']  = "/usr/sbin/sendmail"; // or "/usr/sbin/sendmail"
		    $config['protocol']  = "smtp";
		    $config['smtp_host'] = "localhost";
		    $config['smtp_port'] = "25";
		    $config['mailtype'] = 'html';
		    $config['charset']  = 'utf-8';
		    $config['newline']  = "\r\n";
		    $config['wordwrap'] = TRUE;

		    $this->load->library('email');*/

		    $this->email->initialize($config);

		//$this->load->library('email');
		//$this->email->set_newline("\r\n");

		// Set to, from, message, etc.
		$this->email->to('smehsoud@pakipreneurs.com');
		$this->email->from('peham@postman.xyzflyers.com');
		$this->email->subject('Pehm Testing Mail');
		$r=$this->email->message('hellow');

		$this->email->print_debugger() ;
		echo "<pre>";
		print_r($r);
	}

	
}