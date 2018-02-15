<?php
require_once 'Common_model.php';

class Sentmessage_model extends Common_model {

    var $id;
    var $toUserId;
    var $fromUserId;
    var $message;
    var $type;
    var $mobileNumber;
    var $emailId;
    var $messageid;
    var $activity;
    var $createdby;
    var $modifiedby;
    var $cts;
    var $mts;
    var $status;

    public function __construct() {
        parent::__construct();
        //setting the table name
        $this->setTableName("sentmessage");        
        //Giving alias names to table field names
        $this->_setFieldNames();
    }

    private function _setFieldNames() {
        $this->id = "id";
        $this->toUserId = "to_user_id";
        $this->fromUserId = "from_user_id";
        $this->message = "message";
        $this->type = "type";
        $this->mobileNumber = "mobile_number";
        $this->emailId = "email_id";
        $this->messageid = "messageid";
        $this->activity = "activity";
        $this->createdby = "createdBy";
        $this->modifiedby = "modifiedBy";
        $this->status = "status";
    }

}
