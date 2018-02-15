<?php

/* SMS Gateway received SMS related logic be defined in this class
 * @package		CodeIgniter
 * @author		JEPL Development Team
 * @copyright	Copyright (c) 2017, JEPL.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       25-11-2017
 * @Last Modified By    Sridevi
 */
require_once (APPPATH . 'handlers/handler.php');

class Received_sms_handler extends Handler {

    var $ci;
    
    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Received_sms_model');
    }
    
    public function saveMessage($inputMessageArray = ""){
        try {
			if(count($inputMessageArray) > 0){
				
				
				foreach($inputMessageArray->messages as $messageData)
				{
					$this->ci->Received_sms_model->resetVariable();
					$hexmessage = $messageData->message;
					$decryptMessage = $messageData->message;
					if(ctype_xdigit($hexmessage)) {
						$FinalMessage = substr("@U".$hexmessage, 2); 
						$_hexmessage = hex2bin($FinalMessage);
						$FinalMessage = mb_convert_encoding($_hexmessage, 'UTF-8', 'UCS-2');
						$FinalMessage = htmlentities($FinalMessage, ENT_COMPAT, "UTF-8");
						$decryptMessage =  $FinalMessage;
					}
					
					$this->ci->Received_sms_model->insertUpdateArray[$this->ci->Received_sms_model->fromUserId] = 1;
					$this->ci->Received_sms_model->insertUpdateArray[$this->ci->Received_sms_model->message] = $decryptMessage;
					$this->ci->Received_sms_model->insertUpdateArray[$this->ci->Received_sms_model->localTextMessageid] = $messageData->id;
					$this->ci->Received_sms_model->insertUpdateArray[$this->ci->Received_sms_model->localTextInboxid] = $inputMessageArray->inbox_id;
					
					$this->ci->Received_sms_model->insertUpdateArray[$this->ci->Received_sms_model->fromMobileNumber] = $messageData->number;
					$this->ci->Received_sms_model->insertUpdateArray[$this->ci->Received_sms_model->smsSentDate] = $messageData->date;
					//$this->ci->Received_sms_model->insertUpdateArray[$this->ci->Received_sms_model->activity] = $messageData['activity'];
					$sentMessageId = $this->ci->Received_sms_model->insert_update_onduplicate_data();
					
				}
				$output['status'] = TRUE;
				return $output;
				
			} 
		} catch (Exception $e) {
			$output['status'] = FALSE;
			return $output;
		}

    }
    
	 public function getOpenMessage($inputMessageArray = ""){
        try {
			$this->ci->Received_sms_model->resetVariable();
			$selectInput =array();
			$selectInput['id'] = $this->ci->Received_sms_model->id;
			$selectInput['message'] = $this->ci->Received_sms_model->message;
			$selectInput['fromMobileNumber'] = $this->ci->Received_sms_model->fromMobileNumber;
			
			$whereIn[$this->ci->Received_sms_model->status] = array("open","in-process");
			$likeCondition[$this->ci->Received_sms_model->message] = "TYPE#PRREQ";
			$this->ci->Received_sms_model->setSelect($selectInput);
			$this->ci->Received_sms_model->setWhereIns($whereIn); 
			$this->ci->Received_sms_model->setLike($likeCondition);
			$openMessageData = $this->ci->Received_sms_model->get();
			//$openMessageIdData = commonHelperGetIdArray($openMessageData, 'id');
		//example meesage pattern	//TYPE#PRREQ##PRID#PR1##BCPID#BCP243##MRNO#IND/BCP243/MR13##INCID#IND/BCP243/MR13/INC1##VSID#IND/BCP243/MR14/INC1/VIST1##ABQID#142##ABOPTID#652##PFNAME#Mahabokbb Massdd##PGENDER#Male##PVILLAGE#Hhy##PEMERGNO#null##PDOB#undefined
			if(count($openMessageData) > 0) {
				foreach($openMessageData as $messageData) {
					$smsReceivedId = $messageData['id'];
					$parentMessageArray = explode("##",$messageData['message']);
					if(count($parentMessageArray) > 0 ) {
						$medicalRecordNO = "";
						$patientFname = "";
						$patientEmergencyContactNo = "";
						$patientGender = "";
						$bcpId = "";
						$patientDOB = "";
						$emergencyContactName = "";
						$patientVillage = "";
						$requestDate = "";
						
						foreach($parentMessageArray as $eachMessageKey => $eachMessageData) {
							//echo $eachMessageData."<br>";
							$mData = array();
							$mData = explode("#",$eachMessageData);
							if($mData[0] == "PRID") {
								$prescriptionId = $mData[1];
							}
							if($mData[0] == "BCPID") {
								$bcpId = str_replace("BCP","",$mData[1]);
								//$medicalRecordNO .= "BCP".$bcpId."/";
								require_once (APPPATH . 'handlers/User_handler.php');
								$this->ci->userHandler = new User_handler();
								$bcpUserData = $this->ci->userHandler->getUserDetails($bcpId);
								
								if(count($bcpUserData) > 0 && isset($bcpUserData)) {
									if($bcpUserData['status']) {
										$bcpFirstName = $bcpUserData['response']['userData']['firstName'];
									}
								}
							}
							if($mData[0] == "MRNO") {
								$MRNO = $mData[1];
								$medicalRecordNO .= $MRNO;
							//	echo $MedicalRecordNO."<br>";
							}
							if($mData[0] == "INCID") {
								$incID = $mData[1];
							}
							if($mData[0] == "VSID") {
								$visitID = $mData[1];
							}
							if($mData[0] == "ABQID") {
								$abnormalQuestionID = $mData[1];
							}
							if($mData[0] == "ABOPTID") {
								$abnormalOptionID = $mData[1];
							}
							if($mData[0] == "PFNAME") {
								$patientFname = $mData[1];
							}
							if($mData[0] == "PGENDER") {
								if($mData[1] == "Female")
									$patientGender = "female";
								if($mData[1] == "Male")
									$patientGender = "male";
							}
							if($mData[0] == "PVILLAGE") {
								$patientVillage = $mData[1];
							}
							if($mData[0] == "PEMERGNO") {
								$patientEmergencyContactNo = $mData[1];
							}
							if($mData[0] == "PDOB") {
								$patientDOB = $mData[1];
							}
							if($mData[0] == "REQDATE" && strlen($mData[1])>2) {
								$requestDate = $mData[1];
							}
						}
							$patientRegisterData['medical_registration_code'] = $medicalRecordNO;
							$patientRegisterData['firstName'] = $patientFname;
							$patientRegisterData['emergencyContactNumber'] = $patientEmergencyContactNo;
							$patientRegisterData['gender'] = $patientGender;
							$patientRegisterData['bcp_user_id'] = $bcpId;
							$patientRegisterData["dateofBirth"] = $patientDOB;
							$patientRegisterData["villageName"] = $patientVillage;
							require_once (APPPATH . 'handlers/Medicalincident_handler.php');
							$this->ci->medicalincident_handler = new Medicalincident_handler();
							try {
								require_once (APPPATH . 'handlers/Patient_handler.php');
								$this->ci->patientHandler = new Patient_handler ();
								$patientDataResponse = $this->ci->patientHandler->quickPatientRegistrationViaSMS($patientRegisterData);
								$patientDetailResponse = $this->ci->medicalincident_handler->getPatientId($medicalRecordNO);
								if(count($patientDetailResponse) > 0) {
									$patientId = $patientDetailResponse[0]['id'];
								}
									
								} catch (Exception $e) {
								
							}
							$inputData = array(
                'medicalIncidentId' => "",
                'medicalIncidentVisitId' => "",
                'questionId' => $abnormalQuestionID,
                'optionId' => $abnormalOptionID,
                'bcpId' => $bcpId,
				'bcpName' => $bcpFirstName,
				'patientName' =>$patientFname,
				'mrNumber' =>$medicalRecordNO,
				'patientId' => $patientId,
				'requestDate' => $requestDate
            );
              
							
							
							$responseArray = $this->ci->medicalincident_handler->prescriptionSMSRequest($inputData);
							
							if($responseArray['status']) {
								$this->ci->Received_sms_model->resetVariable();
								$this->ci->Received_sms_model->update_data();
								$this->ci->Received_sms_model->insertUpdateArray[$this->ci->Received_sms_model->status] = "completed";
								if($smsReceivedId > 0 ) {
									$where[$this->ci->Received_sms_model->id] = $smsReceivedId;
									$this->ci->Received_sms_model->setWhere($where);
									$updateRes= $this->ci->Received_sms_model->update_data();
								}
								
							}
						
					}
				}
			}
			$output['status']=TRUE;
			//$output['response']['syncData'] = $lastSyncData;
            $output['response']['messages'][] = array();
           // $output['response']['total']=count($lastSyncData);
            $output['statuscode']  = STATUS_OK ;
            return $output ; 
		} catch (Exception $e) {
			$output['status'] = FALSE;
			return $output;
		}

    }
    
    
}


?>