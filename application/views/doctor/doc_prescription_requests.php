<link rel="stylesheet" href="<?php echo $doc_css_path ?>/mr<?php echo $doc_css_ext ?>">



<div onload="loader()"> 


<?php $this->load->view('templates/datatables_template'); ?>


	<div id="loader"></div>
	<div class="container  animate-bottom mrgtop50" id="preq-requests-table">
	<!-- overscrol -->
	
	<ul class="nav navbar-nav navbar-right" style="display: none;">						
					<li>
					<form class="navbar-form" role="search">
							<div class="input-group dataTables_filter" id="medical_records_filter">
		<input type="text" aria-controls="medical_records" id="medical_records_filter" class="form-control" placeholder="Search" name="q">
								<div class="input-group-btn paddbt11" style="display: none;">
									<button class="btn btn-default ht34" type="submit">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
						</form></li>

                         
				</ul>
                <div class="">
                    <div class="row">
                        <div class="col-md-6 pres-count"><span id="pending_requests">0</span> Pending Prescription Request</div>
                      <!--  <div class="col-md-6"><button class="btn editbutton fltrgt add-prescription-btn" type="button" data-toggle="modal" 
													  data-target="" onclick="doctor.getAddPrescriptionPopup(1);">Request Prescription </button></div> -->
                    </div>
                </div>
            
		<table class="table table-striped display responsive nowrap table-hover table-bordered" id="prescription_requests" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="sl-no" ><h5><b>S. NO.</b></h5></th> 
                    <th ><h5><b>MR Number</b></h5></th> 
                    <th class=""><h5><b>Patient Name</b></h5></th> 
                    <th class=""><h5><b>Bcp Name</b></h5></th> 
                    <th class=""><h5><b>Requested Date</b></h5></th>
                    <th class=""><h5><b>Action</b></h5></th>
                </tr>
            </thead>
            <tbody>
			<?php 
                            $i=1; 
                            $pending = 0; 
                            if(!empty($requests))
                            foreach ($requests as $request) 
                            {
                                
                               
                        ?> 	
            <tr>
                <td><b><?php echo $i; ?></b></td>
                <td><a onclick="doctor.redirectMrDetails('<?php echo getUrl('Mrdetails').'?ptl='.$back_page_title.'&bpg='.$back_page.'&pid='.$request['pid']; ?>'); return false;" href='#' ><b> <?php echo $request['mrnumber']; ?> </b></a></td>
                <!--<td><a href="<?php // echo getUrl('Mrdetails').'?pid='.$request['pid']; ?>"><b><?php // echo $request['mrnumber']; ?></b></a></td>-->
                <td><?php echo trim($request['firstName']).(!empty($request['middleName'])?' '.$request['middleName']:''); ?></td>
                <td><?php echo trim($request['bcpName']); ?></td>
                <td><?php echo date('Y-m-d h:i A',strtotime($request['registration_date'])); ?></td>
                <td> <?php if($request['is_sent'] == 1){
                    
                    ?>
                     <button id="presc_button_<?php echo $request['id']; ?>" class="btn editbutton " type="button" data-toggle="modal" data-target="#mrprescription1"><a onclick="doctor.getPrescriptionPopupView(<?php echo $request['id']; ?>); $('#presc_button_<?php echo $request['id']; ?>').attr('disabled','disabled'); ">View</a></button>

                <?php }else{ 
                    $pending++;
                    ?>
                    
                     <button id="presc_button_<?php echo $request['id']; ?>" class="btn editbutton" type="button" data-toggle="modal" data-target="#mrprescription1" onclick="doctor.getPrescriptionPopup(<?php echo $request['id']; ?>); $('#presc_button_<?php echo $request['id']; ?>').attr('disabled','disabled'); ">Send  Prescription</button>

                        
                <?php } ?>
                </td>
            </tr>
           <?php $i++; 
           
                } ?> 
            </tbody>
            <input type="hidden" id="hidden_pending_rquest" value="<?php echo $pending; ?>" />
        </table>
            <div id="prescription_popup">
                
            </div>
            <div id="prescription_popup_add">
                
            </div>
          					
  
	</div>


</div>
    <input type="hidden" id="prescription_requests_page" value="1" />
    <input type="hidden" id="hidden_page_id" />
</div>
  
<script type="text/javascript">
$(document).ready(function() {
	var table = $('#prescription_requests').DataTable({
            "order": [],
            "fnPreDrawCallback": function( oSettings ) {
                var oSettings = $('#prescription_requests').dataTable().fnSettings();
                var currentPageIndex = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength) + 1;
                $('#hidden_page_id').val(currentPageIndex);
              }
        });
        <?php if($page_id > 0) {?>
            table.page( <?php echo $page_id-1; ?> ).draw( 'page' );
        <?php } ?>
        showPage();
} );
</script>
