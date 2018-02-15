<?php
/**
 Cities entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By Pandu Babu
 */
require_once 'Common_model.php';
class Bcpreferredhospital_model  extends Common_model{
    var $id;
    var $medicalIncidentDetailId;
    var $surveyQuestionId;
    var $surveyQuestionOptionId;
    var $hospitalId;
    var $status;
    var $deleted;
    var $createdby;
    var $cts;
    var $mts;
    
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("bcp_referred_hospitals");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id                       =  "id";
        $this->medicalIncidentDetailId  =  "medical_incident_detail_id";
        $this->surveyQuestionId         =  "survey_question_id"; 
        $this->surveyQuestionOptionId   =  "survey_question_option_id"; 
        $this->hospitalId               =  "hospital_id"; 
        $this->status                   =  "status";
        $this->deleted                  =  "deleted";
        $this->createdby                =  "createdby";
        $this->cts                      =  "cts";
        $this->mts                      =  "mts";
       
    }
}
