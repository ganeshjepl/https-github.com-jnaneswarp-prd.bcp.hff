<?php
/**
 Prescription related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     15-07-2017
 * @Last Modified 15-07-2017
 * @Last Modified By Vijay kumar Basu
 */
require_once 'Common_model.php';
class Prescription_model  extends Common_model{
    var $id;
    var $prescriptionCode;
    var $prescriptionRequestId;
    var $medicalVisitId;
    var $questionId;
    var $optionId;
    var $bcpUserId;
    var $doctorId;
    var $prescriptionDate;
    var $prescriptionStatus;
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
        $this->setTableName("prescription");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id           =  "id";
        $this->prescriptionCode     =  "prescription_code";
        $this->medicalVisitId       =  "medical_visit_id";
        $this->prescriptionRequestId=  "prescription_request_id";
        $this->questionId           =  "question_id";
        $this->optionId             =  "option_id";
        $this->bcpUserId            =  "bcp_id";
        $this->doctorId             =  "doctor_id";
        $this->prescriptionDate     =  "prescription_date";
        $this->prescriptionStatus   =  "prescription_status";
        $this->createdby            =  "createdby";
        $this->modifiedby           =  "modifiedby";
        $this->cts                  =  "cts";
        $this->mts                  =  "cts";
        $this->status               =  "status";
        $this->deleted              =  "deleted";
       
    }
}
