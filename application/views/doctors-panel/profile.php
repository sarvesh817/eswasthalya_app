<!-- start: page toolbar -->
    <?php
        $hash = $this->security->get_csrf_hash();
        $userseesid = $this->session->userdata('user_id');
        $USERTYPE = $this->session->userdata('type');
        $status = $this->session->userdata('status');
        $SUBROLE_ID = $this->session->userdata('subrole_id'); 
        //echo"<pre>";print_r($_SESSION);exit;  
        auto_logout_when_change_password();
    ?>

    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">My Profile</li>
            </ol>
          </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
          <div class="col-auto">
            <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, <?php echo $this->session->userdata('name'); ?>!</h1>
            <small class="text-muted">You have 12 new messages and 7 new notifications.</small>
          </div>
          
        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body border-bottom">
                <div class="d-flex align-items-md-start align-items-center flex-column flex-md-row">
                   <?php if(!empty($doctor_info_edit[0]['photo'])){ ?>
                      <img src="<?php echo base_url() ?>img/doctor_upload/<?php echo $doctor_info_edit[0]['photo']; ?>" alt="" class="rounded-4" style="width: 150px; height: 170px;">
                  <?php }else{ ?>
                  
                      <img src="<?php echo base_url() ?>img/doctor_upload/profile_av.png" alt="" class="rounded-4" style="width: 150px; height: 170px;">
                  <?php } ?>
                  
                  
                  
                  <div class="media-body ms-md-5 m-0 mt-4 mt-md-0 text-md-start text-center">
                    <h4 class="mb-1 fw-light">Dr. <?php echo $this->session->userdata('name'); ?> <a href="<?php echo base_url() ?>doctors/edit-profile" class="fa fa-pencil-square-o fs-6 ms-2" data-bs-toggle="tooltip" title="Edit Profile"></a></h4>
                    <p><?=$_SESSION['email']?></p>    
                    <span class="text-muted"><?php if(isset($doctor_info_edit[0]['your_self'])){ echo $doctor_info_edit[0]['your_self']; } ?></span>
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
                    <a href="#">
                        <div class="card py-2 px-3 me-2 mt-2">
                            <small class="text-muted">Total Earnings</small>
                            <div class="fs-5">₹ 0.00</div>
                          </div>
                    </a>
                      <div class="card py-2 px-3 me-2 mt-2">
                        <small class="text-muted">Specialities</small>
                        <div class="fs-5"><?php if(isset($doctor_info_edit[0]['specialization'])){ echo $doctor_info_edit[0]['specialization']; } ?></div>
                      </div>
                      <div class="card py-2 px-3 me-2 mt-2">
                        <small class="text-muted">Experience</small>
                        <div class="fs-5"><?php if(isset($doctor_info_edit[0]['work_experience'])){ echo $doctor_info_edit[0]['work_experience']; } ?></div>
                      </div>
                      <div class="card py-2 px-3 me-2 mt-2">
                        <small class="text-muted">Education</small>
                        <div class="fs-5"><?php if(isset($doctor_info_edit[0]['qualification'])){ echo $doctor_info_edit[0]['qualification']; } ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs tab-card border-bottom-0 pt-2 fs-6 justify-content-center justify-content-md-start" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#profile_post" role="tab"><span>Overview</span></a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#profile_documents" role="tab"><i class="fa fa-address-card-o"></i><span class="d-none d-sm-inline-block ms-2">Documents</span></a></li>
                
              </ul>
            </div>
            <div class="tab-content mt-5">
              <!-- Tab: Overview -->
              <div class="tab-pane fade show active" id="profile_post" role="tabpanel">
                <div class="row-title mb-2">
                  <h5>Profile Overview</h5>
                </div>
                <div class="row g-3">
                  <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                    <div class="card mb-3">
                      <div class="card-body">
                        <h6 class="card-title mb-3">Personal Information</h6>
                        
                        <ul class="list-unstyled mb-0">
                          <li class="py-2"><span class="text-muted me-2 w90 d-inline-block">Full Name:</span> <?php if(!empty($this->session->userdata('name'))) { echo $this->session->userdata('name'); }?></li>
                          <li class="py-2"><span class="text-muted me-2 w90 d-inline-block">E-mail:</span><?php if(!empty($this->session->userdata('email'))) { echo $this->session->userdata('email'); }?></li>
                          <li class="py-2"><span class="text-muted me-2 w90 d-inline-block">Phone:</span><?php if(!empty($this->session->userdata('userContact'))) { echo $this->session->userdata('userContact'); }?></li>
                          <li class="py-2"><span class="text-muted me-2 w90 d-inline-block">Address:</span><?php if(isset($doctor_info_edit[0]['current_address'])){ echo $doctor_info_edit[0]['current_address']; } ?> </li>
                          <li class="py-2"><span class="text-muted me-2 w90 d-inline-block">Speciality:</span>
                          
                          <?php 
                            if(isset($doctor_info_edit[0]['specialization']) && $doctor_info_edit[0]['specialization'] !=''){ 
                            $specilityData = $this->db->where('id',$doctor_info_edit[0]['specialization'])->get('tbl_speciality')->row();
                                if($specilityData){
                                    echo $specilityData->speciality;
                                } 
                            } 
                          ?>
                          
                          </li>  
                        </ul>
                      </div>
                    </div>
                    
                  </div>
                 
                </div> <!-- Row end  -->
              </div>
              <!-- Tab: Groups -->
              <div class="tab-pane fade" id="profile_documents" role="tabpanel">
                <div class="row-title mb-2">
                  <h5>Documents</h5>
                </div>
                <div class="row g-3">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <table class="table card-table table-hover align-middle mb-0">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Document Name</th>
                                <th>Upload Date Time</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                
                                <?php if(isset($doctor_info_edit[0]['signature']) && $doctor_info_edit[0]['signature'] !='' || isset($doctor_info_edit[0]['joining_letter']) && $doctor_info_edit[0]['joining_letter'] !='' || isset($doctor_info_edit[0]['other_document']) && $doctor_info_edit[0]['other_document'] !='') { ?>
                                
                                    <?php if(isset($doctor_info_edit[0]['signature']) && $doctor_info_edit[0]['signature'] !=''){ $img = $doctor_info_edit[0]['signature']; ?>
                                    <tr>
                                        <td>1</td>
                                        <td><b>Signature</b>
                                        </td>          
                                        <td><?php if(isset($doctor_info_edit[0]['signature'])){ echo $doctor_info_edit[0]['signature_date']; }else{ echo "NA"; } ?></td> 
                                        
                                        <?php if(!empty($status) && $status =='Approved'){ ?>
                                            <td><span class="status-info btn btn-success">Verified</span></td>
                                        <?php }else{ ?>
                                            <td><span class="status-info btn btn-warning">Pending</span></td>
                                        <?php } ?>
                                        
                                        <td>
                                            <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="modal" data-bs-target="#viewCertificateBackdrop" title="View" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                                            <a href="#<?php //echo base_url('doctors-panel/edit-profile')?>" class="btn btn-secondary modal-btn editMode" title="Edit" data-bs-toggle="tooltip"><i class="bi bi-pen"></i></a>
                                            <a href="#" class="btn btn-danger modal-btn deleteBTn1" title="Delete" data-bs-toggle="tooltip" data-id='' ><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php
                                    if($doctor_info_edit[0]['joining_letter'] != '') { ?>
                                    <?php if(isset($doctor_info_edit[0]['joining_letter']) && $doctor_info_edit[0]['joining_letter'] !=''){ $img = $doctor_info_edit[0]['joining_letter']; ?>
                                    <tr>
                                        <td>2</td>
                                        <td><b>Joining Letter</b>
                                        </td>   
                                        <td><?php if(isset($doctor_info_edit[0]['joining_letter'])){ echo $doctor_info_edit[0]['joining_date']; }else{ echo "NA"; } ?></td> 
                                        
                                        <?php if(!empty($status) && $status =='Approved'){ ?>
                                            <td><span class="status-info btn btn-success">Verified</span></td>
                                        <?php }else{ ?>
                                            <td><span class="status-info btn btn-warning">Pending</span></td>
                                        <?php } ?>
                                        <td>
                                    
                                            <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="modal" data-bs-target="#viewCertificateBackdrop2" title="View" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                                            <a href="#<?php //echo base_url('doctors-panel/edit-profile')?>" class="btn btn-secondary modal-btn editMode" title="Edit" data-bs-toggle="tooltip"><i class="bi bi-pen"></i></a>
                                            <a href="#" class="btn btn-danger modal-btn deleteBTn2" title="Delete" data-bs-toggle="tooltip"><i class="bi bi-trash"></i></a>
                                        
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                    <?php if(isset($doctor_info_edit[0]['other_document']) && $doctor_info_edit[0]['other_document'] !=''){ $img = $doctor_info_edit[0]['other_document']; ?>
                                    <tr>
                                        <td>3</td>
                                        <td><b>Other Document</b></td>   
                                        <td><?php if(isset($doctor_info_edit[0]['other_document'])){ echo $doctor_info_edit[0]['document_date']; }else{ echo "NA"; } ?></td>    
                                        <?php if(!empty($status) && $status =='Approved'){ ?>
                                            <td><span class="status-info btn btn-success">Verified</span></td>
                                        <?php }else{ ?>
                                            <td><span class="status-info btn btn-warning">Pending</span></td>
                                        <?php } ?>              
                                        <td>
                                            <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="modal" data-bs-target="#viewCertificateBackdrop3" title="View" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                                            <a href="#<?php //echo base_url('doctors-panel/edit-profile')?>" class="btn btn-secondary modal-btn editMode" title="Edit" data-bs-toggle="tooltip"><i class="bi bi-pen"></i></a>
                                            <a href="#" class="btn btn-danger modal-btn deleteBTn3" title="Delete" data-bs-toggle="tooltip"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php }else{ ?> 
                                      
                                    <tr>
                                        <td colspan="5"><a href="<?=base_url('doctors/edit-profile')?>" class="btn btn-primary" style="float:center">Upload Document</a></td>
                                    </tr>
                                
                                <?php } ?>
                            </tbody>
                          </table>
                        
                      </div>
                    </div> <!-- .Card End -->
                  </div>

                </div> <!-- Row end  -->

              </div>
              <!-- Tab: Project -->

              <!-- Tab: Campaigns -->

            </div>

          </div>
        </div> <!-- Row end  -->
      </div>
    </div>
    

    <div class="modal fade" id="viewCertificateBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Signature</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="media-view-container">
                    <?php if(isset($doctor_info_edit[0]['signature']) && $doctor_info_edit[0]['signature'] !=''){
                        $img = $doctor_info_edit[0]['signature'];
                        $file_extension = explode('.',$img);
                        $file_extension = strtolower(end($file_extension));
                        $accepted_formate = array('jpeg','jpg','png');
                        if(in_array($file_extension,$accepted_formate)) {  ?>          
                          <img src="<?php echo base_url('img/doctor_upload/'.$img); ?>" alt="Patient View" class="patient-media-items">
                        <?php } else { ?>
                          <iframe src="<?php echo base_url('img/doctor_upload/'.$img); ?>" alt="Patient View" class="patient-media-items" width="100%" height="500"></iframe>
                        <?php } ?>
                     
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <!--<a href="javascript:void(0);" class="btn btn-success"><i class="bi bi-download"></i> Download</a>-->
            </div>
          </div>
        </div>
    </div>
    
    <div class="modal fade" id="viewCertificateBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Joining/Contract Letter</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="media-view-container">
                <?php if(isset($doctor_info_edit[0]['joining_letter']) && $doctor_info_edit[0]['joining_letter'] !=''){ 
                    $img = $doctor_info_edit[0]['joining_letter'];
                    $file_extension = explode('.',$img);
                    $file_extension = strtolower(end($file_extension));
                    $accepted_formate = array('jpeg','jpg','png');
                    if(in_array($file_extension,$accepted_formate)) {  ?>          
                      <img src="<?php echo base_url('img/doctor_upload/'.$img); ?>" alt="Patient View" class="patient-media-items">
                    <?php } else { ?>
                      <iframe src="<?php echo base_url('img/doctor_upload/'.$img); ?>" alt="Patient View" class="patient-media-items" width="100%" height="500"></iframe>
                    <?php } ?>
                <?php } ?>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <!--<a href="javascript:void(0);" class="btn btn-success"><i class="bi bi-download"></i> Download</a>-->
            </div>
          </div>
        </div>
    </div>
    
    <div class="modal fade" id="viewCertificateBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Other Documents</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="media-view-container">
                <?php if(isset($doctor_info_edit[0]['other_document']) && $doctor_info_edit[0]['other_document'] !=''){ 
                    $img = $doctor_info_edit[0]['other_document'];
                    $file_extension = explode('.',$img);
                    $file_extension = strtolower(end($file_extension));
                    $accepted_formate = array('jpeg','jpg','png');
                    if(in_array($file_extension,$accepted_formate)) {  ?>          
                      <img src="<?php echo base_url('img/doctor_upload/'.$img); ?>" alt="Patient View" class="patient-media-items">
                    <?php } else { ?>
                      <iframe src="<?php echo base_url('img/doctor_upload/'.$img); ?>" alt="Patient View" class="patient-media-items" width="100%" height="500"></iframe>
                    <?php } ?>
                <?php } ?>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <!--<a href="javascript:void(0);" class="btn btn-success"><i class="bi bi-download"></i> Download</a>-->
            </div>
          </div>
        </div>
    </div>
    
    
    
    <!-- ::::::::::::::::::::::::::::::::: Begin Delete ::::::::::::::::::::::::::::::::: -->
<!-- 1. If Delete then please add also deleted confirmed modal -->
    <div class="modal fade" id="deletestaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header flex-column">
                      <div class="icon-box">
                          <i class="bi bi-x"></i>
                      </div>						
                      <h4 class="modal-title w-100">Are you sure?</h4>	
              <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
            <div class="modal-body">
              <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
             <!--  <button type="submit" class="btn btn-warning" id="deleteyesBTN" >Yes, Edit it!</button> -->
              <button type="submit" class="btn btn-danger" data-bs-toggle="modal" id="deleteyesBTN"    data-bs-target="#donedeletestaticBackdrop">Yes, Delete it!</button>
            </div>
          </div>
        </div>
    </div>

    <!-- 2. Deleted Confirmed -->
    <div class="modal fade" id="donedeletestaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header flex-column">
                      <div class="icon-box-confirmed text-success">
                          <i class="bi bi-check"></i>
                      </div>						
                      <h4 class="modal-title w-100">Deleted!</h4>	
              <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
            
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
  <!-- ::::::::::::::::::::::::::::::::: End Delete ::::::::::::::::::::::::::::::::: -->
  
  
  <div class="modal fade" id="editstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header flex-column">
                      <div class="icon-box">
                          <i class="bi bi-x"></i>
                      </div>						
                      <h4 class="modal-title w-100">Are you sure ?</h4>	
              <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
            <div class="modal-body">
              <p>Do you really want to edit these records?.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-warning" id="yesBTN" >Yes, Edit it!</button>
            </div>
          </div>
        </div>
    </div>
    
  
  <script>
        var URL = "<?=base_url('doctors/edit-profile')?>";
        $(document).ready(function(){
	        $('.editMode').click(function(){
	            $('#editstaticBackdrop').modal('show');
	            $('#yesBTN').click(function(){
                   window.location.href = URL;
    	        });

	        });
        });
        
        $(document).ready(function(){
          $('.deleteBTn1').click(function(){
            var delete_url = "<?=base_url('doctors/update-column-profile/1')?>";
	            $('#deletestaticBackdrop').modal('show');
	            $('#deleteyesBTN').click(function(){ 
	               $('#deletestaticBackdrop').modal('hide');  
	               $('#donedeletestaticBackdrop').modal('show'); 
                 window.location.href = delete_url;                          
    	        });

	        });   
        });

        $(document).ready(function(){
          $('.deleteBTn2').click(function(){
            var delete_url = "<?=base_url('doctors/update-column-profile/2')?>";
	            $('#deletestaticBackdrop').modal('show');
	            $('#deleteyesBTN').click(function(){ 
	               $('#deletestaticBackdrop').modal('hide');  
	               $('#donedeletestaticBackdrop').modal('show'); 
                   window.location.href = delete_url;                          
    	        });

	        });   
        });

        $(document).ready(function(){
          $('.deleteBTn3').click(function(){
            var delete_url = "<?=base_url('doctors/update-column-profile/3')?>";          
	            $('#deletestaticBackdrop').modal('show');
	            $('#deleteyesBTN').click(function(){ 
	               $('#deletestaticBackdrop').modal('hide');  
	               $('#donedeletestaticBackdrop').modal('show'); 
                 window.location.href = delete_url;                          
    	        });

	        });   
        });
        
        

    </script>
    