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
require_once (APPPATH . 'handlers/User_handler.php');
class Index extends REST_Controller {
    public $userHandler;
    public function __construct() {
        parent::__construct();
        $this->ci = & get_instance();
     }
    public function validateUserLogin_post() {
         
        $this->userHandler = new User_handler();
        $inputData = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'language' => '',
            'userrole' => 'admin',
            'deviceId' => '',
            'deviceToken' => '',
            'osType'   => '',
            'osVersion'=> '' ,
            'type'=> WEB_TYPE ,
        );
        
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('userLoginWebRules'));

        if ($this->ci->form_validation->run() == FALSE) {
             
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->ci->form_validation->error_array()  ;
            $output['statusCode'] =STATUS_BAD_REQUEST;
            $this->response($output, $output['statusCode']);
        }else{ 
        
        $responseArray = $this->userHandler->userLogin($inputData);
        $this->response($responseArray, $responseArray['statusCode']);
       }
        
         
    }
}