<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class csv extends CI_Controller {


   function __construct() {
    parent::__construct();
    $this->load->model('admin/Csvmodel');
    $this->load->library('csvimport');
}

function index() {
    $data['csvemails'] = $this->Csvmodel->get_csv_emails();
    //echo "<pre>";print_r($data['csvemails']);exit;
    $this->load->view('admin_emails/csvindex', $data);
}

function importcsv() {
    $data['csvemails'] = $this->Csvmodel->get_csv_emails();
        $data['error'] = '';    //initialize image upload error array to empty

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();

            $this->load->view('admin_emails/csvindex', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];

            $this->Csvmodel->insert_by_infile($file_path);
            $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
            redirect("/admin/csv");
        }

    }





}

