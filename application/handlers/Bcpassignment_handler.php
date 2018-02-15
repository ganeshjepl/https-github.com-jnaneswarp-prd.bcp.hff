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

class Bcpassignment_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Bcpassignment_model');
    }

    public function getBcpAssignedDoctors($bcp_id) {

        $this->ci->Bcpassignment_model->resetVariable();
        $selectInput = array();
        $doctorList = array();
        $where = array();
        $selectInput['id'] = $this->ci->Bcpassignment_model->id;
        $selectInput['doctor_id'] = $this->ci->Bcpassignment_model->doctorId;
        $selectInput['bcp_id'] = $this->ci->Bcpassignment_model->bcpId;
        $this->ci->Bcpassignment_model->setSelect($selectInput);

        $where = array(
            $this->ci->Bcpassignment_model->deleted => 0,
            $this->ci->Bcpassignment_model->status => 1,
            $this->ci->Bcpassignment_model->bcpId => $bcp_id
        );
        $this->ci->Bcpassignment_model->setWhere($where);
        $doctorList = $this->ci->Bcpassignment_model->get();

        if (count($doctorList) == 0) {
            $output['status'] = TRUE;
            $output['response']['message'][] = $this->ci->lang->line('error_no_bcp_assignment_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['doctorsList'] = $doctorList;
        $output['response']['total'] = count($doctorList);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function getDoctorAssignedBcps($inputData) {
        require_once (APPPATH . 'handlers/User_handler.php');
        $this->userHandler = new User_handler();

        $docId = $inputData['doc_id'];

        $this->ci->Bcpassignment_model->resetVariable();
        $selectInput = array();
        $bcpList = array();
        $where = array();
        $selectInput['id'] = $this->ci->Bcpassignment_model->id;
        $selectInput['doctor_id'] = $this->ci->Bcpassignment_model->doctorId;
        $selectInput['bcp_id'] = $this->ci->Bcpassignment_model->bcpId;
        $this->ci->Bcpassignment_model->setSelect($selectInput);

        $where = array(
            $this->ci->Bcpassignment_model->deleted => 0,
            $this->ci->Bcpassignment_model->status => 1,
            $this->ci->Bcpassignment_model->doctorId => $docId
        );
        $this->ci->Bcpassignment_model->setWhere($where);
        $bcpList = $this->ci->Bcpassignment_model->get();
        if (count($bcpList) == 0) {
            $output['status'] = TRUE;
            $output['response']['message'][] = $this->ci->lang->line('error_no_bcp_assignment_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $bcpIds = array();
        $found_bcps = array();
        foreach ($bcpList as $bcp) {
            $bcpIds[$bcp['bcp_id']] = $bcp;
            array_push($found_bcps, $bcp['bcp_id']);
        }

        $bcpDetails = $this->userHandler->getUserProfile($found_bcps);
        if (isset($bcpDetails['response']['userData']) && !empty($bcpDetails['response']['userData'])) {
            $bcpDetails = $bcpDetails['response']['userData'];
        } else {
            $bcpDetails = '';
        }

//        debugArray($bcpDetails); exit;

        $output['status'] = TRUE;
        $output['response']['bcpList'] = $bcpDetails;
        $output['response']['total'] = count($bcpDetails);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function getDoctorBcps($docId) {
        $this->ci->Bcpassignment_model->resetVariable();
        $selectInput = array();
        $bcpAssignmentData = array();
        $where = array();
        $whereInArray = array();

        $selectInput['bcpId'] = $this->ci->Bcpassignment_model->bcpId;

        $where[$this->ci->Bcpassignment_model->doctorId] = $docId;
        $where[$this->ci->Bcpassignment_model->status] = 1;
        $where[$this->ci->Bcpassignment_model->deleted] = 0;

        $this->ci->Bcpassignment_model->setSelect($selectInput);
        $this->ci->Bcpassignment_model->setWhere($where);
        $bcpAssignmentData = $this->ci->Bcpassignment_model->get();
        if (count($bcpAssignmentData) == 0) {
            $output['status'] = TRUE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_bcp_assignment_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $bcp_array = array();
        foreach ($bcpAssignmentData as $key => $val) {
            array_push($bcp_array, $val['bcpId']);
        }
        $output['status'] = TRUE;
        $output['response']['bcpdata'] = $bcp_array;
        $output['response']['total'] = count($bcpAssignmentData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

}

?>
