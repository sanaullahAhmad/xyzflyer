<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csvmodel extends CI_Model
{

	function __construct() {
		parent::__construct();

	}

	function get_csv_emails($id=false) {


		if($id===true){
			$this->db->select('Agency_Name, First_Name, Last_Name, Full_Name, email_address, Address, City, State, ZIPCode, County, Phone_Number, Fax_Number, Website,  Timezone, Latitude, Longitude, ZIPType, CityType, CountyFIPS, StateName, StateFIPS, UTC');
		}
		$this->db->limit(10);
		$query = $this->db->get('campaign_emails');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	function insert_csv($data) {
		$this->db->insert('campaign_emails', $data);
	}

	function get_csv_emails_only(){
		$this->db->select('email_address');
		$this->db->from('campaign_emails');

		$res =  $this->db->get()->result_array();
		if($res){
			return array_column($res, 'email_address');
		}else{
			return NULL;
		}
	}

	function insert_by_infile($file){
		$table = 'campaign_emails';
		$query = $this->db->query('
			LOAD DATA LOCAL INFILE "'.$file.'"
			INTO TABLE '.$table.'
			FIELDS TERMINATED by \',\'
			ENCLOSED BY \'"\'
			LINES TERMINATED BY \'\\r\\n\'
			STARTING BY \'\'
			IGNORE 1 ROWS
			');

	}
}
