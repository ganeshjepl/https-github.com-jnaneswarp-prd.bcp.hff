<?php

/* language entity related logic defination
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       21-04-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/Language_handler.php');

class Language extends REST_Controller {

    var $languageHandler;

    public function __construct() {
        parent::__construct();
        $this->languageHandler = new Language_handler();
    }

    public function index_get() {
        $this->load->library('form_validation');
        $limit = $this->get('limit');
        $page = $this->get('page');
        $inputData = array(
            'limit' => $this->get('limit'),
            'page' => $this->get('page'),
            'timestamp' => $this->get('timestamp')
        );
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules('limit', 'Limit', 'trim|numericCheck');
        $this->form_validation->set_rules('page', 'Page', 'trim|numericCheck');
        if ($this->form_validation->run() == FALSE) {
            // print_r($this->form_validation->error_array());
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        $responseArray = $this->languageHandler->getLanguageDetails($inputData['limit'], $inputData['page']);
        $this->response($responseArray, $responseArray['statuscode']);
    }
    
    public function searchLanguage_get() {
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
        $responseArray = $this->languageHandler->searchLanguage($inputData['name']);
        $this->response($responseArray, $responseArray['statuscode']);
    }

}

?>
