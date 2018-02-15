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

class Prescriptiondoctor_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Prescriptiondoctor_model');
    }

    public function addPrescriptionPatientDetails($data) {
        
//        debugArray($data); exit;
        
        $this->ci->Prescriptiondoctor_model->resetVariable();
        $this->ci->Prescriptiondoctor_model->insertUpdateArray[$this->ci->Prescriptiondoctor_model->patientId]      = $data["id_patient"];
        $this->ci->Prescriptiondoctor_model->insertUpdateArray[$this->ci->Prescriptiondoctor_model->prescId]        = $data["prec_id"];
        $this->ci->Prescriptiondoctor_model->insertUpdateArray[$this->ci->Prescriptiondoctor_model->patientName]    = $data["name"];
        $this->ci->Prescriptiondoctor_model->insertUpdateArray[$this->ci->Prescriptiondoctor_model->gender]         = $data["gender"];
        $this->ci->Prescriptiondoctor_model->insertUpdateArray[$this->ci->Prescriptiondoctor_model->age]            = $data["age"];
        $this->ci->Prescriptiondoctor_model->insertUpdateArray[$this->ci->Prescriptiondoctor_model->village]        = $data["village"];
        $this->ci->Prescriptiondoctor_model->insertUpdateArray[$this->ci->Prescriptiondoctor_model->contactNumber]  = $data["contact"];
        $this->ci->Prescriptiondoctor_model->insertUpdateArray[$this->ci->Prescriptiondoctor_model->incidentType]   = $data["incident_type"];
        $ack = $this->ci->Prescriptiondoctor_model->insert_data($this->ci->Prescriptiondoctor_model->dbTable, $this->ci->Prescriptiondoctor_model->insertUpdateArray);

         
        
        if ($ack) {
            $output['status'] = TRUE;
            $output['statuscode'] = STATUS_OK;
            return $output;
        }else{
            
            $output['status'] = FALSE;
//            $output['response']['message'][] = ERROR_NO_CITY_DATA;
            $output['response']['message'][] = $this->ci->lang->line('error_no_bcp_assignment_message');;
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        
    }
    
}

?>
