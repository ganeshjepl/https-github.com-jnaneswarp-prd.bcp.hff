<style>
  
</style>
<!--Nav Menu -->

<div class="container mrgtop50">
<div class="w3-container w3-card-2 w3-white w3-margin-bottom">
<!-- Header -->
  
  
  <header id="portfolio" class="">
  <h4><b>BCP Details</b></h4> 
  <?php
  $imgurl= getUrl('profilePicFemale');
  if($profileData!==''){
  if($profileData[0]['profile_picture']!=''){
      $imgurl=$profileData[0]['profile_picture'];
  }   
  }?>
   
       <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 pull-left">
       <a href="#">
    <img src="<?php echo $imgurl?>" class="w3-left w3-margin-right img-circle mrbcpimg widht100">
    </a>
     </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 pull-right w3-margin-top">
     <i class="fa fa-user fa-fw  mrgrt5 w3-large hffbcg "></i><?php if($profileData!==''){
         echo $profileData[0]['firstName'];                 
     }else{
        echo 'No Data';
     }?><br>
     <i class="fa fa-phone fa-fw mrgrt5 w3-large hffbcg "></i><?php 
     if($profileData!==''){
     echo $profileData[0]['mobile'];}
     else{
         echo 'No data';
     }?><br>
     <i class="fa fa-home fa-fw  mrgrt5 w3-large hffbcg ">
     </i>
         <?php 
     if($profileData!==''){
     if($profileData[0]['city_name']!=='' ){
     echo $profileData[0]['city_name'].',';             
     }
     }
     if($profileData!==''){
     if($profileData[0]['state_name']){
     echo $profileData[0]['state_name'].',';
     }
     }
     if($profileData!==''){
     if($profileData[0]['country_name']){
     echo $profileData[0]['country_name'];     
     }
     
     }?><br>
     
     </div>
    
  </header> 
  </div>





<div class="w3-container w3-card-2 w3-white w3-margin-bottom">
	<div class="row">
        <div class="col-md-6">
            <h4>BCP DATA</h4>
        </div>
	</div>
   
    <div class="row">
         
        <div class="col-md-3">
          <ul data-pie-id="svg" class="chart-box">
            <li data-value="60">Number Of MR Records(<?php if(!empty($Mrcount[0]['value'])){echo $Mrcount[0]['value'];}?>)</li>
            <li data-value="20">Number Of Red Flags(<?php if(!empty($Mrcount[2]['value'])){echo $Mrcount[2]['value'];}?>)</li>
            <li data-value="12">Number of  Incidents(<?php if(!empty($Mrcount[3]['value'])){echo $Mrcount[3]['value'];}?>)</li>            
            <li data-value="50">Number Of Visits(<?php if(!empty($Mrcount[1]['value'])){echo $Mrcount[1]['value'];}?>)</li>
          </ul>
        </div>
        <div class="col-md-6">
            <div id="chartdiv">
               
            </div>
            
            
        </div>
       
        
        <div class="col-md-3">
          <!--<div id="svg"></div>-->
<!--          <div id="chartdiv"></div>-->
        </div>
    </div>
    </div>
</div>


<!-- HTML -->
<?php // debugArray(json_encode($chartData)); exit; ?>

<script src="<?php echo $doc_plugin_path; ?>amcharts/amcharts<?php echo $doc_js_ext; ?>"></script>
<script src="<?php echo $doc_plugin_path; ?>amcharts/pie<?php echo $doc_js_ext; ?>"></script>
<script src="<?php echo $doc_plugin_path; ?>amcharts/exportmin<?php echo $doc_js_ext; ?>"></script>
<link rel="stylesheet" href="<?php echo $doc_plugin_path; ?>amcharts/export<?php echo $doc_css_ext; ?>" type="text/css" media="all" />
<script src="<?php echo $doc_plugin_path; ?>amcharts/light<?php echo $doc_js_ext; ?>"></script>
<script src="<?php echo $doc_plugin_path; ?>amcharts/responsive<?php echo $doc_js_ext; ?>"></script>
<script>
    $(document).ready(function() {
     
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "pie",
  "theme": "light",
  "dataProvider": <?php echo json_encode($Mrcount)?>,
  "valueField": "value",
  "titleField": "label",
   "balloon":{
   "fixedPosition":true
  },
  "export": {
    "enabled": false
  },
  "responsive": {
    "enabled": true,
  }
} );
    });
</script>
