<?php

require_once (APPPATH . 'handlers/User_handler.php');

class UserLogin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');

        $this->userHandler = new User_handler();
    }

    public function index() {
        // Load view to be displayed
       
        $userid = $this->session->userdata('userid');
        if ($userid != '') {
            redirect(site_url().'user/dashboard', 'refresh');
        }
                
        $this->load->view('bcp_views/bcp_login.php');
        
    }
     
    
    public function logout() {
        $this->userHandler->logout();
        redirect(site_url().'UserLogin');
    }

}
