<?php

/* User  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/User_handler.php');
require_once (APPPATH . 'handlers/Patient_handler.php');
require_once (APPPATH . 'handlers/Doctor_handler.php');
require_once (APPPATH . 'handlers/Medicalincident_handler.php');

class Doctor extends REST_Controller {

    public $userHandler;
    public $role;
    public $userid;

    public function __construct() {
        
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->library('encryption');
        $this->encryption->initialize(array(
            'cipher' => 'aes-128',
            'mode' => 'ctr',
            'key' => '<a 16-character random string>')
        );
        $excludeArray   =   array('login');
        $bcp_links  =   array('prePrescriptionDetailsForResponse','bcpsavePrescription');
        if(!in_array(end($this->uri->segments),$excludeArray)){
            if(in_array($this->uri->segments,$bcp_links)){
                $responseArray = userLoginCheck('json',ROLE_BCP);
            }else{
                $responseArray = userLoginCheck('json',ROLE_DOCTOR);
            }
            $this->role = $responseArray['response']['sessionData']['userrole'];
            $this->userid = $responseArray['response']['sessionData']['userid'];
        }
        
        
    }

    public function login_post() {
        
        $this->userHandler = new User_handler();
        $inputData = array(
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'language' => $this->post('language'),
            'userrole' => ROLE_DOCTOR,
            'deviceId' => $this->post('deviceId'),
            'deviceToken' => $this->post('deviceToken'),
            'osType'   => $this->post('osType'),
            'osVersion'=> $this->post('osVersion'),
            'type'=> "mobile",
        );
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('doctorLoginRules'));

        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);            
        }
        
        // remove the below line after 
        //$password =$this->encryption->encrypt($inputData['password']);
        //$inputData['password'] = $this->encryption->decrypt($password);
        $responseArray = $this->userHandler->doctorLogin($inputData);
        $this->response($responseArray, $responseArray['statusCode']);
    }
    public function searchPatient_get() {
        
        if ($this->role == ROLE_DOCTOR) {
            
            $medicalRegistration = $this->get('medicalRegistration');
            $inputData = array(
                'patientId' => $patientId,
                'medicalRegistrationNumber' => $medicalRegistration
            );
                                   
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('getPatientRules'));
              
            if (($patientId == '') && ($medicalRegistration == '')) {
                $output['status'] = FALSE;
                $output['response']['messages'] = ERROR_INVALID_INPUT;
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            if ($this->form_validation->run() == FALSE) {
                // print_r($this->form_validation->error_array());
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            $this->patientHandler = new Patient_handler();
            $responseArray = $this->patientHandler->getPatientDetails($patientId, $medicalRegistration);
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function patients_get() {
        $this->patientHandler = new Patient_handler();
        $inputData = array(
            'limit' => $this->get('limit'),
            'page' => $this->get('page')
        );
        if ($this->role == ROLE_DOCTOR) {
            $responseArray = $this->patientHandler->getPatients($inputData['limit'], $inputData['page']);
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    //By vijay kumar basu on 15-Jul-2017
    public function prescriptionRequests_get() {
        $this->doctorHandler = new Doctor_handler();
        if ($this->role == ROLE_DOCTOR) {
            
             
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
            
            $responseArray = $this->doctorHandler->getPrescriptionRequests($inputData);
            
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    //By vijay kumar basu on 17-Jul-2017
    public function prePrescriptionDetails_get() {
        $this->userHandler = new User_handler();
        $this->doctorHandler = new Doctor_handler();
        if ($this->role == ROLE_DOCTOR) {
            
            $inputData['prescription_id'] = $this->get('id');
            $inputData['type'] = 0;
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('prescriptionSupportDataRules'));
            
            if ($this->form_validation->run() == FALSE) {
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);            
            }
            
            $responseArray    =   $this->doctorHandler->getPrePrescriptionDetails($inputData);
            

            
            
//            $responseArray = $this->doctorHandler->getPrescriptionRequests($inputData);
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function prePrescriptionDetailsForResponse_get() {
        $this->userHandler = new User_handler();
        $this->doctorHandler = new Doctor_handler();
        
        if ($this->role == ROLE_BCP) {
            
            $inputData['prescription_id'] = $this->get('id');
            $inputData['type'] = 1;
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('prescriptionSupportDataRules'));
            
            if ($this->form_validation->run() == FALSE) {
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);            
            }
             
            $responseArray    =   $this->doctorHandler->getPrePrescriptionDetails($inputData);
            

            
            
//            $responseArray = $this->doctorHandler->getPrescriptionRequests($inputData);
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function prePrescriptionDetailsForAdd_get() {
        
        $this->userHandler = new User_handler();
        $this->doctorHandler = new Doctor_handler();
        
        if ($this->role == ROLE_DOCTOR) {
            
            $inputData['prescription_id'] = $this->get('id');
            $inputData['type'] = 0;
          
            $responseArray    =   $this->doctorHandler->getPrePrescriptionDetailsForAdd($inputData);
            
            
            
            
//            $responseArray = $this->doctorHandler->getPrescriptionRequests($inputData);
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function doctorProfile_get() {
        $this->userHandler = new User_handler();
         
        $inputData = array(
            'id' => $this->get('id'),
        );
        
          
        
        if ($this->role == ROLE_DOCTOR) {
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('doctorProfileRules'));
            
            if ($this->form_validation->run() == FALSE) {
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = ERROR_NO_DOCTOR_PROFILE;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);            
            }
            
            $doctorProfile = $this->userHandler->getDoctorProfile($inputData['id']);
            
            
            $output['status'] = TRUE;
            $output["response"]["doctor_profile"] = $doctorProfile;
            $output['statusCode'] = STATUS_OK;
            $this->response($output, $output['statusCode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
        
    }
    public function updateDoctorProfile_post(){
        
        
        try
        {               
            $inputData = array(
                'firstName'     =>  $this->post('firstName'),
                'lastName'      =>  $this->post('lastName'),
                'email'         =>  $this->post('email'),
                'countryid'     =>  $this->post('countryid'),
                'stateid'       =>  $this->post('stateid'),
                'cityid'        =>  $this->post('cityid'),
                'pincode'       =>  $this->post('pincode'),
                'mobile'        =>  $this->post('mobile'),
                'date_of_birth' =>  $this->post('date_of_birth'),
                'gender'        =>  $this->post('gender'),
                'education'     =>  $this->post('highest_qualification'),
                'userId'        =>  $this->post('userId'),
            );

            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('doctorProfileUpdateRules'));
            
            if ($this->form_validation->run() == FALSE) {
                ///$ret    =   array('status' => FALSE, 'status_code' => STATUS_BAD_REQUEST);
                ///throw new Exception('Internal Server Error');
                
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);                
            }
                                    
            if (isset($_FILES['profilePicture']) && !empty($_FILES['profilePicture'])) {
                $image['name'] = $_FILES['profilePicture']['name'];
                $image['tmp_name'] = $_FILES['profilePicture']['tmp_name'];
                $image['size'] = $_FILES['profilePicture']['size'];                    
                $response = uploadImage($image, $type="profile");
                if($response['status'] == 1){
                    $inputData['profile_picture'] = $response['response']['imagename'];
                }else{
                    $this->response($response);
                }                    
            }
            
            if (isset($_FILES['signaturePicture']) && !empty($_FILES['signaturePicture'])) {
                $image['name'] = $_FILES['signaturePicture']['name'];
                $image['tmp_name'] = $_FILES['signaturePicture']['tmp_name'];
                $image['size'] = $_FILES['signaturePicture']['size'];                    
                $response = uploadImage($image, $type="signature");
                if($response['status'] == 1){
                    $inputData['signature_picture'] = $response['response']['imagename'];
                }else{
                    $this->response($response);
                }                    
            } 
            
            $this->doctorHandler = new Doctor_handler();             
            $responseArray = $this->doctorHandler->updateDoctorProfile($inputData);                        
            $this->response($responseArray, $responseArray['statusCode']);
        
        }
        catch (Exception $e)
        {            
            $output['status'] = $out['status'];
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = $out['status_code'];
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
    }
    
    public function savePrescription_post(){
        
        
        try
        {
            $this->doctorHandler = new Doctor_handler();
                
            
            $sessionUserId = $this->userid;
            $full_data  =   $this->post();
            foreach($full_data as $data){
                
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules($this->config->item('savingPrescriptionRules'));

                if ($this->form_validation->run() == FALSE) {
                    $ret    =   array('status' => FALSE,'status_code' => STATUS_BAD_REQUEST);
                    $output['status'] = $out['status'];
                    $output['response']['messages'] = $this->form_validation->error_array();
                    $statusCode = $out['status_code'];
                    $output['statusCode'] = $statusCode;
                    $this->response($output, $statusCode);

                }
                $inputData[] = array(
                'prescription_request_id'      =>  $data['prescription_request_id'],
                'visit_id'      =>  $data['visit_id'],
                'medicine_id'   =>  $data['medicine_id'],
                'medicine_name' =>  $data['medicine_name'],
//                'dosage'        =>  $data['dosage'],
                'quantity'      =>  $data['quantity'],
                'timing_ids'    =>  $data['timings_ids'],
                'days'          =>  $data['days'],
                'bcp_id'           =>  $data['bcp_id'],
                
                );
            }
            
            
            $responseArray = $this->doctorHandler->savePrescription($inputData);
            
            
            $this->response($responseArray, $responseArray['statusCode']);
        
        }
        catch (Exception $e)
        {
            
            
        }
    }
    public function addPrescription_post(){
        
        
        try
        {
            $this->doctorHandler = new Doctor_handler();
                
            
            
            $sessionUserId = $this->userid;
            
            $inputData['header_data']   =   $this->post('header_data');
            $inputData['data']   =   $this->post('data');
//            foreach($inputData as $data){
//                
//                $this->form_validation->set_data($data);
//                $this->form_validation->set_rules($this->config->item('savingPrescriptionRules'));
//
//                if ($this->form_validation->run() == FALSE) {
//                    $ret    =   array('status' => FALSE,'status_code' => STATUS_BAD_REQUEST);
//                    $output['status'] = $out['status'];
//                    $output['response']['messages'] = $this->form_validation->error_array();
//                    $statusCode = $out['status_code'];
//                    $output['statusCode'] = $statusCode;
//                    $this->response($output, $statusCode);
//
//                }
//                $inputData[] = array(
//                'prescription_request_id'      =>  $data['prescription_request_id'],
//                'visit_id'      =>  $data['visit_id'],
//                'medicine_id'   =>  $data['medicine_id'],
//                'medicine_name' =>  $data['medicine_name'],
////                'dosage'        =>  $data['dosage'],
//                'quantity'      =>  $data['quantity'],
//                'timing_ids'    =>  $data['timings_ids'],
//                'days'          =>  $data['days'],
//                'bcp'           =>  $data['bcp_id'],
//                
//                );
//            }
            
            
            
            
            $responseArray = $this->doctorHandler->addPrescription($inputData);
            
            $this->response($responseArray, $responseArray['statusCode']);
        
        }
        catch (Exception $e)
        {
            
            
        }
    }
    public function bcpsavePrescription_post(){
        
        
        try
        {
            $this->doctorHandler = new Doctor_handler();
            $sessionUserId = $this->userid;
            
            
            $inputData = $this->post();
            foreach($inputData as $data){
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules($this->config->item('bcpsavingPrescriptionRules'));
            }
             
            if ($this->form_validation->run() == FALSE) {
                $ret    =   array('status' => FALSE,'status_code' => STATUS_BAD_REQUEST);
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
                
            }
            
            $responseArray = $this->doctorHandler->bcpsavePrescription($inputData);
            
            
            $this->response($responseArray, $responseArray['statusCode']);
        
        }
        catch (Exception $e)
        {
            
            $output['status'] = $out['status'];
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = $out['status_code'];
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
    }
    public function getMedicineCatelog_get() {
        $this->doctorHandler = new Doctor_handler();
        $inputData = array(
            'search' => $this->get('search'),
            'exp_days'  =>  $this->config->item('medicine_expiry_days')
        );
        
        if ($this->role == ROLE_DOCTOR) {
//            $this->form_validation->set_data($inputData);
//            $this->form_validation->set_rules($this->config->item('doctorProfileRules'));
//            
//            if ($this->form_validation->run() == FALSE) {
//                $output['status'] = FALSE;
//                $output['response']['messages'] = $this->form_validation->error_array();
//                $statusCode = STATUS_BAD_REQUEST;
//                $output['statusCode'] = $statusCode;
//                $this->response($output, $statusCode);            
//            }
            
            $responseArray = $this->doctorHandler->getMedicineCatelog($inputData);
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function prescriptionResponce_get() {
        $this->doctorHandler = new Doctor_handler();
        
        
        if ($this->role == ROLE_BCP) {
            
            $pr_id = $this->get('pr_id');
            $inputData = array(
                'pr_id' => $pr_id,
            );
                                   
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('prescription_response'));
             
            
            echo 'here'; 
            exit;
            
            $responseArray = $this->doctorHandler->getPrescriptionRequests($inputData);
            
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            $output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function assignedBcpList_get() {
        
        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        $this->Bcpassignment_handler = new Bcpassignment_handler();
        
         
        if ($this->role == ROLE_DOCTOR) {
            
             
            $inputData['doc_id'] = $this->get('doc_id');
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
            
            $responseArray = $this->Bcpassignment_handler->getDoctorAssignedBcps($inputData);
            
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function assignedPatientsList_get() {
        $this->Medicalincident_handler = new Medicalincident_handler();
        
        if ($this->role == ROLE_DOCTOR) {
            $inputData['bcp_id'] = $this->get('bcp_id');
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
            
            $responseArray = $this->Medicalincident_handler->getPatientDetails('','',$inputData['bcp_id']);
            
            $this->response($responseArray, $responseArray['statuscode']);
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function doctorFeedback_post(){
        require_once (APPPATH . 'handlers/Doctorfeedback_handler.php');
        $this->doctorFeedbackHandler = new DoctorFeedback_handler();
                
            
            
            $userId = $this->userid;
            
            $inputData = $this->post();
            $inputData['user_id']   =   $userId;
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('doctorFeeebackRules'));
            
            if ($this->form_validation->run() == FALSE) {
                $ret    =   array('status' => FALSE,'status_code' => STATUS_BAD_REQUEST);
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            
            $responseArray = $this->doctorFeedbackHandler->saveDoctorFeedback($inputData);
            
            $this->response($responseArray, $responseArray['statusCode']);
        
         
    }
    
    
    
}
