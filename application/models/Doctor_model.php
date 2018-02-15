<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//id, username, password, email, first_name, last_name, signupdate,
//countryid, stateid, cityid, pincode, mobile, alternate_contact_number,
//language_id, profile_picture, signature_picture, status, createdby, modifiedby, cts, mts, deleted
// 

require_once 'Common_model.php';
class Doctor_model extends Common_model{
   var $id;
   var $username;
   var $password;
   var $email;
   var $first_name;
   var $last_name;
   var $gender;
   var $signupdate;
   var $countryid;
   var $stateid;
   var $cityid;
   var $pincode;
   var $mobile;
   var $alternate_contact_number;
   var $language_id;
   var $profile_picture;
   var $signature_picture;
   var $status;
   var $createdby;
   var $modifiedby;
   var $cts;
   var $mts;
   var $deleted;
   
   
   function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("user");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    
    private function _setFieldNames(){
        $this->id          =  "id";
        $this->username    =  "username";
        $this->password    =  "password";
        $this->email       =  "email";        
        $this->first_name  =  "first_name";
        $this->last_name   =  "last_name";
        $this->gender      =  "gender";
        $this->signupdate  =  "signupdate";
        $this->countryid   =  "countryid";
        $this->stateid     =  "stateid";
        $this->cityid      =  "cityid";
        $this->pincode     =  "pincode";
        $this->mobile      =  "mobile";
        $this->alternate_contact_number     =  "alternate_contact_number";
        $this->language_id =  "language_id";
        $this->profile_picture     =  "profile_picture";
        $this->signature_picture   =  "signature_picture";
        $this->createdby   =  "createdby";
        $this->modifiedby  =  "modifiedby";
        $this->status      =  "status";
        $this->deleted     =  "deleted";
        $this->cts         =  "cts";
        $this->mts         =  "cts";
       
    }
}