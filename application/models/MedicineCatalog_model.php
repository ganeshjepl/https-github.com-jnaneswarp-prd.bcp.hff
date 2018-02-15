<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Common_model.php';

class MedicineCatalog_model extends Common_model{
    //var idid, name, brand, generic_name, dosage, batch_number, expiry_date, indications, quantity, stock, cts, mts

    var $id;
    var $name;
    var $brand;
    var $generic_name;
    var $dosage;
    var $batch_number;
    var $expiry_date;
    var $indications;
    var $quantity;
    var $stock;
    var $createdby;
    var $modifiedby;
    var $status;
    var $deleted;
    var $cts;
    var $mts;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("medicine_catalog");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    
    private function _setFieldNames(){
        $this->id          =  "id";
        $this->name        =  "name";
        $this->brand       =  "brand";
        $this->generic_name=  "generic_name";        
        $this->dosage      =  "dosage";
        $this->batch_number=  "batch_number";
        $this->expiry_date =  "expiry_date";
        $this->indications =  "indications";
        $this->quantity    =  "quantity";
        $this->stock       =  "stock";
        $this->createdby   =  "createdby";
        $this->modifiedby  =  "modifiedby";
        $this->status      =  "status";
        $this->deleted     =  "deleted";
        $this->cts         =  "cts";
        $this->mts         =  "cts";
       
    }
    
}