$(document).ready(function(){
		$flag=1;
		
		//Login Page 
		//Username
        $("input[name='username']").focusout(function(){
	    if($(this).val()===''){
		$("#usernamebar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			 $("#error_username").text("* You have to enter UserName!");
	    }
	    else
	    {
		$(this).css("border-color", "#2eb82e");
		$('#submit').attr('disabled',false);
		$("#error_username").text("");

	    }
        });

        $("input[name='password']").focusout(function(){
	    if($(this).val()===''){
		$("#passwordbar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			$("#error_password").text("* You have to enter Password!");
	    }
	    else
	    {
		$(this).css({"border-color":"#2eb82e"});
		$('#submit').attr('disabled',false);
		$("#error_password").text("");

	    }
	});
		
// End Login Page 

//Mobile Page & Create Password Page

//Mobile Number

$("input[name='mobile']").focusout(function(){
    $pho =$("input[name='mobile']").val();
	if($(this).val()==''){
		$("#mobilebar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			$("#error_mobile").text("* You have to enter your mobile Number!");
	}
	else if(!$.isNumeric($pho))
	{
		$("#mobilebar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			$("#error_mobile").text("* mobile Number Should Be Numeric");  
	}
	else if ($pho.length!=10)
	{   
		$("#mobilebar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			$("#error_mobile").text("* Lenght of mobile Number Should Be Ten");
	}        	
	else{
		$("#mobilebar").css({"background-color":"#2eb82e"});
		$('#submit').attr('disabled',false);
		$("#error_mobile").text("");
	}

});




$("input[name='otp']").focusout(function(){
	if($(this).val()==''){
		$("#otpbar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			$("#error_otp").text("* You have to enter OTP!");
	}
	else
	{
		$('#submit').attr('disabled',false);
		$("#error_otp").text("");

	}
	});


$("input[name='newpassword']").focusout(function(){
	if($(this).val()==''){
		$("#newpasswordbar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			$("#error_newpassword").text("* You have to enter New Password!");
	}
	else
	{
		$('#submit').attr('disabled',false);
		$("#error_newpassword").text("");

	}
	});

$("input[name='confirmpassword']").focusout(function(){
	if($(this).val()==''){
		$("#confirmpasswordbar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			$("#error_confirmpassword").text("* You have to re-enter Password!");
	}
	else
	{
		$('#submit').attr('disabled',false);
		$("#error_confirmpassword").text("");

	}
	});

//End OTP Page 

	// doctor edit page validation	
		//Name
    	$("#myName").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			 $("#error_name").text("* You have to enter Name!");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_name").text("");

        	}
       });
    	
    	//Profession
        $("#Profession").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_Profession").text("* You have to enter your Profession!");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_lastname").text("");
        	}
       });
        
        //Landline Number
        $("#landline").focusout(function(){
            $pho =$("#landline").val();
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_landline").text("* You have to enter your Landline Number!");
        	}
    		else if(!$.isNumeric($pho))
        	{
        	        $(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_landline").text("* Landline Number Should Be Numeric");  
        	}
        	else if ($pho.length!=9)
        	{   
                    $(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_landline").text("* Lenght of Landline Number Should Be Nine");
        	}        	
        	else{
        		$(this).css({"border-color":"#2eb82e"});
        		$('#submit').attr('disabled',false);
        		$("#error_landline").text("");
        	}

    	});
        
        //Mobile Number
        
        $("#mobile").focusout(function(){
            $pho =$("#mobile").val();
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_mobile").text("* You have to enter your mobile Number!");
        	}
    		else if(!$.isNumeric($pho))
        	{
        	        $(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_mobile").text("* mobile Number Should Be Numeric");  
        	}
        	else if ($pho.length!=10)
        	{   
                    $(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_mobile").text("* Lenght of mobile Number Should Be Ten");
        	}        	
        	else{
        		$(this).css({"border-color":"#2eb82e"});
        		$('#submit').attr('disabled',false);
        		$("#error_mobile").text("");
        	}

    	});
        
        
      //Email
        
        
      //Address1
        $("#address1").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_address1").text("* You have to enter address & City");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_address1").text("");
        	}
       }); 
        
      //Address2
        $("#address2").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_address2").text("* You have to enter Country");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_address2").text("");
        	}
       }); 
        
        //D.O.B
        
        $("#dob").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_dob").text("* You have to enter Date of Birth!");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_dob").text("");
        	}
       });
        
        
        //Gender
        $("#gender").focusout(function(){
        	if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_gender").text("* Select The Gender");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_gender").text("");
        	}
       
       });
        
        //Education
        $("#education").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_education").text("* You have to enter Qualification");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_education").text("");
        	}
       });  
        
      //Work Experience-1
        $("#work1").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_work1").text("* You have to enter Work History");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_work1").text("");
        	}
       });  
        
      //Work Experience-2
        $("#work2").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_work2").text("* You have to enter Work History");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_work2").text("");
        	}
       });  
        
      //Work Experience-3
        $("#work3").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_work3").text("* You have to enter Work History");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_work3").text("");
        	}
       });  
        
      //Work Experience-4
        $("#work4").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_work4").text("* You have to enter Work History");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_work4").text("");
        	}
       });  
        
        
        
        $("#age").focusout(function(){
        	$age =$("#age").val();
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_age").text("* You have to enter Age!");
        	}
    		else if(!$.isNumeric($age))
        	{
        	        $(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_age").text("*Please Enter Numeric");  
        	}
        	else if ($age < 1 || $age > 127)
        	{   
                    $(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_age").text("*Age within 1 & 127");
        	}    
        	else
        	{
        		$(this).css({"border-color":"#2eb82e"});
        		$('#submit').attr('disabled',false);
        		$("#error_age").text("");

        	}
        	});
        
      //End DOC Edit Page 
        
        //Patient Presctiption
        
        $("#patientname").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$("#error_patientname").text("* You have to enter Patient Name!");
        	}
        	else
        	{
        		$(this).css({"border-color":"#2eb82e"});
        		$('#submit').attr('disabled',false);
        		$("#error_patientname").text("");

        	}
        	});
        
         
           //End Patient Presctiption
        
        //Submit SMS Button Validation
        
        $( "#submitsms" ).click(function() {
        	
        	if($("#patientname" ).val()=='')
        	{
        	$("#patientname").css("border-color", "#FF0000");
        		$('#submitsms').attr('disabled',true);
        		 $("#error_patientname").text("* You have to enter Patient Name!");
        }	
        	
        	if($("#gender" ).val()=='')
   			{
        		$("#gender").css("border-color", "#FF0000");
        			$('#submitsms').attr('disabled',true);
        			 $("#error_gender").text("* You have to select Gender!");
        	}
        	
        	else
        	{
        		$('#submitsms').attr('disabled',false);
        	}
        	
        	
        	$("#age").focusout(function(){
            	$age =$("#age").val();
        		if($(this).val()==''){
            		$(this).css("border-color", "#FF0000");
            			$('#submitsms').attr('disabled',true);
            			$("#error_age").text("* You have to enter Age!");
            	}
        		else if(!$.isNumeric($age))
            	{
            	        $(this).css("border-color", "#FF0000");
            			$('#submitsms').attr('disabled',true);
            			$("#error_age").text("*Please Enter Numeric");  
            	}
            	else if ($age < 1 || $age > 127)
            	{   
                        $(this).css("border-color", "#FF0000");
            			$('#submitsms').attr('disabled',true);
            			$("#error_age").text("*Age within 1 & 127");
            	}    
            	else
            	{
            		$(this).css({"border-color":"#2eb82e"});
            		$('#submitsms').attr('disabled',false);
            		$("#error_age").text("");

            	}
            	});
        
        });
        
        
        // End Submit SMS Button Validation  
        
      // Submit Button Validations For all pages
   		$( "#submit" ).click(function() {
   			if($("#myName" ).val()=='')
   			{
        		$("#myName").css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			 $("#error_name").text("* You have to enter first name!");
        	}
        	if($("#lastname" ).val()=='')
   			{
        		$("#lastname").css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			 $("#error_lastname").text("* You have to enter Last name!");
        	}
        	
        	if($("#gender" ).val()=='')
   			{
        		$("#gender").css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			 $("#error_gender").text("* You have to select Gender!");
        	}
   			if($("#dob" ).val()=='')
   			{
        		$("#dob").css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			 $("#error_dob").text("* You have to enter your Date of Birth!");
        	}
   			if($("#age" ).val()=='')
   			{
        		$("#age").css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			 $("#error_age").text("* You have to enter Age!");
        	}
        	if($("#phone" ).val()=='')
   			{
        		$("#phone").css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			 $("#error_phone").text("* You have to enter Phone Number!");
        	}
        	
        	//lOGIN paGE
        	if($("#username" ).val()=='')
    		{
    		$("#username").css("border-color", "#FF0000");
    			$('#submit').attr('disabled',true);
    			 $("#error_username").text("* You have to enter first name!");
    	}
    	if($("#password" ).val()=='')
    		{
    		$("#password").css("border-color", "#FF0000");
    			$('#submit').attr('disabled',true);
    			 $("#error_password").text("* You have to enter Password!");
    	}
    	
    	// End Login Page
    	
    	//Otp Page
    	if($("#otp" ).val()=='')
		{
		$("#otp").css("border-color", "#FF0000");
			$('#submit').attr('disabled',true);
			 $("#error_otp").text("* You have to enter first name!");
	}
	if($("#newpassword" ).val()=='')
		{
		$("#newpassword").css("border-color", "#FF0000");
			$('#submit').attr('disabled',true);
			 $("#error_newpassword").text("* You have to enter Password!");
	}
	
	if($("#confirmpassword" ).val()=='')
	{
	$("#confirmpassword").css("border-color", "#FF0000");
		$('#submit').attr('disabled',true);
		 $("#error_confirmpassword").text("* You have to enter Password!");
}
    	// End OTP Page
	
	// Patient Prescription
	
	if($("#patientname" ).val()==='')
	{
	$("#patientname").css("border-color", "#FF0000");
		$('#submit').attr('disabled',true);
		 $("#error_patientname").text("* You have to enter Patient Name!");
}
	// End Patient Prescription
			});


    	
	});