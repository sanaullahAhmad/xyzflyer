<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pagemodel extends CI_Model {

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
    public function getAllpages() {
        $queryStr = " SELECT * 
							FROM tbl_page u
							ORDER BY u.page_creation_date_time
							DESC 
							";
        $queryRS = $this->db->query($queryStr);
        if ($queryRS->num_rows() > 0) {
            return $queryRS->result_array();
        } else {
            return '';
        }
    }

      public function updatePage($dataArray) {
        
        
        $alias = strtolower($dataArray['page_title']);
        $alias = str_replace(' ', "", $alias);
        $alias = preg_replace('!\s+&!', ' ', html_entity_decode($alias, ENT_QUOTES));
        $alias = str_replace(array('\'', '"'), '', $alias);
        $alias = str_replace("\\", "", $alias);
        $alias = str_replace("&", " ", $alias);
        $alias = str_replace("!", "", $alias);
        $alias = str_replace(' ', '_', $alias);
        
        if($dataArray['page_delete_able']==0){
          $datas = array(
                    'page_title' => $dataArray['page_title'],
                    'page_description' => $dataArray['page_description'],
                    'page_alias' => $alias
                    
                );  
        }else{
            $datas = array(
                    'page_title' => $dataArray['page_title'],
                    'page_description' => $dataArray['page_description']
                );
        }
        
         
                $this->db->where('pk_page_id', $dataArray['pk_page_id']);
                $this->db->update('tbl_page', $datas);
                //echo $this->db->last_query(); die;
        
    }
    
    public function addPage($dataArray) {
        
        
        $alias = strtolower($dataArray['page_title']);
        $alias = str_replace(' ', "", $alias);
        $alias = preg_replace('!\s+&!', ' ', html_entity_decode($alias, ENT_QUOTES));
        $alias = str_replace(array('\'', '"'), '', $alias);
        $alias = str_replace("\\", "", $alias);
         $alias = str_replace("&", " ", $alias);
        $alias = str_replace("!", "", $alias);
        $alias = str_replace(' ', '_', $alias);
                
                
         $datas = array(
                    'page_title' => $dataArray['page_title'],
                    'page_delete_able' => $dataArray['page_delete_able'],
                    'page_description' => $dataArray['page_description'],
                    'page_alias' => $alias,
                    'page_status' => 1,
                    'page_creation_date_time' => date('Y-m-d h:i:s')
                );

                $this->db->insert('tbl_page', $datas);
         //echo $this->db->last_query(); die;
        
    }
    
    
	/**
	 * will get single record detail
	 */
	public function getpageInfo($page_id){
		$queryStr    = "SELECT * from tbl_page WHERE pk_page_id=".$page_id."";
		$queryRS	 = $this->db->query($queryStr);
		
		if($queryRS->num_rows() > 0){
		   return  $queryRS->row();
		}else{
		  return '';
		}
	}
        
        public function getpageInfoByAlias($page_alias){
		$queryStr    = "SELECT * from tbl_page WHERE page_alias = '".$page_alias."' "; 
		$queryRS	 = $this->db->query($queryStr);
		
		if($queryRS->num_rows() > 0){
		   return  $queryRS->row();
		}else{
		  return '';
		}
	}
    
}