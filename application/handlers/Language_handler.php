<?php

/* language related business logic defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    shivajyothi
 */
require_once (APPPATH.'handlers/handler.php');
class Language_handler extends  handler{
    var $ci ;
    public function __construct() {
        parent::__construct();
        $this->ci =parent::$CI ;
        $this->ci->load->model('Language_model');
    }
    public function getLanguageDetails($limit, $page=0, $timestamp = ""){
        $this->ci->Language_model->resetVariable();
        $selectInput =array();
        $languageData = array();
        $selectInput['id']   = $this->ci->Language_model->id;
        $selectInput['name'] = $this->ci->Language_model->name;
        $selectInput['code'] = $this->ci->Language_model->code;
        $selectInput['status'] = $this->ci->Language_model->status;
        $selectInput['deleted'] = $this->ci->Language_model->deleted;
        $this->ci->Language_model->setSelect($selectInput);
        $where[$this->ci->Language_model->deleted] = 0;
        $where[$this->ci->Language_model->status]=1;
        if($timestamp!=""){
            $where[$this->ci->Language_model->mts . ">" ] = $timestamp;
        }   
        $this->ci->Language_model->setWhere($where); 
        if(($limit>100)||($limit=='')){
         $limit =100;
        } 
        if($page>0){
              $page = ($page-1);
              $page = ($limit)*$page;
         }
        $this->ci->Language_model->setRecords($limit,$page);
        $languageData = $this->ci->Language_model->get();
        if(count( $languageData)==0){
        $output['status']=TRUE;
             ///$output['response']['message'][] =ERROR_NO_LANGUAGE_DATA;
             $output['response']['messages'][] = $this->ci->lang->line('error_no_language_message');
             $output['response']['total']=0;
             $output['statuscode']  = STATUS_NO_DATA ;
             return $output ;
         }
         $output['status'] =TRUE ;
         $output['response']['languageData'] =$languageData;
         $output['response']['total']=count($languageData);
         $output['statuscode'] = STATUS_OK;
         return $output ;
    }
    
    public function  searchLanguage($name="") {
                         
       $this->ci->Language_model->resetVariable();
       $selectInput =array();
       $languageData = array();
       $where =array();
       $like = array();
       $selectInput['id'] =$this->ci->Language_model->id;
       $selectInput['name'] =$this->ci->Language_model->name;
       $this->ci->Language_model->setSelect($selectInput);
            
       $where =array($this->ci->Language_model->deleted => 0,$this->ci->Language_model->status => 1);
       $this->ci->Language_model->setWhere($where); 
       
       if( isset($name) && ($name!=''))
       {
           $like[ $this->ci->Language_model->name ] = $name;
           $this->ci->Language_model->setlikeWildcard($like,'after');
       }
       
       
     
       $this->ci->Language_model->orderBy="name asc";
        
       $languageData = $this->ci->Language_model->get();
       //print_r($countryData);
       if(count($languageData)==0)
       {
            $output['status']=TRUE;
            ///$output['response']['message'][] = ERROR_NO_COUNTRY_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_country_data_message');
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
       }
       $output['status'] =TRUE ;
       $output['response']['languageData'] =$languageData;
       $output['response']['total']=count($languageData);
       $output['statuscode'] = STATUS_OK;
       return $output ;
   }
   public function getLanguageData($languageId) {
        $this->ci->Language_model->resetVariable();
        $selectInput = array();
        $userroleData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Language_model->id;
        $selectInput['name'] = $this->ci->Language_model->name;
        $selectInput['code'] = $this->ci->Language_model->code;
        $where[$this->ci->Language_model->deleted] = 0;
        $where[$this->ci->Language_model->status] = 1;
        if($languageId != ""){
            $where[$this->ci->Language_model->id] = $languageId;
        }else{
            $where[$this->ci->Language_model->name] = ENGLISH;
        }
        $this->ci->Language_model->setSelect($selectInput);
        $this->ci->Language_model->setWhere($where);
        //$this->ci->Language_model->setLike($like);
        $this->ci->Language_model->setRecords(1);
        $languageData = $this->ci->Language_model->get();
        //print_r(); exit;
        if(count($languageData)==0)
            {
                 $output['status']=TRUE;
                 $output['response']['message'][] = ERROR_NO_LANGUAGE_DATA;
                 $output['response']['total']=0;
                 $output['statuscode']  = STATUS_NO_DATA ;
                 return $output ;
            }
            $output['status'] =TRUE ;
            $output['response']['languageData'] =$languageData[0];
            $output['response']['total']=count($languageData);
            $output['statuscode'] = STATUS_OK;
            return $output ;
        }
 }
?>
