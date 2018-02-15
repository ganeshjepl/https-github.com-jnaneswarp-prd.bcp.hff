<link rel="stylesheet" href="<?php echo $doc_css_path; ?>bcp<?php echo $doc_css_ext; ?>">
<link rel="stylesheet" href="<?php echo $doc_css_path; ?>jquery-ui<?php echo $doc_css_ext; ?>">

<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script> -->
 
  <?php  
   $dob='';
   $education='';
   $gender='';
   if(array_key_exists('dob', $profileData[0]))
    {
    $dob= $profileData[0]['dob'];
    }
    if(array_key_exists('gender', $profileData[0])){
     $gender= $profileData[0]['gender'];
     }
   if(array_key_exists('education', $profileData[0])){
     $education= $profileData[0]['education'];
     }
   ?>
<script>
    var country_id ='<?php echo  $profileData[0]['countryid']?>';
     var state_id ='<?php echo  $profileData[0]['stateid']?>';
      var city_id ='<?php echo  $profileData[0]['cityid']?>';
      var gender ='<?php echo  $gender?>';
      var education ='<?php echo  $education?>';
      var dob ='<?php echo $dob?>';
      var country ='<?php echo  $profileData[0]['country_name']?>';    
      var state ='<?php echo  $profileData[0]['state_name']?>';
      var city ='<?php echo  $profileData[0]['city_name']?>';
</script>
<script src='<?php echo $doc_js_path;?>Doctor_edit<?php echo $doc_js_ext;?>'></script>
 <script src='<?php echo $doc_js_path;?>jquery-ui<?php echo $doc_js_ext;?>'></script>

	
   <div class="maindiv profile-page" ng-app="Doctor">
       <form name="myform" action="EditProfile" method="post" novalidate="" id="doctorEdit">
      <div class="container mrgtop50">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
               <div class="panel panel-info">
                  <div class="panel-heading">
                      <h5 class="blc">Edit Profile <!-- <span class="docgreen" id="success_msg"></span>--></h5>
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-md-3 col-lg-3 doc-img-upload">
                           <div class="">
                              <div class="panel panel-default">
                                 <div class="panel-heading"><strong>Upload Photo</strong> <small> </small></div>
                                 <div class="panel-body">
                                    <div class="preview-img-box">
                                       <img src="<?php if($profileData[0]['profile_picture'] != '') echo $profileData[0]['profile_picture'];  else  echo $doc_images.'profile.jpg'; ?>" id="imagePreview" class="doc-img" alt="Preview Image"/>
                                    </div>
                                    <div class="img-btn-box">
                                       
                                       <input type="file" name="profilePicture" onchange="$('#upload-file-info').val($(this).val().replace(/C:\\fakepath\\/i, ''));" id="imageUpload" class="file-opacity"/> 
                                       <label for="imageUpload" class="btn btn-large"><span class="glyphicon glyphicon-upload"></span> Upload</label>
                                       <input type="text" class="form-control upload-img-name" id="upload-file-info">
                                    </div>
                                 </div>
                                 <span id='profileimgerr' class="text-danger mrglft30"></span>
                              </div>
                               
                           </div>
                           <div class="">
                              <div class="panel panel-default">
                                 <div class="panel-heading"><strong>Upload Sign</strong> <small> </small></div>
                                 <div class="panel-body">
                                    <div class="preview-img-box">
                                       <img src="<?php if($profileData[0]['signature_picture'] != '') echo $profileData[0]['signature_picture'];  else  echo $doc_images.'defaut-sign.png'; ?>" id="signimagePreview" class="doc-img" alt="Preview Image"/>
                                    </div>
                                    <div class="img-btn-box">
                                       
                                       <input type="file" name="signaturePicture" onchange="$('#upload-file-info-sign').val($(this).val().replace(/C:\\fakepath\\/i, ''));" id="signimageUpload" class="file-opacity"/> 
                                       <label for="signimageUpload" class="btn btn-large"><span class="glyphicon glyphicon-upload"></span> Upload</label>
                                       <input type="text" class="form-control upload-img-name" id="upload-file-info-sign" >
                                    </div>
                                 </div>
                                 <span id='signimgerr' class="text-danger mrglft30"></span>
                              </div>
                           </div>
                        </div>
                        <div class=" col-md-9 col-lg-9 ">
                            
                              <table class="table table-user-information">
                                 <tbody>
                                    <tr>
                                       <td>First Name</td>
                                       <td>
                                          <input id="firstName" class="form-control logininput" name="fname" type="text" value="<?php echo $profileData[0]['firstName']; ?>">
                                          <span id="error_fname" class="text-danger"></span>
                                       </td>
                                    </tr>
									 <tr>
                                       <td>Last Name</td>
                                       <td>
                                          <input id="lastName" class="form-control logininput" name="lname" required type="text" value="<?php echo $profileData[0]['lastName']; ?>">
                                          <span id="error_lname" class="text-danger"></span>
                                       </td>
                                    </tr>
<!--                                    <tr>
                                       <td>Profession</td>
                                       <td><input id="Profession" class="form-control logininput" name="profession" required type="text" value="">
                                          <span id="error_Profession" class="text-danger"></span>
                                       </td>
                                    </tr>-->
                                    <tr>
                                       <td>Phone Number</td>
                                       <td><input id="landline" class="form-control logininput" name="landline" required type="text" value="<?php echo $profileData[0]['mobile']; ?>">
                                          <span id="error_landline" class="text-danger"></span>
                                          <br>
                                          <input id="mobile" class="form-control logininput" name="mobile" required type="text" value="">
                                          <span id="error_mobile" class="text-danger"></span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Email</td>
                                       <td><input id="email" class="form-control logininput" name="email" required type="text" value="<?php echo $profileData[0]['email']; ?>">
                                          <span id="error_email" class="text-danger"></span>
                                       </td>
                                    </tr>
                                    <tr>
                                        <td>Home Address</td>
                                       <td><div ng-controller="country" ng-model="query">                                         
                                           <input type="text" list="country_sugg" id="countryid" class='rmv form-control logininput' name='countryid' autocomplete="off"  ng-model="query" ng-keyup="countrysearch()" value="{{country.id}}">
                                                <datalist id="country_sugg" ng-show="query">
                                                    <option  ng-repeat="country in countries| filter:query" data-id="{{country.id}}">{{country.name}} </option>
                                                </datalist>
                                          <span id="error_address1" class="text-danger"></span>
                                          <br></div>
                                           <div ng-controller="state" ng-model="query">
                                          <input type="text" list="state_sugg" id="stateid" class='rmv form-control logininput' name='stateid' autocomplete="off"  ng-model="query" ng-keyup="statesearch()" value="{{state.id}}">
                                    <datalist id="state_sugg" ng-show="query">
                                        <option  ng-repeat="state in states| filter:query" data-id="{{state.id}}">{{state.name}} </option>
                                    </datalist>
                                          <span id="error_address2" class="text-danger"></span><br>
                                          </div>
                                           
                                           <div ng-controller="city" ng-model="query">
                                          <input type="text" list="city_sugg" id="cityid" class='rmv form-control logininput' name='cityid' autocomplete="off" ng-model="query" ng-keyup="citysearch()" value="{{city.id}}">
                                    <datalist id="city_sugg" ng-show="query">
                                        <option  ng-repeat="city in cities| filter:query" data-id="{{city.id}}">{{city.name}} </option>
                                    </datalist>
                                          <span id="error_address2" class="text-danger"></span>
                                          </div>
                                           
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Date of Birth</td>
                                       <td><input id="dob" class="form-control logininput " name="dob" type="text" value="<?php echo $dob ?>">
                                          <span id="error_dob" class="text-danger"></span>
                                       </td>
                                    </tr>
                                    <tr>
                                    <tr>
                                       <td>Gender</td>
                                       <td>
                                          <select id="gender" name="gender" class="form-control logininput">
                                             <option value="" >select</option>
                                             <option value="male">Male</option>
                                             <option value="female">Female</option>
                                          </select>
                                          <span id="error_gender" class="text-danger"></span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Education</td>
                                       <td><input id="education" name="education" class="form-control logininput" type="text" value="<?php echo $education ?>">
                                          <span id="error_education" class="text-danger"></span>
                                       </td>
                                    </tr>
<!--                                    <tr>
                                       <td>Work Experience</td>
                                       <td><input id="work1" class="form-control logininput" required type="text" value="Sr.Doctor">
                                          <span id="error_work1" class="text-danger"></span> <br>
                                          <input id="work2" class="form-control logininput" required type="text" value="Current">
                                          <span id="error_work2" class="text-danger"></span><br>
                                          <input id="work3" class="form-control logininput" required type="text" value="Sr.Doctor">
                                          <span id="error_work3" class="text-danger"></span><br>
                                          <input id="work4" class="form-control logininput" required type="text" value="Mar 2012 - Dec 2014">
                                          <span id="error_work4" class="text-danger"></span><br>
                                       </td>
                                    </tr>-->
                                 </tbody>
                              </table>
							   <input type="hidden" value="<?php echo $userid; ?>" name="userid">
                              <button id="submit" type="submit" name="save" value="submit" class="btn editbutton">Submit</button>
                              <a href="<?php echo getUrl('doctorProfile')?>" class="btn editbutton">Cancel</a>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
   </div>

   <script type="text/javascript">
	   
      //image upload for doctor profile image
        $('#imageUpload').change(function(){      
          readImgUrlAndPreview(this);
          function readImgUrlAndPreview(input){
             if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function (e) {                    
                          $('#imagePreview').attr('src', e.target.result);
                  }
                    };
                    reader.readAsDataURL(input.files[0]);
               }  
        });
      
      //image upload for doctor sign image
        $('#signimageUpload').change(function(){      
          readImgUrlAndPreview(this);
          function readImgUrlAndPreview(input){
             if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function (e) {                    
                          $('#signimagePreview').attr('src', e.target.result);
                  }
                    };
                    reader.readAsDataURL(input.files[0]);
               }  
        });
      $(document).ready(function(){
      $('#dob').datepicker({
      dateFormat:'yy-mm-dd',
      maxDate: new Date(),
      yearRange: 'c-100:c+10',
      changeMonth: true,
      changeYear: true
    });
    });
	   
   </script>


