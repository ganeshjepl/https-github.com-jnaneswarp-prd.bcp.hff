
<?php $this->load->view('templates/datatables_template'); ?>
<div>
<div class="maindiv">
	<div id="loader"></div>
	<div class="container  animate-bottom mrgtop50" id="">
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
		<table class="table table-striped display responsive nowrap table-hover table-bordered" id="medical_records" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class=" sl-no"><h5><b>S. NO.</b></h5></th> 
                    <th class=""><h5><b>M R Number</b></h5></th> 
                    <th class=""><h5><b>Patient Name</b></h5></th>
                    <th class=""><h5><b>Visit ID</b></h5></th>
                    <th class=""><h5><b>Visit Date</b></h5></th>
                    <th class=""><h5><b>Incident Status</b></h5></th>
                    <th class=""><h5><b>BCP Name</b></h5></th>
                </tr>
            </thead>
            <tbody>
			<?php $i=1; 
                        if(!empty($medicallist))
                        foreach ($medicallist as $mdlist) {?> 	
            <tr>
                <td><?php echo $i; ?></td>
                <!--<td><a href="#" onclick='doctor.redirectMrDetails(<?php echo $mdlist["pid"];?>)'><?php echo $mdlist['mr_code']; ?></a></td>-->
                <td><a onclick="doctor.redirectMrDetails('<?php echo getUrl('Mrdetails').'?pid='.$mdlist['pid']; ?>'); return false;" href='#' ><b> <?php echo $mdlist['mr_code']; ?> </b></a></td>
                <!--<td><a onclick="doctor.redirectMrDetails(<?php // echo $mdlist["pid"];?>); return false;<?php // echo getUrl('Mrdetails').'?pid='.$mdlist['pid'].''; ?>"><b> <?php // echo $mdlist['mr_code']; ?> </b></a></td>-->
                <td ><?php echo $mdlist['pfirst_name'].' '.$mdlist['pmiddle_name'].' '.$mdlist['plast_name']; ?></td>
                <td><a onclick="doctor.redirectMrDetails('<?php echo getUrl('Mrdetails').'?pid='.$mdlist['pid']; ?>'); return false;" href='#' ><?php echo $mdlist['medicalIncidentVisitCode']; ?></a></td>
                <td><?php echo date('Y-m-d h:i A',strtotime($mdlist['registration_date'])); ?></td>
                <td><?php echo ucwords($mdlist['status']); ?></td>
				<td><a href="<?php echo getUrl('bcpProfile').'?bid='.$mdlist['bcpId']; ?>">
					<span class="glyphicon glyphicon-user"></span><?php echo $mdlist['bfirst_name'].' '.$mdlist['blast_name']; ?></a></td>
            </tr>
           <?php $i++; } ?> 
            </tbody>
        </table>
	</div>
 

</div>
<form action="<?php echo getUrl('Mrdetails'); ?>" id="redirectMrRecord" method="post">
   <input type="hidden" name="pid" id="pid" value="" />
</form>
</div>
<input type='hidden' id='hidden_page_id' />
	<script type="text/javascript">
$(document).ready(function() {
    	var table = $('#medical_records').DataTable({
            "fnPreDrawCallback": function( oSettings ) {
                var oSettings = $('#medical_records').dataTable().fnSettings();
                var currentPageIndex = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength) + 1;
                $('#hidden_page_id').val(currentPageIndex);
              }
        });
        <?php if($page_id > 0) {?>
            table.page( <?php echo $page_id-1; ?> ).draw( 'page' );
        <?php } ?>
        
//        table.page( 4 ).draw( 'page' );
        
        showPage();
} );
</script>
