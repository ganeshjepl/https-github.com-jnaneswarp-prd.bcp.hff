<?php

/* States related business logic will be defined in this class
 * @package		CodeIgniter
 * @author		JEPL Development Team
 * @copyright	        Copyright (c) 2017, JEPL.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-11-2017
 * @Last Modified By    Sridevi
 */
require_once (APPPATH . 'handlers/handler.php');
require_once(APPPATH . 'handlers/email_handler.php');
require_once(APPPATH . 'handlers/Sms_handler.php');

class Messagetemplate_handler extends Handler {

    var $ci;
    public $emailHandler;
    public $userHandler;
    public $sentmessageHandler;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Messagetemplate_model');

        $this->emailHandler = new Email_handler();
    }

    ///public function sendMessageWithTemplate($languageId="", $type="", $mode="") {
    public function sendMessageWithTemplate($otpCode = "", $languageId = "", $type = "", $mode = "", $toEmail = "", $toMobile = "", $userId = "") {
        
        if ($otpCode != "" && $languageId != "" && ($toEmail != "" || $toMobile != "")) {
            
            $this->ci->Messagetemplate_model->resetVariable();
            $selectInput = array();
            $templateData = array();
            $where = array();
            $like = array();
            $selectInput['id'] = $this->ci->Messagetemplate_model->id;
            $selectInput['template'] = $this->ci->Messagetemplate_model->template;
            $selectInput['type'] = $this->ci->Messagetemplate_model->type;
            $selectInput['subject'] = $this->ci->Messagetemplate_model->subject;
            $selectInput['mode'] = $this->ci->Messagetemplate_model->mode;
            $selectInput['fromemailid'] = $this->ci->Messagetemplate_model->fromemailid;
            $selectInput['params'] = $this->ci->Messagetemplate_model->params;
            $selectInput['countryid'] = $this->ci->Messagetemplate_model->countryid;
            $selectInput['languageid'] = $this->ci->Messagetemplate_model->languageid;

            $this->ci->Messagetemplate_model->setSelect($selectInput);
            $where[$this->ci->Messagetemplate_model->deleted] = 0;

            if ($type != "") {
                $where[$this->ci->Messagetemplate_model->type] = $type;
            }
            if ($mode != "") {
                $where[$this->ci->Messagetemplate_model->mode] = $mode;
            }
            if ($languageId != "") {
                $where[$this->ci->Messagetemplate_model->languageid] = $languageId;
            }
            ///print_r($where); exit;

            $this->ci->Messagetemplate_model->setWhere($where);
            //$this->ci->Messagetemplate_model->setRecords(1);
            $templateData = $this->ci->Messagetemplate_model->get();
//            print_r($templateData); exit;

            if (count($templateData) == 0) {
                //log_message("error", $this->ci->lang->line('error_message_template_not_found_message'));
                
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->ci->lang->line('error_message_template_not_found_message');
                $output['response']['total'] = 0;
                $output['statuscode'] = STATUS_NO_DATA;
                return $output;
            }

            ///print_r($templateData); exit;

            foreach ($templateData as $val) {
                
                $messageId = $val['id'];
                $mode = $val['mode'];
                $languageid = $val['languageid'];
                $fromEmail = $val['fromemailid'];
                $template = $val['template'];
                $subject = $val['subject'];

                $sentMessageArray = array();
                $sentMessageArray['toUserId'] = $userId;
                //$sentMessageArray['fromUserId'] = $userId;
                $sentMessageArray['message'] = $template;
                $sentMessageArray['messageid'] = $messageId;
                $sentMessageArray['type'] = $mode;
                $sentMessageArray['activity'] = $type;
                $sentMessageArray['emailId'] = "";
                $sentMessageArray['mobileNumber'] = "";
                //print_r($sentMessageArray); exit;        
                if ($mode == "email") {
                    $message = str_replace('{OTPCODE}', $otpCode, $template);
                    if ($fromEmail != "") {
                        $sentMessageArray['emailId'] = $toEmail;
                        //print_r($sentMessageArray); exit;
                        $emailResponse = $this->emailHandler->sendEmailFromAWS($fromEmail, $toEmail, $subject, $message, $attachment = '', $replyto = '', $content = '', $sentMessageArray);
                    
                        if($emailResponse['status'] == FALSE){
                            //log_message("error", $this->ci->lang->line('error_otp_send_email_message'));
                            
                            $output['status'] = FALSE;
                            $output['response']['messages'] = $this->ci->lang->line('error_otp_send_email_message');
                            $output['statusCode'] = STATUS_SERVER_ERROR;
                            return $output;
                        }                      
                    }
                    
                } 
                else if ($mode == "sms") {

                    if ($toMobile != "") {

                        $sentMessageArray['mobileNumber'] = $toMobile;

                        $full_message = '';
                        if ($type == 'prescription') {
                            $fullotpCode = $otpCode;
                            $templates = explode('|message_separator|', $template);
                            if (isset($fullotpCode[0]['visit_code']))
                                $message = str_replace('{VISITCODE}', $fullotpCode[0]['visit_code'], $templates[0]);
                            else
                                $message = str_replace('{VISITCODE}', 'None', $templates[0]);
                            foreach ($fullotpCode as $otpCode) {
//                                $message = str_replace( '{MRNUMBER}', 'vcode#'.$fullotpCode[0]['mr_number'], $template );
                                $message .= str_replace('{MEDICINE}', $otpCode['medicine_name'], $templates[1]);
                                $message = str_replace('{QUANTITY}', $otpCode['quantity'], $message);
                                $message = str_replace('{TIMING}', $otpCode['timing_ids'], $message);
                                $message = str_replace('{DAYS}', $otpCode['days'], $message);
                                $full_message .= $message;
                                $message = '';
                            }
                            $message = $full_message;
                            //debugArray($message); exit;
                        } else if ($type == 'prescriptionrequest') {
							$message = "";
							$message = "HFFBCP: Dear Doctor, You have received a new Prescription Request from BCP:".$otpCode['message_data']['bcp_name']. " for Patient: ".$otpCode['message_data']['patient_name']."(".$otpCode['message_data']['mr_number'].")";
                            //$message = str_replace('{BCPNAME}', $otpCode['message_data']['bcp_name'], $template);
                            //$message = str_replace('{PATIENTNAME}', $otpCode['message_data']['patient_name'], $message);
                            //$message = str_replace('{AGE}', $otpCode['message_data']['age'], $message);
                            //$message = str_replace('{MRNUMBER}', $otpCode['message_data']['mr_number'], $message);
                        } else {
                            $message = str_replace('{OTPCODE}', $otpCode, $template);
                        }
						
                        $this->ci->emailHandler = new Email_handler();                     
                        $mobileResponse = $this->ci->emailHandler->sendSMSFromAWS($toMobile, $message, $sentMessageArray);
                        if($mobileResponse['status'] == FALSE){
                            //log_message("error", $this->ci->lang->line('error_otp_send_mobile_message'));
                            
                            $output['status'] = FALSE;
                            $output['response']['messages'] = $this->ci->lang->line('error_otp_send_mobile_message');
                            $output['statusCode'] = STATUS_SERVER_ERROR;
                            return $output;
                        } 
                        
                    }
                }                
            }
            
            $output['status'] = TRUE;
            $output['response']['messages'] = $this->ci->lang->line('success_otp_sent_message');
            $output['statusCode'] = STATUS_OK;
            return $output;   
           
        }
        else{
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->ci->lang->line('error_invalid_otp_data_message');
            $output['statuscode'] = STATUS_BAD_REQUEST;
            return $output;
        }
    }

    public function sendNotificationWithTemplate($messageDetails, $languageId = "1", $type = '', $mode = 'notification', $deviceInfo) {

//        debugArray($type); exit;
//        $deviceInfo['awsarncode'] = 'arn:aws:sns:us-east-1:264423652605:endpoint/GCM/HFFMOBILEBCP/412799c7-cb87-304c-a783-d53f48be6b25';
        $this->ci->Messagetemplate_model->resetVariable();
        $selectInput = array();
        $templateData = array();
        $where = array();
        $like = array();
        $selectInput['id'] = $this->ci->Messagetemplate_model->id;
        $selectInput['template'] = $this->ci->Messagetemplate_model->template;
        $selectInput['type'] = $this->ci->Messagetemplate_model->type;
        $selectInput['subject'] = $this->ci->Messagetemplate_model->subject;
        $selectInput['mode'] = $this->ci->Messagetemplate_model->mode;
        $selectInput['fromemailid'] = $this->ci->Messagetemplate_model->fromemailid;
        $selectInput['params'] = $this->ci->Messagetemplate_model->params;
        $selectInput['countryid'] = $this->ci->Messagetemplate_model->countryid;
        $selectInput['languageid'] = $this->ci->Messagetemplate_model->languageid;

        $this->ci->Messagetemplate_model->setSelect($selectInput);
        $where[$this->ci->Messagetemplate_model->deleted] = 0;

        if ($type != "") {
            $where[$this->ci->Messagetemplate_model->type] = $type;
        }
        if ($mode != "") {
            $where[$this->ci->Messagetemplate_model->mode] = $mode;
        }
        if ($languageId != "") {
            $where[$this->ci->Messagetemplate_model->languageid] = $languageId;
        }
        ///print_r($where); exit;

        $this->ci->Messagetemplate_model->setWhere($where);
        //$this->ci->Messagetemplate_model->setRecords(1);
        $templateData = $this->ci->Messagetemplate_model->get();

        foreach ($templateData as $template) {
//            debugArray($templateData);
            if ($type == 'prescription') {
                $fullotpCode = $messageDetails;
                $full_message = '';
                $templates = explode('|message_separator|', $template['template']);
                if (isset($fullotpCode[0]['visit_code']))
                    $message = str_replace('{VISITCODE}', $fullotpCode[0]['visit_code'], $templates[0]);
                else
                    $message = str_replace('{VISITCODE}', 'None', $templates[0]);
                foreach ($fullotpCode as $otpCode) {
//                                $message = str_replace( '{MRNUMBER}', 'vcode#'.$fullotpCode[0]['mr_number'], $template );
                    $message .= str_replace('{MEDICINE}', $otpCode['medicine_name'], $templates[1]);
                    $message = str_replace('{QUANTITY}', $otpCode['quantity'], $message);
                    $message = str_replace('{TIMING}', $otpCode['timing_ids'], $message);
                    $message = str_replace('{DAYS}', $otpCode['days'], $message);
                    $full_message .= $message;
                    $message = '';
                }
                $message = $full_message;
//                            debugArray($message); exit;
            } else {
                $message = $template['template'];

                if (isset($messageDetails['bcp_name'])) {
                    $message = str_replace('{BCPNAME}', $messageDetails['bcp_name'], $message);
                }
                if (isset($messageDetails['patient_name'])) {
                    $message = str_replace('{PATIENTNAME}', $messageDetails['patient_name'], $message);
                }
                if (isset($messageDetails['age'])) {
                    $message = str_replace('{AGE}', $messageDetails['age'], $message);
                }
                if (isset($messageDetails['mr_number'])) {
                    $message = str_replace('{MRNUMBER}', $messageDetails['mr_number'], $message);
                }
                if (isset($messageDetails['mvisit_code'])) {
                    $message = str_replace('{MVISITCODE}', $messageDetails['mvisit_code'], $message);
                }
            }

            /*
              $message = str_replace('{BCPNAME}', $messageDetails['bcp_name'], $template['template']);
              $message = str_replace('{PATIENTNAME}', $messageDetails['patient_name'], $message);
              $message = str_replace('{AGE}', $messageDetails['age'], $message);
              $message = str_replace('{MRNUMBER}', $messageDetails['mr_number'], $message);
             */
//           debugArray($deviceInfo); exit;
            $status = $this->emailHandler->sendNotificatoinFromAWS($message, $deviceInfo);
            //$status = $this->emailHandler->sendNotificatoinFromAWS($from, $to, $subject, $message, $deviceInfo);
        }
        if (count($templateData) == 0) {
            //log_message("error", $this->ci->lang->line('error_message_template_not_found_message'));
            
            $output['status'] = FALSE;
            ///$output['response']['message'][] = ERROR_MESSAGE_TEMPLATE;
            $output['response']['messages'][] = $this->ci->lang->line('error_message_template_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }


        $output['status'] = TRUE;
        ///$output['response']['messages'] = ERROR_INVALID_DATA;
        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
        $output['response']['total'] = 0;
        $output['statuscode'] = STATUS_BAD_REQUEST;
        return $output;
    }

    public function insertMessageDetail($inputMessageArray = "") {

        require_once (APPPATH . 'handlers/User_handler.php');

        $this->userHandler = new User_handler();

        if ($inputMessageArray != "") {

            $responseArray = userLoginCheck();
            if ($responseArray['status'] == 1) {
                if ($responseArray['response']['total'] > 0) {
                    $fromUserId = $responseArray['response']['sessionData']['userid'];
                } else {
                    $userDetails = $this->userHandler->getUserProfile($id = "", $role_fiter = 'admin');
                    $fromUserId = $userDetails['response']['userData'][0]['id'];
                }
            } else {
                $userDetails = $this->userHandler->getUserProfile($id = "", $role_fiter = 'admin');
                $fromUserId = $userDetails['response']['userData'][0]['id'];
            }

            $inputMessageArray['fromUserId'] = $fromUserId;

            if (isset($inputMessageArray['toUserId']) && !empty($inputMessageArray['toUserId'])) {
                require_once (APPPATH . 'handlers/Sentmessage_handler.php');
                $this->ci->sentmessageHandler = new Sentmessage_handler();

                $sentMessageId = $this->ci->sentmessageHandler->saveSentMessage($inputMessageArray);
            }
        }
    }

}

?>
