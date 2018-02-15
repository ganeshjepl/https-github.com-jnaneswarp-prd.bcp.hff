<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BCP DATA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/ctrl/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>plugins/datatables/dataTables.bootstrap.css">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/ctrl/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/ctrl/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b>FF</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>HFF</span>
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

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo site_url(); ?>images/ctrl/A.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo site_url(); ?>images/ctrl/A.png" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="admin_login.html" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-table"></i> <span>List's</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span></a>
          <ul class="treeview-menu">
            <li class=""><a href="data.html"><i class="fa fa-circle-o"></i>BCP's List</a></li>
            <li class=""><a href="doctor.html"><i class="fa fa-circle-o"></i>Doctor's List</a></li>
          </ul>
        </li>
        <li class="">
          <a href="medicine_catalog.html">
            <i class="fa fa-th"></i> <span>Medicine Catalog</span></a>
        </li>
        <li class="">
          <a href="network_hospital.html">
            <i class="fa fa-th"></i> <span>Network Of Hospitals</span></a>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/charts/chartjs.html"><i class="fa fa-circle-o"></i>ChartJS</a></li>
            <li><a href="/charts/morris.html"><i class="fa fa-circle-o"></i>Morris</a></li>
            <li><a href="/charts/flot.html"><i class="fa fa-circle-o"></i>Flot</a></li>
            <li><a href="/charts/inline.html"><i class="fa fa-circle-o"></i>Inline charts</a></li>
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>BCP<small></small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">BCP DATA</h3>
               <a id="insert-more" class="pull-right btn btn-default btn-flat">Add New Row</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Sign-Up Date</th>
                  <th>Country</th>
                  <th>Zip Code</th>
                  <th>Mobile</th>
                  <th>Alt No.</th>
                  <th>Language</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><span class="edit1">1</span></td>
                  <td><span class="edit1">Internet Explorer 4.0</span></td>
                  <td><span class="edit1">1</span></td>
                  <td><span class="edit1">aaa</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">A</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">B</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">R</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">D</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">E</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">F</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">G</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">H</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                <tr>
                  <td><span class="edit1">Trident</span></td>
                  <td><span class="edit1">Internet Explorer 5.0</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1">5</span></td>
                  <td><span class="edit1">C</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                  <td><span class="edit1"> 4</span></td>
                  <td><span class="edit1">X</span></td>
                  <td><span class="edit1">Win 95+</span></td>
                </tr>
                
               
                </tbody>
                <!-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> -->
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
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo site_url(); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo site_url(); ?>js/ctrl/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo site_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo site_url(); ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo site_url(); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo site_url(); ?>plugins/fastclick/fastclick.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo site_url(); ?>js/ctrl/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo site_url(); ?>js/ctrl/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      
    });
  });
</script>
<script>
$(".edit1").editable();  //for editing tables

$("#insert-more").click(function () {
    $("#example1").each(function () {
        var tds = '<tr>';
        jQuery.each($('tr:last td', this), function () {
            tds += '<td><span class="edit1 editable editable-click"></span></td>';
        });
        tds += '</tr>';
        if ($('tbody', this).length > 0) {
            $('tbody', this).append(tds);
        } else {
            $(this).append(tds);
        }
    });
    $(".edit1").editable();  //for editing tables for newly added rows
});


</script>   
</body>
</html>
