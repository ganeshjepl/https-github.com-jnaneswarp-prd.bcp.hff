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

class Survey_model extends Common_model {

    var $id;
    var $name;
    var $parentId;
    var $type;
    var $status;  //0=inactive , 1=active, 2=notverified
    var $deleted;
    var $order;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("survey");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id = "id";
        $this->name = "name";
        $this->parentId = "parentid";
        $this->type = "type";
        $this->order = "order";
        $this->status = "status";
        $this->deleted = "deleted";
 
    }

    
    

}
?>