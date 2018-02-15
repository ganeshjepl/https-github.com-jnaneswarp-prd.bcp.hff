<script src="<?php echo $ctrl_js_path.'angularjs'.$ctrl_js_ext?>"></script>
<?php

      
      $total =$response['response']['total'] ; 
      if($total!=0){
           $report = $response['response']['reportData'] ;
      }else{
          $report ='';
      }
     
    
?>
  
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>MEDICAL CHART</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
            <div class="box">
				<div class="box-header card" ng-app="Hff">
             <!--  <h3 class="box-title"> </h3> <button  style="float: right;"> Add New Row </button> -->
            <div class="col-md-6">
                
               <div  class="pull-left">
                           
				    <div class="input-container" ng-controller="state">
                                    <input type="text" list='state_sugg' autocomplete="off" id="stateid" name="stateid" required="required" ng-model="squery" ng-keyup="searchstate()" class="repinpt rmv state">
                                    <datalist id="state_sugg" ng-show="query">
                                        <option ng-repeat="state in states| filter:squery" data-id="{{state.id}}">{{state.name}} </option>
                                    </datalist>
                                    <label class="repinpt" for="#{state}">Enter State</label>
                                    <span class="error-msg-box error-span" id='stateerr'></span>
                                </div>
				   
				   <!--  <div class="input-container" ng-controller="state">
                                   <label for="#{state}">Enter State</label>
                                   <input type="text" list='state_sugg' id="stateid" class='state' name='stateid' value="" required="required" ng-model="squery" ng-keyup="searchstate()"   class='rmv'>
                                    <datalist id="state_sugg" ng-show="query">
                                        <option ng-repeat="state in states| filter:squery" data-id="{{state.id}}">{{state.name}} </option>
                                    </datalist>
                                    
                                    <span class="error-msg-box error-span" id='stateerr'>
                                    </span>
                                 </div> -->
               </div>
               <div class="pull-right" >
                       
				    <div class="input-container" ng-controller="bcp">
                                        <input type="text" autocomplete="off" list="bcp_sugg" id="bcpid" name="bcpid" required="required" ng-model="search"  ng-keyup="showbcp()"  ng-blur="searchbcp()" class="repinpt rmv bcp">
                       <datalist id="bcp_sugg"><!-- ng-show="query" -->
                           <option ng-repeat="bcp in bcps|filter:search" data-id="{{bcp.id}}">{{bcp.name}} </option>
                       </datalist>             
                       <label class="repinpt" for="#{bcp}">BCP</label>
                       <span class="error-msg-box error-span" id='bcperr'></span>
                    </div>
				   
				   <!-- <div class="input-container" ng-controller="bcp"  >
                       <label for="#bcp">BCP</label>
                       <input type="text" list="bcp_sugg" id="bcpid" class="bcp" name="bcpid" ng-model="search"  ng-keyup="showbcp();" ng-blur="searchbcp()"  class="rmv">
                       <datalist id="bcp_sugg" >
                           <option ng-repeat=" bcp in bcps  | filter: search "  data-id="{{bcp.id}}">{{bcp.name}} </option>
                       </datalist>
                       <span class="error-msg-box error-span" id='bcperr'>
                                    </span>
                       </div> -->
                </div>
					</div>
            </div> <!-- /.box-header -->
            <div class="box-body">
 

 
          <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Report Data</h3> 
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="chartdiv" style="height: 300px;"></div>
           
            <!-- /.box-body -->
            <div id="chartresult">
              <?php  if($total!=0){ ?> 
            <h3 class="box-title">Medical Incidents :<?php echo $total ?></h3>
            <h3 class="box-title"> <?php echo $response['response']['reportData'][0]['label'] ?>: <?php echo $response['response']['reportData'][0]['value']."/". $total ?> &nbsp; 
             <?php echo $response['response']['reportData'][1]['label'] ?>: <?php echo $response['response']['reportData'][1]['value']."/". $total ?> &nbsp; 
            <?php echo $response['response']['reportData'][2]['label'] ?>: <?php echo $response['response']['reportData'][2]['value']."/". $total ?>&nbsp; </h3>
            <?php } ?>
            </div>
            </div>
          </div>
          <!-- /.box -->

        </div>

           



            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
 
<!-- ./wrapper -->

<script src="<?php echo $ctrl_plugin_path; ?>amcharts/amcharts<?php echo $ctrl_js_ext; ?>"></script>
<script src="<?php echo $ctrl_plugin_path; ?>amcharts/pie<?php echo $ctrl_js_ext; ?>"></script>
<script src="<?php echo $ctrl_plugin_path; ?>amcharts/exportmin<?php echo $ctrl_js_ext; ?>"></script>
<link rel="stylesheet" href="<?php echo $ctrl_plugin_path; ?>amcharts/export<?php echo $ctrl_css_ext; ?>" type="text/css" media="all" />
<script src="<?php echo $ctrl_plugin_path; ?>amcharts/light<?php echo $ctrl_js_ext; ?>"></script>
<script src="<?php echo $ctrl_plugin_path; ?>amcharts/responsive<?php echo $ctrl_js_ext; ?>"></script>
 
<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "pie",
  "theme": "light",
  "dataProvider": <?php echo json_encode($report)?>,
  "valueField": "value",
  "titleField": "label",
   "balloon":{
   "fixedPosition":true
  },
  "export": {
    "enabled": false
  },
  "responsive": {
    "enabled": true,
  }
} );
</script>

<!-- HTML -->
<div id="chartdiv"></div>
<!------------------>
<link rel="stylesheet" href="<?php echo $ctrl_plugin_path; ?>morris/morris<?php echo $ctrl_css_ext; ?>">
<script src="<?php echo $ctrl_plugin_path; ?>morris/morris.min<?php echo $ctrl_js_ext; ?>"></script>

<script src="<?php echo $ctrl_plugin_path; ?>morris/raphael-min<?php echo $ctrl_js_ext; ?>"></script>

  
<script>
    var app = angular.module('Hff', []);
   app.controller('state', function ($scope, $http) {
    $scope.searchstate = function () {
        $('#bcperr').html(" ");
         $('#bcpid').val('')
        $("#chartdiv").html(' ') ;$("#chartresult").html('');
        var state=$('#stateid').val();
        if(state.length>=2)
           
            search();
    };
    function search(){
        $scope.RandomValue = angular.element('#stateid').val();
        var countryid =101;
        $scope.states = [100];
         $http({
            method: "post",
            url: site_url + 'api/web/v1/State/statesByCountry',
            data: $.param({
            name: $scope.RandomValue,
            id:countryid
           }),
           headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           
        }).then(function (response, status) {
            var state_res = response.data;
            var len = Object.keys(state_res.response.stateData).length;
            var i = 0;
            while (i <= len) {
                $scope.states.push(state_res.response.stateData[i]);

                i++;

            }

        }, function myError(response) {
            $scope.err = response.statusText;

        });
    };
   
   
});
app.controller('bcp', function ($scope, $http) {
  $scope.showbcp = function () { 
      
      $scope.bcps = [300];
          var bcpid = $('#bcpid').val();
          var state = $('#stateid').val() ;
          
        if(bcpid.length>=2){
           search1() 
        }
        
  }
  function search1(){
        var state = $('#stateid').val() ;
         if(state!=''){  
          var stateid = $('#state_sugg option').filter(function () {
            return this.value === state;
          }).data('id');
            
        }
           $http({
            method: "post",
            url: site_url + 'api/web/v1/ctrl/user/getStateBcp',
            data: $.param({
            id:stateid,
           }),
           headers: {'Content-Type': 'application/x-www-form-urlencoded'}
           
        }).then(function (response, status) {
            
            $scope.bcp = JSON.stringify(response.data);
            var array = JSON.parse($scope.bcp);
            if(array.status==true){
            var len = Object.keys(array.response.userData).length;
            var i = 0;
            $scope.bcps.length = 0;
            while (i < len) {

                if(array.response.userData[i].lastName == null){
                     
                     array.response.userData[i].name    =   $.trim(array.response.userData[i].firstName)
                      
                 }else{
                      
                     array.response.userData[i].name    =   $.trim(array.response.userData[i].firstName)+' '+ $.trim(array.response.userData[i].lastName);
              
                }
                $scope.bcps.push(array.response.userData[i]);
                i++;

            }
           // searchbcp();
           }else{
               
                $('#bcperr').html("No Data Exists"); $("#chartdiv").html(' ') ;$("#chartresult").html('');
           }
        }, function myError(response) {
            $scope.err = response.statusText;

        });
       
    }
     $scope.searchbcp = function () {
    //function searchbcp(){
         var bcp = $("#bcpid").val()
        
         var bcpid = $('#bcp_sugg option').filter(function () {
            return this.value === bcp;
        }).data('id');  
         
       if((bcpid!='')&&(bcpid!=undefined)){ 
        
        $.ajax({  
        type: "POST",  
        url:   site_url+"api/web/v1/ctrl/Reports/getbcpReports", 
        data:  {"bcpid":bcpid }, 
        success: function(res){ 
             var total =res.response.total ;
            var result = res.response.reportData;
             if(total!=0){
                 
           // var res = JSON.parse(response);
            
            
            
            if(total!=0){
            var chartsres = '<h3 class="box-title">Medical Incidents :'+total+' </h3><h3 class="box-title">'+result['0']['label']+':'+result['0']['value']+'/'+total+'  '+result['1']['label']+':'+result['1']['value']+'/'+total+'   '+result['2']['label']+':'+result['2']['value']+'/'+total+'</h3>';
            $("#chartresult").html(chartsres)
            }else{
                 $("#chartresult").html('')
            }
            var chart = AmCharts.makeChart( "chartdiv", {
            "type": "pie",
            "theme": "light",
            "dataProvider": result,
            "valueField": "value",
            "titleField": "label",
             "balloon":{
             "fixedPosition":true
            },
            "export": {
              "enabled": false
  },
  "responsive": {
    "enabled": true,
  }
          } );
          }else{
         $("#chartdiv").html('No Data') 
          $("#chartresult").html('')
      }
      }   
    });
    }else{
        $("#chartdiv").html('No Data') 
          $("#chartresult").html('')
    }
    }
});
   
    
</script>
 
