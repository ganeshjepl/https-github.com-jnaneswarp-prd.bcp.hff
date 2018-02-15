<?php
/**
 User role entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By  shivajyothi Kandukuri
 */
require_once 'Common_model.php';
class Userrole_model  extends Common_model{
    var $id;
    var $userId	;
    var $role   ;
    var $deleted   ;
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("user_role");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id          =  "id" ;
        $this->userId      =  "user_id";
        $this->role        =  "role";
        $this->deleted     =  "deleted";
    }
}
