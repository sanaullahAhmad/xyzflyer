<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_orders_model extends CI_Model
{

    public $table = 'tbl_orders';
    public $id = 'daorder_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
	
	function get_order_counties($order_id){
		 $this->db->select('daorder_agents,daorder_state,daorder_countyFips');
		 $this->db->where('daorder_id',$order_id);
		 return $this->db->get('tbl_order_details')->result();
	}
    //get order ,flyer and user data combine
    function get_flyer_order_user_by_ordeerid($id)
    {
        $this->db->select(
               'uf.uFlyerTitle as flyer_title,
                uf.flyer_created_image as image,
                uf.propertyAddress as propertyAddress,
                uf.agentAddress as agentAddress,
                (select GROUP_CONCAT(distinct daorder_state) from tbl_order_details where daorder_id=ot.daorder_id) as states,
                ot.daorder_id as order_id,
                ot.daorder_flyer_id as flyer_id,
                ot.daorder_price as price,
                ot.daorder_coupen_discount as discount,
                ot.daorder_coupon_type as coupen_type,
                ot.daorder_total_emails as total_agents,
                ot.daorder_date as order_date,
                ot.daorder_status as status,
                ot.daorder_rejection_reason as reject_reason,
                ot.daorder_modified_date as modified_date,
                ot.daorder_modified_by as modified_by,
                ot.daoder_admin_id as admin_id,
                usr.userId as user_id,
                usr.userFirstName as FirstName,
                usr.userLastName as  LastName'
            );
        $this->db->from('user_flyers uf');
        $this->db->where(array('ot.daorder_id'=>$id));
        $this->db->join('tbl_orders ot','uf.uFlyerId=ot.daorder_flyer_id');
        $this->db->join('users usr','uf.userId=usr.userId');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->row();

    }
    function get_all_by_user($user_id){
        $this->db->order_by($this->id, $this->order);
        $this->db->where('user_id', $user_id);
        return $this->db->get($this->table)->result();
    }
    public $state_list = array(
        'AL' => "Alabama",
        'AK' => "Alaska",
        'AZ' => "Arizona",
        'AR' => "Arkansas",
        'CA' => "California",
        'CO' => "Colorado",
        'CT' => "Connecticut",
        'DE' => "Delaware",
        'DC' => "District Of Columbia",
        'FL' => "Florida",
        'GA' => "Georgia",
        'HI' => "Hawaii",
        'ID' => "Idaho",
        'IL' => "Illinois",
        'IN' => "Indiana",
        'IA' => "Iowa",
        'KS' => "Kansas",
        'KY' => "Kentucky",
        'LS' => "Louisiana",
        'ME' => "Maine",
        'MD' => "Maryland",
        'MA' => "Massachusetts",
        'MI' => "Michigan",
        'MN' => "Minnesota",
        'MS' => "Mississippi",
        'MO' => "Missouri",
        'MT' => "Montana",
        'NE' => "Nebraska",
        'NV' => "Nevada",
        'NH' => "New Hampshire",
        'NJ' => "New Jersey",
        'NM' => "New Mexico",
        'NY' => "New York",
        'NC' => "North Carolina",
        'ND' => "North Dakota",
        'OH' => "Ohio",
        'OK' => "Oklahoma",
        'OR' => "Oregon",
        'PA' => "Pennsylvania",
        'RI' => "Rhode Island",
        'SC' => "South Carolina",
        'SD' => "South Dakota",
        'TN' => "Tennessee",
        'TX' => "Texas",
        'UT' => "Utah",
        'VT' => "Vermont",
        'VA' => "Virginia",
        'WA' => "Washington",
        'WV' => "West Virginia",
        'WI' => "Wisconsin",
        'WY' => "Wyoming",
    );

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
                create_date as pay_date
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
    public function get_user_by_id($id='')
    {
        $this->db->select("*");
        $this->db->where('userId', $id);
        $query=$this->db->get('users');
        $result=$query->row();
        return $result;
    }
   
    function get_pending_orders(){
        $res = $this->db->query('SELECT count(daorder_id) as pending FROM tbl_orders where daorder_status = 0');
        return $res->row();
    }
	
	function get_sorted_orders($limit, $start = 0, $q = NULL){
        $this->db->select('tbl_orders.*,uf.uFlyerTitle as flyer_title,uf.flyer_created_image as flyer_image');
        $this->db->join('user_flyers uf','uf.uFlyerId=tbl_orders.daorder_flyer_id');
        $this->db->order_by($this->id, $this->order); 
		$this->db->where('daorder_status', $q);
		
		$this->db->limit($limit, $start);

       return $this->db->get($this->table)->result();
    }

    function get_rejected_orders(){
        $res = $this->db->query("SELECT count(daorder_id) as rejected FROM tbl_orders where daorder_status = 2");
        return $res->row();
    }

    function get_approved_orders(){
        $res = $this->db->query("SELECT count(daorder_id) as approved FROM tbl_orders where daorder_status = 1");
        return $res->row();
    }

    function get_total_sales(){
        ////@todo: get total sales with packages number
        $res = $this->db->query("SELECT sum(daorder_price) as sales FROM `tbl_orders` WHERE daorder_status = 1");
        return $res->row();

    }

    function get_total_tractions(){
        //todo: get original transactiosn if problem, mainly trasaction mean that paid by users.
        $res = $this->db->query("SELECT count(daorder_id) as transactions FROM `tbl_orders` WHERE daorder_status = 1");
        return $res->row();
    }

    function get_total_failed(){
        $res = $this->db->query("SELECT count(daorder_id) as failed FROM tbl_orders where daorder_status = -1");
        return $res->row();

    }

    // get total rows
    function total_rows($q = NULL) {
    $this->db->like('daorder_id', $q);
	$this->db->or_like('daorder_flyer_id', $q);
	//$this->db->or_like('daorder_user_flyer_id', $q);
	$this->db->or_like('daorder_price', $q);
	$this->db->or_like('daorder_date', $q);
	$this->db->or_like('daorder_status', $q);
	$this->db->or_like('daorder_rejection_reason', $q);
	$this->db->or_like('daorder_user_id', $q);
	$this->db->or_like('daoder_admin_id', $q);
	$this->db->or_like('daorder_modified_date', $q);
	$this->db->or_like('daorder_modified_by', $q);
	$this->db->from($this->table);
    $this->db->join('user_flyers uf','uf.uFlyerId=tbl_orders.daorder_flyer_id');
        return $this->db->count_all_results();
    }

    public function get_limit_records($start = NULL, $limit = NULL)
    {
        $this->db->select('tbl_orders.*,uf.uFlyerTitle as flyer_title,uf.flyer_created_image as flyer_image');
        $this->db->join('user_flyers uf','uf.uFlyerId=tbl_orders.daorder_flyer_id');
        $this->db->order_by($this->id, $this->order); 
        
        $this->db->limit( $start, $limit);

        return $this->db->get($this->table)->result();
    }
    function total_rows_sort($q = NULL){
     $this->db->like('daorder_status', $q); 
     $this->db->from($this->table);
     $this->db->join('user_flyers uf','uf.uFlyerId=tbl_orders.daorder_flyer_id');
        return $this->db->count_all_results();  
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
		$this->db->select('tbl_orders.*,uf.uFlyerTitle as flyer_title,uf.flyer_created_image as flyer_image');
        $this->db->join('user_flyers uf','uf.uFlyerId=tbl_orders.daorder_flyer_id');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('daorder_id', $q);
		$this->db->or_like('daorder_flyer_id', $q);
		//$this->db->or_like('daorder_user_flyer_id', $q);
		$this->db->or_like('daorder_price', $q);
		$this->db->or_like('daorder_date', $q);
		$this->db->or_like('daorder_status', $q);
		$this->db->or_like('daorder_rejection_reason', $q);
		$this->db->or_like('daorder_user_id', $q);
		$this->db->or_like('daoder_admin_id', $q);
		$this->db->or_like('daorder_modified_date', $q);
		$this->db->or_like('daorder_modified_by', $q);
		$this->db->limit($limit, $start);
       

       return $this->db->get($this->table)->result();
	  
    }
    // delete data
    function delete($id)
    {
        $this->db->where('daorder_id', $id);
        $result=$this->db->delete($this->table);
        if($result){
            $this->db->where('daorder_id', $id);
            $result1=$this->db->delete('tbl_order_details');
            if($result1){
                 $this->db->where('order_id', $id);
                 $this->db->delete(array('tbl_payment_info','admi_coupons_used'));

            }  
         return true;
        }
    }

}

/* End of file Admin_orders_model.php */
/* Location: ./application/models/Admin_orders_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-02 15:47:29 */
/* http://harviacode.com */