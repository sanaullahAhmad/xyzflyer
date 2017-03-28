<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_orders extends CI_Controller
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
        $this->load->model('Admin_orders_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(xyzAccesscontrol('order_managment','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin_orders/index.aspx?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin_orders/index.aspx?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin_orders/index.aspx';
            $config['first_url'] = base_url() . 'admin_orders/index.aspx';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_orders_model->total_rows($q);
        $admin_orders = $this->Admin_orders_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_orders_data' => $admin_orders,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
			$data['pending']=$this->commonmodel->getSingleRecord("SELECT count(`daorder_status`) as 'pending' from tbl_orders WHERE `daorder_status`='0'");
			$data['approved']=$this->commonmodel->getSingleRecord("SELECT count(`daorder_status`) as 'approved' from tbl_orders WHERE `daorder_status`='1'");
			$data['rejected']=$this->commonmodel->getSingleRecord("SELECT count(`daorder_status`) as 'rejected' from tbl_orders WHERE `daorder_status`='2'");
			
	   // echo "<pre>";print_r($data);exit;
        // $this->load->view('admin_orders/tbl_orders_list', $data);
		$this->breadcrumbs->push('Orders', '/admin_orders');
		$this->breadcrumbs->push('Orders List', '/admin_orders/index');
			
        $this->commonmodel->adminloadLayout($data,'admin_orders/tbl_orders_list');
    }
	
	 public function sortOrders()
    {
        $sort = urldecode($this->input->get('sort', TRUE));
        $start = intval($this->input->get('start'));
        if ($sort <> '') {
            $config['base_url'] = base_url() . 'admin_orders/sortOrders.aspx?sort=' . urlencode($sort);
            $config['first_url'] = base_url() . 'admin_orders/sortOrders.aspx?sort=' . urlencode($sort);
        } else {
            $config['base_url'] = base_url() . 'admin_orders/index.aspx';
            $config['first_url'] = base_url() . 'admin_orders/index.aspx';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_orders_model->total_rows_sort($sort);
        $admin_orders = $this->Admin_orders_model->get_sorted_orders($config['per_page'], $start, $sort);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_orders_data' => $admin_orders,
            'sort' => $sort,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
		$data['pending']=$this->commonmodel->getSingleRecord("SELECT count(`daorder_status`) as 'pending' from tbl_orders WHERE `daorder_status`='0'");
		$data['approved']=$this->commonmodel->getSingleRecord("SELECT count(`daorder_status`) as 'approved' from tbl_orders WHERE `daorder_status`='1'");
		$data['rejected']=$this->commonmodel->getSingleRecord("SELECT count(`daorder_status`) as 'rejected' from tbl_orders WHERE `daorder_status`='2'");
		$data['rec']=$this->commonmodel->getMultipleRecords("SELECT `daorder_id` FROM `tbl_orders` WHERE `daorder_status` = '0'");
		$this->breadcrumbs->push('Orders', '/admin_orders');
		$this->breadcrumbs->push('Orders List', '/admin_orders/index');
			
        $this->commonmodel->adminloadLayout($data,'admin_orders/tbl_orders_list');
    } 
	
    public function records()
    {
        $records = urldecode($this->input->get('records', TRUE));
        /*echo "<pre>";
        print_r(gettype($records));
        exit;*/
        $start = intval($this->input->get('start'));
        if ($records <> '') {
            $config['base_url'] = base_url() . 'admin_orders/sortOrders.aspx?sort=' . urlencode($records);
            $config['first_url'] = base_url() . 'admin_orders/sortOrders.aspx?sort=' . urlencode($records);
        } else {
            $config['base_url'] = base_url() . 'admin_orders/index.aspx';
            $config['first_url'] = base_url() . 'admin_orders/index.aspx';
        }

        $config['per_page'] = ((intval($records) >= 10) ? intval($records) : 10);
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = count($this->Admin_orders_model->get_limit_records($start, intval($records)));
        $admin_orders = $this->Admin_orders_model->get_limit_records($start, intval($records));
        /*echo "<pre>";
        print_r($admin_orders);
        exit;*/
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_orders_data' => $admin_orders,
            'records' => $records,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['pending']=$this->commonmodel->getSingleRecord("SELECT count(`daorder_status`) as 'pending' from tbl_orders WHERE `daorder_status`='0'");
        $data['approved']=$this->commonmodel->getSingleRecord("SELECT count(`daorder_status`) as 'approved' from tbl_orders WHERE `daorder_status`='1'");
        $data['rejected']=$this->commonmodel->getSingleRecord("SELECT count(`daorder_status`) as 'rejected' from tbl_orders WHERE `daorder_status`='2'");
        $data['rec']=$this->commonmodel->getMultipleRecords("SELECT `daorder_id` FROM `tbl_orders` WHERE `daorder_status` = '0'");
        $this->breadcrumbs->push('Orders', '/admin_orders');
        $this->breadcrumbs->push('Orders List', '/admin_orders/index');
            
        $this->commonmodel->adminloadLayout($data,'admin_orders/tbl_orders_list');
    } 

    public function read($id)
    {
       /* $data['order_data'] = $this->Admin_orders_model->getOrders($id);
              $data['UserActivity']= $this->Admin_orders_model->get_all_by_user($id);
             
              $data['us_state']=$this->commonmodel->state_list;
*/
        $data['order_data'] = $this->Admin_orders_model->get_flyer_order_user_by_ordeerid($id);
        /*echo "<pre>";
        print_r($data['order_data']);exit;*/
        $data['user_data'] = $this->Admin_orders_model->get_user_by_id($data['order_data']->user_id);

		$data['order_detail'] = $this->Admin_orders_model->get_order_counties($id);

		$this->breadcrumbs->push('Orders', '/admin_orders');
		$this->breadcrumbs->push('Order detail', '/admin_orders/read');
		
        if ($data['order_data']){
            $this->commonmodel->adminloadLayout($data,'admin_orders/tbl_orders_read');
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('admin_orders'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin_orders/create_action'),
    	    'daorder_id' => set_value('daorder_id'),
    	    'daorder_flyer_id' => set_value('daorder_flyer_id'),
    	    //'daorder_user_flyer_id' => set_value('daorder_user_flyer_id'),
    	    'daorder_price' => set_value('daorder_price'),
    	    'daorder_date' => set_value('daorder_date'),
    	    'daorder_status' => set_value('daorder_status'),
    	    'daorder_rejection_reason' => set_value('daorder_rejection_reason'),
    	    'daorder_user_id' => set_value('daorder_user_id'),
    	    'daoder_admin_id' => set_value('daoder_admin_id'),
    	    'daorder_modified_date' => set_value('daorder_modified_date'),
    	    'daorder_modified_by' => set_value('daorder_modified_by'),
	);
        // $this->load->view('admin_orders/tbl_orders_form', $data);
		$this->breadcrumbs->push('Orders', '/admin_orders');
		$this->breadcrumbs->push('Add Order', '/admin_orders/create');
        $this->commonmodel->adminloadLayout($data,'admin_orders/tbl_orders_form');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'daorder_flyer_id' => $this->input->post('daorder_flyer_id',TRUE),
		//'daorder_user_flyer_id' => $this->input->post('daorder_user_flyer_id',TRUE),
		'daorder_price' => $this->input->post('daorder_price',TRUE),
		'daorder_date' => $this->input->post('daorder_date',TRUE),
		'daorder_status' => $this->input->post('daorder_status',TRUE),
		'daorder_rejection_reason' => $this->input->post('daorder_rejection_reason',TRUE),
		'daorder_user_id' => $this->input->post('daorder_user_id',TRUE),
		'daoder_admin_id' => $this->input->post('daoder_admin_id',TRUE),
		'daorder_modified_date' => $this->input->post('daorder_modified_date',TRUE),
		'daorder_modified_by' => $this->input->post('daorder_modified_by',TRUE),
	    );

            $this->Admin_orders_model->insert($data);
            $this->session->set_flashdata('message', '<span class="alert-success">Create Record Success</span>');
            log_queries('admin', 0, 'orders', $this->input->post('daorder_flyer_id',TRUE));
            redirect(site_url('admin_orders'));
        }
    }

    public function update($id)
    {
        $row = $this->Admin_orders_model->get_by_id($id);

        if ($row) {
        $data = array(
        'button' => 'Update',
        'action' => site_url('admin_orders/update_action'),
		'daorder_id' => set_value('daorder_id', $row->daorder_id),
		'daorder_flyer_id' => set_value('daorder_flyer_id', $row->daorder_flyer_id),
		//'daorder_user_flyer_id' => set_value('daorder_user_flyer_id', $row->daorder_user_flyer_id),
		'daorder_price' => set_value('daorder_price', $row->daorder_price),
		'daorder_date' => set_value('daorder_date', $row->daorder_date),
		'daorder_status' => set_value('daorder_status', $row->daorder_status),
		'daorder_rejection_reason' => set_value('daorder_rejection_reason', $row->daorder_rejection_reason),
		'daorder_user_id' => set_value('daorder_user_id', $row->daorder_user_id),
		'daoder_admin_id' => set_value('daoder_admin_id', $row->daoder_admin_id),
		'daorder_modified_date' => set_value('daorder_modified_date', $row->daorder_modified_date),
		'daorder_modified_by' => set_value('daorder_modified_by', $row->daorder_modified_by),
	    );
            // $this->load->view('admin_orders/tbl_orders_form', $data);
		$this->breadcrumbs->push('Orders', '/admin_orders');
		$this->breadcrumbs->push('Update Order', '/admin_orders/update');
            $this->commonmodel->adminloadLayout($data,'admin_orders/tbl_orders_form');
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('admin_orders'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('daorder_id', TRUE));
        } else {
            $data = array(
		'daorder_flyer_id' => $this->input->post('daorder_flyer_id',TRUE),
		//'daorder_user_flyer_id' => $this->input->post('daorder_user_flyer_id',TRUE),
		'daorder_price' => $this->input->post('daorder_price',TRUE),
		'daorder_date' => $this->input->post('daorder_date',TRUE),
		'daorder_status' => $this->input->post('daorder_status',TRUE),
		'daorder_rejection_reason' => $this->input->post('daorder_rejection_reason',TRUE),
		'daorder_user_id' => $this->input->post('daorder_user_id',TRUE),
		'daoder_admin_id' => $this->input->post('daoder_admin_id',TRUE),
		'daorder_modified_date' => $this->input->post('daorder_modified_date',TRUE),
		'daorder_modified_by' => $this->input->post('daorder_modified_by',TRUE),
	    );

            $this->Admin_orders_model->update($this->input->post('daorder_id', TRUE), $data);
            $this->session->set_flashdata('message', '<span class="alert-success">Update Record Success</span>');
            log_queries('admin', 1, 'orders', $this->input->post('daorder_flyer_id',TRUE));
            redirect(site_url('admin_orders'));
        }
    }
    //check order 
    public function check_order(){
    	 if(isset($_POST["oid"]) && $_POST["oid"]!=""){
    	 	$orderId=$this->input->post("oid");
    	 	$orderData = $this->commonmodel->getSingleRecord("SELECT *
            FROM tbl_orders
            WHERE daorder_id = '".$orderId."'");
             if($orderData->daorder_status==0){
            	echo "<form method='post' action='".base_url()."admin_orders/process'>";
            	echo "<div class='form-group'>";
				echo "<div class='form-check'>";
          		echo "<label class='form-check-label'>";
            	echo "<input class='form-check-input' type='radio' name='processStatus' id='approve' value='1' checked> Approve</label>&nbsp;&nbsp;&nbsp;";
          		echo "<label class='form-check-label'>";
            	echo "<input class='form-check-input' type='radio' name='processStatus' id='reject' value='2'> Reject</label>";
            	echo "</div>";
    			echo "</div>";
          		echo "<div class='form-group' id='rejreason' style='display:none;'>";
            	echo "<label for='reason'>Rejection Reason</label>";
            	echo "<textarea id='reason' name='reason' class='form-control' disabled='disabled'>".$orderData->daorder_rejection_reason."</textarea>";
               echo "<input type='hidden' name='orderid' value='".$orderId."' />";
          		echo "</div>";
                echo "<button type='submit' class='btn btn-default'>Submit</button>";
                echo "</form>";

            }else  if($orderData->daorder_status==1){
            	echo "<h3 class='alert-warning'>The order is already approved !.It is not allowed to process.";

            }else  if($orderData->daorder_status==2){
                echo "<h3 class='alert-danger'>The order is already Rejected !.It is not allowed to process.";

            }else{
            	echo "<h3 class='alert-danger'>There is an error in your processing.</h3>";
            }
            //echo "<pre>";
            //print_r($orderData);
    	 }
    }
    //process order
    public function process(){
        if(isset($_POST['orderid']) && isset($_POST['processStatus']) && $_POST['orderid']!=""){
        	$orderId=$this->input->post('orderid');
			
		if(isset($_SERVER['HTTP_REFERER'])){
			$redirect=$_SERVER['HTTP_REFERER'];
		}else{
			$redirect=base_url()."admin_orders/";
		}
            $orderData = $this->commonmodel->getSingleRecord("SELECT *
            FROM tbl_orders
            WHERE daorder_id = '".$orderId."'");
            if($orderData->daorder_status==1){
            $this->session->set_flashdata('message', '<span class="alert-danger">The order is already processed.No action is allowed.</span>');
            redirect($redirect);
            exit;
            }else if($orderData->daorder_status==2){
            $this->session->set_flashdata('message', '<span class="alert-danger">The order is already Rejected.No action is allowed.</span>');
            redirect($redirect);
            }else if($orderData->daorder_status == 0 && $this->input->post('processStatus')==1){
                $paydata=$this->commonmodel->getSingleRecord("SELECT * FROM tbl_payment_info WHERE order_id='".$orderId."' AND status='AUTH'");
                if($paydata){
                   $pay=$this->processPayment($paydata,'APPROVAL');
                   if($pay=='Success'){
                    //Update order table
                    $this->commonmodel->update('tbl_orders',array('daorder_status'=>1,'daorder_rejection_reason'=>''),array('daorder_id'=>$orderId));
                    //Update payment table
                    $this->commonmodel->update('tbl_payment_info',array('status'=>'COMPLETE'),array('order_id'=>$paydata->order_id,'ssl_txn_id'=>$paydata->ssl_txn_id));
                    $this->session->set_flashdata('message', '<span class="alert-success">The order is processed Successfully.</span>');
                    redirect($redirect);
                    exit;
                 }else{
                 	$this->session->set_flashdata('message', '<span class="alert-danger">'.$pay.'</span>');
                    redirect($redirect);
                    exit;
                 }
                }else{     
                	$this->session->set_flashdata('message', '<span class="alert-danger">No Transaction info is provided for this order.</span>');
                    redirect($redirect);
                    exit;
                }
              
            }else if($orderData->daorder_status == 0 && $this->input->post('processStatus')==2){
                if($this->input->post('reason')){
                    $reason = $this->input->post('reason');
                }else{
                    $reason = "";
                }
                $paydata=$this->commonmodel->getSingleRecord("SELECT * FROM tbl_payment_info WHERE order_id='".$orderId."' AND status='AUTH'");
                if($paydata){
                   $pay=$this->processPayment($paydata,'DECLINED');
                   if($pay=='Success'){
                    //Update order table
                    $result=$this->commonmodel->update('tbl_orders',array('daorder_status'=>2,'daorder_rejection_reason'=>$reason),array('daorder_id'=>$orderId));
                    //Update payment table
                    $this->commonmodel->update('tbl_payment_info',array('status'=>'DECLINED'),array('order_id'=>$paydata->order_id,'ssl_txn_id'=>$paydata->ssl_txn_id));
                    $this->session->set_flashdata('message', '<span class="alert-danger">Successfully Order Rejected.</span>');
                    redirect($redirect);
                    exit;
                }else{
                	$this->session->set_flashdata('message', '<span class="alert-danger">'.$pay.'</span>');
                    redirect($redirect);
                    exit;
                }
            }else{
               $this->session->set_flashdata('message', '<span class="alert-danger">No Transaction info is provided for this order.</span>');
               redirect($redirect);
               exit;
            }
        }else{
        	$this->session->set_flashdata('message', '<span class="alert-danger">There is an error in the order.Cannot proceed.</span>');
            redirect($redirect);
            exit;
        }

    }else{
		$this->session->set_flashdata('message', '<span class="alert-danger">Error occured please try again.</span>');
            redirect($redirect);
            exit;
	}
}
    protected function processPayment($data=array(),$action=NULL){
        if(isset($data->ssl_txn_id)){
            $this->load->library('convergeapi');
            // Sale the order
           if($action=='APPROVAL'){
            $response = $this->convergeapi->cccomplete(
                  array(
                        'ssl_txn_id' => $data->ssl_txn_id,
                        'ssl_amount' => $data->amount,
                        'ssl_partial_shipment_flag' => 'N'//N – Partial Shipment not supported,Y – Partial Shipment supported
                    )
                );
           }else if($action=='DECLINED'){
            //DELETE KI QUERY
            $response = $this->convergeapi->ccdelete(
                  array(
                        'ssl_txn_id' => $data->ssl_txn_id
                    )
                );
            }
            //Above are deiffernt status
            // echo "<pre>";print_r($response); echo "</pre>"; exit;
            if(isset($response['errorMessage'])){
                if($response['errorCode']==4025){
					return  $response= "Invalid Payment Information has been provided";	
					 
           		}else{
					return $response['errorMessage'];
				}
            }else if($response['ssl_result_message']=='APPROVAL' && $response['ssl_txn_id']!=""){
                return 'Success';
            }else if($response['ssl_result_message']=='APPROVED' && $response['ssl_txn_id']!=""){
                return 'Success';
            }else{
                return 'Invalid Access';
            }
        }else{
                return 'No transaction id provided';
        }

    }

    public function delete($id)
    {
        $row = $this->Admin_orders_model->get_by_id($id);

        if ($row) {
            $this->Admin_orders_model->delete($id);
            $this->session->set_flashdata('message', '<span class="alert-success">Delete Record Success</span>');
            log_queries('admin', 2, 'orders', $id);
            redirect(site_url('admin_orders'));
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('admin_orders'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('daorder_flyer_id', 'daorder flyer id', 'trim|required');
	//$this->form_validation->set_rules('daorder_user_flyer_id', 'daorder user flyer id', 'trim|required');
	$this->form_validation->set_rules('daorder_price', 'daorder price', 'trim|required');
	$this->form_validation->set_rules('daorder_date', 'daorder date', 'trim|required');
	$this->form_validation->set_rules('daorder_status', 'daorder status', 'trim|required');
	$this->form_validation->set_rules('daorder_rejection_reason', 'daorder rejection reason', 'trim|required');
	$this->form_validation->set_rules('daorder_user_id', 'daorder user id', 'trim|required');
	$this->form_validation->set_rules('daoder_admin_id', 'daoder admin id', 'trim|required');
	$this->form_validation->set_rules('daorder_modified_date', 'daorder modified date', 'trim|required');
	$this->form_validation->set_rules('daorder_modified_by', 'daorder modified by', 'trim|required');

	$this->form_validation->set_rules('daorder_id', 'daorder_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_orders.xls";
        $judul = "tbl_orders";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Daorder Flyer Id");
	//xlsWriteLabel($tablehead, $kolomhead++, "Daorder User Flyer Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Daorder Price");
	xlsWriteLabel($tablehead, $kolomhead++, "Daorder Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Daorder Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Daorder Rejection Reason");
	xlsWriteLabel($tablehead, $kolomhead++, "Daorder User Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Daoder Admin Id");


	foreach ($this->Admin_orders_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->daorder_flyer_id);
    	    //xlsWriteNumber($tablebody, $kolombody++, $data->daorder_user_flyer_id);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->daorder_price);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->daorder_date);
    	    xlsWriteLabel($tablebody, $kolombody++, format($data->daorder_status, 'order_status'));
    	    xlsWriteLabel($tablebody, $kolombody++, $data->daorder_rejection_reason);
    	    xlsWriteNumber($tablebody, $kolombody++, format($data->daorder_user_id, 'user'));
    	    xlsWriteNumber($tablebody, $kolombody++, format($data->daoder_admin_id), 'admin');


	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_orders.doc");

        $data = array(
            'admin_orders_data' => $this->Admin_orders_model->get_all(),
            'start' => 0
        );

        $this->load->view('admin_orders/tbl_orders_doc',$data);
    }

}

/* End of file Admin_orders.php */
/* Location: ./application/controllers/Admin_orders.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-02 15:47:29 */
/* http://harviacode.com */