<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mobile_model extends CI_Model
{

    public $table = 'mobile_sessions';
    public $id = 'id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }

    function get_by_admin_id($admin_id){
        $this->db->where(['admin_id' => $admin_id]);
        return $this->db->get($this->table)->row();
    }

    function get_by_admin_id_and_token($admin_id, $token){
        $this->db->where(['admin_id' => $admin_id, 'token' => $token]);
        return $this->db->get($this->table)->row();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // delete data
    function delete_by_admin_id($admin_id)
    {
        $this->db->where('admin_id', $admin_id);
        $this->db->delete($this->table);
    }



}
