<?php
/* Network entity related logic defination
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             24-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once (APPPATH.'handlers/Networkhospital_handler.php');
class Networkhospital Extends REST_Controller {
    function __construct() {
        parent::__construct();
        $this->networkhospitalHandler = new Networkhospital_handler();
    }
    public function index_get(){
         $responseArray = $this->networkhospitalHandler->getNetworkHospitals();
         $this->response($responseArray, $responseArray['statuscode']);
        
    }

}
?>
