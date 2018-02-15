<?php
/**
 Medical record history  entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 20-04-2017
 * @Last Modified By  shivajyothi Kandukuri
 */
require_once 'Common_model.php';
class Medicalrecordhistory_model  extends Common_model{
    var $id;
    var $medicalRecordId	;
    var $prescriptionId ;
    var $prescriptionDetail;
    var $surveyId  ;
    var $registrationDate   ;
    var $remarks;
    var $reviewStatus;
    var $reviewedby   ;
    var $deleted   ;
    var $createdby  ;
    var $modifiedby  ;
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("medical_record_history");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }
    //set the field values 
    private function _setFieldNames(){
        $this->id                        =  "id" ;
        $this->medicalRecordId           =  "medical_record_id";
        $this->prescriptionId            =  "prescription_id";
        $this->prescriptionDetail        =  "prescription_detail";
        $this->registrationDate          =  "registration_date";
        $this->remarks                   =  "remarks";
        $this->reviewStatus              =  "review_status";
        $this->reviewedby                =  "reviewedby";
        $this->deleted                   =  "deleted";
        $this->createdby                 =  "createdby";
        $this->modifiedby                =  "modifiedby";
   }
}



