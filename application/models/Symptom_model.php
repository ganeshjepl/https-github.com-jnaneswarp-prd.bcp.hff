<?php
/**
 Symptom entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             20-04-2017
 * @Last Modified       20-04-2017
 * @Last Modified By    shivajyothi Kandukuri
 */
require_once 'Common_model.php';
class Symptom_model  extends Common_model{
    var $id;
    var $surveyId ;
    var $taxonomyId ;
    var $questionId   ;
    var $name   ;
    var $status   ;
    var $order   ;
    var $createdby   ;
    var $modifiedby  ;
    var $deleted   ;
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("symptom");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id                =  "id" ;
        $this->name              =  "name";
        $this->surveyId          =  "survey_id";
        $this->taxonomyId        =  "taxonomy_id";
        $this->questionId        =  "question_id";
        $this->name              =  "name";
        $this->status            =  "status";
        $this->order             =  "order";
        $this->deleted           =  "deleted";
        $this->createdby         =  "createdby";
        $this->modifiedby        =  "modifiedby";
    }
}