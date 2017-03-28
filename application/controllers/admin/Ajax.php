<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ajax extends CI_Controller {

    /**
     * Constructor of a login 
     */
    private $asset_url_flyer_images = null;
    private $asset_url_flyer_json = null;
    private $asset_url_flyer_objects = null;

    function __construct() {
        parent::__construct(); //call to parent constructor
        $this->load->model(array('admin/flyersmodel', 'frontend/commonmodel'));
        $this->asset_url_flyer_images = base_url('public/upload/flyer_images') . '/';
        $this->asset_url_flyer_json = base_url('public/upload/flyer_json') . '/';
        $this->asset_url_flyer_objects = 'public/upload/flyer_objects/';
    }

    public function index() {
        $response = array(
            'meta' => array(
                'code' => 401,
                'success' => FALSE
            ),
            'data' => array(
                'message' => 'nothing found',
            )
        );

        echo json_encode($response);
        exit;
    }

    public function templates($templateId = NULL) {
        $response['meta'] = array(
            'code' => 200,
            'success' => FALSE
        );
        $response['data'] = array('message' => 'Template Id not set');
        if ($templateId != "") {
            $template = $this->flyersmodel->getFlyer($templateId);
            if (is_array($template) && $template != FALSE) {
                $response['meta']['success'] = TRUE;
                $response['data']['message'] = 'Templete found';
                $template['image'] = $this->asset_url_flyer_images . $template['image_name'];
                $template['json'] = $this->asset_url_flyer_images . $template['json_filename'];
                $response['data']['template'] = $template;
            } else {
                $response['data']['message'] = 'No template found';
            }
        }
        echo json_encode($response);
        exit;
    }

    public function getFonts() {

        $response = array(
            'meta' => array(
                'code' => 200,
                'success' => FALSE
            ),
            'data' => array('message' => 'Template Id not set')
        );

        $fonts = $this->flyersmodel->getAllFonts();
        if (is_array($fonts) && $fonts != FALSE) {
            $response['meta']['success'] = TRUE;
            $response['data']['message'] = 'Font list';
            $response['data']['fonts'] = $fonts;
        } else {
            $response['data']['message'] = 'No font found';
        }
        echo json_encode($response);
        exit;
    }

    public function getFlyerColorSet($flyerId = NULL) {
        $response['meta'] = array(
            'code' => 200,
            'success' => FALSE
        );
        $response['data'] = array('message' => 'Template Id not set');

        if ($flyerId != "") {
            $colorSet = $this->flyersmodel->getFlyerColorSet($flyerId);
            if (!$colorSet) {
                $response['data']['message'] = 'No color set assigned to template';
            } else {
                $response['data']['message'] = 'Color set found';
                $response['data']['set'] = $colorSet;
                foreach ($colorSet as $key => $value) {
                    $colors = $this->flyersmodel->getColorListWithSetid($value['set_id']);
                    $response['data']['set'][$key] = is_array($colors) && $colors != FALSE ? $colors : 'No colors assigned';
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function getObjectsList() {
        $response['meta'] = array(
            'code' => 200,
            'success' => FALSE
        );
        $response['data'] = array('message' => 'Objects directory not found');
        
        if($dir = scandir(FCPATH.$this->asset_url_flyer_objects)){
            $response['data']['message']= 'Directory read successful';
            unset($dir[0]);
            unset($dir[1]);
            $count = 0;
            foreach($dir as $key => $value){
                $response['data']['images'][$count++] = array('path' => base_url().  $this->asset_url_flyer_objects.$value);
            }
        }
        
        echo json_encode($response);
        exit;
    }

}
