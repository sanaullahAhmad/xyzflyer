<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct() {
        parent::__construct(); //call to parent constructor

        $this->load->model(array('admin/adminloginmodel', 'frontend/commonmodel'));
    }
    /**
     * This is the default function of a controller
     */
    public function index() {
       /*if ($this->session->userdata('admin_data')) {  //validate
            redirect(site_url('_backoffice'));
            exit;
        }*/
        if ($this->input->post('username') && $this->input->post('password')){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "",$username);
            if ($username == '') {
                $data['username_error'] = 'Username is Required';
            }

            if ($password == '') {
                $data['password_error'] = 'Password is Required';
            }

            if ($username == '' && $password == '') {
                $data['password_error'] = '';
                $data['username_error'] = '';
                $data['general_error'] = 'Please enter Username and Password to proceed';
            }

            if ($username != '' && $password != '') {
                //varify username password
                $hpassword = md5($password);
                $row = $this->adminloginmodel->veifyuser($username, $hpassword);
                if (!empty($row)) {
                    $userSessionData = array(
                        'admin' => 1,
                        'username' => $username,
                        'pk_admin_id' => $row->admin_id,
                        'pk_my_status' => $row->admin_status,
                        'pk_my_type' => $row->admin_type,
                        );
                    $this->session->set_userdata('admin_data',$userSessionData);

                    //save data to user login history
                    $this->load->model('Admin_login_history_model');
                    $this->Admin_login_history_model->insert([
                        'history_ip' => $_SERVER['REMOTE_ADDR'],
                        'history_browser_info' => $_SERVER['HTTP_USER_AGENT'],
                        'history_referer' => $_SERVER["HTTP_REFERER"],
                        'history_date' => Date('Y-m-d H:i:s'),
                        'admin_id' => $row->admin_id
                        ]);

                    redirect(base_url('_backoffice'));
                } else {
                    $data['general_error'] = 'Username and password do not match.';
                    $data['header'] = '';
                    $data['footer'] = '';
                    $this->load->view('admin/layout/login', $data);
                }
                
            }
        // }
            
        }
        else{
            $data['header'] = '';
            $data['footer'] = '';
            $this->load->view('admin/layout/login', $data);
        }
    }

    /**
     * will destroy session n logout user
     *
     */
    function logout() {

        $this->session->unset_userdata("admin_data");
        $this->session->sess_destroy();
        //session_destroy();
        redirect(base_url('_backoffice/login'));
        exit;
    }

}
