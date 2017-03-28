<?php 
/**
 * @ Library model
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend_settings_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function insert($data){
		$this->db->insert('tbl_frontend',$data);
		return true;
	}
	
	function get_data_by_id($id){
		
		$this->db->select('*');
		$this->db->from('tbl_frontend');
		
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result= $query->row();
		
		return $result;
	}
	
	 function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_frontend', $data);
    }
	
	function get_slider_images(){
		$this->db->select('*');
		$this->db->from('tbl_frontend');
		$this->db->where('frontend_location','home');
		$query = $this->db->get();
		$result= $query->result();
		
		return $result;
		
	}
	
	function delete_image($id){
		$this->db->where('id',$id);
		$this->db->delete('tbl_frontend');
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function get_aboutus_images(){
		$this->db->select('*');
		$this->db->from('tbl_frontend');
		$this->db->where('frontend_location','aboutus');
		$query = $this->db->get();
		$result= $query->result();
		
		return $result;
	}
	
	function get_how_it_works_images(){
		$this->db->select('*');
		$this->db->from('tbl_frontend');
		$this->db->where('frontend_location','how-it-works');
		$query = $this->db->get();
		$result= $query->result();
		
		return $result;
	}
	
	function get_single_image(){
		
		$this->db->select('*');
		$this->db->from('tbl_frontend');
		$this->db->where("(frontend_location='aboutus' AND status='1')", NULL, FALSE);
		$query = $this->db->get();
		$result= $query->row();
		
		return $result;
	}
	
	function update_aboutus_status($query){
		
		$this->db->query($query);
	}
	
	function get_how_it_works(){
		
		$this->db->select('*');
		$this->db->from('tbl_frontend');
		$this->db->where("(frontend_location='how-it-works' AND status='1')", NULL, FALSE);
		$query = $this->db->get();
		$result= $query->row();
		
		return $result;
	}
}
?>