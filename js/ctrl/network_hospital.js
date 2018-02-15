 var country;
 var state;
 function removeError(Id) {
        $('#' + Id + '_error').html("");
    }
  function  deleteNetworkHosp(id) {

        var x = confirm("Are you sure you want to delete?");
        if (x) {
            $.ajax({
                type: "POST",
                url: site_url + "api/web/v1/ctrl/Networkhospital/deleteNetworkhospital",
                data: {"id": id},
                success: function (json) {                    
                    if (json['status'] == 0) {
                        $("#sucess_msg").show()
                        $("#sucess_msg").html(json['response']['messages']).delay(2500).fadeOut(3500, function() { }); 
                        $("#networkhosp" + id).hide();
                    } else {
                        $("#error_msg").show();
                        $("#error_msg").html(json['response']['messages']).delay(2500).fadeOut(3500, function() { }); 
                    }
                }
            });
        }
    }
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
        
 function addhospital(){
     $("#networkhospital_add")[0].reset();
     $('.error-msg-box').text('');
     $('.rmv').removeClass('adminred');
 }
     function  editNetworkHosp(id){
        $('.rmv').removeClass('adminred');
        $('#networkEditId').val(id);
        $.ajax({  
        type: "GET",  
        url:   site_url+"api/web/v1/ctrl/Networkhospital/getNetworkhospital", 
        data:  {"networkEditid":id},
        success: function(json){ 
           
         
          
             $('#name').val(json['response']['networkhospitalData'][0]['name']);
             $('#zipcode').val(json['response']['networkhospitalData'][0]['zipcode']);
             $('#country').val(json['response']['networkhospitalData'][0]['country_name']);
             $('#state').val(json['response']['networkhospitalData'][0]['state_name']);
             $('#status').val(json['response']['networkhospitalData'][0]['status']);
             $('#address').val(json['response']['networkhospitalData'][0]['address']);
             $('#type').val(json['response']['networkhospitalData'][0]['type']);
             $('#contactnumber').val(json['response']['networkhospitalData'][0]['contact_number']);
             $('#weburl').val(json['response']['networkhospitalData'][0]['website']);
             
             country=json['response']['networkhospitalData'][0]['country_id'];
             state=json['response']['networkhospitalData'][0]['state_id'];
          
               $('#lineModalLabel').html('Edit NetWork Hospital');
              $('#squarespaceModal').modal('show');
         }  
        }); 
       
    
     }
     
 
var app = angular.module('Hff', []);
app.controller('country', function ($scope, $http) {
    $scope.countries = [300];
     $scope.countrysearch= function(){
         var len=$('#country').val();
        if(len.length>=2)
           
            search();
    };
      function search() {
        $scope.RandomValue = angular.element('#country').val();
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
         var len=$('#state').val();
        if(len.length>=2)
           
            searchstate();
    };
    function searchstate() {
        // var countryid = angular.element('#country').val();
        // alert($("#country_sugg option").attr('data-id'));
        $scope.RandomValue = angular.element('#state').val();
        var val = $('#country').val();

        var countryid = $('#country_sugg option').filter(function () {
            return this.value === val;
        }).data('id');
        
        //alert(countryid)
        if(countryid===undefined){
            countryid=country;
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
 
 
 
 $(document).ready(function(){
     
  $("#name").focusout(function(){
        if($(this).val()===''){
            $(this).addClass('adminred');
            $('#name_error').text("Please Enter Hospital Name!");
        }
        else{
             $(this).removeClass('adminred');
             $('#name_error').text("");
        }
    });   
    
    $("#country").focusout(function(){
        if($(this).val()===''){
            $(this).addClass('adminred');
            $('#country_error').text("Please Select Country!");
        }
        else{
             $(this).removeClass('adminred');
             $('#country_error').text("");
        }
    });
    
    $("#state").focusout(function(){
        if($(this).val()===''){
            $(this).addClass('adminred');
            $('#state_error').text("Please Select State!");
        }
        else{
             $(this).removeClass('adminred');
             $('#state_error').text("");
        }
    });
    
/*    $("#type").focusout(function(){
        if($(this).val()===''){
            $(this).addClass('adminred');
            $('#type_error').text("Please Enter Type!");
        }
        else{
             $(this).removeClass('adminred');
             $('#type_error').text("");
        }
    });
    
     $("#contactnumber").focusout(function(){
        if($(this).val()===''){
            $(this).addClass('adminred');
            $('#contactnumber_error').text("Please Enter Contact Number!");
        }
        else{
             $(this).removeClass('adminred');
             $('#contactnumber_error').text("");
        }
    });*/
    
    $("#zipcode").focusout(function(){
        if($(this).val()===''){
            $(this).addClass('adminred');
            $('#zipcode_error').text("Please Enter Zip Code!");
        }
        else{
             $(this).removeClass('adminred');
             $('#zipcode_error').text("");
        }
    });
    
    $("#address").focusout(function(){
        if($(this).val()===''){
            $(this).addClass('adminred');
            $('#address_error').text("Please Enter Address!");
        }
        else{
             $(this).removeClass('adminred');
             $('#address_error').text("");
        }
    });
  

 $('#network_close').on('click', function(e) {
     $('#networkadd_error').html('') ;
      $('#networkadd_sucess').html('');
       $('#name_error').html("");
        $('#zipcode_error').html("");
         $('#address_error').html("");
          $('#type_error').html("");
          $('#contactnumber_error').html("");
          $('#country_error').html("");
          $('#state_error').html("");
          var statedata  ='<select   id="state" onchange="removeError(this.id)"  required="required"  value=""   >';
            
               statedata  +='</select><label for="state">Select State</label><div class="error-msg-box padd10"> <span id="state_error"></span></div>';
               
             $("#state_data").html(statedata);
      $('#lineModalLabel').html('Add NetWork Hospital');
     $('#networkhospital_add')[0].reset();
 });
$('#networkhospital_add').on('submit', function(e) {
           
        e.preventDefault();
        var flag=0; 
        var valid = true;
        var reg_letters = /^[a-zA-Z\s]+$/;
        var reg_mobile = /^(([0|\+[0-9]{1,5})?([7-9][0-9]{9})|(\d{3}-)*\d{8})$/;    
        var reg_pin = /^(?=.{1,14}$)[^-\s 0]([a-zA-Z0-9 ]+(-[a-zA-Z0-9]+)?)$/;
        var reg_url=/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
        var  name =$.trim($('#name').val()),
        zipcode =$.trim($('#zipcode').val()),
       // country =$.trim($('#country').val()),
        address =$.trim($('#address').val()),
        status =$.trim($('#status').val()),
        type =$.trim($('#type').val()), 
        contactnumber =$.trim($('#contactnumber').val()),
        weburl =$.trim($('#weburl').val());
        if(name ===''){
             $("#name").addClass('adminred');
            $('#name_error').text("Please Enter Hospital Name!");
            valid=false;
        }
        else if(!name.match(reg_letters)){
            $("#name").addClass('adminred');
            $('#name_error').text("Please Enter Alphabets only!");
            valid=false;
        }
        else{
            $("#name").removeClass('adminred');
             $('#name_error').text("");
        }
        
        if($.trim($("#country").val())===''){
             $("#country").addClass('adminred');
            $('#country_error').text("Please Select Country!");
            valid=false;
        }
        else if(!$("#country").val().match(reg_letters)){
            $("#country").addClass('adminred');
            $('#country_error').text("Please Enter Alphabets only!");
            valid=false;
        }
        else{
            $("#country").removeClass('adminred');
             $('#country_error').text("");
        }
        
        if($.trim($("#state").val())===''){
             $("#state").addClass('adminred');
            $('#state_error').text("Please Select State!");
            valid=false;
        }
        else if(!$("#state").val().match(reg_letters)){
            $("#state").addClass('adminred');
            $('#state_error').text("Please Enter Alphabets only!");
            valid=false;
        }
        else{
            $("#state").removeClass('adminred');
             $('#state_error').text("");
        }
        
        if($("#type").val()!==''){
            
        if(!$("#type").val().match(reg_letters)){
            $("#type").addClass('adminred');
            $('#type_error').text("Please Enter Alphabets only!");
            valid=false;
        }
       }
        else{
            $("#type").removeClass('adminred');
             $('#type_error').text("");
        }
        
        if(contactnumber!==''){
            if(!contactnumber.match(reg_mobile)){
            $("#contactnumber").addClass('adminred');
            $('#contactnumber_error').text("Please Enter Valid Contact Number!");
            valid=false;
        }
         else{
            $("#contactnumber").removeClass('adminred');
             $('#contactnumber_error').text("");
 
         }
        }
        
        if(weburl!==''){
            if(!$("#weburl").val().match(reg_url)){
            $("#weburl").addClass('adminred');
            $('#weburl_error').text("Please Enter Valid Web address!");
            valid=false;
        }
         else{
            $("#weburl").removeClass('adminred');
             $('#weburl_error').text("");
         }
        }
 
        
        if(zipcode===''){
             $("#zipcode").addClass('adminred');
            $('#zipcode_error').text("Please Enter Zip Code!");
            valid=false;
        }
        else if(!zipcode.match(reg_pin)){
            $("#zipcode").addClass('adminred');
            $('#zipcode_error').text("Please Enter Valid Zip Code!");
            valid=false;
        }
        else{
            $("#zipcode").removeClass('adminred');
             $('#zipcode_error').text("");
        }
        
        if(address ===''){
             $("#address").addClass('adminred');
            $('#address_error').text("Please Enter Address!");
            valid=false;
        }
        
        else{
            $("#address").removeClass('adminred');
             $('#address_error').text("");
        }
        
        
        if(valid == true){ 
        
        var  id =$('#networkEditId').val();
             
            var val = $('#country').val();
            var countryid = $('#country_sugg option').filter(function () {
            return this.value === val;
             }).data('id');
             
             if(countryid===undefined){
                 countryid=country;
             }
              
              var val = $('#state').val();
            var stateid = $('#state_sugg option').filter(function () {
            return this.value === val;
            }).data('id');
            
             if(stateid===undefined){
                 stateid=state;
             }
             
            if(id!=''){
                var ajaxurl = site_url+"api/web/v1/ctrl/Networkhospital/editNetworkhospital" ;
                
            }else{
                 var ajaxurl = site_url+"api/web/v1/ctrl/Networkhospital/addNetworkhospital" ;
                
            }
            $.ajax({  
                type: "POST",  
                url:ajaxurl,
                data:{"name":name,"zipcode":zipcode,"country":countryid,"state":stateid,"address":address,"type":type,"contactnumber":contactnumber,"weburl":weburl, "networkEditid":id,"status":status}, 
                 
                beforeSend: function() { 
                        $('#hospitalsubmit').attr('disabled',true);
                         load();
                      },
                success: function(json){
                    setTimeout($.unblockUI, 0000); 
                     $('#hospitalsubmit').attr('disabled',false);
                   
                   if( json['status']==true){
                         
                       $('#networkadd_sucess').html(json['response']['messages']).delay(2500).fadeOut('3000',function(){
                       //$('#networkhospital_add')[0].reset();   
                       // $('#squarespaceModal').modal('hide');
                      
                         window.location.reload();
                       }); 
                      
                   }else{
                       
                      
                       $('#name_error').html(json['response']['messages'][0]['name'] );
                       $('#country_error').html(json['response']['messages'][0]['country'] );
                       $('#state_error').html(json['response']['messages'][0]['state'] );
                       $('#zipcode_error').html(json['response']['messages'][0]['zipcode'] );
                       $('#address_error').html(json['response']['messages'][0]['address'] );
                       $('#type_error').html(json['response']['messages'][0]['type'] );
                       $('#contactnumber_error').html(json['response']['messages'][0]['contactnumber'] );
                       $('#networkadd_error').html(json['response']['messages']) ;
                   }
                }
               });
             return false; 
      }
       return false; 
    });
 });
