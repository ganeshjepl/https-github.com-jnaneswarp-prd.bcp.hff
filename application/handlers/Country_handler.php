<?php

/* countries related business logic will be defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    Pandu Babu
 */
require_once (APPPATH.'handlers/handler.php');
require_once (APPPATH.'handlers/Country_handler.php');
class Country_handler extends Handler {
    var $ci;
    public function __construct() {
        parent::__construct();
        $this->ci =parent::$CI ;
        $this->ci->load->model('Country_model');
    }
    
    public function  getAllCountries($limit=100 ,$page=0,$timestamp) {
       $this->ci->Country_model->resetVariable();
       $selectInput =array();
       $countryData = array();
       $where =array();
       $selectInput['id'] =$this->ci->Country_model->id;
       $selectInput['name'] =$this->ci->Country_model->name;
       $selectInput['shortName'] =$this->ci->Country_model->shortName;
       $selectInput['code'] =$this->ci->Country_model->code;
       $this->ci->Country_model->setSelect($selectInput);
       
       $where =array($this->ci->Country_model->deleted => 0,$this->ci->Country_model->status => 1);
       if( isset($timestamp) && ($timestamp!=''))
       {
           $where[ $this->ci->Country_model->cts . " >=" ] =$timestamp;
       }       
       $this->ci->Country_model->setWhere($where); 
       
       if(($limit>100)||($limit==''))
       {
         $limit =100;
       } 
       if($page>0)
       { 
            $page = ($page-1);
            $page = ($limit)*$page;
       }
       $this->ci->Country_model->setRecords($limit,$page);
       
       $this->ci->Country_model->orderBy="name asc";
        
       $countryData = $this->ci->Country_model->get();
       //print_r($countryData);
       if(count($countryData)==0)
       {
            $output['status']=TRUE;
            ///$output['response']['message'][] = ERROR_NO_COUNTRY_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_country_data_message');
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
       }
       $output['status'] =TRUE ;
       $output['response']['countryData'] =$countryData;
       $output['response']['total']=count($countryData);
       $output['statuscode'] = STATUS_OK;
       return $output ;
   }
   
   public function  searchCountry($name="") {
                         
       $this->ci->Country_model->resetVariable();
       $selectInput =array();
       $countryData = array();
       $where =array();
       $like = array();
       $selectInput['id'] =$this->ci->Country_model->id;
       $selectInput['name'] =$this->ci->Country_model->name;
       $selectInput['shortName'] =$this->ci->Country_model->shortName;
       $selectInput['code'] =$this->ci->Country_model->code;
       $this->ci->Country_model->setSelect($selectInput);
            
       $where =array($this->ci->Country_model->deleted => 0,$this->ci->Country_model->status => 1);
       $this->ci->Country_model->setWhere($where); 
       
       if( isset($name) && ($name!=''))
       {
           $like[ $this->ci->Country_model->name ] = $name;
           $this->ci->Country_model->setlikeWildcard($like,'after');
       }
       
       
     
       $this->ci->Country_model->orderBy="name asc";
        
       $countryData = $this->ci->Country_model->get();
       //print_r($countryData);
       if(count($countryData)==0)
       {
            $output['status']=TRUE;
            ///$output['response']['message'][] = ERROR_NO_COUNTRY_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_country_data_message');
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
       }
       $output['status'] =TRUE ;
       $output['response']['countryData'] =$countryData;
       $output['response']['total']=count($countryData);
       $output['statuscode'] = STATUS_OK;
       return $output ;
   }
   public function getCountryData($countryId){
       $is_id_array =   0;
       if(is_array($countryId)){
           $is_id_array =   1;
       }
       $this->ci->Country_model->resetVariable();
       $selectInput =array();
       $countryData = array();
       $where =array();
       $selectInput['id'] =$this->ci->Country_model->id;
       $selectInput['name'] =$this->ci->Country_model->name;
       $selectInput['shortName'] =$this->ci->Country_model->shortName;
       $selectInput['code'] =$this->ci->Country_model->code;
       $this->ci->Country_model->setSelect($selectInput);
       $where[$this->ci->Country_model->deleted] = 0;
       $where[$this->ci->Country_model->status] = 1;
       if($is_id_array){
           $whereIns[$this->ci->Country_model->id]   =  $countryId; 
           $this->ci->Country_model->setWhereIns($whereIns);
       }else{
        $where[$this->ci->Country_model->id] = $countryId;
        $this->ci->Country_model->setRecords(1);
       }
       $this->ci->Country_model->setWhere($where); 
       $countryData = $this->ci->Country_model->get();
       //print_r($countryData);
       if(count($countryData)==0)
       {
            $output['status']=FALSE;
            ///$output['response']['message'][] = ERROR_NO_COUNTRY_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_country_data_message');
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
       }
       $output['status'] =TRUE ;
       $output['response']['countryData'] =$countryData;
       $output['response']['total']=count($countryData);
       $output['statuscode'] = STATUS_OK;
       return $output ;
       
   }
   
}
?>
