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

class Survey_questionnaire_option_language_model extends Common_model {

    var $id;
    var $value;
    var $label;
    var $suffixLabel;
    var $surveyQuestionOptionId;    
    var $languageId;  
    var $status;  //0=inactive , 1=active, 2=notverified
    var $deleted;
  
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("survey_questionnaire_option_language");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id = "id";       
        $this->value = "value";
        $this->label = "label";
        $this->suffixLabel = "suffix_label";        
        $this->surveyQuestionOptionId = "survey_question_option_id";
        $this->languageId = "language_id";
        $this->status = "status";
        $this->deleted = "deleted"; 
    }
   
    

}
?>