<?php
/**
 primary Assessment Survey Controller  
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By Sridevi Gara
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/Primary_assessment_handler.php');
require_once (APPPATH.'handlers/Networkhospital_handler.php');
require_once (APPPATH . 'handlers/Language_handler.php');

class PrimaryAssessment extends REST_Controller {
    
    var $primaryAssessmentHandler;
    var $networkhospitalHandler;
    var $languageHandler;
    
    public function __construct() {
        parent::__construct();
        $this->primaryAssessmentHandler = new Primary_assessment_handler();
        $this->networkhospitalHandler = new Networkhospital_handler();
        $this->languageHandler = new Language_handler();
    }
    
    public function index_get() {  
        $type = "";
        $timestamp = "";
        if($this->get('type')){
            $type = trim($this->get('type'));
        }
        if($this->get('timestamp')){
            $timestamp = trim($this->get('timestamp'));
        }
        
        $responseArray = $this->primaryAssessmentHandler->getPrimaryAssessmentDetail($type , $timestamp);        
        $this->response($responseArray, $responseArray['statusCode']);        
    }
    
    /*
    public function followup_get() {   
        $type = "";
        $timestamp = "";
        if($this->get('type')){
            $type = trim($this->get('type'));
        }
        if($this->get('timestamp')){
            $timestamp = trim($this->get('timestamp'));
        }
        $responseArray = $this->primaryAssessmentHandler->getPrimaryAssessmentDetail($type="followup", $timestamp="");        
        $this->response($responseArray, $responseArray['statusCode']);        
    }
    */
    
    public function onlineSynchronization_get() {
        $timestamp = trim($this->get('timestamp'));        
        if($timestamp !=""){
               
            $inputData = array(
                "timestamp" => $timestamp
            );
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('timestampRules'));

            if ($this->form_validation->run() == FALSE) {
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $output['statusCode'] = STATUS_BAD_REQUEST;
                $this->response($output, $output['statusCode']);
            } 
            else { 
                $primaryAssessmentData = "";
                $primaryAssessmentResponse = $this->primaryAssessmentHandler->getPrimaryAssessmentDetail($type="", $timestamp);
                if($primaryAssessmentResponse['response']['total'] > 0){
                    $primaryAssessmentData = $primaryAssessmentResponse['response']['primaryAssessmentData'];
                }
                
                $followupPrimaryAssessmentData = "";
                $followupPrimaryAssessmentResponse = $this->primaryAssessmentHandler->getPrimaryAssessmentDetail($type="followup", $timestamp);
                if($followupPrimaryAssessmentResponse['response']['total'] > 0){
                    $followupPrimaryAssessmentData = $followupPrimaryAssessmentResponse['response']['primaryAssessmentData'];
                }
                
                $chiefComplaintsData = "";
                $chiefComplaintsResponse = $this->primaryAssessmentHandler->getAllChiefComplaintsDetails($timestamp);
                if($chiefComplaintsResponse['response']['total'] > 0){
                    $chiefComplaintsData = $chiefComplaintsResponse['response']['chiefComplaintsData'];
                }
                
                $chiefComplaintFollowupsData = "";
                $chiefComplaintFollowupsResponse = $this->primaryAssessmentHandler->getAllChiefComplaintFollowupsDetail($timestamp);
                if($chiefComplaintFollowupsResponse['response']['total'] > 0){
                    $chiefComplaintFollowupsData = $chiefComplaintFollowupsResponse['response']['chiefComplaintFollowupsData'];
                }
                
                $networkHospitalsData = "";
                $networkHospitalsResponse = $this->networkhospitalHandler->getNetworkHospitals($timestamp);
                if($networkHospitalsResponse['response']['total'] > 0){
                    $networkHospitalsData = $networkHospitalsResponse['response']['networkhospitalData'];
                }
                
                $languagesData = "";
                $languagesResponse = $this->languageHandler->getLanguageDetails($limit ="", $page = "", $timestamp);
                if($languagesResponse['response']['total'] > 0){
                    $languagesData = $languagesResponse['response']['languageData'];
                }
                
                $output['status'] = TRUE;
                $output['response']['primaryAssessmentData'] = $primaryAssessmentData;
                $output['response']['followupPrimaryAssessmentData'] = $followupPrimaryAssessmentData;
                $output['response']['chiefComplaintsData'] = $chiefComplaintsData;
                $output['response']['chiefComplaintFollowupsData'] = $chiefComplaintFollowupsData;
                $output['response']['networkHospitalsData'] = $networkHospitalsData;
                $output['response']['languagesData'] = $languagesData;
                $output['statuscode'] = STATUS_OK;
                $this->response($output, $output['statusCode']);
            }
            
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_TIMESTAMP;
            $output['response']['messages'][] = $this->lang->line('error_timestamp_not_found_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
            
        }         
        
    }
    
}
