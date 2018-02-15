<?php

/**
 * User related business logic will be defined in this class
 *
 * @package		CodeIgniter
 * @author		Qison  Dev Team
 * @copyright	Copyright (c) 2015, MeraEvents.
 * @Version		Version 1.0
 * @Since       Class available since Release Version 1.0 
 * @Created     18-06-2015
 * @Last Modified 25-06-2015
 */
require_once(APPPATH . 'handlers/handler.php');
require_once (APPPATH . 'handlers/Country_handler.php');
require_once (APPPATH . 'handlers/State_handler.php');
require_once (APPPATH . 'handlers/City_handler.php');
require_once (APPPATH . 'handlers/Language_handler.php');
require_once (APPPATH . 'handlers/Userdetails_handler.php');

class User_handler extends Handler {

    var $ci;
    public $messagetemplateHandler;
    public $userotpHandler;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;

        $this->ci->load->model('User_model');
        $this->ci->load->model('Userrole_model');
       
        $this->countryHandler = new Country_handler();
        $this->stateHandler = new State_handler();
        $this->cityHandler = new City_handler();
        $this->languageHandler = new Language_handler();
        $this->userdetailsHandler=new Userdetails_handler();
    }

    public function userLogin($inputData) {

        $this->ci->load->model('User_devices_model');

        $userRole = $inputData['userrole'];
        $languageId = $inputData['language'];

        $languageData = $this->languageHandler->getLanguageData($languageId);
        ///print_r($languageData); exit;
        if ($languageData['status'] == 1) {
            $this->ci->session->set_userdata('languageId', $languageData['response']['languageData']['id']);
            $this->ci->session->set_userdata('language', $languageData['response']['languageData']['name']);
            $this->ci->session->set_userdata('code', $languageData['response']['languageData']['code']);
        } else {
            $this->ci->session->set_userdata('languageId', 1);
            $this->ci->session->set_userdata('language', ENGLISH);
            $this->ci->session->set_userdata('code', ENGLISH_CODE);
        }

        
        $userData = $this->getUserData($inputData);
        ///print_r($userData); ///exit;      
        if (count($userData) > 0) {

            if ($userData[0]['status'] == 1) {

                $userId = $userData[0]['id'];
                $inputData['userId'] = $userId;

                if ($inputData['type'] != WEB_TYPE) {
                    $this->checkUserDevice($inputData);
                }
                ///echo $userData[0]['password'] .'=='. $this->setSha1($inputData['password']); exit;

                if ($userData[0]['password'] == $this->setSha1($inputData['password'])) {

                    $userroledata = $this->getUserroleData($userRole, $userId);
                    if (count($userroledata) > 0) {

                        $countryData = $this->countryHandler->getCountryData($userData[0]['countryid']);
                        //print_r($countryData); exit;
                        $countryShortName = "";
                        $countryName = "";
                        if ($countryData['status'] == 1) {
                            if ($countryData['response']['total'] > 0) {
                                /* @var $countryData type */
                                $countryShortName = $countryData['response']['countryData'][0]['shortName'];
                                $countryName = $countryData['response']['countryData'][0]['name'];
                            }
                        }

                        $stateData = $this->stateHandler->getStateData($userData[0]['stateid']);
                        ///print_r($stateData); exit;
                        $stateName = "";
                        if ($stateData['status'] == 1) {
                            if ($stateData['response']['total'] > 0) {
                                $stateName = $stateData['response']['stateData'][0]['name'];
                            }
                        }

                        $cityData = $this->cityHandler->getCityData($userData[0]['cityid']);
                        ///print_r($cityData); exit;
                        $cityName = "";
                        if ($cityData['status'] == 1) {
                            if ($cityData['response']['total'] > 0) {
                                $cityName = $cityData['response']['cityData'][0]['name'];
                            }
                        }

                        $this->ci->session->set_userdata('userid', $userData[0]['id']);
                        $this->ci->session->set_userdata('name', $userData[0]['firstName'] . $userData[0]['lastName']);
                        $this->ci->session->set_userdata('userrole', $userRole);
                        $this->ci->session->set_userdata('countryshortname', $countryShortName);
                        $this->ci->session->set_userdata('countryid', $userData[0]['countryid']);
                        $this->ci->session->set_userdata('country', $countryName);
                        $this->ci->session->set_userdata('stateid', $userData[0]['stateid']);
                        $this->ci->session->set_userdata('state', $stateName);
                        $this->ci->session->set_userdata('cityid', $userData[0]['cityid']);
                        $this->ci->session->set_userdata('city', $cityName);                        
                        unset($userData[0]['password']);
                       
                        $output['status'] = TRUE;
                        $output['response']['userData'] = $userData[0];
                        $output['response']['userData']['country'] = $countryName;
                        $output['response']['userData']['countryshortname'] = $countryShortName;
                        $output['response']['userData']['state'] = $stateName;
                        $output['response']['userData']['city'] = $cityName;

                        //$output['response']['messages'] = LOGIN_SUCCESS;
                        $output['response']['messages'] = $this->ci->lang->line('success_user_login_message');
                        //$output['response']['total'] = 1;
                        $output['statusCode'] = STATUS_OK;
                        $redirectionUrl = "redirectionUrl"; //$this->getuserRedirectionUrl();
                        $output['response']['data']['redirectUrl'] = $redirectionUrl;
                        $output['response']['data']['userrole'] = $userRole;
                        return $output;
                    } else {
                        $output['status'] = FALSE;
                        //$output['response']['messages'][] = ERROR_USER_ROLE_NOT_FOUND;
                        // $output['response']['messages'][] = ERROR_NO_USER;
                        $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
                        $output['response']['total'] = 0;
                        $output['response']['total'] = 0;
                        //$output['statusCode'] = STATUS_USER_ROLE_NOT_FOUND;
                        $output['statusCode'] = STATUS_NO_DATA;
                        return $output;
                    }
                } else {
                    $output['status'] = FALSE;
                    ///$output['response']['messages'][] = ERROR_INCORRECT_CREDENTIALS;
                    $output['response']['messages'][] = $this->ci->lang->line('error_incorrect_password_message');
                    $output['response']['total'] = 0;
                    $output['statusCode'] = STATUS_INCORRECT_CREDENTIALS;
                    return $output;
                }
            } else if ($userData[0]['status'] == 2) {
                $output['status'] = FALSE;
                ///$output['response']['messages'][] = ERROR_USER_INACTIVE;
                $output['response']['messages'][] = $this->ci->lang->line('error_inactive_user_account_message');
                $output['response']['total'] = 0;
                $output['statusCode'] = STATUS_INACTIVE_USER;
                return $output;
            } else if ($userData[0]['status'] == 3) {
                $output['status'] = FALSE;
                //$output['response']['messages'][] = ERROR_USER_BLOCKED;
                $output['response']['messages'][] = $this->ci->lang->line('error_user_account_blocked_message');
                $output['response']['total'] = 0;
                $output['statusCode'] = STATUS_BLOCKED_USER;
                return $output;
            }
        } else {
            $output['status'] = FALSE;
            ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
    }

    public function getUserData($inputArray) {

        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $countryData = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['gender'] = $this->ci->User_model->gender;
        $selectInput['firstName'] = $this->ci->User_model->firstName;
        $selectInput['lastName'] = $this->ci->User_model->lastName;
        $selectInput['password'] = $this->ci->User_model->password;
        $selectInput['countryid'] = $this->ci->User_model->countryid;
        $selectInput['languageId'] = $this->ci->User_model->languageId;
        $selectInput['stateid'] = $this->ci->User_model->stateid;
        $selectInput['cityid'] = $this->ci->User_model->cityid;
        $selectInput['profile_picture'] = $this->ci->User_model->profile_picture;
        $selectInput['signature_picture'] = $this->ci->User_model->signature_picture;
        $selectInput['status'] = $this->ci->User_model->status;
        $selectInput['mobile'] = $this->ci->User_model->mobile;
        //$where[$this->ci->User_model->deleted] = 0;
        //$where[$this->ci->User_model->status] = 1;
        $where[$this->ci->User_model->username] = $inputArray['username'];
        //$where[$this->ci->User_model->password]=$this->setSha1($inputArray['password']);
        $this->ci->User_model->setSelect($selectInput);
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        $userData = $this->ci->User_model->get();
        if (count($userData) > 0) {
            
            //$hff_media_path = $this->ci->config->item('hff_media_path');
            $hff_media_profile_image_path_read = $this->ci->config->item('hff_media_profile_image_path_read');
            $hff_media_signature_image_path_read = $this->ci->config->item('hff_media_signature_image_path_read');
            $hff_media_profile_image_default_path_read = $this->ci->config->item('hff_media_profile_image_default_path_read');
            
            $final_profile_picture = "";
            if (isset($userData[0]['profile_picture']) && $userData[0]['profile_picture'] != "") {
                $profile_picture = $hff_media_profile_image_path_read . $userData[0]['profile_picture'];                
                ///$final_profile_picture = checkImageByURL($profile_picture);
                $final_profile_picture = $profile_picture; 
            } 
            
            if ($final_profile_picture == "") {
                if ($userData[0]['gender'] == "male") {
                    $final_profile_picture = $hff_media_profile_image_default_path_read . "user-male.png";
                } else if ($userData[0]['gender'] == "female") {
                    $final_profile_picture = $hff_media_profile_image_default_path_read . "user-female.png";
                }
            }
            
            $userData[0]['profile_picture'] = $final_profile_picture;
            
            $final_signature_picture = "";
            if ($userData[0]['signature_picture'] != "") {
                $signature_picture = $hff_media_signature_image_path_read . $userData[0]['signature_picture']; 
                ///$final_signature_picture = checkImageByURL($signature_picture);
                $final_signature_picture = $signature_picture;
            }
            $userData[0]['signature_picture'] = $final_signature_picture; 
        }
        
        return $userData;
    }

    // to set the sha1 encryption for given parameter 
    public function setSha1($value) {
        return sha1($value);
    }

    public function doctorLogin($inputData) {

         $userRole = $inputData['userrole'];
         $languageId = $inputData['language'];
         $languageData = $this->languageHandler->getLanguageData($languageId);
         if ($languageData['status'] == 1) {
            $this->ci->session->set_userdata('languageId', $languageData['response']['languageData']['id']);
            $this->ci->session->set_userdata('language', $languageData['response']['languageData']['name']);
         }else {
            $this->ci->session->set_userdata('languageId', 1);
            $this->ci->session->set_userdata('language', ENGLISH);
         }
        $userData = $this->getUserData($inputData);
        // print_r($userData); exit;

        if (count($userData) > 0) {

            $userId = $userData[0]['id'];
            $inputData['userId'] = $userId;
            if ($inputData['type'] != WEB_TYPE) {
                $this->checkUserDevice($inputData);
            }
            if ($userData[0]['status'] == 1) {

                if ($userData[0]['password'] == $this->setSha1($inputData['password'])) {

                    $userId = $userData[0]['id'];
                    $userroledata = $this->getUserroleData($userRole, $userId);
                    if (count($userroledata) > 0) {

                        $countryData = $this->countryHandler->getCountryData($userData[0]['countryid']);
                        //print_r($countryData); exit;
                        if ($countryData['status'] == 1) {
                            if ($countryData['response']['total'] > 0) {
                                $countryShortName = $countryData['response']['countryData'][0]['shortName'];
                                $countryName = $countryData['response']['countryData'][0]['name'];
                            } else {
                                $countryShortName = "";
                                $countryName = "";
                            }
                        }else{
                             $countryShortName = "";
                                $countryName = "";
                        }

                        $stateData = $this->stateHandler->getStateData($userData[0]['stateid']);
                        ///print_r($stateData); exit;
                        if ($stateData['status'] == 1) {
                            if ($stateData['response']['total'] > 0) {
                                $stateName = $stateData['response']['stateData'][0]['name'];
                            } else {
                                $stateName = "";
                            }
                        }else{
                             $stateName = "";
                        }

                        $cityData = $this->cityHandler->getCityData($userData[0]['cityid']);
                        ///print_r($cityData); exit;
                        if ($cityData['status'] == 1) {
                            if ($cityData['response']['total'] > 0) {
                                $cityName = $cityData['response']['cityData'][0]['name'];
                            } else {
                                $cityName = "";
                            }
                        }else{
                            $cityName = "";
                        }

                        $this->ci->session->set_userdata('userid', $userData[0]['id']);
                        $this->ci->session->set_userdata('name', $userData[0]['firstName'] . $userData[0]['lastName']);
                        $this->ci->session->set_userdata('userrole', $userRole);
                        $this->ci->session->set_userdata('countryshortname', $countryShortName);
                        $this->ci->session->set_userdata('countryid', $userData[0]['countryid']);
                        $this->ci->session->set_userdata('country', $countryName);
                        $this->ci->session->set_userdata('stateid', $userData[0]['stateid']);
                        $this->ci->session->set_userdata('state', $stateName);
                        $this->ci->session->set_userdata('cityid', $userData[0]['cityid']);
                        $this->ci->session->set_userdata('city', $cityName);

                        $output['status'] = TRUE;
                        $output['response']['userData'] = $userData[0];
                        $output['response']['userData']['country'] = $countryName;
                        $output['response']['userData']['countryshortname'] = $countryShortName;
                        $output['response']['userData']['state'] = $stateName;
                        $output['response']['userData']['city'] = $cityName;

                        $output['response']['messages'] = $this->ci->lang->line('success_user_login_message');
                        // $output['response']['total'] = 1;
                        $output['statusCode'] = STATUS_OK;
                        $redirectionUrl = "redirectionUrl"; //$this->getuserRedirectionUrl();
                        $output['response']['data']['redirectUrl'] = $redirectionUrl;
                        $output['response']['data']['userrole'] = $userRole;
                        return $output;
                    } else {
                        $output['status'] = FALSE;
                        //$output['response']['messages'][] = ERROR_USER_ROLE_NOT_FOUND;
                        $output['response']['messages'][] = $this->ci->lang->line('error_no_user_role_message');
                        $output['response']['total'] = 0;
                        $output['statusCode'] = STATUS_USER_ROLE_NOT_FOUND;
                        return $output;
                    }
                } else {
                    $output['status'] = FALSE;
                    ///$output['response']['messages'][] = ERROR_INCORRECT_CREDENTIALS;
                    $output['response']['messages'][] = $this->ci->lang->line('error_incorrect_password_message');
                    $output['response']['total'] = 0;
                    $output['statusCode'] = STATUS_INCORRECT_CREDENTIALS;
                    return $output;
                }
            } else if ($userData[0]['status'] == 2) {
                $output['status'] = FALSE;
                ///$output['response']['messages'][] = ERROR_USER_INACTIVE;
                $output['response']['messages'][] = $this->ci->lang->line('error_inactive_user_account_message');
                $output['response']['total'] = 0;
                $output['statusCode'] = STATUS_INACTIVE_USER;
                return $output;
            } else if ($userData[0]['status'] == 3) {
                $output['status'] = FALSE;
                //$output['response']['messages'][] = ERROR_USER_BLOCKED;
                $output['response']['messages'][] = $this->ci->lang->line('error_user_account_blocked_message');
                $output['response']['total'] = 0;
                $output['statusCode'] = STATUS_BLOCKED_USER;
                return $output;
            }
        } else {
            $output['status'] = FALSE;
            ///$output['response']['messages'][] = ERROR_NO_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
    }

    public function getUserDetails($userId) {
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $countryData = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['firstName'] = $this->ci->User_model->firstName;
        $selectInput['lastName'] = $this->ci->User_model->lastName;
        $selectInput['status'] = $this->ci->User_model->status;
        $selectInput['mobile'] = $this->ci->User_model->mobile;
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1;
        $where[$this->ci->User_model->id] = $userId;
        $this->ci->User_model->setSelect($selectInput);
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        $userData = $this->ci->User_model->get();
        if (count($userData) == 0) {
            $output['status'] = FALSE;
            ///$output['response']['messages'] = ERROR_INVALID_USER;
            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_user_message');
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_INVALID_USER;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['userData'] = $userData[0];
        $output['response']['messages'] = array();
        $output['response']['total'] = 1;
        $output['statusCode'] = STATUS_OK;
        return $output;
    }

    public function getUserroleData($userrole, $userId) {
        $selectInput = array();
        $userroleData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Userrole_model->id;
        // remove this comment
        //$where[$this->ci->Userrole_model->deleted] = 0;
        $where[$this->ci->Userrole_model->role] = $userrole;
        $where[$this->ci->Userrole_model->userId] = $userId;
        $this->ci->Userrole_model->setSelect($selectInput);
        $this->ci->Userrole_model->setWhere($where);
        $this->ci->Userrole_model->setRecords(1);
        return $userroleData = $this->ci->Userrole_model->get();
    }

    //to set the uset data
    public function userRegistration($inputData) {

        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['username'] = $this->ci->User_model->username;
        $this->ci->User_model->setSelect($selectInput);
        $where[$this->ci->User_model->username] = $inputData["username"];
        $this->ci->User_model->setWhere($where);
        $userCount = $this->ci->User_model->getCount();
        ///print_r($userCount);  exit;        
        if ($userCount == 0) {
            $this->ci->User_model->startTransaction();
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->username] = $inputData["username"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->password] = $this->setSha1($inputData["password"]);
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->email] = $inputData["email"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->firstName] = $inputData["first_name"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->lastName] = $inputData["last_name"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->countryid] = $inputData["countryid"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->stateid] = $inputData["stateid"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->cityid] = $inputData["cityid"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->pincode] = $inputData["pincode"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->mobile] = $inputData["mobile"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->createdby] = $inputData["sessionUserId"];
            $this->ci->User_model->insertUpdateArray[$this->ci->User_model->modifiedby] = $inputData["sessionUserId"];
            //print_r($this->setSha1($inputData["password"])); exit;

            $userId = $this->ci->User_model->insert_data($this->ci->User_model->dbTable, $this->ci->User_model->insertUpdateArray);
            if ($userId != '') {
                $this->ci->Userrole_model->insertUpdateArray[$this->ci->User_model->userId] = $userId;
                $this->ci->Userrole_model->insertUpdateArray[$this->ci->User_model->role] = $inputData["role"];
                $result = $this->ci->Userrole_model->insertdata($this->ci->Userrole_model->dbTable, $this->ci->Userrole_model->insertUpdateArray);
                if ($this->ci->Userrole_model->transactionStatusCheck() === FALSE) {
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
        } else {
            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_USER_EXISTS;
            $output['response']['messages'][] = $this->ci->lang->line('error_user_exists_message');
            $output['statusCode'] = STATUS_DATA_EXISTS;
            return $output;
        }
    }

    public function logout() {

        $output = logout($type=MOBILE_TYPE);
        return $output;
    }

    public function changePassword($inputArray) {

        $userData = $this->getUserPassword($inputArray['userId']);
        ///print_r($userData); exit;

        $userId = trim($inputArray['userId']);
        $oldPassword = trim($inputArray['oldPassword']);
        $newPassword = trim($inputArray['newPassword']);
        $confirmPassword = trim($inputArray['confirmPassword']);
       // print_r($inputArray);
        //echo $userData[0]['password']." == ".$this->setSha1($oldPassword)." == ".$this->setSha1($newPassword);  exit;

        if ($userData[0]['password'] == $this->setSha1($oldPassword)) {

            if ($newPassword == $confirmPassword) {
                $data = array();
                $data['password'] = $this->setSha1($inputArray['newPassword']);
                $where = array($this->ci->User_model->id => $userId);
                $this->ci->User_model->setInsertUpdateData($data);
                $this->ci->User_model->setWhere($where);
                $response = $this->ci->User_model->update_data();
                if ($response) {
                    $output['status'] = TRUE;
                    ///$output["response"]["messages"] = ERROR_CHANGE_PASSWORD_SUCCESS;
                    $output['response']['messages'][] = $this->ci->lang->line('success_change_password_message');
                    $output['statusCode'] = STATUS_OK;
                    return $output;
                }

                $output['status'] = FALSE;
                ///$output["response"]["messages"] = ERROR_SERVER;
                $output['response']['messages'][] = $this->ci->lang->line('error_internal_server_message');
                $output['statusCode'] = STATUS_SERVER_ERROR;
                return $output;
            }

            $output['status'] = FALSE;
            ///$output["response"]["messages"] = ERROR_PASSWORD_MISMATCH;
            $output['response']['messages'][] = $this->ci->lang->line('error_password_mismatch_message');
            $output['statusCode'] = STATUS_PASSWORD_MISMATCH;
            return $output;
        }

        $output['status'] = FALSE;
        ///$output["response"]["messages"] = ERROR_OLD_PASSWORD_INVALID;
        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_old_password_message');
        $output['statusCode'] = STATUS_PASSWORD_MISMATCH;
        return $output;
    }
    
    public function sendOTP($inputArray, $inputValType = "") {
                
        require_once (APPPATH . 'handlers/Userotp_handler.php');
        $this->userotpHandler = new Userotp_handler();
        
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $userData = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['username'] = $this->ci->User_model->username;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['mobile'] = $this->ci->User_model->mobile;
        $selectInput['languageId'] = $this->ci->User_model->languageId;
        $selectInput['countryId'] = $this->ci->User_model->countryid;
        $this->ci->User_model->setSelect($selectInput);
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1; 
        if ($inputValType == "mobile") {
            $where[$this->ci->User_model->mobile] = $inputArray['inputVal'];            
        } else {
            $where[$this->ci->User_model->username] = $inputArray['inputVal'];             
        }
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        $userData = $this->ci->User_model->get();
          
        if (count($userData) > 0) {
            
            if ($this->ci->config->Item('emailEnable') == true || $this->ci->config->Item('smsEnable') == true) {    

                $userId = $userData[0]['id'];
                $username = $userData[0]['username'];
                $toEmail = trim($userData[0]['email']);
                $toMobile = trim($userData[0]['mobile']);
                $languageId = trim($userData[0]['languageId']);
                $countryId = trim($userData[0]['countryId']);

                $toMobile = checkMobileCountryCode($toMobile, $countryId);  
                //echo $toMobile; exit;
                
                $otpCode = generateOtpCode();
                
                $userOTPData = array();
                $userOTPData['userId'] = $userId;
                $userOTPData['otp'] = $otpCode;

                $otpResponse = $this->userotpHandler->insertOTP($userOTPData);

                if($otpResponse['status'] == TRUE){

                    if ($toEmail != "" || $toMobile != "") {

                        require_once (APPPATH . 'handlers/Messagetemplate_handler.php');
                        $this->messagetemplateHandler = new Messagetemplate_handler();

                        $templateResponse = $this->messagetemplateHandler->sendMessageWithTemplate($otpCode, $languageId, $type = "forgotpassword", $mode = "", $toEmail, $toMobile, $userId);
                        
                        if($templateResponse['status'] == FALSE){   
                            
                            //log_message("error", $this->ci->lang->line('error_otp_send_email_message'));
                            
                            $output['status'] = FALSE;
                            $output['response']['messages'] = $this->ci->lang->line('error_otp_send_email_message');
                            $output['statusCode'] = STATUS_SERVER_ERROR;
                            return $output;
                        }
                        else{
                            $output['status'] = TRUE;
                            $output['response']['data']['emailId'] = $toEmail;
                            $output['response']['data']['username'] = $username;
                            $output['response']['messages'] = $this->ci->lang->line('success_otp_sent_message');
                            $output['statusCode'] = STATUS_OK;
                            return $output;                        
                        }

                    }
                    
                    //log_message("error", $this->ci->lang->line('error_empty_email_mobile_message'));
                    
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $this->ci->lang->line('error_empty_email_mobile_message');
                    $output['statusCode'] = STATUS_BAD_REQUEST;
                    return $output;
                }

                return $otpResponse;
            }
            
            //log_message("error", $this->ci->lang->line('error_send_email_sms_disabled_message'));
            
            $output['status'] = FALSE;
            $output['response']['messages'] = $this->ci->lang->line('error_send_email_sms_disabled_message');
            $output['statusCode'] = STATUS_SERVER_ERROR;
            return $output;
        }
        
        $output['status'] = FALSE;
        $output['response']['messages'] = $this->ci->lang->line('error_no_user_message');
        $output['statusCode'] = STATUS_NO_DATA;
        return $output;    
    }
    
    /*
    public function checkUserExists($inputArray, $inputValType = "") {
          
        $this->ci->load->model('User_otp_model');

        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $userData = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['username'] = $this->ci->User_model->username;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['mobile'] = $this->ci->User_model->mobile;
        $selectInput['languageId'] = $this->ci->User_model->languageId;
        $selectInput['countryId'] = $this->ci->User_model->countryid;
        $this->ci->User_model->setSelect($selectInput);
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1; 
        if ($inputValType == "mobile") {
            $where[$this->ci->User_model->mobile] = $inputArray['inputVal'];            
        } else {
            $where[$this->ci->User_model->username] = $inputArray['inputVal'];             
        }
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        $userData = $this->ci->User_model->get();
          
        if (count($userData) > 0) {
            $userId = $userData[0]['id'];
            $username = $userData[0]['username'];
            $toEmail = trim($userData[0]['email']);
            $toMobile = trim($userData[0]['mobile']);
            $languageId = trim($userData[0]['languageId']);
            $countryId = trim($userData[0]['countryId']);
                        
            $toMobile = checkMobileCountryCode($toMobile, $countryId);            
            $otpCode = generateOtpCode();
            
            $time_expires = date("Y-m-d H:i:s", time() + (OPT_VALIDITY * 60));
            //exit;
            $this->ci->User_otp_model->insertUpdateArray[$this->ci->User_otp_model->userId] = $userId;
            $this->ci->User_otp_model->insertUpdateArray[$this->ci->User_otp_model->otp] = $otpCode;
            $this->ci->User_otp_model->insertUpdateArray[$this->ci->User_otp_model->validity] = $time_expires;

            $otpId = $this->ci->User_otp_model->insertdata($this->ci->User_otp_model->dbTable, $this->ci->User_otp_model->insertUpdateArray);
            if ($otpId != '') {

                if ($toEmail != "" || $toMobile != "") {
                                         
                    $data = $this->messagetemplateHandler->sendMessageWithTemplate($otpCode, $languageId, $type = "forgotpassword", $mode = "", $toEmail, $toMobile, $userId);
                    ///print_r($data); exit;

                    $output['status'] = TRUE;
                    $output['response']['data']['emailId'] = $toEmail;
                    $output['response']['data']['username'] = $username;
                    ///$output['response']['messages'] = OTP_SENT;
                    $output['response']['messages'][] = $this->ci->lang->line('success_otp_sent_message');
                    $output['statusCode'] = STATUS_OK;
                    return $output;
                }

                $output['status'] = FALSE;
                ///$output['response']['messages'] = ERROR_INVALID_DATA;
                $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
                $output['statusCode'] = STATUS_BAD_REQUEST;
                return $output;
            }
            $output['status'] = FALSE;
            ///$output['response']['messages'] = ERROR_INVALID_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
            $output['statusCode'] = STATUS_BAD_REQUEST;
            return $output;
        }

        $output['status'] = FALSE;
        ///$output['response']['messages'][] = ERROR_NO_USER;
        $output['response']['messages'][] = $this->ci->lang->line('error_no_user_message');
        $output['statusCode'] = STATUS_NO_DATA;
        return $output;
    }
    */
    
    public function getUserPassword($userId) {
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $where = array();
        $selectInput['password'] = $this->ci->User_model->password;
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1;
        $where[$this->ci->User_model->id] = $userId;
        $this->ci->User_model->setSelect($selectInput);
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        $userData = $this->ci->User_model->get();
        return $userData;
    }

    public function validateOtp($inputArray) {

        $newPassword = trim($inputArray['newPassword']);
        $confirmPassword = trim($inputArray['confirmPassword']);
        $otpCode = trim($inputArray['otpCode']);
        // $emailId = trim($inputArray['emailId']);
        $username = trim($inputArray['username']);

        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $userData = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['mobile'] = $this->ci->User_model->mobile;
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1;
        $where[$this->ci->User_model->username] = $inputArray['username'];

        $this->ci->User_model->setSelect($selectInput);
        $this->ci->User_model->setWhere($where);
        $this->ci->User_model->setRecords(1);
        $userData = $this->ci->User_model->get();
        //print_r($userData); exit;

        if (count($userData) > 0) {
            $userId = $userData[0]['id'];
                                
            require_once (APPPATH . 'handlers/Userotp_handler.php');
            $this->userotpHandler = new Userotp_handler();
                        
            $userOTPData = array();
            $userOTPData['userId'] = $userId;
            $userOTPData['otp'] = $otpCode;
            
            $otpResponse = $this->userotpHandler->getOTPDetails($userOTPData);
            ///print_r($otpResponse); exit;           
            if($otpResponse['status'] == TRUE){           
                ///print_r($otpResponse['response']);  exit;              
                $otpId = $otpResponse['response']['data'][0]['id'];
                $otp = $otpResponse['response']['data'][0]['otp'];
                $validity = $otpResponse['response']['data'][0]['validity'];
                
                $now = date('Y-m-d H:i:s');
                ///echo $now."==".$validity;

                $current_timestamp = strtotime($now);
                $expiry_timestamp = strtotime($validity);

                if ($expiry_timestamp < $current_timestamp) {
                    $output['status'] = FALSE;
                    $output['response']['messages'] = $this->ci->lang->line('error_expired_otp_message');
                    $output['statusCode'] = STATUS_BAD_REQUEST;
                    return $output;
                }


                if ($newPassword == $confirmPassword) {

                    $this->ci->User_model->resetVariable();
                    $where = array();
                    $data = array();
                    $data['password'] = $this->setSha1($inputArray['newPassword']);
                    $where = array($this->ci->User_model->id => $userId);
                    $this->ci->User_model->setInsertUpdateData($data);
                    $this->ci->User_model->setWhere($where);
                    $response = $this->ci->User_model->update_data();
                    if ($response) {

                        $this->ci->User_otp_model->resetVariable();
                        $where = array();
                        $data = array();
                        $data['status'] = 0;
                        $where = array($this->ci->User_otp_model->id => $otpId);
                        $this->ci->User_otp_model->setInsertUpdateData($data);
                        $this->ci->User_otp_model->setWhere($where);
                        $response = $this->ci->User_otp_model->update_data();
                        if ($response) {
                            $output['status'] = TRUE;
                            $output['response']['messages'] = $this->ci->lang->line('success_change_password_message');
                            $output['statusCode'] = STATUS_OK;
                            return $output;
                        }

                        $output['status'] = FALSE;
                        $output['response']['messages'] = $this->ci->lang->line('error_internal_server_message');
                        $output['statusCode'] = STATUS_SERVER_ERROR;
                        return $output;
                    }

                    $output['status'] = FALSE;
                    $output['response']['messages'] = $this->ci->lang->line('error_internal_server_message');
                    $output['statusCode'] = STATUS_SERVER_ERROR;
                    return $output;
                }

                $output['status'] = FALSE;
                $output['response']['messages'] = $this->ci->lang->line('error_password_mismatch_message');
                $output['statusCode'] = STATUS_PASSWORD_MISMATCH;
                return $output;
            } 

            $output['status'] = FALSE;
            $output["response"]["messages"] = $this->ci->lang->line('error_invalid_otp_message');
            $output['statusCode'] = STATUS_INVALID;
            return $output;
        }

        $output['status'] = FALSE;
        $output['response']['messages'] = $this->ci->lang->line('error_no_user_message');
        $output['statusCode'] = STATUS_NO_DATA;
        return $output;
    }

    public function checkUserDevice($inputData) {
        $this->ci->load->model('User_devices_model');

        $userId = $inputData['userId'];
        $deviceId = $inputData['deviceId'];
        $deviceToken = $inputData['deviceToken'];
        $osType = $inputData['osType'];
        $osVersion = $inputData['osVersion'];

        $this->ci->User_devices_model->resetVariable();
        $selectInput = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_devices_model->id;
        $selectInput['userId'] = $this->ci->User_devices_model->userId;
        $selectInput['deviceId'] = $this->ci->User_devices_model->deviceId;
        $this->ci->User_devices_model->setSelect($selectInput);
        $where[$this->ci->User_devices_model->userId] = $userId;
        $where[$this->ci->User_devices_model->deviceId] = $deviceId;
        $this->ci->User_devices_model->setWhere($where);
        $this->ci->User_devices_model->setRecords(1);
        $deviceData = $this->ci->User_devices_model->get();
        ///print_r($deviceData);  exit; 
        if($deviceId !="" && $deviceToken !=""){
            if (count($deviceData) == 0) {
                $this->ci->User_devices_model->insertUpdateArray[$this->ci->User_devices_model->userId] = $userId;
                $this->ci->User_devices_model->insertUpdateArray[$this->ci->User_devices_model->deviceId] = $deviceId;
                $this->ci->User_devices_model->insertUpdateArray[$this->ci->User_devices_model->deviceToken] = $deviceToken;
                $this->ci->User_devices_model->insertUpdateArray[$this->ci->User_devices_model->osType] = $osType;
                $this->ci->User_devices_model->insertUpdateArray[$this->ci->User_devices_model->osVersion] = $osVersion;
                $userDevId = $this->ci->User_devices_model->insertdata($this->ci->User_devices_model->dbTable, $this->ci->User_devices_model->insertUpdateArray);

                include_once(APPPATH . 'libraries/aws/aws-autoloader.php');
                $this->ci->config->load('aws-sns');
                $snsClient = Aws\Sns\SnsClient::factory(array(
                            'credentials' => array(
                                'key' => $this->ci->config->Item('AWS_SNS_KEY_ID'),
                                'secret' => $this->ci->config->Item('AWS_SNS_SECRET'),
                            ),
                            'version' => $this->ci->config->Item('AWS_SNS_CLIENT_VERSION'),
                            'region' => $this->ci->config->Item('AWS_SNS_REGION')
                ));

                $platformApplicationArn = $this->ci->config->Item('AWS_SNS_MOBILE_APP_ARN');
                ///print_r($platformApplicationArn);  //exit; 
                try {
                   
                    $result = $snsClient->createPlatformEndpoint(array(
                        'PlatformApplicationArn' => $platformApplicationArn,
                        'Token' => $deviceToken,
                        'CustomUserData' => $userId,
                    ));
                    //print_r($result); exit;
                    $result = (array) $result;
                    //print_r($result); exit;

                    if( isset($result[' Aws\Result data']['EndpointArn']) && !is_null ($result[' Aws\Result data']['EndpointArn']) ){
                       $endpointArn = $result[' Aws\Result data']['EndpointArn'];
                       $data = array();
                       $data['awsarncode'] = $endpointArn;
                       $where = array($this->ci->User_devices_model->id => $userDevId);
                       $this->ci->User_devices_model->setInsertUpdateData($data);
                       $this->ci->User_devices_model->setWhere($where);
                       $response = $this->ci->User_devices_model->update_data();
                    }
                    
                } catch (Exception $e) {
                    //echo $e->getMessage();                    
                    //$xml = simplexml_load_string($e->getMessage());
                    //print_r($xml);
                }
                
            } 
            else {
                $id = $deviceData[0]['id'];
                $data = array();
                $data['os_type'] = $osType;
                $data['os_version'] = $osVersion;

                $where = array($this->ci->User_devices_model->id => $id);
                $this->ci->User_devices_model->setInsertUpdateData($data);
                $this->ci->User_devices_model->setWhere($where);
                $response = $this->ci->User_devices_model->update_data();
            }
        }
    }

    public function getUserProfile($id, $role_fiter = '', $countryId = "", $stateId = "", $cityId = "") {
        require_once (APPPATH . 'handlers/Userdevices_handler.php');
        
        $this->deviceHandler = new Userdevices_handler();
        
        $this->ci->load->model('Language_model');
        //print_r($id);
        
        if (!empty($role_fiter)) {
            $this->ci->Userrole_model->resetVariable();
            $selectInput = array();
            $patientData = array();
            $where = array();


            $selectInput['id'] = $this->ci->Userrole_model->userId;
            $this->ci->Userrole_model->setSelect($selectInput);
            $where[$this->ci->Userrole_model->role] = $role_fiter;
            $this->ci->Userrole_model->setWhere($where);
            
            $ids = $this->ci->Userrole_model->get();

            $id = array();
            foreach ($ids as $val) {
                array_push($id, $val['id']);
            }
        }
        
        $is_input_array = 0;
        if (is_array($id))
            $is_input_array = 1;
        
        if(empty($id)){
            $output['status'] = FALSE;
            $output['response']['userData'] = '';
            $output['response']['total'] = '';
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
            
        }
        
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $patientData = array();
        $where = array();
        $whereIns = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['mrnumber'] = $this->ci->User_model->id;
        $selectInput['username'] = $this->ci->User_model->username;
        ///$selectInput['password'] = $this->ci->User_model->password;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['firstName'] = $this->ci->User_model->firstName;
        $selectInput['lastName'] = $this->ci->User_model->lastName;
        $selectInput['gender'] = $this->ci->User_model->gender;
        $selectInput['countryid'] = $this->ci->User_model->countryid;
        $selectInput['stateid'] = $this->ci->User_model->stateid;
        $selectInput['cityid'] = $this->ci->User_model->cityid;
        $selectInput['district'] = $this->ci->User_model->district;
        $selectInput['village'] = $this->ci->User_model->village;
        $selectInput['languageId'] = $this->ci->User_model->languageId;
        $selectInput['pincode'] = $this->ci->User_model->pincode;
        $selectInput['mobile'] = $this->ci->User_model->mobile;
        $selectInput['alternate_contact_number'] = $this->ci->User_model->alternate_contact_number;
        $selectInput['profile_picture'] = $this->ci->User_model->profile_picture;
        $selectInput['signature_picture'] = $this->ci->User_model->signature_picture;
        $selectInput['signupdate'] = $this->ci->User_model->signupdate;

        $this->ci->User_model->setSelect($selectInput);
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1;
        // $where[$this->ci->User_model->stateid] = 2;

        if (!empty($countryId) && ($countryId != '')) {
            $where[$this->ci->User_model->countryid] = $countryId;
        }
        if (!empty($stateId) && ($stateId != '')) {
            $where[$this->ci->User_model->stateid] = $stateId;
        }
        if (!empty($cityId) && ($cityId != '')) {
            $where[$this->ci->User_model->cityid] = $cityId;
        }
        if (!empty($languageId) && ($languageId != '')) {
            $where[$this->ci->User_model->languageId] = $languageId;
        }
        if (!empty($id)) {
            if ($is_input_array) {
                $whereIns[$this->ci->User_model->id] = $id;
                $this->ci->User_model->setWhereIns($whereIns);
                $this->ci->User_model->setWhere($where);
            } else {
                $where[$this->ci->User_model->id] = $id;
                $this->ci->User_model->setWhere($where);
            }
        }
        
//        $devices_info   =   $this->deviceHandler->getDevicesInfoByUser($id);
//        if(!empty($active_doctors_list)){
//            foreach($active_doctors_list as $key => $user){
//                $active_doctors_list[$key]  =   $user['id'];
//            }
//            $doctor_profile_info   =   $this->User_handler->getDoctorProfile($active_doctors_list);
//        }
        
        //$this->ci->Patient_model->setRecords(1);
        $userData = $this->ci->User_model->get();
        
        //$hff_media_path = $this->ci->config->item('hff_media_path');
        $hff_media_profile_image_path_read = $this->ci->config->item('hff_media_profile_image_path_read');
        $hff_media_signature_image_path_read = $this->ci->config->item('hff_media_signature_image_path_read');
        $hff_media_profile_image_default_path_read = $this->ci->config->item('hff_media_profile_image_default_path_read');
        

        if (count($userData) > 0) {
            foreach ($userData as $data) {
                if (isset($country_ids[$data['id']])) {
                    array_push($country_ids[$data['id']], $data['countryid']);
                } else {
                    $country_ids[$data['id']] = $data['countryid'];
                }
                if (isset($state_ids[$data['id']])) {
                    array_push($state_ids[$data['id']], $data['stateid']);
                } else {
                    $state_ids[$data['id']] = $data['stateid'];
                }
                if (isset($city_ids[$data['id']])) {
                    array_push($city_ids[$data['id']], $data['cityid']);
                } else {
                    $city_ids[$data['id']] = $data['cityid'];
                }
                if (isset($language_ids[$data['id']])) {
                    array_push($language_ids[$data['id']], $data['languageId']);
                } else {
                    $language_ids[$data['id']] = $data['languageId'];
                }
            }


            $country_data = $this->countryHandler->getCountryData($country_ids);

            if (isset($country_data['response']['countryData']) && !empty($country_data['response']['countryData'])) {
                $country_details = $country_data['response']['countryData'];
            }

            $final_country_details = null;
            if (!empty($country_details))
                foreach ($country_details as $key => $country) {

                    $final_country_details[$country['id']] = $country['name'];
                }


            $state_data = $this->stateHandler->getStateData($state_ids);
            if (isset($state_data['response']['stateData']) && !empty($state_data['response']['stateData'])) {
                $state_details = $state_data['response']['stateData'];
            }
            $final_state_details = null;
            if (!empty($state_details))
                foreach ($state_details as $key => $state) {
                    if (isset($state['id']) && $state['id'] != "") {
                        $final_state_details[$state['id']] = $state['name'];
                    }
                }

            ///print_r($city_ids); exit;
            $city_data = $this->cityHandler->getCityData($city_ids);

            if (isset($city_data['response']['cityData']) && !empty($city_data['response']['cityData'])) {
                $city_details = $city_data['response']['cityData'];
            }

            $final_city_details = null;
            if (!empty($city_details))
                foreach ($city_details as $key => $city) {
                    $final_city_details[$city['id']] = $city['name'];
                }

            $this->ci->Language_model->resetVariable();
            $selectInput = array();
            $where = array();
            $selectInput['id'] = $this->ci->Language_model->id;
            $selectInput['languages'] = $this->ci->Language_model->name;
            $this->ci->Language_model->setSelect($selectInput);
            $where[$this->ci->Language_model->deleted] = 0;
            $where[$this->ci->Language_model->status] = 1;

            $whereIns[$this->ci->Language_model->id] = $language_ids;
            $this->ci->Language_model->setWhereIns($whereIns);

            $language_details = $this->ci->Language_model->get();

            $final_lang_details = null;
            foreach ($language_details as $key => $lang) {
                $final_lang_details[$lang['id']] = $lang['languages'];
            }

            
            if (count($userData) > 0) {
                foreach ($userData as $key => $user) {
                                        
                    $final_profile_picture = "";
                    if (isset($userData[$key]['profile_picture']) && $userData[$key]['profile_picture'] != "") {
                        $profile_picture = $hff_media_profile_image_path_read . $userData[$key]['profile_picture']; 
                        ///$final_profile_picture = checkImageByURL($profile_picture);
                        $final_profile_picture = $profile_picture;   
                    } 

                    if ($final_profile_picture == "") {
                        if ($userData[$key]['gender'] == "male") {
                            $final_profile_picture = $hff_media_profile_image_default_path_read . "user-male.png";
                        } else if ($userData[$key]['gender'] == "female") {
                            $final_profile_picture = $hff_media_profile_image_default_path_read . "user-female.png";
                        }
                    }

                    $userData[$key]['profile_picture'] = $final_profile_picture;
                    
                    $final_signature_picture = "";
                    if ($userData[$key]['signature_picture'] != "") {
                        $signature_picture = $hff_media_signature_image_path_read . $userData[$key]['signature_picture'];                       
                        ///$final_signature_picture = checkImageByURL($signature_picture);
                        $final_signature_picture = $signature_picture;
                    }
                    $userData[$key]['signature_picture'] = $final_signature_picture;
                                     
                    
                    if (!isset($final_country_details[$user['countryid']]))
                        $final_country_details[$user['countryid']] = '';
                    if (!isset($final_state_details[$user['stateid']]))
                        $final_state_details[$user['stateid']] = '';
                    if (!isset($final_city_details[$user['cityid']]))
                        $final_city_details[$user['cityid']] = '';
                    if (!isset($final_lang_details[$user['languageId']]))
                        $final_lang_details[$user['languageId']] = '';
                    $userData[$key]['country_name'] = $final_country_details[$user['countryid']];
                    $userData[$key]['state_name'] = $final_state_details[$user['stateid']];
                    $userData[$key]['city_name'] = $final_city_details[$user['cityid']];
                    $userData[$key]['language_name'] = $final_lang_details[$user['languageId']];
                }
                
                if (!isset($final_country_details[$user['countryid']]))
                    $final_country_details[$user['countryid']] = '';
                if (!isset($final_state_details[$user['stateid']]))
                    $final_state_details[$user['stateid']] = '';
                if (!isset($final_city_details[$user['cityid']]))
                    $final_city_details[$user['cityid']] = '';
                if (!isset($final_lang_details[$user['languageId']]))
                    $final_lang_details[$user['languageId']] = '';
                $userData[$key]['country_name'] = $final_country_details[$user['countryid']];
                $userData[$key]['state_name'] = $final_state_details[$user['stateid']];
                $userData[$key]['city_name'] = $final_city_details[$user['cityid']];
                $userData[$key]['language_name'] = $final_lang_details[$user['languageId']];
            }
            $output['status'] = TRUE;
            $output['response']['userData'] = $userData;
            $output['response']['total'] = count($userData);
            $output['statuscode'] = STATUS_OK;
            return $output;
        }else {
            $output['status'] = FALSE;
            $output['response']['userData'] = '';
            $output['response']['total'] = '';
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
    }
    

    public function getDoctorProfile($id, $country_details='') {
                
        $this->ci->load->model('Country_model');
        $this->ci->load->model('State_model');
        $this->ci->load->model('City_model');
        $this->ci->load->model('Userrole_model');
        $this->ci->load->model('Userdetails_model');

        $is_input_array = 0;
        if (is_array($id))
            $is_input_array = 1;
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $patientData = array();
        $where = array();
        $whereIns = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['username'] = $this->ci->User_model->username;
        ///$selectInput['password'] = $this->ci->User_model->password;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['firstName'] = $this->ci->User_model->firstName;
        $selectInput['lastName'] = $this->ci->User_model->lastName;
        $selectInput['gender'] = $this->ci->User_model->gender;
        $selectInput['countryid'] = $this->ci->User_model->countryid;
        $selectInput['stateid'] = $this->ci->User_model->stateid;
        $selectInput['cityid'] = $this->ci->User_model->cityid;
        $selectInput['pincode'] = $this->ci->User_model->pincode;
        $selectInput['mobile'] = $this->ci->User_model->mobile;
        $selectInput['profile_picture'] = $this->ci->User_model->profile_picture;
        $selectInput['signature_picture'] = $this->ci->User_model->signature_picture;

        $this->ci->User_model->setSelect($selectInput);
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1;

        if ($is_input_array) {
            $whereIns[$this->ci->User_model->id] = $id;
            $this->ci->User_model->setWhereIns($whereIns);
        } else {
            $where[$this->ci->User_model->id] = $id;
            $this->ci->User_model->setWhere($where);
        }
        $userid=$this->ci->session->userid;
        $userData = $this->ci->User_model->get();
        if(empty($userData)){
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_doctor_message');
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        
        $userDataCheck  =   $userData;
        $userDetails =$this->userdetailsHandler->getAddionalDetails($id);
       // print_r($userDetails);exit;
        $final_user_details =   array();
        if(!empty($userDetails)){
            foreach($userDetails as $user){
                $final_user_details[$user['id']]    =   $user;
                
            }
        }
         
        if(count($userDetails)>0){
            
            foreach($userData as $key => $user){
                //print_r($final_user_details);exit;
                if(isset($final_user_details[$userData[$key]['id']])){
                    $userData[$key]['gender']= $final_user_details[$userData[$key]['id']]['gender'];
                    $userData[$key]['dob']= $final_user_details[$userData[$key]['id']]['date_of_birth'];
                    $userData[$key]['education']= $final_user_details [$userData[$key]['id']]['education'];

                }
            }

        }
        $country_ids    =   null;
        $state_ids    =   null;
        $city_ids    =   null;
        if(!empty($userDataCheck))
        foreach ($userData as $data) {
            if (isset($country_ids[$data['id']])) {
                array_push($country_ids[$data['id']], $data['countryid']);
            } else {
                $country_ids[$data['id']] = $data['countryid'];
            }
            if (isset($state_ids[$data['id']])) {
                array_push($state_ids[$data['id']], $data['stateid']);
            } else {
                $state_ids[$data['id']] = $data['stateid'];
            }
            if (isset($city_ids[$data['id']])) {
                array_push($city_ids[$data['id']], $data['cityid']);
            } else {
                $city_ids[$data['id']] = $data['cityid'];
            }
        }


        $country_data = $this->countryHandler->getCountryData($country_ids);
        $country_details    =   null;
        if (isset($country_data['response']['countryData']) && !empty($country_data['response']['countryData'])) {
            $country_details = $country_data['response']['countryData'];
        }

        $final_country_details = null;
        if(!empty($country_details))
        foreach ($country_details as $key => $country) {

            $final_country_details[$country['id']] = $country['name'];
        }


        $state_data = $this->stateHandler->getStateData($state_ids);
        $state_details =   null;
        if (isset($state_data['response']['stateData']) && !empty($state_data['response']['stateData'])) {
            $state_details = $state_data['response']['stateData'];
        }
        $final_state_details = null;
        if(!empty($state_details))
        foreach ($state_details as $key => $state) {
            $final_state_details[$state['id']] = $state['name'];
        }


        $city_data = $this->cityHandler->getCityData($city_ids);
        $city_details   =   null;
        if (isset($city_data['response']['cityData']) && !empty($city_data['response']['cityData'])) {
            $city_details = $city_data['response']['cityData'];
        }
        
        $final_city_details = null;
        if(!empty($city_details))
        foreach ($city_details as $key => $city) {
            $final_city_details[$city['id']] = $city['name'];
        }

//        debugArray($userData); exit;
        if (count($userData) > 0) {
            
            ///$hff_media_path = $this->ci->config->item('hff_media_path');
            $hff_media_profile_image_path_read = $this->ci->config->item('hff_media_profile_image_path_read');
            $hff_media_signature_image_path_read = $this->ci->config->item('hff_media_signature_image_path_read');
            $hff_media_profile_image_default_path_read = $this->ci->config->item('hff_media_profile_image_default_path_read');
            
            foreach ($userData as $key => $user) {
                if ($userData[$key]['profile_picture'] != "") {
                    $userData[$key]['profile_picture'] = $hff_media_profile_image_path_read . $userData[$key]['profile_picture'];
                } else {
                    if(isset($userData[$key]['gender']))
                    if ($userData[$key]['gender'] == "male") {
                        $userData[$key]['profile_picture'] = $hff_media_profile_image_default_path_read . "user-male.png";
                    } else if ($userData[$key]['gender'] == "female") {
                        $userData[$key]['profile_picture'] = $hff_media_profile_image_default_path_read . "user-female.png";
                    }
                } 
                
                if ($userData[$key]['signature_picture'] != "") {
                    $userData[$key]['signature_picture'] = $hff_media_signature_image_path_read . $userData[$key]['signature_picture'];
                }
                if (!isset($final_user_details[$user['id']])) {
                    $final_user_details[$user['id']] = null;
                }
                $userData[$key]['country_name'] = isset($final_country_details[$user['countryid']]) ? $final_country_details[$user['countryid']] : '';
                $userData[$key]['state_name'] = isset($final_state_details[$user['stateid']]) ? $final_state_details[$user['stateid']] : '';
                $userData[$key]['city_name'] = isset($final_city_details[$user['cityid']]) ? $final_city_details[$user['cityid']] : '';
                $userData[$key]['role'] = ucwords(isset($final_role_details[$user['id']])) ? $final_role_details[$user['id']] : '';
                
            }
//            debugArray($userData); exit;
        }
        return $userData;
        
    }

    public function deleteUser($userId) {
        $userData = array();
        $where = array();
        $userData['deleted'] = 1;
        $where = array($this->ci->User_model->id => $userId);
        $this->ci->User_model->setInsertUpdateData($userData);
        $this->ci->User_model->setWhere($where);
        $status = $this->ci->User_model->update_data();
        if ($status != '') {
            $output['status'] = TRUE;
            $output['response']['messages'] =$this->ci->lang->line('success_user_profile_deleted_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
        }
        $output['status'] = FALSE;
        $output['response']['messages'] = '';
        $output['statusCode'] = STATUS_BAD_REQUEST;
        return $output;
    }

    public function filterIdsWithRole($ids, $role) {

        $userIds = array();
        if (!empty($ids) && !empty($role)) {

            $this->ci->Userrole_model->resetVariable();
            $selectInput = array();

            $where = array();
            $whereIns = array();
            $selectInput['id'] = $this->ci->Userrole_model->id;
            $where[$this->ci->Userrole_model->role] = $role;
            $whereIns[$this->ci->Userrole_model->userId] = $ids;
            $this->ci->Userrole_model->setSelect($selectInput);
            $this->ci->Userrole_model->setWhere($where);
            $this->ci->Userrole_model->setWhereIns($whereIns);

            $userIds = $this->ci->Userrole_model->get();
        }
        return $userIds;
    }

    public function getActiveUsers($ids) {

        $userIds = array();
        if (!empty($ids)) {

            $this->ci->User_model->resetVariable();
            $selectInput = array();

            $where = array();
            $whereIns = array();
            $selectInput['id'] = $this->ci->User_model->id;
            $where[$this->ci->User_model->status] = 1;
            $where[$this->ci->User_model->deleted] = 0;
            $whereIns[$this->ci->User_model->id] = $ids;
            $this->ci->User_model->setSelect($selectInput);
            $this->ci->User_model->setWhere($where);
            $this->ci->User_model->setWhereIns($whereIns);

            $userIds = $this->ci->User_model->get();
        }
        return $userIds;
    }
    public function getDoctorIds($doctor_ids) {



        $userrole_ids = $this->filterIdsWithRole($doctor_ids, ROLE_DOCTOR);
        if (!empty($userrole_ids))
            $active_ids = $this->getActiveUsers($doctor_ids);

        
        return $active_ids;             
        
        
        
//        debugArray($active_ids); exit;
//        return $active_ids;



//        $notificationTitle = "Test Notification";
//        $notificationMessage = "Hi!! Its a test notification";
//        $data = [
//            "type" => "Manual Notification" // You can add your custom contents here
//        ];
//        $userDeviceTokens = $devices_info['response']['devices_info'];
//        foreach ($userDeviceTokens as $userDeviceToken) {
//            
//            $deviceToken = $userDeviceToken['device_token'];
//            
////            $endPointArn = array("EndpointArn" => $deviceToken->arn);
//            try {
//                
//                include_once(APPPATH . 'libraries/aws/aws-autoloader.php');
//                $this->ci->config->load('aws-sns');
//                $snsClient = Aws\Sns\SnsClient::factory(array(
//                            'credentials' => array(
//                                'key' => $this->ci->config->Item('AWS_SNS_KEY_ID'),
//                                'secret' => $this->ci->config->Item('AWS_SNS_SECRET'),
//                            ),
//                            'version' => $this->ci->config->Item('AWS_SNS_CLIENT_VERSION'),
//                            'region' => $this->ci->config->Item('AWS_SNS_REGION')
//                ));
//
//                $platformApplicationArn = $this->ci->config->Item('AWS_SNS_MOBILE_APP_ARN');
//
//               $message     = 
//               $published = $client->publish([
//                   'MessageStructure' => 'json', 
//                   'Message' => Json::encode(['default' => $message->getBody(), 
//                       $message->getService() => $this->formatMessage($message)
//                           ]), 'TargetArn' => 'arn:aws:sns:us-east-1:264423652605:endpoint/GCM/HFFMOBILEBCP/484e6e07-371b-32eb-a5fb-f52aadc9b613']);
//                $data   =   array(
//                    'Message'   => '{"GCM":"{\"data\":{\"message\":\"welcome to doctor\"}}"}',
//                    'MessageStructute'  =>  'json',
////                    'TargetArn' =>  'arn:aws:sns:us-east-1:264423652605:endpoint/GCM/HFFMOBILEBCP/412799c7-cb87-304c-a783-d53f48be6b25',
////                    'TargetArn' =>  'arn:aws:sns:us-east-1:264423652605:endpoint/GCM/HFFMOBILEBCP/88ac4b4e-c1e5-3812-abee-e3a7da944a8c',
//                    'TargetArn' =>  'arn:aws:sns:us-east-1:264423652605:endpoint/GCM/HFFMOBILEBCP/484e6e07-371b-32eb-a5fb-f52aadc9b613',
////                    'MessageAttributes'   => [
////                        
////                    ],
//                );
//                $data   =   json_encode($data);
//                $data2  =   array(
//                    'TargetArn' =>  'arn:aws:sns:us-east-1:264423652605:endpoint/GCM/HFFMOBILEBCP/88ac4b4e-c1e5-3812-abee-e3a7da944a8c',
//                    'Message'   =>  'Welcome to Doctor',
//                    'MessageStructure'  =>  'String'
//                );
//                $sns = $snsClient->publish($data);
////                $endpointAtt = $sns->getEndpointAttributes($platformApplicationArn);
//                debugArray($sns); exit;
//                if ($endpointAtt != 'failed' && $endpointAtt['Attributes']['Enabled'] != 'false') {
//                    if ($deviceToken->platform == 'android') {
//                        $fcmPayload = json_encode(
//                            [
//                                "notification" =>
//                                    [
//                                        "title" => $notificationTitle,
//                                        "body" => $notificationMessage,
//                                        "sound" => 'default'
//                                    ],
//                                "data" => $data // data key is used for sending content through notification.
//                            ]
//                        );
//                        $message = json_encode(["default" => $notificationMessage, "GCM" => $fcmPayload]);
//                        $sns->publish([
//                            'TargetArn' => $deviceToken->arn,
//                            'Message' => $message,
//                            'MessageStructure' => 'json'
//                        ]);
//                    }
//                }
//            } catch (SnsException $e) {
//                Log::info($e->getMessage());
//            }
//        }
    }
    
    
    public function getUserCount($keyValueArray) {
         
        $select = array();
        $where = array();    
        $this->ci->User_model->resetVariable();
        $selectType['id'] = $this->ci->User_model->id;
                
        if(count($keyValueArray)>0){
            foreach($keyValueArray as $key => $val){
                $where[$this->ci->User_model->$key] = $val; 
            }
        }        
        
        $this->ci->User_model->setSelect($select);
        $this->ci->User_model->setWhere($where);
        return $this->ci->User_model->getCount();        
    }

    public function usernameExist($keyValueArray) {
        /*
        //$username
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $this->ci->User_model->setSelect($selectInput);
        $where[$this->ci->User_model->username] = $username;
        $this->ci->User_model->setWhere($where);
        $userCount = $this->ci->User_model->getCount();
        */
        
        $userCount = $this->getUserCount($keyValueArray);
        
        if ($userCount > 0) {
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
    
    public function usermobileExist($keyValueArray) {
        /*
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $where = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $this->ci->User_model->setSelect($selectInput);
        $where[$this->ci->User_model->mobile] = $mobile;
        $this->ci->User_model->setWhere($where);
        $userCount = $this->ci->User_model->getCount();
        */
        
        $userCount = $this->getUserCount($keyValueArray);
        if ($userCount > 0) {
            $output['status'] = FALSE;
            $output['response']['messages'][] = $this->ci->lang->line('error_mobile_exists_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
        } else {
            $output['status'] = TRUE;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_mobile_message');
            $output['statusCode'] = STATUS_OK;
            return $output;
        }
    }
    
    /*
    public function insertDoctor($inputData) {


        $userExists = $this->usernameExist($inputData["username"]);

        if ($userExists['status'] == 1) {

            $usermobileExists = $this->usermobileExist($inputData["mobile"]);

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
                
                $userId = $this->ci->User_model->insertdata($this->ci->User_model->dbTable, $this->ci->User_model->insertUpdateArray);
                if ($userId != '') {
                    $this->ci->Userrole_model->insertUpdateArray[$this->ci->Userrole_model->userId] = $userId;
                    $this->ci->Userrole_model->insertUpdateArray[$this->ci->Userrole_model->role] = $inputData["role"];
                    $result = $this->ci->Userrole_model->insertdata($this->ci->Userrole_model->dbTable, $this->ci->Userrole_model->insertUpdateArray);
                                        
                    $bcpId = $inputData["bcp_id"];                    
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
    */
   
    
     public function getUserLimitData($id, $role_fiter = '', $countryId = "", $stateId = "", $cityId = "") {
        require_once (APPPATH . 'handlers/Userdevices_handler.php');
        
        $this->deviceHandler = new Userdevices_handler();
        
        $this->ci->load->model('Language_model');
        //print_r($id);
        
        if (!empty($role_fiter)) {
            $this->ci->Userrole_model->resetVariable();
            $selectInput = array();
            $patientData = array();
            $where = array();


            $selectInput['id'] = $this->ci->Userrole_model->userId;
            $this->ci->Userrole_model->setSelect($selectInput);
            $where[$this->ci->Userrole_model->role] = $role_fiter;
            $this->ci->Userrole_model->setWhere($where);
            
            $ids = $this->ci->Userrole_model->get();

            $id = array();
            foreach ($ids as $val) {
                array_push($id, $val['id']);
            }
        }
        
        $is_input_array = 0;
        if (is_array($id))
            $is_input_array = 1;
        
        if(empty($id)){
            $output['status'] = FALSE;
            $output['response']['userData'] = '';
            $output['response']['total'] = '';
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
            
        }
        
        $this->ci->User_model->resetVariable();
        $selectInput = array();
        $patientData = array();
        $where = array();
        $whereIns = array();
        $selectInput['id'] = $this->ci->User_model->id;
        $selectInput['username'] = $this->ci->User_model->username;
        $selectInput['email'] = $this->ci->User_model->email;
        $selectInput['firstName'] = $this->ci->User_model->firstName;
        $selectInput['lastName'] = $this->ci->User_model->lastName;
        $selectInput['gender'] = $this->ci->User_model->gender;
        $selectInput['countryid'] = $this->ci->User_model->countryid;
        $selectInput['stateid'] = $this->ci->User_model->stateid;
        $selectInput['cityid'] = $this->ci->User_model->cityid;
        $selectInput['mobile'] = $this->ci->User_model->mobile;

        $this->ci->User_model->setSelect($selectInput);
        $where[$this->ci->User_model->deleted] = 0;
        $where[$this->ci->User_model->status] = 1;
        // $where[$this->ci->User_model->stateid] = 2;

        if (!empty($countryId) && ($countryId != '')) {
            $where[$this->ci->User_model->countryid] = $countryId;
        }
        if (!empty($stateId) && ($stateId != '')) {
            $where[$this->ci->User_model->stateid] = $stateId;
        }
        if (!empty($cityId) && ($cityId != '')) {
            $where[$this->ci->User_model->cityid] = $cityId;
        }
        
        if (!empty($id)) {
            if ($is_input_array) {
                $whereIns[$this->ci->User_model->id] = $id;
                $this->ci->User_model->setWhereIns($whereIns);
                $this->ci->User_model->setWhere($where);
            } else {
                $where[$this->ci->User_model->id] = $id;
                $this->ci->User_model->setWhere($where);
            }
        }
        
//        $devices_info   =   $this->deviceHandler->getDevicesInfoByUser($id);
//        if(!empty($active_doctors_list)){
//            foreach($active_doctors_list as $key => $user){
//                $active_doctors_list[$key]  =   $user['id'];
//            }
//            $doctor_profile_info   =   $this->User_handler->getDoctorProfile($active_doctors_list);
//        }
        
        //$this->ci->Patient_model->setRecords(1);
        $userData = $this->ci->User_model->get();
        
        //$hff_media_path = $this->ci->config->item('hff_media_path');

        if (count($userData) > 0) {
            foreach ($userData as $data) {
                if (isset($country_ids[$data['id']])) {
                    array_push($country_ids[$data['id']], $data['countryid']);
                } else {
                    $country_ids[$data['id']] = $data['countryid'];
                }
                if (isset($state_ids[$data['id']])) {
                    array_push($state_ids[$data['id']], $data['stateid']);
                } else {
                    $state_ids[$data['id']] = $data['stateid'];
                }
                if (isset($city_ids[$data['id']])) {
                    array_push($city_ids[$data['id']], $data['cityid']);
                } else {
                    $city_ids[$data['id']] = $data['cityid'];
                }
            }


            $country_data = $this->countryHandler->getCountryData($country_ids);

            if (isset($country_data['response']['countryData']) && !empty($country_data['response']['countryData'])) {
                $country_details = $country_data['response']['countryData'];
            }

            $final_country_details = null;
            if (!empty($country_details))
                foreach ($country_details as $key => $country) {

                    $final_country_details[$country['id']] = $country['name'];
                }


            $state_data = $this->stateHandler->getStateData($state_ids);
            if (isset($state_data['response']['stateData']) && !empty($state_data['response']['stateData'])) {
                $state_details = $state_data['response']['stateData'];
            }
            $final_state_details = null;
            if (!empty($state_details))
                foreach ($state_details as $key => $state) {
                    if (isset($state['id']) && $state['id'] != "") {
                        $final_state_details[$state['id']] = $state['name'];
                    }
                }

            ///print_r($city_ids); exit;
            $city_data = $this->cityHandler->getCityData($city_ids);

            if (isset($city_data['response']['cityData']) && !empty($city_data['response']['cityData'])) {
                $city_details = $city_data['response']['cityData'];
            }

            $final_city_details = null;
            if (!empty($city_details))
                foreach ($city_details as $key => $city) {
                    $final_city_details[$city['id']] = $city['name'];
                }
            
            if (count($userData) > 0) {
                foreach ($userData as $key => $user) {
                    /*
                    if ($userData[$key]['profile_picture'] != "") {
                        $userData[$key]['profile_picture'] = $hff_media_profile_image_path_read . $userData[$key]['profile_picture'];
                    } else {
                        if ($userData[$key]['gender'] == "male") {
                            $userData[$key]['profile_picture'] = $hff_media_profile_image_default_path_read . "user-male.png";
                        } else if ($userData[$key]['gender'] == "female") {
                            $userData[$key]['profile_picture'] = $hff_media_profile_image_default_path_read . "user-female.png";
                        }
                    } 
                    */
                   
                    if (!isset($final_country_details[$user['countryid']]))
                        $final_country_details[$user['countryid']] = '';
                    if (!isset($final_state_details[$user['stateid']]))
                        $final_state_details[$user['stateid']] = '';
                    if (!isset($final_city_details[$user['cityid']]))
                        $final_city_details[$user['cityid']] = '';
                    $userData[$key]['country_name'] = $final_country_details[$user['countryid']];
                    $userData[$key]['state_name'] = $final_state_details[$user['stateid']];
                    $userData[$key]['city_name'] = $final_city_details[$user['cityid']];
                    
                }
                
                if (!isset($final_country_details[$user['countryid']]))
                    $final_country_details[$user['countryid']] = '';
                if (!isset($final_state_details[$user['stateid']]))
                    $final_state_details[$user['stateid']] = '';
                if (!isset($final_city_details[$user['cityid']]))
                    $final_city_details[$user['cityid']] = '';
                $userData[$key]['country_name'] = $final_country_details[$user['countryid']];
                $userData[$key]['state_name'] = $final_state_details[$user['stateid']];
                $userData[$key]['city_name'] = $final_city_details[$user['cityid']];
            }
            $output['status'] = TRUE;
            $output['response']['userData'] = $userData;
            $output['response']['total'] = count($userData);
            $output['statuscode'] = STATUS_OK;
            return $output;
        }else {
            $output['status'] = FALSE;
            $output['response']['userData'] = '';
            $output['response']['total'] = '';
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
    }
}
