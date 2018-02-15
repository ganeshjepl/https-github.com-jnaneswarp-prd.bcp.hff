<?php

/* States related business logic will be defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    Pandu Babu
 */
require_once (APPPATH . 'handlers/handler.php');

class Sentmessage_handler extends Handler {

    var $ci;
    
    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Sentmessage_model');
    }
    
    public function saveSentMessage($inputMessageArray = ""){
        
        if(count($inputMessageArray) > 0){  
            $this->ci->Sentmessage_model->insertUpdateArray[$this->ci->Sentmessage_model->toUserId] = $inputMessageArray['toUserId'];
            $this->ci->Sentmessage_model->insertUpdateArray[$this->ci->Sentmessage_model->fromUserId] = $inputMessageArray['fromUserId'];
            $this->ci->Sentmessage_model->insertUpdateArray[$this->ci->Sentmessage_model->message] = $inputMessageArray['message'];
            $this->ci->Sentmessage_model->insertUpdateArray[$this->ci->Sentmessage_model->type] = $inputMessageArray['type'];
            $this->ci->Sentmessage_model->insertUpdateArray[$this->ci->Sentmessage_model->mobileNumber] = $inputMessageArray['mobileNumber'];
            $this->ci->Sentmessage_model->insertUpdateArray[$this->ci->Sentmessage_model->emailId] = $inputMessageArray['emailId'];
            $this->ci->Sentmessage_model->insertUpdateArray[$this->ci->Sentmessage_model->messageid] = $inputMessageArray['messageid'];
            $this->ci->Sentmessage_model->insertUpdateArray[$this->ci->Sentmessage_model->activity] = $inputMessageArray['activity'];
            $this->ci->Sentmessage_model->insertUpdateArray[$this->ci->Sentmessage_model->status] = $inputMessageArray['status'];

            $sentMessageId = $this->ci->Sentmessage_model->insertdata($this->ci->Sentmessage_model->dbTable, $this->ci->Sentmessage_model->insertUpdateArray);
            
            if($sentMessageId){
                return $sentMessageId;
            }else{
                //log_message("error", $this->ci->lang->line('error_sent_message_save_message'));
            }
        } 

    }
    
    
    
}


?>