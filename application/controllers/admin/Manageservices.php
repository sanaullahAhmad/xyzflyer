<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class manageservices extends CI_Controller {

    /**
     * Constructor of a login 
     */
    function __construct() {
        parent::__construct(); //call to parent constructor

        if (!$this->session->userdata('admin_data')) {  //validate
            redirect(base_url('admin/login'));
            exit;
        }
        $this->load->model(array('admin/servicesmodel', 'frontend/commonmodel'));
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->library('image_lib');
    }

    /**
     * This is the default function of a controller 
     */
    public function index() {

        $data['sucess'] = $this->session->flashdata('sucess');
        $pages = $this->servicesmodel->getAllservices();
        $data['pages'] = $pages;
        $this->commonmodel->adminloadLayout($data, 'admin/manageservices/content');
    }

    

    public function delete($pk_services_id = NULL) {

        $this->db->where('pk_services_id', $pk_services_id);
        $this->db->delete('tbl_services');
        
        $this->session->set_flashdata('sucess', 'Service Delete Sucefully');
        redirect(base_url('admin/manageservices'));
    }
    public function savePage($pk_services_id = NULL) {
        $data = '';
        
        $data['services_images']  = '' ;
        if (!is_null($pk_services_id)) {
            $row = $this->servicesmodel->getservicesInfo($pk_services_id);
            $data['services_title']  = $row->services_title;
            $data['services_images']   = $row->services_images;
        }
        if (isset($_POST['submit'])) {

            $uploadpath = './public/upload/pages';
            $config['upload_path'] = $uploadpath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000000';
            
            $this->form_validation->set_rules('services_title', 'Services Title', 'trim|required');
            $this->form_validation->set_error_delimiters('', '');
            
            if ($this->form_validation->run() == FALSE) {
               
            } else { // no errors now to save the data
                $services_title       = $this->input->post('services_title');
                if (!is_null($pk_services_id)) {
                    $datas = array(
                        'pk_services_id' => $pk_services_id,
                        'services_title' => $services_title
                    );
                    $this->db->where('pk_services_id', $pk_services_id);
                    $this->db->update('tbl_services', $datas);
                    
                } else {
                    $datas = array(
                        'services_title' => $services_title,
                        'services_creation_date_time' => date('Y-m-d h:i:s')
                    );
                    $this->db->insert('tbl_services', $datas);
                    $pk_services_id = $this->db->insert_id();
                }
                if ($_FILES["photo_file"]["name"] != '') {
                    
                    $photo_name = 'photo_'.$pk_services_id;
                    $config['file_name'] = $photo_name;
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('photo_file');
                    $uploaddata = $this->upload->data();

                    $dataImage = array(
                        'services_images' => $uploaddata['file_name']
                    );
                    $this->db->where('pk_services_id', $pk_services_id);
                    $this->db->update('tbl_services', $dataImage);

                   
                }
                redirect('admin/manageservices/index');
            }
        }
        $this->commonmodel->adminloadLayout($data, 'admin/manageservices/save');
        
    }

       
         
}

