<?php 
    $eclinicCode = "CL".str_pad($eclinic_profile_data[0]['id'], 4, "0", STR_PAD_LEFT);
    
    // $dobDate = date("Y", strtotime($doctor_profile_data[0]['created_at']));
    // $currentDate = date("Y");
    // $age = $currentDate - $dobDate;
    
    //echo $age; exit;
?>
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
        <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, <?php echo $this->session->userdata('name'); ?> !</h1>
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
                  <?php if(!empty($eclinic_profile_data[0]['photo'])){ ?>
                      <img src="<?php echo base_url() ?>img/eclinic_upload/<?php echo $eclinic_profile_data[0]['photo']; ?>" class="img-thumbnail" alt="Patient" style="width: 260px;">
                  <?php }else{ ?>
                  
                      <img src="<?php echo base_url() ?>img/eclinic_upload/profile_av.png" alt="" class="img-thumbnail" alt="Patient" style="width: 260px;">
                  <?php } ?>
                
              </div>
              <div class="doctor-detail order-1 order-md-0">
                <div class="patient-title-btn">
                  <div class="title-btn">
                    <h3>CL. <?php if(isset($eclinic_profile_data[0]['name']) && $eclinic_profile_data[0]['name'] !=''){ echo $eclinic_profile_data[0]['name']; } ?> (<?php echo $eclinicCode; ?>)</h3>
                  <div class="btn-right">
                    <a href="<?php echo base_url(); ?>superadmin/eclinic-list" class="btn btn-dark"><i class="bi bi-arrow-left"></i> Back</a>
                  </div>
                  </div>
                </div>
                <div class="d-flex flex-row flex-wrap align-items-center mb-3 mt-2">
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Contact</small>
                    <div class="mb-0 fw-bold"><?php if(isset($eclinic_profile_data[0]['contact']) && $eclinic_profile_data[0]['contact'] !=''){ echo $eclinic_profile_data[0]['contact']; } ?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Facilities</small>
                    <div class="mb-0 fw-bold"><?php if(isset($eclinic_profile_data[0]['facilities']) && $eclinic_profile_data[0]['facilities'] !=''){ echo $eclinic_profile_data[0]['facilities']; } ?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Experience</small>
                    <div class="mb-0 fw-bold"><?php if(isset($eclinic_profile_data[0]['experience']) && $eclinic_profile_data[0]['experience'] !=''){ echo $eclinic_profile_data[0]['experience']; } ?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Education</small>
                    <div class="mb-0 fw-bold"><?php if(isset($eclinic_profile_data[0]['qualification']) && $eclinic_profile_data[0]['qualification'] !=''){ echo $eclinic_profile_data[0]['qualification']; } ?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Address</small>
                    <div class="mb-0 fw-bold"><?php if(isset($eclinic_profile_data[0]['address']) && $eclinic_profile_data[0]['address'] !=''){ echo $eclinic_profile_data[0]['address']; } ?></div>
                  </div>
                </div>
                <span><?php if(isset($eclinic_profile_data[0]['about']) && $eclinic_profile_data[0]['about'] !=''){ echo $eclinic_profile_data[0]['about']; } ?></span>
                
              </div>
            </div>
          </div>
          <ul
            class="nav nav-tabs tab-card border-bottom-0 pt-2 fs-6 justify-content-center justify-content-md-start"
            role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab"
                href="#dr_documents_record" role="tab" aria-selected="true"><i
                  class="fa-solid fa-file"></i> <span>All Documents</span></a></li>
            
          </ul>
        </div>
        <div class="tab-content mt-5">

          <!-- Tab: Groups -->
          <div class="tab-pane fade active show" id="dr_documents_record" role="tabpanel">
            <div class="row g-3">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-filter">
                        <div class="row">
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                              <div class="row-title mb-2">
                                <h5>All Documents</h5>
                              </div>
                            </div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0"></div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                                <!-- daterange picker -->
                                <div class="input-group">
                                  <input class="form-control" type="text" name="daterange">
                                  <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Download Reports"><i class="fa fa-download"></i></button>
                                  <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Generate PDF"><i class="fa fa-file-pdf-o"></i></button>
                                </div>
                                <!-- Plugin Js -->
                                <script src="assets/js/bundle/daterangepicker.bundle.js"></script>
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
                    <table id="prescriptionTable" class="table card-table table-hover align-middle mb-0">
                      <thead>
                        <tr>
                          <th>S. No</th>
                          <th>Document Name</th>
                          <th>Upload Date Time</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Franchisee Agreement</td>
                          <td><?php if(isset($eclinic_profile_data[0]['franchisee_date']) && $eclinic_profile_data[0]['franchisee_date'] !=''){ echo $eclinic_profile_data[0]['franchisee_date']; } ?></td>
                          <td><span class="btn btn-success">Verified</span></td>
                          <td>
                            <a href="#" class="btn btn-primary modal-btn" title="View Report" data-bs-toggle="modal" data-bs-target="#documentSignature" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Qualification Documents</td>
                          <td><?php if(isset($eclinic_profile_data[0]['qua_documents_date']) && $eclinic_profile_data[0]['qua_documents_date'] !=''){ echo $eclinic_profile_data[0]['qua_documents_date']; } ?></td>
                          <td><span class="btn btn-success">Verified</span></td>
                          <td>
                            <a href="#" class="btn btn-primary modal-btn" title="View Report" data-bs-toggle="modal" data-bs-target="#documentJoiningLetter" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Ownership/Rent Lease Agreement</td>
                          <td><?php if(isset($eclinic_profile_data[0]['ownership_date']) && $eclinic_profile_data[0]['ownership_date'] !=''){ echo $eclinic_profile_data[0]['ownership_date']; } ?></td>
                          <td><span class="btn btn-success">Verified</span></td>
                          <td>
                            <a href="#" class="btn btn-primary modal-btn" title="View Report" data-bs-toggle="modal" data-bs-target="#documentCertificate" data-bs-toggle="tooltip"><i class="bi bi-eye"></i></a>
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
<div class="modal fade" id="documentSignature" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Franchisee Agreement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="media-view-container">
            <?php if(isset($eclinic_profile_data[0]['franchisee']) && $eclinic_profile_data[0]['franchisee'] !=''){
                $img = $eclinic_profile_data[0]['franchisee'];
                $file_extension = explode('.',$img);
                $file_extension = strtolower(end($file_extension));
                $accepted_formate = array('jpeg','jpg','png');
                if(in_array($file_extension,$accepted_formate)) {  ?>          
                  <img src="<?php echo base_url('img/eclinic_upload/'.$img); ?>" alt="Patient View" class="patient-media-items">
                <?php } else { ?>
                  <iframe src="<?php echo base_url('img/eclinic_upload/'.$img); ?>" alt="Patient View" class="patient-media-items" width="100%" height="500"></iframe>
                <?php } ?>
            <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="documentJoiningLetter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Joining/Contract Letter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="media-view-container">
            <?php if(isset($eclinic_profile_data[0]['qualification_documents']) && $eclinic_profile_data[0]['qualification_documents'] !=''){ 
                $img = $eclinic_profile_data[0]['qualification_documents'];
                $file_extension = explode('.',$img);
                $file_extension = strtolower(end($file_extension));
                $accepted_formate = array('jpeg','jpg','png');
                if(in_array($file_extension,$accepted_formate)) {  ?>          
                    <img src="<?php echo base_url('img/eclinic_upload/'.$img); ?>" alt="Patient View" class="patient-media-items">
                <?php } else { ?>
                    <iframe src="<?php echo base_url('img/eclinic_upload/'.$img); ?>" alt="Patient View" class="patient-media-items" width="100%" height="500"></iframe>
                <?php } ?>
            <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="documentCertificate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Certificate Letter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="media-view-container">
            <?php if(isset($eclinic_profile_data[0]['ownership']) && $eclinic_profile_data[0]['ownership'] !=''){ 
                $img = $eclinic_profile_data[0]['ownership'];
                $file_extension = explode('.',$img);
                $file_extension = strtolower(end($file_extension));
                $accepted_formate = array('jpeg','jpg','png');
                if(in_array($file_extension,$accepted_formate)) {  ?>          
                    <img src="<?php echo base_url('img/eclinic_upload/'.$img); ?>" alt="Patient View" class="patient-media-items">
                <?php } else { ?>
                    <iframe src="<?php echo base_url('img/eclinic_upload/'.$img); ?>" alt="Patient View" class="patient-media-items" width="100%" height="500"></iframe>
                <?php } ?>
            <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>