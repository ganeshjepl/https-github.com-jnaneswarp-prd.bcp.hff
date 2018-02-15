<?php

require_once (APPPATH . 'handlers/handler.php');

class Userotp_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('User_otp_model');
    }

    public function insertOTP($userOTPData) {
        
        if (count($userOTPData) > 0) {
            $userId = $userOTPData['userId'];
            $otpCode = $userOTPData['otp'];
            $time_expires = date("Y-m-d H:i:s", time() + (OPT_VALIDITY * 60));

            $this->ci->User_otp_model->insertUpdateArray[$this->ci->User_otp_model->userId] = $userId;
            $this->ci->User_otp_model->insertUpdateArray[$this->ci->User_otp_model->otp] = $otpCode;
            $this->ci->User_otp_model->insertUpdateArray[$this->ci->User_otp_model->validity] = $time_expires;
            $optId = $this->ci->User_otp_model->insertdata($this->ci->User_otp_model->dbTable, $this->ci->User_otp_model->insertUpdateArray);
            
            if($optId){
                $output['status'] = TRUE;
                $output['response']['data']['id'] = $optId;
                $output['response']['messages'] = $this->ci->lang->line('success_otp_create_message');
                $output['statusCode'] = STATUS_OK;
                return $output;
            }
            
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->ci->lang->line('error_otp_create_message');
            $output['statusCode'] = STATUS_SERVER_ERROR;
            return $output;
        }
        
        $output['status'] = FALSE;
        $output['response']['messages'] = $this->ci->lang->line('error_invalid_otp_data_message');
        $output['statusCode'] = STATUS_BAD_REQUEST;
        return $output;
    }
    
    public function getOTPDetails($userOTPData = array()) {
        
        require_once (APPPATH . 'handlers/Userotp_handler.php');
        $this->userotpHandler = new Userotp_handler();
        
        if(count($userOTPData)>0){
            
            $userId = $userOTPData['userId'];
            $otpCode =  $userOTPData['otp'];
            
            $selectInput = array();
            $otpData = array();
            $where = array();
            $orderBy = array();
            $this->ci->User_otp_model->resetVariable();
            $selectInput['id'] = $this->ci->User_otp_model->id;
            $selectInput['otp'] = $this->ci->User_otp_model->otp;
            $selectInput['validity'] = $this->ci->User_otp_model->validity;
            $where[$this->ci->User_otp_model->status] = 1;
            $where[$this->ci->User_otp_model->userId] = $userId;
            $where[$this->ci->User_otp_model->otp] = $otpCode;
            $this->ci->User_otp_model->setSelect($selectInput);
            $this->ci->User_otp_model->setWhere($where);
            $orderBy[] = $this->ci->User_otp_model->id;
            $this->ci->User_otp_model->setOrderBy($orderBy);
            $this->ci->User_otp_model->setRecords(1);
            $otpData = $this->ci->User_otp_model->get();
            
            if(count($otpData)>0){
                $output['status'] = TRUE;
                $output['response']['data'] = $otpData;
                $output['response']['messages'] = $this->ci->lang->line('success_otp_create_message');
                $output['statusCode'] = STATUS_OK;
                return $output;
            }
            
            $output['status'] = FALSE;
            $output["response"]["messages"] = $this->ci->lang->line('error_invalid_otp_message');
            $output['statusCode'] = STATUS_INVALID;
            return $output;
        }   
        
    }
    
}

?>
