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

class Survey_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Survey_model');
    }

    public function getSurveyNameById($survey_id) {
        
        $this->ci->Survey_model->resetVariable();
        $selectInput    = array();
        $survey_name    =   array();
        $where          = array();
        $selectInput['name'] = $this->ci->Survey_model->name;
        $this->ci->Survey_model->setSelect($selectInput);

        $where = array(
            $this->ci->Survey_model->deleted => 0, 
            $this->ci->Survey_model->status => 1,
            $this->ci->Survey_model->id => $survey_id
                );
        $this->ci->Survey_model->setWhere($where);
        
        $survey_name = $this->ci->Survey_model->get();
        
        if (count($survey_name) == 0) {
            $output['status'] = FALSE;
//            $output['response']['message'][] = ERROR_NO_CITY_DATA;
            $output['response']['message'][] = $this->ci->lang->line('error_survey_not_found');;
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['survey'] = $survey_name;
        $output['response']['total'] = count($survey_name);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }
}

?>
