<!DOCTYPE html>
<html>
<head>
<title><?php echo $page_title;?></title>
	<link rel="shortcut icon" href="<?php   echo $doc_images;?>smalllogo.png" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<link rel="stylesheet" href="<?php echo $doc_plugin_path; ?>select2/select2<?php echo $doc_css_ext; ?>">
<link rel="stylesheet" href="<?php echo $doc_css_path; ?>bootstrap<?php echo $doc_css_ext; ?>">
<link rel='stylesheet' href="<?php echo $doc_css_path; ?>googleapis<?php echo $doc_css_ext; ?>">
<link rel="stylesheet" href="<?php echo $doc_css_path; ?>w3<?php echo $doc_css_ext; ?>">
<link rel="stylesheet" href='<?php echo $doc_css_path; ?>font-awesome<?php echo $doc_css_ext; ?>'>
<link rel="stylesheet" href="<?php echo $doc_css_path; ?>doc<?php echo $doc_css_ext; ?>">
<!-- <link rel="stylesheet" href="Style(css)/inputstyle.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script> -->
<script src="<?php echo $doc_js_path; ?>angularjs<?php echo $doc_js_ext; ?>"></script>
<script src="<?php echo $doc_js_path; ?>bootstrapjs<?php echo $doc_js_ext; ?>"></script>
 <script src='<?php echo $doc_js_path;?>jquery-ui<?php echo $doc_js_ext;?>'></script>
<script src="<?php echo $doc_js_path; ?>bootstrapjquerymin<?php echo $doc_js_ext; ?>"></script>
<script src="<?php echo $doc_js_path; ?>doc<?php echo $doc_js_ext; ?>"></script>
<!--<script src="<?php echo $doc_js_path; ?>validation<?php echo $doc_js_ext; ?>"></script>-->
<script src="<?php echo $doc_plugin_path; ?>select2/select2min<?php echo $doc_js_ext; ?>"></script>

<script src="<?php echo $doc_js_path; ?>githubjqueryblockui<?php echo $doc_js_ext; ?>"></script>
<script src="<?php echo $doc_js_path; ?>chili17pack<?php echo $doc_js_ext; ?>"></script>


</head>
<?php   $pageName = (isset($page) ? $page : "");
	if($pageName != "landing") {
	?> 
	
	<nav class="navbar navbar-fixed-top hffgreen">
  <div class="container-fluid">
			<div class="navbar-header">
			<p class="navbar-brand hffgreen labl">
                            <?php
                                if(isset($breadcrumbs) && !empty($breadcrumbs)){
                                    $i = 0;
                                    $concat =   '';
                                    foreach($breadcrumbs as $bread){ 
                                        if($i >0){
                                           $concat  =   '<span class="brthcrum-divide">/</span>' ;
                                        }
                                        echo $concat; ?>
                                        <a class="brth-title" href="<?php echo $bread['link']; ?>"><?php echo $bread['title']; ?></a>
                                    <?php $i++; }
                                    if(isset($tail) && !empty($tail)){ ?>
                                        <span class="brthcrum-divide">/</span>
                                        <span><?php echo $tail; ?></span></p>
                                    <?php }
                                }else{ ?>
                                    <a class="brth-title" href="">
                                    <?php echo $page_title; ?>
                                    </a>
                                <?php }
                            ?>
                            
                            
				<button type="button" class="navbar-toggle navbar-mob-top" data-toggle="collapse"
					data-target="#myNavbar">
					<span class="icon-bar bgwht" ></span>
					 <span class="icon-bar bgwht" ></span> 
					 <span class="icon-bar bgwht" ></span>
				</button>
					
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav hffgreen navbar-right">						
<!--				<li><a href="<?php// echo site_url().'doctor/home'; ?>">Home</a></li>-->
                                    <li><a href="<?php  echo  getUrl('doctorDashboard') ?>">Home</a></li>
				<li><a href="<?php echo getUrl('Mrrecord'); ?>">Medical Records</a></li> 
				<li><a href="<?php echo   getUrl('Prescription'); ?>">Prescription Requests</a></li> 
				<li><a href="<?php echo  getUrl('doctorProfile');  ?>">Doctor Profile</a></li> 	
				<li><a href="<?php echo getUrl('doctorLogout'); ?>">Logout</a></li> 
				</ul>
			</div>
  </div>
</nav>
	 <?php } ?>
	<body>