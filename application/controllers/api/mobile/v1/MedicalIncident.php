<?php

/**
  Medical Incident           Controller
 * @package		   CodeIgniter
 * @author		   Atumit Development Team
 * @copyright	           Copyright (c) 2017, Atumit.
 * @Version		   Version 1.0
 * @Created                2-05-2017
 * @Last Modified          25-05-2017
 * @Last Modified By       Shiva jyothi   
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/Medicalincident_handler.php');
require_once (APPPATH . 'handlers/User_handler.php');

class MedicalIncident extends REST_Controller {

    var $medicalIncidentHandler;

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->medicalincident_handler = new Medicalincident_handler();
        $this->user_handler = new User_handler();
    }

    public function index_post() {
       
        //print_r($_POST);         
        ///print_r($_FILES); 
        ///exit;
               
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
                        
        $questions = array();
        $userId = $responseArray['response']['sessionData']['userid'];
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'bcp') { 
            
            if($this->post('patientDetails') && !empty($this->post('patientDetails'))){
                                
                $medicalRegistrationNumber = isset($this->post('patientDetails')['medicalRegistrationNumber']) ? $this->post('patientDetails')['medicalRegistrationNumber'] : ""; 
                $questions = isset($this->post('primaryAssessment')['questions']) ? $this->post('primaryAssessment')['questions'] : "";                          
                $chiefComplaintSymptoms = isset($this->post('primaryAssessment')['chiefComplaintSymptoms']) ? $this->post('primaryAssessment')['chiefComplaintSymptoms'] : "";
                $type = isset($this->post('patientDetails')['type']) ? $this->post('patientDetails')['type'] : "";
                                
                if (isset($medicalRegistrationNumber) && ($medicalRegistrationNumber != '')) {
                    
                    $medicalIncidentDetailsId = isset($this->post('patientDetails')['medicalIncidentDetailsId']) ? $this->post('patientDetails')['medicalIncidentDetailsId'] : "";
                
                    $mediacalIncidentData = array(
                        "medicalRegistrationNumber" => $medicalRegistrationNumber,
                        "type" => $type, 
                        "medicalIncidentDetailsId" => $medicalIncidentDetailsId,
                        "registrationDate" => $this->post('patientDetails')['registrationDate'],
                        "bcp_user_id" => $userId,
                        "surveyId" => $this->post('patientDetails')['surveyId'],
                        "questions" => $questions,
                        "chiefComplaintSymptoms" => $chiefComplaintSymptoms
                    );
                    ///print_r($mediacalIncidentData);exit;
                     
                    $this->form_validation->set_data($mediacalIncidentData);
                    $this->form_validation->set_rules($this->config->item('createMedicalIncidentRules'));

                    if ($this->form_validation->run() == FALSE) {
                        $output['status'] = FALSE;
                        $output['response']['messages'] = $this->form_validation->error_array();
                        $statusCode = STATUS_BAD_REQUEST;
                        $output['statusCode'] = $statusCode;
                        $this->response($output, $statusCode);
                    } else {                        
                        $responseArray = $this->medicalincident_handler->createMedicalIncident($mediacalIncidentData);                        
                        $this->response($responseArray, $responseArray['statusCode']);
                    }
                } 
                else {
                                      
                    $contactNumber = "";
                    if( $this->post('patientDetails')['contactNumber'] && $this->post('patientDetails')['contactNumber'] !="undefined" ){
                        $contactNumber = $this->post('patientDetails')['contactNumber'];
                    }
                    
                    $alternateContactNumber = "";
                    if( $this->post('patientDetails')['alternateContactNumber'] && $this->post('patientDetails')['alternateContactNumber'] !="undefined" ){
                        $alternateContactNumber = $this->post('patientDetails')['alternateContactNumber'];
                    }
                    
                    $emergencyContactNumber = "";
                    if( $this->post('patientDetails')['emergencyContactNumber'] && $this->post('patientDetails')['emergencyContactNumber'] !="undefined" ){
                        $emergencyContactNumber = $this->post('patientDetails')['emergencyContactNumber'];
                    }
                    
                    $inputData = array(
                        'title' => isset($this->post('patientDetails')['title']) ? $this->post('patientDetails')['title'] : "",
                        'firstName' => isset($this->post('patientDetails')['firstName']) ? $this->post('patientDetails')['firstName'] : "",
                        'middleName' => isset($this->post('patientDetails')['middleName']) ? $this->post('patientDetails')['middleName'] : "",
                        'lastName' => isset($this->post('patientDetails')['lastName']) ? $this->post('patientDetails')['lastName'] : "",
                        'registrationDate' => isset($this->post('patientDetails')['registrationDate']) ? $this->post('patientDetails')['registrationDate'] : "",
                        'age' => isset($this->post('patientDetails')['age']) ? $this->post('patientDetails')['age'] : "",
                        'dateofBirth' => isset($this->post('patientDetails')['dateofBirth']) ? $this->post('patientDetails')['dateofBirth'] : "",
                        'gender' => isset($this->post('patientDetails')['gender']) ? $this->post('patientDetails')['gender'] : "",
                        'guardianName' => isset($this->post('patientDetails')['guardianName']) ? $this->post('patientDetails')['guardianName'] : "",
                        'guardianRelation' => isset($this->post('patientDetails')['guardianRelation']) ? $this->post('patientDetails')['guardianRelation'] : "",
                        'caste' => isset($this->post('patientDetails')['caste']) ? $this->post('patientDetails')['caste'] : "",
                        'religion' => isset($this->post('patientDetails')['religion']) ? $this->post('patientDetails')['religion'] : "",
                        'maritalStatus' => isset($this->post('patientDetails')['maritalStatus']) ? $this->post('patientDetails')['maritalStatus'] : "",
                        'occupation' => isset($this->post('patientDetails')['occupation']) ? $this->post('patientDetails')['occupation'] : "",
                        'education' => isset($this->post('patientDetails')['education']) ? $this->post('patientDetails')['education'] : "",
                        'contactNumber' => $contactNumber,
                        'alternateContactNumber' => $alternateContactNumber,
                        'emergencyContactName' => isset($this->post('patientDetails')['emergencyContactName']) ? $this->post('patientDetails')['emergencyContactName'] : "",
                        'emergencyContactRelation' => isset($this->post('patientDetails')['emergencyContactRelation']) ? $this->post('patientDetails')['emergencyContactRelation'] : "",
                        'emergencyContactNumber' => $emergencyContactNumber,
                        ///'address' => isset($this->post('patientDetails')['address']) ? $this->post('patientDetails')['address'] : "",
                        'houseNo' => isset($this->post('patientDetails')['houseNo']) ? $this->post('patientDetails')['houseNo'] : "",
                        'block' => isset($this->post('patientDetails')['block']) ? $this->post('patientDetails')['block'] : "",
                        'streetName' => isset($this->post('patientDetails')['streetName']) ? $this->post('patientDetails')['streetName'] : "",
                        'area' => isset($this->post('patientDetails')['area']) ? $this->post('patientDetails')['area'] : "",
                        'countryId' => isset($this->post('patientDetails')['countryId']) ? $this->post('patientDetails')['countryId'] : "",
                        'stateId' => isset($this->post('patientDetails')['stateId']) ? $this->post('patientDetails')['stateId'] : "",
                        ///'districtId' => isset($this->post('patientDetails')['districtId']) ? $this->post('patientDetails')['districtId'] : "",
                        ///'mandalId' => isset($this->post('patientDetails')['mandalId']) ? $this->post('patientDetails')['mandalId'] : "",
                        'cityId' => isset($this->post('patientDetails')['cityId']) ? $this->post('patientDetails')['cityId'] : "",
                        'villageName' => isset($this->post('patientDetails')['villageName']) ? $this->post('patientDetails')['villageName'] : "",
                        'pincode' => isset($this->post('patientDetails')['pincode']) ? $this->post('patientDetails')['pincode'] : "",
                        'idProofType' => isset($this->post('patientDetails')['idProofType']) ? $this->post('patientDetails')['idProofType'] : "",
                        'idProofNo' => isset($this->post('patientDetails')['idProofNo']) ? $this->post('patientDetails')['idProofNo'] : "",
                        'bcp_user_id' => $responseArray['response']['sessionData']['userid'],
                        "surveyId" => isset($this->post('patientDetails')['surveyId']) ? $this->post('patientDetails')['surveyId'] : "",
                        "medicalRegistrationNumber" => $medicalRegistrationNumber,
                        "profilePicture" => "",
                        'questions' => $questions,
                        "chiefComplaintSymptoms" => $chiefComplaintSymptoms, 
                        "type" => $type
                    );

                    $this->form_validation->set_data($inputData);                    
                    $this->form_validation->set_rules($this->config->item('CreateMedicalIncidentWithPatientRegRules'));
                    if ($this->form_validation->run() == FALSE) {
                        $output['status'] = FALSE;
                        $output['response']['messages'] = $this->form_validation->error_array();
                        $statusCode = STATUS_BAD_REQUEST;
                        $output['statusCode'] = $statusCode;
                        $this->response($output, $statusCode);
                    } else {
                      
                        if (isset($_FILES['patientDetails']['name']['profilePicture']) && !empty($_FILES['patientDetails']['name']['profilePicture'])) {
                            $image['name'] = $_FILES['patientDetails']['name']['profilePicture'];
                            $image['tmp_name'] = $_FILES['patientDetails']['tmp_name']['profilePicture'];
                            $image['size'] = $_FILES['patientDetails']['size']['profilePicture'];                    
                            $response = uploadImage($image, $type="profile");
                            if($response['status'] == 1){
                                $inputData['profilePicture'] = $response['response']['imagename'];
                            }else{
                                $this->response($response);
                            }                    
                        }
                
                        $responseArray = $this->medicalincident_handler->patientRegistration($inputData);
                        $this->response($responseArray, $responseArray['statusCode']);
                    }
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
    
    public function redflagIncident_post() {
       
        //print_r($_POST); exit; 
               
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
            
            if($this->post('patientDetails') && !empty($this->post('patientDetails'))){
                                
                $medicalRegistrationNumber = isset($this->post('patientDetails')['medicalRegistrationNumber']) ? $this->post('patientDetails')['medicalRegistrationNumber'] : ""; 
                $questions = isset($this->post('primaryAssessment')['questions']) ? $this->post('primaryAssessment')['questions'] : "";                          
                $type = isset($this->post('patientDetails')['type']) ? $this->post('patientDetails')['type'] : "";
                                
                $hospitalId = isset($this->post('redflag')['hospitalId']) ? $this->post('redflag')['hospitalId'] : "";
                $redflagQuestionId = isset($this->post('redflag')['questionId']) ? $this->post('redflag')['questionId'] : "";
                $redflagOptionId = isset($this->post('redflag')['optionId']) ? $this->post('redflag')['optionId'] : "";
                
                if (isset($medicalRegistrationNumber) && ($medicalRegistrationNumber != '')) {
                    
                    //$medicalIncidentDetailsId = isset($this->post('patientDetails')['medicalIncidentDetailsId']) ? $this->post('patientDetails')['medicalIncidentDetailsId'] : "";
                
                    $mediacalIncidentData = array(
                        "medicalRegistrationNumber" => $medicalRegistrationNumber,
                        "type" => $type, 
                        //"medicalIncidentDetailsId" => $medicalIncidentDetailsId,
                        "registrationDate" => $this->post('patientDetails')['registrationDate'],
                        "bcp_user_id" => $userId,
                        "surveyId" => $this->post('patientDetails')['surveyId'],
                        "questions" => $questions,                   
                        "hospitalId" => $hospitalId,                        
                        "questionId" => $redflagQuestionId,                        
                        "optionId" => $redflagOptionId                        
                    );
                    ///print_r($mediacalIncidentData);exit;
                     
                    $this->form_validation->set_data($mediacalIncidentData);
                    $this->form_validation->set_rules($this->config->item('createRedflagMedicalIncidentRules'));

                    if ($this->form_validation->run() == FALSE) {
                        $output['status'] = FALSE;
                        $output['response']['messages'] = $this->form_validation->error_array();
                        $statusCode = STATUS_BAD_REQUEST;
                        $output['statusCode'] = $statusCode;
                        $this->response($output, $statusCode);
                    } else {                        
                        $responseArray = $this->medicalincident_handler->createMedicalIncident($mediacalIncidentData);                        
                        $this->response($responseArray, $responseArray['statusCode']);
                    }
                } 
                else {                    
                    
                    $emergencyContactNumber = "";
                    if( $this->post('patientDetails')['emergencyContactNumber'] && $this->post('patientDetails')['emergencyContactNumber'] !="undefined" ){
                        $emergencyContactNumber = $this->post('patientDetails')['emergencyContactNumber'];
                    }
                     
                    $inputData = array(
                        'firstName' => isset($this->post('patientDetails')['firstName']) ? $this->post('patientDetails')['firstName'] : "",
                        'registrationDate' => isset($this->post('patientDetails')['registrationDate']) ? $this->post('patientDetails')['registrationDate'] : "",
                        'emergencyContactName' => isset($this->post('patientDetails')['emergencyContactName']) ? $this->post('patientDetails')['emergencyContactName'] : "",
                        'emergencyContactNumber' => $emergencyContactNumber,
                        'villageName' => isset($this->post('patientDetails')['villageName']) ? $this->post('patientDetails')['villageName'] : "",
                        'gender' => isset($this->post('patientDetails')['gender']) ? $this->post('patientDetails')['gender'] : "",
                        'bcp_user_id' => $responseArray['response']['sessionData']['userid'],
                        "surveyId" => isset($this->post('patientDetails')['surveyId']) ? $this->post('patientDetails')['surveyId'] : "",
                        'questions' => $questions,
                        "type" => $type,
                        "hospitalId" => $hospitalId,                        
                        "questionId" => $redflagQuestionId,                        
                        "optionId" => $redflagOptionId,   
                    );
                   //print_r($inputData); exit;
                    
                    $this->form_validation->set_data($inputData);                    
                    $this->form_validation->set_rules($this->config->item('CreateRedflagMedicalIncidentWithPatientRegRules'));
                    
                    if ($this->form_validation->run() == FALSE) {
                        $output['status'] = FALSE;
                        $output['response']['messages'] = $this->form_validation->error_array();
                        $statusCode = STATUS_BAD_REQUEST;
                        $output['statusCode'] = $statusCode;
                        $this->response($output, $statusCode);
                    } else {
                        $responseArray = $this->medicalincident_handler->quickPatientRegistration($inputData);
                        $this->response($responseArray, $responseArray['statusCode']);
                    }
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
    
    
    public function index_get() {

        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'bcp' || $userrole == 'doctor') {
            $inputData = array(
                'limit' => $this->get('limit'),
                'page' => $this->get('page')
            );
            //$this->form_validation->set_data($inputData);
            //$this->form_validation->set_rules('limit', 'Limit', 'trim|numericCheck');
            //$this->form_validation->set_rules('page', 'Page', 'trim|numericCheck');
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('getMedicalIncidentRules'));

            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            
            $responseArray = $this->medicalincident_handler->getMedicalIncidents($inputData['limit'], $inputData['page']);
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
    
    public function medicalIncidentsOfPatient_get() {

        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        //if ($userrole == 'bcp' || $userrole == 'doctor') {
        if ($userrole == 'bcp') {
            $inputData = array(
                'medicalRegistrationCode' => $this->get('id'),
                'limit' => $this->get('limit'),
                'page' => $this->get('page')
            );
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('getMedicalIncidentOfPatientRules'));

            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            
            $responseArray = $this->medicalincident_handler->getMedicalIncidentsOfPatient($inputData['medicalRegistrationCode'], $inputData['limit'], $inputData['page']);
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
    
    
    public function searchMedicalIncidentsOfPatient_post() {

        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
       
        //if ($userrole == 'bcp' || $userrole == 'doctor') {
        if ($userrole == 'bcp') {
            //print_r($this->post('medicalRegistrationCode')); exit;
            
            if($this->post('medicalRegistrationCode') && !empty($this->post('medicalRegistrationCode'))){
               
                $medicalRegistrationCode = $this->post('medicalRegistrationCode'); 
                
                $inputData = array(
                    'medicalRegistrationCode' => $medicalRegistrationCode
                );                
                $this->form_validation->set_data($inputData);
                $this->form_validation->set_rules($this->config->item('getMedicalIncidentOfPatientByMRCodeRules'));                 
            }
            else{ 
                $name = "";
                $village = "";
                $emergencyContactNumber = "";
                if($this->post('name')){
                   $name = $this->post('name'); 
                }
                if($this->post('village')){
                   $village = $this->post('village'); 
                }
                if($this->post('emergencyContactNumber')){
                   $emergencyContactNumber = $this->post('emergencyContactNumber'); 
                }
                
                $inputData = array(
                    'firstName' => $name,
                    'village' => $village,
                    'emergencyContactNumber' => $emergencyContactNumber,
                    "bcpUserId" => $responseArray['response']['sessionData']['userid']  
                );
                
                $this->form_validation->set_data($inputData);
                $this->form_validation->set_rules($this->config->item('getMedicalIncidentOfPatientByNameRules'));
            }
            
            //$this->form_validation->set_data($inputData);
            //$this->form_validation->set_rules($this->config->item('getMedicalIncidentOfPatientByMRCodeRules'));
            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
           
            $responseArray = $this->medicalincident_handler->searchMedicalIncidentsOfPatient($inputData);            
            $this->response($responseArray, $responseArray['statusCode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        } 
    }
    
    
    public function medicalIncidentVisits_get() {
        
        ///print_r($this->get());   exit;
        
       $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
                 
        ///////////////////
        //$userrole = "doctor";
        //setSampleUserData();
        ///////////////////             
        
        if ($userrole == 'bcp' || $userrole == 'doctor') {
            //$inputData = array('medicalIncident' => $this->get('medicalIncident'));            
            $inputData = array('medicalIncident' => $this->get('id')); 
            
            
            $inputData['records'] = $this->get('limit');
            
            if(empty($inputData['records'])){
                $inputData['records'] = $this->config->item('pagination_default');
            }
            if($inputData['records'] > $this->config->item('pagination_max')){
                $inputData['records'] = $this->config->item('pagination_max');
            }
            if($this->get('page') <= 1){
                $inputData['offset']    =   0;
            }else{
                $inputData['offset']    =   ($this->get('page')-1)*$inputData['records'];
            }
            $inputData['search']  = $this->get('search');  
            
            
            ///$this->form_validation->set_data($inputData);
            ///$this->form_validation->set_rules('medicalIncident', 'Medical Incident', 'trim|required');
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('getMedicalIncidentVisitsRules'));
            
            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            
            $responseArray = $this->medicalincident_handler->getMedicalIncidentVisits($inputData);
            $this->response($responseArray, $responseArray['statusCode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function medicalIncidentVisitDetails_get() {
        
       $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
            
        $userrole = $responseArray['response']['sessionData']['userrole'];
        
        
        ///////////////////
        ///$userrole = "doctor";
        ///setSampleUserData();
        ///////////////////  
        
        if ($userrole == 'bcp' || $userrole == 'doctor') {
            //$inputData = array('medicalIncident' => $this->get('medicalIncident'));            
            $inputData['patient_id'] = $this->get('pid'); 
            $inputData['visit_id'] = $this->get('vid'); 
            
//            debugArray($inputData); exit;
             $inputData['records'] = $this->get('limit');
            
            if(empty($inputData['records'])){
                $inputData['records'] = $this->config->item('pagination_default');
            }
            if($inputData['records'] > $this->config->item('pagination_max')){
                $inputData['records'] = $this->config->item('pagination_max');
            }
            if($this->get('page') <= 1){
                $inputData['offset']    =   0;
            }else{
                $inputData['offset']    =   ($this->get('page')-1)*$inputData['records'];
            }
            ///$this->form_validation->set_data($inputData);
            ///$this->form_validation->set_rules('medicalIncident', 'Medical Incident', 'trim|required');
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('getMedicalIncidentVisitsRules'));
            
            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            
            $responseArray = $this->medicalincident_handler->getMedicalIncidentVisitDetails($inputData);
            $this->response($responseArray, $responseArray['statusCode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    

    public function medicalIncidentSurvey_get() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'bcp' || $userrole == 'doctor') {
            ///$inputData = array('medicalIncidentVisit' => $this->get('medicalIncidentVisit'));
            $inputData = array('medicalIncidentVisit' => $this->get('id'));
                        
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('getMedicalIncidentSurveyRules'));
            
            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            
            $responseArray = $this->medicalincident_handler->getMedicalIncidentSurvey($inputData['medicalIncidentVisit']);
            $this->response($responseArray, $responseArray['statusCode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
       
    
    public function medicalIncidentIdsByCode_Get(){
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'bcp') {            
            $inputData = array('id' => $this->get('id'));
                        
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('getMedicalIncidentIdsRules'));
            
            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }           
            $responseArray = $this->medicalincident_handler->getMedicalIncidentIdsByCode($inputData['id']);
            $this->response($responseArray, $responseArray['statusCode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
        
    }
    
    public function getSurveyIdByParentId_get() {

        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == ROLE_BCP) {
            
            $inputData['id'] = $this->get('id');
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('surveyIdRules'));  
            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            
            $surveyId = $this->get('id');               
            $responseArray = $this->medicalincident_handler->getSurveyIdByParentId($surveyId);
            $this->response($responseArray, $responseArray['statusCode']);           
            
        } 
        else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        } 
    }
    
}

?>
