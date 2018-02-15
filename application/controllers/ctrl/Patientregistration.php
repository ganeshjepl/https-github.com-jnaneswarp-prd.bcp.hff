<?php

/* Network Hospital  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             14-06-2017
 * @Last Modified       17-07-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/patient_handler.php');
require_once (APPPATH . 'handlers/Country_handler.php');
require_once (APPPATH . 'handlers/State_handler.php');
class Patientregistration extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {               
                 redirect(getUrl('ctrlLogin'));
            }
        }else{
            if($responseArray['response']['sessionData']['userrole']=='doctor')
            {                  
                  redirect(getUrl('doctorDashboard')) ;
            }            
        }
        $this->load->library('form_validation');
        $this->patient_handler  = new Patient_handler(); 
        $this->Countryhandler   = new Country_handler(); 
        $this->Statehandler     = new State_handler(); 
    }
    public function index(){
        $data['active']='Patientregistration';
        $data['response']= $this->patient_handler->getPatients();        
        $data['page_title']='Patient Registration';
        $data['content'] = 'ctrl/ctrl_patientregistration';
        $template = 'templates/ctrl_template';
        $this->load->view($template, $data);
    }
    
     
     
     
     
     
}