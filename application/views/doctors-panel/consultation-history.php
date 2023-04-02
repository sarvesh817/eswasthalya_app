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
          <!--<div class="col d-flex justify-content-lg-end mt-2 mt-md-0">
            <div class="p-2 me-md-3">
              <div><span class="h6 mb-0">8.18K</span> <small class="text-secondary"><i class="fa fa-angle-up"></i> 1.3%</small></div>
              <small class="text-muted text-uppercase">Income</small>
            </div>
          </div>-->
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
                <table id="myDataTable" class="table card-table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th>S. No</th>
                      <th>Patient ID</th>
                      <th>Name</th>
                      <th>App. ID</th>
                      <th>App. Date</th>
                      <th>App. Start-End Time</th>
                      <th>App. Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--<tr>
                      <td>1</td>
                      <td><a href="single-patient.html" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop">PID001</a></td>
                      <td>Aman Sharma</td>
                      <td>APP00115</td>
                      <td>13/02/2023</td>
                      <td>2:15PM - 2:30PM</td>
                      <td><span class="status-info btn btn-warning">Pending</span></td>
                      <td>
                        <a href="single-patient.html" class="btn btn-primary modal-btn" title="Write Prescription"><i class="bi bi-pen"></i> Prescription</a>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td><a href="single-patient.html" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop">PID002</a></td>
                      <td>Aman Sharma</td>
                      <td>APP00115</td>
                      <td>13/02/2023</td>
                      <td>2:15PM - 2:30PM</td>
                      <td><span class="status-info btn btn-success">Completed</span></td>
                      <td>
                        <a href="single-patient.html" class="btn btn-primary modal-btn" title="Write Prescription"><i class="bi bi-pen"></i> Prescription</a>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td><a href="single-patient.html" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop">PID003</a></td>
                      <td>Aman Sharma</td>
                      <td>APP00115</td>
                      <td>13/02/2023</td>
                      <td>2:15PM - 2:30PM</td>
                      <td><span class="status-info btn btn-success">Completed</span></td>
                      <td>
                        <a href="single-patient.html" class="btn btn-primary modal-btn" title="Write Prescription"><i class="bi bi-pen"></i> Prescription</a>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td><a href="single-patient.html" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop">PID004</a></td>
                      <td>Aman Sharma</td>
                      <td>APP00115</td>
                      <td>13/02/2023</td>
                      <td>2:15PM - 2:30PM</td>
                      <td><span class="status-info btn btn-success">Completed</span></td>
                      <td>
                        <a href="single-patient.html" class="btn btn-primary modal-btn" title="Write Prescription"><i class="bi bi-pen"></i> Prescription</a>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td><a href="single-patient.html" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop">PID005</a></td>
                      <td>Aman Sharma</td>
                      <td>APP00115</td>
                      <td>13/02/2023</td>
                      <td>2:15PM - 2:30PM</td>
                      <td><span class="status-info btn btn-danger">Cancelled</span></td>
                      <td>
                        <a href="single-patient.html" class="btn btn-primary modal-btn" title="Write Prescription"><i class="bi bi-pen"></i> Prescription</a>
                      </td>
                    </tr>-->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
