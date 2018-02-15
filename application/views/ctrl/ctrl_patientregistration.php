<?php $country = $country['response']['countryData'] ?>
<link rel="stylesheet" href="<?php echo $ctrl_css_path?>jquery-ui<?php echo $ctrl_css_ext?>">
<script src="<?php echo $ctrl_js_path.'angularjs'.$ctrl_js_ext?>"></script>
<script src="<?php echo $ctrl_js_path.'jquery-ui'.$ctrl_js_ext?>"></script>
<script src="<?php echo $ctrl_js_path.'patient_registration'.$ctrl_js_ext?>"></script>

<style>
.registration_form { margin-top:8px;   }
    /* Safari only */
html:lang(en)>body {display: none;} 
form.ng-pristine {
    background-color:lightblue;
}
form.ng-dirty {
    background-color:pink;
}
.error { color:red; }
#error { color:red; }
.bcp_suc,.delinfo { color:green; font-size: 12px; }
#delete { cursor: pointer; }
input { width:140px !important; }
select { width:120px !important; }
.col-sm-6_n { width: 26% !important;  }
.col-sm-3_s {   width:115px !important; float:left; }
label { font-weight: normal;}
.postleft { margin-left:20px;  }
</style>
<script type="text/javascript">
    /*$(document).ready(function()
	{         
		$("#signupdate").datepicker({
			dateFormat: 'yy-mm-dd'
		 });
		$("#dateofreg").datepicker({
			dateFormat: 'yy-mm-dd'
		 });	
		$('#datepickerdob')
        .datepicker({
            format: 'yy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#dateofreg').val('');
        });
		$('#datepickerdob').datepicker({
            onSelect: function (value) {
                var today = new Date(),
                dob = new Date(value),
                age = new Date(today - dob).getFullYear() - 1970;
                alert(age);
                $('#age').val(age);
                $("#age").css("border-color", "#2eb82e");
                $("#ageerr").text("");
                $("#datepickerdob").css("border-color", "#2eb82e");
                $("#doberr").text("");
            },
            maxDate: '+0d',
            dateFormat: 'yy-mm-dd',
            yearRange: '-100:+1',
            changeMonth: true,
            changeYear: true
        });
		var dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#age').html(age + ' years old');
	});*/
    $(function () {
        $("#dateofreg").datepicker({
			dateFormat: 'yy-mm-dd'
		 });	
		
        $("#datepicker").datepicker({maxDate: new Date(), dateFormat: 'yy-m-dd',
            onSelect: function (datetext) {
                var d = new Date(); // for now
                var h = d.getHours();
                h = (h < 10) ? ("0" + h) : h;

                var m = d.getMinutes();
                m = (m < 10) ? ("0" + m) : m;

                var s = d.getSeconds();
                s = (s < 10) ? ("0" + s) : s;

                datetext = datetext + " " + h + ":" + m + ":" + s;
                $('#datepicker').val(datetext);
            }
        });
        

        $('#datepickerdob').datepicker({
            onSelect: function (value) {
                var today = new Date(),
                dob = new Date(value),
                age = new Date(today - dob).getFullYear() - 1970;

                $('#age').val(age);
                $("#age").css("border-color", "#2eb82e");
                $("#ageerr").text("");
                $("#datepickerdob").css("border-color", "#2eb82e");
                $("#doberr").text("");
                $('#dateofreg').val('');
            },
            maxDate: '+0d',
            dateFormat: 'yy-mm-dd',
            yearRange: '-100:+1',
            changeMonth: true,
            changeYear: true
        });

        var dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#age').html(age + ' years old');

        var d = new Date(); // for now
        var yy = d.getFullYear();
        var mm = d.getMonth() + 1;
        var dd = d.getDate();
        var h = d.getHours();
        h = (h < 10) ? ("0" + h) : h;

        var m = d.getMinutes();
        m = (m < 10) ? ("0" + m) : m;

        var s = d.getSeconds();
        s = (s < 10) ? ("0" + s) : s;

        var datetext = yy + "-" + mm + "-" + dd + " " + h + ":" + m + ":" + s;

        $('#datepicker').val(datetext);

    });
</script>
<!-- Add new row line modal start -->
<div class="modal fade add-row-box" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div class="success-msg-box"><span id="networkadd_sucess"></span></div>
            <div class="error-msg-box"><span id="networkadd_error"></span></div>
            <div class="modal-body card">
                <!-- content goes here -->
                <form novalidate id="new_patient_add" method="post" name='myform' enctype="multipart/form-data">
                    <div ng-app="Hff">					
						<div class="modal-header addbuttonheader">
							   <button type="button" class="close addbutton" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							   <h3 class="modal-title " id="lineModalLabel1">Add New Patient</h3>
							   <h3 class="modal-title " id="lineModalLabelEdit">Edit Patient</h3>
					   </div>
						<div class="registration_form" ng-contoller="Hff">
                                                                
								<table width="100%" border="0">
                                                                <tr><td align="center" colspan="4"><span class="bcp_suc" id="bcp_suc"></span></td></tr>
								<tr><td><input type='hidden' id="pid" name="patientid" value=''></td></tr>
								<tr>
                                                                    <td width="25%">Date of Registration:<span id='error'>*</span></td>
									<td width="25%"><input placeholder="Date of registraion" type="text" id="dateofreg" name='dateofreg' class='filed_empty' name="dregistration" ng-model="dreg">
											<br><span class='error dateofreg'></span>
									</td>                                                            
									<td width="25%">Patient Photo</td>
									<td width="25%">
										<div class="doc-profile-img">
											<div class="doc-file-label">Upload Photo</div>                                     
											<img src="<?php echo site_url()."images/ctrl/profile.jpg"; ?>" id="imageUpload" name="profilePicture" class="doc-img" 
												 alt="Preview Image">
										</div>
										<div class="doc-profile-img">
											<input type="file" name="patient_photo" id="patient_photo" class="file-opacity"> 
											<label for="patient_photo" class="btn btn-large doc-upload-btn addbutton"><span class="glyphicon glyphicon-upload"></span> Upload</label>
										</div>                                                                      												
									</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Salutation<span id='error'>*</span></td>
									<td>
									<select name='Salutation' id="Salutation" ng-model="salu" class='filed_empty'>
											<option value='' ng-model="sal">Select Salutation</option>
											<option value='mr'>Mr</option>
											<option value='mrs'>Mrs</option>
											<option value='miss'>Miss</option>
									</select>
									<br><span class='error Salutation'></span>												
									</td>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Full Name:<span id='error'>*</span></td>
									<td>
											<input placeholder="Full Name" type="text" id='fullname' name="fullname" required ng-model="full_name" class='filed_empty'>
											<br><span class='error fullname'></span>
									</td>											
									<td>Middle Name:<span id='error'>*</span></td>
									<td>
											<input placeholder="Middle Name" type="text" id="Middle_Name" name="Middle_Name" ng-model="middle_name" class='filed_empty'>
											<br><span class='error Middle_Name'></span>
									</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Last Name<span id='error'>*</span></td>
									<td>
											<input placeholder="Last Name" type="text" id="last_name" name="last_name" ng-model="last_name" class='filed_empty'>
											<br><span class='error last_name'></span>												
									</td>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Guardian Name<span id='error'>*</span></td>
									<td>
													<input placeholder="Guardian Name" class='filed_empty' type="text" name="guardian" ng-model="guardian" id="guardian"><br>
													<br><span class='error guardian'></span>
									</td>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Guardian Relation<span id='error'>*</span></td>
									<td>
										<select class="form-control logininput filed_empty" id="guardian_relation" name="guardian_relation" >
											<option value="" selected="">Relation</option>
											<option value="father" >Father</option>
											<option value="mother">Mother</option>
											<option value="husband">Husband</option>
											<option value="other">Others</option>
										</select>
										<br><span class='error guardian_relation'></span>
									</td>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>

								<tr>
									<td colspan="4">
										<div class="form-group">
											<label class="col-sm-3_s">Date of Birth<span id='error'>*</span></label>
											<div class="col-sm-6 col-sm-6_n ">
												<input type="text" id="datepickerdob" value="" name="dob" placeholder="Date of Birth" class="form-control logininput filed_empty">
												<span class="error disp-error-patient" id="doberr"></span>
											</div>
											<div class="col-xs-12 hidden-lg hidden-md hidden-sm">Age<span id='error'>*</span></div>
											<div class="col-sm-3"> 
												<input type="text" placeholder="Age" id="age" class="filed_empty form-control logininput">
												<span class="error disp-error-patient" id="ageerr"></span>
											</div>
										</div>
									</td>
								</tr>								
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Type of Id:</td>
									<td>
									<div>
											<select  class="filed_empty form-control logininput width70" value="" id="typeofid"><!-- lesswidth -->
												<option value="">Select ID</option>
												<option value="adhaar">Adhaar</option>
												<option value="pan">PAN</option>
												<option value="voterid">Voter ID</option>
												<option value="others">Others</option>
											</select>
											<span class="error disp-error-patient" id="typeofiderr"></span>
										</div>															
									</td>
									<td>Id Number:</td>
									<td>
										<div class="col-sm-9"> 
											<input placeholder="Id Number" type="text" class="filed_empty form-control logininput width70" id="idno" placeholder="ID number" disabled="true">
											<span class="error disp-error-patient" id="adhaarerr"></span>
										</div>
									</td>
								</tr>
								
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Gender:<span id='error'>*</span></td>
									<td><select name='gender' id="gender" ng-model="gender" id="gender" class='filed_empty'>
													<option value=''>Select Gender</option>
													<option value='male'>Male</option>
													<option value='female'>Female</option>
											</select>
											<br><span class='error gender'></span>
									</td>											
									<td>Marital Status:<span id='error'>*</span></td>
									<td><select name='martial_status' id="martial_status" ng-model="martial_status" class='filed_empty postleft'>
											<option value="">Select Status</option>
											<option value="single">Single</option>
											<option value="married">Married</option>
											<option value="widow">Widow</option>
											<option value="divorced">Divorced</option>
											<option value="separated">Separated</option>
									</select>
									<br><span class='error martial_status'></span>
									</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Caste:<span id='error'>*</span></td>
									<td>
											<input placeholder="Caste" type="text" name="caste" id="caste" ng-model="caste" class='filed_empty'>
											<br><span class='error caste'></span>
									</td>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Religion:<span id='error'>*</span></td>
									<td>
											<input placeholder="Religion" type="text" name="religion" id="religion" ng-model='religion' class='filed_empty'>
											<br><span class='error religion'></span>
									</td>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Occupation:<span id='error'>*</span></td>
									<td>
											<input placeholder="Occupation" class='filed_empty' type="text" name="occupation" id="occupation" ng-model='occupation'>
											<br><span class='error occupation'></span>
									</td>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td>Education:<span id='error'>*</span></td>
									<td>											
											<select class='filed_empty' name='education' id="education" ng-model="education">
													<option value=''>Select Martial Status</option>
													<option value='elementary'>Elementary</option>
													<option value='high-school'>high-school</option>													
													<option value='college'>College</option>
													<option value='graduation'>Graduation</option>
													<option value='post-graduation'>Post- graduation</option>
													<option value='no-education'>No-Education</option>
											</select>
											<br><span class='error education'></span>
									</td>
									<td>&nbsp;&nbsp;Language<span id='error'>*</span></td>
									<td>

										<div class="input-container postleft"  ng-controller="language"> 
												<input type="text" list="lang_sugg" id="language" class='filed_empty rmv' autocomplete="off" name='languageid' required="required" ng-model="cquery" ng-keyup="searchlang()"/>
												<datalist id="lang_sugg" ng-show="query">
														<option ng-repeat="language in languages| filter:cquery  "  data-id="{{language.id}}">{{language.name}} </option>
												</datalist> 
												<label for="#{language}">Enter Language</label>
												<span class="error error-msg-box error-span language" id='languageerr'>                                    
												</span>
										</div> 												
									</td>
								</tr>
								<tr>
									<td colspan="4">
										<h3><u>Address</u></h3>
									</td>											
								</tr>
								<tr>
									<td>House no / Street<span id='error'>*</span></td> 
									<td>
											<input placeholder="House Number" type="text" class='filed_empty' name="house_no_street" id="house_no_street" ng-model='house_no_street'>
											<br><span class='error house_no_street'></span>
									</td>
									<td colspan="2">&nbsp;</td>
								</tr> 
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
									<td>Village:<span id='error'>*</span></td>
									<td>
											<input placeholder="Village" class='filed_empty' type="text" name="village"  id="village" ng-model='village'>
											<br><span class='error village'></span>
									</td>

									<td>&nbsp;&nbsp;Block:</td>
									<td>
											<input placeholder="Block" class='filed_empty postleft' type="text" name="block" id="block" ng-model='block'>
											<br><span class='error block'></span>
									</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
												<td>Street Name:</td>
												<td>
														<input placeholder="Street Name" class='filed_empty' type="text" name="street_name" id="street_name" ng-model='street_name'>
														<br><span class='error street_name'></span>
												</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
												<td>Area:</td>
												<td>
														<input placeholder="Area" class='filed_empty' type="text" name="Area" id="area" ng-model='area'>
														<br><span class='error area'></span>
												</td>
								</tr>

								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
										<td>Country<span id='error'>*</span></td> 
										<td>
												<div class="input-container" ng-controller="country" ng-model="query" >
														<input type="hidden"  value=" " id="country"   >
														<input type="text" list="country_sugg" id="countryid" class='filed_empty rmv' name='countryid' autocomplete="off" required="required" ng-model="query" ng-keyup="countrysearch()" value="{{country.id}}">
														<datalist id="country_sugg" ng-show="query">
																<option  ng-repeat="country in countries| filter:query" data-id="{{country.id}}">{{country.name}} </option>
														</datalist>
														<label for="#{country}">Enter Country</label>
														<span class="error error-msg-box error-span country" id='countryerr'>                                    
														</span>                                    
												</div>  
										</td>
										<td>&nbsp;&nbsp;State:<span id='error'>*</span></td> 
										<td>

														<div class="postleft input-container" ng-controller="state">
																<input type="text" list='state_sugg' id="stateid" class='filed_empty rmv' name='stateid' autocomplete="off" required="required" ng-model="squery" ng-keyup="statesearch()">
																<datalist id="state_sugg" ng-show="query">
																		<option ng-repeat="state in states| filter:squery" data-id="{{state.id}}">{{state.name}} </option>
																</datalist>
																<label for="#{state}">Enter State</label>
																<span class="error error-msg-box error-span state" id='stateerr'>                                    
																</span>
														</div> 

										</td>										
								</tr>
								<tr>
										<td>&nbsp;&nbsp;City<span id='error'>*</span></td> 
										<td>

														<div class="input-container" ng-controller="city">
																<input type="text" list="city_sugg" id="cityid" class='filed_empty rmv' name='cityid' autocomplete="off" required="required" ng-model="cquery" ng-keyup="citysearch()">
																<datalist id="city_sugg" ng-show="query">
																		<option ng-repeat="city in cities| filter:cquery" data-id="{{city.id}}">{{city.name}} </option>
																</datalist>                                            
																<label for="#{city}">Enter City</label>
																<span class="error error-msg-box error-span city" id='cityerr'>                                    
																</span>
														</div>  

										</td>
										<td>&nbsp;&nbsp;Pin Code:<span id='error'>*</span></td>
										<td>
												<input placeholder="Pin Code" class='postleft filed_empty' type="text" name="pin_code" id="pin_code" ng-model='pin_code'>
												<br><span class='error pin_code'></span>
										</td>
								</tr>									<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
												<td>Contact Number:<span id='error'>*</span></td>
												<td>
														<input placeholder="Contact Number" class='filed_empty' type="number" name="patient_contact_no" maxlength="10" id='patient_contact_no' ng-model='patient_contact_no'>
														<br><span class='error patient_contact_no'></span>
												</td>  
												<td>&nbsp;&nbsp;Alternate Number:<span id='error'>*</span></td>
												<td>
														<input placeholder="Alternate Number" class='postleft filed_empty' type="number"  type="number" name="alter_contact_no" maxlength="10" id='alter_contact_no' ng-model='alter_contact_no'>
														<br><span class='error alter_contact_no'></span>
												</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>

								<tr>

												<td colspan="2">&nbsp;</td>
								</tr>									
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
												<td colspan="4"><h3><u>Emergency Contact Person Details</u></h3></td>											
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
												<td>Name:<span id='error'>*</span></td>
												<td>
														<input placeholder="Name" class='filed_empty' type="text" name="ename" id='ename' ng-model='ename'>
														<br><span class='error alter_contact_no'></span>
												</td>
												<td colspan="2">&nbsp;</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
												<td>Relation to Patient:<span id='error'>*</span></td>
												<td>
														<input placeholder="Relation" class='filed_empty' type="text" name="relation_to_patient" id="relation_to_patient" ng-model="relation_to_patient">
														<br><span class='error relation_to_patient'></span>
												</td>
												<td colspan="2">&nbsp;</td>
								</tr>
								<tr class="registration_form"><td>&nbsp;</td></tr>
								<tr>
												<td>Contact No:<span id='error'>*</span></td>
												<td>
														<input placeholder="Contact Number" class='filed_empty' type="number" type="number" maxlength="10" name="dregistration" id="e_contact_no" ng-model="e_contact_no">
														<br><span class='error e_contact_no'></span>
												</td>
												<td colspan="2">&nbsp;</td>
								</tr>	 
						</table>
                        <input type="hidden"   value=""  id="networkEditId">
                        <div class="doc-profile-img">
                            <input type="submit" id='patientsubmit' class="btn btn-default card-btn addbutton" name="submit" value="Submit" >
                            <input type="submit" id='patientedit' class="btn btn-default card-btn addbutton" name="submit" value="Edit" >
							</div>
 
                             </div>
                        <!--              <button type="submit" class="btn btn-default">Submit</button>-->
                    </div>          
                </form>


            </div>
        </div>
    </div>
</div>
<!-- Add new row line modal end -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>PATIENT DETAILS</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                       <div class="success-msg-box"><span  id="sucess_msg"></span></div> 
                        <div class="error-msg-box"><span  id="error_msg"></span></div>            <!-- <button  style="float: right;"> Add New Row </button> -->
                        <a data-toggle="modal" onclick='addNewPatient()' data-target="#squarespaceModal" class="pull-right btn btn-default btn-flat addbutton">Add Patient Registraion</a>
                        <!--                        <a id="insert-more" class="pull-right btn btn-default btn-flat">Add New Row</a>-->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
            <div class="tbl-responsive">
                       <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr><td align='center' colspan="9"><span class='delinfo'></span></td></tr>
                                <tr>
                                    <th>S No.</th>
                                    <th>Medical Registration Number</th>
                                    <th>Title</th>
                                    <th>Full Name</th>
                                    <th>Guardian Name</th>
                                    <th>Guardian Relation</th>                                     
                                    <th>Marital Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($response['status'] == 1) {
                                    $data = $response['response']['patientData'];                                    
                                    $c = 1;
                                    foreach ($data as $key => $val) {
                                        ?>


                                        <tr id="networkhosp<?php echo $val['id'] ?>">
                                            <td><span  ><?php echo $c; ?></span></td>
                                            <td><span class="edit1" ><?php echo $val['medicalRegistrationNumber']; ?></span></td>
                                            <td><span class="edit1"><?php echo $val['title']; ?></span></td>
                                            <td><span class="edit1"><?php echo $val['firstName']." ".$val['middleName']." ".$val['lastName']; ?></span></td>
                                            <td><span class="edit1"><?php echo $val['guardianName']; ?></span></td>
                                            <td><span class="edit1"><?php echo $val['guardianRelation']; ?></span></td>
                                             <td><span class="edit1"> <?php echo $val['maritalStatus']; ?></span></td>
                                              <td><span class="edit1"><?php if($val['status']==0){ echo "In Active "; }else{ echo "Active" ;}  ?></span></td>
                                           
                                            <td><span class="edit1">
                                                    <a data-toggle="modal" title="Edit"   href="" onclick="editPatient(<?php echo $val['id']; ?>)" >
                                                        <i class="glyphicon glyphicon-edit">
                                                        </i></a></span>/
                                                <a title="Delete" id="delete" onclick="deletePatient(<?php echo $val['id']; ?>)"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a></td>

                                        </tr>
										<?php $c ++;
									}
								} ?>
                        </table>

                    </div>
                    </div>
             </div>

            </div>

        </div>

    </section>
    
</div>
<!-- /.content-wrapper -->
<!-- <footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.3.8
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer> -->

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<script type="text/javascript">
var app = angular.module('Hff', []);
app.controller('country', function ($scope, $http) {
    $scope.countries = [300];
    $scope.countrysearch = function () {
        var len = $('#countryid').val();
        if (len.length >= 2)
            search();
    };
    function search() {
        $scope.RandomValue = angular.element('#countryid').val();
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
                if(array.response.countryData[i]!==""){
                    $scope.countries.push(array.response.countryData[i]);
                }
                
                i++;
            }
        }, function myError(response) {
            $scope.err = response.statusText;

        });


    }
    ;
});
app.controller('state', function ($scope, $http) {
    $scope.statesearch = function () {
        var len = $('#stateid').val();
        if (len.length >= 2)
            searchstate();
    };
    function searchstate() {
        // var countryid = angular.element('#country').val();
        // alert($("#country_sugg option").attr('data-id'));
        $scope.RandomValue = angular.element('#stateid').val();
        var val = $('#countryid').val();

        var countryid = $('#country_sugg option').filter(function () {
            return this.value === val;
        }).data('id');

        //alert(countryid)
        if (countryid === undefined || countryid === null) {
            if (country !== null) {
                countryid = country;
            }else{
                countryid = 0;
            }
        }

        $scope.states = [];
        $scope.states = [100];
        $http({
            method: "post",
            url: site_url + 'api/web/v1/State/statesByCountry',
            data: $.param({
                name: $scope.RandomValue,
                id: countryid
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}

        }).then(function (response, status) {
            var state_res = response.data;
            var len = Object.keys(state_res.response.stateData).length;
            ///console.log(len);
            var i = 0;
            while (i <= len) {
                ///console.log(state_res.response.stateData[i]);
                if(state_res.response.stateData[i]!==""){
                    $scope.states.push(state_res.response.stateData[i]);
                }
                i++;
            }
            //console.log($scope.states);

        }, function myError(response) {
            $scope.err = response.statusText;

        });

    }
    ;
});
app.controller('city', function ($scope, $http) {
    $scope.citysearch = function () {
        var len = $('#cityid').val();
        if (len.length >= 2)
            searchcity();
    };
    function searchcity() {


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
            
        $scope.RandomValue = angular.element('#cityid').val();

        $scope.cities = [];
        $http({
            method: "post",
            url: site_url + 'api/web/v1/City/citiesByState',
            data: $.param({
                name: $scope.RandomValue,
                id: stateid
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {

            var city_res = response.data;

            var len = Object.keys(city_res.response.cityData).length;
            var i = 0;
            while (i <= len) {
                if(city_res.response.cityData[i]!==""){
                    $scope.cities.push(city_res.response.cityData[i]);
                }                
                i++;
			}
        }, function myError(response) {
            $scope.err = response.statusText;
		});
    };
});
app.controller('language', function ($scope, $http) {

    $scope.searchlang = function () {
        var lan = angular.element('#language').val();
        $scope.languages = [300];
        $http({
            method: "post",
            url: site_url + 'api/web/v1/Language/searchLanguage',
            data: $.param({
                name: lan,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {

            var lang_res = response.data;

            var len = Object.keys(lang_res.response.languageData).length;
            var i = 0;
            while (i <= len) {
                if(lang_res.response.languageData[i]!==""){
                    $scope.languages.push(lang_res.response.languageData[i]);
                }
                
                i++;
            }

        }, function myError(response) {
            $scope.err = response.statusText;
        });
    };
});
</script>


 

