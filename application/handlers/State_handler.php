<?php

/* States related business logic will be defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    Pandu Babu
 */
require_once (APPPATH.'handlers/handler.php');
class State_handler extends Handler {
    var $ci;
    public function __construct() {
        parent::__construct();
        $this->ci =parent::$CI ;
        $this->ci->load->model('State_model');
    }
    public function  getAllStates($limit=100 ,$page=0,$timestamp) {
       $this->ci->State_model->resetVariable();
       $selectInput =array();
       $stateData = array();
       $where =array();
       $selectInput['id'] =$this->ci->State_model->id;
       $selectInput['name'] =$this->ci->State_model->name;
       $selectInput['countryId'] =$this->ci->State_model->countryId;
       $this->ci->State_model->setSelect($selectInput);
       
       $where =array($this->ci->State_model->deleted => 0,$this->ci->State_model->status => 1);
       if( isset($timestamp) && ($timestamp!=''))
       {
           $where[ $this->ci->State_model->cts . " >=" ] =$timestamp;
       }       
       $this->ci->State_model->setWhere($where); 
       
       if(($limit>100)||($limit==''))
       {
         $limit =100;
       } 
       if($page>0)
       { 
            $page = ($page-1);
            $page = ($limit)*$page;
       }
       $this->ci->State_model->setRecords($limit,$page);
       
       $this->ci->State_model->orderBy="name asc";
        
       $stateData = $this->ci->State_model->get();
       //print_r($stateData);
       if(count($stateData)==0)
       {
            $output['status']=TRUE;
            ///$output['response']['message'][] = ERROR_NO_STATE_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_state_data_message');
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
       }
       $output['status'] =TRUE ;
       $output['response']['stateData'] =$stateData;
       $output['response']['total']=count($stateData);
       $output['statuscode'] = STATUS_OK;
       return $output ;
   }
   
   public function getStatesByCountry($countryId, $limit = 100, $page = 0, $timestamp,$name='') {
       
        $this->ci->State_model->resetVariable();
        $selectInput = array();
        $stateData = array();
        $where = array();
        $selectInput['id'] = $this->ci->State_model->id;
        $selectInput['name'] = $this->ci->State_model->name;
        $selectInput['countryId'] = $this->ci->State_model->countryId;
        $this->ci->State_model->setSelect($selectInput);

        $where = array(
            $this->ci->State_model->countryId => $countryId,
            $this->ci->State_model->deleted => 0,
            $this->ci->State_model->status => 1
        );
        if (isset($timestamp) && ($timestamp != '')) {
            $where[$this->ci->State_model->cts . " >="] = $timestamp;
        }        
        $this->ci->State_model->setWhere($where);
        
        if (($limit > 100) || ($limit == '')) {
            $limit = 100;
        }
        if ($page > 0) {
            $page = ($page - 1);
            $page = ($limit) * $page;
        }
        $this->ci->State_model->setRecords($limit, $page);
         if( isset($name) && ($name!=''))
       {
           $like[ $this->ci->State_model->name ] = $name;
           $this->ci->State_model->setlikeWildcard($like,'after');
       }
       
       
        $this->ci->State_model->orderBy="name asc";
        
        $stateData = $this->ci->State_model->get();
        //print_r($stateData);
        if (count($stateData) == 0) {
            $output['status'] = TRUE;
            ///$output['response']['message'][] = ERROR_NO_STATE_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_state_data_message');
            $output['response']['total'] = 0;
            $output['statuscode'] = STATUS_NO_DATA;
            return $output;
        }
        $output['status'] = TRUE;
        $output['response']['stateData'] = $stateData;
        $output['response']['total'] = count($stateData);
        $output['statuscode'] = STATUS_OK;
        return $output;
    }
    
    public function  searchState($name="") {
                         
       $this->ci->State_model->resetVariable();
       $selectInput =array();
       $countryData = array();
       $where =array();
       $like = array();
       $selectInput['id'] =$this->ci->State_model->id;
       $selectInput['name'] =$this->ci->State_model->name;
       $this->ci->State_model->setSelect($selectInput);
            
       $where =array($this->ci->State_model->deleted => 0,$this->ci->State_model->status => 1);
       $this->ci->State_model->setWhere($where); 
       
       if( isset($name) && ($name!=''))
       {
           $like[ $this->ci->State_model->name ] = $name;
       }
       
       $this->ci->State_model->setlikeWildcard($like,'after');
     
       $this->ci->State_model->orderBy="name asc";
        
       $stateData = $this->ci->State_model->get();
       //print_r($stateData);
       if(count($stateData)==0)
       {
            $output['status']=TRUE;
            ///$output['response']['message'][] = ERROR_NO_STATE_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_no_state_data_message');
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
       }
       $output['status'] =TRUE ;
       $output['response']['stateData'] =$stateData;
       $output['response']['total']=count($stateData);
       $output['statuscode'] = STATUS_OK;
       return $output ;
   }
    public function getStateData($stateId){
        $is_id_array =   0;
       if(is_array($stateId)){
           $is_id_array =   1;
       }
       $this->ci->State_model->resetVariable();
       $selectInput =array();
       $stateData = array();
       $where =array();
       $selectInput['id'] =$this->ci->State_model->id;
       $selectInput['name'] =$this->ci->State_model->name;
       $this->ci->State_model->setSelect($selectInput);
       $where[$this->ci->State_model->deleted]  =    0;
       $where[$this->ci->State_model->status]   =     1;
       
       if($is_id_array){
           $whereIns[$this->ci->State_model->id]   =  $stateId; 
           $this->ci->State_model->setWhereIns($whereIns);
       }else{
        $where[$this->ci->State_model->id]       = $stateId;
        $this->ci->State_model->setRecords(1);
       }
       
       $this->ci->State_model->setWhere($where); 
       $stateData = $this->ci->State_model->get();
       //print_r($countryData);
       if(count($stateData)==0)
       {
            $output['status']=FALSE;
            $output['response']['message'][] = $this->ci->lang->line('error_no_state_data_message');
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
       }
       $output['status'] =TRUE ;
       $output['response']['stateData'] =$stateData;
       $output['response']['total']=count($stateData);
       $output['statuscode'] = STATUS_OK;
       return $output ;
       
   }
   
}
?>
