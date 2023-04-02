<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: VIDEO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
<!-- :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: CALLING :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
  <!-- Video Calling -->
<div class="videocalling_main_ui smallWindow" id="screenSize">
  <div class="btn-video-calling-window">
    <button class="btn btn-warning smallwindow" onclick="toggleWindow()"><i id="windowIcon" class="bi bi-fullscreen-exit"></i></button>
  </div>
  <div class="running-video-calling-interface">
      
        
    
    
    <form id="join-form">
        <div class="row join-info-group" style="display:none;">
            <div class="col-sm">
                <input id="appid" type="text" value="9e3c2c96c8384758ad69c8155a46a36b" required>
            </div>
            <div class="col-sm">
                <input id="token" type="text">
            </div>
            <div class="col-sm">
                <input id="channel" type="text" value="" required>
            </div>
        </div>

        <div class="button-group">
            <button id="join" type="submit" class="btn btn-success btn-sm"><i class="bi bi-telephone"></i>Call</button>
            <button id="leave" type="button" class="btn btn-danger btn-sm" disabled><i class="bi bi-telephone"></i>Leave</button>
        </div>
    </form>
    
    
        <div class="row video-group">
            <div class="col">
            <div id="remote-playerlist"></div>
          </div>
          <div class="w-100"></div>
          <div class="col" style="display:none;">
            <p id="local-player-name" class="player-name"></p>
            <div id="local-player" class="player"></div>
          </div>
          
        </div>
    
    
    
    <!--<button type="button" class="btn btn-danger calling-round-btn end-video-call" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#confirmstaticBackdrop"><i class="bi bi-telephone"></i></button>-->
  </div>
</div>


<!-- Coming Video Call -->
<!--<div class="modal fade" id="comingvideocalling" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content comingvideocallingcontent">
      <div class="modal-body">
        <div class="video-calling-info">
          <div class="video-calling-details">
            <div class="video-calling-person">
              <img src="<?php echo base_url();?>bassets/img/avatar.png" alt="avatar">
            </div>
            <div class="video-calling-pt-info">
              <span class="video-calling-app-id">APPOINTMENT ID: 121221</span>
              <h4 class="video-calling-title">Aman Sharma</h4>
              <span class="video-calling-pid">PID001</span>
            </div>
          </div>
          <div class="video-calling-btn">
            <div class="btn-calling-group">
              <button type="reset" class="btn btn-danger calling-round-btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#confirmstaticBackdrop"><i class="bi bi-telephone"></i></button>
              <button type="submit" class="btn btn-success calling-round-btn" data-bs-dismiss="modal" onclick="receiveVideoCalling()"><i class="bi bi-telephone"></i></button> 
            </div> 
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>-->

<!-- Cancel -->
<!--<div class="modal fade" id="confirmstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
        <div class="modal-header flex-column">
			<div class="icon-box">
				<i class="bi bi-x"></i>
			</div>						
			<h4 class="modal-title w-100">Are you sure?</h4>	
            <button type="button" class="btn-close close" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#runningvideocalling" aria-label="Close"></button>
		</div>
      <div class="modal-body">
        <p>Do you really want to cancel the video calling? This process cannot be undone.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#runningvideocalling">Close</button>
        <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelitstaticBackdrop">Yes, Cancel it!</button>
      </div>
    </div>
  </div>
</div>-->

<!-- If Cancel It -->
<!--<div class="modal fade" id="cancelitstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header flex-column">
								
				<h4 class="modal-title w-100">Please enter reason!</h4>	
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
      <div class="modal-body">
        <div class="cancel-reason-form">
          <div class="row">
            <div class="col-sm-12 mb-4">
              <div class="text-left">
                <label class="form-label">Reason<span
                  class="required_asterisk">*</span></label>
                  <select class="form-control form-control-lg" name="subject">
                  <option value="- Select Subject -">- Select Reason -</option>
                  <option value="All">All</option>
                  <option value="ABC">ABC</option>
                  <option value="ABC">ABC</option>
                  <option value="ABC">ABC</option>
                  <option value="ABC">ABC</option>
                  <option value="ABC">ABC</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12 mb-4">
              <div class="text-left">
                <label class="form-label">Description<span
                  class="required_asterisk">*</span></label>
              <textarea class="form-control form-control-lg required-entry"
                placeholder="Description" rows="5" cols="10" name="description"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#donestaticBackdrop" onclick="declinedVideoCalling()">Submit</button>
      </div>
    </div>
  </div>
</div>
-->
<!-- Cancelled Modal -->
<!--<div class="modal fade" id="donestaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header flex-column">
				<div class="icon-box-confirmed text-success">
					<i class="bi bi-check"></i>
				</div>						
				<h4 class="modal-title w-100">Cancelled!</h4>	
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
      
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>-->

<!-- End -->
<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Appointments</li>
        </ol>
      </div>
    </div> <!-- .row end -->
    <div class="row align-items-center">
      <div class="col-auto">
        <h1 class="fs-5 color-900 mt-1 mb-0">Appointments</h1>
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
            
          <div class="card-body">
            <div class="table-filter">
                <div class="row">
                  <div class="col-xxl-4 col-md-4 col-sm-12 mt-2 mt-md-0">
                    <div class="card-header">
                        <h6 class="card-title m-0">Appointments</h6>
                      </div>
                </div>
                  <div class="col-xxl-8">
                      <div class="btn-right">
                        <a href="<?php echo base_url(); ?>eclinic/book-new-appointment" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Book New Appointment</a>
                      </div>
                  </div>
                    
                    <div class="col-xxl-3 col-sm-12 mt-2 mt-md-0">
                            <select class="form-control form-control-lg" id="speciality" tabindex="-98">
                              <option value="">- Select Speciality -</option>
                            <?php 
                              if(isset($specialization_list) && $specialization_list !=''){  
                                foreach($specialization_list  as $slt) {
                                  ?>
                                   <option value="<?php echo $slt['id']; ?>"><?php echo $slt['speciality']; ?></option>                       
                            <?php } } ?> 
                            </select>

                    </div>
                    <div class="col-xxl-3 col-sm-12 mt-2 mt-md-0">
                        <select class="form-control form-control-lg" id="doctor_id" tabindex="-98">
                          <option value="">- Select Doctors -</option>
                        </select>   
                </div>
                <div class="col-xxl-2 col-sm-12 mt-2 mt-md-0"></div>   
                    <div class="col-xxl-4 col-sm-12 mt-2 mt-md-0">
                        <!-- daterange picker -->
                        <div class="input-group">
                          <input class="form-control" type="text" name="daterange" id="date_range">
                          <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Download Reports"><i class="fa fa-download"></i></button>
                          <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Generate PDF"><i class="fa fa-file-pdf-o"></i></button>
                        </div>
                        <!-- Plugin Js -->
                        <script src="<?php echo base_url(); ?>bassets/js/bundle/daterangepicker.bundle.js"></script>
                        <!-- Jquery Page Js -->
                        <script>
                          // date range picker
                          $(function() {
                            $('input[name="daterange"]').daterangepicker({
                              opens: 'left'
                            }, function(start, end, label) {
                              console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                            });
                          })
                        </script>
                      </div>
                </div>
            </div>
            <table id="myDataTable" class="table card-table table-hover align-middle mb-0">
              <thead>
                <tr>
                  <th>S. No</th>
                  <th>Patient ID</th>
                  <th>Name</th>
                  <th>Dr. Name</th>
                  <th>Speciality</th>
                  <th>App. ID</th>
                  <th>App. Start-End Time</th>
                  <th>Click to Call</th>
                  <th>App. Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="bind_data">    
                <?php 
                    if(isset($appoint_list) && $appoint_list !=''){
                    $i=1;
                    foreach($appoint_list as $al) {
                    $this->db->where('user_id',$al['doctor_id']);                
                    $fetch_doctor=$this->db->get('user')->row_array();
                    $this->db->where('id',$al['slot_id']);                  
		            $fetch_slot=$this->db->get('slot_management')->row_array();
		        ?>      
                <tr>
                    
                  <td><?=$i++; ?></td>
                  <?php $patientCode = "PID".str_pad($al['patient_id'], 4, "0", STR_PAD_LEFT); ?>
                  <td><a href="<?php echo base_url(); ?>eclinic/single-patient/<?php echo $al['patient_id']; ?>"><?php echo $patientCode; ?></a></td>
                  <td><?php if(isset($al['patient_name']) && $al['patient_name'] !=''){ echo $al['patient_name']; } ?></td>
                  
                  <td>
                    <?php 
                        if(isset($al['doctor_id']) && $al['doctor_id'] !=''){
                            $doctDetails = $this->db->where('user_id',$al['doctor_id'])->get('tbl_doctors')->row();
                            //echo $this->db->last_query();die;
                            if($doctDetails){
                             echo $doctDetails->name;
                            }
                        }
                    ?>
                  </td>
                  
                  <td>
                      <?php 
                        if(isset($al['speciality']) && $al['speciality'] !=''){
                            $specialityData = $this->db->where('id',$al['speciality'])->get('tbl_speciality')->row();
                            //echo $this->db->last_query();die;
                            if($specialityData){
                             echo $specialityData->speciality;
                            }
                        }
                    ?>
                    </td>
                  <?php $appointmentCode = "APP".str_pad($al['id'], 4, "0", STR_PAD_LEFT); ?>
                  <td><?php echo $appointmentCode; ?></td>
                  
                  <td><?php if(!empty($fetch_slot['start_time']) && !empty($fetch_slot['end_time'])){ echo $fetch_slot['start_time'].'-'.$fetch_slot['end_time']; } ?></td>
                  <td><button type="button" class="btn btn-primary modal-btn openCallingModel" data-bs-toggle="tooltip" data-dr_id="<?php echo $al['doctor_id'] ?>" data-pid="<?php echo $al['patient_id'] ?>" data-app_id="<?php echo $al['id'] ?>" ><i class="fa-solid fa-video"></i> Connect Dr.</button ></td>
                    <td><span class="status-info btn btn-warning"><?php if($al['status']==0){echo 'Pending';}else{echo 'Completed';}?></span></td>
                    <td>
                       <a href="#" class="btn btn-secondary" data-bs-toggle="tooltip" title="Medical History">Medical History</a>
                    </td>
                </tr>
                <?php } }?>      
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> <!-- .row end -->
  </div>
</div>
<!---------OTP Varification Popup ----------------->
<div class="modal fade" id="otpstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter OTP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="form-field-title">
            <h4>Sent successfully OTP in patient or clinic registered mobile number.</h4>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col-12">
            <div class="notice-msg">
              <p><strong>Note: Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae necessitatibus sequi cupiditate. Nisi inventore beatae cum sapiente nemo minus rerum?</strong></p>
            <ul class="notice-list">
              <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Optio eius deleniti eaque veritatis praesentium illo.</li>
              <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, nam ratione! Est, consectetur mollitia?</li>
            </ul>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="<?php echo base_url(); ?>eclinic/single-patient/" class="btn btn-primary">Enter OTP</a>
      </div>
    </div>
  </div>
</div>
<!---------END OTP Varification Popup ----------------->

<!---------OTP Varification Popup ----------------->
<div class="modal fade" id="videocallingstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<h5 class="modal-title">Enter OTP</h5>-->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="form-field-title">
            <h4>Sent Request to doctor for video calling.</h4>
          </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <!--<a href="<?php echo base_url(); ?>single-patient" class="btn btn-primary">Enter OTP</a>-->
      </div>
    </div>
  </div>
</div>
<!---------END OTP Varification Popup ----------------->

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

    $('#doctor_id').on('change', function(){
      var doctor_id = $(this).val();   
      common_function(doctor_id,date_range=""); 
    });


    
    $('#date_range').on('change', function(){ 
      var date_range=$(this).val();  
      var doctor_id = $(this).val();     
      common_function(doctor_id,date_range);       
    });



    
    function common_function(doctor_id,date_range){  
              $.ajax({
              url:"<?php echo base_url(); ?>eclinic/fetch-dependent-appointment",     
              method:"POST",
              data:{doctor_id:doctor_id,date_range:date_range},       
              success:function(data)
              {
              $('#bind_data').html(data);
              }
              });
         
    }

     
  
});

    
</script>

<script>
    $(document).on('click','.openCallingModel',function(){

        var dr_id = $(this).data('dr_id');
        var pid = $(this).data('pid');
        var app_id = $(this).data('app_id');
        $.ajax({
            url:"<?php echo base_url(); ?>EclinicPanel/clickToCall",   
            method:"POST",
            data:{dr_id:dr_id,pid:pid ,app_id:app_id  }, 
            dataType:'json',
            success:function(data)
            {
                console.log(data);
                if(data['success']==0){
                    $('#editresmessage').html(data['msg']);
                    $('#doneeditstaticBackdrop').modal('show');
                    setTimeout(function(){
                        $('#editresmessage').html('');
                        $('#doneeditstaticBackdrop').modal('hide');
                        window.location.reload();
                    },2000);
                    
                }else{
                    $('#channel').val(dr_id);
                    
                    receiveVideoCalling();
                }
            }
        });
    });
</script>


