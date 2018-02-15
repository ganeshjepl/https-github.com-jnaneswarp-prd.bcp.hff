
<div class="modal fade" id="prescription1" role="dialog" data-keyboard="false" data-backdrop="static">

	<div class="modal-dialog w3-animate-top w3-card-12">
    
     <!--  Add new Modal content start -->
      <div class="modal-content animate-top card-8 doc-press-box">
        
        <div class="modal-body">	 
			
        <div class="w3-container w3-teal">
    <img src="<?php echo site_url();?>/images/doctor/rx.png" class="w3-left w3-margin-right pres"> 
      <div class="fltrgt">
       <table class="table clorwht">
		<tr>
			<th class="bodtop">Name :</th>
			<th class="text-center bodtop w3-left">Dr.<?php echo $doctor_details['firstName'].' '.$doctor_details['lastName']; ?></th>
		</tr>
<!--		<tr>
			<th class="bodtop">Prescription ID :</th>
			<th class="text-center bodtop w3-left">prid0111</th>
		</tr>-->
		<tr>
			<th class="bodtop">Visit ID :</th>
			<th class="text-center bodtop w3-left"><?php echo $presc_details['visitCode']; ?></th>
		</tr>
		<tr>
			<th class="bodtop">Visit Date :</th>
			<th class="text-center bodtop w3-left"><?php echo date('Y-m-d h:i A',strtotime($presc_details['visitregistrationDate'])); ?></th>
		</tr>
		<tr>
			<th class="bodtop">Date :</th>
			<th class="text-center bodtop w3-left"><p class="currentdate"><?php echo date('Y-m-d h:i A',time()); ?></p></th>
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
			<th class="bodtop">BCP Name :</th>
			<th class="text-center bodtop w3-left"><?php echo $bcp_details['firstName'].' '.$bcp_details['lastName']; ?></th>
		</tr>
		<tr>
			<th class="bodtop">BCP Contact :</th>
			<th class="text-center bodtop w3-left"><?php echo $bcp_details['mobile']; ?></th>
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
                    <div class="w3-container "><!--w3-teal -->

      <div class="fltlft">
      <table class="table "><!--clorwht -->
      <tr>
			<th class="bodtop">Patient Name :</th>
			<th class="text-center bodtop w3-left"><?php echo $patient_details['firstName'].' '.$patient_details['middleName'].' '.$patient_details['lastName']; ?></th>
		</tr>
		<tr>
			<th class="bodtop">Gender :</th>
			<th class="text-center bodtop w3-left"><?php echo $patient_details['gender']; ?></th>
		</tr>
		<tr>
			<th class="bodtop">Age :</th>
			<th class="text-center bodtop w3-left"><?php echo $patient_details['age']; ?></th>
		</tr>
				</table>
      </div>
      </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
			<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <div class="panel-heading" role="tab" id="headingTwo">
                 
				<h4 class="panel-title">
                        Medical Notes 
                </h4>
				<!-- <img src="<?php echo site_url();?>/images/doctor/prescription.png" class="w3-left w3-margin-right wid22"> -->
            </div>
				 </a>
            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <div class="w3-container  w3-white w3-margin-bottom note-box">
       
        <!-- <i class="fa fa-hospital-o fa-fw w3-margin-right w3-large"></i> -->
        <table class="table">
        <tr>
			<td class="bodtop">Chief Complaint</td>
			<td class="text-center bodtop w3-left">: <?php echo $medical_notes['cc_name']; ?></td>
		</tr>
		<tr>
			<td class="bodtop">Diagnosis</td>
			<td class="text-center bodtop w3-left">: <?php echo $medical_notes['taxanomy']; ?></td>
		</tr>
		<tr>
			<td class="bodtop">Requested Medicine</td>
			<td class="text-center bodtop w3-left">: <?php echo $medical_notes['option']; ?></td>
		</tr>
				</table>
        
        </div>
                </div>
            </div>
        </div>

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
					id="prescription_saving_doc">
					<thead>
						<tr>
							<th class="text-center">Medicine</th>
							<th class="text-center">Dosage</th>
							<th class="text-center">Quantity</th>
							<th class="text-center">Timing</th>
							<th class="text-center">Days</th>
							<th class="text-center">Dispenced Qty</th>
						</tr>
					</thead>
					<tbody ng-app="medicines_catalog_app" ng-controller="country">
						<tr id='addr0' data-id="0" class="hidden" >
							<td data-name="medicine">
                                                            <select onchange="doctor.setMedicineDosage(this.value,this.id);" id="medicine" class="select2" style="width: 125px !important;">
                                                                <option value="" selected>-- Select --</option>
                                                                <?php echo $catelog; ?>
                                                            </select>
                                                        </td>
							<td data-name="dosage"><input type="text" name='dosage0'
                                                                                      placeholder='500mg' class="form-control" readonly="" /></td>
							<td data-name="quantity"><input type="text" name='quantity0'
								placeholder='2' class="form-control" /></td>
							<td data-name="timing"><input type="text" name='timing0'
								placeholder='2 times a day' class="form-control" /></td>
							<td data-name="days"><input type="text" name='days0'
								placeholder='Days' class="form-control" /></td>
							<td data-name="days"><input type="text" name='days0'
								placeholder='Days' class="form-control" /></td>
							
                                                        
                                                        
						</tr>
                                                <?php echo $sent_medicine; ?>
					</tbody>
					 
				</table>
			</div>
<!--			 <button id="presc_add_new_button" onclick="doctor.addRows('prescription_saving_doc');" type="button" class="w3-right w3-btn w3-teal w3-section w3-margin-right" 
			 ><span class="glyphicon glyphicon-plus"></span></button><br>-->
<img src="<?php echo $doctor_details['signature_picture'];?>" class="w3-right w3-margin-right wid100">
		</div>
                </div>
            </div>
        </div>

    </div><!-- panel-group -->
    
    
</div><!-- container -->
        <div class="modal-footer">
      <!--<a  id="prescription_saving_doc_save_button" class="w3-right w3-teal w3-btn" href="#" onclick="doctor.savePrescription();">Submit</a>-->
<!--       <button id="submit" type="submit" class="w3-left w3-teal  w3-btn" data-dismiss="modal">Submit</button>
       <button id="submitsms" type="submit" class="w3-left w3-teal  w3-btn marg10" data-dismiss="modal">Send By SMS</button>-->
       <!--  <a class="w3-left w3-teal w3-section w3-btn" href="doc_send_prescription.html">Submit</a>
        <a  class="w3-left w3-teal w3-section w3-btn marg10" href="doc_send_prescription.html">Send By SMS</a> -->

          <button type="button" class="w3-left w3-btn w3-red " 
                  onclick="
                      $('#rx_<?php echo $presc_details['id']; ?>').attr('onclick','doctor.getPrescriptionPopupView(<?php echo $presc_details['id']; ?>)');
                      $('#presc_button_<?php echo $presc_details['id']; ?>').attr('disabled',false);
                  " 
                  data-dismiss="modal">Close</button>
        </div>
      </div>
      <!--Add new modal end -->
</div>
	</div>
	
    
 <!-- Hidden fields -->
 <input type="hidden" id="hidden_prescription_request_id" value="<?php echo $presc_details['id']; ?>" />
 <input type="hidden" id="hidden_incident_id" value="<?php echo $presc_details['medical_incident_id']; ?>" />
 <input type="hidden" id="hidden_visit_id" value="<?php echo $presc_details['medical_visit_id']; ?>" />
 <input type="hidden" id="hidden_bcp_id" value="<?php echo $bcp_details['id']; ?>" />
 
 
 


<div class="modal fade send-press-box" id="prescription11" role="dialog">
    <div class="modal-dialog w3-animate-top w3-card-8">
    
     <!--  Modal content -->
      <div class="modal-content animate-top card-8">
        <div class="w3-container w3-teal w3-center ">

    <img src="<?php echo site_url();?>/images/doctor/rx.png" class="w3-left w3-margin-right pres">
      
      <div class="fltlft">
       <table class="table clorwht">
		<tr>
			<th class="bodtop">Name :</th>
			<th class="text-center bodtop w3-left">Dr.<?php echo $doctor_details['firstName'].' '.$doctor_details['lastName']; ?></th>
		</tr>
<!--		<tr>
			<th class="bodtop">Prescription ID :</th>
			<th class="text-center bodtop w3-left">prid0111</th>
		</tr>-->
		<tr>
			<th class="bodtop">Visit ID :</th>
			<th class="text-center bodtop w3-left"><?php echo $presc_details['visitCode']; ?></th>
		</tr>
		<tr>
			<th class="bodtop">Visit Date :</th>
			<th class="text-center bodtop w3-left"><?php echo $presc_details['visitregistrationDate']; ?></th>
		</tr>
		
</table>
      </div>

      <div class="fltrgt">
      <table class="table clorwht">
      <tr>
			<th class="bodtop">BCP Name :</th>
			<th class="text-center bodtop w3-left"><?php echo $bcp_details['firstName'].' '.$bcp_details['lastName']; ?></th>
		</tr>
		<tr>
			<th class="bodtop">BCP Contact :</th>
			<th class="text-center bodtop w3-left"><?php echo $bcp_details['mobile']; ?></th>
		</tr>
		<tr>
			<th class="bodtop">Date :</th>
			<th class="text-center bodtop w3-left"><p class="currentdate"><?php echo date('d-M-Y',time()); ?></p></th>
		</tr>
				</table>
      </div>
      
	      <div class="col-md-12 col-sm-6 table-responsive patinfo nopad patdet">
	      <table class="table clorwht">
			<tr>
				<th class="bodtop txtalrgt">Patient Name :</th>
				<th class="text-center bodtop w3-left"><?php echo $patient_details['firstName'].' '.$patient_details['middleName'].' '.$patient_details['lastName']; ?></th>
	
				<th class="bodtop txtalrgt">Gender :</th>
				<th class="text-center bodtop w3-left"><?php echo $patient_details['gender']; ?></th>
					
				<th class="bodtop txtalrgt">Age :</th>
				<th class="text-center bodtop w3-left"><?php echo date_diff(date_create($patient_details['dateofBirth']), date_create('now'))->y; ?></th>
					
			</tr>
					</table>
	      </div>
	        </div>
        <div class="modal-body">
<!--        <div class="w3-container w3-card-2 w3-white w3-margin-bottom note-box">
        <img src="<?php echo site_url();?>/images/doctor/prescription.png" class="w3-left w3-margin-right wid22">
         <i class="fa fa-hospital-o fa-fw w3-margin-right w3-large"></i> 
        <b>Medical Notes</b>
        <ul>
         <li>SPO2    : 45</li>
         <li>Oxygen  : 50%</li>
         <li>HR      : 100</li>
        </ul>
        
        </div>-->
        
      <!--  <div class="w3-container w3-card-2 w3-white w3-margin-bottom note-box">  -->
        
<!--        <img src="<?php echo site_url();?>/images/doctor/medicines.png" class="w3-left w3-margin-right wid22">
        <b>Drug History</b>-->
<!--        <b class="fltrgt">6/24/2016</b>
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

        </div>-->
        <div class="row clearfix">
			<div class="col-md-12 col-sm-6 table-responsive">
				<table class="table table-bordered table-hover table-sortable"
					id="prescription_saving_doc">
					<thead>
						<tr>
							<th class="text-center">Medicine</th>
							<th class="text-center">Dosage</th>
							<th class="text-center">Quantity</th>
							<th class="text-center">Timing</th>
							<th class="text-center">Days</th>
						</tr>
					</thead>
					<tbody ng-app="medicines_catalog_app" ng-controller="country">
						<tr id='addr0' data-id="0" class="hidden" >
							<td data-name="medicine">
                                                            <select onchange="doctor.setMedicineDosage(this.value,this.id);" id="medicine" class="select2" style="width: 125px !important;">
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
							
						</tr>
						<?php echo $sent_medicine; ?>
					</tbody>
					 
				</table>
			</div>
<!--			 <button id="presc_add_new_button" onclick="doctor.addRows('prescription_saving_doc');" type="button" class="w3-right w3-btn w3-teal w3-section w3-margin-right" 
			 ><span class="glyphicon glyphicon-plus"></span></button><br>-->
<img src="<?php echo $doctor_details['signature_picture'];?>" class="w3-right w3-margin-right wid100">
		</div>
     <!--   </div>       -->
      </div>
          <div class="modal-footer">

        <!--<a  class="w3-left w3-teal w3-btn" href="#" onclick="doctor.savePrescription();$(this).attr('disabled','true');">Submit</a>-->
        <!--<a  class="w3-left w3-teal w3-btn marg10" href="doc_send_prescription.html">Send By SMS</a>-->

          <button type="button" class="w3-right w3-btn w3-red" data-dismiss="modal">Close</button>
            
        </div>
      
    </div>
  </div>
</div>
    
 <!-- Hidden fields -->
 <input type="hidden" id="hidden_prescription_request_id" value="<?php echo $presc_details['id']; ?>" />
 <input type="hidden" id="hidden_incident_id" value="<?php echo $presc_details['medical_incident_id']; ?>" />
 <input type="hidden" id="hidden_visit_id" value="<?php echo $presc_details['medical_visit_id']; ?>" />
 <input type="hidden" id="hidden_bcp_id" value="<?php echo $bcp_details['id']; ?>" />