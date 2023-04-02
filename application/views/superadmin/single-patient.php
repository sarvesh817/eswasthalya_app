<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="index-2.html">Home</a></li>
          <li class="breadcrumb-item">Doctor</li>
          <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
    <div class="row g-3">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap flex-md-nowrap justify-content-between">
              <div class="doctor-avatar order-0 order-md-1">
                <img src="<?php echo base_url(); ?>img/eclinic_upload/<?php if(isset($patient_details[0]['profile_photo']) && $patient_details[0]['profile_photo'] !=''){ echo $patient_details[0]['profile_photo']; }?>" class="img-thumbnail" alt="Patient" style="width: 260px;">
              </div>
              <div class="doctor-detail order-1 order-md-0">
                <div class="patient-title-btn">
                  <div class="title-btn">
                    <h3><?php if(isset($patient_details[0]['full_name']) && $patient_details[0]['full_name'] !=''){ echo $patient_details[0]['full_name']; }?> (<?php if(isset($patient_details[0]['id']) && $patient_details[0]['id'] !=''){ echo $PatientCode = "PID".str_pad($patient_details[0]['id'], 4, "0", STR_PAD_LEFT);  }?>)</h3>
                  <div class="btn-right">
                    <a href="<?php echo base_url(); ?>superadmin/patient-list" class="btn btn-dark"><i class="bi bi-arrow-left"></i> Back</a>
                  </div>
                  </div>
                </div>
                <div class="d-flex flex-row flex-wrap align-items-center mb-3 mt-2">
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Age/Sex</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details[0]['age']) && $patient_details[0]['age'] !=''){ echo $patient_details[0]['age']; }?>/<?php if(isset($patient_details[0]['gender']) && $patient_details[0]['gender'] !=''){ echo $patient_details[0]['gender']; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Spouse Name</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details[0]['relative_name']) && $patient_details[0]['relative_name'] !=''){ echo $patient_details[0]['relative_name']; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Contact Details</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details[0]['mobile']) && $patient_details[0]['mobile'] !=''){ echo $patient_details[0]['mobile']; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Emergency Contact Details</small>
                    <div class="mb-0"><?php if(isset($patient_details[0]['emergency_person']) && $patient_details[0]['emergency_person'] !=''){ echo $patient_details[0]['emergency_person']; }?></div>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details[0]['emergency_contact']) && $patient_details[0]['emergency_contact'] !=''){ echo $patient_details[0]['emergency_contact']; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Allergy</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details[0]['allergy']) && $patient_details[0]['allergy'] !=''){ echo $patient_details[0]['allergy']; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Marital Status</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details[0]['marital_status']) && $patient_details[0]['marital_status'] !=''){ echo $patient_details[0]['marital_status']; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Occupation</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details[0]['occupation']) && $patient_details[0]['occupation'] !=''){ echo $patient_details[0]['occupation']; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Health Insurance</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details[0]['health_insurance']) && $patient_details[0]['health_insurance'] !=''){ echo $patient_details[0]['health_insurance']; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Address</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details[0]['address']) && $patient_details[0]['address'] !=''){ echo $patient_details[0]['address']; }?></div>
                  </div>
                </div>
                <!--<span>It is a long established fact that a reader will be distracted by the readable<br> content of-->
                <!--  a page when looking at its layout.</span>-->
                <!-- <ul class="resume-box">
                  <li>
                    <div class="icon text-center">
                      <i class="fa-solid fa-video"></i>
                    </div>
                    <div class="fw-bold mb-0">Appointment Date-Time</div>
                    <span>13/02/2023 - 2:15PM to 2:30PM</span>
                  </li>
                </ul> -->
              </div>
            </div>
          </div>
          <h5 class="tab_title">Health Record</h5>
          <ul
            class="nav nav-tabs tab-card border-bottom-0 pt-2 fs-6 justify-content-center justify-content-md-start"
            role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab"
                href="#medicalHistory_record" role="tab" aria-selected="true"><i
                  class="fa-solid fa-notes-medical"></i> <span>Medical History</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab"
                href="#prescription_record" role="tab" aria-selected="false" tabindex="-1"><i
                  class="fa-solid fa-file-prescription"></i> <span>Prescription</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab"
                href="#labReport_record" role="tab" aria-selected="false" tabindex="-1"><i
                  class="fa-solid fa-file"></i> <span>Lab Report</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#media_record"
                role="tab" aria-selected="false" tabindex="-1"><i class="fa-solid fa-photo-film"></i>
                <span>Media</span></a></li>
          </ul>
        </div>
        <div class="tab-content mt-5">
          <!-- Tab: Overview -->
          <div class="tab-pane fade active show" id="medicalHistory_record" role="tabpanel">

            <div class="row g-3">
              <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="health-record-container">
                      <!-- Tab: Overview -->
                      <div class="tab-pane fade active show" id="allHistory_record" role="tabpanel">
                        <!-- All History -->
                        
                        <div class="row g-3">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-body">
                                <div class="table-filter">
                                    <div class="row">
                                     
                                        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                                          <div class="row-title mb-2">
                                            <h5>Medical History</h5>
                                          </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0"></div>
                                        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                                            <div class="btn-right">
                                          <?php if(isset($appointment_data) && $appointment_data =='') { ?>
                                            <a href="#" class="btn btn-primary">+ Add Medical History</a>
                                          <?php } ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="medicalHistoryTable" class="table card-table table-hover align-middle mb-0">
                                  <thead>
                                    <tr>
                                      <th>S. No</th>
                                      <th>App. ID</th>
                                      <th>App. Date</th>
                                      <th>Clinic ID</th>
                                      <th>Doctor Name</th>
                                      <th>Speciality</th>
                                      <th>App. Start-End Time</th>
                                      <th>App. Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    if(isset($appointment_data) && $appointment_data !='') {
                                        $i=1;
                                        foreach($appointment_data as $appointment_list)
                                        { 
                                            $this->db->where('id',$appointment_list['slot_id']);                  
		                                    $fetch_slot=$this->db->get('slot_management')->row_array();
                                    ?>
                                    <tr>
                                      <td><?php echo $i; ?></td>
                                      <?php $patientCode = "PID".str_pad($appointment_list['patient_id'], 4, "0", STR_PAD_LEFT); ?>
                                      <td><?php echo $patientCode; ?></td>
                                      <td><?php if(isset($appointment_list['patient_id']) && $appointment_list['created_at'] !=''){ echo $appointment_list['created_at']; } ?></td>
                                      <?php $clinicCode = "CID".str_pad($appointment_list['user_id'], 4, "0", STR_PAD_LEFT); ?>
                                      <td title="Address: India Gate, New Delhi Near - Supreme Court Metro Station, 110008" data-bs-toggle="tooltip"><?php echo $clinicCode; ?></td>
                                      <td>
                                            <?php 
                                                if(isset($appointment_list['doctor_id']) && $appointment_list['doctor_id'] !=''){ 
                                                
                                                    $doctDetails = $this->db->where('id',$appointment_list['doctor_id'])->get('tbl_doctors')->row();
                                                  
                                                    if($doctDetails){
                                                         
                                                         echo $doctDetails->name;
                                                    } 
    
                                                } 
                                            ?>
                                      
                                      </td>
                                      <td><?php if(isset($appointment_list['speciality']) && $appointment_list['speciality'] !=''){ echo $appointment_list['speciality']; } ?></td>
                                      
                                      <td><?php if(isset($fetch_slot['start_time']) && $fetch_slot['start_time'] !=''){ echo $fetch_slot['start_time']; }?> .' - '.<?php if(isset($fetch_slot['end_time']) && $fetch_slot['end_time'] !=''){ echo $fetch_slot['end_time']; }?></td>
                                      
                                      <?php if(isset($appointment_list['status']) && $appointment_list['status'] == '0') { ?>
                                        <td><span class="status-info btn btn-warning">Pending</span></td>
                                      <?php }else{?>
                                        <td><span class="status-info btn btn-success">Completed</span></td>
                                      <?php } ?>
                                      <td>
                                        <a href="#" class="btn btn-primary modal-btn" title="Edit Medical History" data-bs-toggle="tooltip"><i class="bi bi-pen"></i></a>
                                      </td>
                                    </tr>
                                    <?php $i++; } } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                      
                          
                        </div>
                      
                        <!-- .row end -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div> <!-- Row end  -->
          </div>
          <!-- Tab: Groups -->
          <div class="tab-pane fade" id="prescription_record" role="tabpanel">
            <div class="row g-3">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-filter">
                        <div class="row">
                          
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                              <div class="row-title mb-2">
                                <h5>Prescription</h5>
                              </div>
                            </div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0"></div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0"></div>
                        </div>
                    </div>
                    <table id="prescriptionTable" class="table card-table table-hover align-middle mb-0">
                      <thead>
                        <tr>
                          <th>S. No</th>
                          <th>Clinic ID</th>
                          <th>APP. ID</th>
                          <th>Dr. ID</th>
                          <th>Dr. Name</th>
                          <th>Speciality</th>
                          <th>Upload Date Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <tr>
                          <td>1</td>
                          <td>CID01</td>
                          <td>APP011</td>
                          <td>DR0018</td>
                          <td>Dr. Amit Sharma</td>
                          <td>Orthopedics</td>
                          <td>25/01/2023 01:45PM</td>
                          <td>
                            <!--<a href="#" class="btn btn-success modal-btn" title="Edit Prescription" data-bs-toggle="tooltip"><i class="bi bi-pen"></i></a>-->
                            <a href="#" class="btn btn-primary modal-btn" title="View Report" data-bs-toggle="modal" data-bs-target="#prescriptionstaticBackdrop" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                          </td>
                        </tr>
                       
                      </tbody>
                    </table>
                  </div>
                  <!--Mannual Prescription-->
                  <hr>
                      <div class="card-body">
                        <div class="table-filter">
                            <div class="row">
                                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                                  <div class="row-title mb-2">
                                    <h5>Mannual Prescription</h5>
                                  </div>
                                </div>
                                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0"></div>
                                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                                  <div class="btn-right">
                                    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addprescription"><i class="fa fa-upload icon-text"></i> Upload Prescription</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <table class="table card-table table-hover align-middle mb-0">
                          <thead>
                            <tr>
                              <th>S. No</th>
                              <th>Showing</th>
                              <th>Upload Date Time</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                         <tr>
                              <td>1</td>
                              <td>E-Clinic</td>
                              <td>25/01/2023 01:45PM</td>
                              <td>
                                <a href="#" class="btn btn-secondary modal-btn" title="Download Report" data-bs-toggle="modal" data-bs-target="#addprescription" data-bs-toggle="tooltip"><i class="bi bi-pen"></i></a>
                                <a href="#" class="btn btn-primary modal-btn" title="View Report" data-bs-toggle="modal" data-bs-target="#prescriptionstaticBackdrop" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-danger modal-btn" title="Delete Prescription" data-bs-toggle="modal" data-bs-target="#deletemodal" data-bs-toggle="tooltip"><i class="bi bi-trash"></i></a>
                              </td>
                            </tr>
                           
                          </tbody>
                        </table>
                      </div>
                  <!--End-->
                </div>
              </div>

            </div>
          </div>
          <!-- Tab: Groups -->
          <div class="tab-pane fade" id="labReport_record" role="tabpanel">
            <div class="row g-3">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-filter">
                        <div class="row">
                          
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                              <div class="row-title mb-2">
                                <h5>Lab Report</h5>
                              </div>
                            </div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0"></div>
                            
                        </div>
                    </div>
                    <table id="labReportTable" class="table card-table table-hover align-middle mb-0">
                      <thead>
                        <tr>
                          <th>S. No</th>
                          <th>Lab ID</th>
                          <th>Lab Name</th>
                          <th>Test Category</th>
                          <th>Lab Test</th>
                          <th>Upload Date Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <tr>
                          <td>1</td>
                          <td>LID002</td>
                          <td>Dentist Laboratory</td>
                          <td>X-Ray</td>
                          <td>RCT X-Ray</td>
                          <td>25/01/2023 01:45PM</td>
                          <td>
                                <a href="#" class="btn btn-primary modal-btn" title="View Report" data-bs-toggle="modal" data-bs-target="#viewlabreport" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-danger modal-btn" title="Delete Prescription" data-bs-toggle="modal" data-bs-target="#deletemodal" data-bs-toggle="tooltip"><i class="bi bi-trash"></i></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!--Second Card Body-->
                    <hr>
                      <div class="card-body">
                        <div class="table-filter">
                            <div class="row">
                                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                                  <div class="row-title mb-2">
                                    <h5>Mannual Lab Report</h5>
                                  </div>
                                </div>
                                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0"></div>
                                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                                    <div class="btn-right">
                                  <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addlabreport"><i class="fa fa-upload icon-text"></i> Upload Lab Report</a>
                                </div>
                                    
                                  </div>
                            </div>
                        </div>
                        <table id="prescriptionTable" class="table card-table table-hover align-middle mb-0">
                          <thead>
                            <tr>
                              <th>S. No</th>
                              <th>Showing</th>
                              <th>Upload Date Time</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                         <tr>
                              <td>1</td>
                              <td>E-Clinic</td>
                              <td>25/01/2023 01:45PM</td>
                              <td>
                                <a href="#" class="btn btn-secondary modal-btn" title="Edit Report" data-bs-toggle="modal" data-bs-target="#addlabreport" data-bs-toggle="tooltip"><i class="bi bi-pen"></i></a>
                                <a href="#" class="btn btn-primary modal-btn" title="View Report" data-bs-toggle="modal" data-bs-target="#viewlabreport" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-danger modal-btn" title="Delete Prescription" data-bs-toggle="modal" data-bs-target="#deletemodal" data-bs-toggle="tooltip"><i class="bi bi-trash"></i></a>
                              </td>
                            </tr>
                           
                          </tbody>
                        </table>
                      </div>
                  <!--End-->
                </div>
              </div>

            </div>
          </div>
          <!-- Tab: Groups -->
          <div class="tab-pane fade" id="media_record" role="tabpanel">
            <div class="row g-3">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-filter">
                        <div class="row">
                          
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                              <div class="row-title mb-2">
                                <h5>Media</h5>
                              </div>
                            </div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0"></div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                                 <div class="btn-right">
                                  <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmediafile">+ Add Media</a>
                                </div>
                              </div>
                        </div>
                    </div>
                    <table id="mediaReportTable" class="table card-table table-hover align-middle mb-0">
                          <thead>
                            <tr>
                              <th>S. No</th>
                              <th>Media Type</th>
                              <th>Showing</th>
                              <th>Upload Date Time</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>
                                <span class="media-type-file">
                                  <i class="bi bi-card-image"></i>
                              </span>
                            </td>
                              <td>E-Clinic</td>
                              <td>25/01/2023 01:45PM</td>
                              <td>
                                <a href="#" class="btn btn-secondary modal-btn" title="Edit Media" data-bs-toggle="modal" data-bs-target="#addmediafile" data-bs-toggle="tooltip"><i class="bi bi-pen"></i></a>
                                <a href="#" class="btn btn-primary modal-btn" title="View Media" data-bs-toggle="modal" data-bs-target="#mediastaticBackdrop" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-danger modal-btn" title="Delete Media" data-bs-toggle="modal" data-bs-target="#deletemodal" data-bs-toggle="tooltip"><i class="bi bi-trash"></i></a>
                              </td>
                            </tr>
                            
                          </tbody>
                        </table>
                  </div>
                  
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div> <!-- .row end -->
  </div>
</div>


<!-- All Popup -->
<!-- Media -->
<div class="modal fade" id="mediastaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">PID001 - Media</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="media-view-container">
          <img src="assets/img/patient-media/swollen-knee-treatment.jpg" alt="Patient View" class="patient-media-items">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- Add/Edit -->
<div class="modal fade" id="addmediafile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Media</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="col-sm-12 mb-2 text-left">
            <label class="form-label">Media Type<span class="required_asterisk">*</span></label>
                <select class="form-control form-control-lg" tabindex="-98">
                  <option value="">- Select Media Type -</option>
                  <option value="audio">Audio</option>
                  <option value="video">Video</option>
                  <option value="image">Image</option>
                </select>
          </div>
          <div class="col-sm-12 mb-2 text-left">
            <label class="form-label">Upload Media<span class="required_asterisk">*</span></label>
            <input type="file" class="form-control required-entry" name="profile">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success"><i class="bi bi-upload"></i> Upload</button>
      </div>
    </div>
  </div>
</div>

<!-- labReportstaticBackdrop -->

<!-- Add/Edit -->
<div class="modal fade" id="addlabreport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lab Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          
          <div class="col-sm-12 mb-2 text-left">
            <label class="form-label">Upload Lab Report<span class="required_asterisk">*</span></label>
            <input type="file" class="form-control required-entry" name="profile">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success"><i class="bi bi-upload"></i> Upload</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="viewlabreport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Path Laboratory (LAB00011)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="media-view-container">
          <img src="assets/img/Lab Report/GNU_Health_lab_report_sample.png" alt="Lab Report View" class="patient-media-items">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<!-- prescriptionstaticBackdrop -->
<!-- Add/Edit -->
<div class="modal fade" id="addprescription" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Prescription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          
          <div class="col-sm-12 mb-2 text-left">
            <label class="form-label">Upload Prescription<span class="required_asterisk">*</span></label>
            <input type="file" class="form-control required-entry" name="profile">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success"><i class="bi bi-upload"></i> Upload</button>
      </div>
    </div>
  </div>
</div>

<!-- View -->
<div class="modal fade" id="prescriptionstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Prescription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="media-view-container">
          <img src="assets/img/Lab Report/GNU_Health_lab_report_sample.png" alt="Lab Report View" class="patient-media-items">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<!-- ::::::::::::::::::::::::::::::::: Begin Delete ::::::::::::::::::::::::::::::::: -->
<!-- 1. If Delete then please add also deleted confirmed modal -->
<div class="modal fade" id="deletemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
        <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#donedeletestaticBackdrop">Yes, Delete it!</button>
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


<!-- End All Popup -->
