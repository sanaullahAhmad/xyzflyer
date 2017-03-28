<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_newsletter_model extends CI_Model
{

    public $table = 'tbl_newsletter_subs';
    public $id = 'id';
    public $order = 'DESC';
   
    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
        $this->load->library('form_validation');
    }
	
	function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
		$this->db->like('id', $q);
        $this->db->or_like('email', $q);
    	$this->db->or_like('verification_status', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
	
	function total_rows($q = NULL) {
        $this->db->like('id', $q);
    	$this->db->or_like('email', $q);
    	$this->db->or_like('verification_status', $q);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }
	
	  function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
	
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
		return $this->db->insert_id();
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
	
	 function get_record($email)
    {
        $this->db->where('subEmail', $email);
       return $this->db->get($this->table)->row();
    
	}
	
	
	 function newsletter_record($email)
    {
        $this->db->where('email', $email);
       return $this->db->get('tbl_newsletter_subs')->row();
    
	}
	 
	function insert_newsletter($data){
		$this->db->insert('tbl_newsletter_subs', $data);
		return $this->db->insert_id();
	}
	
	 // update data
    function update_newsletter($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_newsletter_subs', $data);
    }
}
