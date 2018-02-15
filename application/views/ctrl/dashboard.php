<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<style type="text/css">
@media only screen and (max-width: 768px) {
.sidebar-toggle {
    display: none;
}
}
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dashboard</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-2 dash-box">
        <a href="<?php  echo  getUrl('bcpList')?>">
          <div class="dash-icon-box"><i class="fa fa-user" aria-hidden="true"></i>
</div>
          <div class="dash-title-box">BCP's List</div>
        </a>
        </div>
        
        <div class="col-md-2 dash-box">
        <a href="<?php  echo getUrl('doctorList')?>">
          <div class="dash-icon-box"><i class="fa fa-user-md" aria-hidden="true"></i>
</div>
          <div class="dash-title-box">Doctor's List</div>
          </a>
        </div>
        
        <div class="col-md-2 dash-box">
        <a href="<?php  echo   getUrl('medicineCatalog') ?>">
          <div class="dash-icon-box"><i class="fa fa-plus-square" aria-hidden="true"></i>
</div>
          <div class="dash-title-box">Medicine Catalog</div>
          </a>
        </div>
        
        <div class="col-md-2 dash-box">
        <a href="<?php  echo getUrl('networkHospital')?>">
          <div class="dash-icon-box"><i class="fa fa-hospital-o" aria-hidden="true"></i>
</div>
          <div class="dash-title-box">Network Of Hospitals</div>
          </a>
        </div>
        
        <div class="col-md-2 dash-box">
        <a href="<?php  echo getUrl('Reports') ?>">
          <div class="dash-icon-box"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</div>
          <div class="dash-title-box">Reports</div>
          </a>
        </div>
        
        
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>