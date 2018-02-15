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

class Survey_questionnaire_language_model extends Common_model {

    var $d;
    var $title;
    var $surveyQuestionId;
    var $languageId;
    var $deleted;

    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name
        $this->setTableName("survey_questionnaire_language");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }

    //Set the field values
    private function _setFieldNames() {
        $this->id = "id";
        $this->title = "title";
        $this->surveyQuestionId = "survey_question_id";
        $this->languageId = "language_id";
        $this->deleted = "deleted";
    }

}

?>