<?php $country = $country['response']['countryData'] ?>

<script src="<?php echo $ctrl_js_path.'angularjs'.$ctrl_js_ext?>"></script>
<script src="<?php echo $ctrl_js_path.'network_hospital'.$ctrl_js_ext?>"></script>
<!-- Add new row line modal start -->
<div class="modal fade add-row-box " id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header addbuttonheader">
                <button type="button" class="close addbutton" id="network_close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Add Network Hospital</h3>
            </div>
            <div class="success-msg-box"><span id="networkadd_sucess"></span></div>
            <div class="error-msg-box"><span id="networkadd_error"></span></div>
            <div class="modal-body card">

                <!-- content goes here -->
                <form novalidate id="networkhospital_add" method="post">
                    <div ng-app="Hff">
                        <div class="input-container">

                            <input type="text"   id="name" required="required"  value="" class="rmv"   >
                            <label  for="#{name}">Enter Name</label>
                            <span class="error-msg-box error-span" id='name_error'></span>
                            </div>
                            


                        <div class="input-container" ng-controller="country" ng-model="query">
                            <input type="text" list="country_sugg" class="rmv" autocomplete="off" id="country" name='countryid' required="required" ng-model="query" ng-keyup="countrysearch()" value="{{country.id}}">
                            <datalist id="country_sugg" ng-show="query">
                                <option  ng-repeat="country in countries| filter:query" data-id="{{country.id}}">{{country.name}} </option>
                            </datalist>
                            <label for="country">Select Country</label>
                            <span class="error-msg-box error-span" id='country_error'></span>  
                        </div>
                        <div class="input-container" ng-controller="state">

                            <input type="text" list='state_sugg' class="rmv" autocomplete="off" id="state" name='stateid' required="required" ng-model="squery" ng-keyup="statesearch()">
                            <datalist id="state_sugg" ng-show="query">
                                <option ng-repeat="state in states| filter:squery" data-id="{{state.id}}">{{state.name}} </option>
                            </datalist>
                            <label for="state">Select State</label>
                            <span class="error-msg-box error-span" id='state_error'></span>
                            </div>
                        <div class="input-container">

                            <input type="text" id="type" class="rmv" required="required"  value=""   >
                            <label for="type">Type</label>
                            <span class="error-msg-box error-span" id='type_error'></span> 
                        </div>
                        <div class="input-container">
                            <select id="status" required="required" >
                               
                                <option value="1" selected >Active</option>
                                <option value="0">InActive</option>
                            </select>
                             <label for="type">Status</label>
                             <span class="error-msg-box error-span" id='status_error'></span> 
                        </div>
                        <div class="input-container">

                            <input type="text"  id="contactnumber" required="required"   value=""  class="rmv"    >
                            <label for="contact-number">Contact Number</label>
                            <span class="error-msg-box error-span" id='contactnumber_error'></span>
                        </div>
                        
                        <div class="input-container">

                            <input type="text"   id="weburl" required="required"  value=""  class="rmv"   >
                            <label for="Website">Website Address</label> 
                            <span class="error-msg-box error-span" id='weburl_error'></span>
                            
                        </div>
                         
                        <div class="input-container">

                            <input type="text"   id="zipcode" required="required"  value=""  class="rmv"   >
                            <label for="zip">Zip Code</label> 
                            <span class="error-msg-box error-span" id='zipcode_error'></span>
                            
                        </div>

                        <div class="input-container">

                            <textarea class="textareapadd10 rmv" id="address" required="required"  value="" ></textarea>
                            <label for="address">Address</label>
                            <span class="error-msg-box error-span" id='address_error'></span>
                           
                        </div>
                        <input type="hidden"   value=""  id="networkEditId">
                        <div class="doc-profile-img">
                            <input type="submit" id='hospitalsubmit' class="btn btn-default card-btn addbutton" name="submit" value="Submit" >
 
                             </div>
                        <!--              <button type="submit" class="btn btn-default">Submit</button>-->
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
        <h1>NETWORK OF HOSPITALS</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                      <!--  <h3 class="box-title">HOSPITALS DATA</h3>  --> <div class="success-msg-box"><span  id="sucess_msg"></span></div> 
                        <div class="error-msg-box"><span  id="error_msg"></span></div>            <!-- <button  style="float: right;"> Add New Row </button> -->
                        <a data-toggle="modal" onclick='addhospital()' data-target="#squarespaceModal" class="pull-right btn btn-default btn-flat addbutton">Add Network Hospital</a>
                        <!--                        <a id="insert-more" class="pull-right btn btn-default btn-flat">Add New Row</a>-->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
            <div class="tbl-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S No.</th>
                                    <th>Name</th>
                                    <th>Address</th>
<!--                                    <th>Zip Code</th>-->
<!--                                    <th>Country Name</th>-->
                                    <th>Geo-Latitude</th>
                                    <th>Geo-Longitude</th>
                                    <th>Type</th>
                                     
                                    <th>Contact No.</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($response['status'] == 1) {
                                    $data = $response['response']['networkhospitalData'];
                                    $c = 1;
                                    foreach ($data as $key => $val) {
                                        ?>


                                        <tr id="networkhosp<?php echo $val['id'] ?>">
                                            <td><span  ><?php echo $c; ?></span></td>
                                            <td><span class="edit1" ><?php echo $val['name']; ?></span></td>
                                            <td><span class="edit1"><?php echo $val['address']; ?></span></td>
                                            <td><span class="edit1"><?php echo $val['geo_latitude']; ?></span></td>
                                            <td><span class="edit1"><?php echo $val['geo_longitude']; ?></span></td>
                                            <td><span class="edit1"><?php echo $val['type']; ?></span></td>
                                             <td><span class="edit1"> <?php echo $val['contact_number']; ?></span></td>
                                              <td><span class="edit1"><?php if($val['status']==0){ echo "In Active "; }else{ echo "Active" ;}  ?></span></td>
                                           
                                            <td><span class="edit1">
                                                    <a data-toggle="modal" title="Edit"   href="" onclick="editNetworkHosp(<?php echo $val['id']; ?>)" >
                                                        <i class="glyphicon glyphicon-edit">
                                                        </i></a> <?php /* / <a href="javacscript:void(0);"  title="Delete"  onclick="deleteNetworkHosp(<?php echo $val['id']; ?>)" ><i class="glyphicon glyphicon-remove-circle text-danger"></i></a> */?> </span></td>

                                        </tr>
        <?php $c ++;
    }
} ?>

                                <!-- </tfoot> -->
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
 

