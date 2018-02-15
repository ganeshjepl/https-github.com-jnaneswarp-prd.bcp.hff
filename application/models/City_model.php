<?php
/**
 Cities entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By Pandu Babu
 */
require_once 'Common_model.php';
class City_model  extends Common_model{
    var $id;
    var $name;
    var $stateId;
    var $featured;
    var $status;
    var $order;
    var $deleted;
    var $createdby;
    var $modifiedby;
    var $cts;
    var $mts;
    
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("city");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id          =  "id";
        $this->name        =  "name";
        $this->stateId     =  "state_id";        
        $this->featured    =  "featured";
        $this->status      =  "status";
        $this->order       =  "order";
        $this->deleted     =  "deleted";
        $this->createdby   =  "createdby";
        $this->modifiedby  =  "modifiedby";
        $this->cts         =  "cts";
        $this->mts         =  "cts";
       
    }
}
