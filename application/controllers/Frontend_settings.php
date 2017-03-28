<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_settings extends CI_Controller
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
        $this->load->model('Frontend_settings_model');
		 $this->load->library('breadcrumbs');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $check = $this->commonmodel->permissions_check();
		$this->breadcrumbs->push('Frontend Settings', '/frontend_settings/frontend_dashboard/');
		$this->breadcrumbs->push('Home', '/frontend_settings');
        if($check == 0)
        {	$data['title']="Home Slider";
		   $data['slider']=$this->Frontend_settings_model->get_slider_images();
           $this->commonmodel->adminloadLayout($data,'frontend_settings/frontend_settings');
        }
        else $this->commonmodel->adminloadLayout(null,'admin/no_permissions');

    }
	
	 public function read($id)
    {
			$this->breadcrumbs->push_frontend('Frontend Settings', (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/Frontend_settings'));
			$this->breadcrumbs->push('Slider View', '/Frontend_settings/read');
			$data['slider']=$this->Frontend_settings_model->get_data_by_id($id);
            $this->load->view('frontend_settings/read',$data);
    }
	
	public function frontend_dashboard(){
		$data=null;
		 $this->commonmodel->adminloadLayout($data,'frontend_settings/frontend_dashboard');
	}
	
	 public function update($id)
    {
       
        $row = $this->Frontend_settings_model->get_data_by_id($id);

        if ($row) {
            $data = array(
                'action_button' => 'Update',
                'action' => site_url('Frontend_settings/update_action'),
				'slider_id' => set_value('slider_id', $row->id),
				'image_name' => set_value('image_name', $row->image_name),
				'image_type' => set_value('image_type', $row->image_type),
				'frontend_location' => set_value('frontend_location', $row->frontend_location),
				'main_heading' => set_value('main_heading', $row->main_heading),
				'sub_heading' => set_value('sub_heading', $row->sub_heading),
				'button' => set_value('button', $row->button),
				'button_url' => set_value('button_url', $row->button_url),
				'status' => set_value('status', $row->status)
	    );
			
			$this->breadcrumbs->push_frontend('Frontend Settings', (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/Frontend_settings'));
			$this->breadcrumbs->push('Update Slider', '/Frontend_settings/update');
		
            // $this->load->view('admin_flyers/tbl_flyer_detail_form', $data);
            $this->commonmodel->adminloadLayout($data, 'frontend_settings/frontend_settings_form');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Frontend_settings'));
        }
	}
	
	 public function update_action()
    {
       
		$this->form_validation->set_rules('frontend_location', '/Frontend_settings/', 'trim|required');
		$this->form_validation->set_rules('status', 'Slider status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('slider_id', TRUE));
        } else {
			$data=array();
			$main_heading=$this->input->post('main_heading');
			$sub_heading=$this->input->post('sub_heading');
			$button_text=$this->input->post('button_txt');
			$button_url=$this->input->post('button_url');
			$slider_id=$this->input->post('slider_id');
			$location=$this->input->post('frontend_location');
				$data=array(
							'frontend_location' => $location,
							'main_heading'  => $this->input->post('main_heading'),
							'sub_heading'  	=> $this->input->post('sub_heading'),
							'button'  		=> $this->input->post('button_txt'),
							'button_url'  	=>$this->input->post('button_url'),
							'status'  		=> $this->input->post('status')
							);
				
				
				$this->load->library('upload');
				$files = $_FILES;
				$cpt = $_FILES['file_upload']['name'];
				$original_filename = '';
        
		/////////////////////// File upload if file set to update/////////////////////////
		
			if($_FILES['file_upload']['name']!= '' )
			{	
				//////////////// Delete old image/////////////
				$data1 = $this->commonmodel->getSingleRecord("SELECT * from tbl_frontend where id=".$slider_id."");
					if($data1){
						$file = $data1->image_path.$data1->image_name;
							if (!unlink($file)){
								$this->session->set_flashdata('message', 'Error deleting');
							}else{
								$this->session->set_flashdata('message','Deleted');
							}
						}
				//////////// END ////////////////////////////
				$upload_path = "uploads/slider_images/";
				$file_type = "gif|jpg|jpeg|png";
				$this->upload->initialize($this->set_upload_options($upload_path, $file_type));

					if($this->upload->do_upload('file_upload'))
					{
						$uploaddata = $this->upload->data();
						$result['filename'] = $uploaddata['file_name'];
						$original_filename = $result['filename'];
						$DbFieldsArray =  array('image_url');
						$DataArray =  array($original_filename);
						$image_url=$original_filename;
						
						$data=array(
							'image_name' => $uploaddata['file_name'],
							'image_path' => $uploaddata['file_path'],
							'image_type' => $uploaddata['file_type'],
							'frontend_location' => $location,
							'main_heading'  => $this->input->post('main_heading'),
							'sub_heading'  	=> $this->input->post('sub_heading'),
							'button'  		=> $this->input->post('button_txt'),
							'button_url'  	=>$this->input->post('button_url'),
							'status'  		=> $this->input->post('status')
							);
						//echo "<pre>";
						//print_r($data);exit;	
						
						$this->Frontend_settings_model->update($slider_id,$data);
						
						$this->session->set_flashdata('message', 'Slider Image Updated');
						if($location == "home"){
							redirect(site_url('Frontend_settings'));
						}elseif($location == "aboutus"){
							redirect(site_url('Frontend_settings/aboutus'));
						}elseif($location == "how-it-works"){		
							redirect(site_url('Frontend_settings/howitworks'));
						}else{
							 redirect(site_url('Frontend_settings'));
						}
						
					}
			}else{
				$this->Frontend_settings_model->update($slider_id,$data);
				$this->session->set_flashdata('message', 'Slider Image Updated');
				if($location == "home"){
					redirect(site_url('Frontend_settings'));
				}elseif($location == "aboutus"){
					redirect(site_url('Frontend_settings/aboutus'));
				}elseif($location == "how-it-works"){		
					redirect(site_url('Frontend_settings/howitworks'));
				}else{
					 redirect(site_url('Frontend_settings'));
				}	
			}
		}
    }
	
	public function add_slider()
    {
		$this->breadcrumbs->push_frontend('Frontend Settings', '/Frontend_settings/');
		$this->breadcrumbs->push('Add Slider', '/Frontend_settings/add_slider');
		$this->load->view('frontend_settings/add_slider');
    }
	
    public function add_aboutus_slider(){
		$data = array(
			'frontend_location' => set_value('aboutus', 'aboutus'));
		$this->breadcrumbs->push_frontend('Frontend Settings', (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/Frontend_settings'));
		$this->breadcrumbs->push('Add Slider', '/Frontend_settings/add_aboutus_slider');
		$this->load->view('frontend_settings/add_slider_aboutus',$data);	
	}
	
	 public function add_howworks_slider(){
		$data = array(
			'frontend_location' => set_value('how-it-works', 'how-it-works'));
		$this->breadcrumbs->push_frontend('Frontend Settings', (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/Frontend_settings'));
		$this->breadcrumbs->push('Add Slider', '/Frontend_settings/add_aboutus_slider');
		$this->load->view('frontend_settings/add_slider_aboutus',$data);	
	}
	
    public function delete_image($id)
    {
       $slide_id=$id;
		$data= $this->commonmodel->getSingleRecord("SELECT * from tbl_frontend where id=".$slide_id."");
        if($data){
            $file = $data->image_path.$data->image_name;
              if (!unlink($file)){
				$this->session->set_flashdata('message', 'Error deleting');
			}else{
				$this->session->set_flashdata('message','Deleted');
			}
          }
		  
		  $this->Frontend_settings_model->delete_image($id);
		  $this->session->set_flashdata('message', 'Slider Image Deleted');
          
		  if($data->frontend_location == "home"){
					redirect(site_url('Frontend_settings'));
		    }elseif($data->frontend_location == "aboutus"){
				redirect(site_url('Frontend_settings/aboutus'));
			}elseif($data->frontend_location == "how-it-works"){		
				redirect(site_url('Frontend_settings/howitworks'));
			}else{
				 redirect(site_url('Frontend_settings'));
			}
  
    }

    public function upload_home_post_images()
    {
		$main_heading=$this->input->post('main_heading');
		$sub_heading=$this->input->post('sub_heading');
		$button_text=$this->input->post('btn_txt');
		$button_url=$this->input->post('btn_url');
		
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = $_FILES['file_upload']['name'];
        $original_filename = '';
        
        if($_FILES['file_upload']['name']!= '' )
        {
            $upload_path = "uploads/slider_images/";
            $file_type = "gif|jpg|jpeg|png";
            $this->upload->initialize($this->set_upload_options($upload_path, $file_type));

            if($this->upload->do_upload('file_upload'))
            {
                $uploaddata = $this->upload->data();
                $result['filename'] = $uploaddata['file_name'];
                $original_filename = $result['filename'];

                $DbFieldsArray =  array('image_url');
                $DataArray =  array($original_filename);
              
				$image_url=$original_filename;
				$location=$this->input->post('frontend_location');
				$status=$this->input->post('status');;
					$data=array(
								'image_name' 	=> $uploaddata['file_name'],
								'image_path'	=> $uploaddata['file_path'],
								'image_type'	=> $uploaddata['file_type'],
								'frontend_location' => $location,
								'main_heading'  => $main_heading,
								'sub_heading'  	=> $sub_heading,
							    'button'  		=>$button_text,
								'button_url'  	=>$button_url,
								'status'  		=> $status
								);
								
				$this->Frontend_settings_model->insert($data);
			    $this->session->set_flashdata('message', 'Slider Image Added');
				if($location == "home"){
					redirect(site_url('Frontend_settings'));
				}elseif($location == "aboutus"){
					redirect(site_url('Frontend_settings/aboutus'));
				}else{		
					redirect(site_url('Frontend_settings/howitworks'));
				}
				
               
            }
            else
            {
				 $this->session->set_flashdata('message', 'Invalid file type');
				 $this->add_slider();
            }
        }
        else
        {
			$this->session->set_flashdata('message', 'No file selected.');
		    $this->add_slider();
        }
    }

	 public function enable_slider($id){
       
		$slide_id=$id;
		$data= $this->commonmodel->getSingleRecord("SELECT * from tbl_frontend where id=".$slide_id."");
        if($data){
            if($data->status==0){
                $this->commonmodel->update('tbl_frontend',array('status'=>1),array('id'=>$slide_id));
				$this->session->set_flashdata('message', 'Slider Image enabled');
            }else{
                $this->commonmodel->update('tbl_frontend',array('status'=>0),array('id'=>$slide_id));
				$this->session->set_flashdata('message', 'Slider Image Disabled');
            }
          }
		  if($data->frontend_location == "home"){
					redirect(site_url('Frontend_settings'));
			}elseif($data->frontend_location == "aboutus"){
				redirect(site_url('Frontend_settings/aboutus'));
			}elseif($data->frontend_location == "how-it-works"){		
				redirect(site_url('Frontend_settings/howitworks'));
			}else{
				 redirect(site_url('Frontend_settings'));
			}
         
    }
	
    public function set_upload_options($upload_path, $file_type){
        // upload image options
        $config = array();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $file_type;
        $config['overwrite']     = FALSE;
        return $config;
    }
	
	  public function aboutus()
    {	
		
        $check = $this->commonmodel->permissions_check();
		$this->breadcrumbs->push('Frontend Settings', '/frontend_settings/frontend_dashboard/');
		$this->breadcrumbs->push('About-us', '/frontend_settings/aboutus');
        if($check == 0)
        {	$data['title']="About us Slider";
		   $data['slider']=$this->Frontend_settings_model->get_aboutus_images();
           $this->commonmodel->adminloadLayout($data,'frontend_settings/aboutus_settings');
        }
        else $this->commonmodel->adminloadLayout(null,'admin/no_permissions');

    }
	
	 public function enable_aboutus_slider($id){
       
		$slide_id=$id;
		$data= $this->commonmodel->getSingleRecord("SELECT * from tbl_frontend where id=".$slide_id."");
        if($data){
            if($data->status==0){
                $this->commonmodel->update('tbl_frontend',array('status'=>1),array('id'=>$slide_id));
				if($data->frontend_location == "aboutus"){
					$this->db->query('UPDATE `tbl_frontend` SET `status` = 0 WHERE `tbl_frontend`.`id` <> '.$slide_id.' AND `frontend_location` = "aboutus"');
				}else{
					$this->db->query('UPDATE `tbl_frontend` SET `status` = 0 WHERE `tbl_frontend`.`id` <> '.$slide_id.' AND `frontend_location` = "how-it-works"');
				}
				
				$this->session->set_flashdata('message', 'Slider Image enabled');
            }else{
                $this->commonmodel->update('tbl_frontend',array('status'=>0),array('id'=>$slide_id));
				$this->session->set_flashdata('message', 'Slider Image Disabled');
            }
          }
		
		if($data->frontend_location == "aboutus"){
				redirect(site_url('Frontend_settings/aboutus'));
			}elseif($data->frontend_location == "how-it-works"){		
				redirect(site_url('Frontend_settings/howitworks'));
			}else{
				 redirect(site_url('Frontend_settings'));
			}
         
    }
	
	 public function get_slider_aboutus()
    {
        $check = $this->commonmodel->permissions_check();
		$this->breadcrumbs->push('Frontend Settings', '/frontend_settings');
        if($check == 0)
        {
		   $data['slider']=$this->Frontend_settings_model->get_single_image();
           $this->commonmodel->adminloadLayout($data,'frontend_settings/aboutus_settings');
        }
        else $this->commonmodel->adminloadLayout(null,'admin/no_permissions');

    }
	 public function howitworks(){
		   $check = $this->commonmodel->permissions_check();
		   $this->breadcrumbs->push('Frontend Settings', '/frontend_settings/frontend_dashboard/');
		$this->breadcrumbs->push('How it works', '/frontend_settings/aboutus');
        if($check == 0)
        {   $data['title']="How it works Slider";
		   $data['slider']=$this->Frontend_settings_model->get_how_it_works_images();
           $this->commonmodel->adminloadLayout($data,'frontend_settings/howitworks');
        }
        else $this->commonmodel->adminloadLayout(null,'admin/no_permissions');
	 }
	 
}

/* End of file Admins.php */
/* Location: ./application/controllers/Admins.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-05 19:02:43 */
/* http://harviacode.com */