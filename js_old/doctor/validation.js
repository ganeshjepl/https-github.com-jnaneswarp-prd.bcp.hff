function load() {
    	$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#fff', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#000' 
        } }); 
 
//        setTimeout($.unblockUI, 5000); 
	}     
$(document).ready(function(){
    
    $flag=1;
   $("input[name='username']").focusout(function(){
    if($(this).val()==''){
            $("#usernamebar").css("background-color", "#FF0000");
                    $('#loginsubmitbutton').attr('disabled',true);
                     $("#error_username").text("Please Enter UserName");
    }
    else
    {
            $(this).css("border-color", "#2eb82e");
            $('#loginsubmitbutton').attr('disabled',false);
            $("#error_username").text("");

    }
});

$("input[name='password']").focusout(function(){
	if($(this).val()==''){
		$("#passwordbar").css("background-color", "#FF0000");
			 $('#loginsubmitbutton').attr('disabled',true);
			$("#error_password").text("Please Enter Password");
	}
	else
	{
		$(this).css({"border-color":"#2eb82e"});
		 $('#loginsubmitbutton').attr('disabled',false);
		$("#error_password").text("");

	}
	});
		
// End Login Page 
//Login Check Shiva jytohi 

var reg_letters = /^[a-zA-Z0-9@]+$/;
 $('#loginsubmit').submit(function(event){
            $('#loginsubmitbutton').attr('disabled',true);
	        $('#loginforgotpwd').attr('disabled',true);
             $("#login_sucess").html('');
             $("#login_error").html('');
            event.preventDefault();
            var valid=true;
            
            if($("input[name='username']").val()===''){
                
                $("#usernamebar").css("background-color", "#FF0000");
                $('#loginsubmitbutton').attr('disabled',true);
				$('#loginforgotpwd').attr('disabled',true);
                $("#error_username").text("Please Enter UserName");
                $(this).keypress(function(){
                 $("#usernamebar").css("background-color", "#2eb82e");   
                });
                valid=false;
            }
            else if(!$("input[name='username']").val().match(reg_letters)){
                
                $("#usernamebar").css("background-color", "#FF0000");
                $('#loginsubmitbutton').attr('disabled',true);
				$('#loginforgotpwd').attr('disabled',true);
                $("#error_username").text("Please Enter Alphabets Only");
                $(this).keypress(function(){
                 $("#usernamebar").css("background-color", "#2eb82e");   
                });
                valid=false;
            }
            else{
                
		$("#usernamebar").css("background-color", "#2eb82e");
		$('#loginsubmitbutton').attr('disabled',false);
				$('#loginforgotpwd').attr('disabled',false);
		$("#error_username").text("");
            }
            
            if($("input[name='password']").val()===''){
                
                
                $("#passwordbar").css("background-color", "#FF0000");
                $('#loginsubmitbutton').attr('disabled',true);
				$('#loginforgotpwd').attr('disabled',true);
		$("#error_password").text("Please Enter Password");
                $(this).keypress(function(){
                 $("#passwordbar").css("background-color", "#2eb82e");   
                });
                valid=false; 
            }
            else
	    {
		$("#passwordbar").css({"background-color":"#2eb82e"});
		$('#loginsubmitbutton').attr('disabled',false);
			$('#loginforgotpwd').attr('disabled',false);
		$("#error_password").text("");

	    }
            
            var username=$("input[name='username']").val();
            var password=$("input[name='password']").val();
            //console.log(username,password);
            
            var formData = new FormData();
            formData.append('username',username); 
            formData.append('password',password); 
            
            var Adminlogin = new Object();
            Adminlogin.username = username;
            Adminlogin.password = password;
            Adminlogin.userrole = "doctor";

        //var details = JSON.stringify(Adminlogin);
            
            if(valid===true){
                
                $.ajax({
                    url: site_url + 'api/web/v1/doctor/login',
                    type: 'POST',
                    beforeSend: function() { 
                        load();
                        $('#loginsubmitbutton').attr('disabled',true);
						$('#loginforgotpwd').attr('disabled',true);
                      },
                    contentType: false,
                    data: formData,
                    processData: false,
                    accept: {
                    javascript: 'application/javascript'
                    },
                    success:function(json){
                         
                        setTimeout($.unblockUI, 0001); 
                        $('#loginsubmitbutton').attr('disabled',false);
                         
						$('#loginforgotpwd').attr('disabled',false);
						
                       
                       
                        if(json['status']==1||json['status']=='TRUE'){
                            
                             $("#login_sucess").show();
                             $("#login_sucess").html(json['response']['messages']).fadeOut('5000',function(){
                                
                                window.location.href = Dashboard;
                            })
                           
                        }else{
                             $("#login_error").show();
                             $("#login_error").html(json['response']['messages'])
                        }
                       
                    },
                    error:function(xhr){
                        console.log(xhr.responseText);
                        
                    }
                });
                
            }
        });
$("input[name='mobile']").focusout(function(){
	if($(this).val()==''){
		$("#mobilebar").css("background-color", "#FF0000");
			 $('#forgotsubmitbutton').attr('disabled',true);
			$("#error_mobile").text("Please enter your mobile Number Or Username");
	}
	else
	{
           $("#mobilebar").css("background-color", "#2eb82e");
		 
		 $('#forgotsubmitbutton').attr('disabled',false);
		$("#error_mobile").text("");

	}
	});
//Mobile Page & Create Password Page
 $('#forgotsubmit').submit(function(event){
     var flag=true;
    var phno =$("#mobile").val();
	if(phno==''){
		$("#mobilebar").css("background-color", "#FF0000");
			$('#forgotsubmitbutton').attr('disabled',true);
			$("#error_mobile").text(" Please enter your mobile Number Or Username");
                   flag =false ;     
	}
	/*else if(!$.isNumeric(phno))
	{
		$("#mobilebar").css("background-color", "#FF0000");
                $('#forgotsubmitbutton').attr('disabled',true);
                $("#error_mobile").text("Mobile Number Should Be Numeric");  
                 flag =false ;
	}
	else if (phno.length!=10)
	{   
		$("#mobilebar").css("background-color", "#FF0000");
                $('#forgotsubmitbutton').attr('disabled',true);
                $("#error_mobile").text("Lenght of mobile Number Should Be Ten");
                 flag =false ;
	}       */ 	
	else{
		$("#mobilebar").css({"background-color":"#2eb82e"});
		$('#forgotsubmitbutton').attr('disabled',false);
		$("#error_mobile").text("");
	}
         
        if(flag==true){
            $.ajax({
            type: "POST",
            url: site_url + "api/web/v1/doctor/sendotp",
            data: {"mobile": phno},
            beforeSend: function() { 
                 
                        load();
                        $('#forgotsubmitbutton').attr('disabled',true);
                      },
            success: function (response) {
                  setTimeout($.unblockUI, 0001); 
              $('#forgotsubmitbutton').attr('disabled',false);
              // var res = JSON.parse(response);
              
                    if(response['status']==true){
                        $("#username").val(response['response']['data']['username']);
                        $("#otpdiv").css("display","block")
                        $("#forgotdiv").css("display","none")
                        
                    }else{
                        
                        $('#forgot_error').html(response['response']['messages'])
                        $("#forgotdiv").css("display","block")
                    }
            }
            
            
            });
            return false;
        }else{
            return false;
        }
 })
 
 



$('#formotp').submit(function(event){
    $('#otp_error').html('');
    $('#otp_sucess').html('');
     var flag =true , otp  = $('#otp').val(), newpassword = $('#newpassword').val(), confirmpassword= $('#confirmpassword').val(), username =$('#username').val();
        if(otp==''){
		$("#otpbar").css("background-color", "#FF0000");
                $('#otpsubmitbutton').attr('disabled',true);
                $("#error_otp").text("Please enter OTP");
                flag =false;
	}
	else
	{
               $("#otpbar").css("background-color", "#2eb82e");
		$('#otpsubmitbutton').attr('disabled',false);
		$("#error_otp").text("");

	}
        if(newpassword==''){
		$("#newpasswordbar").css("background-color", "#FF0000");
			$('#otpsubmitbutton').attr('disabled',true);
			$("#error_newpassword").text("Please Enter New Password!");
                        flag =false;
	}
	else
	{
                $("#newpasswordbar").css("background-color", "#2eb82e");
		$('#otpsubmitbutton').attr('disabled',false);
		$("#error_newpassword").text("");

	}
        if(confirmpassword==''){
		        $("#confirmpasswordbar").css("background-color", "#FF0000");
			$('#otpsubmitbutton').attr('disabled',true);
			$("#error_confirmpassword").text("Please Enter Confirm Password!");
                        flag =false;
	}
	else
	{
                $("#confirmpasswordbar").css("background-color", "#2eb82e");	
                $('#otpsubmitbutton').attr('disabled',false);
		$("#error_confirmpassword").text("");

	}
        
        if(newpassword!=confirmpassword){
             $('#otp_error').html('New password and confirm password mismatch');
             $("#newpasswordbar").css("background-color", "#FF0000");
             $("#confirmpasswordbar").css("background-color", "#FF0000");
               flag =false;
        }else{
            $('#otp_error').html('');
             $("#newpasswordbar").css("background-color", "#2eb82e");
             $("#confirmpasswordbar").css("background-color", "#2eb82e");
        }
         if(flag==true){
            $.ajax({
            type: "POST",
            url: site_url + "api/web/v1/doctor/otpChangepassword",
            data: {"otp": otp,"newpassword":newpassword,"confirmpassword":confirmpassword,"username":username},
            success: function (json) {
              
               //var res = JSON.parse(response);
                    if(json['status']==true){
                         
                        if(json['response']['status']==true){
                        $('#formotp')[0].reset(); 
                        $('#otp_sucess').show();
                        $('#otp_sucess').html(json['response']['response']['messages']).delay(2000).fadeOut('5000',function(){
                                
                                window.location.href = site_url+"doctorLogin";
                            })
                        
                        }else{
                            $('#otp_error').show();
                            $('#otp_error').html(json['response']['response']['messages'])
                        }
                    }else{
                          $('#otp_error').show();
                          $('#otp_error').html(json['response']['response']['messages'])
                    }
            }
            
            
            });
            return false;
        }else{
            return false;
        }
        
})

$("input[name='otp']").focusout(function(){
	if($(this).val()==''){
		$("#otpbar").css("background-color", "#FF0000");
			$('#otpsubmitbutton').attr('disabled',true);
			$("#error_otp").text("Please Enter OTP ");
	}
	else
	{
		$('#otpsubmitbutton').attr('disabled',false);
		$("#error_otp").text("");

	}
	});


$("input[name='newpassword']").focusout(function(){
	if($(this).val()==''){
		$("#newpasswordbar").css("background-color", "#FF0000");
			$('#otpsubmitbutton').attr('disabled',true);
			$("#error_newpassword").text("Please Enter New Password!");
	}
	else
	{
		$('#otpsubmitbutton').attr('disabled',false);
		$("#error_newpassword").text("");

	}
	});

$("input[name='confirmpassword']").focusout(function(){
	if($(this).val()==''){
		$("#confirmpasswordbar").css("background-color", "#FF0000");
			$('#otpsubmitbutton').attr('disabled',true);
			$("#error_confirmpassword").text("Please Enter Confirm Password!");
	}
	else
	{
		$('#otpsubmitbutton').attr('disabled',false);
		$("#error_confirmpassword").text("");

	}
	});

//End OTP Page 

});