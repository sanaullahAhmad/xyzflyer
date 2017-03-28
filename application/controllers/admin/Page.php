<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class page extends CI_Controller {

    /**
     * Constructor of a login
     */
    function __construct() {
        parent::__construct(); //call to parent constructor
        if(xyzAccesscontrol('page_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $this->load->model(array('admin/pagemodel', 'frontend/commonmodel'));
        // $check = $this->commonmodel->permissions_check();
        // if($check != 0)
        // {$this->commonmodel->no_permissions(); }

        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->library('image_lib');
    }

    /**
     * This is the default function of a controller
     */
    public function index() {
        if(xyzAccesscontrol('page_managment','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
			$this->breadcrumbs->push('Page Management', '/admin/managepages');
		    $this->breadcrumbs->push('Pages List', '/admin/managepages/index');
			
        $data['sucess'] = $this->session->flashdata('sucess');
        $pages = $this->pagemodel->getAllpages();
        $data['pages'] = $pages;
        $this->commonmodel->adminloadLayout($data, 'admin/managepage/content');
    }



    public function delete($pk_page_id = NULL) {

        $this->db->where('pk_page_id', $pk_page_id);
        $this->db->delete('tbl_page');

        $this->session->set_flashdata('sucess', 'Page Delete Sucefully');
        $admin = $_SESSION['admin_data']['pk_admin_id'];
        log_queries('admin', 2, 'pages', $admin);
        redirect(base_url('admin/managepages'));
    }
    public function status($pk_page_id = NULL,$status = NULL) {
        $data  = array (
                          'page_status'           => $status
			);
	$this->db->where('pk_page_id',$pk_page_id);
	$this->db->update('tbl_page',$data);
        $this->session->set_flashdata('sucess', 'Page Status Sucefully');
        redirect(base_url('admin/managepages'));

    }
    public function savePage($page_id = NULL) {
        $data = '';
        if (!is_null($page_id)) {
            $row = $this->pagemodel->getpageInfo($page_id);
            $data['page_title_edit']  = $row->page_title;
            $data['page_body_edit']   = $row->page_description;
            $data['page_image_edit']  = $row->page_image;
            $data['page_delete_able'] = $row->page_delete_able;
			$data['page_title'] = "Edit Page";
			$this->breadcrumbs->push('Page Management', '/admin/managepages');
		    $this->breadcrumbs->push('Edit Page', '/admin/managepages/save');
			$this->commonmodel->adminloadLayout($data, 'admin/managepage/save');	
        }
		else{
			$data['page_title'] = "Add page";
			$this->breadcrumbs->push('Page Management', '/admin/managepages');
		    $this->breadcrumbs->push('Add Page', '/admin/managepages/save');
			$this->commonmodel->adminloadLayout($data, 'admin/managepage/save');
		}
        if (isset($_POST['submit'])) {
			$this->breadcrumbs->push('Page Management', '/admin/managepages');
		    $this->breadcrumbs->push('Add Page', '/admin/managepages/save');
            $uploadpath = './public/upload/pages';
            $config['upload_path'] = $uploadpath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000000';

            $this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
            $this->form_validation->set_rules('page_description', 'Page Body', 'trim|required');
            $this->form_validation->set_error_delimiters('', '');

            if ($this->form_validation->run() == FALSE) {

            } else { // no errors now to save the data
                $page_title       = $this->input->post('page_title');
                $page_description = $this->input->post('page_description');
                if (!is_null($page_id)) {
                    $datas = array(
                        'pk_page_id' => $page_id,
                        'page_title' => $page_title,
                        'page_description' => $page_description,
                        'page_delete_able' => $data['page_delete_able']
                    );
                    $this->pagemodel->updatePage($datas);

                } else {
                    $datas = array(
                        'page_title' => $page_title,
                        'page_delete_able' => 0,
                        'page_description' => $page_description
                    );
                    $this->pagemodel->addPage($datas);
                    $page_id = $this->db->insert_id();
                }
                if ($_FILES["photo_file"]["name"] != '') {

                    $photo_name = 'photo_'.$page_id;
                    $config['file_name'] = $photo_name;
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('photo_file');
                    $uploaddata = $this->upload->data();

                    $dataImage = array(
                        'page_image' => $uploaddata['file_name']
                    );
                    $this->db->where('pk_page_id', $page_id);
                    $this->db->update('tbl_page', $dataImage);
                }
                $admin = $this->session->userdata('user_data')['username'];
                log_queries('admin', 0, 'pages', $admin);
                redirect('admin/managepages/index');
            }
			$this->commonmodel->adminloadLayout($data, 'admin/managepage/save');
        }
        
    }



}

