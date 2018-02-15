<?php

/**
  primary Assessment Handler Survey entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created     20-04-2017
 * @Last Modified 01-05-2017
 * @Last Modified By Sridevi Gara
 */
require_once(APPPATH . 'handlers/handler.php');

class Primary_assessment_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Survey_model');
        $this->ci->load->model('Survey_questionnaire_model');
        $this->ci->load->model('Survey_questionnaire_option_model');
        $this->ci->load->model('Survey_questionnaire_condition_value_model');
        $this->ci->load->model('Survey_taxonomy_model');
        $this->ci->load->model('Taxonomy_model');
        $this->ci->load->model('Survey_chief_complaint_mapping_model');
                
        $this->ci->load->model('Taxonomy_language_model');
        $this->ci->load->model('Survey_language_model');
        $this->ci->load->model('Survey_questionnaire_language_model');
        $this->ci->load->model('Survey_questionnaire_option_language_model');
        
    }
    
    public function getUserLangBasedTaxonomy($taxonomyId = "", $languageId = ""){
        
        $this->ci->Taxonomy_language_model->resetVariable();
        $selectInput = array();        
        $where = array();
        $taxonomyData = array();
        
        $selectInput['name'] = $this->ci->Taxonomy_language_model->name;      
        $this->ci->Taxonomy_language_model->setSelect($selectInput);
        
        $where[$this->ci->Taxonomy_language_model->taxonomyId] = $taxonomyId;
        $where[$this->ci->Taxonomy_language_model->languageId] = $languageId;        
        $this->ci->Taxonomy_language_model->setWhere($where);
        $this->ci->Taxonomy_language_model->setRecords(1);
        $taxonomyData = $this->ci->Taxonomy_language_model->get();
        if (count($taxonomyData) > 0) { 
            return $taxonomyData[0]['name'];
        }
        //print_r($taxonomyData); exit;
        
    }
    public function getUserLangBasedSurvey($surveyId = "", $languageId = ""){
              
        $this->ci->Survey_language_model->resetVariable();
        $selectInput = array();        
        $where = array();
        $surveyData = array();
        
        $selectInput['name'] = $this->ci->Survey_language_model->name;      
        $this->ci->Survey_language_model->setSelect($selectInput);
       
        $where[$this->ci->Survey_language_model->surveyId] = $surveyId;
        $where[$this->ci->Survey_language_model->languageId] = $languageId; 
        
        $this->ci->Survey_language_model->setWhere($where);
        $this->ci->Survey_language_model->setRecords(1);
        $surveyData = $this->ci->Survey_language_model->get();
        if (count($surveyData) > 0) { 
            return $surveyData[0]['name'];
        }
        //print_r($surveyData); exit;
    }
    public function getUserLangBasedSurveyQuestion($questionId = "", $languageId = ""){
                
        $this->ci->Survey_questionnaire_language_model->resetVariable();
        $selectInput = array();
        $where = array();
        $qtnData = array();
        
        $selectInput['title'] = $this->ci->Survey_questionnaire_language_model->title;      
        $this->ci->Survey_questionnaire_language_model->setSelect($selectInput);
        
        $where[$this->ci->Survey_questionnaire_language_model->surveyQuestionId] = $questionId;
        $where[$this->ci->Survey_questionnaire_language_model->languageId] = $languageId;        
        $this->ci->Survey_questionnaire_language_model->setWhere($where);
        $this->ci->Survey_questionnaire_language_model->setRecords(1);
        $qtnData = $this->ci->Survey_questionnaire_language_model->get();
        if (count($qtnData) > 0) { 
            return $qtnData[0]['title'];
        }
        ///print_r($surveyQuestionnaireData); exit;
    }    
    public function getUserLangBasedSurveyQuestionOption($optionId = "", $languageId = ""){
                
        $this->ci->Survey_questionnaire_option_language_model->resetVariable();
        $selectInput = array();
        $where = array();
        $optionData = array();
        
        $selectInput['label'] = $this->ci->Survey_questionnaire_option_language_model->label;      
        $selectInput['suffixLabel'] = $this->ci->Survey_questionnaire_option_language_model->suffixLabel;      
        $this->ci->Survey_questionnaire_option_language_model->setSelect($selectInput);
        
        $where[$this->ci->Survey_questionnaire_option_language_model->surveyQuestionOptionId] = $optionId;
        $where[$this->ci->Survey_questionnaire_option_language_model->languageId] = $languageId;        
        $this->ci->Survey_questionnaire_option_language_model->setWhere($where);
        $this->ci->Survey_questionnaire_option_language_model->setRecords(1);
        $optionData = $this->ci->Survey_questionnaire_option_language_model->get();
        if (count($optionData) > 0) { 
            //return $optionData[0]['label'];
            return $optionData;
        }
        ///print_r($surveyQuestionnaireData); exit;
    }
   
    
    public function getPrimaryAssessmentDetail($type="", $timestamp = "") {
        
        $languageId = trim($this->ci->session->userdata('languageId'));
        $language = trim($this->ci->session->userdata('language'));
        
        $finalResponse = array();
        $this->ci->Survey_model->resetVariable();
        $selectInput = array();
        $surveyData = array();
        $where = array();
        $surveyQuestionnaireData = array();
        $selectInput['id'] = $this->ci->Survey_model->id;
        $selectInput['name'] = $this->ci->Survey_model->name;
        $selectInput['status'] = $this->ci->Survey_model->status;
        $selectInput['deleted'] = $this->ci->Survey_model->deleted;

        $this->ci->Survey_model->setSelect($selectInput);
        $where[$this->ci->Survey_model->deleted] = 0;
        $where[$this->ci->Survey_model->status] = 1;
        $where[$this->ci->Survey_model->type] = "main"; 
        $this->ci->Survey_model->setWhere($where);
        $this->ci->Survey_model->setRecords(1);
        $surveyData = $this->ci->Survey_model->get();
        
        ///////// By Pandu - Get Survey Based On User Language //////////               
        if($languageId !="" && $language != ENGLISH){
            foreach ($surveyData as $reKey => $reVal) {
                if(isset($reVal['id']) && $reVal['id']!=""){      
                    $rowSurveyData = $this->getUserLangBasedSurvey($reVal['id'], $languageId);
                    if ($rowSurveyData != "") { 
                        $surveyData[$reKey]['name'] = $rowSurveyData;
                    }                    
                }            
            }            
        }
        //////////////////////////////////////////////////////////////////
        
        $selectInput = array();
        $where = array();
        $orderBy = array();

        $this->ci->Survey_questionnaire_model->resetVariable();
        $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
        $selectInput['title'] = $this->ci->Survey_questionnaire_model->title;
        $selectInput['severity'] = $this->ci->Survey_questionnaire_model->severity;
        $selectInput['surveyId'] = $this->ci->Survey_questionnaire_model->surveyId;
        $selectInput['surveyTaxonomyId'] = $this->ci->Survey_questionnaire_model->surveyTaxonomyId;
        $selectInput['conditionalDisplay'] = $this->ci->Survey_questionnaire_model->conditionalDisplay;
        $selectInput['conditionalType'] = $this->ci->Survey_questionnaire_model->conditionalType;
        $selectInput['mandatory'] = $this->ci->Survey_questionnaire_model->mandatory;        
        $selectInput['order'] = $this->ci->Survey_questionnaire_model->order;
        $selectInput['chiefComplaintLinking'] = $this->ci->Survey_questionnaire_model->chiefComplaintLinking;
        $selectInput['status'] = $this->ci->Survey_questionnaire_model->status;
        $selectInput['deleted'] = $this->ci->Survey_questionnaire_model->deleted;
        $this->ci->Survey_questionnaire_model->setSelect($selectInput);
        $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
        $where[$this->ci->Survey_questionnaire_model->status] = 1;
        $where[$this->ci->Survey_questionnaire_model->type] = "question";
        $where[$this->ci->Survey_questionnaire_model->surveyId] = $surveyData[0]['id'];
        $where[$this->ci->Survey_questionnaire_model->parentId] = 0;
        //$where[$this->ci->Survey_questionnaire_model->conditionalDisplay] = 0;
        if($type!="" && $type == "followup"){
            $where[$this->ci->Survey_questionnaire_model->chiefComplaintLinking] = 0;
        } 
        if($timestamp!=""){
            $where[$this->ci->Survey_questionnaire_model->mts . ">" ] = $timestamp;
        }  
        
        $this->ci->Survey_questionnaire_model->setWhere($where);
        $orderBy[] = $this->ci->Survey_questionnaire_model->order;
        $this->ci->Survey_questionnaire_model->setOrderBy($orderBy);
        $surveyQuestionnaireData = $this->ci->Survey_questionnaire_model->get();
                 
        if(count($surveyQuestionnaireData)>0){
           
            ///////// By Pandu - Get Question Based On User Language //////////       
            if($languageId !="" && $language != ENGLISH){
                foreach ($surveyQuestionnaireData as $reKey => $reVal) { 
                    if(isset($reVal['id']) && $reVal['id']!=""){      
                        $rowQtnData = $this->getUserLangBasedSurveyQuestion($reVal['id'], $languageId);
                        if ($rowQtnData != "") { 
                            $surveyQuestionnaireData[$reKey]['title'] = $rowQtnData;
                        }                     
                    }
                }    
            }
            //////////////////////////////////////////////////////////////////

            $surveyQuestionnaireIdData = commonHelperGetIdArray($surveyQuestionnaireData, 'id');
            $surveyQuestionnaireIds = implode(",", array_keys($surveyQuestionnaireIdData));
            $surveyTaxonomyIdDataArray = commonHelperGetGroupArray($surveyQuestionnaireData, 'surveyTaxonomyId');
            $chiefComplaintIdDataArray = commonHelperGetGroupArray($surveyQuestionnaireData, 'chiefComplaintLinking');
            if (!empty($chiefComplaintIdDataArray)) {
                unset($chiefComplaintIdDataArray[0]);
            }
           // print_r($surveyQuestionnaireIds); exit;
            
            $groupQuestionIds = array();
            foreach ($surveyTaxonomyIdDataArray as $stidKey => $stidVal) {
                foreach ($stidVal as $stidVVal) {
                    $groupQuestionIds[$stidKey][]['questionId'] = $stidVVal['id'];
                }
            }

            $surveyTaxonomyIdArray = array_keys($surveyTaxonomyIdDataArray);
            $selectInput = array();
            $where = array();
            $orderBy = array();
            $whereIn = array();
            $this->ci->Survey_taxonomy_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_taxonomy_model->id;
            $selectInput['taxonomyId'] = $this->ci->Survey_taxonomy_model->taxonomyId;
            $selectInput['status'] = $this->ci->Survey_taxonomy_model->status;
            $selectInput['deleted'] = $this->ci->Survey_taxonomy_model->deleted;
            $this->ci->Survey_taxonomy_model->setSelect($selectInput);
            $where[$this->ci->Survey_taxonomy_model->deleted] = 0;
            $where[$this->ci->Survey_taxonomy_model->status] = 1;
            $this->ci->Survey_taxonomy_model->setWhere($where);
            $whereIn[$this->ci->Survey_taxonomy_model->id] = $surveyTaxonomyIdArray;
            $this->ci->Survey_taxonomy_model->setWhereIns($whereIn);
            $surveyTaxonomyData = $this->ci->Survey_taxonomy_model->get();
            $surveyTaxonomyIdData = commonHelperGetIdArray($surveyTaxonomyData);

            $selectInput = array();
            $where = array();
            $orderBy = array();
            $whereIn = array();
            $this->ci->Taxonomy_model->resetVariable();
            $selectInput['id'] = $this->ci->Taxonomy_model->id;
            $selectInput['name'] = $this->ci->Taxonomy_model->name;
            $selectInput['status'] = $this->ci->Taxonomy_model->status;
            $selectInput['deleted'] = $this->ci->Taxonomy_model->deleted;
            $this->ci->Taxonomy_model->setSelect($selectInput);
            $where[$this->ci->Taxonomy_model->deleted] = 0;
            $where[$this->ci->Taxonomy_model->status] = 1;
            $this->ci->Taxonomy_model->setWhere($where);
            $whereIn[$this->ci->Taxonomy_model->id] = $surveyTaxonomyIdData;
            $this->ci->Taxonomy_model->setWhereIn($whereIn);
            $taxonomyData = $this->ci->Taxonomy_model->get();

            ///////// By Pandu - Get Taxonomy Based On User Language //////////       
            if($languageId !="" && $language != ENGLISH){
                foreach ($taxonomyData as $reKey => $reVal) { 
                    if(isset($reVal['id']) && $reVal['id']!=""){      
                        $rowTaxData = $this->getUserLangBasedTaxonomy($reVal['id'], $languageId);
                        if ($rowTaxData != "") { 
                            $taxonomyData[$reKey]['name'] = $rowTaxData;
                        } 
                    }            
                }
            }
            //////////////////////////////////////////////////////////////////

            $taxonomyIdData = commonHelperGetIdArray($taxonomyData, 'id');
            foreach ($surveyTaxonomyIdData as $taxKey => $taxVal) {
                $surveyTaxonomyIdData[$taxKey]['taxonomyName'] = $taxonomyIdData[$taxVal['id']]['name'];
            }

            $selectInput = array();
            $where = array();
            $orderBy = array();
            $whereIn = array();
            $this->ci->Survey_questionnaire_option_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
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
            $selectInput['childEnabled'] = $this->ci->Survey_questionnaire_option_model->childEnabled;
            $selectInput['order'] = $this->ci->Survey_questionnaire_option_model->order;
            $selectInput['status'] = $this->ci->Survey_questionnaire_option_model->status;
            $selectInput['deleted'] = $this->ci->Survey_questionnaire_option_model->deleted;
            $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_option_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_option_model->status] = 1;
            $where[$this->ci->Survey_questionnaire_option_model->surveyId] = $surveyData[0]['id'];
            $where[$this->ci->Survey_questionnaire_option_model->parentId] = 0;
            $this->ci->Survey_questionnaire_option_model->setWhere($where);
            $whereIn[$this->ci->Survey_questionnaire_option_model->surveyQuestionId] = $surveyQuestionnaireIds;
            $this->ci->Survey_questionnaire_option_model->setWhereIn($whereIn);
            $orderBy[] = $this->ci->Survey_questionnaire_option_model->order;
            $this->ci->Survey_questionnaire_option_model->setOrderBy($orderBy);
            $surveyQuestionnaireOptionData = $this->ci->Survey_questionnaire_option_model->get();
            //print_r($whereIn);
           // print_r($surveyQuestionnaireIds); 
            //exit;

            ///////// By Pandu - Get Option Based On User Language //////////
            if($languageId !="" && $language != ENGLISH){
                foreach ($surveyQuestionnaireOptionData as $reKey => $reVal) { 
                    if(isset($reVal['id']) && $reVal['id']!=""){      
                        $rowOptData = $this->getUserLangBasedSurveyQuestionOption($reVal['id'], $languageId);
                        if (isset($rowOptData[0]['label']) && $rowOptData[0]['label'] != "") {                         
                            $surveyQuestionnaireOptionData[$reKey]['label'] = $rowOptData[0]['label'];
                        } 
                        if (isset($rowOptData[0]['suffixLabel']) && $rowOptData[0]['suffixLabel'] != "") {  
                            $surveyQuestionnaireOptionData[$reKey]['suffixLabel'] = $rowOptData[0]['suffixLabel'];
                        } 
                    }
                }
            }
            //////////////////////////////////////////////////////////////////

            $surveyQuestionnaireOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'surveyQuestionId');
            $surveyQuestionnaireOptionIdArray = array_keys($surveyQuestionnaireOptionIdData);

            ///print_r($surveyQuestionnaireOptionIdData);exit;

            /////////////////By Pandu///////////////////
            $selectInput = array();
            $where = array();
            $whereIns = array();

            $this->ci->Survey_chief_complaint_mapping_model->resetVariable();
            $selectInput['surveyOptionId'] = $this->ci->Survey_chief_complaint_mapping_model->surveyOptionId;
            $selectInput['chiefComplaintSurveyId'] = $this->ci->Survey_chief_complaint_mapping_model->chiefComplaintSurveyId;
            $selectInput['status'] = $this->ci->Survey_chief_complaint_mapping_model->status;
            $selectInput['deleted'] = $this->ci->Survey_chief_complaint_mapping_model->deleted;
            $where[$this->ci->Survey_chief_complaint_mapping_model->deleted] = 0;
            $where[$this->ci->Survey_chief_complaint_mapping_model->status] = 1;
            ///$where[$this->ci->Survey_chief_complaint_mapping_model->surveyQuestionId] = $surveyQuestionID;
            $whereIns[$this->ci->Survey_chief_complaint_mapping_model->surveyOptionId] = $surveyQuestionnaireOptionIdArray;

            $this->ci->Survey_chief_complaint_mapping_model->setSelect($selectInput);
            $this->ci->Survey_chief_complaint_mapping_model->setWhere($where);
            $this->ci->Survey_chief_complaint_mapping_model->setWhereIns($whereIns);
            $chiefComplaintsData = $this->ci->Survey_chief_complaint_mapping_model->get();

            //print_r($chiefComplaintsData);

            foreach ($chiefComplaintsData as $cqKey => $cqVal) {
                $suryOptionId = $cqVal['surveyOptionId'];
                $chiefCompSuryId = $cqVal['chiefComplaintSurveyId'];
                $reChiefComplaintsData[$suryOptionId] = $chiefCompSuryId;               
            }
            /////////////////End///////////////////

            foreach ($surveyQuestionnaireIdData as $surQkey => $surQval) {
                if (in_array($surQval['id'], $surveyQuestionnaireOptionIdArray)) {
                    foreach ($surveyQuestionnaireOptionIdData[$surQval['id']] as $optVal) {

                        /////////////////By Pandu///////////////////
                        if(array_key_exists($optVal['id'], $reChiefComplaintsData)){                        
                            $optVal['chiefComplaintGroupId'] = $reChiefComplaintsData[$optVal['id']];
                        }
                        /////////////////End///////////////////

                        $surveyQuestionnaireIdData[$surQkey]['options'][] = $optVal;                   
                    }
                }
            }


            $conditionaAllQuestionsArray = array();
            $conditionaGroupQuestionsArray = array();
            $conditionaQuestionsArray = array();
            foreach ($surveyQuestionnaireIdData as $cqKey => $cqVal) {
                if ($cqVal['conditionalDisplay'] == 1) {
                    $conditionaAllQuestionsArray[$cqKey] = $cqVal;
                    // unset($surveyQuestionnaireIdData[$cqKey]);
                }
            }
            $conditionaAllQuestionsIdData = commonHelperGetIdArray($conditionaAllQuestionsArray, 'surveyTaxonomyId');
            $conditionaAllQuestionsIdArray = array_keys($conditionaAllQuestionsIdData);

            $qustionsConditionsArray = array();
            $surveyQuestionnaireConditionDataArray = array();
            
            foreach ($conditionaAllQuestionsArray as $sqcdVal) {
                $selectInput = array();
                $where = array();
                $orderBy = array();
                $whereIn = array();
                $this->ci->Survey_questionnaire_condition_value_model->resetVariable();                
                $selectInput['id'] = $this->ci->Survey_questionnaire_condition_value_model->id;
                $selectInput['conditionSurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionId;
                $selectInput['conditionSurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionOptionId;
                $selectInput['displaySurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId;
                $selectInput['displaySurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId;
                $selectInput['conditionMatchFirstvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchFirstvalue;
                $selectInput['conditionMatchSecondvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchSecondvalue;
                $selectInput['validationType'] = $this->ci->Survey_questionnaire_condition_value_model->validationType;
                $selectInput['mandatory'] = $this->ci->Survey_questionnaire_condition_value_model->mandatory;
                $selectInput['conditionType'] = $this->ci->Survey_questionnaire_condition_value_model->conditionType;
                $selectInput['generalFieldName'] = $this->ci->Survey_questionnaire_condition_value_model->generalFieldName;
                $selectInput['status'] = $this->ci->Survey_questionnaire_condition_value_model->status;
                $selectInput['deleted'] = $this->ci->Survey_questionnaire_condition_value_model->deleted;
                $this->ci->Survey_questionnaire_condition_value_model->setSelect($selectInput);
                $where[$this->ci->Survey_questionnaire_condition_value_model->deleted] = 0;
                $where[$this->ci->Survey_questionnaire_condition_value_model->status] = 1;
                $where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId] = $sqcdVal['id'];
                $this->ci->Survey_questionnaire_condition_value_model->setWhere($where);
                $surveyQuestionnaireConditionData = $this->ci->Survey_questionnaire_condition_value_model->get();
                            
                if(count($surveyQuestionnaireConditionData)>0){            
                    foreach ($surveyQuestionnaireConditionData as $condKey => $condVal) {
                        $surData = $this->getSurveyQtnConditionData($condVal); 
                        if(count($surData)>0){
                            if($condVal['conditionType'] == "custom"){ 
                                $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['customConditions'][] = $surData;
                            }                
                            else if($condVal['conditionType'] == "general"){
                                $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['generalConditions'][] = $surData; 
                            }
                            
                            $surveyQuestionnaireConditionDataArray[$condVal['conditionSurveyQuestionId']][]['questionId'] = $condVal['displaySurveyQuestionId'];
                        }
                        
                    }
                }
                
                
                /*
                foreach ($surveyQuestionnaireConditionData as $condVal) {                    
                    ///$surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions'][] = $condVal;
                    
                    if($condVal['conditionType'] == "custom"){     
                        $condValCustomArray = array();                    
                        $condValCustomArray['id'] = $condVal['id'];
                        $condValCustomArray['conditionSurveyQuestionId'] = $condVal['conditionSurveyQuestionId'];
                        $condValCustomArray['conditionSurveyQuestionOptionId'] = $condVal['conditionSurveyQuestionOptionId'];
                        $condValCustomArray['displaySurveyQuestionOptionId'] = $condVal['displaySurveyQuestionOptionId'];
                        $condValCustomArray['displaySurveyQuestionId'] = $condVal['displaySurveyQuestionId'];
                        $condValCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                        $condValCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                        $condValCustomArray['validationType'] = $condVal['validationType'];
                        $condValCustomArray['mandatory'] = $condVal['mandatory'];
                        $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['customConditions'][] = $condValCustomArray;
                    }                
                    else if($condVal['conditionType'] == "general"){
                        $condValGeneralCustomArray = array();
                        $condValGeneralCustomArray['id'] = $condVal['id'];
                        $condValGeneralCustomArray['displaySurveyQuestionId'] = $condVal['displaySurveyQuestionId'];
                        $condValGeneralCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                        $condValGeneralCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                        $condValGeneralCustomArray['validationType'] = $condVal['validationType'];
                        $condValGeneralCustomArray['mandatory'] = $condVal['mandatory'];
                        $condValGeneralCustomArray['generalFieldName'] = $condVal['generalFieldName'];
                        $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['generalConditions'][] = $condValGeneralCustomArray;
                    }
                                        
                    $surveyQuestionnaireConditionDataArray[$condVal['conditionSurveyQuestionId']][]['questionId'] = $condVal['displaySurveyQuestionId'];
                
                    //print_r($surveyQuestionnaireIdData); exit;
                }
                */
                
                ///print_r($surveyQuestionnaireConditionDataArray); exit;
            }
            
            //print_r($surveyQuestionnaireConditionDataArray); exit;
            
            foreach ($surveyData as $surbeyKey => $surveyData) {
                $finalResponse[$surbeyKey] = $surveyData;
                foreach ($surveyQuestionnaireIdData as $qdVal) {
                    if (isset($surveyQuestionnaireConditionDataArray[$qdVal['id']])) {
                        $qdVal['linkingConditionalQuestions'] = $surveyQuestionnaireConditionDataArray[$qdVal['id']];
                    } else {
                        $qdVal['linkingConditionalQuestions'] = array();
                    }
                    $qdVal['surveyTaxonomyName'] = NULL;
                    if (isset($surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'])) {
                        $qdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'];
                    }
                    $finalResponse[$surbeyKey]['questionnaire']['questions'][] = $qdVal;
                }
                // foreach($conditionaAllQuestionsArray as $cqgdVal)
                //{
                // $cqgdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$cqgdVal['surveyTaxonomyId']]['taxonomyName'];
                //  $finalResponse[$surbeyKey]['questionnaire']['questions'][] = $cqgdVal;
                //}
                if (count($groupQuestionIds) > 0) {
                    foreach ($groupQuestionIds as $grpQKey => $grpQVal) {
                        $finalResponse[$surbeyKey]['questionnaire']['groupQuestionIds'][$grpQKey] = $grpQVal;
                    }
                } else {
                    $finalResponse[$surbeyKey]['questionnaire']['groupQuestionIds'] = array();
                }
            }
        } 
        
        if (count($finalResponse) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_INVALID_USER;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['primaryAssessmentData'] = $finalResponse;
        $output['response']['messages'] = array();
        $output['response']['total'] = count($finalResponse);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }
    
    public function getSubOptionsData($surQOptId = ""){
        
        if(!empty($surQOptId)){
            
            $languageId = trim($this->ci->session->userdata('languageId'));
            $language = trim($this->ci->session->userdata('language'));
        
            $selectInput = array();
            $where = array();
            $orderBy = array();
            $whereIn = array();
            $this->ci->Survey_questionnaire_option_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
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
            $selectInput['order'] = $this->ci->Survey_questionnaire_option_model->order;
            $selectInput['status'] = $this->ci->Survey_questionnaire_option_model->status;
            $selectInput['deleted'] = $this->ci->Survey_questionnaire_option_model->deleted;
            $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_option_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_option_model->status] = 1;
            ///$where[$this->ci->Survey_questionnaire_option_model->surveyId] = $surveyData[0]['id'];
            $where[$this->ci->Survey_questionnaire_option_model->parentId] = $surQOptId;
            $this->ci->Survey_questionnaire_option_model->setWhere($where);
            //$whereIn[$this->ci->Survey_questionnaire_option_model->surveyQuestionId] = $surveyQuestionnaireIds;
            //$this->ci->Survey_questionnaire_option_model->setWhereIn($whereIn);
            $orderBy[] = $this->ci->Survey_questionnaire_option_model->order;
            $this->ci->Survey_questionnaire_option_model->setOrderBy($orderBy);
            $surveyQuestionnaireOptionData = $this->ci->Survey_questionnaire_option_model->get();
            //return $surveyQuestionnaireOptionData; exit;
            
            ///////// By Pandu - Get Option Based On User Language //////////
            if($languageId !="" && $language != ENGLISH){
                foreach ($surveyQuestionnaireOptionData as $reKey => $reVal) {                
                    if(isset($reVal['id']) && $reVal['id']!=""){                    
                        $rowOptData = $this->getUserLangBasedSurveyQuestionOption($reVal['id'], $languageId);
                        if (isset($rowOptData[0]['label']) && $rowOptData[0]['label'] != "") {                         
                            $surveyQuestionnaireOptionData[$reKey]['label'] = $rowOptData[0]['label'];
                        } 
                        if (isset($rowOptData[0]['suffixLabel']) && $rowOptData[0]['suffixLabel'] != "") {  
                            $surveyQuestionnaireOptionData[$reKey]['suffixLabel'] = $rowOptData[0]['suffixLabel'];
                        } 
                    }
                } 
            }       
        
            $subOptionsData = array();
            if(count($surveyQuestionnaireOptionData)>0){
                
                foreach ($surveyQuestionnaireOptionData as $surQOptkey => $surQOptval) {
                    if($surQOptval['childEnabled'] == 1){                       
                        $surQOptId = $surQOptval['id']; 
                        $optionsData = $this->getSubOptionsData($surQOptId); 
                        if(count($optionsData)>0){
                            $surveyQuestionnaireOptionData[$surQOptkey]['subOptions'] = $optionsData; 
                        }                        
                    }
                }
            }
            
            return $surveyQuestionnaireOptionData;
            
        }
    }
    
    public function getChiefComplaintDetail($inputData) {
                
        $languageId = trim($this->ci->session->userdata('languageId'));
        $language = trim($this->ci->session->userdata('language'));
        
        //$surveyId = 3;
        $surveyId = $inputData['chiefComplaintId'];
        $this->ci->Survey_model->resetVariable();
        $selectInput = array();
        $surveyData = array();
        $where = array();
        $surveyQuestionnaireData = array();
        $selectInput['id'] = $this->ci->Survey_model->id;
        $selectInput['name'] = $this->ci->Survey_model->name;
        $selectInput['status'] = $this->ci->Survey_model->status;
        $selectInput['deleted'] = $this->ci->Survey_model->deleted;
        $this->ci->Survey_model->setSelect($selectInput);
        $where[$this->ci->Survey_model->deleted] = 0;
        $where[$this->ci->Survey_model->status] = 1;
        $where[$this->ci->Survey_model->type] = "chief-complaint";
        $where[$this->ci->Survey_model->id] = $surveyId;
        $this->ci->Survey_model->setWhere($where);
        $this->ci->Survey_model->setRecords(1);
        $surveyData = $this->ci->Survey_model->get();
        if(count($surveyData)==0){
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_INVALID_INCIDENT;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
                
        ///////// By Pandu - Get Survey Based On User Language //////////               
        if($languageId !="" && $language != ENGLISH){
            foreach ($surveyData as $reKey => $reVal) {
                if(isset($reVal['id']) && $reVal['id']!=""){      
                    $rowSurveyData = $this->getUserLangBasedSurvey($reVal['id'], $languageId);
                    if ($rowSurveyData != "") { 
                        $surveyData[$reKey]['name'] = $rowSurveyData;
                    }                    
                }            
            }            
        }
        //////////////////////////////////////////////////////////////////
                
        $selectInput = array();
        $where = array();
        $orderBy = array();

        $this->ci->Survey_questionnaire_model->resetVariable();
        $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
        $selectInput['title'] = $this->ci->Survey_questionnaire_model->title;
        $selectInput['severity'] = $this->ci->Survey_questionnaire_model->severity;
        $selectInput['surveyTaxonomyId'] = $this->ci->Survey_questionnaire_model->surveyTaxonomyId;
        $selectInput['conditionalDisplay'] = $this->ci->Survey_questionnaire_model->conditionalDisplay;
        $selectInput['conditionalType'] = $this->ci->Survey_questionnaire_model->conditionalType;
        $selectInput['mandatory'] = $this->ci->Survey_questionnaire_model->mandatory;
        $selectInput['type'] = $this->ci->Survey_questionnaire_model->type;
        $selectInput['order'] = $this->ci->Survey_questionnaire_model->order;
        $selectInput['status'] = $this->ci->Survey_questionnaire_model->status;
        $selectInput['deleted'] = $this->ci->Survey_questionnaire_model->deleted;
        $this->ci->Survey_questionnaire_model->setSelect($selectInput);
        $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
        $where[$this->ci->Survey_questionnaire_model->status] = 1;
        //$where[$this->ci->Survey_questionnaire_model->type] = "question";
        $where[$this->ci->Survey_questionnaire_model->surveyId] = $surveyData[0]['id'];
        $where[$this->ci->Survey_questionnaire_model->parentId] = 0;
        //$where[$this->ci->Survey_questionnaire_model->conditionalDisplay] = 0;
        $this->ci->Survey_questionnaire_model->setWhere($where);
        $orderBy[] = $this->ci->Survey_questionnaire_model->order;
        $this->ci->Survey_questionnaire_model->setOrderBy($orderBy);
        $surveyQuestionnaireData = $this->ci->Survey_questionnaire_model->get();
                
        ///////// By Pandu - Get Question Based On User Language //////////       
        if($languageId !="" && $language != ENGLISH){
            foreach ($surveyQuestionnaireData as $reKey => $reVal) { 
                if(isset($reVal['id']) && $reVal['id']!=""){      
                    $rowQtnData = $this->getUserLangBasedSurveyQuestion($reVal['id'], $languageId);
                    if ($rowQtnData != "") { 
                        $surveyQuestionnaireData[$reKey]['title'] = $rowQtnData;
                    }                     
                }
            }    
        }
        //////////////////////////////////////////////////////////////////
            
        $surveyQuestionnaireIdData = commonHelperGetIdArray($surveyQuestionnaireData, 'id');
        $surveyQuestionnaireIds = implode(",", array_keys($surveyQuestionnaireIdData));
        $surveyTaxonomyIdDataArray = commonHelperGetGroupArray($surveyQuestionnaireData, 'surveyTaxonomyId');
        //print_r($surveyQuestionnaireIdData);
        $groupQuestionIds = array();
        foreach ($surveyTaxonomyIdDataArray as $stidKey => $stidVal) {
            foreach ($stidVal as $stidVVal) {
                $groupQuestionIds[$stidKey][]['questionId'] = $stidVVal['id'];
            }
        }

        $surveyTaxonomyIdArray = array_keys($surveyTaxonomyIdDataArray);
        $selectInput = array();
        $where = array();
        $orderBy = array();
        $whereIn = array();
        $this->ci->Survey_taxonomy_model->resetVariable();
        $selectInput['id'] = $this->ci->Survey_taxonomy_model->id;
        $selectInput['taxonomyId'] = $this->ci->Survey_taxonomy_model->taxonomyId;
        $selectInput['status'] = $this->ci->Survey_taxonomy_model->status;
        $selectInput['deleted'] = $this->ci->Survey_taxonomy_model->deleted;
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
        $selectInput['status'] = $this->ci->Taxonomy_model->status;
        $selectInput['deleted'] = $this->ci->Taxonomy_model->deleted;
        $this->ci->Taxonomy_model->setSelect($selectInput);
        $where[$this->ci->Taxonomy_model->deleted] = 0;
        $where[$this->ci->Taxonomy_model->status] = 1;
        $this->ci->Taxonomy_model->setWhere($where);
        $whereIn[$this->ci->Taxonomy_model->id] = $surveyTaxonomyIdDataArray;
        $this->ci->Taxonomy_model->setWhereIns($whereIn);
        $taxonomyData = $this->ci->Taxonomy_model->get();
                
        ///////// By Pandu - Get Taxonomy Based On User Language //////////       
        if($languageId !="" && $language != ENGLISH){
            foreach ($taxonomyData as $reKey => $reVal) { 
                if(isset($reVal['id']) && $reVal['id']!=""){      
                    $rowTaxData = $this->getUserLangBasedTaxonomy($reVal['id'], $languageId);
                    if ($rowTaxData != "") { 
                        $taxonomyData[$reKey]['name'] = $rowTaxData;
                    } 
                }            
            }
        }
        //////////////////////////////////////////////////////////////////
            
        $taxonomyIdData = commonHelperGetIdArray($taxonomyData, 'id');
        foreach ($surveyTaxonomyIdData as $taxKey => $taxVal) {
            $surveyTaxonomyIdData[$taxKey]['taxonomyName'] = $taxonomyIdData[$taxVal['taxonomyId']]['name'];
        }
        
        $selectInput = array();
        $where = array();
        $orderBy = array();
        $whereIn = array();
        $this->ci->Survey_questionnaire_option_model->resetVariable();
        $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
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
        $selectInput['conditionalDisplay'] = $this->ci->Survey_questionnaire_option_model->conditionalDisplay;
        $selectInput['order'] = $this->ci->Survey_questionnaire_option_model->order;
        $selectInput['status'] = $this->ci->Survey_questionnaire_option_model->status;
        $selectInput['deleted'] = $this->ci->Survey_questionnaire_option_model->deleted;
        $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
        $where[$this->ci->Survey_questionnaire_option_model->deleted] = 0;
        $where[$this->ci->Survey_questionnaire_option_model->status] = 1;
        $where[$this->ci->Survey_questionnaire_option_model->surveyId] = $surveyData[0]['id'];
        $where[$this->ci->Survey_questionnaire_option_model->parentId] = 0;
        $this->ci->Survey_questionnaire_option_model->setWhere($where);
        $whereIn[$this->ci->Survey_questionnaire_option_model->surveyQuestionId] = $surveyQuestionnaireIds;
        $this->ci->Survey_questionnaire_option_model->setWhereIn($whereIn);
        $orderBy[] = $this->ci->Survey_questionnaire_option_model->order;
        $this->ci->Survey_questionnaire_option_model->setOrderBy($orderBy);
        $surveyQuestionnaireOptionData = $this->ci->Survey_questionnaire_option_model->get(); 
        ///print_r($surveyQuestionnaireOptionData); exit;
        
        ///////// By Pandu - Get Option Based On User Language //////////
        if($languageId !="" && $language != ENGLISH){
            foreach ($surveyQuestionnaireOptionData as $reKey => $reVal) {                
                if(isset($reVal['id']) && $reVal['id']!=""){                    
                    $rowOptData = $this->getUserLangBasedSurveyQuestionOption($reVal['id'], $languageId);
                    if (isset($rowOptData[0]['label']) && $rowOptData[0]['label'] != "") {                         
                        $surveyQuestionnaireOptionData[$reKey]['label'] = $rowOptData[0]['label'];
                    } 
                    if (isset($rowOptData[0]['suffixLabel']) && $rowOptData[0]['suffixLabel'] != "") {  
                        $surveyQuestionnaireOptionData[$reKey]['suffixLabel'] = $rowOptData[0]['suffixLabel'];
                    } 
                }
            } 
        }       
        //////////////////////////////////////////////////////////////////
            
        /****
        $surveyQuestionnaireOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'surveyQuestionId');
        $surveyQuestionnaireParentOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'parentId');
        $surveyQuestionnaireOptionIdArray = array_keys($surveyQuestionnaireOptionIdData); 
        $subOptionArray = array();
        if (count($surveyQuestionnaireParentOptionIdData) > 0)
            unset($surveyQuestionnaireParentOptionIdData[0]);
        
        foreach ($surveyQuestionnaireIdData as $surQkey => $surQval) {
            if (in_array($surQval['id'], $surveyQuestionnaireOptionIdArray)) {
                foreach ($surveyQuestionnaireOptionIdData[$surQval['id']] as $optVal) {
                    if (isset($surveyQuestionnaireParentOptionIdData[$optVal['id']])) {
                        $tempArray = array();
                        $tempArray = array_values($surveyQuestionnaireParentOptionIdData[$optVal['id']]);
                        $optVal['subOptions'][] = $tempArray;
                    }
                    if ($optVal['parentId'] == 0) {
                        $surveyQuestionnaireIdData[$surQkey]['options'][] = $optVal;
                    }
                }
            }
        }        
        ****/
        
        $conditionalDisplayQuetionOptionIds = array();
        ////////////////////By Pandu////////////////////
        foreach ($surveyQuestionnaireOptionData as $surQOptkey => $surQOptval) {
            if(isset($surQOptval['childEnabled']) && $surQOptval['childEnabled'] == 1){
                $surQOptId = $surQOptval['id'];      
                $optionsData = $this->getSubOptionsData($surQOptId);
                if(count($optionsData)>0){ 
                    $surveyQuestionnaireOptionData[$surQOptkey]['subOptions'] = $optionsData; 
                } 
            }
                        
            if(isset($surQOptval['autopopulateConditionId']) && $surQOptval['autopopulateConditionId'] !="" && $surQOptval['autopopulateConditionId'] !="null" ){                
                ////////////////////By Pandu//////////////////// 
                $surveyQuestionnaireOptionData[$surQOptkey]['autopopulateConditions'] = $this->getAutoPopulateConditionData($surQOptval['autopopulateConditionId']);
                ///////////////////////////////////////////////  
            } 
            
            if(isset($surQOptval['conditionalDisplay']) && $surQOptval['conditionalDisplay'] !=0){                
                ////////////////////By Pandu//////////////////// 
                $surQOptId = $surQOptval['id'];  
                $conditionalDisplayQuetionOptionIds[] = $surQOptId;
                $surveyQuestionnaireOptionData[$surQOptkey]['displayConditions'] = $this->getConditionalDisplayConditionsData($surQOptval['surveyQuestionId'], $surQOptId);
                /////////////////////////////////////////////// 
            } 
            
        }
      
        ///print_r($conditionalDisplayQuetionIds); exit; 
        
        $surveyQuestionnaireOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'surveyQuestionId');
        $surveyQuestionnaireParentOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'parentId');
        $surveyQuestionnaireOptionIdArray = array_keys($surveyQuestionnaireOptionIdData);        
        
        //print_r($surveyQuestionnaireOptionData); exit;
        ///print_r($surveyQuestionnaireOptionIdData); exit;
        //print_r($surveyQuestionnaireIdData); exit;
        
        foreach ($surveyQuestionnaireIdData as $surQkey => $surQval) {
            if (in_array($surQval['id'], $surveyQuestionnaireOptionIdArray)) {
                foreach ($surveyQuestionnaireOptionIdData[$surQval['id']] as $optVal) {                                
                    //if ($optVal['parentId'] == 0) {
                        $surveyQuestionnaireIdData[$surQkey]['options'][] = $optVal;
                    //} 
                }
            }
        }
        
        //print_r($surveyQuestionnaireIdData); exit;        
        //////////////////////////////////////////////
             
        
        $conditionaAllQuestionsArray = array();
        $conditionaGroupQuestionsArray = array();
        $conditionaQuestionsArray = array();
        foreach ($surveyQuestionnaireIdData as $cqKey => $cqVal) {
            if ($cqVal['conditionalDisplay'] == 1) {
                $conditionaAllQuestionsArray[$cqKey] = $cqVal;
                // unset($surveyQuestionnaireIdData[$cqKey]);
            }
        }
        $conditionaAllQuestionsIdData = commonHelperGetIdArray($conditionaAllQuestionsArray, 'surveyTaxonomyId');
        $conditionaAllQuestionsIdArray = array_keys($conditionaAllQuestionsIdData);
        ///print_r($conditionaAllQuestionsIdArray); exit;                
        //print_r($conditionaAllQuestionsArray); exit;
        
        ///print_r($conditionalDisplayQuetionIds); 
        ///print_r($conditionalDisplayQuetionOptionIds);
        
        $qustionsConditionsArray = array();
        $surveyQuestionnaireConditionDataArray = array();
        foreach ($conditionaAllQuestionsArray as $sqcdKey => $sqcdVal) {            
            $selectInput = array();
            $where = array();
            $whereNotIn = array();
            $orderBy = array();
            $whereIn = array();
            $this->ci->Survey_questionnaire_condition_value_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_questionnaire_condition_value_model->id;
            $selectInput['conditionSurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionId;
            $selectInput['conditionSurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionOptionId;
            $selectInput['displaySurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId;
            $selectInput['displaySurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId;
            $selectInput['conditionMatchFirstvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchFirstvalue;
            $selectInput['conditionMatchSecondvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchSecondvalue;
            $selectInput['validationType'] = $this->ci->Survey_questionnaire_condition_value_model->validationType;
            $selectInput['mandatory'] = $this->ci->Survey_questionnaire_condition_value_model->mandatory;
            $selectInput['conditionType'] = $this->ci->Survey_questionnaire_condition_value_model->conditionType;
            $selectInput['generalFieldName'] = $this->ci->Survey_questionnaire_condition_value_model->generalFieldName;
            $selectInput['status'] = $this->ci->Survey_questionnaire_condition_value_model->status;
            $selectInput['deleted'] = $this->ci->Survey_questionnaire_condition_value_model->deleted;
            $this->ci->Survey_questionnaire_condition_value_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_condition_value_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_condition_value_model->status] = 1;
            $where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId] = $sqcdVal['id'];             
            //$where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId ." IS NULL" ] = NULL;
            //$whereNotIn[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId ] = $conditionalDisplayQuetionOptionIds;
            
            $this->ci->Survey_questionnaire_condition_value_model->setWhere($where);
            ///$this->ci->Survey_questionnaire_condition_value_model->setWhereNotIn($whereNotIn);
            //print_r($whereNotIn); exit;
            $surveyQuestionnaireConditionData = $this->ci->Survey_questionnaire_condition_value_model->get();
            //exit;            
            //print_r($surveyQuestionnaireConditionData);
            
            //echo $this->ci->db->last_query() ."<br>========================================<br>";            
            //exit;
            //echo count($surveyQuestionnaireConditionData);  
            
            if(count($surveyQuestionnaireConditionData)>0){
                
                foreach ($surveyQuestionnaireConditionData as $condKey => $condVal) {
                    //echo $sqcdKey."--".$condKey ."--". $condVal['conditionType'].", "; 
                    
                    $displaySurveyQuestionOptionId = trim($condVal['displaySurveyQuestionOptionId']);
                    //echo "OptionId = ".$displaySurveyQuestionOptionId .", ";  
                         
                    if(!in_array($displaySurveyQuestionOptionId, $conditionalDisplayQuetionOptionIds)){

                        //echo "OptionId = ".$displaySurveyQuestionOptionId .", ";  
                        
                        $surData = $this->getSurveyQtnConditionData($condVal); 
                        
                        if(count($surData)>0){
                            if($condVal['conditionType'] == "custom"){ 
                                $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions']['customConditions'][] = $surData;
                            }                
                            else if($condVal['conditionType'] == "general"){
                                $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions']['generalConditions'][] = $surData; 
                            }
                            
                            $surveyQuestionnaireConditionDataArray[$condVal['conditionSurveyQuestionId']][]['questionId'] = $condVal['displaySurveyQuestionId'];
                        }
                        
                        /*
                        if($condVal['conditionType'] == "custom"){     
                            $condValCustomArray = array();                    
                            $condValCustomArray['id'] = $condVal['id'];
                            $condValCustomArray['conditionSurveyQuestionId'] = $condVal['conditionSurveyQuestionId'];
                            $condValCustomArray['conditionSurveyQuestionOptionId'] = $condVal['conditionSurveyQuestionOptionId'];
                            $condValCustomArray['displaySurveyQuestionOptionId'] = $condVal['displaySurveyQuestionOptionId'];
                            $condValCustomArray['displaySurveyQuestionId'] = $condVal['displaySurveyQuestionId'];
                            $condValCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                            $condValCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                            $condValCustomArray['validationType'] = $condVal['validationType'];
                            $condValCustomArray['mandatory'] = $condVal['mandatory'];
                            $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions']['customConditions'][] = $condValCustomArray;
                        }                
                        else if($condVal['conditionType'] == "general"){
                             $condValGeneralCustomArray = array();
                             $condValGeneralCustomArray['id'] = $condVal['id'];
                             $condValGeneralCustomArray['displaySurveyQuestionId'] = $condVal['displaySurveyQuestionId'];
                             $condValGeneralCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                             $condValGeneralCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                             $condValGeneralCustomArray['validationType'] = $condVal['validationType'];
                             $condValGeneralCustomArray['mandatory'] = $condVal['mandatory'];
                             $condValGeneralCustomArray['generalFieldName'] = $condVal['generalFieldName'];
                             $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions']['generalConditions'][] = $condValGeneralCustomArray;
                        }
                                                
                        $surveyQuestionnaireConditionDataArray[$condVal['conditionSurveyQuestionId']][]['questionId'] = $condVal['displaySurveyQuestionId'];
                        */
                    }  

                }
            }
            
            foreach ($surveyQuestionnaireConditionDataArray as $reCondKey => $reCondVal) {
                $surveyQuestionnaireConditionDataArray[$reCondKey] = array_unique($reCondVal, SORT_REGULAR);              
            }           
        }
        
        //exit;
        //print_r($surveyQuestionnaireConditionDataArray); exit;  
        //print_R($surveyQuestionnaireIdData); exit;
           
        $finalResponse = array();
        foreach ($surveyData as $surbeyKey => $surveyData) {
            $finalResponse[$surbeyKey] = $surveyData;
            foreach ($surveyQuestionnaireIdData as $qdVal) {
                if(array_key_exists('id', $qdVal)){      
                    if (isset($surveyQuestionnaireConditionDataArray[$qdVal['id']])) {                        
                        //$qdVal['linkingConditionalQuestions'][] = $surveyQuestionnaireConditionDataArray[$qdVal['id']];
                        $sQarray = array_values($surveyQuestionnaireConditionDataArray[$qdVal['id']]);                        
                        $qdVal['linkingConditionalQuestions'] = $sQarray;                        
                    } 
                    else {
                        $qdVal['linkingConditionalQuestions'] = array();
                    }
                                         
                    $qdVal['surveyTaxonomyName'] = NULL;
                    if (isset($surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'])) {
                        $qdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'];
                    }                

                    $qtnType = $qdVal['type'];

                    if($qtnType == "question"){          
                        $finalResponse[$surbeyKey]['questionnaire']['questions'][] = $qdVal;
                    }
                    else if($qtnType == "diagnoses"){
                        $finalResponse[$surbeyKey]['questionnaire']['diagnoses'][] = $qdVal;
                    }                
                }
            }
            
            
            // foreach($conditionaAllQuestionsArray as $cqgdVal)
            //{
            // $cqgdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$cqgdVal['surveyTaxonomyId']]['taxonomyName'];
            //  $finalResponse[$surbeyKey]['questionnaire']['questions'][] = $cqgdVal;
            //}
            if (count($groupQuestionIds) > 0) {
                foreach ($groupQuestionIds as $grpQKey => $grpQVal) {
                    $finalResponse[$surbeyKey]['questionnaire']['groupQuestionIds'][$grpQKey] = $grpQVal;
                }
            } else {
                $finalResponse[$surbeyKey]['questionnaire']['groupQuestionIds'] = array();
            }
        }

        if (count($finalResponse) == 0) {
            $output['status'] = TRUE;
             ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_INVALID_USER;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['primaryAssessmentData'] = $finalResponse;
        $output['response']['messages'] = array();
        $output['response']['total'] = count($finalResponse);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    
    
    public function getChiefComplaintFollowupDetail($inputData) {
        
        $languageId = trim($this->ci->session->userdata('languageId'));
        $language = trim($this->ci->session->userdata('language'));
        
        //$surveyId = 3;
        $surveyId = $inputData['chiefComplaintId'];
        $this->ci->Survey_model->resetVariable();
        $selectInput = array();
        $surveyData = array();
        $where = array();
        $surveyQuestionnaireData = array();
        $selectInput['id'] = $this->ci->Survey_model->id;
        $selectInput['name'] = $this->ci->Survey_model->name;
        $selectInput['status'] = $this->ci->Survey_model->status;
        $selectInput['deleted'] = $this->ci->Survey_model->deleted;
        $this->ci->Survey_model->setSelect($selectInput);
        $where[$this->ci->Survey_model->deleted] = 0;
        $where[$this->ci->Survey_model->status] = 1;
        $where[$this->ci->Survey_model->type] = "chief-complaint-followup";
        $where[$this->ci->Survey_model->id] = $surveyId;
        $this->ci->Survey_model->setWhere($where);
        $this->ci->Survey_model->setRecords(1);
        $surveyData = $this->ci->Survey_model->get();
        //print_r($surveyData); exit;
        if(count($surveyData)==0){
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_INVALID_INCIDENT_FOLLOWUP;
            $output['response']['messages'][] = $this->ci->lang->line('error_medical_followup_not_found_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        
        
        ///////// By Pandu - Get Survey Based On User Language //////////               
        if($languageId !="" && $language != ENGLISH){
            foreach ($surveyData as $reKey => $reVal) {
                if(isset($reVal['id']) && $reVal['id']!=""){      
                    $rowSurveyData = $this->getUserLangBasedSurvey($reVal['id'], $languageId);
                    if ($rowSurveyData != "") { 
                        $surveyData[$reKey]['name'] = $rowSurveyData;
                    }                    
                }            
            }            
        }
        //////////////////////////////////////////////////////////////////
                
        $selectInput = array();
        $where = array();
        $orderBy = array();
        $this->ci->Survey_questionnaire_model->resetVariable();
        $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
        $selectInput['title'] = $this->ci->Survey_questionnaire_model->title;
        $selectInput['severity'] = $this->ci->Survey_questionnaire_model->severity;
        $selectInput['surveyTaxonomyId'] = $this->ci->Survey_questionnaire_model->surveyTaxonomyId;
        $selectInput['conditionalDisplay'] = $this->ci->Survey_questionnaire_model->conditionalDisplay;
        $selectInput['conditionalType'] = $this->ci->Survey_questionnaire_model->conditionalType;
        $selectInput['mandatory'] = $this->ci->Survey_questionnaire_model->mandatory;
        $selectInput['type'] = $this->ci->Survey_questionnaire_model->type;
        $selectInput['order'] = $this->ci->Survey_questionnaire_model->order;
        $selectInput['status'] = $this->ci->Survey_questionnaire_model->status;
        $selectInput['deleted'] = $this->ci->Survey_questionnaire_model->deleted;
        $this->ci->Survey_questionnaire_model->setSelect($selectInput);
        $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
        $where[$this->ci->Survey_questionnaire_model->status] = 1;
        //$where[$this->ci->Survey_questionnaire_model->type] = "question";
        $where[$this->ci->Survey_questionnaire_model->surveyId] = $surveyData[0]['id'];
        $where[$this->ci->Survey_questionnaire_model->parentId] = 0;
        $where[$this->ci->Survey_questionnaire_model->chiefComplaintLinking] = 0;
        //$where[$this->ci->Survey_questionnaire_model->conditionalDisplay] = 0;
        $this->ci->Survey_questionnaire_model->setWhere($where);
        $orderBy[] = $this->ci->Survey_questionnaire_model->order;
        $this->ci->Survey_questionnaire_model->setOrderBy($orderBy);
        $surveyQuestionnaireData = $this->ci->Survey_questionnaire_model->get();
        ///print_r($surveyQuestionnaireData); exit;
        
        ///////// By Pandu - Get Question Based On User Language //////////       
        if($languageId !="" && $language != ENGLISH){
            foreach ($surveyQuestionnaireData as $reKey => $reVal) { 
                if(isset($reVal['id']) && $reVal['id']!=""){      
                    $rowQtnData = $this->getUserLangBasedSurveyQuestion($reVal['id'], $languageId);
                    if ($rowQtnData != "") { 
                        $surveyQuestionnaireData[$reKey]['title'] = $rowQtnData;
                    }                     
                }
            }    
        }
        //////////////////////////////////////////////////////////////////

        $surveyQuestionnaireIdData = commonHelperGetIdArray($surveyQuestionnaireData, 'id');
        $surveyQuestionnaireIds = implode(",", array_keys($surveyQuestionnaireIdData));
        $surveyTaxonomyIdDataArray = commonHelperGetGroupArray($surveyQuestionnaireData, 'surveyTaxonomyId');
        $groupQuestionIds = array();
        foreach ($surveyTaxonomyIdDataArray as $stidKey => $stidVal) {
            foreach ($stidVal as $stidVVal) {
                $groupQuestionIds[$stidKey][]['questionId'] = $stidVVal['id'];
            }
        }

        $surveyTaxonomyIdArray = array_keys($surveyTaxonomyIdDataArray);
        $selectInput = array();
        $where = array();
        $orderBy = array();
        $whereIn = array();
        $this->ci->Survey_taxonomy_model->resetVariable();
        $selectInput['id'] = $this->ci->Survey_taxonomy_model->id;
        $selectInput['taxonomyId'] = $this->ci->Survey_taxonomy_model->taxonomyId;
        $selectInput['status'] = $this->ci->Survey_taxonomy_model->status;
        $selectInput['deleted'] = $this->ci->Survey_taxonomy_model->deleted;
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
        $selectInput['status'] = $this->ci->Taxonomy_model->status;
        $selectInput['deleted'] = $this->ci->Taxonomy_model->deleted;
        $this->ci->Taxonomy_model->setSelect($selectInput);
        $where[$this->ci->Taxonomy_model->deleted] = 0;
        $where[$this->ci->Taxonomy_model->status] = 1;
        $this->ci->Taxonomy_model->setWhere($where);
        $whereIn[$this->ci->Taxonomy_model->id] = $surveyTaxonomyIdDataArray;
        $this->ci->Taxonomy_model->setWhereIns($whereIn);
        $taxonomyData = $this->ci->Taxonomy_model->get();
        
        ///////// By Pandu - Get Taxonomy Based On User Language //////////       
        if($languageId !="" && $language != ENGLISH){
            foreach ($taxonomyData as $reKey => $reVal) { 
                if(isset($reVal['id']) && $reVal['id']!=""){      
                    $rowTaxData = $this->getUserLangBasedTaxonomy($reVal['id'], $languageId);
                    if ($rowTaxData != "") { 
                        $taxonomyData[$reKey]['name'] = $rowTaxData;
                    } 
                }            
            }
        }
        //////////////////////////////////////////////////////////////////

        $taxonomyIdData = commonHelperGetIdArray($taxonomyData, 'id');
        foreach ($surveyTaxonomyIdData as $taxKey => $taxVal) {
            $surveyTaxonomyIdData[$taxKey]['taxonomyName'] = $taxonomyIdData[$taxVal['taxonomyId']]['name'];
        }
        $selectInput = array();
        $where = array();
        $orderBy = array();
        $whereIn = array();
        $this->ci->Survey_questionnaire_option_model->resetVariable();
        $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
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
        $selectInput['conditionalDisplay'] = $this->ci->Survey_questionnaire_option_model->conditionalDisplay;
        $selectInput['order'] = $this->ci->Survey_questionnaire_option_model->order;
        $selectInput['status'] = $this->ci->Survey_questionnaire_option_model->status;
        $selectInput['deleted'] = $this->ci->Survey_questionnaire_option_model->deleted;
        $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
        $where[$this->ci->Survey_questionnaire_option_model->deleted] = 0;
        $where[$this->ci->Survey_questionnaire_option_model->status] = 1;
        $where[$this->ci->Survey_questionnaire_option_model->surveyId] = $surveyData[0]['id'];
        $where[$this->ci->Survey_questionnaire_option_model->parentId] = 0;
        $this->ci->Survey_questionnaire_option_model->setWhere($where);
        $whereIn[$this->ci->Survey_questionnaire_option_model->surveyQuestionId] = $surveyQuestionnaireIds;
        $this->ci->Survey_questionnaire_option_model->setWhereIn($whereIn);
        $orderBy[] = $this->ci->Survey_questionnaire_option_model->order;
        $this->ci->Survey_questionnaire_option_model->setOrderBy($orderBy);
        $surveyQuestionnaireOptionData = $this->ci->Survey_questionnaire_option_model->get();
        
        ///////// By Pandu - Get Option Based On User Language //////////
        if($languageId !="" && $language != ENGLISH){
            foreach ($surveyQuestionnaireOptionData as $reKey => $reVal) { 
                if(isset($reVal['id']) && $reVal['id']!=""){      
                    $rowOptData = $this->getUserLangBasedSurveyQuestionOption($reVal['id'], $languageId);
                    if (isset($rowOptData[0]['label']) && $rowOptData[0]['label'] != "") {                         
                        $surveyQuestionnaireOptionData[$reKey]['label'] = $rowOptData[0]['label'];
                    } 
                    if (isset($rowOptData[0]['suffixLabel']) && $rowOptData[0]['suffixLabel'] != "") {  
                        $surveyQuestionnaireOptionData[$reKey]['suffixLabel'] = $rowOptData[0]['suffixLabel'];
                    } 
                }
            }
        }
        //////////////////////////////////////////////////////////////////

        /***
        $surveyQuestionnaireOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'surveyQuestionId');
        $surveyQuestionnaireParentOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'parentId');
        $surveyQuestionnaireOptionIdArray = array_keys($surveyQuestionnaireOptionIdData);
        $subOptionArray = array();
        if (count($surveyQuestionnaireParentOptionIdData) > 0)
            unset($surveyQuestionnaireParentOptionIdData[0]);


        foreach ($surveyQuestionnaireIdData as $surQkey => $surQval) {
            if (in_array($surQval['id'], $surveyQuestionnaireOptionIdArray)) {
                foreach ($surveyQuestionnaireOptionIdData[$surQval['id']] as $optVal) {
                    if (isset($surveyQuestionnaireParentOptionIdData[$optVal['id']])) {
                        $tempArray = array();
                        $tempArray = array_values($surveyQuestionnaireParentOptionIdData[$optVal['id']]);
                        $optVal['subOptions'][] = $tempArray;
                    }
                    if ($optVal['parentId'] == 0) {
                        $surveyQuestionnaireIdData[$surQkey]['options'][] = $optVal;
                    }
                }
            }
        }
        ****/
        
        $conditionalDisplayQuetionOptionIds = array();
        ////////////////////By Pandu////////////////////
        //$autopopulateConditionIds = array();
        foreach ($surveyQuestionnaireOptionData as $surQOptkey => $surQOptval) {
            if($surQOptval['childEnabled'] == 1){
                $surQOptId = $surQOptval['id'];      
                $optionsData = $this->getSubOptionsData($surQOptId);
                if(count($optionsData)>0){ 
                    $surveyQuestionnaireOptionData[$surQOptkey]['subOptions'] = $optionsData; 
                } 
            }
            
            if($surQOptval['autopopulateConditionId'] !="" && $surQOptval['autopopulateConditionId'] !="null" ){
                //$autopopulateConditionIds[$surQOptkey] = $surQOptval['autopopulateConditionId'];                
                ////////////////////By Pandu////////////////////
                $surveyQuestionnaireOptionData[$surQOptkey]['autopopulateConditions'] = $this->getAutoPopulateConditionData($surQOptval['autopopulateConditionId']);
                /////////////////////////////////////////////////
            }
            
            if(isset($surQOptval['conditionalDisplay']) && $surQOptval['conditionalDisplay'] !=0){                
                ////////////////////By Pandu//////////////////// 
                $surQOptId = $surQOptval['id'];  
                $conditionalDisplayQuetionOptionIds[] = $surQOptId;
                $surveyQuestionnaireOptionData[$surQOptkey]['displayConditions'] = $this->getConditionalDisplayConditionsData($surQOptval['surveyQuestionId'], $surQOptId);
                /////////////////////////////////////////////// 
            } 
        }
        //exit;
        ///print_r($surveyQuestionnaireOptionData); exit; 
        
        $surveyQuestionnaireOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'surveyQuestionId');
        $surveyQuestionnaireParentOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'parentId');
        $surveyQuestionnaireOptionIdArray = array_keys($surveyQuestionnaireOptionIdData);        
        
        //print_r($surveyQuestionnaireOptionData); exit;
        ///print_r($surveyQuestionnaireOptionIdData); exit;
        //print_r($surveyQuestionnaireIdData); exit;
        //exit;
        
        foreach ($surveyQuestionnaireIdData as $surQkey => $surQval) {
            if (in_array($surQval['id'], $surveyQuestionnaireOptionIdArray)) {
                foreach ($surveyQuestionnaireOptionIdData[$surQval['id']] as $optVal) {                                
                    //if ($optVal['parentId'] == 0) {
                        $surveyQuestionnaireIdData[$surQkey]['options'][] = $optVal;
                    //} 
                }
            }
        }
        
        ///print_r($surveyQuestionnaireIdData); exit;        
        //////////////////////////////////////////////
                
        $conditionaAllQuestionsArray = array();
        $conditionaGroupQuestionsArray = array();
        $conditionaQuestionsArray = array();
        foreach ($surveyQuestionnaireIdData as $cqKey => $cqVal) {
            if ($cqVal['conditionalDisplay'] == 1) {
                $conditionaAllQuestionsArray[$cqKey] = $cqVal;
                // unset($surveyQuestionnaireIdData[$cqKey]);
            }
        }
        $conditionaAllQuestionsIdData = commonHelperGetIdArray($conditionaAllQuestionsArray, 'surveyTaxonomyId');
        $conditionaAllQuestionsIdArray = array_keys($conditionaAllQuestionsIdData);

        $qustionsConditionsArray = array();
        $surveyQuestionnaireConditionDataArray = array();
        foreach ($conditionaAllQuestionsArray as $sqcdVal) {
            $selectInput = array();
            $where = array();
            $orderBy = array();
            $whereIn = array();
            $this->ci->Survey_questionnaire_condition_value_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_questionnaire_condition_value_model->id;
            $selectInput['conditionSurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionId;
            $selectInput['conditionSurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionOptionId;
            $selectInput['displaySurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId;
            $selectInput['displaySurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId;
            $selectInput['conditionMatchFirstvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchFirstvalue;
            $selectInput['conditionMatchSecondvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchSecondvalue;
            $selectInput['validationType'] = $this->ci->Survey_questionnaire_condition_value_model->validationType;
            $selectInput['mandatory'] = $this->ci->Survey_questionnaire_condition_value_model->mandatory;
            $selectInput['conditionType'] = $this->ci->Survey_questionnaire_condition_value_model->conditionType;
            $selectInput['generalFieldName'] = $this->ci->Survey_questionnaire_condition_value_model->generalFieldName;
            $selectInput['status'] = $this->ci->Survey_questionnaire_condition_value_model->status;
            $selectInput['deleted'] = $this->ci->Survey_questionnaire_condition_value_model->deleted;
            $this->ci->Survey_questionnaire_condition_value_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_condition_value_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_condition_value_model->status] = 1;
            $where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId] = $sqcdVal['id'];
            $this->ci->Survey_questionnaire_condition_value_model->setWhere($where);
            $surveyQuestionnaireConditionData = $this->ci->Survey_questionnaire_condition_value_model->get();
            
                       
            if(count($surveyQuestionnaireConditionData)>0){
                
                foreach ($surveyQuestionnaireConditionData as $condKey => $condVal) {
                    
                    $displaySurveyQuestionOptionId = trim($condVal['displaySurveyQuestionOptionId']);
                    
                    if(!in_array($displaySurveyQuestionOptionId, $conditionalDisplayQuetionOptionIds)){
                        
                        $surData = $this->getSurveyQtnConditionData($condVal); 
                        
                        if(count($surData)>0){
                            if($condVal['conditionType'] == "custom"){ 
                                $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions']['customConditions'][] = $surData;
                            }                
                            else if($condVal['conditionType'] == "general"){
                                $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions']['generalConditions'][] = $surData; 
                            }

                            $surveyQuestionnaireConditionDataArray[$condVal['conditionSurveyQuestionId']][]['questionId'] = $condVal['displaySurveyQuestionId'];
                        }
                    }
                }
            }
            
            
            /*
             if(count($surveyQuestionnaireConditionData)>0){            
                foreach ($surveyQuestionnaireConditionData as $condKey => $condVal) {
                    
                    $surData = $this->getSurveyQtnConditionData($condVal); 
                    if(count($surData)>0){
                        if($condVal['conditionType'] == "custom"){ 
                            $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions']['customConditions'][] = $surData;
                        }                
                        else if($condVal['conditionType'] == "general"){
                            $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions']['generalConditions'][] = $surData; 
                        }
                        
                        $surveyQuestionnaireConditionDataArray[$condVal['conditionSurveyQuestionId']][]['questionId'] = $condVal['displaySurveyQuestionId'];
                    }
                    
                }
            }
             */
                      
        }
                       
        $finalResponse = array();
        foreach ($surveyData as $surbeyKey => $surveyData) {
            $finalResponse[$surbeyKey] = $surveyData;
            foreach ($surveyQuestionnaireIdData as $qdVal) {
                if (isset($surveyQuestionnaireConditionDataArray[$qdVal['id']])) {
                    $qdVal['linkingConditionalQuestions'] = $surveyQuestionnaireConditionDataArray[$qdVal['id']];
                } else {
                    $qdVal['linkingConditionalQuestions'] = array();
                }
                $qdVal['surveyTaxonomyName'] = NULL;
                if (isset($surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'])) {
                    $qdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'];
                }
                
                //$finalResponse[$surbeyKey]['questionnaire']['questions'][] = $qdVal;
                
                $qtnType = $qdVal['type'];
                if($qtnType == "question"){          
                    $finalResponse[$surbeyKey]['questionnaire']['questions'][] = $qdVal;
                }
                else if($qtnType == "diagnoses"){
                    $finalResponse[$surbeyKey]['questionnaire']['diagnoses'][] = $qdVal;
                }
                        
            }
            // foreach($conditionaAllQuestionsArray as $cqgdVal)
            //{
            // $cqgdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$cqgdVal['surveyTaxonomyId']]['taxonomyName'];
            //  $finalResponse[$surbeyKey]['questionnaire']['questions'][] = $cqgdVal;
            //}
            if (count($groupQuestionIds) > 0) {
                foreach ($groupQuestionIds as $grpQKey => $grpQVal) {
                    $finalResponse[$surbeyKey]['questionnaire']['groupQuestionIds'][$grpQKey] = $grpQVal;
                }
            } else {
                $finalResponse[$surbeyKey]['questionnaire']['groupQuestionIds'] = array();
            }
        }

        if (count($finalResponse) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_INVALID_USER;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['primaryAssessmentData'] = $finalResponse;
        $output['response']['messages'] = array();
        $output['response']['total'] = count($finalResponse);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getSurveyQtnConditionData($condVal = "" ){
        ///print_r($condVal); exit;    
        $conditionsData = array();
        
        if(count($condVal)>0){
            if($condVal['conditionType'] == "custom"){     
                $condValCustomArray = array();                    
                $condValCustomArray['id'] = $condVal['id'];
                $condValCustomArray['conditionSurveyQuestionId'] = $condVal['conditionSurveyQuestionId'];
                $condValCustomArray['conditionSurveyQuestionOptionId'] = $condVal['conditionSurveyQuestionOptionId'];
                $condValCustomArray['displaySurveyQuestionOptionId'] = $condVal['displaySurveyQuestionOptionId'];
                $condValCustomArray['displaySurveyQuestionId'] = $condVal['displaySurveyQuestionId'];
                $condValCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                $condValCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                $condValCustomArray['validationType'] = $condVal['validationType'];
                $condValCustomArray['mandatory'] = $condVal['mandatory'];
                $conditionsData = $condValCustomArray;
            }                
            else if($condVal['conditionType'] == "general"){
                $condValGeneralCustomArray = array();
                $condValGeneralCustomArray['id'] = $condVal['id'];
                $condValGeneralCustomArray['displaySurveyQuestionId'] = $condVal['displaySurveyQuestionId'];
                $condValGeneralCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                $condValGeneralCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                $condValGeneralCustomArray['validationType'] = $condVal['validationType'];
                $condValGeneralCustomArray['mandatory'] = $condVal['mandatory'];
                $condValGeneralCustomArray['generalFieldName'] = $condVal['generalFieldName'];
                $conditionsData = $condValGeneralCustomArray;
            }
        }    
        
        return $conditionsData;
    }   
    
    public function getAutoPopulateConditionData($autopopulateConditionId = ""){
        
        $surveyQuestionnaireOptionData = array();
            
        if($autopopulateConditionId !=""){
            $conIds = explode(',', $autopopulateConditionId);
            //print_r($conIds);
            
            $selectInput = array();
            $where = array();
            $orderBy = array();
            $whereIn = array();
            $this->ci->Survey_questionnaire_condition_value_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_questionnaire_condition_value_model->id;
            $selectInput['conditionSurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionId;
            $selectInput['conditionSurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionOptionId;
            $selectInput['displaySurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId;
            $selectInput['displaySurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId;
            $selectInput['conditionMatchFirstvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchFirstvalue;
            $selectInput['conditionMatchSecondvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchSecondvalue;
            $selectInput['validationType'] = $this->ci->Survey_questionnaire_condition_value_model->validationType;
            $selectInput['mandatory'] = $this->ci->Survey_questionnaire_condition_value_model->mandatory;
            $selectInput['conditionType'] = $this->ci->Survey_questionnaire_condition_value_model->conditionType;
            $selectInput['generalFieldName'] = $this->ci->Survey_questionnaire_condition_value_model->generalFieldName;
            $selectInput['status'] = $this->ci->Survey_questionnaire_condition_value_model->status;
            $selectInput['deleted'] = $this->ci->Survey_questionnaire_condition_value_model->deleted;
            $this->ci->Survey_questionnaire_condition_value_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_condition_value_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_condition_value_model->status] = 1;
            //$where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId] = $sqcdVal['id'];
            $this->ci->Survey_questionnaire_condition_value_model->setWhere($where);
            $whereIn[$this->ci->Survey_questionnaire_condition_value_model->id] = $conIds;
            $this->ci->Survey_questionnaire_condition_value_model->setWhereIns($whereIn);              
            $surveyQuestionnaireConditionData = $this->ci->Survey_questionnaire_condition_value_model->get();               
            //print_r($surveyQuestionnaireConditionData); exit;
            
            if(count($surveyQuestionnaireConditionData)>0){            
                foreach ($surveyQuestionnaireConditionData as $condKey => $condVal) {
                    $surData = $this->getSurveyQtnConditionData($condVal); 
                    if(count($surData)>0){
                        if($condVal['conditionType'] == "custom"){ 
                            $surveyQuestionnaireOptionData['customConditions'][] = $surData;
                        }                
                        else if($condVal['conditionType'] == "general"){
                            $surveyQuestionnaireOptionData['generalConditions'][] = $surData; 
                        }
                    }                   
                }
                ///$surveyQuestionnaireOptionData[$surQOptkey]['autopopulateConditions'] = $surveyQuestionnaireConditionData;
            }
            
            
            /*
            foreach ($surveyQuestionnaireConditionData as $condKey => $condVal) {
                //echo $condKey ."--". $condVal['conditionType'].", "; exit;
                if($condVal['conditionType'] == "custom"){     
                    $condValCustomArray = array();                    
                    $condValCustomArray['id'] = $condVal['id'];
                    $condValCustomArray['conditionSurveyQuestionId'] = $condVal['conditionSurveyQuestionId'];
                    $condValCustomArray['conditionSurveyQuestionOptionId'] = $condVal['conditionSurveyQuestionOptionId'];
                    $condValCustomArray['displaySurveyQuestionOptionId'] = $condVal['displaySurveyQuestionOptionId'];
                    $condValCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                    $condValCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                    $condValCustomArray['validationType'] = $condVal['validationType'];
                    $condValCustomArray['mandatory'] = $condVal['mandatory'];
                    $surveyQuestionnaireOptionData['customConditions'][] = $condValCustomArray;
                }                
                else if($condVal['conditionType'] == "general"){
                     $condValGeneralCustomArray = array();
                     $condValGeneralCustomArray['id'] = $condVal['id'];
                     $condValGeneralCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                     $condValGeneralCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                     $condValGeneralCustomArray['validationType'] = $condVal['validationType'];
                     $condValGeneralCustomArray['mandatory'] = $condVal['mandatory'];
                     $condValGeneralCustomArray['generalFieldName'] = $condVal['generalFieldName'];
                     $surveyQuestionnaireOptionData['generalConditions'][] = $condValGeneralCustomArray;
                }
            }            
           
            //$surveyQuestionnaireOptionData[$surQOptkey]['autopopulateConditions'] = $surveyQuestionnaireConditionData;
             */  
        }
        return $surveyQuestionnaireOptionData;
    }
    
    public function getConditionalDisplayConditionsData($qtnId = 0, $surQOptId = 0){
        
        $surveyQuestionnaireOptionData = array();
        
        if($qtnId > 0 &&  $surQOptId > 0){
            
            $selectInput = array();
            $where = array();
            $orderBy = array();
            //$whereIn = array();
            $this->ci->Survey_questionnaire_condition_value_model->resetVariable();
            $selectInput['id'] = $this->ci->Survey_questionnaire_condition_value_model->id;
            $selectInput['conditionSurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionId;
            $selectInput['conditionSurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionOptionId;
            $selectInput['displaySurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId;
            $selectInput['displaySurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId;
            $selectInput['conditionMatchFirstvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchFirstvalue;
            $selectInput['conditionMatchSecondvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchSecondvalue;
            $selectInput['validationType'] = $this->ci->Survey_questionnaire_condition_value_model->validationType;
            $selectInput['mandatory'] = $this->ci->Survey_questionnaire_condition_value_model->mandatory;
            $selectInput['conditionType'] = $this->ci->Survey_questionnaire_condition_value_model->conditionType;
            $selectInput['generalFieldName'] = $this->ci->Survey_questionnaire_condition_value_model->generalFieldName;
            $selectInput['status'] = $this->ci->Survey_questionnaire_condition_value_model->status;
            $selectInput['deleted'] = $this->ci->Survey_questionnaire_condition_value_model->deleted;
            $this->ci->Survey_questionnaire_condition_value_model->setSelect($selectInput);
            $where[$this->ci->Survey_questionnaire_condition_value_model->deleted] = 0;
            $where[$this->ci->Survey_questionnaire_condition_value_model->status] = 1;
            //$where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId .">"] = 0;
            $where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId] = $qtnId;
            $where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId] =  $surQOptId;
            
            $this->ci->Survey_questionnaire_condition_value_model->setWhere($where);
            ///$whereIn[$this->ci->Survey_questionnaire_condition_value_model->id] = $conIds;
            //$this->ci->Survey_questionnaire_condition_value_model->setWhereIns($whereIn);              
            $surveyQuestionnaireConditionData = $this->ci->Survey_questionnaire_condition_value_model->get();               
            ///print_r($surveyQuestionnaireConditionData); exit;
            ///echo $this->ci->db->last_query() ."<br>========================================<br>";
                        
            if(count($surveyQuestionnaireConditionData)>0){            
                foreach ($surveyQuestionnaireConditionData as $condKey => $condVal) {
                    $surData = $this->getSurveyQtnConditionData($condVal); 
                    if(count($surData)>0){
                        if($condVal['conditionType'] == "custom"){ 
                            $surveyQuestionnaireOptionData['customConditions'][] = $surData;
                        }                
                        else if($condVal['conditionType'] == "general"){
                            $surveyQuestionnaireOptionData['generalConditions'][] = $surData; 
                        }
                    }
                }
                //$surveyQuestionnaireOptionData[$surQOptkey]['autopopulateConditions'] = $surveyQuestionnaireConditionData;
            }
            
            
            /*
            foreach ($surveyQuestionnaireConditionData as $condKey => $condVal) {
                //echo $condKey ."--". $condVal['conditionType'].", "; exit;
                if($condVal['conditionType'] == "custom"){     
                    $condValCustomArray = array();                    
                    $condValCustomArray['id'] = $condVal['id'];
                    $condValCustomArray['conditionSurveyQuestionId'] = $condVal['conditionSurveyQuestionId'];
                    $condValCustomArray['conditionSurveyQuestionOptionId'] = $condVal['conditionSurveyQuestionOptionId'];
                    $condValCustomArray['displaySurveyQuestionOptionId'] = $condVal['displaySurveyQuestionOptionId'];
                    $condValCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                    $condValCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                    $condValCustomArray['validationType'] = $condVal['validationType'];
                    $condValCustomArray['mandatory'] = $condVal['mandatory'];
                    $surveyQuestionnaireOptionData['customConditions'][] = $condValCustomArray;
                }                
                else if($condVal['conditionType'] == "general"){
                     $condValGeneralCustomArray = array();
                     $condValGeneralCustomArray['id'] = $condVal['id'];
                     $condValGeneralCustomArray['conditionMatchFirstvalue'] = $condVal['conditionMatchFirstvalue'];
                     $condValGeneralCustomArray['conditionMatchSecondvalue'] = $condVal['conditionMatchSecondvalue'];
                     $condValGeneralCustomArray['validationType'] = $condVal['validationType'];
                     $condValGeneralCustomArray['mandatory'] = $condVal['mandatory'];
                     $condValGeneralCustomArray['generalFieldName'] = $condVal['generalFieldName'];
                     $surveyQuestionnaireOptionData['generalConditions'][] = $condValGeneralCustomArray;
                }
            }                 
            //$surveyQuestionnaireOptionData[$surQOptkey]['autopopulateConditions'] = $surveyQuestionnaireConditionData;
            */
        }
        return $surveyQuestionnaireOptionData;
    }
    
        
    public function getAllChiefComplaintsDetails($timestamp = "") {
            
        $this->ci->Survey_model->resetVariable();
        $selectInput = array();
        $surveyData = array();
        $where = array();
        $orderBy = array();
        $surveyQuestionnaireData = array();
        $selectInput['id'] = $this->ci->Survey_model->id;
        $selectInput['name'] = $this->ci->Survey_model->name;
        $selectInput['status'] = $this->ci->Survey_model->status;
        $selectInput['deleted'] = $this->ci->Survey_model->deleted;
        $this->ci->Survey_model->setSelect($selectInput);
        $where[$this->ci->Survey_model->deleted] = 0;
        $where[$this->ci->Survey_model->status] = 1;
        $where[$this->ci->Survey_model->type] = "chief-complaint";
        //$where[$this->ci->Survey_model->id] = $surveyId;
        $this->ci->Survey_model->setWhere($where);
        $orderBy[] = $this->ci->Survey_model->order;
        $this->ci->Survey_model->setOrderBy($orderBy);
        //$this->ci->Survey_model->setRecords(1);
        $surveyData = $this->ci->Survey_model->get();
        ///print_r($surveyData); exit;
        if(count($surveyData)==0){
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_INVALID_INCIDENT;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        
        $finalChiefComplaintResponse = array();
        
        if(count($surveyData)>0){
            $i = 0;
            foreach($surveyData as $survey){

                $selectInput = array();
                $where = array();
                $orderBy = array();
                $this->ci->Survey_questionnaire_model->resetVariable();
                $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
                $selectInput['title'] = $this->ci->Survey_questionnaire_model->title;
                $selectInput['severity'] = $this->ci->Survey_questionnaire_model->severity;
                $selectInput['surveyTaxonomyId'] = $this->ci->Survey_questionnaire_model->surveyTaxonomyId;
                $selectInput['conditionalDisplay'] = $this->ci->Survey_questionnaire_model->conditionalDisplay;
                $selectInput['conditionalType'] = $this->ci->Survey_questionnaire_model->conditionalType;
                $selectInput['mandatory'] = $this->ci->Survey_questionnaire_model->mandatory;
                $selectInput['type'] = $this->ci->Survey_questionnaire_model->type;
                $selectInput['order'] = $this->ci->Survey_questionnaire_model->order;
                $selectInput['status'] = $this->ci->Survey_questionnaire_model->status;
                $selectInput['deleted'] = $this->ci->Survey_questionnaire_model->deleted;
                $this->ci->Survey_questionnaire_model->setSelect($selectInput);
                $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
                $where[$this->ci->Survey_questionnaire_model->status] = 1;
                //$where[$this->ci->Survey_questionnaire_model->type] = "question";
                $where[$this->ci->Survey_questionnaire_model->surveyId] = $survey['id'];
                $where[$this->ci->Survey_questionnaire_model->parentId] = 0;
                //$where[$this->ci->Survey_questionnaire_model->conditionalDisplay] = 0;
                if($timestamp!=""){
                    $where[$this->ci->Survey_questionnaire_model->mts . ">" ] = $timestamp;
                } 
                $this->ci->Survey_questionnaire_model->setWhere($where);
                $orderBy[] = $this->ci->Survey_questionnaire_model->order;
                $this->ci->Survey_questionnaire_model->setOrderBy($orderBy);
                $surveyQuestionnaireData = $this->ci->Survey_questionnaire_model->get();
                
                if(count($surveyQuestionnaireData)>0){
                
                    $surveyQuestionnaireIdData = commonHelperGetIdArray($surveyQuestionnaireData, 'id');
                    $surveyQuestionnaireIds = implode(",", array_keys($surveyQuestionnaireIdData));
                    $surveyTaxonomyIdDataArray = commonHelperGetGroupArray($surveyQuestionnaireData, 'surveyTaxonomyId');
                    //print_r($surveyQuestionnaireIdData);
                    
                    $groupQuestionIds = array();
                    foreach ($surveyTaxonomyIdDataArray as $stidKey => $stidVal) {
                        foreach ($stidVal as $stidVVal) {
                            $groupQuestionIds[$stidKey][]['questionId'] = $stidVVal['id'];
                        }
                    }
                    $surveyTaxonomyIdArray = array_keys($surveyTaxonomyIdDataArray);
                    ///print_r($surveyTaxonomyIdArray); //exit;

                    $selectInput = array();
                    $where = array();
                    $orderBy = array();
                    $whereIn = array();
                    $this->ci->Survey_taxonomy_model->resetVariable();
                    $selectInput['id'] = $this->ci->Survey_taxonomy_model->id;
                    $selectInput['taxonomyId'] = $this->ci->Survey_taxonomy_model->taxonomyId;
                    $selectInput['status'] = $this->ci->Survey_taxonomy_model->status;
                    $selectInput['deleted'] = $this->ci->Survey_taxonomy_model->deleted;
                    $this->ci->Survey_taxonomy_model->setSelect($selectInput);
                    $where[$this->ci->Survey_taxonomy_model->deleted] = 0;
                    $where[$this->ci->Survey_taxonomy_model->status] = 1;
                    $this->ci->Survey_taxonomy_model->setWhere($where);
                    $whereIn[$this->ci->Survey_taxonomy_model->id] = $surveyTaxonomyIdArray;
                    $this->ci->Survey_taxonomy_model->setWhereIns($whereIn);
                    //print_r($whereIn); exit;
                    $surveyTaxonomyData = $this->ci->Survey_taxonomy_model->get();
                    //print_r($surveyTaxonomyData); exit;

                    $surveyTaxonomyIdData = commonHelperGetIdArray($surveyTaxonomyData);
                    $surveyTaxonomyKeyData = commonHelperGetIdArray($surveyTaxonomyData, 'taxonomyId');
                    $surveyTaxonomyIdDataArray = array_keys($surveyTaxonomyKeyData);
                    //print_r($surveyTaxonomyIdDataArray); exit;

                    $selectInput = array();
                    $where = array();
                    $orderBy = array();
                    $whereIn = array();
                    $this->ci->Taxonomy_model->resetVariable();
                    $selectInput['id'] = $this->ci->Taxonomy_model->id;
                    $selectInput['name'] = $this->ci->Taxonomy_model->name;
                    $selectInput['status'] = $this->ci->Taxonomy_model->status;
                    $selectInput['deleted'] = $this->ci->Taxonomy_model->deleted;
                    $this->ci->Taxonomy_model->setSelect($selectInput);
                    $where[$this->ci->Taxonomy_model->deleted] = 0;
                    $where[$this->ci->Taxonomy_model->status] = 1;
                    $this->ci->Taxonomy_model->setWhere($where);
                    $whereIn[$this->ci->Taxonomy_model->id] = $surveyTaxonomyIdDataArray;
                    $this->ci->Taxonomy_model->setWhereIns($whereIn);
                    $taxonomyData = $this->ci->Taxonomy_model->get();
                    //print_r($taxonomyData); exit;

                    $taxonomyIdData = commonHelperGetIdArray($taxonomyData, 'id');
                    foreach ($surveyTaxonomyIdData as $taxKey => $taxVal) {
                        $surveyTaxonomyIdData[$taxKey]['taxonomyName'] = $taxonomyIdData[$taxVal['taxonomyId']]['name'];
                    }

                    $selectInput = array();
                    $where = array();
                    $orderBy = array();
                    $whereIn = array();
                    $this->ci->Survey_questionnaire_option_model->resetVariable();
                    $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
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
                    $selectInput['order'] = $this->ci->Survey_questionnaire_option_model->order;
                    $selectInput['status'] = $this->ci->Survey_questionnaire_option_model->status;
                    $selectInput['deleted'] = $this->ci->Survey_questionnaire_option_model->deleted;
                    $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
                    $where[$this->ci->Survey_questionnaire_option_model->deleted] = 0;
                    $where[$this->ci->Survey_questionnaire_option_model->status] = 1;
                    $where[$this->ci->Survey_questionnaire_option_model->surveyId] = $survey['id'];
                    //$where[$this->ci->Survey_questionnaire_option_model->parentId] = 0;
                    $this->ci->Survey_questionnaire_option_model->setWhere($where);
                    $whereIn[$this->ci->Survey_questionnaire_option_model->surveyQuestionId] = $surveyQuestionnaireIds;
                    $this->ci->Survey_questionnaire_option_model->setWhereIn($whereIn);
                    $orderBy[] = $this->ci->Survey_questionnaire_option_model->order;
                    $this->ci->Survey_questionnaire_option_model->setOrderBy($orderBy);
                    $surveyQuestionnaireOptionData = $this->ci->Survey_questionnaire_option_model->get();
                    $surveyQuestionnaireOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'surveyQuestionId');
                    $surveyQuestionnaireParentOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'parentId');
                    $surveyQuestionnaireOptionIdArray = array_keys($surveyQuestionnaireOptionIdData);
                    $subOptionArray = array();
                    if (count($surveyQuestionnaireParentOptionIdData) > 0)
                        unset($surveyQuestionnaireParentOptionIdData[0]);


                    foreach ($surveyQuestionnaireIdData as $surQkey => $surQval) {
                        if (in_array($surQval['id'], $surveyQuestionnaireOptionIdArray)) {
                            foreach ($surveyQuestionnaireOptionIdData[$surQval['id']] as $optVal) {
                                if (isset($surveyQuestionnaireParentOptionIdData[$optVal['id']])) {
                                    $tempArray = array();
                                    $tempArray = array_values($surveyQuestionnaireParentOptionIdData[$optVal['id']]);
                                    $optVal['subOptions'][] = $tempArray;
                                }
                                if ($optVal['parentId'] == 0) {
                                    $surveyQuestionnaireIdData[$surQkey]['options'][] = $optVal;
                                }
                            }
                        }
                    }

                    $conditionaAllQuestionsArray = array();
                    $conditionaGroupQuestionsArray = array();
                    $conditionaQuestionsArray = array();
                    foreach ($surveyQuestionnaireIdData as $cqKey => $cqVal) {
                        if ($cqVal['conditionalDisplay'] == 1) {
                            $conditionaAllQuestionsArray[$cqKey] = $cqVal;
                            // unset($surveyQuestionnaireIdData[$cqKey]);
                        }
                    }
                    $conditionaAllQuestionsIdData = commonHelperGetIdArray($conditionaAllQuestionsArray, 'surveyTaxonomyId');
                    $conditionaAllQuestionsIdArray = array_keys($conditionaAllQuestionsIdData);
                    
                    //echo count($conditionaAllQuestionsArray).","; 
                                        
                    $qustionsConditionsArray = array();
                    $surveyQuestionnaireConditionDataArray = array();
                    foreach ($conditionaAllQuestionsArray as $sqcdVal) {
                        $selectInput = array();
                        $where = array();
                        $orderBy = array();
                        $whereIn = array();
                        $this->ci->Survey_questionnaire_condition_value_model->resetVariable();
                        $selectInput['id'] = $this->ci->Survey_questionnaire_condition_value_model->id;
                        $selectInput['conditionSurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionId;
                        $selectInput['conditionSurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionOptionId;
                        $selectInput['displaySurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId;
                        $selectInput['displaySurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId;
                        $selectInput['conditionMatchFirstvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchFirstvalue;
                        $selectInput['conditionMatchSecondvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchSecondvalue;
                        $selectInput['validationType'] = $this->ci->Survey_questionnaire_condition_value_model->validationType;
                        $selectInput['mandatory'] = $this->ci->Survey_questionnaire_condition_value_model->mandatory;
                        $selectInput['conditionType'] = $this->ci->Survey_questionnaire_condition_value_model->conditionType;
                        $selectInput['generalFieldName'] = $this->ci->Survey_questionnaire_condition_value_model->generalFieldName;
                        $selectInput['status'] = $this->ci->Survey_questionnaire_condition_value_model->status;
                        $selectInput['deleted'] = $this->ci->Survey_questionnaire_condition_value_model->deleted;
                        $this->ci->Survey_questionnaire_condition_value_model->setSelect($selectInput);
                        $where[$this->ci->Survey_questionnaire_condition_value_model->deleted] = 0;
                        $where[$this->ci->Survey_questionnaire_condition_value_model->status] = 1;
                        $where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId] = $sqcdVal['id'];
                        $this->ci->Survey_questionnaire_condition_value_model->setWhere($where);
                        $surveyQuestionnaireConditionData = $this->ci->Survey_questionnaire_condition_value_model->get();
                        
                        //echo count($surveyQuestionnaireConditionData).","; 
                        
                        foreach ($surveyQuestionnaireConditionData as $condVal) {
                            $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions'][] = $condVal;
                            $surveyQuestionnaireConditionDataArray[$condVal['conditionSurveyQuestionId']][]['questionId'] = $condVal['displaySurveyQuestionId'];
                        }
                    }
                                      
                    $chiefComplaintResponse = array();                   
                        
                    $chiefComplaintResponse = $survey;

                    foreach ($surveyQuestionnaireIdData as $qdVal) {
                        //print_r($qdVal); exit;
                        if (isset($surveyQuestionnaireConditionDataArray[$qdVal['id']])) {
                            $qdVal['linkingConditionalQuestions'] = $surveyQuestionnaireConditionDataArray[$qdVal['id']];
                        } else {
                            $qdVal['linkingConditionalQuestions'] = array();
                        }

                        $qdVal['surveyTaxonomyName'] = NULL;
                        if (isset($surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'])) {
                            $qdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'];
                        }                

                        $qtnType = $qdVal['type'];

                        if($qtnType == "question"){          
                            $chiefComplaintResponse['questionnaire']['questions'][] = $qdVal;
                        }
                        else if($qtnType == "diagnoses"){
                            $chiefComplaintResponse['questionnaire']['diagnoses'][] = $qdVal;
                        }                

                    }
                    // foreach($conditionaAllQuestionsArray as $cqgdVal)
                    //{
                    // $cqgdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$cqgdVal['surveyTaxonomyId']]['taxonomyName'];
                    //  $finalResponse[$surbeyKey]['questionnaire']['questions'][] = $cqgdVal;
                    //}

                    if (count($groupQuestionIds) > 0) {
                        foreach ($groupQuestionIds as $grpQKey => $grpQVal) {
                            $chiefComplaintResponse['questionnaire']['groupQuestionIds'][$grpQKey] = $grpQVal;
                        }
                    } else {
                        $chiefComplaintResponse['questionnaire']['groupQuestionIds'] = array();
                    }
                                          
                    $finalChiefComplaintResponse[$i] = $chiefComplaintResponse;
                    
                }          
                
                $i++;
            }   
            
        }
              
        
        if (count($finalChiefComplaintResponse) == 0) {
            $output['status'] = TRUE;
             ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_INVALID_USER;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['chiefComplaintsData'] = $finalChiefComplaintResponse;
        $output['response']['messages'] = array();
        $output['response']['total'] = count($finalChiefComplaintResponse);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }
    
    
    public function getAllChiefComplaintFollowupsDetail( $timestamp = "") {
        //$surveyId = 3;
        //$surveyId = $inputData['chiefComplaintId'];
        $this->ci->Survey_model->resetVariable();
        $selectInput = array();
        $surveyData = array();
        $where = array();
        $surveyQuestionnaireData = array();
        $selectInput['id'] = $this->ci->Survey_model->id;
        $selectInput['name'] = $this->ci->Survey_model->name;
        $selectInput['status'] = $this->ci->Survey_model->status;
        $selectInput['deleted'] = $this->ci->Survey_model->deleted;
        $this->ci->Survey_model->setSelect($selectInput);
        $where[$this->ci->Survey_model->deleted] = 0;
        $where[$this->ci->Survey_model->status] = 1;
        $where[$this->ci->Survey_model->type] = "chief-complaint-followup";
        //$where[$this->ci->Survey_model->id] = $surveyId;
        $this->ci->Survey_model->setWhere($where);
        $orderBy[] = $this->ci->Survey_model->order;
        //$this->ci->Survey_model->setRecords(1);
        $surveyData = $this->ci->Survey_model->get();
        if(count($surveyData)==0){
            $output['status'] = FALSE;
            ///$output["response"]["messages"][] = ERROR_INVALID_INCIDENT_FOLLOWUP;
            $output['response']['messages'][] = $this->ci->lang->line('error_medical_followup_not_found_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        
        $finalChiefComplaintFollowupsResponse = array();
        
        if(count($surveyData)>0){
            $i = 0;
            foreach($surveyData as $survey){
                            
                $selectInput = array();
                $where = array();
                $orderBy = array();

                $this->ci->Survey_questionnaire_model->resetVariable();
                $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
                $selectInput['title'] = $this->ci->Survey_questionnaire_model->title;
                $selectInput['severity'] = $this->ci->Survey_questionnaire_model->severity;
                $selectInput['surveyTaxonomyId'] = $this->ci->Survey_questionnaire_model->surveyTaxonomyId;
                $selectInput['conditionalDisplay'] = $this->ci->Survey_questionnaire_model->conditionalDisplay;
                $selectInput['conditionalType'] = $this->ci->Survey_questionnaire_model->conditionalType;
                $selectInput['mandatory'] = $this->ci->Survey_questionnaire_model->mandatory;
                $selectInput['type'] = $this->ci->Survey_questionnaire_model->type;
                $selectInput['order'] = $this->ci->Survey_questionnaire_model->order;
                $selectInput['status'] = $this->ci->Survey_questionnaire_model->status;
                $selectInput['deleted'] = $this->ci->Survey_questionnaire_model->deleted;
                $this->ci->Survey_questionnaire_model->setSelect($selectInput);
                $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
                $where[$this->ci->Survey_questionnaire_model->status] = 1;
                //$where[$this->ci->Survey_questionnaire_model->type] = "question";
                $where[$this->ci->Survey_questionnaire_model->surveyId] = $survey['id'];
                $where[$this->ci->Survey_questionnaire_model->parentId] = 0;
                //$where[$this->ci->Survey_questionnaire_model->conditionalDisplay] = 0;
                $this->ci->Survey_questionnaire_model->setWhere($where);
                $orderBy[] = $this->ci->Survey_questionnaire_model->order;
                $this->ci->Survey_questionnaire_model->setOrderBy($orderBy);
                $surveyQuestionnaireData = $this->ci->Survey_questionnaire_model->get();
                
                if(count($surveyQuestionnaireData)>0){
                                    
                    $surveyQuestionnaireIdData = commonHelperGetIdArray($surveyQuestionnaireData, 'id');
                    $surveyQuestionnaireIds = implode(",", array_keys($surveyQuestionnaireIdData));
                    $surveyTaxonomyIdDataArray = commonHelperGetGroupArray($surveyQuestionnaireData, 'surveyTaxonomyId');
                    $groupQuestionIds = array();
                    foreach ($surveyTaxonomyIdDataArray as $stidKey => $stidVal) {
                        foreach ($stidVal as $stidVVal) {
                            $groupQuestionIds[$stidKey][]['questionId'] = $stidVVal['id'];
                        }
                    }

                    $surveyTaxonomyIdArray = array_keys($surveyTaxonomyIdDataArray);
                    $selectInput = array();
                    $where = array();
                    $orderBy = array();
                    $whereIn = array();
                    $this->ci->Survey_taxonomy_model->resetVariable();
                    $selectInput['id'] = $this->ci->Survey_taxonomy_model->id;
                    $selectInput['taxonomyId'] = $this->ci->Survey_taxonomy_model->taxonomyId;
                    $selectInput['status'] = $this->ci->Survey_taxonomy_model->status;
                    $selectInput['deleted'] = $this->ci->Survey_taxonomy_model->deleted;
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
                    $selectInput['status'] = $this->ci->Taxonomy_model->status;
                    $selectInput['deleted'] = $this->ci->Taxonomy_model->deleted;
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
                    $selectInput = array();
                    $where = array();
                    $orderBy = array();
                    $whereIn = array();
                    $this->ci->Survey_questionnaire_option_model->resetVariable();
                    $selectInput['id'] = $this->ci->Survey_questionnaire_option_model->id;
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
                    $selectInput['order'] = $this->ci->Survey_questionnaire_option_model->order;
                    $selectInput['status'] = $this->ci->Survey_questionnaire_option_model->status;
                    $selectInput['deleted'] = $this->ci->Survey_questionnaire_option_model->deleted;
                    $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);
                    $where[$this->ci->Survey_questionnaire_option_model->deleted] = 0;
                    $where[$this->ci->Survey_questionnaire_option_model->status] = 1;
                    $where[$this->ci->Survey_questionnaire_option_model->surveyId] = $survey['id'];
                    //$where[$this->ci->Survey_questionnaire_option_model->parentId] = 0;
                    $this->ci->Survey_questionnaire_option_model->setWhere($where);
                    $whereIn[$this->ci->Survey_questionnaire_option_model->surveyQuestionId] = $surveyQuestionnaireIds;
                    $this->ci->Survey_questionnaire_option_model->setWhereIn($whereIn);
                    $orderBy[] = $this->ci->Survey_questionnaire_option_model->order;
                    $this->ci->Survey_questionnaire_option_model->setOrderBy($orderBy);
                    $surveyQuestionnaireOptionData = $this->ci->Survey_questionnaire_option_model->get();
                    $surveyQuestionnaireOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'surveyQuestionId');
                    $surveyQuestionnaireParentOptionIdData = commonHelperGetGroupArray($surveyQuestionnaireOptionData, 'parentId');
                    $surveyQuestionnaireOptionIdArray = array_keys($surveyQuestionnaireOptionIdData);
                    $subOptionArray = array();
                    if (count($surveyQuestionnaireParentOptionIdData) > 0)
                        unset($surveyQuestionnaireParentOptionIdData[0]);


                    foreach ($surveyQuestionnaireIdData as $surQkey => $surQval) {
                        if (in_array($surQval['id'], $surveyQuestionnaireOptionIdArray)) {
                            foreach ($surveyQuestionnaireOptionIdData[$surQval['id']] as $optVal) {
                                if (isset($surveyQuestionnaireParentOptionIdData[$optVal['id']])) {
                                    $tempArray = array();
                                    $tempArray = array_values($surveyQuestionnaireParentOptionIdData[$optVal['id']]);
                                    $optVal['subOptions'][] = $tempArray;
                                }
                                if ($optVal['parentId'] == 0) {
                                    $surveyQuestionnaireIdData[$surQkey]['options'][] = $optVal;
                                }
                            }
                        }
                    }

                    $conditionaAllQuestionsArray = array();
                    $conditionaGroupQuestionsArray = array();
                    $conditionaQuestionsArray = array();
                    foreach ($surveyQuestionnaireIdData as $cqKey => $cqVal) {
                        if ($cqVal['conditionalDisplay'] == 1) {
                            $conditionaAllQuestionsArray[$cqKey] = $cqVal;
                            // unset($surveyQuestionnaireIdData[$cqKey]);
                        }
                    }
                    $conditionaAllQuestionsIdData = commonHelperGetIdArray($conditionaAllQuestionsArray, 'surveyTaxonomyId');
                    $conditionaAllQuestionsIdArray = array_keys($conditionaAllQuestionsIdData);

                    $qustionsConditionsArray = array();
                    $surveyQuestionnaireConditionDataArray = array();
                    foreach ($conditionaAllQuestionsArray as $sqcdVal) {
                        $selectInput = array();
                        $where = array();
                        $orderBy = array();
                        $whereIn = array();
                        $this->ci->Survey_questionnaire_condition_value_model->resetVariable();
                        $selectInput['id'] = $this->ci->Survey_questionnaire_condition_value_model->id;
                        $selectInput['conditionSurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionId;
                        $selectInput['conditionSurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionOptionId;
                        $selectInput['displaySurveyQuestionOptionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionOptionId;
                        $selectInput['displaySurveyQuestionId'] = $this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId;
                        $selectInput['conditionMatchFirstvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchFirstvalue;
                        $selectInput['conditionMatchSecondvalue'] = $this->ci->Survey_questionnaire_condition_value_model->conditionMatchSecondvalue;
                        $selectInput['validationType'] = $this->ci->Survey_questionnaire_condition_value_model->validationType;
                        $selectInput['mandatory'] = $this->ci->Survey_questionnaire_condition_value_model->mandatory;
                        $selectInput['conditionType'] = $this->ci->Survey_questionnaire_condition_value_model->conditionType;
                        $selectInput['generalFieldName'] = $this->ci->Survey_questionnaire_condition_value_model->generalFieldName;
                        $selectInput['status'] = $this->ci->Survey_questionnaire_condition_value_model->status;
                        $selectInput['deleted'] = $this->ci->Survey_questionnaire_condition_value_model->deleted;
                        $this->ci->Survey_questionnaire_condition_value_model->setSelect($selectInput);
                        $where[$this->ci->Survey_questionnaire_condition_value_model->deleted] = 0;
                        $where[$this->ci->Survey_questionnaire_condition_value_model->status] = 1;
                        $where[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId] = $sqcdVal['id'];
                        $this->ci->Survey_questionnaire_condition_value_model->setWhere($where);
                        $surveyQuestionnaireConditionData = $this->ci->Survey_questionnaire_condition_value_model->get();

                        foreach ($surveyQuestionnaireConditionData as $condVal) {

                            $surveyQuestionnaireIdData[$condVal['displaySurveyQuestionId']]['conditions'][] = $condVal;
                            $surveyQuestionnaireConditionDataArray[$condVal['conditionSurveyQuestionId']][]['questionId'] = $condVal['displaySurveyQuestionId'];
                        }
                    }

                   
                    $chiefComplaintFollowupsResponse = array();                   

                    $chiefComplaintFollowupsResponse = $survey;

                    foreach ($surveyQuestionnaireIdData as $qdVal) {
                        //print_r($qdVal); exit;
                        if (isset($surveyQuestionnaireConditionDataArray[$qdVal['id']])) {
                            $qdVal['linkingConditionalQuestions'] = $surveyQuestionnaireConditionDataArray[$qdVal['id']];
                        } else {
                            $qdVal['linkingConditionalQuestions'] = array();
                        }

                        $qdVal['surveyTaxonomyName'] = NULL;
                        if (isset($surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'])) {
                            $qdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$qdVal['surveyTaxonomyId']]['taxonomyName'];
                        }                

                        $qtnType = $qdVal['type'];

                        if($qtnType == "question"){          
                            $chiefComplaintFollowupsResponse['questionnaire']['questions'][] = $qdVal;
                        }
                        else if($qtnType == "diagnoses"){
                            $chiefComplaintFollowupsResponse['questionnaire']['diagnoses'][] = $qdVal;
                        }                

                    }
                    // foreach($conditionaAllQuestionsArray as $cqgdVal)
                    //{
                    // $cqgdVal['surveyTaxonomyName'] = $surveyTaxonomyIdData[$cqgdVal['surveyTaxonomyId']]['taxonomyName'];
                    //  $finalResponse[$surbeyKey]['questionnaire']['questions'][] = $cqgdVal;
                    //}

                    if (count($groupQuestionIds) > 0) {
                        foreach ($groupQuestionIds as $grpQKey => $grpQVal) {
                            $chiefComplaintFollowupsResponse['questionnaire']['groupQuestionIds'][$grpQKey] = $grpQVal;
                        }
                    } else {
                        $chiefComplaintFollowupsResponse['questionnaire']['groupQuestionIds'] = array();
                    }
                    
                    $finalChiefComplaintFollowupsResponse[$i] = $chiefComplaintFollowupsResponse;
                }   
                
                $i++;
            }    
        }
        
        if (count($finalChiefComplaintFollowupsResponse) == 0) {
            $output['status'] = TRUE;
             ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_INVALID_USER;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['chiefComplaintFollowupsData'] = $finalChiefComplaintFollowupsResponse;
        $output['response']['messages'] = array();
        $output['response']['total'] = count($finalChiefComplaintFollowupsResponse);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }
    
    
    
}
