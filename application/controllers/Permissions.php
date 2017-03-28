<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permissions extends CI_Controller {
    
        public function __construct() {
        parent::__construct();
        $this->load->model('frontend/commonmodel');
    }

    public function index() {
        
        
    }

    public function check()
    {
        
    }

}
