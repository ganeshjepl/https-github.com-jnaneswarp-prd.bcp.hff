<div class="modal fade" id="prescription2" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog w3-animate-top w3-card-12">

        <!--  Add new Modal content start -->
        <div class="modal-content animate-top card-8 doc-press-box">

            <div class="modal-body">

                <div class="w3-container w3-teal">

                    <img src="<?php echo site_url(); ?>/images/doctor/rx.png" class="w3-left w3-margin-right pres">

                    <div class="fltrgt">
                        <table class="table clorwht">
                            <tr>
                                <th class="bodtop">Name :</th>
                                <th class="text-center bodtop w3-left">Dr.<?php echo $doctor_details['firstName'] . ' ' . $doctor_details['lastName']; ?></th>
                            </tr>
            <!--		<tr>
                                    <th class="bodtop">Prescription ID :</th>
                                    <th class="text-center bodtop w3-left">prid0111</th>
                            </tr>-->
                            <tr>
                                    <th class="bodtop">Visit ID :</th>
                                    <th class="text-center bodtop w3-left">vid111</th>
                            </tr>
                            <tr>
                                <th class="bodtop">Visit Date :</th>
                                <th class="text-center bodtop w3-left"><?php echo date('d-M-Y', time()); ?></th>
                            </tr>


                        </table>
                    </div>

                </div>

            </div>
            <div class="mrgallsides demo">


                <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">

                    <div class="panel panel-default">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsezero" 
                           aria-expanded="false" aria-controls="collapsezero">
                            <div class="panel-heading" role="tab" id="headingzero">
                                <h4 class="panel-title">
                                    BCP Details

                                </h4>
                            </div>
                        </a>
                        <div id="collapsezero" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingzero">
                            <div class="panel-body">
                                <div class="w3-container "><!--w3-teal -->

                                    <div class="fltlft">
                                        <table class="table "><!--clorwht -->
                                            <tr>
                                                <td>
                                            <div>
                                            <select id="id_bcp_list" onchange="doctor.getAssignedPatients(this.value);" class="select2 width220">
                                            </select>
                                            </div>
                                            <span id="bcplist_error" class="text-danger"></span>
                                            
                                            <div>
                                            <select id="id_patient" class="select2 width220">
                                                <option>-- Select --</option>   
                                            </select>
                                            </div>
                                            <span id="patientlist_error" class="text-danger"></span>
                                            </td>
                                                <td>
                                                <input type="radio" name="incident_type" checked id="radio_incident" value="incident" > <label for="radio_incident">Incident</label>
                                                <input type="radio" name="incident_type" id="radio_followup" value="followup" > <label for="radio_followup">Followup</label>             
                                                </td>

                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    Patient Details

                                </h4>
                            </div>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="col-md-12 col-sm-6 table-responsive patinfo nopad patdet from-box-doc">
                                    <div class="col-md-6 col-sm-6">
                                        <input id="name" class="form-control logininput" required type="text" placeholder="Patient Name"/>
                                        <span id="error_pname" class="text-danger"></span>
                                        
                                        <input id="contact" class="form-control logininput" required type="text" placeholder="Contact"/>
                                        <span id="error_contact" class="text-danger"></span>
                                        
                                        <input id="village" class="form-control logininput" required type="text" placeholder="Village"/>
                                        <span id="error_village" class="text-danger"></span>

                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <select id="gender" class="form-control logininput" required>
                                            <option value="" >Select Gender</option>
                                            <option value="male" >Male</option>
                                            <option value="female" >Female</option>
                                        </select>
                                        <span id="error_gender" class="text-danger"></span>
                                        <input id="age" class="form-control logininput" required type="text" placeholder="Age"/>
                                        <span id="error_age" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--        <div class="panel panel-default">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        
                                            <i class="more-less glyphicon glyphicon-chevron-right"></i>
                                            Medical Notes
                                       
                                    </h4>
                                </div>
                                                     </a>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="w3-container w3-card-2 w3-white w3-margin-bottom note-box">
                            <img src="docpics/prescription.png" class="w3-left w3-margin-right wid22">
                             <i class="fa fa-hospital-o fa-fw w3-margin-right w3-large"></i> 
                            <b>Medical Notes</b>
                            <ul>
                             <li>SPO2    : 45</li>
                             <li>Oxygen  : 50%</li>
                             <li>HR      : 100</li>
                            </ul>
                            
                            </div>
                                    </div>
                                </div>
                            </div>-->

                    <!--        <div class="panel panel-default">
                                 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                       
                                            <i class="more-less glyphicon glyphicon-chevron-right"></i>
                                            Drug History
                                       
                                    </h4>
                                </div>
                                                      </a>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                         <div class="w3-container w3-card-2 w3-white w3-margin-bottom note-box">
                            
                            <img src="docpics/medicines.png" class="w3-left w3-margin-right wid22">
                            <b class="fltrgt">6/24/2016</b>
                            <b class="fltrgt">Date Of Prescription : </b>
                            
                            <div class="col-md-12 col-sm-6 table-responsive nopad">
                                                    <table class="table table-bordered table-hover table-sortable prevpresp" id="tab_logic">
                                                            <thead>
                                                                    <tr>
                                                                            <th class="text-center">Medicine</th>
                                                                            <th class="text-center">Dosage</th>
                                                                            <th class="text-center">Quantity</th>
                                                                            <th class="text-center">Timing</th>
                                                                             <th class="text-center">Days</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <tr class="texalgn">
                                                                            <th data-name="name">Nasal decongestants</th>
                                                                            <th data-name="mail">300mg</th>
                                                                            <th data-name="name">2</th>
                                                                            <th data-name="mail">after meal</th>
                                                                            <th data-name="name">6 days</th>
                                                                    </tr>
                                                                    <tr class="texalgn">
                                                                            <th data-name="name">Expectorants</th>
                                                                            <th data-name="mail">300mg</th>
                                                                            <th data-name="name">1</th>
                                                                            <th data-name="mail">Before Dinner</th>
                                                                            <th data-name="name">7 days</th>
                                                                    </tr>
                                                                    <tr class="texalgn">
                                                                            <th data-name="name">Antihistamines</th>
                                                                            <th data-name="mail">300mg</th>
                                                                            <th data-name="name">1</th>
                                                                            <th data-name="mail">Before Lunch</th>
                                                                            <th data-name="name">15 days</th>
                                                                    </tr>
                                                                    
                                                            </tbody>
                                                             
                                                    </table>
                                            </div>
                    
                            </div>
                                    </div>
                                </div>
                            </div>-->

                    <div class="panel panel-default">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour"
                           aria-expanded="false" aria-controls="collapsefour">
                            <div class="panel-heading" role="tab" id="headingfour">
                                <h4 class="panel-title">
                                    Medicine

                                </h4>
                            </div>
                        </a>
                        <div id="collapsefour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfour">
                            <div class="panel-body">
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-6 table-responsive">
                                        <table class="table table-bordered table-hover table-sortable"
                                               id="prescription_add_table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Medicine</th>
                                                    <th class="text-center">Dosage</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Timing</th>
                                                    <th class="text-center">Days</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id='addr0' data-id="0" class="hidden">
                                                    <td data-name="medicine">
                                                        <select onchange="doctor.setMedicineDosage(this.value, this.id);" id="medicine" class="select2" style="width: 125px !important;">
                                                            <option value="" selected>-- Select --</option>
                                                            <?php echo $catelog; ?>
                                                        </select>
                                                    </td>
                                                    <td data-name="dosage"><input type="text" name='dosage0'
                                                                                  placeholder='500mg' class="form-control" /></td>
                                                    <td data-name="quantity"><input type="text" name='quantity0'
                                                                                    placeholder='2' class="form-control" /></td>
                                                    <td data-name="timing"><input type="text" name='timing0'
                                                                                  placeholder='2 times a day' class="form-control" /></td>
                                                    <td data-name="days"><input type="text" name='days0'
                                                                                placeholder='Days' class="form-control" /></td>
                                                    <td data-name="del">
                                                        <button name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove' onclick="doctor.deleteRow('prescription_add_table', this.id);"></button>
                                                    </td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                    <button id="presc_add_new_button_add" onclick="doctor.addRows('prescription_add_table');" type="button" class="w3-right w3-btn w3-teal w3-section w3-margin-right" 
                                            ><span class="glyphicon glyphicon-plus"></span></button><br>
                                    <img src="<?php echo $doctor_details['signature_picture']; ?>" class="w3-right w3-margin-right wid100">
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- panel-group -->


            </div><!-- container -->
            <div class="modal-footer">

                <a  class="w3-right w3-teal w3-btn" href="#" onclick="doctor.addPrescription();
                      $(this).attr('disabled', 'true');">Submit</a>
                <!--       <button id="submitsms" type="submit" class="w3-left w3-teal  w3-btn marg10" data-dismiss="modal">Send By SMS</button>-->
                <!--  <a class="w3-left w3-teal w3-section w3-btn" href="doc_send_prescription.html">Submit</a>
                 <a  class="w3-left w3-teal w3-section w3-btn marg10" href="doc_send_prescription.html">Send By SMS</a> -->

                <button type="button" class="w3-left w3-btn w3-red " data-dismiss="modal">Close</button>
            </div>
        </div>
        <!--Add new modal end -->
    </div>
</div>

