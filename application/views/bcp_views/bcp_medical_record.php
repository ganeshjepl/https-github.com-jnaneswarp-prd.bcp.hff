    
    <!--------Header--------->
    <?php $this->load->view('bcp_views/bcp_header'); ?>
    <!----------------------->
    

 <script></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>


 <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css">
 <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
 var site_url='<?php echo site_url();?>';
 
 $(function() {
    
    $( "#datepicker" ).datepicker({  maxDate: new Date(), dateFormat: 'yy-m-dd',
        onSelect: function(datetext){
            var d = new Date(); // for now
            var h = d.getHours();
            h = (h < 10) ? ("0" + h) : h ;

            var m = d.getMinutes();
            m = (m < 10) ? ("0" + m) : m ;

            var s = d.getSeconds();
            s = (s < 10) ? ("0" + s) : s ;

          datetext = datetext + " " + h + ":" + m + ":" + s;
           $('#datepicker').val(datetext);
           
        }
    });
     
    $('#datepickerdob').datepicker({
    onSelect: function(value) {
        var today = new Date(), 
            dob = new Date(value), 
            age = new Date(today - dob).getFullYear() - 1970;
        
        $('#age').val(age);
        $("#age").css("border-color", "#2eb82e");
        $("#ageerr").text("");
        $("#datepickerdob").css("border-color", "#2eb82e");
        $("#doberr").text("");
    },
    maxDate: '+0d',
    dateFormat:'yy-mm-dd',
    yearRange: '-100:+1',
    changeMonth: true,
    changeYear: true
});
var dob = new Date(dob);
var today = new Date();
var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
$('#age').html(age+' years old');

var d = new Date(); // for now
            var yy=d.getFullYear();
            var mm=d.getMonth()+1;
            var dd=d.getDate();
            var h = d.getHours();
            h = (h < 10) ? ("0" + h) : h ;

            var m = d.getMinutes();
            m = (m < 10) ? ("0" + m) : m ;

            var s = d.getSeconds();
            s = (s < 10) ? ("0" + s) : s ;

         var datetext = yy+"-"+mm+"-"+dd+ " " + h + ":" + m + ":" + s;
        
             $('#datepicker').val(datetext);
         });
 
 
 var country='<?php print_r($_SESSION['country']);?>';
 var countryids='<?php print_r($_SESSION['countryid']);?>';
 var state='<?php print_r($_SESSION['state']);?>';
 var stateid='<?php print_r($_SESSION['stateid']);?>';
 var city='<?php print_r($_SESSION['city']);?>';
 var cityid='<?php print_r($_SESSION['countryid']);?>';
$("#country").val(country);
$('#count').data('data-id',countryids);
$("#state").val(state);
$('#stategt').data('data-ids',stateid);
$("#city").val(city);
$('#citygt').data('data-idss',cityid); 
console.log('hey');
 </script>
    <script src="<?php echo site_url(); ?>js/medical_record.js"></script> 
    <script src='<?php echo site_url(); ?>js/patient_reg.js'></script>

    <!-- <link href="multiple-select.css" rel="stylesheet"/>-->

    <script src="<?php echo site_url(); ?>js/multiselect.js"></script>
        
    <!--------Left Menu--------->
    <?php $this->load->view('bcp_views/bcp_leftmenu'); ?>
    <!-------------------------->
    
        <div class="mrgtp" id='primary'>
             
            <div id="pagedata"></div>         
            
            <div class="button">
                <center class="butpad">
                    <a>
                        <button class="btn btn-lg btn-signin widt20" id="next" 
                                >Next</button></a>
                </center>
            </div>
            
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog w3-animate-top w3-card-8">

                    <!--  Modal content -->
                    <div class="modal-content animate-top card-8">
                        <div class="w3-container w3-teal w3-center w3-padding-32">
                            <span data-dismiss="modal" onclick="document.getElementById('myModal').style.display = 'none'" 
                                  class="w3-closebtn w3-padding-xlarge w3-xxlarge w3-display-topright">x</span>
                            <h4 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Network of Hospitals</h4>
                        </div>
                        <div class="modal-body" id="hospitalsList">
                           
                        </div>
                        <div class="modal-footer">

                            <a  class="w3-left w3-teal w3-btn" href="bcp_patient_identifier.html">Submit</a>

                            <button type="button" class="w3-right w3-btn w3-red" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>    
    
                <div id="new_reg"> <!-- add g -->
                    
                	<div class="mrgtp">
<div class="container width70">
    <span class="disp-error-patient" id="commonerr"></span>
            <form class="form-horizontal" id="form">
               
                <div class="form-group">
                    <div class="col-sm-6">
                    
                        <button onclick="switchView()" 
                                class="btn btn-lg btn-signin widt30">Previous</button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class=" col-sm-3">Date of Registration<span class="disprequired" id="req_regdate"></span></label>
                    <div class="col-sm-3">
                        <input type="text" id="datepicker" placeholder="Date of registration" 
                               class="form-control logininput">
                        
                         <span class="disp-error-patient" id="dateerr"></span>
                    </div>
                        
                    <label class=" col-sm-1"></label>  
                    <label class="txtlft col-sm-2 lft">MR NO.:</label>               
                        <label class=" col-sm-3 col-lg-3 col-md-3 col-xs-3 redtext padleft lft">MR/DND/BCP/1000/1000</label>
                </div>
                

                <div class="form-group">
                    <label class=" col-sm-3">Salutation<span class="disprequired" id="req_salute"></span></label>
                    <div class="col-sm-6">
                        <select class="form-control logininput" id="salute">
						<option value="" >Select</option>
						<option value="mr" >Mr</option>
						<option value="mrs" >Mrs</option>
						<option value="miss">Miss</option>
					</select>
                        <span class="disp-error-patient" id="saluteerr"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class=" col-sm-3">First Name<span class="disprequired" id="req_fname"></span></label>
                   
                    <div class="col-sm-9">
                        <input type="text" id="fname" placeholder="First Name" class="form-control logininput">
                        <span class="disp-error-patient" id="fnameerr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3">Middle Name</label>
                    <div class=" col-sm-9">
                        <input type="text" id="mname" placeholder="Middle Name" class="form-control logininput">
                        <span class="disp-error-patient" id="mnameerr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class=" col-sm-3">Last Name<span class="disprequired" id="req_lname"></span></label>
                    <div class="col-sm-9">
                        <input type="text" id="lname" placeholder="Last Name" class="form-control logininput">
                        <span class="disp-error-patient" id="lnameerr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class=" col-sm-3">Guardian</label>
                    <div class="col-sm-6">
                        <input type="text" id="guardianname" placeholder="Guardian Name" class="form-control logininput">
                        <span class="disp-error-patient" id="gnameerr"></span>
                    </div>
                    <div class="col-xs-12 hidden-lg hidden-md hidden-sm">&nbsp;</div>
                    <div class="col-sm-3">
                        <select class="form-control logininput" id="relation">
                            <option value="" selected="">Relation</option>
						<option value="father" >Father</option>
						<option value="mother">Mother</option>
						<option value="husband">Husband</option>
						<option value="other">Others</option>
					</select>
                        <span class="disp-error-patient" id="relationerr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3">Date of Birth</label>
                    <div class="col-sm-6">
                        <input type="text" id="datepickerdob" value="" name="dob" placeholder="Date of Birth" class="form-control logininput">
                        <span class="disp-error-patient" id="doberr"></span>
                    </div>
                    <div class="col-xs-12 hidden-lg hidden-md hidden-sm">&nbsp;</div>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Age" id="age" class="form-control logininput">
                        <span class="disp-error-patient" id="ageerr"></span>
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="col-sm-3">Gender</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                
                                   <!--RADIO 1-->
         
                                   <input type="radio" class="radio_item" value="male" name="item" id="radio1">
        <label for="radio1" > <img src="<?php echo site_url()."/pics/male.png"; ?>"
                                   class="genderimg" />&nbsp;Male</label> 
    
                                   
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                
                                 <!--RADIO 2-->
    <input type="radio" class="radio_item" value="female" name="item" id="radio2" >
    <label for="radio2"> <img src="<?php echo site_url()."/pics/female.png"; ?>" class="genderimg" />&nbsp;Female</label>
    
                                    <!-- <input type="radio" id="maleRadio" value="gender" name="gender">Male
                                    <img src="pics/men.png" alt="Lights" class="genderimg"> -->
                                </label>
                            </div>
                            
                        </div>
                        <span class="disp-error-patient" id="gendererr"></span>
                    </div>
                </div> 
                 <div class="form-group col-sm-12" >
                <div class="col-sm-9 paddform">
                <div class="form-group">
                    <label for="email" class="col-sm-4" >Marital Status<span class="disprequired" id="req_marital"></span></label>
                    <div class="col-sm-8 formpad" >
                        <select class="form-control logininput" id="marital"><!-- lesswidth -->
						<option value="">Select Status</option>
						<option value="single">Single</option>
						<option value="married">Married</option>
						<option value="widow">Widow</option>
						<option value="divorced">Divorced</option>
						<option value="separated">Separated</option>
						</select>
                        <span class="disp-error-patient" id="maritalerr"></span>
                    </div>
                    </div>
                    
                 <div class="form-group">
                    <label class="col-sm-4">Caste</label>
                    <div class="col-sm-8 formpad">
                        <input type="text" placeholder="Caste" class="form-control logininput" id="caste">
                        <span class="disp-error-patient" id="casteerr"></span>
                    </div>
                </div>
                
                 <div class="form-group">
                    <label  class="col-sm-4">Religion</label>
                    <div class="col-sm-8 formpad">
                        <input type="text" id="religion" placeholder="Religion" class="form-control logininput">
                        <span class="disp-error-patient" id="religionerr"></span>
                         </div>
                </div>
                
                 <div class="form-group">
                    <label class="col-sm-4">Education</label>
                    <div class="col-sm-8 formpad">
                        <select class="form-control logininput" id="education"><!-- lesswidth -->
						<option value="">Select</option>
						<option value="elementary">Elementry</option>
						<option value="high-school">High School</option>
						<option value="college">College</option>
						<option value="graduation">Graduation</option>
						<option value="post-graduation">Post-Graduation</option>
						<option value="no-education">No-Education</option>
					</select>
                        <span class="disp-error-patient" id="educationerr"></span>
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="col-sm-4">Occupation</label>
                    <div class="col-sm-8 formpad">
                        <input type=text id="occupation" placeholder="Occupation" class="form-control logininput">
                        <span class="disp-error-patient" id="occupationerr"></span>
                    </div>
                </div>
                </div>
                
                <div class="col-sm-3" >
                    <div class=" panelwidth" >


    	<div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 lgpicuploader">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Upload Photo</strong> <small> </small></div>
				<div class="panel-body">
					<!-- /input-group image-preview [TO HERE]--> 
					
				
					
					<!-- Drop Zone -->
					<img id="blah" src="<?php echo site_url()."/pics/profile.jpg"; ?>" alt="your image" class="respimg" />
					<div class="input-group image-preview">
							
						<button type="button" class=" btn btn-primary btn btn-labeled btn-primary mrg10 "> <span class="btn-label"><i class="glyphicon glyphicon-camera"></i> </span>Camera</button>
						<button class="btn btn-default image-preview-input"> <span class="glyphicon glyphicon-upload"></span> <span class="image-preview-input-title">Upload</span>
							<input type="file" onchange="readURL(this);" id="image"  accept="image/png, image/jpeg, image/gif" name="input-file-preview"/>
						</button>
                                                				
                             
						 </div>
			
			</div>
                              <span class="disp-error-patient" id="imageerr"></span>		</div>
	</div>

</div>

<!-- /container --> 
</div>
        </div>        
                
                
<div class="form-group">
                    <label class="col-sm-3 textgreen">Address</label>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3">House/Plot Number<span class="disprequired" id="req_hno"></span></label>
                    <div class="col-sm-9">
                        <input type=text placeholder="House/Plot Number" class="form-control logininput width70" id="hno">
                        <span class="disp-error-patient" id="hnoerr"></span>

                    </div>
                </div>
                
                <div class="form-group">
                   <label class="col-sm-3">Block</label>
                    <div class="col-sm-9">
                        <input type=text id="block" class="form-control logininput width70" placeholder="Block">
                        <span class="disp-error-patient" id="blockerr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3">Street Name/Road Number<span class="disprequired" id="req_street"></span></label>
                    <div class="col-sm-9">
                        <input type=text class="form-control logininput width70"id="street" placeholder="Street Name/Road Number">
                        <span class="disp-error-patient" id="streeterr"></span>

                    </div>
                </div>
                
                <div class="form-group">
                   <label class="col-sm-3">Area/Colony Name<span class="disprequired" id="req_area"></span></label>
                    <div class="col-sm-9">
                        <input type=text class="form-control logininput width70" id="area" placeholder="Area/Colony Name">
                        <span class="disp-error-patient" id="areaerr"></span>
                    </div>
                </div>
                
                
                
                <div class="form-group">
                   <label class="col-sm-3">Village</label>
                    <div class="col-sm-9">
                        <input type=text class="form-control logininput width70" id="village" placeholder="Village">
                        <span class="disp-error-patient" id="villageerr"></span>
                    </div>
                </div>
                <div  ng-app="Hff">
                <div class="form-group">
                   <label class="col-sm-3">Country<span class="disprequired" id="req_country"></span></label>
                   
                   <div class="col-sm-9" ng-controller="country" >
                       <input type="text" list="country_sugg" class="form-control logininput width70" id="country" placeholder="Country" ng-model="query" ng-keyup="search()" value="{{country.id}}"> 
                       <datalist id="country_sugg" ng-show="query">
                           <option id="count"  data-id=""></option>
                           <option  ng-repeat="country in countries  | filter:query" data-id="{{country.id}}">{{country.name}} </option>
                       </datalist>
                 
                        <span class="disp-error-patient" id="countryerr"></span>
                    </div>
                </div>
         
                 <div class="form-group">
                   <label class="col-sm-3">State<span class="disprequired" id="req_state"></span></label>
                    <div class="col-sm-9" id="app" ng-app="Hff" ng-controller="state" >
                       <input type="text" list="state_sugg" class="form-control logininput width70" id="state" placeholder="State" ng-model="squery" ng-keyup="searchstate()"> 
                       <datalist id="state_sugg" ng-show="query">
                           <option id="stategt" data-ids=""> </option>
                           <option ng-repeat="state in states  | filter:squery" data-id="{{state.id}}">{{state.name}} </option>
                       </datalist>
                        <span class="disp-error-patient" id="stateerr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                   <label class="col-sm-3">City<span class="disprequired" id="req_city"></span></label>
                    <div class="col-sm-9" ng-app="Hff" ng-controller="city" >
                       <input type="text" list="city_sugg" class="form-control logininput width70" id="city" placeholder="City" ng-model="cquery" ng-keypress="searchcity()">
                       <datalist id="city_sugg" ng-show="query">
                           <option id="citygt" data-idss=""></option>
                           <option ng-repeat="city in cities  | filter:cquery" data-id="{{city.id}}">{{city.name}} </option>
                       </datalist>
                        <span class="disp-error-patient" id="cityerr"></span>
                    </div>
                </div>            
                
                </div>
                <div class="form-group">
                   <label class="col-sm-3">Pincode</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control logininput width70" id="pincode" placeholder="Pincode">
                        <span class="disp-error-patient" id="pincodeerr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                   <label class="col-sm-3">Contact Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control logininput width70" id="contact" placeholder="Contact number">
                        <span class="disp-error-patient" id="contacterr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                   <label class="col-sm-3">Alternate Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control logininput width70" id="altcontact" placeholder="Alternate Contact number">
                        <span class="disp-error-patient" id="altcontacterr"></span>
                    </div>
                </div>
               <div class="form-group">
                   <label class="col-sm-3">Type of ID</label>
                    <div class="col-sm-9">
                       <select  class="form-control logininput width70" value="" id="typeofid"><!-- lesswidth -->
						<option value="">Select ID</option>
						<option value="adhaar">Adhaar</option>
                                                <option value="pan">PAN</option>
						<option value="voterid">Voter ID</option>
						<option value="others">Others</option>
					</select>
                        <span class="disp-error-patient" id="typeofiderr"></span>
                    </div>
                </div>   
                
                <div class="form-group">
                   <label class="col-sm-3">ID Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control logininput width70" id="idno" placeholder="ID number" disabled="true">
                        <span class="disp-error-patient" id="idnoerr"></span>
                    </div>
                </div>
                
                 <div class="form-group">
                    <label  class="col-sm-3 textgreen">Emergency Contact Person Details	</label>
                </div>
                
                <div class="form-group">
                   <label class="col-sm-3">Name</label>
                    <div class="col-sm-9">
                        <input type=text class="form-control logininput width70" id="emergname" placeholder="Name">
                        <span class="disp-error-patient" id="emergnameerr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                   <label class="col-sm-3">Relation to Patient</label>
                    <div class="col-sm-9">
                        <input type=text class="form-control logininput width70" id="emergrelation" placeholder="Relation to Patient" >
                        <span class="disp-error-patient" id="emergrelationerr"></span>
                    </div>
                </div>
                
                <div class="form-group">
                   <label class="col-sm-3">Contact Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control logininput width70" id="emergcontact" placeholder="Alternate number">
                        <span class="disp-error-patient" id="emergcontacterr"></span>
                    </div>
                </div>
                              
                
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-3">
                    
                        <button type="submit" name="submit" id="submit" type="submit" 
                                class="btn btn-lg btn-signin widt30">Submit</button>
                   
                    </div>
                </div>
                
                 </form> <!-- /form -->
                 
          
        </div> <!-- ./container -->
        </div>
            </div>
        
    <!--------Footer--------->
    <?php $this->load->view('bcp_views/bcp_footer'); ?>
    <!----------------------->