<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_svgs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
        if(xyzAccesscontrol('flyer_shapes','Read')!=TRUE){
           redirect(site_url('_backoffice'));
           exit;
        }
        $this->load->model('Admin_svgs_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(xyzAccesscontrol('flyer_shapes','Read')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $admin_svgs = $this->Admin_svgs_model->get_all();
        $data = array(
            'admin_svgs_data' => $admin_svgs
        );
        // $this->load->view('admin_svgs/admin_svgs_list', $data);
		$this->breadcrumbs->push('Manage Flyer Shape', '/Admin_svgs');
	    $this->breadcrumbs->push('Shapes List', '/Admin_svgs/index');
        $this->commonmodel->adminloadLayout($data,'admin_svgs/admin_svgs_list');
    }

    public function read($id)
    {
        if(xyzAccesscontrol('flyer_shapes','Read')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Admin_svgs_model->get_by_id($id);
        if ($row) {
            $data = array(
		'svgId' => $row->svgId,
		'svgTitle' => $row->svgTitle,
		'svgFileUrl' => $row->svgFileUrl,
		'createdDate' => $row->createdDate,
		'modifiedDate' => $row->modifiedDate,
		'adminId' => $row->adminId,
	    );
            // $this->load->view('admin_svgs/admin_svgs_read', $data);
			$this->breadcrumbs->push('Manage Flyer Shape', '/Admin_svgs');
			$this->breadcrumbs->push('Detail', '/Admin_svgs/read');
            $this->commonmodel->adminloadLayout($data,'admin_svgs/admin_svgs_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_svgs'));
        }
    }

    public function create()
    {
        if(xyzAccesscontrol('flyer_shapes','Add')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }

        $data = array(
            'button' => 'Create',
            'action' => site_url('admin_svgs/create_action'),
	    'svgId' => set_value('svgId'),
	    'svgTitle' => set_value('svgTitle'),
	    'svgFileUrl' => set_value('svgFileUrl'),
	    'createdDate' => set_value('createdDate'),
	    'modifiedDate' => set_value('modifiedDate'),
	    'adminId' => set_value('adminId'),
	);
        // $this->load->view('admin_svgs/admin_svgs_form', $data);
		$this->breadcrumbs->push('Manage Flyer Shape', '/Admin_svgs');
	    $this->breadcrumbs->push('Add', '/Admin_svgs/create');
        $this->commonmodel->adminloadLayout($data,'admin_svgs/admin_svgs_form');
    }

    public function create_action()
    {
        if(xyzAccesscontrol('flyer_shapes','Add')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path']          = './uploads/svgs/';
            $config['allowed_types']        = 'svg';
            $config['file_ext_tolower'] = TRUE;
            $config['max_size']             = 10000;
            $config['max_width']            = 3000;
            $config['max_height']           = 3000;
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);

            $files = array();
            $errors = array();

            foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
            {
                if (!empty($fileObject['name']))
                {
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($fieldname))
                       array_push($errors, $this->upload->display_errors());
                   else array_push($files, $this->upload->data());

               }
           }

           if(count($errors)==0){

            $data = array('upload_data' => $this->upload->data());
            $this->session->set_flashdata('message', $data);

            $data = array(
              'svgTitle' => $this->input->post('svgTitle',TRUE),
              'svgFileUrl' => $files[0]['file_name'],
              'createdDate' => $this->input->post('createdDate',TRUE),
              'modifiedDate' => $this->input->post('modifiedDate'),
              'adminId' => $this->input->post('adminId',TRUE),
              );

            $this->Admin_svgs_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

            redirect(site_url('admin_svgs'));
        }
        else{
            $this->session->set_flashdata('message', $errors[0]);
            redirect(site_url('admin_svgs'));
        }

        }
    }

    public function update($id)
    {
        if(xyzAccesscontrol('flyer_shapes','Edit')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Admin_svgs_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin_svgs/update_action'),
		'svgId' => set_value('svgId', $row->svgId),
		'svgTitle' => set_value('svgTitle', $row->svgTitle),
		'svgFileUrl' => set_value('svgFileUrl', $row->svgFileUrl),
		'createdDate' => set_value('createdDate', $row->createdDate),
		'modifiedDate' => set_value('modifiedDate', $row->modifiedDate),
		'adminId' => set_value('adminId', $row->adminId),
	    );
            // $this->load->view('admin_svgs/admin_svgs_form', $data);
		$this->breadcrumbs->push('Manage Flyer Shape', '/Admin_svgs');
	    $this->breadcrumbs->push('Update', '/Admin_svgs/update');
            $this->commonmodel->adminloadLayout($data,'admin_svgs/admin_svgs_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_svgs'));
        }
    }

    public function update_action()
    {
        if(xyzAccesscontrol('flyer_shapes','Edit')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('svgId', TRUE));
        } else {
            $data = array(
		'svgTitle' => $this->input->post('svgTitle',TRUE),
		'svgFileUrl' => $this->input->post('svgFileUrl',TRUE),
		'createdDate' => $this->input->post('createdDate',TRUE),
		'modifiedDate' => $this->input->post('modifiedDate',TRUE),
		'adminId' => $this->input->post('adminId',TRUE),
	    );

            $this->Admin_svgs_model->update($this->input->post('svgId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin_svgs'));
        }
    }

    public function delete($id)
    {
        if(xyzAccesscontrol('flyer_shapes','Delete')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Admin_svgs_model->get_by_id($id);

        if ($row) {
            $this->Admin_svgs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin_svgs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_svgs'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('svgTitle', 'svgtitle', 'trim|required');
	// $this->form_validation->set_rules('svgFileUrl', 'svgfileurl', 'trim|required');
	$this->form_validation->set_rules('createdDate', 'createddate', 'trim|required');
	// $this->form_validation->set_rules('modifiedDate', 'modifieddate', 'trim|required');
	$this->form_validation->set_rules('adminId', 'adminid', 'trim|required');

	$this->form_validation->set_rules('svgId', 'svgId', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        if(xyzAccesscontrol('flyer_shapes','Excel')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $this->load->helper('exportexcel');
        $namaFile = "admin_svgs.xls";
        $judul = "admin_svgs";
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
	xlsWriteLabel($tablehead, $kolomhead++, "SvgTitle");
	xlsWriteLabel($tablehead, $kolomhead++, "SvgFileUrl");
	xlsWriteLabel($tablehead, $kolomhead++, "CreatedDate");
	xlsWriteLabel($tablehead, $kolomhead++, "AdminId");

	foreach ($this->Admin_svgs_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->svgTitle);
	    xlsWriteLabel($tablebody, $kolombody++, $data->svgFileUrl);
	    xlsWriteLabel($tablebody, $kolombody++, $data->createdDate);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->adminId, 'admin'));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
       if(xyzAccesscontrol('flyer_shapes','Word')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
       header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=admin_svgs.doc");

        $data = array(
            'admin_svgs_data' => $this->Admin_svgs_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin_svgs/admin_svgs_doc',$data);
    }

}

/* End of file Admin_svgs.php */
/* Location: ./application/controllers/Admin_svgs.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-05 21:56:17 */
/* http://harviacode.com */