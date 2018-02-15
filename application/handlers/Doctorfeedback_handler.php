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

class Doctorfeedback_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Doctorfeedback_model');
    }

    public function saveDoctorFeedback($inputData) {
        
        $this->ci->Doctorfeedback_model->resetVariable();
        $this->ci->Doctorfeedback_model->insertUpdateArray[$this->ci->Doctorfeedback_model->medicalIncidentVisitId] = $inputData['visit_id'];
        $this->ci->Doctorfeedback_model->insertUpdateArray[$this->ci->Doctorfeedback_model->comments] = $inputData["comments"];
        $this->ci->Doctorfeedback_model->insertUpdateArray[$this->ci->Doctorfeedback_model->isRetake] = $inputData["is_retake"];
        $insert_id = $this->ci->Doctorfeedback_model->insert_data($this->ci->Doctorfeedback_model->dbTable, $this->ci->Doctorfeedback_model->insertUpdateArray);
        
        if (empty($insert_id)) {
            $output['status'] = FALSE;
            $output['response']['message'][] = $this->ci->lang->line('success_saving_doctor_feedback');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['message'][] = $this->ci->lang->line('success_saving_doctor_feedback');
        $output['statusCode'] = STATUS_OK;
        return $output;
    }
    public function getDoctorFeedback($visit_ids) {
        
        $this->ci->Doctorfeedback_model->resetVariable();
        $selectInput    = array();
        $feedback     =   array();
        $where          = array();
        $whereIn          = array();
        $selectInput['id'] = $this->ci->Doctorfeedback_model->id;
        $selectInput['visit_id'] = $this->ci->Doctorfeedback_model->medicalIncidentVisitId;
        $selectInput['comments'] = $this->ci->Doctorfeedback_model->comments;
        $selectInput['is_retake'] = $this->ci->Doctorfeedback_model->isRetake;
        $selectInput['retake_status'] = $this->ci->Doctorfeedback_model->retakeStatus;
        $this->ci->Doctorfeedback_model->setSelect($selectInput);

        $where = array(
            $this->ci->Doctorfeedback_model->deleted => 0, 
            $this->ci->Doctorfeedback_model->status => 1,
                );
        $whereIn = array(
            $this->ci->Doctorfeedback_model->medicalIncidentVisitId => $visit_ids,
                );
        $this->ci->Doctorfeedback_model->setWhere($where);
        $this->ci->Doctorfeedback_model->setOrWhere($whereIn);
        
        $feedback = $this->ci->Doctorfeedback_model->get();
        
        $output['status'] = TRUE;
        $output['response']['feedback'] = $feedback;
        $output['response']['total'] = count($feedback);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }
      
}

?>
