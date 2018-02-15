/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
 
      //  setTimeout($.unblockUI, 5000); 
	} 
$(document).ready(function(){

   var valid=true;
 $('#changePassword').submit(function(event){
    event.preventDefault();
   if($('#curpass').val()===''){
       $('#error_otp').text('Please enter Current Password');
        valid=false;
   }
   else{
       $('#error_otp').text('');
   }
   
   if($('#newpass').val()===''){
       $('#error_newpassword').text('Please enter New Password');
       valid=false;
   }
   else{
       $('#error_newpassword').text('');
   }
   if($('#confpass').val()===''){
       $('#error_confirmpassword').text('Please Confirm Password');
       valid=false;
   }
   else{
       $('#error_confirmpassword').text('');
   }
   
   if($('#newpass').val()!==''){
       if(!$('#newpass').val().match($('#confpass').val())){
           $('#error_confirmpassword').text('Mismatch with New Password');
           valid=false;
       }
       else{
           valid=true;
       }
   }
  
   if(valid===true){
       console.log('true');
        var formdata= new FormData();
        formdata.append('otp',$('#curpass').val()),
        formdata.append('newpassword',$('#newpass').val()),
        formdata.append('confirmpassword',$('#confpass').val());

       $.ajax({  
                type: "POST",  
                url:site_url+'api/web/v1/Doctor/changePassword',
                contentType: false,
                data: formdata,
                processData: false,
                 beforeSend: function () {
                    $('#passwordsubmit').attr('disabled', true);
                    load();

                },
                success: function(response){
                    setTimeout($.unblockUI, 0000);
                    var json=JSON.stringify(response);
                    var res = JSON.parse(json);
                    
                    if(res['status']===true){
                        $('#success').html(res['response']['messages'] ).fadeOut(3000);
                        $('#success').css('text-align','center');
                        $('#success').css('color','green');
                        $('#error').html('');
                        $('#passwordsubmit').attr('disabled', false);
                         window.location=doctorProfile;
                    }
                    else{
                        setTimeout($.unblockUI, 0000);
                        $('#passwordsubmit').attr('disabled', false);
                        $('#error').html(res['response'] );
                        $('#error').css('text-align','center');
                    }
                    
                }
                
               });
   }



    });
    
});
