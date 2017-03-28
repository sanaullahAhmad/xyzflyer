<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin_clients extends CI_Controller {


    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('admin_data')) {  //validate
            redirect(base_url('admin/login'));
            exit;
        }
        $this->load->model(array('frontend/commonmodel', 'admin/servicesmodel'));
        $this->load->library(array('form_validation', 'image_lib'));
        $this->load->helper('string');
    }

   
    public function index() {

        $data['sucess']  = $this->session->flashdata('sucess');
        $clients         = $this->servicesmodel->getAllclients();
        $data['clients'] = $clients;
        $this->commonmodel->adminloadLayout($data, 'admin/manageclients/content');
        
    }

    /**
     * will show the form for Adding new record
     */
    public function saveclient($pk_client_id = NULL) {
        $data = '';
        if (!is_null($pk_client_id)) {
            $row = $this->servicesmodel->getClientsDetails($pk_client_id);
            $data['client_name']  = $row->client_name;
            $data['client_description']   = $row->client_description;
            $data['client_logo']  = $row->client_logo;
            
        }
        if (isset($_POST['submit'])) {

            $uploadpath = './public/upload/client_images';
            $config['upload_path'] = $uploadpath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000000';
            $this->form_validation->set_rules('client_name', 'Client Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
               
                
            } else { // no errors now to save the data
                $client_name        = $this->input->post('client_name');
                if (!is_null($pk_client_id)) {
                    $datas = array(
                        'client_name' => $client_name
                    );
                     $this->db->where('pk_client_id', $pk_client_id);
                     $this->db->update('tbl_clients', $datas);
                     //echo $this->db->last_query(); die;
                    
                } else {
                    $datas = array(
                        'client_name' => $client_name,
                        'client_creation_date_time' => date('Y-m-d h:i:s')
                    );
                     $this->db->insert('tbl_clients', $datas);
                     //echo $this->db->last_query(); die;
                    $pk_client_id = $this->db->insert_id();
                }
                if ($_FILES["photo_file"]["name"] != '') {
                    
                    $photo_name = 'Client_'.$pk_client_id;
                    $config['file_name'] = $photo_name;
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('photo_file');
                    $uploaddata = $this->upload->data();

                    $dataImage = array(
                        'client_logo' => $uploaddata['file_name']
                    );
                    $this->db->where('pk_client_id', $pk_client_id);
                    $this->db->update('tbl_clients', $dataImage);

                   
                }
                redirect('admin/manageclients/index');
            }
        }
        $this->commonmodel->adminloadLayout($data, 'admin/manageclients/save');
        
    }

    public function status($pk_client_id = '', $current_status = '') {
        if ($pk_client_id == '' || $current_status == '') {
            show_404();
        }
        $data  = array (
                          'client_status'           => $current_status
			);
        $this->db->where('pk_client_id', $pk_client_id);
        $this->db->update('tbl_clients', $data);
       // echo $this->db->last_query(); die;
        $this->session->set_flashdata('sucess', 'Clients Updated successfully');
        redirect(base_url('admin/manageclients/index/'));
        exit;
    }

    public function delete($pk_client_id = '') {
        if ($pk_client_id == '') {
            show_404();
        }
        $row = $this->servicesmodel->getClientsDetails($pk_client_id);
        $image = $row->client_logo;
        $this->db->where('pk_client_id', $pk_client_id);
        $this->db->delete('tbl_clients');
        if (isset($image) && $image != '') {
            unlink('./public/upload/client_images/' . $image);
        }
        $this->session->set_flashdata('sucess', 'Clients deleted successfully');
        redirect(base_url('admin/manageclients/index/'));
        exit;
    }

    
}
