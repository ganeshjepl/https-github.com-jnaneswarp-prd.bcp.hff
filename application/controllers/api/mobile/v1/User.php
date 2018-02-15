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
require_once (APPPATH . 'handlers/email_handler.php');
require_once (APPPATH . 'handlers/Messagetemplate_handler.php');

class User extends REST_Controller {

    public $userHandler;
    public $emailHandler;
    public $messagetemplateHandler;

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
        $this->userHandler = new User_handler();
        
        $this->emailHandler = new Email_handler();
        $this->messagetemplateHandler = new Messagetemplate_handler();
        
        
        
    }

    public function login_post() {
        
        //$this->output->enable_profiler(TRUE);
        
        $inputData = array(
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'language' => $this->post('language'),
            'userrole' => ROLE_BCP,
            'deviceId' => $this->post('deviceId'),
            'deviceToken' => $this->post('deviceToken'),
            'osType'   => $this->post('osType'),
            'osVersion'=> $this->post('osVersion'),
            'type'=>  MOBILE_TYPE            
        );
            
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('userLoginRules'));

        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
        // remove the below line after 
        //$inputData['password'] = $this->encryption->encrypt($inputData['password']);
        //$inputData['password'] = $this->encryption->decrypt($inputData['password']);
        $responseArray = $this->userHandler->userLogin($inputData);
        $this->response($responseArray, $responseArray['statusCode']);
    }

    public function userRegistration_post() {

        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }

        $inputData = array(
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'email' => $this->post('email'),
            'first_name' => $this->post('firstName'),
            'last_name' => $this->post('lastName'),
            'signupdate' => $this->post('signupdate'),            
            'countryid' => $this->post('countryid'),
            'stateid' => $this->post('stateid'),
            'cityid' => $this->post('cityid'),
            'pincode' => $this->post('pincode'),
            'mobile' => $this->post('mobile'),
            'role' => $this->post('role'),
            'sessionUserId' => $responseArray['response']['sessionData']['userid']
        );
        // print_r($inputData);
        
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('userRegRules'));

        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
             $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        } else {
            ///$password =$this->encryption->encrypt($inputData['password']);
            ///$inputData['password'] = $this->encryption->decrypt($password);
            $responseArray = $this->userHandler->userRegistration($inputData);
            $this->response($responseArray, $responseArray['statusCode']);
        }
    }

    public function userDetails_get() {

        $responseArray = userLoginCheck();
        //print_r($responseArray);
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $sessionUserId = $responseArray['response']['sessionData']['userid'];
        $responseArray = $this->userHandler->getUserDetails($sessionUserId);
        $this->response($responseArray, $responseArray['statusCode']);
    }

    public function logout_get() {
        $responseArray = userLoginCheck();
        //print_r($responseArray);
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $responseArray = $this->userHandler->logout();
        $this->response($responseArray, $responseArray['statusCode']);
    }
    
    public function changePassword_post() {
        $responseArray = userLoginCheck();
        //print_r($responseArray);
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $sessionUserId = $responseArray['response']['sessionData']['userid'];
               
        $inputData = array(
            'oldPassword' => $this->post('oldPassword'),
            'newPassword' => $this->post('newPassword'),
            'confirmPassword' => $this->post('confirmPassword'),
            'userId' => $sessionUserId,
        );
       
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('changePasswordRules'));
               
        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
         
        $responseArray = $this->userHandler->changePassword($inputData);
        $this->response($responseArray, $responseArray['statusCode']);
        
    }
    
    public function forgotPassword_post() {

        $inputData = array(
            'inputVal' => $this->post('inputVal')
        );
        $inputValType = "";
        $this->form_validation->set_data($inputData);
        if (is_numeric($inputData['inputVal'])) {
            $inputValType = "mobile";
            $this->form_validation->set_rules($this->config->item('forgotPasswordMobileRules'));
        }else{
            $inputValType = "username";
            $this->form_validation->set_rules($this->config->item('forgotPasswordUsernameRules'));
        }
        
        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
         
        ///$responseArray = $this->userHandler->checkUserExists($inputData, $inputValType);
        $responseArray = $this->userHandler->sendOTP($inputData, $inputValType);
        $this->response($responseArray, $responseArray['statusCode']);
        
    }
    
    public function validateOtp_post(){
        
        $otpCode = $this->post('otpCode');        
        $inputData = array(
            'otpCode' => $this->post('otpCode'),
            'username' => $this->post('username'),
            'newPassword' => $this->post('newPassword'),
            'confirmPassword' => $this->post('confirmPassword'),
        );
       
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('validateOtpRules'));
               
        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            $this->response($output, $statusCode);
        }
         
        $responseArray = $this->userHandler->validateOtp($inputData);
        $this->response($responseArray, $responseArray['statusCode']);
        
    } 
    
   
    public function bcpDetails_get() {
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        
            $inputData = array('id' => $this->get('id'));    
//            
//            $this->form_validation->set_data($inputData);
//            $this->form_validation->set_rules($this->config->item('bcpDetailsRules'));
//            
//            if ($this->form_validation->run() == FALSE) {
//                $output['response']['messages'] = $this->form_validation->error_array();
//                $statusCode = STATUS_BAD_REQUEST;
//                $output['statusCode'] = $statusCode;
//                $this->response($output, $statusCode);
//            }
            
            $responseArray = $this->userHandler->getUserProfile($inputData['id'],'');
            
            
            $this->response($responseArray, $responseArray['statusCode']);
        
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        
    }
    public function assignedBcpList_get() {
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        
            $inputData = array('id' => $this->get('bcp_id'));    
//            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('bcpDetailsRules'));
            
            if ($this->form_validation->run() == FALSE) {
                $output['response']['messages'] = $this->form_validation->error_array();
                $statusCode = STATUS_BAD_REQUEST;
                $output['statusCode'] = $statusCode;
                $this->response($output, $statusCode);
            }
            
            $responseArray = $this->userHandler->getUserProfile($inputData['id'],'');
            
            
            $this->response($responseArray, $responseArray['statusCode']);
        
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_NO_AUTHORIZATION;
            $output['response']['messages'][] = $this->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        
    }
    
}
