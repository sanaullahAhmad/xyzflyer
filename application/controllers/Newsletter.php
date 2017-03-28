<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
require_once "recaptchalib.php";

class Newsletter extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('frontend/commonmodel'));
		$this->load->model('Subscriber_model');
	}

	public function index()
	{
		
	}
	
	public function newsletter_subscribe(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('newsletterEmail', 'email', 'trim|required|valid_email');
		
		if ($this->form_validation->run() == FALSE ) {
			redirect(site_url('alpha'));
		}else {
			$email = $this->input->post('newsletterEmail', TRUE);
			
			$data = array(
				'email' => $email,
				'verification_status'=> '0',
				'history_ip' => $_SERVER['REMOTE_ADDR'],
				'history_browser_info' => $_SERVER['HTTP_USER_AGENT'],
				'history_referer' => $_SERVER["HTTP_REFERER"],
				'history_date' => Date('Y-m-d H:i:s')
				);
				
			$result = $this->Subscriber_model->newsletter_record($email);
			//print_r($result->email);echo $result->email;exit;
			if($result){
				if($result->verification_status == 0 )
				{
					$subject = "XYZ Flyers Newsletter";
					$code=$result->id;

					$this->load->helper('send_mail');
					/*$html =  "<p>You have received this email message because you have recently submitted this email address to the XYZ Flyers Newsletter.</p>
								<p>However, your Subscription now requires that you receive this email and want to receive emails from XYZ Flyers.</p>			
								<p class='button'><a class='verify_button button-mobile' href='" . base_url() . "Newsletter/verification?code={$code}&email={$email}" ."'>Click Here to Verify your Subscription </a></p>
								<p>If you do not want to Subscribe, do nothing. You will automatically be removed.</p>
								<p>Thank you,</p>
								<p>XYZ Flyers Mailing List Management </p>
								<p><b style='text-align:center;'>We will not share your email address with anyone else.</p>
								<p>XYZ Flyers <a href='" . base_url() . "privace-policy'>Privacy Policy</a></p>"; 
								*/
					$data1['code']=$code;
					$data1['email']=$email;
				   _sendMail($email, $subject, $this->load->view('emails/newsletter_subscription_emails',$data1, TRUE));				
					$this->session->set_flashdata('message', '<div class="alert alert-success"><h2>Your Newsletter request has been received</h2><strong>A confirmation email was sent to your inbox.<a href="'.base_url().'Newsletter/resend?code='.$code.'&email='.$email.'" id="resend_sub">Resend Confirmation</a></strong></div>');
					redirect(site_url('info'));
					
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-success"><h2>Not required to subscribe again</h2></div>');
				 	redirect(site_url('info'));
				
				}
			}else{
				$insert_id=$this->Subscriber_model->insert_newsletter($data);
				$subject = "XYZ Flyers Newsletter";
				$code=$insert_id;
				$this->load->helper('send_mail');
				/*$html =  "<p>You have received this email message because you have recently submitted this email address to the XYZ Flyers Newsletter.</p>
									<p>However, your Subscription now requires that you receive this email and want to receive emails from XYZ Flyers.</p>			
									<p class='button'><a class='verify_button button-mobile' href='" . base_url() . "Newsletter/verification?code={$code}&email={$email}" ."'>Click Here to Verify your Subscription </a></p>
									<p>If you do not want to Subscribe, do nothing. You will automatically be removed.</p>
									<p>Thank you,</p>
									<p>XYZ Flyers Mailing List Management </p>
									<p><b style='text-align:center;'>We will not share your email address with anyone else.</p>
									<p>XYZ Flyers <a href='" . base_url() . "privace-policy'>Privacy Policy</a></p>";
				*/
				$data1['code']=$code;
				$data1['email']=$email;
				_sendMail($email, $subject, $this->load->view('emails/newsletter_subscription_emails',$data1, TRUE));	
				$this->session->set_flashdata('message', '<div class="alert alert-success"><h2>Your Newsletter request has been received</h2><strong>A confirmation email was sent to your inbox.<a href="'.base_url().'Newsletter/resend?code='.$code.'&email='.$email.'" id="resend_sub">Resend Confirmation</a></strong></div>');
				redirect(site_url('info'));
			}
			
			
		}


	}
	
	public function verification(){
		$code = "";
		if(isset($_GET['code']) && $_GET['email']){
			$code = $_GET['code'];
			$email = $_GET['email'];

			$result = $this->Subscriber_model->newsletter_record($email);
			if($result->email){
				$this->Subscriber_model->update_newsletter($code ,['verification_status'=> 1]);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Your Newsletter Subscription has been verified.</div>');
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
	
	public function resend()
	{
		if($this->input->get('email')){
			$email=$this->input->get('email');
			$code=$this->input->get('code');
			$result=$this->Subscriber_model->newsletter_record($email);
			if($result){
				$subject = "XYZ Flyers Newsletter";
				$this->load->helper('send_mail');
				/*$html =  "<p>You have received this email message because you have recently submitted this email address to the XYZ Flyers Newsletter.</p>
								<p>However, your Subscription now requires that you received this email and want to receive emails from XYZ Flyers.</p>			
								<p class='verify_button'><a class='button-mobile' href='" . base_url() . "Newsletter/verification?code={$code}&email={$email}" ."'>Click Here to Verify your Subscription </a></p>
								<p>If you do not want to Subscribe, do nothing. You will automatically be removed.</p>
								<p>Thank you,</p>
								<p>XYZ Flyers Mailing List Management </p>
								<p><b style='text-align:center;'>We will not share your email address with anyone else.</p>
								<p>XYZ Flyers <a href='" . base_url() . "privace-policy'>Privacy Policy</a></p>";
				*/
				$data1['code']=$code;
				$data1['email']=$email;
				_sendMail($email, $subject, $this->load->view('emails/newsletter_subscription_emails',$data, TRUE));	
					
					//$this->Subscriber_model->insert($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success"><h2>Your Subscription request has been received</h2><strong>A confirmation email was sent to your inbox.<a href="'.base_url().'resend?email='.$email.'" id="resend_sub">Resend Confirmation</a></strong></div>');
				redirect(site_url('info'));
			}
		}
				$this->session->set_flashdata('message', '<div class="alert alert-success"><h2>Bad Request</h2></div>');
				redirect(site_url('info'));
	}
	
	  public function unsub(){
    if(isset($_GET['email'])){
      $email = $_GET['email'];
      $result = $this->Subscriber_model->get_record($email);
			if($result->subEmail){
				 $code=$result->subId;
				 $subject = "XYZ Flyers UnSubscription Verification";
						$this->load->helper('send_mail');
						$html =  "<html><body>You have received this email message because you have recently submitted this email address to the XYZ Flyers Subscription page.<br><br>			
								<a href='" . base_url() . "unsubscribe/verification?code={$code}&email={$email}" ."'>Click Here to Verify </a> <br><br>
								If you do not want to UnSubscribe, do nothing. Your UnSubscription requrest will automatically be removed.<br><br>
								Thank you,<br>
								XYZ Flyers Mailing List Management <br><br>
								<b style='text-align:center;'>We will not share your email address with anyone else.</b><br>
								XYZ Flyers <a href='" . base_url() . "privace-policy'>Privacy Policy</a><br><br>
								<hr style='background-color: #D7DFE3; margin-top:1.5em;'><br>
								<a href='" . base_url() . "'>XYZ Flyers</a> (A 9533Designs Inc. Company) 20 S Santa Cruz Avenue, Suite 300, Los Gatos, CA 95030
								</body></html>";
						
						_sendMail($email, $subject, $html);
				$this->session->set_flashdata('message', '<div class="alert alert-success"><h2>Your UnSubscription request has been received</h2><strong>A confirmation email was sent to your inbox please verify if you want to unsubscribe.<a href="'.base_url().'newdesign/unsub?code='.$code.'&email='.$email.'" id="resend_sub">Resend Confirmation</a></strong></div>');
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
	
}

?>