<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class flyersmodel extends CI_Model {

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
    public function getAllflyers($where=NULL) {
        // $queryStr = " SELECT *  FROM tbl_flyer_detail limit 12";
        // $queryRS = $this->db->query($queryStr);
        // if ($queryRS->num_rows() > 0) {
        //     return $queryRS->result_array();
        // } else {
        //     return '';
        // }
        $this->db->select('*');
        $this->db->from('tbl_flyer_detail');
        if($where!=NULL){
           $this->db->where ($where);  
        }
        $this->db->join('tbl_flyer_size','tbl_flyer_size.pk_flyer_size_id=tbl_flyer_detail.flyer_image_size');
        $this->db->order_by('tbl_flyer_detail.flyer_creation_date','desc');
        $query = $this->db->get();
        $flyers = $query->result_array();
        return count($flyers) > 0 ? $flyers : FALSE;

    }
	
	 public function load_flyers_by_tags($tagId)
    {
        $this->db->select('*')
		->from('tbl_r_flyer_flyer_tag')
		->where('fk_flyer_tag_id',$tagId)
		->join('tbl_flyer_detail','tbl_flyer_detail.pk_flyer_detail_id = tbl_r_flyer_flyer_tag.fk_flyer_id')
		->join('tbl_flyer_size', 'tbl_flyer_size.pk_flyer_size_id = tbl_flyer_detail.flyer_image_size');
        $query = $this->db->get();
        return $query->result_array();
    }
	
    function get_all_svgs()
    {
        return $this->db->order_by('svgTitle','asc')->get('admin_svgs')->result_array();
    }

    public function get_flyer_by_id($id)
    {
        $this->db->select('*')->from('tbl_flyer_detail')->where('pk_flyer_detail_id',$id);
        return $this->db->get()->row();

    }

    public function getAllflyer_tags($where=NULL) {
        $queryStr = " SELECT tbl_flyer_tags.*,(select count(*) from tbl_r_flyer_flyer_tag WHERE tbl_r_flyer_flyer_tag.fk_flyer_tag_id=tbl_flyer_tags.pk_flyer_tags) as total FROM tbl_flyer_tags ".$where." order by flyer_tags_title ASC";
        $queryRS = $this->db->query($queryStr);
        if ($queryRS->num_rows() > 0) {
            return $queryRS->result_array();
        } else {
            return '';
        }
    }

    public function getFlyer_tags($flyerId) {
        $queryStr = " SELECT fk_flyer_tag_id FROM tbl_r_flyer_flyer_tag where fk_flyer_id = '$flyerId' order by created_date desc";
        $queryRS = $this->db->query($queryStr);
        if ($queryRS->num_rows() > 0) {
            return $queryRS->result_array();
        } else {
            return '';
        }
    }

    public function getAllbutton_tags() {
        $queryStr = " SELECT * FROM tbl_button_tags order by button_tags_date DESC ";
        $queryRS = $this->db->query($queryStr);
        if ($queryRS->num_rows() > 0) {
            return $queryRS->result_array();
        } else {
            return '';
        }
    }

    public function getAllFlyerSize($status) {
        $query = $this->db->get_where('tbl_flyer_size', array('flyer_size_status' => $status));

        $flyerSize = $query->result_array();

        return count($flyerSize) > 0 ? $flyerSize : FALSE;
    }

    public function saveFlyer($data) {

        // $query = "INSERT INTO tbl_flyer_detail (flyer_image, flyer_image_size, flyer_creation_date)  VALUES (".$data['image'].", ".$data['sizeid'].", NOW())";

        // // $statment = $this->db->conn_id->prepare($query);
        // // $statment->bindParam(':image', $data['image'], PDO::PARAM_STR);
        // // $statment->bindParam(':sizeid', $data['sizeid'], PDO::PARAM_INT);
        // $query = $this->db->query($query);

        return $this->db->insert('tbl_flyer_detail',$data) ? $this->db->insert_id() : FALSE;
    }

    public function saveFlyerBtnRelation($data) {
        foreach ($data['btn'] as $key => $value) {
            $query = $this->db->query("INSERT INTO tbl_r_flyer_btn_tag (fk_flyer_id, fk_btn_tag_id) VALUES (".$data['flyerid'].", $value)");

            /*$statment = $this->db->conn_id->prepare($query);
            $statment->bindParam(':flyerid', $data['flyerid'], PDO::PARAM_INT);
            $statment->bindParam(':btnid', $value, PDO::PARAM_INT);
            $statment->execute();*/
        }
        return;
    }

    public function saveFlyerFlyertagsRelation($data) {
        $errors = array( );
        $d = $this->session->userdata('admin_data');
        foreach ($data['flyer'] as $key => $value) {
            $this->db->select('*')->from('tbl_r_flyer_flyer_tag')->where(array('fk_flyer_id' => $data['flyerid'], 'fk_flyer_tag_id'=>$value));
            if($this->db->count_all_results()<1)
            {
                if(!$this->db->query("INSERT INTO tbl_r_flyer_flyer_tag (fk_flyer_id, fk_flyer_tag_id, admin_id, created_date) VALUES (".$data['flyerid'].", $value, ".$d['pk_admin_id'].", NOW());"))
                array_push($errors, $this->db->_error_message());
            }

            // $statment = $this->db->conn_id->prepare($query);
            // $statment->bindParam(':flyerid', $data['flyerid'], PDO::PARAM_INT);
            // $statment->bindParam(':flyertagid', $value, PDO::PARAM_INT);
            // $statment->execute();

        }
        if(count($errors)<1) return 'done'; else return $errors;
    }


    public function add_designed_flyer($id, $data)
    {
        // $this->db->set($data);
        // $this->db->where('pk_flyer_id',$id);
        if($id) {if($this->db->update('tbl_flyer_detail', $data, 'pk_flyer_detail_id = '.$id)) return true; else return false;}
        else return false;

    }
    public function flyer_save_properties($flyer_id, $data) {
        $this->db->set(array('flyer_text_properties' => $data));
        $this->db->where(array('pk_flyer_detail_id'=> $flyer_id ));
        if($this->db->update('tbl_flyer_detail'))
            return true;
        else return false;
    }

    public function flyer_save_colorsets($flyerID, $json){
        if($flyerID) 
        {
            $data['flyer_color_sets'] = $json;
            if($this->db->update('tbl_flyer_detail', $data, 'pk_flyer_detail_id = '.$flyerID)) return true; else return false;
        }
        else return false;
    }

   

    public function load_new_flyers()
    {
        $this->db->select('pk_flyer_detail_id as flyer, flyer_image, flyer_size_title as flyer_size, flyer_size_width, flyer_size_height')->from('tbl_flyer_detail')->join('tbl_flyer_size', 'tbl_flyer_size.pk_flyer_size_id = tbl_flyer_detail.flyer_image_size')->order_by('flyer_creation_date','desc')->limit(16);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function removeTagRelations($flyerId, $tags)
    {
        foreach ($tags as $tag => $value) {
            
            $this->db->where(array('fk_flyer_id'=> $flyerId, 'fk_flyer_tag_id' => $value));
            $this->db->delete('tbl_r_flyer_flyer_tag');

        }
        
    }

    public function remove_flyer_tags($flyerId)
    {
        $this->db->where(array('fk_flyer_id'=> $flyerId));
        $this->db->delete('tbl_r_flyer_flyer_tag'); 
            
    }

    public function remove_flyer($flyerId)
    {
        $this->db->where(array('pk_flyer_detail_id'=> $flyerId));
        $this->db->delete('tbl_flyer_detail');         
    }

    public function remove_flyer_properties($flyerId)
    {
        $this->db->where(array('pk_flyer_id'=> $flyerId));
        $this->db->delete('tbl_flyer_properties');        
    }

    public function getFlyer($id) {

        $query = $this->db->query("SELECT  pk_flyer_detail_id AS 'template_id', flyer_title AS 'title', flyer_image AS 'image_name', flyer_json_file AS 'json_filename'
            FROM tbl_flyer_detail
            WHERE pk_flyer_detail_id = '".$id."'
            LIMIT 1");

//        $statment = $this->db->conn_id->prepare($query);

//        $statment->bindParam(':flyerid', $id, PDO::PARAM_INT);
//        $statment->execute();
//        $result = $statment->fetchAll(PDO::FETCH_ASSOC);
        $result = $query->row_array();

            //echo $result;
        return count($result) > 0 ? reset($result) : FALSE;
    }

    public function getAllFonts() {
        $query = $this->db->query("SELECT pk_font_id AS 'font_id', font_title AS 'name', font_name AS 'displayName' FROM tbl_font WHERE font_status = 'Active'");
       // $statment = $this->db->conn_id->prepare($query);
        //$statment->execute();

        //$result = $statment->fetchAll(PDO::FETCH_ASSOC);
        $result = $query->row_array();
        return count($result) > 0 ? $result : FALSE;
    }

    public function getFlyerColorSet($flyerId) {
        $query = $this->db->query("SELECT pk_flyer_color_set AS 'set_id', flyer_color_set_title AS 'name'
            FROM tbl_flyer_color_set AS fcs
            LEFT JOIN tbl_r_flyer_to_flyer_set AS ffs ON fcs.pk_flyer_color_set = ffs.fk_flyer_set
            WHERE ffs.fk_flyer_id = $flyerId");
        /*$statment = $this->db->conn_id->prepare($query);
        $statment->bingParam(':flyerid', $flyerId, PDO::PARAM_INT);
        $statment->execute();
        $result = $statment->fetchAll(PDO::FETCH_ASSOC);*/
        $result = $query->row_array();
        return count($result) > 0 ? $result : FALSE;
    }

    public function getColorListWithSetid($setId) {
        $query = $this->db->query("SELECT cl.pk_color_id AS 'color_id', cl.color_title AS 'color', cl.color_hex_code AS 'color_code'
            FROM tbl_r_flyer_set_to_color AS fsc
            LEFT JOIN tbl_color_list AS cl ON fsc.fk_color = cl.pk_color_id
            WHERE fsc.fk_flyer_set_color = $setid");

       /* $statment = $this->db->conn_id->prepare($query);
        $statment->bingParam(':setid', $setId, PDO::PARAM_INT);
        $statment->execute();
        $result = $statment->fetchAll(PDO::FETCH_ASSOC);*/
        $result = $query->row_array();
        return count($result) > 0 ? $result : FALSE;
    }

    public function get_flyer_properties($flyer_id)
    {

        $this->db->select('flyer_text_properties')->from('tbl_flyer_detail')->where(array('pk_flyer_detail_id' => $flyer_id));
        $query = $this->db->get();
        return $query->result();
    }

}

//end of class