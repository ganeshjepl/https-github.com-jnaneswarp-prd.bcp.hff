<?php

/* States  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             29-07-2017
 * @Last Modified       29-07-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/State_handler.php');

class State extends CI_Controller {

    var $stateHandler;

    public function __construct() {
        parent::__construct();
        $this->stateHandler = new State_handler();   
        
    }

    

    public function statesByCountry() {
        $this->ci = & get_instance();
        
        $inputData = array(
            'countryId' => $this->input->post('id'),
            'name' => $this->input->post('name'),
             
        );
                        
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('getStatesByCountryPagRules'));
                    
        if ($this->ci->form_validation->run() == FALSE) {
            $error['messages'] = $this->ci->form_validation->error_array();
            $error['status'] = 1;
            echo json_encode($error); exit;
        }
        $responseArray = $this->stateHandler->getStatesByCountry($inputData['countryId'] ,'','','',$inputData['name']);
        echo json_encode($responseArray);
    }
    
   
    
}
