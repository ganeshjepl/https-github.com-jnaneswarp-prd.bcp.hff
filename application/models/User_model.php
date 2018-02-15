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

class User_model extends Common_model {

    var $id;
    var $username;
    var $password;
    var $email;
    var $firstName;
    var $lastName;
    var $gender;
    var $signupdate;
    var $countryid;
    var $stateid;
    var $cityid;
    var $district;
    var $village;
    var $pincode;
    var $profile_picture;
    var $signature_picture;
    var $mobile;
    var $alternate_contact_number;
    var $languageId;
    var $createdby;
    var $modifiedby;	
    var $status;  //0=inactive , 1=active, 2=notverified
    var $deleted;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("user");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id         = "id";
        $this->username   = "username";
        $this->password   = "password";
        $this->email      = "email";
        $this->firstName  = "first_name";
        $this->lastName   = "last_name";
        $this->gender     = "gender";
        $this->signupdate = "signupdate";
        $this->countryid  = "countryid";
        $this->stateid    = "stateid";
        $this->cityid     = "cityid";
        $this->district   = "district";
        $this->village    = "village";
        $this->pincode    = "pincode";
        $this->mobile     = "mobile";
        $this->alternate_contact_number = "alternate_contact_number";
        $this->profile_picture     = "profile_picture";
        $this->signature_picture   = "signature_picture";
        $this->languageId = "language_id";
        $this->createdby  = "createdby";
        $this->modifiedby = "modifiedby";
        $this->status     = "status";
        $this->deleted    = "deleted";
 
    }
    
   

    
    

}
?>
