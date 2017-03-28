<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function get_slider_aboutus(){
		$CI = get_instance();
		$CI->load->model('Frontend_settings_model');
		$data=$CI->Frontend_settings_model->get_single_image();
		return $data;
	}

	function get_slider_works(){
		$CI = get_instance();
		$CI->load->model('Frontend_settings_model');
		$data=$CI->Frontend_settings_model->get_how_it_works();
		return $data;
	}
	
	function get_county($county){
		$CI = get_instance();
		$CI->load->model('Users_orders_model');
		$data=$CI->Users_orders_model->get_county($county);
		if($data){
			return $data->County;
		}else{
			return $county;
		}
		
	}
	
	function get_emails_stats($order_id){
		$CI = get_instance();
		$CI->load->model('admin/SearchModel');
		$data=$CI->SearchModel->emails_stats($order_id);
		if($data){
			return $data{0}->opens;
		}else{
			return false;
		}
		
	}
	
?>