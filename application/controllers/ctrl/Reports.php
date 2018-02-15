<?php

/* Network Hospital  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             18-07-2017
 * @Last Modified       18-07-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/Reports_handler.php');
require_once (APPPATH . 'handlers/User_handler.php');
require_once (APPPATH . 'handlers/State_handler.php');
class Reports extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {
               
                 redirect(getUrl('ctrlLogin'));
            }
        }else{
               if($responseArray['response']['sessionData']['userrole']=='doctor'){
                  
                  redirect(getUrl('doctorDashboard')) ;
             }
            
        }
        $this->Reportshandler = new Reports_handler(); 
        $this->Userhandler = new User_handler(); 
        $this->Statehandler = new State_handler(); 
       
    }
public function index(){
        $data['active']= "reportactive"; 
        $data['page_title']='Reports';
        $data['response']= $this->Reportshandler->getAllReports(null);
        $data['content'] = 'ctrl/ctrl_chart';
        $template = 'templates/ctrl_template';
        $this->load->view($template, $data);
    }


}