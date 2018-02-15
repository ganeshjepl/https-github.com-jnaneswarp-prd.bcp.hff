<?php
/**
 Medical record detail entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By  shivajyothi Kandukuri
 */
require_once 'Common_model.php';
class Medicalincidentdetail_model  extends Common_model{
    var $id;
    var $medicalRecordId	;
    var $surveyId  ;
    var $surveyQuestionId   ;
    var $surveyQuestionOptionId;
    var $surveyQuestionOptionValue;
    var $status   ;
    var $deleted   ;
    var $createdby  ;
    var $modifiedby  ;
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("medical_record_detail");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id                        =  "id" ;
        $this->medicalRecordId           =  "medical_record_id";
        $this->surveyId                  =  "survey_id";
        $this->surveyQuestionId          =  "survey_question_id";
        $this->surveyQuestionOptionId    =  "survey_question_option_id";
        $this->surveyQuestionOptionValue =  "survey_question_option_value";
        $this->status                    =  "status";
        $this->deleted                   =  "deleted";
        $this->createdby                 =  "createdby";
        $this->modifiedby                =  "modifiedby";
    }
}

