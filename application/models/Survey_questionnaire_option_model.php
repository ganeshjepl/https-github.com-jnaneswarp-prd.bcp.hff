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

class Survey_questionnaire_option_model extends Common_model {

    var $id;
    var $surveyId;
    var $surveyQuestionId;
    var $optionType;
    var $value;
    var $label;
    var $suffixLabel;
    var $parentId;
    var $childEnabled;
    var $conditionalDisplay;
    var $validationType;
    var $autopopulateOptionId;
    var $autopopulateConditionId;
    var $readonly;
    var $severity;
    var $reminder;
    var $reminderDays;
    var $requestPrescription;
    var $status;  //0=inactive , 1=active, 2=notverified
    var $deleted;
    var $order;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("survey_questionnaire_option");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id = "id";
        $this->surveyId = "survey_id";
        $this->surveyQuestionId = "survey_question_id";
        $this->optionType = "option_type";
        $this->value = "value";
        $this->label = "label";
        $this->suffixLabel = "suffix_label";
        $this->parentId = "parentid";
        $this->childEnabled = "child_enabled";
        $this->conditionalDisplay = "conditional_display";
        $this->validationType = "validation_type";
        $this->autopopulateOptionId = "autopopulate_option_id";
        $this->autopopulateConditionId = "autopopulate_condition_id";
        $this->readonly = "readonly";
        $this->severity = "severity";
        $this->reminder = "reminder";
        $this->reminderDays = "reminder_days";
        $this->requestPrescription = "request_prescription";
        $this->order = "order";
        $this->status = "status";
        $this->deleted = "deleted";
 
    }

    
    

}
?>