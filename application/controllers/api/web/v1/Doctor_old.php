<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/User_handler.php');
require_once (APPPATH . 'handlers/Patient_handler.php');
require_once (APPPATH . 'handlers/Medicalincident_handler.php');
require_once (APPPATH . 'handlers/Doctor_handler.php');
require_once (APPPATH . 'handlers/Reports_handler.php');

class Doctor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->ci = & get_instance();
        $responseArray = userLoginCheck();
        //print_r($responseArray);exit;
        if ($responseArray['status'] != 1) {
            
            if ($responseArray['response']['total'] == 0) {
 
                  getUrl('doctorLogin');
            }
        }else{
             if($responseArray['response']['sessionData']['userrole']=='admin'){
                 
                  redirect(getUrl('Dashboard')) ;
             }else if($responseArray['response']['sessionData']['userrole']=='doctor'){
                  
                   getUrl('doctorDashboard') ;
             }
            
        }
        
        $this->userHandler = new User_handler();
        $this->patientHandler = new Patient_handler();
        $this->medicalincidentHandler = new Medicalincident_handler();
        $this->doctorHandler = new Doctor_handler();
        $this->Reportshandler = new Reports_handler(); 
    }

    // Index page  
    public function Index() {
        
        $data['page_title'] ="Login";
        $data['content'] = 'doctor/doc_login';
        $template = 'templates/doctor_login_template';
        $this->load->view($template, $data);
    }

    //Login page function
    public function Login() {
           
        
        $inputData = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'language' => '',
            'userrole' => 'doctor',
            'deviceId' => '',
            'osType'   => '',
            'osVersion'=> '' ,
            'type'=>WEB_TYPE ,
           );
            
           $errors =array();
           $this->ci->form_validation->set_data($inputData);
           $this->ci->form_validation->set_rules($this->config->item('doctorLoginRules'));
            
            if ($this->ci->form_validation->run() == FALSE) {
                $errors['msg'] =  $this->ci->form_validation->error_array();
                $errors['status']=0;
                echo json_encode($errors);
            }else{
            $hff_media_path =   $this->config->item('hff_media_path');
            $responseArray = $this->userHandler->doctorLogin($inputData,$hff_media_path);
            if ($responseArray['status'] != 1) {
                if ($responseArray['response']['userData'] != '') {
                    $errors['msg'] =  $responseArray['response']['messages'];
                    $errors['status']= 0;
                 }
                 }else{
                 $errors['msg'] =  $responseArray['response']['messages'];
                 $errors['status']=1;
                }
                echo json_encode($errors);
            }
            
         
       
        
    }
 //forgotpassword function
    public function forgotpassword() {

        $data['page_title'] ="Forgotpassword";
        $data['content'] = 'doctor/doc_password';
        $template = 'templates/doctor_login_template';
        $this->load->view($template, $data);
        
    }
    public function sendotp(){
         
            $inputData = array(
                'inputVal' => trim($this->input->post('mobile'))
            );
            $inputValType = "";
            $this->ci->form_validation->set_data($inputData);
            if (is_numeric($inputData['inputVal'])) {
                $inputValType = "mobile";
                $this->ci->form_validation->set_rules($this->config->item('forgotPasswordMobileRules'));
            } else {
                $inputValType = "email";
                $this->ci->form_validation->set_rules($this->config->item('forgotPasswordUsernameRules'));
            }

            if ($this->ci->form_validation->run() == FALSE) {
                $output['status'] = FALSE;
                $output['messages'] = $this->ci->form_validation->error_array();
                echo  json_encode($output);
               
            }else{

                $responseArray = $this->userHandler->checkUserExists($inputData, $inputValType);
                echo  json_encode($responseArray);
            }
    }
    public function otpChangepassword(){
         
         $inputData = array(
            'otpCode' => $this->input->post('otp'),
            'newPassword' => $this->input->post('newpassword'),
            'confirmPassword' => $this->input->post('confirmpassword'),
            'username' => $this->input->post('username'),
        );
        
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('validateOtpRules'));
        if ($this->ci->form_validation->run() == FALSE) {
           $output['status'] = FALSE;
                $output['messages'] = $this->ci->form_validation->error_array();
                echo  json_encode($output);
        }
        $responseArray = $this->userHandler->validateOtp($inputData);
        echo json_encode($responseArray);
    }
    //Leading page function
    public function Home() {
       $responseArray = userLoginCheck();
       
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        
       $data['page_title']='Doctor Dashboard';
        $data['content'] = 'doctor/doc_landing';
        $data['page'] = 'landing';
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
        
        //$data['page_title']='Doctor Dashboard';
//        $data['page']='landing';
//        $this->load->view('doctor/doc_landing', $data);
    }

    // Visited Medical Record display page function	
    public function Mrdetails() {

        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $data['page_title'] = "Medical Record";
        $data['page_current'] = "medical_record";
        
        $inputData['patient_id'] = $this->input->get('pid');
        if(empty($inputData['patient_id'])){
            $inputData['patient_id'] = $this->input->post('pid');
        }
        
        $inputData['visit_id'] = $this->input->get('vid');
        $inputData['records'] = '5';
        $inputData['offset'] = 0;

        $patientData = $this->medicalincidentHandler->getMedicalIncidentVisitDetails($inputData);
        
        if ($patientData['statusCode'] == 200) {
            //echo '<pre>'; print_r($patientData['response']['medicalIncidentVisitData']); echo '</pre>';
            $data['imgpath'] = $this->config->item('hff_media_path');
            $data['pdetails'] = $patientData['response']['patientData'][0];
            $data['userdata'] = $patientData['response']['userData'][0];
            $data['mivdata'] = $patientData['response']['medicalIncidentVisitData'];
//            $data['presc_options'] = $patientData['response']['presc_option_ids'];
            $data['visitid'] = $this->input->get('vid');
            $data['message'] = '';
        } else {
            $data['pdetails'] = '';
            $data['userdata'] = '';
            $data['mivdata'] = '';
            $data['message'] = STATUS_NO_DATA;
//            $data['message'] = $patientData['response']['message'];
        }
//        debugArray($data); exit;
        $data['content'] = "doctor/doc_mr_number.php";
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
    }

    //Medical Records List page function

    public function MedicalRecord() {
        
       $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 

        $data['page_title'] = "Medical Records";
        $data['page_current'] = "medical_record";
        $userid=$this->ci->session->userid;
        $inputData['medicalIncident'] = $userid;
        $inputData['records'] = '';
        $inputData['offset'] = 0;
        $inputData['search'] = '';

        $medicalArray = $this->medicalincidentHandler->getMedicalIncidentVisits($inputData);
        if(!isset($medicalArray['response']['medicalIncidentVisitData'])){
            $medicalArray['response']['medicalIncidentVisitData']   =   null;
        }
        $data['medicallist'] = $medicalArray['response']['medicalIncidentVisitData'];

        $data['content'] = "doctor/doc_medical_records.php";
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
    }

    //Prescription list function
    public function Prescription() {
       
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $this->doctorHandler = new Doctor_handler();
        $data['page_title'] = "Send Prescription";
//        $data['page_current'] = "Medical Records";

        $inputData['records'] = '';
        $inputData['offset'] = 0;
        $inputData['search'] = '';

        $prescriptionRequests = $this->doctorHandler->getPrescriptionRequests($inputData);
        
        if(isset($prescriptionRequests['response']['requests'])){
            $data['requests'] = $prescriptionRequests['response']['requests'];
        }else{
            $data['requests'] = '';
        }

        $data['content'] = "doctor/doc_prescription_requests.php";
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
    }

    //BCP profile page function

    public function bcpProfile() {

        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
       // $userid=$this->ci->session->userid;
        $bcpid = $this->input->get('bid');
        //$role='bcp';
        $data['page_title'] = "BCP Profile";
        $data['page_current'] = "profile_record";
        $doctorArray = $this->userHandler->getUserProfile($bcpid,'');
        $data['imgpath'] = $this->config->item('hff_media_path');
        $data['bid']=$bcpid;
        $data['profileData'] = $doctorArray['response']['userData'];
        $data['Mrcount']=$this->doctorHandler->getBcpStatistics($bcpid);
//        $result = $this->Reportshandler->getAllReports($bcpid);
        //print_r($data);exit;
        $data['content'] = "doctor/doc_bcp_profile.php";
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
    }

    //Login user or doctor profile page function
    public function Profile() {

        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
       // $userid = $this->session->userdata('userid');
        $userid=$this->ci->session->userid;
        $data['page_title'] = "Doctor Profile";
        $data['page_current'] = "profile_record";
        $doctorArray = $this->userHandler->getDoctorProfile($userid, '');
        $data['imgpath'] = $this->config->item('hff_media_path');
        $data['userid'] = $userid;
        $data['profileData'] = $doctorArray;
        $data['content'] = "doctor/doc_doc_profile.php";
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
    }

   

    //Login user or doctor edit profile page function
    public function EditProfile() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $userid=$this->ci->session->userid;

        $data['page_title'] = "Doctor Edit Profile";
        $data['page_current'] = "medical_record";
        $doctorArray = $this->userHandler->getDoctorProfile($userid, '');
        $data['imgpath'] = $this->config->item('hff_media_path');
        $data['userid'] = $userid;
        $data['profileData'] = $doctorArray;
        $data['content'] = "doctor/doc_edit_profile.php";
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
    }
    
    public function updateDocProfile(){
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $userid=$this->ci->session->userid;
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
                'role'=>$this->input->post('role'),
                'userId' => $userid
            );
           //print_r($inputData);
            
            if (isset($_FILES['profilePicture']) && !empty($_FILES['profilePicture'])) {  
              $profileresArray =  uploadImage($_FILES['profilePicture']);
              if($profileresArray['status']==1){
                 $inputData['profilePicture'] = $profileresArray['response']['imagename']; 
              }
         }else{
            
              $inputData['profilePicture']='';
        }
        
        if (isset($_FILES['signaturePicture']) && !empty($_FILES['signaturePicture'])) {
             $signresarray =  uploadImage($_FILES['signaturePicture']);
             if($signresarray['status']==1){
               $inputData['signaturePicture'] =$signresarray['response']['imagename'];
             }
            
        }else{
            $inputData['signaturePicture'] ='';
        }
         // print_r($inputData);
          
          
            $this->ci->form_validation->set_data($inputData);
            $this->ci->form_validation->set_rules($this->config->item('doctorProfileUpdateRules'));
            if ($this->ci->form_validation->run() == FALSE) {
                $errors['error'] =  $this->ci->form_validation->error_array();
                $errors['status']=0;
                echo json_encode($errors);

            } else {
                $responseArray = $this->doctorHandler->updateDoctorProfile($inputData);
                echo json_encode($responseArray);
            }

    }

    //Change password function	
    public function changePassword() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $userid = $this->session->userdata('userid');
        $inputData = array(
            'curPassword' => $this->input->post('otp'),
            'newPassword' => $this->input->post('newpassword'),
            'confirmPassword' => $this->input->post('confirmpassword'),
            'userId' => $userid,
        );
        print_r($inputData);
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('changePasswordRules'));
        if ($this->ci->form_validation->run() == FALSE) {
           $errors['error'] =  $this->ci->form_validation->error_array();
                $errors['status']=0;
                echo json_encode($errors);
        }
       
        $responseArray = $this->userHandler->changePassword($inputData);
        $this->session->set_flashdata('message', $responseArray['response']['messages'][0]);
        //redirect(site_url() . 'doctor/Profile');
        redirect(getUrl('doctorProfile'));
    }

   

    //Logout function
    public function Logout() { 
        $url = getUrl('doctorLogin');
        logout();
        redirect( $url);
    }
    
    public function getPrePrescriptionData() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id']   =   $presc_id;
        $inputData['type']   =   0;
        $hff_media_path =   $this->config->item('hff_media_path');
        
        $this->doctorHandler = new Doctor_handler();
        $prescription_details = $this->doctorHandler->getPrePrescriptionDetails($inputData,$hff_media_path);
        $data['doctor_details']     =   $prescription_details['response']['doctorDetails'][0];
        $data['bcp_details']        =   $prescription_details['response']['bcpDetails'][0];
        $data['patient_details']    =   $prescription_details['response']['patientDetails'][0];
        $data['presc_details']      =   $prescription_details['response']['prescriptionDetails'][0];
        $data['catelog']      =   $this->getMedicineCatalog();
        
//        debugArray($data); exit;
        $prescription_popup =   $this->load->view('doctor/templates/prescription_popup', $data,true);
        $out    =   array('error' => 0, 'payload' => $prescription_popup);
        echo json_encode($out);
    }
    public function getPrePrescriptionDataForView() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        
        
        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id']   =   $presc_id;
        $inputData['type']   =   2;
        $hff_media_path =   $this->config->item('hff_media_path');
//        debugArray($inputData); exit;
        $this->doctorHandler = new Doctor_handler();
        $prescription_details = $this->doctorHandler->getPrePrescriptionDetails($inputData,$hff_media_path);
//        debugArray($prescription_details); exit;
        $prescription_popup =   '';
        if(isset($prescription_details['response']['prescriptionMedicine']) && $prescription_details['response']['prescriptionMedicine'] > 0){
            $data['doctor_details']     =   $prescription_details['response']['doctorDetails'][0];
            $data['bcp_details']        =   $prescription_details['response']['bcpDetails'][0];
            $data['patient_details']    =   $prescription_details['response']['patientDetails'][0];
            $data['presc_details']      =   $prescription_details['response']['prescriptionDetails'][0];
            
            $data['catelog']      =   $this->getMedicineCatalog();
            $data['medicine']      =   $prescription_details['response']['prescriptionMedicine'];
//            debugArray($data); exit;
            $prescription_popup_sent_medicine   =   '';
            foreach($prescription_details['response']['prescriptionMedicine'] as $medicine){
                    $prescription_popup_sent_medicine .=   $this->load->view('doctor/templates/prescription_sent_medicine', array('medicine' => $medicine),true);
            }
            $data['sent_medicine']      =   $prescription_popup_sent_medicine;
            $prescription_popup =   $this->load->view('doctor/templates/prescription_popup_view', $data,true);
        }
        
        
        
        $out    =   array('error' => 0, 'payload' => $prescription_popup);
        echo json_encode($out);
    }
    public function getPrePrescriptionDataForAdd() {
        
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        
        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id']   =   $presc_id;
        $inputData['type']   =   0;
        $hff_media_path =   $this->config->item('hff_media_path');
        
        $this->doctorHandler = new Doctor_handler();
        $prescription_details = $this->doctorHandler->getPrePrescriptionDetailsForAdd($inputData,$hff_media_path);
//        debugArray($prescription_details); exit;
        $data['doctor_details'] =   $prescription_details['docotrDetails'];
        $data['catelog']      =   $this->getMedicineCatalog();
        

        $prescription_popup =   $this->load->view('doctor/templates/prescription_popup_add', $data,true);
        
        $out    =   array('error' => 0, 'payload' => $prescription_popup);
        echo json_encode($out);
    }
    
    public function getAssignedBcpList() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $userid = $this->session->userdata('userid');

         
        $inputData['doc_id'] = $this->session->userdata('userid');
        
        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        $this->bcpAssignmentHandler = new Bcpassignment_handler();
        
        $bcp_data    =   $this->bcpAssignmentHandler->getDoctorAssignedBcps($inputData);
        
        
        $bcp_data['options'] = $bcp_data['response']['bcpList'];
        $bcp_options =   $this->load->view('doctor/templates/bcp_options', $bcp_data,true);
        
        $out    =   array('error' => 0,'payload' => $bcp_options);
        echo json_encode($out);
    }
    public function getAssignedPatients() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $userid = $this->session->userdata('userid');

        
        $bcpId = $this->input->post('id');
//        debugArray($bcpId); exit;
        
        $this->Medicalincident_handler = new Medicalincident_handler();
        
        $patient_data    =   $this->Medicalincident_handler->getPatientDetails('','','',$bcpId);
//        debugArray($patient_data); exit;
        
        $patient_data['options'] = $patient_data;
        $patinet_options =   $this->load->view('doctor/templates/patient_options', $patient_data,true);
        
        $out    =   array('error' => 0,'payload' => $patinet_options);
        echo json_encode($out);
    }
    public function getMedicineCatalog() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $userid = $this->session->userdata('userid');
        $search = $this->input->get('search');
        
        $inputData['search']   =   $search;
        $inputData['exp_days']  =  $this->config->item('medicine_expiry_days');
        $this->doctorHandler = new Doctor_handler();
        
        $medicine_catalog = $this->doctorHandler->getMedicineCatelog($inputData);
        $medicine_catelog_options   =   '';
        if(isset($medicine_catalog['response']['medicine_catelog']) && !empty($medicine_catalog['response']['medicine_catelog'])){
            $medicine_data['options'] = $medicine_catalog['response']['medicine_catelog'];
            $medicine_catelog_options =   $this->load->view('doctor/templates/medicine_catalog_options', $medicine_data,true);
        }
        
        
        return $medicine_catelog_options;
    }
    public function savePrescription() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $userid = $this->session->userdata('userid');
 
        $inputData  =   $this->input->post('data');
        $this->doctorHandler = new Doctor_handler();
        
        $ack = $this->doctorHandler->savePrescription($inputData);
        $out    =   array('error' => 0);
        echo json_encode($out);
    }
    public function addPrescription() {
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {

                redirect(getUrl('doctorLogin'));
            }
        } 
        $userid = $this->session->userdata('userid');
        $inputData['data']  =   $this->input->post('data');
        $inputData['header_data']  =   $this->input->post('header_data');
        $inputData['patient_data']  =   $this->input->post('patient_data');
        $this->doctorHandler = new Doctor_handler();
        
        $ack = $this->doctorHandler->addPrescription($inputData);
        $out    =   array('error' => 0);
        echo json_encode($out);
    }
    
    
    

}
 
