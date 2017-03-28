<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_management_model extends CI_Model
{

    public $table = 'campaign_emails';
    public $id = 'emailId';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
	
	 function get_limit_data($limit, $start = 0){
	   $this->db->select('*');
       $this->db->order_by($this->id, $this->order);
	   $this->db->limit($limit, $start);
       return $this->db->get($this->table)->result();
	  
    }
	
	 function total_rows($q = NULL) {
    $this->db->like('emailId', $q);
	$this->db->or_like('Agency_Name', $q);
	$this->db->or_like('Full_Name', $q);
	$this->db->or_like('email_address', $q);
	$this->db->or_like('StateName', $q);
	$this->db->or_like('County', $q);
	$this->db->or_like('City', $q);
	$this->db->from($this->table);
   
        return $this->db->count_all_results();
    }
	
	 function insert_email($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
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
	
  
    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $result=$this->db->delete($this->table);
        if($result){
			return true;
        }
    }
		//////////////////////// Subscription List .///////////////////
		
	function all_rows($q = NULL) {
			$this->db->like('subId', $q);
			$this->db->or_like('subFirstName', $q);
			$this->db->or_like('subLastName', $q);
			$this->db->or_like('subEmail', $q);
			$this->db->or_like('subCountry', $q);
			$this->db->or_like('county', $q);
			$this->db->or_like('subStatus', $q);
			$this->db->from('tbl_subscriber');
   
        return $this->db->count_all_results();
    }
	
	function get_subscriber_data($limit, $start = 0, $q = NULL){
	  			$this->db->order_by('subId', $this->order);
			$this->db->like('subId', $q);
			$this->db->or_like('subFirstName', $q);
			$this->db->or_like('subLastName', $q);
			$this->db->or_like('subEmail', $q);
			$this->db->or_like('subCountry', $q);
			$this->db->or_like('county', $q);
			$this->db->or_like('subStatus', $q);
			$this->db->limit($limit, $start);
			return $this->db->get('tbl_subscriber')->result();
    }	
    
	function get_unsubscriber_data($limit, $start = 0, $q = NULL){
	  		$this->db->order_by('subId', $this->order);
			// $this->db->like('subFirstName', $q);
			/*$this->db->or_like('subFirstName', $q);
			$this->db->or_like('subLastName', $q);
			$this->db->or_like('subEmail', $q);
			$this->db->or_like('subCountry', $q);
			$this->db->or_like('county', $q);
			$this->db->or_like('subStatus', $q);*/
	  		// $this->db->where('subStatus', 0);
			$this->db->limit($limit, $start);
			return $this->db->get('tbl_unsubscriber')->result();
    }
}
