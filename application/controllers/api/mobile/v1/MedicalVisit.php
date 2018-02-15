<?php

/**
  Medical Visit           Controller
 * @package		   CodeIgniter
 * @author		   Atumit Development Team
 * @copyright	           Copyright (c) 2017, Atumit.
 * @Version		   Version 1.0
 * @Created                28-05-2017
 * @Last Modified          28-05-2017
 * @Last Modified By       Shiva jyothi   
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/Medicalvisit_handler.php');

class MedicalVisit extends REST_Controller {

    var $medicalvisit_handler;

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->medicalvisit_handler = new Medicalvisit_handler();
    }

    public function medicalVisitDetails_get() {

        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];

        if ($userrole == 'doctor') {
            $inputData = array('limit' => $this->get('limit'),
                'page' => $this->get('page'));
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules('limit', 'Limit', 'trim|numericCheck');
            $this->form_validation->set_rules('page', 'Page', 'trim|numericCheck');
            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            $responseArray = $this->medicalvisit_handler->getMedicalVisitDetails($inputData['limit'], $inputData['page']);
            //print_r($responseArray);exit;
            $this->response($responseArray, $responseArray['statusCode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }

    public function medicalsurveyDetails_get() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'doctor') {
            $inputData = array(
                'medicalvisit' => $this->get('medicalvisit'),
                'limit' => $this->get('limit'),
                'page' => $this->get('page')
            );
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules('medicalvisit', 'Medical visit', 'trim|required');
            $this->form_validation->set_rules('limit', 'Limit', 'trim|numericCheck');
            $this->form_validation->set_rules('page', 'Page', 'trim|numericCheck');
            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            $responseArray = $this->medicalvisit_handler->getMedicalSurveyDetails($inputData);
            //print_r($responseArray);exit;
            $this->response($responseArray, $responseArray['statusCode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }

}
