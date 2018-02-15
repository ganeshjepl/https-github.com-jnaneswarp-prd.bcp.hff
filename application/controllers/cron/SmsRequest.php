<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH . 'handlers/Sms_handler.php');
require_once (APPPATH . 'handlers/Received_sms_handler.php');


class SmsRequest extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getGatewayReceivedSMS() {
		try {
			$this->smsHandler = new Sms_handler();
			$this->receivedsmsHandler = new Received_sms_handler();
			require_once (APPPATH . 'handlers/Received_sms_synctime_handler.php');
			$this->receivedSmsSyncTimeHandler = new Received_sms_synctime_handler();
			$this->config->load('aws-sns');
			$inbox_id = $this->config->item('TEXTLOCAL_RECEIVING_INBOXID');
			$latestSyncData = $this->receivedSmsSyncTimeHandler->getLatestSyncTime($inbox_id);
			if($latestSyncData['status']) {
				$latestSyncDateTime = $latestSyncData['response']['syncData'][0]['latestSyncTime'];
				$latestSyncDateTime = strtotime($latestSyncDateTime);
				$receivedSmsData = $this->smsHandler->getGatewayReceivedSMS($latestSyncDateTime);
				if($receivedSmsData['status']) {
					$receiveSaveResponse = $this->receivedsmsHandler->saveMessage($receivedSmsData['response']['smsData']);
					if($receiveSaveResponse['status']) {
						$this->receivedSmsSyncTimeHandler->updateLatestSyncTime($receivedSmsData['response']['smsData']);
					}
				}
				else {
					$output['status'] = FALSE;
					$output['response']['smsData'] = array();
					$output['response']['messages'] = array();
					$output['response']['total'] = 0;
					$output['statusCode'] = STATUS_NO_DATA;
					return $output;
				}
			}
		} catch (Exception $e) {
			$output['status'] = FALSE;
			$output['response']['smsData'] = array();
			$output['response']['messages'] = array();
			$output['response']['total'] = 0;
			$output['statusCode'] = STATUS_NO_DATA;
			return $output;
		}
    }
	
	
	public function processPresRXGatewayReceivedSMS() {
		try {
			$this->receivedsmsHandler = new Received_sms_handler();
			$this->receivedsmsHandler->getOpenMessage();
	} catch (Exception $e) {
			$output['status'] = FALSE;
			$output['response']['smsData'] = array();
			$output['response']['messages'] = array();
			$output['response']['total'] = 0;
			$output['statusCode'] = STATUS_NO_DATA;
			return $output;
		}
	}
	
}

?>
