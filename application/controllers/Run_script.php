<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
* New Custom Script
*/
class Run_script extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		echo 'Please contact admin to process this page.';
		exit;
		$this->load->model(array('admin/flyersmodel','frontend/commonmodel'));
	}
	public function index(){
		$result = $this->commonmodel->getMultipleRecords("SELECT * from tbl_flyer_detail");
		if(is_array($result)){
			foreach($result as $val){
				if(file_exists('public/upload/flyer_images/thumb_'.$val['flyer_image'])){
				unlink('./public/upload/flyer_images/thumb_'.$val['flyer_image'].'');
				echo '<img src="'.base_url()."public/upload/flyer_images/thumb_".$val['flyer_image'].'"  style="padding:10px;" width="100" height="150"/> thumb';
				}
				if(!empty($val['flyer_image']) && file_exists('public/upload/flyer_images/'.$val['flyer_image'])){
				echo '<img src="'.base_url()."public/upload/flyer_images/".$val['flyer_image'].'"  style="padding:10px;" width="100" height="150"/><br/>';
				    $this->create_thumb($val['flyer_image']);
			    }	
			}

		}
	}
	protected function create_thumb($flyer){
		//echo $flyer;
        $config=array();
		$config['image_library'] = 'gd2';
		$config['source_image'] = './public/upload/flyer_images/'.$flyer;
		$config['new_image'] = './public/upload/flyer_images/thumb_'.$flyer;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = 200;
		$config['height'] = 240;
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		//$this->load->library('image_lib', $config);	
		if (!$this->image_lib->resize()){
			$error2 = array('error' =>  $this->image_lib->display_errors());
			echo '<div class="alert alert-danger">'.$error2['error'].'</div>';
		}
		else{
			//seccess
			 $this->image_lib->clear();
		}

	}
}