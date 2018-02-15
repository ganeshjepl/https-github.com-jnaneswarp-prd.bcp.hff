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

class Survey_questionnaire_model extends Common_model {

    var $id;
    var $title;
    var $surveyId;
    var $surveyTaxonomyId;
    var $parentId;
    var $conditionalDisplay;
    var $chiefComplaintLinking;
    var $conditionalType;
    var $surveyQuestionnaireConditionId;
    var $type;
    var $severity;
    var $mandatory;
    var $status;  //0=inactive , 1=active, 2=notverified    
    var $deleted;
    var $order;
    var $cts;
    var $mts;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name
        $this->setTableName("survey_questionnaire");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }

    //Set the field values
    private function _setFieldNames() {
        $this->id = "id";
        $this->title = "title";
        $this->surveyId = "survey_id";
        $this->surveyTaxonomyId = "survey_taxonomy_id";
        $this->parentId = "parentid";
        $this->conditionalDisplay = "conditional_display";
        $this->conditionalType = "conditional_type";
        $this->chiefComplaintLinking = "chief_complaint_linking";
        $this->surveyQuestionnaireConditionId = "survey_questionnaire_condition_id";
        $this->type = "type";
        $this->severity = "severity";
        $this->mandatory = "mandatory";
        $this->order = "order";
        $this->status = "status";
        $this->deleted = "deleted";
        $this->cts = "cts";
        $this->mts = "mts";
    }

}

?>