<?php

/* User  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             16-08-2017
 * @Last Modified       16-08-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/Doctor_handler.php');
class Doctor extends REST_Controller {
     public $userHandler;
     public function __construct() {
        parent::__construct();
     }
      public function insertDoctor_post(){
        
        
        try
        {
            
            $responseArray = userLoginCheck();
            if ($responseArray['status'] != 1) {
                if ($responseArray['response']['total'] == 0) {

                    $this->response($responseArray, $responseArray['statusCode']);
                }
            }
            $this->doctorHandler = new Doctor_handler();
            $sessionUserId = $responseArray['response']['sessionData']['userid'];
            
            $mobile=$this->input->post('mobile');
            $bcpids=$this->input->post('bcp_id');
            $bcpid='';
            if($bcpids !==''){
            $bcpid = explode(',', $bcpids);
            }
                $inputData = array(
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'email' => $this->input->post('email'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'gender'   => $this->input->post('gender'), 
                    'signupdate' => $this->input->post('signupdate'),            
                    'countryid' => $this->input->post('countryid'),
                    'stateid' => $this->input->post('stateid'),
                    'cityid' => $this->input->post('cityid'),
                    'pincode' => $this->input->post('pincode'),
                    'mobile' => $mobile,
                    'alternate_contact_number'=>$this->input->post('alternate_contact_number'),
                    'language_id'=>$this->input->post('language_id'),
                    'bcp_id'=>$bcpid,
                    'role' => $this->input->post('role'),
                    'sessionUserId' => $sessionUserId
                );
                $this->form_validation->set_data($inputData);
                $this->form_validation->set_rules($this->config->item('DoctorRules'));
                 
                if ($this->form_validation->run() == FALSE) {
                    
                    
                    throw new  Exception('Internal Server Error');
                }
                      
                        if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture'])) {  
                            $profileresArray =  uploadImage($_FILES['profile_picture'], $type="profile");
                            if($profileresArray['status']==1){
                                $inputData['profilePicture']  =$profileresArray['response']['imagename']; 
                            }else{
                                $output['status'] = FALSE;
                                $output['response']['messages'] = $profileresArray['response']['messages'];
                                $output['statusCode'] =STATUS_BAD_REQUEST;
                                $this->response($output, $output['statusCode']);
                             }
                        }else{
                            $inputData['profilePicture']  ='';
                        }
                        
                        if (isset($_FILES['signimageUpload']) && !empty($_FILES['signimageUpload'])) {
                             $signresarray =  uploadImage($_FILES['signimageUpload'], $type="signature");
                             if($signresarray['status']==1){
                               $inputData['signaturePicture']  = $signresarray['response']['imagename'];
                             }else{
                                 $output['status'] = FALSE;
                                $output['response']['messages'] = $signresarray['response']['messages'];
                                $output['statusCode'] =STATUS_BAD_REQUEST;
                                $this->response($output, $output['statusCode']);
                             }
                        }else{
                            $inputData['signaturePicture']  ='';
                        }
                    $responseArray = $this->doctorHandler->insertDoctor($inputData);
                    
                    $this->response($responseArray, $responseArray['statusCode']);
               
        }
        catch (Exception $e)
        {
             
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->form_validation->error_array();
            $output['statusCode'] =STATUS_BAD_REQUEST;
            $this->response($output, $output['statusCode']);
        }
    }
       
    public function updateDoctor_post(){    
        try
        {
            $responseArray = userLoginCheck();
            if ($responseArray['status'] != 1) {
                if ($responseArray['response']['total'] == 0) {

                    $this->response($responseArray, $responseArray['statusCode']);
                }
            }
            $this->doctorHandler = new Doctor_handler();
            $sessionUserId = $responseArray['response']['sessionData']['userid'];
            $mobile=$this->input->post('mobile');
            $bcpids=$this->input->post('bcp_id');
            $bcpid='';
            if($bcpids !==''){
            $bcpid = explode(',', $bcpids);
            }

            $inputData = array(
                'id'=>$this->input->post('doctorid'),
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'gender'   => $this->input->post('gender'), 
                'countryid' => $this->input->post('countryid'),
                'stateid' => $this->input->post('stateid'),
                'cityid' => $this->input->post('cityid'),
                'pincode' => $this->input->post('pincode'),
                'mobile' => $mobile,
                'alternate_contact_number'=>$this->input->post('alternate_contact_number'),
                'language_id'=>$this->input->post('language_id'),
                'bcp_id'=>$bcpid,
                'role' => $this->input->post('role'),
                'sessionUserId' => $responseArray['response']['sessionData']['userid']
            );
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('DoctorEditRules'));
               
            if ($this->form_validation->run() == FALSE) {
              throw new  Exception('Internal Server Error');
            }
            
            if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture'])) {  
                if($_FILES['profile_picture']['error'] == 1)
                    throw new  Exception($this->lang->line('error_invalid_image_size_message'));
                
                $profileresArray =  uploadImage($_FILES['profile_picture'], $type="profile");
                if($profileresArray['status']==1){
                    $inputData['profile_picture']  =$profileresArray['response']['imagename']; 
                }else{
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $profileresArray['response']['messages'];
                    $output['statusCode'] =STATUS_BAD_REQUEST;
                    $this->response($output, $output['statusCode']);
                }
           }else{
               $inputData['profile_picture']  ='';
           }
                        
            if (isset($_FILES['signimageUpload']) && !empty($_FILES['signimageUpload'])) {
                 $signresarray =  uploadImage($_FILES['signimageUpload'], $type="signature");
                 if($signresarray['status']==1){
                   $inputData['signature_picture']  = $signresarray['response']['imagename'];
                 }else{
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $signresarray['response']['messages'];
                    $output['statusCode'] =STATUS_BAD_REQUEST;
                    $this->response($output, $output['statusCode']);
                 }
            }else{
                $inputData['signature_picture']  ='';
            }
                    $responseArray = $this->doctorHandler->updateDoctor($inputData);
                    
                    $this->response($responseArray, $responseArray['statusCode']);
        
        }   catch (Exception $e)
        {
            $output['status'] = FALSE;
            $message    =   $this->form_validation->error_array();
            if(!empty($message)){
                $output['response']['messages'] = $this->form_validation->error_array();
            }else{
                $output['response']['messages'] = $e->getMessage();
            }
            $output['statusCode'] =STATUS_BAD_REQUEST;
            $this->response($output, $output['statusCode']);
        }
    }
    public function checkUsername_get(){
        $responseArray = userLoginCheck();
            if ($responseArray['status'] != 1) {
                if ($responseArray['response']['total'] == 0) {

                    $this->response($responseArray, $responseArray['statusCode']);
                }
        }
        $username      =  $this->input->get("username");
        require_once (APPPATH . 'handlers/User_handler.php');
        $this->userHandler = new User_handler();
        $data=array('username'=>$username);
        $responsArray =  $this->userHandler->usernameExist($data);
        $this->response($responsArray, $responsArray['statusCode']);
         
    }
    public function deleteDoctor_post(){
        $responseArray = userLoginCheck();
            if ($responseArray['status'] != 1) {
                if ($responseArray['response']['total'] == 0) {

                    $this->response($responseArray, $responseArray['statusCode']);
                }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'admin') {
      
        $inputData['id'] =  $this->input->post('id');
        $this->doctorHandler = new Doctor_handler();
        $responsArray = $this->doctorHandler->deleteDoctor($inputData);
        $this->response($responsArray, $responsArray['statusCode']);
        }else {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    public function getDoctor_get($limit = 100, $page = 1) {
        $responseArray = userLoginCheck();
                   if ($responseArray['status'] != 1) {
                       if ($responseArray['response']['total'] == 0) {

                           $this->response($responseArray, $responseArray['statusCode']);
                       }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'admin') {
            $docId = $this->input->get('id');
            require_once (APPPATH . 'handlers/User_handler.php');
            $this->userHandler = new User_handler();
            $responseArray = $this->userHandler->getUserProfile($docId, '');
                require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
                $this->bcpassignmentHandler = new Bcpassignment_handler();
                $bcpidresponse=  $this->bcpassignmentHandler->getDoctorBcps($docId);
                if($bcpidresponse['status']){
                    if($bcpidresponse['response']['total']!=0){
                        $responseArray['response']['bcp']=$bcpidresponse['response']['bcpdata'];
                    }else{
                        $responseArray['response']['bcp']=0;
                    }
                }
                $this->response($responseArray,200);
        }else {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }  
        
    }
}
