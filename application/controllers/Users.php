<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(xyzAccesscontrol('user_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
		$this->load->model('frontend/commonmodel');
		$check = $this->commonmodel->permissions_check();
		// if($check!=0)
		// {
		// 	$this->commonmodel->no_permissions();
		// }
		$this->load->model('Users_model');
		$this->load->library('breadcrumbs');

		/*$this->load->library('form_validation');*/
	}

	public function index()
	{
        // users landing page
        // $this->load->view('users/users_list', $data);
		$this->breadcrumbs->push('Users', '/users');
		$this->breadcrumbs->push('Users dashboard', '/users/index');
		$data = null;
		$this->commonmodel->adminloadLayout($data,'users/users_main');
	}

	public function list_all($status = null)
	{
		/* $q = urldecode($this->input->get('q', TRUE));
		$start = intval($this->input->get('start'));

		if ($q <> '') {
			$config['base_url'] = base_url() . 'users/index.aspx?q=' . urlencode($q);
			$config['first_url'] = base_url() . 'users/index.aspx?q=' . urlencode($q);
		} else {
			$config['base_url'] = base_url() . 'users/index.aspx';
			$config['first_url'] = base_url() . 'users/index.aspx';
		}

		$config['per_page'] = 10;
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->Users_model->total_rows($q);
       if ($status == Null) {
        */
        if($status){
         $users = $this->Users_model->list_all_by_status($status);
        }else{
        $users = $this->Users_model->get_all('userId','DESC');
        }

      /*}
        else{
        }
        $this->load->library('pagination');
        $this->pagination->initialize($config);
*/		
		$this->breadcrumbs->push('Users', '/users');
		$this->breadcrumbs->push('Users List', '/users/list_all');
        $data = array(
			'title'      =>"All Users",
        	'users_data' => $users
        	);
        // $this->load->view('users/users_list', $data);
        $this->commonmodel->adminloadLayout($data,'users/users_list');
    }

    public function list_all_by_status($status = NULL)
    {
	    	if(!$status ){
    		$users = $this->Users_model->list_all_by_status();
    	}
    	else
    	{	
			if($status == 1){
				$title="Active Users";
			}elseif($status == 2){
				$title="Suspended Users";
			}elseif($status == 0){
				$title="Unverified Users";
			}
    		$users = $this->Users_model->list_all_by_status($status);
			
			$this->breadcrumbs->push('Users', '/users');
		    $this->breadcrumbs->push($title, '/users/'.$status);
    		$data = array(
				'title' => $title,
    			'users_data' => $users
    			);
    		$this->commonmodel->adminloadLayout($data,'users/users_list');
    	}
    }

    public function read($id)
    {	
    	$row = $this->Users_model->get_by_id($id);
    	if ($row) {
    		$age = date_diff(date_create($row->userDob), date_create('now'))->y;
    		
			$data = array(
    			'userId' => $row->userId,
    			'username' => $row->username,
    			'userFirstName' => $row->userFirstName,
    			'userLastName' => $row->userLastName,
    			'userEmail' => $row->userEmail,
    			'userPassword' => $row->userPassword,
    			'userStatus' => $row->userStatus,
    			//'userDob' => $row->userDob,
    			'age' => $age,
    			'hereabout' => $row->hereabout,
    			'userProfilePicture' => $row->userProfilePicture,
    			'userCreationDate' => format($row->userCreationDate, 'format_date'),
    			'admin_id' => format($row->admin_id, 'admin'),
    			'modified_date' => format($row->modified_date, 'format_date'),
    			'modified_by' => $row->modified_by,
				'state' => $row->state,
				'city' => $row->city
    			);
				
            // $this->load->view('users/users_read', $data);
			$this->breadcrumbs->push('Users', '/users');
		    $this->breadcrumbs->push('User Detail', '/users/read');
			
    		$this->commonmodel->adminloadLayout($data,'users/users_read');

    	} else {
    		$this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
    		redirect(site_url('users/list_all'));
    	}
    }

    public function create()
    {
		
    	$data = array(
    		'button' => 'Create',
    		'userId' => set_value('userId'),
    		'action' => site_url('users/create_action'),
    		'username' => set_value('username'),
    		'userFirstName' => set_value('userFirstName'),
    		'userLastName' => set_value('userLastName'),
			'state' => set_value('state'),
    		'userEmail' => set_value('userEmail'),
    		'userPassword' => set_value('userPassword'),
			'userCity' => set_value('userCity'),
    		//'userStatus' => set_value('userStatus'),
    		//'userDob' => set_value('userDob'),
    		//'userGender' => set_value('userGender'),
    		//'userProfilePicture' => set_value('userProfilePicture')
    		);
			$data['us_state']=$this->commonmodel->state_list;
			$this->breadcrumbs->push('Users', '/users');
		    $this->breadcrumbs->push('Add User', '/users/create');
        // $this->load->view('users/users_form', $data);
    	$this->commonmodel->adminloadLayout($data,'users/users_form');

    }



    public function create_action()
    {
    	$this->_rules();
    	$picture = "";
    	if ($this->form_validation->run() == FALSE) {
    		$this->create();
    	} else {
            
            $currentDate = Date('Y-m-d');
            $email = $this->input->post('userEmail', TRUE);
            $code = "";


            if($this->input->post('userStatus', TRUE) == 0){
                $code = md5(time());
                $this->load->helper('send_mail');
                $html =  "click on this   <a href='" . base_url() . "frontend/verification?code={$code}&email={$email}" ."'>link</a>  to verify your account";
                _sendMail($email, 'Please Verify Account', $html);

            }

            if($this->input->post('sendinfo', TRUE) === 'yes'){
				$this->load->helper('send_mail');
                $username = $this->input->post('username',TRUE);
                $password = $this->input->post('userPassword', TRUE);
				$subject="XYZFlyers Account Info";
                $date = date('Y-m-d');
               $msg = "Your account Updated successfully. <br> Your Account Email: {$email} <br>";
				if($password != ''){
					$msg .= "password: $password <br>";
				}
				$msg .= "Date: {$date}";
				$data1['html']=$msg;
				_sendMail($email, $subject, $this->load->view('emails/user_infoemail',$data1, TRUE));
            }

			/*
    		$config['upload_path']          = './assets/imgs/';
    		$config['allowed_types']        = 'gif|jpg|png';
    		$config['max_size']             = 2048000;
    		$config['max_width']            = 1024;
    		$config['max_height']           = 768;
    		$config['encrypt_name'] = TRUE;


    		$this->load->library('upload', $config);

    		if($this->upload->do_upload('userProfilePicture')){
    			$picture = $this->upload->data('full_path');
    			$picture = $config['upload_path'] . basename($picture);



    		}else{
    			$error = array('error' => $this->upload->display_errors());
    		}
               */
    		$data = array(
    			'username' => $this->input->post('username',TRUE),
    			'userFirstName' => $this->input->post('userFirstName',TRUE),
    			'userLastName' => $this->input->post('userLastName',TRUE),
				'city'  => $this->input->post('userCity',TRUE),
    			'userEmail' => $this->input->post('userEmail',TRUE),
    			'userPassword' => md5($this->input->post('userPassword',TRUE)),
    			'userStatus' => $this->input->post('userStatus',TRUE),
    			'state' => $this->input->post('state',TRUE),
    			'userCreationDate' => Date('Y-m-d H:i:s'),
                'userVerificationCode' => $code,
    			'admin_id' => $this->session->userdata()['admin_data']['pk_admin_id']
    			);

    		$this->Users_model->insert($data);
    		$this->session->set_flashdata('message', '<span class="alert-success">Record Created Successfully<span>');
    		log_queries('admin', 0, 'users', $this->input->post('username',TRUE));
    		redirect(site_url('users/list_all'));
    	}
    }



    public function update($id)
    {
    	$row = $this->Users_model->get_by_id($id);
    	if ($row) {
    		$data = array(
    			'button' => 'Update',
    			'action' => site_url('users/update_action'),
    			'userId' => set_value('userId', $row->userId),
    			'username' => set_value('username', $row->username),
    			'userFirstName' => set_value('userFirstName', $row->userFirstName),
    			'userLastName' => set_value('userLastName', $row->userLastName),
    			'userEmail' => set_value('userEmail', $row->userEmail),
    			'userPassword' => set_value('userPassword', $row->userPassword),
    			'userStatus' => set_value('userStatus', $row->userStatus),
    			'userCity' => set_value('userCity', $row->city),
				'state' => set_value('state', $row->state),
    			//'userGender' => set_value('userGender', $row->userGender),
    			'userProfilePicture' => set_value('userProfilePicture', $row->userProfilePicture),
    			'userCreationDate' => set_value('userCreationDate', $row->userCreationDate)
    			);
            // $this->load->view('users/users_form', $data);
			$this->breadcrumbs->push('Users', '/users');
		    $this->breadcrumbs->push('User Update', '/users/update');
			$data['us_state']=$this->commonmodel->state_list;
    		$this->commonmodel->adminloadLayout($data,'users/users_form');
    	} else {
    		$this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
    		redirect(site_url('users/list_all'));
    	}
    }

    public function update_action()
    {
    	$this->_update_rules();
    	$picture = "";
    	$curretnUser = "";
    	$user = "";
    	$user = $this->Users_model->get_by_id($this->input->post('userId', TRUE));
    	$picture = $user->userProfilePicture;
		$this->_update_rules();
		
    	if ($this->form_validation->run() == FALSE) {
    		$this->update($this->input->post('userId', TRUE));
    	} else {

    		if($this->session->userdata()['admin_data']['pk_admin_id']){
    			$curretnUser = $this->session->userdata()['admin_data']['pk_admin_id'];
    		}else{
    			$curretnUser = $this->session->userdata()['user_data']['pk_user_id'];
    		}

    		$pass = $this->input->post('userPassword');
    		if($pass){
    			$pass = md5($pass);
    		}else{
    			$pass = $user->userPassword;
    		}


    		$data = array(
    			'username' => $this->input->post('username',TRUE),
    			'userFirstName' => $this->input->post('userFirstName',TRUE),
    			'userLastName' => $this->input->post('userLastName',TRUE),
    			'userEmail' => $this->input->post('userEmail',TRUE),
    			'city' => $this->input->post('userCity',TRUE),
				'state' => $this->input->post('state',TRUE),
				'userPassword' => $pass,
    			'userStatus' => $this->input->post('userStatus',TRUE),
    			'admin_id' => $this->session->userdata()['admin_data']['pk_admin_id'],
    			'modified_date' => Date('Y-m-d H:i:s'),
    			'modified_by' => $curretnUser,
    			);
				
				$email = $this->input->post('userEmail');
				 if($this->input->post('sendinfo', TRUE) === 'yes'){
				$this->load->helper('send_mail');
                $username = $this->input->post('username',TRUE);
                $password = $this->input->post('userPassword', TRUE);
				$subject="XYZFlyers Account Info";
                $date = date('Y-m-d');
               $msg = "Your account Updated successfully. <br> Your Account Email: {$email} <br>";
				if($password != ''){
					$msg .= "password: $password <br>";
				}
				$msg .= "Date: {$date}";
				$data1['html']=$msg;
				_sendMail($email, $subject, $this->load->view('emails/user_infoemail',$data1, TRUE));
				
            }
    		$this->Users_model->update($this->input->post('userId', TRUE), $data);
			
    		$this->session->set_flashdata('message', '<span class="alert-success">Record has been updated Successfully</span>');
    		log_queries('admin', 1, 'users', $this->input->post('username',TRUE));
    		redirect(site_url('users/list_all'));
    	}
    }
    public function delete($id)
    {
        $row = $this->Users_model->get_by_id($id);
        $username = $row->username;

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', '<span class="alert-success">Record has been deleted Successfully</span>');
            log_queries('admin', 2, 'users',$username );
            redirect(site_url('users/list_all'));
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('users/list_all'));
        }
    }
    public function _rules()
    {


    	$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]');
    	$this->form_validation->set_rules('userFirstName', 'userfirstname', 'trim|required');
    	$this->form_validation->set_rules('userLastName', 'userlastname', 'trim');
        $this->form_validation->set_rules('userEmail', 'useremail', 'trim|required|is_unique[users.userEmail]');
    	$this->form_validation->set_rules('userPassword', 'userpassword', 'trim');
    	$this->form_validation->set_rules('userStatus', 'userstatus', 'trim|required');
    	$this->form_validation->set_rules('userDob', 'userdob', 'trim');
		$this->form_validation->set_rules('userCity', 'userCity', 'trim');
    	$this->form_validation->set_rules('userGender', 'usergender', 'trim');
    	$this->form_validation->set_rules('userId', 'userId', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

    public function _update_rules()
    {


       // $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('userFirstName', 'userfirstname', 'trim|required');
        $this->form_validation->set_rules('userLastName', 'userlastname', 'trim');
        $this->form_validation->set_rules('userEmail', 'useremail', 'trim|required');
        $this->form_validation->set_rules('userPassword', 'userpassword', 'trim');
        $this->form_validation->set_rules('userStatus', 'userstatus', 'trim|required');
        
        $this->form_validation->set_rules('userId', 'userId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

    public function excel()
    {
    	$this->load->helper('exportexcel');
    	$namaFile = "users.xls";
    	$judul = "users";
    	$tablehead = 0;
    	$tablebody = 1;
    	$nourut = 1;
        //penulisan header
    	header("Pragma: public");
    	header("Expires: 0");
    	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    	header("Content-Type: application/force-download");
    	header("Content-Type: application/octet-stream");
    	header("Content-Type: application/download");
    	header("Content-Disposition: attachment;filename=" . $namaFile . "");
    	header("Content-Transfer-Encoding: binary ");

    	xlsBOF();

    	$kolomhead = 0;
    	xlsWriteLabel($tablehead, $kolomhead++, "Sr.#");
    	xlsWriteLabel($tablehead, $kolomhead++, "Username");
    	xlsWriteLabel($tablehead, $kolomhead++, "First Name");
    	xlsWriteLabel($tablehead, $kolomhead++, "Last Name");
    	xlsWriteLabel($tablehead, $kolomhead++, "Email");
		xlsWriteLabel($tablehead, $kolomhead++, "State");
    	xlsWriteLabel($tablehead, $kolomhead++, "Status");
		xlsWriteLabel($tablehead, $kolomhead++, "City");
    	xlsWriteLabel($tablehead, $kolomhead++, "Creation Date");
    	xlsWriteLabel($tablehead, $kolomhead++, "Admin Name");


    	foreach ($this->Users_model->get_all() as $data) {
    		$kolombody = 0;
			$date = date_create($data->userCreationDate);
			if($data->state == ''){
				$state= "N/A";
			}else{
				$state= $data->state;
			}
			
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
    		xlsWriteNumber($tablebody, $kolombody++, $nourut);
    		xlsWriteLabel($tablebody, $kolombody++, $data->username);
    		xlsWriteLabel($tablebody, $kolombody++, $data->userFirstName);
    		xlsWriteLabel($tablebody, $kolombody++, $data->userLastName);
    		xlsWriteLabel($tablebody, $kolombody++, $data->userEmail);
			xlsWriteLabel($tablebody, $kolombody++, $state);
    		xlsWriteLabel($tablebody, $kolombody++, format($data->userStatus, 'user_status'));
			xlsWriteLabel($tablebody, $kolombody++, $data->city);
    		xlsWriteLabel($tablebody, $kolombody++,  date_format($date, 'm-d-Y'));
    		xlsWriteLabel($tablebody, $kolombody++, format($data->admin_id,'admin_name'));


    		$tablebody++;
    		$nourut++;
    	}

    	xlsEOF();
    	exit();
    }

    public function word()
    {
    	header("Content-type: application/vnd.ms-word");
    	header("Content-Disposition: attachment;Filename=users.doc");

    	$data = array(
    		'users_data' => $this->Users_model->get_all(),
    		'start' => 0
    		);

    	$this->load->view('users/users_doc',$data);
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-29 14:59:51 */
/* http://harviacode.com */