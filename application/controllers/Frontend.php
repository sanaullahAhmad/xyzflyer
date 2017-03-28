<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend extends CI_Controller {



    public function __construct() {

        parent::__construct();
        $this->load->model(array('frontend/commonmodel'));
        $this->load->model('Users_model');
    }

    /**
     * Will get home page content
     */
    public function index() {
        /*$this->load->view('new_frontend/public/head');*/
        $this->load->view('new_frontend/public/head');
        $this->load->view('new_frontend/public/header');


        echo '<div style="margin: 0 auto; width: 45%; border: 1px solid #ddd; box-shadow: 0px 0px 5px #ddd; text-align: center; padding: 10px; margin-top: 120px"><br><h2>Welcome! The Projects in on track!</h2>'.
        'Continue by either going to, <br><br><a href="'.base_url('admin').'">Admin Login</a> &nbsp; OR &nbsp;  <a href="'.base_url('login').'">User Login</a><br><br></div>';
        //die;
       /* $data = '';
        $this->commonmodel->frontloadLayout($data,'frontend/home/index');
*/
    }

    /* ------------Load Layout Functions------------------ */

    public function frontloadLayout($data,$content_path) {

        $data['header'] = $this->load->view('frontend/layout/header', $data, TRUE);
        $data['content'] = $this->load->view($content_path, $data, TRUE);
        $data['footer'] = $this->load->view('frontend/layout/footer', $data, TRUE);
        $this->load->view('frontend/layout/template', $data);

    }

    public function adminloadLayout($data,$content_path) {

        $data['header'] = $this->load->view('admin/layout/header', $data, TRUE);
        $data['footer'] = $this->load->view('admin/layout/footer', $data, TRUE);
        $data['content'] = $this->load->view($content_path, $data, TRUE);
        $this->load->view('admin/layout/template', $data);

    }

    /**
     * Will get design page content
     */
    public function design() {
       
       redirect(site_url());
    }

    public function login() {
        if(isset($_SESSION['user_data']['username'])){
            redirect(site_url('/design'));
        }

        $data['header'] = $this->load->view('frontend/layout/header');
        $data['content'] = $this->load->view('frontend/login');
        $data['footer'] = $this->load->view('frontend/layout/footer');
        $this->load->view('frontend/layout/template', $data, TRUE);


    }

    public function login_action(){

        $email = $this->input->post('email', TRUE);
        $pass = md5($this->input->post('password', TRUE));
        $remember = $this->input->post('rememberme', TRUE);

        if($email && $pass){
            $result = $this->Users_model->get_by_email($email, $pass);

            if( $result && $result->userStatus == 0)
            redirect(site_url('frontend/login?you are not verfied. Plz click on link to verify yourself'));

            if($result->username){

                $userSessionData = array(
                    'user' => 1,
                    'username' => $result->username,
                    'pk_user_id' => $result->userId,
                    'pk_my_status' => $result->userStatus,
                    'pk_my_type' => $result->userType,
                    );
                $this->session->set_userdata('user_data',$userSessionData);
                if($remember){
                    $this->session->sess_expiration = '14400000';
                }

                redirect(site_url('/design'));
            }else{
                redirect(site_url('login?message=invalid credentials'));
            }


        }else{
            redirect(site_url('login?message=invalid credentials'));
        }

    }


    public function logout(){
        if(isset($_SESSION['user_data'])){

            $this->session->unset_userdata('user_data');
            $this->session->sess_destroy();
            redirect(site_url('/login?msg=logoutSuccessful'));
        }else{
            redirect(site_url('/login?msg=logoutAlready'));
        }
    }

    public function lost_password(){
        if(isset($_SESSION['user_data']['username'])){
            redirect(site_url('/design'));
        }

        $data['header'] = $this->load->view("frontend/layout/header");
        $data['content'] = $this->load->view('frontend/lost_password', TRUE);
        $data['footer'] = $this->load->view("frontend/layout/footer");
        $this->load->view('frontend/layout/template', $data, TRUE);

    }

    public function lost_password_action(){
        $email = $this->input->post('email');
        $res = $this->Users_model->get_by_email($email);
        $code = md5(time());
        if ($email && $res){

            $this->Users_model->update($res->userId, ['userVerificationCode' => $code]);
            $this->load->helper('send_mail');
            $msg = "you reset link is <a href=" . base_url() . "/frontend/reset_password/?code={$code}&email={$email}>LINK</a>";
            _sendMail($email, "Password reset link", $msg);
            echo 'Check Email for reset link or reset again <a href="/frontend/lost_password">Reset Again</a>';
            die('');
        }else{
            redirect(site_url('frontend/lost_password?msg=invalidEmail'));
        }
    }

    public function reset_password(){
        if(isset($_GET['email']) && isset($_GET['code']) && !empty($_GET['email']) && !empty($_GET['code'])){
            $email = $_GET['email'];
            $code = $_GET['code'];
            $res  = $this->Users_model->get_by_email($email);
            if($res && $res->userVerificationCode == $code){
                $user_data['id'] = $res->userId;
                $user_data['code'] = $res->userVerificationCode;
                $user_data['email'] = $res->userEmail;

                $data['header'] = $this->load->view("frontend/layout/header");
                $data['content'] = $this->load->view('frontend/reset_password_form', $user_data);
                $data['footer'] = $this->load->view("frontend/layout/footer");
                $this->load->view('frontend/layout/template', $data, TRUE);

            }else{
                redirect(site_url('frontend/lost_password?msg=invalidCodesEmail'));
            }
        }else{
            redirect(site_url('frontend/lost_password?msg=invalidCodes'));
        }
    }

    public function reset_password_action(){
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $repassword = $this->input->post('repassword');

        $res = $this->Users_model->get_by_email($email);


        if( $res->userVerificationCode == $code && $password && $password == $repassword){
            $this->Users_model->update($id, ['userPassword' => md5($password)]);
            redirect(site_url("login?msg=passwordResetSuccessfully"));
        }else{
            redirect(site_url("frontend/reset_password?code={$code}&email={$email}?msg=invalidData"));
        }
    }

    public function register(){
        $data['header'] = $this->load->view("frontend/layout/header");
        $data['content'] = $this->load->view('frontend/register');
        $data['footer'] = $this->load->view("frontend/layout/footer");
    }

    public function register_action(){
        $this->_register_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $code = md5(time());
            $email = $this->input->post('userEmail', TRUE);
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'userFirstName' => $this->input->post('userFirstName', TRUE),
                'userLastName' => $this->input->post('userLastName', TRUE),
                'userEmail' => $email,
                'userPassword' => md5($this->input->post('userPassword', TRUE)),
                'userStatus' => 0,
                'userDob' => $this->input->post('userDob', TRUE),
                'userGender' => $this->input->post('userGender', TRUE),
                'userVerificationCode' => $code,
                'userCreationDate' => date('Y-m-d H:i:s')

              );



            $this->Users_model->insert($data);
            $this->load->helper('send_mail');
            $html =  "click on this   <a href='" . base_url() . "/frontend/verification?code={$code}&email={$email}" ."'>link</a>  to verify your account";
            _sendMail($email, 'Please Verify Account', $html);
            $msg  = "username: {$username} <br> password: <br> {$password} <br> email: {$email}";
            _sendMail($email, 'Your account details for flyer', $html);

            $this->session->set_flashdata('message', 'Account Creation succesfull. check your email to verify');
            redirect(site_url('login?Account Creation Succesful'));
        }


    }

    public function verification(){
        $code = "";
        if(isset($_GET['code']) && $_GET['email']){
            $code = $_GET['code'];
            $email = $_GET['email'];

            $result = $this->Users_model->get_by_email($email);
            if($result->userEmail){
                $this->Users_model->update($result->userId ,['userStatus'=> 1]);
                redirect(site_url('login?msg=youAreVerifiedNow'));

            }else{
                redirect(site_url('login?msg=invalidCode'));
            }
        }else{
            redirect(site_url('login?msg=invalidCodeNone'));
        }
    }

    public function _register_rules(){
        $this->form_validation->set_rules('userFirstName', 'user first name', 'trim|required');
        $this->form_validation->set_rules('userLastName', 'user last name', 'trim');
        $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('userPassword', 'password', 'trim|required|matches[reUserPassword]');
        $this->form_validation->set_rules('reUserPassword', 'password', 'trim|required|matches[userPassword]');
        $this->form_validation->set_rules('userEmail', 'email', 'trim|required|valid_email|matches[reUserEmail]|is_unique[users.userEmail]');
        $this->form_validation->set_rules('reUserEmail', 'email', 'trim|valid_email|required|matches[userEmail]');
        $this->form_validation->set_rules('userDob', 'date of birth', 'trim');
        $this->form_validation->set_rules('userGender', 'gender', 'trim|required');

    }


//this function will used by admin for reseting user password
    public function password_reset(){
        $password = $this->input->post('password', TRUE);
        $reset = $this->input->post('reset', TRUE);
        $email = "";
        $userId = "";

        if($password){
            $email = $this->input->post('email', TRUE);
            $userId = $this->input->post('id', TRUE);

            if($reset === "Reset"){
                $res = $this->Users_model->get_by_id($userId);
                if($res){
                    $this->Users_model->update($userId, ['userPassword' => md5($password)]);
                    redirect(site_url('users?msg=passwordChangeSuccess'));
                }else{
                    redirect(site_url('users?msg=invalidUser'));
                }


            }else{

                $this->load->helper('send_mail');
                $msg = "You new password is $password";

                $res = $this->Users_model->get_by_id($userId);
                if($res){
                    $this->Users_model->update($userId, ['userPassword' => md5($password)]);
                    _sendMail($email, "Your new password for flyer", $msg);
                    redirect(site_url('users?msg=passwordChangeSuccessMail'));
                }else{
                    redirect(site_url('users?msg=invalidUser'));
                }

            }


        }else{
            redirect(site_url('users?msg=PlzSupplyAPassword'));
        }

    }



    /*public function template($data)
    {
        $this->load->view('frontend/layout/general_template', $data);
    }*/

}
