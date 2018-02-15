<?php
/**
 User entity related model file
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     17-07-2017
 * @Last Modified 17-07-2017
 * @Last Modified By Vijay kumar basu
 */
require_once 'Common_model.php';

class Userdetails_model extends Common_model {

    var $id;
    var $user_id;
    var $batch_start_date;
    var $application_no;
    var $guardian_name;
    var $branch;
    var $village;
    var $block;
    var $district;
    var $date_of_birth;
    var $gender;
    var $marital_status;
    var $caste;
    var $child_0_to_6;
    var $child_7_to_14;
    var $child_care_by;	
    var $bpl_status;	
    var $religion;	
    var $highest_qualification;	
    var $institution_name;	
    var $instruction_language;	
    var $passed_year;	
    var $family_monthly_income;	
    var $user_monthly_income;	
    var $shg_member;	
    var $hours_available;	
    var $no_of_households;	
    var $introducer_name;	
    var $designation;	
    var $reason_refer;	
    var $co_ordinator_id;	
    var $apl_bpl;	
    var $bank_account_status;	
    var $status;  //0=inactive , 1=active, 2=notverified
    var $deleted;
    var $createdby;
    var $modifiedby;
    
    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
         //setting the table name
        $this->setTableName("user_details");
        //Giving alias names to table field names
        $this->_setFieldNames();
    }
    

   //Set the field values
    private function _setFieldNames() {
        $this->id                       =   'id';
        $this->user_id                  =   'user_id';
        $this->batch_start_date         =   'batch_start_date';
        $this->application_no           =   'application_no';
        $this->guardian_name            =   'guardian_name';
        $this->branch                   =   'branch';
        $this->village                  =   'village';
        $this->block                    =   'block';
        $this->district                 =   'district';
        $this->date_of_birth            =   'date_of_birth';
        $this->gender                   =   'gender';
        $this->marital_status           =   'marital_status';
        $this->caste                    =   'caste';
        $this->child_0_to_6             =   'child_0_to_6';
        $this->child_7_to_14            =   'child_7_to_14';
        $this->child_care_by            =   'child_care_by';	
        $this->bpl_status               =   'bpl_status';	
        $this->religion                 =   'religion';	
        $this->highest_qualification    =   'highest_qualification';	
        $this->institution_name         =   'institution_name';	
        $this->instruction_language     =   'instruction_language';	
        $this->passed_year              =   'passed_year';	
        $this->family_monthly_income    =   'family_monthly_income';	
        $this->user_monthly_income      =   'user_monthly_income';	
        $this->shg_member               =   'shg_member';	
        $this->hours_available          =   'hours_available';	
        $this->no_of_households         =   'no_of_households';	
        $this->introducer_name          =   'introducer_name';	
        $this->designation              =   'designation';	
        $this->reason_refer             =   'reason_refer';	
        $this->co_ordinator_id          =   'co_ordinator_id';	
        $this->apl_bpl                  =   'apl_bpl';	
        $this->bank_account_status      =   'bank_account_status';	
        $this->status                   =   'status';  //0=inactive , 1=active, 2=notverified
        $this->deleted                  =   'deleted'; 
        $this->createdby                =   'createdby'; 
        $this->modifiedby               =   'modifiedby'; 
    
    }
    
   

    
    

}
?>