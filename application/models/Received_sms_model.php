<?php
require_once 'Common_model.php';

class Received_sms_model extends Common_model {

    var $id;
    var $fromUserId;
    var $message;
    var $fromMobileNumber;
    var $fromEmailId;
    var $localTextMessageid;
	var $localTextInboxid;
    var $activity;
	var $smsSentDate;
    var $createdby;
    var $modifiedby;
    var $cts;
    var $mts;
    var $status;

    public function __construct() {
        parent::__construct();
        //setting the table name
        $this->setTableName("received_sms");        
        //Giving alias names to table field names
        $this->_setFieldNames();
    }

    private function _setFieldNames() {
        $this->id = "id";
        $this->fromUserId = "from_user_id";
        $this->message = "message";
        $this->fromMobileNumber = "from_mobile_number";
        $this->fromEmailId = "from_email_id";
        $this->localTextMessageid = "local_text_messageid";
		$this->localTextInboxid = "local_text_inboxid";
        $this->activity = "activity";
		$this->smsSentDate = "sms_sent_date";
        $this->createdby = "createdBy";
        $this->modifiedby = "modifiedBy";
        $this->status = "status";
		$this->cts = "cts";
		$this->mts = "mts";
    }

}
