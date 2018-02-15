<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
///echo "Hindi Data";
$lang['form_validation_required']		= '{field} फ़ील्ड की आवश्यकता है.';
$lang['form_validation_isset']			= '{field} फ़ील्ड का मान होना चाहिए.';
$lang['form_validation_valid_email']		= '{field} क्षेत्र में एक मान्य ईमेल पता होना चाहिए.';
$lang['form_validation_valid_emails']		= '{field} फ़ील्ड में सभी मान्य ईमेल पते शामिल होने चाहिए.';
$lang['form_validation_valid_url']		= '{field} फ़ील्ड में एक मान्य URL होना चाहिए.';
$lang['form_validation_valid_ip']		= '{field} फ़ील्ड में एक मान्य आईपी होना चाहिए';
$lang['form_validation_min_length']		= '{field} फ़ील्ड कम से कम {param} वर्णों की लंबाई में होना चाहिए.';
$lang['form_validation_max_length']		= '{field} फ़ील्ड लंबाई में {param} वर्णों से अधिक नहीं हो सकती.';
$lang['form_validation_exact_length']		= '{field} फ़ील्ड लम्बाई में बिल्कुल {param} वर्ण होना चाहिए.';
$lang['form_validation_alpha']			= '{field} फ़ील्ड में केवल वर्णानुक्रमिक वर्ण शामिल हो सकते हैं.';
$lang['form_validation_alpha_numeric']		= '{field} फ़ील्ड में केवल अल्फा-न्यूमेरिक वर्ण हो सकते हैं.';
$lang['form_validation_alpha_numeric_spaces']	= '{field} फ़ील्ड में केवल अल्फा-संख्यात्मक वर्ण और रिक्त स्थान हो सकते हैं.';
$lang['form_validation_alpha_dash']		= '{field} फ़ील्ड में केवल अल्फा-संख्यात्मक वर्ण, अंडरस्कोर और डैश शामिल हो सकते हैं.';
$lang['form_validation_numeric']		= '{field} फ़ील्ड में केवल संख्याएं होने चाहिए.';
$lang['form_validation_is_numeric']		= '{field} फ़ील्ड में केवल संख्यात्मक वर्ण होने चाहिए.';
$lang['form_validation_integer']		= '{field} फ़ील्ड में एक पूर्णांक होना चाहिए.';
$lang['form_validation_regex_match']		= '{field} फ़ील्ड सही प्रारूप में नहीं है.';
$lang['form_validation_matches']		= '{field} क्षेत्र {param} क्षेत्र से मेल नहीं खाता है.';
$lang['form_validation_differs']		= '{field} फ़ील्ड को {param} फ़ील्ड से भिन्न होना चाहिए.';
$lang['form_validation_is_unique'] 		= '{field} फ़ील्ड में एक अनन्य मान होना चाहिए.';
$lang['form_validation_is_natural']		= '{field} फ़ील्ड में केवल अंक शामिल होने चाहिए।';
$lang['form_validation_is_natural_no_zero']	= '{field} फ़ील्ड में केवल अंक होते हैं और शून्य से अधिक होना चाहिए.';
$lang['form_validation_decimal']		= '{field} फ़ील्ड में दशमलव संख्या शामिल होने चाहिए.';
$lang['form_validation_less_than']		= '{field} फ़ील्ड में {param} से कम संख्या होनी चाहिए.';
$lang['form_validation_less_than_equal_to']	= '{field} फ़ील्ड में {param} से कम या बराबर अंक होना चाहिए.';
$lang['form_validation_greater_than']		= '{field} फ़ील्ड में {param} से अधिक एक नंबर होना चाहिए.';
$lang['form_validation_greater_than_equal_to']	= '{field} फ़ील्ड में {param} के बराबर या उससे अधिक एक नंबर होना चाहिए.';
$lang['form_validation_error_message_not_set']	= 'आपके फ़ील्ड नाम {field} से संबंधित त्रुटि संदेश तक पहुंचने में असमर्थ.';
$lang['form_validation_in_list']		= '{field} फ़ील्ड इनमें से एक होना चाहिए: {param}.';
$lang['form_validation_numericCheck']		= '%s फ़ील्ड केवल संख्यात्मक है';
$lang['form_validation_checkDateFormat']        = '%s फ़ील्ड मान्य दिनांक नहीं है';
$lang['form_validation_checkMobilenoFormat']	= '%s फ़ील्ड मान्य मोबाइल नंबर नहीं है';
$lang['form_validation_checkZipcodeFormat']	= '%s फ़ील्ड एक मान्य पिनकोड नहीं है';
$lang['form_validation_checkAddressFormat']	= '%s फ़ील्ड एक मान्य पता प्रारूप नहीं है';



