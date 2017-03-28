<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
     /*
     @ Admin permission of Access
     @ Use Full for hidding complete page or menu
     @ Read for detail
     @ Reset adn edit are same
     @ Developed by Saeed mehsoud  Pakipreneurs
     @ Auto load the helper from config autolod
     */
	function xyzAccesscontrol($control=NULL,$action=NULL){
		$CI =& get_instance();
		$CI->load->model('frontend/commonmodel','cm');
		//Check the user session
		if (!$CI->session->userdata('admin_data')) {
			//validate
			redirect(base_url('_backoffice/login'));
			exit;
		} else {
            $admin_data=$CI->session->userdata('admin_data');
			if ($admin_data['pk_my_status'] == '0') {
				redirect(base_url('account_closed'));
				exit;
			} 
		}
		//Access Control Permission
		$type=$CI->session->userdata('admin_data')['pk_my_type'];
		/*$permission = array(
			//super admin
			0=>array(
				'admin_managment'=>array('Full','Read','Add','Edit','Delete','Excel','Word','ViewLog','Report','Status','Reset'),
				'user_managment'=>array('Full','Read','Add','Edit','Delete','Excel','Word','ViewLog','Report','Status','Reset'),
				'page_managment'=>array('Full','Read','Add','Edit','Delete','status'),//status enable/disable
				'flyer_managment'=>array('Full', 'User_flyers', 'Tags','Read','Add','Edit','Delete','Excel','Word','ViewLog','Report', 'Logs'),
				'flyer_tag'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'user_flyer'=>array('Full','Read','Delete'),
				'coupen_managment'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'flyer_shapes'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'flyer_sizes'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'flyer_fonts'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'flyer_tags'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'order_managment'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'activity_managment'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'email_management'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'reports_management' => array('Full', 'Orders', 'Emails')
			),
			//Templates Designer
			1=>array(
				'admin_managment'=>array(),
				'user_managment'=>array(),
				'page_managment'=>array(),//status enable/disable
				'flyer_managment'=>array('Full','Read','Add','Edit','Excel','Word','Report'),
				'flyer_tag'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'user_flyer'=>array(),
				'coupen_managment'=>array(),
				'flyer_shapes'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'flyer_sizes'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'flyer_fonts'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'flyer_tags'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'order_managment'=>array(),
				'activity_managment'=>array(),
				'email_management'=>array(),
				'reports_management' => array()
			),
			//Accounts Manager
			2=>array(
				'admin_managment'=>array(),
				'user_managment'=>array('Full','Read','Add','Edit','Excel','Word','Report'),
				'page_managment'=>array(),//status enable/disable
				'flyer_managment'=>array(),
				'flyer_tag'=>array(),
				'user_flyer'=>array('Full','Read','Delete'),
				'coupen_managment'=>array(),
				'flyer_shapes'=>array(),
				'flyer_sizes'=>array(),
				'flyer_fonts'=>array(),
				'flyer_tags'=>array(),
				'order_managment'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'activity_managment'=>array(),
				'email_management'=>array(),
				'reports_management' => array('Full', 'Orders', 'Emails')
			),
			//Sales & Orders Manager
			3=>array(
				'admin_managment'=>array(),
				'user_managment'=>array('Full','Read','Add','Edit','Excel','Word','Report'),
				'page_managment'=>array(),//status enable/disable
				'flyer_managment'=>array(),
				'flyer_tag'=>array(),
				'user_flyer'=>array('Full','Read','Delete'),
				'coupen_managment'=>array(),
				'flyer_shapes'=>array(),
				'flyer_sizes'=>array(),
				'flyer_fonts'=>array(),
				'flyer_tags'=>array(),
				'order_managment'=>array('Full','Read','Add','Edit','Delete','Excel','Word'),
				'activity_managment'=>array(),
				'email_management'=>array(),
				'reports_management' => array('Full', 'Orders', 'Emails')
			)
		);*/
		//exit;
        $users=array(0=>'Super Admin',1=>'Templates Designer',2=>'Accounts Manager',3=>'Sales/Orders Manager');
        foreach($users as $key => $user){
            $perms=array();
            $permission[$key] = array();
            $perms=$CI->cm->getMultipleRecords("SELECT * FROM tbl_permission_value  WHERE utype=".$key."");
            if($perms){
	            foreach($perms as $val){
	                if($val['permFull']=='Full'){
	                   $result[$val['perm_tab']][]=$val['permFull'];
	                }
	                if($val['permRead']=='Read'){
	                  $result[$val['perm_tab']][]=$val['permRead'];
	                }
	                if($val['permAdd']=='Add'){
	                  $result[$val['perm_tab']][]=$val['permAdd'];
	                }
	                if($val['permEdit']=='Edit'){
	                  $result[$val['perm_tab']][]=$val['permEdit'];
	                }
	                if($val['permDelete']=='Delete'){
	                  $result[$val['perm_tab']][]=$val['permDelete'];
	                }
	                if($val['permExcel']=='Excel'){
	                  $result[$val['perm_tab']][]=$val['permExcel'];
	                }
	                if($val['permWord']=='Word'){
	                  $result[$val['perm_tab']][]=$val['permWord'];
	                }
	                if($val['permViewLog']=='ViewLog'){
	                  $result[$val['perm_tab']][]=$val['permViewLog'];
	                }
	                if($val['permReports']=='Reports'){
	                  $result[$val['perm_tab']][]=$val['permReports'];
	                }
	                if($val['permStatus']=='Status'){
	                  $result[$val['perm_tab']][]=$val['permStatus'];
	                }
	            }
	            $permission[$key]=$result;
	            $result=array();
	        }

        }
     /*   echo '<pre>';
        print_r($permission);
        exit;*/

		/*print_r($permission);
		exit;*/
		if(array_key_exists($type,$permission)){
			if(array_key_exists($control,$permission[$type])){
				if(in_array($action,$permission[$type][$control])){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	function checkselected($tab=NULL,$user=NULL,$control=NULL){
		$CI =& get_instance();
		$data=$CI->commonmodel->getSingleRecord("SELECT ".$control." from tbl_permission_value where perm_tab='".$tab."' AND utype=".$user."");
		if($data)
		{ 
		 if($data->$control!=""){
		 	echo "checked='checked' style='background-color:green;' ";
		 }else{
		 	echo "";
		 }	
		}else{
			echo "";
		}

	}
?>