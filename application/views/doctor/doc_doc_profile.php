
<!--Nav Menu -->
<script src="<?php echo $doc_js_path?>Change_password<?php echo $doc_js_ext?>"></script>
<?php  
   $dob='';
   $education='';
   $gender='';
   if(array_key_exists('dob', $profileData[0]))
    {
        if(str_replace('-','',$profileData[0]['dob']) > 0){
            $dob= $profileData[0]['dob'];
        }
    }
    if(array_key_exists('gender', $profileData[0])){
     $gender= $profileData[0]['gender'];
     }

   if(array_key_exists('education', $profileData[0])){
     $education= $profileData[0]['education'];
     }
     
     $msg=$this->session->flashdata('message');
   ?>

<div class="maindiv profile-page">

      <div class="container mrgtop50">
         <div class="row">
			 <?php if(!empty($this->session->flashdata('message'))) { ?>
             
		  <?php }  ?>
                         
                         
                         <span class="error-span" id="success_msg"></span>                
      <div class="row" id="editprofile">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h5 class="blc mrgleft10"><?php echo $profileData[0]['firstName'].' '.$profileData[0]['lastName']; ?>
                           
              <a href="<?php echo getUrl('doctorEditprofile'); ?>" title="Edit Profile" data-toggle="tooltip" data-placement="top" 
          type="button" class="btn btn-sm btn-warning editbutt"><i class="glyphicon glyphicon-pencil"></i></a>
          
          <span data-toggle="modal" data-target="#squarespaceModal" >
          <a data-toggle="tooltip" title="Change Password" data-placement="top" type="button" class="btn btn-sm btn-warning editbutt mrgrt20">
          <i class="glyphicon glyphicon-edit"></i></a></span>
          
          </h5>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 doc-img-upload"> 

					  <div class="panel panel-default">
						 <div class="panel-heading"><strong>Profile Image</strong> <small> </small></div>
						 <div class="panel-body profile-img-box">
						  <img alt="User Pic" class="doc-img" src="<?php if($profileData[0]['profile_picture'] != '') echo $profileData[0]['profile_picture'];  else  echo $doc_images.'profile.jpg'; ?> " class="img-circle img-responsive">
						 </div>
					  </div>

					  <div class="panel panel-default">
						 <div class="panel-heading"><strong>Signature</strong> <small> </small></div>
						 <div class="panel-body profile-img-box">
							<img alt="User Pic" class="doc-img" src="<?php if($profileData[0]['signature_picture'] != '') echo $profileData[0]['signature_picture'];  else  echo $doc_images.'defaut-sign.png'; ?> " class="img-circle img-responsive">
						 </div>
					  </div>

                 </div>                
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
<!--                      <tr>
                        <td>Profession</td>
                        <td></td>
                      </tr>-->
                      
                      <tr>
                        <td>Phone Number</td>
                        <td><?php echo $profileData[0]['mobile']; ?> </td>
                      </tr>
                      
                      <tr>
                        <td>Email</td>
                        <td><a href="mailto:<?php echo $profileData[0]['email']; ?>"><?php echo $profileData[0]['email']; ?></a></td>
                      </tr>
                      
                       <tr>
                        <td>Home Address</td>
                        <td><?php 
                        if(!empty($profileData[0]['city_name'])){
                            echo $profileData[0]['city_name'].',';
                        }
                        else echo '';
                        if(!empty($profileData[0]['state_name'])){
                            echo $profileData[0]['state_name'].',';
                        }
                        else echo '';
                        if(!empty($profileData[0]['country_name'])){
                            echo $profileData[0]['country_name'];
                        }
                        else echo '';
                        
                        ?></td>
                      </tr>

                      <tr>
                        <td>Date of Birth</td>
                        <td><?php echo $dob?> </td>
                      </tr>
                   
                      <tr>
                        <td>Gender</td>
                        <td><?php echo $gender ?> </td>
                      </tr>
                       
                      <tr>
                        <td>Education</td>
                        <td><?php echo $education ?> </td>
                      </tr>
<!--                      <tr>
                        <td>Work Experience</td>
                        <td> </td>
                      </tr>-->
                     
                    </tbody>
                  </table>
                    
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    </div>

<!-- change password modal box start -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="chng-pass modal-dialog">
  <div class="modal-content">
      
    <div class="modal-header">
      <button type="button" class="close btn-warning" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      <h3 class="modal-title" id="lineModalLabel">Change Password</h3>
    </div>
      <div id="success" class=""></div>
      <div id="error" class="text-danger"></div>
    <div class="modal-body card">
      
            <!-- content goes here -->
            <form  method="post" id="changePassword" novalidate>
              <div class="input-container">
                <input id="curpass" required="required" name="otp" type="password"> <label for="#{label}">Current Password</label>
                <div id="otpbar" class="bar"></div>
                <span id="error_otp" class="text-danger"></span>
              </div>
              <div class="input-container">
                <input id="newpass" required="required" name="newpassword" type="password"> <label for="#{label}">New Password</label>
                <div id="newpasswordbar" class="bar"></div>
                 <span id="error_newpassword" class="text-danger"></span>
              </div>
              <div class="input-container">
                <input id="confpass" required="required" name="confirmpassword" type="password"> <label for="#{label}">Confirm Password</label>
                <div id="confirmpasswordbar" class="bar"></div>
                <span id="error_confirmpassword" class="text-danger"></span>
              </div>
              <div class="textalg">
                <button class="btn editbutton" id="passwordsubmit">
                  <span>Submit</span>
                </button>
              </div>
            </form>
    </div>
  </div>
  </div>
</div>
<!-- change password modal box end -->

</div>

