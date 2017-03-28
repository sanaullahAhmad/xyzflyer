<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class commonmodel extends CI_Model {

	/**
	 * This is the constructor of a Model
	 */
	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}
	public $state_list = array(
		'AL' => "Alabama",
		'AK' => "Alaska",
		'AZ' => "Arizona",
		'AR' => "Arkansas",
		'CA' => "California",
		'CO' => "Colorado",
		'CT' => "Connecticut",
		'DE' => "Delaware",
		'DC' => "District Of Columbia",
		'FL' => "Florida",
		'GA' => "Georgia",
		'HI' => "Hawaii",
		'ID' => "Idaho",
		'IL' => "Illinois",
		'IN' => "Indiana",
		'IA' => "Iowa",
		'KS' => "Kansas",
		'KY' => "Kentucky",
		'LS' => "Louisiana",
		'ME' => "Maine",
		'MD' => "Maryland",
		'MA' => "Massachusetts",
		'MI' => "Michigan",
		'MN' => "Minnesota",
		'MS' => "Mississippi",
		'MO' => "Missouri",
		'MT' => "Montana",
		'NE' => "Nebraska",
		'NV' => "Nevada",
		'NH' => "New Hampshire",
		'NJ' => "New Jersey",
		'NM' => "New Mexico",
		'NY' => "New York",
		'NC' => "North Carolina",
		'ND' => "North Dakota",
		'OH' => "Ohio",
		'OK' => "Oklahoma",
		'OR' => "Oregon",
		'PA' => "Pennsylvania",
		'RI' => "Rhode Island",
		'SC' => "South Carolina",
		'SD' => "South Dakota",
		'TN' => "Tennessee",
		'TX' => "Texas",
		'UT' => "Utah",
		'VT' => "Vermont",
		'VA' => "Virginia",
		'WA' => "Washington",
		'WV' => "West Virginia",
		'WI' => "Wisconsin",
		'WY' => "Wyoming",
	);
	public function isRecordAlreadyExist($record_field, $record, $record_id_field, $record_id, $table) {
		$query = 'SELECT * from ' . $table . ' WHERE ' . $record_field . '="' . $record . '" AND ' . $record_id_field . ' != ' . $record_id;
		$queryRS = $this->db->query($query);
		if ($queryRS->num_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	public function getSingleRecord($query) {
		$queryRS = $this->db->query($query);
		if ($queryRS->num_rows() > 0) {
			return $queryRS->row();
		} else {
			return '';
		}

	}

	public function getMultipleRecords($query) {
		$queryRS = $this->db->query($query);
		if ($queryRS->num_rows() > 0) {
			return $queryRS->result_array();
		} else {
			return '';
		}

	}

	public function getAdminDetails() {
		$queryRS = $this->db->query('SELECT * FROM users WHERE user_id=1');
		if ($queryRS->num_rows() > 0) {
			return $queryRS->result_array();
		} else {
			return '';
		}

	}

	public function validateURL($string) {
		$lowerCase = strtolower($string);
		if ((substr($lowerCase, 0, 7) != 'http://' || substr($lowerCase, 0, 7) != 'https://') && substr($lowerCase, 0, 3) == 'www') {
			$string = 'http://' . $lowerCase;
		}

		if (!preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $string)) {
			return 0;
		} else {
			return 1;
		}
	}

	public function total_super_admins() {
		$this->db->where('admin_type', 0);
		return $this->db->count_all_results('tbl_admin');
	}

	public function total_template_designers() {
		$this->db->where('admin_type', 1);
		return $this->db->count_all_results('tbl_admin');
	}

	public function total_accounts_manager() {
		$this->db->where('admin_type', 2);
		return $this->db->count_all_results('tbl_admin');
	}

	public function total_sales_manager() {
		$this->db->where('admin_type', 3);
		return $this->db->count_all_results('tbl_admin');
	}
	//general function for total records
	public function total_records_where($where, $value, $tbl) {
       if($where!=NULL && $value!=NULL){
            $this->db->where($where, $value);
        }
        else if($where!=NULL && $value==NULL){
		    $this->db->where($where);
        }else{
          //do nothing 
        }
		return $this->db->count_all_results($tbl);
	}
	public function total_active_users() {
		$this->db->where('userStatus', 1);
		return $this->db->count_all_results('users');
	}

	public function total_unverified_users() {
		$this->db->where('userStatus', 0);
		return $this->db->count_all_results('users');
	}

	public function total_suspended_users() {
		$this->db->where('userType', 0);
		return $this->db->count_all_results('users');
	}

	//INSERT QUERY
	function insert($tabel, $data, $lastId = NULL) {
		if ($lastId == 'last_id') {
			$this->db->insert($tabel, $data);
			return $this->db->insert_id();
		} else {
			return $this->db->insert($tabel, $data);
		}
	}
	//UPDATE QUERY
	function update($tabel, $data, $where) {
		$this->db->where($where);
		return $this->db->update($tabel, $data);
	}
	//DELETE QUERY
	function delete($tabel, $where) {
		$this->db->where($where);
		return $this->db->delete($tabel);
	}
	/* ------------Load Layout Functions------------------ */

	public function frontloadLayout($data, $content_path) {

		$data['header'] = $this->load->view('frontend/layout/header', $data, TRUE);
		$data['content'] = $this->load->view($content_path, $data, TRUE);
		$data['footer'] = $this->load->view('frontend/layout/footer', $data, TRUE);
		$this->load->view('frontend/layout/template', $data);

	}

	public function userloadLayout($data, $content_path) {

		$data['head'] = $this->load->view('new_frontend/public/head', $data, TRUE);
		$data['header'] = $this->load->view('new_frontend/public/header', $data, TRUE);
		$data['content'] = $this->load->view($content_path, $data, TRUE);
		$data['footer'] = $this->load->view('new_frontend/public/footer', $data, TRUE);
		$this->load->view('new_frontend/public/user_template', $data);

	}

	public function adminloadLayout($data, $content_path, $nav = true) {
		$data['nav'] = $nav;
		$data['header'] = $this->load->view('admin/layout/header', $data, TRUE);
		$data['footer'] = $this->load->view('admin/layout/footer', $data, TRUE);
		$data['content'] = $this->load->view($content_path, $data, TRUE);
		$this->load->view('admin/layout/template', $data);

	}
	/*
	@ Load  metronic theme function
	*/
	public function adminloadtheme($data, $content_path, $nav = true) {
		$data['nav'] = $nav;
		$data['header'] = $this->load->view('admin/metronic_theme/common_pages/header', $data, TRUE);
		$data['footer'] = $this->load->view('admin/metronic_theme/common_pages/footer', $data, TRUE);
		$data['content'] = $this->load->view($content_path, $data, TRUE);
		$this->load->view('admin/metronic_theme/common_pages/template', $data);

	}
	public function permissions_check() {
		$admin_data = $this->session->userdata('admin_data');
		if (!$this->session->userdata('admin_data')) {
			//validate
			redirect(site_url('_backoffice/login'));
			exit;
		} else {

			if ($admin_data['pk_my_status'] == '0') {
				redirect(base_url('account_closed'));exit;
			} else {
				return $admin_data['pk_my_type'];
			}

		}
	}
	public function check_admin_login() {
		$admin_data = $this->session->userdata('admin_data');
		if (!$this->session->userdata('admin_data')) {
			//validate
			redirect(base_url('_backoffice/login'));
			exit;
		}
	}
	public function no_permissions() {
		$this->adminloadLayout(null, 'admin/no_permissions');
	}
	
	public function getEmailRecords($query) {
		$array=array();
		$queryRS = $this->db->query($query);
		if ($queryRS->num_rows() > 0) {
			foreach ($queryRS->result_array() as $row){
				$array[]=$row['email_address'];
			}
		
			return $array;
		}
	}
	
	
	public function getimage($imagequery) {
		$array=array();
		$queryRS = $this->db->query($imagequery);
		if ($queryRS->num_rows() > 0) {
			$row = $queryRS->row();
			}
		
			return $row->flyer_created_image;
		
	}

	public function get_user_email_settings($id)
	{
		$this->db->select('names.es_name as name, names.es_title as title, names.es_note as note, changes.es_status as status, changes.userId');
		$this->db->join('tbl_users_email_settings_changes as changes','names.esId = changes.esId AND changes.userId = "'.$id.'"', 'LEFT');
		// $this->db->join('tbl_users_email_settings_changes as changess','changess.userId = "'.$id.'"');
		// $this->db->join('tbl_users_email_settings_changes as changess','changess.userId = "'.$id.'"', 'left');
		// $this->db->where(array('changes.userId' => $id));
		return $this->db->get('tbl_users_email_settings_names as names')->result();
	}

	public function check_email_settings($id, $setting=null)
	{
		if(!$setting) $setting = 'notification';
	/*	
		if($setting=='newsletter') $e_setting = 'es_newsletter_emails';
		else if($setting=='order') $e_setting = 'es_order_emails';
		else if($setting=='billing') $e_setting = 'es_billing_emails';
		else if($setting=='statistic') $e_setting = 'es_statistic_emails';
		else if($setting=='promotion') $e_setting = 'es_promotion_emails';
		else $e_setting = 'es_notification_emails';
*/
		$this->db->select('es_status');
		$this->db->where(array('userId'=> $id, 'es_name'=>$setting));
        $row = $this->db->get('tbl_users_email_settings_changes')->result_array();

        if(count($row)>0) return $row[0];
        else 
        {
        	$this->db->select('esId')->from('tbl_users_email_settings_names')->where('es_name', $setting);
        	$r = $this->db->get()->row();
            $resId=0;
            if($r)
            {
                $resId=$r->esId;
            }

        	$insert_array = array('es_name'=>$setting, 'es_status'=>'true', 'es_date'=>Date("Y-m-d H:i:s"), 'userId'=>$id, 'esId'=>$resId);
        	$this->db->insert('tbl_users_email_settings_changes', $insert_array);

        	$this->db->select('es_status');
			$this->db->where(array('userId'=> $id, 'es_name'=>$setting));
	        $row = $this->db->get('tbl_users_email_settings_changes')->result_array();
	        return $row[0];
        }
	}

	public function send_email($template, $subject, $userId=null,$data=null, $email_setting = null )
	{
		if(!$userId) $userId = $this->session->user_data['pk_user_id'];

		if(!$email_setting) $email_setting = 'notification';

		$email_settings = $this->check_email_settings($userId, $email_setting);
		//print_r($email_settings); exit;
		$email_settings = $email_settings['es_status'];
		// print_r($email_settings); exit;
		if($email_settings!=0)
		{
			$this->load->model('Users_model');
			$row = $this->Users_model->get_by_id($userId);
			$this->load->helper('send_mail');
			$data['header'] = 'emails/style1/incs/header';
			$data['footer'] = 'emails/style1/incs/footer';
			$data['body'] = '';
			if(_sendMail($row->userEmail, $subject, $this->load->view('emails/style1/'.$template, $data, true))) return true;
		}
	}

	public function send_settings_change_confirmation_email($change, $setting_name = null)
	{
		$data['subject'] = 'Confirmation for Email Settings Change';
		$userId = $this->session->user_data['pk_user_id'];

		$data['code'] = md5(time());
		$data['change'] = $change;
		//save code

/*
		if(!$setting_name) $setting_name = 'notifications';
		if($setting_name=='newsletter') $e_setting = 'es_newsletter_emails';
		else if($setting_name=='order') $e_setting = 'es_order_emails';
		else if($setting_name=='billing') $e_setting = 'es_billing_emails';
		else if($setting_name=='statistic') $e_setting = 'es_statistic_emails';
		else if($setting_name=='promotion') $e_setting = 'es_promotion_emails';
		else $e_setting = 'es_notification_emails';*/

		if(!$setting_name) $setting_name = 'notifications';

		$data['setting_name'] = $setting_name;

		$email_settings = $this->check_email_settings($userId, $setting_name);
		// $email_settings = $email_settings[$setting_name];
		// print_r($email_settings); exit;

		//RECORD CODE/ TRACKING AND DATE FOR CHANGE
		$this->load->library('user_agent');
		$ip = $this->input->ip_address();
		$agent = '('.$ip.') '.$this->agent->agent_string();
		$datetime = Date('Y-m-d H:i:s');
		$datetime_formated = Date('m/d/Y Hi')."hrs";

		$changes = array('es_code' => $data['code'], 'es_tracking'=> $agent, 'es_modified_date'=> $datetime, 'es_requested_change'=>$change);
		$this->db->where('userId',$userId);
		$this->db->update('tbl_users_email_settings_changes', $changes);

		// RECORD ACTIVITY FOR USER
		$this->load->helper('query_log');
		
		if($change !== 'true') {$subscribe_change = 'Unsubscribed';$change_text='unsubscribe';}else {$subscribe_change = 'Subscribed'; $change_text='subscribe';}
		
		$data['change_text'] = $change_text;
		$custom_activity_text = " named '".$this->session->user_data['username']."' has requested to change his '".$setting_name."' email settings to ".$subscribe_change." at ".$datetime_formated.". His tracking information is ".$agent.". An email was sent to his/her email address for confirmation.";
		log_user_activity($custom_activity_text, $userId);

		// if($email_settings['es_status']!='false')
		// {
			$this->load->model('Users_model');
			$row = $this->Users_model->get_by_id($userId);
			$this->load->helper('send_mail');
			$data['header'] = 'emails/style1/incs/header';
			$data['footer'] = 'emails/style1/incs/footer';
			$data['body'] = '';
			if(_sendMail($row->userEmail, $data['subject'], $this->load->view('emails/style1/settings_opt_out', $data, true))) return true;
		// }
	}

	public function confirm_password($pass)
	{
		$condition = array('userId'=> $this->session->user_data['pk_user_id'], 'userPassword'=>md5($pass));
		$this->db->where($condition);
		$num = $this->db->get('users')->num_rows();
		if($num>0) return true;
		else return false;
	}

	public function email_settings_confirm($change, $setting_name, $code)
	{
	/*	//GETTING DATABASE COLUMN NAME FROM SETTINGS NAME
		if(!$setting_name) $setting_name = 'notifications';
		if($setting_name=='newsletter') $e_setting = 'es_newsletter_emails';
		else if($setting_name=='order') $e_setting = 'es_order_emails';
		else if($setting_name=='billing') $e_setting = 'es_billing_emails';
		else if($setting_name=='statistic') $e_setting = 'es_statistic_emails';
		else if($setting_name=='promotion') $e_setting = 'es_promotion_emails';
		else $e_setting = 'es_notification_emails';
*/		if($change=='unsubscribe') $change = 'false'; else $change = 'true';
		// echo $setting_name; exit;
		$this->db->select('*');
		$this->db->where(array('es_code'=>$code, 'es_name'=>$setting_name, 'es_requested_change'=>$change));
		$row = $this->db->get('tbl_users_email_settings_changes')->row();
		// echo "<pre>";
		// print_r($row); exit;
		// echo "</pre>";
		if(count($row)>0)
		{
			// print_r($row); 
			$date1 = new DateTime($row->es_modified_date);
			$date2 = new DateTime(Date('Y-m-d H:i:s'));

			$diff = $date2->diff($date1);

			$hours = $diff->h;
			// echo "<br>";
			// echo $row[0][$e_setting.'_modified_date'];
			if(intval($hours)>48) //EXPIRED
			{
				return array('msg' => 'Confirmation Code Expired!', 'error_code'=>1);
			}
			else {	//SUCCESS
				$this->load->library('user_agent');
				$ip = $this->input->ip_address();
				$agent = '('.$ip.') '.$this->agent->agent_string();
				$update = array('es_status'=> $change,'es_code'=>null, 'es_modified_date'=>Date("Y-m-d H:i:s"), 'es_tracking'=>$agent);
				$this->db->where(array('userId'=> $row->userId, 'esId'=>$row->esId));
				$this->db->update('tbl_users_email_settings_changes', $update);
				return array('msg' => 'Success', 'error_code'=>false);
			}
		}
		else return array('msg' => 'Invalid Code!', 'error_code'=>2);

	}

	public function semail_unsub($email){
		$this->db->where('subEmail', $email);
		$this->db->from('tbl_unsubscriber');
		$count =  $this->db->count_all_results();
		$this->load->library('user_agent');
		$ip = $this->input->ip_address();
		$headers = '('.$ip.') '.$this->agent->agent_string();
		if($count>0)
		{ // then update
			$data = array('subModifiedHeaders'=> $headers, 'subModifiedDate'=>Date('Y-m-d H:i:s'));
			if($this->db->update('tbl_unsubscriber', $data)) return true; else return false;
		} 
		else { // if not found then insert
			$data = array('subEmail'=> $email, 'subHeaders'=> $headers, 'subCreationDate'=>Date('Y-m-d H:i:s'));
			if($this->db->insert('tbl_unsubscriber', $data)) return true; else return false;
		}
	}

}
