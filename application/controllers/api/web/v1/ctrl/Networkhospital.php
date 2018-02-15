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
require_once (APPPATH . 'handlers/Networkhospital_handler.php');
require_once (APPPATH . 'handlers/Country_handler.php');
require_once (APPPATH . 'handlers/State_handler.php');
class Networkhospital extends REST_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->ci = & get_instance();
        $this->load->library('form_validation');
        $this->Networkhospitalhandler  = new Networkhospital_handler(); 
    }
    public function addNetworkhospital_post( ) {
        try
        {
            $responseArray = userLoginCheck();
               if ($responseArray['status'] != 1) {
                   if ($responseArray['response']['total'] == 0) {

                       $this->response($responseArray, $responseArray['statusCode']);
                   }
               }
            $inputData = array( 
             'name' => $this->input->post('name'),
             'zipcode' =>  $this->input->post('zipcode'),
             'country' => $this->input->post('country'),
             'state' => $this->input->post('state'),
             'type' =>  $this->input->post('type'),
             'status' =>  $this->input->post('status'), 
             'contactnumber' => $this->input->post('contactnumber'),
             'website' =>  $this->input->post('weburl'),
             'address' =>  $this->input->post('address')
            );
            $this->ci->form_validation->set_data($inputData);
            $this->ci->form_validation->set_rules($this->ci->config->item('networkHospitalsRules'));
            if ($this->ci->form_validation->run() == FALSE) {
               throw new  Exception('Internal Server Error');
            }

                   $this->Countryhandler = new Country_handler(); 
                   $this->Statehandler = new State_handler(); 
                    
                   $countryData =   $this->Countryhandler->getCountryData( $this->input->post('country'));
                   $inputData['countryname'] = $countryData['response']['countryData'][0]['name']; 
                   $stateData =   $this->Statehandler->getStateData( $this->input->post('state'));

                   $inputData['statename'] = $stateData['response']['stateData'][0]['name']; 
                   $responseArray =  $this->Networkhospitalhandler->addNetworkHospitals($inputData);
                   $this->response($responseArray, $responseArray['statusCode']);
        }catch (Exception $e)
        {
             
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->ci->form_validation->error_array();
            $output['statusCode'] =STATUS_BAD_REQUEST;
            $this->response($output, $output['statusCode']);
        }

           
     }
      public function editNetworkhospital_post(){
        try
        {
         
            $responseArray = userLoginCheck();
               if ($responseArray['status'] != 1) {
                   if ($responseArray['response']['total'] == 0) {

                       $this->response($responseArray, $responseArray['statusCode']);
                   }
               }
            $inputData = array( 
             'name' => $this->input->post('name'),
             'zipcode' =>  $this->input->post('zipcode'),
             'country' => $this->input->post('country'),
             'state' => $this->input->post('state'),
             'type' =>  $this->input->post('type'),
             'status' =>  $this->input->post('status'),   
             'contactnumber' => $this->input->post('contactnumber'),
                'website' =>  $this->input->post('weburl'),
             'address' =>  $this->input->post('address')
            );
            
            $this->ci->form_validation->set_data($inputData);
            $this->ci->form_validation->set_rules($this->ci->config->item('networkHospitalsRules'));
               
            if ($this->ci->form_validation->run() == FALSE) {
              throw new  Exception('Internal Server Error');
            }
           
                $this->Countryhandler = new Country_handler(); 
                $this->Statehandler = new State_handler(); 
                
                $countryData =   $this->Countryhandler->getCountryData( $this->input->post('country'));
                $countryData['response']['countryData'][0]['name'];
                $inputData['countryname'] = $countryData['response']['countryData'][0]['name']; 
                $stateData =   $this->Statehandler->getStateData( $this->input->post('state'));
                $stateData['response']['stateData'][0]['name']; 
                $inputData['statename'] = $stateData['response']['stateData'][0]['name']; 
                $inputData['networkEditid'] =$this->input->post('networkEditid');
                $responseArray =  $this->Networkhospitalhandler->editNetworkHospitals($inputData);
                $this->response($responseArray, $responseArray['statusCode']);
                       

             
        
        }catch (Exception $e)
          {

              $output['status'] = FALSE;
              $output['response']['messages'][] = $this->ci->form_validation->error_array();
              $output['statusCode'] =STATUS_OK;
              $this->response($output, $output['statusCode']);
          }
      }
      public function getNetworkhospital_get(){
        $responseArray = userLoginCheck();
           if ($responseArray['status'] != 1) {
               if ($responseArray['response']['total'] == 0) {

                   $this->response($responseArray, $responseArray['statusCode']);
               }
        }
        $networkEditid = $this->input->get("networkEditid");
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'admin') {
            $responseArray =  $this->Networkhospitalhandler->getNetworkHospital($networkEditid,'','',ROLE_ADMIN);
            $this->response($responseArray, $responseArray['statusCode']);
        }else {
          $output['status'] = FALSE;
          $output['response']['messages'][] = $this->ci->lang->line('error_no_authorization_message');
          $output['statusCode'] = STATUS_UNAUTHORIZED;
          $this->response($output, $output['statusCode']);
        }
     }
      public function deleteNetworkhospital_post(){
           $responseArray = userLoginCheck();
           if ($responseArray['status'] != 1) {
               if ($responseArray['response']['total'] == 0) {

                   $this->response($responseArray, $responseArray['statusCode']);
               }
           }
           $userrole = $responseArray['response']['sessionData']['userrole'];
           if ($userrole == 'admin') {
            $Id =  $this->input->post("id"); 
            $responseArray =$this->Networkhospitalhandler->deleteNetworkHospitals($Id);
            $this->response($responseArray, $responseArray['statusCode']);
           }else {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
     }
}