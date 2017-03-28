<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_activity extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
         $this->load->model('frontend/commonmodel');
        $check = $this->commonmodel->permissions_check();
        if($check!=0)
        {
            $this->commonmodel->no_permissions();
        }
        $this->load->model('Users_activity_model');
        $this->load->library('form_validation');
    }


    public function index()
    {
        if(xyzAccesscontrol('activity_managment','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $users_activity = $this->Users_activity_model->get_all();

        $data = array(
            'users_activity_data' => $users_activity
        );

        // $this->load->view('users_activity/users_activity_list', $data);
		$this->breadcrumbs->push('User Activity Logs', '/admin_logs');
		$this->breadcrumbs->push('User Activity List', '/Users_activity/index');
         $this->commonmodel->adminloadLayout($data,'users_activity/users_activity_list');
    }

    public function read($id)
    {
        if(xyzAccesscontrol('activity_managment','Read')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Users_activity_model->get_by_id($id);
        if ($row) {
            $data = array(
		'activity_id' => $row->activity_id,
		'action_type' => $row->action_type,
		'activity_text' => $row->activity_text,
		'activity_date' => $row->activity_date,
		'user_id' => $row->user_id,
	    );
            // $this->load->view('users_activity/users_activity_read', $data);
			$this->breadcrumbs->push('User Activity Logs', '/admin_logs');
			$this->breadcrumbs->push('Activity Detail', '/Users_activity/read');
            $this->commonmodel->adminloadLayout($data,'users_activity/users_activity_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users_activity'));
        }
    }

    public function get_all_by_user($id){
        $users_activity = $this->Users_activity_model->get_all_by_user($id);
        $data = array(
            'users_activity_data' => $users_activity
            );
		$this->breadcrumbs->push('User Activity  Logs', '/admin_logs');
		$this->breadcrumbs->push('Activity Detail', '/Users_activity/read');
        $this->commonmodel->adminloadLayout($data,'users_activity/users_activity_list');
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('users_activity/create_action'),
	    'activity_id' => set_value('activity_id'),
	    'action_type' => set_value('action_type'),
	    'activity_text' => set_value('activity_text'),
	    'activity_date' => set_value('activity_date'),
	    'user_id' => set_value('user_id'),
	);
        // $this->load->view('users_activity/users_activity_form', $data);
        $this->commonmodel->adminloadLayout($data,'users_activity/users_activity_form');
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
		'user_id' => $this->input->post('user_id',TRUE),
	    );

            $this->Users_activity_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users_activity'));
        }
    }

    public function update($id)
    {
        $row = $this->Users_activity_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users_activity/update_action'),
		'activity_id' => set_value('activity_id', $row->activity_id),
		'action_type' => set_value('action_type', $row->action_type),
		'activity_text' => set_value('activity_text', $row->activity_text),
		'activity_date' => set_value('activity_date', $row->activity_date),
		'user_id' => set_value('user_id', $row->user_id),
	    );
            // $this->load->view('users_activity/users_activity_form', $data);
            $this->commonmodel->adminloadLayout($data,'users_activity/users_activity_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users_activity'));
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
		'user_id' => $this->input->post('user_id',TRUE),
	    );

            $this->Users_activity_model->update($this->input->post('activity_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users_activity'));
        }
    }

    public function delete($id)
    {
        if(xyzAccesscontrol('activity_managment','Delete')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Users_activity_model->get_by_id($id);

        if ($row) {
            $this->Users_activity_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users_activity'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users_activity'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('action_type', 'action type', 'trim|required');
	$this->form_validation->set_rules('activity_text', 'activity text', 'trim|required');
	$this->form_validation->set_rules('activity_date', 'activity date', 'trim|required');
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');

	$this->form_validation->set_rules('activity_id', 'activity_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "users_activity.xls";
        $judul = "users_activity";
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
	xlsWriteLabel($tablehead, $kolomhead++, "User Name");

	foreach ($this->Users_activity_model->get_all() as $data) {
		
            $kolombody = 0;
		$date = date_create($data->activity_date);
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->action_type, 'action_type'));
	    xlsWriteLabel($tablebody, $kolombody++,  $data->activity_text);
	    xlsWriteLabel($tablebody, $kolombody++,  date_format($date, 'm-d-Y Hi').'hrs');
	    xlsWriteLabel($tablebody, $kolombody++, format($data->user_id, 'user_name'));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=users_activity.doc");

        $data = array(
            'users_activity_data' => $this->Users_activity_model->get_all(),
            'start' => 0
        );

        $this->load->view('users_activity/users_activity_doc',$data);
    }

    public function filter($activity_type=NULL, $user=NULL){
        $results = $this->Users_activity_model ->get_by_filter($activity_type, $user);
        $data = array(
            'users_activity_data' => $results
        );
        $this->commonmodel->adminloadLayout($data,'users_activity/users_activity_list');
    }

    public function ajax_get_users_activty(){
        $res = $this->Users_activity_model->get_all(15);
        echo json_encode($res);

    }
	
	public function ajax_get_users(){
        $res = $this->Users_activity_model->get_all(20);
        echo json_encode($res);

    }

}

/* End of file Users_activity.php */
/* Location: ./application/controllers/Users_activity.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-16 18:02:55 */
/* http://harviacode.com */