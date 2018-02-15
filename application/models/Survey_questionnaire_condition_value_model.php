<?php
/**
 User entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     21-04-2017
 * @Last Modified 21-04-2017
 * @Last Modified By Sridevi Gara
 */
require_once 'Common_model.php';

class Survey_questionnaire_condition_value_model extends Common_model {

    var $id;
    var $conditionSurveyQuestionId;
    var $displaySurveyQuestionId;
    var $conditionSurveyQuestionOptionId;
    var $displaySurveyQuestionOptionId;
    var $conditionMatchFirstvalue;
    var $conditionMatchSecondvalue;
    var $validationType;
    var $mandatory;
    var $conditionType;
    var $generalFieldName;
    var $status;  //0=inactive , 1=active, 2=notverified
    var $deleted;
    var $order;
    var $createdBy;
    var $modifiedBy;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("survey_questionnaire_condition_value");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id = "id";
        $this->conditionSurveyQuestionId = "condition_survey_question_id";
        $this->conditionSurveyQuestionOptionId = "condition_survey_question_option_id";
        $this->displaySurveyQuestionId = "display_survey_question_id";
        $this->displaySurveyQuestionOptionId = "display_survey_question_option_id";
        $this->conditionMatchFirstvalue = "condition_match_firstvalue";
        $this->conditionMatchSecondvalue = "condition_match_secondvalue";
        $this->validationType = "validation_type";
        $this->mandatory = "mandatory";
        $this->conditionType = "condition_type";
        $this->generalFieldName = "general_field_name";
        $this->status = "status";
        $this->order = "order";
        $this->deleted = "deleted";
        $this->createdBy = "createdby";
        $this->modifiedBy = "modifiedby";
        
    }

    
    

}
?>