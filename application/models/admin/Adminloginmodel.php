<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminloginmodel extends CI_Model
{
    /**
	 * This is the constructor of a Model
	 */
	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}
	/**
	 * will check if userneme n pass match
	 *
	 * @param string $username
	 * @param string $password
	 * @return Boolean true in case of exists else return false
	 */
	public function veifyuser($username, $password){
		  $queryStr = "SELECT admin_id, admin_username, admin_type, admin_status from tbl_admin WHERE admin_username= '".$username."' AND admin_password='".$password."'";			             
		   $queryRS  = $this->db->query($queryStr); 
		   if($queryRS->num_rows() > 0){
			   return $queryRS->row();
		   }else{
		       return ''; 
		   }
	}
	/**
	 * will get all the admin info
	 *
	 */
	public function getAdminInfo(){
		   $queryStr = "SELECT admin_id, admin_username, admin_type, admin_status from tbl_admin WHERE pk_admin_id = 1";			             
		   $queryRS  = $this->db->query($queryStr); 
		   if($queryRS->num_rows() > 0){
			   return $queryRS->row();
		   }else{
		       return ''; 
		   }
	}
    function total_rows($q = NULL) {
        $this->db->from('tbl_orders');
        $this->db->join('user_flyers uf','uf.uFlyerId=tbl_orders.daorder_flyer_id');
        return $this->db->count_all_results();
    }
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->select('tbl_orders.*,uf.uFlyerTitle as flyer_title,uf.flyer_created_image as flyer_image,uf.flyerId as uf_flyer_id');
        $this->db->join('user_flyers uf','uf.uFlyerId=tbl_orders.daorder_flyer_id');
        $this->db->order_by('daorder_id', 'DESC');
        $this->db->limit($limit, $start);


        return $this->db->get('tbl_orders')->result();

    }
    function get_by_id($id)
    {
        $this->db->select('tbl_orders.*,uf.uFlyerTitle as flyer_title,uf.flyer_created_image as flyer_image,uf.flyerId as uf_flyer_id');
        $this->db->join('user_flyers uf','uf.uFlyerId=tbl_orders.daorder_flyer_id');
        $this->db->where('tbl_orders.daorder_id', $id);
        return $this->db->get('tbl_orders')->row();
    }
    // these below function are used for tbl_email_tracking
    function email_tracking_total_rows($q = NULL,$id) {
        $this->db->where('tbl_email_tracking.order_id', $id);
        $this->db->from('tbl_email_tracking');
        return $this->db->count_all_results();
    }
    function email_tracking_get_limit_data($limit, $start = 0, $q = NULL,$id) {
        $this->db->where('tbl_email_tracking.order_id', $id);
        $this->db->order_by('order_id', 'DESC');
        $this->db->limit($limit, $start);
        return $this->db->get('tbl_email_tracking')->result();

    }
    function email_tracking_get_by_id($id)
    {
        $this->db->where('tbl_email_tracking.order_id', $id);
        return $this->db->get('tbl_email_tracking')->row();
    }

}
