<?php

/**
 * email related business logic will be defined in this class
 *
 * @package		CodeIgniter
 * @author		Qison  Dev Team
 * @copyright	Copyright (c) 2015, MeraEvents.
 * @Version		Version 1.0
 * @Since       Class available since Release Version 1.0 
 * @Created     17-07-2015
 * @Last Modified 17-07-2015
 */
require_once(APPPATH . 'handlers/handler.php');
require_once (APPPATH . 'libraries/Textlocal.php');

///require_once(APPPATH . 'handlers/sentmessage_handler.php');
require_once(APPPATH . 'handlers/Messagetemplate_handler.php');

class Sms_handler extends Handler {

    var $ci, $messagetemplateHandler;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
		$this->ci->config->load('aws-sns');
		
			
    }

	public function sendSMS($phoneNumber, $message, $sentMessageArray = array()) {
	
		if ($this->ci->config->Item('smsEnable') == true) {
			
			$textLocalAPiKey = $this->ci->config->item('TEXTLOCAL_APIKEY');
			$senderId = $this->ci->config->item('TEXTLOCAL_SENDERID'); 
			$this->messagetemplateHandler = new Messagetemplate_handler();
			$Textlocal = new Textlocal(false, false, $textLocalAPiKey);
			$numbers = array($phoneNumber);
			$sender = $senderId;
			$message = $message;
			$response = $Textlocal->sendSms($numbers, $message, "TXTLCL");
			if (!$smsStatus) {
                $output['status'] = FALSE;
                $output['response']['messages'][] = $this->ci->lang->line('error_sms_not_sent_message');
                $output['statusCode'] = STATUS_SMS_NOT_SENT;
                return $output;
			} else {
                $output['status'] = TRUE;
                $output['response']['messages'][] = $this->ci->lang->line('success_sms_sent_message');
                $output['statusCode'] = STATUS_OK;
                return $output;
			}
		}
		$output['status'] = TRUE;
		$output['response']['messages'][] = $this->ci->lang->line('error_sms_send_not_enabled_message');
		$output['statusCode'] = STATUS_SERVICE_DISABLED;
		return $output;

	}
	
	
	public function getGatewayReceivedSMS($latestSyncDateTime) {
		$textLocalAPiKey = $this->ci->config->item('TEXTLOCAL_APIKEY');
		try {
			$Textlocal = new Textlocal(false, false, $textLocalAPiKey);
			$inbox_id = $this->ci->config->item('TEXTLOCAL_RECEIVING_INBOXID');
			if($latestSyncDateTime > 0) {
			
			}
			$response = $Textlocal->getMessages($inbox_id,$latestSyncDateTime);
			
			if(count($response) > 0) {
			
				$output['status'] = TRUE;
				$output['response']['smsData'] = $response;
				$output['response']['messages'] = array();
				$output['response']['total'] = count($response);
				$output['statusCode'] = STATUS_OK;
				return $output;
			}
		} catch (Exception $e) {
			$output['status'] = FALSE;
				$output['response']['smsData'] = array();
				$output['response']['messages'] = array();
				$output['response']['total'] = 0;
				$output['statusCode'] = STATUS_NO_DATA	;
				return $output;
		}
	}
	
   
}
