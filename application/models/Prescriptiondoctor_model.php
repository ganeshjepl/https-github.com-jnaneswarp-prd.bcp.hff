<?php
/**
 Countries entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By Pandu Babu
 */
require_once 'Common_model.php';
class Prescriptiondoctor_model  extends Common_model{
    var $id;
    var $patientId;
    var $prescId;
    var $patientName;
    var $gender;
    var $age;
    var $village;
    var $contactNumber;
    var $incidentType; 
    var $createdby;
    var $modifiedby;
    var $cts;
    var $mts;
    var $status;
    var $deleted;
    
    
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("prescription_doctor");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id           =  "id";
        $this->patientId    =  "patient_id";
        $this->prescId      =  "precription_id";
        $this->patientName  =  "patient_name";
        $this->gender       =  "gender";
        $this->age          =  "age";
        $this->village      =  "village";
        $this->contactNumber=  "contact_number";
        $this->incidentType =  "incident_type";
        $this->createdby    =  "createdby";
        $this->modifiedby   =  "modifiedby";
        $this->cts          =  "cts";
        $this->mts          =  "mts";
        $this->status       =  "status";
        $this->deleted      =  "deleted";
       
    }
}
