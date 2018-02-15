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
class Bcpassignment_model  extends Common_model{
    var $id;
    var $doctorId;
    var $bcpId;
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
        $this->setTableName("bcp_assignment");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id           =  "id";
        $this->doctorId    =  "doctor_id";
        $this->bcpId       =  "bcp_id";
        $this->createdby    =  "createdby";
        $this->modifiedby   =  "modifiedby";
        $this->cts          =  "cts";
        $this->mts          =  "cts";
        $this->status       =  "status";
        $this->deleted       =  "deleted";
       
    }
}
