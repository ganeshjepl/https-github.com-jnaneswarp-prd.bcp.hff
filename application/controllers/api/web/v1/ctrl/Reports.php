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
require_once (APPPATH . 'handlers/Reports_handler.php');
 
class Reports extends REST_Controller {
     public function __construct() {
        parent::__construct();
        $this->ci = & get_instance();
        $this->Reportshandler =  new Reports_handler();
        
     }
 
    public function getbcpReports_post(){

        $responseArray = userLoginCheck();
            if ($responseArray['status'] != 1) {
                  if ($responseArray['response']['total'] == 0) {

                      $this->response($responseArray, $responseArray['statusCode']);
            }
        }
         $bcpid  = $this->input->post('bcpid');   
          
            $result = $this->Reportshandler->getAllReports($bcpid);
            $this->response($result, $result['statuscode']); 
            



        }
    }