<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users_profile extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
        //set login permission check
	}

	public function index(){
		if(!isset($_SESSION['user_data'])){
			echo 'No Such  user';
			die();
		}

		$id = $_SESSION['user_data']['pk_user_id'];
		$user = $this->Users_model->get_by_id($id);
		$data  = [
		'userId' => $user->userId,
		'username' => $user->username,
		'userEmail' => $user->userEmail,
		'userFirstName' =>$user->userFirstName,
		'userLastName' => $user->userLastName,
		'userDob' => $user->userDob,
		'userGender' => $user->userGender,
		'state' => $user->state,
		'county' => $user->county,
		'city' => $user->city,
		'address' => $user->address,
		'userProfilePicture' => $user->userProfilePicture,
		'userInfo' => $user->userInfo,
		'userLicenseNumber' => $user->userLicenseNumber
		];

		$this->load->view('new_frontend/profile', $data);
	}

	public function profile_action(){

    	//validate user that he is editing his own profile
		$userId = $id = $_SESSION['user_data']['pk_user_id'];
		$user = $this->Users_model->get_by_id($id);
		$errors = [];
		$password = "";
		$picture = "";

		$userPassword = $this->input->post('userPassword', TRUE);
		$newPassword = $this->input->post('new_password' , TRUE);
		$confirmPassword = $this->input->post('confirm_password', TRUE);


		//if user filled fields to change password
		if($userPassword != ""){
			if($user->userPassword !==  md5($userPassword)){
				array_push($errors, "Current Password does not match old password");
			}

			if($newPassword !== $confirmPassword){
				array_push($errors, "New Password does not match confirm password");
			}

		}



		if(!count($errors)){

			$password = $userPassword === "" ? $user->userPassword : md5($newPassword);

			$userEmail = $this->input->post('userEmail' , TRUE);
			$username = $this->input->post('username' , TRUE);

			$userFirstName = $this->input->post('userFirstName' , TRUE);
			$userLastName = $this->input->post('userLastName' , TRUE);
			$userDob = $this->input->post('userDob' , TRUE);
			$userGender = $this->input->post('userGender' , TRUE);
			$state = $this->input->post('state' , TRUE);
			$county = $this->input->post('county' , TRUE);
			$city = $this->input->post('city', TRUE);
			$address = $this->input->post('address', TRUE);
			$userInfo = $this->input->post('userInfo', TRUE);
			$userLicenseNumber = $this->input->post("userLicenseNumber", TRUE);

			$config['upload_path'] = './public/upload/profile_images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);


			if (empty($_FILES['userProfilePicture']['name'])) {
				$picture = $user->userProfilePicture;
			}else{
				if ( $this->upload->do_upload('userProfilePicture')){
					$picture = $this->upload->data('full_path');
					$picture = $config['upload_path'] . basename($picture);
					$file = './public/upload/profile_images/' . $user->userProfilePicture;
					if(file_exists($file)){
						unlink($file);
					}
				}
				else{

					array_push($errors, $this->upload->display_errors());
				}

			}



			$picture = $picture === "" ? $user->picture : basename($picture);


			$data = array(
				'userFirstName' => $userFirstName,
				'userLastName' => $userLastName,
				'userPassword' => $password,
				'userDob' => $userDob,
				'userGender' => $userGender,
				'userProfilePicture' => $picture,
				'state' => $state,
				'county' => $county,
				'city' => $city,
				'address' => $address,
				'userInfo' => $userInfo,
				'userLicenseNumber' => $userLicenseNumber
				);


			$this->Users_model->update( $userId, $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			log_queries('user', 1, 'users', $username);
			redirect(site_url('Users_profile'));
		}else{
			$this->session->keep_flashdata('errors', $errors);
			redirect(site_url('users_profile'));
		}

	}

}

