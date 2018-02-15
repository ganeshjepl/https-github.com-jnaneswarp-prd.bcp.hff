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


$(document).ready(function(event){
    
    $('#gender').val(gender);
    $('#education').val(education);
    $('#dob').val(dob);
    $('#countryid').val(country);
    $('#stateid').val(state);
    $('#cityid').val(city);
    
   
    
   $("#firstName").focusout(function(){
    		if($(this).val()===''){
        		$(this).addClass('docred');
        		$("#error_fname").text("Please Enter First Name!");
        	}
        	else{
                            $(this).removeClass('docred');
                            $("#error_fname").text("");
        	}
       });
       
       $("#lastName").focusout(function(){
    		if($(this).val()===''){
        		$(this).addClass('docred');
        		$("#error_lname").text("Please Enter Last Name!");
        	}
        	else{
                            $(this).removeClass('docred');
                            $("#error_lname").text("");
        	}
       });
//       $("#Profession").focusout(function(){
//    		if($(this).val()===''){
//        		$(this).addClass('docred');
//        		$("#error_Profession").text("Please Enter Profession!");
//        	}
//        	else{
//                            $(this).removeClass('docred');
//                            $("#error_Profession").text("");
//        	}
//       });
       
       $("#landline").focusout(function(){
    		if($(this).val()===''){
        		$(this).addClass('docred');
        		$("#error_landline").text("Please Enter Contact Number!");
        	}
        	else{
                            $(this).removeClass('docred');
                            $("#error_landline").text("");
        	}
       });
       
       $("#email").focusout(function(){
    		if($(this).val()===''){
        		$(this).addClass('docred');
        		$("#error_email").text("Please Enter Contact Number!");
        	}
        	else{
                            $(this).removeClass('docred');
                            $("#error_email").text("");
        	}
       });
       
       $("#dob").focusout(function(){
    		if($(this).val()===''){
        		$(this).addClass('docred');
        		$("#error_dob").text("Please Select Date of Birth!");
        	}
        	else{
                            $(this).removeClass('docred');
                            $("#error_dob").text("");
        	}
       });
       
       $("#gender").focusout(function(){
    		if($(this).val()===''){
        		$(this).addClass('docred');
        		$("#error_gender").text("Please Select Gender!");
        	}
        	else{
                            $(this).removeClass('docred');
                            $("#error_gender").text("");
        	}
       });
       
       $('#imageUpload').change(function () {
            if ($("#imageUpload").val() !== '')
                   {
                       var ext = $('#imageUpload').val().split('.').pop().toLowerCase();
                       if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                           $("#profileimgerr").text("Invalid,Should be an Image!");
                          // valid = false;
                       }
                       else{
                           $("#imageUpload").removeClass('adminred');
                           $('#profileimgerr').text("");
                       }

                   }


       });
       $('#signimageUpload').change(function () {
            if ($("#signimageUpload").val() !== '')
                   {
                       var ext = $('#signimageUpload').val().split('.').pop().toLowerCase();
                       if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                           $("#signimgerr").text("Invalid,Should be an Image!");
                           //valid = false;
                       }
                       else{
                           $("#signimageUpload").removeClass('adminred');
                           $('#signimgerr').text("");
                       }

                   }


       }); 
       
       
       
       $('#doctorEdit').submit(function(event){
           event.preventDefault();
           var valid=true;
           var reg_letters = /^[a-zA-Z\s]+$/;
           var reg_email =/^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/;
           var reg_mobile = /^(([0|\+[0-9]{1,5})?([7-9][0-9]{9})|(\d{3}-)*\d{8})$/;
           if($('#firstName').val()===''){
               $('#firstName').addClass('docred');
               $("#error_fname").text("Please Enter First name!");
               valid=false;
           }
           else if(!$('#firstName').val().match(reg_letters)){
               $('#firstName').addClass('docred');
               $("#error_fname").text("Please Enter Alphabets only!");
               valid=false;
           }
           else{
               $('#firstName').removeClass('docred');
               $("#error_fname").text("");
           }
           
           if($('#lastName').val()===''){
               $('#lastName').addClass('docred');
               $("#error_lname").text("Please Enter Last name!");
               valid=false;
           }
           else if(!$('#lastName').val().match(reg_letters)){
               $('#lastName').addClass('docred');
               $("#error_lname").text("Please Enter Alphabets only!");
               valid=false;
           }
           else{
               $('#lastName').removeClass('docred');
               $("#error_lname").text("");
           }
           
//           if($('#Profession').val()===''){
//               $(this).addClass('docred');
//               $("#error_Profession").text("Please Enter Profession!");
//               valid=false;
//           }
//           else if(!$('#Profession').val().match(reg_letters)){
//               $('#Profession').addClass('docred');
//               $("#error_Profession").text("Please Enter Alphabets only!");
//               valid=false;
//           }
//           else{
//               $('#Profession').removeClass('docred');
//               $("#error_Profession").text("");
//           }
           
           if($('#landline').val()===''){
               $('#landline').addClass('docred');
               $("#error_landline").text("Please Enter Contact!");
               valid=false;
           }
           else if(!$('#landline').val().match(reg_mobile)){
               $('#landline').addClass('docred');
               $("#error_landline").text("Please Enter Valid Contact!");
               valid=false;
           }
           else{
               $('#landline').removeClass('docred');
               $("#error_landline").text("");
           }
           
           if($('#email').val()===''){
               $('#email').addClass('docred');
               $("#error_email").text("Please Enter Email Address!");
               valid=false;
           }
           else if(!$('#email').val().match(reg_email)){
               $('#email').addClass('docred');
               $("#error_email").text("Please Enter Valid Email!");
               valid=false;
           }
           else{
               $('#email').removeClass('docred');
               $("#error_email").text("");
           }
           
           if($('#gender').val()===''){
               $('#gender').addClass('docred');
               $("#error_gender").text("Please Select Gender!");
               valid=false;
           }
           else{
               $('#gender').removeClass('docred');
               $("#error_gender").text("");
           }
           
            $('#imageUpload').change(function () {
            if ($("#imageUpload").val() !== '')
                   {
                       var ext = $('#imageUpload').val().split('.').pop().toLowerCase();
                       if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                           $("#profileimgerr").text("Invalid,Should be an Image!");
                           valid = false;
                       }
                       else{
                           $("#imageUpload").removeClass('adminred');
                           $('#profileimgerr').text("");
                       }

                   }


       });
       $('#signimageUpload').change(function () {
            if ($("#signimageUpload").val() !== '')
                   {
                       var ext = $('#signimageUpload').val().split('.').pop().toLowerCase();
                       if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                           $("#signimgerr").text("Invalid,Should be an Image!");
                           valid = false;
                       }
                       else{
                           $("#signimageUpload").removeClass('adminred');
                           $('#signimgerr').text("");
                       }

                   }


       }); 
           
           
           if(valid===true){
           
           var val = $('#countryid').val();
            var countryid = $('#country_sugg option').filter(function () {
            return this.value === val;
             }).data('id');
             
             if(countryid===undefined){
                 countryid=country_id;
             }
              
             
             
            var val = $('#stateid').val();
            var stateid = $('#state_sugg option').filter(function () {
            return this.value === val;
            }).data('id');
            
             if(stateid===undefined){
                 stateid=state_id;
             }
            
              
            var val = $('#cityid').val();
            var cityid = $('#city_sugg option').filter(function () {
            return this.value === val;
            }).data('id');
            
            if(cityid===undefined){
                 cityid=city_id;
             }
               
              var formdata=new FormData();
           
            formdata.append('firstName',$('#firstName').val()),
            formdata.append('lastName',$('#lastName').val()),
            formdata.append('email',$('#email').val()),
            formdata.append('countryid',countryid),
            formdata.append('stateid',stateid),
            formdata.append('cityid',cityid), 
            formdata.append('dob',$('#dob').val()),
            formdata.append('education',$('#education').val()),
            formdata.append('gender',$('#gender').val()),
            formdata.append('mobile',$('#landline').val()),            
            formdata.append('alternatecontact',$('#mobile').val()),
            formdata.append('profilePicture', $('#imageUpload')[0].files[0]),
            formdata.append('signaturePicture',$("#signimageUpload")[0].files[0]),
            formdata.append('role',$('#Profession').val());
               
               $.ajax({  
                type: "POST",  
                url:site_url+'api/web/v1/Doctor/updateDocProfile',
                contentType: false,
                data: formdata,
                processData: false,
                success: function(response){
                    var json=JSON.stringify(response)
                    var res = JSON.parse(json);
                    if(res['status']){
                         $('#success_msg').html(res['response']['messages'] ).fadeOut(5000);
                         load();
                         window.location=doctorProfile;
                    } 
                    else{
                       $('#error_fname').html(res['error']['firstName'] );
                       $('#error_lname').html(res['error']['lastName'] );
                       $('#error_email').html(res['error']['email'] );
                       $('#error_gender').html(res['error']['gender']);
                       $('#error_landline').html(res['error']['mobile']);
                    }
                    
                }
                
               });
               
               
           }
           
       });
      
});

var app = angular.module('Doctor', []);
app.controller('country', function ($scope, $http) {
     $scope.countries = [300];
     $scope.countrysearch= function(){
         var len=$('#countryid').val();
        if(len.length>=2)
           
            search();
    };
      function search() {
          var country=$('#countryid').val();
        $scope.RandomValue = country;
        $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

        $http({
            method: "post",
            url: site_url + 'api/web/v1/Country/searchCountry',
            data: $.param({
            name: $scope.RandomValue
           }),
           headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           
        }).then(function (response, status) {
            //  alert(response)

            $scope.country = JSON.stringify(response.data);
            var array = JSON.parse($scope.country);
            var len = Object.keys(array.response.countryData).length;
            var i = 0;
            $scope.countries.length = 0;
            while (i < len) {

                $scope.countries.push(array.response.countryData[i]);
                i++;

            }
        }, function myError(response) {
            $scope.err = response.statusText;

        });
        

    };
    
});

app.controller('state', function ($scope, $http) {
    $scope.statesearch= function(){
         var len=$('#stateid').val();
        if(len.length>=2)
           
            searchstate();
    };
    function searchstate() {
        // var countryid = angular.element('#country').val();
        // alert($("#country_sugg option").attr('data-id'));
        var state=$('stateid').val();
        $scope.RandomValue = state;
        var val = $('#countryid').val();

        var countryid = $('#country_sugg option').filter(function () {
            return this.value === val;
        }).data('id');
        
        //alert(countryid)
        if(countryid===undefined){
            countryid=country_id;
        }
        
       
        $scope.states = [100];
           $http({
            method: "post",
            url: site_url + 'api/web/v1/State/statesByCountry',
            data: $.param({
            name: $scope.RandomValue,
            id:countryid
           }),
           headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           
        }).then(function (response, status) {
            var state_res = response.data;
            var len = Object.keys(state_res.response.stateData).length;
           
            var i = 0;
            while (i <= len) {
                
                $scope.states.push(state_res.response.stateData[i]);

                i++;
        

            }
             

        }, function myError(response) {
            $scope.err = response.statusText;

        });
     
    };
});
app.controller('city', function ($scope, $http) {
   $scope.citysearch= function(){
         var len=$('#cityid').val();
        if(len.length>=2)
           
            searchcity();
    }; 
     function searchcity() {
       
        var city=$('#cityid').val();
        var val = $('#stateid').val();
        var stateid = $('#state_sugg option').filter(function () {
            return this.value === val;
        }).data('id');
        
         if(stateid===undefined){
            stateid=state_id;
        }
        $scope.RandomValue = city;
        
        $scope.cities = [];
         $http({
            method: "post",
            url: site_url + 'api/web/v1/City/citiesByState',
            data: $.param({
            name: $scope.RandomValue,
            id:stateid
           }),
           headers: {'Content-Type': 'application/x-www-form-urlencoded'}
         }).then(function (response) {
              
            var city_res = response.data;
            
            var len = Object.keys(city_res.response.cityData).length;
            var i = 0;
            while (i <= len) {
                 
                $scope.cities.push(city_res.response.cityData[i]);
                
                i++;
            }
 
        }, function myError(response) {
            $scope.err = response.statusText;


        });


    };
});
