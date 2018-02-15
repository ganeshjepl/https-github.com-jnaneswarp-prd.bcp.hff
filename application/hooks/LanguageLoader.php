<?php

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $userLang = $ci->session->userdata('code');  ///echo $userLang; exit;
        if ($userLang) {            
            $ci->lang->load('message',$userLang);
            //$ci->lang->load('form_validation',$userLang); 
        } else {
            $ci->lang->load('message', ENGLISH_CODE);
            //$ci->lang->load('form_validation', ENGLISH_CODE);
        }
        
    }
}