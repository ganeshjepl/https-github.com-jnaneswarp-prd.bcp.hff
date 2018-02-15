<?php

/* Reports related business logic will be defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             18-07-2017
 * @Last Modified       18-07-2017
 * @Last Modified By    shivajyothi
 */
require_once(APPPATH . 'handlers/handler.php');
class Reports_handler extends Handler {
    var $ci;
    public function __construct() {
        parent::__construct();
        $this->ci =parent::$CI ;
        $this->ci->load->model('Medicalincidentdetail_model');
    }
    public function getAllReports($bcpid){
         
        
        $this->ci->Medicalincidentdetail_model->resetVariable(); 
        //--------------------------//
        $selectInput = array();
        $disuriyaData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $where = array($this->ci->Medicalincidentdetail_model->deleted => 0, $this->ci->Medicalincidentdetail_model->status => 1, $this->ci->Medicalincidentdetail_model->surveyId=>2);
        if(!empty($bcpid)&&($bcpid!='')){
          
          $where[$this->ci->Medicalincidentdetail_model->createdby]=$bcpid;  
        } 
        
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $disuriyaData = $this->ci->Medicalincidentdetail_model->get();
        $this->ci->Medicalincidentdetail_model->resetVariable();
         //--------------------------//
        $selectInput = array();
        $cssfbpData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $where = array($this->ci->Medicalincidentdetail_model->deleted => 0, $this->ci->Medicalincidentdetail_model->status => 1, $this->ci->Medicalincidentdetail_model->surveyId=>3);
        if(!empty($bcpid)&&($bcpid!='')){
          $where[$this->ci->Medicalincidentdetail_model->createdby]=$bcpid;  
        } 
       
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $cssfbpData = $this->ci->Medicalincidentdetail_model->get();
        $this->ci->Medicalincidentdetail_model->resetVariable();
        //--------------------------//
        $selectInput = array();
        $woundsData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $where = array($this->ci->Medicalincidentdetail_model->deleted => 0, $this->ci->Medicalincidentdetail_model->status => 1, $this->ci->Medicalincidentdetail_model->surveyId=>4);
          if(!empty($bcpid)&&($bcpid!='')){
          $where[$this->ci->Medicalincidentdetail_model->createdby]=$bcpid;  
        } 
        
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $woundsData = $this->ci->Medicalincidentdetail_model->get();
        $this->ci->Medicalincidentdetail_model->resetVariable();
        //--------------------------//
        $selectInput = array();
        $fdisuriyaData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $where = array($this->ci->Medicalincidentdetail_model->deleted => 0, $this->ci->Medicalincidentdetail_model->status => 1, $this->ci->Medicalincidentdetail_model->surveyId=>5);
       if(!empty($bcpid)&&($bcpid!='')){
          $where[$this->ci->Medicalincidentdetail_model->createdby]=$bcpid;  
        } 
         
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $fdisuriyaData = $this->ci->Medicalincidentdetail_model->get();
        $this->ci->Medicalincidentdetail_model->resetVariable();
        //--------------------------//
        $selectInput = array();
        $fcssfbpData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $where = array($this->ci->Medicalincidentdetail_model->deleted => 0, $this->ci->Medicalincidentdetail_model->status => 1, $this->ci->Medicalincidentdetail_model->surveyId=>6);
        if(!empty($bcpid)&&($bcpid!='')){
          $where[$this->ci->Medicalincidentdetail_model->createdby]=$bcpid;  
        } 
        
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $fcssfbpData = $this->ci->Medicalincidentdetail_model->get();
        $this->ci->Medicalincidentdetail_model->resetVariable();
        //--------------------------//
        $selectInput = array();
        $fwoundsData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Medicalincidentdetail_model->id;
        $this->ci->Medicalincidentdetail_model->setSelect($selectInput);
        $where = array($this->ci->Medicalincidentdetail_model->deleted => 0, $this->ci->Medicalincidentdetail_model->status => 1, $this->ci->Medicalincidentdetail_model->surveyId=>7);
       
        if($bcpid!=''){
           $where[$this->ci->Medicalincidentdetail_model->createdby]=$bcpid;   
        } 
        
        $this->ci->Medicalincidentdetail_model->setWhere($where);
        $fwoundsData = $this->ci->Medicalincidentdetail_model->get();
        $this->ci->Medicalincidentdetail_model->resetVariable();
         
         
        $reportData[0]['label'] ='Dysuria';
        $reportData[0]['value']= count($disuriyaData);
        $reportData[1]['label'] ='CSSFBP';
        $reportData[1]['value']= count($cssfbpData);  
        $reportData[2]['label'] ='Wounds';
        $reportData[2]['value']= count($woundsData); 
         
        if((count($disuriyaData)==0)&&(count($cssfbpData)==0)&&(count($woundsData)==0)){
           
            $output['status'] = FALSE;
            $output['response']['message'][] = $this->ci->lang->line('error_medicine_not_found_message') ;
            $output['response']['total'] = 0 ;
            $output['statuscode'] = STATUS_OK;
            return $output;
        }
         $toatl = count($disuriyaData) +count($cssfbpData)+count($woundsData);
        $output['status'] = TRUE ;
        $output['response']['reportData'] = $reportData;
        $output['response']['total'] = $toatl ;
        $output['statuscode'] = STATUS_OK;
        return $output;
    
    }
}
