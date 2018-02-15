<?php
class User extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function dashboard(){
        $data['page_title'] = "Dashboard";
        $data['page_current'] = "dashboard";
        
        $userid = $this->session->userdata('userid');
        if ($userid == '') {
            redirect(site_url().'UserLogin', 'refresh');
        }
        
        $this->load->view('bcp_views/bcp_dashboard',$data);       
        
    }
}



