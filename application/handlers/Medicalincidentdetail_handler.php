<?php

/* Medical Visit  business logic will be defined in the class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             28-05-2017
 * @Last Modified       28-05-2017
 * @Last Modified By    shivajyothi
 */
require_once (APPPATH . 'handlers/handler.php');

class Medicalincidentdetail_handler Extends Handler {

    var $ci;

    function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Medicalincidentdetail_model');
    }
    public function getDetailIdsByIncident($incident_id) {
        
        $this->ci->Medicalincidentdetail_model->resetVariable();
        $selectInput = array();
        $detailData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentdetail_model->medicalIncidentId;
        $selectInput['type'] = $this->ci->Medicalincidentdetail_model->type;
        $where[$this->ci->Medicalincidentdetail_model->deleted] = 0;
        $where[$this->ci->Medicalincidentdetail_model->status] = 1;
        $where[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $incident_id;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $detailData = $this->ci->Medicalincidentdetail_model->get();
        
        if (count($detailData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_incident_detail_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }else{
            $output['status'] = TRUE;
            ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['details'] = $detailData;
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        
        
    }

     
}
