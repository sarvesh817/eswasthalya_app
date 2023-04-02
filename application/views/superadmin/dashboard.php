<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="dashboard.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </div>
    </div> <!-- .row end -->
    <div class="row align-items-center">
      <div class="col">
        <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, <?php echo $this->session->userdata('name'); ?> !</h1>
        <small class="text-muted">You have 12 new messages and 7 new notifications.</small>
      </div>
      <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
        <!-- daterange picker -->
        <div class="input-group">
          <input class="form-control" type="text" name="daterange">
          <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Send Report"><i class="fa fa-envelope"></i></button>
          <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Download Reports"><i class="fa fa-download"></i></button>
          <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Generate PDF"><i class="fa fa-file-pdf-o"></i></button>
          <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Share Dashboard"><i class="fa fa-share-alt"></i></button>
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
    </div> <!-- .row end -->
  </div>
</div>
<!-- start: page body -->
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
  <div class="container-fluid">
    <div class="row g-3 row-deck">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-user-md fa-lg"></i></div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Onboarding Doctor</div>
              <span class="h5 mb-0">2</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-clinic-medical fa-lg"></i></div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Onboarding E-Clinic</div>
              <span class="h5 mb-0">5,024</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-smile-o fa-lg"></i></div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Total Happy Patients</div>
              <span class="h5 mb-0">8,925</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-user-md fa-lg"></i></div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Total Doctors</div>
              <span class="h5 mb-0">1,925</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-clinic-medical fa-lg"></i></div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Total E-Clinic</div>
              <span class="h5 mb-0">11,024</span>
            </div>
          </div>
        </div>
      </div>
 
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-dollar fa-lg"></i></div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Revenue</div>
              <span class="h5 mb-0">₹108,925</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-credit-card fa-lg"></i></div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Expense</div>
              <span class="h5 mb-0">₹1011,024</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <span>Lab Income</span>
            <h4>₹ 7,12,326</h4>
          </div>
          <div id="apexspark1"></div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <span>Pharmacy Income</span>
            <h4>₹ 25,965</h4>
          </div>
          <div id="apexspark2"></div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <span>Video Consultant Income</span>
            <h4>₹ 104,965</h4>
          </div>
          <div id="apexspark3"></div>
        </div>
      </div>
      <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title m-0">Avg Video Consultant Costs</h6>
            <div class="dropdown morphing scale-left">
              <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
              <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
              <ul class="dropdown-menu shadow border-0 p-2">
                <li><a class="dropdown-item" href="#">File Info</a></li>
                <li><a class="dropdown-item" href="#">Copy to</a></li>
                <li><a class="dropdown-item" href="#">Move to</a></li>
                <li><a class="dropdown-item" href="#">Rename</a></li>
                <li><a class="dropdown-item" href="#">Block</a></li>
                <li><a class="dropdown-item" href="#">Delete</a></li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="h4 fw-bold mb-0">₹ 400</div>
            <span class="text-muted small">Avg Treatment Costs All Ages</span>
            <div id="apex-ATCosts"></div>
          </div>
        </div>
      </div>
      <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title m-0">Hospital Referral</h6>
            <div class="dropdown morphing scale-left">
              <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
              <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
              <ul class="dropdown-menu shadow border-0 p-2">
                <li><a class="dropdown-item" href="#">File Info</a></li>
                <li><a class="dropdown-item" href="#">Copy to</a></li>
                <li><a class="dropdown-item" href="#">Move to</a></li>
                <li><a class="dropdown-item" href="#">Rename</a></li>
                <li><a class="dropdown-item" href="#">Block</a></li>
                <li><a class="dropdown-item" href="#">Delete</a></li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div id="apex-HospitalSurvey"></div>
          </div>
        </div>
      </div>
    
     
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title m-0">Gender Overview</h6>
            <div class="dropdown morphing scale-left">
              <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
              <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
              <ul class="dropdown-menu shadow border-0 p-2">
                <li><a class="dropdown-item" href="#">File Info</a></li>
                <li><a class="dropdown-item" href="#">Copy to</a></li>
                <li><a class="dropdown-item" href="#">Move to</a></li>
                <li><a class="dropdown-item" href="#">Rename</a></li>
                <li><a class="dropdown-item" href="#">Block</a></li>
                <li><a class="dropdown-item" href="#">Delete</a></li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div id="apex-GenderOverview"></div>
          </div>
        </div>
      </div>
    </div> <!-- .row end -->
  </div>
</div>