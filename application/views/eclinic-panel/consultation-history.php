<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Consultation History</li>
        </ol>
      </div>
    </div> <!-- .row end -->
    <div class="row align-items-center">
      <div class="col-auto">
        <h1 class="fs-5 color-900 mt-1 mb-0">Consultation History</h1>
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
                        <h6 class="card-title m-0">Consultation History</h6>
                      </div>
                </div>
                  <div class="col-xxl-8">
                      <div class="btn-right">
                        <a href="<?php echo base_url(); ?>eclinic/patient-register" class="btn btn-primary"><i class="fa-solid fa-plus"></i> New Patient Registration</a>
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
                      </div>
                </div>
            </div>
            <table id="myDataTable" class="table card-table table-hover align-middle mb-0">
              <thead>
                <tr>
                  <th>S. No</th>
                  <th>Patient ID</th>
                  <th>Name</th>
                  <th>Dr. ID</th>
                  <th>Dr. Name</th>
                  <th>Speciality</th>
                  <th>App. ID</th>
                  <th>App. Date</th>
                  <th>App. Start-End Time</th>
                  <th>App. Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td data-bs-toggle="tooltip" title="Age/Sex: 32/M, Address: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus, itaque!">
                    <a href="<?php echo base_url(); ?>eclinic/single-patient" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop">PID001</a></td>
                  <td>Aman Sharma</td>
                  <td><a href="#">DRID0011</a></td>
                  <td>Dr. Aditya</td>
                  <td>Orthopedics</td>
                  <td>APP00115</td>
                  <td>13/02/2023</td>
                  <td>2:15PM - 2:30PM</td>
                  <td><span class="status-info btn btn-success">Completed</span></td>
                  <td>
                    <a href="<?php echo base_url(); ?>eclinic/single-patient" class="btn btn-primary modal-btn" data-bs-toggle="tooltip" title="View Invoice" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop"><i class="bi bi-eye"></i> View Invoice</a>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td data-bs-toggle="tooltip" title="Age/Sex: 32/M, Address: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus, itaque!">
                    <a href="<?php echo base_url(); ?>eclinic/single-patient" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop">PID002</a></td>
                  <td>Aman Sharma</td>
                  <td><a href="#">DRID0011</a></td>
                  <td>Dr. Aditya</td>
                  <td>Orthopedics</td>
                  <td>APP00115</td>
                  <td>13/02/2023</td>
                  <td>2:15PM - 2:30PM</td>
                  <td><span class="status-info btn btn-success">Completed</span></td>
                  <td>
                    <a href="<?php echo base_url(); ?>eclinic/single-patient" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop" class="btn btn-primary modal-btn" data-bs-toggle="tooltip" title="View Invoice"><i class="bi bi-eye"></i> View Invoice</a>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td data-bs-toggle="tooltip" title="Age/Sex: 32/M, Address: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus, itaque!"><a href="<?php echo base_url(); ?>eclinic/single-patient" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop">PID003</a></td>
                  <td>Aman Sharma</td>
                  <td><a href="#">DRID0011</a></td>
                  <td>Dr. Aditya</td>
                  <td>Orthopedics</td>
                  <td>APP00115</td>
                  <td>13/02/2023</td>
                  <td>2:15PM - 2:30PM</td>
                  <td><span class="status-info btn btn-success">Completed</span></td>
                  <td>
                    <a href="<?php echo base_url(); ?>eclinic/single-patient" class="btn btn-primary modal-btn" data-bs-toggle="tooltip" title="View Invoice" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop"><i class="bi bi-eye"></i> View Invoice</a>
                  </td>
                </tr>
                
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
        <a href="<?php echo base_url(); ?>eclinic/single-patient" class="btn btn-primary">Enter OTP</a>
      </div>
    </div>
  </div>
</div>
<!---------END OTP Varification Popup ----------------->

