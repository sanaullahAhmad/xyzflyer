<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscriber_history_model extends CI_Model
{

    public $table = 'subscriber_login_history';
    public $id = 'histoy_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all\
    function get_all($limit = 9)
    {
        if($limit !== 9 ){
            $this->db->limit(9);
        }

        $this->db->order_by($this->id, $this->order);
		$this->db->join('tbl_subscriber','tbl_subscriber.subId = subscriber_login_history.subscriber_id','left');
        return $this->db->get($this->table)->result();
		
    }
	
	 function get_record($id)
    {
        $this->db->where('subId', $id);
       return $this->db->get('tbl_subscriber')->row();
    
	}
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_all_by_user($user_id){
        $this->db->order_by($this->id, $this->order);
        $this->db->where('user_id', $user_id);
        return $this->db->get($this->table)->result();
    }

    function get_by_filter($activity_type, $user_id=NULL){
        $this->db->order_by($this->id, $this->order);
        if($user_id!== NULL){
            $this->db->where('user_id', $user_id);
        }
        if($activity_type!== NULL){
            $this->db->where('activity_type', $activity_type);
        }
        return $this->db->get($this->table)->result();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('activity_id', $q);
    	$this->db->or_like('action_type', $q);
    	$this->db->or_like('activity_text', $q);
    	$this->db->or_like('activity_date', $q);
    	$this->db->or_like('user_id', $q);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('activity_id', $q);
    	$this->db->or_like('action_type', $q);
    	$this->db->or_like('activity_text', $q);
    	$this->db->or_like('activity_date', $q);
    	$this->db->or_like('user_id', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
	
	///////////////////////////////////////////////////// NewsLetter funtions /////////////////////
	
	function newsletter_get_all($limit = 9)
	{
		if($limit !== 9 ){
			$this->db->limit(9);
		}

		$this->db->order_by('id', $this->order);
		 return $this->db->get('tbl_newsletter_subs')->result();
		
	}
	
	function newsletter_get_by_id($id){
		  $this->db->where('id', $id);
        return $this->db->get('tbl_newsletter_subs')->row();
		
	}
	
	function delete_newsletter_subscriber($id){
		$this->db->where('id', $id);
        $this->db->delete('tbl_newsletter_subs');
		
	}

}

/* End of file Users_activity_model.php */
/* Location: ./application/models/Users_activity_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-16 18:02:55 */
/* http://harviacode.com */