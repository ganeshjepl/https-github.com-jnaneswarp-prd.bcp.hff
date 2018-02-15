<?php

/* Cities  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             29-07-2017
 * @Last Modified       29-07-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/City_handler.php');

class City extends CI_Controller {  

    var $cityHandler;

    public function __construct() {
        parent::__construct();
        $this->cityHandler = new City_handler();   
        
    }

    public function index() {
        $responseArray = $this->cityHandler->getAllCities('','','');
        echo json_encode($responseArray);
         
    }
    
    public function citiesByState() {
        $this->ci = & get_instance();
        
        $inputData = array(
            'stateId' =>$this->input->post('id'),
            'name' =>$this->input->post('name'),
        );
                        
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('getCitiesByStatePagRules'));
                    
        if ($this->ci->form_validation->run() == FALSE) {
             
            
        }
        $responseArray = $this->cityHandler->getCitiesByState($inputData['stateId'] ,'','','',$inputData['name']);
         echo json_encode($responseArray);
    }
    
    public function searchCity() {
        $this->ci = & get_instance();
        $inputData = array('name' => $this->input->post('name'));
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('searchCityRules'));
                    
        if ($this->ci->form_validation->run() == FALSE) {
            // print_r($this->ci->form_validation->error_array());
            $error['messages'] = $this->ci->form_validation->error_array();
            $error['status'] = 1;
            
        }
        $responseArray = $this->cityHandler->searchCity($inputData['name']);
        echo json_encode($responseArray);
    }
    
}
