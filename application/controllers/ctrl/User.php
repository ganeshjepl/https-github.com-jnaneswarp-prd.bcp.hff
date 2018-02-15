<?php

/* User  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             17-06-2017
 * @Last Modified       17-07-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/User_handler.php');

require_once (APPPATH . 'handlers/Country_handler.php');
require_once (APPPATH . 'handlers/State_handler.php');
require_once (APPPATH . 'handlers/City_handler.php');
require_once (APPPATH . 'handlers/Language_handler.php');
require_once (APPPATH . 'handlers/Doctor_handler.php');

class User extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $responseArray = userLoginCheck('html',ROLE_ADMIN);
         
        $this->load->library('form_validation');
        $this->UserHandler = new User_handler(); 
        $this->doctorHandler = new Doctor_handler(); 
          
        
    }
    public function index(){
        require_once (APPPATH . 'handlers/Patient_handler.php');
        $this->patientHandler = new Patient_handler(); 
        $data['active']= "useractive";
        $result = $this->UserHandler->getUserLimitData(null,ROLE_BCP);
      
        if($result['status']==1){
            $bcpids = array();
            $userdata =  $result['response']['userData'];
            $data['bcp']= $userdata;
            foreach($userdata as $udata){
               $bcpids[]=   $udata['id'];
            }
            $bcp_data = $this->patientHandler->getPatientbyBcpIds($bcpids);
            $final_bcp_data =   array();
            if(!empty($bcp_data)){
                foreach($bcp_data as $bcp){
                    $final_bcp_data[$bcp['bcpUserId']]  =   $bcp['id'];
                }
            }
            if(count($final_bcp_data)){
                 $data['mrcount'] =$final_bcp_data;
            }else{
                $data['mrcount'] =0;
            }
        }else{
            $data['bcp']=0;
        }
        
//        debugArray($data); exit;
        $data['page_title']='Bcp List';
        $data['content'] = 'ctrl/ctrl_bcp';
        $template = 'templates/ctrl_template';
        $this->load->view($template, $data);
    }
    
      
    
         
        
        
    }   

   
        
