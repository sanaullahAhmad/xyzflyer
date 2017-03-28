<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_activity extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0)
        // {
        //     $this->commonmodel->no_permissions();
        // }
        $this->load->model('Admin_activity_model');
        $this->load->library('form_validation');
    }


    public function index()
    {
        if(xyzAccesscontrol('activity_managment','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $admin_activity = $this->Admin_activity_model->get_all();

        $data = array(
            'admin_activity_data' => $admin_activity
        );

        // $this->load->view('admin_activity/admin_activity_list', $data);
		$this->breadcrumbs->push('Admin Activity Logs', '/admin_logs');
		$this->breadcrumbs->push('Admin Activity', '/Admin_activity');
		
        $this->commonmodel->adminloadLayout($data,'admin_activity/admin_activity_list');
    }

    public function read($id)
    {
         if(xyzAccesscontrol('activity_managment','Read')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Admin_activity_model->get_by_id($id);
        if ($row) {
            $data = array(
		'activity_id' => $row->activity_id,
		'action_type' => $row->action_type,
		'activity_text' => $row->activity_text,
		'activity_date' => $row->activity_date,
		'admin_id' => $row->admin_id,
	    );
            // $this->load->view('admin_activity/admin_activity_read', $data);
			$this->breadcrumbs->push('Admin Activity Logs', '/admin_logs');
			$this->breadcrumbs->push('Activity Detail', '/Admin_activity/read');
            $this->commonmodel->adminloadLayout($data,'admin_activity/admin_activity_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_activity'));
        }
    }

     public function get_all_by_admin($id){
        $admin_activity = $this->Admin_activity_model->get_all_by_admin($id);
        $data = array(
            'admin_activity_data' => $admin_activity
            );
		$this->breadcrumbs->push('Admin Activity Logs', '/admin_logs');
	    $this->breadcrumbs->push('Login Detail', '/Admin_activity/get_all_by_admin');
        $this->commonmodel->adminloadLayout($data,'admin_activity/admin_activity_list');
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin_activity/create_action'),
	    'activity_id' => set_value('activity_id'),
	    'action_type' => set_value('action_type'),
	    'activity_text' => set_value('activity_text'),
	    'activity_date' => set_value('activity_date'),
	    'admin_id' => set_value('admin_id'),
	);
        // $this->load->view('admin_activity/admin_activity_form', $data);
        $this->commonmodel->adminloadLayout($data,'admin_activity/admin_activity_form');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'action_type' => $this->input->post('action_type',TRUE),
		'activity_text' => $this->input->post('activity_text',TRUE),
		'activity_date' => $this->input->post('activity_date',TRUE),
		'admin_id' => $this->input->post('admin_id',TRUE),
	    );

            $this->Admin_activity_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin_activity'));
        }
    }

    public function update($id)
    {

        $row = $this->Admin_activity_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin_activity/update_action'),
		'activity_id' => set_value('activity_id', $row->activity_id),
		'action_type' => set_value('action_type', $row->action_type),
		'activity_text' => set_value('activity_text', $row->activity_text),
		'activity_date' => set_value('activity_date', $row->activity_date),
		'admin_id' => set_value('admin_id', $row->admin_id),
	    );
            // $this->load->view('admin_activity/admin_activity_form', $data);
            $this->commonmodel->adminloadLayout($data,'admin_activity/admin_activity_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_activity'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('activity_id', TRUE));
        } else {
            $data = array(
		'action_type' => $this->input->post('action_type',TRUE),
		'activity_text' => $this->input->post('activity_text',TRUE),
		'activity_date' => $this->input->post('activity_date',TRUE),
		'admin_id' => $this->input->post('admin_id',TRUE),
	    );

            $this->Admin_activity_model->update($this->input->post('activity_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin_activity'));
        }
    }

    public function delete($id)
    {
        if(xyzAccesscontrol('activity_managment','Delete')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Admin_activity_model->get_by_id($id);

        if ($row) {
            $this->Admin_activity_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin_activity'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_activity'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('action_type', 'action type', 'trim|required');
	$this->form_validation->set_rules('activity_text', 'activity text', 'trim|required');
	$this->form_validation->set_rules('activity_date', 'activity date', 'trim|required');
	$this->form_validation->set_rules('admin_id', 'admin id', 'trim|required');

	$this->form_validation->set_rules('activity_id', 'activity_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
		
        $this->load->helper('exportexcel');
        $namaFile = "admin_activity.xls";
        $judul = "admin_activity";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Sr.#");
	xlsWriteLabel($tablehead, $kolomhead++, "Action Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Activity Text");
	xlsWriteLabel($tablehead, $kolomhead++, "Activity Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Admin Name");

	foreach ($this->Admin_activity_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			$date = date_create($data->activity_date);
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->action_type, 'action_type'));
	    xlsWriteLabel($tablebody, $kolombody++, $data->activity_text);
	    xlsWriteLabel($tablebody, $kolombody++, date_format($date, 'm-d-Y Hi').'hrs');
	    xlsWriteLabel($tablebody, $kolombody++, format($data->admin_id, 'admin_name'));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=admin_activity.doc");

        $data = array(
            'admin_activity_data' => $this->Admin_activity_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin_activity/admin_activity_doc',$data);
    }

    public function filter($activity_type=NULL, $admin=NULL){
        $results = $this->Admin_activity_model->get_by_filter($activity_type, $admin);

        $data = array(
            'admin_activity_data' => $results
        );

        $this->commonmodel->adminloadLayout($data,'admin_activity/admin_activity_list');

    }
	
	public function flyerActivity($activity_type="flyers", $admin=NULL){
        if(xyzAccesscontrol('activity_managment','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $results = $this->Admin_activity_model->get_by_filter($activity_type, $admin);
        $data = array(
            'admin_activity_data' => $results
        );
        $this->commonmodel->adminloadLayout($data,'flyer_activity/flyer_activity_list');
    }

    public function ajax_get_admin_activity(){
        $res = $this->Admin_activity_model->get_all(10);
        echo json_encode($res);
    }
	
	 public function ajax_get_admin_(){
        $res = $this->Admin_activity_model->get_all(20);
        echo json_encode($res);
    }

}

/* End of file Admin_activity.php */
/* Location: ./application/controllers/Admin_activity.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-06 02:05:16 */
/* http://harviacode.com */