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

class Bcpreferredhospital_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Bcpreferredhospital_model');
    }

    public function getHospitalIds($detailids) {
        
        $this->ci->Bcpreferredhospital_model->resetVariable();
        $selectInput    = array();
        $hospitalList   = array();
        $where          = array();
        $whereIn        = array();
        $selectInput['id'] = $this->ci->Bcpreferredhospital_model->id;
        $selectInput['hospital_id'] = $this->ci->Bcpreferredhospital_model->hospitalId;
        $this->ci->Bcpreferredhospital_model->setSelect($selectInput);

        $where[$this->ci->Bcpreferredhospital_model->deleted] = 0;
        $where[$this->ci->Bcpreferredhospital_model->status] = 1;
        $whereIn[$this->ci->Bcpreferredhospital_model->medicalIncidentDetailId] = $detailids;
                
            
                
        $this->ci->Bcpreferredhospital_model->setWhere($where);
        $this->ci->Bcpreferredhospital_model->setOrWhere($whereIn);
        
        $hospitalList = $this->ci->Bcpreferredhospital_model->get();
        
        if (count($hospitalList) == 0) {
            $output['status'] = TRUE;
//            $output['response']['message'][] = ERROR_NO_CITY_DATA;
            $output['response']['message'][] = $this->ci->lang->line('error_no_hospital_message');;
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['hospitalList'] = $hospitalList;
        $output['response']['total'] = count($hospitalList);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }
    
}

?>
