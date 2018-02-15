<?php

/* Country  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             29-07-2017
 * @Last Modified       29-07-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/Country_handler.php');
class Country extends CI_Controller {

    var $countryHandler;

    public function __construct() {
        parent::__construct();
        $this->countryHandler = new Country_handler();   
        
    }
    public function searchCountry() {
        $this->ci = & get_instance();
        
        $inputData = array('name' => $this->input->post('name'));
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('searchCountryRules'));
                    
        if ($this->ci->form_validation->run() == FALSE) {
            // print_r($this->ci->form_validation->error_array());
            $error['messages'] = $this->ci->form_validation->error_array();
            $error['status'] = 1;
            echo json_encode($error); exit;
        }
        $responseArray = $this->countryHandler->searchCountry($inputData['name']);
         echo json_encode($responseArray);
    }
     
}
