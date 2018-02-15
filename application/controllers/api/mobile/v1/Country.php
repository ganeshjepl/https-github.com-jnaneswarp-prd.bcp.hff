<?php

/* Country  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       21-04-2017
 * @Last Modified By    Pandu Babu
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/Country_handler.php');

class Country extends REST_Controller {

    var $countryHandler;

    public function __construct() {
        parent::__construct();
        $this->countryHandler = new Country_handler();   
        
    }

    public function index_get() {
        $inputData = array(
            'limit' => $this->get('limit'),
            'page' => $this->get('page'),
            'timestamp' => $this->get('timestamp')
        );
                        
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('getCountryPagRules'));
                    
        if ($this->form_validation->run() == FALSE) {
            // print_r($this->form_validation->error_array());
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        $responseArray = $this->countryHandler->getAllCountries($inputData['limit'], $inputData['page'], $inputData['timestamp']);
        $this->response($responseArray, $responseArray['statuscode']);
    }

    public function searchCountry_get() {
        $inputData = array('name' => $this->get('name'));
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('searchCountryRules'));
                    
        if ($this->form_validation->run() == FALSE) {
            // print_r($this->form_validation->error_array());
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        $responseArray = $this->countryHandler->searchCountry($inputData['name']);
        $this->response($responseArray, $responseArray['statuscode']);
    }
    
    
}
