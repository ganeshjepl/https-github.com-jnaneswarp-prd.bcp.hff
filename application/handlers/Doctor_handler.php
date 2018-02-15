<?php

/* Prescription related business logic will be defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             15-07-2017
 * @Last Modified       15-07-2017
 * @Last Modified By    Vijay basu
 */

require_once (APPPATH . 'handlers/handler.php');
require_once (APPPATH . 'handlers/Country_handler.php');
require_once (APPPATH . 'handlers/User_handler.php');
require_once (APPPATH . 'handlers/Medicalincident_handler.php');
require_once (APPPATH . 'handlers/Messagetemplate_handler.php');
require_once(APPPATH . 'handlers/email_handler.php');

//require_once (APPPATH . 'handlers/Patient_handler.php');

class Doctor_handler extends Handler {

    var $ci;
    var $patientHandler;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Doctor_model');
        //$this->ci->load->model('Patient_model');
        $this->ci->load->model('User_model');
        $this->ci->load->model('Userdetails_model');
        $this->ci->load->model('Country_model');
        $this->ci->load->model('Userrole_model');
        $this->ci->load->model('Bcpassignment_model');
        ///$this->ci->load->model('Medicalincidentvisit_model');
        //$this->ci->patientHandler = new Patient_handler();
    }

    /*
      // Already defined in Bcpassignment_handler.php
      public function getDoctorBcp($docId) {
      $this->ci->Bcpassignment_model->resetVariable();
      $selectInput = array();
      $bcpAssignmentData = array();
      $where = array();
      $whereInArray = array();

      $selectInput['bcpId'] = $this->ci->Bcpassignment_model->bcpId;

      $where[$this->ci->Bcpassignment_model->doctorId] = $docId;
      $where[$this->ci->Bcpassignment_model->status] = 1;
      $where[$this->ci->Bcpassignment_model->deleted] = 0;

      $this->ci->Bcpassignment_model->setSelect($selectInput);
      $this->ci->Bcpassignment_model->setWhere($where);
      $bcpAssignmentData = $this->ci->Bcpassignment_model->get();
      if (count($bcpAssignmentData) == 0) {
      $output['status'] = TRUE;
      ///$output['response']['message'] = ERROR_NO_BCPASSIGNMENTS;
      $output['response']['messages'][] = $this->ci->lang->line('error_no_bcp_assignment_message');
      $output['response']['total'] = 0;
      $output['statusCode'] = STATUS_NO_DATA;
      return $output;
      }

      $bcp_array = array();
      foreach ($bcpAssignmentData as $key => $val) {
      array_push($bcp_array, $val['bcpId']);
      }
      $output['status'] = TRUE;
      $output['response']['bcpdata'] = $bcp_array;
      $output['response']['total'] = count($bcpAssignmentData);
      $output['statusCode'] = STATUS_OK;
      return $output;
      }
     */

    public function usernameExist($username) {
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $this->ci->User_model->setSelect($selectInput);
        $where[$this->ci->User_model->username] = $username;
        $this->ci->User_model->setWhere($where);
        $userCount = $this->ci->User_model->getCount();

        if ($userCount != 0) {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_user_exists_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
        } else {
            $output['status'] = TRUE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
        }
    }

    /*
      public function usermobileExist($mobile) {
      $this->ci->User_model->resetVariable();
      $selectInput = array();
      $where = array();
      $selectInput['id'] = $this->ci->User_model->id;
      $this->ci->User_model->setSelect($selectInput);
      $where[$this->ci->User_model->mobile] = $mobile;
      $this->ci->User_model->setWhere($where);
      $userCount = $this->ci->User_model->getCount();

      if ($userCount != 0) {
      $output['status'] = FALSE;
      $output['response']['messages'][] = $this->ci->lang->line('error_mobile_exists_message');
      $output['statusCode'] = STATUS_OK;
      return $output;
      } else {
      $output['status'] = TRUE;
      $output['response']['messages'][] = $this->ci->lang->line('error_no_mobile_message');
      ;
      $output['statusCode'] = STATUS_OK;
      return $output;
      }
      }
     */

    public function insertDoctor($inputData) {
        require_once (APPPATH . 'handlers/User_handler.php');
        $this->userHandler = new User_handler();
        $data=array('username'=>$inputData["username"]);
        $userExists =  $this->userHandler->usernameExist($data);

        if ($userExists['status'] == 1) {
            $data=array('mobile'=>$inputData["mobile"]);
            $usermobileExists =$this->userHandler->usermobileExist($data);

            if ($usermobileExists['status'] == 1) {


                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->username] = $inputData["username"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->password] = $this->setSha1($inputData["password"]);
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->email] = $inputData["email"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->firstName] = $inputData["first_name"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->lastName] = $inputData["last_name"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->gender] = $inputData["gender"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->signupdate] = $inputData["signupdate"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->countryid] = $inputData["countryid"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->stateid] = $inputData["stateid"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->cityid] = $inputData["cityid"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->pincode] = $inputData["pincode"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->mobile] = $inputData["mobile"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->alternate_contact_number] = $inputData["alternate_contact_number"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->languageId] = $inputData["language_id"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->profile_picture] = $inputData["profilePicture"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->signature_picture] = $inputData["signaturePicture"];
                $this->ci->User_model->insertUpdateArray[$this->ci->User_model->createdby] = $inputData["sessionUserId"];
                $bcpId = $inputData["bcp_id"];

                //$doctor = $this->ci->Doctor_model->insertdata($this->ci->Doctor_model->dbTable, $this->ci->Doctor_model->insertUpdateArray);  
                $userId = $this->ci->User_model->insertdata($this->ci->User_model->dbTable, $this->ci->User_model->insertUpdateArray);
                if ($userId != '') {
                    $this->ci->Userrole_model->insertUpdateArray[$this->ci->Userrole_model->userId] = $userId;
                    $this->ci->Userrole_model->insertUpdateArray[$this->ci->Userrole_model->role] = $inputData["role"];

                    $result = $this->ci->Userrole_model->insertdata($this->ci->Userrole_model->dbTable, $this->ci->Userrole_model->insertUpdateArray);
                    $this->ci->Bcpassignment_model->resetVariable();
                    if (!empty($bcpId)) {
                        for ($i = 0; $i < count($bcpId); $i++) {
                            $this->ci->Bcpassignment_model->insertUpdateArray[$this->ci->Bcpassignment_model->doctorId] = $userId;
                            $this->ci->Bcpassignment_model->insertUpdateArray[$this->ci->Bcpassignment_model->bcpId] = $bcpId[$i];
                            $this->ci->Bcpassignment_model->insertUpdateArray[$this->ci->Bcpassignment_model->createdby] = $inputData["sessionUserId"];
                            $result = $this->ci->Bcpassignment_model->insertdata($this->ci->Bcpassignment_model->dbTable, $this->ci->Bcpassignment_model->insertUpdateArray);
                        }
                    }
                    if ($this->ci->User_model->transactionStatusCheck() === FALSE) {
                        $this->ci->Bcpassignment_model->rollBackLastTransaction();
                        $this->ci->User_model->rollBackLastTransaction();
                        $this->ci->Userrole_model->rollBackLastTransaction();

                        $output['status'] = FALSE;
                        ///$output["response"]["messages"][] = ERROR_SOMETHING_WENT_WRONG;
                        $output['response']['messages'][] = $this->ci->lang->line('error_something_went_wrong_message');
                        $output['statusCode'] = STATUS_SERVER_ERROR;
                        return $output;
                    } else {
                        $this->ci->Userrole_model->commitLastTransaction();

                        $output['status'] = TRUE;
                        $output["response"]["messages"][] = $this->ci->lang->line('success_user_register_message');
                        $output['statusCode'] = STATUS_CREATED;
                        return $output;
                    }
                } else {
                    $output['status'] = FALSE;
                    ///$output['response']['messages'] = ERROR_INVALID_USER;
                    $output['response']['messages'][] = $this->ci->lang->line('error_invalid_user_message');
                    $output['statusCode'] = STATUS_INVALID_USER;
                    return $output;
                }

                if (count($inputData['bcpId']) > 0) {
                    foreach ($inputData['bcpId'] as $val) {
                        $this->ci->Bcpassignment_model->insertUpdateArray[$this->ci->Bcpassignment_model->doctorId] = $userId;
                        $this->ci->Bcpassignment_model->insertUpdateArray[$this->ci->Bcpassignment_model->bcpId] = $val;
                        $bcpAssign = $this->ci->Bcpassignment_model->insertdata($this->ci->Bcpassignment_model->dbTable, $this->ci->Bcpassignment_model->insertUpdateArray);
                    }
                }



                if ($userId != '') {
                    $output['status'] = TRUE;
                    ///$output['response']['messages'] = SUCCESS_DOCTOR_INSERTED;
                    $output['response']['messages'][] = $this->ci->lang->line('success_doctor_profile_created_message');
                    $output['statusCode'] = STATUS_CREATED;
                    return $output;
                }
                $output['status'] = FALSE;
                ///$output['response']['messages'] = ERROR_INVALID_DATA;
                $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
                $output['statusCode'] = STATUS_BAD_REQUEST;
                return $output;
            } else {
                $output['status'] = FALSE;
                ///$output["response"]["messages"] = ERROR_USER_EXISTS;
                $output['response']['messages'][] = $this->ci->lang->line('error_mobile_exists_message');
                $output['statusCode'] = STATUS_DATA_EXISTS;
                return $output;
            }
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_USER_EXISTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_user_exists_message');
            $output['statusCode'] = STATUS_DATA_EXISTS;
            return $output;
        }
    }

    // to set the sha1 encryption for given parameter 
    public function setSha1($value) {
        return sha1($value);
    }

    public function updateDoctor($inputData) {
        $bcpId = array();
        $doctorData = array();
        $where = array();
        $doctorData['email'] = $inputData["email"];
        $doctorData['first_name'] = $inputData["first_name"];
        $doctorData['last_name'] = $inputData["last_name"];
        $doctorData['gender'] = $inputData['gender'];
        $doctorData['countryid'] = $inputData["countryid"];
        $doctorData['stateid'] = $inputData["stateid"];
        $doctorData['cityid'] = $inputData["cityid"];
        $doctorData['pincode'] = $inputData["pincode"];
        $doctorData['mobile'] = $inputData["mobile"];
        $doctorData['alternate_contact_number'] = $inputData["alternate_contact_number"];
        $doctorData['language_id'] = $inputData["language_id"];
        if ($inputData["profile_picture"] != '') {
            $doctorData['profile_picture'] = $inputData["profile_picture"];
        }
        if ($inputData["signature_picture"] != '') {
            $doctorData['signature_picture'] = $inputData["signature_picture"];
        }

        // $this->ci->Doctor_model->insertUpdateArray['createdby'] =$inputData["sessionUserId"]; 
        $where[$this->ci->User_model->id] = $inputData["id"];
        $this->ci->User_model->setInsertUpdateData($doctorData);
        $this->ci->User_model->setWhere($where);
        $status = $this->ci->User_model->update_data();
        if ($status) {
            $bcpId = $inputData["bcp_id"];
            require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
            $this->bcpassignmentHandler = new Bcpassignment_handler();
            $doctorBcpids=  $this->bcpassignmentHandler->getDoctorBcps($inputData["id"]);
            
            if ($doctorBcpids['status']) {
                if ($doctorBcpids['response']['total'] != 0) {
                    $bcpidList = $doctorBcpids['response']['bcpdata'];
                } else {
                    $bcpidList = array();
                }
            }

            $deleteList = array();
            $this->ci->Bcpassignment_model->resetVariable();
            if (!empty($bcpId)) {
                $deleteList = array_diff($bcpidList, $bcpId);
                $deletebcpData = array();
                $where = array();
                if (count($deleteList) != 0) {
                    foreach ($deleteList as $dkey => $dval) {

                        $deletebcpData['status'] = 0;
                        $where[$this->ci->Bcpassignment_model->bcpId] = $dval;
                        $where[$this->ci->Bcpassignment_model->doctorId] = $inputData["id"];
                        $this->ci->Bcpassignment_model->setInsertUpdateData($deletebcpData);
                        $this->ci->Bcpassignment_model->setWhere($where);
                        $this->ci->Bcpassignment_model->update_data();
                    }
                }
            } else {
                foreach ($bcpidList as $dkey => $dval) {

                    $deletebcpData['status'] = 0;
                    $bcpwhere[$this->ci->Bcpassignment_model->bcpId] = $dval;
                    $bcpwhere[$this->ci->Bcpassignment_model->doctorId] = $inputData["id"];
                    $this->ci->Bcpassignment_model->setInsertUpdateData($deletebcpData);
                    $this->ci->Bcpassignment_model->setWhere($bcpwhere);
                    $this->ci->Bcpassignment_model->update_data();
                }
            }


            $this->ci->Bcpassignment_model->resetVariable();
            $deletebcpData = array();
            $newList = array();


            if (!empty($bcpId)) {
                $newList = array_diff($bcpId, $bcpidList);
                if (!empty($newList)) {
                    foreach ($newList as $ikey => $ival) {
                        $where = array();
                        $selectInput = array();
                        $where[$this->ci->Bcpassignment_model->bcpId] = $ival;
                        $where[$this->ci->Bcpassignment_model->doctorId] = $inputData["id"];
                        $selectInput['id'] = $this->ci->Bcpassignment_model->id;
                        $this->ci->Bcpassignment_model->setSelect($selectInput);
                        $this->ci->Bcpassignment_model->setWhere($where);
                        $bcpstatus = $this->ci->Bcpassignment_model->get();
                        if (count($bcpstatus) == 0) {
                            $this->ci->Bcpassignment_model->insertUpdateArray[$this->ci->Bcpassignment_model->bcpId] = $ival;
                            $this->ci->Bcpassignment_model->insertUpdateArray[$this->ci->Bcpassignment_model->doctorId] = $inputData["id"];
                            $this->ci->Bcpassignment_model->insertUpdateArray[$this->ci->Bcpassignment_model->createdby] = $inputData["sessionUserId"];

                            $this->ci->Bcpassignment_model->insertdata($this->ci->Bcpassignment_model->dbTable, $this->ci->Bcpassignment_model->insertUpdateArray);
                        } else {
                            $deletebcpData['status'] = 1;
                            $where[$this->ci->Bcpassignment_model->bcpId] = $ival;
                            $where[$this->ci->Bcpassignment_model->doctorId] = $inputData["id"];
                            $this->ci->Bcpassignment_model->setInsertUpdateData($deletebcpData);
                            $this->ci->Bcpassignment_model->setWhere($where);
                            $this->ci->Bcpassignment_model->update_data();
                        }
                    }
                }
            }
            $output['status'] = TRUE;
            
            $output['response']['messages']  = $this->ci->lang->line('success_doctor_profile_updated_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
        }
    }

    public function deleteDoctor($inputData) {
        $id = $inputData['id'];
        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        $this->bcpassignmentHandler = new Bcpassignment_handler();
        $doctorBcpids=  $this->bcpassignmentHandler->getDoctorBcps($id);
        
        $bcpidList = array();
        if ($doctorBcpids['status']) {
            if ($doctorBcpids['response']['total'] != 0) {
                $bcpidList = $doctorBcpids['response']['bcpdata'];
            }
        }

        if (count($bcpidList) == 0) {

            $data = array();
            $data['deleted'] = 1;
            $data['status'] = 0;
            $where = array($this->ci->User_model->id => $id);
            $this->ci->User_model->setInsertUpdateData($data);
            $this->ci->User_model->setWhere($where);
            $response = $this->ci->User_model->update_data();
            //print_r($response);
            //exit;

            if ($response) {
                $output['status'] = TRUE;
                $output['response']['messages'] = $this->ci->lang->line('success_doctor_profile_deleted_message');
                ;
                $output['statusCode'] = STATUS_CREATED;
                return $output;
            }
            $output['status'] = FALSE;
            //$output['response']['messages'] = "bcp Assigned";
            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
        } else {
            $output['status'] = FALSE;
            //$output['response']['messages'] = ERROR_INVALID_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('sucess_bcp_assigned_to_doctor');
            $output['statusCode'] = STATUS_OK;
            return $output;
        }
    }

    public function getDoctor($limit = 100, $page = 0, $timestamp = '') {
        $this->user_handler = new User_handler();

        $data = $this->user_handler->getUserLimitData($id = '', $role_fiter = ROLE_DOCTOR);

        if (count($data) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICINE_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_doctor_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['Doctor'] = $data;
        $output['response']['total'] = count($data);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function getPrescriptionRequests($inputData) {
        $this->user_handler = new User_handler();
        $this->medicalincident_handler = new Medicalincident_handler();

        $this->ci->load->model('Prescription_model');
        $this->ci->load->model('Prescriptionrequests_model');
        $this->ci->load->model('Medicalincident_model');


        $docId = $this->ci->session->userid;

        $this->ci->Bcpassignment_model->resetVariable();
        $selectInput = array();
        $bcpAssignmentData = array();
        $where = array();
        $whereInArray = array();

        $selectInput['bcpId'] = $this->ci->Bcpassignment_model->bcpId;

        $where[$this->ci->Bcpassignment_model->doctorId] = $docId;
        $where[$this->ci->Bcpassignment_model->status] = 1;

        $this->ci->Bcpassignment_model->setSelect($selectInput);
        $this->ci->Bcpassignment_model->setWhere($where);
        $this->ci->Bcpassignment_model->setOrWhere($whereInArray);


        $bcpAssignmentData = $this->ci->Bcpassignment_model->get();

        if (count($bcpAssignmentData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'] = ERROR_NO_BCPASSIGNMENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_bcp_assignment_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $bcp_array = array();
        foreach ($bcpAssignmentData as $key => $val) {
            array_push($bcp_array, $val['bcpId']);
        }


        $this->ci->Prescription_model->resetVariable();
        $selectInput = array();
        $prescriptionData = array();
        $where = array();
        $selectInput['prescriptionRequestId'] = $this->ci->Prescription_model->prescriptionRequestId;
        $order[] = " id DESC";
        $where[$this->ci->Prescription_model->prescriptionStatus] = 0;
        $this->ci->Prescription_model->setSelect($selectInput);
//            $this->ci->Prescription_model->setWhere($where);
        $this->ci->Prescription_model->setOrderBy($order);

        $prescriptionData = $this->ci->Prescription_model->get();

//        if (count($prescriptionData) == 0) {
//            $output['status'] = TRUE;
//            $output['response']['message'] = ERROR_NO_PRESCRIPTION_DATA;
//            $output['response']['messages'][] = $this->ci->lang->line('error_prescription_not_found_message');
//            $output['response']['total'] = 0;
//            $output['statusCode'] = STATUS_NO_DATA ;
//            return $output;
//        }
        $prescription_array = array();
        if (!empty($prescriptionData))
            foreach ($prescriptionData as $prescription) {
                if (!in_array($prescription['prescriptionRequestId'], $prescription_array) && !empty($prescription['prescriptionRequestId']))
                    array_push($prescription_array, $prescription['prescriptionRequestId']);
            }
//        debugArray($prescription_array); exit;


        $this->ci->Prescriptionrequests_model->resetVariable();
        $selectInput = array();
        $where = array();
        $whereIn = array();
        $selectInput['id'] = $this->ci->Prescriptionrequests_model->id;
        $selectInput['medical_incident_id'] = $this->ci->Prescriptionrequests_model->medicalIncidentId;
        $selectInput['medical_visit_id'] = $this->ci->Prescriptionrequests_model->medicalVisitId;
        $selectInput['question_id'] = $this->ci->Prescriptionrequests_model->questionId;
        $selectInput['option_id'] = $this->ci->Prescriptionrequests_model->optionId;
        $selectInput['bcpId'] = $this->ci->Prescriptionrequests_model->bcpId;
        $selectInput['registration_date'] = $this->ci->Prescriptionrequests_model->cts;

        $this->ci->Prescriptionrequests_model->setSelect($selectInput);
        $where[$this->ci->Prescriptionrequests_model->deleted] = 0;
        $where[$this->ci->Prescriptionrequests_model->medicalIncidentId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->medicalVisitId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->questionId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->optionId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->status] = 1;
        $where[$this->ci->Prescriptionrequests_model->type] = 1;
        $whereIn[$this->ci->Prescriptionrequests_model->bcpId] = $bcp_array;
//       if(!empty($prescription_array))
//        $whereIn[$this->ci->Prescriptionrequests_model->id]  = $prescription_array;
        $this->ci->Prescriptionrequests_model->setWhere($where);
//       $this->ci->Prescriptionrequests_model->setOrWhere($whereIn); 
        $this->ci->Prescriptionrequests_model->setRecords($inputData['records'], $inputData['offset']);
        $this->ci->Prescriptionrequests_model->orderBy = $this->ci->Prescriptionrequests_model->cts . " DESC";
        $prescriptionRequests = $this->ci->Prescriptionrequests_model->get();

//       debugArray($prescriptionRequests); exit;

        $this->ci->Prescriptionrequests_model->resetVariable();
        $selectInput = array();
        $where = array();
        $whereIn = array();
        $selectInput['id'] = $this->ci->Prescriptionrequests_model->id;
        $selectInput['medical_incident_id'] = $this->ci->Prescriptionrequests_model->medicalIncidentId;
        $selectInput['medical_visit_id'] = $this->ci->Prescriptionrequests_model->medicalVisitId;
        $selectInput['question_id'] = $this->ci->Prescriptionrequests_model->questionId;
        $selectInput['option_id'] = $this->ci->Prescriptionrequests_model->optionId;
        $selectInput['bcpId'] = $this->ci->Prescriptionrequests_model->bcpId;
        $selectInput['registration_date'] = $this->ci->Prescriptionrequests_model->cts;


        $this->ci->Prescriptionrequests_model->setSelect($selectInput);
        $where[$this->ci->Prescriptionrequests_model->deleted] = 0;
        $where[$this->ci->Prescriptionrequests_model->medicalIncidentId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->medicalVisitId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->questionId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->optionId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->status] = 1;
        $whereIn[$this->ci->Prescriptionrequests_model->bcpId] = $bcp_array;
//       if(!empty($prescription_array))
//        $whereIn[$this->ci->Prescriptionrequests_model->id]  = $prescription_array;
        $this->ci->Prescriptionrequests_model->setWhere($where);
//       $this->ci->Prescriptionrequests_model->setOrWhere($whereIn); 
        $this->ci->Prescriptionrequests_model->orderBy = $this->ci->Prescriptionrequests_model->cts . " DESC";
        $prescriptionRequestsCount = $this->ci->Prescriptionrequests_model->get();


//       debugArray($prescriptionRequests); exit;
        if (count($prescriptionRequests) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_PRESCRIPTION_REQUESTS_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_prescription_requests_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $bcpIds = array();
        $incident_ids = array();
        foreach ($prescriptionRequests as $key => $data) {
            if (!in_array($data['medical_incident_id'], $incident_ids)) {
                array_push($incident_ids, $data['medical_incident_id']);
            }
            if (!in_array($data['bcpId'], $bcpIds)) {
                array_push($bcpIds, $data['bcpId']);
            }
            $data['is_sent'] = 0;
            if (in_array($data['id'], $prescription_array)) {
                $data['is_sent'] = 1;
            }
            $prescriptionRequests[$key] = $data;
        }
//       debugArray($prescriptionRequests); exit;


        $this->ci->Medicalincident_model->resetVariable();

        $selectInput = array();
        $where = array();
        $whereIns = array();
        $selectInput['id'] = $this->ci->Medicalincident_model->id;
        $selectInput['patientId'] = $this->ci->Medicalincident_model->patientId;
        $selectInput['bcpUserId'] = $this->ci->Medicalincident_model->bcpUserId;

        $this->ci->Medicalincident_model->setSelect($selectInput);
        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;
        $whereIns[$this->ci->Medicalincident_model->id] = $incident_ids;
        $this->ci->Medicalincident_model->setWhere($where);
        $this->ci->Medicalincident_model->setWhereIns($whereIns);
//       $this->ci->Medicalincidentdetail_model->setRecords($inputData['records'],$inputData['offset']);
        $this->ci->Medicalincident_model->orderBy = $this->ci->Medicalincident_model->mts . " DESC";
        $medical_incidents = $this->ci->Medicalincident_model->get();
//       debugArray($incident_ids); exit;
        if (count($medical_incidents) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $patient_ids = array();
        $final_medical_incidents = null;
        foreach ($medical_incidents as $incident) {
            $final_medical_incidents[$incident['id']] = $incident;
            if (!in_array($incident['patientId'], $patient_ids))
                array_push($patient_ids, $incident['patientId']);
        }



        $bcpData = $this->user_handler->getUserProfile($bcpIds);
        $bcpData = $bcpData['response']['userData'];
        if (count($bcpData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_USER_PROFILE;
            $output['response']['messages'][] = $this->ci->lang->line('error_user_profile_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $final_bcp_data =   null;
        foreach($bcpData as $bcp){
            $final_bcp_data[$bcp['id']] =   $bcp;
        }
        $patientData = $this->medicalincident_handler->getPatientDetails('id', $patient_ids);
        if (count($patientData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_PATIENT_DETAILS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_patient_details_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $final_patient_data = null;
        foreach ($patientData as $patient) {
            $final_patient_data[$patient['id']] = $patient;
        }
        
        foreach ($prescriptionRequests as $key => $data) {
            $data['mrnumber'] = $final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['medicalRegistrationNumber'];
            $data['firstName'] = $final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['firstName'];
            $data['middleName'] = $final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['lastName'];
            $data['registrationDate'] = $final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['registrationDate'];
            $data['pid'] = $final_medical_incidents[$data['medical_incident_id']]['patientId'];
            $data['bcpName'] = (isset($final_bcp_data[$data['bcpId']]))?$final_bcp_data[$data['bcpId']]['firstName'].' '.$final_bcp_data[$data['bcpId']]['lastName']:'';

            $prescriptionRequests[$key] = $data;
        }
        $output['status'] = TRUE;
        $output['response']['requests'] = $prescriptionRequests;
        $output['response']['total'] = count($prescriptionRequestsCount);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

	
    public function getPrescriptionRequestsOffline($inputData) {
        $this->ci->user_handler = new User_handler();
        $this->ci->medicalincident_handler = new Medicalincident_handler();

        $this->ci->load->model('Prescription_model');
        $this->ci->load->model('Prescriptionrequests_model');
        //$this->ci->load->model('Medicalincident_model');


        $docId = $this->ci->session->userid;

        $this->ci->Bcpassignment_model->resetVariable();
        $selectInput = array();
        $bcpAssignmentData = array();
        $where = array();
        $whereInArray = array();

        $selectInput['bcpId'] = $this->ci->Bcpassignment_model->bcpId;

        $where[$this->ci->Bcpassignment_model->doctorId] = $docId;
        $where[$this->ci->Bcpassignment_model->status] = 1;

        $this->ci->Bcpassignment_model->setSelect($selectInput);
        $this->ci->Bcpassignment_model->setWhere($where);
        $this->ci->Bcpassignment_model->setOrWhere($whereInArray);


        $bcpAssignmentData = $this->ci->Bcpassignment_model->get();

        if (count($bcpAssignmentData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'] = ERROR_NO_BCPASSIGNMENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_bcp_assignment_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $bcp_array = array();
        foreach ($bcpAssignmentData as $key => $val) {
            array_push($bcp_array, $val['bcpId']);
        }


        $this->ci->Prescription_model->resetVariable();
        $selectInput = array();
        $prescriptionData = array();
        $where = array();
        $selectInput['prescriptionRequestId'] = $this->ci->Prescription_model->prescriptionRequestId;
		$order[] = " id DESC";
        $where[$this->ci->Prescription_model->prescriptionStatus] = 0;
        $this->ci->Prescription_model->setSelect($selectInput);
//            $this->ci->Prescription_model->setWhere($where);
        $this->ci->Prescription_model->setOrderBy($order);

        $prescriptionData = $this->ci->Prescription_model->get();

//        if (count($prescriptionData) == 0) {
//            $output['status'] = TRUE;
//            $output['response']['message'] = ERROR_NO_PRESCRIPTION_DATA;
//            $output['response']['messages'][] = $this->ci->lang->line('error_prescription_not_found_message');
//            $output['response']['total'] = 0;
//            $output['statusCode'] = STATUS_NO_DATA ;
//            return $output;
//        }
        $prescription_array = array();
        if (!empty($prescriptionData))
            foreach ($prescriptionData as $prescription) {
                if (!in_array($prescription['prescriptionRequestId'], $prescription_array) && !empty($prescription['prescriptionRequestId']))
                    array_push($prescription_array, $prescription['prescriptionRequestId']);
            }
//        debugArray($prescription_array); exit;


        $this->ci->Prescriptionrequests_model->resetVariable();
        $selectInput = array();
        $where = array();
        $whereIn = array();
        $selectInput['id'] = $this->ci->Prescriptionrequests_model->id;
        $selectInput['medical_incident_id'] = $this->ci->Prescriptionrequests_model->medicalIncidentId;
        $selectInput['medical_visit_id'] = $this->ci->Prescriptionrequests_model->medicalVisitId;
        $selectInput['question_id'] = $this->ci->Prescriptionrequests_model->questionId;
        $selectInput['option_id'] = $this->ci->Prescriptionrequests_model->optionId;
        $selectInput['bcpId'] = $this->ci->Prescriptionrequests_model->bcpId;
        $selectInput['registration_date'] = $this->ci->Prescriptionrequests_model->requestDate;
		$selectInput['patient_id'] = $this->ci->Prescriptionrequests_model->patientId;


        $this->ci->Prescriptionrequests_model->setSelect($selectInput);
        $where[$this->ci->Prescriptionrequests_model->deleted] = 0;
        //$where[$this->ci->Prescriptionrequests_model->medicalIncidentId . ' > '] = 0;
        //$where[$this->ci->Prescriptionrequests_model->medicalVisitId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->questionId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->optionId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->status] = 1;
        $where[$this->ci->Prescriptionrequests_model->type] = 1;
        $whereIn[$this->ci->Prescriptionrequests_model->bcpId] = $bcp_array;
//       if(!empty($prescription_array))
//        $whereIn[$this->ci->Prescriptionrequests_model->id]  = $prescription_array;
        $this->ci->Prescriptionrequests_model->setWhere($where);
//       $this->ci->Prescriptionrequests_model->setOrWhere($whereIn); 
        $this->ci->Prescriptionrequests_model->setRecords($inputData['records'], $inputData['offset']);
        $this->ci->Prescriptionrequests_model->orderBy = $this->ci->Prescriptionrequests_model->cts . " DESC";
        $prescriptionRequests = $this->ci->Prescriptionrequests_model->get();

      // debugArray($prescriptionRequests); exit;

        $this->ci->Prescriptionrequests_model->resetVariable();
        $selectInput = array();
        $where = array();
        $whereIn = array();
        $selectInput['id'] = $this->ci->Prescriptionrequests_model->id;
        $selectInput['medical_incident_id'] = $this->ci->Prescriptionrequests_model->medicalIncidentId;
        $selectInput['medical_visit_id'] = $this->ci->Prescriptionrequests_model->medicalVisitId;
        $selectInput['question_id'] = $this->ci->Prescriptionrequests_model->questionId;
        $selectInput['option_id'] = $this->ci->Prescriptionrequests_model->optionId;
        $selectInput['bcpId'] = $this->ci->Prescriptionrequests_model->bcpId;
        $selectInput['registration_date'] = $this->ci->Prescriptionrequests_model->requestDate;
		$selectInput['patient_id'] = $this->ci->Prescriptionrequests_model->patientId;


        $this->ci->Prescriptionrequests_model->setSelect($selectInput);
        $where[$this->ci->Prescriptionrequests_model->deleted] = 0;
        //$where[$this->ci->Prescriptionrequests_model->medicalIncidentId . ' > '] = 0;
        //$where[$this->ci->Prescriptionrequests_model->medicalVisitId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->questionId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->optionId . ' > '] = 0;
        $where[$this->ci->Prescriptionrequests_model->status] = 1;
        $whereIn[$this->ci->Prescriptionrequests_model->bcpId] = $bcp_array;
//       if(!empty($prescription_array))
//        $whereIn[$this->ci->Prescriptionrequests_model->id]  = $prescription_array;
        $this->ci->Prescriptionrequests_model->setWhere($where);
//       $this->ci->Prescriptionrequests_model->setOrWhere($whereIn); 
        $this->ci->Prescriptionrequests_model->orderBy = $this->ci->Prescriptionrequests_model->cts . " DESC";
        $prescriptionRequestsCount = $this->ci->Prescriptionrequests_model->get();


//       debugArray($prescriptionRequests); exit;
        if (count($prescriptionRequests) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_PRESCRIPTION_REQUESTS_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_prescription_requests_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $bcpIds = array();
        $incident_ids = array();
		$patient_ids = array();
        foreach ($prescriptionRequests as $key => $data) {
            if (!in_array($data['patient_id'], $patient_ids)) {
                array_push($patient_ids, $data['patient_id']);
            }
            if (!in_array($data['bcpId'], $bcpIds)) {
                array_push($bcpIds, $data['bcpId']);
            }
            $data['is_sent'] = 0;
            if (in_array($data['id'], $prescription_array)) {
                $data['is_sent'] = 1;
            }
            $prescriptionRequests[$key] = $data;
        }
		
//       debugArray($prescriptionRequests); exit;

/*
        $this->ci->Medicalincident_model->resetVariable();

        $selectInput = array();
        $where = array();
        $whereIns = array();
        $selectInput['id'] = $this->ci->Medicalincident_model->id;
        $selectInput['patientId'] = $this->ci->Medicalincident_model->patientId;
        $selectInput['bcpUserId'] = $this->ci->Medicalincident_model->bcpUserId;

        $this->ci->Medicalincident_model->setSelect($selectInput);
        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;
        $whereIns[$this->ci->Medicalincident_model->id] = $incident_ids;
        $this->ci->Medicalincident_model->setWhere($where);
        $this->ci->Medicalincident_model->setWhereIns($whereIns);
//       $this->ci->Medicalincidentdetail_model->setRecords($inputData['records'],$inputData['offset']);
        $this->ci->Medicalincident_model->orderBy = $this->ci->Medicalincident_model->mts . " DESC";
        $medical_incidents = $this->ci->Medicalincident_model->get();
//       debugArray($incident_ids); exit;
        if (count($medical_incidents) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $patient_ids = array();
        $final_medical_incidents = null;
        foreach ($medical_incidents as $incident) {
            $final_medical_incidents[$incident['id']] = $incident;
            if (!in_array($incident['patientId'], $patient_ids))
                array_push($patient_ids, $incident['patientId']);
        }
*/

		
        $bcpData = $this->ci->user_handler->getUserProfile($bcpIds);
        $bcpData = $bcpData['response']['userData'];
        if (count($bcpData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_USER_PROFILE;
            $output['response']['messages'][] = $this->ci->lang->line('error_user_profile_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $final_bcp_data =   null;
        foreach($bcpData as $bcp){
            $final_bcp_data[$bcp['id']] =   $bcp;
        }
		
        $patientData = $this->ci->medicalincident_handler->getPatientDetails('id', $patient_ids);
		
        if (count($patientData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_PATIENT_DETAILS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_patient_details_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $final_patient_data = null;
        foreach ($patientData as $patient) {
            $final_patient_data[$patient['id']] = $patient;
        }
        
        foreach ($prescriptionRequests as $key => $data) {
			
            $data['mrnumber'] = $final_patient_data[$data['patient_id']]['medicalRegistrationNumber'];
            $data['firstName'] = $final_patient_data[$data['patient_id']]['firstName'];
            $data['middleName'] = $final_patient_data[$data['patient_id']]['lastName'];
            $data['registrationDate'] = $final_patient_data[$data['patient_id']]['registrationDate'];
            $data['pid'] = $data['patient_id'];
            $data['bcpName'] = (isset($final_bcp_data[$data['bcpId']]))?$final_bcp_data[$data['bcpId']]['firstName'].' '.$final_bcp_data[$data['bcpId']]['lastName']:'';

            $prescriptionRequests[$key] = $data;
        }
        $output['status'] = TRUE;
        $output['response']['requests'] = $prescriptionRequests;
        $output['response']['total'] = count($prescriptionRequestsCount);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }


    public function getPrePrescriptionDetails($inputData) {
       //debugArray($inputData); exit;
        $hff_media_path = $this->ci->config->item('hff_media_path');

        require_once (APPPATH . 'handlers/Prescription_detail_handler.php');
        require_once (APPPATH . 'handlers/MedicineCatalog_handler.php');
        require_once (APPPATH . 'handlers/Survey_questionnaire_option_handler.php');
        require_once (APPPATH . 'handlers/Survey_questionnaire_handler.php');
        require_once (APPPATH . 'handlers/Taxonomy_handler.php');
        require_once (APPPATH . 'handlers/Survey_taxonomy_handler.php');
        require_once (APPPATH . 'handlers/Survey_handler.php');
        
        $this->user_handler = new User_handler();
        $this->medicalincident_handler = new Medicalincident_handler();
        $this->prescription_detail_handler = new Prescription_detail_handler();
        $this->MedicineCatalog_handler = new MedicineCatalog_handler();
        $this->SurveryQuestionOptionHandler = new Survey_questionnaire_option_handler();
        $this->SurveryQuestionnaireHandler = new Survey_questionnaire_handler();
        $this->TaxonomyHandler = new Taxonomy_handler();
        $this->SurveyTaxonomyHandler = new Survey_taxonomy_handler();
        $this->SurveyHandler = new Survey_handler();

        $this->ci->load->model('Prescriptionrequests_model');
        $this->ci->load->model('Prescriptiondetail_model');
        $this->ci->load->model('Prescription_model');
        $this->ci->load->model('Medicalincident_model');
        $this->ci->load->model('Medicalincidentvisit_model');
        $this->ci->load->model('Bcpassignment_model');
        $medicine = null;

        if ($inputData['type'] >= 1) {
            $this->ci->Prescription_model->resetVariable();
            $selectInput = array();
            $where = array();
            $prescriptionStatus = array();
            $selectInput['id'] = $this->ci->Prescription_model->id;
            $selectInput['doctorId'] = $this->ci->Prescription_model->doctorId;
            $selectInput['prescriptionDate'] = $this->ci->Prescription_model->doctorId;
            $this->ci->Prescription_model->setSelect($selectInput);
//            $this->ci->Prescription_model->setRecords(1);        

            $where[$this->ci->Prescription_model->prescriptionStatus.'>= '] = 1;

            $where[$this->ci->Prescription_model->prescriptionRequestId] = $inputData['prescription_id'];
            $this->ci->Prescription_model->setWhere($where);
            $prescriptionStatus = $this->ci->Prescription_model->get();
            print_r($prescriptionStatus); exit;
            if (count($prescriptionStatus) == 0) {
                $output['status'] = TRUE;
                $output['response']['messages'][] = $this->ci->lang->line('error_prescription_details_not_found_message');
                $output['response']['total'] = 0;
                $output['statuscode'] = STATUS_NO_DATA;
                return $output;
            } else {
                
                $medicine = $this->prescription_detail_handler->getPrescriptionMedicine($prescriptionStatus[0]['id']);
            }
            $medicine_ids = array();
            if (isset($medicine['response']['prescription']) && !empty($medicine['response']['prescription'])) {
                foreach ($medicine['response']['prescription'] as $medicineid) {
                    $medicine_ids[] = $medicineid['medicine_id'];
                }
            }else{
                return $medicine;
            }
            $timestamp  =   '';
            if ($inputData['type'] == 0) {
                $config_exp_days    =   $this->ci->config->item('medicine_expiry_days');
                $timestamp          =   date('Y-m-d H:i:s',($_SERVER['REQUEST_TIME']+($config_exp_days*24*60*60)));
            }
            
            
            $medicine_list = $this->MedicineCatalog_handler->getMedicineCatalog($medicine_ids,'','',$timestamp);
            $final_medicine_list = array();
            if (isset($medicine_list['response']['medicineCatalog']) && !empty($medicine_list['response']['medicineCatalog'])) {
                foreach ($medicine_list['response']['medicineCatalog'] as $medicineName) {
                    $final_medicine_list[$medicineName['id']] = array(
                        'name' => $medicineName['name'],
                        'dosage' => $medicineName['dosage'],
                    );
                }
            }
            
            if (isset($medicine['response']['prescription']) && !empty($medicine['response']['prescription'])) {
                foreach ($medicine['response']['prescription'] as $key => $medicineid) {
                    
                    if (isset($final_medicine_list[$medicineid['medicine_id']])) {
                        $medicine['response']['prescription'][$key]['name'] = $final_medicine_list[$medicineid['medicine_id']]['name'];
                        $medicine['response']['prescription'][$key]['dosage'] = $final_medicine_list[$medicineid['medicine_id']]['dosage'];
                    }else{
                        $medicine['response']['prescription'][$key]['name'] = '';
                        $medicine['response']['prescription'][$key]['dosage'] = '';
                    }
                }
            }
            
        }



        $this->ci->Prescriptionrequests_model->resetVariable();
        $selectInput = array();
        $where = array();
        $selectInput['id'] = $this->ci->Prescriptionrequests_model->id;
        $selectInput['prescription_code'] = $this->ci->Prescriptionrequests_model->prescriptionCode;
        $selectInput['medical_incident_id'] = $this->ci->Prescriptionrequests_model->medicalIncidentId;
        $selectInput['medical_visit_id'] = $this->ci->Prescriptionrequests_model->medicalVisitId;
        $selectInput['question_id'] = $this->ci->Prescriptionrequests_model->questionId;
        $selectInput['option_id'] = $this->ci->Prescriptionrequests_model->optionId;
        $selectInput['bcpId'] = $this->ci->Prescriptionrequests_model->bcpId;
		$selectInput['patientId'] = $this->ci->Prescriptionrequests_model->patientId;
        $selectInput['registration_date'] = $this->ci->Prescriptionrequests_model->requestDate;

        $this->ci->Prescriptionrequests_model->setSelect($selectInput);
        $where[$this->ci->Prescriptionrequests_model->deleted] = 0;
        $where[$this->ci->Prescriptionrequests_model->status] = 1;
        $where[$this->ci->Prescriptionrequests_model->id] = $inputData['prescription_id'];
        $this->ci->Prescriptionrequests_model->setWhere($where);
//       $this->ci->Prescriptionrequests_model->setRecords($inputData['records'],$inputData['offset']);
        $this->ci->Prescriptionrequests_model->orderBy = $this->ci->Prescriptionrequests_model->cts . " DESC";
        $prescriptionRequests = $this->ci->Prescriptionrequests_model->get();
//       debugArray($prescriptionRequests); exit;
        if (count($prescriptionRequests) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_PRESCRIPTION_REQUESTS_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_prescription_requests_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }

        $bcpId          = $prescriptionRequests[0]['bcpId'];
        $incident_id    = $prescriptionRequests[0]['medical_incident_id'];
        $visit_id       = $prescriptionRequests[0]['medical_visit_id'];
        $option_id      = $prescriptionRequests[0]['option_id'];
		$patient_id      = $prescriptionRequests[0]['patientId'];
        $registration_date = $prescriptionRequests[0]['registration_date'];
        
        $taxanomy_name  =   '';
        $cc_name        =   '';
        $option_title   =   '';
        if(!empty($option_id)){
            $questionDetails    =   $this->SurveryQuestionOptionHandler->getOptionDetails($option_id);
            if(isset($questionDetails['response']['question_ids']) && !empty($questionDetails['response']['question_ids'])){
                
                $question_id    =   $questionDetails['response']['question_ids'][0]['question_id'];
                $option_title   =   $questionDetails['response']['question_ids'][0]['label'];
                
                if(!empty($question_id)){
                    $details = $this->SurveryQuestionnaireHandler->getSurveyIdByQuestion($question_id);
                    
                    if(isset($details['response']['question_ids']) && !empty($details['response']['question_ids'])){
                        $survey_taxanomy_details   =   $this->SurveyTaxonomyHandler->getSurveyTaxonomyDetails($details['response']['question_ids'][0]['survey_taxanomy_id']);
                        $survey_details   =   $this->SurveyHandler->getSurveyNameById($details['response']['question_ids'][0]['survey_id']);
                        if(isset($survey_details['response']['survey']) && !empty($survey_details['response']['survey'])){
                            $cc_name    =   $survey_details['response']['survey'][0]['name'];
                        }
                        if(!empty($survey_taxanomy_details)){
                            $taxanomy_details   =   $this->TaxonomyHandler->getTaxonomyDetails($survey_taxanomy_details[0]['id']);
                            if(!empty($taxanomy_details)){
                                $taxanomy_name  =   $taxanomy_details[0]['name'];
                            }
                        }
                        
                    }
                }
            }
        }
        $prescription_for   =   array(
            'cc_name'   => $cc_name,
            'taxanomy'  => $taxanomy_name,
            'option'    => $option_title
        );
        /*
        
        $this->ci->Medicalincident_model->resetVariable();

        $selectInput = array();
        $where = array();
        $whereIns = array();
        $selectInput['id'] = $this->ci->Medicalincident_model->id;
//       $selectInput['visitId'] =$this->ci->Medicalincident_model->medicalIncidentVisitId;
        $selectInput['patientId'] = $this->ci->Medicalincident_model->patientId;
        $selectInput['bcpUserId'] = $this->ci->Medicalincident_model->bcpUserId;

        $this->ci->Medicalincident_model->setSelect($selectInput);
        $where[$this->ci->Medicalincident_model->deleted] = 0;
        $where[$this->ci->Medicalincident_model->status] = 1;
        $whereIns[$this->ci->Medicalincident_model->id] = $incident_id;
        $this->ci->Medicalincident_model->setWhere($where);
        $this->ci->Medicalincident_model->setWhereIns($whereIns);
//       $this->ci->Medicalincidentdetail_model->setRecords($inputData['records'],$inputData['offset']);
        $this->ci->Medicalincident_model->orderBy = $this->ci->Medicalincident_model->mts . " DESC";
        $medical_incidents = $this->ci->Medicalincident_model->get();

        if (count($medical_incidents) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        } */
        /*$patient_id = $medical_incidents[0]['patientId'];
        

        $this->ci->Medicalincidentvisit_model->resetVariable();

        $selectInput = array();
        $where = array();
        $whereIns = array();
        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $selectInput['visit_code'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $selectInput['registration_date'] = $this->ci->Medicalincidentvisit_model->registrationDate;
        
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $whereIns[$this->ci->Medicalincidentvisit_model->medicalIncidentId] = $incident_id;
        $this->ci->Medicalincidentvisit_model->setWhere($where);
        $this->ci->Medicalincidentvisit_model->setWhereIns($whereIns);
//       $this->ci->Medicalincidentdetail_model->setRecords($inputData['records'],$inputData['offset']);
        $this->ci->Medicalincidentvisit_model->orderBy = $this->ci->Medicalincidentvisit_model->mts . " DESC";
        $medical_incident_visit_details = $this->ci->Medicalincidentvisit_model->get();
        
        if (count($medical_incident_visit_details) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        } */
        $visit_date = $medical_incident_visit_details[0]['registration_date'];
        $visit_code = $medical_incident_visit_details[0]['visit_code'];

        $docId = $this->ci->session->userid;
        if($inputData['type'] >= 1){
            if(isset($prescriptionStatus[0]['doctorId']) && !empty($prescriptionStatus[0]['doctorId'])){
                $docId = $prescriptionStatus[0]['doctorId'];
            }
        }
        
        $doctor_profile = $this->user_handler->getDoctorProfile($docId);
        $final_doctor_profile = null;
        foreach ($doctor_profile as $data) {
            $final_doctor_profile = $data;
        }


        $final_medical_incident_visit_details = null;
        foreach ($medical_incident_visit_details as $key => $data) {
            $final_medical_incident_visit_details[$data['id']] = $data;
        }
        

        $patient_ids = array();
        $final_medical_incidents = null;
        foreach ($medical_incidents as $incident) {
            $final_medical_incidents[$incident['id']] = $incident;
            if (!in_array($incident['patientId'], $patient_ids))
                array_push($patient_ids, $incident['patientId']);
        }




        $bcpData = $this->user_handler->getUserProfile($bcpId);
        $bcpData = $bcpData['response']['userData'];
        if (count($bcpData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_USER_PROFILE;
            $output['response']['messages'][] = $this->ci->lang->line('error_user_profile_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }

        $patientData = $this->medicalincident_handler->getPatientDetails('id', $patient_id);
        if (count($patientData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_PATIENT_DETAILS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_patient_details_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }

        $final_patient_data = null;
        foreach ($patientData as $patient) {
            $final_patient_data[$patient['id']] = $patient;
            $patient_data[] = $patient;
        }

//       debugArray($final_medical_incidents); exit;
        foreach ($prescriptionRequests as $key => $data) {
            $data['mrnumber'] = (isset($final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['medicalRegistrationNumber'])) ? $final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['medicalRegistrationNumber'] : '';
            $data['firstName'] = (isset($final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['firstName'])) ? $final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['firstName'] : '';
            $data['middleName'] = (isset($final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['middleName'])) ? $final_patient_data[$final_medical_incidents[$data['medical_incident_id']]['patientId']]['middleName'] : '';
            $data['visitregistrationDate'] = (isset($final_medical_incident_visit_details[$data['medical_visit_id']]['registration_date'])) ? $final_medical_incident_visit_details[$data['medical_visit_id']]['registration_date'] : '';
            $data['visitCode'] = (isset($final_medical_incident_visit_details[$data['medical_visit_id']]['visit_code'])) ? $final_medical_incident_visit_details[$data['medical_visit_id']]['visit_code'] : '';
            $data['drName'] = $final_doctor_profile['firstName'] . ' ' . trim($final_doctor_profile['lastName']);


            $prescriptionRequests[$key] = $data;
        }
        
        

        $output['status'] = TRUE;
        $output['response']['doctorDetails'] = $doctor_profile;
        $output['response']['bcpDetails'] = $bcpData;
        $output['response']['patientDetails'] = $patient_data;
        $output['response']['prescriptionDetails'] = $prescriptionRequests;
        $output['response']['prescriptionMedicine'] = $medicine['response']['prescription'];
        $output['response']['medicalNotes'] = $prescription_for;
//       $output['response']['total']=count($prescriptionRequests);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function getPrePrescriptionDetailsForAdd($inputData) {

        $hff_media_path = $this->ci->config->item('hff_media_path');

        $this->userHandler = new User_handler();

        $docId = $this->ci->session->userid;


        $doctor_profile = $this->userHandler->getDoctorProfile($docId);
        $final_doctor_profile = null;
        foreach ($doctor_profile as $data) {
            $final_doctor_profile = $data;
        }
        $output['docotrDetails'] = $final_doctor_profile;
        return $output;

        $output['status'] = TRUE;
        $output['response']['doctorDetails'] = $final_doctor_profile;
//       $output['response']['total']=count($prescriptionRequests);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function getMedicineCatelog($inputData) {

        $this->ci->load->model('MedicineCatalog_model');



        $this->ci->MedicineCatalog_model->resetVariable();

        $selectInput = array();
        $where = array();

        $selectInput['id'] = $this->ci->MedicineCatalog_model->id;
        $selectInput['name'] = 'concat(' . $this->ci->MedicineCatalog_model->name . ',"-",' . $this->ci->MedicineCatalog_model->dosage . ')';
        $selectInput['dosage'] = $this->ci->MedicineCatalog_model->dosage;

        $like[$this->ci->MedicineCatalog_model->name] = $inputData['search'];
        $like[$this->ci->MedicineCatalog_model->dosage] = $inputData['search'];
        $this->ci->MedicineCatalog_model->setOrWhere($like, 'or', 'like');


        $this->ci->MedicineCatalog_model->setSelect($selectInput);

        $where = array(
            $this->ci->MedicineCatalog_model->deleted => 0,
            $this->ci->MedicineCatalog_model->status => 1,
            $this->ci->MedicineCatalog_model->expiry_date . ' >=' => date('Y-m-d', strtotime("+" . $inputData['exp_days'] . " days"))
        );
        $this->ci->MedicineCatalog_model->setWhere($where);


//       $this->ci->Doctor_model->setRecords($limit,$page);

        $this->ci->MedicineCatalog_model->orderBy = $this->ci->MedicineCatalog_model->name . " ASC";

        $medicine_catelog = $this->ci->MedicineCatalog_model->get();



        if (count($medicine_catelog) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICINE_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_medicine_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['medicine_catelog'] = $medicine_catelog;
        $output['response']['total'] = count($medicine_catelog);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function getDrugHistory($limit = 100, $page = 0, $timestamp = '') {
        //$where = array($this->ci->Doctor_model->id => $id);
        $this->ci->Doctor_model->resetVariable();
        $selectInput = array();
        $doctor = array();
        $where = array();
        $selectInput['id'] = $this->ci->Doctor_model->id;
        $selectInput['username'] = $this->ci->Doctor_model->username;
        $selectInput['password'] = $this->ci->Doctor_model->password;
        $selectInput['email'] = $this->ci->Doctor_model->email;
        $selectInput['first_name'] = $this->ci->Doctor_model->first_name;
        $selectInput['last_name'] = $this->ci->Doctor_model->last_name;
        $selectInput['signupdate'] = $this->ci->Doctor_model->signupdate;
        $selectInput['countryid'] = $this->ci->Doctor_model->countryid;
        $selectInput['stateid'] = $this->ci->Doctor_model->stateid;
        $selectInput['cityid'] = $this->ci->Doctor_model->cityid;
        $selectInput['pincode'] = $this->ci->Doctor_model->pincode;
        $selectInput['mobile'] = $this->ci->Doctor_model->mobile;
        $selectInput['alternate_contact_number'] = $this->ci->Doctor_model->alternate_contact_number;
        $selectInput['language_id'] = $this->ci->Doctor_model->language_id;
        $selectInput['profile_picture'] = $this->ci->Doctor_model->profile_picture;
        $selectInput['signature_picture'] = $this->ci->Doctor_model->signature_picture;

        $this->ci->Doctor_model->setSelect($selectInput);

        $where = array($this->ci->Doctor_model->deleted => 0, $this->ci->Doctor_model->status => 1);
        if (isset($timestamp) && ($timestamp != '')) {
            $where[$this->ci->Doctor_model->cts . " >="] = $timestamp;
        }
        $this->ci->Doctor_model->setWhere($where);

        if (($limit > 100) || ($limit == '')) {
            $limit = 100;
        }
        if ($page > 0) {
            $page = ($page - 1);
            $page = ($limit) * $page;
        }
        $this->ci->Doctor_model->setRecords($limit, $page);

        $this->ci->Doctor_model->orderBy = "first_name asc";

        $doctor = $this->ci->Doctor_model->get();

        $CountryIdData = commonHelperGetIdArray($doctor, 'countryid');
        $CountryIds = implode(",", array_keys($CountryIdData));
        $selectInput = array();
        $whereIn = array();
        $selectInput['country'] = $this->ci->Country_model->name;
        $this->ci->Country_model->setSelect($selectInput);
        $whereIn[$this->ci->Country_model->id] = $CountryIds;
        $this->ci->Country_model->setWhereIns($whereIn);
        $CountryData = $this->ci->Country_model->get();

        print_r($whereIn);

        if (count($doctor) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICINE_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_medicine_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['Doctor'] = $doctor;
        $output['response']['total'] = count($doctor);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function updateDoctorProfile($inputData) {

        $this->ci->load->model('User_model');
        $this->ci->load->model('Userdetails_model');

        $whereUser = array();
        $where = array();
        $whereUserrole = array();
        //print_r($inputData['userId']); exit;

        $userData['first_name'] = strip_tags($inputData["firstName"]);
        $userData['last_name'] = strip_tags($inputData["lastName"]);
        $userData['email'] = $inputData["email"];
        $userData['countryid'] = $inputData["countryid"];
        $userData['stateid'] = $inputData["stateid"];
        $userData['cityid'] = $inputData["cityid"];
        $userData['mobile'] = $inputData["mobile"];
        $userData['alternate_contact_number'] = isset($inputData["alternatecontact"])?$inputData["alternatecontact"]:'';

        if (isset($inputData["profilePicture"]) && !empty($inputData["profilePicture"])) {
            $userData['profile_picture'] = $inputData["profilePicture"];
        }
        if (isset($inputData["signaturePicture"]) && !empty($inputData["signaturePicture"])) {
            $userData['signature_picture'] = $inputData["signaturePicture"];
        }

        $this->ci->User_model->setInsertUpdateData($userData);

        $userDetailsData['gender'] = $inputData["gender"];
        $userDetailsData['highest_qualification'] = $inputData["education"];
        $userDetailsData['date_of_birth'] = $inputData["date_of_birth"];


        $selectInput['user_id'] = $this->ci->Userdetails_model->user_id;
        $this->ci->Userdetails_model->setSelect($selectInput);
        $where = array($this->ci->Userdetails_model->deleted => 0, $this->ci->Userdetails_model->status => 1, $this->ci->Userdetails_model->user_id => $inputData['userId']);
        $this->ci->Userdetails_model->setWhere($where);
        $doctor = $this->ci->Userdetails_model->getCount();
        //print_r($doctor); exit;
        if ($doctor === 0) {
            $this->ci->Userdetails_model->insertUpdateArray[$this->ci->Userdetails_model->user_id] = $inputData["userId"];
            $this->ci->Userdetails_model->insertUpdateArray[$this->ci->Userdetails_model->gender] = $inputData["gender"];
            $this->ci->Userdetails_model->insertUpdateArray[$this->ci->Userdetails_model->date_of_birth] = $inputData["date_of_birth"];
            $this->ci->Userdetails_model->insertUpdateArray[$this->ci->Userdetails_model->highest_qualification] = $inputData["education"];
            $userDetails = $this->ci->Userdetails_model->insertdata($this->ci->Userdetails_model->dbTable, $this->ci->Userdetails_model->insertUpdateArray);
        } else {
            $where = array();
            $this->ci->Userdetails_model->setInsertUpdateData($userDetailsData);
            $where[$this->ci->Userdetails_model->user_id] = $inputData['userId'];
            $this->ci->Userdetails_model->setWhere($where);
            $details = $this->ci->Userdetails_model->update_data();
            //echo $this->ci->db->last_query();
            //print_r($where);exit;
        }

        $whereUser[$this->ci->User_model->id] = $inputData['userId'];

        $this->ci->User_model->setWhere($whereUser);
        $this->ci->Userdetails_model->setWhere($whereUserrole);

        $response = $this->ci->User_model->update_data();


        if ($response) {
            $output['status'] = TRUE;
            ///$output["response"]["messages"] = ERROR_PROFILE_UPDATE_SUCCESS;
            $output['response']['messages'][] = $this->ci->lang->line('success_profile_update_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
            //print_r($output);
        }
    }

    public function savePrescription($fullInputData) {
		

        $this->ci->load->model('Prescription_model');
        $this->ci->load->model('Prescriptiondetail_model');
        require_once (APPPATH . 'handlers/Userdevices_handler.php');


        $this->deviceHandler = new Userdevices_handler();
        $this->Messagetemplate_handler = new Messagetemplate_handler();
        $this->Medicalincident_handler = new Medicalincident_handler();
        $this->Userhandler = new User_handler();



        $whereUser = array();
        $whereUserrole = array();


        $this->ci->Prescription_model->resetVariable();
        $selectInput = array();
        $prescriptionData = array();
        $selectInput['id'] = $this->ci->Prescription_model->id;
        $selectInput['prescriptionCode'] = $this->ci->Prescription_model->prescriptionCode;
        $selectInput['medicalVisitId'] = $this->ci->Prescription_model->medicalVisitId;
        $order[] = " id DESC";
        $this->ci->Prescription_model->setSelect($selectInput);
        $this->ci->Prescription_model->setOrderBy($order);
        $this->ci->Prescription_model->setRecords(1);
        $prescriptionData = $this->ci->Prescription_model->get();
//            debugArray($prescriptionData); exit;
        if (count($prescriptionData) > 0) {
            $presCode = $prescriptionData[0]['prescriptionCode'];
            $prePresNum = $this->returnIntValFromString($presCode);
            $newPresNum = $prePresNum + 1;
            $prescriptionCode = $this->ci->session->countryshortname . '/' . PRESCRIPTION_STRING . $newPresNum;
            $prec_code = $prescriptionCode;
        } else {
            $prec_code = $this->ci->session->countryshortname . '/' . PRESCRIPTION_STRING . '1';
        }
//            debugArray($fullInputData); exit;
//            $visit_id =   $prescriptionData[0]['medicalVisitId'];
        $visit_details = $this->Medicalincident_handler->checkMedicalIncidentVisitByVisitId($fullInputData[0]["visit_id"]);

        if (!isset($visit_details[0]['medicalIncidentVisitCode'])) {
            $visit_details[0]['medicalIncidentVisitCode'] = '';
        }
        $fullInputData[0]['visit_code'] = $visit_details[0]['medicalIncidentVisitCode'];

        $this->ci->Prescription_model->insertUpdateArray[$this->ci->Prescription_model->prescriptionRequestId] = $fullInputData[0]["prescription_request_id"];
        $this->ci->Prescription_model->insertUpdateArray[$this->ci->Prescription_model->medicalVisitId] = $fullInputData[0]["visit_id"];
        $this->ci->Prescription_model->insertUpdateArray[$this->ci->Prescription_model->bcpUserId] = $this->ci->session->userid;
        $this->ci->Prescription_model->insertUpdateArray[$this->ci->Prescription_model->doctorId] = $this->ci->session->userid;
        $this->ci->Prescription_model->insertUpdateArray[$this->ci->Prescription_model->prescriptionCode] = $prec_code;
        $this->ci->Prescription_model->insertUpdateArray[$this->ci->Prescription_model->prescriptionDate] = date('Y-m-d', time());
        $this->ci->Prescription_model->insertUpdateArray[$this->ci->Prescription_model->prescriptionStatus] = 1;

        $prec_id = $this->ci->Prescription_model->insert_data($this->ci->Prescription_model->dbTable, $this->ci->Prescription_model->insertUpdateArray);
		$smsMessageData = "DOCTOR-PRESCIPTION <br> Please use <br>";
		$this->ci->emailHandler = new Email_handler();                     
        

        foreach ($fullInputData as $key => $inputData) {
            if (!empty($prec_id)) {
				$smsMessageData .= "Medicine: ".$inputData["medicine_name"]."<br> Quantity: ".$inputData["quantity"]."<br> Timings: ".$inputData["timing_ids"]." <br> Days: ".$inputData["days"]." ";
                $this->ci->Prescriptiondetail_model->insertUpdateArray[$this->ci->Prescriptiondetail_model->prescription_Id] = $prec_id;
                $this->ci->Prescriptiondetail_model->insertUpdateArray[$this->ci->Prescriptiondetail_model->medicineId] = $inputData["medicine_id"];
//                $this->ci->Prescriptiondetail_model->insertUpdateArray['dosage']          =   $inputData['dosage'];
                $this->ci->Prescriptiondetail_model->insertUpdateArray[$this->ci->Prescriptiondetail_model->quantity] = $inputData["quantity"];
                $this->ci->Prescriptiondetail_model->insertUpdateArray[$this->ci->Prescriptiondetail_model->timingsIds] = $inputData["timing_ids"];
                $this->ci->Prescriptiondetail_model->insertUpdateArray[$this->ci->Prescriptiondetail_model->days] = $inputData["days"];

                $ack = $this->ci->Prescriptiondetail_model->insert_data($this->ci->Prescriptiondetail_model->dbTable, $this->ci->Prescriptiondetail_model->insertUpdateArray);
            }
        }
//        if(!empty($prec_id)){
//            $this->ci->Prescription_model->resetVariable();
//            $this->ci->Prescription_model->insertUpdateArray['prescription_status']    =   0;
//
//            $where['id']    =   $prec_id;
//            $this->ci->Prescription_model->setWhere($where);
//            $ack = $this->ci->Prescription_model->update_data();
//        }
		
        $this->ci->load->model('User_model');

        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $userData = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['username'] = $this->ci->User_model->username;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['mobile'] = $this->ci->User_model->mobile;
        $selectInput['languageId'] = $this->ci->User_model->languageId;
		$selectInput['countryid'] = $this->ci->User_model->countryid;
		
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1;
        $where[$this->ci->User_model->id] = $fullInputData[0]['bcp_id'];

        $this->ci->User_model->setSelect($selectInput);
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        $userData = $this->ci->User_model->get();

        $bcp_details = $this->Userhandler->getUserProfile($fullInputData[0]['bcp_id'], '');
        if (isset($bcp_details['response']['userData']) && !empty($bcp_details['response']['userData'])) {
            $bcp_details = $bcp_details['response']['userData'][0];
        }
		
//        debugArray($userData); exit;
        $userId = $userData[0]['id'];
        $username = $userData[0]['username'];
        $toEmail = trim($userData[0]['email']);
        $toMobile = trim($userData[0]['mobile']);
        $languageId = $userData[0]['languageId'];
		$toMobile = checkMobileCountryCode($toMobile, $userData[0]['countryid']);
			
		$mobileResponse = $this->ci->emailHandler->sendSMSFromAWS($toMobile, $smsMessageData, $sentMessageArray);
		//debugArray($mobileResponse); exit;


//            $data = $this->Messagetemplate_handler->sendMessageWithTemplate($fullInputData, $languageId, $type="prescription", $mode="sms", $toEmail, $toMobile);
//            debugArray($bcp_details); exit;



        $bcp_id[] = array('id' => $fullInputData[0]['bcp_id']);
//            debugArray($bcp_id); exit;
//        $devices_info = $this->deviceHandler->getDevicesInfoByUser($bcp_id);
//            debugArray($devices_info); exit;
    /*    if (isset($devices_info['response']['devices_info']) && !empty($devices_info['response']['devices_info'])) {

            $devices_info = $devices_info['response']['devices_info'];
            foreach ($devices_info as $key => $device) {
//                        debugArray($devices_info); exit;
                if (!empty($device['awsarncode'])) {
                    $data = $this->Messagetemplate_handler->sendNotificationWithTemplate($fullInputData, $languageId = "1", $type = 'prescription', $mode = 'notification', $devices_info[$key]);
                }
            }
        }*/

		
        if ($ack) {
			
			
            $output['status'] = TRUE;
            ///$output["response"]["messages"][] = SUCCESS_PRESCRIPTION;
            $output['response']['messages'][] = $this->ci->lang->line('success_prescription_data_save_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
        }
    }

    public function addPrescription($fullInputData) {

        require_once (APPPATH . 'handlers/Medicalvisit_handler.php');
        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        require_once (APPPATH . 'handlers/Userdevices_handler.php');
        require_once (APPPATH . 'handlers/Prescriptiondoctor_handler.php');
        require_once (APPPATH . 'handlers/Patient_handler.php');

        $this->ci->load->model('Prescriptionrequests_model');

        $this->deviceHandler = new Userdevices_handler();
        $this->bcpassignment = new Bcpassignment_handler();
        $this->Messagetemplate_handler = new Messagetemplate_handler();
        $this->User_handler = new User_handler();
        $this->Medicalvisit_handler = new Medicalvisit_handler();
        $this->PatientHandler = new Patient_handler();
        $this->PrescriptiondoctorHandler = new Prescriptiondoctor_handler();





        $bcpId = $fullInputData["header_data"]['bcp_id'];
        if (!empty($fullInputData)) {

            $this->ci->Prescriptionrequests_model->insertUpdateArray[$this->ci->Prescriptionrequests_model->bcpId] = $bcpId;

            $prec_req = $this->ci->Prescriptionrequests_model->insert_data($this->ci->Medicalincident_model->dbTable, $this->ci->Medicalincident_model->insertUpdateArray);
        }


        $this->ci->load->model('Prescription_model');
        $this->ci->load->model('Prescriptiondetail_model');
        $this->Messagetemplate_handler = new Messagetemplate_handler();
        $this->Medicalincident_handler = new Medicalincident_handler();
        $this->Userhandler = new User_handler();


//            debugArray($fullInputData); exit;
        $whereUser = array();
        $whereUserrole = array();


        $this->ci->Prescription_model->resetVariable();
        $selectInput = array();
        $prescriptionData = array();
        $selectInput['id'] = $this->ci->Prescription_model->id;
        $selectInput['prescriptionCode'] = $this->ci->Prescription_model->prescriptionCode;
        $selectInput['medicalVisitId'] = $this->ci->Prescription_model->medicalVisitId;
        $order[] = " id DESC";
        $this->ci->Prescription_model->setSelect($selectInput);
        $this->ci->Prescription_model->setOrderBy($order);
        $this->ci->Prescription_model->setRecords(1);
        $prescriptionData = $this->ci->Prescription_model->get();
//            debugArray($prescriptionData); exit;
        if (count($prescriptionData) > 0) {
            $presCode = $prescriptionData[0]['prescriptionCode'];
            $prePresNum = $this->returnIntValFromString($presCode);
            $newPresNum = $prePresNum + 1;
            $prescriptionCode = $this->ci->session->countryshortname . '/' . PRESCRIPTION_STRING . $newPresNum;
            $prec_code = $prescriptionCode;
        } else {
            $prec_code = $this->ci->session->countryshortname . '/' . PRESCRIPTION_STRING . '1';
        }
//            debugArray($prec_code); exit;
//            $visit_id =   $prescriptionData[0]['medicalVisitId'];


        $this->ci->Prescription_model->insertUpdateArray['prescription_request_id'] = $prec_req;
        $this->ci->Prescription_model->insertUpdateArray['bcp_id'] = $bcpId;
        $this->ci->Prescription_model->insertUpdateArray['prescription_code'] = $prec_code;
        $this->ci->Prescription_model->insertUpdateArray['prescription_date'] = date('Y-m-d', time());

        $prec_id = $this->ci->Prescription_model->insert_data($this->ci->Prescription_model->dbTable, $this->ci->Prescription_model->insertUpdateArray);
        foreach ($fullInputData['data'] as $key => $inputData) {

            if (!empty($prec_id)) {

                $this->ci->Prescriptiondetail_model->insertUpdateArray['prescription_id'] = $prec_id;
                $this->ci->Prescriptiondetail_model->insertUpdateArray['medicine_id'] = $inputData["medicine_id"];
//                $this->ci->Prescriptiondetail_model->insertUpdateArray['dosage']          =   $inputData['dosage'];
                $this->ci->Prescriptiondetail_model->insertUpdateArray['quantity'] = $inputData["quantity"];
                $this->ci->Prescriptiondetail_model->insertUpdateArray['timings_ids'] = $inputData["timing_ids"];
                $this->ci->Prescriptiondetail_model->insertUpdateArray['days'] = $inputData["days"];

                $ack = $this->ci->Prescriptiondetail_model->insert_data($this->ci->Prescriptiondetail_model->dbTable, $this->ci->Prescriptiondetail_model->insertUpdateArray);
            }
        }
//        if(!empty($prec_id)){
//            $this->ci->Prescription_model->resetVariable();
//            $this->ci->Prescription_model->insertUpdateArray['prescription_status']    =   0;
//
//            $where['id']    =   $prec_id;
//            $this->ci->Prescription_model->setWhere($where);
//            $ack = $this->ci->Prescription_model->update_data();
//        }

        $this->ci->load->model('User_model');

        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $userData = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['username'] = $this->ci->User_model->username;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['mobile'] = $this->ci->User_model->mobile;
        $selectInput['languageId'] = $this->ci->User_model->languageId;
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1;
        $where[$this->ci->User_model->id] = $bcpId;

        $this->ci->User_model->setSelect($selectInput);
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        $userData = $this->ci->User_model->get();

//        $bcp_details    =   $this->Userhandler->getUserProfile($bcpId,'');
//        debugArray($userData); exit;
        $userId = $userData[0]['id'];
        $username = $userData[0]['username'];
        $toEmail = trim($userData[0]['email']);
        $toMobile = trim($userData[0]['mobile']);
        $languageId = $userData[0]['languageId'];
        $fullInputData['header_data']['prec_id'] = $prec_id;

//            echo 'here'; exit;
//            $data = $this->Messagetemplate_handler->sendMessageWithTemplate($fullInputData['data'], $languageId, $type="prescription", $mode="sms", $toEmail, $toMobile);

        $this->PrescriptiondoctorHandler->addPrescriptionPatientDetails($fullInputData['header_data']);


        if ($ack) {
            $output['status'] = TRUE;
            ///$output["response"]["messages"][] = SUCCESS_PRESCRIPTION;
            $output['response']['messages'][] = $this->ci->lang->line('success_adding_prescription');
            $output['statusCode'] = STATUS_OK;
            return $output;
        }
    }

    public function bcpsavePrescription($fullInputData) {

        $this->ci->load->model('Prescription_model');
        $this->ci->load->model('Prescriptiondetail_model');
        $this->ci->load->model('MedicineCatalog_model');
        $ack = "";
        foreach ($fullInputData as $inputData) {
            $this->ci->Prescriptiondetail_model->resetVariable();
            $selectInput = array();
            $prescriptionData = array();
            $where = array();

            $selectInput['prescription_id'] = $this->ci->Prescriptiondetail_model->prescription_Id;
            $selectInput['medicine_id'] = $this->ci->Prescriptiondetail_model->medicineId;
            $where['id'] = $inputData['id'];
            $this->ci->Prescriptiondetail_model->setSelect($selectInput);
            $this->ci->Prescriptiondetail_model->setWhere($where);

            $this->ci->Prescription_model->setRecords(1);
            $prescriptionDetail = $this->ci->Prescriptiondetail_model->get();

            if (count($prescriptionDetail) == 0) {
                $output['status'] = FALSE;
                ///$output['response']['message'][] = ERROR_NO_PRESCRIPTION_DETAILS_DATA;
                $output['response']['messages'][] = $this->ci->lang->line('error_prescription_details_not_found_message');
                $output['response']['total'] = 0;
                $output['statuscode'] = STATUS_NO_DATA;
                return $output;
            }
            $prec_id = $prescriptionDetail[0]['prescription_id'];
            $medicine_id = $prescriptionDetail[0]['medicine_id'];

            $selectInput    =   array();
            $this->ci->MedicineCatalog_model->resetVariable();
            $selectInput['stock'] = $this->ci->MedicineCatalog_model->stock;

            $where['id'] = $medicine_id;
            $this->ci->MedicineCatalog_model->setWhere($where);
            
            $this->ci->MedicineCatalog_model->setSelect($selectInput);
            $this->ci->MedicineCatalog_model->setRecords(1);
            $quantity = $this->ci->MedicineCatalog_model->get();

            if (count($quantity) == 0) {
                $output['status'] = FALSE;
                ///$output['response']['message'][] = ERROR_NO_MEDICINE_QUANTITY;
                $output['response']['messages'][] = $this->ci->lang->line('error_medicine_quantity_not_found_message');
                $output['response']['total'] = 0;
                $output['statuscode'] = STATUS_NO_DATA;
                return $output;
            }

            $quantity = $quantity[0]['stock'];


            $this->ci->Prescriptiondetail_model->resetVariable();
            $where = array();

            $this->ci->Prescriptiondetail_model->insertUpdateArray['dispence_quantity'] = $inputData["quantity"];
            $this->ci->Prescriptiondetail_model->insertUpdateArray['dispence_date'] = date('Y-m-d', time());
            $where['id'] = $inputData['id'];
            $this->ci->Prescriptiondetail_model->setWhere($where);
            $ack = $this->ci->Prescriptiondetail_model->update_data();

            if ($ack) {

                $this->ci->MedicineCatalog_model->resetVariable();
                $this->ci->MedicineCatalog_model->insertUpdateArray['stock'] = $quantity - $inputData["quantity"];

                $where['id'] = $medicine_id;
                $this->ci->MedicineCatalog_model->setWhere($where);
                $ack = $this->ci->MedicineCatalog_model->update_data();
                if ($ack) {

                    $this->ci->Prescription_model->resetVariable();
                    $this->ci->Prescription_model->insertUpdateArray['prescription_status'] = 2;

                    $where['id'] = $prec_id;
                    $this->ci->Prescription_model->setWhere($where);
                    $ack = $this->ci->Prescription_model->update_data();
                }
            }
        }
        if ($ack) {
            $output['status'] = TRUE;
            ///$output["response"]["messages"][] = SUCCESS_PRESCRIPTION;
            $output['response']['messages'][] = $this->ci->lang->line('success_prescription_data_save_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
        } else {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_prescription_data_save_message');
            $output['statusCode'] = STATUS_SERVER_ERROR;
            return $output;
        }
    }

    public function getMedicalNotes($visit_id) {
        $this->ci->load->model('Medicalsurveyreport_model');
        $this->ci->load->model('Survey_questionnaire_model');
        $this->ci->load->model('Survey_questionnaire_condition_value_model');

        $this->ci->Medicalsurveyreport_model->resetVariable();

        $selectInput = array();
        $where = array();

        $selectInput['id'] = $this->ci->Medicalsurveyreport_model->id;
        $selectInput['survey_question_id'] = $this->ci->Medicalsurveyreport_model->surveyQuestionId;
        $selectInput['survey_question_option'] = $this->ci->Medicalsurveyreport_model->surveyQuestionOptionId;
        $selectInput['survey_question_option_value'] = 'group_concat(' . $this->ci->Medicalsurveyreport_model->surveyQuestionOptionValue . ')';
        $groupBy[] = $this->ci->Medicalsurveyreport_model->surveyQuestionId;
        $this->ci->Medicalsurveyreport_model->setSelect($selectInput);
        $this->ci->Medicalsurveyreport_model->setGroupBy($groupBy);
        $where = array(
            $this->ci->Medicalsurveyreport_model->deleted => 0,
            $this->ci->Medicalsurveyreport_model->status => 1,
            $this->ci->Medicalsurveyreport_model->medicalIncidentVisitId => $visit_id
        );
        $this->ci->Medicalsurveyreport_model->setWhere($where);


//       $this->ci->Doctor_model->setRecords($limit,$page);

        $survey_questions = $this->ci->Medicalsurveyreport_model->get();
        if (count($survey_questions) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_QUESTION_OPTIONS;
            $output['response']['messages'][] = $this->ci->lang->line('error_question_options_not_found_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $question_ids = array();
        foreach ($survey_questions as $question) {
            array_push($question_ids, $question['survey_question_id']);
        }


        $this->ci->Survey_questionnaire_condition_value_model->resetVariable();
        $selectInput = array();
        $where = array();
        $whereIns = array();
        $selectInput['question_id'] = $this->ci->Survey_questionnaire_condition_value_model->conditionSurveyQuestionId;

        $this->ci->Survey_questionnaire_condition_value_model->setSelect($selectInput);
        $where[$this->ci->Survey_questionnaire_condition_value_model->deleted] = 0;
        $where[$this->ci->Survey_questionnaire_condition_value_model->status] = 1;
        $whereIns[$this->ci->Survey_questionnaire_condition_value_model->displaySurveyQuestionId] = $question_ids;


        $this->ci->Survey_questionnaire_condition_value_model->setWhere($where);
        $this->ci->Survey_questionnaire_condition_value_model->setWhereIns($whereIns);
        $conditional_questions = $this->ci->Survey_questionnaire_condition_value_model->get();


        debugArray($conditional_questions);
        exit;





        $this->ci->Survey_questionnaire_model->resetVariable();
        $selectInput = array();
        $where = array();
        $whereIns = array();
        $selectInput['id'] = $this->ci->Survey_questionnaire_model->id;
        $selectInput['title'] = $this->ci->Survey_questionnaire_model->title;

        $this->ci->Survey_questionnaire_model->setSelect($selectInput);
        $where[$this->ci->Survey_questionnaire_model->deleted] = 0;
        $where[$this->ci->Survey_questionnaire_model->status] = 1;
        $whereIns[$this->ci->Survey_questionnaire_model->id] = $question_ids;


        $this->ci->Survey_questionnaire_model->setWhere($where);
        $this->ci->Survey_questionnaire_model->setWhereIns($whereIns);
        $surveyQuestionnaireData = $this->ci->Survey_questionnaire_model->get();


        debugArray($surveyQuestionnaireData);
        exit;




        $output['status'] = TRUE;
        $output['response']['medicine_catelog'] = $medicine_catelog;
        $output['response']['total'] = count($medicine_catelog);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function getPatientDetailsFromVisit($visit_id) {

        $this->ci->load->model('Medicalincidentvisit_model');
        ///$this->ci->load->model('Patient_model');

        $this->ci->Medicalincidentvisit_model->resetVariable();
        $selectInput = array();
        $medicalIncidentVisitData = array();
        $where = array();
        $whereInArray = array();

        $selectInput['id'] = $this->ci->Medicalincidentvisit_model->id;
        $selectInput['medicalIncidentVisitCode'] = $this->ci->Medicalincidentvisit_model->medicalIncidentVisitCode;
        $selectInput['medicalIncidentId'] = $this->ci->Medicalincidentvisit_model->medicalIncidentId;
        $selectInput['patientId'] = $this->ci->Medicalincidentvisit_model->patientId;
        $selectInput['registrationDate'] = $this->ci->Medicalincidentvisit_model->registrationDate;
        $selectInput['status'] = $this->ci->Medicalincidentvisit_model->status;

        $where[$this->ci->Medicalincidentvisit_model->deleted] = 0;
        $where[$this->ci->Medicalincidentvisit_model->status] = 1;
        $where[$this->ci->Medicalincidentvisit_model->id] = $visit_id;


        $this->ci->Medicalincidentvisit_model->setOrderBy(array($this->ci->Medicalincidentvisit_model->id . ' DESC'));
        $this->ci->Medicalincidentvisit_model->setSelect($selectInput);
        $this->ci->Medicalincidentvisit_model->setWhere($where);

        $medicalIncidentVisitData = $this->ci->Medicalincidentvisit_model->get();


        if (count($medicalIncidentVisitData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_MEDICALINCIDENT_VISITS;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_medical_incident_visit_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $patinet_id = $medicalIncidentVisitData[0]['patientId'];

        /*
          $this->ci->Patient_model->resetVariable();
          $selectInput = array();
          $patientDetails = array();
          $where = array();
          $whereInArray = array();

          $selectInput['id'] = $this->ci->Patient_model->id;
          $selectInput['firstName'] = $this->ci->Patient_model->firstName;
          $selectInput['middleName'] = $this->ci->Patient_model->middleName;
          $selectInput['lastName'] = $this->ci->Patient_model->lastName;
          $selectInput['medicalRegistrationNumber'] = $this->ci->Patient_model->medicalRegistrationNumber;

          $where[$this->ci->Patient_model->deleted] = 0;
          $where[$this->ci->Patient_model->id] = $patinet_id;
          $this->ci->Patient_model->setSelect($selectInput);
          $this->ci->Patient_model->setWhere($where);

          $patientDetails = $this->ci->Patient_model->get();
         */

        require_once (APPPATH . 'handlers/Patient_handler.php');
        $this->ci->patientHandler = new Patient_handler();

        $patientDetails = $this->ci->patientHandler->getPatientBasicDetails($inputData['id'] = $patinet_id, $getByValue = "id");

        if (count($patientDetails) == 0) {
            $output['status'] = TRUE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_patient_details_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }

        $mr_code = $patientDetails[0]['medicalRegistrationNumber'];

        $output['status'] = TRUE;
        $output['response']['mr_number'] = $mr_code;
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function returnIntValFromString($str) {
        return intval(preg_replace('/[^0-9]+/', '', $str), 10);
    }

    public function getBCPByDoctorId($id) {
        $selectInput = array();
        $where = array();
        $bcpByDoctor = array();

        $selectInput['bcpId'] = $this->ci->Bcpassignment_model->bcpId;
        $where[$this->ci->Bcpassignment_model->id] = $id;

        $this->ci->Bcpassignment_model->setSelect($selectInput);
        $this->ci->Bcpassignment_model->setWhere($where);
        $bcpByDoctor = $this->ci->Bcpassignment_model->get();

        if (count($bcpByDoctor) !== 0) {
            $output['status'] = TRUE;
            $output['response']['BcpData'] = $bcpByDoctor;
            $output['response']['total'] = '';
            $output['statuscode'] = STATUS_OK;
            return $output;
        } else {
            $output['status'] = FALSE;
            ///$output['response']['BcpData'] = ERROR_NO_BCP_ASSIGNED ;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_bcp_assigned_message');
            $output['response']['total'] = '';
            $output['statuscode'] = STATUS_OK;
            return $output;
        }
    }

    public function updateBCP($inputData) {

        $doctorData = array();
        $where = array();
        $doctorData['email'] = $inputData["email"];
        $doctorData['first_name'] = $inputData["first_name"];
        $doctorData['last_name'] = $inputData["last_name"];
        $doctorData['gender'] = $inputData['gender'];
        $doctorData['countryid'] = $inputData["countryid"];
        $doctorData['stateid'] = $inputData["stateid"];
        $doctorData['cityid'] = $inputData["cityid"];
        $doctorData['district'] = $inputData["district"];
        $doctorData['village'] = $inputData["village"];
        $doctorData['pincode'] = $inputData["pincode"];
        $doctorData['mobile'] = $inputData["mobile"];
        $doctorData['alternate_contact_number'] = $inputData["alternate_contact_number"];
        $doctorData['language_id'] = $inputData["language_id"];

        if ($inputData["profilePicture"] != '') {
            $doctorData['profile_picture'] = $inputData["profilePicture"];
        }
        $where[$this->ci->User_model->id] = $inputData["id"];
        $this->ci->User_model->setInsertUpdateData($doctorData);
        $this->ci->User_model->setWhere($where);
        $status = $this->ci->User_model->update_data();


        if ($status != '') {
            $output['status'] = TRUE;
            $output['response']['messages'] = $this->ci->lang->line('success_bcp_profile_updated_message');
            $output['statusCode'] = STATUS_CREATED;
            return $output;
        }
        $output['status'] = FALSE;
        ///$output['response']['messages'] = ERROR_INVALID_DATA;
        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
        $output['statusCode'] = STATUS_BAD_REQUEST;
        return $output;
    }

    public function getBcpStatistics($bcpid) {

        require_once (APPPATH . 'handlers/Medicalvisit_handler.php');
        $this->ci->medicalvisitHandler = new Medicalvisit_handler();

        require_once (APPPATH . 'handlers/Patient_handler.php');
        $this->ci->patientHandler = new Patient_handler();

        /*
          $MrRecords = array();

          $where = array();
          $select = array();
          $selectType = array();
          $whereType = array();
          $select['id'] = $this->ci->Medicalincidentvisit_model->id;
          $where[$this->ci->Medicalincidentvisit_model->bcpUserId] = $bcpid;
          $this->ci->Medicalincidentvisit_model->setSelect($select);
          $this->ci->Medicalincidentvisit_model->setWhere($where);
          $MrRecords[0]['label'] = 'Visits';
          $MrRecords[0]['value'] = $this->ci->Medicalincidentvisit_model->getCount();

          $select['id'] = $this->ci->Patient_model->medicalRegistrationNumber;
          $where[$this->ci->Patient_model->createdby] = $bcpid;
          $this->ci->Patient_model->setSelect($select);
          $this->ci->Patient_model->setWhere($where);
          $MrRecords[1]['label'] = 'Mr Records';
          $MrRecords[1]['value'] = $this->ci->Patient_model->getCount();

          $selectType['id'] = $this->ci->Medicalincidentvisit_model->id;
          $whereType[$this->ci->Medicalincidentvisit_model->bcpUserId] = $bcpid;
          $whereType[$this->ci->Medicalincidentvisit_model->type] = 'redflag';
          $this->ci->Medicalincidentvisit_model->setSelect($selectType);
          $this->ci->Medicalincidentvisit_model->setWhere($whereType);
          $MrRecords[2]['label'] = 'Red Flag';
          $MrRecords[2]['value'] = $this->ci->Medicalincidentvisit_model->getCount();

          $selectType['id'] = $this->ci->Medicalincidentvisit_model->id;
          $whereType[$this->ci->Medicalincidentvisit_model->bcpUserId] = $bcpid;
          $whereType[$this->ci->Medicalincidentvisit_model->type] = 'incident';
          $this->ci->Medicalincidentvisit_model->setSelect($selectType);
          $this->ci->Medicalincidentvisit_model->setWhere($whereType);
          $MrRecords[3]['label'] = 'Incidents';
          $MrRecords[3]['value'] = $this->ci->Medicalincidentvisit_model->getCount();

          return $MrRecords;
         */

        $mrRecords = array();

        $keyValueArray = array("createdby" => $bcpid);
        $mrCount = $this->ci->patientHandler->getPatientCount($keyValueArray);
        if ($mrCount > 0) {
            $mrRecords[0]['label'] = 'Mr Records';
            $mrRecords[0]['value'] = $mrCount;
        }
        else{
            $mrRecords[0]['label'] = 'Mr Records';
            $mrRecords[0]['value'] = 0;
        }

        
        $keyValueArray = array("bcpUserId" => $bcpid);
        $visitsCount = $this->ci->medicalvisitHandler->getMedicalVisitCount($keyValueArray);
        if ($visitsCount > 0) {
            $mrRecords[1]['label'] = 'Visits';
            $mrRecords[1]['value'] = $visitsCount;          
        }
        else{
            $mrRecords[1]['label'] = 'Visits';
            $mrRecords[1]['value'] = 0; 
        }

        
        $keyValueArray = array("bcpUserId" => $bcpid, "type" => 'redflag');
        $redflagCount = $this->ci->medicalvisitHandler->getMedicalVisitCount($keyValueArray);
        if ($redflagCount > 0) {
            $mrRecords[2]['label'] = 'Red Flag';
            $mrRecords[2]['value'] = $redflagCount;
            //$mrRecords['redflag'] = $redflagCount;
        }
        else{
            $mrRecords[2]['label'] = 'Red Flag';
            $mrRecords[2]['value'] = 0;
        }

        //$mrRecords['incident'] = 0;
        $keyValueArray = array("bcpUserId" => $bcpid, "type" => 'incident');
        $incidentCount = $this->ci->medicalvisitHandler->getMedicalVisitCount($keyValueArray);
        if ($incidentCount > 0) {
            $mrRecords[3]['label'] = 'Incidents';
            $mrRecords[3]['value'] =$incidentCount;
            //$mrRecords['incident'] = $incidentCount;
        }
        else{
            $mrRecords[3]['label'] = 'Incidents';
            $mrRecords[3]['value'] =0;
        }

        return $mrRecords;
    }

}
