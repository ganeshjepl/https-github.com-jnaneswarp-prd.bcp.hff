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

class Prescription_detail_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Prescriptiondetail_model');
    }

    public function getPrescriptionMedicine($prec_id) {
        $selectInput['id'] = $this->ci->Prescriptiondetail_model->id;
        $selectInput['prescription_id'] = $this->ci->Prescriptiondetail_model->prescription_Id;
        $selectInput['medicine_id'] = $this->ci->Prescriptiondetail_model->medicineId;
        $selectInput['dosage'] = $this->ci->Prescriptiondetail_model->dosage;
        $selectInput['quantity'] = $this->ci->Prescriptiondetail_model->quantity;
        $selectInput['timings'] = $this->ci->Prescriptiondetail_model->timingsIds;
        $selectInput['dispence_quantity'] = $this->ci->Prescriptiondetail_model->dispenceQuantity;
        $selectInput['days'] = $this->ci->Prescriptiondetail_model->days;
        $where[$this->ci->Prescriptiondetail_model->prescription_Id]    =   $prec_id;
        $this->ci->Prescriptiondetail_model->setSelect($selectInput);
        $this->ci->Prescriptiondetail_model->setWhere($where);

        
        $prescriptionDetail = $this->ci->Prescriptiondetail_model->get();
        if(count($prescriptionDetail)==0)
        {
             $output['status']=FALSE;
             ///$output['response']['message'][] = ERROR_NO_PRESCRIPTION_DETAILS_DATA;
             $output['response']['messages'][] = $this->ci->lang->line('error_prescription_details_not_found_message');
             $output['response']['total']=0;
             $output['statuscode']  = STATUS_NO_DATA ;
             return $output ;
        }
        $output['status']=TRUE;
             ///$output['response']['message'][] = ERROR_NO_PRESCRIPTION_DETAILS_DATA;
        $output['response']['prescription'] = $prescriptionDetail;
        $output['response']['total']=0;
        $output['statuscode']  = STATUS_OK;
        return $output ;
    }
}

?>
