<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Email_database extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('frontend/Commonmodel', 'cm');
		$this->load->model('Email_database_model');
    $this->load->library('breadcrumbs');
	}
	public function index() {
		$query = "select StateName as name,State, 'State' as type,count(email_address) as totalEmails from campaign_emails group by State";
		$query1 = "select count(email_address) as total from campaign_emails";
		$data['StateEmail'] = $this->cm->getMultipleRecords($query);
		$data['totals'] = $this->cm->getSingleRecord($query1);
		$this->breadcrumbs->push('Email Management', '/emailmanagement');
		$this->breadcrumbs->push('States List', '/email/index');
		$this->cm->adminloadLayout($data, 'admin/email_database_view/email_view');
	}
	public function county_state_wise($state = null) {
		
		$state = $this->uri->segment(2);
		$query = "select County as name,StateName,CountyFIPS as countyCode, 'County' as type,  count(email_address) as totalEmails from campaign_emails Where State='" . $state . "' group by CountyFIPS";
		$query1 = "select count(email_address) as total from campaign_emails";
		$data['StateEmail'] = $this->cm->getMultipleRecords($query);
		$data['totals'] = $this->cm->getSingleRecord($query1);
		//echo "<pre>";print_r($data['StateEmail']);exit;
		$this->breadcrumbs->push('Email Database', '/email');
		$this->breadcrumbs->push($data['StateEmail'][0]['StateName'].' Counties List', '/state/'.$data['StateEmail'][0]['StateName']);
		$this->cm->adminloadLayout($data, 'admin/email_database_view/email_view');
	}
	public function county_wise($state = null) {
		
		$County = $this->uri->segment(2);
		$query = " select State,County,City as name, 'City' as type,ZIPCode, count(email_address) as totalEmails FROM campaign_emails WHERE CountyFIPS='" . $County . "' GROUP BY City;";
		$query1 = "select count(email_address) as total from campaign_emails";
		$data['StateEmail'] = $this->cm->getMultipleRecords($query);
		$data['totals'] = $this->cm->getSingleRecord($query1);
		$this->breadcrumbs->push('Email Database', '/email/');
		$this->breadcrumbs->push('State', '/state/'.$data['StateEmail'][0]['State']);
		$this->breadcrumbs->push('Cities', '//');
		$this->cm->adminloadLayout($data, 'admin/email_database_view/email_view');
	}
  public function _get_users_by_state(){
    $res = $this->Email_database_model->get_state_users();
    $states = array_column($res, 'StateName');
    $emails = array_column($res, 'totalEmails');
    $map = array_combine($states, $emails);
    $res = null;
    $states = null;
    $emails = null;
    return $map;
  }
  public function get_state_lat_long(){
    $state_users = $this->_get_users_by_state();
    $file = fopen( FCPATH .  "public/state_latlon.csv","r");
    $mappings = [];
    while(! feof($file)){
      $arr = fgetcsv($file);
      $key = $arr[3];
      if(isset($state_users[$key])){
      $a = [$key => [
      'lat' => $arr[1],
      'long' => $arr[2],
      'users' => $state_users[$key]
      ]];
      $mappings = array_merge($mappings, $a);
      }
    }//endwhile
    fclose($file);
    echo json_encode($mappings);
  }
	/**
	 * $counties: a key value pair of county with quota
	 * $total: total no of emails that user selected
	 */
	public function send_bulk_email($counties=["06037" => 200, "40027" => 300], $total=500){
		$emails_list = $this->Email_database_model->get_random_mails($counties, $total );
	}
	public function test_send_bulk(){
		$bcc  = [
		"info@pakipreneurs.com",
		"hr@pakipreneurs.com",
		"team@pakipreneurs.com",
		"support@pakipreneurs.com",
		"jawad@pakipreneurs.com",
		"ali@pakipreneurs.com",
		"ali.waraich@pakipreneurs.com",
		"nousheen@pakipreneurs.com",
		"peham@pakipreneurs.com",
		"junaid@pakipreneurs.com",
		"smehsoud@pakipreneurs.com",
		"javed@pakipreneurs.com",
		"insia@pakipreneurs.com",
		"zain@pakipreneurs.com",
		"rizwan@pakipreneurs.com",
		"awaishanif@pakipreneurs.com"
		];
   $to = [
   "owaishanif786@yandex.com"
   ];
   $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
// This is your From email address
   $from = array('owaishanif786@gmail.com' => 'flyer-market');
 // Email recipients
		// $to = $mock_email_list;
 // Email subject
   $subject = 'view flyers';
 // Login credentials
   $username = 'owaishanif786';
   $password = 'bingo123';
 // Setup Swift mailer parameters
   $transport->setUsername($username);
   $transport->setPassword($password);
   $swift = Swift_Mailer::newInstance($transport);
 // Create a message (subject)
   $message = new Swift_Message($subject);
 // attach the body of the email
   $message->setFrom($from);
   $cid = $message->embed(Swift_Image::fromPath(base_url()."public/upload/flyer_images/flyer_Nousheen_2016-09-051.jpg"));
   $text = "Hi!\nHow are you?\n";
   $html = '
   <!doctype html>
   <html>
   <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>FLYER </title>
    <style>
    /* -------------------------------------
    GLOBAL RESETS
    ------------------------------------- */
    img {
    border: none;
    -ms-interpolation-mode: bicubic;
    max-width: 100%; }

    body {
    background-color: #f6f6f6;
    font-family: sans-serif;
    -webkit-font-smoothing: antialiased;
    font-size: 14px;
    line-height: 1.4;
    margin: 0;
    padding: 0;
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%; }

    table {
    border-collapse: separate;
    mso-table-lspace: 0pt;
    mso-table-rspace: 0pt;
    width: 100%; }
    table td {
    font-family: sans-serif;
    font-size: 14px;
    vertical-align: top; }

    /* -------------------------------------
    BODY & CONTAINER
    ------------------------------------- */

    .body {
    background-color: #f6f6f6;
    width: 100%; }

    /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
    .container {
    display: block;
    Margin: 0 auto !important;
    /* makes it centered */
    max-width: 580px;
    padding: 10px;
    width: auto !important;
    width: 580px; }

    /* This should also be a block element, so that it will fill 100% of the .container */
    .content {
    box-sizing: border-box;
    display: block;
    Margin: 0 auto;
    max-width: 580px;
    padding: 10px; }

    /* -------------------------------------
    HEADER, FOOTER, MAIN
    ------------------------------------- */
    .main {
    background: #fff;
    border-radius: 3px;
    width: 100%; }

    .wrapper {
    box-sizing: border-box;
    padding: 20px; }

    .footer {
    clear: both;
    padding-top: 10px;
    text-align: center;
    width: 100%; }
    .footer td,
    .footer p,
    .footer span,
    .footer a {
    color: #999999;
    font-size: 12px;
    text-align: center; }

    /* -------------------------------------
    TYPOGRAPHY
    ------------------------------------- */
    h1,
    h2,
    h3,
    h4 {
    color: #000000;
    font-family: sans-serif;
    font-weight: 400;
    line-height: 1.4;
    margin: 0;
    Margin-bottom: 30px; }

    h1 {
    font-size: 35px;
    font-weight: 300;
    text-align: center;
    text-transform: capitalize; }

    p,
    ul,
    ol {
    font-family: sans-serif;
    font-size: 14px;
    font-weight: normal;
    margin: 0;
    Margin-bottom: 15px; }
    p li,
    ul li,
    ol li {
    list-style-position: inside;
    margin-left: 5px; }

    a {
    color: #3498db;
    text-decoration: underline; }

    /* -------------------------------------
    BUTTONS
    ------------------------------------- */
    .btn {
    box-sizing: border-box;
    width: 100%; }
    .btn > tbody > tr > td {
    padding-bottom: 15px; }
    .btn table {
    width: auto; }
    .btn table td {
    background-color: #ffffff;
    border-radius: 5px;
    text-align: center; }
    .btn a {
    background-color: #ffffff;
    border: solid 1px #3498db;
    border-radius: 5px;
    box-sizing: border-box;
    color: #3498db;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: bold;
    margin: 0;
    padding: 12px 25px;
    text-decoration: none;
    text-transform: capitalize; }

    .btn-primary table td {
    background-color: #3498db; }

    .btn-primary a {
    background-color: #3498db;
    border-color: #3498db;
    color: #ffffff; }

  /* -------------------------------------
  OTHER STYLES THAT MIGHT BE USEFUL
  ------------------------------------- */
  .last {
    margin-bottom: 0; }
  .first {
  margin-top: 0; }
  .align-center {
  text-align: center; }
  .align-right {
  text-align: right; }
  .align-left {
  text-align: left; }
  .clear {
  clear: both; }
  .mt0 {
  margin-top: 0; }
  .mb0 {
  margin-bottom: 0; }
  .preheader {
  color: transparent;
  display: none;
  height: 0;
  max-height: 0;
  max-width: 0;
  opacity: 0;
  overflow: hidden;
  mso-hide: all;
  visibility: hidden;
  width: 0; }
  .powered-by a {
  text-decoration: none; }
  hr {
  border: 0;
  border-bottom: 1px solid #f6f6f6;
  Margin: 20px 0; }
  /* -------------------------------------
  RESPONSIVE AND MOBILE FRIENDLY STYLES
  ------------------------------------- */
  @media only screen and (max-width: 620px) {
  table[class=body] h1 {
  font-size: 28px !important;
  margin-bottom: 10px !important; }
  table[class=body] p,
  table[class=body] ul,
  table[class=body] ol,
  table[class=body] td,
  table[class=body] span,
  table[class=body] a {
  font-size: 16px !important; }
  table[class=body] .wrapper,
  table[class=body] .article {
  padding: 10px !important; }
  table[class=body] .content {
  padding: 0 !important; }
  table[class=body] .container {
  padding: 0 !important;
  width: 100% !important; }
  table[class=body] .main {
  border-left-width: 0 !important;
  border-radius: 0 !important;
  border-right-width: 0 !important; }
  table[class=body] .btn table {
  width: 100% !important; }
  table[class=body] .btn a {
  width: 100% !important; }
  table[class=body] .img-responsive {
  height: auto !important;
  max-width: 100% !important;
  width: auto !important; }
    }
  /* -------------------------------------
  PRESERVE THESE STYLES IN THE HEAD
  ------------------------------------- */
@media all {
  .ExternalClass {
    width: 100%; }
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
    line-height: 100%; }
    .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important; }
    .btn-primary table td:hover {
    background-color: #34495e !important; }
    .btn-primary a:hover {
    background-color: #34495e !important;
    border-color: #34495e !important; } 
    }

</style>
      </head>
      <body class="">
        <table border="0" cellpadding="0" cellspacing="0" class="body">
          <tr>
            <td>&nbsp;</td>
            <td class="container">
              <div class="content">
                <!-- START CENTERED WHITE CONTAINER -->
                <span class="preheader">Buy and sell property using Flyer</span>
                <table class="main">
                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                    <td class="wrapper">
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>
                            <p>Hi there,</p>
                            <p>Lets  buy property</p>
                            <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                              <tbody>
                                <tr>
                                  <td align="left">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                      <tbody>
                                        <tr>
                                          <td> <img class="img img-responsive" src="' . $cid . '" /> </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <p>I hope you will like it.</p>
                            <p>Good luck! </p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <!-- END MAIN CONTENT AREA -->
                </table>
                <!-- START FOOTER -->
                <div class="footer">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="content-block">
                        <span class="apple-link">FLYER INC &copy;</span>
                        <br> Don\'t like these emails? <a href="unsub">Unsubscribe</a>.
                        </td>
                    </tr>
                    <tr>
                      <td class="content-block powered-by">
                        Powered by <a href="' . site_url() . '">Flyer</a>.
                      </td>
                    </tr>
                  </table>
                </div>
                <!-- END FOOTER -->
                <!-- END CENTERED WHITE CONTAINER --></div>
              </td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </body>
        </html>';
      $message->setBody($html, 'text/html');
      $message->setTo($to);
      $message->setBcc($bcc);
      $message->addPart($text, 'text/plain');
     //$message->attach(Swift_Attachment::fromPath("/home/owaishanif/www/flyer/public/upload/flyer_images/resized_3ddd74ba11025e01b3fcc3546ebeb09c.jpg")->setFileName("flyer.jpg"));
// send message
      if ($recipients = $swift->send($message, $failures))
      {
// This will let us know how many users received this message
       echo 'Message sent out to '.$recipients.' users';
     }
// something went wrong =(
     else
     {
       echo "Something went wrong - ";
       print_r($failures);
     }
   }
   public function unsub(){
//@todo: get url from forwarded by sendgrid url and make sure it's valid unsubscribe
    if(isset($_GET['email'])){
      $email = $_GET['email'];
      $this->Email_database_model->update_by_email($email, ['unsubscribed' => 1]);
      $data = ['email' => $email];
      $this->load->view('new_frontend/unsubscribe', $data, FALSE);
    }else{
      echo "No such email for unsubscription";
    }
  }
 public function subscribe(){
//@todo: get token from url and make sure it's valid subscribe
    if(isset($_GET['email'])){
      $email = $_GET['email'];
      $email = urldecode($email);
////0 means he is subscribed
      $this->Email_database_model->update_by_email(  $email, ['unsubscribed' => 0]);
/////@todo: aslo remove this email from sendgrid database
      echo " Thanks. You are subscribed again.";
    }else{
      echo "No such email for subscription";
    }
  }
  public function ajax_get_all_data(){
    $result = $this->Email_database_model->get_all_active();
    echo json_encode($result);
    }
}