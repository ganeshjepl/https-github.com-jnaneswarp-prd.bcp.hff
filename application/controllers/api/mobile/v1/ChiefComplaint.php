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
require_once (APPPATH . 'handlers/Medicalincident_handler.php');

class ChiefComplaint extends REST_Controller {

    var $primaryAssessmentHandler;

    public function __construct() {
        parent::__construct();
        $this->primaryAssessmentHandler = new Primary_assessment_handler();
        $this->medicalincident_handler = new Medicalincident_handler();
    }

    public function index_get() {

        $inputData['chiefComplaintId'] = $this->get('id');
        $responseArray = $this->primaryAssessmentHandler->getChiefComplaintDetail($inputData);

        $this->response($responseArray, $responseArray['statusCode']);
    }

    public function followup_get() {

        $inputData['chiefComplaintId'] = $this->get('id');
        $responseArray = $this->primaryAssessmentHandler->getChiefComplaintFollowupDetail($inputData);

        $this->response($responseArray, $responseArray['statusCode']);
    }
    
    public function index_post() {
        
        //print_r($_POST);  exit;       
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
                        
        $questions = array();
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == ROLE_BCP) { 
            
            if($this->post('chiefComplaintDetails') && !empty($this->post('chiefComplaintDetails'))){
                
                ///$medicalIncidentDetailsId = isset($this->post('chiefComplaintDetails')['medicalIncidentDetailsId']) ? $this->post('chiefComplaintDetails')['medicalIncidentDetailsId'] : ""; 
                $medicalIncidentId = isset($this->post('chiefComplaintDetails')['medicalIncidentId']) ? $this->post('chiefComplaintDetails')['medicalIncidentId'] : ""; 
                ///$medicalIncidentVisitId = isset($this->post('chiefComplaintDetails')['medicalIncidentVisitId']) ? $this->post('chiefComplaintDetails')['medicalIncidentVisitId'] : ""; 
                $registrationDate = isset($this->post('chiefComplaintDetails')['registrationDate']) ? $this->post('chiefComplaintDetails')['registrationDate'] : ""; 
                
                $survey = isset($this->post('chiefComplaintDetails')['survey']) ? $this->post('chiefComplaintDetails')['survey'] : "";                          
                               
                $chiefComplaintData = array(
                    ///"medicalIncidentDetailsId" => $medicalIncidentDetailsId,
                    "medicalIncidentId" => $medicalIncidentId,
                    ///"medicalIncidentVisitId" => $medicalIncidentVisitId,
                    "registrationDate" => $registrationDate,
                    "bcp_user_id" => $userId,
                    "survey" => $survey
                );
                ///print_r($chiefComplaintData);exit;

                $this->form_validation->set_data($chiefComplaintData);
                $this->form_validation->set_rules($this->config->item('createChiefComplaintRules'));

                if ($this->form_validation->run() == FALSE) {
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $this->form_validation->error_array();
                    $statusCode = STATUS_BAD_REQUEST;
                    $output['statusCode'] = $statusCode;
                    $this->response($output, $statusCode);
                } else {
                    $responseArray = $this->medicalincident_handler->createChiefComplaint($chiefComplaintData);
                    $this->response($responseArray, $responseArray['statusCode']);
                }
             
            }
            else{
                $output['status'] = FALSE;
                ///$output['response']['messages'] = ERROR_INVALID_DATA;
                $output['response']['messages'][] = $this->lang->line('error_invalid_data_message');
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }            
            
            
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    
    public function redflagChiefComplaint_post() {
        
        ///print_r($_POST);  exit;       
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
            
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == ROLE_BCP) { 
            
            if($this->post('chiefComplaintDetails') && !empty($this->post('chiefComplaintDetails'))){
                
                ///$medicalIncidentDetailsId = isset($this->post('chiefComplaintDetails')['medicalIncidentDetailsId']) ? $this->post('chiefComplaintDetails')['medicalIncidentDetailsId'] : ""; 
                $medicalIncidentId = isset($this->post('chiefComplaintDetails')['medicalIncidentId']) ? $this->post('chiefComplaintDetails')['medicalIncidentId'] : ""; 
                ///$medicalIncidentVisitId = isset($this->post('chiefComplaintDetails')['medicalIncidentVisitId']) ? $this->post('chiefComplaintDetails')['medicalIncidentVisitId'] : ""; 
                $registrationDate = isset($this->post('chiefComplaintDetails')['registrationDate']) ? $this->post('chiefComplaintDetails')['registrationDate'] : ""; 
                
                $survey = isset($this->post('chiefComplaintDetails')['survey']) ? $this->post('chiefComplaintDetails')['survey'] : "";                          
                             
                $hospitalId = isset($this->post('redflag')['hospitalId']) ? $this->post('redflag')['hospitalId'] : "";
                $redflagQuestionId = isset($this->post('redflag')['questionId']) ? $this->post('redflag')['questionId'] : "";
                $redflagOptionId = isset($this->post('redflag')['optionId']) ? $this->post('redflag')['optionId'] : "";
                
                $chiefComplaintData = array(
                    ///"medicalIncidentDetailsId" => $medicalIncidentDetailsId,
                    "medicalIncidentId" => $medicalIncidentId,
                    ///"medicalIncidentVisitId" => $medicalIncidentVisitId,
                    "registrationDate" => $registrationDate,
                    "bcp_user_id" => $userId,
                    "survey" => $survey,
                    "hospitalId" => $hospitalId,                        
                    "questionId" => $redflagQuestionId,                        
                    "optionId" => $redflagOptionId   
                );
                ///print_r($chiefComplaintData);exit;

                $this->form_validation->set_data($chiefComplaintData);
                $this->form_validation->set_rules($this->config->item('createRedflagChiefComplaintRules'));

                if ($this->form_validation->run() == FALSE) {
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $this->form_validation->error_array();
                    $statusCode = STATUS_BAD_REQUEST;
                    $output['statusCode'] = $statusCode;
                    $this->response($output, $statusCode);
                } else {
                    $responseArray = $this->medicalincident_handler->createChiefComplaint($chiefComplaintData);
                    $this->response($responseArray, $responseArray['statusCode']);
                }
             
            }
            else{
                $output['status'] = FALSE;
                ///$output['response']['messages'] = ERROR_INVALID_DATA;
                $output['response']['messages'][] = $this->lang->line('error_invalid_data_message');
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }            
            
            
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    
    public function prescriptionRequest_post() {
                       
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        
        if ($userrole == ROLE_BCP) { 
            
            $inputData = array(
                'medicalIncidentId' => $this->post('medicalIncidentId'),
                'medicalIncidentVisitId' => $this->post('medicalIncidentVisitId'),
                'questionId' => $this->post('questionId'),
                'optionId' => $this->post('optionId'),
                'bcpId' => $userId
            );
              
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('sendPrescriptionRules'));

            if ($this->form_validation->run() == FALSE) {
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            
            $responseArray = $this->medicalincident_handler->prescriptionRequest($inputData);
            $this->response($responseArray, $responseArray['statusCode']);       
            
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    
    
    public function diagnoses_post() {
        
        //print_r($_POST);  exit;       
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
                        
        $questions = array();
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == ROLE_BCP) { 
            
            if($this->post('chiefComplaintDetails') && !empty($this->post('chiefComplaintDetails'))){
                
                $medicalIncidentDetailsId = isset($this->post('chiefComplaintDetails')['medicalIncidentDetailsId']) ? $this->post('chiefComplaintDetails')['medicalIncidentDetailsId'] : ""; 
                //$medicalIncidentId = isset($this->post('chiefComplaintDetails')['medicalIncidentId']) ? $this->post('chiefComplaintDetails')['medicalIncidentId'] : ""; 
                //$medicalIncidentVisitId = isset($this->post('chiefComplaintDetails')['medicalIncidentVisitId']) ? $this->post('chiefComplaintDetails')['medicalIncidentVisitId'] : ""; 
                $registrationDate = isset($this->post('chiefComplaintDetails')['registrationDate']) ? $this->post('chiefComplaintDetails')['registrationDate'] : ""; 
                
                $survey = isset($this->post('chiefComplaintDetails')['survey']) ? $this->post('chiefComplaintDetails')['survey'] : "";                          
                               
                $chiefComplaintData = array(
                    "medicalIncidentDetailsId" => $medicalIncidentDetailsId,
                    //"medicalIncidentId" => $medicalIncidentId,
                    //"medicalIncidentVisitId" => $medicalIncidentVisitId,
                    "registrationDate" => $registrationDate,
                    "bcp_user_id" => $userId,
                    "survey" => $survey
                );
                ///print_r($chiefComplaintData);exit;

                $this->form_validation->set_data($chiefComplaintData);
                $this->form_validation->set_rules($this->config->item('saveChiefComplaintDiagnosesRules'));

                if ($this->form_validation->run() == FALSE) {
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $this->form_validation->error_array();
                    $statusCode = STATUS_BAD_REQUEST;
                    $output['statusCode'] = $statusCode;
                    $this->response($output, $statusCode);
                } else {
                    $responseArray = $this->medicalincident_handler->saveChiefComplaintDiagnoses($chiefComplaintData);
                    $this->response($responseArray, $responseArray['statusCode']);
                }
             
            }
            else{
                $output['status'] = FALSE;
                ///$output['response']['messages'] = ERROR_INVALID_DATA;
                $output['response']['messages'][] = $this->lang->line('error_invalid_data_message');
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }            
            
            
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    
    public function redflagdiagnoses_post() {
        
        //print_r($_POST);  exit;       
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
                        
        $questions = array();
                        
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == ROLE_BCP) { 
            
            if($this->post('chiefComplaintDetails') && !empty($this->post('chiefComplaintDetails'))){
                
                $medicalIncidentDetailsId = isset($this->post('chiefComplaintDetails')['medicalIncidentDetailsId']) ? $this->post('chiefComplaintDetails')['medicalIncidentDetailsId'] : ""; 
                //$medicalIncidentId = isset($this->post('chiefComplaintDetails')['medicalIncidentId']) ? $this->post('chiefComplaintDetails')['medicalIncidentId'] : ""; 
                //$medicalIncidentVisitId = isset($this->post('chiefComplaintDetails')['medicalIncidentVisitId']) ? $this->post('chiefComplaintDetails')['medicalIncidentVisitId'] : ""; 
                $registrationDate = isset($this->post('chiefComplaintDetails')['registrationDate']) ? $this->post('chiefComplaintDetails')['registrationDate'] : ""; 
                
                $survey = isset($this->post('chiefComplaintDetails')['survey']) ? $this->post('chiefComplaintDetails')['survey'] : "";                          
                                
                $hospitalId = isset($this->post('redflag')['hospitalId']) ? $this->post('redflag')['hospitalId'] : "";
                $redflagQuestionId = isset($this->post('redflag')['questionId']) ? $this->post('redflag')['questionId'] : "";
                $redflagOptionId = isset($this->post('redflag')['optionId']) ? $this->post('redflag')['optionId'] : ""; 
                
                $chiefComplaintData = array(
                    "medicalIncidentDetailsId" => $medicalIncidentDetailsId,
                    //"medicalIncidentId" => $medicalIncidentId,
                    //"medicalIncidentVisitId" => $medicalIncidentVisitId,
                    "registrationDate" => $registrationDate,
                    "bcp_user_id" => $userId,
                    "survey" => $survey,
                    "hospitalId" => $hospitalId,                        
                    "questionId" => $redflagQuestionId,                        
                    "optionId" => $redflagOptionId    
                );
                ///print_r($chiefComplaintData);exit;

                $this->form_validation->set_data($chiefComplaintData);
                $this->form_validation->set_rules($this->config->item('saveRedflagChiefComplaintDiagnosesRules'));

                if ($this->form_validation->run() == FALSE) {
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $this->form_validation->error_array();
                    $statusCode = STATUS_BAD_REQUEST;
                    $output['statusCode'] = $statusCode;
                    $this->response($output, $statusCode);
                } else {
                    $responseArray = $this->medicalincident_handler->saveChiefComplaintDiagnoses($chiefComplaintData);
                    $this->response($responseArray, $responseArray['statusCode']);
                }
             
            }
            else{
                $output['status'] = FALSE;
                ///$output['response']['messages'] = ERROR_INVALID_DATA;
                $output['response']['messages'][] = $this->lang->line('error_invalid_data_message');
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }            
            
            
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    
    public function createFollowup_post() {
        
        //print_r($_POST);  exit;       
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
                        
        $questions = array();        
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == ROLE_BCP) { 
            
            if($this->post('chiefComplaintDetails') && !empty($this->post('chiefComplaintDetails'))){
                
                $medicalIncidentDetailsId = isset($this->post('chiefComplaintDetails')['medicalIncidentDetailsId']) ? $this->post('chiefComplaintDetails')['medicalIncidentDetailsId'] : ""; 
                //$medicalIncidentId = isset($this->post('chiefComplaintDetails')['medicalIncidentId']) ? $this->post('chiefComplaintDetails')['medicalIncidentId'] : ""; 
                ///$medicalIncidentVisitId = isset($this->post('chiefComplaintDetails')['medicalIncidentVisitId']) ? $this->post('chiefComplaintDetails')['medicalIncidentVisitId'] : ""; 
                $registrationDate = isset($this->post('chiefComplaintDetails')['registrationDate']) ? $this->post('chiefComplaintDetails')['registrationDate'] : ""; 
                
                $survey = isset($this->post('chiefComplaintDetails')['survey']) ? $this->post('chiefComplaintDetails')['survey'] : "";                          
                
                $chiefComplaintData = array(
                    "medicalIncidentDetailsId" => $medicalIncidentDetailsId,
                    //"medicalIncidentId" => $medicalIncidentId,
                    //"medicalIncidentVisitId" => $medicalIncidentVisitId,
                    "registrationDate" => $registrationDate,
                    "bcp_user_id" => $userId,
                    "survey" => $survey
                );
                ///print_r($chiefComplaintData);exit;

                $this->form_validation->set_data($chiefComplaintData);
                $this->form_validation->set_rules($this->config->item('createFollowupRules'));

                if ($this->form_validation->run() == FALSE) {
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $this->form_validation->error_array();
                    $statusCode = STATUS_BAD_REQUEST;
                    $output['statusCode'] = $statusCode;
                    $this->response($output, $statusCode);
                } else {
                    $responseArray = $this->medicalincident_handler->createFollowup($chiefComplaintData);
                    $this->response($responseArray, $responseArray['statusCode']);
                }
             
            }
            else{
                $output['status'] = FALSE;
                ///$output['response']['messages'] = ERROR_INVALID_DATA;
                $output['response']['messages'][] = $this->lang->line('error_invalid_data_message');
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            } 
            
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    
    public function createRedflagFollowup_post() {
        
        //print_r($_POST);  exit;       
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
                        
        $questions = array();
                
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == ROLE_BCP) { 
            
            if($this->post('chiefComplaintDetails') && !empty($this->post('chiefComplaintDetails'))){
                
                $medicalIncidentDetailsId = isset($this->post('chiefComplaintDetails')['medicalIncidentDetailsId']) ? $this->post('chiefComplaintDetails')['medicalIncidentDetailsId'] : ""; 
                //$medicalIncidentId = isset($this->post('chiefComplaintDetails')['medicalIncidentId']) ? $this->post('chiefComplaintDetails')['medicalIncidentId'] : ""; 
                ///$medicalIncidentVisitId = isset($this->post('chiefComplaintDetails')['medicalIncidentVisitId']) ? $this->post('chiefComplaintDetails')['medicalIncidentVisitId'] : ""; 
                $registrationDate = isset($this->post('chiefComplaintDetails')['registrationDate']) ? $this->post('chiefComplaintDetails')['registrationDate'] : ""; 
                
                $survey = isset($this->post('chiefComplaintDetails')['survey']) ? $this->post('chiefComplaintDetails')['survey'] : "";                          
                                
                $hospitalId = isset($this->post('redflag')['hospitalId']) ? $this->post('redflag')['hospitalId'] : "";
                $redflagQuestionId = isset($this->post('redflag')['questionId']) ? $this->post('redflag')['questionId'] : "";
                $redflagOptionId = isset($this->post('redflag')['optionId']) ? $this->post('redflag')['optionId'] : "";   
                                               
                $chiefComplaintData = array(
                    "medicalIncidentDetailsId" => $medicalIncidentDetailsId,
                    //"medicalIncidentId" => $medicalIncidentId,
                    //"medicalIncidentVisitId" => $medicalIncidentVisitId,
                    "registrationDate" => $registrationDate,
                    "bcp_user_id" => $userId,
                    "survey" => $survey,
                    "hospitalId" => $hospitalId,                        
                    "questionId" => $redflagQuestionId,                        
                    "optionId" => $redflagOptionId   
                );
                ///print_r($chiefComplaintData);exit;

                $this->form_validation->set_data($chiefComplaintData);
                $this->form_validation->set_rules($this->config->item('createRedflagFollowupRules'));

                if ($this->form_validation->run() == FALSE) {
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $this->form_validation->error_array();
                    $statusCode = STATUS_BAD_REQUEST;
                    $output['statusCode'] = $statusCode;
                    $this->response($output, $statusCode);
                } else {
                    $responseArray = $this->medicalincident_handler->createFollowup($chiefComplaintData);
                    $this->response($responseArray, $responseArray['statusCode']);
                }
             
            }
            else{
                $output['status'] = FALSE;
                ///$output['response']['messages'] = ERROR_INVALID_DATA;
                $output['response']['messages'][] = $this->lang->line('error_invalid_data_message');
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            } 
            
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    
    
    public function sendPatientVisitReminder_post() {
        
        $responseArray = $this->medicalincident_handler->sendPatientVisitReminder();
        $this->response($responseArray, $responseArray['statusCode']); 
         
        /*
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        
        if ($userrole == ROLE_BCP) { 
                                    
            $responseArray = $this->medicalincident_handler->sendPatientVisitReminder();
            $this->response($responseArray, $responseArray['statusCode']);       
            
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
         
         */
    }
    
    public function patientVisitReminders_get() {
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        
        if ($userrole == ROLE_BCP) { 
                                    
            $responseArray = $this->medicalincident_handler->getPatientVisitReminders($userId);
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
