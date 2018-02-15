<?php
/**
 User entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By Sridevi Gara
 */
require_once 'Common_model.php';

class Survey_chief_complaint_mapping_model extends Common_model {

    var $d;
    var $surveyQuestionId;
    var $surveyOptionId;
    var $value;
    var $chiefComplaintSurveyId;
    var $condition;
    var $status;  //0=inactive , 1=active, 2=notverified
    var $deleted;
    var $createdBy;
    var $modifiedBy;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("survey_chief_complaint_mapping");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id = "id";
        $this->surveyQuestionId = "survey_question_id";
        $this->surveyOptionId = "survey_option_id";
        $this->value = "value";
        $this->chiefComplaintSurveyId = "chief_complaint_survey_id";
        $this->condition = "condition";
        $this->status = "status";
        $this->deleted = "deleted";
        $this->createdBy = "createdBy";
        $this->modifiedBy = "modifiedBy";
         
    }

    
    

}
?>