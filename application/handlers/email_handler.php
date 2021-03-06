<?php

/**
 * email related business logic will be defined in this class
 *
 * @package		CodeIgniter
 * @author		JEPL  Dev Team
 * @copyright	Copyright (c) 2015, JEPL.
 * @Version		Version 1.0
 * @Since       Class available since Release Version 1.0 
 * @Created     17-07-2017
 * @Last Modified 25-11-2017
 */
require_once(APPPATH . 'handlers/handler.php');

///require_once(APPPATH . 'handlers/sentmessage_handler.php');
require_once(APPPATH . 'handlers/Messagetemplate_handler.php');

class Email_handler extends Handler {

    var $ci, $messagetemplateHandler;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->library('email');
    }

    //Function to send email with pdf 'path'
    function sendEmailFromAWS($from, $to, $subject, $message, $attachment = '', $replyto = '', $content = NULL, $sentMessageArray = array()) {

        if ($this->ci->config->Item('emailEnable') == true) {

            $this->messagetemplateHandler = new Messagetemplate_handler();

            $this->ci->config->load('aws-ses');
            $config = $this->ci->config->item('aws-ses');
            $this->ci->email->initialize($config);
            $this->ci->email->from($from);
            if (!empty($replyto)) {
                $this->ci->email->reply_to($replyto);
            }
            $this->ci->email->to($to);
            $this->ci->email->subject($subject);
            $this->ci->email->message($message);
            // $cc = '';
            $bcc = '';
            $uid = time();
            if (!empty($attachment)) {
                $this->ci->email->attach($attachment);
            }
            $status = $this->ci->email->send();
            //print_r($status);
            //print_r($this->ci->email->print_debugger()); exit;           
            $sentMessageArray['status'] = $status;
            $sendMessage = $this->messagetemplateHandler->insertMessageDetail($sentMessageArray);
            if ($status) {
                $output['status'] = TRUE;
                $output["response"]['email'] = $to;
                $output["response"]['messages'] = $this->ci->lang->line('success_email_sent_message');
                $output['statusCode'] = STATUS_OK;
                return $output;
            } else {
                $output['status'] = FALSE;
                $output['response']['messages'] = $this->ci->lang->line('error_email_sent_message');
                $output['statusCode'] = STATUS_SERVER_ERROR;
                return $output;
            }
        }

        $output['status'] = TRUE;
        $output['response']['messages'] = $this->ci->lang->line('error_send_email_not_enabled_message');
        $output['statusCode'] = STATUS_SERVICE_DISABLED;
        return $output;
    }

    function sendNotificatoinFromAWS($message, $deviceInfo, $from = "", $to = "", $subject = "", $attachment = '', $replyto = '', $content = NULL, $sentMessageArray = array()) {
//        debugArray($this->ci->config->Item('notificationEnable')); exit;
        if ($this->ci->config->Item('notificationEnable') == true) {
            $this->messagetemplateHandler = new Messagetemplate_handler();

            include_once(APPPATH . 'libraries/aws/aws-autoloader.php');
            $this->ci->config->load('aws-sns');
            $snsClient = Aws\Sns\SnsClient::factory(array(
                        'credentials' => array(
                            'key' => $this->ci->config->Item('AWS_SNS_KEY_ID'),
                            'secret' => $this->ci->config->Item('AWS_SNS_SECRET'),
                        ),
                        'version' => $this->ci->config->Item('AWS_SNS_CLIENT_VERSION'),
                        'region' => $this->ci->config->Item('AWS_SNS_REGION')
            ));
            $result = $snsClient->setSMSAttributes([
                'attributes' => array('DefaultSMSType' => $this->ci->config->Item('AWS_SNS_SMS_TYPE')), // REQUIRED
            ]);
            //$EndpointArn = "arn:aws:sns:us-east-1:264423652605:endpoint/GCM/HFFMOBILEBCP/8a350277-6de8-3e31-9f42-2cdfc45d6c00";
//            debugArray($message); exit;
            $EndpointArn = $deviceInfo['awsarncode'];
            $jsonData = '{
                                "GCM": "{ \"data\": { \"message\": \"' . $message . '\" } }"
                                }';
            $payload = array(
                'TargetArn' => $EndpointArn,
                'Message' => $jsonData,
                'MessageStructure' => 'json',
            );
            $result = $snsClient->publish($payload);
            $result = (array) $result;
            $messageId = $result[' Aws\Result data']['MessageId'];
            $smsStatus = 0;
            if (!is_null($messageId)) {
                $smsStatus = 1;
            }


//                            try {
//
//                       
//                              
//                     } catch ( Exception $e ) {
//                      //  echo “Send Failed!\n" . $e->getMessage();
//                            }
            //print_r($status);
            //print_r($this->ci->email->print_debugger()); exit;           
            $sentMessageArray['status'] = $smsStatus;
            $sendMessage = $this->messagetemplateHandler->insertMessageDetail($sentMessageArray);
            if ($smsStatus) {
                $output['status'] = TRUE;
                $output["response"]['email'] = $to;
                $output["response"]['messages'][] = $this->ci->lang->line('success_email_sent_message');
                $output['statusCode'] = STATUS_OK;
                return $output;
            } else {
                $output['status'] = FALSE;
                //$output["response"]['messages'][] = ERROR_EMAIL_NOT_SENT;
                $output['response']['messages'][] = $this->ci->lang->line('error_email_sent_message');
                $output['statusCode'] = STATUS_SERVER_ERROR;
                return $output;
            }
        }

        $output['status'] = FALSE;
        ///$output['response']['messages'][] = ERROR_EMAIL_SEND_NOT_ENABLED;
        $output['response']['messages'][] = $this->ci->lang->line('error_send_email_not_enabled_message');
        $output['statusCode'] = STATUS_SERVICE_DISABLED;
        return $output;
    }

    //Function to send email with pdf 'path'
    function sendEmail($from, $to, $subject, $message, $attachment = '', $replyto = '', $content = NULL, $sentMessageArray = array()) {
        if ($this->ci->config->Item('emailEnable') == true) {
            //CODE RELATED TO MANDRILL MAIL   
            $this->ci->email->from($from);
            $this->ci->email->reply_to($replyto);
            $this->ci->email->to($to);
            $this->ci->email->subject($subject);
            $this->ci->email->message($message);
            // $cc = '';
            $bcc = '';
            $uid = time();
            if (!empty($attachment)) {
                $this->ci->email->attach($attachment);
            }
            $mailResponse = $this->ci->email->send();
            if ($mailResponse) {
                $mailStatus = $mailResponse;
            } else {//If mandrilla mail send failed
                //MANUAL MAIL SENDING                 
                $email_txt = $message; // Message that the email has in it     
                $headers = "From: " . $from;
                $data = $fileatt = $fileatt_type = $fileatt_name = $data = '';
                if ($attachment) {
                    $fileatt = $attachment; // Path to the file
                    $fileatt_type = "application/octet-stream"; // File Type 
                    $start = strrpos($attachment, '/') == -1 ? strrpos($attachment, '//') : strrpos($attachment, '/') + 1;
                    $fileatt_name = substr($attachment, $start, strlen($attachment)); // Filename that will be used for the file as the attachment 
                    $file = fopen($fileatt, 'rb');
                    $data = fread($file, filesize($fileatt));
                    fclose($file);
                }
                $semi_rand = md5(time());
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
                $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
                $email_message .= "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type:text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $email_txt . "\n\n";
                $data = chunk_split(base64_encode($data));
                $email_message .= "--{$mime_boundary}\n" . "Content-Type: {$fileatt_type};\n" . " name=\"{$fileatt_name}\"\n" . //"Content-Disposition: attachment;\n" . //" filename=\"{$fileatt_name}\"\n" . "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n" . "--{$mime_boundary}--\n";
                        $mailStatus = mail($to, $subject, $email_message, $headers);
            }
            $sentMessageArray['status'] = $mailStatus;
            if (!isset($sentMessageArray['notInsertIntoSentMessage'])) {//There are some emails which are not needed to be inserted in to sentmessages
                $this->sentmessageHandler = new Sentmessage_handler();
                $sendMessage = $this->sentmessageHandler->insertSentMessageDetail($sentMessageArray);
            }
            if ($mailStatus) {
                $output['status'] = TRUE;
                $output["response"]['email'] = Email_SENT;
                $output["response"]['messages'][] = SUCCESS_MAIL_SENT;
                $output['statusCode'] = STATUS_OK;
                return $output;
            } else {
                $output['status'] = FALSE;
                //$output["response"]['messages'][] = ERROR_EMAIL_NOT_SENT;
                $output['response']['messages'][] = $this->ci->lang->line('error_email_sent_message');
                $output['statusCode'] = STATUS_SERVER_ERROR;
                return $output;
            }
        }
        $output['status'] = TRUE;
        $output["response"]['email'] = Email_SENT;
        //$output["response"]['messages'][] = ERROR_EMAIL_NOT_SENT;
        $output['response']['messages'][] = $this->ci->lang->line('error_email_sent_message');
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    // Function to send Email With mpdf Attachment(with pdf 'content')
    function EmailSend($to, $cc, $bcc, $from, $subject, $message, $content = NULL, $filename = NULL, $folder = NULL, $sentMessageArray = array()) {

        require_once (APPPATH . 'libraries/Swift/lib/swift_required.php');
        if ($this->ci->config->Item('emailEnable') == true) {
            $this->ci->config->load('email');
            /*             * ********************* CODE RELATED TO MANDRILL MAIL ************************************ */
            //$to, $cc, $bcc - list of mail id's seperated by comma (,)
            //$from - from name<from mail id>. Ex: MeraEvents<admin@meraevents.com>
            //$replyto - single mail id
            //$subject - subject of the mail
            //$message - message/body of the mail. it may be html  or plain text
            //$content -  attached file content. if no attachment is there, then value must be NULL
            //$filename - attached file name. if no attachment is there, then value must be NULL
            $transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
            $transport->setUsername($this->ci->config->item('smtp_user'));
            $transport->setPassword($this->ci->config->item('smtp_pass'));
            $swift = Swift_Mailer::newInstance($transport);
            /*             * ********************* CODE RELATED TO MANDRILL MAIL ************************************ */
            if (strpos($to, ',') !== FALSE) {
                $mailto = explode(',', $to);
                foreach ($mailto as $key => $value) {
                    $value = trim($value);
                    if (strlen(trim($value)) > 0 && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $mailto[$key] = $value;
                    } else {
                        unset($mailto[$key]);
                    }
                }
            } else {
                $mailto = $to;
            }

            $mailcc = strlen($cc) > 0 ? explode(',', $cc) : array();
            $mailbcc = strlen($bcc) > 0 ? explode(',', $bcc) : array();
            if (!is_array($filename)) {
                if (strlen($filename) > 0) {
                    $filenameEx = explode(".", $filename);
                    $fileExtension = end($filenameEx);
                }
            }
            //throw new Exception('shashi');
            try {
                $fromEx = explode("<", $from);
                $from_name = $fromEx[0];
                $from_mail = substr($fromEx[1], 0, -1);
                $mess = new Swift_Message($subject);
                $mess->setFrom(array($from_mail => $from_name));
                $mess->setBody($message, 'text/html');
                $mess->addPart($message, 'text/plain');
                $mess->setTo($mailto);

                if (!empty($mailbcc)) {
                    $mess->setBcc($mailbcc);
                }
                if (!empty($mailcc)) {
                    $mess->setCc($mailcc);
                }

                if (!is_array($content)) {
                    if (strlen($content) > 0) {
                        if (strtolower($fileExtension) == 'pdf') {
                            $mess->attach(Swift_Attachment::newInstance($content, $filename, 'application/pdf'));
                        } elseif (strtolower($fileExtension) == 'csv') {
                            $mess->attach(Swift_Attachment::newInstance($content, $filename, 'application/csv'));
                        }
                    }
                }


                if (is_array($content) > 0) {

                    foreach ($filename as $key => $value) {
                        if (strlen($filename[$key]) > 0) {
                            $filenameEx = explode(".", $filename[$key]);
                            $fileExtension = end($filenameEx);
                        }
                        if (strtolower($fileExtension) == 'pdf') {
                            $mess->attach(Swift_Attachment::newInstance($content[$key], $filename[$key], 'application/pdf'));
                        } elseif (strtolower($fileExtension) == 'csv') {
                            $mess->attach(Swift_Attachment::newInstance($content[$key], $filename[$key], 'application/csv'));
                        }
                    }
                }



                $mailStatus = $swift->send($mess, $failures);
            } catch (Exception $e) {//Manual mail sending
                $fileatt_type = "application/octet-stream"; // File Type 
                $fileatt_name = $filename; // Filename that will be used for the file as the attachment 

                $email_from = $from; // Who the email is from
                //$subject = "New Attachment Message";

                $email_subject = $subject; // The Subject of the email 
                $email_txt = $message; // Message that the email has in it 
                $email_to = $to; // Who the email is to

                $headers = "From: " . $email_from;
                //$file = fopen($fileatt,'rb'); 
                $data = $content;
                $semi_rand = md5(time());
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
                $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

                $email_message .= "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type:text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $email_txt . "\n\n";
                $data = chunk_split(base64_encode($data));
                $email_message .= "--{$mime_boundary}\n" . "Content-Type: {$fileatt_type};\n" . " name=\"{$fileatt_name}\"\n" . //"Content-Disposition: attachment;\n" . //" filename=\"{$fileatt_name}\"\n" . "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n" . "--{$mime_boundary}--\n";
                        $mailStatus = mail($email_to, $email_subject, $email_message, $headers);
            }
            $sentMessageArray['status'] = $mailStatus;
            if (!isset($sentMessageArray['notInsertIntoSentMessage'])) {//There are some emails which are not needed to be inserted in to sentmessages
                $this->sentmessageHandler = new Sentmessage_handler();
                $sendMessage = $this->sentmessageHandler->insertSentMessageDetail($sentMessageArray);
            }
            if ($mailStatus) {
                $output['status'] = TRUE;
                $output["response"]['messages'][] = SUCCESS_MAIL_SENT;
                $output['statusCode'] = STATUS_OK;
                return $output;
            } else {
                $output['status'] = FALSE;
                //$output["response"]['messages'][] = ERROR_EMAIL_NOT_SENT;
                $output['response']['messages'][] = $this->ci->lang->line('error_email_sent_message');
                $output['statusCode'] = STATUS_SERVER_ERROR;
                return $output;
            }
        }
        //If we disable email
        $output['status'] = TRUE;
        $output["response"]['email'] = Email_SENT;
        $output["response"]['messages'][] = '';
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    function manualMailSending($from, $to, $subject, $message, $cc, $bcc, $replyto = '', $filename = NULL, $content = NULL) {
        $uid = md5(uniqid(time()));
        $header = "From:" . $from . "\r\n" .
                'Cc: ' . $cc . "\r\n" .
                'Bcc: ' . $bcc . "\r\n";

        if (strlen($filename) > 0) {
            $filenameEx = explode(".", $filename);
            $fileExtension = end($filenameEx);
        }

        if (strlen($replyto) > 0) {
            $header.="Reply-To: " . $replyto . "\r\n";
        }
        $header.='X-Mailer: PHP/' . phpversion() . "\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-Type: text/html; charset=iso-8859-1\r\n" .
                "Content-Transfer-Encoding: 8bit\r\n\r\n";

        $fileheaders = '\r\n';
        if (strlen($content) > 0) {
            if (strtolower($fileExtension) == 'pdf') {
                $content = chunk_split(base64_encode($content));
                $header = "From:" . $from . "\r\n" .
                        'Cc: ' . $cc . "\r\n" .
                        'Bcc: ' . $bcc . "\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
                $header .= "This is a multi-part message in MIME format.\r\n";
                $header .= "--" . $uid . "\r\n";
                $header .= "Content-type:text/html; charset=iso-8859-1\r\n";
                $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                $header .= $message . "\r\n\r\n";
                $header .= "--" . $uid . "\r\n";
                $header .= "Content-Type: application/pdf; name=\"" . $filename . "\"\r\n";

                $header .= "Content-Transfer-Encoding: base64\r\n";
                $header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
                $header .= $content . "\r\n\r\n";
                $header .= "--" . $uid . "--";
            } elseif (strtolower($fileExtension) == 'csv') {
                $header = "From:" . $from . "\r\n" .
                        'Cc: ' . $cc . "\r\n" .
                        'Bcc: ' . $bcc . "\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
                $header .= "This is a multi-part message in MIME format.\r\n";
                $header .= "--" . $uid . "\r\n";
                $header .= "Content-type:text/html; charset=iso-8859-1\r\n";
                $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                $header .= $message . "\r\n\r\n";
                $header .= "--" . $uid . "\r\n";
                $header.= "Content-Type: application/csv; name=\"" . $filename . "\"\r\n" . // use different content types here
                        "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n" .
                        $content . "\r\n\r\n";
                $header .= "--" . $uid . "--";
            }
        }
        $mailStatus = @mail($to, $subject, $message, $header);
        return $mailStatus;
    }

	    public function sendSMSFromAWS($phoneNumber, $message, $sentMessageArray = array()) {

        if ($this->ci->config->Item('smsEnable') == true) {

            $this->messagetemplateHandler = new Messagetemplate_handler();

            include_once(APPPATH . 'libraries/aws/aws-autoloader.php');
            include_once(APPPATH . 'libraries/aws/aws-autoloader.php');
            $this->ci->config->load('aws-sns');
            $snsClient = Aws\Sns\SnsClient::factory(array(
                        'credentials' => array(
                            'key' => $this->ci->config->Item('AWS_SNS_KEY_ID'),
                            'secret' => $this->ci->config->Item('AWS_SNS_SECRET'),
                        ),
                        'version' => $this->ci->config->Item('AWS_SNS_CLIENT_VERSION'),
                        'region' => $this->ci->config->Item('AWS_SNS_REGION')
            ));
            $result = $snsClient->setSMSAttributes([
                'attributes' => array('DefaultSMSType' => $this->ci->config->Item('AWS_SNS_SMS_TYPE')), // REQUIRED
            ]);

            $result = $snsClient->publish([
                'Message' => $message, // REQUIRED
                'PhoneNumber' => $phoneNumber,
                'Subject' => $this->ci->config->Item('AWS_SNS_SMS_SUBJECT')
            ]);

            $result = (array) $result;
            $messageId = $result[' Aws\Result data']['MessageId'];
            $smsStatus = 0;
            if (!is_null($messageId)) {
                $smsStatus = 1;
            }

            /*
              $resultDecoded = new Aws\Result($result);
              $smsStatus = 0;
              if (!is_null($resultDecoded->get('MessageId'))) {
              $smsStatus = 1;
              }
             */

            //print_r($snsClient->getSMSAttributes())
            //$smsStatus =$result['status'];
            $sentMessageArray['status'] = $smsStatus;
            $sendMessage = $this->messagetemplateHandler->insertMessageDetail($sentMessageArray);

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


  
}
