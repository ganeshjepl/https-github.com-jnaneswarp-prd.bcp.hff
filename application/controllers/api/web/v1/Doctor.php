<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/Doctor_handler.php');
require_once (APPPATH . 'libraries/REST_Controller.php');

class Doctor extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $responseArray = userLoginCheck(); 
//        if ($responseArray['response']['sessionData']['userrole'] == 'admin') {
//
//            redirect(getUrl('Dashboard'));
//        } else if ($responseArray['response']['sessionData']['userrole'] == 'doctor') {
//
//            getUrl('doctorDashboard');
//        }
         
        $this->doctorHandler = new Doctor_handler();
    }

    //Login page function
    public function Login_post() {

        $inputData = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'language' => '',
            'userrole' => ROLE_DOCTOR,
            'deviceId' => '',
            'osType' => '',
            'osVersion' => '',
            'type' => WEB_TYPE,
        );

        $errors = array();
        $this->form_validation->reset_validation();
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('doctorLoginRules'));
        $output = array();

        if ($this->form_validation->run() == FALSE) {
            //$errors['msg'] =  $this->form_validation->error_array();
            $output['response']['messages'][] = $this->form_validation->error_array();
            $output['status'] = FALSE;
            $output['statusCode'] = STATUS_BAD_REQUEST;
        } else {

            require_once (APPPATH . 'handlers/User_handler.php');
            $this->userHandler = new User_handler();
            $responseArray = $this->userHandler->doctorLogin($inputData);

            if ($responseArray['status'] != 1) {
                if ($responseArray['response']['total'] == 0) {
                    $output['response']['messages'][] = $responseArray['response']['messages'];
                    $output['status'] = FALSE;
                    $output['statusCode'] = 200;
                }
            } else {

                $output['response']['messages'][] = $responseArray['response']['messages'];
                $output['status'] = TRUE;
                $output['statusCode'] = STATUS_OK;
            }
        }
//			$output['response'] = array();
//        debugArray($output); exit;
        $this->response($output, $output['statusCode']);
    }

    public function sendotp_post() {
           require_once (APPPATH . 'handlers/User_handler.php');
            $this->userHandler = new User_handler();
        $inputData = array(
            'inputVal' => trim($this->input->post('mobile'))
        );
        $inputValType = "";

        $this->form_validation->reset_validation();
        $this->form_validation->set_data($inputData);
        if (is_numeric($inputData['inputVal'])) {
            $inputValType = "mobile";
            $this->form_validation->set_rules($this->config->item('forgotPasswordMobileRules'));
        } else {
            $inputValType = "email";
            $this->form_validation->set_rules($this->config->item('forgotPasswordUsernameRules'));
        }

        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response'] = array();
            $output['response']['messages'][] = $this->form_validation->error_array();
            $output['statusCode'] = STATUS_BAD_REQUEST;
        } else {

           // $responseArray = $this->userHandler->checkUserExists($inputData, $inputValType);
            $responseArray = $this->userHandler->sendOTP($inputData, $inputValType);
            $output['status'] = TRUE;
            $output['response'] = $responseArray;
            $output['statusCode'] = STATUS_OK;
        }

        $this->response($responseArray, $output['statusCode']);
    }

    public function otpChangepassword_post() {

        $inputData = array(
            'otpCode' => $this->input->post('otp'),
            'newPassword' => $this->input->post('newpassword'),
            'confirmPassword' => $this->input->post('confirmpassword'),
            'username' => $this->input->post('username'),
        );
        $this->form_validation->reset_validation();
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('validateOtpRules'));
        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response'] = array();
            $output['response']['messages'][] = $this->form_validation->error_array();
            $output['statusCode'] = STATUS_BAD_REQUEST;
        } else {
            require_once (APPPATH . 'handlers/User_handler.php');
            $this->userHandler = new User_handler();
            $responseArray = $this->userHandler->validateOtp($inputData);
            $output['status'] = TRUE;
            $output['response'] = $responseArray;
            $output['statusCode'] = STATUS_OK;
        }
        $this->response($output, $output['statusCode']);
    }

    public function updateDocProfile_post() {

        $userid = $this->session->userid;
        $inputData = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'email' => $this->input->post('email'),
            'countryid' => $this->input->post('countryid'),
            'stateid' => $this->input->post('stateid'),
            'cityid' => $this->input->post('cityid'),
            'mobile' => $this->input->post('mobile'),
            'alternatecontact' => $this->input->post('alternatecontact'),
            'date_of_birth' => $this->input->post('dob'),
            'gender' => $this->input->post('gender'),
            'education' => $this->input->post('education'),
            'role' => $this->input->post('role'),
            'userId' => $userid
        );
        $this->form_validation->reset_validation();
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('doctorProfileUpdateRules'));
        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response'] = array();
            $output['response']['messages'][] = $this->form_validation->error_array();
            $output['statusCode'] = STATUS_BAD_REQUEST;
        } else {
            if (isset($_FILES['profilePicture']) && !empty($_FILES['profilePicture'])) {
                $profileresArray = uploadImage($_FILES['profilePicture'], $type="profile");
                if ($profileresArray['status'] == 1) {
                    $inputData['profilePicture'] = $profileresArray['response']['imagename'];
                }
            } else {

                $inputData['profilePicture'] = '';
            }

            if (isset($_FILES['signaturePicture']) && !empty($_FILES['signaturePicture'])) {
                $signresarray = uploadImage($_FILES['signaturePicture'], $type="signature");
                if ($signresarray['status'] == 1) {
                    $inputData['signaturePicture'] = $signresarray['response']['imagename'];
                }
            } else {
                $inputData['signaturePicture'] = '';
            }

            $responseArray = $this->doctorHandler->updateDoctorProfile($inputData);
            if($responseArray['status']==true){
                $output['status'] = TRUE;
                $output['response'] = $responseArray['response'];
                $output['statusCode'] = STATUS_OK;
            }
            else{
            $output['status'] = FALSE;
            $output['response'] = $this->lang->line('error_profile_update_failed') ;;
            $output['statusCode'] = STATUS_BAD_REQUEST;
            }
        }
        $this->response($output, $output['statusCode']);
    }

    //Change password function	
    public function changePassword_post() {

        $userid = $this->session->userdata('userid');
        $inputData = array(
            'oldPassword' => $this->input->post('otp'),
            'newPassword' => $this->input->post('newpassword'),
            'confirmPassword' => $this->input->post('confirmpassword'),
            'userId' => $userid,
        );
        $this->form_validation->reset_validation();
        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('changePasswordRules'));
        if ($this->form_validation->run() == FALSE) {
            $output['status'] = FALSE;
            $output['response'] = array();
            $output['response']['messages'][] = $this->form_validation->error_array();
            $output['statusCode'] = STATUS_BAD_REQUEST;
        } else {

            require_once (APPPATH . 'handlers/User_handler.php');
            $this->userHandler = new User_handler();
            $responseArray = $this->userHandler->changePassword($inputData);
            //$this->session->set_flashdata('message', $responseArray['response']['messages'][0]);
            if($responseArray['status']==true){
                $output['status'] = TRUE;
                $output['response'] = $responseArray['response'];
                $output['statusCode'] = STATUS_OK;
            }
            else{
                $output['status'] = FALSE;
                $output['response'] =$responseArray['response']['messages'] ;
                $output['statusCode'] = STATUS_OK;
            }
        }
        $this->response($output, $output['statusCode']);
    }

    //Logout function
    public function Logout_get($responseType = "json") {
        if ($responseType == "json") {
            logout();
            $output['status'] = TRUE;
            $output['response'] = array();
            $output['statusCode'] = STATUS_OK;
            $this->response($output, $output['statusCode']);
        } else {
            $url = getUrl('doctorLogin');
            logout();
            redirect($url);
        }
    }
	public function newPrescriptionVideoDetail_get() {

        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id'] = $presc_id;
        $inputData['type'] = 0;
        $data = array();
		$prescription_popup = $this->load->view('doctor/templates/prescription_video_popup', $data, true);
        $out = array('error' => 0, 'payload' => $prescription_popup);
        echo json_encode($out);
    }

    public function newPrescriptionDetail_get() {

        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id'] = $presc_id;
        $inputData['type'] = 0;
        $this->doctorHandler = new Doctor_handler();
        $prescription_details = $this->doctorHandler->getPrePrescriptionDetails($inputData);
        
        $data['doctor_details'] = $prescription_details['response']['doctorDetails'][0];
        $data['bcp_details'] = $prescription_details['response']['bcpDetails'][0];
        $data['patient_details'] = $prescription_details['response']['patientDetails'][0];
        $data['presc_details'] = $prescription_details['response']['prescriptionDetails'][0];
        $data['medical_notes'] = $prescription_details['response']['medicalNotes'];
        $data['catelog'] = $this->getMedicineCatalog();

//        debugArray($data); exit;
        $prescription_popup = $this->load->view('doctor/templates/prescription_popup', $data, true);
        $out = array('error' => 0, 'payload' => $prescription_popup);
        echo json_encode($out);
    }

    public function prescriptionDetail_get() {
        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id'] = $presc_id;
        $inputData['type'] = 2;
//        debugArray($inputData); exit;
        $this->doctorHandler = new Doctor_handler();
        $prescription_details = $this->doctorHandler->getPrePrescriptionDetails($inputData);
//        debugArray($prescription_details); exit;
        $prescription_popup = '';
        if (isset($prescription_details['response']['prescriptionMedicine']) && $prescription_details['response']['prescriptionMedicine'] > 0) {
            $data['doctor_details'] = $prescription_details['response']['doctorDetails'][0];
            $data['bcp_details'] = $prescription_details['response']['bcpDetails'][0];
            $data['patient_details'] = $prescription_details['response']['patientDetails'][0];
            $data['presc_details'] = $prescription_details['response']['prescriptionDetails'][0];

            $data['catelog'] = $this->getMedicineCatalog();
            $data['medicine'] = $prescription_details['response']['prescriptionMedicine'];
            $data['medical_notes'] = $prescription_details['response']['medicalNotes'];
//            debugArray($data); exit;
            $prescription_popup_sent_medicine = '';
//            debugArray($prescription_details['response']['prescriptionMedicine']); exit;
            foreach ($prescription_details['response']['prescriptionMedicine'] as $medicine) {
                $prescription_popup_sent_medicine .= $this->load->view('doctor/templates/prescription_sent_medicine', array('medicine' => $medicine), true);
            }
            $data['sent_medicine'] = $prescription_popup_sent_medicine;
             
            $prescription_popup = $this->load->view('doctor/templates/prescription_popup_view', $data, true);
        }



        $out = array('error' => 0, 'payload' => $prescription_popup);
        echo json_encode($out);
    }

    public function prescriptionRequestFromDoctor_get() {


        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id'] = $presc_id;
        $inputData['type'] = 0;

        $this->doctorHandler = new Doctor_handler();
        $prescription_details = $this->doctorHandler->getPrePrescriptionDetailsForAdd($inputData);
//        debugArray($prescription_details); exit;
        $data['doctor_details'] = $prescription_details['docotrDetails'];
        $data['catelog'] = $this->getMedicineCatalog();


        $prescription_popup = $this->load->view('doctor/templates/prescription_popup_add', $data, true);

        $out = array('error' => 0, 'payload' => $prescription_popup);
        echo json_encode($out);
    }

    public function assignedBcpList_get() {

        $userid = $this->session->userdata('userid');


        $inputData['doc_id'] = $this->session->userdata('userid');

        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        $this->bcpAssignmentHandler = new Bcpassignment_handler();

        $bcp_data = $this->bcpAssignmentHandler->getDoctorAssignedBcps($inputData);


        $bcp_data['options'] = $bcp_data['response']['bcpList'];
        $bcp_options = $this->load->view('doctor/templates/bcp_options', $bcp_data, true);

        $out = array('error' => 0, 'payload' => $bcp_options);
        echo json_encode($out);
    }

    public function bcpMedicalRecords_get() {

        $userid = $this->session->userdata('userid');
        $bcpId = $this->input->get('id');
        require_once (APPPATH . 'handlers/Medicalincident_handler.php');

        $this->Medicalincident_handler = new Medicalincident_handler();

        $patient_data = $this->Medicalincident_handler->getPatientDetails('', '', $bcpId);
        $patient_data['options'] = $patient_data;
        $patinet_options = $this->load->view('doctor/templates/patient_options', $patient_data, true);

        $output['status'] = TRUE;
        $output['response']['payload'] = $patinet_options;
        $output['statusCode'] = STATUS_OK;
        $output['response']['messages'][] = "";
        $this->response($output, $output['statusCode']);
    }

    public function getMedicineCatalog() {

        $userid = $this->session->userdata('userid');
        $search = $this->input->get('search');

        $inputData['search'] = $search;
        $inputData['exp_days'] = $this->config->item('medicine_expiry_days');
        $this->doctorHandler = new Doctor_handler();

        $medicine_catalog = $this->doctorHandler->getMedicineCatelog($inputData);
        $medicine_catelog_options = '';
        if (isset($medicine_catalog['response']['medicine_catelog']) && !empty($medicine_catalog['response']['medicine_catelog'])) {
            $medicine_data['options'] = $medicine_catalog['response']['medicine_catelog'];
            $medicine_catelog_options = $this->load->view('doctor/templates/medicine_catalog_options', $medicine_data, true);
        }


        return $medicine_catelog_options;
    }

    public function prescriptionDetail_post() {

        $userid = $this->session->userdata('userid');

        $inputData = $this->input->post('data');
        $this->doctorHandler = new Doctor_handler();

        $ack = $this->doctorHandler->savePrescription($inputData);
        $out = array('error' => 0);
        echo json_encode($out);
    }

    public function prescriptionRequestFromDoctor_post() {

        $userid = $this->session->userdata('userid');
        $inputData['data'] = $this->input->post('data');
        $inputData['header_data'] = $this->input->post('header_data');
        $inputData['patient_data'] = $this->input->post('patient_data');
        $this->doctorHandler = new Doctor_handler();

        $ack = $this->doctorHandler->addPrescription($inputData);
        $out = array('error' => 0);
        echo json_encode($out);
    }
    public function doctorFeedback_post(){
        require_once (APPPATH . 'handlers/Doctorfeedback_handler.php');
        $this->doctorFeedbackHandler = new DoctorFeedback_handler();
        $userId = $this->session->userid;

        $inputData = $this->post();
        $inputData['user_id']   =   $userId;

        $this->form_validation->set_data($inputData);
        $this->form_validation->set_rules($this->config->item('doctorFeeebackRules'));

        if ($this->form_validation->run() == FALSE) {
            $ret    =   array('status' => FALSE,'status_code' => STATUS_BAD_REQUEST);
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->form_validation->error_array();
            $statusCode = STATUS_BAD_REQUEST;
            $output['statusCode'] = $statusCode;
            echo json_encode($output);
        }else{
//            debugArray($inputData); exit;
            $output = $this->doctorFeedbackHandler->saveDoctorFeedback($inputData);
            $output['status'] = TRUE;
            echo json_encode($output);
        }

        
        
         
    }
    public function fetchPrescriptionrequests_GET(){
        
        $this->doctorHandler = new Doctor_handler();
        $inputData['records'] = $this->get('limit');
            
            if(empty($inputData['records'])){
                $inputData['records'] = $this->config->item('pagination_default');
            }
            if($inputData['records'] > $this->config->item('pagination_max')){
                $inputData['records'] = $this->config->item('pagination_max');
            }
            if($this->get('page') <= 1){
                $inputData['offset']    =   0;
            }else{
                $inputData['offset']    =   ($this->get('page')-1)*$inputData['records'];
            }
        $inputData['search'] = $this->get('search');    
        
        $prescriptionRequests = $this->doctorHandler->getPrescriptionRequests($inputData);
        
        if(isset($prescriptionRequests['response']['requests'])){
            $data['requests'] = $prescriptionRequests['response']['requests'];
            $push_data  =   array();
            $i=1;
            foreach($prescriptionRequests['response']['requests'] as $request){
                
                if(!$request['is_sent']){
                    $button = '<button class="btn editbutton " type="button" data-toggle="modal" data-target="#mrprescription1"><a onclick="doctor.getPrescriptionPopup('.$request['id'].')">Prescription Sent</a></button>';
                }else{
                    $button = '<button class="btn editbutton " disabled="" type="button" data-toggle="modal" data-target="#mrprescription1"><a onclick="doctor.getPrescriptionPopup('.$request['id'].')">Prescription Sent</a></button>';
                }
                $push_data[]    =   array($i,$request['mrnumber'],$request['firstName'],$request['registration_date'],$button);
                $i++;
            }
        }else{
            $data['requests'] = '';
        }
        
        $output =   array(
            'draw'  =>  $this->get('page'),
            'recordsTotal'  =>  $prescriptionRequests['response']['total'],
            'recordsFiltered'  =>  $prescriptionRequests['response']['total'],
            'data'  =>  $push_data,
        );
        
        echo json_encode($output);
         
    }
    

}
