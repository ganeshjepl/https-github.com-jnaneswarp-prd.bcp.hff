<?php

// mandrial smtp settings 
$config['aws-ses']['protocol'] = 'smtp';
$config['aws-ses']['smtp_host'] = 'email-smtp.us-east-1.amazonaws.com';
$config['aws-ses']['smtp_port'] = '587';
$config['aws-ses']['smtp_timeout'] = '15';
$config['aws-ses']['smtp_crypto'] = 'tls';
//MND PROD DETAILS
$config['aws-ses']['smtp_user']='AKIAISXF6KX3F7THBCDA';
$config['aws-ses']['smtp_pass'] ='ApdWEVLG0Zpc3csqTy/XkAzwJgUDHpgR0MdWMbKfJ9Wx';
$config['aws-ses']['charset'] = 'utf-8';
$config['aws-ses']['newline'] = "\r\n";
$config['aws-ses']['crlf'] = "\r\n";
$config['aws-ses']['mailtype'] = 'html'; // or html
$config['aws-ses']['validation'] = TRUE; // bool whether to validate email or not 
?>

