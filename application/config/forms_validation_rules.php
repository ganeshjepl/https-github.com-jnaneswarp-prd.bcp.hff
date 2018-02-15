<?php

////////////////Form Validations/////////////////
$config = array(
    'paginationRules' => array(///*** ****///
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        )
    ),
    'getCountryPagRules' => array(///*** ****///
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'timestamp',
            'label' => 'Timestamp',
            'rules' => 'trim|checkDateFormat'
        )
    ),
    'getStatePagRules' => array(///*** ****///
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'timestamp',
            'label' => 'Timestamp',
            'rules' => 'trim|checkDateFormat'
        )
    ),
    'getCityPagRules' => array(///*** ****///
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'timestamp',
            'label' => 'Timestamp',
            'rules' => 'trim|checkDateFormat'
        )
    ),
    'getCitiesByStatePagRules' => array(///***Cities - getCitiesByState_get() ****///
        array(
            'field' => 'stateId',
            'label' => 'State',
            'rules' => 'trim|numericCheck|required'
        ),
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'timestamp',
            'label' => 'Timestamp',
            'rules' => 'trim|checkDateFormat'
        )
    ),
    'getStatesByCountryPagRules' => array(///***States - getStatesByCountry_get() ****///
        array(
            'field' => 'countryId',
            'label' => 'State',
            'rules' => 'trim|numericCheck|required'
        ),
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'timestamp',
            'label' => 'Timestamp',
            'rules' => 'trim|checkDateFormat'
        )
    ),
    'searchCountryRules' => array(///*** Countries -  searchCountry() ****///
        array(
            'field' => 'name',
            'label' => 'Country name',
            'rules' => 'trim|required|xss_clean'
        )
    ),
    'searchStateRules' => array(///*** States - searchState() ****///
        array(
            'field' => 'name',
            'label' => 'State name',
            'rules' => 'trim|required|xss_clean'
        )
    ),
    'searchCityRules' => array(///*** Cities - searchCity() ****///
        array(
            'field' => 'name',
            'label' => 'City name',
            'rules' => 'trim|required|xss_clean'
        )
    ),
    'languageRules' => array(///*** ****///
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        )
    ),
    'patientRegRules' => array(///***index_post() ****///
//        array(
//            'field' => 'name',
//            'label' => 'Name',
//            'rules' => 'trim|required|xss_clean'
//        ),
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|xss_clean|required|checkDateFormat'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'firstName',
            'label' => 'First Name',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'middleName',
            'label' => 'Middle Name',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'lastName',
            'label' => 'Last Name',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'profilePicture',
            'label' => 'Profile Picture',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'dateofBirth',
            'label' => 'Date of Birth',
            'rules' => 'trim|checkDateFormat|xss_clean'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'guardianName',
            'label' => 'Guardian Name',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'guardianRelation',
            'label' => 'Guardian Relation',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'caste',
            'label' => 'Caste',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'religion',
            'label' => 'Religion',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'maritalStatus',
            'label' => 'Marital Status',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'occupation',
            'label' => 'Occupation',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'education',
            'label' => 'Education',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'contactNumber',
            'label' => 'Contact Number',
            'rules' => 'trim|xss_clean|checkMobilenoFormat'
        ),
        array(
            'field' => 'alternateContactNumber',
            'label' => 'Alternate Contact Number',
            'rules' => 'trim|xss_clean|checkMobilenoFormat'
        ),
        array(
            'field' => 'emergencyContactName',
            'label' => 'Emergency Contact Name',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'emergencyContactRelation',
            'label' => 'Emergency Contact Relation',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'emergencyContactNumber',
            'label' => 'Emergency Contact Number',
            'rules' => 'trim|xss_clean|checkMobilenoFormat'
        ),
//        array(
//            'field' => 'address',
//            'label' => 'Address',
//            'rules' => 'trim|required|xss_clean'
//        ),
        array(
            'field' => 'houseNo',
            'label' => 'House No.',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'block',
            'label' => 'Block',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'streetName',
            'label' => 'Street Name',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'area',
            'label' => 'Area',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'countryId',
            'label' => 'Country',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        array(
            'field' => 'stateId',
            'label' => 'State',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
//        array(
//            'field' => 'districtId',
//            'label' => 'Distirct',
//            'rules' => 'trim|required|xss_clean'
//        ),
//        array(
//            'field' => 'mandalId',
//            'label' => 'Mandal',
//            'rules' => 'trim|required|xss_clean'
//        ),
        array(
            'field' => 'cityId',
            'label' => 'City',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        array(
            'field' => 'villageName',
            'label' => 'Village Name',
            'rules' => 'trim|xss_clean'
        ),
         array(
            'field' => 'idProofType',
            'label' => 'Type of ID',
            'rules' => 'trim|xss_clean'
        ),
         array(
            'field' => 'idProofNo',
            'label' => 'ID Number',
            'rules' => 'trim|xss_clean|alphaNumericSlash'
        ),
        array(
            'field' => 'pincode',
            'label' => 'Pincode',
            'rules' => 'trim|xss_clean|checkZipcodeFormat'
        )
    ),
    'CreateMedicalIncidentWithPatientRegRules' => array(///***Medical Incident - index_post() ****///
        /* array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
        ), */
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|checkDateFormat|xss_clean|required'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'firstName',
            'label' => 'First Name',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'middleName',
            'label' => 'Middle Name',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'lastName',
            'label' => 'Last Name',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'profilePicture',
            'label' => 'Profile Picture',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'dateofBirth',
            'label' => 'Date of Birth',
            'rules' => 'trim|checkDateFormat|xss_clean'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'guardianName',
            'label' => 'Guardian Name',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'guardianRelation',
            'label' => 'Guardian Relation',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'caste',
            'label' => 'Caste',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'religion',
            'label' => 'Religion',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'maritalStatus',
            'label' => 'Marital Status',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'occupation',
            'label' => 'Occupation',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'education',
            'label' => 'Education',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'contactNumber',
            'label' => 'Contact Number',
            'rules' => 'trim|xss_clean|checkMobilenoFormat'
        ),
        array(
            'field' => 'alternateContactNumber',
            'label' => 'Alternate Contact Number',
            'rules' => 'trim|xss_clean|checkMobilenoFormat'
        ),
        array(
            'field' => 'emergencyContactName',
            'label' => 'Emergency Contact Name',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'emergencyContactRelation',
            'label' => 'Emergency Contact Relation',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'emergencyContactNumber',
            'label' => 'Emergency Contact Number',
            'rules' => 'trim|xss_clean|checkMobilenoFormat'
        ),
        /*array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim|required|xss_clean'
        ),*/
        array(
            'field' => 'houseNo',
            'label' => 'House No.',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'block',
            'label' => 'Block',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'streetName',
            'label' => 'Street Name',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'area',
            'label' => 'Area',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'countryId',
            'label' => 'Country',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        array(
            'field' => 'stateId',
            'label' => 'State',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        /*array(
            'field' => 'districtId',
            'label' => 'Distirct',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'mandalId',
            'label' => 'Mandal',
            'rules' => 'trim|required|xss_clean'
        ),*/
        array(
            'field' => 'cityId',
            'label' => 'City',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        array(
            'field' => 'villageName',
            'label' => 'Village Name',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'pincode',
            'label' => 'Pincode',
            'rules' => 'trim|xss_clean|checkZipcodeFormat'
        ),
         array(
            'field' => 'idProofType',
            'label' => 'Type of ID',
            'rules' => 'trim|xss_clean'
        ),
         array(
            'field' => 'idProofNo',
            'label' => 'ID Number',
            'rules' => 'trim|xss_clean|alphaNumericSlash'
        ),
        array(
            'field' => 'surveyId',
            'label' => 'Survey Id',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        array(
            'field' => 'questions[]',
            'label' => 'Questions',
            'rules' => 'required'
        )
    ),
    'createMedicalIncidentRules' => array(///***Medical Incident - index_post() ****///
        array(
            'field' => 'medicalRegistrationNumber',
            'label' => 'Medical Registration Number',
            'rules' => 'trim|required|alphaNumericSlash'
        ),
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|required|checkDateTimeFormat|xss_clean'
        ),
        array(
            'field' => 'surveyId',
            'label' => 'Survey Id',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        array(
            'field' => 'questions[]',
            'label' => 'Questions',
            'rules' => 'required'
        )
    ),
    'userRegRules' => array(///*** User - ****///
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'first_name',
            'label' => 'First name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last name',
            'rules' => 'trim'
        ),
        array(
            'field' => 'signupdate',
            'label' => 'Signup Date',
            'rules' => 'trim|checkDateTimeFormat|xss_clean|required'
        ),
        array(
            'field' => 'countryid',
            'label' => 'Country',
            'rules' => 'trim|xss_clean|numericCheck'
        ),
        array(
            'field' => 'stateid',
            'label' => 'State',
            'rules' => 'trim|xss_clean|numericCheck'
        ),
        array(
            'field' => 'cityid',
            'label' => 'City',
            'rules' => 'trim|xss_clean|numericCheck'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'trim|xss_clean|required|checkMobilenoFormat'
        )
    ),
    'userLoginRules' => array(///*** User - login()****///
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'language',
            'label' => 'Language',
            'rules' => 'trim'
        ),
        array(
            'field' => 'deviceId',
            'label' => 'Device Id',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'deviceToken',
            'label' => 'Device Token',
            'rules' => 'trim|required'
        ),
         array(
            'field' => 'osType',
            'label' => 'OS Type',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'osVersion',
            'label' => 'OS Version',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'type',
            'label' => 'Type',
            'rules' => 'trim|required'
        )
    ),
    'getPatientRules' => array(///*** Patient - index_get() ****///
        array(
            'field' => 'patientid',
            'label' => 'Patient Id',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'medicalregistration',
            'label' => 'Medical Registration Id',
            'rules' => 'trim|alpha_dash'
        ),
        array(
            'field' => 'language',
            'label' => 'Language',
            'rules' => 'trim'
        )
    ),
    'patientSearchRules' => array(///*** Patient - patientSearch_get() ****///
        array(
            'field' => 'firstName',
            'label' => 'Name',
            'rules' => 'trim|xss_clean|required'
        ),        
        array(
            'field' => 'village',
            'label' => 'Village',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'emergencyContactNumber',
            'label' => 'Emergency Contact Number',
            'rules' => 'trim|xss_clean|required|checkMobilenoFormat'
        )
    ),
    'doctorLoginRules' => array(///*** Doctor - Login() ****///
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'language',
            'label' => 'Language',
            'rules' => 'trim'
        ),
        array(
            'field' => 'type',
            'label' => 'Type',
            'rules' => 'trim|required'
        )
    ),
    'medicalVisitDetailsRules' => array(///*** Medical Incident  ****///
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        )
    ),
    'medicalSurveyDetailsRules' => array(///***MedicalVisit - medicalVisitDetails_get() ****///
        array(
            'field' => 'medicalvisit',
            'label' => 'Medical visit',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        )
    ),
    'getMedicalIncidentVisitsRules' => array(////*** MedicalIncident - medicalIncidentVisits_get() ****///
        array(
            'field' => 'medicalIncident',
            'label' => 'Medical Incident',
            'rules' => 'trim'
        )
    ),
    'getMedicalIncidentVisitsDetailsRules' => array(////*** MedicalIncident - medicalIncidentVisits_get() ****///
        array(
            'field' => 'medicalIncidentVisit',
            'label' => 'Medical Incident Visit',
            'rules' => 'trim|required'
        )
    ),
    'getMedicalIncidentSurveyRules' => array(///*** MedicalIncident - medicalIncidentSurvey_get() ****///
        array(
            'field' => 'medicalIncidentVisit',
            'label' => 'Medical Incident Visit',
            'rules' => 'trim|required'
        )
    ),
    'getMedicalIncidentRules' => array(///***MedicalIncident - index_get() ****///
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck'
        )
    ),
    'getMedicalIncidentOfPatientRules' => array(///***MedicalIncident - medicalIncidentsOfPatient_get() ****///
        array(
            'field' => 'medicalRegistrationCode',
            'label' => 'Medical registration code',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'limit',
            'label' => 'Limit',
            'rules' => 'trim|numericCheck'
        ),
        array(
            'field' => 'page',
            'label' => 'Page',
            'rules' => 'trim|numericCheck' 
        )
    ),
    'createChiefComplaintRules' => array(///***Chief Complaint - index_post() ****///
        array(
            'field' => 'medicalIncidentId',
            'label' => 'Medical Incident Id',
            'rules' => 'trim|required|numericCheck'
        ),         
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|required|checkDateTimeFormat|xss_clean'
        ),
        array(
            'field' => 'survey[]',
            'label' => 'Survey',
            'rules' => 'trim|xss_clean|required'
        )
    ),    
    'forgotPasswordEmailRules' => array(///***User - forgotPassword_post() ****///
        array(
            'field' => 'inputVal',
            'label' => 'Email Id',
            'rules' => 'trim|required|valid_email'
        )
    ),    
    'forgotPasswordMobileRules' => array(///***User - forgotPassword_post() ****///
        array(
            'field' => 'inputVal',
            'label' => 'Mobile Number',
            'rules' => 'trim|xss_clean|checkMobilenoFormat'
        )
    ),    
    'changePasswordRules' => array(///***User - forgotPassword_post() ****///
        array(
            'field' => 'oldPassword',
            'label' => 'Current Password',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'newPassword',
            'label' => 'New Password',
            'rules' => 'trim|xss_clean|required'
        ), 
        array(
            'field' => 'confirmPassword',
            'label' => 'Confirm Password',
            'rules' => 'trim|xss_clean|required' 
        )
    ),
    'validateOtpRules' => array(///***User - forgotPassword_post() ****///
        array(
            'field' => 'otpCode',
            'label' => 'OTP Code',
            'rules' => 'trim|xss_clean|required'
        ),
       /* array(
            'field' => 'emailId',
            'label' => 'Email Id',
            'rules' => 'trim|xss_clean|required|valid_email'
        ),*/
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|xss_clean|required'
        ),
         array(
            'field' => 'newPassword',
            'label' => 'New Password',
            'rules' => 'trim|xss_clean|required'
        ), 
        array(
            'field' => 'confirmPassword',
            'label' => 'Confirm Password',
            'rules' => 'trim|xss_clean|required' 
        )
    ),  
    
    'bcpDetailsRules' => array(
        array(
            'field' => 'id',
            'label' => 'Bcp Id',
            'rules' => 'trim|xss_clean|required'
        ),
    ),
    
    'MedicineCatalog' => array(
        array(
            'field'=> 'name',
            'label'=> 'Medicine Name',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'brand',
            'label'=> 'Brand',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'generic_name',
            'label'=> 'Generic Name',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'dosage',
            'label'=> 'Dosage',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'batch_number',
            'label'=> 'Batch No.',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'expiry_date',
            'label'=> 'Expiry Date',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'indications',
            'label'=> 'Indications',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'quantity',
            'label'=> 'Quantity',
            'rules'=> 'trim|xss_clean|required'
        ),
    ),
     
     'DoctorEditRules' => array(
        
        array(
            'field'=> 'email',
            'label'=> 'Email',
            'rules'=> 'trim|xss_clean|required|valid_email'
        ),
        array(
            'field'=> 'first_name',
            'label'=> 'First Name',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'last_name',
            'label'=> 'Last Name',
            'rules'=> 'trim|xss_clean|required'
        ),
        
        array(
            'field'=> 'countryid',
            'label'=> 'Country',
            'rules'=> 'trim|xss_clean|numericCheck'
        ),
        array(
            'field'=> 'stateid',
            'label'=> 'State',
            'rules'=> 'trim|xss_clean|numericCheck'
        ),
        array(
            'field'=> 'cityid',
            'label'=> 'City',
            'rules'=> 'trim|xss_clean|numericCheck'
        ),
        array(
            'field'=> 'picode',
            'label'=> 'Pincode',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'mobile',
            'label'=> 'Mobile',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'alternate_contact_number',
            'label'=> 'Alternate Contact',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'language_id',
            'label'=> 'Language',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'profile_picture',
            'label'=> 'Profile Picture',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'signature_picture',
            'label'=> 'Signature Picture',
            'rules'=> 'trim|xss_clean'
        ),
    
    
    ),
    'DoctorRules' => array(
        array(
            'field'=> 'username',
            'label'=> 'Username',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'password',
            'label'=> 'Password',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'email',
            'label'=> 'Email',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'first_name',
            'label'=> 'First Name',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'last_name',
            'label'=> 'Last Name',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'gender',
            'label'=> 'Gender',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'signupdate',
            'label'=> 'Sign Up Date',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'countryid',
            'label'=> 'Country',
            'rules'=> 'trim|xss_clean|numericCheck'
        ),
        array(
            'field'=> 'stateid',
            'label'=> 'State',
            'rules'=> 'trim|xss_clean|numericCheck'
        ),
        array(
            'field'=> 'cityid',
            'label'=> 'City',
            'rules'=> 'trim|xss_clean|numericCheck'
        ),
        array(
            'field'=> 'picode',
            'label'=> 'Pincode',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'mobile',
            'label'=> 'Mobile',
            'rules'=> 'trim|xss_clean|required'
        ),
        array(
            'field'=> 'alternate_contact_number',
            'label'=> 'Alternate Contact',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'language_id',
            'label'=> 'Language',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'profile_picture',
            'label'=> 'Profile Picture',
            'rules'=> 'trim|xss_clean'
        ),
        array(
            'field'=> 'signature_picture',
            'label'=> 'Signature Picture',
            'rules'=> 'trim|xss_clean'
        ),
    
    
    ),
    'networkHospitalsRules'=> array(
        array(
            'field' => 'name',
            'label' => 'Hospital Name',
            'rules' => 'trim|xss_clean|required'
        ),  
        array(
            'field' => 'zipcode',
            'label' => 'Zipcode',
            'rules' => 'trim|xss_clean|required'
        ),
         array(
            'field' => 'country',
            'label' => 'Country Name',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ), 
        array(
            'field' => 'state',
            'label' => 'State Name',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ), 
        array(
            'field' => 'type',
            'label' => 'Type',
            'rules' => 'trim|xss_clean' 
        ),
        array(
            'field' => 'contactnumber',
            'label' => 'Contact Number',
            'rules' => 'trim|xss_clean' 
        ),
        array(
            'field' => 'website',
            'label' => 'Website address',
            'rules' => 'trim|xss_clean' 
        ),
        array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim|xss_clean|required|checkAddressFormat' 
        ),        
        
    ),   
    'timestampRules' => array(///*** ****///
        array(
            'field' => 'timestamp',
            'label' => 'Timestamp',
            'rules' => 'trim|checkDateFormat'
        )
    ),
    'prescriptionSupportDataRules' => array(///*** ****///
        array(
            'field' => 'prescription_id',
            'label' => 'Prescription Id',
            'rules' => 'trim|required'
        )
    ),
    'savingPrescriptionRules' => array(///*** ****///
        array(
            'field' => 'prescription_request_id',
            'label' => 'Prescription Id',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'medicine_id',
            'label' => 'Medicine Id',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'dosage',
            'label' => 'Medicine Dosage',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'quantity',
            'label' => 'Medicine Quantity',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'timings_ids',
            'label' => 'Timings Ids',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'days',
            'label' => 'Days',
            'rules' => 'trim|required'
        ),
    ),
    'bcpsavingPrescriptionRules' => array(///*** ****///
        array(
            'field' => 'id',
            'label' => 'Prescription Detail Id',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'quantity',
            'label' => 'Quantity',
            'rules' => 'trim|required'
        ),
        
    ),
    'doctorProfileRules' => array(///*** ****///
        array(
            'field' => 'id',
            'label' => 'Doctor Id',
            'rules' => 'trim|required'
        )
    ),
    'doctorProfileUpdateRules' => array(
        array(
            'field' => 'firstName',
            'label' => 'First Name',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'lastName',
            'label' => 'Last Name',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|xss_clean|required|valid_email'
        ),
        array(
            'field' => 'countryid',
            'label' => 'Country',
            'rules' => 'trim|xss_clean|numericCheck'
        ),
        array(
            'field' => 'stateid',
            'label' => 'State',
            'rules' => 'trim|xss_clean|numericCheck'
        ),
        array(
            'field' => 'cityid',
            'label' => 'City',
            'rules' => 'trim|xss_clean|numericCheck'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile Number',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'date_of_birth',
            'label' => 'Date of Birth',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'education',
            'label' => 'Education',
            'rules' => 'trim|xss_clean'
        )
    ),
    'sendPrescriptionRules' => array(
        array(
            'field' => 'medicalIncidentId',
            'label' => 'Medical Incident Id',
            'rules' => 'trim|xss_clean|required|is_natural_no_zero'
        ),
        array(
            'field' => 'medicalIncidentVisitId',
            'label' => 'Medical Incident Visit Id',
            'rules' => 'trim|xss_clean|required|is_natural_no_zero'
        ),
        array(
            'field' => 'questionId',
            'label' => 'Question Id',
            'rules' => 'trim|xss_clean|required|is_natural_no_zero'
        ),
        array(
            'field' => 'optionId',
            'label' => 'Option Id',
            'rules' => 'trim|xss_clean|required|is_natural_no_zero'
        ),
        array(
            'field' => 'bcpId',
            'label' => 'BCP Id',
            'rules' => 'trim|xss_clean|required|is_natural_no_zero'
        ),
    ),
    'saveChiefComplaintDiagnosesRules' => array(///***Chief Complaint - index_post() ****///
        array(
            'field' => 'medicalIncidentDetailsId',
            'label' => 'Medical Incident Details Id',
            'rules' => 'trim|required|numericCheck'
        ),         
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|required|checkDateTimeFormat|xss_clean'
        ),
        array(
            'field' => 'survey[]',
            'label' => 'Survey',
            'rules' => 'trim|xss_clean|required'
        )
    ), 
    'BcpEdit' => array(
         array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|xss_clean|valid_email'
        ), 
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'countryid',
            'label' => 'Country',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ),
        array(
            'field' => 'stateid',
            'label' => 'State',
            'rules' => 'trim|xss_clean|numericCheck'
        ),
        array(
            'field' => 'cityid',
            'label' => 'City',
            'rules' => 'trim|xss_clean|numericCheck'
        ),
        array(
            'field' => 'village',
            'label' => 'Village',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'district',
            'label' => 'District',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'pincode',
            'label' => 'Pincode',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Contact',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'alternate_contact_number',
            'label' => 'Alternate Contact',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'language_id',
            'label' => 'Language',
            'rules' => 'trim|xss_clean'
        ),
    ),
     'createMedicalIncidentPARules' => array(///***Medical Incident - index_post() ****///
        array(
            'field' => 'medicalRegistrationNumber',
            'label' => 'Medical Registration Number',
            'rules' => 'trim|required|alphaNumericSlash'
        ),
        array(
            'field' => 'medicalIncidentDetailId',
            'label' => 'Medical Incident Detail Id',
            'rules' => 'trim|required|alphaNumericSlash'
        ),
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|required|checkDateTimeFormat|xss_clean'
        ),
        array(
            'field' => 'surveyId',
            'label' => 'Survey Id',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        array(
            'field' => 'questions[]',
            'label' => 'Questions',
            'rules' => 'required'
        )
    ),
    'getMedicalIncidentOfPatientByMRCodeRules' => array(///***MedicalIncident - searchMedicalIncidentsOfPatient_get() ****///
        array(
            'field' => 'medicalRegistrationCode',
            'label' => 'Medical registration code',
            'rules' => 'trim|required'
        )
    ),
    'getMedicalIncidentOfPatientByNameRules' => array(///***MedicalIncident - searchMedicalIncidentsOfPatient_get() ****///
        array(
            'field' => 'firstName',
            'label' => 'Patient Name',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'village',
            'label' => 'Village',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'emergencyContactNumber',
            'label' => 'Emergency Contact Number',
            'rules' => 'trim|required'
        )
        
    ),
    'createFollowupRules' => array(///***Chief Complaint - index_post() ****///
        array(
            'field' => 'medicalIncidentDetailsId',
            'label' => 'Medical Incident Details Id',
            'rules' => 'trim|required|numericCheck'
        ),         
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|required|checkDateTimeFormat|xss_clean'
        ),
        array(
            'field' => 'survey[]',
            'label' => 'Survey',
            'rules' => 'trim|xss_clean|required'
        )
    ),  
    'getMedicalIncidentIdsRules' => array(///*** MedicalIncident - medicalIncidentSurvey_get() ****///
        array(
            'field' => 'id',
            'label' => 'Medical Incident Code',
            'rules' => 'trim|required'
        )
    ),
    'userLoginWebRules' => array(///*** User - login()****///
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'language',
            'label' => 'Language',
            'rules' => 'trim'
        ),        
        array(
            'field' => 'type',
            'label' => 'Type',
            'rules' => 'trim|required'
        )
    ),
    'prescription_response' => array(
        array(
            'field' => 'pr_id',
            'label' => 'Prescription Id',
            'rules' => 'trim|required'
        )
    ),
    'createRedflagMedicalIncidentRules' => array(///***Medical Incident - index_post() ****///
        array(
            'field' => 'medicalRegistrationNumber',
            'label' => 'Medical Registration Number',
            'rules' => 'trim|required|alphaNumericSlash'
        ),
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|required|checkDateTimeFormat|xss_clean'
        ),
        array(
            'field' => 'surveyId',
            'label' => 'Survey Id',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        array(
            'field' => 'questions[]',
            'label' => 'Questions',
            'rules' => 'trim|xss_clean|required'
        ), 
        array(
            'field' => 'hospitalId',
            'label' => 'Hospital Id',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'questionId',
            'label' => 'Question Id',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'optionId',
            'label' => 'Option Id',
            'rules' => 'trim|xss_clean|required'
        )
    ),
    'CreateRedflagMedicalIncidentWithPatientRegRules' => array(///***Medical Incident - index_post() ****///
       
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|checkDateFormat|xss_clean|required'
        ),       
        array(
            'field' => 'firstName',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
        ),   
        array(
            'field' => 'villageName',
            'label' => 'Village Name',
            'rules' => 'trim|xss_clean'
        ), 
        array(
            'field' => 'emergencyContactNumber',
            'label' => 'Emergency Contact Number',
            'rules' => 'trim|xss_clean|checkMobilenoFormat'
        ),  
        array(
            'field' => 'surveyId',
            'label' => 'Survey Id',
            'rules' => 'trim|required|xss_clean|numericCheck'
        ),
        array(
            'field' => 'questions[]',
            'label' => 'Questions',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'hospitalId',
            'label' => 'Hospital Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ),
        array(
            'field' => 'questionId',
            'label' => 'Question Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ),
        array(
            'field' => 'optionId',
            'label' => 'Option Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        )
    ),
    'forgotPasswordUsernameRules' => array(///***User - forgotPassword_post() ****///
        array(
            'field' => 'inputVal',
            'label' => 'Username',
            'rules' => 'trim|required'
        )
    ), 
    'surveyIdRules' => array(///*** - () ****///
        array(
            'field' => 'id',
            'label' => 'Survey Id',
            'rules' => 'trim|required|alphaNumericSlash'
        )
    ), 
    'createRedflagChiefComplaintRules' => array(///***Chief Complaint - index_post() ****///
        array(
            'field' => 'medicalIncidentId',
            'label' => 'Medical Incident Id',
            'rules' => 'trim|required|numericCheck'
        ),         
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|required|checkDateTimeFormat|xss_clean'
        ),
        array(
            'field' => 'survey[]',
            'label' => 'Survey',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'hospitalId',
            'label' => 'Hospital Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ),
        array(
            'field' => 'questionId',
            'label' => 'Question Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ),
        array(
            'field' => 'optionId',
            'label' => 'Option Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        )
    ),    
    'saveRedflagChiefComplaintDiagnosesRules' => array(///***Chief Complaint - index_post() ****///
        array(
            'field' => 'medicalIncidentDetailsId',
            'label' => 'Medical Incident Details Id',
            'rules' => 'trim|required|numericCheck'
        ),         
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|required|checkDateTimeFormat|xss_clean'
        ),
        array(
            'field' => 'survey[]',
            'label' => 'Survey',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'hospitalId',
            'label' => 'Hospital Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ),
        array(
            'field' => 'questionId',
            'label' => 'Question Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ),
        array(
            'field' => 'optionId',
            'label' => 'Option Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ) 
    ),
    'createRedflagFollowupRules' => array(///***Chief Complaint - index_post() ****///
        array(
            'field' => 'medicalIncidentDetailsId',
            'label' => 'Medical Incident Details Id',
            'rules' => 'trim|required|numericCheck'
        ),         
        array(
            'field' => 'registrationDate',
            'label' => 'Registration Date',
            'rules' => 'trim|required|checkDateTimeFormat|xss_clean'
        ),
        array(
            'field' => 'survey[]',
            'label' => 'Survey',
            'rules' => 'trim|xss_clean|required'
        ),
        array(
            'field' => 'hospitalId',
            'label' => 'Hospital Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ),
        array(
            'field' => 'questionId',
            'label' => 'Question Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ),
        array(
            'field' => 'optionId',
            'label' => 'Option Id',
            'rules' => 'trim|xss_clean|required|numericCheck'
        ) 
    ),  
    'doctorFeeebackRules' => array(
        array(
            'field' => 'visit_id',
            'label' => 'Visit Id',
            'rules' => 'trim|required|numericCheck'
        ),         
        array(
            'field' => 'comments',
            'label' => 'Comments',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'is_retake',
            'label' => 'Retake',
            'rules' => 'trim|xss_clean|required'
        ),
    ),  
);

