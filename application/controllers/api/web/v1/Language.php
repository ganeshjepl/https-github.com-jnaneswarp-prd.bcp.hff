<?php

/* language entity related logic defination
 * @package		CodeIgniter
 * @author		Atumit Development Team
 * @copyright	        Copyright (c) 2017, Atumit.
 * @Version		Version 1.0
 * @Created             21-04-2017
 * @Last Modified       21-04-2017
 * @Last Modified By    shivajyothi
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH . 'handlers/Language_handler.php');

class Language extends CI_Controller {

    var $languageHandler;

    public function __construct() {
        parent::__construct();
        $this->languageHandler = new Language_handler();
    }

    public function searchLanguage() {
        $this->ci = & get_instance();
        $inputData = array('name' => $this->input->post('name'));
        $this->ci->form_validation->set_data($inputData);
        $this->ci->form_validation->set_rules($this->config->item('searchCountryRules'));
                    
        if ($this->ci->form_validation->run() == FALSE) {
            $error['messages'] = $this->ci->form_validation->error_array();
            $error['status'] = 1;
            echo json_encode($error); exit;
        }
        $responseArray = $this->languageHandler->searchLanguage($inputData['name']);
        echo json_encode($responseArray);
    }

}

?>
