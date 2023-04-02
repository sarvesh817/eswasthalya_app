<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Book New Appointment</li>
        </ol>
      </div>
    </div> <!-- .row end -->
    <div class="row align-items-center">
      <div class="col-auto">
        <h1 class="fs-5 color-900 mt-1 mb-0">Book New Appointment</h1>
        <small class="text-muted">You have 12 new messages and 7 new notifications.</small>
      </div>

    </div> <!-- .row end -->
  </div>
</div>
<!-- start: page body -->
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
  <div class="container-fluid">
    <div class="row g-2 row-deck">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
        <form action="<?php echo base_url('eclinic/book-new-appointment') ?>" method="post" >     
          <div class="card-body">
            <div class="table-filter">
                
                
                    <div class="col-xxl-12 col-md-12 col-sm-12 mt-2 mt-md-0 mb-3">
                        <div class="row">
                          <div class="col-xxl-3 col-sm-12 mt-2 mt-md-0"><span id="patient_id22"></span></div>
                          <div class="col-xxl-3 col-sm-12 mt-2 mt-md-0"><span id="patient_names22"></span></div>
                          <div class="col-xxl-3 col-sm-12 mt-2 mt-md-0"><span id="patient_mobiles22"></span></div>
                        </div>
                    </div>
                
          
          
              <div class="row">
                <div class="col-xxl-4 col-md-4 col-sm-12 mt-2 mt-md-0 mb-3">
                  <div class="card-header">

                    <h6 class="card-title m-0">Book New Appointment</h6>
                 
                  </div>
                </div>
                <div class="col-xxl-8 col-md-4 col-sm-12 mt-2 mt-md-0"></div>
                <input type="hidden" id="patient_id" name="patient_id">  
                <input type="hidden" id="patient_name" name="patient_name">       
                <div class="col-xxl-3 col-sm-12 mt-2 mt-md-0">
                  <select class="form-control form-control-lg" name="speciality"  id="speciality" tabindex="-98">
                    <option value="">- Select Speciality -</option>
                    <?php 
                      if(isset($specialization_list) && $specialization_list !=''){  
                        foreach($specialization_list  as $slt) {
                          ?>
                    <option value="<?=$slt['id']?>"><?=$slt['speciality']?></option>                       
                    <?php } } ?>
                  </select>
                </div>
                <div class="col-xxl-3 col-sm-12 mt-2 mt-md-0">
                  <select class="form-control form-control-lg" name="doctor_id"  id="doctor_id" tabindex="-98">
                    <option value="">- Select Doctors -</option>       
                  </select>
                </div>   
                <div class="col-xxl-2 col-sm-12 mt-2 mt-md-0"></div>
                <div class="col-xxl-4 col-sm-12 mt-2 mt-md-0">
                  <!-- daterange picker -->
                  <div class="input-group">
                    <input class="form-control" type="text" name="daterange">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip"
                      title="Download Reports"><i class="fa fa-download"></i></button>
                    <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Generate PDF"><i
                        class="fa fa-file-pdf-o"></i></button>
                  </div>
                  <!-- Plugin Js -->
                  <script src="assets/js/bundle/daterangepicker.bundle.js"></script>
                  <!-- Jquery Page Js -->
                  <script>
                    // date range picker
                    $(function () {
                      $('input[name="daterange"]').daterangepicker({
                        opens: 'left'
                      }, function (start, end, label) {
                        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                      });
                    })
                  </script>
                </div>

                <!-- Select Available Slots -->

                <div class="col-xxl-12 col-sm-12 mt-5 mb-3">
                  <div class="available-slots">
                    <div class="col-sm-12">
                      <div class="section-header">
                        <h5 class="section-title">Select Available Slots</h5>
                      </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                      <label for="date-week">Today<span class="required_asterisk">*</span></label>
                      <div class="weekDays-selector available-slots-selector">
                        <?php 
                        //echo '<pre>';
                    //    print_r($slot_list); die;  
                        
                      if(isset($slot_list) && $slot_list !=''){ 
                        $i=1; 
                        foreach($slot_list  as $sl) {
                           $today_date=date('d/m/Y');
                           $i++;
                          if($sl['week_days'] == date('l')){                  
                          ?>
                            <input type="radio" id="<?=$i?>_slot" class="weekday" name="slot_id"      
                              value="<?=$sl['id']?>"/>        
                            <label for="<?=$i?>_slot"><?php echo date('h:i A', strtotime($sl['start_time']));?> - <?php echo date('h:i A', strtotime($sl['end_time']));?></label>
                          <?php
                          }   
                          }
                          } ?>   
                
                      </div>  
                    </div>
                   
                           
                      <?php 
                      if(isset($slot_list) && $slot_list !=''){  
                              $Monday=array();
                              $Tuesday=array();
                               $Wednesday=array();
                                $Thrusday=array();
                                 $Friday=array();
                                  $Saturday=array();
                                   $Sunday=array();
                                   $j=1;
                        foreach($slot_list  as $sl) {
                          $today_date=date("d/m/Y");
                            $j++;
                          if($sl['week_days'] != date('l')){
                            
                                 if ($sl['week_days']=="Monday") {
$Monday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['start_time'].'-'.$sl['end_time']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
                                 } else if($sl['week_days']=="Tuesday"){
                    
$Tuesday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['start_time'].'-'.$sl['end_time']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
              
                                 }else if($sl['week_days']=="Wednesday"){
                                 
$Wednesday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['start_time'].'-'.$sl['end_time']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
                                 }else if($sl['week_days']=="Thrusday"){
$Thrusday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['start_time'].'-'.$sl['end_time']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
                                 }else if($sl['week_days']=="Friday"){
$Friday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['start_time'].'-'.$sl['end_time']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
                                 } else if($sl['week_days']=="Saturday"){
$Saturday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['start_time'].'-'.$sl['end_time']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
                                 }else if($sl['week_days']=="Sunday"){
$Sunday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['start_time'].'-'.$sl['end_time']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
                                 }
                            }
                          }
                        }
                    ?> 
  
                        <div class="col-sm-12 mb-3">
                         <hr>
                            <!--<label for="date-week">Other Day <span class="required_asterisk">*</span></label>-->
                            <div class="weekDays-selector available-slots-selector">
                          
                              <div class="row"> 
                                 <?php if(!empty($Monday)){ ?>
                                <label>Monday</label>  
                                 <?php 
                                 
                                 foreach($Monday as $md){
                                        
                                        echo $md;
                                     
                                 } } ?>
                                 
                                 <?php if(!empty($Tuesday)){ ?>
                                <label>Tuesday</label>  
                                 <?php 
                                 
                                 foreach($Tuesday as $ts){
                                        
                                        echo $ts;
                                     
                                 } } ?>
                                 
                                 
                                 <?php if(!empty($Wednesday)){ ?>
                                <label>Wednesday</label>  
                                 <?php 
                                 
                                 foreach($Wednesday as $wednes){
                                        
                                        echo $wednes;
                                     
                                 } } ?>
                                 
                                 
                                 <?php if(!empty($Thrusday)){ ?>
                                <label>Thursday</label>  
                                 <?php 
                                 
                                 foreach($Thrusday as $thrus){
                                        
                                        echo $thrus;
                                     
                                 } } ?>
                                 
                                 
                                 <?php if(!empty($Friday)){ ?>
                                <label>Friday</label>  
                                 <?php 
                                 
                                 foreach($Friday as $frid){
                                        
                                        echo $frid;
                                     
                                 } } ?>
                                 
                                 
                                 <?php if(!empty($Saturday)){ ?>
                                <label>Saturday</label>  
                                 <?php 
                                 
                                 foreach($Saturday as $satur){
                                        
                                        echo $satur;
                                     
                                 } } ?>
                                 
                                 <?php if(!empty($Sunday)){ ?>
                                <label>Sunday</label>  
                                 <?php 
                                 
                                 foreach($Sunday as $sunday){
                                        
                                        echo $sunday;
                                     
                                 } } ?>
                              </div>    
                         

                            </div>
                        </div>
                        <div class="col-md-12">
                      <div class="btn-right">
                        <a href="<?php echo base_url(); ?>eclinic/appointments" class="btn btn-dark">Back</a>
                        <input type="submit" name="submit_book_appoint" class="btn btn-primary w-auto" value="Book Appointment"  >
                       <!--  <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal"
                          data-bs-target="#confirmstaticBackdrop">Book Appointment</a> -->
                          
                      </div>
                    </div>
                       
                    
                  </div>
                </div>
                <!-- End -->
              </div>
            </div>
          </form>           
          </div>

        </div>
      </div>
    </div> <!-- .row end -->
  </div>
</div>


<div class="modal fade" id="confirmstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="form-field-title">
            <h4>Are you sure want to book Appointment with this slot?</h4>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal"
          data-bs-target="#secretpinstaticBackdrop">Yes</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="secretpinstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
   
        <h5 class="modal-title">Enter Appoinment Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row justify-content-center g-3">
          <div class="col-md-7">
            <input id="password" class="form-control form-control-lg" type="password" maxlength="10"
              placeholder="Enter the Appoinment Password">
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="submit" href="javascript:void(0);" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!-- Verify Mobile Number through OTP -->

<div class="modal fade" id="verifypatientbeforeappointment" data-bs-backdrop="static" data-bs-keyboard="false"
  tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
             
        <h5 class="modal-title">Enter PID and Verify Mobile Number</h5>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center g-3">
          <div class="col-sm-12 mb-2 text-left">
            <label class="form-label">PID<span class="required_asterisk">*</span></label>
            <div class="input-with-btn">
              <input type="text" id="pid" class="form-control form-control-lg required-entry pid_input" placeholder="PID"
                name="pid">
              <button class="verify-pid btn btn-primary btn-sm" id="verifypid">Verify</button>
            </div>
          </div>
          <div class="col-sm-12 text-left">
              <span id="errormsg"></span>
            <div class="pid-details" id="hideshow-details" style="display:none">
              <label class="form-label">Patient Details:</label>
              <ul class="patient-details">
                <li style="display:none" id="patient_names"> </li>
                <li style="display:none" id="patient_mobiles"> </li>   
              </ul>
            </div>
          </div>
          <div class="col-sm-12"><span id="randOtp"></span>
          </div>
          <div class="col">
              <input type="text" class="form-control form-control-lg text-center" id="otpnew" style="display:none">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" id="num1" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" id="num2" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" id="num3" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" id="num4" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col-12">
              
              <span id="verifyMessage"></span>
            <div class="mb-2">
              <p>Auto deduct an appointment fee Rs.400 from the Wallet, after click the "<strong>Proceed To Book
                  Appointment</strong>" button.</p>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault"> I accept the <a href="#" title=""
                    class="text-primary">Terms and Conditions</a>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <a href="<?php echo base_url(); ?>eclinic/appointments" class="btn btn-dark">Back</a>
        
        <!--<span id="otpVerifyButton"></span>-->
        <button type="button" id="otpVerify" class="btn btn-primary">Proceed To Book Appoinment</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    $('#speciality').on('change', function(){
        var speciality_val = $(this).val();
        if(speciality_val){   
              $.ajax({
              url:"<?php echo base_url(); ?>eclinic/fetch-dependent-doctors",   
              method:"POST",
              data:{speciality_val:speciality_val},
              success:function(data)
              {
              $('#doctor_id').html(data);
              }
              });
        }else{
          $('#doctor_id').html('<option value="">Select Speciality First</option>');              
        }
    });
  
});

$(document).ready(function(){
    $('#verifypid').on('click', function(){
        var pid = $("#pid").val();
        if(pid){   
              $.ajax({
              url:"<?php echo base_url(); ?>eclinic/fetch-dependent-patient",   
              method:"POST",
              data:{pid:pid}, 
              dataType:'json',
              success:function(data)
              {
                  console.log(data);
                if(data['success']==0){
                  $('#patient_names').hide();
                  $('#patient_mobiles').hide(); 
                  $('#hideshow-details').hide();
                  
                  $('#errormsg').html("<span style='color:red'>Please Enter Valid Patient ID</span>");
                  //$('#patient_names').html("<li>Please Enter Valid Patient ID</li>");
                  $('#patient_mobiles').html("");     
                  //$('.patient-details').html("<li>Please Enter Valid Patient ID</li>");          
                } else{
                  $('#hideshow-details').show();    
                  $('#patient_names').show();
                  $('#patient_mobiles').show();  
                  //var json = $.parseJSON(data);
                  $('#errormsg').html("");
                  
                  $('#otpnew').val(data['otp']);
                  $('#patient_id').val(data['pid']);   
                  $('#patient_name').val(data['pname']);
                  $('#randOtp').html("( "+data['otp']+" ) " + "OTP");
                  $('#patient_names').html("Patient Name: "+data['pname']);
                  $('#patient_mobiles').html("Patient Mobile: "+data['pmobile']);
                  
                  $('#patient_id22').html("Patient ID: "+data['pid']);
                  $('#patient_names22').html("Patient Name: "+data['pname']);
                  $('#patient_mobiles22').html("Patient Mobile: "+data['pmobile']);
                  
                  
                 /* $('#otpVerifyButton').html('<button type="button" id="otpVerify" class="btn btn-primary">Proceed To Book Appoinment</button>');*/
 
                }
              }
              });
        } 
    });
  
});

    
    $(document).ready(function(){
        $('#otpVerify').on('click', function(){
            var otpnew = $("#otpnew").val();
            var num1 = $("#num1").val();
            var num2 = $("#num2").val();
            var num3 = $("#num3").val();
            var num4 = $("#num4").val();
            var finalOtp = num1+num2+num3+num4;

            if(finalOtp =='' || otpnew ==''){
              $('#verifypatientbeforeappointment').modal('show');  
            }else{
            
                if(finalOtp === otpnew){
                    $('#verifypatientbeforeappointment').modal('hide');
                }else{
                    $('#verifypatientbeforeappointment').modal('show');
                    $('#verifyMessage').html('<span style="color:red">OTP not matched</span>');
                    $("#num1").val('');
                    $("#num2").val('');
                    $("#num3").val('');
                    $("#num4").val('');
                }
            }
        });
        
    });
 

$(document).ready(function(){
    $("#otpVerify").hide();
    $("#flexCheckDefault").click(function() {
        if($(this).is(":checked")) {
            $("#otpVerify").show(300);
        } else {
            $("#otpVerify").hide(200);
        }
    });

});
</script>