<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
    public $id = 'userId';
    public $order = 'DESC';
    /*public $status = 'userStatus';
*/
    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
        $this->load->library('form_validation');
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_users()
    {
        $this->db->select('userId, username, userFirstName, userLastName');
        $this->db->order_by('userFirstName', $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_email($email, $pass=""){

        if($pass!== ""){
            $this->db->where(['userEmail' => $email, 'userPassword' => $pass]);
            return $this->db->get($this->table)->row();
        }else{
            $this->db->where(['userEmail' => $email]);
            return $this->db->get($this->table)->row();
        }

    }



    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('userId', $q);
        $this->db->or_like('username', $q);
        $this->db->or_like('userFirstName', $q);
        $this->db->or_like('userLastName', $q);
        $this->db->or_like('userEmail', $q);
        $this->db->or_like('userPassword', $q);
        $this->db->or_like('userStatus', $q);
        $this->db->or_like('userDob', $q);
        $this->db->or_like('userGender', $q);
        $this->db->or_like('userVerificationCode', $q);
        $this->db->or_like('userProfilePicture', $q);
        $this->db->or_like('userCreationDate', $q);
        $this->db->or_like('admin_id', $q);
        $this->db->or_like('modified_date', $q);
        $this->db->or_like('modified_by', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $status = NULL) {
        $this->db->get_where($this->table, array('userStatus' => $status));
        $this->db->order_by($this->id, $this->order);
        $this->db->like('userId', $q);
        $this->db->or_like('username', $q);
        $this->db->or_like('userFirstName', $q);
        $this->db->or_like('userLastName', $q);
        $this->db->or_like('userEmail', $q);
        $this->db->or_like('userPassword', $q);
        $this->db->or_like('userStatus', $q);
        $this->db->or_like('userDob', $q);
        $this->db->or_like('userGender', $q);
        $this->db->or_like('userVerificationCode', $q);
        $this->db->or_like('userProfilePicture', $q);
        $this->db->or_like('userCreationDate', $q);
        $this->db->or_like('admin_id', $q);
        $this->db->or_like('modified_date', $q);
        $this->db->or_like('modified_by', $q);
        $this->db->limit($limit, $start);

        if (!$status) {
            $this->db->order_by($this->id, $this->order);
            $data = $this->db->get($this->table)->result();
        }else{
            if($status == 00) $status = 0;
            $query = $this->db->where('userStatus',$status);
            $data = $this->db->get($this->table)->result();
        }

        return $data;
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

    //list of user by using status
    function list_all_by_status($status = '')
    {

        if($status)$this->db->where('userStatus',$status);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-29 14:59:51 */
/* http://harviacode.com */