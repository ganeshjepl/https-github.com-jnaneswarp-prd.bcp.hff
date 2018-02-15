<?php
/**
 User entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By Sridevi Gara
 */
require_once 'Common_model.php';

class User_otp_model extends Common_model {

    var $id;
    var $userId;
    var $otp;
    var $validity;
    var $cts;   
    var $status;   
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("user_otp");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id = "id";
        $this->userId = "user_id";
        $this->otp = "otp";
        $this->validity = "validity";
        $this->cts = "cts";  
        $this->status = "status";  
    }
    
}
?>