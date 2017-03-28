<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* New design Congtroller
*/
class Editor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(isset($_SESSION['user_data'])){
			if(!$this->session->userdata('tab_open')){
				$this->session->set_userdata('tab_open', 1);

			}
			$this->load->model(array('admin/flyersmodel','frontend/commonmodel'));
			$this->load->model('Users_model');
			$this->load->model('Subscriber_model');
			$this->load->helper('file');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Please login to your editor dashboard.</div>');
			redirect(site_url('login'));
		}
	}
	public function index($value='')
	{
		/*echo '<pre>';
		print_r($this->session->all_userdata());
		exit;*/
		$data['flyerTags'] = $this->flyersmodel->getAllflyer_tags(" WHERE flyer_tags_status='Active' ");
		$data['flyers'] = $this->flyersmodel->getAllflyers(array('flyer_status'=>'Published'));
		//Get user flyers
		$data['userflyers']=$this->commonmodel->getMultipleRecords("SELECT uf.uFlyerId as fid,uf.uFlyerTitle as ftitle,uf.flyer_created_image as fimage,uf.flyer_json_file as json_file
			FROM user_flyers uf
			WHERE  uf.userId='".$this->session->userdata('user_data')['pk_user_id']."' AND repeater=0 
			ORDER BY uf.uFlyerDate");
		//FLYER PROOF
		$data['flyer_proof'] = $this->showflyer($val=1);
		//BILLING INFO
		$data['billinginfo']=$this->commonmodel->getSingleRecord("SELECT state,county,city,address,zipCode from users where userId='".$this->session->userdata('user_data')['pk_user_id']."'");

        //step 3
		if($this->session->userdata('tab_open')==3)
		{
			$data['user_selected_flyer']=$this->session->userdata('user_selected_flyer');
		}
        //delivery area
		if($this->session->userdata('tab_open')==5){ 
			$data['overall_emails'] = $this->commonmodel->getSingleRecord("SELECT count(email_address) as overallEmails from campaign_emails");
			$data['us_state_agents']=$this->agents_statewise();
		}
		if($this->session->userdata('tab_open')==6){
			$data['us_state']=$this->commonmodel->state_list;
		//Get coupen active coupen data
			if(isset($this->session->userdata('user_order')['coupon_applied']['cp_id'])){
				$data['coupen_code'] = $this->commonmodel->getSingleRecord("SELECT * from admi_coupons JOIN admi_coupons_used on admi_coupons.coupon_code=admi_coupons_used.coupon_code WHERE admi_coupons_used.userId=".$this->session->userdata('user_data')['pk_user_id']." AND admi_coupons_used.used_id=".$this->session->userdata('user_order')['coupon_applied']['cp_id']."");
			}
		}
		$this->load->view('new_frontend/editor',$data);
	}
	//STEP ONE OPTION 1 create new
	public function create_new(){
		if(isset($_POST['new_flyer'])){
			if($this->input->post('new_flyer')==1){
				/*$this->session->userdata['user_order']['step'] = 2;*/
				/*$this->session->userdata['user_order']['type'] = 'new';// new, previous,*/
				$this->session->unset_userdata('using_previous');
		 		$this->session->set_userdata('tab_open', 2);
				echo json_encode(array('message'=>'Success'));
			}else{
				echo json_encode(array('message'=>'Error'));
			}
		}
	}

	public function exit_tour()
	{
		$this->session->set_userdata('exit', true);
		$this->session->set_userdata('exit_step', $this->session->tab_open);
		echo 'ok';


	}

	public function get_step()
	{
		if($this->input->post('way')=='auto')
		{
			if($this->session->userdata('exit')) echo 'exit';
		}
		else echo $this->session->tab_open;
	}

	//STEP ONE OPTION 1 cancel new
	public function cancel_new(){
		if(isset($_POST['new_cancel'])){
			if($this->input->post('new_cancel')==1){
				$this->session->set_userdata('tab_open', 1);
				/*$this->session->userdata['user_order']['step'] = 1;
				$this->session->userdata['user_order']['type'] = null;// new, previous, file*/
				$this->session->unset_userdata('using_previous');
				echo json_encode(array('message'=>'Success'));
			}else{
				echo json_encode(array('message'=>'Error'));
			}
		}
	}
	//STEP ONE OPTION 1 ADD FLYER FROM EDITOR
	public function save_editor_flyer(){
		if(isset($_POST['save_editor'])){
			$property=json_decode($_POST['text_properties'],true);
			$body1=(isset($property[0]['body1'])?$property[0]['body1']:"");
			$body2=(isset($property[0]['body2'])?$property[0]['body2']:"");
			$body3=(isset($property[0]['body3'])?$property[0]['body3']:"");
			$mainheader=(isset($property[0]['mainheader'])?$property[0]['mainheader']:"");
			$company1_contactinfo=(isset($property[0]['company1-contactinfo'])?$property[0]['company1-contactinfo']:"");
			$agent1_contactinfo=(isset($property[0]['agent1-contactinfo'])?$property[0]['agent1-contactinfo']:"");
			$address=(isset($property[0]['address'])?$property[0]['address']:"");
			$price=(isset($property[0]['price'])?$property[0]['price']:0);
			if($this->input->post('save_editor')==1){
				$img = $this->input->post('img_file');
				htmlspecialchars_decode($img);
				$file_name='flyer_'.$this->session->userdata('user_data')['username']."_".time();
				$imgdata = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
				$filepath = './public/upload/user_flyer_store/';
				//img file
				$imgfile=$filepath.$file_name.'.jpg';
				//json file
				$json_data = $this->input->post('json_file');
				$jsonfile=$filepath.'json_files/'.$file_name.'.json';
				$this->load->helper('file');
				if(!write_file($jsonfile, $json_data)) echo json_encode(array('message'=>'Image cannot created.'));
				
				if(!write_file($imgfile,$imgdata)){
					echo json_encode(array('message'=>'Image cannot created.'));
				}else{		
					$config['image_library'] = 'gd2';
					$config['source_image'] = $imgfile;
					$config['new_image'] = $filepath.'_thumbs/thumb_'.$file_name.'.jpg';
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 200;
					$config['height'] = 240;
					$this->load->library('image_lib', $config);	
					if (!$this->image_lib->resize()){
						$thumb="";
						$error2 = array('error' =>  $this->image_lib->display_errors());
						echo json_encode(array('message'=>$error2));
					}
					else{
						$thumb='thumb_'.$file_name.'.jpg';
					}
					$json=$this->input->post('json_file');
					if(empty($json) || !write_file($jsonfile,$json)){
						$jsonfile="";
						$filetype="File";

					}else{
						$filetype="Editor";

					}				
					$data=array(
						'propertyMainHeader' =>$mainheader,
						'propertyBody1' =>$body1,
						'propertyBody2' =>$body2,
						'propertyBody3' =>$body3,
						'company1Info' => $company1_contactinfo,
						'agent1ContactInfo'=>$agent1_contactinfo,
						'propertyAddress'=>$address,
						'propertyPrice'=>$price,
						'flyer_created_image' => $file_name.'.jpg',
						'flyer_created_thumb' => $thumb,
						'flyerType' => $filetype,
						'flyer_json_file' => $file_name.'.json',
						'uFlyerDate'=> date('Y-m-d H:i:s'),
						'userId' => $this->session->userdata('user_data')['pk_user_id']
						);
					$result= $this->commonmodel->insert("user_flyers",$data,'last_id');
					if(!empty($result)){
						$this->session->set_userdata('tab_open', 4);
						$this->session->set_userdata('active_flyer', $result);
						echo json_encode(array('message'=>'Success'));
					}else {
						echo json_encode(array('message'=>'There is some error while saving please try again.'));
					}
				}
			}
		}
	}

	public function check_if_using_previous_flyer()
	{
		if($this->session->using_previous) echo $this->session->using_previous;
		else echo 'false';
	}
	//STEP ONE OPTION 2 USE EXISTING FLYER OF USER
	public function use_existing_flyer(){
		if($_POST['flyer']){

			$flyerID=$this->input->post('flyer');
			$flyerData=$this->commonmodel->getSingleRecord("SELECT *
				FROM user_flyers
				WHERE uFlyerId='".$flyerID."'");
			$data=array(
				'uFlyerTitle' => $flyerData->uFlyerTitle,
				'flyer_created_image' => $flyerData->flyer_created_image,
				'flyer_created_thumb' => $flyerData->flyer_created_thumb,
				'flyer_json_file' => $flyerData->flyer_json_file,
				'uFlyerDate' => date('Y-m-d H:i:s'),
				'propertyAddress' => $flyerData->propertyAddress,
				'propertyPrice' => $flyerData->propertyPrice,
				'propertyMainHeader' => $flyerData->propertyMainHeader,
				'propertyHeadline' => $flyerData->propertyHeadline,
				'propertyBody1' => $flyerData->propertyBody1,
				'propertyBody2' => $flyerData->propertyBody2,
				'propertyBody3' => $flyerData->propertyBody3,
				'propertyCallToAction' => $flyerData->propertyCallToAction,
				'agent1ContactInfo' => $flyerData->agent1ContactInfo,
				'agent1License' => $flyerData->agent1License,
				'agent2ContactInfo' => $flyerData->agent2ContactInfo,
				'agent2License' => $flyerData->agent2License,
				'agentEmail' => $flyerData->agentEmail,
				'agentAddress' => $flyerData->agentAddress,
				'company1Info' => $flyerData->company1Info,
				'company1License' => $flyerData->company1License,
				'company2Info' => $flyerData->company2Info,
				'company2License' => $flyerData->company2License,
				'flyerType' => $flyerData->flyerType,
				'repeater'	=> $flyerID,
				'flyerId' => $flyerData->flyerId,
				'userId' => $this->session->userdata('user_data')['pk_user_id']
				);
$result= $this->commonmodel->insert("user_flyers",$data,'last_id');
if(!empty($result)){
	$this->session->set_userdata('active_flyer', $result);
	
	if($flyerData->flyerType=='Editor') 
		{$this->session->set_userdata('tab_open', 3);
		/*$this->session->userdata['user_order']['step'] = 3;*/}
	else {$this->session->set_userdata('tab_open', 4);
/*		$this->session->userdata['user_order']['step'] = 4;*/}

	$this->session->set_userdata('using_previous', 'true');
	// $this->session->userdata['user_order']['type'] = 'previous';
	$this->session->set_userdata('user_selected_flyer', $result);
	echo json_encode(array('message'=>'Success'));
}else {
	echo json_encode(array('message'=>'Error'));
}
}
}
//STEP ONE OPTION  3
public function upload_flyer(){
	if(isset($_FILES['userfile'])){
		$terms 	= $this->input->post('terms');
		$name	= $this->session->userdata('user_data')['username'];
		$user_id= $this->session->userdata('user_data')['pk_user_id'];
		$config = array(
			'upload_path' => "./public/upload/user_flyer_store",
			'allowed_types' => "gif|jpg|png|bmp|jpeg|pdf",
			'overwrite' => FALSE,
			'file_name' => 'flyer_'.$name."_".date('Y-m-d')
			);
		$this->load->library('upload', $config);
		if($terms!=1){
			echo json_encode('<div class="alert alert-danger">Please accept the Terms & Conditions</div>');

		}
		else if(!$this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());
			echo json_encode('<div class="alert alert-danger">'.$error['error'].'</div>');
		}
		else{
			$filearray = array('upload_data' => $this->upload->data());
			if($filearray['upload_data']['file_ext']=='.pdf')
			{
				$im = new Imagick();
				$im->setResolution(300, 300);
				$im->readimage('./public/upload/user_flyer_store/'.$filearray['upload_data']['file_name']);
				$im->setImageFormat('jpeg');    
				$new_fname = $filearray['upload_data']['raw_name'].'.jpg'; //new file name in jpg
				$im->writeImage('./public/upload/user_flyer_store/'.$new_fname); 
				$im->clear(); 
				$im->destroy();

				// print_r($filearray);exit;
				$filename = $new_fname;
			}
	else $filename = $filearray['upload_data']['file_name'];
			//create thumb
	if($filename!=""){
		$config['image_library'] = 'gd2';
		$config['source_image'] = './public/upload/user_flyer_store/'.$filename;
		$config['new_image'] = './public/upload/user_flyer_store/_thumbs/thumb_'.$filename;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;		
		$config['width'] = 200;
		$config['height'] = 240;
		$this->load->library('image_lib', $config);	
		if (!$this->image_lib->resize()){
			$error2 = array('error' =>  $this->image_lib->display_errors());
			echo '<div class="alert alert-danger">'.$error2['error'].'</div>';
		}
		else{
				//seccess
		}
	} 
			//insertion array
	$data=array(
		'userId' => $this->session->userdata('user_data')['pk_user_id'],
		'flyer_created_image' => $filename,
		'flyer_created_thumb' => 'thumb_'.$filename,
		'flyerType' => 'File',
		'uFlyerDate' =>date('Y-m-d H:i:s')

		);
	$result= $this->commonmodel->insert("user_flyers",$data,'last_id');
	if($result!=""){
		$this->session->set_userdata('active_flyer', $result);
		$this->session->set_userdata('tab_open', 4);
		$this->session->set_userdata('tab_refrer', "upload_own_flyer");
		echo json_encode(array('message'=>'Success'));
	}else{
		echo json_encode('<div class="alert alert-danger">There is some error !</div>');
	}
}
}
}
//STEP 2
public function load_flyers_by_tags()
{
	echo json_encode($this->flyersmodel->load_flyers_by_tags($this->input->post('tagId')));
}
public function load_json($id)
{
	if(!empty($id)){
		$this->session->set_userdata('selected_flyer_p', $id);
		$flyer = $this->flyersmodel->get_flyer_by_id($id);
		if(!$flyer)
		{
			$flyer = $this->commonmodel->getSingleRecord("SELECT *
			FROM user_flyers
			WHERE uFlyerId='".$id."'");
			$file = $flyer->flyer_json_file;
		} else $file = $flyer->flyer_json_file;
        //echo $file;
		if(file_exists('public/upload/flyers/'.$file)){
			$this->load->helper('file');
			$this->session->set_userdata('tab_open', 3);
			$this->session->set_userdata('admin_flyer',$id);
			$this->session->set_userdata('user_selected_flyer',$id);
			echo htmlspecialchars_decode(read_file('public/upload/flyers/'.$file));
		}else{
			if($this->session->using_previous=='true') $this->session->set_userdata('tab_open', 1);
			else $this->session->set_userdata('tab_open', 2);
			echo json_encode(array('message'=>'Empty'));
		}	
	}

}
public function get_flyer_colorsets()
{
	if($this->input->post('flyerId')){
		if($flyer = $this->flyersmodel->get_flyer_by_id($this->input->post('flyerId')))
		echo $flyer->flyer_color_sets;
		// print_r($flyer); 
	}
	else echo 'bad request!';
}
public function get_flyer_properties($flyer_id = null)
{
	$this->load->model('admin/flyersmodel');
	if(!$flyer_id) {$flyer_id = $this->input->post('flyer_id');}

	$res = $this->flyersmodel->get_flyer_properties($flyer_id);
	if($res) echo @$res[0]->flyer_text_properties;
}

public function load_json_update($id)
{
	if(!empty($id)){
		$flyer = $this->commonmodel->getSingleRecord("SELECT *
			FROM user_flyers
			WHERE uFlyerId='".$id."'");
		$file = $flyer->flyer_json_file;
		if(!empty($file) && file_exists('./public/upload/user_flyer_store/json_files/'.$file)){
			$this->load->helper('file');
			$this->session->set_userdata('tab_open', 3);
			$this->session->set_userdata('admin_flyer',$flyer->flyerId);
			echo htmlspecialchars_decode(read_file('./public/upload/user_flyer_store/json_files/'.$file));
		}else{
			$this->session->set_userdata('tab_open', 2);
			echo json_encode(array('message'=>'Empty'));
		}
		$this->deleteFlyerData();	
	}

}
//cancel flyer in editor
public function cancel_flyer_editor(){
	if(isset($_POST['cancel_editor'])){
		if($this->session->using_previous=='true')
		{
			$this->session->set_userdata('tab_open', 1);
			echo json_encode(array('message'=>'Success'));
		}
		else{
				if($this->input->post('cancel_editor')==1){
					$this->session->set_userdata('tab_open', 2);
					$this->session->unset_userdata('admin_flyer');
					$this->session->unset_userdata('selected_flyer_p');
					echo json_encode(array('message'=>'Success'));
				}else{
					echo json_encode(array('message'=>'Error'));
				}}
	}

}
public function flyer_save_properties($flyerID, $data)
{
	if($res = $this->flyersmodel->flyer_save_properties($flyerID, $data)=='done')
	{
		return true;
	}
	else return $res;

}
/*
STEP NU 4 PROOF
* Afer uploading or creating flyer show for review on step number 4
*/
public function showflyer($val=NULL){
	if(isset($_POST['showflyer'])){
		$val=$this->input->post('showflyer');
	}
	if($val==1){
		$flyerData=$this->commonmodel->getSingleRecord("SELECT * from user_flyers where uFlyerId='".$this->session->userdata('active_flyer')."'");
		if($flyerData){
			return $flyerData;

		}else{
			return 'Empty';
		}
	}else{
		return 'Error';
	}
}
	/*
	* Save flyer data in step number 4
	*/
	public function saveproof(){

		if(isset($_POST['subject'])){
			$arraynotempty=array(
				'uFlyerTitle' => $this->input->post('subject'),
				'uFlyerEmail'=> $this->input->post('email')
				);
			$array=array(
				'uFlyerTitle' => $this->input->post('subject'),
				'uFlyerEmail'=> $this->input->post('email'),
				'agentEmail'=> $this->input->post('client_email'),
				'agent1License'=>$this->input->post('mls-num'),//should varified what is mls
				'propertyPrice'=>$this->input->post('listing-price'),
				'propertyAddress'=>$this->input->post('prop-address'),
				'propertyMainHeader'=>$this->input->post('main-header'),
				'propertyBody1'=>$this->input->post('body')
				);
			if(!in_array("",$arraynotempty)){
				$result=$this->commonmodel->update('user_flyers',$array,array('uFlyerId'=>$this->session->userdata('active_flyer'),'userId'=>$this->session->userdata('user_data')['pk_user_id']));
				if($result){
					if(!$this->session->user_order) $this->session->set_userdata('tab_open', 5);
					else $this->session->set_userdata('tab_open', 6);
					echo json_encode(array('message'=>'Success'));

				}else{
					echo json_encode(array('message'=>'Error'));
				}

			}else{
				echo json_encode(array('message'=>'Empty'));
			}
		}
	}
	/*
	* Cancel flyer data in step number 4
	* This will remove the flyer data both in session and
	* Data base and will lead the user to step number 1
	*/
	public function cancelFlyer(){
		if(isset($_POST['cancel_proof'])){
			if($this->deleteFlyerData()==TRUE){
				$this->session->unset_userdata('tab_refrer');
				$this->session->set_userdata('tab_open', 1);
				echo json_encode(array('message'=>'Success'));
			}else{
				echo json_encode(array('message'=>'Error'));
			}

		}
	}
	protected function deleteFlyerData(){
		$proofData=$this->commonmodel->getSingleRecord("SELECT flyer_created_image,flyer_created_thumb,flyer_json_file,repeater
			FROM user_flyers
			WHERE uFlyerId='".$this->session->userdata('active_flyer')."'
			AND userId='".$this->session->userdata('user_data')['pk_user_id']."'");
		$result=$this->commonmodel->delete('user_flyers',array('uFlyerId' => $this->session->userdata('active_flyer')));
		if($result){
			if(!empty($proofData->flyer_created_image) && $proofData->repeater==0 && file_exists('./public/upload/user_flyer_store/'.$proofData->flyer_created_image)){
				unlink('./public/upload/user_flyer_store/'.$proofData->flyer_created_image);
			}
			if(!empty($proofData->flyer_created_thumb) && $proofData->repeater==0 &&  file_exists('./public/upload/user_flyer_store/_thumbs/'.$proofData->flyer_created_thumb)){
				unlink('./public/upload/user_flyer_store/_thumbs/'.$proofData->flyer_created_thumb);

			}
			if(!empty($proofData->flyer_json_file) && $proofData->repeater==0 && file_exists('./public/upload/flyer_json_files/'.$proofData->flyer_json_file)){
				unlink('./public/upload/user_flyer_store/json_files/'.$proofData->flyer_json_file);

			}
			$pieces = explode(".", $proofData->flyer_created_image);

			if(file_exists('./public/upload/user_flyer_store/'.$pieces[0].'.pdf')){
				unlink('./public/upload/user_flyer_store/'.$pieces[0].'.pdf');

			}
			return TRUE;
		}else{
			return FALSE;
		}

	}
	/*
	STEP NU 5 Delivery
	* Afer saving flyer data user will be land on delivery area.
	* Here user  will select agents for mailing
	* Agents state wise for map papulation
	*/
	protected function agents_statewise(){
		
		return $this->commonmodel->getMultipleRecords("SELECT state as code, count(email_address) as agt from campaign_emails group by(state)");
	}
	/*
    * Load counties state wise
	*/
	public function load_counties_by_state(){
		$state=$this->input->post("state");
		$stateName=$this->input->post("stateName");
		$this->load_map_data($state,$stateName);

	}
	/*
    * Cancel the selected agents in cart
	*/
	public function cancelCart(){
		if(isset($_POST['cancel_delivery'])){
			if($_POST['cancel_delivery']==1){
				$this->commonmodel->delete('admi_coupons_used',array('userId' => $this->session->userdata('user_data')['pk_user_id'],'order_id'=>'-111'));
				$this->session->set_userdata('tab_open', 4);
				$this->session->unset_userdata('user_order');
				echo json_encode(array('message'=>'Success'));
			}else{
				echo json_encode(array('message'=>'Error'));
			}

		}

	}
	/*
    * Checks the selected agents if exist proceed else stop proceeding
	*/
	public function agentsInque(){
		if(isset($_POST['agtentsEmails'])){
			if($this->session->userdata('user_order')){
				$this->session->set_userdata('tab_open', 6);
				echo json_encode(array('message'=>'Success'));
			}else{
				echo json_encode(array('message'=>'Empty'));
			}
		}
	}
	/*
    * STEP NO 6
    * Save biiling info
	*/
	public function save_billing_info(){
		if(isset($_POST['state'])){
			$array=array(
				'state' => $this->input->post('state'),
				//'county'=> $this->input->post('county'),
				'city'=>$this->input->post('city'),
				'address'=>$this->input->post('address')
				);
			if(!in_array("",$array)){
				$result=$this->commonmodel->update('users',$array,array('userId'=>$this->session->userdata('user_data')['pk_user_id']));
				if($result){
					$finalarray=$this->session->user_order;
					if(isset($finalarray['tax_applied'])){
						unset($finalarray['tax_applied']);
						$this->session->set_userdata('user_order',$finalarray);
					}
					$data['billinginfo']=$this->commonmodel->getSingleRecord("SELECT state,county,city,address,zipCode from users where userId='".$this->session->userdata('user_data')['pk_user_id']."'");
					echo json_encode($data);
				}else{
					echo json_encode(array('message'=>'Error'));
				}

			}else{
				echo json_encode(array('message'=>'Empty'));
			}

		}
	}
	/*
	* Validate coupen code
	*/
	public function coupenAdd(){
		if($_POST['cooupen_code']){
			//Get all the coupen data
			$coupenData = $this->commonmodel->getSingleRecord("SELECT * from admi_coupons where coupon_code='".$this->input->post('cooupen_code')."'");
			//Get the total usage of current coupen
			$coupenUsage=$this->commonmodel->getSingleRecord("SELECT count(coupon_code) as usedcpn from admi_coupons_used where coupon_code='".$this->input->post('cooupen_code')."'");
			//Get the info if the user used current coupen
			$coupenAlreadyused=$this->commonmodel->getSingleRecord("SELECT count(coupon_code) as usercpn from admi_coupons_used where coupon_code='".$this->input->post('cooupen_code')."' AND 	userId='".$this->session->userdata('user_data')['pk_user_id']."'");
			//Get the user info either he/she is new or existing
			$userOrder = $this->commonmodel->getSingleRecord("SELECT count(daorder_id) as userorder from tbl_orders where daorder_user_id='".$this->session->userdata('user_data')['pk_user_id']."'");
            //Validation conditions
			if(empty($coupenData)){
				echo json_encode('<div class="alert alert-danger">Sorry this coupon does not exists.</div>');
			}else if($coupenData->coupon_status!=1){
				echo  json_encode('<div class="alert alert-danger">Sorry this coupon  is not active.</div>');
			}else if(strtotime($coupenData->coupone_end_date) < time()){
				echo  json_encode('<div class="alert alert-danger">Sorry this coupon code is expired.</div>');
			}else if($coupenUsage->usedcpn>=$coupenData->coupon_maximum_uses){
				echo  json_encode('<div class="alert alert-danger">Sorry this coupon has complete usage limit.</div>');
			}else if(($coupenData->coupon_apply_once==1) && ($coupenAlreadyused->usercpn > 0)){
				echo  json_encode('<div class="alert alert-danger">You have already used this coupon.</div>'); 
			}else if(($coupenData->coupon_new_signups==1) && ($userOrder->userorder > 0)){
				echo  json_encode('<div class="alert alert-danger">Sorry only new user can use this coupon.</div>'); 
			}else if(($coupenData->coupon_apply_on_existing_client_only==1) && ($userOrder->userorder < 1)){
				echo  json_encode('<div class="alert alert-danger">Sorry only existing user can use this coupon.</div>'); 
			}else{
				$coupen=array(
					'used_date'	=> date('Y-m-d H:i:s'),
					'userId'	=> $this->session->userdata('user_data')['pk_user_id'],
					'order_id'	=> '-111',
					'coupon_code'=> $this->input->post('cooupen_code')
					);
				$last_id= $this->commonmodel->insert("admi_coupons_used",$coupen,'last_id');
				if($last_id!=""){
					//Applying coupon on price order
					$coupen_code = $this->commonmodel->getSingleRecord("SELECT * from admi_coupons JOIN admi_coupons_used on admi_coupons.coupon_code=admi_coupons_used.coupon_code WHERE admi_coupons_used.userId=".$this->session->userdata('user_data')['pk_user_id']." AND admi_coupons_used.used_id=".$last_id."");
					if(isset($coupen_code) && !empty($coupen_code)){
						switch ($coupen_code->coupon_type){
							case 0:
							$dicount=round($coupen_code->coupon_value*($this->session->userdata('user_order')['price'])/100,2);
							$grand_total=((($this->session->userdata('user_order')['price'])-$dicount)>0?(($this->session->userdata('user_order')['price'])-$dicount):0);
							break;
							case 1:
							$dicount=$coupen_code->coupon_value;
							$grand_total=((($this->session->userdata('user_order')['price'])-$dicount)>0?(($this->session->userdata('user_order')['price'])-$dicount):0);
							break;
							case 2:
							$dicount= $coupen_code->coupon_value;
							$grand_total=($coupen_code->coupon_value>0?$coupen_code->coupon_value:0);
							break;
							default:
							$dicount=0;
							$grand_total=((($this->session->userdata('user_order')['price'])-$dicount)>0?(($this->session->userdata('user_order')['price'])-$dicount):0);
							break;
						}
					}else{
						$dicount=0;
						$grand_total=$this->session->userdata('user_order')['price'];
					}
					if($dicount && $grand_total){
						$finalarray=$this->session->user_order;
						$finalarray['coupon_applied']=array('cp_id'=>$last_id,'cp_type'=>$coupen_code->coupon_type,'cpn_discount'=>$dicount,'cpn_total'=>$grand_total
							); 
						$this->session->set_userdata('user_order',$finalarray);
					}
					echo json_encode(array('message'=>'Success'));
				}else{
					echo json_encode(array('message'=>'Error'));
				}
			}
		}
	}
	/* 
	* coupen remove
	*/
	public function cancelCoupen(){
		if(isset($_POST['cancel_coupen'])){
			$result=$this->commonmodel->delete('admi_coupons_used',array('userId' => $this->session->userdata('user_data')['pk_user_id'],'used_id'=>$this->session->userdata('user_order')['coupon_applied']['cp_id']));
			if($result){
				$finalarray=$this->session->user_order;
				if(isset($finalarray['coupon_applied'])){
					unset($finalarray['coupon_applied']);
					$this->session->set_userdata('user_order',$finalarray);
				}
				echo json_encode(array('message'=>'Success'));

			}else{
				echo json_encode(array('message'=>'Error'));

			}
		}
	}
	/*
	* Cancel the payment information tab
	*/
	public function cancelPayment(){
		if(isset($_POST['cancel_payment'])){
			//if result is true
			if(isset($this->session->userdata('user_order')['coupon_applied']['cp_id'])){
				$this->commonmodel->delete('admi_coupons_used',array('userId' => $this->session->userdata('user_data')['pk_user_id'],'used_id'=>$this->session->set_userdata('user_order')['coupon_applied']['cp_id']));

			}
			$this->session->set_userdata('tab_open', 5);
			$this->session->unset_userdata('user_order');
			echo json_encode(array('message'=>'Success'));
		}
	}
	/*
    * Place orders and make the cart items to status done
	*/
	public function placeOrder(){
		// $cardInfo=json_decode(base64_decode($this->session->userdata('order_info')));
		//echo "<pre>";
		//print_r($cardInfo);
		/*echo '<pre>';
		print_r($this->session->all_userdata());
		exit;*/
		if(isset($_POST['cc_name'])){
			$name       = $_POST['cc_name'];
			$cardNumber = $_POST['ccn1'].$_POST['ccn2'].$_POST['ccn3'].$_POST['ccn4'];
			$expMonth   = $_POST['cc_exp_mo'];
			$expYear    = $_POST['cc_exp_yr'];
			$ccVv       = $_POST['ccvv'];
			$nameSplit  = explode(" ",$name);
			if(isset($nameSplit[0]) && $nameSplit[0]==""){
				echo json_encode(array('message'=>'Please enter first name as it appears on the card.'));
			}else if(!array_key_exists(1,$nameSplit) && @$nameSplit[1]==""){
				echo json_encode(array('message'=>'Please enter last name as it appears on the card.'));
			}else if($cardNumber==""){
				echo json_encode(array('message'=>'Card number of payment Info should not be empty.'));
			}else if($ccVv==""){
				echo json_encode(array('message'=>'Please enter CVV code as it appears on the card.'));	
			}else{
				$finalarray=$this->session->user_order;
				if(is_array($finalarray) && !empty($finalarray)){
					$ordertbl=array(
						'daorder_flyer_id' =>$this->session->userdata('active_flyer'),
						'daorder_user_id' => $this->session->userdata('user_data')['pk_user_id'],
						'daorder_total_emails'=>$finalarray['quantity'],
						'daorder_price' => floatval($finalarray['price']),
						'daorder_coupen_discount' =>(array_key_exists('coupon_applied',$finalarray)?$finalarray['coupon_applied']['cpn_discount']:0),
						'daorder_tax_applied' => (array_key_exists('tax_applied',$finalarray)?$finalarray['tax_applied']:0),
						'daorder_grand_total' => floatval($finalarray['price']-(array_key_exists('coupon_applied',$finalarray)?$finalarray['coupon_applied']['cpn_discount']:0)+(array_key_exists('tax_applied',$finalarray)?$finalarray['tax_applied']:0)),
						'daorder_coupon_type' =>(array_key_exists('coupon_applied',$finalarray)?$finalarray['coupon_applied']['cp_type']:204),
						'daoder_admin_id' =>'',
						'daorder_modified_by'=>'',
						'daorder_date' =>date('Y-m-d H:i:s'),
						'daorder_modified_date' =>'',
						'daorder_status' =>0,
						);
				/*echo "<pre>";
				print_r($ordertbl);
				exit;*/
				$last_id= $this->commonmodel->insert("tbl_orders",$ordertbl,'last_id');
				if($last_id!=""){
					if(array_key_exists('coupon_applied',$finalarray)){
						$this->commonmodel->update('admi_coupons_used',array('order_id'=>$last_id),array('userId'=>$this->session->userdata('user_data')['pk_user_id'],'used_id'=>$finalarray['coupon_applied']['cp_id']));
					}
					
					$ordertbl2=array();
					foreach($finalarray['details'] as $value){
						$ordertbl2[]=array(
							'daorder_id' => $last_id,
							'daorder_pkg_number' => '',
							'daorder_agents' => $value['quantity'],
							'daorder_state' => $value['state'],
							'daorder_countyFips' =>$value['fips'],
							'deorder_status' =>0
							);

					}
					$success=$this->db->insert_batch('tbl_order_details', $ordertbl2);
					if($success==true){
						//process the payment card
						$this->load->library('convergeapi');
						$firstName=$nameSplit[0];
						$lastName=$nameSplit[1];
						$expiryDate=$expMonth.$expYear;
						// Authonicate the order
						$process_req = array(
							// 'ssl_amount' => floatval(array_key_exists('coupon_applied',$finalarray)?(($finalarray['coupon_applied']['cpn_total']) > 1?$finalarray['coupon_applied']['cpn_total']:0)+(array_key_exists('tax_applied',$finalarray)?$finalarray['tax_applied']:0):$finalarray['price']+(array_key_exists('tax_applied',$finalarray)?$finalarray['tax_applied']:0)),
								'ssl_amount' => 1,
							'ssl_invoice_number' => $last_id,
							'ssl_card_number' => $cardNumber,
							'ssl_cvv2cvc2' => $ccVv,
							'ssl_exp_date' => $expiryDate,
							'ssl_first_name' => $firstName,
							'ssl_last_name' =>  $lastName,
							'ssl_get_token' => 'Y'
							) ;
						// print_r($process_req);
						$response = $this->convergeapi->ccauthonly($process_req);
						if(isset($response['errorMessage'])){
			               		//When their is error show message and delete order
							$this->discardOrder($last_id);
							if($response['errorCode']==5000){
								echo json_encode(array('message'=>'The credit card number supplied is invalid.'));	
							}else{
								echo json_encode(array('message'=>$response['errorMessage']));	
							}
							exit;
						}else if(isset($response['ssl_result_message']) && $response['ssl_result_message']=='INVALID CARD'){
			               	    //When card is decline show message and delete order
							$this->discardOrder($last_id);
							echo json_encode(array('message'=>'The credit card number supplied is invalid.!'));
						}else if(isset($response['ssl_result_message']) && $response['ssl_result_message']=='CALL REF:'){
			               	    //When card is decline show message and delete order
							$this->discardOrder($last_id);
							echo json_encode(array('message'=>'This transaction request has not been approved.Try with another form of payment to complete this transaction or contact admin.'));
						}else if(isset($response['ssl_result_message']) && $response['ssl_result_message']=='CALL AUTH CENTER'){
			               	    //When card is decline show message and delete order
							$this->discardOrder($last_id);
							echo json_encode(array('message'=>'Your bank account cannot be processed.Please call your bank for acceptence of online shoping.'));
						}else if(isset($response['ssl_result_message']) && $response['ssl_result_message']=='APPROVAL' && $response['ssl_txn_id']!=""){
                             		//Make order and show success message
							$ress=$this->makeOrder($response,$last_id);
							if($ress){
								// send admin order email
								// send user order confirmation email
								echo json_encode(array('message'=>'Success'));
							}else{
				                	//send admin an email and save response for resolving issue
								$this->saveErroLog($response);
					                //delete all order records and go to tab 6
								$this->discardOrder($last_id);
								echo json_encode(array('message'=>'Error'));
							}
						}else{
							if(isset($response['ssl_result_message']) && $response['ssl_result_message']=='DECLINED'){
			               		//When card is decline show message and delete order
								$this->discardOrder($last_id);
								echo json_encode(array('message'=>'This transaction request has not been approved.Try with another form of payment to complete this transaction or contact admin.'));
							}else if(isset($response['ssl_txn_currency_code']) && isset($response['ssl_markup']) && isset($response['ssl_conversion_rate']) && isset($response['ssl_cardholder_amount'])){
			               		//show currency conversion message
								$response['last_id']=$last_id;
								$this->session->set_userdata('conversion',base64_encode(json_encode($response)));
								echo json_encode(array('message'=>'Conversion'));
								exit;
							}else{
			               		 //Place add this message till the complete testing it will save all errors
								$res=$this->saveErroLog($response);
								$this->discardOrder($last_id);
								echo json_encode(array('message'=>'Some error occured! Note the reference # 
									'.$res.' and contact to admin with this reference number.'));
							}
							exit;
						}
					}else{
						echo json_encode(array('message'=>'Error'));
					}
				}else{
					echo json_encode(array('message'=>'Error'));
				}

			}else{
				echo json_encode(array('message'=>'Please Make an order to proceed !'));
			}
		}
	}
}
	//save error log
protected function saveErroLog($response){
	$this->db->insert('tbl_error_log',array('error'=>json_encode($response)));
	return $this->db->insert_id();

}
	//make order
protected function makeOrder($response,$last_id){
	if(isset($response['ssl_txn_id'])){
		$txn_dateTime  = explode(" ",$response['ssl_txn_time']);
		   	//add data into database
		$payData=array(
			'user_id' =>$this->session->userdata('user_data')['pk_user_id'],
			'order_id' =>$last_id,
			'amount' =>floatval($response['ssl_amount']),
			'ssl_txn_id' =>$response['ssl_txn_id'],
			'ssl_txn_date' => $txn_dateTime[0],
			'ssl_txn_time' => $txn_dateTime[1],
			'create_date' => date('Y-m-d H:i:s'),
			'status' => 'AUTH'

			);
		$ress=$this->commonmodel->insert('tbl_payment_info',$payData);
		if($ress){
				//send admin an email to approve
			log_queries('user', 0, 'orders', $last_id);

			$user_id = $this->session->userdata('user_data')['pk_user_id'];
			$email_qurey = $this->commonmodel->getSingleRecord("SELECT `userEmail` FROM `users` WHERE `userId` = ".$user_id."");
			$email= $email_qurey->userEmail;

				// Send order email to client 
				  $this->load->model('Users_orders_model');
				  $data['order'] = $this->Users_orders_model->get_order_detail_by_ordeerid($last_id);
				  $data['order_detail'] = $this->Users_orders_model->get_order_counties($last_id);
				  $this->load->helper('send_mail');
				  $subject="Order Details";
			     _sendMail($email, $subject,  $this->load->view('emails/order_confirmation_email',$data, TRUE));
				 $flyerData=$this->commonmodel->getSingleRecord("SELECT * from user_flyers where uFlyerId='".$this->session->userdata('active_flyer')."'");
				 if($flyerData){
					$data_flyer['image']=$flyerData->flyer_created_image;
					$data_flyer['header']="emails/style1/incs/header";
					$data_flyer['footer']="emails/style1/incs/footer";
					$subject="Order Flyer Copy";
					
				   _sendMail($email, $subject, $this->load->view('emails/style1/flyer',$data_flyer, TRUE));
				    
					///////////// Admin email ///////////////
					$data_flyer_admin['image']=$flyerData->flyer_created_image;
					$data_flyer_admin['header']="emails/style1/incs/header";
					$data_flyer_admin['footer']="emails/style1/incs/footer";
					$data_flyer_admin['order_id']=$last_id;
					$data_flyer_admin['user']=$data['order'];
					$query1 = $this->db->query("select * from tbl_settings where mykey = 'frontend_contactus_email'");
					$frontend_contactus_email = $query1->row();
					$subject_admin="New Order Notification";
				   _sendMail("faisal_developer@yopmail.com", $subject_admin, $this->load->view('emails/admin_order_email',$data_flyer_admin, TRUE));
				}
				

				$this->session->set_userdata('tab_open', 7);
				return true;
			}else{
				return false;
			}


		}
	}
	//discard order
	protected function discardOrder($id){
		//delete the card info and send to tab six
		$this->db->where('daorder_id',$id);
		$this->db->delete(array('tbl_orders','tbl_order_details'));
		$this->session->set_userdata('tab_open', 6);
	}
	//currency conversion make order
	public function placeCurrencyOrder(){
		if(isset($_POST['tag'])){
			$currency=json_decode(base64_decode($this->session->conversion));
			 // echo "<pre>";
 		     // print_r($currency);
 		     // exit;
			//process the payment card
			$this->load->library('convergeapi');
			$response = $this->convergeapi->ccauthonly(array('ID'=>$currency->id,'dccoption' =>'Y'));
			// print_r($response);
			if(isset($response['errorMessage'])){
               	//When card is decline show message and delete order
				$this->discardOrder($currency->last_id);
				if($response['errorCode']==5000){
					echo json_encode(array('message'=>'The credit card number supplied is invalid.'));	
				}else{
					echo json_encode(array('message'=>$response['errorMessage']));	
				}
				exit;
			}else{
               	//Place add this message till the complete testing it will save all errors
				$res=$this->saveErroLog($response);
				$this->discardOrder($currency->last_id);
				echo json_encode(array('message'=>'Some error occured! Note the reference # 
					'.$res.' and contact to admin with this reference number.'));	
               	 	//echo "<pre>";
 					//print_r($response);
			}
		}
	}
	/*
    * Check if billing and payment info are done than proceed else ask for filling these two options
	*/
	public function checkInfobefore(){
		if(isset($_POST['send_info'])){
			error_reporting(0);
			$this->session->unset_userdata('tab_refrer');
			$this->session->unset_userdata('active_flyer');
			$this->session->unset_userdata('admin_flyer');
			$this->session->unset_userdata('user_order');
			$this->session->unset_userdata('conversion');
			$this->session->set_userdata('tab_open', 1);
			$this->db->where(array('userId'=>$this->session->userdata('user_data')['pk_user_id'],'order_id'=>'-111'));
			$this->db->delete('admi_coupons_used');
			echo json_encode(array('message'=>'Success'));	   
		}
	}
	public function get_fonts()
	{
		$this->db->select('fontId, fontTitle')->from('admin_fonts')->order_by('fontTitle', 'asc')->group_by('fontTitle');
		$query = $this->db->get();
		echo json_encode($query->result());
	}

	public function upload_flyer_images()
	{
/*
    	  // ob_start();
        $this->load->helper('file');

// Upload data can be POST'ed as raw form data or uploaded via <iframe> and <form>
// using regular multipart/form-data enctype (which is handled by PHP $_FILES).
        if (!empty($_FILES['image_file']) and is_uploaded_file($_FILES['image_file']['tmp_name'])) {
  // Regular multipart/form-data upload.
          $name = $_FILES['image_file']['name'];
  // move_uploaded_file($name, '/'.$name);
          $data = file_get_contents($_FILES['image_file']['tmp_name']);
      } else {
  // Raw POST data.
          $name = urldecode(@$_SERVER['HTTP_X_FILE_NAME']);
          $data = file_get_contents("php://input");
          // file_put_contents($name, $data);

      }
      $new_name = time().$name;
      if(!write_file('./public/upload/flyers/user_assets/'.$new_name, $data))
        { json_encode(array('message'=>'error')); }
    else 
        {
            $arrayName = array('url' => base_url('/public/upload/flyers/user_assets/'.$new_name), 'name'=> $new_name, 'message'=>'success');
            echo json_encode($arrayName);
        }
*/

        $base64 = htmlspecialchars_decode($this->input->post('image_file'));
        $splited = explode(',', substr( $base64 , 5 ) , 2);
        $mime=$splited[0];
        $data=base64_decode($splited[1]);
        // write_file('./public/upload/flyers/user_assets/'.$output_file_without_extentnion.'_image.json', $splited[1]);

        $mime_split_without_base64=explode(';', $mime,2);
        $mime_split=explode('/', $mime_split_without_base64[0],2);
        if(count($mime_split)==2)
        {
        	$extension=$mime_split[1];
        	if($extension=='jpeg')$extension='jpg';
        	$output_file_with_extentnion=time().'.'.$extension;
        }
        else echo 'problem with json'; 

        if(!write_file('./public/upload/flyers/user_assets/'.$output_file_with_extentnion, $data))
        	{ json_encode(array('message'=>'error')); }
        else 
        {
        	$arrayName = array('url' => base_url('/public/upload/flyers/user_assets/'.$output_file_with_extentnion), 'name'=> $output_file_with_extentnion, 'message'=>'success');
        	echo json_encode($arrayName);
        }

        exit(0);
    }

    public function delete_file()
    {
    	if($this->input->post('filename'))
    	{
    		$file = './public/upload/flyers/user_assets/'.$this->input->post('filename');
    		if(file_exists($file)) if(unlink($file)) echo 'done';
    		
    	}
    }	
}
?>