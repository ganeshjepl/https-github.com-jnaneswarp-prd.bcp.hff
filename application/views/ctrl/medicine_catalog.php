
<link rel="stylesheet" href="<?php echo $ctrl_css_path?>jquery-ui<?php echo $ctrl_css_ext?>">
<script src="<?php echo $ctrl_js_path.'angularjs'.$ctrl_js_ext?>"></script>
<script src="<?php echo $ctrl_js_path.'jquery-ui'.$ctrl_js_ext?>"></script>
<script>
    $(document).ready(function(){

    $("#expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: '+0d',
        yearRange: 'c-10:c+10',
        changeMonth: true,
        changeYear: true

     }).val();
 });
</script>
<?php 
//print_r($list);
//$data =  $list['response']['medicineCatalog']; 

 

?>
<!-- Add new row line modal start -->
<div class="modal fade add-row-box " id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header addbuttonheader">
      <button type="button" class="close addbutton" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      <h3 class="modal-title" id="lineModalLabel">Add New Row</h3>
    </div>
    <div class="modal-body card">
        <div class="success-msg-box"><span id="medicine_sucess">  </span></div>
         <div class="error-msg-box"><span id="medicine_error">  </span></div>
            <!-- content goes here -->
            <form id='medicinesubmit'novalidate>

                <input type='hidden' id='medicineid' name='medicineid' value="" >
            <div class="input-container">
            <input type="text" id="name" name='name' required='' class='rmv'>
           <label for="#{name}">Enter Medicine Name</label>
           <span class="error-msg-box error-span " id='nameerr'></span>
        </div>
  <div class="row">
      <div class="col-md-6">
          <div class="input-container">
            <input type="text" id="brand" name='brand' required="required" class='rmv'>
          <label for="#{brand}">Enter Brand Name</label>
         <span class="error-msg-box error-span " id='branderr'></span>
        </div>
      </div>
      <div class="col-md-6">
          <div class="input-container">
            <input type="text" id="generic_name" name='generic_name' required="required" class='rmv'>
          <label for="#{generic_name}">Enter Generic Name</label>
          <span class="error-msg-box error-span " id='generic_nameerr'></span>
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-6">
          <div class="input-container">
            <input type="text" id="dosage" name='dosage' required="required" class='rmv'>
          <label for="#{dosage}">Enter Dosage</label>
          <span class="error-msg-box error-span " id='dosageerr'></span>
        </div>
      </div>
      <div class="col-md-6">
          <div class="input-container">
            <input type="text" id="batch_number" name='batch_number' required="required" class='rmv'>
          <label for="#{batch_number}">Enter Batch Number</label>          
          <span class="error-msg-box error-span " id='batch_numbererr'></span>
        </div>
      </div>
  </div>
      <div class="row">
          <div class="col-md-6" id='exdate'>
              <div class="input-container">
            <input type="text" id="expiry_date" name='expiry_date' required="required" class='rmv' value="<?php echo date('Y-m-d'); ?>">
          <label for="#{expiry_date}">Select Expiry Date</label>
          
          <span class="error-msg-box error-span " id='expiry_dateerr'></span>
        </div>
          </div>  
          <div class="col-md-6">
              <div class="input-container" id='qnt'>
           <input type="text" id="quantity" name='quantity' required="required" class='rmv'>
           <label for="#{quantity}">Enter Quantity</label>
          <span class="error-msg-box error-span " id='quantityerr'></span>
        </div> 
          </div>    
      </div>
                         
        <div class="input-container">
            <input type="text" id="indications" name='indications' required="required" class='rmv'>
          <label for="#{indications}">Enter Indications</label>
          <span class="error-msg-box error-span " id='indicationserr'></span>
        </div>   
                
        
                
<!--       <div class="input-container">
            <input type="text" id="stock" name='stock' required="required" class='rmv'>
          <label for="#{stock}">Enter Stock</label>
          <span class="error-msg-box error-span " id='stockerr'></span>
        </div> -->
        <div class="doc-profile-img">
        <button type="submit" id='medicinesubmit' class="btn btn-default addbutton">Submit</button>
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
      <h1>MEDICINE CATALOG</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
          <!--    <h3 class="box-title">MEDICINE CATALOG DATA</h3> -->  <div class="success-msg-box"><span  id="sucess_msg">   </span></div> <div class="error-msg-box"> <span  id="error_msg"></span></div>              <!-- <button  style="float: right;"> Add New Row </button> -->
              <a data-toggle="modal" data-target="#squarespaceModal" onclick='addMedicine()' class="pull-right btn btn-default btn-flat addbutton">Add New Medicine</a>
<!--              <a id="insert-more" class="pull-right btn btn-default btn-flat">Add New Row</a>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="tbl-responsive">
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S No.</th>
                  <th>Medicine Name</th>
                  <th>Brand</th>
                  <th>Generic Name</th>
                  <th>Dosage</th>
                  <th>Batch No.</th>
                  <th>Expiry Date</th>
                  <th>Indications</th>
                  <th>Quantity</th>
                  <th>Stock In Hand</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                     if (is_array($list) && count($list) > 0) {
                                    $i=1;
                    
                    foreach($list as $key=>$val){?>
                <tr id="medicine<?php  echo $val['id'] ?>">
                   <td ><span class="edit1" id="<?php  echo $val['id']?>_1"> <?php  echo $i?></span></td>
                  <td><span class="edit1" id="<?php  echo $val['id']?>_2"><?php  echo $val['name']?></span></td>
                  <td><span class="edit1" id="<?php  echo $val['id']?>_3"><?php  echo $val['brand']?></span></td>
                  <td><span class="edit1" id="<?php  echo $val['id']?>_4"><?php  echo $val['generic_name']?></span></td>
                  <td><span class="edit1" id="<?php  echo $val['id']?>_5"><?php  echo $val['dosage']?></span></td>
                  <td><span class="edit1" id=<?php  echo $val['id']?>_6><?php  echo $val['batch_number']?></span></td>
                  <td><span class="edit1" id=<?php  echo $val['id']?>_7> <?php  echo $val['expiry_date']?></span></td>
                  <td><span class="edit1" id=<?php  echo $val['id']?>_8><?php  echo $val['indications']?></span></td>
                  <td><span class="edit1" id=<?php  echo $val['id']?>_9><?php  echo $val['quantity']?></span></td>
                  <td><span class="edit1" id=<?php  echo $val['id']?>_10><?php  echo $val['stock']?></span></td>
                  <td><a title="Edit"  onclick='editmedicine(<?php  echo $val['id']?>)'><i class="glyphicon glyphicon-edit"></i>
                  </a> / <a title="Delete"  onclick='deletemedicine(<?php  echo $val['id']?>)'>
                    <i class="glyphicon glyphicon-remove-circle text-danger"></i></a></span></td>
                </tr>
                    <?php $i++;
                    
                    } }?>
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
 <script src="<?php echo $ctrl_js_path.'Medicine_Catalog'.$ctrl_js_ext?>"></script>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
