<?php

/* User  entity related logic definition
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/User_handler.php');

class Index extends CI_Controller {

    public $userHandler;

    public function __construct() {
        parent::__construct();
        $this->ci = & get_instance();
        $this->userHandler = new User_handler();
        $excludeArray   =   array('ctrlLogin');
        if(!in_array(end($this->uri->segments),$excludeArray)){
            $responseArray = userLoginCheck($type = 'html', $role = ROLE_ADMIN);
        }
    }

    public function index(){
         if(!empty($this->session->userdata('userid')) && $this->session->userdata('userrole') == ROLE_ADMIN){
            redirect(getUrl('Dashboard'));
        }
//         if ($responseArray['status'] != 1) {
//            if ($responseArray['response']['total'] == 0) {
//
//                 getUrl('ctrlLogin');
//            }
//        }else{
//             if($responseArray['response']['sessionData']['userrole']=='admin'){
//                 
//                  redirect(getUrl('Dashboard')) ;
//             }else if($responseArray['response']['sessionData']['userrole']=='doctor'){
//                  
//                  redirect(getUrl('doctorDashboard')) ;
//             }
//            
//        }
        $data['page_title']='Admin Login';
        $data['page']='adminLogin';
        $data['content'] = 'ctrl/admin_login';
        $template = 'templates/ctrl_login_template';
        $this->load->view($template, $data);
        
    }
    
   
    public function profile(){
        $data['active']= " ";
        $data['page_title']='Admin Profile';
        $data['content'] = 'ctrl/ctrl_profile';
        $template = 'templates/ctrl_template';
        $this->load->view($template, $data);
    }

    public function logout(){
        $url = getUrl('ctrlLogin');
        logout($type = WEB_TYPE);
        redirect( $url);
    }
    
    public function dashboard(){
        $data['active']= " ";
        $data['page_title']='DashBoard';
        $data['content'] = 'ctrl/dashboard';
        $template = 'templates/ctrl_template';
        $this->load->view($template, $data);
    }
}
