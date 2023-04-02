<?php 
$userid = $this->session->userdata('user_id');
//$uid = $this->session->userdata('user_id');
$userCode = "CL-".str_pad($userid, 5, "0", STR_PAD_LEFT);
$userstatus = $this->session->userdata('status');
?>

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
        <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, CL-<?php echo $this->session->userdata('name'); ?> !</h1>
        <small class="text-muted">You have 12 new messages and 7 new notifications.</small>
      </div>
      <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
    
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
          you have successfully created E-clinic profile with e-Swasthalya.
        </div>
      </div>
      <div class="col-lg-12 col-md-6 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="btn-center">
                    <img src="<?php echo base_url(); ?>bassets/img/verified.png" class="verify_profile_icon" alt="Verified" />
                    <a href="<?php echo base_url();?>eclinic/edit-profile" type="button" class="btn btn-success btn-lg">Verify My Profile</a>
                </div>
            </div>
        </div>
      </div>

    </div> <!-- .row end -->
  </div>
</div>

<?php }else{ ?>
<!-- Verified Eclinic Dashboard -->
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
  <div class="container-fluid">
    <div class="row g-3 row-deck">
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 18 18">
                <path d="M13.5 4.5C14.5 5.5 14.8958 4.16351 14.8958 5.81323C14.8958 7.17269 16 7 14.8958 7.86936C14.9492 9.24213 14.9661 10.5596 14.7708 11.8964C14.5612 13.3424 14.125 14.5873 13.345 15.4954C12.5299 16.4448 11.3802 17 9.78511 17C7.50775 17 6.21998 15.9854 5.49732 14.5487C4.90356 13.369 4.73169 11.9323 4.69913 10.5782C4.37361 10.3439 4.04678 10.0243 3.72647 9.64484C3.26162 9.09227 2.79938 8.40389 2.38531 7.67423C2.26813 7.46652 2.26162 7.22419 2.34755 7.02047C2.32542 6.97653 2.30328 6.93393 2.28115 6.88999C1.3788 5.08315 0.790252 3.11388 1.0702 2.25373C1.20171 1.84896 1.51682 1.58266 1.98036 1.43487C2.35537 1.31636 2.84105 1.27642 3.41527 1.30571C3.46605 1.25911 3.52465 1.21384 3.59235 1.17123C3.66657 1.1233 3.7421 1.08602 3.81631 1.05805C4.52856 0.787762 5.25773 1.5081 4.9296 2.25107C4.78117 2.58794 4.45304 2.83293 4.10017 2.82361C3.76944 2.81429 3.51032 2.59326 3.32152 2.33362L3.3098 2.30966C2.8736 2.29235 2.52073 2.31898 2.26943 2.39887C2.11839 2.4468 2.02594 2.50405 2.0038 2.5693C1.80719 3.17246 2.35797 4.83017 3.15746 6.42929C3.19001 6.49453 3.22256 6.55978 3.25641 6.62369C3.40485 6.68094 3.53506 6.78879 3.621 6.94058C3.9934 7.59834 4.40226 8.20949 4.8046 8.6875C5.01684 8.93915 5.22127 9.1482 5.41008 9.30265C5.43482 9.30265 5.45956 9.30398 5.48299 9.30664C5.66268 9.17483 5.8619 8.98309 6.07024 8.74875C6.49602 8.27207 6.92832 7.64095 7.32155 6.96189C7.40749 6.81409 7.53509 6.7089 7.68092 6.65165C8.51687 5.07117 9.11974 3.38151 8.99604 2.71576C8.96739 2.56397 8.83588 2.46544 8.64447 2.4002C8.39968 2.31631 8.08067 2.28303 7.73431 2.27371C7.7252 2.29368 7.71478 2.31365 7.70436 2.33495C7.51556 2.5946 7.25644 2.81562 6.92571 2.82494C6.57284 2.83426 6.24602 2.58927 6.09628 2.2524C5.76815 1.50943 6.49732 0.789093 7.20957 1.05805C7.28509 1.08602 7.35931 1.12463 7.43353 1.17123C7.4804 1.20052 7.52207 1.23248 7.56113 1.2631C8.06634 1.26444 8.55593 1.30438 8.95567 1.44286C9.48042 1.62394 9.85672 1.95415 9.96349 2.52935C10.1236 3.39615 9.49344 5.31217 8.59109 7.0471C8.67703 7.25348 8.66921 7.49715 8.54942 7.70619C8.10931 8.46647 7.61582 9.18148 7.12363 9.73272C6.7968 10.0989 6.46086 10.4025 6.12623 10.6142C6.15748 11.7699 6.30071 12.9629 6.76165 13.879C7.24993 14.8496 8.15098 15.5367 9.7799 15.5367C10.9244 15.5367 11.7239 15.1679 12.2669 14.5354C12.8463 13.8617 13.1784 12.8697 13.3515 11.686C13.5299 10.4597 13.5143 9.22748 13.4648 7.92395C12.1471 7.63635 13 6.93668 13 5.5C14 5 13.5 6 13.5 4.5Z"></path>
                <path class="fill-secondary" d="M16.1213 7.12132C15.5587 7.68393 14.7956 8 14 8C13.2044 8 12.4413 7.68393 11.8787 7.12132C11.3161 6.55871 11 5.79565 11 5C11 4.20435 11.3161 3.44129 11.8787 2.87868C12.4413 2.31607 13.2044 2 14 2C14.7956 2 15.5587 2.31607 16.1213 2.87868C16.6839 3.44129 17 4.20435 17 5C17 5.79565 16.6839 6.55871 16.1213 7.12132Z"></path>
              </svg>
            </div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Today Appointments</div>
              <span class="h5 mb-0">0,00</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 18 18">
                <path d="M13.5 4.5C14.5 5.5 14.8958 4.16351 14.8958 5.81323C14.8958 7.17269 16 7 14.8958 7.86936C14.9492 9.24213 14.9661 10.5596 14.7708 11.8964C14.5612 13.3424 14.125 14.5873 13.345 15.4954C12.5299 16.4448 11.3802 17 9.78511 17C7.50775 17 6.21998 15.9854 5.49732 14.5487C4.90356 13.369 4.73169 11.9323 4.69913 10.5782C4.37361 10.3439 4.04678 10.0243 3.72647 9.64484C3.26162 9.09227 2.79938 8.40389 2.38531 7.67423C2.26813 7.46652 2.26162 7.22419 2.34755 7.02047C2.32542 6.97653 2.30328 6.93393 2.28115 6.88999C1.3788 5.08315 0.790252 3.11388 1.0702 2.25373C1.20171 1.84896 1.51682 1.58266 1.98036 1.43487C2.35537 1.31636 2.84105 1.27642 3.41527 1.30571C3.46605 1.25911 3.52465 1.21384 3.59235 1.17123C3.66657 1.1233 3.7421 1.08602 3.81631 1.05805C4.52856 0.787762 5.25773 1.5081 4.9296 2.25107C4.78117 2.58794 4.45304 2.83293 4.10017 2.82361C3.76944 2.81429 3.51032 2.59326 3.32152 2.33362L3.3098 2.30966C2.8736 2.29235 2.52073 2.31898 2.26943 2.39887C2.11839 2.4468 2.02594 2.50405 2.0038 2.5693C1.80719 3.17246 2.35797 4.83017 3.15746 6.42929C3.19001 6.49453 3.22256 6.55978 3.25641 6.62369C3.40485 6.68094 3.53506 6.78879 3.621 6.94058C3.9934 7.59834 4.40226 8.20949 4.8046 8.6875C5.01684 8.93915 5.22127 9.1482 5.41008 9.30265C5.43482 9.30265 5.45956 9.30398 5.48299 9.30664C5.66268 9.17483 5.8619 8.98309 6.07024 8.74875C6.49602 8.27207 6.92832 7.64095 7.32155 6.96189C7.40749 6.81409 7.53509 6.7089 7.68092 6.65165C8.51687 5.07117 9.11974 3.38151 8.99604 2.71576C8.96739 2.56397 8.83588 2.46544 8.64447 2.4002C8.39968 2.31631 8.08067 2.28303 7.73431 2.27371C7.7252 2.29368 7.71478 2.31365 7.70436 2.33495C7.51556 2.5946 7.25644 2.81562 6.92571 2.82494C6.57284 2.83426 6.24602 2.58927 6.09628 2.2524C5.76815 1.50943 6.49732 0.789093 7.20957 1.05805C7.28509 1.08602 7.35931 1.12463 7.43353 1.17123C7.4804 1.20052 7.52207 1.23248 7.56113 1.2631C8.06634 1.26444 8.55593 1.30438 8.95567 1.44286C9.48042 1.62394 9.85672 1.95415 9.96349 2.52935C10.1236 3.39615 9.49344 5.31217 8.59109 7.0471C8.67703 7.25348 8.66921 7.49715 8.54942 7.70619C8.10931 8.46647 7.61582 9.18148 7.12363 9.73272C6.7968 10.0989 6.46086 10.4025 6.12623 10.6142C6.15748 11.7699 6.30071 12.9629 6.76165 13.879C7.24993 14.8496 8.15098 15.5367 9.7799 15.5367C10.9244 15.5367 11.7239 15.1679 12.2669 14.5354C12.8463 13.8617 13.1784 12.8697 13.3515 11.686C13.5299 10.4597 13.5143 9.22748 13.4648 7.92395C12.1471 7.63635 13 6.93668 13 5.5C14 5 13.5 6 13.5 4.5Z"></path>
                <path class="fill-secondary" d="M16.1213 7.12132C15.5587 7.68393 14.7956 8 14 8C13.2044 8 12.4413 7.68393 11.8787 7.12132C11.3161 6.55871 11 5.79565 11 5C11 4.20435 11.3161 3.44129 11.8787 2.87868C12.4413 2.31607 13.2044 2 14 2C14.7956 2 15.5587 2.31607 16.1213 2.87868C16.6839 3.44129 17 4.20435 17 5C17 5.79565 16.6839 6.55871 16.1213 7.12132Z"></path>
              </svg>
            </div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Total Appointments</div>
              <span class="h5 mb-0">0,00</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-smile-o fa-lg"></i></div>
            <div class="flex-fill ms-3 text-truncate">
              <div class="small">Total Happy Patients</div>
              <span class="h5 mb-0">0,00</span>
            </div>
          </div>
        </div>
      </div>
    
      <div class="col-xl-8 col-lg-8 col-md-12">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title m-0">Recent Patients Status</h6>
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
            <table id="myDataTable" class="table card-table table-hover align-middle mb-0">
              <thead>
                <tr>
                  <th>Patients</th>
                  <th>Adress</th>
                  <th>Admited</th>
                  <th>Discharge</th>
                  <th>Progress</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><img src="<?php echo base_url(); ?>bassets/img/xs/avatar3.jpg" class="avatar sm rounded-circle me-2" alt="profile-image"><span>John</span></td>
                  <td>70 Bowman St. South Windsor, CT 06074</td>
                  <td>Feb 13, 2022</td>
                  <td>Feb 16, 2022</td>
                  <td>
                    <div class="progress" style="height: 3px;">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"> <span class="sr-only">40% Complete</span> </div>
                    </div>
                  </td>
                  <td><span class="badge bg-info">Admit</span></td>
                </tr>
                <tr>
                  <td><img src="<?php echo base_url(); ?>bassets/img/xs/avatar1.jpg" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Jack Bird</span></td>
                  <td>123 6th St. Melbourne, FL 32904</td>
                  <td>Feb 13, 2022</td>
                  <td>Feb 22, 2022</td>
                  <td>
                    <div class="progress" style="height: 3px;">
                      <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                    </div>
                  </td>
                  <td><span class="badge bg-success">Discharge</span></td>
                </tr>
                <tr>
                  <td><img src="<?php echo base_url(); ?>bassets/img/xs/avatar2.jpg" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Jack Bird</span></td>
                  <td>4 Shirley Ave. West Chicago, IL 60185</td>
                  <td>Feb 17, 2022</td>
                  <td>Feb 16, 2022</td>
                  <td>
                    <div class="progress" style="height: 3px;">
                      <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                    </div>
                  </td>
                  <td><span class="badge bg-success">Discharge</span></td>
                </tr>
                
                <tr>
                  <td><img src="<?php echo base_url(); ?>bassets/img/xs/avatar5.jpg" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Hughe L.</span></td>
                  <td>4 Shirley Ave. West Chicago, IL 60185</td>
                  <td>Feb 18, 2022</td>
                  <td>Feb 18, 2022</td>
                  <td>
                    <div class="progress" style="height: 3px;">
                      <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"> <span class="sr-only">85% Complete</span> </div>
                    </div>
                  </td>
                  <td><span class="badge bg-info">Admit</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-12">
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
<?php } ?>