<?php 
$userstatus = $this->session->userdata('status');
$userid = $this->session->userdata('userid');

$uid = $this->session->userdata('user_id');

?>

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
                <input id="channel" type="text" value="<?php echo $uid; ?>" required>
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
  </div>
</div>
<!-- Coming Video Call -->

<?php if(!empty($callData) && $callData !=''){?>
<div class="modal fade" id="comingvideocalling" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content comingvideocallingcontent">
      
      <div class="modal-body">
        <div class="video-calling-info">
          <div class="video-calling-details">
                <?php 
                    if(isset($callData->patient_id)){ 
                        $pid = $callData->patient_id; 
                        $pDetails = $this->db->where('id',$pid)->get('tbl_patient')->row();
                    } 
                ?>
            <div class="video-calling-person">
                
                <?php if(isset($pDetails->profile_photo)){ ?>
                    <img src="<?php echo base_url();?>img/eclinic_upload/<?php echo $pDetails->profile_photo; ?>" alt="avatar">
                <?php }else{ ?>
                    <img src="<?php echo base_url();?>bassets/img/avatar.png" alt="avatar">
                <?php } ?>
            </div>
            <div class="video-calling-pt-info">
                <span class="video-calling-app-id">APPOINTMENT ID: <?php if(isset($callData->app_id)){ echo "APP".str_pad($callData->app_id, 4, "0", STR_PAD_LEFT); } ?></span>
                <h5 class="video-calling-title">
                    <?php if(isset($pDetails->full_name)){ echo $pDetails->full_name; } ?>
                </h5>
                <span class="video-calling-pid">
                  <?php if(isset($callData->patient_id)){ echo "PID".str_pad($callData->patient_id, 4, "0", STR_PAD_LEFT); } ?>
                </span>
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
</div>
<?php } ?>



<!-- Cancel -->
<div class="modal fade" id="confirmstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
</div>

<!-- If Cancel It -->
<div class="modal fade" id="cancelitstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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

<!-- Cancelled Modal -->
<div class="modal fade" id="donestaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
</div>

<!-- End -->

    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
          <div class="col">
            <h1 class="fs-5 color-900 mt-1 mb-0">Welcome, <?php echo $this->session->userdata('name'); ?> !</h1>      
            <!-- <small class="text-muted">You have 12 new messages and 7 new notifications.</small> -->
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    <?php if($userstatus != 'Approved') { ?>
    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3 row-deck">
          <div class="col-lg-12 col-md-6 col-sm-6">
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Well done!</h4>
              you have successfully created doctor profile with e-Swasthalya.
            </div>
          </div>
          <div class="col-lg-12 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="btn-center">
                        <img src="http://e-swasthalya.com/bassets/img/verified.png" class="verify_profile_icon" alt="Verified" />
                        <a href="<?php echo base_url();?>doctors/edit-profile" type="button" class="btn btn-success btn-lg">Verify My Profile</a>
                    </div>
                </div>
            </div>
          </div>

        </div> <!-- .row end -->
      </div>
    </div>
    
    <?php }else{ ?>
    
    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-2 row-deck">
          <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header">
                <h6 class="card-title m-0">Today's Appointment Status</h6>
              </div>
              <div class="card-body">
                <table id="myDataTable" class="table card-table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Patient ID</th>
                      <th>Name</th>
                      <th>Age/Sex</th>
                      <th>App. ID</th>
                      <th>App. Start-End Time</th>
                      <th>App. Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    if(isset($appointment_data) && $appointment_data !=''){
                    $i=1;
                    foreach($appointment_data as $appointValue) {
                    $this->db->where('id',$appointValue['slot_id']);                  
		            $fetch_slot=$this->db->get('slot_management')->row_array();
		            
		            $this->db->where('id',$appointValue['patient_id']);                  
		            $patient_data=$this->db->get('tbl_patient')->row_array();
		          ?>    
                    <tr>
                      <td><?php echo $i; ?></td>
                      <?php $patientCode = "PID".str_pad($appointValue['patient_id'], 4, "0", STR_PAD_LEFT); ?>
                      <td><a href="<?php echo base_url(); ?>doctors/single-patient/<?php echo $appointValue['patient_id']; ?>"><?php echo $patientCode; ?></a></td>
                      <td><?php if(isset($appointValue['patient_name']) && $appointValue['patient_name'] !=''){ echo $appointValue['patient_name']; } ?></td>
                      <td><?php if(isset($patient_data['age']) && $patient_data['age'] !=''){ echo $patient_data['age']; } ?>/<?php if(isset($patient_data['gender']) && $patient_data['gender'] !=''){ echo $patient_data['gender']; } ?></td>
                      <?php $appointmentCode = "APP".str_pad($appointValue['id'], 4, "0", STR_PAD_LEFT); ?>
                      <td><?php echo $appointmentCode; ?></td>
                      <td><?=$fetch_slot['start_time'].' - '.$fetch_slot['end_time']?></td>
                      <?php if(isset($appointValue['status']) && $appointValue['status'] == '0') { ?>
                        <td><span class="status-info btn btn-warning">Pending</span></td>
                      <?php }else{?>
                        <td><span class="status-info btn btn-success">Completed</span></td>
                      <?php } ?>
                      <td>
                        <a href="<?php echo base_url(); ?>doctors/write-prescription/<?php echo $appointValue['patient_id']; ?>" class="btn btn-primary modal-btn" title="Write Prescription"><i class="bi bi-pen"></i> Prescription</a>
                      </td>
                    </tr>
                    <?php $i++; } } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    
    
    <?php } ?>
    
    
  