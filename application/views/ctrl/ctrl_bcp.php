<link rel="stylesheet" href="<?php echo $ctrl_css_path?>jquery-ui<?php echo $ctrl_css_ext?>">
<script src="<?php echo $ctrl_js_path.'angularjs'.$ctrl_js_ext?>"></script>
<script src="<?php echo $ctrl_js_path.'jquery-ui'.$ctrl_js_ext?>"></script>
<script>
    $(document).ready(function(){
         
    $("#signupdate").datepicker({
        dateFormat: 'yy-mm-dd'

     });
 });
</script>
  
<!-- Add new row line modal start -->
<div class="modal fade add-row-box " id="bcpModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header addbuttonheader">
                <button type="button" class="close addbutton" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title " id="lineModalLabel">Edit BCP</h3>
            </div>
            <div class="modal-body card">
                  <div class="success-msg-box" id="bcp_sucess"></div>
                  <div class="error-msg-box" id="bcp_error"></div>

                <!-- content goes here -->
                <form id='editbcp_form' novalidate>

                    <input type='text' id='bcpEditid' name='bcpEditid' hidden value="">
                     
                    <div ng-app="Hff">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id="username" name='username' required="required" class='rmv'>
                                    <label for="#{username}">Enter User Name</label>                                   
                                    <span class="error-msg-box error-span" id='usernameerr'>                                    
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id="email" name='email' required="required" class='rmv'>
                                    <label for="#{dosage}">Enter Email ID</label>
                                    <span class="error-msg-box error-span" id='emailerr'>                                    
                                    </span>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id="fname" name='fname' required="required" class='rmv'>
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
                                                                                         
                                 <div class="funkyradio col-md-6">
                                    <div class="funkyradio-default">
                                        <input type="radio" name="radio" id="radio1" value="male" />
                                        <label for="radio1">Male</label>
                                    </div>
                                 </div>
                                <div class="funkyradio col-md-6 funkyradio-right">
                                    <div class="funkyradio-default">
                                        <input type="radio" name="radio" id="radio2" value="female" />
                                        <label for="radio2">Female</label>
                                    </div>
                                 </div>
                               <span class="error-msg-box error-span" id='gendererr'>                                 
                                    </span>
                            
                            </div>
                         
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id="signupdate" name='signupdate' required="required" class='rmv'>
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
                                <div class="input-container" ng-controller="country" ng-model="query" >
                                    <input type="hidden"  value=" " id="country"   >
                                    <input type="text" list="country_sugg" id="countryid" class='rmv' name='countryid' autocomplete="off" required="required" ng-model="query" ng-keyup="countrysearch()" value="{{country.id}}">
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
                                    <input type="text" list='state_sugg' id="stateid" class='rmv' name='stateid' autocomplete="off" required="required" ng-model="squery" ng-keyup="statesearch()">
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
                                    <input type="text" id="district" name='district' required="required" class='rmv'>
                                    <label for="#{district}">Enter District</label>
                                    <span class="error-msg-box error-span" id='districterr'>                                    
                                    </span>
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" id="village" name='village' required="required" class='rmv'>
                                    <label for="#{village}">Enter Village</label>
                                    <span class="error-msg-box error-span" id='villageerr'>                                    
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
                                    <input type="text" list="lang_sugg" id="language" class='rmv' autocomplete="off" name='languageid' required="required" ng-model="cquery" ng-keyup="searchlang()"/>
                                    <datalist id="lang_sugg" ng-show="query">
                                        <option ng-repeat="language in languages| filter:cquery  "  data-id="{{language.id}}">{{language.name}} </option>
                                    </datalist> 
                                    <label for="#{language}">Enter Language</label>
                                    <span class="error-msg-box error-span" id='languageerr'>                                    
                                    </span>
                                </div> 
                            </div>

                            <div class="col-md-6">                            
                                <div class="doc-profile-img">
                                    <div class="doc-file-label">Upload Photo</div>
                                     
                                    <img src="<?php echo $ctrl_images; ?>profile.jpg" id="imagePreview" name='profilePicture' class="doc-img" alt="Preview Image"/>
                                </div>
                                <div class="doc-profile-img">
                                    <input type="file" name="imageUpload" id="imageUpload" class="file-opacity"/> 
                                    <label for="imageUpload" class="btn btn-large doc-upload-btn addbutton"><span class="glyphicon glyphicon-upload"></span> Upload</label>
                                </div>
                                <span class="error-msg-box error-span" id='profileimgerr'>                                    
                                </span>
                            </div>


                        </div>


                        <div class="doc-profile-img">
                            <button type="submit" class="btn btn-default btn-bg addbutton">Submit</button>
                        </div>
                        <!--                            <button type="button" class="btn btn-default card-btn">Cancle</button>-->

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
        <h1>BCP</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                       <!-- <h3 class="box-title">BCP Data</h3> -->  <div class="success-msg-box"><span  id="sucess_msg">  </span></div> <div class="error-msg-box"><span  id="error_msg"></span></div>            <!-- <button  style="float: right;"> Add New Row </button> -->
<!-- <a data-toggle="modal" data-target="#bcpModal" class="pull-right btn btn-default btn-flat">Add New Row</a>-->
<!--                        
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body tbl-responsive">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S No.</th>
                                    <th>  Name</th>
                                     
<!--                                    <th>Zip Code</th>-->
                                   <th>User Name</th>
                                    <th>Email</th>
                                     <th>No Of MedicalRecords</th>
                                    <th>Mobile</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                               
                                if (is_array($bcp) && ($bcp!=0)) {
                                $c= 1;
                                foreach ($bcp as $key => $val) {
                                    $count  =   0;
                                    if(isset($mrcount[$val['id']])){
                                        $count  =   $mrcount[$val['id']];
                                    }
                                    ?>


                                    <tr id="user<?php echo   $val['id']  ?>">
                                        <td><span  ><?php echo $c ;?></span></td>
                                        <td><span class="edit1" ><?php echo Ucfirst($val['firstName']).' '.$val['lastName']; ?></span></td>
                                        <td><span class="edit1"><?php echo $val['username'] ;?></span></td>
                                        <td><span class="edit1"><?php echo $val['email'] ;?></span></td>
                                        <td><span class="edit1"><?php  echo  $count ; ?></span></td>
                                        <td><span class="edit1"><?php  echo $val['mobile']; ?></span></td>
                                        <td><span class="edit1"><?php  echo $val['country_name'] ;?></span></td>
                                        <td><span class="edit1"> <?php  echo $val['state_name']; ?></span></td>
                                        <td><span class="edit1"><a data-toggle="modal" title="Edit"   href="" onclick="editBcp(<?php echo $val['id'] ;?>)" ><i class="glyphicon glyphicon-edit"></i></a>/<a title="Delete"  onclick="deleteUser(<?php echo $val['id'];  ?>)" ><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>  </span></td>
                                        
                                    </tr>
                                <?php $c++; } }?>
                 
                           <!-- </tfoot> -->
                        </table>
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
	<script src="<?php echo $ctrl_js_path.'bcp'.$ctrl_js_ext?>"></script>


