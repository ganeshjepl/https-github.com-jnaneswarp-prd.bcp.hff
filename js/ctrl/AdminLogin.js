
 function load() {
    	$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#fff', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            'z-index':9999,
            color: '#000' 
        } }); 
 
      //  setTimeout($.unblockUI, 5000); 
	}     
$(document).ready(function(){
    var reg_letters = /^[a-zA-Z]+$/;
    
 $("input[name='username']").focusout(function(){
	    if($(this).val()===''){
		        $("#usernamebar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			 $("#error_username").text("Please Enter UserName");
	    }
	    else
	    {
		$("#usernamebar").css("background-color", "#2eb82e");
		$('#submit').attr('disabled',false);
		$("#error_username").text("");

	    }
        });

        $("input[name='password']").focusout(function(){
	    if($(this).val()===''){
		$("#passwordbar").css("background-color", "#FF0000");
			$('#submit').attr('disabled',true);
			$("#error_password").text("Please Enter Password");
	    }
	    else
	    {
		$("#passwordbar").css("background-color","#2eb82e");
		$('#submit').attr('disabled',false);
		$("#error_password").text("");

	    }
	});
        
        
        $('#loginsubmit').submit(function(event){
            
             $("#login_sucess").html('');
             $("#login_error").html('');
            event.preventDefault();
            var valid=true;
            
            if($("input[name='username']").val()===''){
                
                $("#usernamebar").css("background-color", "#FF0000");
                $('#submit').attr('disabled',true);
                $("#error_username").text("Please Enter UserName");
                $(this).keypress(function(){
                 $("#usernamebar").css("background-color", "#2eb82e");   
                });
                valid=false;
            }
            else if(!$("input[name='username']").val().match(reg_letters)){
                
                $("#usernamebar").css("background-color", "#FF0000");
                $('#submit').attr('disabled',true);
                $("#error_username").text("Please Enter Alphabets Only");
                $(this).keypress(function(){
                 $("#usernamebar").css("background-color", "#2eb82e");   
                });
                valid=false;
            }
            else{
                
		$("#usernamebar").css("background-color", "#2eb82e");
		$('#submit').attr('disabled',false);
		$("#error_username").text("");
            }
            
            if($("input[name='password']").val()===''){
                
                
                $("#passwordbar").css("background-color", "#FF0000");
                $('#submit').attr('disabled',true);
		$("#error_password").text("Please Enter Password");
                $(this).keypress(function(){
                 $("#passwordbar").css("background-color", "#2eb82e");   
                });
                valid=false; 
            }
            else
	    {
		$("#passwordbar").css({"background-color":"#2eb82e"});
		$('#submit').attr('disabled',false);
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
            Adminlogin.userrole = "admin";

        //var details = JSON.stringify(Adminlogin);
            
            if(valid===true){
                $.ajax({
                    url: site_url + 'api/web/v1/ctrl/Index/validateUserLogin',
                    type: 'POST',
                    beforeSend: function() { 
                         
                        $('#submit').attr('disabled',true);
                         load();
                      },
                    contentType: false,
                    data: formData,
                    processData: false,
                    accept: {
                    javascript: 'application/javascript'
                    },
                    success:function(json){
                         setTimeout($.unblockUI, 0001);  
                         $('#submit').attr('disabled',false); 
                        if(json['status']==1||json['status']=='TRUE'){
                            window.location.href = Dashboard;
                            $("#login_sucess").html(json['response']['messages']).delay(2500).fadeOut('3000',function(){
                               
                                
                            })
                           
                        }else{
                             $("#login_error").html(json['response']['messages'])
                        }
                       
                    },
                    error:function(xhr){
                        setTimeout($.unblockUI, 0001);  
                        var json=JSON.parse(xhr.responseText);
                        $("#login_error").html(json['response']['messages'])
                    }
                });
                
            }
        });
       
});
