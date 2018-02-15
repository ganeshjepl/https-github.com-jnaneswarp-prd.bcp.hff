<?php
/**
 Medical record entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             20-04-2017
 * @Last Modified       2-05-2017
 * @Last Modified By    shivajyothi Kandukuri
 */
require_once 'Common_model.php';
class Medicalrecord_model  extends Common_model{
    var $id;
    var $medicalRegistrationNumber	;
    var $patientId   ;
    var $registrationDate   ;
    var $bcpUserId   ; 
    var $status   ;
    var $deleted   ;
    var $createdby  ;
    var $modifiedby  ;
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("medical_record");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id               =  "id" ;
        $this->medicalRegistrationNumber      =  "medical_registration_number";
        $this->patientId        =  "patient_id";
        $this->registrationDate =  "registration_date";
        $this->bcpUserId        =  "bcp_user_id";
        $this->status           =  "status";
        $this->deleted          =  "deleted";
        $this->createdby        =  "createdby";
        $this->modifiedby       =  "modifiedby";
    }
}
