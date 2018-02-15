<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once (APPPATH . 'handlers/handler.php');
require_once (APPPATH . 'handlers/Prescription_handler.php');

class MedicineCatalog_handler extends Handler {
    var $ci; 
    
    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('MedicineCatalog_model');
        $this->prescriptionHandler  = new Prescription_handler();
    }
    
    
     public function InsertMedicineCatalog($inputData) {
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->id] = $inputData["id"];
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->name] = strip_tags($inputData["name"]);
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->brand] = $inputData["brand"];
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->generic_name] = $inputData["generic_name"];
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->dosage] = $inputData["dosage"];
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->batch_number] = $inputData["batch_number"];
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->expiry_date] = $inputData["expiry_date"];
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->indications] = $inputData["indications"];
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->quantity] = $inputData["quantity"];
        $this->ci->MedicineCatalog_model->insertUpdateArray[$this->ci->MedicineCatalog_model->stock] = $inputData["quantity"];                
        $MedicineCatalogdata = $this->ci->MedicineCatalog_model->insertdata($this->ci->MedicineCatalog_model->dbTable, $this->ci->MedicineCatalog_model->insertUpdateArray);
                  
        if ($MedicineCatalogdata != '') {            
            $output['status'] = TRUE;
            $output['response']['messages'] = $this->ci->lang->line('success_medicine_catelogue_created_message');
            $output['statusCode'] = STATUS_CREATED;
            return $output;
        }
        $output['status'] = FALSE;
        ///$output['response']['messages'] = ERROR_INVALID_DATA;
        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
        $output['statusCode'] = STATUS_BAD_REQUEST;
        return $output;
    }
    
    public function updateMedicineCatalog($inputData) {
        $this->ci->MedicineCatalog_model->resetVariable();
        $insertUpdateArray=array();
        $where = array();
        $id= $inputData['id'];
        $insertUpdateArray['name'] = $inputData["name"];
        $insertUpdateArray['brand'] = $inputData["brand"];
        $insertUpdateArray['generic_name'] = $inputData["generic_name"];
        $insertUpdateArray['dosage'] = $inputData["dosage"];
        $insertUpdateArray['batch_number'] = $inputData["batch_number"];
        $insertUpdateArray['expiry_date'] = $inputData["expiry_date"];
        $insertUpdateArray['indications'] = $inputData["indications"];
        $insertUpdateArray['quantity'] = $inputData["quantity"];
        $insertUpdateArray['stock'] = $inputData["quantity"];
        $where = array($this->ci->MedicineCatalog_model->id => $id);
        $this->ci->MedicineCatalog_model->setInsertUpdateData($insertUpdateArray);
        $this->ci->MedicineCatalog_model->setWhere($where);
        $response = $this->ci->MedicineCatalog_model->update_data();
        
        if ($response) {            
            $output['status'] = TRUE;
            $output['response']['messages'] = $this->ci->lang->line('success_medicine_catelogue_updated_message');
            $output['statusCode'] = STATUS_CREATED;
            return $output;
        }
        $output['status'] = FALSE;
        ///$output['response']['messages'] = ERROR_INVALID_DATA;
        $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
        $output['statusCode'] = STATUS_BAD_REQUEST;
        return $output;
    }
      
    public function deleteMedicineCatalog($inputData) {
        $id= $inputData['id'];
        $medicineList = $this->prescriptionHandler->medicineInPrecicription($id);
        if(count($medicineList)==0){
        $data = array();
        $data['deleted']=1;
        $where = array($this->ci->MedicineCatalog_model->id => $id);
        $this->ci->MedicineCatalog_model->setInsertUpdateData($data);
        $this->ci->MedicineCatalog_model->setWhere($where);
        $response = $this->ci->MedicineCatalog_model->update_data();
        //print_r($response);
        //exit;
              
        if ($response) {            
            $output['status'] = TRUE;
            $output['response']['messages'] = $this->ci->lang->line('success_medicine_catelogue_deleted_message');
            $output['statusCode'] = STATUS_CREATED;
            return $output;
        }
            $output['status'] = FALSE;
            ///$output['response']['messages'] = ERROR_INVALID_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_invalid_data_message');
            $output['statusCode'] = STATUS_BAD_REQUEST;
            return $output;
        }else{
            $output['status'] = FALSE;
            ///$output['response']['messages'] = ERROR_INVALID_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('medicine_in_prescription_cannot_delete');
            $output['statusCode'] = STATUS_BAD_REQUEST;
            return $output;
        }
    }
        
    
     public function  getMedicineCatalog($ids = '',$limit=100 ,$page=0,$timestamp='') {
         
       $this->ci->MedicineCatalog_model->resetVariable();
       $selectInput =array();
       $medicineCatalog = array();
       $where =array();
       $whereIn =array();
       $selectInput['id'] =$this->ci->MedicineCatalog_model->id;
       $selectInput['name'] =$this->ci->MedicineCatalog_model->name;
       $selectInput['brand'] =$this->ci->MedicineCatalog_model->brand;
       $selectInput['generic_name'] =$this->ci->MedicineCatalog_model->generic_name;
       $selectInput['dosage'] =$this->ci->MedicineCatalog_model->dosage;
       $selectInput['batch_number'] =$this->ci->MedicineCatalog_model->batch_number;
       $selectInput['expiry_date'] =$this->ci->MedicineCatalog_model->expiry_date;
       $selectInput['indications'] =$this->ci->MedicineCatalog_model->indications;
       $selectInput['quantity'] =$this->ci->MedicineCatalog_model->quantity;
       $selectInput['stock'] =$this->ci->MedicineCatalog_model->stock;
       
       $this->ci->MedicineCatalog_model->setSelect($selectInput);
       
       
       if(!empty($ids)){
           $whereIn[$this->ci->MedicineCatalog_model->id] =   $ids;
           
       }
       if( isset($timestamp) && ($timestamp!=''))
       {
           $where[ $this->ci->MedicineCatalog_model->expiry_date . " >=" ] =$timestamp;
           $where =array($this->ci->MedicineCatalog_model->deleted => 0,$this->ci->MedicineCatalog_model->status => 1);
       }       
       $this->ci->MedicineCatalog_model->setWhere($where); 
       $this->ci->MedicineCatalog_model->setOrWhere($whereIn); 
       
       if(($limit>100)||($limit==''))
       {
         $limit =100;
       } 
       if($page>0)
       { 
            $page = ($page-1);
            $page = ($limit)*$page;
       }
       $this->ci->MedicineCatalog_model->setRecords($limit,$page);
       
       $this->ci->MedicineCatalog_model->orderBy="name asc";
       
       
       
       
       
       $medicineCatalog = $this->ci->MedicineCatalog_model->get();
//       print_r(count($medicineCatalog)); exit;
       if(count($medicineCatalog)==0)
       {
            $output['status']=FALSE;
            ///$output['response']['message'][] = ERROR_NO_MEDICINE_DATA;
            $output['response']['messages'][] = $this->ci->lang->line('error_medicine_not_found_message');
            $output['response']['total']=0;
            $output['statuscode']  = STATUS_NO_DATA ;
            return $output ;
       }
       $output['status'] =TRUE ;
       $output['response']['medicineCatalog'] =$medicineCatalog;
       $output['response']['total']=count($medicineCatalog);
       $output['statuscode'] = STATUS_OK;
       return $output ;
   }
    
    
    
    
    
}
