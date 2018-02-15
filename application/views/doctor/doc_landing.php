
<link rel="stylesheet" href='<?php echo $doc_css_path; ?>landing<?php echo $doc_css_ext; ?>'>
<link rel="stylesheet" href='<?php echo $doc_css_path; ?>effects<?php echo $doc_css_ext; ?>'/>
<script src="<?php echo $doc_js_path; ?>landing<?php echo $doc_js_ext; ?>"></script>	



<div class="container site-body">
   <div class="row ">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
         <!-- colored -->
         <div class="ih-item circle colored effect10 bottom_to_top">
            <a href="<?php  echo  getUrl('Mrrecord')  ?>">
               <div class="img"><img src="<?php echo $doc_images; ?>medical-records.png" alt="medical-records"></div>
               <div class="info">
                  <h3>Medical Records</h3>
               </div>
            </a>
         </div>
         <!-- end colored -->
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
         <!-- colored -->
         <div class="ih-item circle colored effect10 bottom_to_top">
            <a href="<?php echo  getUrl('Prescription'); ?>">
               <div class="img"><img src="<?php echo $doc_images; ?>prescription-requests.png" alt="Prescription Requests"></div>
               <div class="info">
                  <h3>Prescription Requests</h3>
               </div>
            </a>
         </div>
         <!-- end colored -->
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
         <!-- colored -->
         <div class="ih-item circle colored effect10 bottom_to_top">
            <a href="<?php echo  getUrl('doctorProfile');   ?>">
               <div class="img"><img src="<?php echo $doc_images; ?>profile.png" alt="Doctor Profile"></div>
               <div class="info">
                  <h3>Doctor Profile</h3>
               </div>
            </a>
         </div>
         <!-- end colored -->
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
         <!-- colored -->
         <div class="ih-item circle colored effect10 bottom_to_top">
            <a href="<?php echo getUrl('doctorLogout');   ?>">
               <div class="img"><img src="<?php echo $doc_images; ?>Logout.png" alt="Logout"></div>
               <div class="info">
                  <h3>Logout</h3>
               </div>
            </a>
         </div>
         <!-- end colored -->
      </div>
   </div>
</div>
