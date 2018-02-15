<?php
/**
 Country entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By  shivajyothi Kandukuri
 */
require_once 'Common_model.php';
class Networkhospital_model  extends Common_model{
    var $id;
    var $name;
    var $address;
    var $countryId;
    var $stateId;
    var $geoLatitude;
    var $geoLongitude;
    var $type;
    var $zipcode; 
    var $contactNumber;
    var $website;
    var $mts;
    var $status;
    var $deleted;
     
     
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("network_hospital");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id             =  "id" ;
        $this->name           =  "name";
        $this->address        =  "address";
        $this->zipcode        =  "zipcode";
        $this->countryId      =  "country_id";
        $this->stateId        =  "state_id";
        $this->geoLatitude    =  "geo_latitude";
        $this->geoLongitude   =  "geo_longitude";
        $this->type           =  "type";
        $this->contactNumber  =  "contact_number";
        $this->website  =  "website";
        $this->mts  =  "mts";
        $this->status  =  "status";
        $this->deleted  =  "deleted";
  }
}
