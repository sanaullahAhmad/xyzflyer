<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_login_history extends CI_Controller
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
        $this->load->model('Admin_login_history_model');
        $this->load->library('form_validation');
    }


    public function index()
    {
    if(xyzAccesscontrol('activity_managment','Full')==TRUE){
        $admin_login_history = $this->Admin_login_history_model->get_all();

        $data = array(
            'admin_login_history_data' => $admin_login_history
            );
        // $this->load->view('admin_login_history/admin_login_history_list', $data); admin_logs
		$this->breadcrumbs->push('Admin Login History', '/admin_logs');
	    $this->breadcrumbs->push('Login History List', '/Admin_login_history/index');
        $this->commonmodel->adminloadLayout($data,'admin_login_history/admin_login_history_list');
    }else{
         redirect(site_url('_backoffice'));
     
        }
    }

    public function read($id)
    {
        if(xyzAccesscontrol('activity_managment','Read')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        $row = $this->Admin_login_history_model->get_by_id($id);
        if ($row) {
            $data = array(
              'histoy_id' => $row->histoy_id,
              'history_ip' => $row->history_ip,
              'history_browser_info' => $row->history_browser_info,
              'history_referer' => $row->history_referer,
              'history_date' => $row->history_date,
              'admin_id' => $row->admin_id,
              );
            // $this->load->view('admin_login_history/admin_login_history_read', $data);
			$this->breadcrumbs->push('Admin Login History', '/admin_logs');
			$this->breadcrumbs->push('Login Detail', '/Admin_login_history/read');
            $this->commonmodel->adminloadLayout($data,'admin_login_history/admin_login_history_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_login_history'));
        }
    }

    public function get_all_by_admin($id){
        $admin_login_history = $this->Admin_login_history_model->get_all_by_admin($id);
        $data = array(
            'admin_login_history_data' => $admin_login_history
            );
		$this->breadcrumbs->push('AdminLogin History', '/admin_logs');
	    $this->breadcrumbs->push('History List', '/Admin_login_history/get_all_by_admin');
        $this->commonmodel->adminloadLayout($data,'admin_login_history/admin_login_history_list');
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin_login_history/create_action'),
            'histoy_id' => set_value('histoy_id'),
            'history_ip' => set_value('history_ip'),
            'history_browser_info' => set_value('history_browser_info'),
            'history_referer' => set_value('history_referer'),
            'history_date' => set_value('history_date'),
            'admin_id' => set_value('admin_id'),
            );
        // $this->load->view('admin_login_history/admin_login_history_form', $data);
		$this->breadcrumbs->push('AdminLoginHistory', '/Admin_login_history');
	    $this->breadcrumbs->push('Add', '/Admin_login_history/create');
        $this->commonmodel->adminloadLayout($data,'admin_login_history/admin_login_history_form');
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
              'admin_id' => $this->input->post('admin_id',TRUE),
              );

            $this->Admin_login_history_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin_login_history'));
        }
    }

    public function update($id)
    {
        $row = $this->Admin_login_history_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin_login_history/update_action'),
                'histoy_id' => set_value('histoy_id', $row->histoy_id),
                'history_ip' => set_value('history_ip', $row->history_ip),
                'history_browser_info' => set_value('history_browser_info', $row->history_browser_info),
                'history_referer' => set_value('history_referer', $row->history_referer),
                'history_date' => set_value('history_date', $row->history_date),
                'admin_id' => set_value('admin_id', $row->admin_id),
                );
            // $this->load->view('admin_login_history/admin_login_history_form', $data);
            $this->commonmodel->adminloadLayout($data,'admin_login_history/admin_login_history_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_login_history'));
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
              'admin_id' => $this->input->post('admin_id',TRUE),
              );

            $this->Admin_login_history_model->update($this->input->post('histoy_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin_login_history'));
        }
    }

    public function delete($id)
    {
        if(xyzAccesscontrol('activity_managment','Delete')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
         }
        $row = $this->Admin_login_history_model->get_by_id($id);

        if ($row) {
            $this->Admin_login_history_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin_login_history'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_login_history'));
        }
    }

    public function _rules()
    {
       $this->form_validation->set_rules('history_ip', 'history ip', 'trim|required');
       $this->form_validation->set_rules('history_browser_info', 'history browser info', 'trim|required');
       $this->form_validation->set_rules('history_referer', 'history referer', 'trim|required');
       $this->form_validation->set_rules('history_date', 'history date', 'trim|required');
       $this->form_validation->set_rules('admin_id', 'admin id', 'trim|required');

       $this->form_validation->set_rules('histoy_id', 'histoy_id', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "admin_login_history.xls";
    $judul = "admin_login_history";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Admin Name");

    foreach ($this->Admin_login_history_model->get_all() as $data) {
        $kolombody = 0;
		$date = date_create($data->history_date);
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->history_ip);
        xlsWriteLabel($tablebody, $kolombody++, $data->history_browser_info);
        xlsWriteLabel($tablebody, $kolombody++, $data->history_referer);
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
    header("Content-Disposition: attachment;Filename=admin_login_history.doc");

    $data = array(
        'admin_login_history_data' => $this->Admin_login_history_model->get_all(),
        'start' => 0
        );

    $this->load->view('admin_login_history/admin_login_history_doc',$data);
}

}

/* End of file Admin_login_history.php */
/* Location: ./application/controllers/Admin_login_history.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-06 02:08:22 */
/* http://harviacode.com */