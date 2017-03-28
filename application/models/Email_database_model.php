<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_database_model extends CI_Model
{

    public $table = 'campaign_emails';

    public $order = 'DESC';
    /*public $status = 'userStatus';
*/
    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
    }

    // get all
    function get_all()
    {

        return $this->db->get($this->table)->result();
    }

    function get_all_active()
    {
        $this->db->select('Full_Name, Latitude, Longitude');
        $this->db->where('unsubscribed', 0);
        $this->db->limit(10000);
        return $this->db->get($this->table)->result();
    }


    /**
     * $counties: a key value pair of county with quota
     * $total: total no of emails that user selected
     */
    function get_random_mails($counties, $total ){
        $email_list = [];
        foreach ($counties as $county_fip => $quota) {
            $this->db->select('email_address');
            $this->db->where('CountyFIPS', $county_fip);
            $this->db->limit($quota);
            $res = $this->db->get($this->table)->result_array();
            $res = array_column($res, 'email_address');
            //push only if there is content in result
            $email_list = !empty($res) ? array_merge($email_list, $res) : array_merge($email_list, []) ;
        }
        $count = count($email_list);
        $total =  $total < $count ? $total : $count;
        shuffle($email_list);
        $email_list =  array_slice($email_list, 0, $total);
        return $email_list;
    }

    function update_by_email($email, $data)
    {
        $this->db->where('email_address', $email);
        $this->db->update($this->table, $data);
    }

    function get_state_users(){
        return $this->db->query("select StateName, count(email_address) as totalEmails from campaign_emails group by State")->result_array();
    }
}
