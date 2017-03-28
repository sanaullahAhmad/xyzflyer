<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SearchModel extends CI_Model
{
    
	function __construct() {
	
		parent::__construct();
	}

	public function serachByFilter($value){
		$this->db->select("*");
		if($value){
			$this->db->where("userEmail LIKE '%$value%' || userId LIKE '%$value%' || userFirstName LIKE '%$value%' || userLastName LIKE '%$value%' || userEmail LIKE '%$value%'");
			
		}
		$query=$this->db->get('users');
		$result=$query->result();
		//print_r($this->db->last_query());exit;
		return $result;
	}
	
	public function detailsearch($values){
		
	  $this->db->select("*");
		if($values){
			foreach($values as $arr){
				foreach($arr as $name=>$value){
				$this->db->where($name  , $value);
				}
			}
		}
		$query=$this->db->get('users');
		$result=$query->result();
		/*echo "<pre>";
		print_r($result);exit;*/
		return $result;
	}
	public function getOrders($id){
		//print_r($values);exit;
		$this->db->select("uFlyerId,flyer_created_image as userFlyer,daorder_id as order_id,
                daorder_flyer_id as flyer_id,
                daorder_price as price,
				daorder_grand_total as grand_total,
                daorder_coupen_discount as discount,
                daorder_coupon_type as coupen_type,
                daorder_total_emails as total_agents,
                daorder_date as order_date,
                daorder_status as status,
                daorder_rejection_reason as reject_reason,
                daorder_modified_date as modified_date,
                daorder_modified_by as modified_by,
                daoder_admin_id as admin_id,
				status as payment_status,
				amount as amount,
				create_date	as pay_date
				");
		
		$this->db->from('tbl_orders');
		$this->db->join('user_flyers','user_flyers.uFlyerId=tbl_orders.daorder_flyer_id');
		$this->db->join('tbl_payment_info','tbl_payment_info.order_id=tbl_orders.daorder_id');
		$this->db->or_where('daorder_user_id',$id);
		//$this->db->join('tbl_orders','tbl_orders.daorder_user_id=users.userId');
		//$this->db->group_by('users.userId'); 
		//$this->db->join('users_activity','users_activity.daorder_user_id=users.userId');
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}
	
	function emails_stats($order_id){
		$this->db->select('count(order_id) as opens');
		$this->db->from('tbl_email_tracking');
		$this->db->or_where('order_id',$order_id);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
		
	}
	

}
