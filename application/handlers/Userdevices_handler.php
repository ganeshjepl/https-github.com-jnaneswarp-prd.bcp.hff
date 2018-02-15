<?php

/* Cities related business logic will be defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    Pandu Babu
 */
require_once (APPPATH . 'handlers/handler.php');

class Userdevices_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('User_devices_model');
    }

    public function getDevicesInfoByUser($userIds) {
        if(!empty($userIds)){
            foreach($userIds as $key => $user){
                $userIds[$key]  =   $user['id'];
            }
        }
        
        $this->ci->User_devices_model->resetVariable();
        $selectInput    = array();
        $devicesInfo     =   array();
        $where          = array();
        $selectInput['id'] = $this->ci->User_devices_model->id;
        $selectInput['user_id'] = $this->ci->User_devices_model->userId;
        $selectInput['device_id'] = $this->ci->User_devices_model->deviceId;
        $selectInput['device_token'] = $this->ci->User_devices_model->deviceToken;
        $selectInput['awsarncode'] = $this->ci->User_devices_model->awsarncode;
        $this->ci->User_devices_model->setSelect($selectInput);
        
        $where = array(
//            $this->ci->User_devices_model->deleted => 0, 
            $this->ci->User_devices_model->status => 1,
            $this->ci->User_devices_model->deviceId.' !=' => '',
            $this->ci->User_devices_model->deviceToken.' !=' => '',
            
                );
        $whereIns = array(
            $this->ci->User_devices_model->userId => $userIds,
                );
        $this->ci->User_devices_model->setWhere($where);
        $this->ci->User_devices_model->setWhereIns($whereIns);
        
        $devices_info = $this->ci->User_devices_model->get();
        
        
        if (count($devices_info) == 0) {
            $output['status'] = TRUE;
//            $output['response']['message'][] = ERROR_NO_CITY_DATA;
            $output['response']['message'][] = $this->ci->lang->line('error_no_device_information_message');;
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['devices_info'] = $devices_info;
        $output['response']['total'] = count($devices_info);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }
}

?>
