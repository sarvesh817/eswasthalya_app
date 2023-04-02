<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
    <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
            <div class="col">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a class="text-secondary" href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Patient Dashboard</li>
                </ol>
            </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-5 color-900 mt-1 mb-0">Patient Dashboard</h1>
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
                                        <h6 class="card-title m-0">Patient Dashboard</h6>
                                    </div>
                                </div>
                                <div class="col-xxl-8">
                                    <div class="btn-right" hidden>
                                        <a href="new-register.html" class="btn btn-primary"><i class="fa-solid fa-plus"></i> New Patient Registration</a>
                                    </div>
                                </div>
                    
                                <div class="col-xxl-4 col-md-4 col-sm-12 mt-2 mt-md-0"></div>
                                <div class="col-xxl-4 col-md-4 col-sm-12 mt-2 mt-md-0"></div>
                                <div class="col-xxl-4 col-md-4 col-sm-12 mt-2 mt-md-0">
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
                        <table id="myDataTable" class="table card-table table-hover align-middle mb-0 patient-dashboard">
                        <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Patient ID</th>
                                <th>Patient</th>
                                <th>Age/Sex</th>
                                <th>Email</th>
                                <th>Adhaar</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if(isset($patientListData) && $patientListData !=''){
                        $i=1;
                        foreach($patientListData as $patientValue) {
                        ?>  
                            <tr>
                                <td><?php echo $i; ?></td>
                                <?php $patientCode = "PID".str_pad($patientValue['id'], 4, "0", STR_PAD_LEFT); ?>
                                <td><a href="<?php echo base_url(); ?>superadmin/single-patient/<?php echo $patientValue['id']; ?>"><?php echo $patientCode ?></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo base_url(); ?>img/eclinic_upload/<?php if(isset($patientValue['profile_photo']) && $patientValue['profile_photo'] !=''){ echo $patientValue['profile_photo']; } ?>" class="avatar table-avatar rounded-circle me-3" alt="profile-image">
                                        <div>
                                            <div class="fw-bold"><?php if(isset($patientValue['full_name']) && $patientValue['full_name'] !=''){ echo $patientValue['full_name']; } ?></div>
                                            <span class="small text-muted"><?php if(isset($patientValue['mobile']) && $patientValue['mobile'] !=''){ echo $patientValue['mobile']; } ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td><?php if(isset($patientValue['age']) && $patientValue['age'] !=''){ echo $patientValue['age']; } ?>/<?php if(isset($patientValue['gender']) && $patientValue['gender'] !=''){ echo $patientValue['gender']; } ?></td>
                                <td><?php if(isset($patientValue['email']) && $patientValue['email'] !=''){ echo $patientValue['email']; } ?></td>
                                <td><?php if(isset($patientValue['aadhar_no']) && $patientValue['aadhar_no'] !=''){ echo $patientValue['aadhar_no']; } ?></td>
                                <td><?php if(isset($patientValue['address']) && $patientValue['address'] !=''){ echo $patientValue['address']; } ?></td>
                                <td>
                                    <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip" title="Book Lab Test"><i class="bi bi-eye"></i> Book Lab Test</a>
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