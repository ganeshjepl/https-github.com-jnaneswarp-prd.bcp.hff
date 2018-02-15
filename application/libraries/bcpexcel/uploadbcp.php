<?php
include 'excel_reader.php';     // include the class

// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;
$excel->read('BCP_Master_List.xls');

mysql_connect("192.168.1.240", "hffwrite","@appUser");
$sel = mysql_select_db("healingfields");


function sheetData($sheet) {
  $re = '<table>';     // starts html table
	
  //print_r($sheet['cells'][3]); echo "<br><br>";
	  
  $x = 2;
  while($x <= $sheet['numRows']) {
    //$re .= "<tr>\n";
    $y = 1;
	
	$batch_start_date = trim($sheet['cells'][$x][2]);
	  
	$full_name = trim($sheet['cells'][$x][3]);	  
	$guardian_name = trim($sheet['cells'][$x][4]);
	$branch = trim($sheet['cells'][$x][5]);
	$village = trim($sheet['cells'][$x][6]);
	$block = trim($sheet['cells'][$x][7]);
	$district = trim($sheet['cells'][$x][8]);
	$state = trim($sheet['cells'][$x][9]);
		  
	$mobile = trim($sheet['cells'][$x][10]);
	$alternative_mobile = trim($sheet['cells'][$x][11]);
	  
	$age = trim($sheet['cells'][$x][12]);
	$gender = trim($sheet['cells'][$x][13]);
	$marital_status = trim($sheet['cells'][$x][14]);
	$child_0_to_6 = trim($sheet['cells'][$x][15]);
	$child_7_to_14 = trim($sheet['cells'][$x][16]);
	$child_above_14 = trim($sheet['cells'][$x][17]);
	$child_care_by = trim($sheet['cells'][$x][18]);	  
	$bpl_status = trim($sheet['cells'][$x][19]);
	$caste = trim($sheet['cells'][$x][20]);
	$religion = trim($sheet['cells'][$x][21]);
	$highest_qualification = trim($sheet['cells'][$x][22]);
	$institution_name = trim($sheet['cells'][$x][23]);
	$instruction_language = trim($sheet['cells'][$x][24]);
	$passed_year = trim($sheet['cells'][$x][25]);
	$languages_known = trim($sheet['cells'][$x][26]);
	  
	$current_occupation = trim($sheet['cells'][$x][27]);
	$seasonal_occupation = trim($sheet['cells'][$x][28]);
	$health_work_experience = trim($sheet['cells'][$x][29]);
	$work_nature = trim($sheet['cells'][$x][30]);
	  
	$family_monthly_income = trim($sheet['cells'][$x][31]);
	$user_monthly_income = trim($sheet['cells'][$x][32]);
	$shg_member = trim($sheet['cells'][$x][33]);
	$hours_available = trim($sheet['cells'][$x][34]);
	$no_of_households = trim($sheet['cells'][$x][35]);
	$introducer_name = trim($sheet['cells'][$x][36]);
	$designation = trim($sheet['cells'][$x][37]);
	$reason_refer = trim($sheet['cells'][$x][38]);
	$id_proof = trim($sheet['cells'][$x][40]);
	$address_proof = trim($sheet['cells'][$x][41]);
	$bank_account_status = trim($sheet['cells'][$x][42]);  
	
	$co_ordinator_name = trim($sheet['cells'][$x][43]);
	$co_ordinator_mobile = trim($sheet['cells'][$x][44]); 
	  
	$active = trim($sheet['cells'][$x][45]);  
	  
	$aadhar_ino = trim($sheet['cells'][$x][46]);
	$apl_bpl = trim($sheet['cells'][$x][47]);
	$voter_no = trim($sheet['cells'][$x][48]);
	  	  
	$account_no = trim($sheet['cells'][$x][49]);
	$account_name = trim($sheet['cells'][$x][50]);
	$bank_name = trim($sheet['cells'][$x][51]);
	$bank_address = trim($sheet['cells'][$x][52]);
	$ifsc_code = trim($sheet['cells'][$x][53]);
	  
	
	$batch_start_date =  date ("Y-m-d", strtotime($batch_start_date));

	 
	if(strtolower($gender) == 'f' || strtolower($gender) == 'Female'){  
		$gender = "female";
	}else{
		$gender = "male";
	}
	if(strtolower($marital_status) == 'yes'){  
		$marital_status = "married";
	}else{
		$marital_status = "single"; 
	}	
	if(strtolower($bpl_status) == 'yes'){  
		$bpl_status = 1;
	}else{
		$bpl_status = 0;
	}	
	 
	if($highest_qualification !=""){  
		if(strtolower(substr($highest_qualification, 0, 1)) == 'b'){  
			$highest_qualification = "graduation";
		}else if(strtolower(substr($highest_qualification, 0, 1)) == 'm'){  
			$highest_qualification = "post-graduation";
		}else{
			$highest_qualification = "high-school";
		}	  
	}else{
		$highest_qualification = "no-education";
	}	
	
	if(strtolower($user_monthly_income) == 'no' || strtolower($user_monthly_income) == ''){  
		$user_monthly_income = "";
	}  
	if(strtolower($shg_member) == 'yes'){  
		$shg_member = 1;
	}else{
		$shg_member = 0;
	} 
	
	if(strtolower($user_monthly_income) == 'no' || strtolower($user_monthly_income) == ''){  
		$user_monthly_income = "";
	} 
	  
	if(strtolower($id_proof) == 'yes'){  
		$id_proof = 1;
	}else{
		$id_proof = 0;
	}  
	  
	if(strtolower($address_proof) == 'yes'){  
		$address_proof = 1;
	}else{
		$address_proof = 0;
	}  
	  
	if(strtolower($bank_account_status) == 'yes'){  
		$bank_account_status = 1;
	}else{
		$bank_account_status = 0;
	} 
	
        if($child_0_to_6 ==''){
          $child_0_to_6=0 ;
        }
	if($child_7_to_14 ==''){
	 $child_7_to_14=0 ;
	 }
	if($child_above_14 ==''){
	 $child_above_14=0 ;
	 }
	 
	$cData = mysql_query("select * from co_ordinators where name='$co_ordinator_name' and mobile='$co_ordinator_mobile'");  
	$cRowCount = mysql_num_rows($cData);
	if($cRowCount>0){
		$cResult = mysql_fetch_row($cData);
		$co_ordinator_id = $cResult[0];
	}else{
		mysql_query("insert into co_ordinators(`name`, `mobile`) values('$co_ordinator_name', '$co_ordinator_mobile')") or die(mysql_error());
		$co_ordinator_id = mysql_insert_id();
	}
	  
	 
		
	$username = strtolower(trim($full_name));
        //$username = str_replace  (",", "", $username);
        $new_username = preg_replace ('/[^\p{L}\p{N}]/u', '', $username); 
	//$password = "f9527d25bf8a6da52ec9cf0355ae18ad3bee444f";
        $password = sha1('bcp@hff');
	$signupdate = date ("Y-m-d H:i:s");
        /*---------- get state id ------------*/
            $country_id =101 ; 
            $stateData = mysql_query("SELECT id FROM  state where name='$state'");  
            $stateCount = mysql_num_rows($stateData);
            if($stateCount>0){
                $stateResult = mysql_fetch_row($stateData);
                $stateid = $stateResult[0];
            }else{
                $stateid = 0;
            }
        if($mobile!=""){ $mobile = '+91'.$mobile ; }
        if($alternative_mobile!=''){ $alternative_mobile =  '+91'.$alternative_mobile ; }
	if($full_name !=""){	 
           	//$uniqueData = mysql_query("SELECT id FROM  user where mobile='$mobile'");  
                //$uniqueCount = mysql_num_rows($uniqueData);
                $rand = rand(1,9999); 
                $new_username =$new_username.'@'.$rand;
               // if($uniqueCount==0){
                  //echo  "insert into user(username, password, first_name, countryid , stateid, mobile, alternate_contact_number, signupdate, profile_picture) 
							//values('$new_username', '$password', '$full_name','$country_id', '$stateid', '$mobile', '$alternative_mobile', '$signupdate', '$profile_picture')";
		mysql_query("insert into user(username, password, first_name, countryid , stateid, mobile, alternate_contact_number, signupdate, profile_picture) 
							values('$new_username', '$password', '$full_name','$country_id', '$stateid', '$mobile', '$alternative_mobile', '$signupdate', '$profile_picture')") or die(mysql_error());
		$user_id = mysql_insert_id();
                $language =explode(",",$languages_known)  ; 
                for($i=0;$i<=count($language);$i++){ 
                   if($language[$i]!=''){ 
                   mysql_query("INSERT INTO `healingfields`.`user_languages` (`user_id`, `language`, `read`, `speak`, `write`)VALUES ($user_id, '$language[$i]', 1,1,1)") or die(mysql_error());
                  }
                }
						
            $usrl_query   =  "insert into user_role(user_id, role)values($user_id, 'bcp')";	  
	                     mysql_query($usrl_query) or die(mysql_error());
	    $usrdtl_query =  "insert into user_details(user_id, batch_start_date,   guardian_name, branch, village, block, district,  gender, marital_status, caste, child_0_to_6, child_7_to_14, child_above_14, child_care_by, bpl_status, religion, highest_qualification, institution_name, instruction_language, passed_year, family_monthly_income, user_monthly_income, shg_member, hours_available, no_of_households, introducer_name, designation, reason_refer, co_ordinator_id, apl_bpl, bank_account_status  )
			     values($user_id, '$batch_start_date',   '$guardian_name', '$branch', '$village', '$block', '$district',   '$gender', '$marital_status', '$caste', $child_0_to_6, $child_7_to_14, $child_above_14, '$child_care_by', $bpl_status, '$religion', '$highest_qualification', '$institution_name', '$instruction_language', '$passed_year', '$family_monthly_income', '$user_monthly_income', $shg_member, '$hours_available', '$no_of_households', '$introducer_name', '$designation', '$reason_refer', $co_ordinator_id, '$apl_bpl', $bank_account_status)";  
			     mysql_query($usrdtl_query) or die(mysql_error());
	    $usrbank_query = "insert into user_bank_details(user_id, account_no, account_name, bank_name, bank_address, ifsc_code) 
						values($user_id,'$account_no', '$account_name', '$bank_name', '$bank_address', '$ifsc_code')";
	 
	            mysql_query($usrbank_query) or die(mysql_error());
	  
	 if($aadhar_ino!=''){	
	  $usridprf_query1 = "insert into user_idproofs(user_id, idproof_type, idproof_number) values($user_id,'Aadhar', '$aadhar_ino')";
	  mysql_query($usridprf_query1) or die(mysql_error());
         }
         if($apl_bpl!=''){	
	  $usridprf_query2 = "insert into user_idproofs(user_id, idproof_type, idproof_number) values($user_id,'APL/BPL', '$apl_bpl')";
	  mysql_query($usridprf_query2) or die(mysql_error());
         }
         if($ration_no!=''){	
	  $usridprf_query3 = "insert into user_idproofs(user_id, idproof_type, idproof_number) values($user_id,'Ration', '$ration_no')";
	  mysql_query($usridprf_query3) or die(mysql_error());
         }
	
	$occ_type = 0;
	$work_exp = 0;
	$work_exp = 0;
	if(strtolower($seasonal_occupation) != 'no'){
		$occ_type = 1;
	}
	if(strtolower($health_work_experience) != 'no'){
		$work_exp = 1;
	}
	  
	if(strtolower($work_nature) == 'no'){
		$work_nature = "";
	}
	  
	   $usrempmt_query = "insert into user_employment(user_id, occupation, type, health_related_work_experience, work_nature) 
								values($user_id, '$current_occupation', $occ_type, $work_exp, '$work_nature')";
			 
            mysql_query($usrempmt_query) or die(mysql_error());
	 
	
	  
   
    }
     $x++;
    }
    
  // }
  

  //return $re .'</table>';     // ends and returns the html table
}

$nr_sheets = count($excel->sheets);       // gets the number of sheets
$excel_data = '';              // to store the the html tables with data of each sheet

// traverses the number of sheets and sets html table with each sheet data in $excel_data
for($i=0; $i<$nr_sheets; $i++) {
  //$excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>';  
  $excel_data .= sheetData($excel->sheets[$i]) .'<br/>';  
}
/* ?>

<style type="text/css">
table {
 border-collapse: collapse;
}        
td {
 border: 1px solid black;
 padding: 0 0.5em;
}        
</style>
<?php
// displays tables with excel file data
echo $excel_data;
*/?>    





