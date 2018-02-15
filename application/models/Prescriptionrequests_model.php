<?php
/**
 Prescription requests entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     15-07-2017
 * @Last Modified 15-07-2017
 * @Last Modified By Vijay kumar Basu
 */
require_once 'Common_model.php';
class Prescriptionrequests_model  extends Common_model{
    var $id;
    var $prescriptionCode;
    var $type;
    var $medicalIncidentId;
    var $medicalIncidentDetailId;
    var $medicalIncidentVisitId;
    var $questionId;
    var $optionId;
    var $bcpId;
	var $patientId;
	var $requestDate;
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
        $this->setTableName("prescription_requests");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id           =  "id";
        $this->prescriptionCode    =  "prescription_code";
        $this->type    =  "type";
        $this->medicalIncidentId    =  "medical_incident_id";
        $this->medicalIncidentDetailId    =  "medical_incident_details_id";
        $this->medicalVisitId    =  "medical_incident_visit_id";
        $this->questionId    =  "question_id";
        $this->optionId    =  "option_id";
		$this->patientId 	= "patient_id";
        $this->bcpId       =  "bcp_id";
		$this->requestDate = "request_date";
        $this->createdby    =  "createdby";
        $this->modifiedby   =  "modifiedby";
        $this->cts          =  "cts";
        $this->mts          =  "cts";
        $this->status       =  "status";
        $this->deleted      =  "deleted";
       
    }
}
