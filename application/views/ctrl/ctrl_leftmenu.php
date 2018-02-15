  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        
        <li class="treeview <?php if($active=='useractive'){ echo "active" ; } ?>">
          <a href="#">
            <i class="fa fa-table"></i> <span>Lists</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span></a>
          <ul class="treeview-menu ">
            <li class=""><a href="<?php  echo  getUrl('bcpList')?>"><i class="fa fa-circle-o"></i>BCP's List</a></li>
            <li class=""><a href="<?php  echo getUrl('doctorList')?>"><i class="fa fa-circle-o"></i>Doctor's List</a></li>
          </ul>
        </li>
        <li class="<?php if($active=='medicineactive'){ echo "active" ; } ?>">
          <a href="<?php  echo   getUrl('medicineCatalog') ?>">
            <i class="fa fa-th"></i> <span>Medicine Catalog</span></a>
        </li>
        <li class="<?php if($active=='networkactive'){ echo "active" ; } ?>" >
            <a href="<?php  echo getUrl('networkHospital')?>">
            <i class="fa fa-th"></i> <span>Network Of Hospitals</span></a>
        </li>
        
        <li class="<?php if($active=='reportactive'){ echo "active" ; } ?>">
          <a href="<?php  echo getUrl('Reports') ?>">
            <i class="fa fa-pie-chart"></i>
            <span>Reports</span>
                
          </a>
          
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>