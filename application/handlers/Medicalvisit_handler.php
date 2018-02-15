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

class Medicalvisit_handler Extends Handler {

    var $ci;

    function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Medicalincident_model');
        $this->ci->load->model('Medicalincidentdetail_model');
        $this->ci->load->model('Medicalincidentvisit_model');
        $this->ci->load->model('Medicalsurveyreport_model');
        $this->ci->load->model('Patient_model');
        $this->ci->load->model('User_model');
        $this->ci->load->model('Survey_model');
        $this->ci->load->model('Survey_questionnaire_model');
    }

    public function getMedicalVisitDetails($limit, $page = 0) {
        $doctorId = $this->ci->session->userid;
        $bcpDetails = $this->getBcp($doctorId);
        if (count($bcpDetails) > 0) {
            $bcpId = $bcpDetails[0]['id'];
            $selectInput = array();
            $patientData = array();
            $where = array();
            $selectInput['id'] = $this->ci->Patient_model->id;
            $selectInput['medicalRegistrationNumber'] = $this->ci->Patient_model->medicalRegistrationNumber;
            $selectInput['registrationDate'] = $this->ci->Patient_model->registrationDate;
            $selectInput['name'] = $this->ci->Patient_model->name;
            $selectInput['title'] = $this->ci->Patient_model->title;
            $selectInput['age'] = $this->ci->Patient_model->age;
            $selectInput['contactNumber'] = $this->ci->Patient_model->contactNumber;
            $selectInput['gender'] = $this->ci->Patient_model->gender;
            $selectInput['createdby'] = $this->ci->Patient_model->createdby;

            $where[$this->ci->Patient_model->deleted] = 0;
            $where[$this->ci->Patient_model->status] = 1;
            $where[$this->ci->Patient_model->createdby] = $bcpId;
            $this->ci->Patient_model->setSelect($selectInput);
            $this->ci->Patient_model->setWhere($where);

            $patientData = $this->ci->Patient_model->get();

            $patientData = commonHelperGetIdArray($patientData, 'id');

            $this->ci->Patient_model->resetVariable();
            foreach ($patientData as $id) {
                $patientIds[] = $id['id'];
            }
            //print_r($patientIds); 
            $selectInput = array();
            $medicalIncidentData = array();
            $where = array();
            $groupByArray = array();
            $whereInArray = array();
            $selectInput['id'] = $this->ci->Medicalincident_model->id;
            $selectInput['medicalIncidentCode'] = $this->ci->Medicalincident_model->medicalIncidentCode;
            $selectInput['patientId'] = $this->ci->Medicalincident_model->patientId;
            $selectInput['bcpUserId'] = $this->ci->Medicalincident_model->bcpUserId;
            $selectInput['registrationDate'] = $this->ci->Medicalincident_model->registrationDate;

            $where[$this->ci->Medicalincident_model->deleted] = 0;
            $where[$this->ci->Medicalincident_model->status] = 1;
            $whereInArray[$this->ci->Medicalincident_model->patientId] = $patientIds;
            $this->ci->Medicalincident_model->setOrWhere($whereInArray);

            $this->ci->Medicalincident_model->setSelect($selectInput);
            $this->ci->Medicalincident_model->setWhere($where);
            //$this->ci->Medicalincident_model->setGroupBy($this->ci->Medicalincident_model->medicalIncidentCode);
            $ordetByArr[] = $this->ci->Medicalincident_model->registrationDate . " Desc ";
            $this->ci->Medicalincident_model->setOrderBy($ordetByArr);
            $MedicalincidentData = $this->ci->Medicalincident_model->get();
            // print_r($MedicalincidentData);exit;
            $MedicalincidentData = commonHelperGetIdArray($MedicalincidentData, 'id');
            $this->ci->Medicalincident_model->resetVariable();
            $selectInput = array();
            $medicalVisitData = array();
            $where = array();
            $whereInArray = array();
            if (($limit > 100) || ($limit == '')) {
                $limit = 100;
            }
            if ($page > 0) {
                $page = ($page - 1);
                $page = ($limit) * $page;
            }
            $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
            $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
            $selectInput['registrationDate '] = $this->ci->Medicalincidentvisit_model->registrationDate;
            $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentvisit_model->medicalIncidentId;
            $selectInput['patientId'] = $this->ci->Medicalincidentvisit_model->patientId;

            $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
            $where[$this->ci->Medicalincidentvisit_model->status] = 1;
            $whereInArray[$this->ci->Medicalincidentvisit_model->patientId] = $patientIds;
            $this->ci->Medicalincidentvisit_model->setOrWhere($whereInArray);
            $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
            $this->ci->Medicalincidentvisit_model->setWhere($where);
            $this->ci->Medicalincidentvisit_model->setRecords($limit, $page);
            $medicalVisitData = $this->ci->Medicalincidentvisit_model->get();

            foreach ($medicalVisitData as $key => $value) {

                $medicalVisitData[$key]['patientname'] = $patientData[$value['patient_id']]['name'];
                $medicalVisitData[$key]['medicalregistrationcode'] = $patientData[$value['patient_id']]['medical_registration_code'];
                $medicalVisitData[$key]['bcpname'] = $bcpDetails[0]['first_name'] . $bcpDetails[0]['last_name'];
            }//print_r($medicalVisitData);
            /* foreach($MedicalincidentData as $key =>$value){  
              $MedicalincidentData[$key]['patientname']=$patientData[$value['patient_id']]['name'];
              $MedicalincidentData[$key]['medicalregistrationcode']=$patientData[$value['patient_id']]['medical_registration_code'];
              $MedicalincidentData[$key]['age']=$patientData[$value['patient_id']]['age'];
              $MedicalincidentData[$key]['title']=$patientData[$value['patient_id']]['title'];
              $MedicalincidentData[$key]['contactnumber']=$patientData[$value['patient_id']]['contact_number'];
              $MedicalincidentData[$key]['bcpname']=$bcpDetails[0]['first_name'].$bcpDetails[0]['last_name'];
              } */

            if (count($medicalVisitData) == 0) {
                $output['status'] = TRUE;
                ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENTS;
                $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
                $output['response']['total'] = 0;
                $output['statusCode'] = STATUS_NO_DATA;
                return $output;
            }
            $output['status'] = TRUE;
            $output['response']['MedicalVisitData'] = $medicalVisitData;
            $outout['response']['total'] = count($medicalVisitData);
            $output['statusCode'] = STATUS_OK;
            return $output;
        }
    }

    public function getBcp($doctorId) {
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $bcpData = array();
        $where = array();
        $selectInput['createdby'] = $this->ci->User_model->createdby;
        $where[$this->ci->User_model->status] = 1;
        $where[$this->ci->User_model->id] = $doctorId;
        $this->ci->User_model->setSelect($selectInput);
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        $bcpData = $this->ci->User_model->get();
        if (count($bcpData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $this->ci->User_model->resetVariable();
        $Input['id'] = $this->ci->User_model->id;
        $Input['first_name'] = $this->ci->User_model->firstName;
        $Input['last_name'] = $this->ci->User_model->lastName;
        $where[$this->ci->User_model->status] = 1;
        $where[$this->ci->User_model->id] = $bcpData[0]['createdby'];
        $this->ci->User_model->setSelect($Input);
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        return $bcpDetails = $this->ci->User_model->get();
    }

    public function getMedicalSurveyDetails($inputData) {

        /* Get the medical detail visit data  depends on medical visit id */
        $selectInput = array();
        $medicalSurveyData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $selectInput['registrationDate'] = $this->ci->Medicalincidentvisit_model->registrationDate;
        $selectInput['patientId'] = $this->ci->Medicalincidentvisit_model->patientId;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentvisit_model->medicalIncidentId;
        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $where[$this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode] = $inputData['medicalvisit'];
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);
        $medicalSurveyData = $this->ci->Medicalincidentvisit_model->get();
        $this->ci->Medicalincidentvisit_model->resetVariable();
        /* Get the patient  detailed data */
        $selectInput = array();
        $patientData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Patient_model->id;
        $selectInput['medicalRegistrationNumber'] = $this->ci->Patient_model->medicalRegistrationNumber;
        $selectInput['registrationDate'] = $this->ci->Patient_model->registrationDate;
        $selectInput['name'] = $this->ci->Patient_model->name;
        $selectInput['title'] = $this->ci->Patient_model->title;
        $selectInput['age'] = $this->ci->Patient_model->age;
        $selectInput['contactNumber'] = $this->ci->Patient_model->contactNumber;
        $selectInput['gender'] = $this->ci->Patient_model->gender;
        $selectInput['createdby'] = $this->ci->Patient_model->createdby;
        $where[$this->ci->Patient_model->deleted] = 0;
        $where[$this->ci->Patient_model->status] = 1;
        $where[$this->ci->Patient_model->id] = $medicalSurveyData[0]['patient_id'];
        $this->ci->Patient_model->setSelect($selectInput);
        $this->ci->Patient_model->setWhere($where);
        $patientData = $this->ci->Patient_model->get();
        $this->ci->Patient_model->resetVariable();
        /* Get the patient submited survey data */
        $selectInput = array();
        $patientSurveyData = array();
        $where = array();
        $selectInput['surveyId'] = $this->ci->Medicalsurveyreport_model->surveyId;
        $selectInput['surveyQuestionId'] = $this->ci->Medicalsurveyreport_model->surveyQuestionId;
        $selectInput['surveyQuestionOptionId'] = $this->ci->Medicalsurveyreport_model->surveyQuestionOptionId;
        $selectInput['surveyQuestionOptionValue'] = $this->ci->Medicalsurveyreport_model->surveyQuestionOptionValue;
        $where[$this->ci->Medicalsurveyreport_model->medicalIncidentVisitId] = $medicalSurveyData[0]['id'];
        $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
        $this->ci->Medicalsurveyreport_model->setWhere($where);
        $patientSurveyData = $this->ci->Medicalsurveyreport_model->get();
        $this->ci->Medicalsurveyreport_model->resetVariable();
        print_r($patientSurveyData);
        /*         * * survey data ** */
        $selectInput = array();
        $surveyData = array();
        $where = array();
        $selectInput['name'] = $this->ci->Survey_model->name;
        $this->ci->Survey_model->setSelect($selectInput);
        $this->ci->Survey_model->setWhere($where);
        $surveyData = $this->ci->Survey_model->get();
        $this->ci->Survey_model->resetVariable();
        print_r($surveyData);
        foreach ($patientSurveyData as $key => $surveyValue) {

            $medicalSurveyData[0]['patientname'] = $patientData[0]['name'];
            $medicalSurveyData[0]['medical_registration_code'] = $patientData[0]['medical_registration_code'];
            $medicalSurveyData[0]['title'] = $patientData[0]['title'];
            $medicalSurveyData[0]['age'] = $patientData[0]['age'];
            $medicalSurveyData[0]['contact_number'] = $patientData[0]['contact_number'];
            $medicalSurveyData[0]['surveyname'] = $surveyData[$surveyValue['survey_id']]['name'];
        }

        print_r($medicalSurveyData);
    }
    public function getVisitDetailsById($id) {
        
        $this->ci->Medicalincidentvisit_model->resetVariable();
        $selectInput = array();
        $visitData = array();
        $where = array();
        $selectInput['patient_id'] = $this->ci->Medicalincidentvisit_model->patientId;
        $where[$this->ci->Medicalincidentvisit_model->status]   = 1;
        $where[$this->ci->Medicalincidentvisit_model->deleted]  = 0;
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);
        $this->ci->Medicalincidentvisit_model->setRecords(1);
        $visitData = $this->ci->Medicalincidentvisit_model->get();
        if (count($visitData) == 0) {
            $output['status'] = TRUE;
            $output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_details');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['visit_data'] = $visitData;
        $output['response']['total'] = 0;
        $output['statusCode'] = STATUS_OK;
        return $output; 
    }
     

    
    public function getMedicalVisitCount($keyValueArray){        
        $select = array();
        $where = array();        
        $selectType['id'] = $this->ci->Medicalincidentvisit_model->id;
                
        if(count($keyValueArray)>0){
            foreach($keyValueArray as $key => $val){
                $where[$this->ci->Medicalincidentvisit_model->$key] = $val; 
            }
        }        
        
        $this->ci->Medicalincidentvisit_model->setSelect($select);
        $this->ci->Medicalincidentvisit_model->setWhere($where);
        return $this->ci->Medicalincidentvisit_model->getCount();
    }
    
    
    
}
