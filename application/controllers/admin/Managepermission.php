<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Managepermission extends CI_Controller {

    /**
     * Constructor of a login
     */
    function __construct() {
        parent::__construct(); //call to parent constructor
       if($this->session->userdata('admin_data')['pk_my_type']!=0) { 
             redirect(site_url('_backoffice'));
            exit;
        }
        $this->load->model(array('frontend/commonmodel'));
        $this->load->library('form_validation');
        $this->load->helper('form');
    }
    /**
     * This is the default function of a controller
     */
    public function index() {
        $data['Users']=array(0=>'Super Admin',1=>'Templates Designer',2=>'Accounts Manager',3=>'Sales/Orders Manager');
        $data['perm_tab']=$this->commonmodel->getMultipleRecords("SELECT * FROM tbl_permission_tabs");
        $this->commonmodel->adminloadLayout($data, 'admin/managepermission/content');
    }
    //Save the permission data into database
    public function save() {
        if(isset($_POST['save'])){
            $action=FALSE;
            $utype=$this->input->post('utype');
            if(isset($_POST['perm_tab'])){
                $perm_tab=$this->input->post('perm_tab');
                if(is_array($perm_tab)){
                    foreach($perm_tab as $tab){
                        $where=array('utype' => $utype,'perm_tab' => $tab);
                        $data['permFull']='';
                        $data['permRead']='';
                        $data['permAdd']='';
                        $data['permEdit']='';
                        $data['permDelete']='';
                        $data['permExcel']='';
                        $data['permWord']='';
                        $data['permViewLog']='';
                        $data['permReports']='';
                        $data['permStatus']='';
                        if(array_key_exists($tab,$_POST)){
                            foreach($_POST[$tab] as $value){
                                if($value=='Full'){
                                    $data['permFull']=''.$value.'';
                                }
                                if($value=='Read'){
                                    $data['permRead']=''.$value.'';
                                }
                                if($value=='Add'){
                                    $data['permAdd']=''.$value.'';
                                }
                                if($value=='Edit'){
                                    $data['permEdit']=''.$value.'';
                                }
                                if($value=='Delete'){
                                    $data['permDelete']=''.$value.'';
                                }
                                if($value=='Excel'){
                                    $data['permExcel']=''.$value.'';
                                }
                                if($value=='Word'){
                                    $data['permWord']=''.$value.'';
                                }
                                if($value=='ViewLog'){
                                    $data['permViewLog']=''.$value.'';
                                }
                                if($value=='Reports'){
                                    $data['permReports']=''.$value.'';
                                }
                                if($value=='Status'){
                                    $data['permStatus']=''.$value.'';
                                }
                            }
                            if($this->check_exists($tab,$utype)==true){
                                $this->commonmodel->update('tbl_permission_value',$data,$where);
                                $action=TRUE;
                             }else{
                                $data['perm_tab']=''.$tab.'';
                                $data['utype']=$utype;
                                $this->commonmodel->insert('tbl_permission_value',$data);
                                $action=TRUE;
                            }
                        }else{
                            if($this->check_exists($tab,$utype)==true){
                                $this->commonmodel->update('tbl_permission_value',$data,$where);
                                $action=TRUE;
                             }else{
                                $data['perm_tab']=''.$tab.'';
                                $data['utype']=$utype;
                                $this->commonmodel->insert('tbl_permission_value',$data);
                                $action=TRUE;
                            }
                        }
                    }
                }
                if($action==TRUE){
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Successfully changed.</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Cannot changed.</div>');
                }
                redirect(site_url('permission'));
            }
        } 
    }
    protected function check_exists($tab,$type){
        $tabData=$this->commonmodel->getSingleRecord("SELECT * FROM tbl_permission_value WHERE perm_tab ='".$tab."'  AND utype=".$type."");
        if($tabData){
            return true;
        }else{
            return false;
        }

    }
}
