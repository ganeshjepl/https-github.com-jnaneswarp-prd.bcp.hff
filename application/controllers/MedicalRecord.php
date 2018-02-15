<?php

class MedicalRecord extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $data['page_title'] = "Create Medical Record";
        $data['page_current'] = "medical_record";
        
        $userid = $this->session->userdata('userid');
        if ($userid == '') {
            redirect(site_url().'UserLogin', 'refresh');
        }
            
        $this->load->view('bcp_views/bcp_medical_record', $data);
        
    }
    
    public function primary_new_reg(){
         $data['page_title'] = "Create Medical Record";
         $data['page_current'] = "medical_record";
    }

}
