<?php

/* Taxonomy related business logic will be defined in this class
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       24-04-2017
 * @Last Modified By    shivajyothi
 */
require_once (APPPATH.'handlers/handler.php');
class Taxonomy_handler extends Handler {
    var $ci;
    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Taxonomy_model');
    }
    public function getTaxonomyDetails($id = ''){
         
       $this->ci->Taxonomy_model->resetVariable();
       $selectInput =array();
       $taxonomyData = array();
       $where =array();
       $selectInput['id'] =$this->ci->Taxonomy_model->id;
       $selectInput['name'] =$this->ci->Taxonomy_model->name;
       if(!empty($id)){
           $where[$this->ci->Taxonomy_model->id] = $id;  
           $this->ci->Taxonomy_model->setWhere($where);
       }
       $this->ci->Taxonomy_model->setSelect($selectInput);
       $taxonomyData = $this->ci->Taxonomy_model->get();
       return $taxonomyData;
    }
}