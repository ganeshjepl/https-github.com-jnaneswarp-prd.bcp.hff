<?php
/**
 Medical record entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             2-05-2017
 * @Last Modified       2-05-2017
 * @Last Modified By    shivajyothi Kandukuri
 */
require_once 'Common_model.php';
class Medicalincident_model  extends Common_model{
    var $id;
    var $medicalRecordId;
    var $medicalIncidentCode;
    var $medicalIncidentVisitId;
    var $patientId;
    var $registrationDate;
    var $bcpUserId; 
    var $medicalIncidentStatus; 
    var $status;
    var $deleted;
    var $createdby;
    var $modifiedby;
    var $cts;
    var $mts;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("medical_incident");
        //Giving alias names to table field names 
        $this->_setFieldNames();              
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id               =  "id" ;
        $this->medicalRecordId  = "medical_record_id";
        $this->medicalIncidentCode      =  "medical_incident_code";
        $this->medicalIncidentVisitId        =  "medical_incident_visit_id";
        $this->patientId        =  "patient_id";
        $this->registrationDate =  "registration_date";
        $this->bcpUserId        =  "bcp_user_id";
        $this->medicalIncidentStatus =  "medical_incident_status";
        $this->status           =  "status";
        $this->deleted          =  "deleted";
        $this->createdby        =  "createdby";
        $this->modifiedby       =  "modifiedby";
        $this->cts       =  "cts";
        $this->mts       =  "mts";
    }
    
    
}
