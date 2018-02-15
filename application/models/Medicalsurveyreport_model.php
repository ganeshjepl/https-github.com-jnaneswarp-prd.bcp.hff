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
class Medicalsurveyreport_model  extends Common_model{
    var $id;
    var $medicalIncidentDetailId;
    var $medicalIncidentId;
    var $medicalIncidentVisitId;
    var $surveyId   ;
    var $surveyQuestionId   ;
    var $surveyQuestionOptionId   ; 
    var $surveyQuestionOptionValue   ;
    var $registrationDate   ;
    var $status ;
    var $createdby  ;
    var $modifiedby  ;
    var $deleted;
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("medical_survey_report");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id                          =  "id" ;
        $this->medicalIncidentDetailId     =  "medical_incident_detail_id";
        $this->medicalIncidentId      =  "medical_incident_id";
        $this->medicalIncidentVisitId      =  "medical_incident_visit_id";
        $this->surveyId                    =  "survey_id";
        $this->surveyQuestionId            =  "survey_question_id";
        $this->surveyQuestionOptionId      =  "survey_question_option_id";
        $this->surveyQuestionOptionValue   =  "survey_question_option_value";
        $this->registrationDate   =  "registration_date";
        $this->status                      =  "status";
        $this->createdby                   =  "createdby";
        $this->modifiedby                  =  "modifiedby";
        $this->deleted                     =  "deleted";
    }
}
