<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title;?></title>
	<link rel="shortcut icon" href="<?php   echo $ctrl_images?>smalllogo.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $ctrl_css_path?>bootstrap.min.css">
<script src="<?php echo $ctrl_plugin_path ;?>jQuery/jquery-223min<?php echo $ctrl_js_ext ;?>"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $ctrl_css_path ?>font-awesomemin<?php echo $ctrl_css_ext ;?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $ctrl_css_path ?>ioniconsmin<?php echo $ctrl_css_ext ;?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $ctrl_plugin_path ?>datatables/dataTablesbootstrap<?php echo $ctrl_css_ext ;?>">
  
  <link href="<?php echo $ctrl_css_path ?>bootstrap-editable<?php echo $ctrl_css_ext ;?>" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo $ctrl_css_path ?>custom<?php echo $ctrl_css_ext ;?>">

    
  
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $ctrl_css_path ?>AdminLTEmin<?php echo $ctrl_css_ext ;?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $ctrl_css_path ?>skins/_all-skinsmin<?php echo $ctrl_css_ext ;?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->  
<script src="<?php echo $ctrl_js_path;?>githubjqueryblockui<?php echo $ctrl_js_ext ;?>"></script>
<script src="<?php echo $ctrl_js_path;?>chili17pack<?php echo $ctrl_js_ext ;?>"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php  echo  getUrl('Dashboard')?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b>FF</span>
      <!-- logo for regular state and mobile devices -->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="tab-view">
      <div class="tab-title-box">
    <a href="<?php  echo  getUrl('Dashboard')?>" class="logo">
      <span class="logo-lg"><b>Admin</b>HFF</span>
    </a>
    </div>
    </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php   echo $ctrl_images;  ?>A.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <div>
                <img src="<?php echo $ctrl_images; ?>A.png" class="img-circle wid100" alt="User Image">
                <p>Admin</p>
                </div>
<!--            <div class="pull-left">
                  <a href="<?php echo $site_url ?>ctrl/Admin/profile" class="btn btn-default btn-flat">Profile</a>
                </div>-->
                <div class="pull-right">
                    <a href="<?php  echo   getUrl('Logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
              <!-- Menu Footer-->
  <!--             <li class="user-footer">
               <div class="pull-left">
                  <a href="<?php echo $site_url ?>ctrl/Admin/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a href="<?php  echo   getUrl('Logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>-->
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
