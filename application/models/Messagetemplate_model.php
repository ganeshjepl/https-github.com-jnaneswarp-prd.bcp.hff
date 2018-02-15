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

class Messagetemplate_model extends Common_model {

    var $id;
    var $template;
    var $type;
    var $subject;
    var $mode;
    var $fromemailid; 
    var $params; 
    var $countryid; 
    var $languageid; 
    var $cts; 
    var $mts;    
    var $createdby;    
    var $modifiedby;    
    var $deleted;   
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("messagetemplate");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id = "id";
        $this->template = "template";
        $this->type = "type";
        $this->subject = "subject";
        $this->mode = "mode";
        $this->fromemailid = "fromemailid";
        $this->params = "params";
        $this->countryid = "countryid";
        $this->languageid = "languageid";
        $this->cts = "cts";  
        $this->mts = "mts";         
        $this->createdby = "createdby";
        $this->modifiedby = "modifiedby";
        $this->deleted = "deleted";  
    }
    
   

    
    

}
?>