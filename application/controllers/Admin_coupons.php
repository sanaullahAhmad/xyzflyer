<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_coupons extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(xyzAccesscontrol('coupen_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $this->load->model('frontend/commonmodel');
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0)
        // {
        //     $this->commonmodel->no_permissions();
        // }
        $this->load->model('Admin_coupons_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(xyzAccesscontrol('coupen_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        $q = urldecode($this->input->get('q', TRUE));
        $records = urldecode($this->input->get('records', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin_coupons/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin_coupons/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin_coupons/index.html';
            $config['first_url'] = base_url() . 'admin_coupons/index.html';
        }
        if ($records <> '') {
            $config['base_url'] = base_url() . 'admin_coupons/index.html?records=' . urlencode($records);
            $config['first_url'] = base_url() . 'admin_coupons/index.html?records=' . urlencode($records);
        } else {
            $config['base_url'] = base_url() . 'admin_coupons/index.html';
            $config['first_url'] = base_url() . 'admin_coupons/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_coupons_model->total_rows($q, $records);
        $admin_coupons = $this->Admin_coupons_model->get_limit_data($config['per_page'], $start, $q, $records);
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_coupons_data' => $admin_coupons,
            'q' => $q,
            'records' => $records,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('admin_coupons/admi_coupons_list', $data);
		$this->breadcrumbs->push('Coupons', '/Admin_coupons');
		$this->breadcrumbs->push('Coupons List', '/Admin_coupons/index');
        $this->commonmodel->adminloadLayout($data,'admin_coupons/admi_coupons_list');
    }
    public function records()
    {
        if(xyzAccesscontrol('coupen_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        $q = urldecode($this->input->get('q', TRUE));
        $records = urldecode($this->input->get('records', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin_coupons/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin_coupons/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin_coupons/index.html';
            $config['first_url'] = base_url() . 'admin_coupons/index.html';
        }
        if ($records <> '') {
            $config['base_url'] = base_url() . 'admin_coupons/index.html?records=' . urlencode($records);
            $config['first_url'] = base_url() . 'admin_coupons/index.html?records=' . urlencode($records);
        } else {
            $config['base_url'] = base_url() . 'admin_coupons/index.html';
            $config['first_url'] = base_url() . 'admin_coupons/index.html';
        }

        $config['per_page'] = ((intval($records) >= 10) ? intval($records) : 10);
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_coupons_model->total_rows($q, $records);
        $admin_coupons = $this->Admin_coupons_model->get_limit_data($config['per_page'], $start, $q, $records);
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_coupons_data' => $admin_coupons,
            'q' => $q,
            'records' => $records,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('admin_coupons/admi_coupons_list', $data);
        $this->breadcrumbs->push('Coupons', '/Admin_coupons');
        $this->breadcrumbs->push('Coupons List', '/Admin_coupons/index');
        $this->commonmodel->adminloadLayout($data,'admin_coupons/admi_coupons_list');
    }

    public function read($id)
    {
        if(xyzAccesscontrol('coupen_managment','Read')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        $row = $this->Admin_coupons_model->get_by_id($id);
        if ($row) {
            $coupinDats= $this->Admin_coupons_model->get_coupin_use($row->coupon_code);
            $data = array(
        		'coupon_id' => $row->coupon_id,
        		'coupon_title' => $row->coupon_title,
        		'coupon_description' => $row->coupon_description,
        		'coupon_start_date' => $row->coupon_start_date,
        		'coupone_end_date' => $row->coupone_end_date,
        		'coupon_type' => $row->coupon_type,
        		'coupon_status' => $row->coupon_status,
                'coupon_value' => $row->coupon_value,
        		'coupon_maximum_uses' => $row->coupon_maximum_uses,
        		'coupon_apply_once' => $row->coupon_apply_once,
        		'coupon_new_signups' => $row->coupon_new_signups,
        		'coupon_apply_on_existing_client_only' => $row->coupon_apply_on_existing_client_only,
        		'coupon_date' => $row->coupon_date,
        		'coupon_modified_date' => $row->coupon_modified_date,
        		'coupon_modified_admin' => $row->coupon_modified_admin,
        		'admin_id' => $row->admin_id,
                'coupon_code' => $row->coupon_code,
                'coupin_uses'=> $coupinDats
        	    );
            // $this->load->view('admin_coupons/admi_coupons_read', $data);
			$this->breadcrumbs->push('Coupons', '/Admin_coupons');
			$this->breadcrumbs->push('Coupon Detail', '/Admin_coupons/read');
            $this->commonmodel->adminloadLayout($data,'admin_coupons/admi_coupons_read');
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('admin_coupons'));
        }
    }

    public function create()
    {
        if(xyzAccesscontrol('coupen_managment','Add')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin_coupons/create_action'),
    	    'coupon_id' => set_value('coupon_id'),
    	    'coupon_title' => set_value('coupon_title'),
    	    'coupon_description' => set_value('coupon_description'),
    	    'coupon_start_date' => set_value('coupon_start_date'),
            'coupon_start_time' => set_value('coupon_start_time'),
            'coupone_end_date' => set_value('coupone_end_date'),
            'coupone_end_time' => set_value('coupone_end_time'),
            'coupon_type' => set_value('coupon_type'),
    	    'coupon_status' => set_value('coupon_status'),
    	    'coupon_value' => set_value('coupon_value'),
    	    'coupon_maximum_uses' => set_value('coupon_maximum_uses'),
    	    'coupon_apply_once' => set_value('coupon_apply_once'),
    	    'coupon_new_signups' => set_value('coupon_new_signups'),
    	    'coupon_apply_on_existing_client_only' => set_value('coupon_apply_on_existing_client_only'),
    	    'coupon_date' => set_value('coupon_date'),
    	    'coupon_modified_date' => set_value('coupon_modified_date'),
    	    'coupon_modified_admin' => set_value('coupon_modified_admin'),
    	    'admin_id' => set_value('admin_id'),
            'coupon_code' => set_value('coupon_code')
	       );
		   $this->breadcrumbs->push('Coupons', '/Admin_coupons');
		   $this->breadcrumbs->push('Add Coupon', '/Admin_coupons/create');
        // $this->load->view('admin_coupons/admi_coupons_form', $data);
        $this->commonmodel->adminloadLayout($data,'admin_coupons/admi_coupons_form');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'coupon_title' => $this->input->post('coupon_title',TRUE),
        		'coupon_description' => $this->input->post('coupon_description',TRUE),
        		'coupon_start_date' => date('Y-m-d',strtotime(str_replace("-","/",($this->input->post('coupon_start_date',true))))).' '.$this->input->post('coupon_start_time',TRUE),
        		'coupone_end_date' => date('Y-m-d',strtotime(str_replace("-","/",($this->input->post('coupone_end_date',TRUE))))).' '.$this->input->post('coupone_end_time',TRUE),
        		'coupon_type' => $this->input->post('coupon_type',TRUE),
                'coupon_status' => $this->input->post('coupon_status', TRUE),
        		'coupon_value' => $this->input->post('coupon_value',TRUE),
        		'coupon_maximum_uses' => $this->input->post('coupon_maximum_uses',TRUE),
        		'coupon_apply_once' => $this->input->post('coupon_apply_once',TRUE),
        		'coupon_new_signups' => $this->input->post('coupon_new_signups',TRUE),
        		'coupon_apply_on_existing_client_only' => $this->input->post('coupon_apply_on_existing_client_only',TRUE),
        		'coupon_date' => $this->input->post('coupon_date',TRUE),
        		'coupon_modified_date' => $this->input->post('coupon_modified_date',TRUE),
        		'coupon_modified_admin' => $this->input->post('coupon_modified_admin',TRUE),
        		'admin_id' => $this->input->post('admin_id',TRUE),
                'coupon_code' => $this->input->post('coupone_code',TRUE)
    	    );
            $this->Admin_coupons_model->insert($data);
            $this->session->set_flashdata('message', '<span class="alert-success">Create Record Success</span>');
            log_queries('admin', 0, 'coupons',  $this->input->post('coupon_title',TRUE));
            redirect(site_url('admin_coupons'));
        }
    }

    public function update($id)
    {
        if(xyzAccesscontrol('coupen_managment','Edit')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        $startDatetime="";
        $endDatetime="";
        $row = $this->Admin_coupons_model->get_by_id($id);
        if ($row) {
            $startDatetime = explode(" ",$row->coupon_start_date);
            $endDatetime = explode(" ",$row->coupone_end_date);
            $data = array(
                    'button' => 'Update',
                    'action' => site_url('admin_coupons/update_action'),
            		'coupon_id' => set_value('coupon_id', $row->coupon_id),
            		'coupon_title' => set_value('coupon_title', $row->coupon_title),
            		'coupon_description' => set_value('coupon_description', $row->coupon_description),
            		'coupon_start_date' => set_value('coupon_start_date', date('Y-m-d',strtotime($startDatetime[0]))),
                    'coupon_start_time' => set_value('coupon_start_time', $startDatetime[1]),
            		'coupone_end_date' => set_value('coupone_end_date', date('Y-m-d',strtotime($endDatetime[0]))),
                    'coupone_end_time' => set_value('coupone_end_time', $endDatetime[1]),
            		'coupon_type' => set_value('coupon_type', $row->coupon_type),
                    'coupon_status' => set_value('coupon_status', $row->coupon_status),
            		'coupon_value' => set_value('coupon_value', $row->coupon_value),
            		'coupon_maximum_uses' => set_value('coupon_maximum_uses', $row->coupon_maximum_uses),
            		'coupon_apply_once' => set_value('coupon_apply_once', $row->coupon_apply_once),
            		'coupon_new_signups' => set_value('coupon_new_signups', $row->coupon_new_signups),
            		'coupon_apply_on_existing_client_only' => set_value('coupon_apply_on_existing_client_only', $row->coupon_apply_on_existing_client_only),
            		'coupon_date' => set_value('coupon_date', $row->coupon_date),
            		'coupon_modified_date' => set_value('coupon_modified_date', $row->coupon_modified_date),
            		'coupon_modified_admin' => set_value('coupon_modified_admin', $row->coupon_modified_admin),
            		'admin_id' => set_value('admin_id', $row->admin_id),
                    'coupon_code' => set_value('coupon_code', $row->coupon_code)
        	    );
				
			$this->breadcrumbs->push('Coupons', '/Admin_coupons');
			$this->breadcrumbs->push('Update Coupon', '/Admin_coupons/update');
            $this->commonmodel->adminloadLayout($data,'admin_coupons/admi_coupons_form');

        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('admin_coupons'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('coupon_id', TRUE));
            //redirect(site_url('admin_coupons/update/'.$this->input->post('coupon_id', TRUE)));
        } else {
            $records_against_couponid = $this->Admin_coupons_model->check_coupons_code($this->input->post('coupone_code'));
            if (count($records_against_couponid) > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Coupon has already been used</div>');
                redirect(site_url('admin_coupons/update/'.$this->input->post('coupon_id', TRUE)));
            }
            else 
            {
                $data = array(
                        'coupon_title' => $this->input->post('coupon_title',TRUE),
                        'coupon_description' => $this->input->post('coupon_description',TRUE),
                        'coupon_start_date' => date('Y-m-d',strtotime(str_replace("-","/",($this->input->post('coupon_start_date',TRUE))))).' '.$this->input->post('coupon_start_time',TRUE),
                        'coupone_end_date' => date('Y-m-d',strtotime(str_replace("-","/",($this->input->post('coupone_end_date',TRUE))))).' '.$this->input->post('coupone_end_time',TRUE),
                        'coupon_type' => $this->input->post('coupon_type',TRUE),
                        'coupon_value' => $this->input->post('coupon_value',TRUE),
                        'coupon_status' => $this->input->post('coupon_status',TRUE),
                        'coupon_maximum_uses' => $this->input->post('coupon_maximum_uses',TRUE),
                        'coupon_apply_once' => $this->input->post('coupon_apply_once',TRUE),
                        'coupon_new_signups' => $this->input->post('coupon_new_signups',TRUE),
                        'coupon_apply_on_existing_client_only' => $this->input->post('coupon_apply_on_existing_client_only',TRUE),
                        'coupon_date' => $this->input->post('coupon_date',TRUE),
                        'coupon_modified_date' => $this->input->post('coupon_modified_date',TRUE),
                        'coupon_modified_admin' => $this->input->post('coupon_modified_admin',TRUE),
                        'admin_id' => $this->input->post('admin_id',TRUE),
                        'coupon_code' => $this->input->post('coupone_code',TRUE)
                    );
                $this->Admin_coupons_model->update($this->input->post('coupon_id', TRUE), $data);
                $this->session->set_flashdata('message', '<span class="alert-success">Update Record Success</span>');
                log_queries('admin', 1, 'coupons', $this->input->post('coupon_id', TRUE));
                redirect(site_url('admin_coupons'));
            }
        }
    }

    public function delete($id)
    {
        if(xyzAccesscontrol('coupen_managment','Delete')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        $row = $this->Admin_coupons_model->get_by_id($id);

        if ($row) {
            $this->Admin_coupons_model->delete($id);
            $this->session->set_flashdata('message', '<span class="alert-success">Delete Record Success</span>');
            log_queries('admin', 2, 'coupons', $id);
            redirect(site_url('admin_coupons'));
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('admin_coupons'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('coupon_title', 'coupon title', 'trim|required');

	// $this->form_validation->set_rules('coupon_description', 'coupon description', 'trim|required');
	$this->form_validation->set_rules('coupon_start_date', 'coupon start date', 'trim|required');
	$this->form_validation->set_rules('coupone_end_date', 'coupone end date', 'trim|required');
	$this->form_validation->set_rules('coupon_type', 'coupon type', 'trim|required');
	$this->form_validation->set_rules('coupon_value', 'coupon value', 'trim|required');
	$this->form_validation->set_rules('coupon_maximum_uses', 'coupon maximum uses', 'trim|required');
	// $this->form_validation->set_rules('coupon_apply_once', 'coupon apply once', 'trim|required');
	// $this->form_validation->set_rules('coupon_new_signups', 'coupon new signups', 'trim|required');
	// $this->form_validation->set_rules('coupon_apply_on_existing_client_only', 'coupon apply on existing client only', 'trim|required');
	$this->form_validation->set_rules('coupon_date', 'coupon date', 'trim|required');
	// $this->form_validation->set_rules('coupon_modified_date', 'coupon modified date', 'trim|required');
	// $this->form_validation->set_rules('coupon_modified_admin', 'coupon modified admin', 'trim|required');
	// $this->form_validation->set_rules('admin_id', 'admin id', 'trim|required');

	$this->form_validation->set_rules('coupon_id', 'coupon_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        if(xyzAccesscontrol('coupen_managment','Excel')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        $this->load->helper('exportexcel');
        $namaFile = "admi_coupons.xls";
        $judul = "admi_coupons";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon Title");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon Description");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon Start Date");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupone End Date");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon Type");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon Value");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon Maximum Uses");
        xlsWriteLabel($tablehead, $kolomhead++, "Coupon Code");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon Apply Once");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon New Signups");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon Apply On Existing Client Only");
    	xlsWriteLabel($tablehead, $kolomhead++, "Coupon Date");
    	xlsWriteLabel($tablehead, $kolomhead++, "Admin Id");

	foreach ($this->Admin_coupons_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->coupon_title);
	    xlsWriteLabel($tablebody, $kolombody++, $data->coupon_description);
	    xlsWriteLabel($tablebody, $kolombody++, $data->coupon_start_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->coupone_end_date);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->coupon_type, 'coupon_type'));
	    xlsWriteLabel($tablebody, $kolombody++, $data->coupon_value);
	    xlsWriteNumber($tablebody, $kolombody++, $data->coupon_maximum_uses);
        xlsWriteNumber($tablebody, $kolombody++, $data->coupon_code);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->coupon_apply_once, 'BOOL'));
	    xlsWriteLabel($tablebody, $kolombody++, format($data->coupon_new_signups, 'BOOL'));
	    xlsWriteLabel($tablebody, $kolombody++, format($data->coupon_apply_on_existing_client_only, 'BOOL'));
	    xlsWriteLabel($tablebody, $kolombody++, $data->coupon_date);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->admin_id, 'admin'));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        if(xyzAccesscontrol('coupen_managment','Word')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=admi_coupons.doc");

        $data = array(
            'admin_coupons_data' => $this->Admin_coupons_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin_coupons/admi_coupons_doc',$data);
    }

}

/* End of file Admin_coupons.php */
/* Location: ./application/controllers/Admin_coupons.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-08 11:05:00 */
/* http://harviacode.com */