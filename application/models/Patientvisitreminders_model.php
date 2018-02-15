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
class Patientvisitreminders_model  extends Common_model{
    var $id;    
    var $medicalIncidentVisitId;
    var $medicalIncidentDetailId;
    var $surveyQuestionId;
    var $surveyQuestionOptionId;
    var $visitDate;
    var $expiryDate;
    var $bcpUserId;
    var $cts;
    var $mts;
    var $status;
    var $deleted;
     
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("patient_visit_reminders");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id           =  "id";        
        $this->medicalIncidentVisitId = "medical_incident_visit_id";
        $this->medicalIncidentDetailId = "medical_incident_detail_id";
        $this->surveyQuestionId = "survey_question_id";
        $this->surveyQuestionOptionId = "survey_question_option_id";
        $this->visitDate    =  "visit_date";
        $this->expiryDate   =  "expiry_date";
        $this->bcpUserId   =  "bcp_user_id";
        $this->cts          =  "cts";
        $this->mts          =  "mts";
        $this->status       =  "status";
        $this->deleted      =  "deleted";
       
    }
}
