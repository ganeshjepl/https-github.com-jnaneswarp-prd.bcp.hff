<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once (APPPATH . 'handlers/Primary_assessment_handler.php');
require_once (APPPATH . 'handlers/Taxonomy_handler.php');
class PrimaryAssessment extends CI_Controller{
    var $primaryAssessmentHandler;
    public function __construct() {
        parent::__construct();
        $this->primaryAssessmentHandler = new Primary_assessment_handler();
        $this->taxonomyHandler = new Taxonomy_handler();
    }
    public function index(){
        
        $data['responseArray']= $this->primaryAssessmentHandler->getPrimaryAssessmentDetail();
        
        
        $data['taxonomyDatas'] =  $this->taxonomyHandler->getTaxonomyDetails();
        $this->load->view("PrimaryAssessment_view",$data);
       //print($responseArray['response']['primaryAssessmentData']['quesstionnaire']['questions']) ;
       
    }
    
    






    
}
?>