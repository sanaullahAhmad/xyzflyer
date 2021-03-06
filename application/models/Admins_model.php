<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admins_model extends CI_Model
{

    public $table = 'tbl_admin';
    public $id = 'admin_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all($type=NULL)
    {
        if($type){
            if($type==00) $type=0;
                $this->db->where('admin_type',$type);
        }
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function list_all_by_status($status = '')
    {

        // var_dump($status);
        // die('<br>status');
        if($status != ""){
            $this->db->where('admin_status',$status);
            $this->db->order_by($this->id, $this->order);
            return $this->db->get($this->table)->result();
        }else{
            return NULL;
        }
    }

    function get_all_admins()
    {
        $this->db->select('admin_id, admin_username');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_username_pass($username, $pass){
        $this->db->where(['admin_username' => $username, 'admin_password' => $pass]);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('admin_id', $q);
    	$this->db->or_like('admin_username', $q);
    	$this->db->or_like('admin_password', $q);
    	$this->db->or_like('admin_email', $q);
    	$this->db->or_like('admin_date', $q);
    	$this->db->or_like('admin_type', $q);
    	$this->db->or_like('admin_status', $q);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('admin_id', $q);
    	$this->db->or_like('admin_username', $q);
    	$this->db->or_like('admin_password', $q);
    	$this->db->or_like('admin_email', $q);
    	$this->db->or_like('admin_date', $q);
    	$this->db->or_like('admin_type', $q);
    	$this->db->or_like('admin_status', $q);
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

    function get_sales_by_region(){
        return $this->db->query("select users.state, count(users.state) as total_orders from users INNER JOIN tbl_orders ON users.userId = tbl_orders.daorder_user_id where tbl_orders.daorder_status = 1 group by users.state ORDER BY total_orders desc limit 5");
    }

    function get_sales_by_region_county($state){
        return $this->db->query("select users.county, count(users.county) as total_orders from users INNER JOIN tbl_orders ON users.userId = tbl_orders.daorder_user_id where tbl_orders.daorder_status = 1 AND users.state = '". $state ."' group by users.county ORDER BY total_orders desc limit 5");
    }

    function get_recent_users_data(){
    return $this->db->query('SELECT usr.userProfilePicture, usr.userId, usr.userFirstName, usr.userLastName, usr.state, usr.county,sum(ord.daorder_price)  as sales, sum(ord.daorder_total_emails) as sent, "123" as "last_active"
            from users usr
            JOIN tbl_orders ord on usr.userId=ord.daorder_user_id
            WHERE ord.daorder_status=1
            Group BY usr.userId ORDER by ord.daorder_date  limit 3')->result();
    }

}

/* End of file Admins_model.php */
/* Location: ./application/models/Admins_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-05 19:02:43 */
/* http://harviacode.com */