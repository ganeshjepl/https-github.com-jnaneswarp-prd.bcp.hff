<?php

/* Cities  entity related logic definition
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
require_once (APPPATH . 'handlers/City_handler.php');

class City extends REST_Controller {

    var $cityHandler;

    public function __construct() {
        parent::__construct();
        $this->cityHandler = new City_handler();   
        
    }

    public function index_get() {
        $this->ci = & get_instance();
        $inputData = array(
            'limit' => $this->get('limit'),
            'page' => $this->get('page'),
            'timestamp' => $this->get('timestamp')
        );
                        
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('getCityPagRules'));
                    
        if ($this->ci->form_validation->run() == FALSE) {
            // print_r($this->ci->form_validation->error_array());
            $output['response']['messages'] = $this->ci->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        $responseArray = $this->cityHandler->getAllCities($inputData['limit'], $inputData['page'], $inputData['timestamp']);
        $this->response($responseArray, $responseArray['statuscode']);
    }
    
    public function citiesByState_get() {
        $this->ci = & get_instance();
        
        $inputData = array(
            'stateId' => $this->get('id'),
            'limit' => $this->get('limit'),
            'page' => $this->get('page'),
            'timestamp' => $this->get('timestamp')
        );
                        
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('getCitiesByStatePagRules'));
                    
        if ($this->ci->form_validation->run() == FALSE) {
            // print_r($this->ci->form_validation->error_array());
            $output['response']['messages'] = $this->ci->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        $responseArray = $this->cityHandler->getCitiesByState($inputData['stateId'] ,$inputData['limit'], $inputData['page'], $inputData['timestamp'],'');
        $this->response($responseArray, $responseArray['statuscode']);
    }
    
    public function searchCity_get() {
        $this->ci = & get_instance();
        $inputData = array('name' => $this->get('name'));
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('searchCityRules'));
                    
        if ($this->ci->form_validation->run() == FALSE) {
            // print_r($this->ci->form_validation->error_array());
            $output['response']['messages'] = $this->ci->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        $responseArray = $this->cityHandler->searchCity($inputData['name']);
        $this->response($responseArray, $responseArray['statuscode']);
    }
    
}
