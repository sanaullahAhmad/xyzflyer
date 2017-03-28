<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flyer_tags_model extends CI_Model
{

    public $table = 'tbl_flyer_tags';
    public $id = 'pk_flyer_tags';
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
        $this->db->from($this->table);
        $this->db->join('tbl_admin', 'tbl_admin.admin_id = tbl_flyer_tags.admin_id');
        return $this->db->get()->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('pk_flyer_tags', $q);
	$this->db->or_like('flyer_tags_title', $q);
	$this->db->or_like('flyer_tags_status', $q);
	$this->db->or_like('flyer_tags_date', $q);
	$this->db->or_like('admin_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('pk_flyer_tags', $q);
	$this->db->or_like('flyer_tags_title', $q);
	$this->db->or_like('flyer_tags_status', $q);
	$this->db->or_like('flyer_tags_date', $q);
	// $this->db->or_like('admin_id', $q);
	$this->db->limit($limit, $start);
    $this->db->from($this->table);
    $this->db->join('tbl_admin','tbl_admin.admin_id = tbl_flyer_tags.admin_id');
        return $this->db->get()->result();
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

/* End of file Flyer_tags_model.php */
/* Location: ./application/models/Flyer_tags_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-17 12:36:34 */
/* http://harviacode.com */