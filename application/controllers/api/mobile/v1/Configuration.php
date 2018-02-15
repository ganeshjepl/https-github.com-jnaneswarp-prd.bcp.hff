<?php

/* language entity related logic defination
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             09-05-2017
 * @Last Modified       09-05-2017
 * @Last Modified By    Sridevi Gara
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH . 'libraries/REST_Controller.php');

class Configuration extends REST_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function language_get() {
        $this->load->library('form_validation');
        $name = $this->get('name');
        $inputData['name'] = $name;
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules('limit', 'Limit', 'trim|alpha_dash');

        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->form_validation->error_array();
            $output['statusCode'] = STATUS_BAD_REQUEST;
            $this->response($output, $output['statusCode']);
        }
        try {
            $languageData = array();
            if (in_array($name, $this->config->item("mobile_languages"))) {
                $this->lang->load($name, 'mobile');
                $languageData = $this->lang->line('MOBILE_DATA', FALSE);
            }
        } catch (exception $e) {
            
        }
        $output['status'] = TRUE;
        $output['response'] = $languageData;
        $output['statusCode'] = STATUS_OK;
        $this->response($output, $output['statusCode']);
    }

    public function mobileInitialize_get() {
        $siteUrl = site_url();
        $responseData["language"][] = $siteUrl . "api/mobile/v1/language";
        $responseData["mlanguage"][] = $siteUrl . "api/mobile/v1/configuration/language?name=english";
        $responseData["mlanguage"][] = $siteUrl . "api/mobile/v1/configuration/language?name=hindi";
        $responseData["primaryAssessment"][] = $siteUrl . "api/mobile/v1/primaryAssessment";
        $responseData["chiefComplaints"][] = $siteUrl . "api/mobile/v1/chiefComplaint?id=2";
        $responseData["chiefComplaints"][] = $siteUrl . "api/mobile/v1/chiefComplaint?id=3";
        $responseData["chiefComplaints"][] = $siteUrl . "api/mobile/v1/chiefComplaint?id=4";
        $responseData["followups"][] = $siteUrl . "api/mobile/v1/chiefComplaint/followup?id=5";
        $responseData["followups"][] = $siteUrl . "api/mobile/v1/chiefComplaint/followup?id=6";
        $responseData["followups"][] = $siteUrl . "api/mobile/v1/chiefComplaint/followup?id=7";
        $responseData["networkHospitals"][] = $siteUrl . "api/mobile/v1/networkHospital";

        $output['status'] = TRUE;
        $output['response']['apiData'] = $responseData;
        $output['statusCode'] = STATUS_OK;
        $this->response($output, $output['statusCode']);
    }

	public function synchronizeData_post() {
		$bcpId = $this->post('bcpId');
		$medicalRecordData = $this->post('medicalRecord');
		$medicalRecordDetail = $this->post('medicalRecordDetail');
		$updateTimeStamp = date("d-m-YY_h_i_s");
		if($bcpId > 0) {
			if(strlen($medicalRecordData) > 2) {
			$myfile = fopen("application/synchData/BCP_".$bcpId."_medicalRecord_".$updateTimeStamp.".json", "w+");
			$txt = "";
			$txt = $medicalRecordData;
			fwrite($myfile, $txt);
			fclose($myfile);
			}
			if(strlen($medicalRecordDetail) > 2) {
			$myfile = fopen("application/synchData/BCP_".$bcpId."_medicalRecordDetail_".$updateTimeStamp.".json", "w+");
			$txt = "";
			$txt = $medicalRecordDetail;
			fwrite($myfile, $txt);
			fclose($myfile);
			}
			return true;
		}
		return false;
		
	}
	
}

?>
