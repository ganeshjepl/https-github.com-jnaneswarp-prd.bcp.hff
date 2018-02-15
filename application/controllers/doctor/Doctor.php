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
        
        $excludeArray   =   array('doctorLogin','doctorForgotpassword');
        if(!in_array(end($this->uri->segments),$excludeArray)){
            $responseArray = userLoginCheck($type = 'html', $role = ROLE_DOCTOR);
        }
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->library('session');
        $this->userHandler = new User_handler();
        $this->patientHandler = new Patient_handler();
        $this->medicalincidentHandler = new Medicalincident_handler();
        $this->doctorHandler = new Doctor_handler();
        $this->Reportshandler = new Reports_handler(); 
        
    }

    // Index page  
    public function Index() {
        if(!empty($this->session->userdata('userid')) && $this->session->userdata('userrole') == ROLE_DOCTOR){
            redirect(getUrl('doctorDashboard'));
        }
        $data['page_title'] ="Login";
        $data['content'] = 'doctor/doc_login';
        $template = 'templates/doctor_login_template';
        $this->load->view($template, $data);
    }
        
                        
    //forgotpassword function
    public function forgotpassword() {

        $data['page_title'] ="Forgotpassword";
        $data['content'] = 'doctor/doc_password';
        $template = 'templates/doctor_login_template';
        $this->load->view($template, $data);
        
    }
    //Leading page function
    public function Home() {
        $data['page_title']='Doctor Dashboard';
        $data['content'] = 'doctor/doc_landing';
        $data['page'] = 'landing';
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
    }

    // Visited Medical Record display page function	
    public function Mrrecord() {

        $concat_string  =   '';
        $ret_url        =   'Mrrecord';
        if(!empty($this->input->get('page_id'))){
            $concat_string  =   '?page_id='.$this->input->get('page_id');
        }
        if(!empty($this->input->get('bpg'))){
                $ret_url  =  $this->input->get('bpg');
        }
        $title  =   'Medical Records';
        if(!empty($this->input->get('ptl'))){
                $title  =  $this->input->get('ptl');
        }
        
        $breadcrumb_links[]   =   array('title' => $title,'link' => getUrl($ret_url).$concat_string);
        
        $data['breadcrumbs'] = $breadcrumb_links;
        $data['tail'] = 'Details';
        
        $data['page_title'] = "Medical Records / Details";
        
        $data['page_current'] = "medical_record";
        
        $inputData['patient_id'] = $this->input->get('pid');
        if(empty($inputData['patient_id'])){
            $inputData['patient_id'] = $this->input->post('pid');
        }
        
        $inputData['visit_id'] = $this->input->get('vid');
        $inputData['records'] = '';
        $inputData['offset'] = 0;

        $patientData = $this->medicalincidentHandler->getMedicalIncidentVisitDetails($inputData);
        
        if ($patientData['statusCode'] == 200) {
            //echo '<pre>'; print_r($patientData['response']['medicalIncidentVisitData']); echo '</pre>';
            $data['imgpath'] = $this->config->item('hff_media_path');
            $data['pdetails'] = $patientData['response']['patientData'][0];
            $data['userdata'] = $patientData['response']['userData'][0];
//            $data['userdata'] = (isset($patientData['response']['userData'][0]))?$patientData['response']['userData'][0]:null;
            $data['mivdata'] = $patientData['response']['medicalIncidentVisitData'];
            $data['feedback_ids'] = $patientData['response']['feedback_ids'];
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
        
        $data['page_title'] = "Medical Records";
        $data['page_current'] = "medical_record";
        $data['page_id'] = $this->input->get('page_id');
        $userid=$this->session->userid;
        $inputData['medicalIncident'] = $userid;
        $inputData['records'] = '';
        $inputData['offset'] = 0;
        $inputData['search'] = '';

        $medicalArray = $this->medicalincidentHandler->getMedicalIncidentVisits($inputData);
        if(!isset($medicalArray['response']['medicalIncidentVisitData'])){
            $medicalArray['response']['medicalIncidentVisitData']   =   null;
        }
        $data['medicallist'] = $medicalArray['response']['medicalIncidentVisitData'];
//        debugArray($data); exit;
        $data['content'] = "doctor/doc_medical_records.php";
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
    }
    //Prescription list function
    public function Prescription() {
        $this->doctorHandler = new Doctor_handler();
        $data['page_id'] = $this->input->get('page_id');
        $data['page_title'] = "Prescription Requests";
        $data['back_page'] = "Prescription";
        $data['back_page_title'] = "Prescription Requests";
//        $data['page_current'] = "Medical Records";

        $inputData['records'] = '';
        $inputData['offset'] = 0;
        $inputData['search'] = '';
        
        $prescriptionRequests = $this->doctorHandler->getPrescriptionRequestsOffline($inputData);
        
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
         
       // $userid=$this->session->userid;
        $bcpid = $this->input->get('bid');
        $data['page_title'] = "BCP Profile";
        $data['page_current'] = "profile_record";
        $doctorArray = $this->userHandler->getUserProfile($bcpid,'');
        $data['imgpath'] = $this->config->item('hff_media_path');
        $data['bid']=$bcpid;
        $data['profileData'] = $doctorArray['response']['userData'];
        $data['Mrcount']=$this->doctorHandler->getBcpStatistics($bcpid);
        $chartData  =   null;
        if(!empty($data['Mrcount'])){
            foreach($data['Mrcount'] as $key => $val){
                $chartData[] = array(
                    'label' => $key,
                    'val'   => $val
                );
            }
        }
        $data['chartData']=$chartData;
//        $result = $this->Reportshandler->getAllReports($bcpid);
//        debugArray($data);exit;
        $data['content'] = "doctor/doc_bcp_profile.php";
        $template = 'templates/doctor_template';
        $this->load->view($template, $data);
    }
    //Login user or doctor profile page function
    public function Profile() {

        
        
       // $userid = $this->session->userdata('userid');
        $userid=$this->session->userid;
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
         
        $userid=$this->session->userid;

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

    //Logout function
  public function Logout( ) {
        $url = getUrl('doctorLogin');
        logout($type = WEB_TYPE);
        redirect($url);
    }
    public function getPrePrescriptionData() {
        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id']   =   $presc_id;
        $inputData['type']   =   0;
       
        $this->doctorHandler = new Doctor_handler();
        $prescription_details = $this->doctorHandler->getPrePrescriptionDetails($inputData);
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
        
        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id']   =   $presc_id;
        $inputData['type']   =   2;
        
//        debugArray($inputData); exit;
        $this->doctorHandler = new Doctor_handler();
        $prescription_details = $this->doctorHandler->getPrePrescriptionDetails($inputData);
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
        
        $userid = $this->session->userdata('userid');
        $presc_id = $this->input->get('id');
        $inputData['prescription_id']   =   $presc_id;
        $inputData['type']   =   0;
        
        $this->doctorHandler = new Doctor_handler();
        $prescription_details = $this->doctorHandler->getPrePrescriptionDetailsForAdd($inputData);
//        debugArray($prescription_details); exit;
        $data['doctor_details'] =   $prescription_details['docotrDetails'];
        $data['catelog']      =   $this->getMedicineCatalog();
        

        $prescription_popup =   $this->load->view('doctor/templates/prescription_popup_add', $data,true);
        
        $out    =   array('error' => 0, 'payload' => $prescription_popup);
        echo json_encode($out);
    }
    public function getAssignedBcpList() {
         
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
         
        $userid = $this->session->userdata('userid');

        
        $bcpId = $this->input->post('id');
//        debugArray($bcpId); exit;
        
        $this->Medicalincident_handler = new Medicalincident_handler();
        
        $patient_data    =   $this->Medicalincident_handler->getPatientDetails('','',$bcpId);
//        debugArray($patient_data); exit;
        
        $patient_data['options'] = $patient_data;
        $patinet_options =   $this->load->view('doctor/templates/patient_options', $patient_data,true);
        
        $out    =   array('error' => 0,'payload' => $patinet_options);
        echo json_encode($out);
    }
    public function getMedicineCatalog() {
         
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
         
        $userid = $this->session->userdata('userid');
 
        $inputData  =   $this->input->post('data');
        $this->doctorHandler = new Doctor_handler();
        
        $ack = $this->doctorHandler->savePrescription($inputData);
        $out    =   array('error' => 0);
        echo json_encode($out);
    }
    public function addPrescription() {
         
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
