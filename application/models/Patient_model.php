<?php

/* Patient entity related model file 
 * @package        CodeIgniter
 * @author         Atumit Developement Team 
 * @copyright      Copyright(c) 2017 ,Atumit.
 * @Version        version  1.0
 * @Created        20-4-2017
 * @Last Modified  20-04-2017
 * @Last Modifiedby shivajyothi Kandukuri 
 */
require_once 'Common_model.php';

class Patient_model extends Common_model {

    var $id;
    var $medicalRegistrationNumber;
    var $registrationDate;
    var $name;
    var $title;
    var $firstName;
    var $middleName;
    var $lastName;
    var $profilePicture;
    var $age;
    var $dateofBirth;
    var $gender;
    var $guardianName;
    var $guardianRelation;
    var $caste;
    var $religion;
    var $maritalStatus;
    var $occupation;
    var $education;
    var $contactNumber;
    var $alternateContactNumber;
    var $emergencyContactName;
    var $emergencyContactRelation;
    var $emergencyContactNumber;
    var $address;
    var $houseNo;
    var $block;
    var $streetName;
    var $area;
    var $countryId;
    var $stateId;
    var $districtId;
    var $mandalId;
    var $cityId;
    var $villageName;
    var $pincode;
    var $idProofType;
    var $idProofNo;
    var $medicalIncidentCount;
    var $medicalIncidentVisitCount;
    var $bcpUserId;
    var $status;
    var $createdby;
    var $modifiedby;
    var $deleted;

    function __construct() {
        parent::__construct();
        $this->select[] = $this->id;
        //setting the table name ;
        $this->setTableName("patient");
        //Giving alias names to table field names 
        $this->_setFieldNames();
    }

    //set the field values 
    private function _setFieldNames() {
        $this->id = "id";
        $this->medicalRegistrationNumber = "medical_registration_code";
        $this->registrationDate = "registration_date";
        $this->name = "name";
        $this->title = "title";
        $this->firstName = "first_name";
        $this->middleName = "middle_name";
        $this->lastName = "last_name";
        $this->profilePicture = "profile_picture";
        $this->age = "age";
        $this->dateofBirth = "dateofbirth";
        $this->gender = "gender";
        $this->guardianName = "guardian_name";
        $this->guardianRelation = "guardian_relation";
        $this->caste = "caste";
        $this->religion = "religion";
        $this->maritalStatus = "marital_status";
        $this->occupation = "occupation";
        $this->education = "education";
        $this->contactNumber = "contact_number";
        $this->alternateContactNumber = "alternate_contact_number";
        $this->emergencyContactName = "emergency_contact_name";
        $this->emergencyContactRelation = "emergency_contact_relation";
        $this->emergencyContactNumber = "emergency_contact_number";
        $this->address = "address";
        $this->houseNo = "house_no";
        $this->block = "block";
        $this->streetName = "street_name";
        $this->area = "area";
        $this->countryId = "country_id";
        $this->stateId = "state_id";
        $this->districtId = "district_id";
        $this->mandalId = "mandal_id";
        $this->cityId = "city_id";
        $this->villageName = "village_name";
        $this->pincode = "pincode";
        $this->idProofType = "id_proof_type";
        $this->idProofNo = "id_proof_no";
        $this->medicalIncidentCount = "medical_incident_count";
        $this->medicalIncidentVisitCount = "medical_incident_visit_count";
        $this->bcpUserId = "bcp_user_id";
        $this->status = "status";
        $this->createdby = "createdby";
        $this->modifiedby = "modifiedby";
        $this->deleted = "deleted";
    }

}

?>
