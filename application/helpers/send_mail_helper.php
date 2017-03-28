<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function _sendMail($to, $sub, $msg){

		$CI =& get_instance();
     	$CI->load->library('email'); // load library

		/*$CI->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.sendgrid.net',
			'smtp_user' => 'owaishanif786',
			'smtp_pass' => 'bingo123',
			'smtp_port' => 587,
			'charset' => 'utf-8',
			'mailtype' => 'html'
			));*/
		// testing
		/*$CI->email->initialize(array(
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
		));*/
		$config=array(
	    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
	    'smtp_host' => 'smtp.xyzflyers.com',
	    'smtp_port' => 465,
	    'smtp_user' => 'admin@xyzflyers.com',
	    'smtp_pass' => 'admin@xyz786',
	    //'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example,
	    'validation' => false,
	    'mailtype' => 'html', //plaintext 'text' mails or 'html'
	    'smtp_timeout' => '7', //in seconds
	    'charset' => 'iso-8859-1',
	    'wordwrap' => TRUE
		);

           /* $config['protocol']    = 'smtp';

            $config['smtp_host']    = 'ssl://smtp.gmail.com';

            $config['smtp_port']    = '465';

            $config['smtp_timeout'] = '7';

            $config['smtp_user']    = 'pakipreneurs786@gmail.com';

            $config['smtp_pass']    = 'paki@786';

            $config['charset']    = 'utf-8';

            $config['newline']    = "\r\n";

            $config['mailtype'] = 'html'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not      

            $CI->email->initialize($config);*/
        //$CI->load->library('email',$config);
		$CI->email->set_mailtype('html');
		$CI->email->from('no-reply@xyzflyers.com', 'XYZ Flyers');	
		$CI->email->to($to);
		$CI->email->subject($sub);
		$CI->email->message($msg);
		$CI->email->send();
		 //echo $CI->email->print_debugger();
	}