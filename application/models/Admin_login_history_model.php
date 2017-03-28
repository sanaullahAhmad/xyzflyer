<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_login_history_model extends CI_Model
{

    public $table = 'admin_login_history';
    public $id = 'histoy_id';
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

    function get_all_by_admin($admin_id){
        $this->db->order_by($this->id, $this->order);
        $this->db->where('admin_id', $admin_id);
        return $this->db->get($this->table)->result();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('histoy_id', $q);
	$this->db->or_like('history_ip', $q);
	$this->db->or_like('history_browser_info', $q);
	$this->db->or_like('history_referer', $q);
	$this->db->or_like('history_date', $q);
	$this->db->or_like('admin_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('histoy_id', $q);
	$this->db->or_like('history_ip', $q);
	$this->db->or_like('history_browser_info', $q);
	$this->db->or_like('history_referer', $q);
	$this->db->or_like('history_date', $q);
	$this->db->or_like('admin_id', $q);
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

}

/* End of file Admin_login_history_model.php */
/* Location: ./application/models/Admin_login_history_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-06 02:08:22 */
/* http://harviacode.com */