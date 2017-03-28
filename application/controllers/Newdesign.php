<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once "recaptchalib.php";


/**
* New design Congtroller
*/
class Newdesign extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('frontend/commonmodel'));
		$this->load->model('Users_model');
		$this->load->model('Subscriber_model');
	}

	public function index($value='')
	{
		$res = $this->commonmodel->getSingleRecord('Select count(DISTINCT email_address) as total_agents from campaign_emails');
		$res2 = $this->commonmodel->getSingleRecord('Select count(DISTINCT CountyFIPS) as total_counties from campaign_emails where CountyFIPS <> "" and CountyFIPS <> "NULL"');
		$res3 = $this->commonmodel->getSingleRecord('Select count(DISTINCT City) as total_cities from campaign_emails where City <> "" and City <> "NULL"');
		
		// print_r($res2);
		$data['total_agents'] = floor($res->total_agents/10)*10;
		$data['total_counties'] = floor($res2->total_counties/10)*10;
		$data['total_cities'] = floor($res3->total_cities/10)*10;
		$data['emails_delivered'] = $this->email_stats();
		$data['slider_image'] = $this->commonmodel->getMultipleRecords('SELECT * FROM `tbl_frontend` WHERE `frontend_location` = "home" AND `status` = 1');
		
		$data['front_tags']=$this->commonmodel->getMultipleRecords("SELECT * FROM tbl_flyer_tags WHERE show_on_homepage=1");
		$data['front_flyer']=$this->commonmodel->getMultipleRecords("SELECT tbl_flyer.*,
			GROUP_CONCAT(tbl_tag.fk_flyer_tag_id ORDER BY tbl_tag.fk_flyer_tag_id ASC SEPARATOR ',') tags 
			from tbl_flyer_detail as tbl_flyer 
			LEFT JOIN tbl_r_flyer_flyer_tag as tbl_tag ON tbl_flyer.pk_flyer_detail_id=tbl_tag.fk_flyer_id 
			where tbl_flyer.show_on_homepage=1 GROUP BY tbl_flyer.pk_flyer_detail_id");


		$this->load->view('new_frontend/public/template', $data);
	}

	public function save_order()
	{
		if($this->input->post('skip_next_step')==true){
			if($this->session->userdata('tab_open')==5){
				$this->session->set_userdata('tab_open', 6);	
			}else{
				//do nothing
			}
			
		}

		$this->session->set_userdata(array('user_order' => array('details' => $this->input->post('order'), 'order_type'=>$this->input->post('order_type'), 'price'=>$this->input->post('price'), 'quantity'=>$this->input->post('quantity') )));
		if($this->session->user_order)
			echo 'done';
		else echo 'error';
	}

	public function clear_order_selection()
	{
		$this->session->unset_userdata('user_order');
		if($this->session->userdata('user_order'))
			echo 'error';
		else echo 'done';
	}

	public function flyer_coupon($coupon_id)
	{
        //$this->db->query("SELECT coupon_maximum_uses as t_coupon FROM `admi_coupons` WHERE coupon_id=$coupon_id");
		$this->db->select('coupon_maximum_uses, coupon_code, coupon_type, coupon_value');
		$this->db->where('coupon_id', $coupon_id);
		$res = $this->db->get('admi_coupons');
		$res = $res->row();
		$res_coupon_code=0;
		$res_coupon_type=0;
		$res_coupon_value=0;
		$res_coupon_maximum_uses=0;
		if($res)
		{
			$res_coupon_code= $res->coupon_code;
			$res_coupon_type=$res->coupon_type;
			$res_coupon_value=$res->coupon_value;
			$res_coupon_maximum_uses=$res->coupon_maximum_uses;
		}
		$this->db->where('coupon_code', $res_coupon_code);
		$this->db->from('admi_coupons_used');
		$admi_coupons_used = $this->db->count_all_results();

        //echo $admi_coupons_used;exit;

		if($res_coupon_type==2)
		{
			$data['price'] = 39.95 - (39.95*$res->coupon_value/100);
		}
		else{
			$data['price'] = (39.95 - $res_coupon_value);
		}

		$data['available_coupons'] = ($res_coupon_maximum_uses - $admi_coupons_used);
		$data['header'] = 'emails/style1/incs/header';
		$data['footer'] = 'emails/style1/incs/footer_coupon';
		$data['tracker'] = '<img src="'.base_url().'/Bulk_emailer/email_tracker/'.$coupon_id.'" alt="" width="1px" height="1px">';
		$this->load->view('emails/style1/flyer_coupon', $data);
	}

	public function login($value='')
	{
		if(isset($_SESSION['user_data'])){
			redirect(site_url('order'));
		}else{
			$this->load->view('new_frontend/login');
		}
	}
	public function login_action(){
       //var_dump($_POST);exit;
		$email = $this->input->post('email', TRUE);
		$pass = md5($this->input->post('password', TRUE));
		$remember = $this->input->post('rememberme', TRUE);
		
		$secret = "6LeiygkUAAAAAFObKX5r_Glxhx2EIGmoevlM8RD4";
		$response = null;
		$reCaptcha = new ReCaptcha($secret);
		
		if (isset($_POST["g-recaptcha-response"])) {
			$response = $reCaptcha->verifyResponse(
				$_SERVER["REMOTE_ADDR"],
				$_POST["g-recaptcha-response"]
				);
		}
		$captchValidation=json_decode($response->success);
		//print_r($captchValidation);exit;
		if($captchValidation !=  1){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please Verify Captcha</div>');
			redirect(site_url('login'));
		}elseif($email && $pass ){
			$result = $this->Users_model->get_by_email($email, $pass);

			if( $result && $result->userStatus != 1){
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Your account is not verified. We have sent you an email with information on how to verify your account. Please check your email.</div>');
				redirect(site_url('login'));
			}
			if(!empty($result->userFirstName)){

				$userSessionData = array(
					'user' => 1,
					'username' => $result->userFirstName,
					'pk_user_id' => $result->userId,
					'pk_my_status' => $result->userStatus,
					'pk_my_type' => $result->userType,
					);
				$this->session->set_userdata('user_data',$userSessionData);
				if($remember){
					$this->session->sess_expiration = '14400000';
				}

				$this->load->model('Users_login_history_model');
				$this->Users_login_history_model->insert([
					'history_ip' => $_SERVER['REMOTE_ADDR'],
					'history_browser_info' => $_SERVER['HTTP_USER_AGENT'],
					'history_referer' => $_SERVER["HTTP_REFERER"],
					'history_date' => Date('Y-m-d H:i:s'),
					'user_id' =>$result->userId
					]);

				redirect(site_url('order'));
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">invalid credentials.</div>');
				redirect(site_url('login'));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please enter user email and password.</div>');
			redirect(site_url('login'));
		}

	}
	
	public function logout(){
		if(isset($_SESSION['user_data'])){

			$this->session->unset_userdata('user_data');
			$this->session->sess_destroy();
            //There is a bug in flash data after session is destroyed.
			$this->session->set_flashdata('message', '<div class="alert alert-success">logout Successful.</div>');
			redirect(site_url('login'));
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">You have been already Logged out.</div>');
			redirect(site_url('login'));
		}
	}
	public function lost_password(){
		if(isset($_SESSION['user_data']['username'])){
			redirect(site_url('order'));
		}else{
			$this->load->view('new_frontend/forgotpassword');
		}
	}
	public function lost_password_action(){
		$email = $this->input->post('email');
		$res = $this->Users_model->get_by_email($email);
		$code = md5(time());
		$secret = "6LeiygkUAAAAAFObKX5r_Glxhx2EIGmoevlM8RD4";
		$response = null;
		$reCaptcha = new ReCaptcha($secret);
		
		if (isset($_POST["g-recaptcha-response"])) {
			$response = $reCaptcha->verifyResponse(
				$_SERVER["REMOTE_ADDR"],
				$_POST["g-recaptcha-response"]
				);
		}
		$captchValidation=json_decode($response->success);
		//print_r($captchValidation);exit;
		if($captchValidation !=  1){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please Verify Captcha</div>');
			redirect(site_url('lostpass'));
		}elseif ($email && $res){

			$subject="Reset Your Password";
			$this->Users_model->update($res->userId, ['userVerificationCode' => $code]);
			$this->load->helper('send_mail');
			$html = "<p>You have received this email message because you have recently submitted this email address to the XYZ Flyers for password.</p>
			<p>Click the link and you'll be redirected to a secure site from which you can set a new password.</p>";
			
			$data['html']=$html;
			$data['code']=$code;
			$data['email']=$email;
			
			_sendMail($email, $subject, $this->load->view('emails/forgetpass_email',$data, TRUE));	
			$this->session->set_flashdata('message', '<div class="alert alert-success">Please check your email for a link to reset your password or reset again <a href="'.site_url('lostpass').'">Click here to send it again</a></div>');
			redirect(site_url('info'));
			die('');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid Email.</div>');
			redirect(site_url('lostpass'));
		}
	}
	public function reset_password(){
		if(isset($_GET['email']) && isset($_GET['code']) && !empty($_GET['email']) && !empty($_GET['code'])){
			$email = $_GET['email'];
			$code = $_GET['code'];
			$res  = $this->Users_model->get_by_email($email);
			if($res && $res->userVerificationCode == $code){
				$user_data['id'] = $res->userId;
				$user_data['code'] = $res->userVerificationCode;
				$user_data['email'] = $res->userEmail;

				$this->load->view('new_frontend/recoverpassword',$user_data);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid Code or link expired try a new one.</div>');
				redirect(site_url('lostpass'));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid Attempt.</div>');
			redirect(site_url('lostpass'));
		}
	}
	public function reset_password_action(){
		$id = $this->input->post('useridentity');
		$code = $this->input->post('usercode');
		$email = $this->input->post('useremail');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		$res = $this->Users_model->get_by_email($email);
		if( $res->userVerificationCode == $code && $password && $password == $repassword){
			$this->Users_model->update($id, ['userPassword' => md5($password),'userVerificationCode'=>md5(time())]);

			$this->session->set_flashdata('message', '<div class="alert alert-success">Password has been changed successfully, please <a href="'.base_url().'login" ><b><ul>click here</ul></b></a> to Login</div>');
			redirect(site_url('info'));
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid data provided.</div>');
			redirect(site_url("frontend/reset_password/?code={$code}&email={$email}"));
		}
	}
	public function register($value='')
	{
		$data['us_state']=$this->commonmodel->state_list;
		$this->load->view('new_frontend/register',$data);
	}
	public function register_action(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userFirstName', 'First name', 'trim|required');
		$this->form_validation->set_rules('userLastName', 'Last name', 'trim');
		$this->form_validation->set_rules('userEmail', 'Email', 'trim|required|valid_email|matches[reUserEmail]|is_unique[users.userEmail]',array('is_unique' => 'The email address you have entered is already Registered'));
		$this->form_validation->set_rules('reUserEmail', 'Confirm email', 'trim|valid_email|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('city', 'city', 'trim|required');
		$this->form_validation->set_rules('userPassword', 'password', 'trim|required|matches[reUserPassword]',array('matches' => 'Your password and confirm password do not match'));
		$this->form_validation->set_rules('reUserPassword', 'confirm password', 'trim|required');
		//$this->form_validation->set_rules('hereabout[0]', 'hereabout', 'trim|required',array('required' => 'You must check the box “How did you hear about us?"'));
		$secret = "6LeiygkUAAAAAFObKX5r_Glxhx2EIGmoevlM8RD4";
		$response = null;
		$reCaptcha = new ReCaptcha($secret);

		// if submitted check response
		if ($_POST["g-recaptcha-response"]) {
			$response = $reCaptcha->verifyResponse(
				$_SERVER["REMOTE_ADDR"],
				$_POST["g-recaptcha-response"]
				);
		}
		if($response!=null){
			$captchValidation=json_decode($response->success);
		}else{
			$captchValidation=0;
		}
		if($captchValidation !=  1){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please Verify Captcha</div>');
			redirect(site_url('register'));
		}elseif ($this->form_validation->run() == FALSE) {
			$this->register();
		} else {
			$hereabout = implode(",", $this->input->post('hereabout', TRUE));
			$code = md5(time());
			$email = $this->input->post('userEmail', TRUE);
			$data = array(
				'userFirstName' => $this->input->post('userFirstName', TRUE),
				'userLastName' => $this->input->post('userLastName', TRUE),
				'userEmail' => $email,
				'userPassword' => md5($this->input->post('userPassword', TRUE)),
				'phone'=>$this->input->post('phone', TRUE),
				'state'=>$this->input->post('state', TRUE),
				'city'=>$this->input->post('city', TRUE),
				'hereabout'=>$hereabout,
				'userStatus' => 0,
				'userVerificationCode' => $code,
				'userCreationDate' => date('Y-m-d H:i:s')
				);

			$this->Users_model->insert($data);
			$this->load->helper('send_mail');
			$subject="Please Verify Account";	
			$data1['code']=$code;
			$data1['email']=$email;
			_sendMail($email, $subject, $this->load->view('emails/registration_confirmation',$data1, TRUE));
			$this->session->set_flashdata('message', '<div class="alert alert-success">Your Account has been Created Successfully, please check your Email for verification</div>');
			redirect(site_url('info'));
		}
	}
	public function get_cities(){
		//get search term
		$data=array();
		$searchTerm = $_GET['term'];
		$stateCode = trim($_GET['state']);
		//get matched data from skills table
		$query_row = $this->commonmodel->getMultipleRecords("SELECT emailId,state,City FROM campaign_emails WHERE state='".$stateCode."' AND City LIKE '%".$searchTerm."%' group by City ORDER BY City ASC LIMIT 20");
		if(!empty($query_row)){
			foreach($query_row as $row){
				$data[]=$row['City'];
			}
		}
		echo json_encode($data);
	}
	public function verification(){
		$code = "";
		if(isset($_GET['code']) && $_GET['email']){
			$code = $_GET['code'];
			$email = $_GET['email'];

			$result = $this->Users_model->get_by_email($email);
			if($result->userEmail){
				$this->Users_model->update($result->userId ,['userStatus'=> 1]);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Your account has been verified, please <a href="'.base_url().'login" ><b style="text-decoration: underline;">click here</b></a> to Login.</div>');
				redirect(site_url('info'));

			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-success">Invalid or expired code.</div>');
				redirect(site_url('login?msg=invalidCode'));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Invalid Attempt.</div>');
			redirect(site_url('login?msg=invalidCodeNone'));
		}
	}
	public function subscribe($value='')
	{	
		$data = array(
			'subFirstName' => set_value('subFirstName'),
			'subLastName' => set_value('subLastName'),
			'subEmail' => set_value('subEmail'),
			'resubEmail' => set_value('resubEmail'),
			'state' => set_value('subCountry'),
			'subStatus' => set_value('subStatus'),
			'county' => set_value('county')
			
			);
		
		$data['counties']=$this->commonmodel->getMultipleRecords("SELECT * FROM cities_extended WHERE state_code='".$data['state']."' GROUP BY `county`");
		$data['us_state']=$this->commonmodel->state_list;
		$this->load->view('new_frontend/subscribe',$data);
	}
	public function subscribe_action(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('subFirstName', 'Subscriber first name', 'trim|required');
		$this->form_validation->set_rules('subLastName', 'Subscriber last name', 'trim');
		$this->form_validation->set_rules('subEmail', 'email', 'trim|required|valid_email|matches[resubEmail]');
		$this->form_validation->set_rules('resubEmail', 'confirm email', 'trim|valid_email|required');
		$this->form_validation->set_rules('subCountry', 'State', 'trim|required');
		$this->form_validation->set_rules('county', 'county', 'trim|required');
		//$this->form_validation->set_rules('g-recaptcha-response', 'g-recaptcha-response', array('required' => 'Please Verify Captcha'));
		$this->form_validation->set_rules('subStatus', 'Subscription', 'trim|required',array('required' => 'You must check the box “I want to receive emails flyers in my county to continue."'));
		//$this->form_validation->set_message('subStatus', 'You must check the box “I want to receive emails flyers in my county to continue.');
		$secret = "6LeiygkUAAAAAFObKX5r_Glxhx2EIGmoevlM8RD4";
		$response = null;
		$reCaptcha = new ReCaptcha($secret);

		// if submitted check response
		if (isset($_POST["g-recaptcha-response"])) {
			$response = $reCaptcha->verifyResponse(
				$_SERVER["REMOTE_ADDR"],
				$_POST["g-recaptcha-response"]
				);
		}
		if($response!=null){
			$captchValidation=json_decode($response->success);
		}else{
			$captchValidation=0;
		}

		if ($this->form_validation->run() == FALSE ) {
			$this->subscribe();
			
		}elseif($captchValidation !=  1){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please Verify Captcha</div>');
			$this->subscribe();
		} else {
			$email = $this->input->post('subEmail', TRUE);
			
			$data = array(
				'subFirstName' => $this->input->post('subFirstName', TRUE),
				'subLastName' => $this->input->post('subLastName', TRUE),
				'subEmail' => $email,
				'subCountry'=> $this->input->post('subCountry', TRUE),
				'county'=>$this->input->post('county', TRUE),
				'subStatus' => $this->input->post('subStatus', TRUE),
				'subCreationDate' => date('Y-m-d H:i:s')
				);
			$result = $this->Subscriber_model->get_record($email);
			if($result){
				$this->Subscriber_model->update($result->subId,$data);
				$insert_id=$result->subId;
			}else{
				$insert_id=$this->Subscriber_model->insert($data);
				$Subs_history =array(
					'history_ip' => $_SERVER['REMOTE_ADDR'],
					'history_browser_info' => $_SERVER['HTTP_USER_AGENT'],
					'history_referer' => $_SERVER["HTTP_REFERER"],
					'history_date' => Date('Y-m-d H:i:s'),
					'subscriber_id' =>$insert_id
					);
				$this->Subscriber_model->insert_history($Subs_history);	
			}
			$subject = "XYZ Flyers Subscription";
			$code=$insert_id;
			$this->load->helper('send_mail');
			$data1['code']=$code;
			$data1['email']=$email;
			_sendMail($email, $subject, $this->load->view('emails/subscribe',$data1, TRUE));			
			$this->session->set_flashdata('message', '<div class="alert alert-success"><h2>Your Subscription request has been received</h2><strong>A confirmation email was sent to your inbox. <a href="'.base_url().'resend?code='.$code.'&email='.$email.'" id="resend_sub">Resend Confirmation</a></strong></div>');
			redirect(site_url('info'));
		}


	}
	
	public function sub_verification(){
		$code = "";
		if(isset($_GET['code']) && $_GET['email']){
			$code = $_GET['code'];
			$email = $_GET['email'];

			$result = $this->Subscriber_model->get_record($email);
			if($result->subEmail){
				$this->Subscriber_model->update($code ,['subStatus'=> 1]);
				$data = array(
					'Agency_Name' =>'',
					'First_Name' =>$result->subFirstName,
					'Last_Name' => $result->subLastName,
					'email_address' => $result->subEmail,
					'City' => '',
					'County'=>$result->county,
					'State' => $result->subCountry,
					'unsubscribed' => 0
					);
				$this->load->model('Email_management_model');
				$this->Email_management_model->insert_email($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Your Subscription has been verified.</div>');
				redirect(site_url('info'));

			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-success">Invalid or expired code.</div>');
				redirect(site_url('info'));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Invalid Attempt.</div>');
			redirect(site_url('info'));
		}
	}
	
	public function email_unsub() // sepcial unsub form from email footers i.e. bulk emails
	{
		// route unsubscribe_me
		if(!$this->session->user_data)
		{
			$this->load->view('new_frontend/special_unsubscribe');
		}
		else { redirect(site_url('email-settings')); }
	}

	public function semail_unsub(){ // sepcial usnubscribe for footer emails 
	// route unsubscribe_me_response
		if($this->input->post('email')){
			$email = $this->input->post('email');   	
			if($this->commonmodel->semail_unsub($email))
			{
				$this->session->set_flashdata('message1', '<div class="alert alert-success">You have been successfuly unsubscribed from our mailing list!</div>');
				redirect(site_url('unsubscribe_me'));	
			}

		}else{
			$this->session->set_flashdata('message1', '<div class="alert alert-warning">Please enter your email you want to unsubscribe.</div>');
			redirect(site_url('unsubscribe_me'));
		}
	}

	public function unsub(){
		if(isset($_GET['email'])){
			$email = $_GET['email'];
			$result = $this->Subscriber_model->get_record($email);
			if($result){
				$code=$result->subId;
				$subject = "XYZ Flyers UnSubscription Verification";
				$this->load->helper('send_mail');				
				$data1['code']=$code;
				$data1['email']=$email;
				_sendMail($email, $subject, $this->load->view('emails/unsubscribe',$data1, TRUE));
				$this->session->set_flashdata('message', '<div class="alert alert-success"><h2>Your UnSubscription request has been received</h2><strong>A confirmation email was sent to your inbox please verify if you want to unsubscribe. <a href="'.base_url().'newdesign/unsub?code='.$code.'&email='.$email.'" id="resend_sub">Resend Confirmation</a></strong></div>');
				redirect(site_url('info'));
				
				
			}else{
				$this->session->set_flashdata('message1', '<div class="alert alert-danger">Please enter valid email you want to unsubscribe.</div>');
				redirect(site_url('subscribe'));
			}

		}else{
			$this->session->set_flashdata('message1', '<div class="alert alert-danger">Please enter your email you want to unsubscribe.</div>');
			redirect(site_url('subscribe'));
		}
	}
	
	public function unsub_verification(){
		$code = "";
		if(isset($_GET['code']) && $_GET['email']){
			$code = $_GET['code'];
			$email = $_GET['email'];

			$result = $this->Subscriber_model->get_record($email);
			if($result->subEmail){
				$this->Subscriber_model->update($result->subId ,['subStatus'=> 0]);
				$data = ['email' => $email];
				$this->load->view('new_frontend/unsubscribe', $data, FALSE);
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-success">Invalid or expired code.</div>');
				redirect(site_url('info'));
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Invalid Attempt.</div>');
			redirect(site_url('info'));
		}
	}



	public function pdf_image($image_name)
	{
        //print_r($size);exit;
		/*$width=595;
		$height=842;*/
		$width=2525;
		$height=3375;
		// $size = getimagesize(dirname(dirname(dirname(__FILE__))).'/public/upload/user_flyer_store/'.$image_name);
		/*if($size)
		{
            //$width=$size[0];
            //$height=$size[1];
		}
		$this->load->library('Pdf');
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(0.3, 0.3, 0.3);//PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
        $pdf->SetHeaderMargin(0);//PDF_MARGIN_HEADER
        $pdf->SetFooterMargin(0);//PDF_MARGIN_FOOTER
        $pdf->SetAutoPageBreak(TRUE, 0);//PDF_MARGIN_BOTTOM
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        	require_once(dirname(__FILE__).'/lang/eng.php');
        	$pdf->setLanguageArray($l);
        }
        // add a page
        $pdf->AddPage();
        $pdf->setJPEGQuality(75);
        $pdf->Image(dirname(dirname(dirname(__FILE__))).'/public/upload/user_flyer_store/'.$image_name, '', '', $width, $height, 'JPG', '', '', false, 150, '', false, false, 1, false, false, false);
        $filename = (dirname(dirname(dirname(__FILE__))).'/public/outputpdfs/'. pathinfo($image_name,PATHINFO_FILENAME).'.pdf');
        $pdf->Output($filename, 'F');

        $this->load->helper('download');
        force_download($filename, NULL);*/
        
        $im = new Imagick();
		$im->setResolution(300, 300);
		$im->readimage('./public/upload/user_flyer_store/'.$image_name); 
		/*if($im->getImageWidth()==650)
			$im->scaleImage(2625, 3375);
		    else $im->scaleImage(2550, 3300);*/
		$im->scaleImage(2550, 3300);
		$im->setImageFormat('pdf');    

		$im->writeImage('./public/outputpdfs/'. pathinfo($image_name,PATHINFO_FILENAME).'.pdf'); 
		header('Content-Type: application/pdf');// if generating pdf from jpg and forcing download
		echo $im;
		$im->clear(); 
		$im->destroy();
    }

    public function pdf_image_with_overlay($image_name)
    {
        
		$width=2525;
		$height=3375;
		

        $im = new Imagick();
        $im->setResolution(300, 300);
        $im->readimage('./public/upload/user_flyer_store/'.$image_name); 
		/*if($im->getImageWidth()==650) 
			$im->scaleImage(2625, 3375);
			else $im->scaleImage(2550, 3300);*/
			$text = "PROOF";
			$draw = new ImagickDraw();
			/* Black text */
			$draw->setFillColor('black');

			/* Font properties */
			// $draw->setFont('Arial');
			$draw->setFontSize( 70 );
			/* Create text */
			$im->setImageOpacity(0.9);
			$im->annotateImage($draw, ((($im->getImageWidth()/100)*50)-($im->getImageWidth()/100)*25), (($im->getImageHeight()/100)*50), 0, $text);
      // Print Text On Image

			// $im->scaleImage(2550, 3300);
			$im->setImageFormat('pdf');    

			$im->writeImage('./public/outputpdfs/'. pathinfo($image_name,PATHINFO_FILENAME).'.pdf'); 
		header('Content-Type: application/pdf');// if generating pdf from jpg and forcing download
		echo $im;
		$im->clear(); 
		$im->destroy();
	}

    public function base64_to_pdf($sting)
	{
		$width=2525;
		$height=3375;
        $im = new Imagick();
		$im->setResolution(300, 300);
		$im->readimageblob(base64_decode($string));
		// $im->readimage('./public/upload/user_flyer_store/'.$image_name); 
		$im->scaleImage(2550, 3300);
		$im->setImageFormat('pdf');    

		// $im->writeImage('./public/outputpdfs/'. pathinfo($image_name,PATHINFO_FILENAME).'.pdf'); 
		header('Content-Type: application/pdf');// if generating pdf from jpg and forcing download
		echo $im;
		$im->clear(); 
		$im->destroy();
    }

    public function pdf()
    {
        //require_once (dirname(dirname(dirname(dirname(__FILE__)))).'/public/tcpdf/tcpdf.php');
    	$this->load->library('Pdf');
        /*$jsonData = $_POST['jsonData'];
        $cwidth = $_POST['cwidth'];
        $cheight = $_POST['cheight'];
        $rows = $_POST['rows'];
        $cols = $_POST['cols'];
        $savecrop = $_POST['savecrop'];*/

        //enable above and comment below for dynamic content to load;

        $jsonData='["<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\" ?>\n<!DOCTYPE svg PUBLIC \"-//W3C//DTD SVG 1.1//EN\" \"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\">\n<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\" width=\"480\" height=\"672\" style=\"background-color: #ffffff\" viewBox=\"0 0 480 672\" xml:space=\"preserve\">\n<desc>Created with Fabric.js 1.6.0-rc.1</desc>\n<defs></defs>\n<g transform=\"translate(288 864)\">\n<image xlink:href=\"http://192.241.203.65/public/uploads/eggshell.jpg\" x=\"-288\" y=\"-288\" style=\"stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;\" width=\"576\" height=\"576\" preserveAspectRatio=\"none\"></image>\n</g>\n<g transform=\"translate(288 288)\">\n<image xlink:href=\"http://192.241.203.65/public/uploads/eggshell.jpg\" x=\"-288\" y=\"-288\" style=\"stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;\" width=\"576\" height=\"576\" preserveAspectRatio=\"none\"></image>\n</g>\n\t<g transform=\"translate(240 336)\">\n\t\t<text font-family=\"Tinos\" font-size=\"46.800000000000004\" font-weight=\"normal\" style=\"stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: Black; fill-rule: nonzero; opacity: 1;\" >\n\t\t\t<tspan x=\"-128\" y=\"14.74\" fill=\"Black\">Heading Text</tspan>\n\t\t</text>\n\t</g>\n<g style=\"stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;\" transform=\"translate(24.439999999999998 120.44)\" >\n\t<path d=\"M 398.355 0 H 31.782 C 14.229 0 0.002 13.793 0.002 30.817 v 368.471 c 0 17.025 14.232 30.83 31.78 30.83 h 366.573 c 17.549 0 31.76 -13.814 31.76 -30.83 V 30.817 C 430.115 13.798 415.904 0 398.355 0 z M 130.4 360.038 H 65.413 V 165.845 H 130.4 V 360.038 z M 97.913 139.315 h -0.437 c -21.793 0 -35.92 -14.904 -35.92 -33.563 c 0 -19.035 14.542 -33.535 36.767 -33.535 c 22.227 0 35.899 14.496 36.331 33.535 C 134.654 124.415 120.555 139.315 97.913 139.315 z M 364.659 360.038 h -64.966 V 256.138 c 0 -26.107 -9.413 -43.921 -32.907 -43.921 c -17.973 0 -28.642 12.018 -33.327 23.621 c -1.736 4.144 -2.166 9.94 -2.166 15.728 v 108.468 h -64.954 c 0 0 0.85 -175.979 0 -194.192 h 64.964 v 27.531 c 8.624 -13.229 24.035 -32.1 58.534 -32.1 c 42.76 0 74.822 27.739 74.822 87.414 V 360.038 z M 230.883 193.99 c 0.111 -0.182 0.266 -0.401 0.42 -0.614 v 0.614 H 230.883 z\" style=\"stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;\" transform=\" matrix(1 0 0 1 0 0) \" stroke-linecap=\"round\" />\n</g>\n</svg>"]';
        //$jsonData=file_get_contents('dirname(dirname(dirname(__FILE__))).'/public/upload/flyer_images/fb446359e56a112b6f010187852d548c.jpg');
        $cwidth = 480;
        $cheight = 672;
        $rows = 1;
        $cols = 1;
        $savecrop = false;
        $POSTfilename = "22201720947.pdf";

        $rc = $rows * $cols;
        $jsonData = json_decode($jsonData);
        $scalef = 72/96;
        $cmp = 0;
        if($savecrop != 'false') {
        	$cmp = 10;
        }
        //$pdf = new TCPDF('', 'px', array($cwidth * $scalef * $cols + $cmp*2, $cheight * $scalef * $rows + $cmp*2), true, 'UTF-8', false, false);
        $pdf = new Pdf('', 'px', array($cwidth * $scalef * $cols + $cmp*2, $cheight * $scalef * $rows + $cmp*2), true, 'UTF-8', false, false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        $pdf->SetLeftMargin(0);
        $pdf->SetRightMargin(0);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->setCellMargins(0,0,0,0);
        $pdf->SetCellPaddings(0,0,0,0);
        $pdf->SetAutoPageBreak(false);
        $pdf->SetDisplayMode(100);
        $totalcanvas = count($jsonData);
        $offsetwidth = $cwidth * $scalef;
        $offsetheight = $cheight * $scalef;
        for ($x = 0; $x < $totalcanvas; $x += $rc) {
        	$pdf->AddPage();
        	$pdf->StartTransform();
        	$colscount = 0;
        	$rowscount = 0;
        	for ($y = $x; $y < ($x+$rc); $y++) {
        		$dataString = $jsonData[$y];
        		$dataString = str_replace("design.youprintem.com",$_SERVER['HTTP_HOST'],$dataString);
        		if($colscount >= $cols) {
        			$colscount = 0;
        			$rowscount++;
        		}
        		$template_id = $pdf->startTemplate($offsetwidth*2, $offsetheight*2, true);
        		$pdf->StartTransform();
        		$pdf->Rect($offsetwidth, $offsetheight, $offsetwidth, $offsetheight, 'CNZ');
        		$decoded_xml = simplexml_load_string($dataString);
        		$fontNameArr = array();
        		foreach($decoded_xml[0] as $i=>$xmlList){
        			$fontFamilyArr = $xmlList->text;
        			$fontName = ($this->xml_attribute($fontFamilyArr,'font-family'));
        			if(!in_array($fontName, $fontNameArr)){
        				array_push($fontNameArr,$fontName);
        			}
        		}
        		foreach ($fontNameArr as $fontFamily){
        			if($fontFamily!='' && strlen($fontFamily)>0){
        				$folderName = str_replace(" ","_", $fontFamily);
        				$fontFileName = str_replace(" ","", $fontFamily);
        				$fontpath = dirname(dirname(dirname(__FILE__)))."/tcpdf/fonts/googlefonts/".$folderName."/".$fontFileName."-Regular.ttf";
        				$fontname = TCPDF_FONTS::addTTFfont($fontpath,'TrueTypeUnicode', '', 96);
        				$pdf->SetFont($fontname, '', 14, '', false);
        			}
        		}
        		$pdf->setXY($offsetwidth, $offsetheight);
        		$pdf->ScaleXY($scalef * 100);
        		$pdf->ImageSVG('@'.$dataString);
        		$pdf->StopTransform();
        		$pdf->endTemplate();
        		$pdf->printTemplate($template_id, ($offsetwidth * $colscount) - $offsetwidth + $cmp, ($offsetheight * $rowscount) - $offsetheight + $cmp, $offsetwidth*2, $offsetheight*2, '', '', false);
        		if($savecrop != 'false') {
        			$pdf->cropMark(($offsetwidth * $colscount) + $cmp, ($offsetheight * $rowscount) + $cmp, $cmp, $cmp, 'TL', array(136,136,136));
        			$pdf->cropMark(($offsetwidth * $colscount) + $offsetwidth + $cmp, ($offsetheight * $rowscount) + $cmp, $cmp, $cmp, 'TR', array(136,136,136));
        			$pdf->cropMark(($offsetwidth * $colscount) + $cmp, ($offsetheight * $rowscount) + $offsetheight + $cmp, $cmp, $cmp, 'BL', array(136,136,136));
        			$pdf->cropMark(($offsetwidth * $colscount) + $offsetwidth + $cmp, ($offsetheight * $rowscount) + $offsetheight + $cmp, $cmp, $cmp, 'BR', array(136,136,136));
        		}
        		$colscount++;
        	}
        	$pdf->StopTransform();
        }
        $pdf->Close();
        //$filename = url('') . "/outputpdfs/" . $_POST['filename'];
            //echo dirname(dirname(dirname(__FILE__))).'/public/outputpdfs/';
        $filename = (dirname(dirname(dirname(__FILE__))).'/public/outputpdfs/'). $POSTfilename;
        $pdf->Output($filename, 'F');
        //echo $filename;

        $this->load->helper('download');
        force_download($filename, NULL);
    }
    public function Hex2RGB($color){
    	$color = str_replace('#', '', $color);
    	if (strlen($color) != 6){
    		return array(0,0,0);
    	}
    	$rgb = array();
    	for ($x=0;$x<3;$x++){
    		$rgb[$x] = hexdec(substr($color,(2*$x),2));
    	}
    	return $rgb;
    }

    public function xml_attribute($object, $attribute)
    {
    	if(isset($object[$attribute]))
    		return (string) $object[$attribute];
    }



    public function how_it_works($value='')
    {
    	$this->load->view('new_frontend/how_it_works');
    }

    public function pricing($value='')
    {
    	$data['us_state_agents']="";
		/*$result=$this->commonmodel->state_list;
		if(is_array($result)){
			$res=array();
			foreach($result as $key => $state){
				$res[]=$this->commonmodel->getSingleRecord("SELECT  '".$key."' as code,count(email_address) as agt from campaign_emails where state='".$key."'");
			}
			$data['us_state_agents']=$res;
		}*/
		$data['overall_emails'] = $this->commonmodel->getSingleRecord("SELECT count(email_address) as overallEmails from campaign_emails");
		$data['us_state_agents']= $this->commonmodel->getMultipleRecords("SELECT state as code, count(email_address) as agt from campaign_emails group by(state)");
		/*echo '<pre>';
		print_r($data['us_state_agents']);
		exit;*/
		$this->load->view('new_frontend/pricing',$data);
	}
	// get counties by state
	public function counties_by_state(){
		if($_POST['state']){
			$state=$this->input->post("state");
			$data=$this->commonmodel->getMultipleRecords("SELECT GROUP_CONCAT(DISTINCT ce.County  ORDER BY ce.County ASC SEPARATOR '/') County,count(email_address) as total_email
				FROM campaign_emails ce
				WHERE  ce.state='".$state."' AND ce.County <> '' AND ce.County <> 'NULL' 
				GROUP BY ce.state");
			echo json_encode($data);
		}
	}

	public function counties_data_by_state()
	{
		$state = $this->input->post('st');
		echo json_encode( $this->commonmodel->getMultipleRecords("SELECT County as name, CountyFIPS as fips, count(email_address) as agnts from campaign_emails where state='$state'  group by(CountyFIPS) HAVING `County` <> '' ORDER BY `County` ASC"));
	}

	function get_cities_by_state()
	{
		$state = $this->input->post('st');
		$fips = $this->input->post('fips');
		echo json_encode( $this->commonmodel->getMultipleRecords("SELECT DISTINCT City as name from campaign_emails where state='$state' and CountyFIPS = '$fips' group by(City)"));
	}

	public function blog($value='')
	{
		$this->load->view('new_frontend/blog');
	}

	public function aboutus($value='')
	{
		$this->load->view('new_frontend/aboutus');
	}

	public function ordernow($value='')
	{
		$this->load->view('new_frontend/ordernow');
	}

	public function contactus($value='')
	{
		$this->load->view('new_frontend/contactus');
	}
	public function faqs(){
		$this->load->view('new_frontend/faqs');
	}
	public function contactus_action(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('message', 'message', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->contactus();
		} else {

			$query = $this->db->query("select * from tbl_settings where mykey = 'frontend_contactus_email'");
			$frontend_contactus_email = $query->row();
			$query1 = $this->db->query("select * from tbl_settings where mykey = 'frontend_contactus_email_footer'");
			$frontend_contactus_email_footer = $query1->row();
		      /*print_r($frontend_contactus_email_footer);
		      echo "<pre>";
		      print_r($frontend_contactus_email);*/
		      $frontend_email='peham@pakipreneurs.com';
		      if($frontend_contactus_email)
		      {
		      	$frontend_email = $frontend_contactus_email->Value;
		      }

		      $frontend_contactus_email_footer='footer.php';
		      if($frontend_contactus_email_footer)
		      {
		      	//$frontend_email_footer = $frontend_contactus_email_footer->Value;
		      }

		      $name = $this->input->post('name', TRUE);
		      $email = $this->input->post('email', TRUE);
		      $subject = "Contact Request from XYZFlyers.com";
		      $mailer_sub = $this->input->post('subject', TRUE);
		      $message = $this->input->post('message', TRUE);

		      $this->load->helper('send_mail');
		      $html = "<p>{$mailer_sub}</p><p>{$message}</p><p>Sender Name:{$name}<br/>Email:{$email}</p>";
		      $data['html']=$html;
		      _sendMail($frontend_email, $subject, $this->load->view('emails/contactus_email',$data, TRUE));

		      $this->session->set_flashdata('message', '<div class="alert alert-success">Your email has been sent Successfully.</div>');
		      redirect(site_url('contact-us'));
		  }
		}
		public function info(){
			$data['info_page_flyer']=$this->commonmodel->getMultipleRecords("SELECT * FROM tbl_flyer_detail WHERE flyer_status='Published' order by rand() limit 5");
		/*echo "<pre>";
		print_r($data['info_page_flyer']);
		exit;*/
		$this->load->view('new_frontend/info',$data);
	}


	public function get_flyer_properties($flyer_id = null)
	{
		$this->load->model('admin/flyersmodel');
		if(!$flyer_id) {$flyer_id = $this->input->post('flyer_id');}

		$res = $this->flyersmodel->get_flyer_properties($flyer_id);
		echo @$res[0]->flyer_text_properties;
	}

	public function get_flyer_colorsets()
	{
		$this->load->model('admin/flyersmodel');
		if($this->input->post('flyerId')){
			$flyer = $this->flyersmodel->get_flyer_by_id($this->input->post('flyerId'));
		// print_r($flyer); 
			echo $flyer->flyer_color_sets;
		}
		else echo 'bad request!';
	}
	public function resend_subscription()
	{
		if($this->input->get('email')){
			$email=$this->input->get('email');
			$code=$this->input->get('code');
			$result=$this->Subscriber_model->get_record($email);

			$data = array(
				'subFirstName' => $result->subFirstName,
				'subLastName' =>$result->subLastName,
				'subEmail' => $result->subEmail,
				'subCountry'=> $result->subCountry,
				'subStatus' =>$result->subStatus,
				'subCreationDate' => date('Y-m-d H:i:s')
				);

			$subject = "XYZ Flyers Subscription";

			$this->load->helper('send_mail');
			$data1['code']=$code;
			$data1['email']=$email;
			_sendMail($email, $subject, $this->load->view('emails/subscribe',$data1, TRUE));		

				//$this->Subscriber_model->insert($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success"><h2>Your Subscription request has been received</h2><strong>A confirmation email was sent to your inbox.<a href="'.base_url().'resend?email='.$email.'" id="resend_sub">Resend Confirmation</a></strong></div>');
			redirect(site_url('info'));
		}
		else echo 'bad request!';
	}
	public function email_stats(){

		if($this->input->post('date_from')){
			$dateFrom = date('Y-m-d',strtotime($this->input->post('date_from')));
		}else{
			$dateFrom = "2016-08-07";
		}
		if($this->input->post('date_to')){
			$dateTo = date('Y-m-d',strtotime($this->input->post('date_to')));
		}else{
			$dateTo = date('Y-m-d');
		}
		$key = "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";
		$sg = new \SendGrid($key);
    // "country": "US",
		$query_params = json_decode('{  "start_date": "'.$dateFrom.'", "end_date": "'.$dateTo.'" , "aggregated_by": "month"}');
// $response = $sg->client->geo()->stats()->get(null, $query_params);
		$response = $sg->client->stats()->get(null, $query_params);
// echo $response->statusCode();
		$body =  $response->body();
		$body = json_decode($body, true);
		$sent = 0;
		$bounces = 0;
		$optOut = 0;
		$blocks = 0;
		$bounce_drops = 0;
		$clicks = 0;
		$deferred = 0;
		$delivered  = 0;
		$invalid_emails = 0;
		$opens = 0;
		$requests = 0;
		$spam_report_drops = 0;
		$spam_reports = 0;
		$unique_clicks = 0;
		$unique_opens = 0;
		$unsubscribe_drops = 0;
		foreach ($body as $b) {
			$arr = $b['stats'][0]['metrics'];
			$sent += $arr['processed'];
			$bounces += $arr['bounces'];
			$optOut += $arr['unsubscribes'];
			$blocks += $arr['blocks'];
			$bounce_drops += $arr['bounce_drops'];
			$clicks += $arr['clicks'];
			$deferred += $arr['deferred'];
			$delivered += $arr['delivered'];
			$invalid_emails += $arr['invalid_emails'];
			$opens += $arr['opens'];
			$requests += $arr['requests'];
			$spam_report_drops += $arr['spam_report_drops'];
			$spam_reports += $arr['spam_reports'];
			$unique_clicks += $arr['unique_clicks'];
			$unsubscribe_drops += $arr['unsubscribe_drops'];
		}

		return $delivered;
	}

	public function account_settings($form = null){
		if(!$this->session->user_data)redirect(site_url('login'));
		$id=$this->session->userdata('user_data')['pk_user_id'];
		$row = $this->Users_model->get_by_id($id);
		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('users/update_action'),
				'userId' => set_value('userId', $row->userId),
				'username' => set_value('username', $row->username),
				'userFirstName' => set_value('userFirstName', $row->userFirstName),
				'userLastName' => set_value('userLastName', $row->userLastName),
				'userEmail' => set_value('userEmail', $row->userEmail),
				'userCity' => set_value('userCity', $row->city),
				'state' => set_value('state', $row->state),
				'userPhone' => set_value('userPhone', $row->phone),

				);
		}
		$data[$form]= validation_errors_array();
		$data['us_state']=$this->commonmodel->state_list;
		$this->load->view('new_frontend/account_settings',$data);
		

	}

	public function change_password($form = null){
		if(!$this->session->user_data)redirect(site_url('login'));
		$id=$this->session->userdata('user_data')['pk_user_id'];
		$row = $this->Users_model->get_by_id($id);
		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('users/update_action'),
				'userId' => set_value('userId', $row->userId),
				'username' => set_value('username', $row->username),
				'userFirstName' => set_value('userFirstName', $row->userFirstName),
				'userLastName' => set_value('userLastName', $row->userLastName),
				'userEmail' => set_value('userEmail', $row->userEmail),
				'userCity' => set_value('userCity', $row->city),
				'state' => set_value('state', $row->state),
				'userPhone' => set_value('userPhone', $row->phone),

				);
		}
		$data[$form]= validation_errors_array();
		$data['us_state']=$this->commonmodel->state_list;
		$this->load->view('new_frontend/change-password',$data);
		

	}

	public function confirm_password()
	{
		if($this->commonmodel->confirm_password($this->input->post('pass'))) 
		{
				//SEND CONFIRMATION EMAIL FOR SETTINGS
			$setting_name = $this->input->post('setting_name');
			$change = $this->input->post('change');
				// if($change) $change = 1; else $change = 0;
			$this->commonmodel->send_settings_change_confirmation_email($change, $setting_name);

			echo 'true';
		}
		else echo 'false';
	}
	
	public function settings_action(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userFirstName', 'First name', 'trim|required');
		$this->form_validation->set_rules('userLastName', 'Last name', 'trim|required');
		$this->form_validation->set_rules('userEmail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('userPassword', 'password', 'trim');
		
		$secret = "6LeiygkUAAAAAFObKX5r_Glxhx2EIGmoevlM8RD4";
		$response = null;
		$reCaptcha = new ReCaptcha($secret);

		// if submitted check response
		if ($_POST["g-recaptcha-response"]) {
			$response = $reCaptcha->verifyResponse(
				$_SERVER["REMOTE_ADDR"],
				$_POST["g-recaptcha-response"]
				);
		}
		if($response!=null){
			$captchValidation=json_decode($response->success);
		}else{
			$captchValidation=0;
		}
		if($captchValidation !=  1){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Please Verify Captcha</div>');
			redirect(site_url('account'));
		}elseif ($this->form_validation->run() == FALSE) {
			$data="formerror1";
			$this->account_settings($data);
		} else {   		
			$data = array(

				'userFirstName' => $this->input->post('userFirstName',TRUE),
				'userLastName' => $this->input->post('userLastName',TRUE),
				'userEmail' => $this->input->post('userEmail',TRUE),
				'city' => $this->input->post('city',TRUE),
				'phone'=>$this->input->post('phone', TRUE),
				'state'=>$this->input->post('state', TRUE),

				);
			$pass = $this->input->post('userPassword');
			if($pass){
				$pass = md5($pass);
				$data['userPassword'] = $pass;
			}
			$this->Users_model->update($this->input->post('userId', TRUE), $data);
			$this->session->set_flashdata('message', '<span class="alert-success">Your account info has been changed Successfully</span>');
			log_queries('user', 1, 'users', $this->input->post('username',TRUE));
			redirect(site_url('info'));
		}
	}

	public function email_settings(){
		if(!$this->session->user_data)redirect(site_url('login'));
		$settings['settings'] = $this->commonmodel->get_user_email_settings($this->session->user_data['pk_user_id']);
	/*	echo "<pre>";
		print_r($settings);
		echo "</pre>";
		exit;*/
		// if(count($settings)<1) $settings = array('es_newsletter_emails'=>1, 'es_order_emails'=>1, 'es_billing_emails'=>1, 'es_statistic_emails'=>1, 'es_promotion_emails'=>1, 'es_notification_emails'=>1);
		$this->load->view('new_frontend/email-settings', $settings);
	}

	public function email_settings_confirm($change, $setting_name, $code){
		if($setting_name && $change && $code)
		{

			$data['result'] = $this->commonmodel->email_settings_confirm($change, $setting_name, $code);
			// print_r($data['result']); exit;
			$data['setting_name'] = $setting_name;
			$data['code'] = $code;
			$data['change'] = $change;
			$this->load->view('new_frontend/email_settings_confirm', $data);
		}
		else{

		}
	}
	
	public function updatepassword(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userPassword', 'New Password', 'trim|required|matches[reUserPassword]');
		$this->form_validation->set_rules('reUserPassword', 'Confirm Password', 'trim|required');

		$this->form_validation->set_rules('olduserPassword', 'Old Password', 'trim|required');
		$secret = "6LeiygkUAAAAAFObKX5r_Glxhx2EIGmoevlM8RD4";
		$response = null;
		$reCaptcha = new ReCaptcha($secret);

		// if submitted check response
		if ($this->form_validation->run() == FALSE) {
			$data="formerror2";
			$this->change_password($data);
		} else {   		

			$email = $this->input->post('email', TRUE);
			$pass = md5($this->input->post('olduserPassword', TRUE));
			
			if($email && $pass ){
				$result = $this->Users_model->get_by_email($email, $pass);
				if(!empty($result->userFirstName)){
					$newpass= md5($this->input->post('userPassword', TRUE));
					$data = array(
						'userPassword' => $newpass
						);

					$this->Users_model->update($this->input->post('userId', TRUE), $data);
					$this->load->helper('query_log');
					log_user_activity('updated his/her password', $this->session->user_data['pk_user_id']);
					$this->commonmodel->send_email('password_changed', 'Account Password Updated');
					$this->session->set_flashdata('message', '<div class="alert alert-success">Your password has been changed successfully.</div>');
					$this->change_password();

				}
				else{
					$this->session->set_flashdata('message2', '<div class="alert alert-warning">Invalid Current Password.</div>');
					$this->change_password();
				}
			}else{
				$this->session->set_flashdata('message2', '<div class="alert alert-danger">Something wrong happened try again</div>');
				$this->change_password();
			}
		}	

	}
	
	public function counties(){
		$value=$this->input->post('state');
		$data=$this->commonmodel->getMultipleRecords("SELECT * FROM cities_extended WHERE state_code='".$value."' GROUP BY `county`");
		echo "<option value=''>Select County</option> " ;
		foreach($data as $county) {
			if(!empty($county ['county'])){

				echo "<option value='".$county ['county']."'>".$county ['county']."</option> " ;
			}
		}
	} 

	public function convert_pdf_to_jpg()
	{
		$im = new Imagick();

		$im->setResolution(480, 672);
		$im->readimage('./public/upload/flyers/test2.jpg'); 
		  /*$im->setResolution($width, $Height); not possible code
		  echo $width=$im->getImageWidth();
		  echo 'x'.$Height=$im->getImageHeight();*/
		      // $im->enhanceImage();
		$im->setImageFormat('pdf');    
		 // header('Content-Type: application/pdf');// if generating pdf from jpg

		$im->writeImage('./public/upload/flyers/test.pdf'); 
		$im->clear(); 
		$im->destroy();
	}
}
?>