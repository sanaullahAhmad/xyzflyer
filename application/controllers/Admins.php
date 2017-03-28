<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admins extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(xyzAccesscontrol('admin_managment','Full')!=TRUE){
             redirect(site_url('_backoffice'));
             exit;
        }
        $this->load->model('frontend/commonmodel');
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0)
        // {
        //     $this->commonmodel->no_permissions();
        // }
        $this->load->model('Admins_model');
		 $this->load->library('breadcrumbs');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(xyzAccesscontrol('admin_managment','Full')!=TRUE){
            redirect(site_url('_backoffice'));
            exit;
        }
        $check = $this->commonmodel->permissions_check();
		$this->breadcrumbs->push('admins', '/admins');
		$this->breadcrumbs->push('admins_dashboard', '/admins/admins_dashboard');
        if($check == 0)
        {
            $this->commonmodel->adminloadLayout(null,'admins/admins_dashboard');
        }
        else $this->commonmodel->adminloadLayout(null,'admin/no_permissions');

        // $this->load->view('admins/tbl_admin_list', $data);

    }

    public function list_all($type=false)
    {
        $admins = $this->Admins_model->get_all($type);
            // print_r($admins);exit;
    		$this->breadcrumbs->push('Admins', '/admins');
    		$this->breadcrumbs->push('Admins List', '/admins/index');
        $data = array(
			            'title' => "All Admins",
                  'admins_data' => $admins
                );
        $this->commonmodel->adminloadLayout($data,'admins/tbl_admin_list');
    }

    public function list_all_by_status($status = NULL)
    {

        if($status === NULL) $admins = $this->Admins_model->list_all_by_status();
        else $admins = $this->Admins_model->list_all_by_status($status);
        ///    print_r($admins);exit;
  		if($status == 1){
  			$title="Active Admins";
  		}elseif($status == 0){
  			$title="Suspended Admins";
  		}
  		$this->breadcrumbs->push('Admins', '/admins');
  		$this->breadcrumbs->push($title, '/admins/'.$status);
        $data = array(
			          'title' => $title,
                'admins_data' => $admins
			
            );
        $this->commonmodel->adminloadLayout($data,'admins/tbl_admin_list');
    }

    public function set_upload_options($upload_path, $file_type){
        // upload image options
        $config = array();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $file_type;
        $config['overwrite']     = true;
        $config['file_name'] = "logo";
        return $config;
    }

    public function site_settings($value='')
    {
      
      $original_filename = '';
      if(isset($_POST['send']))
      {
        ////
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = $_FILES['frontend_contactus_email_logo']['name'];
       
        
        if($_FILES['frontend_contactus_email_logo']['name']!= '' )
        {
            $upload_path = "uploads/site_logo/";
            $file_type = "gif|jpg|jpeg|png";
            $this->upload->initialize($this->set_upload_options($upload_path, $file_type));

            if($this->upload->do_upload('frontend_contactus_email_logo'))
            {
                $uploaddata = $this->upload->data();
                $result['frontend_contactus_email_logo'] = $uploaddata['file_name'];
                $original_filename = $result['frontend_contactus_email_logo'];

                $DbFieldsArray =  array('image_url');
                $DataArray =  array($original_filename);
              
                //upload image name in folder
                $image_url=$original_filename;

                $location=$this->input->post('frontend_location');
                $status=$this->input->post('status');;
               /* $data=array(
                      'image_name'  => $uploaddata['file_name'],
                      'image_path'  => $uploaddata['file_path'],
                      'image_type'  => $uploaddata['file_type'],
                      'frontend_location' => $location,
                      'main_heading'  => $main_heading,
                      'sub_heading'   => $sub_heading,
                      'button'      =>$button_text,
                      'button_url'    =>$button_url,
                      'status'      => $status
                      );*/
                      
                //$this->Frontend_settings_model->insert($data);
                  $this->session->set_flashdata('message', 'Slider Image Added');
                /*if($location == "home"){
                  redirect(site_url('Frontend_settings'));
                }elseif($location == "aboutus"){
                  redirect(site_url('Frontend_settings/aboutus'));
                }else{    
                  redirect(site_url('Frontend_settings/howitworks'));
                }        */
                $query = $this->db->query("update tbl_settings set Value = '". $result['frontend_contactus_email_logo'] ."' where mykey='frontend_contactus_email_logo'");
            }
            else
            {
              $this->session->set_flashdata('message', 'Invalid file type');
              $this->add_slider();
            }
           /* echo "<pre>";
            print_r($original_filename);
            exit;*/
        }
        else
        {
          $this->session->set_flashdata('message', 'No file selected.');
          //$this->add_slider();
        }
        ///////////
          //echo "send";exit;
          $query = $this->db->query("update tbl_settings set Value = '".$_POST['frontend_contactus_email']."' where mykey='frontend_contactus_email'");
          $query = $this->db->query("update tbl_settings set Value = '".$_POST['frontend_contactus_email_footer']."' where mykey='frontend_contactus_email_footer'");
          $query = $this->db->query("update tbl_settings set Value = '".$_POST['frontend_contactus_coupon']."' where mykey='frontend_contactus_coupon'");
          /*echo "<pre>";
          print_r($_POST);
          exit;*/
      }
      $this->breadcrumbs->push('Site Settings', '/admins/site_settings');
      $this->breadcrumbs->push(' ', ' ');
      $query1 = $this->db->query("select * from tbl_settings where mykey = 'frontend_contactus_email'");
      $frontend_contactus_email = $query1->row();
        //
      $query2 = $this->db->query("select * from tbl_settings where mykey = 'frontend_contactus_email_footer'");
      $frontend_contactus_email_footer = $query2->row();
        //
      $query3 = $this->db->query("select * from tbl_settings where mykey = 'frontend_contactus_coupon'");
      $frontend_contactus_coupon = $query3->row();
        //
      $query4 = $this->db->query("select * from tbl_settings where mykey = 'frontend_contactus_email_logo'");
      $frontend_contactus_email_logo = $query4->row();
      //print_r($frontend_contactus_email_logo);exit;
        $this->db->select('coupon_maximum_uses, coupon_code, coupon_type, coupon_value');
        $res = $this->db->get('admi_coupons');
        $res = $res->result();
        if($res)
        {
            foreach ($res as $key=>$coupon_row)
            {
                $this->db->where('coupon_code', $coupon_row->coupon_code);
                $this->db->from('admi_coupons_used');
                $num_rows = $this->db->count_all_results();
                $available_coupons = ($coupon_row->coupon_maximum_uses - $num_rows);
                if($available_coupons>0)
                {
                    $res[$key]->available_coupons = $num_rows;
                }
                else{
                    unset($res[$key]);
                }
            }
        }
      $data = [
        'title'                           => "Site Settings",
        'frontend_contactus_email'        => $frontend_contactus_email,
        'frontend_contactus_email_footer' => $frontend_contactus_email_footer,
        'frontend_contactus_coupon'       => $frontend_contactus_coupon,
        'available_coupons'               => $res,
        'logo_url'                        => 'uploads/site_logo/'. $frontend_contactus_email_logo->Value,
        'button'                          => 'Update'
      ];
      
      $this->commonmodel->adminloadLayout($data,'admin/site_settings');
    }

    public function read($id)
    {
        $row = $this->Admins_model->get_by_id($id);
		//print_r($row);exit;
		$this->breadcrumbs->push('Admins', '/admins');
		$this->breadcrumbs->push('Admin Detail', '/admins/read');
		
        if ($row) {
            $data = array(
			        'admin_firstname' =>$row->admin_firstname,
              'admin_lastname' => $row->admin_lastname,
              'admin_id' => $row->admin_id,
              'admin_username' => $row->admin_username,
              'admin_email' => $row->admin_email,
              'admin_date' => $row->admin_date,
              'admin_type' => $row->admin_type,
              'admin_status' => $row->admin_status,
              );
            // $this->load->view('admins/tbl_admin_read', $data);
            $this->commonmodel->adminloadLayout($data,'admins/tbl_admin_read');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admins'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admins/create_action'),
      			'firstname' => set_value('firstname'),
      			'lastname' => set_value('lastname'),
      			'admin_id' => set_value('admin_id'),
            'admin_username' => set_value('admin_username'),
            'admin_password' => set_value('admin_password'),
            'admin_email' => set_value('admin_email'),
            'admin_date' => set_value('admin_date'),
            'admin_type' => set_value('admin_type'),
            'admin_status' => null,
            );
		$this->breadcrumbs->push('Admins', '/admins');
		$this->breadcrumbs->push('Add Admin', '/admins/create');
		
        // $this->load->view('admins/tbl_admin_form', $data);
        $this->commonmodel->adminloadLayout($data,'admins/tbl_admin_form');
    }



    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {




            if($this->input->post('sendinfo', TRUE) === 'yes'){

                $username = $this->input->post('admin_username',TRUE);
                $password = $this->input->post('admin_password', TRUE);
                $email = $this->input->post('admin_email', TRUE);
                $date = date('Y-m-d');
                $msg = "your account created successfully. <br> username : {$username} <br> password: $password <br> email: {$email} <br> date: {$date}";

                $this->load->helper('send_mail');
                _sendMail($email, 'Login Info For Flyer', $msg);
            }

            $data = array(
			  'admin_firstname' => $this->input->post('firstname',TRUE),
              'admin_lastname' => $this->input->post('lastname',TRUE),
              'admin_username' => $this->input->post('admin_username',TRUE),
              'admin_password' => md5($this->input->post('admin_password')),
              'admin_email' => $this->input->post('admin_email',TRUE),
              'admin_date' => date('Y-m-d'),
              'admin_type' => $this->input->post('admin_type',TRUE),
              'admin_status' => $this->input->post('admin_status',TRUE),
              );

            $this->Admins_model->insert($data);
            $this->session->set_flashdata('message', 'Record has been Created');
            log_queries('admin', 0, 'admins', $this->input->post('admin_username',TRUE));
            redirect(site_url('admins/list_all'));
        }
    }

    public function update($id)
    {
        $row = $this->Admins_model->get_by_id($id);
		$this->breadcrumbs->push('Admins', '/admins');
		$this->breadcrumbs->push('Admin Update', '/admins/update');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admins/update_action'),
				'firstname' => set_value('firstname', $row->admin_firstname),
                'lastname' => set_value('lastname', $row->admin_lastname),
                'admin_id' => set_value('admin_id', $row->admin_id),
                'admin_username' => set_value('admin_username', $row->admin_username),
                'admin_password' => set_value('admin_password', $row->admin_password),
                'admin_email' => set_value('admin_email', $row->admin_email),
                'admin_date' => set_value('admin_date', $row->admin_date),
                'admin_type' => set_value('admin_type', $row->admin_type),
                'admin_status' => set_value('admin_status', $row->admin_status),
                );
            $this->commonmodel->adminloadLayout($data,'admins/tbl_admin_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admins'));
        }
    }

    public function update_action()
    {
        $this->_update_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('admin_id', TRUE));

        } else {
            if ( $this->input->post('admin_password',TRUE) == '') {
                $data = array(
				 'admin_firstname' => $this->input->post('firstname',TRUE),
                 'admin_lastname' => $this->input->post('lastname',TRUE),
                 'admin_username' => $this->input->post('admin_username',TRUE),
                 'admin_email' => $this->input->post('admin_email',TRUE),
                 'admin_date' => $this->input->post('admin_date',TRUE),
                 'admin_type' => $this->input->post('admin_type',TRUE),
                 'admin_status' => $this->input->post('admin_status',TRUE),
                 );
            }
            else
            {
                $data = array(
				 'admin_firstname' => $this->input->post('firstname',TRUE),
                 'admin_lastname' => $this->input->post('lastname',TRUE),
                 'admin_username' => $this->input->post('admin_username',TRUE),
                 'admin_password' => md5($this->input->post('admin_password',TRUE)),
                 'admin_email' => $this->input->post('admin_email',TRUE),
                 'admin_date' => $this->input->post('admin_date',TRUE),
                 'admin_type' => $this->input->post('admin_type',TRUE),
                 'admin_status' => $this->input->post('admin_status',TRUE),
                 );
            }

            $this->Admins_model->update($this->input->post('admin_id', TRUE), $data );
            $this->session->set_flashdata('message', 'Record Updated Successfully');
            log_queries('admin', 1, 'admins', $this->input->post('admin_username',TRUE));
            redirect(site_url('admins/list_all'));
        }
    }

    public function delete($id)
    {
        $row = $this->Admins_model->get_by_id($id);
        $admin_username = $row->admin_username;
        if ($row) {
            $this->Admins_model->delete($id);
            $this->session->set_flashdata('message', 'Record has been Deleted');
            log_queries('admin', 2, 'admins', $admin_username);
            redirect(site_url('admins/list_all'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admins'));
        }
    }
	
	  public function delete_all()
    {	
		$ids=$this->input->post('del_data');
		//echo "here";exit;
		foreach($ids as $id){
			$row = $this->Admins_model->get_by_id($id);
          $admin_username = $row->admin_username;
			if ($row) {
				$this->Admins_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				log_queries('admin', 2, 'admins', $admin_username);
				//redirect(site_url('admins/list_all'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				//redirect(site_url('admins'));
				
			}
		}       
    }

    public function _update_rules()
    {
       $this->form_validation->set_rules('admin_username', 'admin username', 'trim|required');
       $this->form_validation->set_rules('admin_password', 'admin password', 'trim');
       $this->form_validation->set_rules('admin_email', 'admin email', 'trim|required');
       $this->form_validation->set_rules('admin_date', 'admin date', 'trim|required');
       $this->form_validation->set_rules('admin_type', 'admin type', 'trim|required');
	// $this->form_validation->set_rules('admin_status', 'admin status', 'trim|required');

       $this->form_validation->set_rules('admin_id', 'admin_id', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function _rules()
    {
       $this->form_validation->set_rules('admin_username', 'admin username', 'trim|required|is_unique[tbl_admin.admin_username]');
       $this->form_validation->set_rules('admin_password', 'admin password', 'trim');
       $this->form_validation->set_rules('admin_email', 'admin email', 'trim|required');
       $this->form_validation->set_rules('admin_date', 'admin date', 'trim|required');
       $this->form_validation->set_rules('admin_type', 'admin type', 'trim|required');
    // $this->form_validation->set_rules('admin_status', 'admin status', 'trim|required');

       $this->form_validation->set_rules('admin_id', 'admin_id', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "tbl_admin.xls";
    $judul = "tbl_admin";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Firstname");
	xlsWriteLabel($tablehead, $kolomhead++, "Lastname");
    xlsWriteLabel($tablehead, $kolomhead++, "Email");
    xlsWriteLabel($tablehead, $kolomhead++, "Date");
    xlsWriteLabel($tablehead, $kolomhead++, "Type");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");

    foreach ($this->Admins_model->get_all() as $data) {
        $kolombody = 0;
		$date = date_create($data->admin_date);
                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->admin_username);
		xlsWriteLabel($tablebody, $kolombody++, $data->admin_firstname);
		xlsWriteLabel($tablebody, $kolombody++, $data->admin_lastname);
        xlsWriteLabel($tablebody, $kolombody++, $data->admin_email);
        xlsWriteLabel($tablebody, $kolombody++, date_format($date, 'm-d-Y'));
        xlsWriteLabel($tablebody, $kolombody++, format($data->admin_type, 'admin_type'));
        xlsWriteLabel($tablebody, $kolombody++, format($data->admin_status, 'admin_status'));

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=tbl_admin.doc");

    $data = array(
        'admins_data' => $this->Admins_model->get_all(),
        'start' => 0
        );
    $this->load->view('admins/tbl_admin_doc',$data);
}

}

/* End of file Admins.php */
/* Location: ./application/controllers/Admins.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-05 19:02:43 */
/* http://harviacode.com */