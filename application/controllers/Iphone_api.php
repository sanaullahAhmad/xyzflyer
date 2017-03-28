<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Iphone_api extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
        $this->load->model('Admins_model');
        $this->load->model('Mobile_model');
    }
    public function login(){
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $already;
        if($username && $password){
            $result = $this->Admins_model->get_by_username_pass($username, md5($password));
            if( $result && $result->admin_id  && strval($result->admin_type) === '0' && strval($result->admin_status) === '1'){
            	$flyerData=$this->commonmodel->getSingleRecord("SELECT count(*) as pending
                FROM tbl_orders
                WHERE   daorder_status=0");
                $token  = sha1(time());
                $already = $this->Mobile_model->get_by_admin_id($result->admin_id);
                if(!($already && $already->admin_id)){
                    $this->Mobile_model->insert(['admin_id' => $result->admin_id, 'token' => $token]);
                }
                echo json_encode([
                    "status" => "200",
                    "message" => "You are logged in." ,
                    "data" =>
                    [
                    //admin_id and token user must store and send at each request for validation
                    "admin_id" => $result->admin_id,
                    "token" => (!($already && $already->admin_id)?$token:$already->token),
                    "username" => $result->admin_username,
                    "admin_email" => $result->admin_email,
                    "pending_flyer"=>$flyerData->pending
                    ]
                    ]);
            }else{
                echo json_encode(["status" => "401", "message" => "Invalid username or password or not super-admin" ]);
            }
        }else{
            echo json_encode(["status" => "401", "message" => "No empty fields" ]);
        }
    }

    public function is_logged_in(){
        $admin_id = "";
        $token = "";
        $headers=getallheaders();
        if(isset($headers['Auth-Admin-Id']) && isset($headers['Auth-Token'])){
            $admin_id = $headers['Auth-Admin-Id'];
            $token = $headers['Auth-Token'];
        }
        $message = "";
        if($admin_id && $token){
            $admin_id = (int)$admin_id;
            $result = $this->Mobile_model->get_by_admin_id_and_token($admin_id, $token);
            if( $result && $result->id ){
                return [
                "status" => "200",
                "message" => "You are logged in."
                ];
            }else{
                $message = "Invalid admin_id or token";

            }
        }else{
            $message = "No admin_id and token in header.";
        }
        return [
        "status" => "401",
        "message" => $message
        ];
    }
    public function logout(){
        $admin_id = "";
        if($this->is_logged_in()["status"] === "200"){
            $headers  = getallheaders();
            $admin_id = isset($headers['Auth-Admin-Id']) ? $headers['Auth-Admin-Id'] : "";

            $this->Mobile_model->delete_by_admin_id($admin_id);
            echo json_encode([
                "status" => "200",
                "message" => "Logged Out",
                "data" => [
                "admin_id" => $admin_id
                ]]);
        }else{
            echo json_encode([
                "status" => "200",
                "message" => "No such account record or session",
                ]);
        }
    }
    /*
    * Get flyers by status code or list all flyers
    */
    public function flyerList(){
        if(isset($_POST['status'])){
            if($this->is_logged_in()["status"] === "200"){
                if($_POST['status']!= "" && $_POST['status']!=1234){
                $status=$this->input->post('status');
                $query="SELECT
                uf.uFlyerTitle as flyer_title,
                uf.flyer_created_image as thumb,
                ot.daorder_id as order_id,
                DATE_FORMAT(ot.daorder_date,'%m-%d-%Y') as order_date,
                DATE_FORMAT(ot.daorder_date,'%H%i') as order_time,
                DATE_FORMAT(ot.daorder_date,'%m-%d-%Y %H%i') as order_datetime,
                ot.daorder_status as status
                FROM user_flyers uf
                JOIN tbl_orders ot ON uf.uFlyerId=ot.daorder_flyer_id
                WHERE ot.daorder_status='".$status."'";
                $result=$this->commonmodel->getMultipleRecords($query);
                if($result){
                   echo json_encode(array(
                        "status" => "200",
                        "thumb_path"=>base_url('public/upload/user_flyer_store/_thumbs/thumb_'),
                        "message" => "Data fetch Successfully.",
                        "data" =>$result)
                    );
                    }else{
                        echo json_encode(array('status' => '404','message'=>'No data found.'));
                    }
                }else{
                 $query="SELECT
                 uf.uFlyerTitle as flyer_title,
                 uf.flyer_created_image as thumb,
                 ot.daorder_id as order_id,
                 DATE_FORMAT(ot.daorder_date,'%m-%d-%Y') as order_date,
                 DATE_FORMAT(ot.daorder_date,'%H%i') as order_time,
                 DATE_FORMAT(ot.daorder_date,'%m-%d-%Y %H%i') as order_datetime,
                 ot.daorder_status as status
                 FROM user_flyers uf
                 JOIN tbl_orders ot ON uf.uFlyerId=ot.daorder_flyer_id
                 ";
                 $result=$this->commonmodel->getMultipleRecords($query);
                 if($result){
                    echo json_encode(array(
                        "status" => "200",
                        "thumb_path"=>base_url('public/upload/user_flyer_store/_thumbs/thumb_'),
                        "message" => "Data fetch Successfully.",
                        "data" =>$result)
                    );
                }else{
                    echo json_encode(array('status' => '404','message'=>'No data found.'));
                }
            }
        }else{
            echo json_encode(array('status' => '401','message'=>'Invalid access'));
        }
    }
}
//Get the flyer info detail with send emails 
public function getFlyerDetail(){
     if(isset($_POST['order_id'])){
        $counties="abc(AK),bbc(AS),ccd(AK)";
        if($this->is_logged_in()["status"] === "200"){
            if(!empty($_POST['order_id'])){
                $orderId=$this->input->post('order_id');
                $query="SELECT
                usr.`userFirstName` as fname,
                usr.`userLastName` as lname,
                uf.uFlyerTitle as flyer_title,
                uf.flyer_created_image as image,
                uf.propertyAddress as property_address,
                uf.propertyMainHeader as property_main_header,
                uf.propertyHeadline as property_headline,
                uf.propertyPrice as property_price,
                uf.company1Info as company1,
                uf.company2Info as company2,
                uf.agent1ContactInfo as agent1_contact,
                uf.agent1License as agent1_license,
                uf.agent2ContactInfo as agent2_contact,
                uf. agent2License as agent1_license,
                ot.daorder_id as order_id,
                ot.daorder_user_id as order_user,
                count(otd.daorder_detail_id) as total_counties,
                'abc(AK)\,bbc(AS),\ccd(AK)' as counties,
                DATE_FORMAT(ot.daorder_date,'%m-%d-%Y') as create_date,
                DATE_FORMAT(ot.daorder_date,'%H%i') as created_time,
                DATE_FORMAT(ot.daorder_date,'%m-%d-%Y %H%i') as created_datetime,
                ot.daorder_grand_total as totalvalue,
                ot.daorder_total_emails as totalsend
                FROM `tbl_orders` as ot
                JOIN `user_flyers` as uf  ON ot.daorder_flyer_id=uf.uFlyerId
                JOIN `users` as usr  ON ot.daorder_user_id=usr.userId
                JOIN `tbl_order_details` as otd ON ot.daorder_id=otd.daorder_id
                WHERE ot.daorder_id='".$orderId."' GROUP BY otd.daorder_id";
            $result=$this->commonmodel->getMultipleRecords($query);
            if($result){
                echo json_encode(array(
                    "status" => "200",
                    "image_path"=>base_url('public/upload/user_flyer_store/'),
                    "thumb_path"=>base_url('public/upload/user_flyer_store/_thumbs/thumb_'),
                    "message" => "Data fetch Successfully.",
                    "data" =>$result)
                );
            }else{
                echo json_encode(array('status' => '404','message'=>'No data found.'));
            }
        }else{
            echo json_encode(array('status' => '404','message'=>'No order found.'));
        }
    }else{
            echo json_encode(array('status' => '401','message'=>'Invalid access'));
        }
    }
    else{
        echo 'no post request!';
    }
}
//Get the client info detail for total orders
public function getClientSalesInfo(){
     if(isset($_POST['user_id'])){
        if($this->is_logged_in()["status"] === "200"){
            if(!empty($_POST['user_id'])){
                $userId=$this->input->post('user_id');
                //get data by year
                if(!empty($this->input->post('year'))){
                    $year=$this->input->post('year');
                }else{
                    $year=date('Y');
                }
                //Get data by month
                if(!empty($this->input->post('month'))){
                    $month=$this->input->post('month');
                }else{
                    $month=date('m');
                }
                $query="SELECT
                usr.`userFirstName` as fname,
                usr.`userLastName` as lname,
                usr.phone,
                usr.`userEmail` as email,
                usr.company,
                usr.state,
                usr.county,
                usr.city,
                usr.zipCode,
                usr.address,
                (SELECT ROUND(SUM(daorder_price)-SUM(daorder_coupen_discount),2) FROM tbl_orders WHERE daorder_user_id='".$userId."' AND daorder_status=1 AND  MONTH(daorder_date)='".$month."') as monthSale,
                (SELECT ROUND(SUM(daorder_price)-SUM(daorder_coupen_discount),2) FROM tbl_orders WHERE daorder_user_id='".$userId."' AND daorder_status=1 AND  YEAR(daorder_date)='".$year."') as yearSale,
                (SELECT ROUND(SUM(daorder_price)-SUM(daorder_coupen_discount),2) FROM tbl_orders WHERE daorder_user_id='".$userId."' AND daorder_status=1) as totalSale 
                FROM `users` as usr 
                WHERE usr.userId='".$userId."'";
            $result=$this->commonmodel->getMultipleRecords($query);
            if($result){
                echo json_encode(array(
                    "status" => "200",
                    "message" => "Data fetch Successfully.",
                    "data" =>$result)
                );
            }else{
                echo json_encode(array('status' => '404','message'=>'No data found.'));
            }
        }else{
            echo json_encode(array('status' => '404','message'=>'No user found.'));
        }
    }else{
            echo json_encode(array('status' => '401','message'=>'Invalid access'));
        }
    }
    else{
        echo 'no post request!';
    }
}
//@todo protect this route from invalid request but make available to dashboard also
public function stats(){
 if($this->is_logged_in()["status"] === "200"){
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
//@todo: @saeed plz verify these respective quries
    $this->load->model('Admin_orders_model');
    $pending = $this->Admin_orders_model->get_pending_orders();
    $rejected = $this->Admin_orders_model->get_rejected_orders();
    $approved = $this->Admin_orders_model->get_approved_orders();
    $transactions = $this->Admin_orders_model->get_total_tractions();
    $sales = $this->Admin_orders_model->get_total_sales();
    $failed = $this->Admin_orders_model->get_total_failed();
    $res = [
    'sent' => $sent,
    'bounces' => $bounces,
    'optOut' => $optOut,
    'transactions' => $transactions->transactions,
    'rejected' => $rejected->rejected,
    'pending' => $pending->pending,
    'approved' => $approved->approved,
    'failed' => $failed->failed,
    'sales' => $sales->sales,
    //'blocks' => $blocks,
    //'bounce_drops' => $bounce_drops,
    //'clicks' => $clicks,
    //'deferred' => $deferred,
    //'delivered'  => $delivered,
    //'invalid_emails' => $invalid_emails,
    //'opens' => $opens,
    //'requests' => $requests,
    //'spam_report_drops' => $spam_report_drops,
    //'spam_reports' => $spam_reports,
    //'unique_clicks' => $unique_clicks,
    //'unique_opens' => $unique_opens,
   // 'unsubscribe_drops' => $unsubscribe_drops
    ];
    if($res){
        echo json_encode([
            "status" => "200",
            "message" => "order stats success",
            "data" => $res
            ]);
    }else{
        echo json_decode([
            "status" => "424",
            "message" => "some thing bad happen while processing"

            ]);
        }
    }else{
            echo json_encode(array('status' => '401','message'=>'Invalid access'));
        }

    }
    public function orderProcess() {
        if(isset($_POST['order_id']) && isset($_POST['status'])){
            $status=$this->input->post('status');
            $orderId=$this->input->post('order_id');
            $orderData=$this->commonmodel->getSingleRecord("SELECT *
            FROM tbl_orders
            WHERE daorder_id='".$orderId."'");
            if($orderData && $this->is_logged_in()["status"] === "200"){
                if($orderData->daorder_status==1 && $status > 0){
                    echo json_encode(
                            array(
                            "status" => "401",
                            "message" => "The order is already processed.No action is allowed."
                          )
                        );

                }else if($status==1 && $orderData->daorder_status >= 0){
                    $paydata=$this->commonmodel->getSingleRecord("SELECT * FROM tbl_payment_info WHERE order_id='".$orderId."' AND status='AUTH'");
                    if($paydata){
                       $pay=$this->processPayment($paydata,'APPROVAL');
                       if($pay=='Success'){
                        //Update order table
                        $this->commonmodel->update('tbl_orders',array('daorder_status'=>1,'daorder_rejection_reason'=>''),array('daorder_id'=>$orderId));
                        //Update payment table
                        $this->commonmodel->update('tbl_payment_info',array('status'=>'COMPLETE'),array('order_id'=>$paydata->order_id,'ssl_txn_id'=>$paydata->ssl_txn_id));
                            echo json_encode(
                                array(
                                "status" => "200",
                                "message" => "Order Completed Successfully."
                              )
                            );
                     }else{
                         echo json_encode(
                                array(
                                "status" => "401",
                                "message" => $pay
                              )
                            );
                     }
                    }else{
                        echo json_encode(
                                array(
                                "status" => "424",
                                "message" => "No payment is done for this order"
                              )    
                        );
                    }
                  
                }else if($status==2 && $orderData->daorder_status >= 0){
                    if($this->input->post('rejection')){
                        $reason = $this->input->post('rejection');
                    }else{
                        $reason = "";
                    }
                    $paydata=$this->commonmodel->getSingleRecord("SELECT * FROM tbl_payment_info WHERE order_id='".$orderId."' AND status='AUTH'");
                    if($paydata){
                       $pay=$this->processPayment($paydata,'DECLINED');
                       if($pay=='Success'){
                        //Update order table
                        $result=$this->commonmodel->update('tbl_orders',array('daorder_status'=>2,'daorder_rejection_reason'=>$reason),array('daorder_id'=>$orderId));
                        //Update payment table
                        $this->commonmodel->update('tbl_payment_info',array('status'=>'DECLINED'),array('order_id'=>$paydata->order_id,'ssl_txn_id'=>$paydata->ssl_txn_id));
                        echo json_encode(
                            array(
                            "status" => "200",
                            "message" => "Successfully Order Rejected."
                          )
                        );
                    }else{
                        echo json_encode(
                            array(
                            "status" => "401",
                            "message" => $pay
                          )
                        );
                    }
                }else{
                    echo json_encode(
                            array(
                            "status" => "401",
                            "message" => "Invalid action."
                          )
                        );
                }
            }else{
                echo json_encode(
                            array(
                            "status" => "401",
                            "message" => "No data found."
                          )
                    );
            }
        }
    }
}
    protected function processPayment($data=array(),$action=NULL){
        if(isset($data->ssl_txn_id)){
            $this->load->library('convergeapi');
            // Sale the order
           if($action=='APPROVAL'){
            $response = $this->convergeapi->cccomplete(
                  array(
                        'ssl_txn_id' => $data->ssl_txn_id,
                        'ssl_amount' => $data->amount,
                        'ssl_partial_shipment_flag' => 'Y'//N – Partial Shipment not supported,Y – Partial Shipment supported
                    )
                );
           }else if($action=='DECLINED'){
            //DELETE KI QUERY
            $response = $this->convergeapi->ccdelete(
                  array(
                        'ssl_txn_id' => $data->ssl_txn_id
                    )
                );
            }
            //Above are deiffernt status
            if(isset($response['errorMessage'])){
                return $response['errorMessage'];
            }else if($response['ssl_result_message']=='APPROVAL' && $response['ssl_txn_id']!=""){
                return 'Success';
            }else{
                return 'Invalid Access';
            }
        }else{
                return 'No transaction id provided';
        }

    }
	/*public function orderProcess() {
			
		if(isset($_POST['orderID'])){
            if($this->is_logged_in()["status"] === "200"){
                if($_POST['orderID']!= ""){
					$orderId=$this->input->post('orderID');
					$query="SELECT
							tbl_order_details.daorder_countyFips	as county, 
							tbl_order_details.daorder_agents 		as emails
							
							From tbl_order_details 
							
							WHERE daorder_id='".$orderId."' ";
					$result=$this->commonmodel->getMultipleRecords($query);
					
					$data=array();
				
					foreach ($result as $row){
						$Countquery="SELECT 
								count(email_address) as total
								FROM `campaign_emails` 
								WHERE  CountyFIPS = '".$row['county']."'";
						$count= $this->commonmodel->getSingleRecord($Countquery);		
						foreach($count as $total){
							$total_emails= $total;
						}
						
						$percentage = ($row['emails'] / $total_emails) * 100;
						
						if($percentage < 50){
							
							$query="SELECT email_address
								FROM `campaign_emails` 
								WHERE  CountyFIPS = '".$row['county']."'
								ORDER BY RAND()
								LIMIT 0, ".$row['emails']." ";
								
							$emails_data1= $this->commonmodel->getEmailRecords($query);
						
							$data[]= array(
										'code'	=>$row['county'],
										'total'	=>$row['emails'],
										'emails'=>$emails_data
									);
							
						}else{
							
							$query="SELECT email_address
								FROM `campaign_emails` 
								WHERE  CountyFIPS = '".$row['county']."'
								
								LIMIT 0, ".$row['emails']." ";
								
							$emails_data[]= $this->commonmodel->getEmailRecords($query);
							foreach ($emails_data as $key => $res){
								foreach ($res as $row){
									$email[]=$row;
								}
								
								
							}
						
						}
					
					}
					
					$imagequery = "SELECT 
									user_flyers. flyer_created_image
									
									From tbl_orders 
									JOIN user_flyers 
									ON tbl_orders.daorder_flyer_id = user_flyers.uFlyerId 
									WHERE daorder_id= '".$orderId."'";
					$image= $this->commonmodel->getimage($imagequery);
					//echo $image;exit;
					//echo json_encode($email);
					//$this->test_send_bulk($image,$email);
					exit;
					if($data){
					   echo json_encode(array(
								"status" => "200",
								"message" => "Flyer Completed Successfully",
								)
							);
						}else{
							echo json_encode(array('status' => '404','message'=>'No data found.'));
						}
                }else{
					
					echo json_encode(array('status' => '404','message'=>'Order Id is required.'));
					
				}

			}else{
				echo json_encode(array('status' => '401','message'=>'Invalid access'));
			}
		}else{
					
			echo json_encode(array('status' => '401','message'=>'Order Id is required'));
					
			}

	}*/
public function test_send_bulk($image=null,$email=null){

	$to  = [
	"peham@pakipreneurs.com",
    "pakipreneurs@gmail.com",
    // "yousendjunkmail@gmail.com",
    // "minimatc@gmail.com"

	
	];

	// $bcc = [
	// "pakipreneurs@gmail.com"

	// ];

	$transport = Swift_SmtpTransport::newInstance('mailing.xyzflyers.com', 2725);

	// This is your From email address
	$from = array('api@deliver1.xyzflyers.com' => 'XYZ Flyers');

	// Email recipients
	// $to = $mock_email_list;

	// Email subject
	$subject = 'Test Flyer Email';

	// Login credentials
	$username = 'api';
	$password = 'changeme';

	// Setup Swift mailer parameters

	$transport->setUsername($username);
	$transport->setPassword($password);
	$swift = Swift_Mailer::newInstance($transport);

	// Create a message (subject)
	$message = new Swift_Message($subject);
    $headers = $message->getHeaders();
    $headers->addTextHeader('x-virtual-mta', 'deliver');
	// attach the body of the email
	$message->setFrom($from);



	// $email_vars['cid'] = $message->embed(Swift_Image::fromPath("public/upload/flyer_images/resized_fc451e1dbf0deb200d96956fc2f44ea7.jpg"));
    $email_vars['header'] = 'emails/style1/incs/header';
    $email_vars['footer'] = 'emails/style1/incs/footer';
    $html = $this->load->view('emails/style1/flyer', $email_vars, true);
    
    $text = "Hi!\nHow are you?\n";

	    $message->setBody($html, 'text/html');
	    $message->setTo($to);
	    // $message->setBcc($bcc);
	    $message->addPart($text, 'text/plain');
	// $message->attach(Swift_Attachment::fromPath("/home/owaishanif/www/flyer/public/upload/user_flyer_store/resized_3ddd74ba11025e01b3fcc3546ebeb09c.jpg")->setFileName("flyer.jpg"));


	/*// send message
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
	   }*/
       $recipients = '';
        foreach ($to as $address)
        {
          // if (is_int($address)) {
            $message->setTo($address);
          // } else {
            // $message->setTo(array($address => $name));
          // }

          $recipients += $swift->send($message, $failures);
        }
        echo 'Message sent out to '.$recipients.' users';
 	}
}
