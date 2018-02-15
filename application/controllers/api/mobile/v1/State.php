<?php

/* States  entity related logic definition
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
require_once (APPPATH . 'handlers/State_handler.php');

class State extends REST_Controller {

    var $stateHandler;

    public function __construct() {
        parent::__construct();
        $this->stateHandler = new State_handler();   
        
    }

    public function index_get() {
        $inputData = array(
            'limit' => $this->get('limit'),
            'page' => $this->get('page'),
            'timestamp' => $this->get('timestamp')
        );
                        
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('getStatePagRules'));
                    
        if ($this->form_validation->run() == FALSE) {
            // print_r($this->form_validation->error_array());
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        $responseArray = $this->stateHandler->getAllStates($inputData['limit'], $inputData['page'], $inputData['timestamp']);
        $this->response($responseArray, $responseArray['statuscode']);
    }

    public function statesByCountry_get() {
        $inputData = array(
            'countryId' => $this->get('id'),
            'limit' => $this->get('limit'),
            'page' => $this->get('page'),
            'timestamp' => $this->get('timestamp')
        );
                        
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('getStatesByCountryPagRules'));
                    
        if ($this->form_validation->run() == FALSE) {
            // print_r($this->form_validation->error_array());
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        $responseArray = $this->stateHandler->getStatesByCountry($inputData['countryId'] ,$inputData['limit'], $inputData['page'], $inputData['timestamp']);
        $this->response($responseArray, $responseArray['statuscode']);
    }
    
    public function searchState_get() {
        $inputData = array('name' => $this->get('name'));
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('searchStateRules'));
                    
        if ($this->form_validation->run() == FALSE) {
            // print_r($this->form_validation->error_array());
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        $responseArray = $this->stateHandler->searchState($inputData['name']);
        $this->response($responseArray, $responseArray['statuscode']);
    }
    
}
