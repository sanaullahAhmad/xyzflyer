<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flyer_tags extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(xyzAccesscontrol('flyer_tags','Full')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
        }
        $this->load->model('frontend/commonmodel');
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0)
        // {
        //     $this->commonmodel->no_permissions();
        // }

        $this->load->model('Flyer_tags_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(xyzAccesscontrol('flyer_tags','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'flyer_tags/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'flyer_tags/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'flyer_tags/index';
            $config['first_url'] = base_url() . 'flyer_tags/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Flyer_tags_model->total_rows($q);
        $flyer_tags = $this->Flyer_tags_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'flyer_tags_data' => $flyer_tags,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('flyer_tags/tbl_flyer_tags_list', $data);
		$this->breadcrumbs->push('Flyer Tags', '/Flyer_tags');
		    $this->breadcrumbs->push('Tags list', '/Flyer_tags/index');
        $this->commonmodel->adminloadLayout($data, 'flyer_tags/tbl_flyer_tags_list');
    }

    public function read($id)
    {
        $row = $this->Flyer_tags_model->get_by_id($id);
        if ($row) {
            $data = array(
		'pk_flyer_tags' => $row->pk_flyer_tags,
		'flyer_tags_title' => $row->flyer_tags_title,
		'flyer_tags_status' => $row->flyer_tags_status,
		'flyer_tags_date' => $row->flyer_tags_date,
		'admin_id' => $row->admin_id,
        'admin_username' => $row->admin_firstname." ".$row->admin_lastname 
	    );
			$this->breadcrumbs->push('FlyerTags', '/Flyer_tags');
		    $this->breadcrumbs->push('detail', '/Flyer_tags/read');
            // $this->load->view('flyer_tags/tbl_flyer_tags_read', $data);
            $this->commonmodel->adminloadLayout($data, 'flyer_tags/tbl_flyer_tags_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('flyer_tags'));
        }
    }

    public function create()
    {
        $data = array(
                'button' => 'Create',
                'action' => site_url('flyer_tags/create_action'),
        	    'pk_flyer_tags' => set_value('pk_flyer_tags'),
        	    'flyer_tags_title' => set_value('flyer_tags_title'),
        	    'flyer_tags_status' => set_value('flyer_tags_status'),
        	    'flyer_tags_date' => set_value('flyer_tags_date'),
        	    'admin_id' => set_value('admin_id'),
        	);
		$this->breadcrumbs->push('Flyer Tags', '/Flyer_tags');
		$this->breadcrumbs->push('Add Tag', '/Flyer_tags/create');
        // $this->load->view('flyer_tags/tbl_flyer_tags_form', $data);
        $this->commonmodel->adminloadLayout($data, 'flyer_tags/tbl_flyer_tags_form');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'flyer_tags_title' => $this->input->post('flyer_tags_title',TRUE),
		'flyer_tags_status' => $this->input->post('flyer_tags_status',TRUE),
		'flyer_tags_date' => $this->input->post('flyer_tags_date',TRUE),
		'admin_id' => $this->input->post('admin_id',TRUE),
	    );

            $this->Flyer_tags_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('flyer_tags'));
        }
    }

    public function update($id)
    {
        $row = $this->Flyer_tags_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('flyer_tags/update_action'),
        		'pk_flyer_tags' => set_value('pk_flyer_tags', $row->pk_flyer_tags),
        		'flyer_tags_title' => set_value('flyer_tags_title', $row->flyer_tags_title),
        		'flyer_tags_status' => set_value('flyer_tags_status', $row->flyer_tags_status),
        		'flyer_tags_date' => set_value('flyer_tags_date', $row->flyer_tags_date),
        		'admin_id' => set_value('admin_id', $row->admin_id),
        	    );
            // $this->load->view('flyer_tags/tbl_flyer_tags_form', $data);
			$this->breadcrumbs->push('FlyerTags', '/Flyer_tags');
		    $this->breadcrumbs->push('Update', '/Flyer_tags/update');
            $this->commonmodel->adminloadLayout($data,
                'flyer_tags/tbl_flyer_tags_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('flyer_tags'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pk_flyer_tags', TRUE));
        } else {
            $data = array(
            		'flyer_tags_title' => $this->input->post('flyer_tags_title',TRUE),
            		'flyer_tags_status' => $this->input->post('flyer_tags_status',TRUE),
            		'flyer_tags_date' => $this->input->post('flyer_tags_date',TRUE),
            		'admin_id' => $this->input->post('admin_id',TRUE),
            	    );

            $this->Flyer_tags_model->update($this->input->post('pk_flyer_tags', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('flyer_tags'));
        }
    }

    public function delete($id)
    {
        $row = $this->Flyer_tags_model->get_by_id($id);

        if ($row) {
            $this->Flyer_tags_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('flyer_tags'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('flyer_tags'));
        }
    }

    public function _rules()
    {
    	$this->form_validation->set_rules('flyer_tags_title', 'flyer tags title', 'trim|required');
    	$this->form_validation->set_rules('flyer_tags_status', 'flyer tags status', 'trim|required');
    	$this->form_validation->set_rules('flyer_tags_date', 'flyer tags date', 'trim|required');
    	$this->form_validation->set_rules('admin_id', 'admin id', 'trim|required');

    	$this->form_validation->set_rules('pk_flyer_tags', 'pk_flyer_tags', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_flyer_tags.xls";
        $judul = "tbl_flyer_tags";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Tags Title");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Tags Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Tags Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Admin Id");

	foreach ($this->Flyer_tags_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_tags_title);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_tags_status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_tags_date);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->admin_id, 'admin'));

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_flyer_tags.doc");

        $data = array(
            'flyer_tags_data' => $this->Flyer_tags_model->get_all(),
            'start' => 0
        );

        $this->load->view('flyer_tags/tbl_flyer_tags_doc',$data);
    }

}

/* End of file Flyer_tags.php */
/* Location: ./application/controllers/Flyer_tags.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-17 12:36:34 */
/* http://harviacode.com */