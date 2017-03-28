<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_fonts extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(xyzAccesscontrol('flyer_fonts','Full')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
        }
        $this->load->model('frontend/commonmodel');
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0)
        // {
        //     $this->commonmodel->no_permissions();
        // }
        $this->load->model('Admin_fonts_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(xyzAccesscontrol('flyer_fonts','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }

        $admin_fonts = $this->Admin_fonts_model->get_all();

        $data = array(
            'admin_fonts_data' => $admin_fonts
        );

        // $this->load->view('admin_fonts/admin_fonts_list', $data);
		$this->breadcrumbs->push('Fonts', '/Admin_fonts');
	    $this->breadcrumbs->push('Fonts List', '/Admin_fonts/index');
        $this->commonmodel->adminloadLayout($data,'admin_fonts/admin_fonts_list');
    }

    public function read($id)
    {
        $row = $this->Admin_fonts_model->get_by_id($id);
        if ($row) {
            $data = array(
		'fontId' => $row->fontId,
		'fontTitle' => $row->fontTitle,
		'fontUrl' => $row->fontUrl,
		'createdDate' => $row->createdDate,
		'modifiedDate' => $row->modifiedDate,
		'adminId' => $row->adminId,
	    );
            // $this->load->view('admin_fonts/admin_fonts_read', $data);
			$this->breadcrumbs->push('Fonts', '/Admin_fonts');
	        $this->breadcrumbs->push('Fonts Detail', '/Admin_fonts/read');
            $this->commonmodel->adminloadLayout($data,'admin_fonts/admin_fonts_read');
			
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_fonts'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin_fonts/create_action'),
	    'fontId' => set_value('fontId'),
	    'fontTitle' => set_value('fontTitle'),
	    'fontUrl' => set_value('fontUrl'),
	    'createdDate' => set_value('createdDate'),
	    'modifiedDate' => set_value('modifiedDate'),
	    'adminId' => set_value('adminId'),
	);
        // $this->load->view('admin_fonts/admin_fonts_form', $data);
		$this->breadcrumbs->push('Fonts', '/Admin_fonts');
	    $this->breadcrumbs->push('Add Font', '/Admin_fonts/create');
        $this->commonmodel->adminloadLayout($data,'admin_fonts/admin_fonts_form');

    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'fontTitle' => $this->input->post('fontTitle',TRUE),
		'fontUrl' => $this->input->post('fontUrl',TRUE),
		'createdDate' => $this->input->post('createdDate',TRUE),
		'modifiedDate' => $this->input->post('modifiedDate',TRUE),
		'adminId' => $this->session->userdata['admin_data']['pk_admin_id']
	    );

            $this->Admin_fonts_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin_fonts'));
        }
    }

    public function update($id)
    {
        $row = $this->Admin_fonts_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin_fonts/update_action'),
		'fontId' => set_value('fontId', $row->fontId),
		'fontTitle' => set_value('fontTitle', $row->fontTitle),
		'fontUrl' => set_value('fontUrl', $row->fontUrl),
		'createdDate' => set_value('createdDate', $row->createdDate),
		'modifiedDate' => set_value('modifiedDate', $row->modifiedDate),
		'adminId' => set_value('adminId', $row->adminId),
	    );
            // $this->load->view('admin_fonts/admin_fonts_form', $data);
		$this->breadcrumbs->push('Fonts', '/Admin_fonts');
	    $this->breadcrumbs->push('UpdateFont', '/Admin_fonts/update');
            $this->commonmodel->adminloadLayout($data,'admin_fonts/admin_fonts_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_fonts'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('fontId', TRUE));
        } else {
            $data = array(
		'fontTitle' => $this->input->post('fontTitle',TRUE),
		'fontUrl' => $this->input->post('fontUrl',TRUE),
		'createdDate' => $this->input->post('createdDate',TRUE),
		'modifiedDate' => $this->input->post('modifiedDate',TRUE),
		'adminId' => $this->input->post('adminId',TRUE),
	    );

            $this->Admin_fonts_model->update($this->input->post('fontId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin_fonts'));
        }
    }

    public function delete($id)
    {
        $row = $this->Admin_fonts_model->get_by_id($id);

        if ($row) {
            $this->Admin_fonts_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin_fonts'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_fonts'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('fontTitle', 'fonttitle', 'trim|required');
	$this->form_validation->set_rules('fontUrl', 'fonturl', 'trim|required');

	$this->form_validation->set_rules('fontId', 'fontId', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "admin_fonts.xls";
        $judul = "admin_fonts";
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
	xlsWriteLabel($tablehead, $kolomhead++, "FontTitle");
	xlsWriteLabel($tablehead, $kolomhead++, "FontUrl");
	xlsWriteLabel($tablehead, $kolomhead++, "CreatedDate");
	xlsWriteLabel($tablehead, $kolomhead++, "ModifiedDate");
	xlsWriteLabel($tablehead, $kolomhead++, "AdminId");

	foreach ($this->Admin_fonts_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->fontTitle);
	    xlsWriteLabel($tablebody, $kolombody++, $data->fontUrl);
	    xlsWriteLabel($tablebody, $kolombody++, $data->createdDate);
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
        header("Content-Disposition: attachment;Filename=admin_fonts.doc");

        $data = array(
            'admin_fonts_data' => $this->Admin_fonts_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin_fonts/admin_fonts_doc',$data);
    }

}

/* End of file Admin_fonts.php */
/* Location: ./application/controllers/Admin_fonts.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-05 21:47:05 */
/* http://harviacode.com */