<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_flyers extends CI_Controller
{
    function __construct()
    {
       parent::__construct();
        $this->load->model('frontend/commonmodel');
        if(xyzAccesscontrol('flyer_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0)
        // {
        //     $this->commonmodel->no_permissions();
        // }
        $this->load->model('Admin_flyers_model');
        $this->load->library('form_validation');
    }

    public function index()
    {	
		$q=null;
		$search=null;
        if(xyzAccesscontrol('flyer_managment','Read')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
		if($this->input->get('sort')){
			$q = urldecode($this->input->get('sort', TRUE));
			$search=$q;
		}elseif($this->input->get('q')){
			$q = urldecode($this->input->get('q', TRUE));
			$search="search";
		}

        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin_flyers/index.aspx?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin_flyers/index.aspx?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin_flyers/index.aspx';
            $config['first_url'] = base_url() . 'admin_flyers/index.aspx';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_flyers_model->total_rows($q);
        $admin_flyers = $this->Admin_flyers_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_flyers_data' => $admin_flyers,
            'q' => $search,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('admin_flyers/tbl_flyer_detail_list', $data);
		$this->breadcrumbs->push('Admin Flyers', '/Admin_flyers');
		$this->breadcrumbs->push('Flyer List', '/Admin_flyers/index');
			
        $this->commonmodel->adminloadLayout($data,'admin_flyers/tbl_flyer_detail_list');
		
    }

    public function flyers_management()
    {
        if(xyzAccesscontrol('flyer_managment','Read')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $check = $this->commonmodel->permissions_check();
        /*if($check == 0)
        {*/
            $this->commonmodel->adminloadLayout(null,'admins/flyers_management');
        /*}
        else $this->commonmodel->adminloadLayout(null,'admin/no_permissions');*/
    }
    public function showfront(){
         if(xyzAccesscontrol('flyer_managment','Status')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
    $flyerId=$this->uri->segment(3);
    $data= $this->commonmodel->getSingleRecord("SELECT * from tbl_flyer_detail where pk_flyer_detail_id=".$flyerId."");
        if($data){
            if($data->show_on_homepage==0){
                $this->commonmodel->update('tbl_flyer_detail',array('show_on_homepage'=>1),array('pk_flyer_detail_id'=>$flyerId));
            }else{
                $this->commonmodel->update('tbl_flyer_detail',array('show_on_homepage'=>0),array('pk_flyer_detail_id'=>$flyerId));
            }
          }
          redirect(site_url('admin_flyers'));
    }
    public function read($id)
    {
        if(xyzAccesscontrol('flyer_managment','Read')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Admin_flyers_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'pk_flyer_detail_id' => $row->pk_flyer_detail_id,
        		'flyer_title' => $row->flyer_title,
        		'flyer_image' => $row->flyer_image,
        		'flyer_image_size_id' => $row->flyer_image_size,
                'flyer_image_size' => $row->flyer_size_title,
        		'flyer_created_image' => $row->flyer_created_image,
        		'flyer_json_file' => $row->flyer_json_file,
        		'flyer_status' => $row->flyer_status,
        		'flyer_approved' => $row->flyer_approved,
        		'flyer_approved_by' => $row->flyer_approved_by,
        		'flyer_creation_date' => $row->flyer_creation_date,
        		'admin_id' => $row->admin_id,
                'admin' => $row->admin_firstname." ".$row->admin_lastname,
        		'modified_by' => $row->modified_by,
        		'modified_date' => $row->modified_date,
        	    );
            // $this->load->view('admin_flyers/tbl_flyer_detail_read', $data);
			
			$this->breadcrumbs->push('Admin Flyers', '/Admin_flyers');
			$this->breadcrumbs->push('Flyer Detail', '/Admin_flyers/read');
            $this->commonmodel->adminloadLayout($data, 'admin_flyers/tbl_flyer_detail_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_flyers'));
        }
    }

    public function create()
    {
        if(xyzAccesscontrol('flyer_managment','Add')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin_flyers/create_action'),
    	    'pk_flyer_detail_id' => set_value('pk_flyer_detail_id'),
    	    'flyer_title' => set_value('flyer_title'),
    	    'flyer_image' => set_value('flyer_image'),
    	    'flyer_image_size' => set_value('flyer_image_size'),
    	    'flyer_created_image' => set_value('flyer_created_image'),
    	    'flyer_json_file' => set_value('flyer_json_file'),
    	    'flyer_status' => set_value('flyer_status'),
    	    'flyer_approved' => set_value('flyer_approved'),
    	    'flyer_approved_by' => set_value('flyer_approved_by'),
    	    'flyer_creation_date' => set_value('flyer_creation_date'),
    	    'admin_id' => set_value('admin_id'),
    	    'modified_by' => set_value('modified_by'),
    	    'modified_date' => set_value('modified_date'),
	);
        // $this->load->view('admin_flyers/tbl_flyer_detail_form', $data);
		$this->breadcrumbs->push('Admin Flyers', '/Admin_flyers');
	    $this->breadcrumbs->push('Add Flyer', '/Admin_flyers/create');
        $this->commonmodel->adminloadLayout($data, 'admin_flyers/tbl_flyer_detail_form');
    }

    public function create_action()
    {
        if(xyzAccesscontrol('flyer_managment','Add')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'flyer_title' => $this->input->post('flyer_title',TRUE),
        		'flyer_image' => $this->input->post('flyer_image',TRUE),
        		'flyer_image_size' => $this->input->post('flyer_image_size',TRUE),
        		'flyer_created_image' => $this->input->post('flyer_created_image',TRUE),
        		'flyer_json_file' => $this->input->post('flyer_json_file',TRUE),
        		'flyer_status' => $this->input->post('flyer_status',TRUE),
        		'flyer_approved' => $this->input->post('flyer_approved',TRUE),
        		'flyer_approved_by' => $this->input->post('flyer_approved_by',TRUE),
        		'flyer_creation_date' => $this->input->post('flyer_creation_date',TRUE),
        		'admin_id' => $this->input->post('admin_id',TRUE),
        		'modified_by' => $this->input->post('modified_by',TRUE),
        		'modified_date' => $this->input->post('modified_date',TRUE),
        	    );

            $this->Admin_flyers_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            log_queries('admin', 0, 'flyers', $this->input->post('flyer_title',TRUE));
            redirect(site_url('admin_flyers'));
        }
    }

    public function update($id)
    {
        if(xyzAccesscontrol('flyer_managment','Edit')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $row = $this->Admin_flyers_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin_flyers/update_action'),
		'pk_flyer_detail_id' => set_value('pk_flyer_detail_id', $row->pk_flyer_detail_id),
		'flyer_title' => set_value('flyer_title', $row->flyer_title),
		'flyer_image' => set_value('flyer_image', $row->flyer_image),
		'flyer_image_size' => set_value('flyer_image_size', $row->flyer_image_size),
		'flyer_created_image' => set_value('flyer_created_image', $row->flyer_created_image),
		'flyer_json_file' => set_value('flyer_json_file', $row->flyer_json_file),
		'flyer_status' => set_value('flyer_status', $row->flyer_status),
		'flyer_approved' => set_value('flyer_approved', $row->flyer_approved),
		'flyer_approved_by' => set_value('flyer_approved_by', $row->flyer_approved_by),
		'flyer_creation_date' => set_value('flyer_creation_date', $row->flyer_creation_date),
		'admin_id' => set_value('admin_id', $row->admin_id),
		'admin_name' => set_value('admin_name', $row->admin_firstname." ".$row->admin_lastname),
		'modified_by' => set_value('modified_by', $row->modified_by),
		'modified_date' => set_value('modified_date', $row->modified_date),
	    );
			
			$this->breadcrumbs->push('Admin Flyers', '/Admin_flyers');
			$this->breadcrumbs->push('Update Flyer', '/Admin_flyers/update');
		
            // $this->load->view('admin_flyers/tbl_flyer_detail_form', $data);
            $this->commonmodel->adminloadLayout($data, 'admin_flyers/tbl_flyer_detail_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_flyers'));
        }
    }

    public function update_action()
    {
        if(xyzAccesscontrol('flyer_managment','Edit')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pk_flyer_detail_id', TRUE));
        } else {
            $data = array(
		'flyer_title' => $this->input->post('flyer_title',TRUE),
		'flyer_image' => $this->input->post('flyer_image',TRUE),
		'flyer_image_size' => $this->input->post('flyer_image_size',TRUE),
		'flyer_created_image' => $this->input->post('flyer_created_image',TRUE),
		'flyer_json_file' => $this->input->post('flyer_json_file',TRUE),
		'flyer_status' => $this->input->post('flyer_status',TRUE),
		'flyer_approved' => $this->input->post('flyer_approved',TRUE),
		'flyer_approved_by' => $this->input->post('flyer_approved_by',TRUE),
		'flyer_creation_date' => $this->input->post('flyer_creation_date',TRUE),
		'admin_id' => $this->input->post('admin_id',TRUE),
		'modified_by' => $this->input->post('modified_by',TRUE),
		'modified_date' => $this->input->post('modified_date',TRUE),
	    );

            $this->Admin_flyers_model->update($this->input->post('pk_flyer_detail_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            log_queries('admin', 1, 'flyers', $this->input->post('flyer_title',TRUE));
            redirect(site_url('admin_flyers'));
        }
    }

    public function delete($id)
    {
        if(xyzAccesscontrol('flyer_managment','Delete')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $this->load->model('admin/flyersmodel');

         $flyer = $this->flyersmodel->get_flyer_by_id($id);

        if($flyer && count((array)$flyer)>0)
        {
                // remove flyer designed image file if any

                $admin_id = $flyer->admin_id;
                $this->load->model('Admins_model');
                $admin = $this->Admins_model->get_by_id($admin_id);


                if(strval($admin->admin_type) === "0"){
                $this->flyersmodel->remove_flyer($id);
                    log_queries('admin', 2, 'flyers', $id);
                    // remove flyer tag relations
                $this->flyersmodel->remove_flyer_tags($id);

                // remove flyer properties if any
                $this->flyersmodel->remove_flyer_properties($id);

                // remove flyer image
                $file = './public/upload/flyer_images/'.$flyer->flyer_image;
                    if(file_exists($file)) unlink($file);

                $file = './public/upload/flyer_images/resized_'.$flyer->flyer_image;
                    if(file_exists($file)) unlink($file);

                $file = './public/upload/flyer_images/thumb_'.$flyer->flyer_image;
                    if(file_exists($file)) unlink($file);

                // remove flyer json flie
                $file = './public/upload/files/flyers/'.$flyer->flyer_json_file;
                    if(file_exists($file)) unlink($file);

                $this->session->set_flashdata('message', 'Delete Record Success');
                log_queries('other-admin', 2, 'flyers', $id);

                }else{

                    $this->session->set_flashdata('message', 'Updated Record Success');

                    $this->Admin_flyers_model->update($id, ["flyer_status" => "Published"]);
                    log_queries('other-admin', 1, 'flyers', $id);

                }





                redirect(site_url('admin_flyers'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_flyers'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('flyer_title', 'flyer title', 'trim|required');
	$this->form_validation->set_rules('flyer_image', 'flyer image', 'trim|required');
	$this->form_validation->set_rules('flyer_image_size', 'flyer image size', 'trim|required');
	$this->form_validation->set_rules('flyer_created_image', 'flyer created image', 'trim|required');
	$this->form_validation->set_rules('flyer_json_file', 'flyer json file', 'trim|required');
	$this->form_validation->set_rules('flyer_status', 'flyer status', 'trim|required');
	//$this->form_validation->set_rules('flyer_approved', 'flyer approved', 'trim|required');
	$this->form_validation->set_rules('flyer_approved_by', 'flyer approved by', 'trim|required');
	$this->form_validation->set_rules('flyer_creation_date', 'flyer creation date', 'trim|required');
	$this->form_validation->set_rules('admin_id', 'admin id', 'trim|required');
	$this->form_validation->set_rules('modified_by', 'modified by', 'trim|required');
	$this->form_validation->set_rules('modified_date', 'modified date', 'trim|required');

	$this->form_validation->set_rules('pk_flyer_detail_id', 'pk_flyer_detail_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        if(xyzAccesscontrol('flyer_managment','Excel')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        $this->load->helper('exportexcel');
        $namaFile = "tbl_flyer_detail.xls";
        $judul = "tbl_flyer_detail";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Title");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Image");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Approved");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Approved By");
	xlsWriteLabel($tablehead, $kolomhead++, "Flyer Creation Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Admin Id");


	foreach ($this->Admin_flyers_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_title);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_image);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_approved);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->flyer_approved_by, 'admin'));
	    xlsWriteLabel($tablebody, $kolombody++, $data->flyer_creation_date);
	    xlsWriteLabel($tablebody, $kolombody++, format($data->admin_id, 'admin'));


	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        if(xyzAccesscontrol('flyer_managment','Word')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_flyer_detail.doc");

        $data = array(
            'admin_flyers_data' => $this->Admin_flyers_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin_flyers/tbl_flyer_detail_doc',$data);
    }
    public function flyer_status(){
        if(xyzAccesscontrol('flyer_managment','Status')!=TRUE){
              redirect(site_url('_backoffice'));
            exit;
        }
       $flyerID= $this->uri->segment(2);
        $flyerData=$this->commonmodel->getSingleRecord("SELECT *
            FROM tbl_flyer_detail
            WHERE pk_flyer_detail_id='".$flyerID."'");
    if($flyerData){
        if($flyerData->flyer_status=='Draft'){
            $status='Published';
        }else{
           $status='Draft'; 
        }
        $result=$this->commonmodel->update('tbl_flyer_detail',array('flyer_status'=>$status),array('pk_flyer_detail_id'=>$flyerID));
        if($result){
            $this->session->set_flashdata('message', '<div class="alert alert-success">Status changed to '.$status.'</div>');
                redirect(site_url('admin_flyers'));

         }else{
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Some error !</div>');
                redirect(site_url('admin_flyers'));
        }
    }else{
         $this->session->set_flashdata('message', '<div class="alert alert-danger">Some error !</div>');
                redirect(site_url('admin_flyers'));
        }
   }
    /*The user section*/
    public function user_flyers(){
        if(xyzAccesscontrol('user_flyer','Read')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }

        $user_flyers = $this->Admin_flyers_model->get_user_flyer();
        $data = array(
            'flyers_data' => $user_flyers
        );
		//echo "<pre>";print_r($data);exit;
		$this->breadcrumbs->push('User Flyers', '/user_flyers');
		$this->breadcrumbs->push('Flyers List', '/admin_flyers/user_flyers');
			
        $this->commonmodel->adminloadLayout($data,'admin_flyers/users_flyers_list');
    }
    public function user_flyer_read(){
        if(xyzAccesscontrol('user_flyer','Read')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
       $flyerID=$this->uri->segment(3);
       $flyerData=$this->commonmodel->getSingleRecord("SELECT *
            FROM user_flyers
            WHERE uFlyerId='".$flyerID."'");
        $data = array(
            'flyers_data' => $flyerData
        );
		$this->breadcrumbs->push('User flyers', '/user_flyers');
		$this->breadcrumbs->push('Flyer Detail', '/admin_flyers/user_flyer_read');
        $this->commonmodel->adminloadLayout($data,'admin_flyers/users_flyers_read');
    }
    public function user_flyer_delete(){
        if(xyzAccesscontrol('user_flyer','Delete')!=TRUE){
             redirect(site_url('_backoffice'));
            exit;
        }
      $flyerID=$this->uri->segment(3);
      $flyerData=$this->commonmodel->getSingleRecord("SELECT user_flyers.*
            FROM user_flyers
            JOIN tbl_orders ON user_flyers.uFlyerId=tbl_orders.daorder_flyer_id
            WHERE user_flyers.uFlyerId=".$flyerID."");
     if($flyerData){
        $this->session->set_flashdata('message', '<div class="alert alert-danger">This flyer has order data so cannot deleted here.</div>');
            redirect(site_url('user_flyers'));

     }else{
            $result=$this->commonmodel->delete('user_flyers',array('uFlyerId' => $flyerID));
            if($result){
                if(!empty($flyerData->flyer_created_image) && $flyerData->repeater==0 && file_exists('./public/upload/user_flyer_store/'.$flyerData->flyer_created_image)){
                    unlink('./public/upload/user_flyer_store/'.$flyerData->flyer_created_image);

                }
                if(!empty($flyerData->flyer_created_thumb) && $flyerData->repeater==0 && file_exists('./public/upload/user_flyer_store/_thumbs/'.$flyerData->flyer_created_thumb)){
                    unlink('./public/upload/user_flyer_store/_thumbs/'.$flyerData->flyer_created_thumb);

                }
                if(!empty($flyerData->flyer_json_file) &&  $flyerData->repeater==0 && file_exists('./public/upload/flyer_json_files/'.$flyerData->flyer_json_file)){
                    unlink('./public/upload/flyer_json_files/'.$flyerData->flyer_json_file);

                }
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success">Successfully Deleted</div>');
            redirect(site_url('user_flyers'));
        }

    }

}

/* End of file Admin_flyers.php */
/* Location: ./application/controllers/Admin_flyers.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-20 01:34:11 */
/* http://harviacode.com */