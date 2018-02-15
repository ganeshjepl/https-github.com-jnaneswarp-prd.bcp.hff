<link rel="stylesheet" href="<?php echo $ctrl_css_path?>jquery-ui<?php echo $ctrl_css_ext?>">
<script src="<?php echo $ctrl_js_path.'jquery-ui'.$ctrl_js_ext?>"></script>
<script src="<?php echo $ctrl_js_path.'angularjs'.$ctrl_js_ext?>"></script>
<style type="text/css">
    /* Safari only */
html:lang(en)>body {display: none;} 
</style>


<script src="<?php echo $ctrl_js_path.'Doctor_data'.$ctrl_js_ext?>"></script>
<script>
    $(document).ready(function(){
    $("#signupdate").datepicker({
        dateFormat: 'yy-mm-dd'

     });
 });
</script>
<style>
    .multiselect-container{    
    max-height: 135px;
    overflow-y: scroll;
    }
</style>
<script type="text/javascript">
$(function() {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});
</script>
<!-- Content Wrapper. Contains page content -->
<?php

$bcp     = $bcp['response']['userData'] ;
?>

<!-- Content Wrapper. Contains page content -->

<!-- Add new row line modal start -->
<div ng-app="Hff">
<div class="modal fade add-row-box " id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog2">
        <div class="modal-content">
            <div class="modal-header addbuttonheader">
                <button type="button" class="close addbutton" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Add New Doctor</h3>
            </div>
             <div class="success-msg-box" id="doctor_sucess"> </div>
            <div class="error-msg-box" id="doctor_error"> </div>
            <div class="modal-body card">

                <!-- content goes here -->
                <form id='doctorsubmit' novalidate enctype="multipart/form-data">

                    <input type='text' id='doctorid' name='doctorid' value="" hidden>

                    <div ng-app="Hff">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-container" id="uname">
                                    <input type="text" id="username" name='username' required="required" class='rmv'>
                                    <label for="#{username}">Enter User Name</label>
                                    <span class="error-msg-box error-span" id='usernameerr'>
                                    
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6" id="mail">
                                <div class="input-container">
                                    <input type="text" id="email" name='email' required="required" class='rmv'>
                                    <label for="#{dosage}">Enter Email ID</label>
                                    <span class="error-msg-box error-span " id='emailerr'>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="pass">

                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="password" id="password" name='password' required="required"  class='rmv'>
                                    <label for="#{password}">Enter Password</label>
                                    <span class="error-msg-box error-span" id='passworderr'>                                    
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="password" id="confpassword" name='password' required="required"  class='rmv'>
                                    <label for="#{password}">Confirm Password</label>
                                    <span class="error-msg-box error-span" id='confpassworderr'>
                                    </span>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id="fname" name='fname' required="required"  class='rmv'>
                                    <label for="#{fname}">Enter First Name</label>
                                    <span class="error-msg-box error-span" id='fnameerr'>                                    
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id='lname' name='lname' required="required" class='rmv'>
                                    <label for="#{lname}">Last Name</label>
                                    <span class="error-msg-box error-span" id='lnameerr'>                                    
                                    </span>
                                </div>
                            </div>  
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                                              
                                 <div class="funkyradio col-md-6 funkyradio-left">
                                    <div class="funkyradio-default">
                                        <input type="radio" name="radio" id="radio1" value="male" />
                                        <label for="radio1">Male</label>
                                    </div>
                                 </div>
                                <div class="funkyradio col-md-6 funkyradio-right">
                                    <div class="funkyradio-default">
                                        <input type="radio" name="radio" id="radio2" value="female"/>
                                        <label for="radio2">Female</label>
                                    </div>
                                 </div>
                                <span class="error-msg-box error-span" id='gendererr'>                                 
                                    </span>
                            
                            </div>

                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id="signupdate" name='signupdate' required="required" class='rmv' value="<?php echo date('Y-m-d'); ?>">
                                    <label for="#{signupdate}">Enter Sign Up Date</label>
                                    <span class="error-msg-box error-span" id='signupdateerr'>
                                    </span>
                                </div> 
                                
                            </div>  
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id="contact" name='mobile' required="required" class='rmv'>
                                    <label for="#{mobile}">Enter Contact Number</label>
                                    <span class="error-msg-box error-span" id='contacterr'>
                                    </span>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id="altcontact" name='alternate_contact_number' required="required" class='rmv'>
                                    <label for="#{altcontact}">Enter Alt Number</label>
                                    <span class="error-msg-box error-span" id='altcontacterr'>
                                    </span>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-container" ng-controller="country" >
                                    <input type="text" list="country_sugg" class='rmv' id="countryid" autocomplete="off" name='countryid' required="required" ng-model="query" ng-keyup="countrysearch()" value="{{country.id}}">
                                    <datalist id="country_sugg" ng-show="query">
                                        <option  ng-repeat="country in countries| filter:query" data-id="{{country.id}}">{{country.name}} </option>
                                    </datalist>
                                    <label for="#{country}">Enter Country</label>
                                    <span class="error-msg-box error-span" id='countryerr'>
                                    </span>
                                </div>  
                                
                            </div>    

                            <div class="col-md-6">
                                <div class="input-container" ng-controller="state">
                                    <input type="text" list='state_sugg' id="stateid" class='state' name='stateid' autocomplete="off" required="required" ng-model="squery" ng-keyup="statesearch()"  class='rmv'>
                                    <datalist id="state_sugg" ng-show="query">
                                        <option ng-repeat="state in states| filter:squery" data-id="{{state.id}}">{{state.name}} </option>
                                    </datalist>
                                    <label for="#{state}">Enter State</label>
                                    <span class="error-msg-box error-span" id='stateerr'>
                                    </span>
                                </div> 
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6"  >
                                <div class="input-container" ng-controller="city">
                                    <input type="text" list="city_sugg" id="cityid" class='rmv' name='cityid' autocomplete="off" required="required" ng-model="cquery" ng-keyup="citysearch()">
                                    <datalist id="city_sugg" ng-show="query">
                                        <option ng-repeat="city in cities| filter:cquery" data-id="{{city.id}}">{{city.name}} </option>
                                    </datalist>                                            
                                    <label for="#{city}">Enter City</label>
                                    <span class="error-msg-box error-span" id='cityerr'>
                                    </span>
                                </div> 
                            </div>

                            <div class="col-md-6">
                                 <div class="input-container">
                                    <input type="text" id="pincode" name='pincode' required="required" class='rmv'>
                                    <label for="#{pincode}">Enter Pin Code</label>
                                    <span class="error-msg-box error-span" id='pincodeerr'>
                                    </span>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-container"  ng-controller="language">
                                    <input type="text" list="lang_sugg" class='rmv' id="language" name='languageid' autocomplete="off" required="required" ng-model="cquery" ng-keyup="searchlang()"/>
                                    <datalist id="lang_sugg" ng-show="query">
                                        <option ng-repeat="language in languages| filter:cquery" data-id="{{language.id}}">{{language.name}} </option>
                                    </datalist> 
                                    <label for="#{language}">Enter Language</label>
                                    <span class="error-msg-box error-span" id='languageerr'>
                                    </span>
                                </div> 
                            </div>

                            <div class="col-md-6">                            
                                <div class="form-group">
                            <label class="control-label bcp-label" for="rolename" style="text-align: right;">BCP Asignment</label>
                            <div class="" id="bcpassigndiv">
                                <select id="bcpassign" class="multiselect-ui form-control" multiple="multiple">
                                     <?php

                                        if (is_array($bcp) && count($bcp) > 0) {

                                            foreach ($bcp as $key => $val) {
                                                ?>  
                                                <option value="<?php echo $val['id'] ?>"><?php echo $val['username'] ?></option>

                                            <?php }
                                        }else{
                                            ?>
                                                <option>No Assignments</option>
                                                <?php
                                        } ?>
                                </select>
                            </div>
                        </div>
                            </div>


                        </div>




                        


                        <div class="row">
                            <div class="col-md-6">
                                <div class="doc-profile-img">
                                    <div class="doc-file-label">Upload Photo</div>
                                    <img src="<?php echo $ctrl_images; ?>profile.jpg" id="imagePreview" name='imagePreview' class="doc-img" alt="Preview Image"/>
                                    
                                </div>
                                <div class="doc-profile-img">
                                    <input type="file" class='rmv file-opacity' onchange="$('#upload-file-info').val($(this).val().replace(/C:\\fakepath\\/i, ''));" name='profilePicture' id="imageUpload" /> 
                                    <label for="imageUpload" class="btn btn-large doc-upload-btn addbutton"><span class="glyphicon glyphicon-upload"></span> Upload</label>
                                    <input type="text" class="form-control upload-img-name" id="upload-file-info">
                                </div>

                                <span class='error-msg-box error-span' id='profileimgerr'></span>
                            </div>


                            <div class="col-md-6">
                                <div class="doc-profile-img">
                                    <div class="doc-file-label">Upload Sign</div>
                                    <img src="<?php echo $ctrl_images; ?>profile.jpg" id="signimagePreview" class="doc-img" alt="Preview Image"/>
                                    

                                </div>
                                <div class="doc-profile-img">
                                    <input type="file"  class='rmv file-opacity' onchange="$('#upload-file-info-sign').val($(this).val().replace(/C:\\fakepath\\/i, ''));" id="signimageUpload" name='signimageUpload' /> 
                                    <label for="signimageUpload" class="btn btn-large doc-upload-btn addbutton"><span class="glyphicon glyphicon-upload"></span> Upload</label>
                                    <input type="text" class="form-control upload-img-name" id="upload-file-info-sign" >

                                </div>
                                <span class='error-msg-box error-span' id='signimgerr'></span>
                            </div>
                        </div>


                        <div class="doc-profile-img">
                            <button type="submit" id="submit" class="btn btn-default btn-bg addbutton">Submit</button>
                        </div>
                        <!--                            <button type="button" class="btn btn-default card-btn">Cancle</button>-->

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Add new row line modal end -->



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>DOCTOR<small></small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                       <!-- <h3 class="box-title">DOCTOR DATA</h3> --> <div class="success-msg-box"><span  id="sucess_msg"> </span></div> 
                      <div class="error-msg-box"><span  id="error_msg">  </span></div> 
                        <a data-toggle="modal" data-target="#squarespaceModal" onclick="adddoctor()" class="pull-right btn btn-default btn-flat addbutton">Add New Doctor</a>
                    </div>
                    <!-- /.box-header -->
                    
                    <div class="box-body">
                    <div class="tbl-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>User Name</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($list) && count($list) > 0) {
                                    $i=1;
                                    foreach ($list as $key => $val) {
                                        ?>
                                        <tr id="doctordelete<?php echo  $val['id']  ?>" >
                                            <td><span class="edit1"><?php echo $i ?></span></td>
                                            <td><span class="edit1" id='<?php echo $val['id'] ?>'><?php echo $val['username'] ?></span></td>
                                            <td><span class="edit1" id='<?php echo $val['id'] ?>_2'><?php echo $val['firstName'] ?></span></td>
                                            <td><span class="edit1" id='<?php echo $val['id'] ?>_3'><?php echo $val['lastName'] ?></span></td>
                                            <td><span class="edit1" id='<?php echo $val['id'] ?>_4'><?php echo $val['email'] ?></span></td>
                                            <td><span class="edit1" id='<?php echo $val['id'] ?>_5'><?php echo $val['country_name'] ?></span></td>
                                            <td><span class="edit1" id='<?php echo $val['id'] ?>_6'><?php echo $val['mobile'] ?></span></td>
                                            <td><a data-toggle="modal" title="Edit"   href="" onclick='editDoctor(<?php echo $val['id'] ?>)'>
                                                <i class="glyphicon glyphicon-edit"></i>
                                                </a> / <a title="Delete" onclick='deleteDoctor(<?php echo $val['id'] ?>)'><i class="glyphicon glyphicon-remove-circle text-danger"></i></a></span></td>
                                        </tr>
                                    <?php $i++;}
                                    
                                } ?>



                            </tbody>

                        </table>
                    </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
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
</div>
<!-- ./wrapper -->

<script type="text/javascript">
   // var bcpIds = <?php //echo json_encode($bcp) ?>;
    
     function editDoctor(id){
    $('#squarespaceModal').modal('show');
    $('#lineModalLabel').html('Edit Doctor');
    $('.error-msg-box').text('');
     $('.rmv').removeClass('adminred');
    $(".multiselect-container li").find('input[type=checkbox]').prop('checked', false);
       $.ajax({
            url:site_url + 'api/web/v1/ctrl/doctor/getDoctor',
            type: 'GET',
            data:{"id": id },           
            success: function(json){ 
           
         var userData = json['response']['userData'];
         var bcpData = json['response']['bcp'];
         
         if(bcpData!=0){
          var size = bcpData.length;
           
              for(var i=0; i < size; i++){
                  $('.multiselect-selected-text').html(size +' selected ');
                  $(".multiselect-container li").find('input[type=checkbox][value='+bcpData[i]+']').prop('checked', true);
                }
            } else{
                $('.multiselect-selected-text').html('None selected '); 
                $(".multiselect-container li").find('input[type=checkbox]').prop('checked', false);
            } 
        
        // $.each(userData , function( key, val ) {
             
             $('#doctorid').val(userData[0]['id']);
             $('#username').val(userData[0]['username']);
             $('#uname').hide();
             $('#pass').hide();
             $('#mail').addClass('col-md-12');
             $('#mail').removeClass('col-md-6');             
             $('#fname').val(userData[0]['firstName']);
             $('#lname').val(userData[0]['lastName']);
             if(userData[0]['gender']!=''){
             $("input:radio[value="+userData[0]['gender']+"]").attr('checked', 'checked');
             }
             $('#email').val(userData[0]['email']);
             $('#contact').val(userData[0]['mobile']);
             $('#altcontact').val(userData[0]['alternate_contact_number']);
             $('#signupdate').val(userData[0]['signupdate']);
              $('#language').val(userData[0]['language_name']);
             $('#countryid').val(userData[0]['country_name']);
             $('#stateid').val(userData[0]['state_name']);
             $('#cityid').val(userData[0]['city_name']);
             $('#signupdate').val(userData[0]['signupdate']);
             $('#pincode').val(userData[0]['pincode']);
             
             if((userData[0]['profile_picture']!='')&&(userData[0]['profile_picture']!=null)){
                  
                  var imgurl = userData[0]['profile_picture'];
                  $('#imagePreview').attr('src',imgurl);
              }else{
                   var imgurl = imgs+"profile.jpg"
                   $('#imagePreview').attr('src',imgurl);
                 
              }
              
              if((userData[0]['signature_picture']!='')&&(userData[0]['signature_picture']!=null)){
                  var imgurl = userData[0]['signature_picture'];
                  $('#signimagePreview').attr('src',imgurl);
              }else{
                   var imgurl = imgs+"profile.jpg"
                   $('#signimagePreview').attr('src',imgurl);
                 
              }
              
             country=userData[0]['countryid'];
             state= userData[0]['stateid'];
             city=userData[0]['cityid'];
             language =1;
        //  }); 
              
              
         }    ,
            error: function (xhr, status, error) {
                console.log(" xhr.responseText: " + xhr.responseText + " //status: " + status + " //Error: " + error);
            }

        });
    }
    //image upload for doctor profile image
    $('#imageUpload').change(function () {
        readImgUrlAndPreview(this);
        function readImgUrlAndPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').attr('src', e.target.result);
                }
            }
            ;
            reader.readAsDataURL(input.files[0]);
        }
    });

    //image upload for doctor sign image
    $('#signimageUpload').change(function () {
        readImgUrlAndPreview(this);
        function readImgUrlAndPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#signimagePreview').attr('src', e.target.result);
                }
            }
            ;
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>


