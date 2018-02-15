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

class Survey_questionnaire_condition_model extends Common_model {

    var $d;
    var $surveyId;
    var $surveyTaxonomyId;
    var $surveyQuestionId;
    var $condition;
    var $status;  //0=inactive , 1=active, 2=notverified
    var $deleted;
    var $order;
    var $createdBy;
    var $modifiedBy;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("survey_questionnaire_condition");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id = "id";
        $this->surveyId = "survey_id";
        $this->surveyTaxonomyId = "survey_taxonomy_id";
        $this->surveyQuestionId = "survey_question_id";
        $this->condition = "condition";
        $this->status = "status";
        $this->order = "order";
        $this->deleted = "deleted";
        $this->createdBy = "createdby";
        $this->modifiedBy = "modifiedby";
        
    }

    
    

}
?>