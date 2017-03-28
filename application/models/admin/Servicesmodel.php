<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class servicesmodel extends CI_Model {

    /**
     * This is the constructor of a Model
     */
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * will get all the records
     *
     * @param integer $page [optional]
     * @param integer $limit [optional]
     * @return array of records
     */
    public function getAllservices() {
        $queryStr = " SELECT * 
							FROM tbl_services u
							ORDER BY u.services_creation_date_time
							DESC 
							";
        $queryRS = $this->db->query($queryStr);
        if ($queryRS->num_rows() > 0) {
            return $queryRS->result_array();
        } else {
            return '';
        }
    }

	/**
	 * will get single record detail
	 */
	public function getservicesInfo($pk_services_id){
		$queryStr    = "SELECT * from tbl_services WHERE pk_services_id=".$pk_services_id."";
		$queryRS	 = $this->db->query($queryStr);
		
		if($queryRS->num_rows() > 0){
		   return  $queryRS->row();
		}else{
		  return '';
		}
	}
        
        public function getservices(){
		$queryStr    = "SELECT * from tbl_services ORDER BY pk_services_id DESC "; 
		$queryRS = $this->db->query($queryStr);
                if ($queryRS->num_rows() > 0) {
                    return $queryRS->result_array();
                } else {
                    return '';
                }
	}
        // admin Clients function
         public function getAllclients(){
		$queryStr 	= " SELECT * 
                                            FROM tbl_clients
                                            ORDER BY pk_client_id DESC "; 
		$queryRS	= $this->db->query($queryStr);
		if($queryRS->num_rows() > 0){
                    $data   = $queryRS->result_array();
		   return $data;
		}else{
		   return '';
		}
	} 
       
        public function getClientsDetails($pk_client_id){
		//echo $team_id;die;
		$queryStr    = "SELECT * from tbl_clients WHERE pk_client_id=".$pk_client_id."";
		$queryRS	 = $this->db->query($queryStr);
		if($queryRS->num_rows() > 0){
		   return  $queryRS->row();
		  
		}else{
		   return '';
		}
	}
    
}