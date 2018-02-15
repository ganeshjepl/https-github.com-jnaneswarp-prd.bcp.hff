<?php

/* Medical Incident  business logic will be defined in the class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             24-04-2017
 * @Last Modified       3-05-2017
 * @Last Modified By    shivajyothi
 */
require_once (APPPATH . 'handlers/handler.php');
require_once (APPPATH . 'handlers/User_handler.php');
require_once (APPPATH . 'handlers/Patient_handler.php');

class Medicalincident_handler Extends Handler {

    var $ci;

    function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Medicalincident_model');
        $this->ci->load->model('Medicalincidentdetail_model');
        $this->ci->load->model('Medicalincidentvisit_model');
        $this->ci->load->model('Medicalsurveyreport_model');
        $this->ci->load->model('Bcpassignment_model');
        $this->ci->load->model('Patient_model');
        $this->ci->load->model('User_model');

        $this->ci->load->model('Survey_model');
        $this->ci->load->model('Survey_chief_complaint_mapping_model');


        $this->ci->load->model('Survey_questionnaire_model');
        $this->ci->load->model('Survey_questionnaire_option_model');
        //$this->ci->load->model('Survey_questionnaire_condition_value_model');
        $this->ci->load->model('Survey_taxonomy_model');
        $this->ci->load->model('Taxonomy_model');

        $this->ci->load->model('Prescriptionrequests_model');

        $this->ci->load->model('Bcpreferredhospital_model');
        $this->ci->load->model('Patientvisitreminders_model');
    }

    public function checkSurvey($surveyId = "") {
        $surveyData = array();
        $selectInput = array();
        $where = array();
        $selectInput['id'] = $this->ci->Survey_model->id;
        $selectInput['type'] = $this->ci->Survey_model->type;
        $where[$this->ci->Survey_model->id] = $surveyId;
        $this->ci->Survey_model->setSelect($selectInput);
        $this->ci->Survey_model->setWhere($where);
        //$this->ci->Survey_model->setRecords(1);
        return $surveyData = $this->ci->Survey_model->get();
    }

    public function checkMedicalIncident($mrCode) {
        $selectInput = array();
        $medicalIncidentData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincident_model->id;
        $selectInput['medical_incident_code'] = $this->ci->Medicalincident_model->medicalIncidentCode;
        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;
        $like[$this->ci->Medicalincident_model->medicalIncidentCode] = $mrCode . "/" . MEDICAL_INCIDENT_STRING;
        $notLike[$this->ci->Medicalincident_model->medicalIncidentStatus] = MEDICAL_NON_INCIDENT_STRING;
        $order[] = " id DESC";
        $this->ci->Medicalincident_model->setSelect($selectInput);
        $this->ci->Medicalincident_model->setWhere($where);
        $this->ci->Medicalincident_model->setLike($like);
        $this->ci->Medicalincident_model->setNotLike($notLike);
        $this->ci->Medicalincident_model->setOrderBy($order);
        $this->ci->Medicalincident_model->setRecords(1);
        return $medicalIncidentData = $this->ci->Medicalincident_model->get();
    }

    public function checkMedicalIncidentByVisitId($medIncId) {
        $selectInput = array();
        $medicalIncidentData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincident_model->id;
        $selectInput['medicalIncidentCode'] = $this->ci->Medicalincident_model->medicalIncidentCode;
        $selectInput['patientId'] = $this->ci->Medicalincident_model->patientId;
        $selectInput['medicalIncidentStatus'] = $this->ci->Medicalincident_model->medicalIncidentStatus;
        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;
        $where[$this->ci->Medicalincident_model->id] = $medIncId;
        //$like[$this->ci->Medicalincident_model->medicalIncidentCode] = $mrCode . "/" . MEDICAL_INCIDENT_STRING ;
        $order[] = " id DESC";
        $this->ci->Medicalincident_model->setSelect($selectInput);
        $this->ci->Medicalincident_model->setWhere($where);
        //$this->ci->Medicalincident_model->setLike($like);
        $this->ci->Medicalincident_model->setOrderBy($order);
        $this->ci->Medicalincident_model->setRecords(1);
        return $medicalIncidentData = $this->ci->Medicalincident_model->get();
    }

    public function checkMedicalIncidentById($medIncId) {
        $selectInput = array();
        $medicalIncidentData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincident_model->id;
        $selectInput['medicalIncidentCode'] = $this->ci->Medicalincident_model->medicalIncidentCode;
        $selectInput['patientId'] = $this->ci->Medicalincident_model->patientId;
        $selectInput['medicalIncidentStatus'] = $this->ci->Medicalincident_model->medicalIncidentStatus;
        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;
        $where[$this->ci->Medicalincident_model->id] = $medIncId;
        //$like[$this->ci->Medicalincident_model->medicalIncidentCode] = $mrCode . "/" . MEDICAL_INCIDENT_STRING ;
        $order[] = " id DESC";
        $this->ci->Medicalincident_model->setSelect($selectInput);
        $this->ci->Medicalincident_model->setWhere($where);
        //$this->ci->Medicalincident_model->setLike($like);
        $this->ci->Medicalincident_model->setOrderBy($order);
        $this->ci->Medicalincident_model->setRecords(1);
        return $medicalIncidentData = $this->ci->Medicalincident_model->get();
    }

    public function checkMedicalIncidentVisitByVisitId($medIncVisitId) {
        $selectInput = array();
        $medicalIncidentData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $selectInput['patientId'] = $this->ci->Medicalincidentvisit_model->patientId;
        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $where[$this->ci->Medicalincidentvisit_model->id] = $medIncVisitId;
        //$like[$this->ci->Medicalincident_model->medicalIncidentCode] = $mrCode . "/" . MEDICAL_INCIDENT_STRING ;
        $order[] = " id DESC";
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);
        //$this->ci->Medicalincidentvisit_model->setLike($like);
        $this->ci->Medicalincidentvisit_model->setOrderBy($order);
        $this->ci->Medicalincidentvisit_model->setRecords(1);
        return $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();
    }

    public function checkMedicalIncidentVisitByIncidentId($medIncId) {
        $selectInput = array();
        $medicalIncidentData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $selectInput['patientId'] = $this->ci->Medicalincidentvisit_model->patientId;
        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $where[$this->ci->Medicalincidentvisit_model->medicalIncidentId] = $medIncId;
        //$like[$this->ci->Medicalincident_model->medicalIncidentCode] = $mrCode . "/" . MEDICAL_INCIDENT_STRING ;
        $order[] = " id DESC";
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);
        //$this->ci->Medicalincidentvisit_model->setLike($like);
        $this->ci->Medicalincidentvisit_model->setOrderBy($order);
        $this->ci->Medicalincidentvisit_model->setRecords(1);
        return $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();
    }

    public function checkMedicalIncidentDetailsById($medIncDetailId = "", $surveyId = "") {
        $selectInput = array();
        $medicalIncidentDetailsData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentdetail_model->medicalIncidentId;
        $selectInput['type'] = $this->ci->Medicalincidentdetail_model->type;
        $selectInput['medicalIncidentDetailStatus'] = $this->ci->Medicalincidentdetail_model->medicalIncidentDetailStatus;
        $selectInput['surveyId'] = $this->ci->Medicalincidentdetail_model->surveyId;
        $where[$this->ci->Medicalincidentdetail_model->deleted] = 0;
        $where[$this->ci->Medicalincidentdetail_model->status] = 1;
        $where[$this->ci->Medicalincidentdetail_model->id] = $medIncDetailId;
        if ($surveyId != "") {
            $where[$this->ci->Medicalincidentdetail_model->surveyId] = $surveyId;
        }
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $this->ci->Medicalincidentdetail_model->setRecords(1);
        return $medicalIncidentDetailsData = $this->ci->Medicalincidentdetail_model->get();
    }

    public function checkMedicalIncidentDetailsByIncidentIdSurveyId($medIncId = "", $surveyId = "") {
        $selectInput = array();
        $medicalIncidentDetailsData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentdetail_model->medicalIncidentId;
        $selectInput['type'] = $this->ci->Medicalincidentdetail_model->type;
        $selectInput['surveyId'] = $this->ci->Medicalincidentdetail_model->surveyId;
        $where[$this->ci->Medicalincidentdetail_model->deleted] = 0;
        $where[$this->ci->Medicalincidentdetail_model->status] = 1;
        $where[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $medIncId;
        $where[$this->ci->Medicalincidentdetail_model->surveyId] = $surveyId;
        $order[] = " id DESC";
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $this->ci->Medicalincidentdetail_model->setOrderBy($order);
        $this->ci->Medicalincidentdetail_model->setRecords(1);
        return $medicalIncidentDetailsData = $this->ci->Medicalincidentdetail_model->get();
    }

    public function checkMedicalIncidentDetailsByIncidentId($medIncId = "") {
        $selectInput = array();
        $medicalIncidentDetailsData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentdetail_model->medicalIncidentId;
        $selectInput['type'] = $this->ci->Medicalincidentdetail_model->type;
        $selectInput['surveyId'] = $this->ci->Medicalincidentdetail_model->surveyId;
        $where[$this->ci->Medicalincidentdetail_model->deleted] = 0;
        $where[$this->ci->Medicalincidentdetail_model->status] = 1;
        $where[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $medIncId;
        //$where[$this->ci->Medicalincidentdetail_model->surveyId] = $surveyId;
        $order[] = " id DESC";
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $this->ci->Medicalincidentdetail_model->setOrderBy($order);
        $this->ci->Medicalincidentdetail_model->setRecords(1);
        return $medicalIncidentDetailsData = $this->ci->Medicalincidentdetail_model->get();
    }

    public function getMedicalRegistrationCode($patientId) {
        $selectInput = array();
        $medicalRegistrationCodeData = array();
        $where = array();
        $selectInput['medical_registration_code'] = $this->ci->Patient_model->medicalRegistrationNumber;
        $selectInput['medicalIncidentCount'] = $this->ci->Patient_model->medicalIncidentCount;
        $selectInput['medicalIncidentVisitCount'] = $this->ci->Patient_model->medicalIncidentVisitCount;
        $where[$this->ci->Patient_model->deleted] = 0;
        $where[$this->ci->Patient_model->status] = 1;
        $where[$this->ci->Patient_model->id] = $patientId;
        $this->ci->Patient_model->setSelect($selectInput);
        $this->ci->Patient_model->setWhere($where);
        $this->ci->Patient_model->setRecords(1);
        return $medicalRegistrationCodeData = $this->ci->Patient_model->get();
    }

    public function checkMedicalIncidentVisit($miCode) {
        $selectInput = array();
        $medicalIncidentVisitData = array();
        $where = array();
        $selectInput['medical_incident_visit_code'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $order[] = " id DESC";
        $like[$this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode] = $miCode . "/" . MEDICAL_INCIDENT_VISIT_STRING . "/";
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);
        $this->ci->Medicalincidentvisit_model->setLike($like);
        $this->ci->Medicalincidentvisit_model->setOrderBy($order);
        $this->ci->Medicalincidentvisit_model->setRecords(1);
        return $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();
    }

    public function checkMedicalIncidentVisitByPatientId($patientId = "") {
        $selectInput = array();
        $medicalIncidentVisitData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $where[$this->ci->Medicalincidentvisit_model->patientId] = $patientId;
        $order[] = " id DESC";
        //$like[$this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode] = $miCode . "/" . MEDICAL_INCIDENT_VISIT_STRING . "/";
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);
        //$this->ci->Medicalincidentvisit_model->setLike($like);
        $this->ci->Medicalincidentvisit_model->setOrderBy($order);
        $this->ci->Medicalincidentvisit_model->setRecords(1);
        return $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();
    }

    public function getPatientId($mrCode) {
        $selectInput = array();
        $patientData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Patient_model->id;
        $selectInput['medicalIncidentCount'] = $this->ci->Patient_model->medicalIncidentCount;
        $selectInput['medicalIncidentVisitCount'] = $this->ci->Patient_model->medicalIncidentVisitCount;
        $selectInput['createdby'] = $this->ci->Patient_model->createdby;
        $where[$this->ci->Patient_model->deleted] = 0;
        $where[$this->ci->Patient_model->status] = 1;
        $where[$this->ci->Patient_model->medicalRegistrationNumber] = $mrCode;
        $this->ci->Patient_model->setSelect($selectInput);
        $this->ci->Patient_model->setWhere($where);
        $this->ci->Patient_model->setRecords(1);
        return $patientData = $this->ci->Patient_model->get();
    }

    public function checkMedicalIncidentDetail($id, $surveyId) {
        $selectInput = array();
        $medicalIncidentDetailData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $where[$this->ci->Medicalincidentdetail_model->deleted] = 0;
        $where[$this->ci->Medicalincidentdetail_model->status] = 1;
        $where[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $id;
        $where[$this->ci->Medicalincidentdetail_model->surveyId] = $surveyId;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $this->ci->Medicalincidentdetail_model->setRecords(1);
        return $medicalIncidentDetailData = $this->ci->Medicalincidentdetail_model->get();
    }

    public function checkQuestionsAndOptionsAsMandatory($surveyId = "", $type = "", $questions = array(), $incidentType = "") {
        /////////////Check Questions and Options as Mandatory /////////// 
        ///echo $surveyId.", ".$type.", ". count($questions); exit;

        $output = array();
        if ($surveyId != "" && $type != "" && count($questions) > 0) {
            //echo $type; exit;
            $where = array();
            $this->ci->Survey_questionnaire_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
            $this->ci->Survey_questionnaire_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_model->status] = 1;
            $where[$this->ci->Survey_questionnaire_model->type] = $type;
            $where[$this->ci->Survey_questionnaire_model->mandatory] = 1;
            if ($incidentType == "followup") {
                $where[$this->ci->Survey_questionnaire_model->chiefComplaintLinking] = 0;
            }
            $where[$this->ci->Survey_questionnaire_model->surveyId] = $surveyId;
            $this->ci->Survey_questionnaire_model->setWhere($where);
            $surveyQtnsData = $this->ci->Survey_questionnaire_model->get();

            $surveyQtnIdData = commonHelperGetIdArray($surveyQtnsData, 'id');
            $surveyQtnIdsArray = array_keys($surveyQtnIdData);
            //print_r($surveyQtnIdsArray); exit; 
            //$questions = $inputData['questions'];
            $submittedSurveyQtnIdData = commonHelperGetIdArray($questions, 'questionId');
            $submittedSurveyQtnIdsArray = array_keys($submittedSurveyQtnIdData);

            //print_r($where); exit; 
            //print_r($questions);
            //echo count($submittedSurveyQtnIdsArray). "==" .count($surveyQtnIdsArray);
            //exit;

            $errorQtnIds = array();
            $errorQtnOptns = array();
            $optKey = 0;
            if (count($submittedSurveyQtnIdsArray) >= count($surveyQtnIdsArray)) {

                foreach ($questions as $questionKey => $questionValue) {

                    if (isset($questionValue['questionId']) && !empty($questionValue['questionId'])) {

                        $questionId = $questionValue['questionId'];

                        if (in_array($questionId, $surveyQtnIdsArray)) {

                            if (isset($questionValue['options']) && count($questionValue['options']) > 0) {
                                $options = $questionValue['options'];
                                //print_r($options);
                                foreach ($options as $optionKey => $optionValue) {

                                    //print_r($optionValue);
                                    if (!isset($optionValue['id']) || strlen(trim($optionValue['id'])) == 0 || !isset($optionValue['value']) || strlen(trim($optionValue['value'])) == 0) {

                                        $output['status'] = FALSE;
                                        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_questionnare_options_message');
                                        $output['response']['data']['questionId'] = $questionId;
                                        $output['response']['data']['optionId'] = $optionValue['id'];
                                        $output['response']['data']['optionValue'] = $optionValue['value'];
                                        $output['statusCode'] = STATUS_INVALID;
                                        return $output;
                                    } 
                                    else {
                                        $optionId = $optionValue['id'];
                                        $optionValue = strip_tags($optionValue['value']);

                                        $surveyQtnsOptsData = array();
                                        $where = array();
                                        $this->ci->Survey_questionnaire_option_model->resetVariable();
                                        $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
                                        $selectInput['validationType'] = $this->ci->Survey_questionnaire_option_model->validationType;
                                        $selectInput['optionType'] = $this->ci->Survey_questionnaire_option_model->optionType;
                                        $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
                                        $where[$this->ci->Survey_questionnaire_option_model->id] = $optionId;
                                        $this->ci->Survey_questionnaire_option_model->setWhere($where);
                                        $surveyQtnsOptsData = $this->ci->Survey_questionnaire_option_model->get();
                                        //print_r($surveyQtnsOptsData); //exit;
                                        if (count($surveyQtnsOptsData) > 0) {
                                            $validationType = $surveyQtnsOptsData[0]['validationType'];
                                            $optionType = $surveyQtnsOptsData[0]['optionType'];
                                            //$validationType = "number";
                                            if (trim($validationType) != "" && $validationType != "null") {

                                                //echo $optionId."=>".$validationType."==".$optionValue.", ";

                                                if ($validationType === "string") {
                                                    
                                                    if (!is_string($optionValue)) {                                                        
                                                        $errorQtnOptns[$optKey]['id'] = $optionId;
                                                        $errorQtnOptns[$optKey]['message'] = $this->ci->lang->line('error_invalid_option_value_string');
                                                    }
                                                    
                                                } else if ($validationType === "number") {
                                                    
                                                    if (!is_numeric($optionValue)) {
                                                        $errorQtnOptns[$optKey]['id'] = $optionId;
                                                        $errorQtnOptns[$optKey]['message'] = $this->ci->lang->line('error_invalid_option_value_numeric');
                                                    }
                                                    
                                                } else if ($validationType === "decimal") {
                                                    
                                                    if (!is_numeric($optionValue)) {
                                                        $errorQtnOptns[$optKey]['id'] = $optionId;
                                                        $errorQtnOptns[$optKey]['message'] = $this->ci->lang->line('error_invalid_option_value_decimal');
                                                    } 
                                                    
                                                } else if ($validationType === "ratio") {
                                                    
                                                    $valArry = explode("/", $optionValue);
                                                    foreach($valArry as $val){
                                                        if (!is_numeric($val)) {
                                                            $errorQtnOptns[$optKey]['id'] = $optionId;
                                                            $errorQtnOptns[$optKey]['message'] = $this->ci->lang->line('error_invalid_option_value_numeric');
                                                        }
                                                    }
                                                }
                                            }
                                        }


                                        /*
                                          $output['status'] = TRUE;
                                          $output['statusCode'] = STATUS_OK;
                                          return $output;
                                         */
                                    }
                                    $optKey++;
                                } 
                                
                                //print_r($errorQtnOptns);exit;
                                
                            } else {
                                $output['status'] = FALSE;
                                $output['response']['messages'][] = $this->ci->lang->line('error_questionnare_options_empty_message');
                                $output['statusCode'] = STATUS_INVALID;
                                return $output;
                            }
                        }
                        /* else{                   
                          $output['status'] = TRUE;
                          $output['statusCode'] = STATUS_OK;
                          return $output;
                          } */
                    } else {
                        $output['status'] = FALSE;
                        ///$output['response']['data']['questionIds'] = $errorQtnIds;
                        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_question_index');
                        $output['statusCode'] = STATUS_INVALID;
                        return $output;
                    }
                }
                
                //print_r($errorQtnOptns); exit;
                if(count($errorQtnOptns)>0){
                    $output['status'] = FALSE;
                    $output['response']['data'][] = $errorQtnOptns;
                    $output['response']['messages'][] = $this->ci->lang->line('error_invalid_option_value_data_type');
                    $output['statusCode'] = STATUS_INVALID;
                    return $output;
                }
                 
            } else {

                foreach ($surveyQtnIdsArray as $questionKey => $questionValue) {
                    if (!in_array($questionValue, $submittedSurveyQtnIdsArray)) {
                        $errorQtnIds[] = $questionValue;
                    }
                }

                $output['status'] = FALSE;
                $output['response']['data']['questionIds'] = $errorQtnIds;
                $output['response']['messages'][] = $this->ci->lang->line('error_missing_mandatory_survey_questions');
                $output['statusCode'] = STATUS_INVALID;
                return $output;
            }
        } else {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_survey_message');
            $output['statusCode'] = STATUS_INVALID;
            return $output;
        }
    }

    public function getRedflagQuestionsIdsBySurveyId($surveyId = "", $type = "", $qtnIdsArray = "") {
        $redflag = "false";
        if ($surveyId != "") {
            $where = array();
            $this->ci->Survey_questionnaire_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
            $this->ci->Survey_questionnaire_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_model->status] = 1;
            $where[$this->ci->Survey_questionnaire_model->type] = $type;
            ///$where[$this->ci->Survey_questionnaire_model->mandatory] = 0;
            $where[$this->ci->Survey_questionnaire_model->severity] = "redflag";
            //$where[$this->ci->Survey_questionnaire_model->chiefComplaintLinking] = 0;
            $where[$this->ci->Survey_questionnaire_model->surveyId] = $surveyId;
            $this->ci->Survey_questionnaire_model->setWhere($where);
            $redflagSurveyQtnsData = $this->ci->Survey_questionnaire_model->get();

            if (count($redflagSurveyQtnsData) > 0) {
                $redflagSurveyQtnIdData = commonHelperGetIdArray($redflagSurveyQtnsData, 'id');
                $redflagSurveyQtnIdsArray = array_keys($redflagSurveyQtnIdData);

                foreach ($qtnIdsArray as $questionKey => $questionValue) {
                    if (in_array($questionValue, $redflagSurveyQtnIdsArray)) {
                        $redflag = "true";
                        //break;
                    }
                }
            }
        }
        return $redflag;
    }

    public function getRedflagQuestionsOptionsIdsBySurveyId($surveyId = "", $type = "", $qtnIdsArray = "") {
        $redflag = "false";
        if ($surveyId != "") {
            $redflagSurveyQtnsOptsData = array();
            $where = array();
            $this->ci->Survey_questionnaire_option_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
            $selectInput['surveyQuestionId'] = $this->ci->Survey_questionnaire_option_model->surveyQuestionId;
            $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_option_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_option_model->status] = 1;
            //$where[$this->ci->Survey_questionnaire_option_model->type] = $type;
            ///$where[$this->ci->Survey_questionnaire_option_model->mandatory] = 0;
            $where[$this->ci->Survey_questionnaire_option_model->severity] = "redflag";
            //$where[$this->ci->Survey_questionnaire_option_model->chiefComplaintLinking] = 0;
            $where[$this->ci->Survey_questionnaire_option_model->surveyId] = $surveyId;
            $this->ci->Survey_questionnaire_option_model->setWhere($where);
            $redflagSurveyQtnsOptsData = $this->ci->Survey_questionnaire_option_model->get();

            //print_r($redflagSurveyQtnsOptsData); //exit;

            if (count($redflagSurveyQtnsOptsData) > 0) {
                $redflagSurveyQtnIdData = commonHelperGetIdArray($redflagSurveyQtnsOptsData, 'surveyQuestionId');
                $redflagSurveyQtnIdsArray = array_keys($redflagSurveyQtnIdData);

                foreach ($qtnIdsArray as $questionKey => $questionValue) {
                    if (in_array($questionValue, $redflagSurveyQtnIdsArray)) {
                        $redflag = "true";
                        //break;
                    }
                }
            }
        }
        return $redflag;
    }

    public function createMedicalIncident($inputData) {
        ///print_r($inputData); exit;

        $surveyId = $inputData['surveyId'];
        $incidentType = $inputData['type'];
        $questions = $inputData['questions'];
        $hospitalId = "";
        $redflagQuestionId = "";
        $redflagOptionId = "";
        /////////////Check Questions Redflag Status ///////////
        $qtnIdData = commonHelperGetIdArray($questions, 'questionId');
        $qtnIdsArray = array_keys($qtnIdData);
        $redflagStatus = $this->getRedflagQuestionsIdsBySurveyId($surveyId, $type = "question", $qtnIdsArray);
        /////////////////////////////////////////////////////////////////

        if ($redflagStatus != "true") {
            /////////////Check Questions and Options as Mandatory ///////////
            $checkData = $this->checkQuestionsAndOptionsAsMandatory($surveyId, $type = "question", $questions, $incidentType);
            if ($checkData != "") {
                return $checkData;
            }
            /////////////////////////////////////////////////////////////////
        } else {
            
            if (isset($inputData['hospitalId'])) {
                $hospitalId = $inputData['hospitalId'];
            }
            if (isset($inputData['questionId'])) {
                $redflagQuestionId = $inputData['questionId'];
            }
            if (isset($inputData['optionId'])) {
                $redflagOptionId = $inputData['optionId'];
            }
        }
        //echo "hii";  exit;
        //echo $incidentType; exit;
        $followupIdData = array();
        if ($incidentType == "followup") {

            $medicalIncidentDetailId = $inputData['medicalIncidentDetailsId'];
            if ($medicalIncidentDetailId == "") {
                $output['status'] = FALSE;
                ///$output["response"]["messages"][] = ERROR_INVALID_INCIDENT;
                $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
                $output['statusCode'] = STATUS_NO_DATA;
                return $output;
            }

            $this->ci->Medicalincidentdetail_model->resetVariable();
            $selectInput = array();
            $where = array();
            $medIncdentsData = array();
            $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentdetail_model->medicalIncidentId;
            $selectInput['surveyId'] = $this->ci->Medicalincidentdetail_model->surveyId;
            $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
            $where[$this->ci->Medicalincidentdetail_model->id] = $medicalIncidentDetailId;
            //$where[$this->ci->Medicalincidentdetail_model->medicalIncidentDetailStatus] = "intiated";
            $this->ci->Medicalincidentdetail_model->setWhere($where);
            $this->ci->Medicalincidentdetail_model->setRecords(1);
            $medIncdentSurveyData = $this->ci->Medicalincidentdetail_model->get();
            //print_r($medIncdentSurveyData); exit;

            $medicalIncidentId = $medIncdentSurveyData[0]['medicalIncidentId'];
            $surveyId = $medIncdentSurveyData[0]['surveyId'];

            /*
              $medIncdentSurveyIdsArray = commonHelperGetIdArray($medIncdentSurveyData, 'surveyId');
              $medIncdentSurveyIds = array_keys($medIncdentSurveyIdsArray);
              print_r($medIncdentSurveyIds); exit;
             */

            $this->ci->Medicalincident_model->resetVariable();
            $selectInput = array();
            $where = array();
            $medicalIncidentData = array();
            $selectInput['id'] = $this->ci->Medicalincident_model->id;
            $selectInput['medicalIncidentCode'] = $this->ci->Medicalincident_model->medicalIncidentCode;
            $this->ci->Medicalincident_model->setSelect($selectInput);
            $where[$this->ci->Medicalincident_model->id] = $medicalIncidentId;
            $where[$this->ci->Medicalincident_model->medicalIncidentStatus] = "completed";
            $this->ci->Medicalincident_model->setWhere($where);
            $this->ci->Medicalincident_model->setRecords(1);
            $medicalIncidentData = $this->ci->Medicalincident_model->get();
            $medicalIncidentCode = $medicalIncidentData[0]['medicalIncidentCode'];
            //print_r($medicalIncidentData); exit;

            if (count($medicalIncidentData) == 0) {
                $output['status'] = FALSE;
                ///$output["response"]["messages"][] = ERROR_INVALID_INCIDENT;
                $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
                $output['statusCode'] = STATUS_NO_DATA;
                return $output;
            }

            $this->ci->Survey_model->resetVariable();

            $selectInput = array();
            $where = array();
            $selectInput['id'] = $this->ci->Survey_model->id;
            $this->ci->Survey_model->setSelect($selectInput);
            $where[$this->ci->Survey_model->parentId] = $surveyId;
            $this->ci->Survey_model->setWhereIns($where);
            //$this->ci->Survey_model->setRecords(1);
            $followupIdData = $this->ci->Survey_model->get();
            //print_r($followupIdData);  exit;            
        }

        $medicalRegistrationCode = $inputData["medicalRegistrationNumber"];
        //$chiefComplaintSymptoms = $inputData["chiefComplaintSymptoms"];        
        $patientData = $this->getPatientId($medicalRegistrationCode);
        ///print_r($patientData); exit; 

        if (count($patientData) > 0) {

            $patientId = $patientData[0]['id'];
            $createdby = $patientData[0]['createdby'];
            $medicalIncidentCount = $patientData[0]['medicalIncidentCount'];
            $medicalIncidentVisitCount = $patientData[0]['medicalIncidentVisitCount'];

            //echo $medicalIncidentCount.", ". $medicalIncidentVisitCount; exit;

            $chiefComplaintSymptoms = "";
            
            $medicalIncidentStatus = "initiated";
            $medicalIncidentDetailStatus = "initiated";
                    
            if ($incidentType == "followup") {
                if ($redflagStatus == "true") {
                    $mIStr = MEDICAL_NON_INCIDENT_STRING;
                    $mIVisitType = 'redflag';
                    $mIncidentType = 'nonincident';
                    
                    $medicalIncidentStatus = "completed";
                    $medicalIncidentDetailStatus = "completed";
                    
                } else {
                    $mIVisitType = 'followup';
                    $mIncidentType = 'nonincident';
                }

                $medicalIncidentVisitCount = $medicalIncidentVisitCount + 1;
            } 
            else {
                $medicalIncidentCount = $medicalIncidentCount + 1;
                $medicalIncidentVisitCount = $medicalIncidentVisitCount + 1;

                if ($redflagStatus == "true") {
                    $mIStr = MEDICAL_NON_INCIDENT_STRING;
                    $mIVisitType = 'redflag';
                    $mIncidentType = 'nonincident';
                    
                    $medicalIncidentStatus = "completed";
                    $medicalIncidentDetailStatus = "completed";
                }
                else {

                    if (isset($inputData["chiefComplaintSymptoms"]) && count($chiefComplaintSymptoms) > 0) {
                        $chiefComplaintSymptoms = $inputData["chiefComplaintSymptoms"];
                        $mIStr = MEDICAL_INCIDENT_STRING . $medicalIncidentCount;
                        $mIVisitType = 'incident';
                        $mIncidentType = 'incident';
                    } else {
                        $mIStr = MEDICAL_NON_INCIDENT_STRING;
                        $mIVisitType = 'nonincident';
                        $mIncidentType = 'nonincident';
                    }                                        
                }


                $medicalIncidentCode = $medicalRegistrationCode . "/" . $mIStr;

                $this->ci->Medicalincident_model->startTransaction();
                $this->ci->Medicalincident_model->insertUpdateArray[$this->ci->Medicalincident_model->patientId] = $patientId;
                $this->ci->Medicalincident_model->insertUpdateArray[$this->ci->Medicalincident_model->registrationDate] = $inputData["registrationDate"];
                $this->ci->Medicalincident_model->insertUpdateArray[$this->ci->Medicalincident_model->bcpUserId] = $inputData["bcp_user_id"];
                $this->ci->Medicalincident_model->insertUpdateArray[$this->ci->Medicalincident_model->medicalIncidentStatus] = $medicalIncidentStatus;
                $this->ci->Medicalincident_model->insertUpdateArray[$this->ci->Medicalincident_model->medicalIncidentCode] = $medicalIncidentCode;
                $medicalIncidentId = $this->ci->Medicalincident_model->insert_data($this->ci->Medicalincident_model->dbTable, $this->ci->Medicalincident_model->insertUpdateArray);
            }

            $medicalIncidentVisitCode = $medicalIncidentCode . "/" . MEDICAL_INCIDENT_VISIT_STRING . $medicalIncidentVisitCount;

            $this->ci->Medicalincidentdetail_model->insertUpdateArray[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $medicalIncidentId;
            $this->ci->Medicalincidentdetail_model->insertUpdateArray[$this->ci->Medicalincidentdetail_model->surveyId] = $inputData["surveyId"];
            $this->ci->Medicalincidentdetail_model->insertUpdateArray[$this->ci->Medicalincidentdetail_model->type] = $mIncidentType;
            $this->ci->Medicalincidentdetail_model->insertUpdateArray[$this->ci->Medicalincidentdetail_model->medicalIncidentDetailStatus] = $medicalIncidentDetailStatus;
            $incidentDetailId = $this->ci->Medicalincidentdetail_model->insert_data($this->ci->Medicalincidentdetail_model->dbTable, $this->ci->Medicalincidentdetail_model->insertUpdateArray);

            $this->ci->Medicalincidentvisit_model->insertUpdateArray[$this->ci->Medicalincidentvisit_model->medicalIncidentId] = $medicalIncidentId;
            $this->ci->Medicalincidentvisit_model->insertUpdateArray[$this->ci->Medicalincidentvisit_model->patientId] = $patientId;
            $this->ci->Medicalincidentvisit_model->insertUpdateArray[$this->ci->Medicalincidentvisit_model->bcpUserId] = $createdby;
            $this->ci->Medicalincidentvisit_model->insertUpdateArray[$this->ci->Medicalincidentvisit_model->type] = $mIVisitType;
            $this->ci->Medicalincidentvisit_model->insertUpdateArray[$this->ci->Medicalincidentvisit_model->registrationDate] = $inputData["registrationDate"];
            $this->ci->Medicalincidentvisit_model->insertUpdateArray[$this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode] = $medicalIncidentVisitCode;
            $incidentVisitId = $this->ci->Medicalincidentvisit_model->insert_data($this->ci->Medicalincidentvisit_model->dbTable, $this->ci->Medicalincidentvisit_model->insertUpdateArray);

            $patiendUpdateData = array();
            $patiendUpdateData['medical_incident_count'] = $medicalIncidentCount;
            $patiendUpdateData['medical_incident_visit_count'] = $medicalIncidentVisitCount;
            $this->ci->Patient_model->resetVariable();
            $where = array($this->ci->Patient_model->id => $patientId);
            $this->ci->Patient_model->setInsertUpdateData($patiendUpdateData);
            $this->ci->Patient_model->setWhere($where);
            $this->ci->Patient_model->update_data();


            if ($redflagStatus == "true") {
                ///print_r($hospitalId); exit;
                if (isset($hospitalId) && $hospitalId !="") {
                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->medicalIncidentDetailId] = $incidentDetailId;
                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->surveyQuestionId] = $redflagQuestionId;
                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->surveyQuestionOptionId] = $redflagOptionId;
                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->hospitalId] = $hospitalId;
                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->createdby] = $inputData["bcp_user_id"];
                    $bcphptlId = $this->ci->Bcpreferredhospital_model->insert_data($this->ci->Bcpreferredhospital_model->dbTable, $this->ci->Bcpreferredhospital_model->insertUpdateArray);

                }
            }

            $questions = $inputData['questions'];
            $surveyId = $inputData["surveyId"];

            $surQtnData['medical_incident_id'] = $medicalIncidentId;
            $surQtnData['medical_incident_detail_id'] = $incidentDetailId;
            $surQtnData['medical_incident_visit_id'] = $incidentVisitId;
            $surQtnData['survey_id'] = $surveyId;
            $surQtnData['registrationDate'] = $inputData["registrationDate"];
            $surQtnData['bcp_user_id'] = $inputData["bcp_user_id"];

            /////////////Save Survey Report//////
            $saveStatus = $this->saveQuestionnaireOptionData($surQtnData, $questions, $type = "question");
            /////////////////////////////////////           
            //print_r($saveStatus);
            //exit;

            $chiefComplaintsData = "";
            if (!empty($chiefComplaintSymptoms) && is_array($chiefComplaintSymptoms)) {
                $selectInput = array();
                $chiefComplaintsData = array();
                $where = array();
                $whereIns = array();
                $groupBy = array();

                $surveyOptionIds = $chiefComplaintSymptoms;
                ///$surveyQuestionID = $inputData['surveyQuestionID'];
                $this->ci->Survey_chief_complaint_mapping_model->resetVariable();
                $selectInput['chiefComplaintSurveyId'] = $this->ci->Survey_chief_complaint_mapping_model->chiefComplaintSurveyId;
                $where[$this->ci->Survey_chief_complaint_mapping_model->deleted] = 0;
                $where[$this->ci->Survey_chief_complaint_mapping_model->status] = 1;
                ///$where[$this->ci->Survey_chief_complaint_mapping_model->surveyQuestionId] = $surveyQuestionID;
                $whereIns[$this->ci->Survey_chief_complaint_mapping_model->surveyOptionId] = $surveyOptionIds;
                $groupBy[] = $this->ci->Survey_chief_complaint_mapping_model->chiefComplaintSurveyId;

                $this->ci->Survey_chief_complaint_mapping_model->setSelect($selectInput);
                $this->ci->Survey_chief_complaint_mapping_model->setWhere($where);
                $this->ci->Survey_chief_complaint_mapping_model->setWhereIns($whereIns);
                $this->ci->Survey_chief_complaint_mapping_model->setGroupBy($groupBy);
                ///$this->ci->Patient_model->setRecords(1);
                $chiefComplaintsData = $this->ci->Survey_chief_complaint_mapping_model->get();
            }


            try {
                if ($this->ci->Medicalincident_model->transactionStatusCheck() === FALSE) {
                    $this->ci->Medicalincident_model->rollBackLastTransaction();

                    $output['status'] = FALSE;
                    ///$output["response"]["messages"][] = ERROR_SOMETHING_WENT_WRONG;
                    $output['response']['messages'][] = $this->ci->lang->line('error_something_went_wrong_message');
                    $output['statusCode'] = STATUS_SERVER_ERROR;
                    return $output;
                } else {
                    $this->ci->Medicalincident_model->commitLastTransaction();

                    $output['status'] = TRUE;
                    ///$output["response"]["messages"][] = MEDICAL_INCIDENT_CREATED;
                    $output['response']['messages'][] = $this->ci->lang->line('success_medical_incident_create_message');
                    $output['response']['data']['redirectUrl'] = "redirectionUrl";
                    $output['response']['data']['medicalRegistrationCode'] = $medicalRegistrationCode;
                    $output['response']['data']['medicalIncidentCode'] = $medicalIncidentCode;
                    $output['response']['data']['medicalIncidentVisitCode'] = $medicalIncidentVisitCode;
                    $output['response']['data']['patientId'] = $patientId;
                    $output['response']['data']['medicalIncidentNumber'] = $medicalIncidentCount;
                    $output['response']['data']['medicalIncidentVisitNumber'] = $medicalIncidentVisitCount;
                    $output['response']['data']['medicalIncidentDetailsId'] = $incidentDetailId;
                    $output['response']['data']['medicalIncidentId'] = $medicalIncidentId;
                    $output['response']['data']['medicalIncidentVisitId'] = $incidentVisitId;

                    if (!empty($chiefComplaintsData)) {
                        $output['response']['data']['chiefComplaintsData'] = $chiefComplaintsData;
                    }

                    if (!empty($followupIdData)) {
                        $output['response']['data']['followupData'] = $followupIdData;
                    }

                    $output['statusCode'] = STATUS_CREATED;
                    return $output;
                }
            } catch (Exception $exc) {
                return $exc->message();
            }
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = PATIENT_NOT_EXIST;
            $output['response']['messages'][] = $this->ci->lang->line('error_patient_not_found_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
    }

    /*
      public function createMedicalIncident_back($inputData) {
      ///print_r($inputData); exit;

      $medicalRegistrationCode = $inputData["medicalRegistrationNumber"];
      $patientdata = $this->getPatientId($medicalRegistrationCode);

      if (count($patientdata) > 0) {

      $patientId = $patientdata[0]['id'];

      $this->ci->Medicalincident_model->startTransaction();
      $this->ci->Medicalincident_model->insertUpdateArray['patient_id'] = $patientId;
      $this->ci->Medicalincident_model->insertUpdateArray['registration_date'] = $inputData["registrationDate"];
      $this->ci->Medicalincident_model->insertUpdateArray['bcp_user_id'] = $inputData["bcp_user_id"];
      $medicalIncidentId = $this->ci->Medicalincident_model->insert_data($this->ci->Medicalincident_model->dbTable, $this->ci->Medicalincident_model->insertUpdateArray);

      $medicalIncident = $this->checkMedicalIncident($medicalRegistrationCode);

      //print_r($medicalIncident); //exit;
      if ((count($medicalIncident) == 0)) {
      $val1 = 1;
      $medicalIncidentCode = $medicalRegistrationCode . "/" . MEDICAL_INCIDENT_STRING . $val1;
      $medicalIncidentData['medical_incident_code'] = $medicalIncidentCode;
      } else {

      $explodeMedicalIncident = explode("/", $medicalIncident[0]['medical_incident_code']);
      $mIncCode = end($explodeMedicalIncident);
      $val1 = $this->returnIntValFromString($mIncCode);
      $val1 = $val1 + 1;
      $medicalIncidentCode = $medicalRegistrationCode . "/" . MEDICAL_INCIDENT_STRING . $val1;
      $medicalIncidentData['medical_incident_code'] = $medicalIncidentCode;
      }

      ///print_r($medicalIncidentData);exit;

      $this->ci->Medicalincident_model->resetVariable();
      $where = array($this->ci->Medicalincident_model->id => $medicalIncidentId);
      $this->ci->Medicalincident_model->setInsertUpdateData($medicalIncidentData);
      $this->ci->Medicalincident_model->setWhere($where);
      $this->ci->Medicalincident_model->update_data();

      $this->ci->Medicalincidentdetail_model->insertUpdateArray['medical_incident_id'] = $medicalIncidentId;
      $this->ci->Medicalincidentdetail_model->insertUpdateArray['survey_id'] = $inputData["surveyId"];
      $incidentDetailId = $this->ci->Medicalincidentdetail_model->insert_data($this->ci->Medicalincidentdetail_model->dbTable, $this->ci->Medicalincidentdetail_model->insertUpdateArray);

      $this->ci->Medicalincidentvisit_model->insertUpdateArray['medical_incident_id'] = $medicalIncidentId;
      $this->ci->Medicalincidentvisit_model->insertUpdateArray['patient_id'] = $patientId;
      $this->ci->Medicalincidentvisit_model->insertUpdateArray['registration_date'] = $inputData["registrationDate"];
      $incidentVisitId = $this->ci->Medicalincidentvisit_model->insert_data($this->ci->Medicalincidentvisit_model->dbTable, $this->ci->Medicalincidentvisit_model->insertUpdateArray);

      $medicalIncidentVisit = $this->checkMedicalIncidentVisit($medicalIncidentCode);

      if (count($medicalIncidentVisit) == 0) {
      $this->ci->Medicalincidentvisit_model->resetVariable();
      $val2 = 1;
      $medical_incident_visit_code = $medicalIncidentCode . "/" . MEDICAL_INCIDENT_VISIT_STRING . $val2;
      $medicalIncidentVisitData['medical_incident_visit_code'] = $medical_incident_visit_code;
      $where = array($this->ci->Medicalincidentvisit_model->id => $incidentVisitId);
      $this->ci->Medicalincidentvisit_model->setInsertUpdateData($medicalIncidentVisitData);
      $this->ci->Medicalincidentvisit_model->setWhere($where);
      $this->ci->Medicalincidentvisit_model->update_data();
      } else {
      $explodeMedicalIncidentVisit = explode("/", $medicalIncidentVisit[0]['medical_incident_visit_code']);
      $this->ci->Medicalincidentvisit_model->resetVariable();

      $mIncVisitCode = end($explodeMedicalIncidentVisit);
      $val2 = $this->returnIntValFromString($mIncVisitCode);
      $val2 = $val2 + 1;

      $medical_incident_visit_code = $medicalIncidentCode . "/" . MEDICAL_INCIDENT_VISIT_STRING . $val2;
      $medicalIncidentVisitData['medical_incident_visit_code'] = $medical_incident_visit_code;

      $where = array($this->ci->Medicalincidentvisit_model->id => $incidentVisitId);
      $this->ci->Medicalincidentvisit_model->setInsertUpdateData($medicalIncidentVisitData);
      $this->ci->Medicalincidentvisit_model->setWhere($where);
      $this->ci->Medicalincidentvisit_model->update_data();
      }

      $questions = $inputData['questions'];

      foreach ($questions as $questionKey => $questionValue) {

      if (!empty($questionValue['options']) && count($questionValue['options']) > 0) {
      $options = $questionValue['options'];
      foreach ($options as $optionKey => $optionValue) {
      if ($optionValue != "") {
      $this->ci->Medicalsurveyreport_model->insertUpdateArray['medical_incident_detail_id'] = $incidentDetailId;
      $this->ci->Medicalsurveyreport_model->insertUpdateArray['medical_incident_visit_id'] = $incidentVisitId;
      $this->ci->Medicalsurveyreport_model->insertUpdateArray['survey_id'] = $inputData["surveyId"];
      $this->ci->Medicalsurveyreport_model->insertUpdateArray['survey_question_id'] = $questionValue['questionId'];

      $this->ci->Medicalsurveyreport_model->insertUpdateArray['survey_question_option_id'] = $optionValue['id'];
      $this->ci->Medicalsurveyreport_model->insertUpdateArray['survey_question_option_value'] = $optionValue['value'];

      $this->ci->Medicalsurveyreport_model->insertUpdateArray['registration_date'] = $inputData["registrationDate"];
      $this->ci->Medicalsurveyreport_model->insert_data($this->ci->Medicalsurveyreport_model->dbTable, $this->ci->Medicalsurveyreport_model->insertUpdateArray);
      }
      }
      }
      }


      if (isset($inputData["chiefComplaintSymptoms"])) {
      $chiefComplaintSymptoms = $inputData["chiefComplaintSymptoms"];
      } else {
      $chiefComplaintSymptoms = "";
      }

      $chiefComplaintsData = "";
      if (!empty($chiefComplaintSymptoms) && is_array($chiefComplaintSymptoms)) {
      $selectInput = array();
      $chiefComplaintsData = array();
      $where = array();
      $whereIns = array();
      $groupBy = array();

      $surveyOptionIds = $chiefComplaintSymptoms;
      ///$surveyQuestionID = $inputData['surveyQuestionID'];
      $this->ci->Survey_chief_complaint_mapping_model->resetVariable();
      $selectInput['chiefComplaintSurveyId'] = $this->ci->Survey_chief_complaint_mapping_model->chiefComplaintSurveyId;
      $where[$this->ci->Survey_chief_complaint_mapping_model->deleted] = 0;
      $where[$this->ci->Survey_chief_complaint_mapping_model->status] = 1;
      ///$where[$this->ci->Survey_chief_complaint_mapping_model->surveyQuestionId] = $surveyQuestionID;
      $whereIns[$this->ci->Survey_chief_complaint_mapping_model->surveyOptionId] = $surveyOptionIds;
      $groupBy[] = $this->ci->Survey_chief_complaint_mapping_model->chiefComplaintSurveyId;

      $this->ci->Survey_chief_complaint_mapping_model->setSelect($selectInput);
      $this->ci->Survey_chief_complaint_mapping_model->setWhere($where);
      $this->ci->Survey_chief_complaint_mapping_model->setWhereIns($whereIns);
      $this->ci->Survey_chief_complaint_mapping_model->setGroupBy($groupBy);
      ///$this->ci->Patient_model->setRecords(1);
      $chiefComplaintsData = $this->ci->Survey_chief_complaint_mapping_model->get();
      }

      try {
      if ($this->ci->Medicalincident_model->transactionStatusCheck() === FALSE) {
      $this->ci->Medicalincident_model->rollBackLastTransaction();

      $output['status'] = FALSE;
      ///$output["response"]["messages"][] = ERROR_SOMETHING_WENT_WRONG;
      $output['response']['messages'][] = $this->ci->lang->line('error_something_went_wrong_message');
      $output['statusCode'] = STATUS_SERVER_ERROR;
      return $output;
      } else {
      $this->ci->Medicalincident_model->commitLastTransaction();

      $output['status'] = TRUE;
      ///$output["response"]["messages"][] = MEDICAL_INCIDENT_CREATED;
      $output['response']['messages'][] = $this->ci->lang->line('success_medical_incident_create_message');
      $output['response']['data']['redirectUrl'] = "redirectionUrl";
      $output['response']['data']['medicalRegistrationCode'] = $medicalRegistrationCode;
      $output['response']['data']['medicalIncidentCode'] = $medicalIncidentCode;
      $output['response']['data']['medicalIncidentVisitCode'] = $medical_incident_visit_code;
      $output['response']['data']['patientId'] = $patientId;
      $output['response']['data']['medicalIncidentNumber'] = $val1;
      $output['response']['data']['medicalIncidentVisitNumber'] = $val2;
      $output['response']['data']['medicalIncidentDetailsId'] = $incidentDetailId;
      $output['response']['data']['medicalIncidentVisitId'] = $incidentVisitId;

      if (!empty($chiefComplaintsData)) {
      $output['response']['data']['chiefComplaintsData'] = $chiefComplaintsData;
      }
      $output['statusCode'] = STATUS_CREATED;
      return $output;
      }
      } catch (Exception $exc) {
      return $exc->message();
      }
      } else {
      $output['status'] = FALSE;
      ///$output["response"]["messages"][] = PATIENT_NOT_EXIST;
      $output['response']['messages'][] = $this->ci->lang->line('error_patient_not_found_message');
      $output['statusCode'] = STATUS_NO_DATA;
      return $output;
      }
      }
     */

    public function patientRegistration($inputData) {
        ///print_r($inputData); exit;
        $type = $inputData["type"];
        $surveyId = $inputData["surveyId"];
        $questions = $inputData["questions"];
        
        /////////////Check Questions Redflag Status ////////////////////
        $qtnIdData = commonHelperGetIdArray($questions, 'questionId');
        $qtnIdsArray = array_keys($qtnIdData);
        ///print_r($qtnIdsArray); exit;
        $redflagStatus = $this->getRedflagQuestionsOptionsIdsBySurveyId($surveyId, $type = "question", $qtnIdsArray);
        //print_r($redflagStatus);
        /////////////////////////////////////////////////////////////////        

        if ($redflagStatus != "true") {
            /////////////Check Questions and Options as Mandatory ///////////
            $checkData = $this->checkQuestionsAndOptionsAsMandatory($surveyId, $type = "question", $questions, $incidentType = "");
            if ($checkData != "") {
                return $checkData;
            }
            /////////////////////////////////////////////////////////////////
        }

        $this->ci->Patient_model->resetVariable();
        $selectInput = array();
        $selectInput['id'] = $this->ci->Patient_model->id;
        $this->ci->Patient_model->setSelect($selectInput);
        $where[$this->ci->Patient_model->bcpUserId] = $inputData["bcp_user_id"];
        $this->ci->Patient_model->setWhere($where);
        $patientCount = $this->ci->Patient_model->getCount();
        $patientCount = $patientCount + 1;

        $medicalRegistrationCode = getMedicalRegistrationCode();
        $medical_registration_code = $medicalRegistrationCode . MEDICAL_RECORD_STRING . $patientCount;

        $address = "";
        if (isset($inputData["houseNo"]) && !empty($inputData["houseNo"])) {
            $address .= $inputData["houseNo"] . ',';
        }
        if (isset($inputData["block"]) && !empty($inputData["block"])) {
            $address .= $inputData["block"] . ',';
        }
        if (isset($inputData["streetName"]) && !empty($inputData["streetName"])) {
            $address .= $inputData["streetName"] . ',';
        }
        if (isset($inputData["area"]) && !empty($inputData["area"])) {
            $address .= $inputData["area"];
        }


        $this->ci->Patient_model->startTransaction();
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->medicalRegistrationNumber] = $medical_registration_code;
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->title] = strip_tags($inputData["title"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->firstName] = strip_tags($inputData["firstName"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->middleName] = strip_tags($inputData["middleName"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->lastName] = strip_tags($inputData["lastName"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->profilePicture] = $inputData["profilePicture"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->registrationDate] = $inputData["registrationDate"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->age] = $inputData["age"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->dateofBirth] = $inputData["dateofBirth"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->gender] = $inputData["gender"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->guardianName] = strip_tags($inputData["guardianName"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->guardianRelation] = strip_tags($inputData["guardianRelation"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->caste] = strip_tags($inputData["caste"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->religion] = strip_tags($inputData["religion"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->maritalStatus] = strip_tags($inputData["maritalStatus"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->occupation] = strip_tags($inputData["occupation"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->education] = strip_tags($inputData["education"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->contactNumber] = $inputData["contactNumber"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->alternateContactNumber] = $inputData["alternateContactNumber"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactName] = $inputData["emergencyContactName"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactRelation] = strip_tags($inputData["emergencyContactRelation"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactNumber] = $inputData["emergencyContactNumber"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->address] = strip_tags($address);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->houseNo] = strip_tags($inputData["houseNo"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->block] = strip_tags($inputData["block"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->streetName] = strip_tags($inputData["streetName"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->area] = strip_tags($inputData["area"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->countryId] = $inputData["countryId"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->stateId] = $inputData["stateId"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->cityId] = $inputData["cityId"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->villageName] = strip_tags($inputData["villageName"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->pincode] = $inputData["pincode"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->idProofType] = $inputData["idProofType"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->idProofNo] = $inputData["idProofNo"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->bcpUserId] = $inputData["bcp_user_id"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->createdby] = $inputData["bcp_user_id"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->modifiedby] = $inputData["bcp_user_id"];
        $patientId = $this->ci->Patient_model->insert_data($this->ci->Patient_model->dbTable, $this->ci->Patient_model->insertUpdateArray);
        if ($patientId != '') {

            $questions = $inputData['questions'];
            $chiefComplaintSymptoms = $inputData['chiefComplaintSymptoms'];
            $mediacalIncidentData = array(
                "medicalRegistrationNumber" => $medical_registration_code,
                "registrationDate" => $inputData["registrationDate"],
                "bcp_user_id" => $inputData["bcp_user_id"],
                "surveyId" => $inputData["surveyId"],
                "questions" => $questions,
                "chiefComplaintSymptoms" => $chiefComplaintSymptoms,
                "type" => $type
            );

            ///return $this->createMedicalIncident($mediacalIncidentData);

            $response = $this->createMedicalIncident($mediacalIncidentData);

            if ($this->ci->Patient_model->transactionStatusCheck() === FALSE) {
                $this->ci->Patient_model->rollBackLastTransaction();

                $output['status'] = FALSE;
                ///$output["response"]["messages"][] = ERROR_SOMETHING_WENT_WRONG;
                $output['response']['messages'][] = $this->ci->lang->line('error_something_went_wrong_message');
                $output['statusCode'] = STATUS_SERVER_ERROR;
                return $output;
            } else {
                $this->ci->Patient_model->commitLastTransaction();
                return $response;
            }
        }
    }

    public function getMedicalIncidents($limit = 100, $page = 0) {

        $hff_media_path = $this->ci->config->item('hff_media_path');

        $bcpUserId = $this->ci->session->userid;
        $userRole = $this->ci->session->userrole;

        $selectInput = array();
        $medicalIncidentData = array();
        $where = array();
        $groupByArray = array();
        //$selectInput['id'] =$this->ci->Medicalincident_model->id ;
        $selectInput['medicalIncidentCode'] = $this->ci->Medicalincident_model->medicalIncidentCode;
        $selectInput['patientId'] = $this->ci->Medicalincident_model->patientId;
        //$selectInput['bcpUserId'] =$this->ci->Medicalincident_model->bcpUserId;
        $selectInput['registrationDate'] = $this->ci->Medicalincident_model->registrationDate;

        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;

        if ($userRole == 'bcp') {
            $where[$this->ci->Medicalincident_model->bcpUserId] = $bcpUserId;
        }

        $this->ci->Medicalincident_model->setSelect($selectInput);
        $this->ci->Medicalincident_model->setWhere($where);
        $this->ci->Medicalincident_model->setGroupBy($this->ci->Medicalincident_model->medicalIncidentCode);
        $ordetByArr[] = $this->ci->Medicalincident_model->registrationDate . " Desc ";
        $this->ci->Medicalincident_model->setOrderBy($ordetByArr);
        if (($limit > 100) || ($limit == '')) {
            $limit = 100;
        }
        if ($page > 0) {
            $page = ($page - 1);
            $page = ($limit) * $page;
        }
        $this->ci->Medicalincident_model->setRecords($limit, $page);
        $medicalIncidentData = $this->ci->Medicalincident_model->get();
        //print_r($medicalIncidentData); exit;

        if (count($medicalIncidentData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $patientData = "";
        for ($i = 0; $i < count($medicalIncidentData); $i++) {
            $patientId = $medicalIncidentData[$i]['patientId'];
            $patientData = $this->getPatientDetails("id", $patientId);  ////$getByField = "id", $getByValue = $patientId;  
            //print_r($patientData);exit;
            $medicalIncidentData[$i]['patientData'] = $patientData;
        }


        $output['status'] = TRUE;
        $output['response']['medicalIncidentData'] = $medicalIncidentData;
        $outout['response']['total'] = count($medicalIncidentData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getMedicalIncidentsOfPatient($medicalRegistrationCode, $limit = 100, $page = 0) {

        $hff_media_path = $this->ci->config->item('hff_media_path');

        $patientData = "";
        $patientData = $this->getPatientDetails("mrcode", $medicalRegistrationCode);  ////$getByField = "id", $getByValue = $patientId;  

        if (count($patientData) == 0) {
            $output['status'] = TRUE;
            //$output['response']['message'][] = ERROR_NO_PATIENT;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }

        ///print_r($patientData); exit;
        $patientId = $patientData[0]['id'];

        $selectInput = array();
        $medicalIncidentData = array();
        $where = array();
        $groupByArray = array();
        //$selectInput['id'] =$this->ci->Medicalincident_model->id ;
        $selectInput['medicalIncidentCode'] = $this->ci->Medicalincident_model->medicalIncidentCode;
        // $selectInput['patientId'] =$this->ci->Medicalincident_model->patientId;
        //$selectInput['bcpUserId'] =$this->ci->Medicalincident_model->bcpUserId;
        $selectInput['registrationDate'] = $this->ci->Medicalincident_model->registrationDate;

        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;

        $where[$this->ci->Medicalincident_model->patientId] = $patientId;

        $this->ci->Medicalincident_model->setSelect($selectInput);
        $this->ci->Medicalincident_model->setWhere($where);
        $this->ci->Medicalincident_model->setGroupBy($this->ci->Medicalincident_model->medicalIncidentCode);
        $ordetByArr[] = $this->ci->Medicalincident_model->registrationDate . " Desc ";
        $this->ci->Medicalincident_model->setOrderBy($ordetByArr);
        if (($limit > 100) || ($limit == '')) {
            $limit = 100;
        }
        if ($page > 0) {
            $page = ($page - 1);
            $page = ($limit) * $page;
        }
        $this->ci->Medicalincident_model->setRecords($limit, $page);
        $medicalIncidentData = $this->ci->Medicalincident_model->get();

        if (count($medicalIncidentData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['patientData'] = $patientData;
        $output['response']['medicalIncidentData'] = $medicalIncidentData;
        $outout['response']['total'] = count($medicalIncidentData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function searchMedicalIncidentsOfPatient($inputData) {
        //print_R($inputData); exit;
        $this->patientHandler = new Patient_handler();

        $patientData = "";
        if (isset($inputData['medicalRegistrationCode']) && !empty($inputData['medicalRegistrationCode'])) {

            $patientData = $this->patientHandler->getPatientBasicDetails($inputData, "mrcode");
        } else {
            $patientData = $this->patientHandler->getPatientBasicDetails($inputData, "search");
        }
        //print_r($patientData); exit;

        if (count($patientData) == 0) {
            $output['status'] = TRUE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_patient_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $patientIdData = commonHelperGetIdArray($patientData, 'id');
        $patientIdsArray = array_keys($patientIdData);

        ///print_r($patientIdData); exit;

        $selectInput = array();
        $medicalIncidentData = array();
        $where = array();
        $groupByArray = array();
        $whereIns = array();

        $selectInput['medicalIncidentId'] = $this->ci->Medicalincident_model->id;
        $selectInput['medicalIncidentCode'] = $this->ci->Medicalincident_model->medicalIncidentCode;
        $selectInput['patientId'] = $this->ci->Medicalincident_model->patientId;
        $selectInput['registrationDate'] = $this->ci->Medicalincident_model->registrationDate;
        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;
        $where[$this->ci->Medicalincident_model->medicalIncidentStatus] = "completed";
        $whereIns[$this->ci->Medicalincident_model->patientId] = $patientIdsArray;
        $this->ci->Medicalincident_model->setSelect($selectInput);
        $this->ci->Medicalincident_model->setWhere($where);
        $this->ci->Medicalincident_model->setWhereIns($whereIns);
        $ordetByArr[] = $this->ci->Medicalincident_model->registrationDate . " Desc ";
        $this->ci->Medicalincident_model->setOrderBy($ordetByArr);
        $medicalIncidentData = $this->ci->Medicalincident_model->get();
        //print_r($medicalIncidentData); exit;

        if (count($medicalIncidentData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $medicalIncidentIdData = commonHelperGetIdArray($medicalIncidentData, 'medicalIncidentId');
        $medicalIncidentIdsArray = array_keys($medicalIncidentIdData);

        $reMedicalIncidentIdData = commonHelperGetIdArray($medicalIncidentData, 'patientId');
        $reMedicalIncidentIdsArray = array_keys($reMedicalIncidentIdData);

        ///print_r($medicalIncidentIdData); exit;
               
        $selectInput = array();
        $medicalIncidentDetailData = array();
        $where = array();
        $whereIns = array();
        $selectInput['medicalIncidentDetailId'] = $this->ci->Medicalincidentdetail_model->id;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentdetail_model->medicalIncidentId;
        $selectInput['surveyId'] = $this->ci->Medicalincidentdetail_model->surveyId;
        $where[$this->ci->Medicalincidentdetail_model->deleted] = 0;
        $where[$this->ci->Medicalincidentdetail_model->status] = 1;
        $where[$this->ci->Medicalincidentdetail_model->type] = "incident";
        $where[$this->ci->Medicalincidentdetail_model->medicalIncidentDetailStatus] = "completed";
        $whereIns[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $medicalIncidentIdsArray;
        ///$whereIns[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $medicalIncidentVisitIdsArray;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $this->ci->Medicalincidentdetail_model->setWhereIns($whereIns);
        $medicalIncidentDetailData = $this->ci->Medicalincidentdetail_model->get();
        //print_r($medicalIncidentDetailData); exit;

        if (count($medicalIncidentDetailData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $medicalIncidentDetailIdsData = commonHelperGetIdArray($medicalIncidentDetailData, 'medicalIncidentDetailId');
        $medicalIncidentDetailIdArray = array_keys($medicalIncidentDetailIdsData);
        //print_r($medicalIncidentDetailIdsData); exit;

        $reMedicalIncidentDetailIdsData = commonHelperGetIdArray($medicalIncidentDetailData, 'medicalIncidentId');
        $reMedicalIncidentDetailIdArray = array_keys($reMedicalIncidentDetailIdsData);

        //print_r($medicalIncidentIdData); //exit;
        //print_r($medicalIncidentDetailIdsData); exit;

        /*
          foreach($medicalIncidentDetailIdsData as $mKey => $mVal){
          $medicalIncidentDetailIdsData[$mKey]['medicalIncidentCode'] = $medicalIncidentIdData[$mKey]['medicalIncidentCode'];
          $medicalIncidentDetailIdsData[$mKey]['patientId'] = $medicalIncidentIdData[$mKey]['patientId'];
          $medicalIncidentDetailIdsData[$mKey]['registrationDate'] = $medicalIncidentIdData[$mKey]['registrationDate'];
          } */

        foreach ($medicalIncidentDetailIdsData as $mKey => $mVal) {
            $medicalIncidentId = $mVal['medicalIncidentId'];
            if (array_key_exists($medicalIncidentId, $medicalIncidentIdData)) {
                $medicalIncidentDetailIdsData[$mKey]['medicalIncidentCode'] = $medicalIncidentIdData[$medicalIncidentId]['medicalIncidentCode'];
                $medicalIncidentDetailIdsData[$mKey]['patientId'] = $medicalIncidentIdData[$medicalIncidentId]['patientId'];
                $medicalIncidentDetailIdsData[$mKey]['registrationDate'] = $medicalIncidentIdData[$medicalIncidentId]['registrationDate'];
            }
        }
        //print_r($medicalIncidentDetailIdsData); exit;


        $surveyIdsData = commonHelperGetIdArray($medicalIncidentDetailData, 'surveyId');
        $surveyIdArray = array_keys($surveyIdsData);
        //print_r($surveyIdArray); exit;

        $this->ci->Survey_model->resetVariable();
        $selectInput = array();
        $surveyData = array();
        $where = array();
        $whereIn = array();
        $surveyQuestionnaireData = array();
        $selectInput['id'] = $this->ci->Survey_model->id;
        $selectInput['name'] = $this->ci->Survey_model->name;
        $this->ci->Survey_model->setSelect($selectInput);
        $where[$this->ci->Survey_model->deleted] = 0;
        $where[$this->ci->Survey_model->status] = 1;
        $whereIn[$this->ci->Survey_model->id] = $surveyIdArray;
        $this->ci->Survey_model->setWhereIns($whereIn);
        $this->ci->Survey_model->setWhere($where);
        $surveyData = $this->ci->Survey_model->get();
        if (count($surveyData) == 0) {
            $output['status'] = TRUE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $reSurveyIdsData = commonHelperGetIdArray($surveyData, 'id');
        $reSurveyIdArray = array_keys($reSurveyIdsData);
        $finalPatientData = array();
        foreach ($medicalIncidentDetailIdsData as $skey => $sval) {
            $patientId = $sval['patientId'];
            $surveyId = $sval['surveyId'];
            $surveyName = "";
            if (array_key_exists($surveyId, $reSurveyIdsData)) {
                $surveyName = $reSurveyIdsData[$surveyId]['name'];
            }
            $medicalIncidentDetailIdsData[$skey]['surveyName'] = $surveyName;

            if (array_key_exists($patientId, $patientIdData)) {
                $patientIdData[$patientId]['medicalIncidentData'][] = $medicalIncidentDetailIdsData[$skey];
                $finalPatientData[$patientId] = $patientIdData[$patientId];
            }
        }
        //print_r($finalPatientData); exit;
        $finalPatientData = array_values($finalPatientData);
        if (count($finalPatientData) == 0) {
            $output['status'] = TRUE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['patientData']['patientDetails'] = $finalPatientData;
        $outout['response']['total'] = count($finalPatientData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getMedicalIncidentVisits($medicalIncident) {
        //echo $medicalIncident; exit;
        $hff_media_path = $this->ci->config->item('hff_media_path');
        $docId = $this->ci->session->userid;

        $this->ci->Medicalincidentvisit_model->resetVariable();
        $selectInput = array();
        $bcpAssignmentData = array();
        $where = array();
        $whereInArray = array();

//        $selectInput['bcpId'] = $this->ci->Bcpassignment_model->bcpId;
        $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->medicalIncidentId;
        $selectInput['registration_date'] = $this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->registrationDate;
        $selectInput['status'] = $this->ci->Medicalincident_model->dbTable . '.' . $this->ci->Medicalincident_model->medicalIncidentStatus;
        $selectInput['pid'] = $this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->id;
        $selectInput['pfirst_name'] = $this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->firstName;
        $selectInput['pmiddle_name'] = $this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->middleName;
        $selectInput['plast_name'] = $this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->lastName;
        $selectInput['bfirst_name'] = $this->ci->User_model->dbTable . '.' . $this->ci->User_model->firstName;
        $selectInput['blast_name'] = $this->ci->User_model->dbTable . '.' . $this->ci->User_model->lastName;
        $selectInput['bcpId'] = $this->ci->User_model->dbTable . '.' . $this->ci->User_model->id;
        $selectInput['mr_code'] = $this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->medicalRegistrationNumber;

        $join_array = array($this->ci->Medicalincident_model->dbTable . '.' . $this->ci->Medicalincident_model->id, $this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->medicalIncidentId);
        $this->ci->Medicalincidentvisit_model->join($this->ci->Medicalincident_model->dbTable, $join_array);
        $join_array = array($this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->id, $this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->patientId);
        $this->ci->Medicalincidentvisit_model->join($this->ci->Patient_model->dbTable, $join_array);
        $join_array = array($this->ci->User_model->dbTable . '.' . $this->ci->User_model->id, $this->ci->Medicalincident_model->dbTable . '.' . $this->ci->Medicalincident_model->bcpUserId);
        $this->ci->Medicalincidentvisit_model->join($this->ci->User_model->dbTable, $join_array);
        $join_array = array($this->ci->Bcpassignment_model->dbTable . '.' . $this->ci->Bcpassignment_model->bcpId, $this->ci->Medicalincident_model->dbTable . '.' . $this->ci->Medicalincident_model->bcpUserId);
        $this->ci->Medicalincidentvisit_model->join($this->ci->Bcpassignment_model->dbTable, $join_array);

//        $where[$this->ci->Bcpassignment_model->dbTable.'.'.$this->ci->Bcpassignment_model->status] = 1;
        $where[$this->ci->Bcpassignment_model->dbTable . '.' . $this->ci->Bcpassignment_model->doctorId] = $docId;
//        $where[$this->ci->Medicalincident_model->medicalIncidentStatus] = 'completed';

        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);
        $this->ci->Medicalincidentvisit_model->setRecords($medicalIncident['records'], $medicalIncident['offset']);
        $this->ci->Medicalincidentvisit_model->setOrderBy(array($this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->id . ' DESC'));
        $like[$this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode] = $medicalIncident['search'];
        $like[$this->ci->User_model->dbTable . '.' . $this->ci->User_model->firstName] = $medicalIncident['search'];
        $like[$this->ci->User_model->dbTable . '.' . $this->ci->User_model->lastName] = $medicalIncident['search'];
        $like[$this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->firstName] = $medicalIncident['search'];
        $like[$this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->middleName] = $medicalIncident['search'];
        $like[$this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->lastName] = $medicalIncident['search'];
        $like[$this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->medicalRegistrationNumber] = $medicalIncident['search'];
        $this->ci->Medicalincidentvisit_model->setOrWhere($like, 'or', 'like');
//        $this->ci->Medicalincidentvisit_model->setOrderBy(array($this->ci->Medicalincidentvisit_model->dbTable.'.'.$this->ci->Medicalincidentvisit_model->id.' DESC'));
        $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();




        $this->ci->Medicalincidentvisit_model->resetVariable();
        $selectInput = array();
        $bcpAssignmentData = array();
        $where = array();
        $whereInArray = array();

        $selectInput['mr_code'] = $this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->medicalRegistrationNumber;

        $join_array = array($this->ci->Medicalincident_model->dbTable . '.' . $this->ci->Medicalincident_model->id, $this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->medicalIncidentId);
        $this->ci->Medicalincidentvisit_model->join($this->ci->Medicalincident_model->dbTable, $join_array);
        $join_array = array($this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->id, $this->ci->Medicalincident_model->dbTable . '.' . $this->ci->Medicalincident_model->patientId);
        $this->ci->Medicalincidentvisit_model->join($this->ci->Patient_model->dbTable, $join_array);
        $join_array = array($this->ci->User_model->dbTable . '.' . $this->ci->User_model->id, $this->ci->Medicalincident_model->dbTable . '.' . $this->ci->Medicalincident_model->bcpUserId);
        $this->ci->Medicalincidentvisit_model->join($this->ci->User_model->dbTable, $join_array);
        $join_array = array($this->ci->Bcpassignment_model->dbTable . '.' . $this->ci->Bcpassignment_model->bcpId, $this->ci->Medicalincident_model->dbTable . '.' . $this->ci->Medicalincident_model->bcpUserId);
        $this->ci->Medicalincidentvisit_model->join($this->ci->Bcpassignment_model->dbTable, $join_array);

//        $where[$this->ci->Bcpassignment_model->dbTable.'.'.$this->ci->Bcpassignment_model->status] = 1;
        $where[$this->ci->Bcpassignment_model->dbTable . '.' . $this->ci->Bcpassignment_model->doctorId] = $docId;
        $where[$this->ci->Medicalincident_model->medicalIncidentStatus] = 3;

        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);

        $this->ci->Medicalincidentvisit_model->setOrderBy(array($this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->id . ' DESC'));
        $like[$this->ci->Medicalincidentvisit_model->dbTable . '.' . $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode] = $medicalIncident['search'];
        $like[$this->ci->User_model->dbTable . '.' . $this->ci->User_model->firstName] = $medicalIncident['search'];
        $like[$this->ci->User_model->dbTable . '.' . $this->ci->User_model->lastName] = $medicalIncident['search'];
        $like[$this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->firstName] = $medicalIncident['search'];
        $like[$this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->middleName] = $medicalIncident['search'];
        $like[$this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->lastName] = $medicalIncident['search'];
        $like[$this->ci->Patient_model->dbTable . '.' . $this->ci->Patient_model->medicalRegistrationNumber] = $medicalIncident['search'];
        $this->ci->Medicalincidentvisit_model->setOrWhere($like, 'or', 'like');
        $medicalIncidentVisitDataCount = count($this->ci->Medicalincidentvisit_model->get());




        if (count($medicalIncidentVisitData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $output['status'] = TRUE;
        $output['response']['medicalIncidentVisitData'] = $medicalIncidentVisitData;
        $output['response']['page_count'] = count($medicalIncidentVisitData);
        $output['response']['total_count'] = $medicalIncidentVisitDataCount;
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getMedicalIncidentVisitsBkup($medicalIncident) {
        $hff_media_path = $this->ci->config->item('hff_media_path');
        //echo $medicalIncident; exit;
        $docId = $this->ci->session->userid;

        $this->ci->Bcpassignment_model->resetVariable();
        $selectInput = array();
        $bcpAssignmentData = array();
        $where = array();
        $whereInArray = array();

        $selectInput['bcpId'] = $this->ci->Bcpassignment_model->bcpId;

        $where[$this->ci->Bcpassignment_model->doctorId] = $docId;
        $where[$this->ci->Bcpassignment_model->status] = 1;

        $this->ci->Bcpassignment_model->setSelect($selectInput);
        $this->ci->Bcpassignment_model->setWhere($where);
        $this->ci->Bcpassignment_model->setOrWhere($whereInArray);

        $like[$this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode] = $medicalIncident['search'];

        $this->ci->Medicalincidentvisit_model->setLike($like);

        $bcpAssignmentData = $this->ci->Bcpassignment_model->get();
        if (count($bcpAssignmentData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'] = ERROR_NO_BCPASSIGNMENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_bcp_assignment_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $bcp_array = array();
        foreach ($bcpAssignmentData as $key => $val) {
            array_push($bcp_array, $val['bcpId']);
        }

        $this->ci->Medicalincident_model->resetVariable();
        $selectInput = array();
        $medicalIndicentData = array();
        $where = array();
        $whereInArray = array();

        $selectInput['id'] = $this->ci->Medicalincident_model->id;
//        $selectInput['medicalRecordId']     = $this->ci->Medicalincident_model->medicalRecordId;
        $selectInput['medicalIncidentCode'] = $this->ci->Medicalincident_model->medicalIncidentCode;
        $selectInput['bcpUserId'] = $this->ci->Medicalincident_model->bcpUserId;
        $selectInput['patientId'] = $this->ci->Medicalincident_model->patientId;

        $where[$this->ci->Medicalincident_model->bcpUserId] = $bcp_array;
//        $where[$this->ci->Medicalincident_model->status] = 1;

        $this->ci->Medicalincident_model->setSelect($selectInput);
//        $this->ci->Medicalincident_model->setWhere($where);
        $this->ci->Medicalincident_model->setOrWhere(array($this->ci->Medicalincident_model->bcpUserId => $bcp_array));

        $medicalIndicentData = $this->ci->Medicalincident_model->get();

        if (count($medicalIndicentData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $mri_array = array();
        $mri_bcp_array = array();
        $patient_ids = array();

        foreach ($medicalIndicentData as $key => $val) {

            if (!in_array($val['id'], $mri_array)) {
                array_push($mri_array, $val['id']);
            }
            $mri_bcp_array[$val['id']] = $val['bcpUserId'];
            if (!in_array($val['patientId'], $patient_ids)) {
                array_push($patient_ids, $val['patientId']);
            }
        }

        $this->ci->Patient_model->resetVariable();
        $selectInput = array();
        $patientDetails = array();
        $where = array();
        $whereInArray = array();

        $selectInput['id'] = $this->ci->Patient_model->id;
        $selectInput['firstName'] = $this->ci->Patient_model->firstName;
        $selectInput['middleName'] = $this->ci->Patient_model->middleName;
        $selectInput['lastName'] = $this->ci->Patient_model->lastName;
        $selectInput['medicalRegistrationNumber'] = $this->ci->Patient_model->medicalRegistrationNumber;

        $where[$this->ci->Patient_model->deleted] = 0;
        $this->ci->Patient_model->setSelect($selectInput);
        $this->ci->Patient_model->setWhere($where);
        //$whereInArray[$this->ci->Medicalincidentvisit_model->medicalIncidentId] = $medicalIncidentIds;
        $this->ci->Medicalincidentvisit_model->setOrWhere(array($this->ci->Patient_model->id => $patient_ids));

        $patientDetails = $this->ci->Patient_model->get();
        if (count($patientDetails) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_PATIENT_DETAILS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_patient_details_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $final_pateint_details = array();
        foreach ($patientDetails as $detail) {

            $name = '';
            if (!empty(trim($detail['firstName'])))
                $name = $detail['firstName'];
            if (!empty(trim($detail['middleName'])))
                $name .= ' ' . $detail['middleName'];
            if (!empty(trim($detail['lastName'])))
                $name .= ' ' . $detail['lastName'];
            $detail['name'] = $name;
            $final_pateint_details[$detail['id']] = $detail;
        }
//        print_r($final_pateint_details); exit;

        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $bcpDetails = array();
        $where = array();
        $whereInArray = array();

        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['first_name'] = $this->ci->User_model->firstName;
        $selectInput['last_name'] = $this->ci->User_model->lastName;

        $where[$this->ci->User_model->deleted] = 0;
        $this->ci->User_model->setSelect($selectInput);
        $this->ci->User_model->setWhere($where);
        //$whereInArray[$this->ci->Medicalincidentvisit_model->medicalIncidentId] = $medicalIncidentIds;
        $this->ci->User_model->setOrWhere(array($this->ci->User_model->id => $bcp_array));

        $bcpDetails = $this->ci->User_model->get();

        if (count($bcpDetails) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_PATIENT_DETAILS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_patient_details_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $final_bcp_details = array();
        foreach ($bcpDetails as $detail) {
            $name = '';
            if (!empty(trim($detail['first_name'])))
                $name = $detail['first_name'];
            if (!empty(trim($detail['last_name'])))
                $name .= ' ' . $detail['last_name'];
            $detail['name'] = $name;
            $final_bcp_details[$detail['id']] = $detail;
        }



        $this->ci->Medicalincidentvisit_model->resetVariable();
        $selectInput = array();
        $medicalIncidentVisitData = array();
        $where = array();
        $whereInArray = array();

        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentvisit_model->medicalIncidentId;
        $selectInput['patientId'] = $this->ci->Medicalincidentvisit_model->patientId;
        $selectInput['registrationDate'] = $this->ci->Medicalincidentvisit_model->registrationDate;
        $selectInput['status'] = $this->ci->Medicalincidentvisit_model->status;

        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $this->ci->Medicalincidentvisit_model->setRecords($medicalIncident['records'], $medicalIncident['offset']);
        $this->ci->Medicalincidentvisit_model->setOrderBy(array($this->ci->Medicalincidentvisit_model->id . ' DESC'));
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);

        $like[$this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode] = $medicalIncident['search'];

        $this->ci->Medicalincidentvisit_model->setLike($like);
        //$whereInArray[$this->ci->Medicalincidentvisit_model->medicalIncidentId] = $medicalIncidentIds;

        $this->ci->Medicalincidentvisit_model->setOrWhere(array($this->ci->Medicalincidentvisit_model->medicalIncidentId => $mri_array));
        $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();

        if (count($medicalIncidentVisitData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        foreach ($medicalIncidentVisitData as $key => $data) {

            $pat_name = '';
            $pat_mr = '';
            if (isset($final_pateint_details[$data['patientId']])) {
                $pat_name = $final_pateint_details[$data['patientId']]['name'];
                $pat_mr = $final_pateint_details[$data['patientId']]['medicalRegistrationNumber'];
            }

            $medicalIncidentVisitData[$key]['patientName'] = $pat_name;
            $medicalIncidentVisitData[$key]['patientMR'] = $pat_mr;
            $bcp_name = '';
            if (isset($final_bcp_details[$mri_bcp_array[$data['medicalIncidentId']]])) {
                $bcp_name = $final_bcp_details[$mri_bcp_array[$data['medicalIncidentId']]]['name'];
                $bcpId = $mri_bcp_array[$data['medicalIncidentId']];
            }
            $medicalIncidentVisitData[$key]['bcpName'] = $bcp_name;
            $medicalIncidentVisitData[$key]['bcpId'] = $bcpId;
        }

        $output['status'] = TRUE;
        $output['response']['medicalIncidentVisitData'] = $medicalIncidentVisitData;
        $outout['response']['total'] = count($medicalIncidentVisitData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getMedicalIncidentVisitDetails($medicalIncident) {
        require_once (APPPATH . 'handlers/Medicalincidentdetail_handler.php');
        require_once (APPPATH . 'handlers/Bcpreferredhospital_handler.php');
        require_once (APPPATH . 'handlers/Networkhospital_handler.php');
        require_once (APPPATH . 'handlers/Doctorfeedback_handler.php');
        
        $this->Medicalincidentdetail_handler    =   new Medicalincidentdetail_handler();
        $this->Bcpreferredhospital_handler      =   new Bcpreferredhospital_handler();
        $this->Networkhospital_handler      =   new Networkhospital_handler();
        $this->DocotrfeedbackHandler      =   new Doctorfeedback_handler();
        
        $hff_media_path = $this->ci->config->item('hff_media_path');

        $this->userHandler = new user_handler();

        $selectInput = array();
        $medicalIncidentVisitData = array();
        $where = array();
        $whereInArray = array();
        $this->ci->Medicalincidentvisit_model->resetVariable();
        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentvisit_model->medicalIncidentId;
        $selectInput['patient_id'] = $this->ci->Medicalincidentvisit_model->patientId;
        $selectInput['bcpId'] = $this->ci->Medicalincidentvisit_model->bcpUserId;
        $selectInput['registrationDate'] = $this->ci->Medicalincidentvisit_model->registrationDate;
        $selectInput['type'] = $this->ci->Medicalincidentvisit_model->type;

        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;

        $order = [$this->ci->Medicalincidentvisit_model->registrationDate . ' DESC'];
        if (isset($medicalIncident['visit_id']) && !empty($medicalIncident['visit_id'])) {

            $this->ci->Medicalincidentvisit_model->setRecords(3, 0);
            $where[$this->ci->Medicalincidentvisit_model->id . ' >= '] = $medicalIncident['visit_id'];
        } else {
            $this->ci->Medicalincidentvisit_model->setRecords($medicalIncident['records'], $medicalIncident['offset']);
        }
        $this->ci->Medicalincidentvisit_model->setOrderBy($order);
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);

        $whereInArray[$this->ci->Medicalincidentvisit_model->patientId] = $medicalIncident['patient_id'];

        $this->ci->Medicalincidentvisit_model->setOrWhere($whereInArray);
        $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();
//        debugArray($medicalIncidentVisitData); exit;

        if (count($medicalIncidentVisitData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        foreach($medicalIncidentVisitData as $visit){
            $visit_ids[]  =   $visit['id'];
        }
//        debugArray($visit_ids); exit;
        $feedback   =   $this->DocotrfeedbackHandler->getDoctorFeedback($visit_ids);
        $final_feedback =   array();
        if(isset($feedback['response']['feedback']) && !empty($feedback['response']['feedback'])){
            foreach($feedback['response']['feedback'] as $feed){
                if(!in_array($feed['visit_id'],$final_feedback)){ 
                    $final_feedback[$feed['visit_id']]['id']    =   $feed['visit_id'];
                    $final_feedback[$feed['visit_id']]['comments']    =   $feed['comments'];
                    $final_feedback[$feed['visit_id']]['is_retake']    =   $feed['is_retake'];
                }
            }
        }
        
        
        $patientData = $this->getPatientDetails("id", $medicalIncidentVisitData[0]['patient_id']);  ////$getByField = "id", $getByValue = $patientId;  
        $userData = $this->userHandler->getUserProfile($medicalIncidentVisitData[0]['bcpId'], '');  ////$getByField = "id", $getByValue = $patientId;  
        $userData = $userData['response']['userData'];
//        debugArray($medicalIncidentVisitData[0]['bcpId']); exit;
        $presc_options_ids = array();
        foreach ($medicalIncidentVisitData as $key => $val) {
            
            $type   =   'chief-complaint';
            if($val['type'] == 'followup'){
                $type = 'chief-complaint-followup';
            }
            $final_hos_list =   array();
            if($val['type'] == 'redflag'){
                $detail_ids =   $this->Medicalincidentdetail_handler->getDetailIdsByIncident($val['medicalIncidentId']);
                $details_ids_list   =   array();
                if(isset($detail_ids['response']['details']) && !empty($detail_ids['response']['details'])){
                    foreach($detail_ids['response']['details'] as $detail){
                        array_push($details_ids_list, $detail['id']);
                    }
                }
                if(!empty($details_ids_list)){
                    $hospital_ids =   $this->Bcpreferredhospital_handler->getHospitalIds($details_ids_list);
                    $hospital_id_list   =   array();
                    if(isset($hospital_ids['response']['hospitalList']) && !empty($hospital_ids['response']['hospitalList'])){
                        foreach($hospital_ids['response']['hospitalList'] as $hospital){
                            array_push($hospital_id_list, $hospital['hospital_id']);
                        }
                        $hospital_list  =   $this->Networkhospital_handler->getNetworkHospitals('',$hospital_id_list);
                        
                        if(isset($hospital_list['response']['networkhospitalData']) && $hospital_list['response']['networkhospitalData']){
                            foreach($hospital_list['response']['networkhospitalData'] as $hospital_detail){
                                $final_hos_list[] =   $hospital_detail;
                            }
                            
                        }
                    }
                }
                
            }
            $surveydetails = $this->getMedicalIncidentSurvey($val['id'],$type);
            
            $this->ci->Prescriptionrequests_model->resetVariable();
            $selectInput = array();

            $where = array();
            $selectInput['id'] = $this->ci->Prescriptionrequests_model->id;
            $selectInput['option'] = $this->ci->Prescriptionrequests_model->optionId;


            $where[$this->ci->Prescriptionrequests_model->deleted] = 0;
            $where[$this->ci->Prescriptionrequests_model->status] = 1;
            $where[$this->ci->Prescriptionrequests_model->medicalIncidentId] = $val['medicalIncidentId'];
            $where[$this->ci->Prescriptionrequests_model->medicalVisitId] = $val['id'];

            $this->ci->Prescriptionrequests_model->setSelect($selectInput);
            $this->ci->Prescriptionrequests_model->setWhere($where);

            $prescription_request_options = $this->ci->Prescriptionrequests_model->get();
//            debugArray($val['medicalIncidentId']); exit;
            $presc_options_ids = array();
            if (count($prescription_request_options) != 0) {
                $presc_options_ids[$prescription_request_options[0]['id']] = $prescription_request_options[0]['option'];
            }
            $surveydetails['prec_ids'] = $presc_options_ids;
            $surveydetails['hospital_list'] = $final_hos_list;
            $survey_details[] = $surveydetails;
        }

        

        $output['status'] = TRUE;
        $output['response']['patientData'] = $patientData;
        $output['response']['userData'] = !empty($userData)?$userData:null;
        $output['response']['medicalIncidentVisitData'] = $survey_details;
        $output['response']['presc_option_ids'] = $presc_options_ids;
        $output['response']['feedback_ids'] = (array)$final_feedback;
        $output['response']['total'] = count($medicalIncidentVisitData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getMedicalIncidentSurvey_test($medicalIncidentVisit) {
        $selectInput = array();
        $medicalSurveyData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $where[$this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode] = $medicalIncidentVisit;
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);

        $medicalSurveyData = $this->ci->Medicalincidentvisit_model->get();
        if (count($medicalSurveyData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $this->ci->Medicalsurveyreport_model->resetVariable();
        $selectInput = array();
        $medicalSurveyReportData = array();
        $where = array();
        $selectInput['surveyId'] = $this->ci->Medicalsurveyreport_model->surveyId;
        $selectInput['surveyQuestionId'] = $this->ci->Medicalsurveyreport_model->surveyQuestionId;
        $selectInput['surveyQuestionOptionId'] = $this->ci->Medicalsurveyreport_model->surveyQuestionOptionId;
        $selectInput['surveyQuestionOptionValue'] = $this->ci->Medicalsurveyreport_model->surveyQuestionOptionValue;

        $where[$this->ci->Medicalsurveyreport_model->deleted] = 0;
        $where[$this->ci->Medicalsurveyreport_model->status] = 1;
        $where[$this->ci->Medicalsurveyreport_model->medicalIncidentVisitId] = $medicalSurveyData[0]['id'];
        $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
        $this->ci->Medicalsurveyreport_model->setWhere($where);
        $medicalSurveyReportData = $this->ci->Medicalsurveyreport_model->get();
        if (count($medicalSurveyReportData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'] = ERROR_NO_MEDICALSURVEY_REPORT;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_survey_report_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['medicalSurveyReportData'] = $medicalSurveyReportData;
        $outout['response']['total'] = count($medicalSurveyReportData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getMedicalIncidentSurvey($medicalIncidentVisit,$type) {
        
        $hff_media_path = $this->ci->config->item('hff_media_path');
        $selectInput = array();
        $medicalSurveyData = array();
        $where = array();
        $this->ci->Medicalincidentvisit_model->resetVariable();
        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentvisit_model->medicalIncidentId;
        $selectInput['registrationDate'] = $this->ci->Medicalincidentvisit_model->registrationDate;
        $selectInput['patientId'] = $this->ci->Medicalincidentvisit_model->patientId;
        $selectInput['type'] = $this->ci->Medicalincidentvisit_model->type;
        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $where[$this->ci->Medicalincidentvisit_model->id] = $medicalIncidentVisit;
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);

//        $this->ci->Medicalincidentvisit_model->setOrWhere(array($this->ci->Medicalincident_model->id => $medicalIncidentVisit));

        $medicalSurveyData = $this->ci->Medicalincidentvisit_model->get();

        
        if (count($medicalSurveyData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $inc_id = $medicalSurveyData[0]['medicalIncidentId'];
        $visit_id = $medicalIncidentVisit;

        

        $this->ci->Medicalsurveyreport_model->resetVariable();
        $selectInput = array();
        $primaryAssessmentSurveyReportData = array();
        $primaryAssessmentSurveyReport = array();
        $where = array();
        $selectInput['medicalIncidentVisitId'] = $this->ci->Medicalsurveyreport_model->medicalIncidentVisitId;
        $selectInput['surveyId'] = $this->ci->Medicalsurveyreport_model->surveyId;
        $selectInput['surveyQuestionId'] = $this->ci->Medicalsurveyreport_model->surveyQuestionId;
        $selectInput['surveyQuestionOptionId'] = $this->ci->Medicalsurveyreport_model->surveyQuestionOptionId;
        $selectInput['surveyQuestionOptionValue'] = $this->ci->Medicalsurveyreport_model->surveyQuestionOptionValue;

        $where[$this->ci->Medicalsurveyreport_model->surveyId] = 1;
        $where[$this->ci->Medicalsurveyreport_model->deleted] = 0;
        $where[$this->ci->Medicalsurveyreport_model->status] = 1;
        $where[$this->ci->Medicalsurveyreport_model->medicalIncidentVisitId] = $medicalSurveyData[0]['id'];
        $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
        $this->ci->Medicalsurveyreport_model->setWhere($where);
        //$this->ci->Medicalincidentvisit_model->setOrWhere(array($this->ci->Medicalsurveyreport_model->medicalIncidentVisitId => $visit_ids));
        $primaryAssessmentSurveyReport = $this->ci->Medicalsurveyreport_model->get();
        //echo count($primaryAssessmentSurveyReport); 
        ///print_r($primaryAssessmentSurveyReport);exit;

        if (count($primaryAssessmentSurveyReport) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'] = ERROR_NO_MEDICALSURVEY_REPORT;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_survey_report_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }


        $this->ci->Survey_questionnaire_model->resetVariable();
        $selectInput = array();
        $all_questons = array();
        $where = array();

        $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
        $selectInput['order'] = $this->ci->Survey_questionnaire_model->order;
        
        $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
        $where[$this->ci->Survey_questionnaire_model->status] = 1;
        $where[$this->ci->Survey_questionnaire_model->surveyId] = $primaryAssessmentSurveyReport[0]['surveyId'];
        if($type == 'chief-complaint-followup'){
            $where[$this->ci->Survey_questionnaire_model->chiefComplaintLinking] = 0;
        }
        $orderby[] = $this->ci->Survey_questionnaire_model->order;
        $this->ci->Survey_questionnaire_model->setSelect($selectInput);
        $this->ci->Survey_questionnaire_model->setWhere($where);
        $this->ci->Survey_questionnaire_model->setOrderBy($orderby);
        //$this->ci->Medicalincidentvisit_model->setOrWhere(array($this->ci->Medicalsurveyreport_model->medicalIncidentVisitId => $visit_ids));
        $all_questons = $this->ci->Survey_questionnaire_model->get();

        if (count($all_questons) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'] = ERROR_NO_MEDICALSURVEY_REPORT;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_survey_report_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
//        foreach($primaryAssessmentSurveyReport as $data){
//            $primaryAssessmentSurveyReport[$data['medicalIncidentVisitId']][] =   $data;
//        }
//        print_r($primaryAssessmentSurveyReport);    exit;
//        foreach($primaryAssessmentSurveyReport as $key => $primaryAssessmentSurveyReporti){
        $i = 0;
        $found_array = array();
        $final_options_answers = array();
        foreach ($primaryAssessmentSurveyReport as $pasrKey => $pasrVal) {
//            debugArray($primaryAssessmentSurveyReport); exit;
//            if (!in_array($pasrVal['surveyQuestionId'], $found_array)) {
            $surveyQuestionIdData[$i]['surveyQuestionId'] = $pasrVal['surveyQuestionId'];
            $surveyQuestionOptionIdData[$i]['surveyQuestionOptionId'] = $pasrVal['surveyQuestionOptionId'];
            $surveyQuestionOptionValueData[$i]['surveyQuestionOptionValue'] = $pasrVal['surveyQuestionOptionValue'];
            $final_options_answers[$pasrVal['surveyQuestionOptionId']] = $pasrVal['surveyQuestionOptionValue'];
            $i++;
            array_push($found_array, $pasrVal['surveyQuestionId']);
//            }
        }
//        debugArray($final_options_answers); exit;
        $found_array = array_unique($found_array);
        foreach ($all_questons as $question) {
            if (!in_array($question['id'], $found_array)) {
                $surveyQuestionIdData[] = array(
                    'surveyQuestionId' => $question['id'],
                    'order' => $question['order'],
                );
            }
        }



        //print_r($surveyQuestionOptionIdData);    exit;


        $surveyQuestionIdsData = commonHelperGetIdArray($surveyQuestionIdData, 'surveyQuestionId');

//            ksort($surveyQuestionIdsData);
//            $surveyQuestionIds = implode(",", array_keys($surveyQuestionIdsData));
        $surveyQuestionIdArray = array_keys($surveyQuestionIdsData);

        $surveyQuestionOptionIdsData = commonHelperGetIdArray($surveyQuestionOptionIdData, 'surveyQuestionOptionId');
//            $surveyQuestionOptionIds = implode(",", array_keys($surveyQuestionOptionIdsData));
        $surveyQuestionOptionIdArray = array_keys($surveyQuestionOptionIdsData);
//        }
//        print_r($surveyQuestionIdData); exit;
//        print_r($surveyQuestionOptionIdData); 
//        print_r($surveyQuestionOptionIdArray);  exit;
        //print_r($surveyQuestionIds); 
//        print_r($surveyQuestionIdArray); exit;

        $surveyQuestionnaireData = array();

        if (is_array($surveyQuestionIdArray) && count($surveyQuestionIdArray) > 0) {

            $this->ci->Survey_questionnaire_model->resetVariable();
            $selectInput = array();
            $where = array();
            $whereIn = array();
            $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
            $selectInput['title'] = $this->ci->Survey_questionnaire_model->title;
            $selectInput['severity'] = $this->ci->Survey_questionnaire_model->severity;
            $selectInput['type'] = $this->ci->Survey_questionnaire_model->type;
            $selectInput['surveyTaxonomyId'] = $this->ci->Survey_questionnaire_model->surveyTaxonomyId;
            $selectInput['order'] = $this->ci->Survey_questionnaire_model->order;
            $selectInput['conditional_display'] = $this->ci->Survey_questionnaire_model->conditionalDisplay;
            $selectInput['chief_complaint_linking'] = $this->ci->Survey_questionnaire_model->chiefComplaintLinking;
            //$selectInput['conditionalDisplay'] = $this->ci->Survey_questionnaire_model->conditionalDisplay;
            //$selectInput['conditionalType'] = $this->ci->Survey_questionnaire_model->conditionalType;
            //$selectInput['order'] = $this->ci->Survey_questionnaire_model->order;
            $this->ci->Survey_questionnaire_model->setSelect($selectInput);
            $whereIn[$this->ci->Survey_questionnaire_model->id] = $surveyQuestionIdArray;
            $this->ci->Survey_questionnaire_model->setWhereIns($whereIn);
            //$orderBy[] = $this->ci->Survey_questionnaire_model->order;
            //$this->ci->Survey_questionnaire_model->setOrderBy($orderBy);
            $surveyQuestionnaireData = $this->ci->Survey_questionnaire_model->get();
            $finalSurveyQuestionnaireData = null;
            foreach ($surveyQuestionnaireData as $sur) {
                $finalSurveyQuestionnaireData[$sur['id']] = $sur;
            }
            $surveyTaxonomyIdDataArray = commonHelperGetGroupArray($surveyQuestionnaireData, 'surveyTaxonomyId');
            $groupQuestionIds = array();
            foreach ($surveyTaxonomyIdDataArray as $stidKey => $stidVal) {
                foreach ($stidVal as $stidVVal) {
                    $groupQuestionIds[$stidKey][]['questionId'] = $stidVVal['id'];
                }
            }

            //print_r($groupQuestionIds); exit; 

            $surveyTaxonomyIdArray = array_keys($surveyTaxonomyIdDataArray);

            $selectInput = array();
            $where = array();
            $orderBy = array();
            $whereIn = array();
            $this->ci->Survey_taxonomy_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_taxonomy_model->id;
            $selectInput['taxonomyId'] = $this->ci->Survey_taxonomy_model->taxonomyId;
            $this->ci->Survey_taxonomy_model->setSelect($selectInput);
            $where[$this->ci->Survey_taxonomy_model->deleted] = 0;
            $where[$this->ci->Survey_taxonomy_model->status] = 1;
            $this->ci->Survey_taxonomy_model->setWhere($where);
            $whereIn[$this->ci->Survey_taxonomy_model->id] = $surveyTaxonomyIdArray;
            $this->ci->Survey_taxonomy_model->setWhereIns($whereIn);
            $surveyTaxonomyData = $this->ci->Survey_taxonomy_model->get();
            $surveyTaxonomyIdData = commonHelperGetIdArray($surveyTaxonomyData);
            $surveyTaxonomyKeyData = commonHelperGetIdArray($surveyTaxonomyData, 'taxonomyId');
            $surveyTaxonomyIdDataArray = array_keys($surveyTaxonomyKeyData);
            $selectInput = array();
            $where = array();
            $orderBy = array();
            $whereIn = array();
            $this->ci->Taxonomy_model->resetVariable();
            $selectInput['id'] = $this->ci->Taxonomy_model->id;
            $selectInput['name'] = $this->ci->Taxonomy_model->name;
            $this->ci->Taxonomy_model->setSelect($selectInput);
            $where[$this->ci->Taxonomy_model->deleted] = 0;
            $where[$this->ci->Taxonomy_model->status] = 1;
            $this->ci->Taxonomy_model->setWhere($where);
            $whereIn[$this->ci->Taxonomy_model->id] = $surveyTaxonomyIdDataArray;
            $this->ci->Taxonomy_model->setWhereIns($whereIn);
            $taxonomyData = $this->ci->Taxonomy_model->get();
            $taxonomyIdData = commonHelperGetIdArray($taxonomyData, 'id');
            foreach ($surveyTaxonomyIdData as $taxKey => $taxVal) {
                $surveyTaxonomyIdData[$taxKey]['taxonomyName'] = $taxonomyIdData[$taxVal['taxonomyId']]['name'];
            }

            ///print_r($surveyTaxonomyIdData); exit;

            $this->ci->Survey_questionnaire_option_model->resetVariable();
            $selectInput = array();
            $whereIns = array();
            $where = array();
            $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
            $selectInput['surveyId'] = $this->ci->Survey_questionnaire_option_model->surveyId;
            $selectInput['surveyQuestionId'] = $this->ci->Survey_questionnaire_option_model->surveyQuestionId;
            $selectInput['optionType'] = $this->ci->Survey_questionnaire_option_model->optionType;
            $selectInput['value'] = $this->ci->Survey_questionnaire_option_model->value;
            $selectInput['label'] = $this->ci->Survey_questionnaire_option_model->label;
            $selectInput['suffixLabel'] = $this->ci->Survey_questionnaire_option_model->suffixLabel;
            $selectInput['validationType'] = $this->ci->Survey_questionnaire_option_model->validationType;
            $selectInput['autopopulateOptionId'] = $this->ci->Survey_questionnaire_option_model->autopopulateOptionId;
            $selectInput['autopopulateConditionId'] = $this->ci->Survey_questionnaire_option_model->autopopulateConditionId;
            $selectInput['readonly'] = $this->ci->Survey_questionnaire_option_model->readonly;
            $selectInput['severity'] = $this->ci->Survey_questionnaire_option_model->severity;
            $selectInput['reminder'] = $this->ci->Survey_questionnaire_option_model->reminder;
            $selectInput['reminderDays'] = $this->ci->Survey_questionnaire_option_model->reminderDays;
            $selectInput['requestPrescription'] = $this->ci->Survey_questionnaire_option_model->requestPrescription;
            $selectInput['parentId'] = $this->ci->Survey_questionnaire_option_model->parentId;
            $selectInput['childEnabled'] = $this->ci->Survey_questionnaire_option_model->childEnabled;
            ///$selectInput['order'] = $this->ci->Survey_questionnaire_option_model->order;
            $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
            $whereIns[$this->ci->Survey_questionnaire_option_model->surveyQuestionId] = $surveyQuestionIdArray;
            $this->ci->Survey_questionnaire_option_model->setWhereIns($whereIns);
            $surveyQuestionnaireOptionData = $this->ci->Survey_questionnaire_option_model->get();

            $surveyQuestionOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'surveyQuestionId');
            $surveyQuestionParentOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'parentId');
            $surveyQuestionOptionIdArray = array_keys($surveyQuestionOptionIdData);

            $subOptionArray = array();
            if (count($surveyQuestionParentOptionIdData) > 0)
                unset($surveyQuestionParentOptionIdData[0]);

            /* if($medicalIncidentVisit == 550){
              print_r($surveyQuestionnaireOptionData); exit;
              } */


            //print_r($surveyQuestionnaireData); exit; 
            //print_r($surveyQuestionIdData); //exit;            
            //print_r($surveyQuestionIdArray); exit;
//            print_r($surveyQuestionnaireOptionData); exit;                     
            //print_r($surveyQuestionOptionIdArray); exit;
            $finalsurveyQuestionIdData = null;
            foreach ($surveyQuestionIdData as $surQkey => $surQval) {
                $finalsurveyQuestionIdData[$surQval['surveyQuestionId']] = $surQval;
            }
            $surveyQuestionIdData = $finalsurveyQuestionIdData;
            ksort($surveyQuestionIdData);


            foreach ($surveyQuestionIdData as $surQkey => $surQval) {

                if (in_array($surQval['surveyQuestionId'], $surveyQuestionIdArray)) {

                    foreach ($surveyQuestionOptionIdData[$surQval['surveyQuestionId']] as $optVal) {

                        if (isset($surveyQuestionParentOptionIdData[$optVal['id']])) {
                            $tempArray = array();
                            $tempArray = array_values($surveyQuestionParentOptionIdData[$optVal['id']]);
                            $optVal['subOptions'][] = $tempArray;
                        }
                        if ($optVal['parentId'] == 0) {

                            if (isset($surveyQuestionIdData[$surQkey]['surveyQuestionId']))
                                $surveyQuestionIdData[$surQkey] = $finalSurveyQuestionnaireData[$surQkey];
                            $ans = '';

                            if (isset($final_options_answers[$optVal['id']])) {
                                $ans = $final_options_answers[$optVal['id']];
                                $surveyQuestionIdData[$surQkey]['answered'] = 1;
                            } else {
                                if (!isset($surveyQuestionIdData[$surQkey]['answered']))
                                    $surveyQuestionIdData[$surQkey]['answered'] = 0;
                            }
                            $optVal['ans'] = $ans;
                            $surveyQuestionIdData[$surQkey]['options'][] = $optVal;
                        }
                    }
                } else {

                    unset($surveyQuestionIdData[$surQkey]);
                }
            }


//            print_r($surveyQuestionIdData);  exit; 

            $primaryAssessmentResponse = array();
            foreach ($medicalSurveyData as $surbeyKey => $surveyData) {
                //$finalResponse[$surbeyKey] = $medicalSurveyData;
                foreach ($surveyQuestionIdData as $qdVal) {
//                    print_r($qdVal); exit;
                    $qdVal['surveyTaxonomyName'] = NULL;
                    if (isset($surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'])) {
                        $qdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'];
                    }
                    $primaryAssessmentResponse['questionnaire'][] = $qdVal;
                }
            }

            $finalPrimaryAssessment = null;
            foreach ($primaryAssessmentResponse['questionnaire'] as $question) {
                $finalPrimaryAssessment[$question['order']] = $question;
            }
            ksort($finalPrimaryAssessment);
            $temprorayArray = null;
            foreach ($finalPrimaryAssessment as $key => $question) {
                if ($question['conditional_display'] == 1) {
                    if (!in_array($question['id'], $found_array)) {
                        unset($finalPrimaryAssessment[$key]);
                    } else {
                        $temprorayArray[] = $question;
                    }
                } else {
                    $temprorayArray[] = $question;
                }
            }
            $primaryAssessmentResponse['questionnaire'] = $temprorayArray;


            $this->ci->load->model('Survey_questionnaire_condition_value_model');

            $this->ci->Survey_questionnaire_condition_value_model->resetVariable();
            $selectInput = array();
            $where = array();
            $selectInput['condition_question_id'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionId;
            $selectInput['condition_optin_id'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionOptionId;
            $selectInput['display_question_id'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId;
            $selectInput['confition_first_value'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchFirstvalue;
            $selectInput['confition_second_value'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchSecondvalue;
            $selectInput['validation_type'] = $this->ci->Survey_questionnaire_condition_value_model->validationType;
            $selectInput['condition_type'] = $this->ci->Survey_questionnaire_condition_value_model->conditionType;
            $selectInput['general_field_name'] = $this->ci->Survey_questionnaire_condition_value_model->generalFieldName;

            $this->ci->Survey_questionnaire_condition_value_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_condition_value_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_condition_value_model->status] = 1;
            //$where[$this->ci->Survey_model->id] = 2;
            $this->ci->Survey_model->setWhere($where);
            //$this->ci->Survey_model->setRecords(1);
            $conditions = $this->ci->Survey_questionnaire_condition_value_model->get();
            $final_conditions = null;
            foreach ($conditions as $key => $condition) {
                $final_conditions[$condition['condition_question_id']][$condition['display_question_id']] = $condition;
            }

            //Chief Complaints        



            $this->ci->Survey_model->resetVariable();
            $selectInput = array();
            $chiefComplaintSurveyData = array();
            $where = array();
            $selectInput['id'] = $this->ci->Survey_model->id;
            $selectInput['name'] = $this->ci->Survey_model->name;

            $this->ci->Survey_model->setSelect($selectInput);
            $where[$this->ci->Survey_model->deleted] = 0;
            $where[$this->ci->Survey_model->status] = 1;
            $where[$this->ci->Survey_model->type] = $type;
            //$where[$this->ci->Survey_model->id] = 2;
            $this->ci->Survey_model->setWhere($where);
            //$this->ci->Survey_model->setRecords(1);
            $chiefComplaintSurveyData = $this->ci->Survey_model->get();

//            print_r($chiefComplaintSurveyData); exit;



            $chiefComplaintResponse = array();
            $chiefComplaintResponse = (object) $chiefComplaintResponse;

            if (is_array($chiefComplaintSurveyData) && count($chiefComplaintSurveyData) > 0) {
                $i = 0;
                foreach ($chiefComplaintSurveyData as $chiefCompSurKey => $chiefCompSurValue) {
//                    print_r($chiefCompSurValue); exit;
                    if (!empty($chiefCompSurValue['id']) && $chiefCompSurValue['id'] != "") {

                        $this->ci->Survey_questionnaire_model->resetVariable();
                        $selectInput = array();
                        $all_questons = array();
                        $where = array();

                        $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;

                        $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
                        $where[$this->ci->Survey_questionnaire_model->status] = 1;
                        $where[$this->ci->Survey_questionnaire_model->surveyId] = $chiefCompSurValue['id'];
                        $this->ci->Survey_questionnaire_model->setSelect($selectInput);
                        $this->ci->Survey_questionnaire_model->setWhere($where);
                        //        $this->ci->Medicalincidentvisit_model->setOrWhere(array($this->ci->Medicalsurveyreport_model->medicalIncidentVisitId => $visit_ids));
                        $all_questons = $this->ci->Survey_questionnaire_model->get();

                        if (count($all_questons) == 0) {
                            $output['status'] = TRUE;
                            ///$output['response']['message'] = ERROR_NO_MEDICALSURVEY_REPORT;
                            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_survey_report_message');
                            $output['response']['total'] = 0;
                            $output['statusCode'] = STATUS_NO_DATA;
                            return $output;
                        }
//                        print_r($all_questons); exit;
                        //echo $i; 
                        $this->ci->Medicalsurveyreport_model->resetVariable();
                        $selectInput = array();
                        $where = array();
                        //$groupBy = array();
                        //$selectInput['surveyId'] = $this->ci->Medicalsurveyreport_model->surveyId;
                        $selectInput['surveyQuestionId'] = $this->ci->Medicalsurveyreport_model->surveyQuestionId;
                        $selectInput['surveyQuestionOptionId'] = $this->ci->Medicalsurveyreport_model->surveyQuestionOptionId;
                        $selectInput['surveyQuestionOptionValue'] = $this->ci->Medicalsurveyreport_model->surveyQuestionOptionValue;

                        $where[$this->ci->Medicalsurveyreport_model->surveyId] = $chiefCompSurValue['id'];
                        $where[$this->ci->Medicalsurveyreport_model->deleted] = 0;
                        $where[$this->ci->Medicalsurveyreport_model->status] = 1;
                        $where[$this->ci->Medicalsurveyreport_model->medicalIncidentVisitId] = $medicalSurveyData[0]['id'];
                        $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
                        $this->ci->Medicalsurveyreport_model->setWhere($where);

                        //$groupBy[]= $this->ci->Medicalsurveyreport_model->surveyQuestionId;

                        $chiefComplaintData = $this->ci->Medicalsurveyreport_model->get();
//                        print_r($chiefComplaintData); exit;
                        
                        $chiefComplaintSurveyReport = array();
                        //$m=0;
                        if (is_array($chiefComplaintData) && count($chiefComplaintData) > 0) {

                            $chiefComplaintSurveyReport[$i]['id'] = $chiefCompSurValue['id'];
                            $chiefComplaintSurveyReport[$i]['name'] = $chiefCompSurValue['name'];
                            //$chiefComplaintSurveyReport[$m]['questions'] = $chiefComplaintData;
//                            print_r($chiefComplaintData); exit;

                            $newQtnArry = array();
                            $final_options_answers = array();
                            foreach ($chiefComplaintData as $ccsrKey => $ccsrVal) {
                                $qtnId = $ccsrVal['surveyQuestionId'];
                                $optId = $ccsrVal['surveyQuestionOptionId'];
                                $otpVal = $ccsrVal['surveyQuestionOptionValue'];
                                $newOptArry = array("surveyQuestionOptionId" => $optId, 'surveyQuestionOptionValue' => $otpVal);

                                $newQtnArry[$qtnId]['surveyQuestionId'] = $qtnId;
                                $newQtnArry[$qtnId]['options'][] = $newOptArry;
                                $final_options_answers[$optId] = $otpVal;
                            }

                            //print_r($newQtnArry);
                            $newQtnArry = array_values($newQtnArry);
//                            print_r($newQtnArry); exit;                                           
                            $chiefComplaintSurveyReport[$i]['questions'] = $newQtnArry;

//                            print_r($chiefComplaintSurveyReport); exit; 

                            $chiefCompSurveyQuestionOptionIdData = array();
                            $chiefCompSurveyQuestionIdData = array();
                            $j = 0;
                            $found_array = array();
                            foreach ($chiefComplaintSurveyReport[$i]['questions'] as $ccsrKey => $ccsrVal) {

                                //print_r($ccsrVal);

                                $chiefCompSurveyQuestionIdData[$j]['surveyQuestionId'] = $ccsrVal['surveyQuestionId'];
                                $chiefCompSurveyOptionData = $ccsrVal['options'];
                                if ($chiefCompSurveyOptionData != "") {
                                    foreach ($chiefCompSurveyOptionData as $ccsroptKey => $ccsroptVal) {
                                        //print_r($ccsroptVal);
                                        $chiefCompSurveyQuestionOptionIdData[]['surveyQuestionOptionId'] = $ccsroptVal['surveyQuestionOptionId'];
                                        //$chiefCompSurveyQuestionOptionIdArray = array("surveyQuestionOptionId" => $ccsroptVal['surveyQuestionOptionId'], "surveyQuestionId" => $ccsrVal['surveyQuestionId']);
                                        //$chiefCompSurveyQuestionOptionIdData[] = $chiefCompSurveyQuestionOptionIdArray;
                                    }
                                    $j++;
                                }
                                array_push($found_array, $ccsrVal['surveyQuestionId']);
                            }
                            foreach ($all_questons as $question) {
                                if (!in_array($question['id'], $found_array)) {
                                    $chiefCompSurveyQuestionIdData[]['surveyQuestionId'] = $question['id'];
                                }
                            }
                            //print_r($chiefCompSurveyQuestionIdData); 
                            //print_r($chiefCompSurveyQuestionOptionIdData); echo "<br><br>";
                            //exit;

                            $chiefCompSurveyQuestionIdsData = commonHelperGetIdArray($chiefCompSurveyQuestionIdData, 'surveyQuestionId');
//                            $chiefCompSurveyQuestionIds = implode(",", array_keys($chiefCompSurveyQuestionIdsData));
                            $chiefCompSurveyQuestionIdArray = array_keys($chiefCompSurveyQuestionIdsData);

                            $chiefCompSurveyQuestionOptionIdsData = commonHelperGetIdArray($chiefCompSurveyQuestionOptionIdData, 'surveyQuestionOptionId');
//                            $chiefCompSurveyQuestionOptionIds = implode(",", array_keys($chiefCompSurveyQuestionOptionIdsData));
                            $chiefCompSurveyQuestionOptionIdArray = array_keys($chiefCompSurveyQuestionOptionIdsData);



//                            print_r($chiefCompSurveyQuestionIdsData); exit;
                            $chiefCompSurveyQuestionnaireData = array();

                            if (is_array($chiefCompSurveyQuestionIdArray) && count($chiefCompSurveyQuestionIdArray) > 0) {

                                $this->ci->Survey_questionnaire_model->resetVariable();
                                $selectInput = array();
                                $where = array();
                                $whereIn = array();
                                $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
                                $selectInput['title'] = $this->ci->Survey_questionnaire_model->title;
                                $selectInput['severity'] = $this->ci->Survey_questionnaire_model->severity;
                                $selectInput['type'] = $this->ci->Survey_questionnaire_model->type;
                                $selectInput['surveyTaxonomyId'] = $this->ci->Survey_questionnaire_model->surveyTaxonomyId;
                                $selectInput['order'] = $this->ci->Survey_questionnaire_model->order;
                                $selectInput['conditional_display'] = $this->ci->Survey_questionnaire_model->conditionalDisplay;

                                $this->ci->Survey_questionnaire_model->setSelect($selectInput);
                                $whereIn[$this->ci->Survey_questionnaire_model->id] = $chiefCompSurveyQuestionIdArray;
                                $this->ci->Survey_questionnaire_model->setWhereIns($whereIn);
                                //$orderBy[] = $this->ci->Survey_questionnaire_model->order;
                                //$this->ci->Survey_questionnaire_model->setOrderBy($orderBy);

                                $chiefCompSurveyQuestionnaireData = $this->ci->Survey_questionnaire_model->get();
//                                print_r($chiefCompSurveyQuestionnaireData); exit;                       


                                $chiefCompSurveyTaxonomyIdDataArray = commonHelperGetGroupArray($chiefCompSurveyQuestionnaireData, 'surveyTaxonomyId');
                                $groupQuestionIds = array();
                                foreach ($chiefCompSurveyTaxonomyIdDataArray as $stidKey => $stidVal) {
                                    foreach ($stidVal as $stidVVal) {
                                        $groupQuestionIds[$stidKey][]['questionId'] = $stidVVal['id'];
                                    }
                                }

//                                print_r($groupQuestionIds); exit;

                                $chiefCompSurveyTaxonomyIdArray = array_keys($chiefCompSurveyTaxonomyIdDataArray);
                                $selectInput = array();
                                $where = array();
                                $orderBy = array();
                                $whereIn = array();
                                $this->ci->Survey_taxonomy_model->resetVariable();
                                $selectInput['id'] = $this->ci->Survey_taxonomy_model->id;
                                $selectInput['taxonomyId'] = $this->ci->Survey_taxonomy_model->taxonomyId;
                                $this->ci->Survey_taxonomy_model->setSelect($selectInput);
                                $where[$this->ci->Survey_taxonomy_model->deleted] = 0;
                                $where[$this->ci->Survey_taxonomy_model->status] = 1;
                                $this->ci->Survey_taxonomy_model->setWhere($where);
                                $whereIn[$this->ci->Survey_taxonomy_model->id] = $chiefCompSurveyTaxonomyIdArray;
                                $this->ci->Survey_taxonomy_model->setWhereIns($whereIn);
                                $chiefCompSurveyTaxonomyData = $this->ci->Survey_taxonomy_model->get();
//                                print_r($chiefCompSurveyTaxonomyData); exit;

                                $chiefCompSurveyTaxonomyIdData = commonHelperGetIdArray($chiefCompSurveyTaxonomyData);
                                $chiefCompSurveyTaxonomyKeyData = commonHelperGetIdArray($chiefCompSurveyTaxonomyData, 'taxonomyId');
                                $chiefCompSurveyTaxonomyIdDataArray = array_keys($chiefCompSurveyTaxonomyKeyData);
                                $selectInput = array();
                                $where = array();
                                $orderBy = array();
                                $whereIn = array();
                                $this->ci->Taxonomy_model->resetVariable();
                                $selectInput['id'] = $this->ci->Taxonomy_model->id;
                                $selectInput['name'] = $this->ci->Taxonomy_model->name;
                                $this->ci->Taxonomy_model->setSelect($selectInput);
                                $where[$this->ci->Taxonomy_model->deleted] = 0;
                                $where[$this->ci->Taxonomy_model->status] = 1;
                                $this->ci->Taxonomy_model->setWhere($where);
                                $whereIn[$this->ci->Taxonomy_model->id] = $chiefCompSurveyTaxonomyIdDataArray;
                                $this->ci->Taxonomy_model->setWhereIns($whereIn);
                                $taxonomyData = $this->ci->Taxonomy_model->get();
                                $taxonomyIdData = commonHelperGetIdArray($taxonomyData, 'id');
                                foreach ($chiefCompSurveyTaxonomyIdData as $taxKey => $taxVal) {
                                    $chiefCompSurveyTaxonomyIdData[$taxKey]['taxonomyName'] = $taxonomyIdData[$taxVal['taxonomyId']]['name'];
                                }

//                                print_r($chiefCompSurveyTaxonomyIdData); exit;
                                

                                $this->ci->Survey_questionnaire_option_model->resetVariable();
                                $selectInput = array();
                                $whereIns = array();
                                $where = array();
                                $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
                                $selectInput['surveyId'] = $this->ci->Survey_questionnaire_option_model->surveyId;
                                $selectInput['surveyQuestionId'] = $this->ci->Survey_questionnaire_option_model->surveyQuestionId;
                                $selectInput['optionType'] = $this->ci->Survey_questionnaire_option_model->optionType;
                                $selectInput['value'] = $this->ci->Survey_questionnaire_option_model->value;
                                $selectInput['label'] = $this->ci->Survey_questionnaire_option_model->label;
                                $selectInput['suffixLabel'] = $this->ci->Survey_questionnaire_option_model->suffixLabel;
                                $selectInput['validationType'] = $this->ci->Survey_questionnaire_option_model->validationType;
                                $selectInput['autopopulateOptionId'] = $this->ci->Survey_questionnaire_option_model->autopopulateOptionId;
                                $selectInput['autopopulateConditionId'] = $this->ci->Survey_questionnaire_option_model->autopopulateConditionId;
                                $selectInput['readonly'] = $this->ci->Survey_questionnaire_option_model->readonly;
                                $selectInput['severity'] = $this->ci->Survey_questionnaire_option_model->severity;
                                $selectInput['reminder'] = $this->ci->Survey_questionnaire_option_model->reminder;
                                $selectInput['reminderDays'] = $this->ci->Survey_questionnaire_option_model->reminderDays;
                                $selectInput['requestPrescription'] = $this->ci->Survey_questionnaire_option_model->requestPrescription;
                                $selectInput['parentId'] = $this->ci->Survey_questionnaire_option_model->parentId;
                                $selectInput['childEnabled'] = $this->ci->Survey_questionnaire_option_model->childEnabled;
                                $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);

                                $whereIns[$this->ci->Survey_questionnaire_option_model->surveyQuestionId] = $chiefCompSurveyQuestionIdArray;                                
                                $this->ci->Survey_questionnaire_option_model->setWhereIns($whereIns);
                                
                                //$where[$this->ci->Survey_questionnaire_option_model->parentId] = 0;
                                //$this->ci->Survey_questionnaire_option_model->setWhere($where);

                                $chiefCompSurveyQuestionnaireOptionData = $this->ci->Survey_questionnaire_option_model->get();
//                                print_r($chiefCompSurveyQuestionnaireOptionData); exit;


                                $chiefCompSurveyQuestionOptionIdData = commonHelperGetGroupArray($chiefCompSurveyQuestionnaireOptionData, 'surveyQuestionId');
                                $chiefCompSurveyQuestionParentOptionIdData = commonHelperGetGroupArray($chiefCompSurveyQuestionnaireOptionData, 'parentId');
                                
                                $chiefCompSurveyQuestionOptionIdArray = array_keys($chiefCompSurveyQuestionOptionIdData);
                                $subOptionArray = array();
                                if (count($chiefCompSurveyQuestionParentOptionIdData) > 0)
                                    unset($chiefCompSurveyQuestionParentOptionIdData[0]);

//                                print_r($chiefCompSurveyQuestionOptionIdData); exit;
                                $temp_question_data = array();
                                foreach ($chiefCompSurveyQuestionIdData as $question) {
                                    $temp_question_data[$question['surveyQuestionId']] = $question;
                                }
                                $chiefCompSurveyQuestionIdData = $temp_question_data;

                                $temp_question_data = array();
                                foreach ($chiefCompSurveyQuestionnaireData as $key => $question) {

                                    $temp_question_data[$question['id']] = $question;
                                }
                                $chiefCompSurveyQuestionnaireData = $temp_question_data;
//                                debugArray($chiefCompSurveyQuestionIdData); exit;
                                foreach ($chiefCompSurveyQuestionIdData as $chiefCompSurQkey => $chiefCompSurQval) {
//                                    debugArray($chiefCompSurveyQuestionIdData); 
//                                    debugArray($chiefCompSurveyQuestionOptionIdData); exit;
                                    
                                    if (in_array($chiefCompSurQval['surveyQuestionId'], $chiefCompSurveyQuestionOptionIdArray)) {

                                        foreach ($chiefCompSurveyQuestionOptionIdData[$chiefCompSurQval['surveyQuestionId']] as $chiefCompOptVal) {
//                                            print_r($chiefCompSurveyQuestionOptionIdData[$chiefCompSurQval['surveyQuestionId']]); exit;

                                            if (isset($chiefCompSurveyQuestionParentOptionIdData[$chiefCompOptVal['id']])) {
                                                foreach ($chiefCompSurveyQuestionParentOptionIdData[$chiefCompOptVal['id']] as $key => $tempArray) {
//                                                    debugArray($chiefCompSurveyQuestionParentOptionIdData); exit;
//                                                    debugArray($tempArray); exit;
                                                    $ans = '';
                                                    if (isset($final_options_answers[$tempArray['id']])) {
                                                        $ans = $final_options_answers[$tempArray['id']];
                                                        $chiefCompSurveyQuestionParentOptionIdData[$chiefCompOptVal['id']][$key]['answered'] = 1;
                                                    } else {
                                                        if (!isset($chiefCompSurveyQuestionParentOptionIdData[$chiefCompOptVal['id']][$key]['answered']))
                                                            $chiefCompSurveyQuestionParentOptionIdData[$chiefCompOptVal['id']][$key]['answered'] = 0;
                                                    }
                                                    $tempArray['ans'] = $ans;
                                                    $chiefCompSurveyQuestionParentOptionIdData[$chiefCompOptVal['id']][$key] = $tempArray;
                                                    
                                                }
                                                
                                                $tempArray = array();
                                                $tempArray = array_values($chiefCompSurveyQuestionParentOptionIdData[$chiefCompOptVal['id']]);
//                                                debugArray($tempArray); exit;
                                                ///$chiefCompOptVal['subOptions'][] = $tempArray;
                                                $chiefCompOptVal['subOptions'] = $tempArray;
                                            }

//                                            if ($chiefCompOptVal['parentId'] == 0) {                                                
                                            if (isset($chiefCompSurveyQuestionIdData[$chiefCompSurQkey]['surveyQuestionId']))
                                                $chiefCompSurveyQuestionIdData[$chiefCompSurQkey] = $chiefCompSurveyQuestionnaireData[$chiefCompSurQkey];
                                            $ans = '';
                                            if (isset($final_options_answers[$chiefCompOptVal['id']])) {
                                                $ans = $final_options_answers[$chiefCompOptVal['id']];
                                                $chiefCompSurveyQuestionIdData[$chiefCompSurQkey]['answered'] = 1;
                                            } else {
                                                if (!isset($chiefCompSurveyQuestionIdData[$chiefCompSurQkey]['answered']))
                                                    $chiefCompSurveyQuestionIdData[$chiefCompSurQkey]['answered'] = 0;
                                            }
                                            $chiefCompOptVal['ans'] = $ans;
                                            if($chiefCompOptVal['parentId'] == 0)
                                                $chiefCompSurveyQuestionIdData[$chiefCompSurQkey]['options'][] = $chiefCompOptVal;
                                            
//                                            }                                                                                   
                                        }
//                                        print_r($chiefCompSurveyQuestionIdData); exit;
                                    } else {
                                        unset($chiefCompSurveyQuestionIdData[$chiefCompSurQkey]);
                                    }
                                }

//                                print_r($chiefCompSurveyQuestionIdData);  exit; 

                                $reChiefCompSurveyQuestionIdData = array();
                                foreach ($chiefCompSurveyQuestionIdData as $qdKey => $qdVal) {
                                    //print_r($qdVal);
                                    $reChiefCompSurveyQuestionIdData[$qdKey] = $qdVal;
                                    $qdVal['surveyTaxonomyName'] = NULL;
                                    if (isset($chiefCompSurveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'])) {
                                        $qdVal['surveyTaxonomyName'] = $chiefCompSurveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'];
                                    }
                                    $reChiefCompSurveyQuestionIdData[$qdKey] = $qdVal;
                                }
                            }

                            $chiefComplaintSurveyReport[$i]['questions'] = $reChiefCompSurveyQuestionIdData;
                            $finalCcyAssessment = null;
                            foreach ($chiefComplaintSurveyReport[$i]['questions'] as $question) {
                                $finalCcyAssessment[$question['order']] = $question;
                            }
                            $temprorayArray = null;
                            foreach ($finalCcyAssessment as $question) {

                                if ($question['conditional_display'] == 1) {
                                    if (!in_array($question['id'], $found_array)) {
                                        unset($finalPrimaryAssessment[$key]);
                                    } else {
                                        $temprorayArray[] = $question;
                                    }
                                } else {
                                    $temprorayArray[] = $question;
                                }
                            }
                            $chiefComplaintSurveyReport[$i]['questions'] = $temprorayArray;
                            $chiefComplaintResponse = (array) $chiefComplaintResponse;
                            $chiefComplaintResponse['questionnaire'][$i] = $chiefComplaintSurveyReport[$i];

                            $i++;
                        }
                    }
                }
            }
        }


//        debugArray($chiefComplaintResponse); exit;
//        $output['status'] = TRUE;
//        $output['response']['data']['patientData'] = $patientData;
        $output['primaryAssessmentData'] = $primaryAssessmentResponse;
        $output['chiefComplaintData'] = $chiefComplaintResponse;

        $output['id'] = $medicalIncidentVisit;
        $output['visit_code'] = $medicalSurveyData[0]['medicalIncidentVisitCode'];
        $output['date'] = $medicalSurveyData[0]['registrationDate'];
        $output['type'] = $medicalSurveyData[0]['type'];
        //$outout['response']['total'] = count($primaryAssessmentSurveyReportData);
//        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function createChiefComplaint($inputData) {
        ///print_r($inputData); exit;   

        $medicalIncidentId = $inputData["medicalIncidentId"];
        //$medicalIncidentDetailsId = $inputData["medicalIncidentDetailsId"];        
        //$medicalIncidentVisitId = $inputData["medicalIncidentVisitId"];

        if (!empty($medicalIncidentId) && is_array($inputData["survey"]) && count($inputData["survey"]) > 0) {

            $registrationDate = $inputData["registrationDate"];
            $survey = $inputData["survey"];
            $hospitalId = "";
            $redflagQuestionId = "";
            $redflagOptionId = "";
        
            foreach ($survey as $surveyKey => $surveyValue) {

                $surveyId = $surveyValue['surveyId'];
                $questions = $surveyValue['questions'];

                /////////////Check Questions Redflag Status ///////////
                $qtnIdData = commonHelperGetIdArray($questions, 'questionId');
                $qtnIdsArray = array_keys($qtnIdData);
                ///print_r($qtnIdsArray); exit;
                $redflagStatus = $this->getRedflagQuestionsOptionsIdsBySurveyId($surveyId, $type = "question", $qtnIdsArray);
                //print_r($redflagStatus);
                /////////////////////////////////////////////////////////////////        

                if ($redflagStatus != "true") {
                    /////////////Check Questions and Options as Mandatory ///////////
                    $checkData = $this->checkQuestionsAndOptionsAsMandatory($surveyId, $type = "question", $questions, $incidentType = "");
                    if ($checkData != "") {
                        return $checkData;
                    }
                    /////////////////////////////////////////////////////////////////
                } else {
                    if (isset($inputData['hospitalId'])) {
                        $hospitalId = $inputData['hospitalId'];
                    }
                    if (isset($inputData['questionId'])) {
                        $redflagQuestionId = $inputData['questionId'];
                    }
                    if (isset($inputData['optionId'])) {
                        $redflagOptionId = $inputData['optionId'];
                    }
                }

                ///echo "hii";  exit;               
               
                if (!empty($surveyValue['surveyId'])) {

                    $surveyId = $surveyValue['surveyId'];
                    $medicalIncident = $this->checkMedicalIncidentById($medicalIncidentId);
                    $medicalIncidentVisit = $this->checkMedicalIncidentVisitByIncidentId($medicalIncidentId);
                    $medicalIncidentVisitId = $medicalIncidentVisit[0]["id"];
                    //$medicalIncidentVisit = $this->checkMedicalIncidentVisitByVisitId($medicalIncidentVisitId);
                    //print_r($medicalIncident); 
                    //print_r($medicalIncidentVisit); exit;

                    $medicalIncidentDetails = $this->checkMedicalIncidentDetailsByIncidentId($medicalIncidentId);
                    $medicalIncidentDetailId = $medicalIncidentDetails[0]['id'];
                    ///print_r($medicalIncidentDetails); exit;

                    if ((count($medicalIncident) == 0)) {
                        $output['status'] = FALSE;
                        ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_VISIT_NOT_EXISTS;
                        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_incident_details_message');
                        $output['statusCode'] = STATUS_INVALID;
                        return $output;
                    } else {
                        $this->ci->Medicalsurveyreport_model->resetVariable();
                        $selectInput = array();
                        $medicalSurveyReportData = array();
                        $where = array();
                        $selectInput['id'] = $this->ci->Medicalsurveyreport_model->surveyId;
                        //$where[$this->ci->Medicalsurveyreport_model->medicalIncidentVisitId] = $medicalIncidentVisitId;
                        $where[$this->ci->Medicalsurveyreport_model->medicalIncidentId] = $medicalIncidentId;
                        //$where[$this->ci->Medicalsurveyreport_model->medicalIncidentDetailId] = $medicalIncidentDetailId;
                        $where[$this->ci->Medicalsurveyreport_model->surveyId] = $surveyId;
                        $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
                        $this->ci->Medicalsurveyreport_model->setWhere($where);
                        $medicalSurveyReportData = $this->ci->Medicalsurveyreport_model->get();
                        //echo count($medicalSurveyReportData);  exit;
                        if (count($medicalSurveyReportData) > 0) {
                            $output['status'] = FALSE;
                            ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_EXISTS;
                            $output['response']['messages'][] = $this->ci->lang->line('error_medical_incident_exists_message');
                            $output['statusCode'] = STATUS_DATA_EXISTS;
                            return $output;
                        }

                        $surveyQtnIdData = commonHelperGetIdArray($surveyValue['questions'], 'questionId');
                        $surveyQtnIdsArray = array_keys($surveyQtnIdData);
                        //print_r($surveyQtnIds); exit; 

                        $this->ci->Survey_questionnaire_model->resetVariable();
                        $selectInput = array();
                        $surQtnData = array();
                        $where = array();
                        $whereIns = array();
                        $selectInput['id'] = $this->ci->Survey_questionnaire_model->surveyId;
                        $where[$this->ci->Survey_questionnaire_model->type] = "question";
                        $whereIns[$this->ci->Survey_questionnaire_model->id] = $surveyQtnIdsArray;
                        $this->ci->Survey_questionnaire_model->setSelect($selectInput);
                        $this->ci->Survey_questionnaire_model->setWhere($where);
                        $this->ci->Survey_questionnaire_model->setWhereIns($whereIns);
                        $surQtnData = $this->ci->Survey_questionnaire_model->get();

                        $subQtnCount = count($surveyQtnIdData);
                        $actualQtnCount = count($surQtnData);
                        //echo $subQtnCount."==".$actualQtnCount; exit;

                        if ($subQtnCount != $actualQtnCount) {
                            $output['status'] = FALSE;
                            ///$output['response']['message'] = ERROR_INVALID_CHIEF_COMPLAINT_QUESTIONS;
                            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_incident_data_message');
                            $output['statusCode'] = STATUS_INVALID;
                            return $output;
                        }

                        $medicalIncidentId = $medicalIncident[0]['id'];
                        $medicalIncidentStatus = $medicalIncident[0]['medicalIncidentStatus'];
                        $patientId = $medicalIncident[0]['patientId'];

                        $patientData = $this->getMedicalRegistrationCode($patientId);
                        $medicalRegistrationCode = $patientData[0]['medical_registration_code'];
                        $medicalIncidentCount = $patientData[0]['medicalIncidentCount'];
                        $medicalIncidentVisitCount = $patientData[0]['medicalIncidentVisitCount'];

                        //print_r($patientData); exit;
                        //echo $medicalIncidentCode; 
                        //exit;

                        $this->ci->Medicalsurveyreport_model->resetVariable();
                        $selectInput = array();
                        $medicalIncidentSurveysData = array();
                        $where = array();
                        $groupBy = array();
                        $selectInput['id'] = $this->ci->Medicalsurveyreport_model->surveyId;
                        $where[$this->ci->Medicalsurveyreport_model->medicalIncidentId] = $medicalIncidentId;
                        $groupBy[] = $this->ci->Medicalsurveyreport_model->surveyId;
                        $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
                        $this->ci->Medicalsurveyreport_model->setWhere($where);
                        $this->ci->Medicalsurveyreport_model->setGroupBy($groupBy);
                        $medicalIncidentSurveysCount = $this->ci->Medicalsurveyreport_model->getCount();
                        //$medicalIncidentSurveysData = $this->getMedicalIncidentAllSurveys($medicalIncidentId);
                        //print_r($medicalIncidentSurveysData); 
                        //exit;

                        $this->ci->Medicalincidentvisit_model->resetVariable();
                        $selectInput = array();
                        $medicalVisitData = array();
                        $where = array();
                        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
                        $selectInput['type'] = $this->ci->Medicalincidentvisit_model->type;
                        $selectInput['bcpUserId'] = $this->ci->Medicalincidentvisit_model->bcpUserId;
                        $where[$this->ci->Medicalincidentvisit_model->id] = $medicalIncidentVisitId;
                        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
                        $this->ci->Medicalincidentvisit_model->setWhere($where);
                        $medicalVisitData = $this->ci->Medicalincidentvisit_model->get();
                        ///print_r($medicalVisitData); exit;

                        if (count($medicalVisitData) > 0) {
                            $visitType = $medicalVisitData[0]['type'];
                            $bcpUserId = $medicalVisitData[0]['bcpUserId'];
                            $mvisitId = $medicalVisitData[0]['id'];

                            //echo $medicalIncidentStatus .", ".$medicalIncidentSurveysCount;  exit;
                            
                            if ($redflagStatus == "true") {
                                $medical_incident_status = "completed";
                                $medical_incident_detail_status = "completed";
                                $visit_type="redflag";
                            }
                            else{
                                $medical_incident_status = "inprocess";
                                $medical_incident_detail_status = "inprocess";
                                $visit_type="incident";
                            }
                            
                            if ($medicalIncidentStatus == 'initiated' && $medicalIncidentSurveysCount == 1) {
                                ///if ( $medicalIncidentStatus == 'initiated' && $visitType == 'nonincident' || $visitType == 'incident') {

                                $medicalIncidentCode = $medicalRegistrationCode . "/" . MEDICAL_INCIDENT_STRING . $medicalIncidentCount;
                                $medicalIncidentData['medical_incident_code'] = $medicalIncidentCode;

                                $medicalIncidentVisitCode = $medicalIncidentCode . "/" . MEDICAL_INCIDENT_VISIT_STRING . $medicalIncidentVisitCount;
                                $medicalIncidentVisitData['medical_incident_visit_code'] = $medicalIncidentVisitCode;

                                $this->ci->Medicalincidentdetail_model->resetVariable();
                                $selectInput = array();
                                $medicalIncDetailsData = array();
                                $where = array();
                                $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
                                $where[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $medicalIncidentId;
                                $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
                                $this->ci->Medicalincidentdetail_model->setWhere($where);
                                $medicalIncDetailsData = $this->ci->Medicalincidentdetail_model->get();
                                $medicalIncidentDetailsId = $medicalIncDetailsData[0]['id'];

                                ///print_r($medicalIncDetailsData); exit;

                                $this->ci->Medicalincidentdetail_model->resetVariable();
                                //$incDetailsUpdateData['type'] = 'incident';
                                $incDetailsUpdateData['survey_id'] = $surveyId;
                                $incDetailsUpdateData['medical_incident_detail_status'] = $medical_incident_detail_status;
                                $where = array($this->ci->Medicalincidentdetail_model->id => $medicalIncidentDetailId);
                                $this->ci->Medicalincidentdetail_model->setInsertUpdateData($incDetailsUpdateData);
                                $this->ci->Medicalincidentdetail_model->setWhere($where);
                                $this->ci->Medicalincidentdetail_model->update_data();

                                $this->ci->Medicalincident_model->resetVariable();
                                //$incUpdateData['medical_incident_code'] = $modifiedMedicalIncidentCode;
                                $incUpdateData['medical_incident_status'] = $medical_incident_status;
                                $where = array($this->ci->Medicalincident_model->id => $medicalIncidentId);
                                $this->ci->Medicalincident_model->setInsertUpdateData($incUpdateData);
                                $this->ci->Medicalincident_model->setWhere($where);
                                $this->ci->Medicalincident_model->update_data();

                                if ($redflagStatus == "true") {
                                    $mIVisitType = 'redflag';
                                    $incUpdateData = array();
                                    $this->ci->Medicalincident_model->resetVariable();
                                    //$incUpdateData['medical_incident_code'] = $modifiedMedicalIncidentCode;
                                    $incUpdateData['type'] = 'redflag';
                                    $where = array($this->ci->Medicalincidentvisit_model->id => $mvisitId);
                                    $this->ci->Medicalincidentvisit_model->setInsertUpdateData($incUpdateData);
                                    $this->ci->Medicalincidentvisit_model->setWhere($where);
                                    $this->ci->Medicalincidentvisit_model->update_data();

                                    if (isset($hospitalId) && $hospitalId !="") {
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->medicalIncidentDetailId] = $medicalIncidentDetailId;
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->surveyQuestionId] = $redflagQuestionId;
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->surveyQuestionOptionId] = $redflagOptionId;
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->hospitalId] = $hospitalId;
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->createdby] = $inputData["bcp_user_id"];
                                        $bcphptlId = $this->ci->Bcpreferredhospital_model->insert_data($this->ci->Bcpreferredhospital_model->dbTable, $this->ci->Bcpreferredhospital_model->insertUpdateArray);
                                    }
                                }
                            } else {
                                $medicalIncidentCount = $medicalIncidentCount + 1;
                                $medicalIncidentCode = $medicalRegistrationCode . "/" . MEDICAL_INCIDENT_STRING . $medicalIncidentCount;
                                $medicalIncidentData['medical_incident_code'] = $medicalIncidentCode;

                                $medicalIncidentVisitCode = $medicalIncidentCode . "/" . MEDICAL_INCIDENT_VISIT_STRING . $medicalIncidentVisitCount;
                                $medicalIncidentVisitData['medical_incident_visit_code'] = $medicalIncidentVisitCode;

                                ///print_r($medicalIncidentData);
                                ///print_r($medicalIncidentVisitData);
                                ///exit;

                                $medicalIncidentData['medical_incident_status'] = $medical_incident_status;

                                $this->ci->Medicalincident_model->startTransaction();
                                $this->ci->Medicalincident_model->resetVariable();
                                $where = array($this->ci->Medicalincident_model->id => $medicalIncidentId);
                                $this->ci->Medicalincident_model->setInsertUpdateData($medicalIncidentData);
                                $this->ci->Medicalincident_model->setWhere($where);
                                $this->ci->Medicalincident_model->update_data();

                                $this->ci->Medicalincidentdetail_model->resetVariable();
                                $this->ci->Medicalincidentdetail_model->insertUpdateArray[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $medicalIncidentId;
                                $this->ci->Medicalincidentdetail_model->insertUpdateArray[$this->ci->Medicalincidentdetail_model->type] = "incident";
                                $this->ci->Medicalincidentdetail_model->insertUpdateArray[$this->ci->Medicalincidentdetail_model->surveyId] = $surveyId;
                                $this->ci->Medicalincidentdetail_model->insertUpdateArray[$this->ci->Medicalincidentdetail_model->medicalIncidentDetailStatus] = $medical_incident_detail_status;
                                $medicalIncidentDetailsId = $this->ci->Medicalincidentdetail_model->insert_data($this->ci->Medicalincidentdetail_model->dbTable, $this->ci->Medicalincidentdetail_model->insertUpdateArray);

                                $patiendUpdateData = array();
                                $patiendUpdateData['medical_incident_count'] = $medicalIncidentCount;
                                $patiendUpdateData['medical_incident_visit_count'] = $medicalIncidentVisitCount;
                                $this->ci->Patient_model->resetVariable();
                                $where = array($this->ci->Patient_model->id => $patientId);
                                $this->ci->Patient_model->setInsertUpdateData($patiendUpdateData);
                                $this->ci->Patient_model->setWhere($where);
                                $this->ci->Patient_model->update_data();
                            }

                            //echo $medicalIncidentId ."--". $medicalIncidentVisitId."--". count($survey); exit;
                            //$surveyId = $surveyValue['surveyId'];

                            $questions = $surveyValue['questions'];

                            $surQtnData['medical_incident_id'] = $medicalIncidentId;
                            $surQtnData['medical_incident_detail_id'] = $medicalIncidentDetailId;
                            $surQtnData['medical_incident_visit_id'] = $medicalIncidentVisitId;
                            $surQtnData['survey_id'] = $surveyId;
                            $surQtnData['registrationDate'] = $inputData["registrationDate"];
                            $surQtnData['bcp_user_id'] = $inputData["bcp_user_id"];

                            /////////////Save Survey Report//////
                            $saveStatus = $this->saveQuestionnaireOptionData($surQtnData, $questions, $type = "question");
                            ///////////////////////////////////// 
                            
                            try {
                                if ($this->ci->Medicalsurveyreport_model->transactionStatusCheck() === FALSE) {
                                    $this->ci->Medicalsurveyreport_model->rollBackLastTransaction();

                                    $output['status'] = FALSE;
                                    ///$output["response"]["messages"][] = ERROR_SOMETHING_WENT_WRONG;
                                    $output['response']['messages'][] = $this->ci->lang->line('error_something_went_wrong_message');
                                    $output['statusCode'] = STATUS_SERVER_ERROR;
                                    return $output;
                                } else {
                                    $this->ci->Medicalsurveyreport_model->commitLastTransaction();

                                    $output['status'] = TRUE;
                                    ///$output["response"]["messages"][] = CHIEF_COMPLAINT_SUBMITTED;
                                    $output['response']['messages'][] = $this->ci->lang->line('success_chief_complaint_create_message');
                                    $output['response']['data']['medicalRegistrationCode'] = $medicalRegistrationCode;
                                    $output['response']['data']['medicalIncidentCode'] = $medicalIncidentCode;
                                    $output['response']['data']['medicalIncidentVisitCode'] = $medicalIncidentVisitCode;
                                    $output['response']['data']['patientId'] = $patientId;
                                    //$output['response']['data']['medicalIncidentNumber'] = $val1;
                                    //$output['response']['data']['medicalIncidentVisitNumber'] = $val2;
                                    $output['response']['data']['medicalIncidentDetailsId'] = $medicalIncidentDetailsId;
                                    $output['response']['data']['medicalIncidentId'] = $medicalIncidentId;
                                    $output['response']['data']['medicalIncidentVisitId'] = $medicalIncidentVisitId;
                                    $output['statusCode'] = STATUS_CREATED;
                                    return $output;
                                }
                            } catch (Exception $exc) {
                                return $exc->message();
                            }
                        } else {
                            $output['status'] = FALSE;
                            ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_VISIT_NOT_EXISTS;
                            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_incident_details_message');
                            $output['statusCode'] = STATUS_BAD_REQUEST;
                            return $output;
                        }
                    }
                }
            }
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_CHIEF_COMPLAINT_NO_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_medical_incident_data_empty_message');
            $output['statusCode'] = STATUS_BAD_REQUEST;
            return $output;
        }
    }

    public function saveChiefComplaintDiagnoses($inputData) {
        //print_r($inputData); exit;    
        ///$medicalIncidentId = $inputData["medicalIncidentId"];
        $medicalIncidentDetailId = $inputData["medicalIncidentDetailsId"];
        ///$medicalIncidentVisitId = $inputData["medicalIncidentVisitId"];
        $hospitalId = "";
        $redflagQuestionId = "";
        $redflagOptionId = "";
        
        if (!empty($medicalIncidentDetailId) && is_array($inputData["survey"]) && count($inputData["survey"]) > 0) {
            $survey = $inputData["survey"];
            //print_r($survey[0]['questions']); exit; 
            $registrationDate = $inputData["registrationDate"];

            foreach ($survey as $surveyKey => $surveyValue) {

                if (isset($surveyValue['surveyId']) && !empty($surveyValue['surveyId'])) {
                    $surveyId = $surveyValue['surveyId'];
                    $questions = $surveyValue['questions'];

                    /////////////Check Questions Redflag Status ///////////
                    $qtnIdData = commonHelperGetIdArray($questions, 'questionId');
                    $qtnIdsArray = array_keys($qtnIdData);
                    ///print_r($qtnIdsArray); exit;
                    $redflagStatus = $this->getRedflagQuestionsOptionsIdsBySurveyId($surveyId, $type = "diagnoses", $qtnIdsArray);
                    //print_r($redflagStatus);
                    /////////////////////////////////////////////////////////////////        

                    if ($redflagStatus != "true") {
                        /////////////Check Questions and Options as Mandatory ///////////
                        $checkData = $this->checkQuestionsAndOptionsAsMandatory($surveyId, $type = "diagnoses", $questions, $incidentType = "");
                        if ($checkData != "") {
                            return $checkData;
                        }
                        /////////////////////////////////////////////////////////////////
                    } else {                        
                        if (isset($inputData['hospitalId'])) {
                            $hospitalId = $inputData['hospitalId'];
                        }
                        if (isset($inputData['questionId'])) {
                            $redflagQuestionId = $inputData['questionId'];
                        }
                        if (isset($inputData['optionId'])) {
                            $redflagOptionId = $inputData['optionId'];
                        }
                    }

                    //print_r($questions);  exit;

                    $survey = $this->checkSurvey($surveyId);
                    $surveyType = $survey[0]['type'];

                    //$medicalIncidentDetails = $this->checkMedicalIncidentDetailsByIncidentIdSurveyId($medicalIncidentId, $surveyId);
                    //$medicalIncidentDetailsId = $medicalIncidentDetails[0]["id"];

                    $medicalIncidentDetails = $this->checkMedicalIncidentDetailsById($medicalIncidentDetailId, $surveyId);
                    //print_r($medicalIncidentDetails); exit; 

                    if ((count($medicalIncidentDetails) == 0)) {
                        $output['status'] = FALSE;
                        ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_VISIT_NOT_EXISTS;
                        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_incident_details_message');
                        $output['statusCode'] = STATUS_INVALID;
                        return $output;
                    } else {

                        $medicalIncidentDetailId = $medicalIncidentDetails[0]["id"];
                        $medicalIncidentId = $medicalIncidentDetails[0]["medicalIncidentId"];
                        $medicalIncidentDetailStatus = $medicalIncidentDetails[0]["medicalIncidentDetailStatus"];

                        $medicalIncident = $this->checkMedicalIncidentById($medicalIncidentId);
                        $medicalIncidentStatus = $medicalIncident[0]['medicalIncidentStatus'];

                        //$medicalIncidentVisit = $this->checkMedicalIncidentVisitByVisitId($medicalIncidentVisitId);                    
                        $medicalIncidentVisit = $this->checkMedicalIncidentVisitByIncidentId($medicalIncidentId);
                        $medicalIncidentVisitId = $medicalIncidentVisit[0]["id"];

                        //print_r($medicalIncidentStatus); exit;

                        if ($medicalIncidentDetailStatus == "initiated") {
                            $output['status'] = FALSE;
                            ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_VISIT_NOT_EXISTS;
                            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_incident_details_message');
                            $output['statusCode'] = STATUS_INVALID;
                            return $output;
                        } else if ($medicalIncidentDetailStatus == 'completed') {
                            $output['status'] = FALSE;
                            ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_EXISTS;
                            $output['response']['messages'][] = $this->ci->lang->line('error_medical_incident_exists_message');
                            $output['statusCode'] = STATUS_INVALID;
                            return $output;
                        } else if ($medicalIncidentDetailStatus == 'inprocess') {

                            $surveyQtnIdData = commonHelperGetIdArray($surveyValue['questions'], 'questionId');
                            $surveyQtnIdsArray = array_keys($surveyQtnIdData);
                            //print_r($surveyQtnIdsArray); exit; 

                            $this->ci->Survey_questionnaire_model->resetVariable();
                            $selectInput = array();
                            $surQtnData = array();
                            $where = array();
                            $whereIns = array();
                            $selectInput['id'] = $this->ci->Survey_questionnaire_model->surveyId;
                            $where[$this->ci->Survey_questionnaire_model->type] = "diagnoses";
                            $whereIns[$this->ci->Survey_questionnaire_model->id] = $surveyQtnIdsArray;
                            $this->ci->Survey_questionnaire_model->setSelect($selectInput);
                            $this->ci->Survey_questionnaire_model->setWhere($where);
                            $this->ci->Survey_questionnaire_model->setWhereIns($whereIns);
                            $surQtnData = $this->ci->Survey_questionnaire_model->get();

                            $subQtnCount = count($surveyQtnIdData);
                            $actualQtnCount = count($surQtnData);
                            //echo $subQtnCount."==".$actualQtnCount;
                            //exit;

                            if ($subQtnCount == $actualQtnCount) {

                                $this->ci->Medicalsurveyreport_model->resetVariable();
                                $selectInput = array();
                                $reSurQtnData = array();
                                $where = array();
                                $whereIns = array();
                                $selectInput['id'] = $this->ci->Medicalsurveyreport_model->surveyId;
                                $where[$this->ci->Medicalsurveyreport_model->medicalIncidentVisitId] = $medicalIncidentVisitId;
                                //$where[$this->ci->Medicalsurveyreport_model->medicalIncidentId] = $medicalIncidentId;
                                $where[$this->ci->Medicalsurveyreport_model->surveyId] = $surveyId;
                                $whereIns[$this->ci->Medicalsurveyreport_model->surveyQuestionId] = $surveyQtnIdsArray;
                                $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
                                $this->ci->Medicalsurveyreport_model->setWhere($where);
                                $this->ci->Medicalsurveyreport_model->setWhereIns($whereIns);
                                $reSurQtnData = $this->ci->Medicalsurveyreport_model->get();

                                //print_r($reSurQtnData); exit;

                                if (count($reSurQtnData) > 0) {
                                    $output['status'] = FALSE;
                                    ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_EXISTS;
                                    $output['response']['messages'][] = $this->ci->lang->line('error_medical_incident_exists_message');
                                    $output['statusCode'] = STATUS_INVALID;
                                    return $output;
                                }

                                $this->ci->Medicalsurveyreport_model->resetVariable();
                                $selectInput = array();
                                $medicalSurveyReportData = array();
                                $where = array();
                                $selectInput['id'] = $this->ci->Medicalsurveyreport_model->surveyId;
                                $where[$this->ci->Medicalsurveyreport_model->medicalIncidentVisitId] = $medicalIncidentVisitId;
                                //$where[$this->ci->Medicalsurveyreport_model->medicalIncidentId] = $medicalIncidentId;
                                $where[$this->ci->Medicalsurveyreport_model->surveyId] = $surveyId;
                                $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
                                $this->ci->Medicalsurveyreport_model->setWhere($where);
                                $medicalSurveyReportData = $this->ci->Medicalsurveyreport_model->get();
                                //print_r($medicalSurveyReportData);  exit;

                                if (count($medicalSurveyReportData) == 0) {
                                    $output['status'] = FALSE;
                                    ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_VISIT_NOT_EXISTS;
                                    $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_incident_details_message');
                                    $output['statusCode'] = STATUS_INVALID;
                                    return $output;
                                }

                                $this->ci->Medicalincident_model->startTransaction();
                                $this->ci->Medicalincident_model->resetVariable();
                                $incUpdateData['medical_incident_status'] = "completed";
                                $where = array($this->ci->Medicalincident_model->id => $medicalIncidentId);
                                $this->ci->Medicalincident_model->setInsertUpdateData($incUpdateData);
                                $this->ci->Medicalincident_model->setWhere($where);
                                $this->ci->Medicalincident_model->update_data();

                                $this->ci->Medicalincidentdetail_model->resetVariable();
                                $incDetailUpdateData['medical_incident_detail_status'] = "completed";
                                $where = array($this->ci->Medicalincidentdetail_model->id => $medicalIncidentDetailId);
                                $this->ci->Medicalincidentdetail_model->setInsertUpdateData($incDetailUpdateData);
                                $this->ci->Medicalincidentdetail_model->setWhere($where);
                                $this->ci->Medicalincidentdetail_model->update_data();

                                if ($redflagStatus == "true") {
                                    $mIVisitType = 'redflag';
                                    $incUpdateData = array();
                                    $this->ci->Medicalincidentvisit_model->resetVariable();
                                    $incUpdateData['type'] = 'redflag';
                                    $where = array($this->ci->Medicalincidentvisit_model->id => $medicalIncidentVisitId);
                                    $this->ci->Medicalincidentvisit_model->setInsertUpdateData($incUpdateData);
                                    $this->ci->Medicalincidentvisit_model->setWhere($where);
                                    $this->ci->Medicalincidentvisit_model->update_data();

                                    if (isset($hospitalId) && $hospitalId !="") {
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->medicalIncidentDetailId] = $medicalIncidentDetailId;
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->surveyQuestionId] = $redflagQuestionId;
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->surveyQuestionOptionId] = $redflagOptionId;
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->hospitalId] = $hospitalId;
                                        $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->createdby] = $inputData["bcp_user_id"];
                                        $bcphptlId = $this->ci->Bcpreferredhospital_model->insert_data($this->ci->Bcpreferredhospital_model->dbTable, $this->ci->Bcpreferredhospital_model->insertUpdateArray);
                                    }
                                }

                                //print_r($questions); exit; 
                                $surQtnData['medical_incident_id'] = $medicalIncidentId;
                                $surQtnData['medical_incident_detail_id'] = $medicalIncidentDetailId;
                                $surQtnData['medical_incident_visit_id'] = $medicalIncidentVisitId;
                                $surQtnData['survey_id'] = $surveyId;
                                $surQtnData['registrationDate'] = $inputData["registrationDate"];
                                $surQtnData['bcp_user_id'] = $inputData["bcp_user_id"];

                                /////////////Save Survey Report//////
                                $saveStatus = $this->saveQuestionnaireOptionData($surQtnData, $questions, $type = "diagnoses");
                                /////////////////////////////////////    

                                try {
                                    if ($this->ci->Medicalsurveyreport_model->transactionStatusCheck() === FALSE) {
                                        $this->ci->Medicalsurveyreport_model->rollBackLastTransaction();

                                        $output['status'] = FALSE;
                                        ///$output["response"]["messages"][] = ERROR_SOMETHING_WENT_WRONG;
                                        $output['response']['messages'][] = $this->ci->lang->line('error_something_went_wrong_message');
                                        $output['statusCode'] = STATUS_SERVER_ERROR;
                                        return $output;
                                    } else {
                                        $this->ci->Medicalsurveyreport_model->commitLastTransaction();

                                        $output['status'] = TRUE;
                                        if ($surveyType == 'chief-complaint') {
                                            ///$output["response"]["messages"][] = CHIEF_COMPLAINT_SUBMITTED;
                                            $output['response']['messages'][] = $this->ci->lang->line('success_chief_complaint_create_message');
                                        } else {
                                            ///$output["response"]["messages"][] = MEDICAL_FOLLOWUP_SUBMITTED;
                                            $output['response']['messages'][] = $this->ci->lang->line('success_medical_followup_submitted_message');
                                        }
                                        $output['response']['data']['medicalIncidentId'] = $medicalIncidentId;
                                        $output['statusCode'] = STATUS_CREATED;
                                        return $output;
                                    }
                                } catch (Exception $exc) {
                                    return $exc->message();
                                }
                            } else {
                                $output['status'] = FALSE;
                                if ($surveyType == 'chief-complaint') {
                                    ///$output['response']['message'] = ERROR_INVALID_CHIEF_COMPLAINT_QUESTIONS;
                                    $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_incident_data_message');
                                } else {
                                    ///$output["response"]["messages"][] = ERROR_INVALID_FOLLOWUP_QUESTIONS;
                                    $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_followup_questionnaire_message');
                                }
                                $output['statusCode'] = STATUS_BAD_REQUEST;
                                return $output;
                            }
                        }
                    }
                } else {
                    $output['status'] = FALSE;
                    ///$output["response"]["messages"][] = ERROR_NO_SURVEY_DATA;
                    $output['response']['messages'][] = $this->ci->lang->line('error_survey_data_empty_message');
                    $output['statusCode'] = STATUS_BAD_REQUEST;
                    return $output;
                }
            }
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_NO_SURVEY_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_survey_data_empty_message');
            $output['statusCode'] = STATUS_BAD_REQUEST;
            return $output;
        }
    }

    public function createFollowup($inputData) {
        //print_r($inputData); exit; 
        //$medicalIncidentId = $inputData["medicalIncidentId"];
        $medicalIncidentDetailId = $inputData["medicalIncidentDetailsId"];
        //$medicalIncidentVisitId = $inputData["medicalIncidentVisitId"];
        $hospitalId = "";
        $redflagQuestionId = "";
        $redflagOptionId = "";
        
        if (!empty($medicalIncidentDetailId) && is_array($inputData["survey"]) && count($inputData["survey"]) > 0) {

            $registrationDate = $inputData["registrationDate"];
            $survey = $inputData["survey"];

            foreach ($survey as $surveyKey => $surveyValue) {

                $surveyId = $surveyValue['surveyId'];
                $questions = $surveyValue['questions'];

                /////////////Check Questions Redflag Status ///////////
                $qtnIdData = commonHelperGetIdArray($questions, 'questionId');
                $qtnIdsArray = array_keys($qtnIdData);
                ///print_r($qtnIdsArray); exit;
                $redflagStatus = $this->getRedflagQuestionsOptionsIdsBySurveyId($surveyId, $type = "questions", $qtnIdsArray);
                //print_r($redflagStatus);
                /////////////////////////////////////////////////////////////////        

                if ($redflagStatus != "true") {
                    /////////////Check Questions and Options as Mandatory ///////////
                    $checkData = $this->checkQuestionsAndOptionsAsMandatory($surveyId, $type = "questions", $questions, $incidentType = "");
                    if ($checkData != "") {
                        return $checkData;
                    }
                    /////////////////////////////////////////////////////////////////
                } else {
                    
                    if (isset($inputData['hospitalId'])) {
                        $hospitalId = $inputData['hospitalId'];
                    }
                    if (isset($inputData['questionId'])) {
                        $redflagQuestionId = $inputData['questionId'];
                    }
                    if (isset($inputData['optionId'])) {
                        $redflagOptionId = $inputData['optionId'];
                    }
                }

                if (!empty($surveyValue['surveyId'])) {

                    $surveyId = $surveyValue['surveyId'];
                    //$medicalIncident = $this->checkMedicalIncidentById($medicalIncidentId);
                    $medicalIncidentDetails = $this->checkMedicalIncidentDetailsById($medicalIncidentDetailId);
                    //print_r($medicalIncidentDetails); exit;

                    if ((count($medicalIncidentDetails) == 0)) {
                        $output['status'] = FALSE;
                        ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_NOT_EXISTS;
                        $output['response']['messages'][] = $this->ci->lang->line('error_medical_incident_not_exists_message');
                        $output['statusCode'] = STATUS_INVALID;
                        return $output;
                    } else {
                        $medicalIncidentId = $medicalIncidentDetails[0]["medicalIncidentId"];
                        $medicalIncident = $this->checkMedicalIncidentById($medicalIncidentId);
                        $medicalIncidentVisit = $this->checkMedicalIncidentVisitByIncidentId($medicalIncidentId);
                        $medicalIncidentVisitId = $medicalIncidentVisit[0]["id"];
                        $medicalIncidentVisitCode = $medicalIncidentVisit[0]["medicalIncidentVisitCode"];

                        $this->ci->Medicalsurveyreport_model->resetVariable();
                        $selectInput = array();
                        $medicalSurveyReportData = array();
                        $where = array();
                        $selectInput['id'] = $this->ci->Medicalsurveyreport_model->surveyId;
                        //$where[$this->ci->Medicalsurveyreport_model->medicalIncidentVisitId] = $medicalIncidentVisitId;
                        //$where[$this->ci->Medicalsurveyreport_model->medicalIncidentId] = $medicalIncidentId;
                        $where[$this->ci->Medicalsurveyreport_model->medicalIncidentDetailId] = $medicalIncidentDetailId;
                        $where[$this->ci->Medicalsurveyreport_model->surveyId] = $surveyId;
                        $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
                        $this->ci->Medicalsurveyreport_model->setWhere($where);
                        $medicalSurveyReportData = $this->ci->Medicalsurveyreport_model->get();
                        //echo count($medicalSurveyReportData);  exit;
                        if (count($medicalSurveyReportData) > 0) {
                            $output['status'] = FALSE;
                            ///$output['response']['message'] = ERROR_USER_MEDICAL_FOLLOWUP_EXISTS;
                            $output['response']['messages'][] = $this->ci->lang->line('error_medical_followup_exists_message');
                            $output['statusCode'] = STATUS_DATA_EXISTS;
                            return $output;
                        }

                        $surveyQtnIdData = commonHelperGetIdArray($surveyValue['questions'], 'questionId');
                        $surveyQtnIdsArray = array_keys($surveyQtnIdData);
                        //print_r($surveyQtnIds); exit; 

                        $this->ci->Survey_questionnaire_model->resetVariable();
                        $selectInput = array();
                        $surQtnData = array();
                        $where = array();
                        $whereIns = array();
                        $selectInput['id'] = $this->ci->Survey_questionnaire_model->surveyId;
                        $where[$this->ci->Survey_questionnaire_model->type] = "question";
                        $whereIns[$this->ci->Survey_questionnaire_model->id] = $surveyQtnIdsArray;
                        $this->ci->Survey_questionnaire_model->setSelect($selectInput);
                        $this->ci->Survey_questionnaire_model->setWhere($where);
                        $this->ci->Survey_questionnaire_model->setWhereIns($whereIns);
                        $surQtnData = $this->ci->Survey_questionnaire_model->get();

                        $subQtnCount = count($surveyQtnIdData);
                        $actualQtnCount = count($surQtnData);
                        //echo $subQtnCount."==".$actualQtnCount; exit;

                        if ($subQtnCount != $actualQtnCount) {
                            $output['status'] = FALSE;
                            ///$output["response"]["messages"][] = ERROR_INVALID_FOLLOWUP_QUESTIONS;
                            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_followup_questionnaire_message');
                            $output['statusCode'] = STATUS_INVALID;
                            return $output;
                        }

                        $medicalIncidentId = $medicalIncident[0]['id'];
                        $medicalIncidentCode = $medicalIncident[0]['medicalIncidentCode'];
                        ///$medicalIncidentStatus = $medicalIncident[0]['medicalIncidentStatus'];
                        $patientId = $medicalIncident[0]['patientId'];

                        $patientData = $this->getMedicalRegistrationCode($patientId);
                        $medicalRegistrationCode = $patientData[0]['medical_registration_code'];
                        ///$medicalIncidentCount = $patientData[0]['medicalIncidentCount']; 
                        ///$medicalIncidentVisitCount = $patientData[0]['medicalIncidentVisitCount'];
                        //print_r($patientData); exit;

                        $this->ci->Medicalincidentvisit_model->resetVariable();
                        $selectInput = array();
                        $medicalVisitData = array();
                        $where = array();
                        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
                        $selectInput['type'] = $this->ci->Medicalincidentvisit_model->type;
                        $selectInput['bcpUserId'] = $this->ci->Medicalincidentvisit_model->bcpUserId;
                        $where[$this->ci->Medicalincidentvisit_model->id] = $medicalIncidentVisitId;
                        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
                        $this->ci->Medicalincidentvisit_model->setWhere($where);
                        $medicalVisitData = $this->ci->Medicalincidentvisit_model->get();
                        
                        if ($redflagStatus == "true") {
                            //$medical_incident_status = "completed";
                            $medical_incident_detail_status = "completed";
                        }
                        else{
                            //$medical_incident_status = "inprocess";
                            $medical_incident_detail_status = "inprocess";
                        }
                            
                        if (count($medicalVisitData) > 0) {
                            $visitType = $medicalVisitData[0]['type'];
                            $bcpUserId = $medicalVisitData[0]['bcpUserId'];

                            $this->ci->Medicalincidentdetail_model->resetVariable();
                            $incDetailsUpdateData['survey_id'] = $surveyId;
                            $incDetailsUpdateData['medical_incident_detail_status'] = $medical_incident_detail_status;
                            $where = array($this->ci->Medicalincidentdetail_model->id => $medicalIncidentDetailId);
                            $this->ci->Medicalincidentdetail_model->setInsertUpdateData($incDetailsUpdateData);
                            $this->ci->Medicalincidentdetail_model->setWhere($where);
                            $this->ci->Medicalincidentdetail_model->update_data();

                            if ($redflagStatus == "true") {
                                $mIVisitType = 'redflag';
                                $incUpdateData = array();
                                $this->ci->Medicalincidentvisit_model->resetVariable();
                                //$incUpdateData['medical_incident_code'] = $modifiedMedicalIncidentCode;
                                $incUpdateData['type'] = 'redflag';
                                $where = array($this->ci->Medicalincidentvisit_model->id => $medicalIncidentVisitId);
                                $this->ci->Medicalincidentvisit_model->setInsertUpdateData($incUpdateData);
                                $this->ci->Medicalincidentvisit_model->setWhere($where);
                                $this->ci->Medicalincidentvisit_model->update_data();

                                if (isset($hospitalId) && $hospitalId !="") {
                                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->medicalIncidentDetailId] = $medicalIncidentDetailId;
                                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->surveyQuestionId] = $redflagQuestionId;
                                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->surveyQuestionOptionId] = $redflagOptionId;
                                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->hospitalId] = $hospitalId;
                                    $this->ci->Bcpreferredhospital_model->insertUpdateArray[$this->ci->Bcpreferredhospital_model->createdby] = $inputData["bcp_user_id"];
                                    $bcphptlId = $this->ci->Bcpreferredhospital_model->insert_data($this->ci->Bcpreferredhospital_model->dbTable, $this->ci->Bcpreferredhospital_model->insertUpdateArray);
                                }
                            }

                            //echo $medicalIncidentId ."--". $medicalIncidentVisitId."--". count($survey); exit;
                            //$surveyId = $surveyValue['surveyId'];
                            $questions = $surveyValue['questions'];

                            $surQtnData['medical_incident_id'] = $medicalIncidentId;
                            $surQtnData['medical_incident_detail_id'] = $medicalIncidentDetailId;
                            $surQtnData['medical_incident_visit_id'] = $medicalIncidentVisitId;
                            $surQtnData['survey_id'] = $surveyId;
                            $surQtnData['registrationDate'] = $inputData["registrationDate"];
                            $surQtnData['bcp_user_id'] = $inputData["bcp_user_id"];

                            /////////////Save Survey Report//////
                            $saveStatus = $this->saveQuestionnaireOptionData($surQtnData, $questions, $type = "question");
                            ///////////////////////////////////// 

                            try {
                                if ($this->ci->Medicalsurveyreport_model->transactionStatusCheck() === FALSE) {
                                    $this->ci->Medicalsurveyreport_model->rollBackLastTransaction();

                                    $output['status'] = FALSE;
                                    ///$output["response"]["messages"][] = ERROR_SOMETHING_WENT_WRONG;
                                    $output['response']['messages'][] = $this->ci->lang->line('error_something_went_wrong_message');
                                    $output['statusCode'] = STATUS_SERVER_ERROR;
                                    return $output;
                                } else {
                                    $this->ci->Medicalsurveyreport_model->commitLastTransaction();

                                    $output['status'] = TRUE;
                                    ///$output["response"]["messages"][] = MEDICAL_FOLLOWUP_CREATED;
                                    $output['response']['messages'][] = $this->ci->lang->line('success_medical_followup_created_message');
                                    $output['response']['data']['medicalRegistrationCode'] = $medicalRegistrationCode;
                                    $output['response']['data']['medicalIncidentCode'] = $medicalIncidentCode;
                                    $output['response']['data']['medicalIncidentVisitCode'] = $medicalIncidentVisitCode;
                                    $output['response']['data']['patientId'] = $patientId;
                                    $output['response']['data']['medicalIncidentId'] = $medicalIncidentId;
                                    $output['response']['data']['medicalIncidentDetailsId'] = $medicalIncidentDetailId;
                                    $output['response']['data']['medicalIncidentVisitId'] = $medicalIncidentVisitId;
                                    $output['statusCode'] = STATUS_CREATED;
                                    return $output;
                                }
                            } catch (Exception $exc) {
                                return $exc->message();
                            }
                        } else {
                            $output['status'] = FALSE;
                            ///$output['response']['message'] = ERROR_USER_MEDICAL_INCIDENT_VISIT_NOT_EXISTS;
                            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_medical_incident_details_message');
                            $output['statusCode'] = STATUS_BAD_REQUEST;
                            return $output;
                        }
                    }
                }
            }
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_CHIEF_COMPLAINT_NO_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_medical_incident_data_empty_message');
            $output['statusCode'] = STATUS_BAD_REQUEST;
            return $output;
        }
    }

    public function saveQuestionnaireOptionData($surQtnData = "", $questions = "", $type = "question") {
        
        if (!empty($surQtnData) && !empty($questions)) {

            $registrationDate = $surQtnData["registrationDate"];
            $medicalIncidentId = $surQtnData['medical_incident_id'];
            $medicalIncidentDetailId = $surQtnData['medical_incident_detail_id'];
            $medicalIncidentVisitId = $surQtnData['medical_incident_visit_id'];
            $surveyId = $surQtnData['survey_id'];
            $bcpUserId = $surQtnData['bcp_user_id'];

            foreach ($questions as $questionKey => $questionValue) {

                if (isset($questionValue['questionId']) && $questionValue['questionId'] != "") {

                    $surveyQuestionId = $questionValue['questionId'];

                    if (isset($questionValue['options']) && count($questionValue['options']) > 0) {

                        $options = $questionValue['options'];

                        foreach ($options as $optionKey => $optionValue) {

                            if ($optionValue != "") {

                                $surveyQuestionOptionId = $optionValue['id'];
                                $surveyQuestionOptionValue = $optionValue['value'];

                                ///$this->ci->Medicalsurveyreport_model->startTransaction();
                                $this->ci->Medicalsurveyreport_model->insertUpdateArray[$this->ci->Medicalsurveyreport_model->medicalIncidentDetailId] = $medicalIncidentDetailId;
                                $this->ci->Medicalsurveyreport_model->insertUpdateArray[$this->ci->Medicalsurveyreport_model->medicalIncidentId] = $medicalIncidentId;
                                $this->ci->Medicalsurveyreport_model->insertUpdateArray[$this->ci->Medicalsurveyreport_model->medicalIncidentVisitId] = $medicalIncidentVisitId;
                                $this->ci->Medicalsurveyreport_model->insertUpdateArray[$this->ci->Medicalsurveyreport_model->surveyId] = $surveyId;
                                $this->ci->Medicalsurveyreport_model->insertUpdateArray[$this->ci->Medicalsurveyreport_model->surveyQuestionId] = $surveyQuestionId;
                                $this->ci->Medicalsurveyreport_model->insertUpdateArray[$this->ci->Medicalsurveyreport_model->surveyQuestionOptionId] = $surveyQuestionOptionId;
                                $this->ci->Medicalsurveyreport_model->insertUpdateArray[$this->ci->Medicalsurveyreport_model->surveyQuestionOptionValue] = $surveyQuestionOptionValue;
                                $this->ci->Medicalsurveyreport_model->insertUpdateArray[$this->ci->Medicalsurveyreport_model->registrationDate] = $surQtnData["registrationDate"];
                                $this->ci->Medicalsurveyreport_model->insert_data($this->ci->Medicalsurveyreport_model->dbTable, $this->ci->Medicalsurveyreport_model->insertUpdateArray);

                                if ($type == "diagnoses") {

                                    /////////////Save Visit Reminder///////////
                                    $selectInput = array();
                                    $where = array();
                                    $this->ci->Survey_questionnaire_option_model->resetVariable();
                                    $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
                                    $selectInput['reminder'] = $this->ci->Survey_questionnaire_option_model->reminder;
                                    $selectInput['reminderDays'] = $this->ci->Survey_questionnaire_option_model->reminderDays;
                                    $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
                                    $where[$this->ci->Survey_questionnaire_option_model->deleted] = 0;
                                    $where[$this->ci->Survey_questionnaire_option_model->status] = 1;
                                    $where[$this->ci->Survey_questionnaire_option_model->id] = $surveyQuestionOptionId;
                                    $this->ci->Survey_questionnaire_option_model->setWhere($where);
                                    $this->ci->Survey_questionnaire_option_model->setRecords(1);
                                    $surveyQtnsOptsData = $this->ci->Survey_questionnaire_option_model->get();
                                    if (count($surveyQtnsOptsData) > 0) {

                                        $reminder = $surveyQtnsOptsData[0]['reminder'];
                                        $reminderDays = $surveyQtnsOptsData[0]['reminderDays'];
                                        if ($reminder == 1 && $reminderDays > 0) {

                                            $current_timestamp = strtotime($registrationDate);
                                            $curr_date = date('Y-m-d', $current_timestamp);
                                            $addDays = " +" . $reminderDays . " days";
                                            $expiry_timestamp = strtotime(date("Y-m-d", strtotime($curr_date)) . $addDays);
                                            $expire_date = date('Y-m-d', $expiry_timestamp);

                                            $this->ci->Patientvisitreminders_model->insertUpdateArray[$this->ci->Patientvisitreminders_model->medicalIncidentVisitId] = $medicalIncidentVisitId;
                                            $this->ci->Patientvisitreminders_model->insertUpdateArray[$this->ci->Patientvisitreminders_model->medicalIncidentDetailId] = $medicalIncidentDetailId;
                                            $this->ci->Patientvisitreminders_model->insertUpdateArray[$this->ci->Patientvisitreminders_model->surveyQuestionId] = $surveyQuestionId;
                                            $this->ci->Patientvisitreminders_model->insertUpdateArray[$this->ci->Patientvisitreminders_model->surveyQuestionOptionId] = $surveyQuestionOptionId;
                                            $this->ci->Patientvisitreminders_model->insertUpdateArray[$this->ci->Patientvisitreminders_model->visitDate] = $curr_date;
                                            $this->ci->Patientvisitreminders_model->insertUpdateArray[$this->ci->Patientvisitreminders_model->expiryDate] = $expire_date;
                                            $this->ci->Patientvisitreminders_model->insertUpdateArray[$this->ci->Patientvisitreminders_model->bcpUserId] = $bcpUserId;
                                            $patientRemId = $this->ci->Patientvisitreminders_model->insertdata($this->ci->Patientvisitreminders_model->dbTable, $this->ci->Patientvisitreminders_model->insertUpdateArray);
                                        }
                                    }
                                }
                                //////////////////////////////////////////////////
                                $optQuestion = array();
                                if (isset($optionValue['subOptions']) && count($optionValue['subOptions']) > 0) {
                                    $subOptions = $optionValue['subOptions'];
                                    $optQuestion[0]['questionId'] = $questionValue['questionId'];
                                    $optQuestion[0]['options'] = $subOptions;
                                    /////////////Save Survey Report///////////
                                    $saveStatus = $this->saveQuestionnaireOptionData($surQtnData, $optQuestion, $type);
                                    ////////////////////////////////////////// 
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function returnIntValFromString($str) {
        return intval(preg_replace('/[^0-9]+/', '', $str), 10);
    }

    public function getPatientDetails($getByField = "", $getByValue = "", $createdBy = '') {

        //$hff_media_path = $this->ci->config->item('hff_media_path');
        $hff_media_profile_image_path_read = $this->ci->config->item('hff_media_profile_image_path_read');
        $hff_media_profile_image_default_path_read = $this->ci->config->item('hff_media_profile_image_default_path_read');

        $this->ci->load->model('Country_model');
        $this->ci->load->model('State_model');
        $this->ci->load->model('City_model');
//        debugArray($createdBy); exit;
        $this->ci->Patient_model->resetVariable();
        $selectInput = array();
        $patientData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Patient_model->id;
        ///$selectInput['name'] = $this->ci->Patient_model->name; 
        $selectInput['medicalRegistrationNumber'] = $this->ci->Patient_model->medicalRegistrationNumber;
        $selectInput['title'] = $this->ci->Patient_model->title;
        $selectInput['firstName'] = $this->ci->Patient_model->firstName;
        $selectInput['middleName'] = $this->ci->Patient_model->middleName;
        $selectInput['lastName'] = $this->ci->Patient_model->lastName;

        $selectInput['profilePicture'] = $this->ci->Patient_model->profilePicture;
        $selectInput['age'] = $this->ci->Patient_model->age;
        $selectInput['dateofBirth'] = $this->ci->Patient_model->dateofBirth;
        $selectInput['gender'] = $this->ci->Patient_model->gender;
        $selectInput['registrationDate'] = $this->ci->Patient_model->registrationDate;
        $selectInput['guardianName'] = $this->ci->Patient_model->guardianName;
        $selectInput['guardianRelation'] = $this->ci->Patient_model->guardianRelation;
        $selectInput['maritalStatus'] = $this->ci->Patient_model->maritalStatus;
        $selectInput['occupation'] = $this->ci->Patient_model->occupation;
        $selectInput['education'] = $this->ci->Patient_model->education;
        $selectInput['caste'] = $this->ci->Patient_model->caste;
        $selectInput['religion'] = $this->ci->Patient_model->religion;
        $selectInput['contactNumber'] = $this->ci->Patient_model->contactNumber;
        $selectInput['emergencyName'] = $this->ci->Patient_model->emergencyContactName;
        $selectInput['emergencyContactRelation'] = $this->ci->Patient_model->emergencyContactRelation;
        $selectInput['emergencyNumber'] = $this->ci->Patient_model->emergencyContactNumber;
        $selectInput['address'] = $this->ci->Patient_model->address;
        $selectInput['pincode'] = $this->ci->Patient_model->pincode;
        $selectInput['idProofType'] = $this->ci->Patient_model->idProofType;
        $selectInput['idProofNo'] = $this->ci->Patient_model->idProofNo;
        $selectInput['houseNo'] = $this->ci->Patient_model->houseNo;
        $selectInput['block'] = $this->ci->Patient_model->block;
        $selectInput['streetName'] = $this->ci->Patient_model->streetName;
        $selectInput['area'] = $this->ci->Patient_model->area;
        $selectInput['countryId'] = $this->ci->Patient_model->countryId;
        $selectInput['stateId'] = $this->ci->Patient_model->stateId;
        $selectInput['cityId'] = $this->ci->Patient_model->cityId;
        $selectInput['village'] = $this->ci->Patient_model->villageName;

        $this->ci->Patient_model->setSelect($selectInput);
        $where[$this->ci->Patient_model->deleted] = 0;
        $where[$this->ci->Patient_model->status] = 1;
        if (!empty($createdBy)) {
            $where[$this->ci->Patient_model->createdby] = $createdBy;
            $this->ci->Patient_model->setWhere($where);
        } else if ($getByField == "id") {
            if (is_array($getByValue)) {
                $whereIns[$this->ci->Patient_model->id] = $getByValue;
                $this->ci->Patient_model->setWhereIns($whereIns);
            } else {
                $where[$this->ci->Patient_model->id] = $getByValue;
                $this->ci->Patient_model->setWhere($where);
            }
        } else if ($getByField == "mrcode") {
            $where[$this->ci->Patient_model->medicalRegistrationNumber] = $getByValue;
            $this->ci->Patient_model->setWhere($where);
        }


        //$this->ci->Patient_model->setRecords(1);
        $patientData = $this->ci->Patient_model->get();
        
        if(!empty($patientData)){
            $this->ci->Country_model->resetVariable();
            $selectInput = array();
            $where = array();
            $selectInput['id'] = $this->ci->Country_model->id;
            $selectInput['country'] = $this->ci->Country_model->name;
            $this->ci->Country_model->setSelect($selectInput);
            $where[$this->ci->Country_model->deleted] = 0;
            $where[$this->ci->Country_model->status] = 1;
            $whereIns[$this->ci->Country_model->id] = $patientData[0]['countryId'];
            $this->ci->Country_model->setWhereIns($whereIns);
            $country_details = $this->ci->Country_model->get();
            if(!empty($country_details))
                $patientData[0]['country'] = $country_details[0]['country'];
            else
                $patientData[0]['country'] = '';


            $this->ci->State_model->resetVariable();
            $selectInput = array();
            $where = array();
            $selectInput['id'] = $this->ci->State_model->id;
            $selectInput['state'] = $this->ci->State_model->name;
            $this->ci->State_model->setSelect($selectInput);
            $where[$this->ci->State_model->deleted] = 0;
            $where[$this->ci->State_model->status] = 1;
            $whereIns[$this->ci->State_model->id] = $patientData[0]['stateId'];
            $this->ci->State_model->setWhereIns($whereIns);

            $state_details = $this->ci->State_model->get();
            if(!empty($state_details))
            $patientData[0]['state'] = $state_details[0]['state'];
            else
                $patientData[0]['state'] = '';

            $this->ci->City_model->resetVariable();
            $selectInput = array();
            $where = array();
            $selectInput['id'] = $this->ci->City_model->id;
            $selectInput['city'] = $this->ci->City_model->name;
            $this->ci->City_model->setSelect($selectInput);
            $where[$this->ci->City_model->deleted] = 0;
            $where[$this->ci->City_model->status] = 1;
            $whereIns[$this->ci->City_model->id] = $patientData[0]['cityId'];
            $this->ci->City_model->setWhereIns($whereIns);
            $city_details = $this->ci->City_model->get();
            if(!empty($city_details))
                $patientData[0]['city'] = $city_details[0]['city'];
            else
                $patientData[0]['city'] = '';


            //print_r($patientData); exit;
            if (count($patientData) > 0) {
                
                $final_profile_picture = "";
                if (isset($patientData[0]['profilePicture']) && $patientData[0]['profilePicture'] != "") {
                    $profile_picture = $hff_media_profile_image_path_read . $patientData[0]['profilePicture'];   
                    ///$final_profile_picture = checkImageByURL($profile_picture);
                    $final_profile_picture = $profile_picture;   
                } 

                if ($final_profile_picture == "") {
                    if ($patientData[0]['gender'] == "male") {
                        $final_profile_picture = $hff_media_profile_image_default_path_read . "user-male.png";
                    } else if ($patientData[0]['gender'] == "female") {
                        $final_profile_picture = $hff_media_profile_image_default_path_read . "user-female.png";
                    }
                }
                
                $patientData[0]['profilePicture'] = $final_profile_picture;
            }           
            
        }
        return $patientData;
    }
public function prescriptionRequest($inputData) {
        require_once (APPPATH . 'handlers/Medicalvisit_handler.php');
        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        require_once (APPPATH . 'handlers/Userdevices_handler.php');
        require_once (APPPATH . 'handlers/Survey_handler.php');
        require_once (APPPATH . 'handlers/Messagetemplate_handler.php');

        $this->deviceHandler = new Userdevices_handler();
        $this->bcpassignment = new Bcpassignment_handler();
        $this->Messagetemplate_handler = new Messagetemplate_handler();
        $this->User_handler = new User_handler();
        $this->Medicalvisit_handler = new Medicalvisit_handler();
        $this->PatientHandler = new Patient_handler();
        $this->SurveyHandler = new Survey_handler();

        $bcpUserId = $this->ci->session->userid;

        //print_r($inputData); exit;         
        $medicalIncidentId = $inputData["medicalIncidentId"];
        $medicalIncidentVisitId = $inputData["medicalIncidentVisitId"];
        $questionId = $inputData["questionId"];
        $optionId = $inputData["optionId"];
        $bcpId = $inputData["bcpId"];

        $incident_detail_id = $this->getIndicentDetailByQuestionId($questionId, $medicalIncidentId);
//        debugArray($questionId);
//        debugArray($medicalIncidentId); exit;
        
        if (isset($incident_detail_id['response']['incidentDetail']) && !empty($incident_detail_id['response']['incidentDetail'])) {
            $survey_id = $incident_detail_id['response']['survey_id'];
            $incident_detail_id = $incident_detail_id['response']['incidentDetail'][0]['id'];
        }else{
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_PRESCRIPTION_NO_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $inputData['incident_details_id'] = $incident_detail_id;
        $inputData['survey_id'] = $survey_id;
        


        if (!empty($inputData)) {
//            $this->ci->Prescriptionrequests_model->insertUpdateArray['prescription_code'] = $prescriptionData['prescriptionCode'];
            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->medicalIncidentId] = $inputData["medicalIncidentId"];
            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->medicalVisitId] = $inputData["medicalIncidentVisitId"];
            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->questionId] = $inputData["questionId"];
            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->optionId] = $inputData["optionId"];
            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->bcpId] = $inputData["bcpId"];
            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->medicalIncidentDetailId] = $inputData["incident_details_id"];



            $ack = $this->ci->Prescriptionrequests_model->insert_data($this->ci->Medicalincident_model->dbTable, $this->ci->Medicalincident_model->insertUpdateArray);

            $doctors_list = $this->bcpassignment->getBcpAssignedDoctors($bcpUserId);
            $doctor_ids = array();
            $doctor_profile_info    =   array();
            if (isset($doctors_list['response']['doctorsList']) && $doctors_list['response']['doctorsList'] >= 0) {
                foreach ($doctors_list['response']['doctorsList'] as $doctor) {
                    if (!in_array($doctor['doctor_id'], $doctor_ids)) {
                        array_push($doctor_ids, $doctor['doctor_id']);
                    }
                }
                $active_doctors_list = $this->User_handler->getDoctorIds($doctor_ids);
                $doctor_profile_info = null;
                if (!empty($active_doctors_list)) {
                    $devices_info = $this->deviceHandler->getDevicesInfoByUser($active_doctors_list);
                    if (!empty($active_doctors_list)) {
                        foreach ($active_doctors_list as $key => $user) {
                           // $active_doctors_list[$key] = $user['id'];
                        }
                        
                        $doctor_profile_info = $this->User_handler->getDoctorProfile($active_doctors_list);
                        
                    }
                }
            }

            
            if ($ack > 0) {
                $visit_details = $this->Medicalvisit_handler->getVisitDetailsById($inputData['medicalIncidentVisitId']);
                $survery_name = $this->SurveyHandler->getSurveyNameById($inputData['survey_id']);
                
                if(isset($visit_details['response']['visit_data']) && !empty($visit_details['response']['visit_data'])){
                    
                    $patient_id = $visit_details['response']['visit_data'][0]['patient_id'];
                    $bcp_id = $inputData['bcpId'];

                    $patient_details = null;
                    if (!empty($patient_id)) {
                        $patient_details = $this->PatientHandler->getPatientDetails($patient_id);
                        
                        if (isset($patient_details['response']['patientData']) && !empty($patient_details['response']['patientData'])) {
                            $patient_details = $patient_details['response']['patientData'][0];
                        }
                    }
                    $bcp_data = null;
                    if (!empty($bcp_id)) {
                        $bcp_details = $this->User_handler->getUserProfile($bcpId);
                        if (isset($bcp_details['response']['userData']) && !empty($bcp_details['response']['userData'])) {
                            $bcp_data = $bcp_details['response']['userData'][0];
                        }
                    }
                    if (isset($survery_name['response']['survey']) && !empty($survery_name['response']['survey'])) {
                        $survery_name = $survery_name['response']['survey'][0]['name'];
                    }
                    
    //                echo 'here'; exit;
    
                    $transmit_info = array(
                        'bcp_name' => $bcp_data['firstName'] . ' ' . $bcp_data['lastName'],
                        'patient_name' => $patient_details['firstName'] . ' ' . $patient_details['middleName'] . ' ' . $patient_details['lastName'],
                        'age' => date_diff(date_create($patient_details['dateofBirth']), date_create('now'))->y,
                        'mr_number' => $patient_details['medicalRegistrationNumber'],
                        'survey_name' => $survery_name
                    );
                    
                    if (!empty($doctor_profile_info)) {
                        $fullInputData = array();

                        foreach ($doctor_profile_info as $key => $doctor) {
                            $doctor_profile_info[$key]['message_data'] = $transmit_info;
                            if(($doctor['id'] == 59)){
                                $doctor_profile_info[$key]['mobile'] = checkMobileCountryCode($doctor_profile_info[$key]['mobile'], $doctor_profile_info[$key]['countryid']);
                                
                                $data = $this->Messagetemplate_handler->sendMessageWithTemplate($doctor_profile_info[$key], $languageId = '1', $type = "prescriptionrequest", $mode = "sms", $toEmail = '', $doctor_profile_info[$key]['mobile']);
                            }
                        }
                    }

                    if (isset($devices_info['response']['devices_info']) && !empty($devices_info['response']['devices_info'])) {
                        $fullInputData = array();
                        $devices_info = $devices_info['response']['devices_info'];
                        foreach ($devices_info as $key => $device) {
                            $devices_info[$key]['message_data'] = $transmit_info;
                            if(!empty($device['awsarncode'])){
//                                $data = $this->Messagetemplate_handler->sendNotificationWithTemplate($devices_info[$key]['message_data'], $languageId = "1", $type = 'prescriptionrequest', $mode = 'notification', $devices_info[$key]);
                            }
                        }
                    }
                    
                    $output['status'] = TRUE;
                    ///$output["response"]["messages"][] = SUCCESS_PRESCRIPTION_REQUEST;
                    $output['response']['messages'][] = $this->ci->lang->line('success_prescription_request_data_save_message');
                    $output['response']['presc_id'] = $ack;
                    $output['statusCode'] = STATUS_OK;
                    
                    return $output;
                }
            }
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_PRESCRIPTION_NO_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_prescription_data_empty_message');
            $output['statusCode'] = STATUS_BAD_REQUEST;
            return $output;
        }
    }

    public function prescriptionSMSRequest($inputData) {
        require_once (APPPATH . 'handlers/Medicalvisit_handler.php');
        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        require_once (APPPATH . 'handlers/Userdevices_handler.php');
        require_once (APPPATH . 'handlers/Survey_handler.php');
        require_once (APPPATH . 'handlers/Messagetemplate_handler.php');

        $this->deviceHandler = new Userdevices_handler();
        $this->bcpassignment = new Bcpassignment_handler();
        $this->ci->Messagetemplate_handler = new Messagetemplate_handler();
        $this->ci->User_handler = new User_handler();
        $this->Medicalvisit_handler = new Medicalvisit_handler();
        $this->PatientHandler = new Patient_handler();
        $this->SurveyHandler = new Survey_handler();

       

        //print_r($inputData); exit;         
        $medicalIncidentId = $inputData["medicalIncidentId"];
        $medicalIncidentVisitId = $inputData["medicalIncidentVisitId"];
        $questionId = $inputData["questionId"];
        $optionId = $inputData["optionId"];
        $bcpId = $inputData["bcpId"];
		$patientId = $inputData["patientId"];
		$requestDate = $inputData["requestDate"];
		$bcpUserId = $bcpId;
/*
        $incident_detail_id = $this->getIndicentDetailByQuestionId($questionId, $medicalIncidentId);
//        debugArray($questionId);
//        debugArray($medicalIncidentId); exit;
        
        if (isset($incident_detail_id['response']['incidentDetail']) && !empty($incident_detail_id['response']['incidentDetail'])) {
            $survey_id = $incident_detail_id['response']['survey_id'];
            $incident_detail_id = $incident_detail_id['response']['incidentDetail'][0]['id'];
        }else{
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_PRESCRIPTION_NO_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $inputData['incident_details_id'] = $incident_detail_id;
        $inputData['survey_id'] = $survey_id;
        */


        if (!empty($inputData)) {
//            $this->ci->Prescriptionrequests_model->insertUpdateArray['prescription_code'] = $prescriptionData['prescriptionCode'];
            //$this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->medicalIncidentId] = $inputData["medicalIncidentId"];
            //$this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->medicalVisitId] = $inputData["medicalIncidentVisitId"];
            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->questionId] = $inputData["questionId"];
            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->optionId] = $inputData["optionId"];
            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->bcpId] = $inputData["bcpId"];
			$this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->requestDate] = $inputData["requestDate"];
			$this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->patientId] = $inputData["patientId"];
			$this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->createdby] = $inputData["bcpId"];
			$this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->modifiedby] = $inputData["bcpId"];
            //$this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->medicalIncidentDetailId] = $inputData["incident_details_id"];



            $ack = $this->ci->Prescriptionrequests_model->insert_data($this->ci->Medicalincident_model->dbTable, $this->ci->Medicalincident_model->insertUpdateArray);

            $doctors_list = $this->bcpassignment->getBcpAssignedDoctors($bcpUserId);
			$doctor_ids = array();
            $doctor_profile_info    =   array();
            if (isset($doctors_list['response']['doctorsList']) && $doctors_list['response']['doctorsList'] >= 0) {
                foreach ($doctors_list['response']['doctorsList'] as $doctor) {
                    if (!in_array($doctor['doctor_id'], $doctor_ids)) {
                        array_push($doctor_ids, $doctor['doctor_id']);
                    }
                }
			    $active_doctors_list = $this->ci->User_handler->getDoctorIds($doctor_ids);
                $doctor_profile_info = null;
			    if (!empty($active_doctors_list)) {
                   // $devices_info = $this->deviceHandler->getDevicesInfoByUser($active_doctors_list);
                    if (!empty($active_doctors_list)) {
                        foreach ($active_doctors_list as $key => $user) {
                            $active_doctors_list[$key] = $user['id'];
                        }
                        $doctor_profile_info = $this->ci->User_handler->getDoctorProfile($active_doctors_list);
                        
                    }
                }
            }

            if ($ack > 0) {
               
			    

                    $transmit_info = array(
                        'bcp_name' => $inputData['bcpName'],
                        'patient_name' => $inputData['patientName'] ,
                        'age' => "35",
                        'mr_number' => $inputData['mrNumber'],
                        'survey_name' => ""
                    );
					//'age' => date_diff(date_create($patient_details['dateofBirth']), date_create('now'))->y,
                    if (!empty($doctor_profile_info)) {
                        $fullInputData = array();

                        foreach ($doctor_profile_info as $key => $doctor) {
                            $doctor_profile_info[$key]['message_data'] = $transmit_info;
                            
                                $doctor_profile_info[$key]['mobile'] = checkMobileCountryCode($doctor_profile_info[$key]['mobile'], $doctor_profile_info[$key]['countryid']);
                                
                            $data = $this->ci->Messagetemplate_handler->sendMessageWithTemplate($doctor_profile_info[$key], '1', "prescriptionrequest", "sms", '', $doctor_profile_info[$key]['mobile']);
                            
                        }
                    }

                    
                    
                    $output['status'] = TRUE;
                    ///$output["response"]["messages"][] = SUCCESS_PRESCRIPTION_REQUEST;
                    $output['response']['messages'][] = $this->ci->lang->line('success_prescription_request_data_save_message');
                    $output['response']['presc_id'] = $ack;
                    $output['statusCode'] = STATUS_OK;
                    
                    return $output;
                
            }
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_PRESCRIPTION_NO_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_prescription_data_empty_message');
            $output['statusCode'] = STATUS_BAD_REQUEST;
            return $output;
        }
    }

    public function getIndicentDetailByQuestionId($question_id, $incident_id) {
        require_once (APPPATH . 'handlers/Survey_questionnaire_handler.php');
        $this->questionHandler = new Survey_questionnaire_handler();

        $survey_id_details = $this->questionHandler->getSurveyIdByQuestion($question_id);
        
        if (isset($survey_id_details['response']['question_ids']) && !empty($survey_id_details['response']['question_ids'])) {

            $this->ci->Medicalincidentdetail_model->resetVariable();
            $selectInput = array();
            $medicalIncidentDetailData = array();
            $where = array();
            $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
            $where[$this->ci->Medicalincidentdetail_model->deleted] = 0;
            $where[$this->ci->Medicalincidentdetail_model->status] = 1;
            $where[$this->ci->Medicalincidentdetail_model->surveyId] = $survey_id_details['response']['question_ids'][0]['survey_id'];
            $where[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $incident_id;
            $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
            $this->ci->Medicalincidentdetail_model->setWhere($where);

            $medicalIncidentDetailData = $this->ci->Medicalincidentdetail_model->get();
//            debugArray($medicalIncidentDetailData); exit;
            
            if (count($medicalIncidentDetailData) == 0) {
                $output['status'] = FALSE;
                ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
                $output['response']['messages'][] = $this->ci->lang->line('error_visit_details_mismatch_message');
                $output['response']['total'] = 0;
                $output['statusCode'] = STATUS_NO_DATA;
                return $output;
            } else {
                $output['status'] = TRUE;

                $output['response']['incidentDetail'] = $medicalIncidentDetailData;
                $output['response']['survey_id'] = $survey_id_details['response']['question_ids'][0]['survey_id'];
                $output['response']['total'] = 0;
                $output['statusCode'] = STATUS_NO_DATA;
                return $output;
            }
            return $output;
        }
    }

    public function getMedicalIncidentIdsByCode($medicalIncidentCode) {
        $selectInput = array();
        $medicalIncidentData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincident_model->id;
        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;
        $where[$this->ci->Medicalincident_model->medicalIncidentCode] = $medicalIncidentCode;
        $this->ci->Medicalincident_model->setSelect($selectInput);
        $this->ci->Medicalincident_model->setWhere($where);
        $medicalIncidentData = $this->ci->Medicalincident_model->get();
        if (count($medicalIncidentData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $medicalIncidentId = $medicalIncidentData[0]['id'];

        $selectInput = array();
        $medicalIncidentDetailData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $where[$this->ci->Medicalincidentdetail_model->deleted] = 0;
        $where[$this->ci->Medicalincidentdetail_model->status] = 1;
        $where[$this->ci->Medicalincidentdetail_model->medicalIncidentId] = $medicalIncidentId;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $medicalIncidentDetailData = $this->ci->Medicalincidentdetail_model->get();
        if (count($medicalIncidentDetailData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $output['status'] = TRUE;
        $output['response']['medicalIncidentDetail'] = $medicalIncidentDetailData;
        $outout['response']['total'] = count($medicalIncidentDetailData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getSurveyIdByParentId($surveyId) {
        $this->ci->Survey_model->resetVariable();
        $selectInput = array();
        $surveyData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Survey_model->id;
        $selectInput['name'] = $this->ci->Survey_model->name;
        $this->ci->Survey_model->setSelect($selectInput);
        $where[$this->ci->Survey_model->deleted] = 0;
        $where[$this->ci->Survey_model->status] = 1;
        $where[$this->ci->Survey_model->parentId] = $surveyId;
        $this->ci->Survey_model->setWhere($where);
        $surveyData = $this->ci->Survey_model->get();
        if (count($surveyData) == 0) {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_survey_not_found');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $output['status'] = TRUE;
        $output['response']['surveyData'] = $surveyData;
        $outout['response']['total'] = count($surveyData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function quickPatientRegistration($inputData) {

        //print_r($inputData); exit;                
                        
        $searchIPData = array(
            'firstName' => strip_tags($inputData['firstName']),
            'gender' => strip_tags($inputData['gender']),
            'villageName' => strip_tags($inputData['villageName']),
            'emergencyContactNumber' => strip_tags($inputData['emergencyContactNumber']),
            "registrationDate" => $inputData['registrationDate'],  
            "bcpUserId" => $inputData['bcp_user_id']  
        );
        $this->patientHandler = new Patient_handler();
        $searchData = $this->patientHandler->patientSearch($searchIPData);          
        $medical_registration_code = "";
        if(isset($searchData['status']) && $searchData['status'] == 1){
            if(isset($searchData['response']['total']) && $searchData['response']['total'] > 0){
                $medical_registration_code = $searchData['response']['patientData'][0]['medicalRegistrationNumber'];
            }
        }
        //print_r($searchData);      
        //exit;
        
        if($medical_registration_code == ""){
            
            /*
            $this->ci->Patient_model->resetVariable();
            $selectInput = array();
            $selectInput['id'] = $this->ci->Patient_model->id;
            $this->ci->Patient_model->setSelect($selectInput);
            $where[$this->ci->Patient_model->bcpUserId] = $inputData["bcp_user_id"];
            $this->ci->Patient_model->setWhere($where);
            $patientCount = $this->ci->Patient_model->getCount();
            $patientCount = $patientCount + 1;

            $medicalRegistrationCode = getMedicalRegistrationCode();
            $medical_registration_code = $medicalRegistrationCode . MEDICAL_RECORD_STRING . $patientCount;
            
            $gender = strip_tags($inputData["gender"]);
            if($gender == "male"){
                $title = "mr";
            }else{
                $title = "miss"; 
            }
            $this->ci->Patient_model->startTransaction();
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->medicalRegistrationNumber] = $medical_registration_code;
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->firstName] = strip_tags($inputData["firstName"]);
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactName] = strip_tags($inputData["emergencyContactName"]);
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactNumber] = $inputData["emergencyContactNumber"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->registrationDate] = $inputData["registrationDate"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->villageName] = strip_tags($inputData["villageName"]);
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->gender] = $gender;
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->title] = $title;
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->bcpUserId] = $inputData["bcp_user_id"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->createdby] = $inputData["bcp_user_id"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->modifiedby] = $inputData["bcp_user_id"];
            $patientId = $this->ci->Patient_model->insert_data($this->ci->Patient_model->dbTable, $this->ci->Patient_model->insertUpdateArray);
            */
            
            $keyValueArray = array("bcpUserId" => $inputData["bcp_user_id"]);
            $patientCount = $this->patientHandler->getPatientCount($keyValueArray);
            $patientCount = $patientCount + 1;
            
            $medicalRegistrationCode = getMedicalRegistrationCode();
            $medical_registration_code = $medicalRegistrationCode . MEDICAL_RECORD_STRING . $patientCount;
            $inputData["medical_registration_code"] = $medical_registration_code;
            $patientId = $this->patientHandler->quickPatientRegistration($inputData); 
        }
                        
        if ($medical_registration_code != '') {
            
            $type = $inputData["type"];
            $surveyId = $inputData["surveyId"];
            $questions = $inputData["questions"];
            $hospitalId = $inputData["hospitalId"];
            $questionId = $inputData["questionId"];
            $optionId = $inputData["optionId"];
            
            $mediacalIncidentData = array(
                "medicalRegistrationNumber" => $medical_registration_code,
                "registrationDate" => $inputData["registrationDate"],
                "bcp_user_id" => $inputData["bcp_user_id"],
                "surveyId" => $inputData["surveyId"],
                "questions" => $questions,
                "hospitalId" => $hospitalId,
                "type" => $type,
                "questionId" => $questionId,
                "optionId" => $optionId,
            );

            return $response = $this->createMedicalIncident($mediacalIncidentData);
            
            /*
            if ($this->ci->Patient_model->transactionStatusCheck() === FALSE) {
                $this->ci->Patient_model->rollBackLastTransaction();

                $output['status'] = FALSE;
                ///$output["response"]["messages"][] = ERROR_SOMETHING_WENT_WRONG;
                $output['response']['messages'][] = $this->ci->lang->line('error_something_went_wrong_message');
                $output['statusCode'] = STATUS_SERVER_ERROR;
                return $output;
            } else {
                $this->ci->Patient_model->commitLastTransaction();
                return $response;
            }
            */
        }
        else{
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->ci->lang->line('error_something_went_wrong_message');
            $output['statusCode'] = STATUS_SERVER_ERROR;
            return $output;
        }
    }

    public function sendPatientVisitReminder() {
        require_once (APPPATH . 'handlers/Medicalvisit_handler.php');
        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        require_once (APPPATH . 'handlers/Userdevices_handler.php');
        require_once (APPPATH . 'handlers/Survey_handler.php');

        $this->deviceHandler = new Userdevices_handler();
        $this->Messagetemplate_handler = new Messagetemplate_handler();
        $this->User_handler = new User_handler();
        $this->Medicalvisit_handler = new Medicalvisit_handler();
        $this->PatientHandler = new Patient_handler();
        $this->SurveyHandler = new Survey_handler();

        $today = date('Y-m-d');

        $selectInput = array();
        $patientVisitRemindersData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Patientvisitreminders_model->id;
        $selectInput['medicalIncidentVisitId'] = $this->ci->Patientvisitreminders_model->medicalIncidentVisitId;
        $selectInput['medicalIncidentDetailId'] = $this->ci->Patientvisitreminders_model->medicalIncidentDetailId;
        $selectInput['surveyQuestionId'] = $this->ci->Patientvisitreminders_model->surveyQuestionId;
        $selectInput['surveyQuestionOptionId'] = $this->ci->Patientvisitreminders_model->surveyQuestionOptionId;
        $selectInput['visitDate'] = $this->ci->Patientvisitreminders_model->visitDate;
        $selectInput['expiryDate'] = $this->ci->Patientvisitreminders_model->expiryDate;
        $selectInput['bcpUserId'] = $this->ci->Patientvisitreminders_model->bcpUserId;
        $where[$this->ci->Patientvisitreminders_model->deleted] = 0;
        $where[$this->ci->Patientvisitreminders_model->status] = 1;
        $where[$this->ci->Patientvisitreminders_model->expiryDate] = $today;
        $order[] = " id DESC";
        $this->ci->Patientvisitreminders_model->setSelect($selectInput);
        $this->ci->Patientvisitreminders_model->setWhere($where);
        $this->ci->Patientvisitreminders_model->setOrderBy($order);
        $patientVisitRemindersData = $this->ci->Patientvisitreminders_model->get();

        if (count($patientVisitRemindersData) == 0) {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_reminders_not_found_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        //print_r($medicalIncidentData);
        //$medicalIncidentVisitData = commonHelperGetIdArray($medicalIncidentData, 'medicalIncidentVisitId');
        //$medicalIncidentVisitIdsArray = array_keys($medicalIncidentVisitData);
        //print_r($medicalIncidentVisitIdsArray); exit;

        foreach ($patientVisitRemindersData as $key => $val) {
            $medicalIncidentVisitId = $val["medicalIncidentVisitId"];
            $medicalIncidentDetailId = $val["medicalIncidentDetailId"];
            $surveyQuestionId = $val["surveyQuestionId"];
            $surveyQuestionOptionId = $val["surveyQuestionOptionId"];
            $bcpUserId = $val["bcpUserId"];

            if ($medicalIncidentVisitId != "") {

                $selectInput = array();
                $medicalIncidentVisitData = array();
                $where = array();
                $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
                $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
                $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentvisit_model->medicalIncidentId;
                $selectInput['type'] = $this->ci->Medicalincidentvisit_model->type;
                $selectInput['patientId'] = $this->ci->Medicalincidentvisit_model->patientId;
                $selectInput['bcpUserId'] = $this->ci->Medicalincidentvisit_model->bcpUserId;
                $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
                $where[$this->ci->Medicalincidentvisit_model->status] = 1;
                $where[$this->ci->Medicalincidentvisit_model->id] = $medicalIncidentVisitId;
                $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
                $this->ci->Medicalincidentvisit_model->setWhere($where);
                $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();
                //print_r($medicalIncidentVisitData);

                if (count($medicalIncidentVisitData) == 0) {
                    $output['status'] = FALSE;
                    $output['response']['messages'][] = $this->ci->lang->line('error_reminders_not_found_message');
                    $output['statusCode'] = STATUS_NO_DATA;
                    return $output;
                }

                $medicalIncidentVisitId = $medicalIncidentVisitData[0]['id'];
                $medicalIncidentVisitCode = $medicalIncidentVisitData[0]['medicalIncidentVisitCode'];
                $medicalIncidentId = $medicalIncidentVisitData[0]['medicalIncidentId'];
                $type = $medicalIncidentVisitData[0]['type'];
                $patientId = $medicalIncidentVisitData[0]['patientId'];
                $bcpUserId = $medicalIncidentVisitData[0]['bcpUserId'];

                $incidentDetail = $this->getIndicentDetailById($medicalIncidentDetailId);
                $surveyId = $incidentDetail[0]['surveyId'];
                $survery = $this->SurveyHandler->getSurveyNameById($surveyId);
                $surveryName = "";
                if (isset($survery['response']['survey']) && !empty($survery['response']['survey'])) {
                    $surveryName = $survery['response']['survey'][0]['name'];
                }
                $userData['user']['id'] = $bcpUserId;
                $devices_info = $this->deviceHandler->getDevicesInfoByUser($userData);
                //print_r($devices_info);
                //exit;
                $patient_details = null;
                if (!empty($patientId)) {
                    $patient_details = $this->PatientHandler->getPatientDetails($patientId);
                    if (isset($patient_details['response']['patientData']) && !empty($patient_details['response']['patientData'])) {
                        $patient_details = $patient_details['response']['patientData'][0];
                    }
                }
                /*
                  $bcp_details = null;
                  if (!empty($bcpUserId)) {
                  $bcp_details = $this->User_handler->getUserProfile($bcpUserId);
                  if (isset($bcp_details['response']['userData']) && !empty($bcp_details['response']['userData'])) {
                  $bcp_details = $bcp_details['response']['userData'][0];
                  }
                  }
                 */
                $transmit_info = array(
                    //'bcp_name' => $bcp_details['firstName'] . ' ' . $bcp_details['lastName'],
                    'patient_name' => $patient_details['firstName'] . ' ' . $patient_details['middleName'] . ' ' . $patient_details['lastName'],
                    //'age' => date_diff(date_create($patient_details['dateofBirth']), date_create('now'))->y,
                    'mr_number' => $patient_details['medicalRegistrationNumber'],
                    'mvisit_code' => $medicalIncidentVisitCode,
                    'survey_name' => $surveryName
                );


                if (isset($devices_info['response']['devices_info']) && !empty($devices_info['response']['devices_info'])) {
                    $fullInputData = array();
                    $devices_info = $devices_info['response']['devices_info'];
                    foreach ($devices_info as $key => $device) {
                        $devices_info[$key]['message_data'] = $transmit_info;
                        $data = $this->Messagetemplate_handler->sendNotificationWithTemplate($devices_info[$key]['message_data'], $languageId = "1", $type = 'visitreminder', $mode = 'notification', $devices_info[$key]);
                    }
                }
            }
        }


        $output['status'] = TRUE;
        $output['response']['messages'][] = $this->ci->lang->line('success_prescription_request_data_save_message');
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getPatientVisitReminders($bcpUserId = "") {
        require_once (APPPATH . 'handlers/Medicalvisit_handler.php');
        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        require_once (APPPATH . 'handlers/Userdevices_handler.php');
        require_once (APPPATH . 'handlers/Survey_handler.php');
        require_once (APPPATH . 'handlers/Messagetemplate_handler.php');

        $this->deviceHandler = new Userdevices_handler();
        $this->Messagetemplate_handler = new Messagetemplate_handler();
        $this->User_handler = new User_handler();
        $this->Medicalvisit_handler = new Medicalvisit_handler();
        $this->PatientHandler = new Patient_handler();
        $this->SurveyHandler = new Survey_handler();

        $today = date('Y-m-d');

        $selectInput = array();
        $patientVisitRemindersData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Patientvisitreminders_model->id;
        $selectInput['medicalIncidentVisitId'] = $this->ci->Patientvisitreminders_model->medicalIncidentVisitId;
        $selectInput['medicalIncidentDetailId'] = $this->ci->Patientvisitreminders_model->medicalIncidentDetailId;
        $selectInput['surveyQuestionId'] = $this->ci->Patientvisitreminders_model->surveyQuestionId;
        $selectInput['surveyQuestionOptionId'] = $this->ci->Patientvisitreminders_model->surveyQuestionOptionId;
        $selectInput['visitDate'] = $this->ci->Patientvisitreminders_model->visitDate;
        $selectInput['expiryDate'] = $this->ci->Patientvisitreminders_model->expiryDate;
        $selectInput['bcpUserId'] = $this->ci->Patientvisitreminders_model->bcpUserId;
        $where[$this->ci->Patientvisitreminders_model->deleted] = 0;
        $where[$this->ci->Patientvisitreminders_model->status] = 1;
        $where[$this->ci->Patientvisitreminders_model->expiryDate] = $today;
        $where[$this->ci->Patientvisitreminders_model->bcpUserId] = $bcpUserId;
        $order[] = " id DESC";
        $this->ci->Patientvisitreminders_model->setSelect($selectInput);
        $this->ci->Patientvisitreminders_model->setWhere($where);
        $this->ci->Patientvisitreminders_model->setOrderBy($order);
        $patientVisitRemindersData = $this->ci->Patientvisitreminders_model->get();
        ///print_r($patientVisitRemindersData);  exit;

        if (count($patientVisitRemindersData) == 0) {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_reminders_not_found_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        //print_r($medicalIncidentData);
        //$medicalIncidentVisitData = commonHelperGetIdArray($medicalIncidentData, 'medicalIncidentVisitId');
        //$medicalIncidentVisitIdsArray = array_keys($medicalIncidentVisitData);
        //print_r($medicalIncidentVisitIdsArray); exit;
        $allPatientsVisitReminders = array();
        foreach ($patientVisitRemindersData as $key => $val) {
            $medicalIncidentVisitId = $val["medicalIncidentVisitId"];
            $medicalIncidentDetailId = $val["medicalIncidentDetailId"];
            $surveyQuestionId = $val["surveyQuestionId"];
            $surveyQuestionOptionId = $val["surveyQuestionOptionId"];
            $visitDate = $val["visitDate"];
            $expiryDate = $val["expiryDate"];
            $bcpUserId = $val["bcpUserId"];

            if ($medicalIncidentVisitId != "") {

                $selectInput = array();
                $medicalIncidentVisitData = array();
                $where = array();
                $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
                $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
                $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentvisit_model->medicalIncidentId;
                $selectInput['type'] = $this->ci->Medicalincidentvisit_model->type;
                $selectInput['patientId'] = $this->ci->Medicalincidentvisit_model->patientId;
                $selectInput['bcpUserId'] = $this->ci->Medicalincidentvisit_model->bcpUserId;
                $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
                $where[$this->ci->Medicalincidentvisit_model->status] = 1;
                $where[$this->ci->Medicalincidentvisit_model->id] = $medicalIncidentVisitId;
                $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
                $this->ci->Medicalincidentvisit_model->setWhere($where);
                $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();
                //print_r($medicalIncidentVisitData);

                if (count($medicalIncidentVisitData) == 0) {
                    $output['status'] = FALSE;
                    $output['response']['messages'][] = $this->ci->lang->line('error_reminders_not_found_message');
                    $output['statusCode'] = STATUS_NO_DATA;
                    return $output;
                }

                $medicalIncidentVisitId = $medicalIncidentVisitData[0]['id'];
                $medicalIncidentVisitCode = $medicalIncidentVisitData[0]['medicalIncidentVisitCode'];
                $medicalIncidentId = $medicalIncidentVisitData[0]['medicalIncidentId'];
                $type = $medicalIncidentVisitData[0]['type'];
                $patientId = $medicalIncidentVisitData[0]['patientId'];
                $bcpUserId = $medicalIncidentVisitData[0]['bcpUserId'];

                $incidentDetail = $this->getIndicentDetailById($medicalIncidentDetailId);
                $surveyId = $incidentDetail[0]['surveyId'];
                $survery = $this->SurveyHandler->getSurveyNameById($surveyId);
                $surveryName = "";
                if (isset($survery['response']['survey']) && !empty($survery['response']['survey'])) {
                    $surveryName = $survery['response']['survey'][0]['name'];
                }
                $userData['user']['id'] = $bcpUserId;
                $devices_info = $this->deviceHandler->getDevicesInfoByUser($userData);
                //print_r($devices_info);
                //exit;
                $patient_details = null;
                if (!empty($patientId)) {
                    $patient_details = $this->PatientHandler->getPatientDetails($patientId);
                    if (isset($patient_details['response']['patientData']) && !empty($patient_details['response']['patientData'])) {
                        $patient_details = $patient_details['response']['patientData'][0];
                    }
                }
                $patientName = "";
                if (isset($patient_details['firstName']) && $patient_details['firstName'] != "") {
                    $patientName .= $patient_details['firstName'] . " ";
                }
                if (isset($patient_details['middleName']) && $patient_details['middleName'] != "") {
                    $patientName .= $patient_details['middleName'] . " ";
                }
                if (isset($patient_details['lastName']) && $patient_details['lastName'] != "") {
                    $patientName .= $patient_details['lastName'];
                }
                $reminderData = array(
                    'patientName' => $patientName,
                    'medicalRegistrationCode' => $patient_details['medicalRegistrationNumber'],
                    'medicalIncidentVisitCode' => $medicalIncidentVisitCode,
                    'chiefComplaint' => $surveryName,
                    'visitDate' => $visitDate,
                    'expiryDate' => $expiryDate,
                );
                $allPatientsVisitReminders[] = $reminderData;
            }
        }


        $output['status'] = TRUE;
        $output['response']['data']['visitReminders'] = $allPatientsVisitReminders;
        $outout['response']['total'] = count($allPatientsVisitReminders);
        //$output['response']['messages'][] = $this->ci->lang->line('success_visit_reminder_message');
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getIndicentDetailById($medicalIncidentDetailId = "") {

        $this->ci->Medicalincidentdetail_model->resetVariable();
        $selectInput = array();
        $medicalIncidentDetailData = array();
        $where = array();
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentdetail_model->medicalIncidentId;
        $selectInput['surveyId'] = $this->ci->Medicalincidentdetail_model->surveyId;
        $where[$this->ci->Medicalincidentdetail_model->deleted] = 0;
        $where[$this->ci->Medicalincidentdetail_model->status] = 1;
        $where[$this->ci->Medicalincidentdetail_model->id] = $medicalIncidentDetailId;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $medicalIncidentDetailData = $this->ci->Medicalincidentdetail_model->get();
        return $medicalIncidentDetailData;
    }

}
