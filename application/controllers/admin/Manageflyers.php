<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manageflyers extends CI_Controller {

    /**
     * Constructor of a login
     */
    function __construct() {
        parent::__construct(); //call to parent constructor
        if(xyzAccesscontrol('flyer_managment','Full')!=TRUE){
         redirect(site_url('_backoffice'));
         exit;
     }
     $this->load->model(array('admin/flyersmodel', 'frontend/commonmodel'));
        // $check = $this->commonmodel->permissions_check();
        // if($check!=0 && $check!=1)
        // {
        //     $this->commonmodel->no_permissions();
        // }
     $this->load->library('form_validation');
     $this->load->helper('form');
 }

    /**
     * This is the default function of a controller
     */
    public function index() {
        $data['sucess'] = $this->session->flashdata('sucess');
        $this->commonmodel->adminloadLayout($data, 'admin/manageflyers/content');
    }

    public function save($tab = NULL) {
        $errors = [];
        $flyers = [];
        $data = '';
        $data['error'] = FALSE;
        $data['success'] = FALSE;
        $data['svgs'] = $this->flyersmodel->get_all_svgs();
		$this->breadcrumbs->push('Manage flyers', '/flyers_management');
		$this->breadcrumbs->push('Add Flyer', '/Manageflyers/save');
        // $data['buttontags'] = $this->flyersmodel->getAllbutton_tags();
        if (isset($_POST['submit'])) {
            $post = $_POST;
            // print_r($_FILES); exit;

            $config['upload_path'] = './public/upload/flyer_images/';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf';
            $config['encrypt_name'] = TRUE;
            $config['max_size']  = 50000;
            $config['max_width'] = 10000;
            $config['max_height']= 10000;
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);

            $this->form_validation->set_rules('flyer_size', 'Flyer Size', 'required');


            if (!$this->form_validation->run()) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="Alert">Something went wrong!</div>');
                redirect(site_url('admin/manageflyers/save'));
                // echo ''; exit;

            } else {

                $files = array();

            // print_r($_FILES); exit;
                $this->load->library('image_lib');

                $FILES = $_FILES;

                for ($i=0; $i< count($FILES['fileinput']['name']); $i++)
                {

                    $_FILES['fileinput']['name']= $FILES['fileinput']['name'][$i];
                    $_FILES['fileinput']['type']= $FILES['fileinput']['type'][$i];
                    $_FILES['fileinput']['tmp_name']= $FILES['fileinput']['tmp_name'][$i];
                    $_FILES['fileinput']['error']= $FILES['fileinput']['error'][$i];
                    $_FILES['fileinput']['size']= $FILES['fileinput']['size'][$i];

                    $this->upload->initialize($config);
                        // $this->upload->do_upload();

                    if (!$this->upload->do_upload("fileinput")){
                     array_push($errors, $this->upload->display_errors());
                 }else{
                        $filearray = array('upload_data' => $this->upload->data('full_path'));
                        //print_r($filearray); exit;
                        $ext = pathinfo($filearray['upload_data'],PATHINFO_EXTENSION);
                        if($ext=='pdf')
                        {
                            $new_fname = str_replace(".pdf","",$filearray['upload_data']).'.jpg'; //new file name in jpg
                            $im = new Imagick();
                            $im->setResolution(300, 300);
                            $im->readimage($filearray['upload_data']);
                            $im->setImageFormat('jpeg');
                            $im->writeImage($new_fname);
                            $im->clear();
                            $im->destroy();

                            $picture = $new_fname;
                        }
                        else
                        {
                            $picture = $filearray['upload_data'];
                        }
                        //echo $picture;exit;
                    //$picture = $this->upload->data('full_path');

                    $configSize1['image_library']   = 'gd2';
                    $configSize1['source_image']    = $picture;

                    $configSize1['maintain_ratio']  = TRUE;
                    $configSize1['width']           = 200;
                    $configSize1['height']          = 240;
                    $configSize1['new_image']   = 'thumb_' . basename($picture);

                    $this->image_lib->initialize($configSize1);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    /* Second size */
                    list($width, $height) = getimagesize($picture);
                    if($height > 1000 && $height< 1500){
                        $height = $height/2;
                    }else if($height > 1500 && $height< 2500){
                        $height = $height/3;
                    }else if($height > 2500 || $height > 3500){
                        $height = $height/4;
                    }else{

                    }


                    $configSize2['image_library']   = 'gd2';
                    $configSize2['source_image']    = $picture;

                    $configSize2['maintain_ratio']  = TRUE;
                    // $configSize2['width']           = $width/4;
                    $configSize2['height']          = ceil($height);
                    $configSize2['new_image']   = 'resized_' . basename($picture);

                    $this->image_lib->initialize($configSize2);
                    $this->image_lib->resize();
                    $this->image_lib->clear();




                    $insert_arr = Array('flyer_image'=> basename($picture),

                        'flyer_image_size' => $post['flyer_size'],
                        'flyer_creation_date' =>  Date('Y-m-d H:i:s'),
                        'admin_id' => $this->session->userdata['admin_data']['pk_admin_id']);

                    $flyerID = $this->flyersmodel->saveFlyer($insert_arr);

                    if(!$flyerID){
                        $data['message'] = '<div class="alert alert-danger" role="Alert">Flyer could not be saved to database. Try again.</div>';
                    }else{

                        $data['flyer'][]= basename($picture);//$this->upload->data()['file_name'];
                        $data['message'] = '<div class="alert alert-success" role="Alert">Flyer Added Successfully</div>';
                        log_queries('admin', 0, 'flyers', $flyerID);
                    }
                }
            }
        }
    }

    $data['flyerSize'] = $this->flyersmodel->getAllFlyerSize('Active');
    $data['flyerTags'] = $this->flyersmodel->getAllflyer_tags();
    $data['flyers'] = $this->flyersmodel->getAllflyers();
    $data['tab'] = $tab;
	
    $this->commonmodel->adminloadLayout($data, 'admin/manageflyers/save');

}

public function ajax_save_flyer_tags_relation($flyerID)
{
    $post = $this->input->post();
    if($this->flyersmodel->saveFlyerFlyertagsRelation(array('flyerid'=> $flyerID, 'flyer' => $post['flyer_tags']))=='done')
    {
        if(isset($post['removed_tags']))
        {
            if(count($post['removed_tags'])>0)
                $this->flyersmodel->removeTagRelations($flyerID, $post['removed_tags']);
        }
        echo 'done';
    }

}


public function flyer_save_properties($flyerID, $data)
{
    if($flyerID)
    {
        if($res = $this->flyersmodel->flyer_save_properties($flyerID, $data))
        {
            return true;
        }
        else return $res;
    }else echo 'flyer id not found';

}

public function save_colorsets($flyerID)
{
    if($flyerID)
    {
        if($this->flyersmodel->flyer_save_colorsets($flyerID, $this->input->post('json')))
        {
            echo 'true';
        }
        else echo 'false';
    }else echo 'flyer id not found';

}

public function load_html($flyer_id){
	
	$flyer = $this->flyersmodel->get_flyer_by_id($flyer_id);
	$data['image']= $flyer->flyer_created_image;
	$data['header']="emails/style1/incs/header";
	$data['footer']="emails/style1/incs/footer";
	$this->load->view('admin/manageflyers/flyer',$data);
}

public function flyer_pdf($flyer_id){
	
	$flyer = $this->flyersmodel->get_flyer_by_id($flyer_id);
	$image_name = $flyer->flyer_created_image;
	
     $im = new Imagick();
        $im->setResolution(300, 300);
        $im->readimage('./public/upload/flyers/'.$image_name); 
        /*if($im->getImageWidth()==650) 
            $im->scaleImage(2625, 3375);
            else $im->scaleImage(2550, 3300);*/
        $im->scaleImage(2550, 3300);
        $im->setImageFormat('pdf');    
        header('Content-Type: application/pdf');// if generating pdf from jpg and forcing download
        echo $im;
        $im->clear(); 
        $im->destroy();
}

public function email_flyer(){
    $fId=$this->input->post('flyer_id');
    $flyer = $this->flyersmodel->get_flyer_by_id($fId);
     if(count((array)$flyer)<1)
    {
        echo "error";
    }elseif($flyer->flyer_created_image){
        $data['image']= $flyer->flyer_created_image;
        $data['header']="emails/style1/incs/header";
        $data['footer']="emails/style1/incs/footer";
        //$this->load->view('admin/manageflyers/flyer',$data);
        $this->load->helper('send_mail');
        $admin_id=$this->session->userdata('admin_data')['pk_admin_id'];
        $email_qurey = $this->commonmodel->getSingleRecord("SELECT `admin_email` FROM `tbl_admin` WHERE `admin_id` = ".$admin_id."");
        $email= $email_qurey->admin_email;
        $subject="Test Flyer Email";
        _sendMail($email, $subject, $this->load->view('admin/manageflyers/flyer',$data, TRUE));
        //$this->load->view('emails/style1/flyer',$data);
        echo "sent";
        //print_r($data);
        
    }else{
        echo "Image not found";
    }
    
}

public function email_flyer_to_anyone(){
    $fId=$this->input->post('flyer_id');
    $email=$this->input->post('email');
    $flyer = $this->flyersmodel->get_flyer_by_id($fId);
     if(count((array)$flyer)<1)
    {
        echo "error";
    }elseif($flyer->flyer_created_image){
        $data['image']= $flyer->flyer_created_image;
        $data['header']="emails/style1/incs/header";
        $data['footer']="emails/style1/incs/footer";
        //$this->load->view('admin/manageflyers/flyer',$data);
        $this->load->helper('send_mail');
        $subject="New Flyer on XYZFlyers.com";
        _sendMail($email, $subject, $this->load->view('admin/manageflyers/flyer',$data, TRUE));
        //$this->load->view('emails/style1/flyer',$data);
        echo "sent";
        //print_r($data);
        
    }else{
        echo "Image not found";
    }
    
}

public function flyer_save_for_later()
{
    // print_r($_POST); exit;
    $post = $this->input->post();
    if($this->input->post('flyer_id'))
    {
        $fId = $this->input->post('flyer_id');
        //if flyer is selected
        // $properties = json_decode($post['properties'], true);
        // print_r($properties); exit;
        if($this->flyer_save_properties($fId, $post['properties']))
        {
            //if properties are added
            // now add the flyer remaining attributes

            //saving flyer image
            $img = $post['image_b64'];
            htmlspecialchars_decode($img);
            list($type, $data) = explode(';', $img);
            list(, $img)      = explode(',', $img);
            $img = base64_decode($img);

            $output_file_without_extentnion = md5(time().uniqid());

            $this->load->helper('file');


            $flyer = $this->flyersmodel->get_flyer_by_id($fId);
             // print_r($flyer); exit;
            if(count((array)$flyer)<1)
            {
                // echo 'no flyer';
               // print_r($flyer); exit;
               if(!write_file('./public/upload/flyers/'.$output_file_without_extentnion.'.jpg', $img))
                { echo 'json file write failed'; array_push($errors, 'json file write failed');}
        }
        else{
                // echo 'flyer found';
                // print_r($flyer); exit;
            if($flyer->flyer_created_image)
            {
                $file = './public/upload/flyers/'.$flyer->flyer_created_image;
                if(file_exists($file)) {unlink($file);}
            }

            if(!write_file('./public/upload/flyers/'.$output_file_without_extentnion.'.jpg', $img)){
             echo 'json file write failed'; @array_push($errors, 'image file write failed');
         }

         if($flyer->flyer_json_file)
         {
            $file = './public/upload/flyers/'.$flyer->flyer_json_file;
            if(file_exists($file)) {unlink($file);}
        }

        if(!write_file('./public/upload/flyers/'.$output_file_without_extentnion.'.json', $post['flyer_json']))
            {echo 'json file write failed'; @array_push($errors, 'json file write failed');}
    }

    if($this->flyersmodel->add_designed_flyer($fId,
        array(  'flyer_created_image'=>$output_file_without_extentnion.'.jpg',
            'flyer_json_file'=> $output_file_without_extentnion.'.json',
            'flyer_status'=>'Draft',
                        // 'flyer_approved'=>'Yes',
                        // 'flyer_approved_by'=> $this->session->userdata['admin_data']['pk_admin_id'],
            'modified_by'=> $this->session->userdata['admin_data']['pk_admin_id'],
            'modified_date'=> Date('Y-m-d H:i:s')
            ))) {
        log_queries('admin', 0, 'flyer_later', 'flyer');
    echo 'done';

		} else echo 'error';
		}
	}
}
public function flyer_publish()
{
    // print_r($_POST); exit;
    $post = $this->input->post();
    if($this->input->post('flyer_id'))
    {
        $fId = $this->input->post('flyer_id');
        //if flyer is selected
        // $properties = json_decode($post['properties'], true);
        // print_r($properties); exit;
        if($this->flyer_save_properties($fId, $post['properties']))
        {
            //if properties are added
            // now add the flyer remaining attributes

            //saving flyer image
            $img = $post['image_b64'];
            htmlspecialchars_decode($img);
            list($type, $data) = explode(';', $img);
            list(, $img)      = explode(',', $img);
            $img = base64_decode($img);

            $output_file_without_extentnion = md5(time().uniqid());

            $this->load->helper('file');


            $flyer = $this->flyersmodel->get_flyer_by_id($fId);
             // print_r($flyer); exit;
            if(count((array)$flyer)<1)
            {
                // echo 'no flyer';
               // print_r($flyer); exit;
               if(!write_file('./public/upload/flyers/'.$output_file_without_extentnion.'.jpg', $img))
                { echo 'json file write failed'; array_push($errors, 'json file write failed');}
        }
        else{
                // echo 'flyer found';
                // print_r($flyer); exit;
            if($flyer->flyer_created_image)
            {
                $file = './public/upload/flyers/'.$flyer->flyer_created_image;
                if(file_exists($file)) {unlink($file);}
            }

            if(!write_file('./public/upload/flyers/'.$output_file_without_extentnion.'.jpg', $img)){
             echo 'json file write failed'; @array_push($errors, 'image file write failed');
         }

         if($flyer->flyer_json_file)
         {
            $file = './public/upload/flyers/'.$flyer->flyer_json_file;
            if(file_exists($file)) {unlink($file);}
        }

        if(!write_file('./public/upload/flyers/'.$output_file_without_extentnion.'.json', $post['flyer_json']))
            {echo 'json file write failed'; @array_push($errors, 'json file write failed');}
    }

    if($this->flyersmodel->add_designed_flyer($fId,
        array(  'flyer_created_image'=>$output_file_without_extentnion.'.jpg',
            'flyer_json_file'=> $output_file_without_extentnion.'.json',
            'flyer_status'=>'Published',
                        // 'flyer_approved'=>'Yes',
                        // 'flyer_approved_by'=> $this->session->userdata['admin_data']['pk_admin_id'],
            'modified_by'=> $this->session->userdata['admin_data']['pk_admin_id'],
            'modified_date'=> Date('Y-m-d H:i:s')
            ))) {
        log_queries('admin', 0, 'flyer_later', 'flyer');
    echo 'done';

} else echo 'error';
}

}
else {
        //if new flyer
    echo 'no flyer selected!';
}
}

public function load_json($id)
{
 $flyer = $this->flyersmodel->get_flyer_by_id($id);
 $file = $flyer->flyer_json_file;
 $this->load->helper('file');
 echo htmlspecialchars_decode(read_file('public/upload/flyers/'.$file));
}

public function ajax_get_flyer_tags($flyerId)
{
    $r = $this->flyersmodel->getFlyer_tags($flyerId);
    if($r!='') echo json_encode($r);
    else echo 'Nothing';

}

public function load_flyers_by_tags()
{
    echo json_encode($this->flyersmodel->load_flyers_by_tags($this->input->post('tagId')));
}

public function load_new_flyers()
{
    echo json_encode($this->flyersmodel->load_new_flyers());
}
public function add_flyer_tags() {
    $data = '';
    if (isset($_POST['submit'])) {

        $this->form_validation->set_rules('flyer_tags_title', 'Tags Title', 'required');
        if ($this->form_validation->run() == FALSE) {

            } else { // no errors now to save the data
                $flyer_tags_title = $this->input->post('flyer_tags_title');
                $datas = array(
                    'flyer_tags_title' => $flyer_tags_title,
                    'flyer_tags_date' => date('Y-m-d h:i:s')
                    );
                $this->db->insert('tbl_flyer_tags', $datas);
                $data['sucess'] = 'Flyer Added successfully';
            }
        }
        $this->commonmodel->adminloadLayout($data, 'admin/manageflyers/add_flyer_tags');
    }

    public function delete_this_flyer()
    {
        $id = $this->input->post('flyerId');
        $flyer = $this->flyersmodel->get_flyer_by_id($id);
        if($flyer && count((array)$flyer)>0)
        {
                // print_r($flyer);

                // remove flyer tag relations
            $this->flyersmodel->remove_flyer_tags($id);

                // remove flyer properties if any
            $this->flyersmodel->remove_flyer_properties($id);

                // remove flyer image
            $file = './public/upload/flyer_images/'.$flyer->flyer_image;
            if(file_exists($file)) unlink($file);

                // remove flyer json flie
            $file = './public/upload/files/flyers/'.$flyer->flyer_json_file;
            if(file_exists($file)) unlink($file);

                // remove flyer designed image file if any

                //remove flyer detail record
            $this->flyersmodel->remove_flyer($id);

            echo 'done';
        }else echo 'No Flyers Found!';
    }

    public function add_button_tags() {

        $data = '';
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('button_tags_title', 'Button Title', 'required');
            if ($this->form_validation->run() == FALSE) {

            } else { // no errors now to save the data
                $button_tags_title = $this->input->post('button_tags_title');
                $datas = array(
                    'button_tags_title' => $button_tags_title,
                    'button_tags_date' => date('Y-m-d h:i:s')
                    );
                $this->db->insert('tbl_button_tags', $datas);

                $data['sucess'] = 'Button Added successfully';
            }
        }
        $this->commonmodel->adminloadLayout($data, 'admin/manageflyers/add_button_tags');
    }

    public function get_fonts()
    {
        $this->db->select('fontId, fontTitle')->from('admin_fonts')->order_by('fontTitle', 'asc')->group_by('fontTitle');
        $query = $this->db->get();
        echo json_encode($query->result());
    }

    public function save_flyer_assets()
    {
        // ob_start();
        $this->load->helper('file');

// Callback name is passed if upload happens via iframe, not AJAX (FileAPI).
        $callback = &$_REQUEST['fd-callback'];

// Upload data can be POST'ed as raw form data or uploaded via <iframe> and <form>
// using regular multipart/form-data enctype (which is handled by PHP $_FILES).
        if (!empty($_FILES['fd-file']) and is_uploaded_file($_FILES['fd-file']['tmp_name'])) {
  // Regular multipart/form-data upload.
          $name = $_FILES['fd-file']['name'];
  // move_uploaded_file($name, '/'.$name);
          $data = file_get_contents($_FILES['fd-file']['tmp_name']);
      } else {
  // Raw POST data.
          $name = urldecode(@$_SERVER['HTTP_X_FILE_NAME']);
          $data = file_get_contents("php://input");
          // file_put_contents($name, $data);

      }
      $new_name = time().$name;
      if(!write_file('./public/upload/flyers/assets/'.$new_name, $data))
        { echo 'error';}
    else 
        {
            $arrayName = array('url' => base_url('/public/upload/flyers/assets/'.$new_name), 'name'=> $new_name);
            echo json_encode($arrayName);
        }
/*
// In FileDrop sample this demonstrates the passing of custom ?query variables along
// with an AJAX/iframe upload.
      $opt = &$_REQUEST['upload_option'];
      isset($opt) and $output .= "\nReceived upload_option with value $opt";

      if ($callback) {
  // Callback function given - the caller loads response into a hidden <iframe> so
  // it expects it to be a valid HTML calling this callback function.
          header('Content-Type: text/html; charset=utf-8');

  // Escape output so it remains valid when inserted into a JS 'string'.
          $output = addcslashes($output, "\\\"\0..\x1F");

  // Finally output the HTML with an embedded JavaScript to call the function giving
  // it our message(in your app it doesn't have to be a string) as the first parameter.
          echo '<!DOCTYPE html><html><head></head><body><script type="text/javascript">',
          "try{window.top.$callback(\"$output\")}catch(e){}</script></body></html>";
      } else {
  // Caller reads data with XMLHttpRequest so we can output it raw. Real apps would
  // usually pass and read a JSON object instead of plan text.
          header('Content-Type: text/plain; charset=utf-8');
          echo $output;
      }
*/
  }

  public function remove_flyer_asset($file = null)
  {
    if(!$file) $file = $this->input->post('file');
    if($file){
        if(file_exists('./public/upload/flyers/assets/'.$file))
            {if(unlink('./public/upload/flyers/assets/'.$file)) echo 'done'; else echo 'error';}
        else echo 'no file';
    }
    else echo 'invalid request';
}

}
