<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $ctrl_js_path.'bootstrapmin'.$ctrl_js_ext?>"></script>
<script src='<?php echo $ctrl_js_path.'bootstrap-multiselect'.$ctrl_js_ext?>'></script>
<!-- DataTables -->
<script src="<?php echo $ctrl_plugin_path.'datatables/jquerydataTablesmin'.$ctrl_js_ext?>"></script>
<script src="<?php echo $ctrl_plugin_path.'datatables/dataTablesbootstrapmin'.$ctrl_js_ext?>"></script>
<!-- SlimScroll -->
<script src="<?php echo $ctrl_plugin_path.'slimScroll/jqueryslimscrollmin'.$ctrl_js_ext?>"></script>
<!-- FastClick -->
<script src="<?php echo $ctrl_plugin_path.'fastclick/fastclick'.$ctrl_js_ext?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo $ctrl_js_path.'appmin'.$ctrl_js_ext?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $ctrl_js_path.'demo'.$ctrl_js_ext?>"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
        "language": {
      "emptyTable": "No data available"
    }
    });
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
  
  $(document).ready(function(){
  var currentTime = new Date();
var year = currentTime.getFullYear();
  $("#currentyear").text(year);
    });
</script>

   <footer class="hffgreen botm">
		<center>
      <p class="new-account">Copyright © Healing Fields. All Rights Reserved.</p> <!-- <span id="currentyear"> </span>  -->
		</center>
</footer>
   
</body>
</html>
  
