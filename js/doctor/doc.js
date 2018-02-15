/* global angular, site_url */

//Medical Record Page
var myVar;
function loader() {
    myVar = setTimeout(showPage, 1500);
}
function loading(){
    
    	$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
 
        

}
function showPage() {
    
  document.getElementById("loader").style.display = "none";
//  document.getElementById("myDiv").style.display = "block";
}
// End Medical Record Page
// 
function docpro(){
	$('#newpwd').hide();
	$('#editprofile').show();
}
function newpassword(){
	$('#editprofile').hide();
	$('#newpwd').show();
}





$(document).ready(function() {
    doctor.drawSticky();
    if($('#prescription_requests_page').val()){
        $('#pending_requests').text($('#hidden_pending_rquest').val());
    }
//    doctor.getPrescriptionPopup(1);
//    doctor.getMedicineCatalog();
});
var app = angular.module('medicines_catalog_app', []);

app.controller('country', function ($scope, $http) {
    $scope.countries = [300];
    
    $scope.search = function () {
        var country=$("#country").val();
        $scope.RandomValue = country;
        
        $http({
            method: "get",
            url: site_url + 'api/web/v1/Country/searchCountry?name=' + $scope.RandomValue
        }).then(function (response, status) {

            $scope.country = JSON.stringify(response.data);
            var array = JSON.parse($scope.country);
//     var arr = jQuery.makeArray(array.response.countryData);
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



var doctor = {
    setMedicineDosage: function(val,id){
        
        $('#dosage'+$('#'+id).closest('tr').attr('data-id')).val($('#'+id).find(':selected').attr('data-dosage'));
        
    },
    drawSticky: function(){
        var sticky_ids    =   [];
        $('input[type="hidden"].stickyImageid').each(function () {
            sticky_ids.push($(this).val());
            
        });
        $.each(sticky_ids, function( index, value ) {
            var sticky_data = JSON.parse($('#sticky_coordinates'+value+'').val());
            $.each(sticky_data, function( index, coordinate ) {
                $("#sticky_"+value).append('<img src="'+doc_images+'img.png" style="position:absolute;left:'+coordinate.x+'px; top:'+coordinate.y+'px; z-index:2;" >');
            });
        });
         
    },
    redirectMrDetails: function(url){
        window.location = url+'&page_id='+$('#hidden_page_id').val();
    },
    savePrescription: function(){
//        try{
            var data   =   [];
            var error_active    =   0;
            $.each($("#prescription_saving_doc tr"), function() {
                var error_messages  =   '';
            var rowid   =   $(this).data("id");
            if(rowid > 0){
                    if($('#medicine'+rowid+'').val() == 0){
//                        $('.select2-selection').css("border-color", "#ff0000");
                        $('#select2-medicine'+rowid+'-container').parent().addClass("validred");
//                        $('.select2').addClass("alert")
                        error_active    =   1;
//                        error_messages  +=  '<span>Please select Medicine</span>';
                    }else{
                        $('#select2-medicine'+rowid+'-container').parent().removeClass("validred");
                    }
                        
                    if($('#quantity'+rowid+'').val() == ''){
                        $('#quantity'+rowid+'').addClass("validred");
                        error_active    =   1;
//                        error_messages  +=  '<span>Please select Medicine</span>';
                    }else{
                        $('#quantity'+rowid+'').removeClass("validred");
                    }
                        
                    if($('#quantity'+rowid+'').val() == 0){
                        $('#quantity'+rowid+'').addClass("validred");
                        error_active    =   1;
//                        error_messages  +=  '<span>Quantity should be atleast 1</span>';
                    }else{
                        $('#quantity'+rowid+'').removeClass("validred");
                    }
                    if($('#timing'+rowid+'').val() == ''){
                        $('#timing'+rowid+'').addClass("validred");
                        error_active    =   1;
//                        error_messages  +=  '<span>Please enter timings</span>';
                    }else{
                        $('#quantity'+rowid+'').removeClass("validred");
                    }
                    if($('#days'+rowid+'').val() == 0){
                        $('#days'+rowid+'').addClass("validred");
                        error_active    =   1;
//                        error_messages  +=  '<span>Days should be atleaset 1</span>';
                    }else{
                        $('#quantity'+rowid+'').removeClass("validred");
                    }
                    
                    var Array   =   {
                        'medicine_id'   :   $('#medicine'+rowid+'').val(),
                        'quantity'      :   $('#quantity'+rowid+'').val(),
                        'timing_ids'        :   $('#timing'+rowid+'').val(),
                        'days'          :   $('#days'+rowid+'').val(),
                        'visit_id'          :   $('#hidden_visit_id').val(),
                        'bcp_id'          :   $('#hidden_bcp_id').val(),
                        'medicine_name'          :   $('#medicine'+rowid+' :selected').text(),
                        'prescription_request_id'          :   $('#hidden_prescription_request_id').val(),
                    };
                    data.push(Array);
//                    if($.trim(error_messages) != ''){
//                        error_active    =   1;
//                        $('#error_messages'+rowid).html(error_messages);
//                    }
                    
                }
                
            });
            if(error_active){
                return false;
            }
            $('#prescription_saving_doc_save_button').attr('disabled',true);
            
            loading();
            $.ajax({
            url:doc_web_api + 'Doctor/prescriptionDetail',
            type: 'POST',
            data: {
                'data'  :   data
            },
            dataType:'json',
            beforeSend: function(){
                $('#prescription1').modal('hide');
            },  
            error: function (xhr, tst, err) {
                location.reload();
            },
            success: function(data) {
                    
                if(!data.error){
//                      $.unblockUI;  
//                    document.getElementById("loader").style.display = "none";
                    $('#prescription1').modal('hide');
                    $('#prescription_popup').html('');
                    location.reload();
                }
                              
            },
            

        });
            
        
//        }
//        catch(e)
//         {
//            alert(e.msg);
//            $(e.elt).focus();
//            return false;
//         }
        
    },
    saveDoctorFeedback: function(visit_id){
//        try{
            var error_active    =   0;
                    if($.trim($('#comments_'+visit_id+'').val()) == ''){
                        $('#comments_'+visit_id+'').addClass("validred");
                        error_active    =   1;
                    }else{
                        $('#is_retake_'+visit_id+'').removeClass("validred");
                    }
                    var is_retake   =   0    
                    if($('#is_retake_' +visit_id).is(":checked")){
                        is_retake   =   1;
                    }
                    var Array   =   {
                        'visit_id'   :   visit_id,
                        'comments'      :   $('#comments_'+visit_id+'').val(),
                        'is_retake'      :   is_retake,
                        
                    };
                     
            if(error_active){
                return false;
            }
            $('#doctor_remarks_submit_button'+visit_id).attr('disabled',true);
            $('#retake_button_'+visit_id).attr('disabled',true);
            $('#retake_button_'+visit_id).hide();
            $('#retake_close_button_'+visit_id).trigger('click');
            
            loading();
            $.ajax({
            url:doc_web_api + 'Doctor/doctorFeedback',
            type: 'POST',
            data: Array,
            dataType:'json',
            success: function(data) {
                if(!data.error){
                    $('#retake_button_'+visit_id).attr('disabled',true);
                    setTimeout($.unblockUI, 0001); 
                }else{
                    
                }
                              
            },
            

        });
            
        
//        }
//        catch(e)
//         {
//            alert(e.msg);
//            $(e.elt).focus();
//            return false;
//         }
        
    },
    addPrescription: function(){
        try{
            var data   =   [];
            if($('#id_bcp_list').val() == 0)
               $('#bcplist_error').text('Please Select BCP');
               $('#collapsezero').addClass('in');
            
            if($('#id_patient').val() == 0){
                $('#patientlist_error').text('Please Select Patient');
                $('#collapsezero').addClass('in');
            }
                if($('#name').val() == ''){
                   $('#error_pname').text('Please Enter Patient Name');
                   $('#name').addClass('validred');
                   $('#collapseOne').addClass('in');
               }
                if($('#gender').val() == ''){
                   $('#error_gender').text('Please Select Gender');
                   $('#gender').addClass('validred');
                   $('#collapseOne').addClass('in');
                }
                if($('#age').val() == ''){
                    $('#error_age').text('Please Enter Age');
                   $('#age').addClass('validred');
                   $('#collapseOne').addClass('in');
                }
                if($('#village').val() == ''){
                   $('#error_village').text('Please Enter Village Name');
                   $('#village').addClass('validred');
                   $('#collapseOne').addClass('in');
                }
                if($('#contact').val() == ''){
                   $('#error_contact').text('Please Enter Contact');
                   $('#contact').addClass('validred');
                   $('#collapseOne').addClass('in');
            }
            
            var header_data =   {
                'bcp_id'    :   $('#id_bcp_list').val(),
                'id_patient'    :   $('#id_patient').val(),
                'incident_type'    :   $('input[name=incident_type]:checked').val(),
                'name'    :   $('#name').val(),
                'gender'    :   $('#gender').val(),
                'age'    :   $('#age').val(),
                'village'    :   $('#village').val(),
                'contact'    :   $('#contact').val(),
            };
            
            $.each($("#prescription_add_table tr"), function() {
            var rowid   =   $(this).data("id");
            if(rowid > 0){
                    if($('#medicine'+rowid+'').val() == 0){
                        $('#medicine'+rowid+'').addClass('validred');
                    }
                   
                    if($('#dosage'+rowid+'').val() == ''){
                        
                        $('#dosage'+rowid+'').addClass('validred');
                    }
                    if($('#quantity'+rowid+'').val() == 0){
                        $('#quantity'+rowid+'').addClass('validred');
                    }
                    if($('#timing'+rowid+'').val() == ''){
                        $('#timing'+rowid+'').addClass('validred');
                    }
                    if($('#days'+rowid+'').val() == 0){
                        $('#days'+rowid+'').addClass('validred');
                    }
                        throw{'msg':'Days should be atlease 1','elt':'#days'+rowid+''}
                        
                    var Array   =   {
                        'medicine_id'   :   $('#medicine'+rowid+'').val(),
                        'quantity'      :   $('#quantity'+rowid+'').val(),
                        'timing_ids'    :   $('#timing'+rowid+'').val(),
                        'days'          :   $('#days'+rowid+'').val(),
                        'visit_id'      :   $('#hidden_visit_id').val(),
                        'bcp_id'        :   $('#hidden_bcp_id').val(),
                        'medicine_name'          :   $('#medicine'+rowid+':selected').text(),
                        'prescription_request_id'          :   $('#hidden_prescription_request_id').val(),
                    };
                    data.push(Array);
                }
            });
            
            
//            loading();
            $.ajax({
            url:doc_web_api + 'Doctor/prescriptionRequestFromDoctor',
            type: 'POST',
            data: {
                'data'  :   data,
                'header_data'  :   header_data,
            },
            dataType:'json',
            success: function(data) {
                    
                if(!data.error){
//                      $.unblockUI;  
//                    document.getElementById("loader").style.display = "none";
                    $('#prescription1').modal('hide');
                    $('#prescription_popup').html('');
                    location.reload();
                }
                              
            },
            

        });
            
        
        }
        catch(e)
         {
            //alert(e.msg);
            $(e.elt).focus();
            return false;
         }
        
    },
    getMedicineCatalog: function(search){
        $.ajax({
            url:doc_web_api + 'Doctor/getMedicineCatalog',
            type: 'GET',
            data: {
                'search'    :   search,
            },
            dataType:'json',
            success: function(data) {
                
                if(!data.error){
                    console.log(data);
                    $('#prescription_popup').html(data.payload);
                    $('#prescription1').modal('show');
                }
                              
            },
            

        });
    },
	getPrescriptionVideoPopup: function(id){
        $.ajax({
            url:doc_web_api +'Doctor/newPrescriptionVideoDetail',
            type: 'GET',
            data: {
                'id'    :   id,
            },
            dataType:'json',
            success: function(data) {
                if(!data.error){
                    
                    $('#prescription_popup').html(data.payload);
                    $('#prescription1').modal('show');
                    
                    $('#presc_add_new_button').trigger("click");
//                    $compile($('#prescription_popup').contents())($scope);
                }
                              
            },
            

        });
    },
    getPrescriptionPopup: function(id){
        $.ajax({
            url:doc_web_api +'Doctor/newPrescriptionDetail',
            type: 'GET',
            data: {
                'id'    :   id,
            },
            dataType:'json',
            success: function(data) {
                if(!data.error){
                    
                    $('#prescription_popup').html(data.payload);
                    $('#prescription1').modal('show');
                    
                    $('#presc_add_new_button').trigger("click");
//                    $compile($('#prescription_popup').contents())($scope);
                }
                              
            },
            

        });
    },
    getPrescriptionPopupView: function(id){
        
        $.ajax({
            url:doc_web_api + 'Doctor/prescriptionDetail',
            type: 'GET',
            data: {
                'id'    :   id,
            },
            dataType:'json',
            success: function(data) {
                if(!data.error){
                    
                    $('#prescription_popup').html(data.payload);
                    $('#prescription1').modal('show');
                    
//                    $compile($('#prescription_popup').contents())($scope);
                }
                              
            },
            

        });
    },
    getAddPrescriptionPopup: function(id){
        
        $.ajax({
            url: doc_web_api + 'Doctor/prescriptionRequestFromDoctor',
            type: 'GET',
            data: {
                'id'    :   id,
            },
            dataType:'json',
            success: function(data) {
                if(!data.error){
                    
                    $('#prescription_popup_add').html(data.payload);
                    
                    $('#prescription2').modal('show');
                    doctor.getBcpList();
                    $('#presc_add_new_button_add').trigger("click");
                }
                              
            },
            

        });
    },
    getBcpList: function(id){
        
        $.ajax({
            url:doc_web_api + 'Doctor/assignedBcpList',
            type: 'GET',
            data: {
                'id'    :   id,
            },
            dataType:'json',
            success: function(data) {
                
                if(!data.error){
                    
                    $('#id_bcp_list').html('<option value="0">-- BCP --</option>'+data.payload);
                    $('.select2').select2();
//                    $('#prescription2').modal('show');
                    
//                    $('#presc_add_new_button').trigger("click");
//                    $compile($('#prescription_popup').contents())($scope);
                }
                              
            },
            

        });
    },
    getAssignedPatients: function(id){
        
        $.ajax({
            url:doc_web_api + 'Doctor/bcpMedicalRecords',
            type: 'GET',
            data: {
                'id'    :   id,
            },
            dataType:'json',
            success: function(response) {
                
                if(response.status){
                    
                    $('#id_patient').html('<option value="0">-- Patient --</option>'+response.response.payload);
                    $('.select2').select2();
//                    $('#prescription2').modal('show');
                    
//                    $('#presc_add_new_button').trigger("click");
//                    $compile($('#prescription_popup').contents())($scope);
                }
                              
            },
            

        });
    },
    
    addRows: function(tableid){	
        
	// Dynamic Rows Code
        // Get max row id and set new id
	var newid = 0;
	$.each($("#"+tableid+" tr"), function() {
		
		if (parseInt($(this).data("id")) > newid) {
			newid = parseInt($(this).data("id"));
		}
	});
	newid++;

	var tr = $("<tr></tr>", {
		id : "addr" + newid,
		"data-id" : newid
	});

	// loop through each td and create new elements with
	// name of newid
	$.each($("#"+tableid+" tbody tr:nth(0) td"), function() {
		var cur_td = $(this);

		var children = cur_td.children();

		// add new td and element if it has a nane
		if ($(this).data("name") != undefined) {
			var td = $("<td></td>", {
				"data-name" : $(cur_td).data("name"),
			});

			var c = $(cur_td).find(
					$(children[0]).prop('tagName')).clone()
					.val("");
			c.attr("name", $(cur_td).data("name") + newid);
			c.attr("id", $(cur_td).data("name") + newid);
			c.appendTo($(td));
			td.appendTo($(tr));
		} else {
			var td = $("<td></td>", {
				'text' : $("#"+tableid+" tr").length
			}).appendTo($(tr));
		}
	});

	// add delete button and td
	/*
	 * $("<td></td>").append( $("<button class='btn
	 * btn-danger glyphicon glyphicon-remove row-remove'></button>")
	 * .click(function() { $(this).closest("tr").remove(); })
	 * ).appendTo($(tr));
	 */

	// add the new row
	$(tr).appendTo($("#"+tableid));

	
                        $('.select2').select2();
                        
    },
    deleteRow: function(tableid,id){
        var rows = $("#"+tableid+" tr").length;
        if(rows > 3){
            $('#'+id).closest("tr").remove();
        }
    }
};









// Script to open and close sidebar
function w3_open() {
	document.getElementById("mySidebar").style.display = "block";
	document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
	document.getElementById("mySidebar").style.display = "none";
	document.getElementById("myOverlay").style.display = "none";
}

function openNav() {
	document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
}


//for tool-tip
$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
});


$(document).ready(function(){
	
	n =  new Date();
	y = n.getFullYear();
	m = n.getMonth() + 1;
	d = n.getDate();
	var date = m + "/" + d + "/" + y;
	$(".currentdate").text(date);
	
	
	
	$(".contact-toggle").click(function(){
		$(".contact-toggle").hide();
	    $(".contact-box").show(); /*('slide', {direction: 'right'}, 1000);*/
    });
	
	$(".retake").click(function(){
		$(".contact-box").hide(); /*('slide', {direction: 'right'}, 1000); */
	    $(".contact-toggle").show();
	});
	
	$(".submit").click(function(){
		$(".contact-box").hide(); /*('slide', {direction: 'right'}, 1000); */
	    $(".contact-toggle").show();
	});
	
	
	//for tool-tip	
	//$('[data-toggle="tooltip"]').tooltip();
	//for end tool-tip	
	
					columnChart();

					function columnChart() {
						var item = $('.chart', '.column-chart').find('.item'), itemWidth = 100 / item.length;
						item.css('width', itemWidth + '%');

						$('.column-chart')
								.find('.item-progress')
								.each(
										function() {
											var itemProgress = $(this), itemProgressHeight = $(
													this).parent().height()
													* ($(this).data('percent') / 100);

											console
													.log($(this)
															.data('percent'));
											console.log(itemProgressHeight);

											itemProgress.css('height',
													itemProgressHeight);
										});
					}
					;
				});



// for displaying a particular date

function myFunction() {
	var x = document.getElementById("myDate").value;
	document.getElementById("demo").innerHTML = x;
}

// for filtering table data of single column with multiple tables
function myFunction2() {

	var input, filter, table, tr, td, i;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("myTable");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}
	}

	if ($('#myTable tr:visible').length == 1) {
		$('#myTable').hide();
	} else {
		$('#myTable').show();
	}
}
function myFunction20() {

	var input, filter, table, table2, tr, tr2, td, td2, i, j;
	input = document.getElementById("myInput");

	filter = input.value.toUpperCase();

	table = document.getElementById("myTable");
	tr = table.getElementsByTagName("tr");

	table2 = document.getElementById("myTable2");
	tr2 = table2.getElementsByTagName("tr");

	for (i = 0, j = 0; (i < tr.length) || (j < tr2.length); i++, j++) {

		td = tr[i].getElementsByTagName("td")[0];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {

				tr[i].style.display = "";

				$('#myTable tbody tr.header').show();
				$('#myTable').show();

			} else {
				tr[i].style.display = "none";

			}
		}

		td2 = tr2[j].getElementsByTagName("td")[0];
		if (td2) {
			if (td2.innerHTML.toUpperCase().indexOf(filter) > -1) {

				tr2[j].style.display = "";

				$('#myTable2 tbody tr.header').show();
				$('#myTable2').show();

			} else {
				tr2[j].style.display = "none";

			}
			console.log($('#myTable2 tr:visible').length);
		}

	}
	if ($('#myTable tr:visible').length == 1) {
		$('#myTable tbody tr.header').hide();
		$('#myTable').hide();
	}
	if ($('#myTable2 tr:visible').length == 1) {
		$('#myTable2 tbody tr.header').hide();
		$('#myTable2').hide();
	}
	if ($.trim(filter) == '') {
		$('#myTable').hide();
		$('#myTable2').hide();
	}

}



