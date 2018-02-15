<?php
/**
 Countries entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By Pandu Babu
 */
require_once 'Common_model.php';
class Doctorfeedback_model  extends Common_model{
    var $id;
    var $medicalIncidentVisitId;
    var $comments;
    var $isRetake;
    var $retakeStatus;
    var $createdby;
    var $modifiedby;
    var $cts;
    var $mts;
    var $status;
    var $deleted;
    
    
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("doctor_feedback");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id                       =  "id";
        $this->medicalIncidentVisitId   =  "medical_incident_visit_id";
        $this->comments                 =  "comments";
        $this->isRetake                 =  "is_retake";
        $this->retakeStatus             =  "retake_status";
        $this->createdby                =  "createdby";
        $this->modifiedby               =  "modifiedby";
        $this->cts                      =  "cts";
        $this->mts                      =  "mts";
        $this->status                   =  "status";
        $this->deleted                  =  "deleted";
       
    }
}
