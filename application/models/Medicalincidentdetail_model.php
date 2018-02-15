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

class Medicalincidentdetail_model extends Common_model {

    var $id;
    var $medicalIncidentId;
    var $type;
    var $medicalIncidentDetailStatus;
    var $surveyId;
    var $status;
    var $deleted;
    var $createdby;
    var $modifiedby;

    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("medical_incident_detail");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }

    //set the field values 
    private function _setFieldNames() {
        $this->id = "id";
        $this->medicalIncidentId = "medical_incident_id";
        $this->type = "type";
        $this->medicalIncidentDetailStatus = "medical_incident_detail_status";
        $this->surveyId = "survey_id";
        $this->status = "status";
        $this->deleted = "deleted";
        $this->createdby = "createdby";
        $this->modifiedby = "modifiedby";
    }

}
