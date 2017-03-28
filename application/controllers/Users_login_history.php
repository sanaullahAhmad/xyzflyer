<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_login_history extends CI_Controller
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
        $this->load->model('Users_login_history_model');
        $this->load->library('form_validation');
    }


    public function index()
    {
        if(xyzAccesscontrol('activity_managment','Full')==TRUE){
        $users_login_history = $this->Users_login_history_model->get_all();

        $data = array(
            'users_login_history_data' => $users_login_history
        );
       /* echo "<pre>";
        print_r($data);
        exit;*/
        // $this->load->view('users_login_history/users_login_history_list', $data);
		$this->breadcrumbs->push('User logs', '/admin_logs');
		$this->breadcrumbs->push('User Login History', '/Users_login_history/index');
        $this->commonmodel->adminloadLayout($data,'users_login_history/users_login_history_list');
        }else{
         redirect(site_url('_backoffice'));
     
        }
       
    }

    public function get_all_by_user($id){
        $users_login_history = $this->Users_login_history_model->get_all_by_user($id);
        $data = array(
            'users_login_history_data' => $users_login_history
            );
		$this->breadcrumbs->push('User logs', '/admin_logs');
		$this->breadcrumbs->push('User Login History', '/Users_login_history/get_all_by_user');
        $this->commonmodel->adminloadLayout($data,'users_login_history/users_login_history_list');
    }

    public function read($id)
    {
    	 if(xyzAccesscontrol('activity_managment','Read')!=TRUE){
    	 	 redirect(site_url('_backoffice'));
    	 	 exit;
    	 }
        $row = $this->Users_login_history_model->get_by_id($id);
        if ($row) {
            $data = array(
		'histoy_id' => $row->histoy_id,
		'history_ip' => $row->history_ip,
		'history_browser_info' => $row->history_browser_info,
		'history_referer' => $row->history_referer,
		'history_date' => $row->history_date,
		'user_id' => $row->user_id,
	    );
            // $this->load->view('users_login_history/users_login_history_read', $data);
		$this->breadcrumbs->push('User logs', '/admin_logs');
		$this->breadcrumbs->push('User Login Detail', '/Users_login_history/read');
            $this->commonmodel->adminloadLayout($data,'users_login_history/users_login_history_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users_login_history'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('users_login_history/create_action'),
	    'histoy_id' => set_value('histoy_id'),
	    'history_ip' => set_value('history_ip'),
	    'history_browser_info' => set_value('history_browser_info'),
	    'history_referer' => set_value('history_referer'),
	    'history_date' => set_value('history_date'),
	    'user_id' => set_value('user_id'),
	);
        // $this->load->view('users_login_history/users_login_history_form', $data);
		$this->breadcrumbs->push('User logs', '/admin_logs');
		$this->breadcrumbs->push('Add', '/Users_login_history/create');
        $this->commonmodel->adminloadLayout($data,'users_login_history/users_login_history_form');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'history_ip' => $this->input->post('history_ip',TRUE),
		'history_browser_info' => $this->input->post('history_browser_info',TRUE),
		'history_referer' => $this->input->post('history_referer',TRUE),
		'history_date' => $this->input->post('history_date',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
	    );

            $this->Users_login_history_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users_login_history'));
        }
    }

    public function update($id)
    {
        $row = $this->Users_login_history_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users_login_history/update_action'),
		'histoy_id' => set_value('histoy_id', $row->histoy_id),
		'history_ip' => set_value('history_ip', $row->history_ip),
		'history_browser_info' => set_value('history_browser_info', $row->history_browser_info),
		'history_referer' => set_value('history_referer', $row->history_referer),
		'history_date' => set_value('history_date', $row->history_date),
		'user_id' => set_value('user_id', $row->user_id),
	    );
            // $this->load->view('users_login_history/users_login_history_form', $data);
			
            $this->commonmodel->adminloadLayout($data,'users_login_history/users_login_history_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users_login_history'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('histoy_id', TRUE));
        } else {
            $data = array(
		'history_ip' => $this->input->post('history_ip',TRUE),
		'history_browser_info' => $this->input->post('history_browser_info',TRUE),
		'history_referer' => $this->input->post('history_referer',TRUE),
		'history_date' => $this->input->post('history_date',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
	    );

            $this->Users_login_history_model->update($this->input->post('histoy_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users_login_history'));
        }
    }

    public function delete($id)
    {
    	if(xyzAccesscontrol('activity_managment','Delete')!=TRUE){
    	 	 redirect(site_url('_backoffice'));
    	 	 exit;
    	 }
        $row = $this->Users_login_history_model->get_by_id($id);

        if ($row) {
            $this->Users_login_history_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users_login_history'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users_login_history'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('history_ip', 'history ip', 'trim|required');
	$this->form_validation->set_rules('history_browser_info', 'history browser info', 'trim|required');
	$this->form_validation->set_rules('history_referer', 'history referer', 'trim|required');
	$this->form_validation->set_rules('history_date', 'history date', 'trim|required');
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');

	$this->form_validation->set_rules('histoy_id', 'histoy_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "users_login_history.xls";
        $judul = "users_login_history";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Ip");
	xlsWriteLabel($tablehead, $kolomhead++, "Browser Info");
	xlsWriteLabel($tablehead, $kolomhead++, "Referred");
	xlsWriteLabel($tablehead, $kolomhead++, "Date");
	xlsWriteLabel($tablehead, $kolomhead++, "User Name");

	foreach ($this->Users_login_history_model->get_all() as $data) {
            $kolombody = 0;
			$date = date_create($data->history_date);
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->history_ip);
	    xlsWriteLabel($tablebody, $kolombody++, $data->history_browser_info);
	    xlsWriteLabel($tablebody, $kolombody++, $data->history_referer);
	    xlsWriteLabel($tablebody, $kolombody++, date_format($date, 'm-d-Y Hi').'hrs');
	    xlsWriteLabel($tablebody, $kolombody++, format($data->user_id,'user_name'));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=users_login_history.doc");

        $data = array(
            'users_login_history_data' => $this->Users_login_history_model->get_all(),
            'start' => 0
        );

        $this->load->view('users_login_history/users_login_history_doc',$data);
    }

}

/* End of file Users_login_history.php */
/* Location: ./application/controllers/Users_login_history.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-16 18:19:00 */
/* http://harviacode.com */