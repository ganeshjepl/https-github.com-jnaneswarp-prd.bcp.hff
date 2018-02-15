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
//require_once (APPPATH . 'libraries/REST_Controller.php');
require_once (APPPATH . 'handlers/User_handler.php');
require_once (APPPATH . 'handlers/MedicineCatalog_handler.php');

class MedicineCatalog extends CI_Controller {

    public $userHandler;
    public $medicineCatalogHandler;

    public function __construct() {
       
        parent::__construct();
        $responseArray = userLoginCheck();
        if ($responseArray['status'] != 1) {
            if ($responseArray['response']['total'] == 0) {
               
                 redirect(getUrl('ctrlLogin'));
            }
        }else{
            
             if($responseArray['response']['sessionData']['userrole']=='admin'){
                 
                  getUrl('dashboard') ;
             }else if($responseArray['response']['sessionData']['userrole']=='doctor'){
                  
                  redirect(getUrl('doctorDashboard')) ;
             }
        }
        $this->userHandler = new User_handler();
        $this->medicineCatalogHandler = new MedicineCatalog_handler();
        
        
    }

    public function medicine_catalog($limit=100,$page=1){
        $data['active']= "medicineactive";
        $response= $this->medicineCatalogHandler->getMedicineCatalog('',$limit,$page);
        
        if($response['status']==1){
                   
          $data['list']=$response['response']['medicineCatalog'];
           
        }else{
           $data['list']=0;
        }
        $data['page_title']='Medicine Catalog';
        $data['content'] = 'ctrl/medicine_catalog';
        $template = 'templates/ctrl_template';
        $this->load->view($template, $data);
            
        
    }
    
    
}
