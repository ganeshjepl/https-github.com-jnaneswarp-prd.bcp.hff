<?php
require_once 'Common_model.php';

class Received_sms_synctime_model extends Common_model {

    var $id;
    var $localTextInboxid;
    var $lastSyncTimestamp;
    var $createdby;
    var $modifiedby;
    var $cts;
    var $mts;
    

    public function __construct() {
        parent::__construct();
        //setting the table name
        $this->setTableName("received_sms_synctime");        
        //Giving alias names to table field names
        $this->_setFieldNames();
    }

    private function _setFieldNames() {
        $this->id = "id";
       $this->localTextInboxid = "local_text_inboxid";
       $this->lastSyncTimestamp = "last_sync_timestamp";
        $this->createdby = "createdBy";
        $this->modifiedby = "modifiedBy";
        $this->status = "status";
		$this->cts = "cts";
		$this->mts = "mts";
    }

}
