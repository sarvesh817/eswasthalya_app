<style type="text/css">
  .col-lg-0{ width: 11% !important; text-align: center; }
</style>
<?php 

$user_id = $this->session->userdata('user_id');
//if($user_id==973 || $user_id==51242 || $user_id ==27303) {

//if($USER_TYPE=="SUPERADMIN" && $SUBROLE==8){ 
if($this->userprivileged->hasUserPrivilege("Dashboard")  && $this->session->userdata('user_id') != 248065 || $this->privilegeduser->hasPrivilege("Dashboard")  && $this->session->userdata('user_id') != 248065 ) {
    $this->load->model('Homemodel','',TRUE);
  ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Dashboard <small><!-- (On Dashboard Last 30 Days Data Reflecting) --></small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
         <fieldset class="col-lg-4" style="border: 1px black solid;height: 173px;padding: 0px;">
          <legend style="margin-left: 1em;width: auto;margin-bottom:0px">Physical Medical</legend>
    
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php if(!empty($opencasesdata) && $opencasesdata !=false ) { echo $opencasesdata[0]['totalOpen']; } else { echo "000"; } ?></h3> <p><?php echo substr_replace("Total Open Cases","..",11); ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo URL."cases";?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php if(!empty($AppntScheduleCase) && $AppntScheduleCase !=false ) { echo $AppntScheduleCase[0]['totalScheduled']; } else { echo "00"; } ?></h3> 
              <p><?php echo substr_replace("Appointment Fixed","..",11); ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo URL."appointment-list";?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php if(!empty($Closedcasesdata) && $Closedcasesdata !=false ) { echo $Closedcasesdata[0]['totalClosed']; } else { echo "00"; } ?></h3> 
              <p><?php echo substr_replace("Closed Cases","..",11); ?> <i class="fa fa-info-circle" title="Current Month Data from <?php echo date('Y-m-01') ." to Today"?>"></i></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo URL."close-appointment";?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        </fieldset>
        <!-- ./col -->


         <fieldset class="col-lg-4" style="border: 1px black solid; border-left: none;height: 173px;padding: 0px;">
          <legend style="margin-left: 1em;width: auto;margin-bottom:0px">VMER Cases</legend>

    
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php if(!empty($MERopencasesdata) && $MERopencasesdata !=false ) { echo $MERopencasesdata[0]['totalOpen']; } else { echo "000"; } ?></h3> <p><?php echo substr_replace("Total Open Cases","..",11); ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo URL."list-telephonic-case";?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php if(!empty($MERAppntScheduleCase) && $MERAppntScheduleCase !=false ) { echo $MERAppntScheduleCase[0]['totalScheduled']; } else { echo "00"; } ?></h3> 
              <p><?php echo substr_replace("Appointment Fixed","..",11); ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo URL."appt-list";?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php if(!empty($MERClosedcasesdata) && $MERClosedcasesdata !=false ) { echo $MERClosedcasesdata[0]['totalClosed']; } else { echo "00"; } ?></h3> 
              <p><?php echo substr_replace("Closed Cases","..",11); ?> <i class="fa fa-info-circle" title="Current Month Data from <?php echo date('Y-m-01') ." to Today"?>"></i></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo URL."closed-list";?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        </fieldset>
        <!-- ./col -->
      
         <fieldset class="col-lg-4" style="border: 1px solid; border-left: none; height: 173px;padding: 0px;">
          <legend style="margin-left: 1em;width: auto;margin-bottom:0px">Verification Cases</legend>

    
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php if(!empty($VVopencasesdata) && $VVopencasesdata !=false ) { echo $VVopencasesdata[0]['totalOpen']; } else { echo "000"; } ?></h3> 
              <p><?php echo substr_replace("Total Open Cases","..",11); ?> </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo URL."list-telephonic-case";?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php if(!empty($VVAppntScheduleCase) && $VVAppntScheduleCase !=false ) { echo $VVAppntScheduleCase[0]['totalScheduled']; } else { echo "00"; } ?></h3> 
              <p><?php echo substr_replace("Appointment Fixed","..",11); ?> </p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo URL."appt-list";?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php if(!empty($VVClosedcasesdata) && $VVClosedcasesdata !=false ) { echo $VVClosedcasesdata[0]['totalClosed']; } else { echo "00"; } ?></h3> 
              <p><?php echo substr_replace("Closed Cases","..",11); ?>  <i class="fa fa-info-circle" title="Current Month Data from <?php echo date('Y-m-01') ." to Today"?>"></i></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo URL."closed-list";?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        </fieldset>
        <!-- ./col -->
      
      </div>
      <!-- /.row -->
      <br/>

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">

              <!-- <li class="pull-left header"><i class="fa fa-inbox"></i>MIS Report</li> -->
              <li class="active"><a href="#revenue-chart" data-toggle="tab" title="Current Month Data">Status Wise Cases</a></li>
              <li><a href="#icwise-recievdcases" data-toggle="tab" title="Current Month IC Wise Recieved Cases" id="icwisePMCases">IC Wise Cases</a></li>
              <li><a href="#sales-chart" data-toggle="tab" title="Current Month Closed Cases" id="branchwisePMCases">Branch Wise Cases</a></li>              
              <li><a href="#icwise-chartvm" data-toggle="tab" title="Current Month VM Closed Cases" id="icwiseVMcases">IC Wise VM Cases</a></li>
              <li><a href="#icwise-chartmtypevm" data-toggle="tab" title="Current Month VM Closed Cases Medical wise" id="medicalwiseVMcases">Medical Wise VM Cases</a></li>
              <!-- <li><a href="#ClientBilling" data-toggle="tab" title="Client Billing">Billing</a></li> -->
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 355px; overflow: auto;">
                <table class="table table-responsive table-bordered">
                  <thead>
                    <tr>
                      <th>Case Status</th>
                      <th>Total Cases</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php //echo "<pre>"; print_r($StatuswiseCase); 
                        $totalStsData= [];
                        if(!empty($StatuswiseCase) && $StatuswiseCase !=false){
                          foreach ($StatuswiseCase as $CSkey => $CSvalue) {
                            $totalStsData[]= $CSvalue["ttlcases"];
                            echo '<tr> <td>'.$CSvalue["case_status"].'</td><td>'.$CSvalue["ttlcases"].'</td> </tr>';
                          }
                         // echo '<tr><th>Total Regitered Caeses in this Month </th><th>'.array_sum($totalStsData).'</th> </tr>';
                        }
                    ?>
                    
                  </tbody>
                </table>
                
              </div>
              
              
              <div class="chart tab-pane" id="icwise-recievdcases" style="position: relative; height: 355px;overflow: auto;">
                 <table class="table table-responsive table-bordered">
                  <thead>
                    <tr>
                      <th>Insurance Company Name</th>
                      <th>Total cases rec`d in the month</th>
                      <th>Total cases closed from the rec`d cases in the month</th>
                      <th>Total cases closed in the month</th>
                      <th>Client Billing</th>
                      <th>DC Billing</th>
                    </tr>
                  </thead>
                  <tbody class="icwisePMCases"> </tbody>
                </table>
              </div>

              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 355px;overflow: auto;">
                 <table class="table table-responsive table-bordered">
                  <thead>
                    <tr>
                      <th>Branch Name</th>
                      <th>Total cases rec`d in the month</th>
                      <th>Total cases closed from the rec`d cases in the month</th>
                      <th>Total cases closed in the month</th>
                    </tr>
                  </thead>
                  <tbody class="branchwisePMCases"> </tbody>
                </table>
              </div>


              <div class="chart tab-pane" id="icwise-chartvm" style="position: relative; height: 355px;overflow: auto;">
                 <table class="table table-responsive table-bordered">
                  <thead>
                    <tr>
                      <th>Insurance Company Name</th>
                      <th>Total cases rec`d in the month</th>
                      <th>Total cases closed from the rec`d cases in the month</th>
                      <th>Total cases closed in the month</th>
                    </tr>
                  </thead>
                  <tbody class="icwiseVMcases"> </tbody>
                </table>
              </div>

              <div class="chart tab-pane" id="icwise-chartmtypevm" style="position: relative; height: 355px;overflow: auto;">
                 <table class="table table-responsive table-bordered">
                  <thead>
                    <tr>
                      <th>MER TYPE (Case Type)</th>
                      <th>Total cases rec`d in the month</th>
                      <th>Total cases closed from the rec`d cases in the month</th>
                      <th>Total cases closed in the month</th>
                    </tr>
                  </thead>
                  <tbody class="medicalwiseVMcases"> </tbody>
                </table>
              </div>
              <!-- <div class="chart tab-pane" id="ClientBilling" style="position: relative; height: 355px;overflow: auto;">
                 <table class="table table-responsive table-bordered">
                  <thead>
                    <tr>
                      <th>IC Name</th>
                      <th>Home Visit Charges</th>
                      <th>Service Charges</th>
                      <th>Summary Charges</th>
                      <th>Interpretation Charges</th>
                      <th>Tele/Video MER Charges</th>
                      <th>Verification Charges</th>
                      <th>Total medical charges</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    
                  </tbody>
                </table>
              </div> -->

            </div>
          </div>
          <!-- /.nav-tabs-custom -->   

        </section>
        <!-- /.Left col -->
        <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <div class="box box-solid">
            <div class="box-header">
               <!-- tools box -->
              <div class="pull-left box-tools"> Serch Section</div>
              <!-- /. tools -->
             
              <i class="fa fa-map-marker"></i> <h3 class="box-title"> Daily Report</small></h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height:700px; width: 100%; overflow: auto;">
                
                <table class="table table-responsive table-bordered">
                  <thead>
                    
                      <?php 
                      $this->load->model("Homemodel");

                      $Cstatus =["Number of cases received","Number of calls dialled","Number of calls connected","Number of Appointments fixed","Number of Appointment scheduled for the day","Medicals completed","Closure % (Scheduled to completed)","MTD Rec’d cases","MTD Closed cases (rec’d in current month)","MTD Conversion %age","Open Appointments","Pending cases (In follow up & Non-escalated)","Number of Appointment scheduled for the month","Medicals completed against scheduled","Conversion %age","Actual closure – MTD"];

                      $CalcStatus = ["Closure % (Scheduled to completed)","MTD Conversion %age","Conversion %age"];
                      $graycolor  = ["MTD Rec’d cases","MTD Closed cases (rec’d in current month)","MTD Conversion %age","Open Appointments","Pending cases (In follow up & Non-escalated)"];
                      $tillcolor  = ["Number of Appointment scheduled for the month","Medicals completed against scheduled","Conversion %age"];
                      $greencolor = ["Actual closure – MTD"];

                      
                        echo '<tr><th>Status</th>';
                        foreach ($icNames as $ICNkey => $ICNvalue) {
                          echo '<th>'. str_replace(" ","&nbsp;", $ICNvalue["name"]).'</th>';
                        }
                        echo '</tr>';                        
                      ?>
                      
                  </thead>
                  <tbody id="dailyReportSec"> 
                    <?php 
                      $AppSFTDAY =[]; $MedicalsCompleted =[]; $MTDRCase = [];$MTDRecClosed =[]; $AppFTM=[];$MEDClose=[];
                      for ($sts=0; $sts <count($Cstatus) ; $sts++) {
                        
                        if(in_array($Cstatus[$sts],$graycolor)) {
                          $trcolor = "style='background-color: #cacbbc'";
                        } else if(in_array($Cstatus[$sts],$tillcolor)){
                          $trcolor = "style='background-color: #9bf6f8'";
                        } else if(in_array($Cstatus[$sts],$greencolor)){
                          $trcolor = "style='background-color: #37c235'";
                        } else{
                          $trcolor ="";
                        }
                        echo '<tr '.$trcolor.'><th>'. str_replace(" ","&nbsp;", $Cstatus[$sts]).'</th>';
                        if (!in_array($Cstatus[$sts],$CalcStatus)) {
                          
                          $Rdata = $this->Homemodel->getDailyReports($Cstatus[$sts]);
                          if(!empty($Rdata) && $Rdata !=""){
                            
                            foreach ($icNames as $ICNkey => $ICNvalue) {
                            
                              echo '<td>'.$Rdata[$ICNvalue["ic_id"]].'</td>';
                              
                              if($Cstatus[$sts]=="Number of Appointment scheduled for the day"){
                                $AppSFTDAY[$ICNvalue["ic_id"]]= $Rdata[$ICNvalue["ic_id"]];
                              }
                              if($Cstatus[$sts]=="Medicals completed"){
                                $MedicalsCompleted[$ICNvalue["ic_id"]]= $Rdata[$ICNvalue["ic_id"]];
                              }

                              if($Cstatus[$sts]=="MTD Rec’d cases"){
                                $MTDRCase[$ICNvalue["ic_id"]]= $Rdata[$ICNvalue["ic_id"]];
                              }
                              if($Cstatus[$sts]=="MTD Closed cases (rec’d in current month)"){
                                $MTDRecClosed[$ICNvalue["ic_id"]]= $Rdata[$ICNvalue["ic_id"]];
                              }
                              
                              if($Cstatus[$sts]=="Number of Appointment scheduled for the month"){
                                $AppFTM[$ICNvalue["ic_id"]]= $Rdata[$ICNvalue["ic_id"]];
                              }
                              if($Cstatus[$sts]=="Medicals completed against scheduled"){
                                $MEDClose[$ICNvalue["ic_id"]]= $Rdata[$ICNvalue["ic_id"]];
                              }

                            }
                          }

                        } else{
                          foreach ($icNames as $ICNkey => $ICNvalue) {
                            if($Cstatus[$sts] =="Closure % (Scheduled to completed)"){
                              $Convrsion1 = (int)$AppSFTDAY[$ICNvalue["ic_id"]];
                              $Convrsion2 = (int)$MedicalsCompleted[$ICNvalue["ic_id"]];

                            } else if($Cstatus[$sts] =="MTD Conversion %age"){
                              $Convrsion1 = (int)$MTDRCase[$ICNvalue["ic_id"]];
                              $Convrsion2 = (int)$MTDRecClosed[$ICNvalue["ic_id"]];
                            
                            } else if($Cstatus[$sts] =="Conversion %age"){
                              $Convrsion1 = (int)$AppFTM[$ICNvalue["ic_id"]];
                              $Convrsion2 = (int)$MEDClose[$ICNvalue["ic_id"]];
                                                          
                            } else{
                              $Convrsion1 =0;
                              $Convrsion2 =0;  
                            }

                            if($Convrsion1!=0 && $Convrsion2!=0){
                              $Cpercent   = ($Convrsion2/$Convrsion1)*100; 
                            } else{
                              $Cpercent   =0;
                            }

                            echo '<td>'.number_format($Cpercent,2).'%</td>';
                          }
                        }
                        echo '</tr>';  
                        
                      }
                    ?>
                  
                </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body-->
          </div>          
        </section>
      </div>
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <div class="box box-solid">
            <div class="box-header">
               <!-- tools box -->
              <div class="pull-left box-tools">
                
                <select class="form-control" name="icnames" id="icnames" style="margin=right: 10px; width:1000px !important;" multiple> 
                  <?php 
                      echo '<option value="">Select</option>';
                      foreach ($icNames as $ICNkey => $ICNvalue) {
                        echo '<option value="'.$ICNvalue['ic_id'].'">'.$ICNvalue['name'].'</option>';
                      }
                  ?>
                </select>
              </div>
              <!-- /. tools -->
             
              <i class="fa fa-map-marker"></i> <h3 class="box-title"> Pivoital Data Branch Wise <small>(Current Month Data)</small></h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 355px; width: 100%; overflow: auto;">
                <?php 
               
               $branches =[];
                $columns =['case_status'];
                $branch_name = $this->Mastermodel->getTableRecords("welnext_branch","branch_name");
                if(!empty($branch_name)) {
                  foreach ($branch_name as $Bkey => $Bvalue) {
                    $branches[] = $Bvalue['branch_name'];
                  }
                } 
                
                $Arr= ['case_status'];
                $brancglist = array_merge($Arr,$branches);

                ?>
                <table class="table table-responsive table-bordered">
                  <thead>
                    <tr>
                      <th>Case Status</th>
                      <?php 
                      for($bhead=1; $bhead<count($brancglist); $bhead++){
                        echo '<th>'.str_replace("WX – ", "",$brancglist[$bhead]).'</th>';
                      }
                      ?>
                      <th>Recd Case</th>
                    </tr>
                  </thead>
                  <tbody id="PivotalDataICwise"> </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body-->
          </div>          
        </section>
      </div>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<?php } else { ?>
<style>
	.imGRounded{
	    border-radius: 30px;
		background-repeat: no-repeat;background-size: cover;height: 520px;
    }
    .imaData{
    	margin-top: 5px;
    	margin-left: 0px;
    	margin-bottom: 15px;
    	height: 100%;;
    	width:100%;
    	overflow: none;

    }
</style>
<div class="content-wrapper">
	<div class="col-sm-12">
		<div class="imaData">
			<img class="img-responsive imGRounded" src="<?php echo SITE_URL.'img/dashboard_images.png'?>" height="100%" width="100%">
		</div>
	</div>
</div>

<?php } ?>

<script type="text/javascript">
  getPivotalData();
  function getPivotalData(){
    $icname = $("#icnames").val();
    $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/pivotalData", 
        method:'POST',
        dataType:'html',
        data : {'ic_id':$icname,'csrf_test_name':csrf_token},             
        success: function(res){ 
            $("#PivotalDataICwise").html(res);
            $(".se-pre-con").hide();
        }
    });
  }

  $("#icnames").change(function(){
    $icname = $(this).val();
    getPivotalData($icname);
  });

$("#icwisePMCases").click(function(){
  $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/getICWisePMCases", 
        method:'POST',
        dataType:'html',
        data : {'csrf_test_name':csrf_token},             
        success: function(res){ 
            $(".icwisePMCases").html(res);
            $(".se-pre-con").hide();
        }
    });

  });

  $("#branchwisePMCases").click(function(){
    $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/getBranchWisePMCases", 
        method:'POST',
        dataType:'html',
        data : {'csrf_test_name':csrf_token},             
        success: function(res){ 
            $(".branchwisePMCases").html(res);
            $(".se-pre-con").hide();
        }
    });

  });
$("#icwiseVMcases").click(function(){
  $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/getICWiseVMCases", 
        method:'POST',
        dataType:'html',
        data : {'csrf_test_name':csrf_token},             
        success: function(res){ 
            $(".icwiseVMcases").html(res);
            $(".se-pre-con").hide();
        }
    });

  });

$("#medicalwiseVMcases").click(function(){
  $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/getMedicalWiseVMcases", 
        method:'POST',
        dataType:'html',
        data : {'csrf_test_name':csrf_token},             
        success: function(res){ 
            $(".medicalwiseVMcases").html(res);
            $(".se-pre-con").hide();
        }
    });

  });


</script>

