<?php

class Patient extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function registration() {
        $data['page_title'] = "New Patient Registration";
        $data['page_current'] = "patient_reg";
        
        $userid = $this->session->userdata('userid');
        if ($userid == '') {
            redirect(site_url().'UserLogin', 'refresh');
        }
        
        $this->load->view('bcp_views/bcp_patient_registration', $data);
       
    }

}

?>
