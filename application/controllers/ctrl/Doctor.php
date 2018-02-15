<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/User_handler.php');
require_once (APPPATH . 'handlers/Doctor_handler.php');
require_once (APPPATH . 'handlers/Country_handler.php');

class Doctor extends CI_Controller {

    public $userHandler;
    public $bcpassignmentHandler;

    public function __construct() {
        parent::__construct();
        $responseArray = userLoginCheck('html',ROLE_ADMIN);
        $this->userHandler = new User_handler();
        
    }

    public function index($limit=100,$page=1){
        $data['active']= "useractive";
        $data['bcp']= $this->userHandler->getUserLimitData(null,ROLE_BCP);
         
        $data['list']='';
        
        $response= $this->userHandler->getUserLimitData(null,ROLE_DOCTOR);
          if($response['status']==1){          
          $data['list']=$response['response']['userData'];          
          }
        
        $data['page_title'] = 'Doctor';
        $data['content'] = 'ctrl/doctor';
        $template = 'templates/ctrl_template';

        $this->load->view($template, $data);
    }
   
   

    public function getDoctor($limit = 100, $page = 1) {

        require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
        $this->bcpassignmentHandler = new Bcpassignment_handler();

        $docId = $this->input->post('id');
        $response = $this->userHandler->getUserProfile($docId, '');

        if ($response['status'] != 1) {
            $error['msg']= $this->lang->line('error_no_user_message');
            $error['status']=1;
        }else{
            require_once (APPPATH . 'handlers/Bcpassignment_handler.php');
            $this->bcpassignmentHandler = new Bcpassignment_handler();
            $bcpidresponse=  $this->bcpassignmentHandler->getDoctorBcps($docId);
            if($bcpidresponse['status']){
                if($bcpidresponse['response']['total']!=0){
                    $response['response']['bcp']=$bcpidresponse['response']['bcpdata'];
                }else{
                    $response['response']['bcp']=0;
                }
            }
            echo json_encode($response);
        }
    }
   

}
