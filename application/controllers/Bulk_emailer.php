<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Bulk_emailer extends CI_Controller
{
    private $emailBody;
    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
        $this->load->model('Admins_model');
        $this->load->model('Mobile_model');
    }
   

    /*public function orderProcess() {
            
        if(isset($_POST['orderID'])){
            if($this->is_logged_in()["status"] === "200"){
                if($_POST['orderID']!= ""){
                    $orderId=$this->input->post('orderID');
                    $query="SELECT
                            tbl_order_details.daorder_countyFips    as county, 
                            tbl_order_details.daorder_agents        as emails
                            
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
                                        'code'  =>$row['county'],
                                        'total' =>$row['emails'],
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
        echo 'Sent to '.$recipients.' email(s)';
    }




    public function new_send_bulk($image=null,$email=null){
        // print_r($_POST);exit;

        if($_POST['state']!='')
        {
            echo 'Emails to States are disabled!'; exit;
            /*$this->db->where('State', $_POST['state']);
            $comp = $this->db->get('campaign_emails');
            $res = $comp->result();
            $to=array();
            foreach ($res as $email)
            {
                array_push($to, $email->email_address);
            }*/
        }
        else{
            $to = explode(PHP_EOL,$_POST['email_list']);
            // print_r($to); exit;
        }

        //echo "<br><pre>";print_r($to);exit;
       /* $to  = [
            "peham@pakipreneurs.com",
            "pakipreneurs@gmail.com",
        ];*/
            
        $email_vars['header'] = 'emails/style1/incs/'.$_POST['tempheader'];
        $email_vars['subject'] = $_POST['subject'];
        $email_vars['bodycontent'] = $_POST['bodycontent'];
        $email_vars['price'] = 0;
        $email_vars['available_coupons'] = 0; 
        $email_vars['email_list'] = $_POST['email_list'];
        //$email_vars['footer'] = 'emails/style1/incs/footer_coupon';
        $email_vars['tracker'] = '<img src="'.base_url().'/Bulk_emailer/email_tracker/12" alt="" width="1px" height="1px">';
        $email_vars['footer'] = 'emails/style1/incs/'.$_POST['tempfooter'];
        $emailBody = $this->load->view('emails/style1/template', $email_vars, true);
        $email_vars['emailBody'] = $emailBody;
        
        if($this->input->post('view')){ $this->load->view('emails/style1/template', $email_vars, false);}

        if($this->input->post('send')){

        $transport = Swift_SmtpTransport::newInstance('mailing.xyzflyers.com', 2725);
        $from = array('email@xyzflyers.com' => 'XYZ Flyers');
        $subject = $this->input->post('subject');
        $username = 'api';
        $password = 'changeme';

        $transport->setUsername($username);
        $transport->setPassword($password);
        $swift = Swift_Mailer::newInstance($transport);
        $message = new Swift_Message($subject);
        $headers = $message->getHeaders();
        $headers->addTextHeader('x-virtual-mta', 'deliver');
        $message->setFrom($from);
        
        // $text = "Hi!\nHow are you?\n";
        $html = $this->load->view('emails/style1/template', $email_vars, true);
        $message->setBody($html, 'text/html');
        // $message->setTo($to);
        // $message->addPart($text, 'text/plain');
        $recipients = '';
        foreach ($to as $address)
        {
            $message->setTo(trim($address));
            $recipients += $swift->send($message, $failures);
        }
        echo 'Message sent out to '.$recipients.' users';
        
        }
/*      echo "<pre>";
        print_r($email_vars);
        die();
        */

        //echo "Message sent!!!";
    }
    public function email_tracker($order_id){
        header("Content-Type: image/jpeg"); // it will return image
        readfile(dirname(dirname(dirname(__FILE__)))."/assets/imgs/onepixcel.jpg");
        $PublicIP = $this->get_client_ip();
        $ser='';
        foreach ($_SERVER as $key=>$value)
        {
            $ser.=$key.'='.$value.'
            ';
        }
        $deta =['order_id'  => $order_id,
                'ip'        =>$PublicIP,
                'headers'   =>$ser,
                'datetime'  =>date('Y-m-d H:i:s')];
        $this->db->insert('tbl_email_tracking', $deta);
    }


    public function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function notify_for_push($vars=null)
    {
    	$this->load->helper('send_mail_helper');
        $msg = '';
        if($_POST){
                $posts_vars = $_POST;
                foreach ($post_vars as $vars) {
                    $msg+=$vars.' ---- ';
                }}
    	// $msg = $post_vars;
    	_sendMail('peham@pakipreneurs.com', 'Code Pushed to Repo', $msg);

    }

    public function alter()
    {
        $prefs = array(
            'tables'        => array('tbl_settings'),   // Array of tables to backup.
            'ignore'        => array(),                     // List of tables to omit from the backup
            'format'        => 'txt',                       // gzip, zip, txt
            'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
            'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
            'newline'       => "\n"                         // Newline character used in backup file
        );
        $this->load->dbutil();
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup($prefs);
        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file('/public/mybackup.sql', $backup);
        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('mybackup.sql', $backup);


        /*$this->db->query('CREATE TABLE `tbl_settings` (
                              `id` int(10) NOT NULL,
                              `key` varchar(255) NOT NULL,
                              `Value` varchar(100) NOT NULL,
                              `datetime` datetime NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;');
        $this->db->query('ALTER TABLE `tbl_settings` ADD PRIMARY KEY (`id`);');
        $this->db->query('ALTER TABLE `tbl_settings` MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;');
        */
        //$this->db->query("ALTER TABLE `tbl_settings` ADD `imagename` VARCHAR(255) NOT NULL AFTER `Value`;");
        /*$this->db->query("INSERT INTO `tbl_settings` (`mykey`, `Value`, `datetime`) VALUES ('frontend_contactus_coupon', '28936', '2017-03-24 00:00:00')");*/
        //$this->db->query("INSERT INTO `tbl_settings` (`mykey`, `Value`, `datetime`) VALUES ('frontend_contactus_email_logo', 'footer.php', '2017-03-24 00:00:00')");
        /*$res=$this->db->get('tbl_flyer_detail');
        $res=$this->db->query('update `user_flyers` set `flyerId`=73 WHERE `flyerId`=0');*/
       /* $campaign_emails = $this->db->get('campaign_emails');
        $res = $campaign_emails->result();
        echo "<pre>"; print_r($res);*/
        //$this->db->query(" ALTER TABLE `tbl_settings` DROP `imagename`;");

        //echo "<pre>";print_r($res->result());
    }
}
