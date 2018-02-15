<?php
/**
 Taxonomy entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             20-04-2017
 * @Last Modified       20-04-2017
 * @Last Modified  By   shivajyothi Kandukuri
 */
require_once 'Common_model.php';

class Taxonomy_model extends Common_model {
    var $id;
    var $name;
    var $code   ;
    var $status   ;
    var $order   ;
    var $deleted   ;
    var $createdby   ;
    var $modifiedby  ;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("taxonomy");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
      //set the field values 
    private function _setFieldNames(){
        
        $this->id          =  "id" ;
        $this->name        =  "name";
        $this->code        =  "code";
        $this->status      =  "status";
        $this->order       =  "order";
        $this->deleted     =  "deleted";
        $this->createdby   =  "createdby";
        $this->modifiedby  =  "modifiedby";
        
    }
}