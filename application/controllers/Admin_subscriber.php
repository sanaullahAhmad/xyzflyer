<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_subscriber extends CI_Controller
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
        $this->load->model('Subscriber_history_model');
        $this->load->library('form_validation');
    }


    public function index()
    {
        if(xyzAccesscontrol('activity_managment','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $subscriber_activity = $this->Subscriber_history_model->get_all();

        $data = array(
            'subscriber_activity_data' => $subscriber_activity
        );
		//echo "<pre>"; 
		//print_r( $data);exit;
        // $this->load->view('users_activity/users_activity_list', $data);
		$this->breadcrumbs->push('Logs', '/admin_logs');
		$this->breadcrumbs->push('Subscriber Activity List', '/subscriber_history/index');
        $this->commonmodel->adminloadLayout($data,'subscriber_history/subscriber_history_list');
    }

    public function read($id)
    {
        if(xyzAccesscontrol('activity_managment','Read')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Subscriber_history_model->get_record($id);
        if ($row) {
       
			 
			$data=array(
				'subId' =>$row->subId,
				'subName'  => $row->subFirstName.' '.$row->subLastName,	
				'subEmail' => $row->subEmail,
				'subCountry' => $row->subCountry,
				'subCreationDate' =>  $row->subCreationDate
			 );
			//  print_r($data);exit;
            // $this->load->view('users_activity/users_activity_read', $data);
			$this->breadcrumbs->push('subscriber Logs', '/admin_logs');
			$this->breadcrumbs->push('subscriber Detail', '/subscriber_history/read');
            $this->commonmodel->adminloadLayout($data,'subscriber_history/subscriber_history_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users_activity'));
        }
    }


    public function delete($id)
    {
        if(xyzAccesscontrol('activity_managment','Delete')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Subscriber_history_model->get_by_id($id);

        if ($row) {
            $this->Subscriber_history_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Record Deleted Success</div>');
            redirect(site_url('Admin_subscriber'));
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Record Not Found</div>');
            redirect(site_url('Admin_subscriber'));
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
        $namaFile = "SubscriberHistory.xls";
        $judul = "Subscriber_History";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Email");
    	xlsWriteLabel($tablehead, $kolomhead++, "Referrer");
    	xlsWriteLabel($tablehead, $kolomhead++, "Date");

	    foreach ($this->Subscriber_history_model->get_all() as $data) {
		
            $kolombody = 0;
    		$date = date_create($data->history_date);
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->history_ip);
    	    xlsWriteLabel($tablebody, $kolombody++,  $data->history_browser_info);
    		xlsWriteLabel($tablebody, $kolombody++,  $data->subEmail);
    	    xlsWriteLabel($tablebody, $kolombody++,   $data->history_referer);
    	    xlsWriteLabel($tablebody, $kolombody++, date_format($date, 'm-d-Y Hi').'hrs');

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=subscriber_activity.doc");

        $data = array(
            'subscriber_activity_data' => $this->Subscriber_history_model->get_all(),
            'start' => 0
        );

        $this->load->view('subscriber_history/subscriber_doc',$data);
    }


}

/* End of file Users_activity.php */
/* Location: ./application/controllers/Users_activity.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-16 18:02:55 */
/* http://harviacode.com */