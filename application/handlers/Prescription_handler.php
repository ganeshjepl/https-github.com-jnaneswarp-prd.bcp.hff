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

class Prescription_handler extends Handler {

    var $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = parent::$CI;
        $this->ci->load->model('Prescription_model');
    }

    public function medicineInPrecicription($medicineId) {
        $this->ci->Prescription_model->resetVariable();
        $selectInput = array();
        $stateData = array();
        $where = array();
        $selectInput['id'] = $this->ci->Prescription_model->id;
        $this->ci->Prescription_model->setSelect($selectInput);

        $where = array($this->ci->Prescription_model->deleted => 0, $this->ci->Prescription_model->status => 1);
        $this->ci->Prescription_model->setWhere($where);
        $medicineList = $this->ci->Prescription_model->get();
        return $medicineList;
    }
}

?>
