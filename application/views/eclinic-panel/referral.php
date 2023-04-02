<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
    <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
            <div class="col">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a class="text-secondary" href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Referral</li>
                </ol>
            </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-5 color-900 mt-1 mb-0">Referral</h1>
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
                        <div class="referral-tabs-container">
                            <div class="referral-tabs-head">
                                <div class="row align-items-center">
                                    <div class="col-lg-9 col-12">
                                        <ul class="nav nav-tabs tab-card border-bottom-0 pt-2 fs-6 justify-content-center justify-content-md-start referral-tabs-list"
                                    role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#hospital_referral_record" role="tab" aria-selected="true">
                                            <i class="fa-solid fa-hospital"></i>
                                            <span>Hospital</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#pathology_record" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="fa-sharp fa-solid fa-microscope"></i>
                                            <span>Pathology</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#radiology_record" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="fa-solid fa-x-ray"></i>
                                            <span>Radiology</span>
                                        </a>
                                        </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#home_healthcare_record" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="fa-solid fa-user-nurse"></i>
                                            <span>Home HealthCare</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#health_insurance_record" role="tab" aria-selected="false" tabindex="-1">
                                            <i class="fa-sharp fa-solid fa-notes-medical"></i>
                                            <span>Health Insurance</span>
                                        </a>
                                    </li>
                                </ul>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="referral-tabs-body">
                                <div class="tab-content mt-4">
                                    <div class="tab-pane fade active show" id="hospital_referral_record" role="tabpanel">
                                        
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="tabs-title" style="margin-bottom: 0px;">
                                            <h5>
                                                <i class="fa-solid fa-hospital"></i>
                                                <span>Hospital Referral</span>
                                            </h5>
                                        </div>
                                            </div>
                                            <div class="col-md-6">
                                               
                                        <div class="btn-right">
                                            <a href="<?php echo base_url(); ?>eclinic/add-new-referral" class="btn btn-primary">+ Add New</a>
                                        </div>
                                    
                                            </div>
                                        </div>
                                        
                                        <table id="hospital_referral_table" class="table card-table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>S. No</th>
                                                    <th>Patient ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Purpose</th>
                                                    <th>Hospital ID</th>
                                                    <th>Hospital Name</th>
                                                    <th>Documents</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="pathology_record" role="tabpanel">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="tabs-title" style="margin-bottom: 0px;">
                                            <h5>
                                                <i class="fa-sharp fa-solid fa-microscope"></i>
                                                <span>Pathology Referral</span>
                                            </h5>
                                        </div>
                                            </div>
                                            <div class="col-md-6">
                                               
                                        <div class="btn-right">
                                            <a href="<?php echo base_url(); ?>eclinic/add-new-referral" class="btn btn-primary">+ Add New</a>
                                        </div>
                                    
                                            </div>
                                        </div>
                                        
                                        <table id="pathology_referral_table" class="table card-table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>S. No</th>
                                                    <th>Patient ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Purpose</th>
                                                    <th>Pathology ID</th>
                                                    <th>Pathology Name</th>
                                                    <th>Documents</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="radiology_record" role="tabpanel">
                                         <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="tabs-title" style="margin-bottom: 0px;">
                                            <h5>
                                                <i class="fa-solid fa-x-ray"></i>
                                                <span>Radiology Referral</span>
                                            </h5>
                                        </div>
                                            </div>
                                            <div class="col-md-6">
                                               
                                        <div class="btn-right">
                                            <a href="<?php echo base_url(); ?>eclinic/add-new-referral" class="btn btn-primary">+ Add New</a>
                                        </div>
                                    
                                            </div>
                                        </div>
                                        
                                        <table id="radiology_referral_table" class="table card-table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>S. No</th>
                                                    <th>Patient ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Purpose</th>
                                                    <th>Radiology ID</th>
                                                    <th>Radiology Name</th>
                                                    <th>Documents</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="home_healthcare_record" role="tabpanel">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="tabs-title" style="margin-bottom: 0px;">
                                            <h5>
                                                <i class="fa-solid fa-user-nurse"></i>
                                                <span>Home HealthCare Referral</span>
                                            </h5>
                                        </div>
                                            </div>
                                            <div class="col-md-6">
                                               
                                        <div class="btn-right">
                                            <a href="<?php echo base_url(); ?>eclinic/add-new-referral" class="btn btn-primary">+ Add New</a>
                                        </div>
                                    
                                            </div>
                                        </div>
                                        
                                        <table id="homeHealthCare_referral_table" class="table card-table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>S. No</th>
                                                    <th>Patient ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Purpose</th>
                                                    <th data-bs-toggle="tooltip" title="Home HealthCare ID">HHC ID</th>
                                                    <th>Home HealthCare Name</th>
                                                    <th>Documents</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HSPTID001</td>
                                                    <td>Max Hospital</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="health_insurance_record" role="tabpanel">
                                       <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <div class="tabs-title" style="margin-bottom: 0px;">
                                            <h5>
                                                <i class="fa-sharp fa-solid fa-notes-medical"></i>
                                                <span>Health Insurance Referral</span>
                                            </h5>
                                        </div>
                                            </div>
                                            <div class="col-md-6">
                                               
                                        <div class="btn-right">
                                            <a href="<?php echo base_url(); ?>eclinic/add-new-referral" class="btn btn-primary">+ Add New</a>
                                        </div>
                                    
                                            </div>
                                        </div>
                                        
                                        <table id="healthInsurance_referral_table" class="table card-table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>S. No</th>
                                                    <th>Patient ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Purpose</th>
                                                    <th data-bs-toggle="tooltip" title="Health Insurance ID">H. Insurance ID</th>
                                                    <th>Health Insurance Name</th>
                                                    <th>Documents</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HISCID001</td>
                                                    <td>LIC</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HISCID001</td>
                                                    <td>Bajaj Insurance</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PID001</td>
                                                    <td>Aman Sharma</td>
                                                    <td>Heart Disease</td>
                                                    <td>HISCID001</td>
                                                    <td>Appolo Insurance</td>
                                                    <td title="View Documents" data-bs-toggle="modal" data-bs-target="#hospitalreferraldocument" data-bs-toggle="tooltip">
                                                        <span class="media-type-file">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </td>
                                                    <td>03/03/2023</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip"
                                                            title="Send Mail"><i class="fa-solid fa-envelope"></i> Send Mail</a>
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