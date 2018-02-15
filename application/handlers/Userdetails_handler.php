<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(APPPATH . 'handlers/handler.php');
class Userdetails_handler extends Handler{
    var $ci;
    
    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;

        $this->ci->load->model('Userdetails_model');
    }
    
    public function getAddionalDetails($userid){
        
        $this->ci->Userdetails_model->resetVariable();
        $selectInput = array();
        $whereUb = array();        
        $selectInput['id'] = $this->ci->Userdetails_model->user_id;
        $selectInput['gender'] = $this->ci->Userdetails_model->gender;
        $selectInput['date_of_birth'] = $this->ci->Userdetails_model->date_of_birth;
        $selectInput['education'] = $this->ci->Userdetails_model->highest_qualification;        
        $whereIn[$this->ci->Userdetails_model->user_id] = $userid;        
        $this->ci->Userdetails_model->setSelect($selectInput);
        $this->ci->Userdetails_model->setOrWhere($whereIn);
        $userData = $this->ci->Userdetails_model->get();
        return $userData;
       
    }
    
}