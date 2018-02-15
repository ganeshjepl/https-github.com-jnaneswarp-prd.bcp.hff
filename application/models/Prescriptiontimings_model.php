<?php
/**
 Prescription details related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     15-07-2017
 * @Last Modified 15-07-2017
 * @Last Modified By Vijay kumar Basu
 */
require_once 'Common_model.php';
class Prescriptiontimings_model  extends Common_model{
    var $id;
    var $name;
    var $type;
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
        $this->setTableName("prescription_requests");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id           =  "id";
        $this->name         =  "name";
        $this->type         =  "type";
        $this->createdby    =  "createdby";
        $this->modifiedby   =  "modifiedby";
        $this->cts          =  "cts";
        $this->mts          =  "cts";
        $this->status       =  "status";
        $this->deleted      =  "deleted";
       
    }
}
