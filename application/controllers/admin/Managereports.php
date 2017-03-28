<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Managereports extends CI_Controller {

    /**
     * Constructor of a login
     */
    function __construct() {
        parent::__construct(); //call to parent constructor
        $this->load->model(array('admin/flyersmodel', 'frontend/commonmodel','admin/reportsmodel'));
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0 && $check!=1)
        // {
        //     $this->commonmodel->no_permissions();
        // }
        $this->load->library('form_validation');
    }

    /**
     * The orders report main page
     */
	   public function index() {
		    $data['sucess'] = $this->session->flashdata('sucess');
        $this->commonmodel->adminloadLayout( $data,'admins/reports_dashboard');
    }
	 
    public function orders() {

        $data['sucess'] = $this->session->flashdata('sucess');
        $data['approve_orders']=$this->commonmodel->total_records_where('daorder_status',1,'tbl_orders');
        $data['trashed_orders']=$this->commonmodel->total_records_where('daorder_status','-1','tbl_orders');
        $data['pending_orders']=$this->commonmodel->total_records_where('daorder_status','0','tbl_orders');
        $data['rejected_orders']=$this->commonmodel->total_records_where('daorder_status',2,'tbl_orders');
        $this->commonmodel->adminloadLayout($data, 'admin/managereports/order_page');
    }
    /*
    * Get the ajax Loaded data of orders
    */
    public function table_orders(){
        if(isset($_REQUEST['draw'])){
          /* For all tables asign the concer column name 
          *  that is using in your model to data table column
          * This can also be done from js datatable so do on both side
          */
          $orderTableinfo=array(0=>FALSE,
                                1=>'ot.daorder_id',
                                2=>'ot.daorder_date',
                                3=>'usr.userFirstName',
                                4=>'ot.daorder_price',
                                5=>'ot.daorder_total_emails',
                                6=>FALSE,
                                7=>FALSE
                            );
          $orderColumn=$_REQUEST['order'][0]['column'];
          $orderType=$_REQUEST['order'][0]['dir'];
          if($orderTableinfo[$orderColumn]!=FALSE){
           $orderby= $orderTableinfo[$orderColumn];
          }else{
            $orderby=NULL;
          }
                //FILTER AREA
          if(isset($_REQUEST['action']) && $_REQUEST['action']=='filter'){
                //Intialize where with no error occur
                $where='ot.daorder_id <> "" AND ';
                // if filter is on order id
                if(!empty($_REQUEST['order_id'])){
                    $where.='ot.daorder_id="'.$_REQUEST['order_id'].'" AND ';
                }
                //if filter is on date or date range
                if(!empty($_REQUEST['order_date_from']) && empty($_REQUEST['order_date_to'])){
                    $where.='ot.daorder_date BETWEEN "'.date('Y-m-d',strtotime(str_replace('/', '-', $_REQUEST['order_date_from']))).'" AND "'.date('Y-m-d').'" AND ';
                }else if(empty($_REQUEST['order_date_from']) && !empty($_REQUEST['order_date_to'])){
                    $where.='ot.daorder_date BETWEEN "2016-01-01" AND "'.date('Y-m-d',strtotime(str_replace('/', '-', $_REQUEST['order_date_to']))).'" AND ';
                }else if(!empty($_REQUEST['order_date_from']) && !empty($_REQUEST['order_date_to'])){
                    $where.='ot.daorder_date BETWEEN "'.date('Y-m-d',strtotime(str_replace('/', '-', $_REQUEST['order_date_from']))).'" AND "'.date('Y-m-d',strtotime(str_replace('/', '-', $_REQUEST['order_date_to']))).'" AND ';
                }else{
                    //if both are empty do nothing
                }
                //if filter is on first name
                if(!empty($_REQUEST['order_customer_fname'])){
                    $where.='usr.userFirstName LIKE "%'.$_REQUEST['order_customer_fname'].'%" AND ';
                }
                //if filter is on last name
                if(!empty($_REQUEST['order_customer_lname'])){
                    $where.='usr.userLastName LIKE "%'.$_REQUEST['order_customer_lname'].'%" AND ';
                }
                //if filter is on order price
                if(!empty($_REQUEST['order_price_from']) && empty($_REQUEST['order_price_to'])){
                    $where.='ot.daorder_price >= "'.$_REQUEST['order_price_from'].'" AND ';
                }else if(empty($_REQUEST['order_price_from']) && !empty($_REQUEST['order_price_to'])){
                    $where.='ot.daorder_price <= "'.$_REQUEST['order_price_to'].'" AND ';
                }else if(!empty($_REQUEST['order_price_from']) && !empty($_REQUEST['order_price_to'])){
                    $where.='ot.daorder_price BETWEEN "'.$_REQUEST['order_price_from'].'" AND "'.$_REQUEST['order_price_to'].'" AND '; 
                }else {
                    //if both price fields are empty than do nothing
                }
                //if filter is on agents number
                if(!empty($_REQUEST['order_quantity_from']) && empty($_REQUEST['order_quantity_to'])){
                    $where.='ot.daorder_total_emails >= "'.$_REQUEST['order_price_from'].'" AND ';
                }else if(empty($_REQUEST['order_quantity_from']) && !empty($_REQUEST['order_quantity_to'])){
                    $where.='ot.daorder_total_emails <= "'.$_REQUEST['order_quantity_to'].'" AND ';
                }else if(!empty($_REQUEST['order_quantity_from']) && !empty($_REQUEST['order_quantity_to'])){
                    $where.='ot.daorder_total_emails BETWEEN "'.$_REQUEST['order_quantity_from'].'" AND "'.$_REQUEST['order_quantity_to'].'" AND '; 
                }else {
                    //if both price fields are empty than do nothing
                }
                //if filter is on order status
                if(!empty($_REQUEST['order_status'])){
                    $where.='ot.daorder_status="'.$_REQUEST['order_status'].'" AND ';
                }
                //finilize where with no errors
                $where.='ot.daorder_id > 0';

          }else{
            $where='';
          }
          //FILTER END

          $iTotalRecords = $this->reportsmodel->total_order_records($where);
          $iDisplayLength = intval($_REQUEST['length']);
          $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
          $iDisplayStart = intval($_REQUEST['start']);
          $sEcho = intval($_REQUEST['draw']);
          
          $records = array();
          $records["data"] = array(); 

          $end = $iDisplayStart + $iDisplayLength;
          $end = $end > $iTotalRecords ? $iTotalRecords : $end;
          $orders_data=$this->reportsmodel->getOrderAjaxData($where,$orderby,$orderType,$iDisplayStart,$end);
        /*  echo '<pre>';
         print_r($_REQUEST);
          exit;*/
          if(is_array($orders_data) && !empty($orders_data)){
            foreach($orders_data as $value) {
                 switch($value['status']){
                    case -1:
                        $status='Closed';
                        $class='danger';
                        break;
                    case 0:
                        $status='Pending';
                        $class='info';
                        break;
                    case 1:
                        $status='Approved';
                        $class='success';
                        break;
                    case 2:
                        $status='Rejected';
                        $class='warning';
                        break;
                    default:
                        $status='Fraud';
                        $class='warning';
                        break;
                }
                $records["data"][] = array(
                  '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['order_id'].'"/><span></span></label>',
                  $value['order_id'],
                  $value['flyer_title'],
                  '<img src="'.base_url().'public/upload/user_flyer_store/_thumbs/'.(!empty($value['thumb'])?$value['thumb']:'placeholder-image-thumb.jpg').'" width="100" height="100"/>',
                  date('m-d-Y',strtotime($value['order_date'])),
                  $value['FirstName']." ".$value['LastName'],
                  "$".$value['daorder_grand_total'],
                  number_format($value['total_agents']),
                  '<span class="label label-sm label-'.$class.'">'.$status.'</span>',
                  '<a href="'.base_url().'admin_orders/read/'.$value['order_id'].'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i>View</a>'
                   );
                }
           }else{
            $records["customActionMessage"] = "No Data found"; // 
           }
          if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
          }

          $records["draw"] = $sEcho;
          $records["recordsTotal"] = $iTotalRecords;
          $records["recordsFiltered"] = $iTotalRecords;
          
          echo json_encode($records);
      }

    }
    /*
    * The email reports main page
    */
    public function emails() {
        $data['sucess'] = $this->session->flashdata('sucess');
        /*tree params must*/
        $data['active_emails']=$this->commonmodel->total_records_where('unsubscribed','0','campaign_emails');
        $data['inactive_emails']=$this->commonmodel->total_records_where('unsubscribed',1,'campaign_emails');
		 $data['sent_emails']=$this->commonmodel->getMultipleRecords('SELECT SUM(`daorder_total_emails`) as total_emails FROM `tbl_orders` WHERE `daorder_status` = 1');
		// print_r($data['sent_emails'][0]['total_emails'] );exit;
        //Get data from send grid
        $data['sendGrid_response']=$this->reportsmodel->sendGrid_response($fromDate='2016-07-07',$toDate=date('Y-m-d'));
        $this->commonmodel->adminloadLayout($data, 'admin/managereports/user_page');
    }
    public function bulk_emails() {
        $ignore = array('Federated state of Micronesia', 'American Samoa', 'Northern Mariana Islands', 'Palau', 'Puerto Rico', 'Virgin Islands');
        $this->db->where_not_in('name', $ignore);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get("tbl_states");
        $result = $query->result();
        $us=array();
        foreach ($result as $res)
        {
            $us[$res->code]=$res->name;
        }
        $data = array(
            'button' => 'Send Bulk Emails',
            'viewemail' => 'View Email',
            'action' => site_url('Bulk_emailer/new_send_bulk'),
            'us_state' => $us,
        );
        $this->breadcrumbs->push('Email Management', '/emailmanagement');
        $this->breadcrumbs->push('Bulk Email', 'bulk_emails');
        $this->commonmodel->adminloadLayout($data, 'admin/email_management/bulk_email_form');
    }
    public function email_tracking() {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
		$per_page=$this->input->get('records');
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/managereports/email_tracking?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/managereports/email_tracking?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/managereports/email_tracking?records='.urlencode($per_page);
            $config['first_url'] = base_url() . 'admin/managereports/email_tracking?records='.urlencode($per_page);
        }
        if($this->input->get('records')){
				$per_page=$this->input->get('records');
				$config['per_page'] = $per_page;
			}else{
				
				$config['per_page'] = 10;
			}
        $config['page_query_string'] = TRUE;
        $this->load->model('admin/Adminloginmodel');
        $config['total_rows'] = $this->Adminloginmodel->total_rows($q);
        $users_orders = $this->Adminloginmodel->get_limit_data($config['per_page'], $start, $q);
        foreach ($users_orders as $key => $field) {
            $this->db->where('order_id', $field->daorder_id);
            $num_rows = $this->db->count_all_results('tbl_email_tracking');
            $users_orders[$key]->daorder_count = $num_rows;
        }
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        //
        $data = array(
            'users_orders_data' => $users_orders,
            'q'                 => $q,
			'records'           => $per_page,
            'pagination'        => $this->pagination->create_links(),
            'total_rows'        => $config['total_rows'],
            'start'             => $start
        );



        $this->breadcrumbs->push('Email Management', '/emailmanagement');
        $this->breadcrumbs->push('Email Tracking', '/admin/email_management/email_tracking_list');
        $this->commonmodel->adminloadLayout($data, 'admin/email_management/email_tracking_list');
    }

    public function email_track_read($id)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $per_page=$this->input->get('records');
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/managereports/email_track_read/'.$id.'?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/managereports/email_track_read/'.$id.'?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/managereports/email_track_read/'.$id.'?records='.urlencode($per_page);
            $config['first_url'] = base_url() . 'admin/managereports/email_track_read/'.$id.'?records='.urlencode($per_page);
        }
        if($this->input->get('records')){
            $per_page=$this->input->get('records');
            $config['per_page'] = $per_page;
        }else{

            $config['per_page'] = 10;
        }
        $config['page_query_string'] = TRUE;
        $this->load->model('admin/Adminloginmodel');
        $config['total_rows'] = $this->Adminloginmodel->email_tracking_total_rows($q,$id);
        $users_orders = $this->Adminloginmodel->email_tracking_get_limit_data($config['per_page'], $start, $q,$id);
        //
        $this->load->library('user_agent');
        foreach ($users_orders as $key => $field) {
            $this->db->where('ip', $field->ip);
            $qqq = $this->db->get('tbl_email_tracking');
            $rrr = $qqq->row();
            $users_orders[$key]->headers = '('.$rrr->ip.') '.$this->agent->agent_string();
        }
        //echo "<pre>";echo $this->db->last_query();exit;
        //
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        //
        $data = array(
            'users_orders_data' => $users_orders,
            'q'                 => $q,
            'records'           => $per_page,
            'pagination'        => $this->pagination->create_links(),
            'total_rows'        => $config['total_rows'],
            'start'             => $start
        );

            $this->breadcrumbs->push('Email Tracking', '/admin/managereports/email_tracking');
            $this->breadcrumbs->push('Order Email Detail', '/admin/managereports/email_track_read');
            $this->commonmodel->adminloadLayout($data, 'admin/email_management/tbl_emailtraking_detail_read');

    }

    /*
    * Get the ajax Loaded data of emails
    */
    public function table_emails(){
        if(isset($_REQUEST['draw'])){
          /* For all tables asign the concer column name 
          *  that is using in your model to data table column
          * This can also be done from js datatable so do on both side
          */
          $orderTableinfo=array(0=>FALSE,
                                1=>FALSE,
                                2=>'em.Agency_Name',
                                3=>'em.Full_Name',
                                4=>'em.email_address',
                                5=>'em.StateName',
                                6=>'em.County',
                                7=>'em.City',
                                8=>'em.unsubscribed',
                                9=>true,
								10=>true,
								11=>FALSE
                            );
          $orderColumn=$_REQUEST['order'][0]['column'];
          $orderType=$_REQUEST['order'][0]['dir'];
          if($orderTableinfo[$orderColumn]!=FALSE){
           $orderby= $orderTableinfo[$orderColumn];
          }else{
            $orderby=NULL;
          }
          //FILTER AREA
          if(isset($_REQUEST['action']) && $_REQUEST['action']=='filter'){
                //Intialize where with no error occur
                $where='em.email_address <> "" AND ';
                //if filter is agency  name
                if(!empty($_REQUEST['agency_name'])){
                    $where.='em.Agency_Name LIKE "%'.$_REQUEST['agency_name'].'%" AND ';
                }
                //if filter is on agent name
                if(!empty($_REQUEST['agent_First_name'])){
                    $where.='em.First_Name LIKE "%'.$_REQUEST['agent_First_name'].'%" AND ';
                }
				if(!empty($_REQUEST['agent_last_name'])){
                    $where.='em.Last_Name LIKE "%'.$_REQUEST['agent_last_name'].'%" AND ';
                }
                //if filter is on  agent email
                if(!empty($_REQUEST['agent_email'])){
                    $where.='em.email_address LIKE "%'.$_REQUEST['agent_email'].'%" AND ';
                }
                //if filter is on agent state
                if(!empty($_REQUEST['agent_state'])){
                    $where.='em.StateName LIKE "%'.$_REQUEST['agent_state'].'%" AND ';
                }
                //if filter is on  agent county
                if(!empty($_REQUEST['agent_county'])){
                    $where.='em.County LIKE "%'.$_REQUEST['agent_county'].'%" AND ';
                }
                //if filter is on  agent city
                if(!empty($_REQUEST['agent_city'])){
                    $where.='em.City LIKE "%'.$_REQUEST['agent_city'].'%" AND ';
                }
                //if filter is on order status
				$agent=$_REQUEST['agent_status'];
				if($agent == 0){
					$agent= "'".$agent."'";
					 $where.='em.unsubscribed="'.$agent.'" AND ';
				}
                if(!empty($_REQUEST['agent_status'])){
                    $where.='em.unsubscribed="'.$_REQUEST['agent_status'].'" AND ';
                }
                //finilize where with no errors
                $where.='length(em.email_address) > 0';
				//var_dump($where);exit;
          }else{
            $where='';
          }
          //FILTER END
          $iTotalRecords = $this->reportsmodel->total_email_records($where);
          $iDisplayLength = intval($_REQUEST['length']);
          $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
          $iDisplayStart = intval($_REQUEST['start']);
          $sEcho = intval($_REQUEST['draw']);
          
          $records = array();
          $records["data"] = array(); 

          $end = $iDisplayStart + $iDisplayLength;
          $end = $end > $iTotalRecords ? $iTotalRecords : $end;
     
          $orders_data=$this->reportsmodel->getEmailsAjaxData($where,$orderby,$orderType,$iDisplayStart,$end);
        /*  echo '<pre>';
         print_r($_REQUEST);
          exit;*/
          if(is_array($orders_data) && !empty($orders_data)){
            $count=1;
            foreach($orders_data as $value) {
                 switch($value['status']){
                    case -1:
                        $status='Closed';
                        $class='danger';
                        break;
                    case 0:
                        $status='Subscribed';
                        $class='info';
                        break;
                    case 1:
                        $status='Unsubscribed';
                        $class='warning';
                        break;
                    default:
                        $status='Fraud';
                        $class='warning';
                        break;
                }
                $records["data"][] = array(
                  '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['email'].'"/><span></span></label>',
                  $count++,
                  $value['agency'],
                  $value['firstname'],
				  $value['lastname'],
                  $value['email'],
                  $value['state'],
                  $value['county'],
                  $value['city'],
                  '<span class="label label-sm label-'.$class.'">'.$status.'</span>',
                  '<a href="'.base_url().'subscriber_read_email/'.$value['emailId'].'"  class="btn btn-sm btn-outline btn-primary" style="margin-bottom: 4px;width: 73px;"><i class="fa fa-search"></i> View</a> 
				  <a href="'.base_url().'updateemail/'.$value['emailId'].'" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-pencil"></i>Update</a>
				  '
				  
                   );
                }
           }else{
            $records["customActionMessage"] = "No Data found"; // 
           }
          if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
          }

          $records["draw"] = $sEcho;
          $records["recordsTotal"] = $iTotalRecords;
          $records["recordsFiltered"] = $iTotalRecords;
          
          echo json_encode($records);
      }

    }

    public function update_email_subscriber($subscriberId = NULL)
    {
        $row = $this->reportsmodel->get_email_data($subscriberId);

        if ($row) {
        $data = array(
        'button' => 'Update',
        'action' => site_url('admin/managereports/update_action_email_subscriber'),
        'subId' => set_value('subId', $row->subId),
        'subFirstName' => set_value('subFirstName', $row->subFirstName),
        'subLastName' => set_value('subLastName', $row->subFirstName),
        //'daorder_user_flyer_id' => set_value('daorder_user_flyer_id', $row->daorder_user_flyer_id),
        'subEmail' => set_value('subEmail', $row->subEmail),
        'subCountry' => set_value('subCountry', $row->subCountry),
        'county' => set_value('county', $row->county),
        'subCreationDate' => set_value('subCreationDate', $row->subCreationDate),
        'subStatus' => set_value('subStatus', $row->subStatus),
        //'daorder_rejection_reason' => set_value('daorder_rejection_reason', $row->daorder_rejection_reason),
        /*'daorder_user_id' => set_value('daorder_user_id', $row->daorder_user_id),
        'daoder_admin_id' => set_value('daoder_admin_id', $row->daoder_admin_id),
        'daorder_modified_date' => set_value('daorder_modified_date', $row->daorder_modified_date),
        'daorder_modified_by' => set_value('daorder_modified_by', $row->daorder_modified_by),*/
        );
            // $this->load->view('admin_orders/tbl_orders_form', $data);
        $this->breadcrumbs->push('Emails', '/admin_orders');
        $this->breadcrumbs->push('Email Update', '/admin_orders/index');
            $this->commonmodel->adminloadLayout($data,'admin/managereports/update_email_subscriber_view');
        } else {
            $this->session->set_flashdata('message', '<span class="alert-danger">Record Not Found</span>');
            redirect(site_url('admin_orders'));
        }

       /* $this->breadcrumbs->push('Emails', '/admin_orders');
        $this->breadcrumbs->push('Email Update', '/admin_orders/index');
        $this->commonmodel->adminloadLayout([], 'admin/managereports/update_email_subscriber_view');*/
    }

    
    public function update_action_email_subscriber()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update_email_subscriber($this->input->post('subId', TRUE));
        } else {
            $data = array(
                        'subId' => $this->input->post('subId',TRUE),
                        //'daorder_user_flyer_id' => $this->input->post('daorder_user_flyer_id',TRUE),
                        'subFirstName' => $this->input->post('subFirstName',TRUE),
                        'subLastName' => $this->input->post('subLastName',TRUE),
                        'subEmail' => $this->input->post('subEmail',TRUE),
                        'subCountry' => $this->input->post('subCountry',TRUE),
                        'county' => $this->input->post('county',TRUE),
                        'subStatus' => $this->input->post('subStatus',TRUE),
                        /*'daorder_modified_date' => $this->input->post('daorder_modified_date',TRUE),
                        'daorder_modified_by' => $this->input->post('daorder_modified_by',TRUE),*/
                    );

            $this->reportsmodel->update($this->input->post('subId', TRUE), $data);
            echo "<pre>";
            print_r($data);
            //exit;
            $this->session->set_flashdata('message', '<span class="alert alert-success">Update Record Success</span>');
            //log_queries('admin', 1, 'orders', $this->input->post('daorder_flyer_id',TRUE));
            redirect(site_url('reports/emails'));
        }
    }

    public function subscriber_read($subscriberId='')
    {
        $data['subscriber_data'] = $this->reportsmodel->subscriber_read($subscriberId);
        $this->breadcrumbs->push('Emails', 'reports');
        $this->breadcrumbs->push('Email Read', '/reports/index');
        $this->commonmodel->adminloadLayout($data,'admin/managereports/subscriber_read_view');
    }
    public function _rules()
    {
        //$this->form_validation->set_rules('subId', 'subId', 'trim|required');
        //$this->form_validation->set_rules('daorder_user_flyer_id', 'daorder user flyer id', 'trim|required');
        $this->form_validation->set_rules('subFirstName', 'subFirstName', 'trim|required');
        $this->form_validation->set_rules('subEmail', 'subEmail', 'trim|required');
        $this->form_validation->set_rules('subCountry', 'subCountry', 'trim|required');
        $this->form_validation->set_rules('subLastName', 'subLastName', 'trim|required');
        $this->form_validation->set_rules('county', 'county', 'trim|required');
        $this->form_validation->set_rules('subStatus', 'subStatus', 'trim|required');
       /* $this->form_validation->set_rules('daorder_modified_date', 'daorder modified date', 'trim|required');
        $this->form_validation->set_rules('daorder_modified_by', 'daorder modified by', 'trim|required');
*/
        $this->form_validation->set_rules('subId', 'subId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

   

}
