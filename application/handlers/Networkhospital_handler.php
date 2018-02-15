<?php
/* Network hospital business logic will be defined in the class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             24-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    shivajyothi
 */
require_once (APPPATH.'handlers/handler.php');
class Networkhospital_handler Extends Handler{
    var $ci;
    function __construct() {
        parent::__construct();
        $this->ci =parent::$CI;
        $this->ci->load->model('Networkhospital_model');
      
    }
    public function getNetworkHospitals($timestamp = "",$ids = '',$role='') {
        $this->ci->Networkhospital_model->resetVariable();
        $selectInput = array();
        $networkhospitalsData = array();
        $where      =array();
        $whereIn    =array();
        $orderby    =array();
         $selectInput[$this->ci->Networkhospital_model->id] =$this->ci->Networkhospital_model->id;
        $selectInput[$this->ci->Networkhospital_model->name] =$this->ci->Networkhospital_model->name;
        $selectInput[$this->ci->Networkhospital_model->address] =$this->ci->Networkhospital_model->address;
        $selectInput[$this->ci->Networkhospital_model->status] =$this->ci->Networkhospital_model->status; 
        $selectInput[$this->ci->Networkhospital_model->geoLatitude] =$this->ci->Networkhospital_model->geoLatitude;
        $selectInput[$this->ci->Networkhospital_model->geoLongitude] =$this->ci->Networkhospital_model->geoLongitude;
        $selectInput[$this->ci->Networkhospital_model->type] =$this->ci->Networkhospital_model->type;
        $selectInput[$this->ci->Networkhospital_model->contactNumber] =$this->ci->Networkhospital_model->contactNumber;
        $selectInput[$this->ci->Networkhospital_model->website] =$this->ci->Networkhospital_model->website;
        $selectInput[$this->ci->Networkhospital_model->status] = $this->ci->Networkhospital_model->status;
        $selectInput[$this->ci->Networkhospital_model->deleted] = $this->ci->Networkhospital_model->deleted;
        
        $where[$this->ci->Networkhospital_model->deleted] = 0;
        
        if($role !='admin'){
        $where[$this->ci->Networkhospital_model->status] = 1;
        //$where[$this->ci->Networkhospital_model->status] = 0;
        }
        if(!empty($ids) && is_array($ids)){
            $whereIn[$this->ci->Networkhospital_model->id] = $ids;
        }
        $orderby[] = $this->ci->Networkhospital_model->id ." desc " ;
        $this->ci->Networkhospital_model->setSelect($selectInput);
        $this->ci->Networkhospital_model->setWhere($where);
        $this->ci->Networkhospital_model->setOrWhere($whereIn);
        $this->ci->Networkhospital_model->setOrderBy($orderby) ;
        $networkhospitalsData = $this->ci->Networkhospital_model->get();
        if(count( $networkhospitalsData)==0)
        {
             $output['status']=FALSE;
             ///$output['response']['message'][] = ERROR_NO_NETWORK_HOSPITAL_DATA;
             $output['response']['messages'][] = $this->ci->lang->line('error_no_network_hospital_data_message');
             $output['response']['total']=0;
             $output['statuscode']  = STATUS_NO_DATA ;
             return $output ;
        }
        $output['status'] =TRUE ;
        $output['response']['networkhospitalData'] =$networkhospitalsData;
        $output['response']['total']=count($networkhospitalsData);
        $output['statuscode'] = STATUS_OK;
        return $output ;
        
    }
    public function deleteNetworkHospitals($netHospId){
         //$this->ci->session->set_userdata('userid',1);
        $networkHospitalsData=array();
        $where = array();
        $networkHospitalsData[$this->ci->Networkhospital_model->deleted] =1;
        $where = array($this->ci->Networkhospital_model->id => $netHospId);
        $this->ci->Networkhospital_model->setInsertUpdateData($networkHospitalsData);
         $this->ci->Networkhospital_model->setWhere($where);
          $status = $this->ci->Networkhospital_model->update_data();  
        if($status!=''){
            $output['status'] = TRUE;
            $output['response']['messages'] =  $this->ci->lang->line('sucess_network_hospital_deleted_message');
            $output['statusCode'] = STATUS_OK;
            return $output; 
        }
        $output['status'] = FALSE;
        $output['response']['messages'] = '';
        $output['statusCode'] = STATUS_BAD_REQUEST;
        return $output;
    }
    public function addNetworkHospitals($inputData) {
       
     //echo  $address = $inputData['countryname'].",". $inputData["address"].",".$inputData["zipcode"].",".$inputData["name"];
        $address = $inputData["name"].",".$inputData["address"].",".$inputData['statename'].",".$inputData["zipcode"].",".$inputData['countryname'];
        $prepAddr = str_replace(' ','+',$address);
        $details=file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$prepAddr."&sensor=false");
        $result = json_decode($details,true);
         if($result['status']!='ZERO_RESULTS'){
              $lat=$result['results'][0]['geometry']['location']['lat'];
              $lng=$result['results'][0]['geometry']['location']['lng'];
          
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->name] = $inputData["name"];
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->zipcode] = $inputData["zipcode"];
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->countryId] = $inputData["country"];
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->stateId] = $inputData["state"];
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->type] = $inputData["type"];
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->contactNumber] = $inputData["contactnumber"];
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->website] = $inputData["website"];
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->address] = $inputData["address"];
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->geoLatitude] = $lat;
            $this->ci->Networkhospital_model->insertUpdateArray[$this->ci->Networkhospital_model->geoLongitude] =$lng;

            $netHospId = $this->ci->Networkhospital_model->insert_data($this->ci->Networkhospital_model->dbTable, $this->ci->Networkhospital_model->insertUpdateArray);
            if ($netHospId != '') {
                $output['status'] = TRUE;
                ///$output['response']['messages'] =  HOSPITAL_DATA_INSERTED;
                $output['response']['messages'][] = $this->ci->lang->line('success_hospital_details_created_message');
                $output['statusCode'] = STATUS_CREATED;
                return $output;
            }
        
         }else{
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
    public function getNetworkHospital($id,$timestamp='',$countryId='',$role='') {
        $this->ci->load->model('Country_model');
        $this->ci->load->model('State_model');
        $this->ci->Networkhospital_model->resetVariable();
        $selectInput = array();
        $networkhospitalsData = array();
        $where =array();
        $selectInput[$this->ci->Networkhospital_model->id] =$this->ci->Networkhospital_model->id;
        $selectInput[$this->ci->Networkhospital_model->name] =$this->ci->Networkhospital_model->name;
        $selectInput[$this->ci->Networkhospital_model->address] =$this->ci->Networkhospital_model->address;
        $selectInput[$this->ci->Networkhospital_model->zipcode] =$this->ci->Networkhospital_model->zipcode;
        $selectInput[$this->ci->Networkhospital_model->status] =$this->ci->Networkhospital_model->status; 
        $selectInput[$this->ci->Networkhospital_model->countryId] =$this->ci->Networkhospital_model->countryId;
        $selectInput[$this->ci->Networkhospital_model->stateId] =$this->ci->Networkhospital_model->stateId;
        $selectInput[$this->ci->Networkhospital_model->geoLatitude] =$this->ci->Networkhospital_model->geoLatitude;
        $selectInput[$this->ci->Networkhospital_model->geoLongitude] =$this->ci->Networkhospital_model->geoLongitude;
        $selectInput[$this->ci->Networkhospital_model->type] =$this->ci->Networkhospital_model->type;
        $selectInput[$this->ci->Networkhospital_model->contactNumber] =$this->ci->Networkhospital_model->contactNumber;
        $selectInput[$this->ci->Networkhospital_model->website] =$this->ci->Networkhospital_model->website;
        $where[$this->ci->Networkhospital_model->deleted] = 0;
        if($role!='admin'){
        $where[$this->ci->Networkhospital_model->status] = 1;
         
        } 
        $where[$this->ci->Networkhospital_model->id] =$id;
        
        $this->ci->Networkhospital_model->setSelect($selectInput);
        
        if(!empty($countryId)&&($countryId!='')){
          $where[$this->ci->Networkhospital_model->countryid]=$countryId;  
        }
        if(!empty($stateId)&&($stateId!='')){
          $where[$this->ci->Networkhospital_model->stateid]=$stateId;  
        }
        
        if($timestamp!=""){
            $where[$this->ci->Networkhospital_model->mts . ">" ] = $timestamp;
        } 
        $this->ci->Networkhospital_model->setWhere($where);
        $networkhospitalsData = $this->ci->Networkhospital_model->get();
        
        if(count($networkhospitalsData)>0){
            foreach($networkhospitalsData as $data){
                if(isset($country_ids[$data['id']])){
                    array_push($country_ids[$data['id']],$data['country_id']);
                }else{
                    $country_ids[$data['id']]   =   $data['country_id'];
                }   
                if(isset($state_ids[$data['id']])){
                    array_push($state_ids[$data['id']],$data['state_id']);
                }else{
                    $state_ids[$data['id']]   =   $data['state_id'];
                }   
                
            }
        $this->ci->Country_model->resetVariable();
        $selectInput = array();
        $where = array();
        $selectInput['id'] = $this->ci->Country_model->id;
        $selectInput['country'] = $this->ci->Country_model->name;
        $this->ci->Country_model->setSelect($selectInput);
        $where[$this->ci->Country_model->deleted] = 0;
        $where[$this->ci->Country_model->status] = 1;
        
        
            $whereIns[$this->ci->Country_model->id] = $country_ids;
            $this->ci->Country_model->setWhereIns($whereIns);
        
        $country_details = $this->ci->Country_model->get(); 
        $final_country_details = null;
        foreach($country_details as $key => $country){
            $final_country_details[$country['id']]    =   $country['country'];
        }
        
        
        $this->ci->State_model->resetVariable();
        $selectInput = array();
        $where = array();
        $selectInput['id'] = $this->ci->State_model->id;
        $selectInput['state'] = $this->ci->State_model->name;
        $this->ci->State_model->setSelect($selectInput);
        $where[$this->ci->State_model->deleted] = 0;
        $where[$this->ci->State_model->status] = 1;
        
            $whereIns[$this->ci->State_model->id] = $state_ids;
            $this->ci->State_model->setWhereIns($whereIns);
        
        $state_details = $this->ci->State_model->get(); 
        
        $final_state_details    =   null;
        foreach($state_details as $key => $state){
            $final_state_details[$state['id']]    =   $state['state'];
        }
        
       if (count($networkhospitalsData) > 0) {
                foreach($networkhospitalsData as $key =>  $user){
                    if(!isset($final_country_details[$user['country_id']])) $final_country_details[$user['countryid']] = '';
                    if(!isset($final_state_details[$user['state_id']])) $final_state_details[$user['stateid']] = '';
                    $networkhospitalsData[$key]['country_name'] = $final_country_details[$user['country_id']];
                    $networkhospitalsData[$key]['state_name'] = $final_state_details[$user['state_id']];
                    }
                
                if(!isset($final_country_details[$user['country_id']])) $final_country_details[$user['country_id']] = '';
                if(!isset($final_state_details[$user['state_id']])) $final_state_details[$user['state_id']] = '';
                $networkhospitalsData[$key]['country_name'] = $final_country_details[$user['country_id']];
                $networkhospitalsData[$key]['state_name'] = $final_state_details[$user['state_id']];
                
            }
        }
        
        if(count( $networkhospitalsData)==0)
        {
             $output['status']=TRUE;
             $output['response']['message'][] = $this->ci->lang->line('error_no_network_hospital_data_message');
             $output['response']['total']=0;
             $output['statusCode']  = STATUS_NO_DATA ;
             return $output ;
        }
        $output['status'] =TRUE ;
        $output['response']['networkhospitalData'] =$networkhospitalsData;
        $output['response']['total']=count($networkhospitalsData);
        $output['statusCode'] = STATUS_OK;
        return $output ;
        
    }
    public function editNetworkHospitals($inputData) {
        $address = $inputData["name"].",". $inputData["address"].",".$inputData['statename'].",".$inputData["zipcode"].",".$inputData['countryname'];
        $prepAddr = str_replace(' ','+',$address);
        $details=file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$prepAddr."&sensor=false");
        $result = json_decode($details,true);
        
         if($result['status']!='ZERO_RESULTS'){
              $lat=$result['results'][0]['geometry']['location']['lat'];
              $lng=$result['results'][0]['geometry']['location']['lng'];
         
         
            $networkHospitalsData=array();
            $where = array();
            $networkHospitalsData[$this->ci->Networkhospital_model->name] =  $inputData["name"];
            $networkHospitalsData[$this->ci->Networkhospital_model->zipcode] =$inputData["zipcode"];
            $networkHospitalsData[$this->ci->Networkhospital_model->countryId] = $inputData["country"];
            $networkHospitalsData[$this->ci->Networkhospital_model->stateId] = $inputData["state"];
            $networkHospitalsData[$this->ci->Networkhospital_model->type] =$inputData["type"];
            $networkHospitalsData[$this->ci->Networkhospital_model->status] =$inputData["status"];
            $networkHospitalsData[$this->ci->Networkhospital_model->contactNumber] =  $inputData["contactnumber"];
            $networkHospitalsData[$this->ci->Networkhospital_model->website] =  $inputData["website"];
            $networkHospitalsData[$this->ci->Networkhospital_model->address] = $inputData["address"];
            $networkHospitalsData[$this->ci->Networkhospital_model->geoLatitude] = $lat;
            $networkHospitalsData[$this->ci->Networkhospital_model->geoLongitude] =$lng;

            $where = array($this->ci->Networkhospital_model->id =>  $inputData["networkEditid"]); 
            $this->ci->Networkhospital_model->setInsertUpdateData($networkHospitalsData);
            $this->ci->Networkhospital_model->setWhere($where);
            $status = $this->ci->Networkhospital_model->update_data();
            //print_r($status); exit;
             if ($status) {
                $output['status'] = TRUE;
                ///$output['response']['messages'] =  HOSPITAL_DATA_UPDATED;
                $output['response']['messages'][] = $this->ci->lang->line('success_hospital_details_updated_message');
                $output['statusCode'] = STATUS_CREATED;
                return $output;
            }
         }else{
            $output['status'] = FALSE;
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
}
?>
