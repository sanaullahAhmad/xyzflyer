<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flyer_Size extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
        if(xyzAccesscontrol('flyer_sizes','Full')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
        }
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0)
        // {
        //     $this->commonmodel->no_permissions();
        // }
        $this->load->model('Flyer_size_model');
        $this->load->library('form_validation');
		$this->load->library('breadcrumbs');
    }

    public function index()
    {
        if(xyzAccesscontrol('flyer_sizes','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
		$this->breadcrumbs->push('Flyer Size', '/Flyer_Size');
		$this->breadcrumbs->push('Size list', '/admins/Flyer_Size');
        $flyer_size = $this->Flyer_size_model->get_all();

        $data = array(
            'flyer_size_data' => $flyer_size
        );

        // $this->load->view('flyer_size/tbl_flyer_size_list', $data);
        $this->commonmodel->adminloadLayout($data,'flyer_size/tbl_flyer_size_list');
    }

    public function read($id)
    {
        $row = $this->Flyer_size_model->get_by_id($id);
		$this->breadcrumbs->push('Flyer Size', '/Flyer_Size');
		$this->breadcrumbs->push('Detail', '/admins/read');
        if ($row) {
        $data = array(
		'pk_flyer_size_id' => $row->pk_flyer_size_id,
		'flyer_size_title' => $row->flyer_size_title,
		'flyer_size_width' => $row->flyer_size_width,
		'flyer_size_height' => $row->flyer_size_height,
		'flyer_size_status' => $row->flyer_size_status,
		'flyer_size_date' => $row->flyer_size_date,
		'modifiedDate' => $row->modifiedDate,
        'modifiedBy' => $row->modifiedBy,
		'adminId' => $row->adminId,
	    );
            // $this->load->view('flyer_size/tbl_flyer_size_read', $data);
            $this->commonmodel->adminloadLayout($data,'flyer_size/tbl_flyer_size_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('flyer_size'));
        }
    }

    public function create()
    {
		$this->breadcrumbs->push('Flyer Size', '/Flyer_Size');
		$this->breadcrumbs->push('Add', '/admins/create');
        $data = array(
            'button' => 'Create',
            'action' => site_url('flyer_size/create_action'),
	    'pk_flyer_size_id' => set_value('pk_flyer_size_id'),
	    'flyer_size_title' => set_value('flyer_size_title'),
	    'flyer_size_width' => set_value('flyer_size_width'),
	    'flyer_size_height' => set_value('flyer_size_height'),
	    'flyer_size_status' => set_value('flyer_size_status'),
	    'flyer_size_date' => set_value('flyer_size_date'),
	    'modifiedDate' => set_value('modifiedDate'),
	    'adminId' => set_value('adminId'),
	);
        // $this->load->view('flyer_size/tbl_flyer_size_form', $data);
        $this->commonmodel->adminloadLayout($data,'flyer_size/tbl_flyer_size_form');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'flyer_size_title' => $this->input->post('flyer_size_title',TRUE),
		'flyer_size_width' => $this->input->post('flyer_size_width',TRUE),
		'flyer_size_height' => $this->input->post('flyer_size_height',TRUE),
		'flyer_size_status' => $this->input->post('flyer_size_status',TRUE),
		'flyer_size_date' => $this->input->post('flyer_size_date',TRUE),
		'modifiedDate' => $this->input->post('modifiedDate',TRUE),
		'adminId' => $this->input->post('adminId',TRUE),
	    );

            $this->Flyer_size_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('flyer_size'));
        }
    }

    public function update($id)
    {
		$this->breadcrumbs->push('Flyer Size', '/Flyer_Size');
		$this->breadcrumbs->push('Update', '/admins/update');
		
        $row = $this->Flyer_size_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('flyer_size/update_action'),
		'pk_flyer_size_id' => set_value('pk_flyer_size_id', $row->pk_flyer_size_id),
		'flyer_size_title' => set_value('flyer_size_title', $row->flyer_size_title),
		'flyer_size_width' => set_value('flyer_size_width', $row->flyer_size_width),
		'flyer_size_height' => set_value('flyer_size_height', $row->flyer_size_height),
		'flyer_size_status' => set_value('flyer_size_status', $row->flyer_size_status),
		'flyer_size_date' => set_value('flyer_size_date', $row->flyer_size_date),
		'modifiedDate' => set_value('modifiedDate', $row->modifiedDate),
		'adminId' => set_value('adminId', $row->adminId),
	    );
            // $this->load->view('flyer_size/tbl_flyer_size_form', $data);
            $this->commonmodel->adminloadLayout($data,'flyer_size/tbl_flyer_size_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('flyer_size'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pk_flyer_size_id', TRUE)); exit;
        } else {
            $data = array(
		'flyer_size_title' => $this->input->post('flyer_size_title',TRUE),
		'flyer_size_width' => $this->input->post('flyer_size_width',TRUE),
		'flyer_size_height' => $this->input->post('flyer_size_height',TRUE),
		'flyer_size_status' => $this->input->post('flyer_size_status',TRUE),
		'flyer_size_date' => $this->input->post('flyer_size_date',TRUE),
		'modifiedDate' => $this->input->post('modifiedDate',TRUE),
        'modifiedBy' => $this->input->post('modifiedBy',TRUE),
		// 'adminId' => $this->input->post('adminId',TRUE),
	    );

            $this->Flyer_size_model->update($this->input->post('pk_flyer_size_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('flyer_size'));
        }
    }

    public function delete($id)
    {
        $row = $this->Flyer_size_model->get_by_id($id);

        if ($row) {
            $this->Flyer_size_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('flyer_size'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('flyer_size'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('flyer_size_title', 'flyer size title', 'trim|required');
	$this->form_validation->set_rules('flyer_size_width', 'flyer size width', 'trim|required');
	$this->form_validation->set_rules('flyer_size_height', 'flyer size height', 'trim|required');
	// $this->form_validation->set_rules('flyer_size_status', 'flyer size status', 'trim|required');
	// $this->form_validation->set_rules('flyer_size_date', 'flyer size date', 'trim|required');
	// $this->form_validation->set_rules('modifiedDate', 'modifieddate', 'trim|required');
	// $this->form_validation->set_rules('adminId', 'adminid', 'trim|required');

	// $this->form_validation->set_rules('pk_flyer_size_id', 'pk_flyer_size_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_flyer_size.xls";
        $judul = "tbl_flyer_size";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Size Title");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Size Width");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Size Height");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Size Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Size Date");
	xlsWriteLabel($tablehead, $kolomhead++, "ModifiedDate");
	xlsWriteLabel($tablehead, $kolomhead++, "AdminId");

	foreach ($this->Flyer_size_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_size_title);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_size_width);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_size_height);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_size_status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_size_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modifiedDate);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->adminId, 'admin'));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_flyer_size.doc");

        $data = array(
            'flyer_size_data' => $this->Flyer_size_model->get_all(),
            'start' => 0
        );

        $this->load->view('flyer_size/tbl_flyer_size_doc',$data);
    }

}

/* End of file Flyer_Size.php */
/* Location: ./application/controllers/Flyer_Size.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-05 22:05:03 */
/* http://harviacode.com */