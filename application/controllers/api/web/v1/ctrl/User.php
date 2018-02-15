<?php

/* User  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             17-08-2017
 * @Last Modified       17-08-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/Doctor_handler.php');
require_once (APPPATH . 'handlers/User_handler.php');

class User extends REST_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->ci = & get_instance();
        $this->doctorHandler =  new Doctor_handler();
        $this->userHandler  =  new User_handler();
     }
    public function deleteUser_post(){
        $responseArray = userLoginCheck();
          if ($responseArray['status'] != 1) {
              if ($responseArray['response']['total'] == 0) {

                  $this->response($responseArray, $responseArray['statusCode']);
              }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'admin') {
            
            $Id =  $this->input->post("id"); 
            $responseArray = $this->userHandler->deleteUser($Id);
            $this->response($responseArray, $responseArray['statusCode']);  
        }else {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
     }
      public function editBcp_post(){
        try
        {
         
            $responseArray = userLoginCheck();
              if ($responseArray['status'] != 1) {
                  if ($responseArray['response']['total'] == 0) {

                      $this->response($responseArray, $responseArray['statusCode']);
                  }
            }
            $mobile=$this->input->post('mobile');
            $inputData = array(
                'id'=>$this->input->post('id'),
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'gender' =>$this->input->post('gender'),
                'countryid' => $this->input->post('countryid'),
                'stateid' => $this->input->post('stateid'),
                'cityid' => $this->input->post('cityid'),
                'district' => $this->input->post('district'),
                'village' => $this->input->post('village'),
                'pincode' => $this->input->post('pincode'),
                'mobile' => $mobile,
                'alternate_contact_number'=>$this->input->post('alternate_contact_number'),
                'language_id'=>$this->input->post('language_id'),
                'role' => $this->input->post('role'),
                'sessionUserId' => $responseArray['response']['sessionData']['userid']
            );
            
         
            $this->ci->form_validation->set_data($inputData);
            $this->ci->form_validation->set_rules($this->config->item('BcpEdit'));
            if ($this->ci->form_validation->run() == FALSE) {

                  throw new  Exception('Internal Server Error');
            }else{
                   
                if (isset($_FILES['profilePicture']) && !empty($_FILES['profilePicture'])) {  
                 $profileresArray =  uploadImage($_FILES['profilePicture'], $type="profile");

                 if($profileresArray['status']==1){
                    $inputData['profilePicture'] = $profileresArray['response']['imagename']; 
                 }else{
                      
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $profileresArray['response']['messages'];
                    $output['statusCode'] =STATUS_BAD_REQUEST;
                    $this->response($output, $output['statusCode']);
                 }
                }else{

                    $inputData['profilePicture'] ='';
                }
                 
                $responseArray = $this->doctorHandler->updateBCP($inputData);
                $this->response($responseArray, $responseArray['statusCode']);  
            }
        }   catch (Exception $e)
        {
             
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->ci->form_validation->error_array();
            $output['statusCode'] =STATUS_OK;
            $this->response($output, $output['statusCode']);
        } 
        
            
        }
        
    public function getBcp_get(){
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                $this->response($responseArray, $responseArray['statusCode']);
            }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'admin') {
            $bcpEditid = $this->input->get("bcpEditid");

            $responseArray = $this->userHandler->getUserProfile($bcpEditid,'');
            $this->response($responseArray, $responseArray['statuscode']); 
        }else {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
     }
     public function getStateBcp_post(){
         
            $stateid = $this->input->post('id');
            $responseArray = $this->userHandler->getUserLimitData(null,ROLE_BCP,'',$stateid,'');
            $this->response($responseArray, $responseArray['statuscode']);
            //echo json_encode($responseArray);
        }
     
}