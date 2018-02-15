<?php
/**
 Medical  Incident Visit entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             3-05-2017
 * @Last Modified       3-05-2017
 * @Last Modified By    shivajyothi Kandukuri
 */
require_once 'Common_model.php';
class Medicalincidentvisit_model  extends Common_model{
    var $id;
    var $medicalIncidentVisitCode;
    var $medicalIncidentId;
    var $patientId;
    var $bcpUserId;
    var $type;
    var $registrationDate;
    var $status;
    var $deleted;
    var $createdby;
    var $modifiedby;
    var $cts  ;
    var $mts  ;
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("medical_incident_visit");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id               =  "id" ;
        $this->medicalIncidentVisitCode  = "medical_incident_visit_code";
        $this->medicalIncidentId      =  "medical_incident_id";
        $this->patientId        =  "patient_id";
        $this->bcpUserId        =  "bcp_user_id";
        $this->type        =  "type";
        $this->registrationDate =  "registration_date";
        $this->status           =  "status";
        $this->deleted          =  "deleted";
        $this->createdby        =  "createdby";
        $this->modifiedby       =  "modifiedby";
        $this->cts       =  "cts";
        $this->mts       =  "mts";
    }
}
