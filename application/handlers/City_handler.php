<?php

/* Cities related business logic will be defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    Pandu Babu
 */
require_once (APPPATH . 'handlers/handler.php');

class City_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('City_model');
    }

    public function getAllCities($limit = 100, $page = 0, $timestamp) {
        $this->ci->City_model->resetVariable();
        $selectInput = array();
        $stateData = array();
        $where = array();
        $selectInput['id'] = $this->ci->City_model->id;
        $selectInput['name'] = $this->ci->City_model->name;
        $selectInput['stateId'] = $this->ci->City_model->stateId;
        $this->ci->City_model->setSelect($selectInput);

        $where = array($this->ci->City_model->deleted => 0, $this->ci->City_model->status => 1);
        if (isset($timestamp) && ($timestamp != '')) {
            $where[$this->ci->City_model->cts . " >="] = $timestamp;
        }
        $this->ci->City_model->setWhere($where);
        
        
        if (($limit > 100) || ($limit == '')) {
            $limit = 100;
        }
        if ($page > 0) {
            $page = ($page - 1);
            $page = ($limit) * $page;
        }
		$limit = 1000;
        $this->ci->City_model->setRecords($limit, $page);
        
        $this->ci->City_model->orderBy="name asc";
        
        $cityData = $this->ci->City_model->get();
        
        //print_r($cityData);
        if (count($cityData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_CITY_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_city_data_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['cityData'] = $cityData;
        $output['response']['total'] = count($cityData);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }

    public function getCitiesByState($stateId, $limit = 100, $page = 0, $timestamp,$name='') {
       
        $this->ci->City_model->resetVariable();
        $selectInput = array();
        $stateData = array();
        $where = array();
        $selectInput['id'] = $this->ci->City_model->id;
        $selectInput['name'] = $this->ci->City_model->name;
        $selectInput['stateId'] = $this->ci->City_model->stateId;
        $this->ci->City_model->setSelect($selectInput);

        $where = array(
            $this->ci->City_model->stateId => $stateId,
            $this->ci->City_model->deleted => 0,
            $this->ci->City_model->status => 1
        );
        if (isset($timestamp) && ($timestamp != '')) {
            $where[$this->ci->City_model->cts . " >="] = $timestamp;
        }        
        $this->ci->City_model->setWhere($where);
        
        if (($limit > 100) || ($limit == '')) {
            $limit = 100;
        }
        if ($page > 0) {
            $page = ($page - 1);
            $page = ($limit) * $page;
        }
		$limit = 1000;
         if( isset($name) && ($name!=''))
       {
           $like[ $this->ci->City_model->name ] = $name;
           $this->ci->City_model->setlikeWildcard($like,'after');
       }
        $this->ci->City_model->setRecords($limit, $page);
        
        $this->ci->City_model->orderBy="name asc";
        
        $cityData = $this->ci->City_model->get();
        //print_r($cityData);
        if (count($cityData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_CITY_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_city_data_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['cityData'] = $cityData;
        $output['response']['total'] = count($cityData);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }
    
    public function  searchCity($name="") {
                         
       $this->ci->City_model->resetVariable();
       $selectInput =array();
       $countryData = array();
       $where =array();
       $like = array();
       $selectInput['id'] =$this->ci->City_model->id;
       $selectInput['name'] =$this->ci->City_model->name;
       $this->ci->City_model->setSelect($selectInput);
            
       $where =array($this->ci->City_model->deleted => 0,$this->ci->City_model->status => 1);
       $this->ci->City_model->setWhere($where); 
       
       if( isset($name) && ($name!=''))
       {
           $like[ $this->ci->City_model->name ] = $name;
       }
       
       $this->ci->City_model->setlikeWildcard($like,'after');
     
       $this->ci->City_model->orderBy="name asc";
        
       $cityData = $this->ci->City_model->get();
       //print_r($cityData);
       if(count($cityData)==0)
       {
            $output['status']=TRUE;
            $output['response']['message'][] = ERROR_NO_DATA;
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
       }
       $output['status'] =TRUE ;
       $output['response']['cityData'] =$cityData;
       $output['response']['total']=count($cityData);
       $output['statuscode'] = STATUS_OK;
       return $output ;
   }
   public function getCityData($cityId) {
        $is_id_array =   0;
        if(is_array($cityId)){
            $is_id_array =   1;
        }
        $this->ci->City_model->resetVariable();
        $selectInput = array();
        $userroleData = array();
        $where = array();
        $selectInput['id'] = $this->ci->City_model->id;
        $selectInput['name'] = $this->ci->City_model->name;
        $where[$this->ci->City_model->deleted] = 0;
        $where[$this->ci->City_model->status] = 1;
        $where[$this->ci->City_model->id] = $cityId;
        $this->ci->City_model->setSelect($selectInput);
         if($is_id_array){
           $whereIns[$this->ci->City_model->id]   =  $cityId; 
           $this->ci->City_model->setWhereIns($whereIns);
        }else{
         $where[$this->ci->City_model->id] = $cityId;
         $this->ci->City_model->setRecords(1);
        }
         
         
        $cityData = $this->ci->City_model->get();
        if (count($cityData) == 0) {
            $output['status'] = TRUE;
            $output['response']['total'] = 0;
            $output['statusCode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['cityData'] = $cityData;
        $output['response']['messages'] = array();
        $output['response']['total'] = 1;
        $output['statusCode'] = STATUS_OK;
        return $output;
    }
   
   
}

?>
