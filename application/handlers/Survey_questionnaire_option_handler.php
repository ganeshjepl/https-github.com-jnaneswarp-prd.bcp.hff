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

class Survey_questionnaire_option_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Survey_questionnaire_option_model');
    }

    public function getOptionDetails($option_id) {
        
        $this->ci->Survey_questionnaire_option_model->resetVariable();
        $selectInput    = array();
        $where          = array();
        $selectInput['survey_id'] = $this->ci->Survey_questionnaire_option_model->surveyId;
        $selectInput['question_id'] = $this->ci->Survey_questionnaire_option_model->surveyQuestionId;
        $selectInput['label'] = $this->ci->Survey_questionnaire_option_model->label;
        $selectInput['suffix_label'] = $this->ci->Survey_questionnaire_option_model->suffixLabel;
        $this->ci->Survey_questionnaire_option_model->setSelect($selectInput);

        $where = array(
            $this->ci->Survey_questionnaire_option_model->deleted => 0, 
            $this->ci->Survey_questionnaire_option_model->status => 1,
            $this->ci->Survey_questionnaire_option_model->id => $option_id
                );
        $this->ci->Survey_questionnaire_option_model->setWhere($where);
        
        $question_ids = $this->ci->Survey_questionnaire_option_model->get();
        
        if (count($question_ids) == 0) {
            $output['status'] = FALSE;
//            $output['response']['message'][] = ERROR_NO_CITY_DATA;
            $output['response']['message'][] = $this->ci->lang->line('error_question_not_found');;
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['question_ids'] = $question_ids;
        $output['response']['total'] = count($question_ids);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }
}

?>
