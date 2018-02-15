<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/MedicineCatalog_handler.php');

class MedicineCatalog extends REST_Controller {
   public $medicineCatalogHandler;
   
   public function __construct() {
        parent::__construct();
        $this->ci = & get_instance();
        $this->load->library('form_validation');
        $this->medicineCatalogHandler  = new MedicineCatalog_handler(); 
    }
    
    public function insertMedicineCatalog_post( ) {
        try
        {
            $responseArray = userLoginCheck();
               if ($responseArray['status'] != 1) {
                   if ($responseArray['response']['total'] == 0) {

                       $this->response($responseArray, $responseArray['statusCode']);
                   }
               }
            $inputData = array(
            'id'=>$this->input->post('id'),
            'name' => $this->input->post('name'),
            'brand' => $this->input->post('brand'),
            'generic_name' => $this->input->post('generic_name'),
            'dosage' => $this->input->post('dosage'),
            'batch_number' => $this->input->post('batch_number'),
            'expiry_date' => $this->input->post('expiry_date'),
            'indications' => $this->input->post('indications'),
            'quantity' => $this->input->post('quantity')
            
            );
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('MedicineCatalog'));

            if ($this->ci->form_validation->run() == FALSE) {
               throw new  Exception('Internal Server Error');
            }

            $responseArray = $this->medicineCatalogHandler->insertMedicineCatalog($inputData);
            $this->response($responseArray, $responseArray['statusCode']);
            
        }
        catch (Exception $e)
        {
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->ci->form_validation->error_array();
            $output['statusCode'] =STATUS_BAD_REQUEST;
            $this->response($output, $output['statusCode']);
        }

           
     }
    public function updateMedicineCatalog_post(){    
        try
        {
            $responseArray = userLoginCheck();
            if ($responseArray['status'] != 1) {
                if ($responseArray['response']['total'] == 0) {

                    $this->response($responseArray, $responseArray['statusCode']);
                }
            }
          
            $inputData = array(
            'id'=>$this->input->post('id'),
            'name' => $this->input->post('name'),
            'brand' => $this->input->post('brand'),
            'generic_name' => $this->input->post('generic_name'),
            'dosage' => $this->input->post('dosage'),
            'batch_number' => $this->input->post('batch_number'),
            'expiry_date' => $this->input->post('expiry_date'),
            'indications' => $this->input->post('indications'),
            'quantity' => $this->input->post('quantity')
            
            );
            
            $this->form_validation->set_data($inputData);
            $this->form_validation->set_rules($this->config->item('MedicineCatalog'));
               
            if ($this->ci->form_validation->run() == FALSE) {
              throw new  Exception('Internal Server Error');
            }
            $responseArray = $this->medicineCatalogHandler->updateMedicineCatalog($inputData);
            $this->response($responseArray, $responseArray['statusCode']);
            
        }   catch (Exception $e)
        {
             
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->ci->form_validation->error_array();
            $output['statusCode'] =STATUS_BAD_REQUEST;
            $this->response($output, $output['statusCode']);
        }
    }
    
    public function deleteMedicineCatalog_post(){
        $responseArray = userLoginCheck();
            if ($responseArray['status'] != 1) {
                if ($responseArray['response']['total'] == 0) {

                    $this->response($responseArray, $responseArray['statusCode']);
                }
        }
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'admin') {
      
        $inputData['id'] =  $this->input->post('id');
        $responseArray = $this->medicineCatalogHandler->deleteMedicineCatalog($inputData);
        $this->response($responseArray, $responseArray['statusCode']);
        print_r($responseArray);
        }else {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_authorization_message');
            $output['statusCode'] = STATUS_UNAUTHORIZED;
            $this->response($output, $output['statusCode']);
        }
    }
    
    public function getMedicine_get(){
        $responseArray = userLoginCheck();
           if ($responseArray['status'] != 1) {
               if ($responseArray['response']['total'] == 0) {

                   $this->response($responseArray, $responseArray['statusCode']);
               }
        }
        $inputData=array(
           $this->input->get("medicineid") 
        );
        
        $userrole = $responseArray['response']['sessionData']['userrole'];
        if ($userrole == 'admin') {
            $responseArray =  $this->medicineCatalogHandler->getMedicineCatalog($inputData,'','','');
            $this->response($responseArray);
        }else {
          $output['status'] = FALSE;
          $output['response']['messages'][] = $this->ci->lang->line('error_no_authorization_message');
          $output['statusCode'] = STATUS_UNAUTHORIZED;
          $this->response($output, $output['statusCode']);
        }
     }
    
    
    
}
