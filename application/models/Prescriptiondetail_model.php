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
class Prescriptiondetail_model  extends Common_model{
    var $id;
    var $prescriptionId;
    var $medicineId;
    var $dosage;
    var $quantity;
    var $timingsIds;
    var $days;
    var $dispenceQuantity;
    var $dispenceDate;
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
        $this->setTableName("prescription_detail");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id                   =  "id";
        $this->prescription_Id      =  "prescription_id";
        $this->medicineId           =  "medicine_id";
        $this->dosage               =  "dosage";
        $this->quantity             =  "quantity";
        $this->timingsIds           =  "timings_ids";
        $this->days                 =  "days";
        $this->dispenceQuantity     =  "dispence_quantity";
        $this->dispenceDate         =  "dispence_date";
        $this->createdby            =  "createdby";
        $this->modifiedby           =  "modifiedby";
        $this->cts                  =  "cts";
        $this->mts                  =  "cts";
        $this->status               =  "status";
        $this->deleted              =  "deleted";
       
    }
}
