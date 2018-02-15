<?php

/* Patient  entity related logic definition
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
require_once (APPPATH . 'handlers/Patient_handler.php');

class Patient extends REST_Controller {

    var $patientHandler;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->patientHandler = new Patient_handler (); 
    }

    public function index_get() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'bcp') {
                        
            $patientId = "";
            $medicalRegistration = "";
            if($this->get('patientId')){
                $patientId = trim($this->get('patientId'));
            }       
            if($this->get('medicalRegistration')){
                $medicalRegistration = trim($this->get('medicalRegistration'));
            }

            $inputData = array(
                'patientId' => $patientId,
                'medicalRegistrationNumber' => $medicalRegistration
            );

            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('getPatientRules'));

            if (($patientId == '') && ($medicalRegistration == '')) {
                $output['response']['messages'] = ERROR_INVALID_INPUT;
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            if ($this->form_validation->run() == FALSE) {
                // print_r($this->form_validation->error_array());
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }

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

    public function patientRegistration_post() {
        ///print_r($_POST); exit;
        ///print_r($_FILES);  exit;
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {
                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'bcp') {
            
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
                "profilePicture" => "",
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
                //"sessionUserId" => $responseArray['response']['sessionData']['userid'],
                "bcp_user_id" => $responseArray['response']['sessionData']['userid']                
            );        
            
            //print_r($inputData); exit;
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('patientRegRules'));
           
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
                    $image['type'] = $_FILES['patientDetails']['type']['profilePicture'];  
                    $image['error'] = $_FILES['patientDetails']['error']['profilePicture'];  
                    
                    //echo $image['error'];
                    /*
                    if($image['error'] == 1){ 
                       log_message("error", $this->lang->line('error_upload_size_exceeds_upload_max_filesize_message'));   
                    }
                    else if($image['error'] == 2){ 
                       log_message("error", $this->lang->line('error_upload_size_exceeds_max_file_size_message'));   
                    }
                    else if($image['error'] == 3){ 
                       log_message("error", $this->lang->line('error_upload_partially_uploaded_message'));   
                    }  
                    else if($image['error'] == 6){ 
                       log_message("error", $this->lang->line('error_upload_no_temporary_folder_message'));   
                    }
                    else if($image['error'] == 7){ 
                       log_message("error", $this->lang->line('error_upload_cannot_write_message'));   
                    }
                    else if($image['error'] == 8){ 
                       log_message("error", $this->lang->line('error_upload_extension_message'));   
                    }
                    */
                    //exit;
                     
                    $response = uploadImage($image, $type ="profile");                    
                    ///print_r($response); exit;                    
                    if($response['status'] == 1){
                        $inputData['profilePicture'] = $response['response']['imagename'];
                    }else{
                        $this->response($response);
                    }                    
                }
                //exit;
                
                $responseArray = $this->patientHandler->patientRegistration($inputData);
                $this->response($responseArray, $responseArray['statusCode']);
            }
            
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }

    public function patientSearch_get() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'bcp') {
            $inputData = array(
                'firstName' => $this->get('firstName'),
                'village' => $this->get('village'),
                'emergencyContactNumber' => $this->get('emergencyContactNumber'),
                "bcpUserId" => $responseArray['response']['sessionData']['userid']  
            );
                        
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('patientSearchRules'));
              
            if ($this->form_validation->run() == FALSE) {
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            } else {                
                $responseArray = $this->patientHandler->patientSearch($inputData);
                $this->response($responseArray, $responseArray['statusCode']);
            }
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }

}
