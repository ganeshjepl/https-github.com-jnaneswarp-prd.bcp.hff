<?php

/* SMS Gateway received SMS Synctime related logic be defined in this class
 * @package		CodeIgniter
 * @author		JEPL Development Team
 * @copyright	Copyright (c) 2017, JEPL.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       25-11-2017
 * @Last Modified By    Sridevi
 */
require_once (APPPATH . 'handlers/handler.php');

class Received_sms_synctime_handler extends Handler {

    var $ci;
    
    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Received_sms_synctime_model');
    }
    
    public function updateLatestSyncTime($inputMessageArray = ""){
		try {
        	$this->ci->load->model('Received_sms_synctime_model');
			$this->ci->Received_sms_synctime_model->resetVariable();
			$lastSyncTime = date('Y-m-d h:m:s', $inputMessageArray->max_time); 
			$this->ci->Received_sms_synctime_model->insertUpdateArray[$this->ci->Received_sms_synctime_model->localTextInboxid] = $inputMessageArray->inbox_id;
			$this->ci->Received_sms_synctime_model->insertUpdateArray[$this->ci->Received_sms_synctime_model->lastSyncTimestamp] = $lastSyncTime;
			$update_array[$this->ci->Received_sms_synctime_model->lastSyncTimestamp] = $lastSyncTime;
			$sentMessageId = $this->ci->Received_sms_synctime_model->insert_update_onduplicate_data($update_array);
			$output['status'] = TRUE;
			return $output;
		} catch (Exception $e) {
			$output['status'] = FALSE;
			return $output;
		}		

    }
    
    public function getLatestSyncTime($inboxId = ""){
		try {
        	$this->ci->load->model('Received_sms_synctime_model');
			$this->ci->Received_sms_synctime_model->resetVariable();
			$selectInput =array();
			$selectInput['latestSyncTime'] = $this->ci->Received_sms_synctime_model->lastSyncTimestamp;
			$where[$this->ci->Received_sms_synctime_model->localTextInboxid] = $inboxId;
			$this->ci->Received_sms_synctime_model->setSelect($selectInput);
			$this->ci->Received_sms_synctime_model->setWhere($where); 
			$lastSyncData = $this->ci->Received_sms_synctime_model->get();
			$output['status']=TRUE;
			$output['response']['syncData'] = $lastSyncData;
            $output['response']['messages'][] = array();
            $output['response']['total']=count($lastSyncData);
            $output['statuscode']  = STATUS_OK ;
            return $output ;
		} catch (Exception $e) {
			$output['status']=FALSE;
			$output['response']['syncData'] = array();
            $output['response']['messages'][] = array();
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
		}		

    }
    
}


?>