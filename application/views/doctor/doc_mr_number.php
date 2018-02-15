<style>
    .panel{
        margin-bottom: 10px
    }
    ul.parent_ul {
    float: left;
    /*min-height: 42px;*/
}
.div_right{float: right;}
.dr-spn-box{margin-bottom: 5px;}
ul, menu, dir {
    -webkit-padding-start: 15px;
  list-style-type: none;
}
</style>
<link rel="stylesheet" href="<?php echo $doc_css_path ?>mr<?php echo $doc_css_ext ?>">
<!-- <script src="<?php echo $doc_js_path; ?>jqueryui-1-11-4<?php echo $doc_js_ext; ?>"></script> -->

<div class="w3-light-grey w3-content maxwid">

<!--Nav Menu -->

<?php if(!empty($pdetails)) { 
	//echo '<pre>'; print_r($pdetails); echo '</pre>';
	?>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left mrsidnav" id="mySidebar">
  <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container bcp-profile-img">
          <img class="w3-circle clrwht" src="<?php if(!empty($pdetails) && $pdetails['profilePicture']!='') echo $pdetails['profilePicture']; else echo $doc_images.'profile.jpg'; ?>" alt="Avatar">
        </div>
        <div class="w3-container padd15 panel-left-pading">
          <p title="Name"><i class="fa fa-user-circle fa-fw w3-margin-right w3-large hffbcg"></i><b><?php if(!empty($pdetails)) echo ucwords ($pdetails['title']).' '.$pdetails['firstName'].' '.$pdetails['middleName'].' '.$pdetails['lastName']; else echo ''?></b></p>
          <p title="MR Number"><i class="fa fa-book fa-fw w3-margin-right w3-large hffbcg"></i><?php if(!empty($pdetails)) echo $pdetails['medicalRegistrationNumber']; else ''; ?></p>
          <p title="Registration Date"><i class="fa fa-calendar-plus-o fa-fw w3-margin-right w3-large hffbcg"></i><?php
          if(!empty($pdetails)) {
          echo $regtime = $pdetails['registrationDate'];
          //$timestamp = strtotime($regtime);
          //echo date("m-d-Y h:m:s", $timestamp);
          }
          else ''; ?></p>
          <p title="Cotact Number"><i class="fa fa-phone fa-fw w3-margin-right w3-large hffbcg"></i><?php if(!empty($pdetails)) echo $pdetails['contactNumber']; else ''; ?></p>
          <p title="Date of Birth"><i class="fa fa-calendar fa-fw w3-margin-right w3-large hffbcg"></i><?php 
          if(!empty($pdetails)){
          echo $db = $pdetails['dateofBirth'];
          //$timestamp = strtotime($db);
          //echo  $timestamp;
          } else echo '' ?></p>
          <p title="Age"><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-large hffbcg"></i><?php if(!empty($pdetails)) echo date_diff(date_create($pdetails['dateofBirth']), date_create('now'))->y; else echo '' ?></p>
          <p title="Guardian Name"><i class="fa fa-users fa-fw w3-margin-right w3-large hffbcg"></i><?php echo $pdetails['guardianName']; echo (!empty($pdetails['emergencyContactRelation']))?'('.$pdetails['emergencyContactRelation'].')':'' ?></p>
          <p title="Emergency Name"><i class="fa fa-plus-circle  fa-fw w3-margin-right w3-large w3-text-red"></i><?php echo $pdetails['emergencyName']; echo (!empty($pdetails['guardianRelation']))?'('.$pdetails['guardianRelation'].')':'' ?></p>
          <p title="Emergency Number"><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-red"></i><?php echo $pdetails['emergencyNumber']; ?></p>
          <p title="Profession"><i class="fa fa-briefcase fa-fw w3-margin-right w3-large hffbcg"></i><?php echo $pdetails['occupation']; ?></p>          
          <p title="Education"><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-large hffbcg"></i><?php echo $pdetails['education']; ?></p>          
          <p title="Maritial Status"><i class="fa fa-venus-mars fa-fw w3-margin-right w3-large hffbcg"></i><?php if(!empty($pdetails)) echo $pdetails['maritalStatus']; else echo ''; ?></p>
          <p title="Caste"><i class="fa fa-asterisk fa-fw w3-margin-right w3-large hffbcg"></i><?php echo $pdetails['caste']; ?></p>
          <p title="Religion"><i class="fa fa-asterisk fa-fw w3-margin-right w3-large hffbcg"></i><?php echo $pdetails['religion']; ?></p>
          <p title="ID Proof"><i class="fa fa-id-card fa-fw w3-margin-right w3-large hffbcg"></i><?php echo $pdetails['idProofType'].' '.$pdetails['idProofNo']; ?></p>
          <p title="Address"><i class="fa fa-home fa-fw w3-margin-right w3-large hffbcg"></i><?php 
                                        if(!empty($pdetails)){
                                            $addr   =   0;
                                            if(!empty($pdetails['houseNo'])){
                                                echo ($addr)?' ,'.$pdetails['houseNo']:$pdetails['houseNo'];
                                                $addr   =   1;
                                            }
                                            if(!empty($pdetails['block'])){
                                                echo ($addr)?' ,'.$pdetails['block']:$pdetails['block'];
                                                $addr   =   1;
                                            }
                                            if(!empty($pdetails['streetName'])){
                                                echo ($addr)?' ,'.$pdetails['streetName']:$pdetails['streetName'];
                                                $addr   =   1;
                                            }
                                            if(!empty($pdetails['area'])){
                                                echo ($addr)?' ,'.$pdetails['area']:$pdetails['area'];
                                                $addr   =   1;
                                            }
                                            if(!empty($pdetails['village'])){
                                                echo ($addr)?' ,'.$pdetails['village']:$pdetails['village'];
                                                $addr   =   1;
                                            }
                                            if(!empty($pdetails['city'])){
                                                echo ($addr)?' ,'.$pdetails['city']:$pdetails['city'];
                                                $addr   =   1;
                                            }
                                            if(!empty($pdetails['state'])){
                                                echo ($addr)?' ,'.$pdetails['state']:$pdetails['state'];
                                                $addr   =   1;
                                            }
                                            if(!empty($pdetails['country'])){
                                                echo ($addr)?' ,'.$pdetails['country']:$pdetails['country'];
                                            }
                                        }     
                                        ?></p>
          
          
<!--          <p title="Village"><i class="fa fa-home fa-fw w3-margin-right w3-large hffbcg"></i><?php if(!empty($pdetails)) echo $pdetails['village'];?></p>
          <p title="City"><i class="fa fa-home fa-fw w3-margin-right w3-large hffbcg"></i><?php echo $pdetails['city']; ?></p>
          <p title="State"><i class="fa fa-home fa-fw w3-margin-right w3-large hffbcg"></i><?php echo $pdetails['state']; ?></p>
          <p title="Country"><i class="fa fa-globe fa-fw w3-margin-right w3-large hffbcg"></i><?php echo $pdetails['country']; ?></p>-->
              
          </div>
          <br>
    </div>
</nav>

<div class="maindiv">


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity cursur" onclick="w3_close()" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main mrglft300">
<?php if(!empty($userdata)) { 
?>
 <header id="portfolio" class="mrgtop51">
  <h4 class="doc-page-heading"><b>BCP Details</b></h4>  

    <div class="w3-right w3-hide-large profile-img-for-leftbar">
    <img src="<?php if(!empty($pdetails) && $pdetails['profilePicture']!='') echo $pdetails['profilePicture'];
							 else echo $doc_images.'profile.jpg'; ?>" onclick="w3_open()"
    class="w3-circle w3-hover-opacity mrpatimg ">
    <div onclick="w3_open()" class="bcp-details-box-leftbar">
     <div><?php if(!empty($pdetails)) echo ucwords ($pdetails['title']).' '.$pdetails['firstName'].' '.$pdetails['middleName'].' '.$pdetails['lastName']; else echo ''?></div>
     <div>Details</div>
     
     </div>
     </div>
    
       <div class="col-lg-1 pull-left">
       <a href="bcpProfile?bid=<?php echo $userdata['id']?>">
    <img src="<?php if(!empty($userdata) && $userdata['profile_picture']!='') echo $userdata['profile_picture']; else echo $doc_images.'profile.jpg'; ?>" class="w3-left w3-margin-top w3-margin-right img-circle mrbcpimg">
    </a>
     
     </div>
        <div class="col-lg-3 pull-left w3-margin-top bcp-details-box">
     <i class="fa fa-user fa-fw  mrgrt5 w3-large hffbcg "></i><a href="#"><?php if(!empty($userdata)) echo $userdata['firstName'].' '.$userdata['lastName']; else echo ''?></a><br>
     <i class="fa fa-phone fa-fw mrgrt5 w3-large hffbcg "></i><?php if(!empty($userdata)) echo $userdata['mobile']; else echo ''?><br>
     <i class="fa fa-home fa-fw  mrgrt5 w3-large hffbcg ">
     </i><?php if(!empty($userdata)){
         $address   =   '';
         if(!empty($userdata['village'])){
             echo (!empty($address))?','.$userdata['village']:$userdata['village'] ;
             $address   =   $userdata['village'];
         }
         else echo '';
         if(!empty($userdata['city_name'])){
             echo (!empty($address))?','.$userdata['city_name']:$userdata['city_name'] ;
             $address   =   $userdata['city_name'];
         }
         else echo '';
         if(!empty($userdata['state_name'])){
             echo (!empty($address))?','.$userdata['state_name']:$userdata['state_name'];
             $address   =   $userdata['state_name'];
         }
         else echo '';
         if(!empty($userdata['country_name'])){
             echo (!empty($address))?','.$userdata['country_name']:$userdata['country_name'];
             $address   =   $userdata['country_name'];
         }
         else echo '';
         if(!empty($userdata['pincode'])){
             echo (!empty($address))?','.$userdata['pincode']:$userdata['pincode'];
             $address   =   $userdata['pincode'];
         }
         else echo '';
     }
     else echo ''
        ?><br>
     
     </div>
    
  </header> 
  
<?php } ?> 

  <!-- Right Column -->
    <div class="scroll">
      <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        <h6 class="w3-text-grey w3-padding-16">
        <i class="fa fa-table fa-fw w3-margin-right  hffbcg"></i><b>Visit Details</b></h6>
        
       <div > <!--class="w3-container" -->
		    
           <!--<div class="row">-->
		 <?php  if(!empty($mivdata)){ 
                     
		   $vd = 1;
                   $pv=1; 
                   $cc_inc_id    =   1;
		   foreach($mivdata as $mval) {
                       	if(!empty($mval['primaryAssessmentData'])){
					//echo '<pre>'; print_r($mval['primaryAssessmentData']['questionnaire']); echo '</pre>';
					foreach($mval['primaryAssessmentData']['questionnaire'] as $primarydata){

						$primarysurvey[] = $primarydata['surveyTaxonomyName'];
//						$primarysurvey[] = empty($primarydata['surveyTaxonomyName'])?'Chief Complaint Symptoms':$primarydata['surveyTaxonomyName'];

					}
					
					$primaryarray = array_unique($primarysurvey);
                                        
				}
				 
//                                debugArray($ccsurvey); exit;
                                
		 ?>
           
         <div>
				
				<div class="panel-group mr-details">
					<div class="panel panel-default" style="margin-bottom:15px">
						<a data-toggle="collapse" href="#collapsevid<?php echo $mval['id']; ?>" class="textgreen visitid<?php echo $mval['id']; ?>">
						<div class="panel-heading">
                                                    <?php
                                                    $custom_class= '';
                                                    if($mval['type'] == 'redflag'){
                                                        $custom_class= 'hffredbcg';
                                                    }
                                                    ?>
							<h6 class="panel-title font15 <?php echo $custom_class; ?>">
								
								<i class="fa fa-heartbeat fa-fw w3-margin-right w3-large "></i>
								<b class="mrglft padrgt20"><?php echo $mval['visit_code']; ?></b>
								<b class="mrglft"><?php echo date('Y-m-d h:i A',strtotime($mval['date'])); ?></b>
                                <b class="fltrgt"><?php echo ucwords($mval['type']); ?></b>
								
<!--								<img class="fltrgt wid20 mrglft10" src="<?php echo $doc_images.'sms-message.png'; ?>">
								<img class="fltrgt wid20 mrglft10" src="<?php echo $doc_images.'telephone.png'; ?>">
								<img class="fltrgt wid20 mrglft10" src="<?php echo $doc_images.'amber_rx.png'; ?>">
								<img class="fltrgt wid20 mrglft10" src="<?php echo $doc_images.'retake.png'; ?>">-->
								<!--<i class="fltrgt glyphicon glyphicon-bookmark hffamberbcg fntsz20"></i>-->
								
							</h6>
						</div>
							</a>
						<div id="collapsevid<?php echo $mval['id']; ?>" class="panel-collapse collapse ">
							<div class="panel-body">
							<div class="colaps-parent-box">
							<div data-toggle="collapse" data-target="#primary_assess_block<?php echo $cc_inc_id;?>" class="colaps-parent-box-heading">Primary Assessment</div>
                                                        <div id="primary_assess_block<?php echo $cc_inc_id;?>">
       
       <?php 
			   
                           $i=0;
                           $cc_inc_id++;
			   foreach($primaryarray as $primaryval) { 
                               $i++;
			   	if(!empty($primaryval)){
                                    
								?>
        <div class="w3-container panel-collapse collapse in" id="primary_asses">
         <div class="row">
				<div class="panel-group">
                                    
					<div class="panel panel-default">
						<a data-toggle="collapse" href="#collapse<?php echo $pv; ?>" class="textgreen visitid<?php echo $visitid; ?>">
                                                    <div class="panel-heading">
                                                            <h6 class="panel-title font15">
                                                                    <b><?php 
                                                                        echo $primaryval;
                                                                        if(empty($primaryval)){
                                                                            echo "Symptoms";
                                                                        }
                                                                        ?></b>
                                                                            <!--<i class="fltrgt glyphicon glyphicon-bookmark hffamberbcg fntsz20"></i>-->
                                                            </h6>
                                                    </div>
						</a>
						<div id="collapse<?php echo $pv; ?>" class="panel-collapse collapse in">
							<div class="panel-body ">
							<?php if(!empty($mivdata)){ 
							   foreach($mval['primaryAssessmentData']['questionnaire'] as $val) {
                                                               
								   if($val['surveyTaxonomyName'] == $primaryval){
									   $fred = '';
									   if($val['severity']!='low'){
										   $fred = 'reed';
									   }
							?>
								<div class="row borbotm">
								<span id="<?php echo $val['id']; ?>" class="list-group-item atumgroup atumgroup col-md-10 col-sm-10 col-xs-8 <?php echo $fred; ?> "><span
									class="glyphicon glyphicon-bookmark top3"></span>&nbsp;<?php echo $val['title']; ?></span>
								<b><span class="list-group-item atumgroup atumgroup textalgrt col-md-2 col-sm-2 col-xs-4">
									
									<?php $ans_temp   =   '';
                                                                        foreach($val['options'] as $opt) {
                                                                                $ans = '';
                                                                                if($opt['optionType']=='radio'){
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='text') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='ratio') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='checkbox') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='multi-select') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='sticky') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='textarea') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}
                                                                                
                                                                                $ans_temp   =   (!empty($ans_temp) && !empty($ans))?','.$ans:$ans;
                                                                                echo $ans_temp;
                                                                                if($opt['ans']){ 
                                                                                    if(in_array($opt['id'],$mval['prec_ids'])){
                                                                                        $presc_id   =   array_search($opt['id'],$mval['prec_ids']);
                                                                                        ?>
                                                                                            <a>
                                                                                            <img id="rx_<?php echo $presc_id; ?>" onclick="doctor.getPrescriptionPopupView(<?php echo $presc_id; ?>); this.onclick=null"  class="fltrgt ohver mrglft10 wid27" 
                                                                                            title="Sent Prescription" data-toggle="tooltip" src="<?php echo $doc_images;?>rx.png">
                                                                                            </a>
                                                                                            <?php
                                                                                    }
								
                                                                                }} ?>
                                                                 
								</span></b>		
								</div>				
								
								
							<?php } } } ?>	
								
							</div>
						</div>
					</div>
				</div>
                                
			</div>
        </div>
       <?php $pv++; }else{
           if(!empty($mivdata)){                            $alternate_span = 1;
							   foreach($mval['primaryAssessmentData']['questionnaire'] as $val) {
                                                               
								   if($val['surveyTaxonomyName'] == $primaryval){
									   $fred = '';
									   if($val['severity']!='low'){
										   $fred = 'reed';
									   }
							?>	
							<div class="row borbotm nopanel">
								<span id="<?php echo $val['id']; ?>" class="list-group-item atumgroup atumgroup col-md-8 col-sm-8 col-xs-8 <?php echo $fred; ?> "><span
									class="glyphicon glyphicon-bookmark top3"></span>&nbsp;<?php echo $val['title']; ?></span>
								<b><span class="list-group-item atumgroup atumgroup textalgrt col-md-4 col-sm-4 col-xs-4">
									
									<?php $ans_temp   =   '';$prev_ans=   '';
                                                                        foreach($val['options'] as $opt) {
                                                                                $ans = '';
                                                                                if($opt['optionType']=='radio'){
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='text') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='ratio') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='checkbox') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='multi-select') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='sticky') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}else if ($opt['optionType']=='textarea') {
											$ans =  ($opt['ans']) ? $opt['ans'] : '';
										}
                                                                                if($alternate_span%2 != 0){
                                                                                    $span_ans    =   '<span class="altbckgrd">'.$ans.'</span>';
                                                                                }else {
                                                                                    $span_ans    =   '<span class="altbckgrd2">'.$ans.'</span>';
                                                                                }
                                                                                $alternate_span++;    
                                                                                $ans_temp   =   (!empty($prev_ans) && !empty($ans))?','.$span_ans:$span_ans;
                                                                                $prev_ans   =   $ans;
                                                                                echo $ans_temp;
                                                                                if($opt['ans']){ 
                                                                                    if(in_array($opt['id'],$mval['prec_ids'])){
                                                                                        $presc_id   =   array_search($opt['id'],$mval['prec_ids']);
                                                                                        ?>
                                                                                            <a>
                                                                                            <img id="rx_<?php echo $presc_id; ?>"  onclick="doctor.getPrescriptionPopupView(<?php echo $presc_id; ?>); this.onclick=null"  class="fltrgt ohver mrglft10 wid27" 
                                                                                            title="Sent Prescription" data-toggle="tooltip" src="<?php echo $doc_images;?>rx.png">
                                                                                            </a>
                                                                                            <?php
                                                                                    }
								
                                                                                }} ?>
                                                                 
									</span></b>	</div>					
								
								
							<?php } } }
       } }  ?>
                                                        </div>
       </div>
       	<!-- Chief complaint block						-->	
								
        <?php  
        if(!empty($mval['chiefComplaintData']) && is_array($mval['chiefComplaintData']) ) 
        {
        ?>
		<div class="">
			<div class="panel-group">
				<div class="panel panel-default">
					<a data-toggle="collapse" href="#chiefcompoaint<?php echo $mval['id']; ?>"  class="textgreen chiefcompoaintBlock<?php echo $visitid; ?>">
                        <div class="panel-heading">
                            <h6 class="panel-title font15">
                                <b>Chief Complaints</b>
                            </h6>
                        </div>
                    </a>
					<div id="chiefcompoaint<?php echo $mval['id']; ?>" class="panel-collapse collapse">
						<div class="panel-body">
						<?php 
                        foreach($mval['chiefComplaintData']['questionnaire'] as $chieflist) 
                        {
                            $ccsurvey    =   array();
                            $ccsurvey['diagnosis']   =   array();
                            $ccsurvey['cc']   =   array();
                            foreach($chieflist['questions'] as $ccdata)
                            {
                                if($ccdata['answered'])
                                {
                                    if($ccdata['type'] == 'diagnoses')
                                    {
                                        $ccsurvey['diagnosis'][] = $ccdata['surveyTaxonomyName'];
                                        $diagnosis[]    =   $ccdata['id'];
                                    }else{
                                        $ccsurvey['cc'][] = $ccdata['surveyTaxonomyName'];
                                    }
                                }
                            }
                            $ccarrayPrimary['cc'] = array_unique($ccsurvey['cc']);
                            $ccarrayPrimary['diagnosis'] = array_unique($ccsurvey['diagnosis']);
                            ?>
                            <div class="w3-container">
                                <div class="row">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <a data-toggle="collapse" href="#cc<?php echo $cc_inc_id; ?>" class="textgreen visitid<?php echo $visitid; ?>">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title font15">
                                                    <b><?php echo $chieflist['name']; ?></b>
                                                    </h6>
                                                </div>
                                            </a>
                                            <div id="cc<?php echo $cc_inc_id; ?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <?php foreach($ccarrayPrimary as $key => $ccarray)
                                                    {
                                                        if($key == 'diagnosis' && !empty($ccarray))
                                                        { ?> 
                                                            <!--<div class="w3-container-fluid">-->
                                                            <div class="">
                                                                <div class="panel-group">
                                                                    <div class="panel panel-default">
                                                                        <a data-toggle="collapse" href="#cc<?php echo $cc_inc_id; ?>" class="textgreen visitid<?php echo $visitid; ?>">
                                                                            <div class="panel-heading">
                                                                                <h6 class="panel-title font15">
                                                                                    <b><?php echo ucwords($key); ?></b>
                                                                                </h6>
                                                                            </div>
                                                                        </a>
                                                                        <div id="cc<?php echo $cc_inc_id; $cc_inc_id++; ?>" class="panel-collapse collapse in">
                                                                            <div class="panel-body"> 
                                                        <?php   
                                                        }
                                                        foreach($ccarray as $cc)
                                                        {
                                                            if(!empty($cc))
                                                            {  ?>
                                                            <div class="">
                                                                <div class="">
                                                                    <div class="panel-group">
                                                                        <div class="panel panel-default">
                                                                            <a data-toggle="collapse" href="#ccq<?php echo $cc_inc_id; ?>" class="textgreen visitid">
                                                                                <div class="panel-heading">
                                                                                    <h6 class="panel-title font15">
                                                                                        <b><?php
                                                                                        echo $cc;
                                                                                        if(empty($cc)){
                                                                                            echo 'Sticky Image';
                                                                                        }
                                                                                        ?></b>

                                                                                    </h6>
                                                                                </div>
                                                                            </a>
                                                                            <div id="ccq<?php echo $cc_inc_id; ?>" class="panel-collapse collapse in">
                                                                                <div class="panel-body ">
                                                                                    <?php 
                                                                                    if(!empty($chieflist['questions']))
                                                                                    { 
                                                                                        $alternate_span   =   1;
                                                                                        foreach($chieflist['questions'] as $chiefval) 
                                                                                        {
                                                                                            if($chiefval['surveyTaxonomyName'] == $cc)
                                                                                            {
                                                                                                $cred = '';
                                                                                                if($chiefval['severity']!='low')
                                                                                                {
                                                                                                    $cred = 'red';
                                                                                                }
                                                                                                if($chiefval['title'] == 'Sticky Diagram' || $chiefval['title'] == 'Stick Figure Diagram')
                                                                                                {
                                                                                                ?>
                                                                                                    <div class="row borbotm">
                                                                                                        
                                                                                                        <span id="<?php echo $chiefval['id']; ?>" class="list-group-item atumgroup col-md-3 col-sm-3 col-xs-12 <?php echo $cred; ?> ">
                                                                                                            <span class="glyphicon glyphicon-bookmark top3"></span><?php echo $chiefval['title']; ?>
                                                                                                        </span>
                                                                                                        <b>
                                                                                                        <span class="list-group-item atumgroup textalgrt col-md-9 col-sm-9 col-xs-12  scrolsticky" >
                                                                                                        <div class="">
                                                                                                <?php
                                                                                                }
                                                                                                else
                                                                                                { ?>
                                                                                                    <div class="row borbotm">
                                                                                                        
                                                                                                        <span id="<?php echo $chiefval['id']; ?>" class="list-group-item atumgroup col-md-4 col-sm-4 col-xs-12 <?php echo $cred; ?> ">
                                                                                                            <span class="glyphicon glyphicon-bookmark top3"></span><span>&nbsp;</span><?php echo $chiefval['title']; ?>
                                                                                                        </span>
                                                                                                        <b>
                                                                                                        <span class="list-group-item atumgroup textalglft col-md-8 col-sm-8 col-xs-12">
                                                                                                        <div class="div_right">
                                                                                                <?php 
                                                                                                } 
                                                                                                $ans_temp = ''; $i=1; 
                                                                                                foreach($chiefval['options'] as $copt) 
                                                                                                {
                                                                                                    if($copt['ans'])
                                                                                                    {
                                                                                                        if(in_array($copt['id'],$mval['prec_ids']))
                                                                                                        {
                                                                                                            $presc_id   =   array_search($copt['id'],$mval['prec_ids']);
                                                                                                            ?>
                                                                                                            <a>
                                                                                                            <img id="rx_<?php echo $presc_id; ?>" onclick="doctor.getPrescriptionPopupView(<?php echo $presc_id; ?>); this.onclick=null"  class="fltrgt ohver mrglft10 wid27" 
                                                                                                            title="Sent Prescription" data-toggle="tooltip" src="<?php echo $doc_images;?>rx.png">
                                                                                                            </a>
                                                                                                        <?php
                                                                                                        }
                                                                                                        if(!empty($prev_ans))
                                                                                                        {
                                                                                                            $prev_ans   .=  ','.$copt['ans'];   
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                            $prev_ans   =  $copt['ans'];
                                                                                                        }
                                                                                                        if($copt['optionType'] == 'sticky')
                                                                                                        { 
                                                                                                            $coordinates    =   json_decode($copt['ans']);
                                                                                                            ?>
                                                                                                            <div style="background:url('<?php echo $copt['value']; ?>') no-repeat ; width:480px; height:480px;margin-top:-10px" id="sticky_<?php echo $cc_inc_id; ?>" ></div>
                                                                                                            <input type="hidden" class="stickyImageid" value="<?php echo $cc_inc_id; ?>" />
                                                                                                            <input type="hidden" class="stickyIds" id="sticky_coordinates<?php echo $cc_inc_id; ?>"  value='<?php echo $copt['ans']; ?>'  />
                                                                                                        <?php 
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                            $ans    =   $copt['ans'];
                                                                                                            if($alternate_span%2 != 0)
                                                                                                            {
                                                                                                                $altbg    =   'altbckgrd';
                                                                                                            }
                                                                                                            else
                                                                                                            {
                                                                                                                $altbg    =   'altbckgrd2';
                                                                                                            }
                                                                                                            $ans_temp   =   (!empty($ans_temp) && !empty($ans))?'<span class="'.$altbg.' fltlft dr-spn-box">'.$ans:'<span class="'.$altbg.' fltlft dr-spn-box">'.$ans;
                                                                                                            echo $ans_temp;
                                                                                                            $alternate_span++;
                                                                                                        }
                                                                                                        if(!empty($copt['subOptions'])) 
                                                                                                        {   
                                                                                                            echo '<div class="">';
                                                                                                            echo '<ul style="list-style-type:disc" class="parent_ul">';
                                                                                                            foreach ($copt['subOptions'] as $coptsub)
                                                                                                            { 
                                                                                                                if($coptsub['ans']){ 
                                                                                                                    echo '<li>';
                                                                                                                    echo $coptsub['ans']; 
                                                                                                                }
                                                                                                                
                                                                                                                if(!empty($coptsub['subOptions'])) 
                                                                                                                {   
                                                                                                                    echo '<ul style="list-style-type:disc">';
                                                                                                                    foreach ($coptsub['subOptions'] as $coptsubsub)
                                                                                                                    { 
                                                                                                                        if($coptsubsub['ans']){ 
                                                                                                                            echo '<li>';
                                                                                                                            echo $coptsubsub['ans']; 
                                                                                                                            echo '</li>';
                                                                                                                        }

                                                                                                                    }
                                                                                                                    echo '</ul>';
                                                                                                                }
                                                                                                                if($coptsub['ans']){ 
                                                                                                                    echo '</li>';
                                                                                                                }
                                                                                                                
                                                                                                            }
                                                                                                            echo '</ul>';
                                                                                                            echo '</div>';
                                                                                                        } 
                                                                                                        $i++;
                                                                                                        echo '</span>';
                                                                                                    } 
                                                                                                } ?>
                                                                                                        </div></span></b>
                                                                                                    </div>
                                                                                            <?php 
                                                                                            } 

                                                                                        }
                                                                                    } ?>
                                                                                                            </span></b>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                           <?php $cc_inc_id++; 
                                                            }
                                                            else
                                                            {
                                                                if(!empty($chieflist['questions']))
                                                                { 
                                                                    foreach($chieflist['questions'] as $chiefval) 
                                                                    {
                                                                        $alternate_span = 1;
                                                                        if($chiefval['surveyTaxonomyName'] == $cc)
                                                                        {
                                                                            $cred = '';
                                                                            if($chiefval['severity']!='low')
                                                                            {
                                                                                $cred = 'red';
                                                                            }
                                                                            ?>	
                                                                            <li id="<?php echo $chiefval['id']; ?>" class="list-group-item atumgroup col-md-6 col-sm-6 col-xs-6 <?php echo $cred; ?> "><span
    class="glyphicon glyphicon-bookmark top3"></span>&nbsp;<?php echo $chiefval['title']; ?></li>
                                                                            <li class="list-group-item atumgroup textalgrt col-md-6 col-sm-6 col-xs-6">
                                                                            <?php $prev_ans = '';$ans_temp = ''; $i=1; 
                                                                            foreach($chiefval['options'] as $copt) 
                                                                            {
                                                                                if($copt['ans'])
                                                                                {
                                                                                    if(in_array($copt['id'],$mval['prec_ids']))
                                                                                    {
                                                                                        $presc_id = array_search($copt['id'],$mval['prec_ids']);
                                                                                    ?>
                                                                                    <a>
                                                                                    <img id="rx_<?php echo $presc_id; ?>" onclick="doctor.getPrescriptionPopupView(<?php echo $presc_id; ?>); this.onclick=null"  class="fltrgt ohver mrglft10 wid27" 
                                                                                    title="Sent Prescription" data-toggle="tooltip" src="<?php echo $doc_images;?>rx.png">
                                                                                    </a>
                                                                                    <?php
                                                                                    }
                                                                                    if($copt['optionType'] == 'sticky')
                                                                                    { 
                                                                                        $coordinates    =   json_decode($copt['ans']);
                                                                                        ?>
                                                                                        <div style="background:url('<?php echo $copt['value']; ?>') no-repeat ; width:480px; height:480px;margin-top:-10px" id="sticky_<?php echo $cc_inc_id; ?>" />
                                                                                        <input type="hidden" class="stickyImageid" value="<?php echo $cc_inc_id; ?>" />
                                                                                        <input type="hidden" class="stickyIds" id="sticky_coordinates<?php echo $cc_inc_id; ?>"  value='<?php echo $copt['ans']; ?>'  />
                                                                                    <?php 
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $ans    =   $copt['ans'];
                                                                                        if($alternate_span%2 != 0)
                                                                                        {
                                                                                            $span_ans    =   '<span class="altbckgrd">'.$ans.'</span>';
                                                                                        }
                                                                                        else 
                                                                                        {
                                                                                            $span_ans    =   '<span class="altbckgrd2">'.$ans.'</span>';
                                                                                        }
                                                                                        $alternate_span++;  
                                                                                        $ans_temp   =   (!empty($ans_temp) && !empty(trim($ans)))?','.$span_ans:$span_ans;
                                                                                        echo $ans_temp; 

                                                                                    }
                                                                                    if(!empty($copt['subOptions'])) 
                                                                                    { ?>
                                                                                        <span class="list-group-item atumgroup col-md-6 col-sm-6 col-xs-6">
                                                                                        <?php foreach ($copt['subOptions'] as $coptsub)
                                                                                        {
                                                                                            echo '<div class="">';
                                                                                            echo '<ul style="list-style-type:disc" class="parent_ul">';
                                                                                            if($coptsub['ans']){
                                                                                                echo '<li>';
                                                                                                echo $coptsub['ans'];
                                                                                            }
                                                                                            if(!empty($coptsub['subOptions'])) 
                                                                                            {   
                                                                                                echo '<ul style="list-style-type:disc">';
                                                                                                foreach ($coptsub['subOptions'] as $coptsubsub)
                                                                                                { 
                                                                                                    if($coptsubsub['ans']) {
                                                                                                        echo '<li>';
                                                                                                        echo $coptsubsub['ans']; 
                                                                                                        echo '</li>';
                                                                                                }
                                                                                            } 
                                                                                                echo '</ul>';
                                                                                            }
                                                                                            if($coptsub['ans']){
                                                                                                echo '</li>';
                                                                                            }
                                                                                            echo '</ul>';
                                                                                            echo '</div>';
                                                                                        }?>
                                                                                        </span>
                                                                                    <?php 
                                                                                    } 
                                                                                    $i++;
                                                                                } 
                                                                            } ?>
                                                                            </li>
                                                                        <?php 
                                                                        } 
                                                                    } 
                                                                }
                                                            }
                                                        }
                                                        if($key == 'diagnosis' && !empty($ccarray))
                                                        {?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php // new block sridevi removed one div
                                                        }
                                                    }?>		
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php 
        } // sridevi remved 2 div closings
// sridevi remved 2 div closings
        
        if(!empty($mval['hospital_list'])){
            echo '<ul>';
            
            foreach($mval['hospital_list'] as $hospital){
                ?>
                    <span class="list-group-item atumgroup textalglt col-md-12 col-sm-12 col-xs-12"><b>Referred Hospital Info:</b></span>
                    <span class="list-group-item atumgroup textalglt col-md-6 col-sm-6 col-xs-6">Name</span><span class="list-group-item atumgroup textalgrt col-md-6 col-sm-6 col-xs-6"><?php echo $hospital['name']; ?></span>
                    <span class="list-group-item atumgroup textalglt col-md-6 col-sm-6 col-xs-6">Address</span><span class="list-group-item atumgroup textalgrt col-md-6 col-sm-6 col-xs-6"><?php echo $hospital['address']; ?></span>
                    <span class="list-group-item atumgroup textalglt col-md-6 col-sm-6 col-xs-6">Contact</span><span class="list-group-item atumgroup textalgrt col-md-6 col-sm-6 col-xs-6"><?php echo $hospital['contact_number']; ?></span>
                    
                    <?php
            }
            echo '</ul>';
        }?>
        
                
            
        
         <?php if(isset($feedback_ids[$mval['id']])){
             ?>
                    <div class="panel-group">
            <div class="panel panel-default">
                <a data-toggle="collapse" href="#feedback<?php echo $mval['id']; ?>" class="textgreen visitid">
                    <div class="panel-heading">
                        <h6 class="panel-title font15">
                            <b>Doctor Feedback</b>

                        </h6>
                    </div>
                </a>
             
             <div id="feedback<?php echo $mval['id']; ?>" class="panel-collapse collapse in">
                    <div class="panel-body ">
                                                                                                                            <div class="row borbotm">

                                            <span id="" class="list-group-item atumgroup col-md-4 col-sm-4 col-xs-4  ">
                                                <span class="glyphicon glyphicon-bookmark top3"></span><span>&nbsp;</span>Remarks:</span>
                                            <b>
                                            <span class="list-group-item atumgroup textalgrt col-md-8 col-sm-8 col-xs-8">
                                            <span class="altbckgrd"></span><?php echo $feedback_ids[$mval['id']]['comments']; ?></span></b>
                                        </div>
                                                                                                                                    <div class="row borbotm">

                                            <span id="" class="list-group-item atumgroup col-md-4 col-sm-4 col-xs-4  ">
                                                <span class="glyphicon glyphicon-bookmark top3"></span><span>&nbsp;</span>Retake:</span>
                                            <b>
                                            <span class="list-group-item atumgroup textalgrt col-md-8 col-sm-8 col-xs-8">
                                            <span class="altbckgrd2"><?php echo ($feedback_ids[$mval['id']]['is_retake'] == 1)?'Yes':'No'; ?></span>
                                            </span></b>
                                        </div>
                    </div>
                </div>       
             
             
              </div>
        </div>  
        <?php }else{?>
            <a  id="retake_button_<?php echo $mval['id']; ?>"><i class="fa fa-repeat fa-fw hffbcg contact-toggle fltrgt ohver retk"
		title="Remarks " data-toggle="tooltip" src="<?php echo $doc_images.'retake.png'; ?>"></i>
			<img  ></a>
        <?php } ?>
		
		<!-- <b class="redtext">Send Prescription</b> --> <!--</button>-->
        
        <div class="container fltrgt width70 contact-box" hidden>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
        <h4>Comment</h4>
        <textarea rows="4" cols="4" class="widht" id="comments_<?php echo $mval['id']; ?>">
        </textarea>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
        <label><input class="margintp70" type="checkbox" id="is_retake_<?php echo $mval['id']; ?>" /> Re-Take</label>
        <button class="retake" id="retake_close_button_<?php echo $mval['id']; ?>">X</button>
        
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            <button class="col-lg-5 col-md-5 col-sm-12 col-xs-12 cmt-btn" id="doctor_remarks_submit_button<?php echo $mval['id']; ?>"  onclick="doctor.saveDoctorFeedback(<?php echo $mval['id']; ?>);">Submit</button>
        </div>      
        </div>
        
        
        
        
                            
						</div>
					</div>
				</div>
                                </div>
         </div>
			<!-- removing div for box shadow going up </div>-->
		 <?php  $vd++; } }?>  
		
        
        

    

</div>
<?php }else { ?>
<div><?php echo $message; ?></div>
<?php } ?>
 <!-- End Right Column -->
    </div>
<!-- End page content -->
</div>
<div id="prescription_popup">
    
</div>

<script type="text/javascript">
$(document).ready(function() {
//    $( ".visitid<?php // echo $visitid; ?>,.chiefcompoaintBlock<?php // echo $visitid; ?>" ).trigger( "click" );

} );
</script>
</div>
    </div>
</div>
