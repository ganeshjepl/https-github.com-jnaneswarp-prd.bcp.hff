var app = angular.module('Hff', []);
var country;
var state;
var city;
var language;
function deletePatient(id)
{
        
    ajaxurl = site_url + 'api/web/v1/ctrl/Patient/deletePatient';
    $.ajax({
            url: ajaxurl,
            type: 'POST',            
            data: {"patientId": id},            
            beforeSend: function () {
                $('#doctorsubmit').attr('disabled', true);
                load();
            },
            success: function (json) 
            {                       
                        //alert(json);
                        if(json['status']) 
                        {
                            window.location.href='.delinfo';
                            $(".delinfo").show().html(json["response"]["messages"]).delay(3500).fadeOut(3000);
                            window.location.reload();
                        }
            }
        });
}

function addNewPatient()
{
			$("#lineModalLabelEdit").hide();
			$("#lineModalLabel1").show();
                        $("#patientsubmit").show();
                        $("#patientedit").hide();
                        $("form").attr("id","new_patient_add");
			$("#pid").hide();
                        $(".filed_empty").val('');
                        var imgurl = imgs + "profile.jpg";                                                                                
                        $("#imageUpload").attr('src', imgurl);
			$(".error").show().html('');
}
function editPatient(id)
{		
                
		var ajaxurl = site_url + 'api/web/v1/ctrl/Patient/editPatient'; 
                $(".error").show().html('');
		//alert(ajaxurl);
                $("form").attr("id","new_patient_edit");
		$("#pid").show().val(id);
		$("#lineModalLabel1").hide();
                $("#patientsubmit").hide();
                $("#patientedit").show();
		$("#lineModalLabelEdit").show();
		$('#squarespaceModal').modal('show');
		$.ajax({
				type: "POST",
				url: ajaxurl,
				data: {"patientId": id},
				success: function (json) 
				{
                                    //alert(json); return false;
                                    if(json['status'])
                                    {								
                                            $("#dateofreg").val(json['response']['patientData']['0']['registrationDate']);
                                            $("#datepickerdob").val(json['response']['patientData']['0']['dateofBirth']);
                                            $("#Salutation").val(json['response']['patientData']['0']['title']);
                                            $("#fullname").val(json['response']['patientData']['0']['firstName']);
                                            $("#Middle_Name").val(json['response']['patientData']['0']['middleName']);
                                            $("#last_name").val(json['response']['patientData']['0']['lastName']);
                                            $("#age").val(json['response']['patientData']['0']['age']);
                                            $("#gender").val(json['response']['patientData']['0']['gender']);
                                            $("#caste").val(json['response']['patientData']['0']['caste']);
                                            $("#guardian").val(json['response']['patientData']['0']['guardianName']);
                                            $("#guardian_relation").val(json['response']['patientData']['0']['guardianRelation']);
                                            $("#martial_status").val(json['response']['patientData']['0']['maritalStatus']);
                                            $("#occupation").val(json['response']['patientData']['0']['occupation']);
                                            $("#education").val(json['response']['patientData']['0']['education']);
                                            $("#contactNumber").val(json['response']['patientData']['0']['contactNumber']);
                                            $("#pin_code").val(json['response']['patientData']['0']['pincode']);
                                            $("#religion").val(json['response']['patientData']['0']['religion']);								

                                            $("#patient_contact_no").val(json['response']['patientData']['0']['contactNumber']);
                                            $("#alter_contact_no").val(json['response']['patientData']['0']['alternateContactNumber']);
                                            $("#ename").val(json['response']['patientData']['0']['emergencyContactName']);
                                            $("#relation_to_patient").val(json['response']['patientData']['0']['emergencyContactRelation']);

                                            $("#e_contact_no").val(json['response']['patientData']['0']['emergencyContactNumber']);
                                            $("#house_no_street").val(json['response']['patientData']['0']['houseNo']);
                                            $("#block").val(json['response']['patientData']['0']['block']);
                                            $("#street_name").val(json['response']['patientData']['0']['streetName']);
                                            $("#language").val(json['response']['patientData']['0']['language']);
                                            $("#idno").val(json['response']['patientData']['0']['idProofNo']).attr('disabled','true');
                                            $("#typeofid").val(json['response']['patientData']['0']['idProofType']);
                                            $("#village").val(json['response']['patientData']['0']['villageName']);
                                            $("#stateid").val(json['response']['patientData']['0']['stateId']);
                                            $("#countryid").val(json['response']['patientData']['0']['countryId']);								
                                            $("#cityid").val(json['response']['patientData']['0']['cityId']);
                                            $("#area").val(json['response']['patientData']['0']['area']);	

                                            if(json['response']['patientData']['0']['profilePicture'] !='' )
                                            {
                                                var imgurl = json['response']['patientData']['0']['profilePicture'];                                                                
                                                $("#imageUpload").attr('src', imgurl);	
                                            }
                                            else
                                            {
                                                var imgurl = imgs + "profile.jpg";                                                                                
                                                $("#imageUpload").attr('src', imgurl);	
                                            }
                                    }
                                    else
                                    {
                                                    alert("You got an error");
                                                    //alert('Hai');
                                    }
				}
		});		
}



function load() {
    $.blockUI({css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#fff',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            'z-index': 9999,
            color: '#000'
        }});
    //  setTimeout($.unblockUI, 5000); 
}
function getDOB(age) {
    var today = new Date();
    var date = today.getDate();
    var month = today.getMonth() + 1;
    var year = today.getFullYear();
    var dobyear = year - age;
    var dob = dobyear + '-' + month + '-' + date;
    return dob;
}
$(document).ready(function()
{	
                        var reg_age = /^(0?[0-9]{1,2}|1[0-0][0-9]|110)$/;
    $("#age").keyup(function () {

        $("#datepickerdob").val("");
        var ag = $("#age").val();
        $("#datepickerdob").val("");
        if ($("#age").val().match(reg_age)) {
            $("#datepickerdob").val(getDOB(ag));
            $(this).removeClass("validred");
            //$("#datepickerdob").addClass("validgreen");
            $("#doberr").text("");
            $(this).removeClass("validred");
            //$("#age").addClass("validgreen");
            $("#ageerr").text("");
            $("#datepickerdob").css("border-color", "#ccc");
        }
        else {
            $("#datepickerdob").css("border-color", "#ccc");
            $("#ageerr").text("Age limit is 110");
        }
    });
			$("#dateofreg").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.dateofreg').show().html("Please Enter data of registaration date!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.dateofreg').show().html("");
				}
			});
			$("#dateofreg").change(function()
			{
				$(this).removeClass('adminred');
				$('.dateofreg').show().html("");				
			});
			
			$("#datepickerdob").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('#doberr').show().html("Please Enter data of birth!");
				}
				else {						
					$(this).removeClass('adminred');
					$('#doberr').show().html("");
				}
			});		

			$("#datepickerdob").change(function()
			{
                                
				$(this).removeClass('adminred');
				$('#doberr').show().html("");				
                                $("#datepickerdob").css("border-color", "#2eb82e");
			});
			
			$("#Salutation").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.Salutation').show().html("Please Enter data of registaration!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.Salutation').show().html("");
				}
			});
			
			$("#fullname").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.fullname').show().html("Please Enter fullname!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.fullname').show().html("");
				}
			});
			
			$("#Middle_Name").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.Middle_Name').show().html("Please Enter Middle Name!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.Middle_Name').show().html("");
				}
			});
			$("#last_name").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.last_name').show().html("Please Enter last name!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.last_name').show().html("");
				}
			});
			
			$("#guardian").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.guardian').show().html("Please Enter gradain!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.guardian').show().html("");
				}
			});
			
			$("#guardian_relation").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.guardian_relation').show().html("Please Enter guardian relation!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.guardian_relation').show().html("");
				}
			});
			
			$("#age").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('#ageerr').show().html("Please Enter you age!");
				}
				else {						
					$(this).removeClass('adminred');
					$('#ageerr').show().html("");
				}
			});
			
			$("#gender").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.gender').show().html("Please Enter gender!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.gender').show().html("");
				}
			});
			$("#martial_status").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.martial_status').show().html("Please Enter gender!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.martial_status').show().html("");
				}
			});
			
			$("#caste").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.caste').show().html("Please Enter caste!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.caste').show().html("");
				}
			});
			
			$("#religion").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.religion').show().html("Please Enter religion!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.religion').show().html("");
				}
			});
			
			$("#occupation").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.occupation').show().html("Please Enter occupation!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.occupation').show().html("");
				}
			});
			
			$("#education").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.education').show().html("Please Enter education!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.education').show().html("");
				}
			});
			
			$("#house_no_street").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.house_no_street').show().html("Please Enter house no!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.house_no_street').show().html("");
				}
			});
			
			$("#village").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.village').show().html("Please Enter village!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.village').show().html("");
				}
			});
			
			$("#block").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.block').show().html("Please Enter block!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.block').show().html("");
				}
			});
			
			$("#district").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.district').show().html("Please Enter district!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.district').show().html("");
				}
			});
			
			$("#stateid").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.state').show().html("Please Enter state!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.state').show().html("");
				}
			});
			
			$("#cityid").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.city').show().html("Please Enter city!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.city').show().html("");
				}
			});
						
			$("#language").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.language').show().html("Please Enter language!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.language').show().html("");
				}
			});
			
			$("#countryid").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.country').show().html("Please Enter country!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.country').show().html("");
				}
			});
			
			$("#pin_code").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.pin_code').show().html("Please Enter pin code!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.pin_code').show().html("");
				}
			});
			
			$("#patient_contact_no").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.patient_contact_no').show().html("Please Enter patient contact no!");
				}
				else {					
						var plen = $('#patient_contact_no').val().length;
						//alert(plen);
						if(plen<10 || plen>10)
						{
								//alert('error');
								$('.patient_contact_no').show().html("Please Enter max 10 numbers!");								
						}
						else
						{
								//alert('error123');
								$(this).removeClass('adminred');
								$('.patient_contact_no').show().html("");
						}
				}
			});
			
			$("#alter_contact_no").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.alter_contact_no').show().html("Please Enter alternate no!");
				}
				else {		
					var plen = $('#alter_contact_no').val().length;
						//alert(plen);
					if(plen<10 || plen>10)
					{
						$('.alter_contact_no').show().html("Please Enter max 10 numbers!");
					}
					else
					{
						$(this).removeClass('adminred');
						$('.alter_contact_no').show().html("");
					}
				}
			});
			
			$("#e_contact_no").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.e_contact_no').show().html("Please Enter emergency contact no!");
				}
				else {						
					var plen = $('#e_contact_no').val().length;
						//alert(plen);
					if(plen<10 || plen>10)
					{
						$('.e_contact_no').show().html("Please Enter max 10 numbers!");
					}
					else
					{
						$(this).removeClass('adminred');
						$('.e_contact_no').show().html("");
					}
				}
			});
			
			$("#relation_to_patient").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.relation_to_patient').show().html("Please Enter patiet relation!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.relation_to_patient').show().html("");
				}
			});
			
			$("#ename").focusout(function () {
				if ($(this).val() === '') {						
					$(this).addClass('adminred');
					$('.ename').show().html("Please Enter patiet relation!");
				}
				else {						
					$(this).removeClass('adminred');
					$('.ename').show().html("");
				}
			});
	$("#typeofid").change(function () 
	{
        if ($('#typeofid').val() !== "") {
            $("#idno").prop('disabled', false);
        }
        else if ($('#typeofid').val() === "") {

            $("#idno").removeClass("validred");
            $("#idnoerr").text("");
            $("#idno").prop('disabled', true);
        }
    });
    
$("#patientedit").click(function()
{
                    var ajaxurl = '';
                    var formdata = new FormData();	                    
                    formdata.append('profile_picture', $('#patient_photo')[0].files[0]);							
                    formdata.append('date_of_registration', $('#dateofreg').val());
                    formdata.append('pid', $('#pid').val());
                    formdata.append('salutation', $('#Salutation').val());
                    formdata.append('full_name', $('#fullname').val());
                    formdata.append('middle_name', $('#Middle_Name').val());
                    formdata.append('last_name', $('#last_name').val());
                    formdata.append('guardian_name', $('#guardian').val());
                    formdata.append('guardian_relation', $("#guardian_relation").val());
                    formdata.append('Age', $("#age").val());
                    formdata.append('date_of_birth', $("#datepickerdob").val());                        
                    formdata.append('gender', $('#gender').val());                        
                    formdata.append('marital_status', $('#martial_status').val());                        
                    formdata.append('caste', $('#caste').val());                        
                    formdata.append('religion', $("#religion").val());
                    formdata.append('occupation', $("#occupation").val());
                    formdata.append('education', $("#education").val());                        
                    formdata.append('language_id', $('#language').val());                        
                    formdata.append('house_no', $("#house_no_street").val());                        
                    formdata.append('village', $("#village").val());                        
                    formdata.append('block', $("#block").val());
                    formdata.append('district', $("#district").val());
                    formdata.append('countryid', $('#countryid').val());			
                    formdata.append('stateid', $('#stateid').val());
                    formdata.append('cityid', $('#cityid').val());                        
                    formdata.append('pincode', $("#pin_code").val());  
                    formdata.append('street_name', $("#street_name").val());  
                    formdata.append('area', $("#area").val());  
                    formdata.append('patient_contact_no', $("#patient_contact_no").val());
                    formdata.append('alternate_contact_no', $("#alter_contact_no").val());
                    formdata.append('emer_name', $("#ename").val());
                    formdata.append('em_replation_name', $("#relation_to_patient").val());
                    formdata.append('em_contact_no', $("#e_contact_no").val());
                    formdata.append('idno', $("#idno").val());
                    formdata.append('typeofid', $("#typeofid").val());

                    ajaxurl = site_url + 'api/web/v1/ctrl/Patient/updatePatient';   
                    //alert(ajaxurl); return false;
                    
                    $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            contentType: false,
                            data: formdata,
                            processData: false,
                            beforeSend: function () {
                                $('#doctorsubmit').attr('disabled', true);
                                load();
                            },
                            success: function (json) 
                            {        
                                setTimeout($.unblockUI, 0001)
                                $('#patientsubmit').attr('disabled', false);
                                if (json['status']) {
                                        window.location = '#bcp_suc';
                                        $('.bcp_suc').show().html(json['response']['messages']['0']).delay(3500).fadeOut(3000);
                                        window.location.reload();
                                }
                                else
                                {
                                        $('.bcp_suc').show().html("Error Occuurred").delay(3500).fadeOut(3000);
                                        window.location.reload();
                                }                                                       
                                return false;
                            }
                        });
    return false;
});  
	
        
	$('#new_patient_add').on('submit', function(e) 
	{           
                        
			//alert("a12e");
			e.preventDefault();
			var flag=0; 
			var valid = true;
			//var reg_mobile = /^(([0|\+[0-9]{1,5})?([7-9][0-9]{9})|(\d{3}-)*\d{8})$/;    
			//var reg_pin = /^(?=.{1,14}$)[^-\s 0]([a-zA-Z0-9 ]+(-[a-zA-Z0-9]+)?)$/;
			
			
			if($("#dateofreg").val()=='')
			{
					$(".dateofreg").show().html("Please enter your registaration date");
					valid = false;
			}
			
			
                        
			
			if($("#Salutation").val()=='')
			{
					$(".Salutation").show().html("Please enter your Salutation");
					valid = false;
			}
                        if($("#fullname").val()=='')
			{
					$(".fullname").show().html("Please enter your full name");
					valid = false;
			}
			if($("#Middle_Name").val()=='')
			{
					$(".Middle_Name").show().html("Please enter your Middle Name");
					valid = false;
			}
			if($("#last_name").val()=='')
			{
					$(".last_name").show().html("Please enter your last name");
					valid = false;
			}
			if($("#guardian").val()=='')
			{
					$(".guardian").show().html("Please enter your guardian");
					valid = false;
			}
			if($("#guardian_relation").val()=='')
			{
					$(".guardian_relation").show().html("Please enter your guardian relation");
					valid = false;
			}
			if($("#age").val()=='')
			{
					$("#ageerr").show().html("Please enter your Age");
					valid = false;
			}
			if($("#datepickerdob").val()=='')
			{
					$("#doberr").show().html("Please enter your date");
					valid = false;
			}
			
			if($("#gender").val()=='')
			{
					$(".gender").show().html("Please enter your gender");
					valid = false;
			}
			if($("#martial_status").val()=='')
			{
					$(".martial_status").show().html("Please enter your gender");
					valid = false;
			}			
			
			if($("#caste").val()=='')
			{
					$(".caste").show().html("Please enter your caste");
					valid = false;
			}
			if($("#religion").val()=='')
			{
					$(".religion").show().html("Please enter your religion");
					valid = false;
			}
			if($("#occupation").val()=='')
			{
					$(".occupation").show().html("Please enter your occupation");
					valid = false;
			}
			if($("#education").val()=='')
			{
					$(".education").show().html("Please enter your education");
					valid = false;
			}
			if($("#education").val()=='')
			{
					$(".education").show().html("Please enter your education");
					valid = false;
			}
			if($("#house_no_street").val()=='')
			{
					$(".house_no_street").show().html("Please enter your house_no_street");
					valid = false;
			}
			
			if($("#village").val()=='')
			{
					$(".village").show().html("Please enter your village");
					valid = false;
			}
			if($("#block").val()=='')
			{
					$(".block").show().html("Please enter your village");
					valid = false;
			}
			
			if($("#district").val()=='')
			{
					$(".district").show().html("Please enter your district");
					valid = false;
			}
			
			if($("#stateid").val()=='')
			{
					$(".state").show().html("Please enter your state");
					valid = false;
			}
			if($("#cityid").val()=='')
			{
					$(".city").show().html("Please enter your state");
					valid = false;
			}
			
			if($("#language").val()=='')
			{
					$(".language").show().html("Please enter your state");
					valid = false;
			}
			
			if($("#countryid").val()=='')
			{
					$(".country").show().html("Please enter your country");
					valid = false;
			}
			if($("#pin_code").val()=='')
			{
					$(".pin_code").show().html("Please enter your pin_code");
					valid = false;
			}
			
			if($("#patient_contact_no").val()=='')
			{
					$(".patient_contact_no").show().html("Please enter your patient_contact_no");
					valid = false;
			}
			
			if($("#alter_contact_no").val()=='')
			{
					$(".alter_contact_no").show().html("Please enter your alter_contact_no");
					valid = false;
			}
			
			if($("#ename").val()=='')
			{
					$(".ename").show().html("Please enter your ename");
					valid = false;
			}
			if($("#relation_to_patient").val()=='')
			{
					$(".relation_to_patient").show().html("Please enter your relation_to_patient");
					valid = false;
			}
			if($("#e_contact_no").val()=='')
			{				
					$(".e_contact_no").show().html("Please enter your e_contact_no");
					valid = false;
			}
			if(valid==true)
			{
                            var val = $('#countryid').val();            
                            var countryid = $('#country_sugg option').filter(function () {
                                return this.value === val;
                            }).data('id');

                            if (countryid === undefined || countryid === null) {
                                if (country !== null) {
                                    countryid = country;
                                }else{
                                    countryid = 0;
                                }
                            }

                            var val = $('#stateid').val();            
                            var stateid = $('#state_sugg option').filter(function () {
                                return this.value === val;
                            }).data('id');

                            if (stateid === undefined || stateid === null) {
                                if (state !== null) {
                                    stateid = state;
                                }else{
                                    stateid = 0;
                                }
                            }

                            var val = $('#cityid').val();
                            var cityid = $('#city_sugg option').filter(function () {
                                return this.value === val;
                            }).data('id');

                            if (cityid === undefined || cityid === null) {
                                if (city !== null) {
                                    cityid = city;
                                }else{
                                    cityid = 0;
                                }
                            }

                            //alert(cityid)

                            var val = $('#language').val();
                            var langid = $('#lang_sugg option').filter(function () {
                                return this.value === val;
                            }).data('id');

                            if (langid === undefined || langid === null) {
                                if (language !== null) {
                                    langid = language;
                                }else{
                                    langid = 0;
                                }
                            }

                            var formdata = new FormData();							
							formdata.append('profile_picture', $('#patient_photo')[0].files[0]);							
                            formdata.append('date_of_registration', $('#dateofreg').val());
                            formdata.append('salutation', $('#Salutation').val());
                            formdata.append('full_name', $('#fullname').val());
                            formdata.append('middle_name', $('#Middle_Name').val());
                            formdata.append('last_name', $('#last_name').val());
                            formdata.append('guardian_name', $('#guardian').val());
                            formdata.append('guardian_relation', $("#guardian_relation").val());
                            formdata.append('Age', $("#age").val());
                            formdata.append('date_of_birth', $("#datepickerdob").val());                        
                            formdata.append('gender', $('#gender').val());                        
                            formdata.append('marital_status', $('#martial_status').val());                        
                            formdata.append('caste', $('#caste').val());                        
                            formdata.append('religion', $("#religion").val());
                            formdata.append('occupation', $("#occupation").val());
                            formdata.append('education', $("#education").val());                        
                            formdata.append('language_id', langid);                        
                            formdata.append('house_no', $("#house_no_street").val());                        
                            formdata.append('village', $("#village").val());                        
                            formdata.append('block', $("#block").val());
                            formdata.append('district', $("#district").val());
                            formdata.append('countryid', countryid);			
                            formdata.append('stateid', stateid);
                            formdata.append('cityid', cityid);                        
                            formdata.append('pincode', $("#pin_code").val());  
                            formdata.append('street_name', $("#street_name").val());  
                            formdata.append('area', $("#area").val());  
                            formdata.append('patient_contact_no', $("#patient_contact_no").val());
                            formdata.append('alternate_contact_no', $("#alter_contact_no").val());
                            formdata.append('emer_name', $("#ename").val());
                            formdata.append('em_replation_name', $("#relation_to_patient").val());
                            formdata.append('em_contact_no', $("#e_contact_no").val());
							formdata.append('idno', $("#idno").val());
							formdata.append('typeofid', $("#typeofid").val());

                            ajaxurl = site_url + 'api/web/v1/ctrl/Patient/insertPatient';                            		
			
                            //alert(formdata);
                        $.ajax({
                                url: ajaxurl,
                                type: 'POST',
                                contentType: false,
                                data: formdata,
                                processData: false,
                                beforeSend: function () {
                                    $('#doctorsubmit').attr('disabled', true);
                                    load();

                                },
                                success: function (json) 
                                {                
                                    //alert(json); return false;
                                        //alert("record inserted successfully");
                                        setTimeout($.unblockUI, 0001)
                                        $('#patientsubmit').attr('disabled', false);
                                        if (json['status']) {
                                                window.location = '#bcp_suc';
                                                $('.bcp_suc').show().html(json['response']['messages']['0']).delay(3500).fadeOut(3000);
                                                window.location.reload();
                                        }
                                        else
                                        {
                                                $('.bcp_suc').show().html("Error Occuurred").delay(3500).fadeOut(3000);
                                                window.location.reload();
                                        }
									
                                }
                        });
                    }
					else
					{
							return false;
					}	
});
});
 
 
 
 
 