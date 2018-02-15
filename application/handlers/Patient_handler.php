<?php

/* patient related business logic defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       29-05-2017
 * @Last Modified By    shivajyothi
 */
require_once (APPPATH . 'handlers/handler.php');

class Patient_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Patient_model');
    }

    public function getPatientDetails($patientId, $medicalRegistration = "") {
        //print_r($medicalRegistration);exit;
        
        $this->ci->Patient_model->resetVariable();
        $selectInput = array();
        $PatientData = array();
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
        //$selectInput['caste'] = $this->ci->Patient_model->caste;
        $selectInput['guardianName'] = $this->ci->Patient_model->guardianName;
        $selectInput['guardianRelation'] = $this->ci->Patient_model->guardianRelation;
        $selectInput['maritalStatus'] = $this->ci->Patient_model->maritalStatus;
        $selectInput['occupation'] = $this->ci->Patient_model->occupation;
        $selectInput['education'] = $this->ci->Patient_model->education;
        $selectInput['contactNumber'] = $this->ci->Patient_model->contactNumber;
        $selectInput['emergencyContactNumber'] = $this->ci->Patient_model->emergencyContactNumber;
        $selectInput['address'] = $this->ci->Patient_model->address;
        $selectInput['houseNo'] = $this->ci->Patient_model->houseNo;
        $selectInput['block'] = $this->ci->Patient_model->block;
        $selectInput['streetName'] = $this->ci->Patient_model->streetName;
        $selectInput['area'] = $this->ci->Patient_model->area;
        $this->ci->Patient_model->setSelect($selectInput);
        $where[$this->ci->Patient_model->deleted] = 0;
        $where[$this->ci->Patient_model->status] = 1;
        if ($patientId != '') {
            $where[$this->ci->Patient_model->id] = $patientId;
        }if ($medicalRegistration != '') {
            $where[$this->ci->Patient_model->medicalRegistrationNumber] = $medicalRegistration;
        }
        $this->ci->Patient_model->setWhere($where);
        $this->ci->Patient_model->setRecords(1);
        $patientData = $this->ci->Patient_model->get();
        
        ///$hff_media_path = $this->ci->config->item('hff_media_path');
        $hff_media_profile_image_path_read = $this->ci->config->item('hff_media_profile_image_path_read');
        $hff_media_profile_image_default_path_read = $this->ci->config->item('hff_media_profile_image_default_path_read');
        
        for($i=0; $i<count($patientData); $i++){
                        
            $final_profile_picture = "";
            if (isset($patientData[$i]['profilePicture']) && $patientData[$i]['profilePicture'] != "") {
                $profile_picture = $hff_media_profile_image_path_read . $patientData[$i]['profilePicture']; 
                ///$final_profile_picture = checkImageByURL($profile_picture);
                $final_profile_picture = $profile_picture;   
            } 

            if ($final_profile_picture == "") {
                if ($patientData[$i]['gender'] == "male") {
                    $final_profile_picture = $hff_media_profile_image_default_path_read . "user-male.png";
                } else if ($patientData[$i]['gender'] == "female") {
                    $final_profile_picture = $hff_media_profile_image_default_path_read . "user-female.png";
                }
            }
            
            $patientData[$i]['profilePicture'] = $final_profile_picture;
                    
        }
        ///print_r($patientData); exit;
        
        if (count($patientData) == 0) {

            $output['status'] = TRUE;
            //$output['response']['message'][] = ERROR_NO_PATIENT;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['patientData'] = $patientData;
        $output['response']['total'] = count($patientData);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function patientRegistration($inputData) {
        
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
        if(isset($inputData["houseNo"])&&!empty($inputData["houseNo"])){
            $address .= $inputData["houseNo"].',';
        }
        if(isset($inputData["block"])&&!empty($inputData["block"])){
            $address .= $inputData["block"].',';
        }
        if(isset($inputData["streetName"])&&!empty($inputData["streetName"])){
            $address .= $inputData["streetName"].',';
        }
        if(isset($inputData["area"])&&!empty($inputData["area"])){
            $address .= $inputData["area"];
        }    
        
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->medicalRegistrationNumber]  = $medical_registration_code;
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
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->caste] = $inputData["caste"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->religion] = $inputData["religion"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->maritalStatus] = $inputData["maritalStatus"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->occupation] = $inputData["occupation"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->education] = $inputData["education"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->contactNumber] = $inputData["contactNumber"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->alternateContactNumber] = $inputData["alternateContactNumber"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactName] = strip_tags($inputData["emergencyContactName"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactRelation] = strip_tags($inputData["emergencyContactRelation"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactNumber] = $inputData["emergencyContactNumber"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->address] = strip_tags($address);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->houseNo] = strip_tags($inputData["houseNo"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->block] = strip_tags($inputData["block"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->streetName] = strip_tags($inputData["streetName"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->area] = strip_tags($inputData["area"]);
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->countryId] = $inputData["countryId"];
        $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->stateId] = $inputData["stateId"];
        ///$this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->districtId] = $inputData["districtId"];
        ///$this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->mandalId] = $inputData["mandalId"];
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
            $output['status'] = TRUE;
            ///$output['response']['messages'] = PATIENT_DATA_INSERTED;
            $output['response']['messages'][] = $this->ci->lang->line('success_patient_create_message');
            $output['response']['data']['medicalRegistrationCode'] = $medical_registration_code;
            $output['response']['data']['patientId'] = $patientId;
            $output['statusCode'] = STATUS_CREATED;
            return $output;
        }
        
        $output['status'] = FALSE;
        ///$output['response']['messages'] = ERROR_INVALID_DATA;
        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
        $output['statusCode'] = STATUS_BAD_REQUEST;
        return $output;
    }

    public function patientSearch($inputData) {
        
        $this->ci->Patient_model->resetVariable();
        $selectInput = array();
        $PatientData = array();
        $like = array();
        $selectInput['id'] = $this->ci->Patient_model->id;
        //$selectInput['name'] = $this->ci->Patient_model->name;
        $selectInput['medicalRegistrationNumber'] = $this->ci->Patient_model->medicalRegistrationNumber;
        $selectInput['title'] = $this->ci->Patient_model->title;
        $selectInput['firstName'] = $this->ci->Patient_model->firstName;
        $selectInput['middleName'] = $this->ci->Patient_model->middleName;
        $selectInput['lastName'] = $this->ci->Patient_model->lastName;
        $selectInput['profilePicture'] = $this->ci->Patient_model->profilePicture;
        $selectInput['age'] = $this->ci->Patient_model->age;
        $selectInput['dateofBirth'] = $this->ci->Patient_model->dateofBirth;
        $selectInput['gender'] = $this->ci->Patient_model->gender;
        //$selectInput['caste'] = $this->ci->Patient_model->caste;
        $selectInput['guardianName'] = $this->ci->Patient_model->guardianName;
        $selectInput['guardianRelation'] = $this->ci->Patient_model->guardianRelation;
        $selectInput['maritalStatus'] = $this->ci->Patient_model->maritalStatus;
        $selectInput['occupation'] = $this->ci->Patient_model->occupation;
        $selectInput['education'] = $this->ci->Patient_model->education;
        $selectInput['contactNumber'] = $this->ci->Patient_model->contactNumber;        
        $selectInput['emergencyContactNumber'] = $this->ci->Patient_model->emergencyContactNumber;        
        $selectInput['address'] = $this->ci->Patient_model->address;
        $selectInput['houseNo'] = $this->ci->Patient_model->houseNo;
        $selectInput['block'] = $this->ci->Patient_model->block;
        $selectInput['streetName'] = $this->ci->Patient_model->streetName;
        $selectInput['area'] = $this->ci->Patient_model->area;        
        
        $this->ci->Patient_model->setSelect($selectInput);
        $where[$this->ci->Patient_model->deleted] = 0;
        $where[$this->ci->Patient_model->status] = 1;
        
        /*
        $name = trim($inputData['firstName']);
        $like[$this->ci->Patient_model->firstName] = $name;
        $like[$this->ci->Patient_model->middleName] = $name;
        $like[$this->ci->Patient_model->lastName] = $name;   
        */
                
        $name = explode(' ', trim($inputData['firstName']));
           
        if(is_array($name) && count($name)>0){
            
            if(isset($name[0])){
                $firstName = $name[0];
                $like[$this->ci->Patient_model->firstName] = $firstName;
            }
            
            if(isset($name[1])){
                $middleName = $name[1];
                $like[$this->ci->Patient_model->lastName] = $middleName;
            }
            
            if(isset($name[2])){
                $lastName = $name[2];
                $like[$this->ci->Patient_model->lastName] = $lastName;
            }                                        
        }                
        
        if(isset($inputData['contactNumber']) && !empty($inputData['contactNumber'])){
            $where[$this->ci->Patient_model->contactNumber] = $inputData['contactNumber'];
        }   
        if(isset($inputData['emergencyContactNumber']) && !empty($inputData['emergencyContactNumber'])){
            $where[$this->ci->Patient_model->emergencyContactNumber] = $inputData['emergencyContactNumber'];
        } 
        if(isset($inputData['village']) && !empty($inputData['village'])){
            $where[$this->ci->Patient_model->villageName] = $inputData['village'];
        }
        if(isset($inputData['age']) && !empty($inputData['age'])){
            $where[$this->ci->Patient_model->age] = $inputData['age'];
        }
        if(isset($inputData['gender']) && !empty($inputData['gender'])){
            $where[$this->ci->Patient_model->gender] = $inputData['gender'];
        }
        if(isset($inputData['bcpUserId']) && !empty($inputData['bcpUserId'])){
            $where[$this->ci->Patient_model->bcpUserId] = $inputData['bcpUserId'];
        }
        
        $this->ci->Patient_model->setOrWhere($like, 'and', 'like');
        $this->ci->Patient_model->setWhere($where);

        // $this->ci->Patient_model->setRecords(1);
        $patientData = $this->ci->Patient_model->get();
        
        ///$hff_media_path = $this->ci->config->item('hff_media_path');
        
        $hff_media_profile_image_path_read = $this->ci->config->item('hff_media_profile_image_path_read');
        $hff_media_profile_image_default_path_read = $this->ci->config->item('hff_media_profile_image_default_path_read');
        
        for($i=0; $i<count($patientData); $i++){
                        
            $final_profile_picture = "";
            if (isset($patientData[$i]['profilePicture']) && $patientData[$i]['profilePicture'] != "") {
                $profile_picture = $hff_media_profile_image_path_read . $patientData[$i]['profilePicture']; 
                ///$final_profile_picture = checkImageByURL($profile_picture);
                $final_profile_picture = $profile_picture; 
            } 

            if ($final_profile_picture == "") {
                if ($patientData[$i]['gender'] == "male") {
                    $final_profile_picture = $hff_media_profile_image_default_path_read . "user-male.png";
                } else if ($patientData[$i]['gender'] == "female") {
                    $final_profile_picture = $hff_media_profile_image_default_path_read . "user-female.png";
                }
            }
            
            $patientData[$i]['profilePicture'] = $final_profile_picture;
                    
        }
                
        if (count($patientData) == 0) {
            $output['status'] = TRUE;
            //$output['response']['message'][] = ERROR_NO_PATIENT;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        
        $output['status'] = TRUE;
        $output['response']['patientData'] = $patientData;
        $output['response']['total'] = count($patientData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    
    public function getPatients($limit = 100, $page = 0) {

        $this->ci->Patient_model->resetVariable();
        $selectInput = array();
        $PatientData = array();
        $selectInput['id'] = $this->ci->Patient_model->id;
        //$selectInput['name'] = $this->ci->Patient_model->name;
        $selectInput['medicalRegistrationNumber'] = $this->ci->Patient_model->medicalRegistrationNumber;
        $selectInput['title'] = $this->ci->Patient_model->title;
        $selectInput['firstName'] = $this->ci->Patient_model->firstName;
        $selectInput['middleName'] = $this->ci->Patient_model->middleName;
        $selectInput['lastName'] = $this->ci->Patient_model->lastName;
        $selectInput['profilePicture'] = $this->ci->Patient_model->profilePicture;
        $selectInput['age'] = $this->ci->Patient_model->age;
        $selectInput['dateofBirth'] = $this->ci->Patient_model->dateofBirth;
        $selectInput['gender'] = $this->ci->Patient_model->gender;
        //$selectInput['caste'] = $this->ci->Patient_model->caste;
        $selectInput['guardianName'] = $this->ci->Patient_model->guardianName;
        $selectInput['guardianRelation'] = $this->ci->Patient_model->guardianRelation;
        $selectInput['maritalStatus'] = $this->ci->Patient_model->maritalStatus;
        $selectInput['occupation'] = $this->ci->Patient_model->occupation;
        $selectInput['education'] = $this->ci->Patient_model->education;
        $selectInput['contactNumber'] = $this->ci->Patient_model->contactNumber;        
        $selectInput['address'] = $this->ci->Patient_model->address;
        $selectInput['houseNo'] = $this->ci->Patient_model->houseNo;
        $selectInput['block'] = $this->ci->Patient_model->block;
        $selectInput['streetName'] = $this->ci->Patient_model->streetName;
        $selectInput['area'] = $this->ci->Patient_model->area;        
        
        $this->ci->Patient_model->setSelect($selectInput);
        $where[$this->ci->Patient_model->deleted] = 0;
        $where[$this->ci->Patient_model->status] = 1;

        //$like[$this->ci->Patient_model->firstName] = $inputData['firstName'];
        //$where[$this->ci->Patient_model->gender] = $inputData['gender'];
        //$where[$this->ci->Patient_model->contactNumber] = $inputData['contactNumber'];
        //$this->ci->Patient_model->setLike($like);
        //$this->ci->Patient_model->setWhere($where);

        // $this->ci->Patient_model->setRecords(1);
        if (($limit > 100) || ($limit == '')) {
            $limit = 100;
        }
        if ($page > 0) {
            $page = ($page - 1);
            $page = ($limit) * $page;
        }
        $this->ci->Patient_model->setRecords($limit, $page);
        $patientData = $this->ci->Patient_model->get();
        
        ///$hff_media_path = $this->ci->config->item('hff_media_path');  
        $hff_media_profile_image_path_read = $this->ci->config->item('hff_media_profile_image_path_read');  
        
        for($i=0; $i<count($patientData); $i++){
            
            $final_profile_picture = "";
            if (isset($patientData[$i]['profilePicture']) && $patientData[$i]['profilePicture'] != "") {
                $profile_picture = $hff_media_profile_image_path_read . $patientData[$i]['profilePicture'];  
                ///$final_profile_picture = checkImageByURL($profile_picture);
                $final_profile_picture = $profile_picture;   
            } 

            if ($final_profile_picture == "") {
                if ($patientData[$i]['gender'] == "male") {
                    $final_profile_picture = $hff_media_profile_image_default_path_read . "user-male.png";
                } else if ($patientData[$i]['gender'] == "female") {
                    $final_profile_picture = $hff_media_profile_image_default_path_read . "user-female.png";
                }
            }
            
            $patientData[$i]['profilePicture'] = $final_profile_picture;
        }
                
        if (count($patientData) == 0) {
            $output['status'] = TRUE;
            //$output['response']['message'][] = ERROR_NO_PATIENT;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        
        $output['status'] = TRUE;
        $output['response']['patientData'] = $patientData;
        $output['response']['total'] = count($patientData);
        $output['statusCode'] = STATUS_OK;
        return $output;
    }
    
    
    public function getPatientBasicDetails($inputData = "", $getByValue = "") {
        
        $this->ci->Patient_model->resetVariable();
        $selectInput = array();
        $patientData = array();
        $where = array();
        $like = array();
        $selectInput['id'] = $this->ci->Patient_model->id;
        $selectInput['medicalRegistrationNumber'] = $this->ci->Patient_model->medicalRegistrationNumber;
        $selectInput['title'] = $this->ci->Patient_model->title;
        $selectInput['firstName'] = $this->ci->Patient_model->firstName;
        $selectInput['middleName'] = $this->ci->Patient_model->middleName;
        $selectInput['lastName'] = $this->ci->Patient_model->lastName;
        $selectInput['gender'] = $this->ci->Patient_model->gender;
        $selectInput['village'] = $this->ci->Patient_model->villageName;
        $selectInput['contactNumber'] = $this->ci->Patient_model->contactNumber;
        $selectInput['emergencyContactNumber'] = $this->ci->Patient_model->emergencyContactNumber;
        $selectInput['dateofBirth'] = $this->ci->Patient_model->dateofBirth;
        $this->ci->Patient_model->setSelect($selectInput);
        $where[$this->ci->Patient_model->deleted] = 0;
        $where[$this->ci->Patient_model->status] = 1;
        if(isset($inputData['bcpUserId']) && !empty($inputData['bcpUserId'])){
            $where[$this->ci->Patient_model->bcpUserId] = $inputData['bcpUserId'];
        }
        if ($getByValue == "id") {
            $where[$this->ci->Patient_model->id] = $inputData['id'];
            $this->ci->Patient_model->setWhere($where);
            $this->ci->Patient_model->setRecords(1);
        }
        else if ($getByValue == "mrcode") {
            $mrCode = $inputData['medicalRegistrationCode'];
            $where[$this->ci->Patient_model->medicalRegistrationNumber] = $mrCode;
            $this->ci->Patient_model->setWhere($where);
            $this->ci->Patient_model->setRecords(1);
        }
        else if ($getByValue == "search") {
           
            $name = explode(' ', trim($inputData['firstName']));
           
            if(is_array($name) && count($name)>0){

                if(isset($name[0])){
                    $firstName = $name[0];
                    $like[$this->ci->Patient_model->firstName] = $firstName;
                }

                if(isset($name[1])){
                    $middleName = $name[1];
                    $like[$this->ci->Patient_model->lastName] = $middleName;
                }

                if(isset($name[2])){
                    $lastName = $name[2];
                    $like[$this->ci->Patient_model->lastName] = $lastName;
                }                                        
            }                
              
      
            if(isset($inputData['village']) && !empty($inputData['village'])){
                $where[$this->ci->Patient_model->villageName] = $inputData['village'];
            }
            
            if(isset($inputData['emergencyContactNumber']) && !empty($inputData['emergencyContactNumber'])){
                $where[$this->ci->Patient_model->emergencyContactNumber] = $inputData['emergencyContactNumber'];
            }  
                        
            $this->ci->Patient_model->setOrWhere($like, 'and', 'like');
            $this->ci->Patient_model->setWhere($where); 
        }
        
        //$this->ci->Patient_model->setRecords(1);
        $patientData = $this->ci->Patient_model->get();  
        if(count($patientData)>0){
            $dateofBirth = $patientData[0]['dateofBirth'];
            $age = date_diff(date_create($dateofBirth), date_create('now'))->y;
            $patientData[0]['age'] = $age;
            unset($patientData[0]['dateofBirth']);
        }        
       
        return $patientData;
    }
    
    
    public function getPatientCount($keyValueArray){        
        $select = array();
        $where = array();
        $select['id'] = $this->ci->Patient_model->id;
        
        if(count($keyValueArray)>0){
            foreach($keyValueArray as $key => $val){
                $where[$this->ci->Patient_model->$key] = $val; 
            }
        }        
        
        $this->ci->Patient_model->setSelect($select);
        $this->ci->Patient_model->setWhere($where);
        return $this->ci->Patient_model->getCount();
    }
     
     public function getPatientbyBcpIds($bcpids){
        $this->ci->Patient_model->resetVariable();
        $mrcount =array();
        
        $select = array();
        $where = array();
        $groupBy    =   array();
        $select['id'] = 'count('.$this->ci->Patient_model->id.')';
        $select['bcpUserId'] = $this->ci->Patient_model->bcpUserId;
        $whereIn[$this->ci->Patient_model->bcpUserId] = $bcpids; 
        $groupBy  =   $this->ci->Patient_model->createdby;
        $this->ci->Patient_model->setSelect($select);
        $this->ci->Patient_model->setOrWhere($whereIn);
        $this->ci->Patient_model->setGroupBy($groupBy);
        $count =  $this->ci->Patient_model->get();  
        return $count ;
       
    }
    
    public function quickPatientRegistration($inputData = array()){
        ///print_r($inputData); exit;
        
        if(count($inputData)>0){ 
            $gender = strip_tags($inputData["gender"]);
            if($gender == "male"){
               // $title = "mr";
            }else{
                //$title = "miss"; 
            }
            
            $this->ci->Patient_model->startTransaction();
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->medicalRegistrationNumber] = $inputData["medical_registration_code"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->firstName] = strip_tags($inputData["firstName"]);
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactName] = strip_tags($inputData["emergencyContactName"]);
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactNumber] = $inputData["emergencyContactNumber"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->registrationDate] = $inputData["registrationDate"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->villageName] = strip_tags($inputData["villageName"]);
			if(strlen($inputData["dateofBirth"]) > 2) 
			$this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->dateofBirth] = strip_tags($inputData["dateofBirth"]);
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->gender] = $gender;
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->title] = $title;
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->bcpUserId] = $inputData["bcp_user_id"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->createdby] = $inputData["bcp_user_id"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->modifiedby] = $inputData["bcp_user_id"];
            return $patientId = $this->ci->Patient_model->insert_data($this->ci->Patient_model->dbTable, $this->ci->Patient_model->insertUpdateArray);
        }
    }
	
	 public function quickPatientRegistrationViaSMS($inputData = array()){
        ///print_r($inputData); exit;
        
        if(count($inputData)>0){ 
            $gender = strip_tags($inputData["gender"]);
            if($gender == "male"){
               // $title = "mr";
            }else{
                //$title = "miss"; 
            }
            $this->ci->Patient_model->resetVariable();
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->medicalRegistrationNumber] = $inputData["medical_registration_code"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->firstName] = strip_tags($inputData["firstName"]);
          //  $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactName] = strip_tags($inputData["emergencyContactName"]);
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->emergencyContactNumber] = $inputData["emergencyContactNumber"];
           // $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->registrationDate] = $inputData["registrationDate"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->villageName] = strip_tags($inputData["villageName"]);
			if(strlen($inputData["dateofBirth"]) > 2) 
			$this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->dateofBirth] = strip_tags($inputData["dateofBirth"]);
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->gender] = $gender;
            //$this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->title] = $title;
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->bcpUserId] = $inputData["bcp_user_id"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->createdby] = $inputData["bcp_user_id"];
            $this->ci->Patient_model->insertUpdateArray[$this->ci->Patient_model->modifiedby] = $inputData["bcp_user_id"];
			
			$updateDataArray = array();
		//	$updateDataArray[$this->ci->Patient_model->medicalIncidentCount] = 1; 
		//	$updateDataArray[$this->ci->Patient_model->medicalIncidentVisitCount] = 1; 
			$patientId = $this->ci->Patient_model->insert_update_onduplicate_data(array(),$updateDataArray);
			
			
			
        }
    }
}
