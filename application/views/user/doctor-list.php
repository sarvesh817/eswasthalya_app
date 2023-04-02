<!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">

        <div class="row g-2 row-deck">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header">
                <h6> Doctor Management &raquo; Doctors List </h6> 
                <div class="dropdown morphing scale-left">
                  <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                  <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                  <ul class="dropdown-menu shadow border-0 p-2">
                    <li>
                      <?php 
                        if ($this->session->userdata('user_id') > 0 && ($this->privilegeduser->hasPrivilege("addUser") || $this->userprivileged->hasUserPrivilege("addUser"))){
                          echo '<a href="'.URL.'add-doctor" class="btnAdd dropdown-item"> Add New Doctor</a>';
                         } 
                      ?>  
                    </li>
                    <li>
                      <?php 
                        if ($this->privilegeduser->hasPrivilege("exportDoctorUser") || $this->userprivileged->hasUserPrivilege("exportDoctorUser") ){
                          echo '<a href="'.URL.'getAllDRData" class="dropdown-item" id="doctorCSV">&nbsp;|&nbsp; Export Doctor List</a>';
                         } 
                      ?>  
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">

                <table class="table card-table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th><input type ="text" placeholder="Name" id="column2_search" class="searchInput form-control search-input-text" filtercol="1"/></th>
                      <th><input type ="text" placeholder="Employee ID/Docr Code" id="column3_search" class="form-control search-input-text" filtercol="2"/></th>
                      <th><input type ="text" placeholder="Email" id="column4_search" class="form-control search-input-text" filtercol="3"/></th>
                      <th><input type ="text" placeholder="Contact" id="column5_search"  class="form-control search-input-text" filtercol="4"/></th>
                      <th><input type ="text" placeholder="Role" id="column6_search"  class="form-control search-input-text" filtercol="5"/></th>
                      <th><input type ="text" placeholder="SubRole" id="column7_search"  class="form-control search-input-text" filtercol="6"/></th>
                    </tr>
                  </thead>
                </table> 


                <br>



                <div class="table-responsive">
                  <table class="table card-table table-hover align-middle mb-0" id="all_user" style="font-size: 12px;">
                    <thead>
                      <tr style="background-color: #52c1e8; color: #FFF;">
                        <th>Action</th>
                        <th>Doctor Id</th>
                        <th>Doctor Name</th>
                        <th>Specialist</th>
                        <th>Schedule</th>
                        <th>Progress</th>
                        <th>Date Join</th>
                        <th>Status</th> 
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                        if(!empty($doctor_list) && is_array($doctor_list) && count($doctor_list) >0){
                          $i = 1;
                          foreach ($doctor_list as $key => $value) {                  
                            echo "<tr><td>";
                            $href = base_url()."editDoctorView?text=".rtrim(strtr(base64_encode("id=".$value['user_id']), '+/', '-_'), '=');
                            echo '<a href="'. $href.'" target="_blank"><span class="glyphicon glyphicon-pencil"></span></a><br>';
                            echo "<a href='#myDRModal' data-toggle='modal' data-target='#myDRModal' data-id=".$value['user_type_id']." id='myDRDataBtn'><span class='glyphicon glyphicon-comment'></span></a>";
                            echo "</td><td>".$value['user_id']."</td>";
                            $i++;
                            echo "<td>".$value['name']."</td>";

                            echo "<td>".$value['status']."</td>";
                            echo "<td id='".$value['user_id']."'>";
                            if($value['incorrect_try']>3){
                              echo "<span class='incorrecttry' data-try='UnLocked' data-userid='".$value['user_id']."' title='Click to UnLock' style='cursor: pointer;color:#f70606;'>Locked</span>";
                            } else{
                              echo "<span class='incorrecttry' data-try='Locked' data-userid='".$value['user_id']."' title='Click to Lock' style='cursor: pointer; color: #52c1e8;'>Un-Locked</span>";
                            }
                            echo "</td>";
                            echo "<td>".$value['user_type']."</td>";
                            echo "<td>NA</td>";
                            echo "<td>".$value['created_at']."</td>";
                            echo "<td>".getUserName($value['created_by'])."</td>";
                            echo "<td>".$value['modified_at']."</td>";
                            echo "<td>".getUserName($value['modified_by'])."</td>";
                            echo "</tr>";
                          } 
                        }else{
                          echo "<tr><td colspan='9'>No Record Found...</td></tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>








                <!-- <table id="myAllDoctor" class="table card-table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Doctor</th>
                      <th>Specialist</th>
                      <th>Schedule</th>
                      <th>Progress</th>
                      <th>Date Join</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>DH0015</td>
                      <td>
                        <div class="d-flex">
                          <img src="../assets/img/xs/avatar1.jpg" class="avatar rounded-circle me-3" alt="profile-image">
                          <div>
                            <div class="fw-bold">Hossein Shams</div>
                            <span class="small text-muted">+ 44 123 456 2121</span>
                          </div>
                        </div>
                      </td>
                      <td>Physical Therapy</td>
                      <td><button type="button" class="btn btn-secondary btn-sm">No Schedule</button></td>
                      <td>
                        <div class="progress" style="height: 3px;">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"> <span class="sr-only">40% Complete</span> </div>
                        </div>
                      </td>
                      <td>Sept 16, 2016</td>
                      <td class="text-muted">Unavailable</td>
                    </tr>
                    <tr>
                      <td>DH0025</td>
                      <td>
                        <div class="d-flex">
                          <img src="../assets/img/xs/avatar2.jpg" class="avatar rounded-circle me-3" alt="profile-image">
                          <div>
                            <div class="fw-bold">Maryam Amiri</div>
                            <span class="small text-muted">+ 44 123 456 1414</span>
                          </div>
                        </div>
                      </td>
                      <td>Dentist</td>
                      <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#book_appointment">2 Appointment</button></td>
                      <td>
                        <div class="progress" style="height: 3px;">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width: 38%;"> <span class="sr-only">40% Complete</span> </div>
                        </div>
                      </td>
                      <td>Sept 16, 2016</td>
                      <td class="text-muted">Unavailable</td>
                    </tr>
                    <tr>
                      <td>DH0055</td>
                      <td>
                        <div class="d-flex">
                          <img src="../assets/img/xs/avatar3.jpg" class="avatar rounded-circle me-3" alt="profile-image">
                          <div>
                            <div class="fw-bold">Frank Camly</div>
                            <span class="small text-muted">+ 44 123 456 2626</span>
                          </div>
                        </div>
                      </td>
                      <td>Nursing</td>
                      <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#book_appointment">3 Appointment</button></td>
                      <td>
                        <div class="progress" style="height: 3px;">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"> <span class="sr-only">40% Complete</span> </div>
                        </div>
                      </td>
                      <td>Sept 16, 2016</td>
                      <td class="text-muted">Unavailable</td>
                    </tr>
                    <tr>
                      <td>DH0027</td>
                      <td>
                        <div class="d-flex">
                          <img src="../assets/img/xs/avatar4.jpg" class="avatar rounded-circle me-3" alt="profile-image">
                          <div>
                            <div class="fw-bold">Tim Hank</div>
                            <span class="small text-muted">+ 44 123 456 5926</span>
                          </div>
                        </div>
                      </td>
                      <td>Dentist</td>
                      <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#book_appointment">1 Appointment</button></td>
                      <td>
                        <div class="progress" style="height: 3px;">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"> <span class="sr-only">40% Complete</span> </div>
                        </div>
                      </td>
                      <td>Sept 16, 2016</td>
                      <td class="text-success">Available</td>
                    </tr>
                    <tr>
                      <td>DH0061</td>
                      <td>
                        <div class="d-flex">
                          <img src="../assets/img/xs/avatar5.jpg" class="avatar rounded-circle me-3" alt="profile-image">
                          <div>
                            <div class="fw-bold">Cindy Anderson</div>
                            <span class="small text-muted">+ 44 123 456 4848</span>
                          </div>
                        </div>
                      </td>
                      <td>Cardiologist</td>
                      <td><button type="button" class="btn btn-secondary btn-sm">No Schedule</button></td>
                      <td>
                        <div class="progress" style="height: 3px;">
                          <div class="progress-bar bg-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"> <span class="sr-only">40% Complete</span> </div>
                        </div>
                      </td>
                      <td>Nov 10, 2010</td>
                      <td class="text-muted">Unavailable</td>
                    </tr>
                    <tr>
                      <td>DH0026</td>
                      <td>
                        <div class="d-flex">
                          <img src="../assets/img/xs/avatar6.jpg" class="avatar rounded-circle me-3" alt="profile-image">
                          <div>
                            <div class="fw-bold">David Lee</div>
                            <span class="small text-muted">+ 44 123 456 7575</span>
                          </div>
                        </div>
                      </td>
                      <td>Dermatologists</td>
                      <td><button type="button" class="btn btn-danger btn-sm">Holiday</button></td>
                      <td>
                        <div class="progress" style="height: 3px;">
                          <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"> <span class="sr-only">40% Complete</span> </div>
                        </div>
                      </td>
                      <td>Jun 13, 2017</td>
                      <td class="text-success">Available</td>
                    </tr>
                    <tr>
                      <td>DH0021</td>
                      <td>
                        <div class="d-flex">
                          <img src="../assets/img/xs/avatar7.jpg" class="avatar rounded-circle me-3" alt="profile-image">
                          <div>
                            <div class="fw-bold">Hossein Shams</div>
                            <span class="small text-muted">+ 44 123 456 4545</span>
                          </div>
                        </div>
                      </td>
                      <td>Dentist</td>
                      <td><button type="button" class="btn btn-secondary btn-sm">No Schedule</button></td>
                      <td>
                        <div class="progress" style="height: 3px;">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"> <span class="sr-only">40% Complete</span> </div>
                        </div>
                      </td>
                      <td>Sept 11, 2016</td>
                      <td class="text-success">Available</td>
                    </tr>
                    <tr>
                      <td>DH0022</td>
                      <td>
                        <div class="d-flex">
                          <img src="../assets/img/xs/avatar8.jpg" class="avatar rounded-circle me-3" alt="profile-image">
                          <div>
                            <div class="fw-bold">Brian Swader</div>
                            <span class="small text-muted">+ 44 123 456 1425</span>
                          </div>
                        </div>
                      </td>
                      <td>Family Physicians</td>
                      <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#book_appointment">2 Appointment</button></td>
                      <td>
                        <div class="progress" style="height: 3px;">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%;"> <span class="sr-only">40% Complete</span> </div>
                        </div>
                      </td>
                      <td>Aug 22, 2020</td>
                      <td class="text-muted">Unavailable</td>
                    </tr>
                    <tr>
                      <td>DH0023</td>
                      <td>
                        <div class="d-flex">
                          <img src="../assets/img/xs/avatar9.jpg" class="avatar rounded-circle me-3" alt="profile-image">
                          <div>
                            <div class="fw-bold">Orlando Lentz</div>
                            <span class="small text-muted">+ 44 123 456 2525</span>
                          </div>
                        </div>
                      </td>
                      <td>Rectal Surgeons</td>
                      <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#book_appointment">4 Appointment</button></td>
                      <td>
                        <div class="progress" style="height: 3px;">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 56%;"> <span class="sr-only">40% Complete</span> </div>
                        </div>
                      </td>
                      <td>Sept 16, 2019</td>
                      <td class="text-success">Available</td>
                    </tr>
                  </tbody>
                </table> -->



              </div>
              <!-- Modal: book appointment -->
              <!-- <button class="btn btn-primary px-4 text-uppercase" data-bs-toggle="modal" data-bs-target="#book_appointment" type="button">book appointment</button> -->
              <div class="modal fade" id="book_appointment" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Appointment Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="d-flex justify-content-between mb-3">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="checkbox" required="" data-parsley-errors-container="#error-checkbox" data-parsley-multiple="checkbox">
                          <label class="form-check-label" for="flexCheckDefault">
                            <strong>Brian Swader</strong>
                            <span class="text-muted d-flex small">Jan 12, 2021 11:30 AM</span>
                          </label>
                        </div>
                        <div>
                          <img class="avatar sm rounded-circle ms-1 lift" src="../assets/img/xs/avatar1.jpg" data-bs-toggle="tooltip" data-bs-placement="top" title="" alt="" data-original-title="Avatar Name">
                        </div>
                      </div>
                      <div class="d-flex justify-content-between mb-3">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="flexCheckDefault2" name="checkbox" required="" data-parsley-errors-container="#error-checkbox" data-parsley-multiple="checkbox">
                          <label class="form-check-label" for="flexCheckDefault2">
                            <strong>Frank Camly</strong>
                            <span class="text-muted d-flex small">Jan 12, 2021 2:45 PM</span>
                          </label>
                        </div>
                        <div>
                          <img class="avatar sm rounded-circle ms-1 lift" src="../assets/img/xs/avatar2.jpg" data-bs-toggle="tooltip" data-bs-placement="top" title="" alt="" data-original-title="Avatar Name">
                        </div>
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
    <!-- start: page footer -->




    <script>
$(document).ready(function() {
  <?php if($this->privilegeduser->hasPrivilege("exportUser") || $this->userprivileged->hasUserPrivilege("exportUser")){?>
        var table = $('#all_user').DataTable({
      //stateSave: true,
      dom: 'Bfrtip',
            buttons: [{
            extend : 'csv',
            text : 'Export to CSV',
            exportOptions: {
                    columns: [ 1, 2, 3, 5, 6]
                }
            }]
      });
  <?php }else{ ?>
    var table = $('#all_user').DataTable({});
  <?php } ?> 
      // Restore state
    var state = table.state.loaded();
    if(state){
        table.columns().eq( 0 ).each( function ( colIdx ) {
        var colSearch = state.columns[colIdx].search;
        if(colSearch.search){
          $('#column'+colIdx+'_search').val(colSearch.search);
        }
        });
        table.draw();
    }    
      
    $('#column2_search').on( 'keyup', function () {
    table.columns(2).search(this.value).draw();
  });
    
  $('#column3_search').on( 'keyup', function () {
    table.columns(3).search(this.value).draw();
  });
    
  $('#column4_search').on( 'keyup', function () {
    table.columns(4).search(this.value).draw();
  });
  
  $('#column5_search').on( 'keyup', function () {
    table.columns(5).search(this.value).draw();
  });
  
  $('#column6_search').on( 'keyup', function () {
    table.columns(6).search(this.value).draw();
  });
  $('#column6_search').on( 'keyup', function () {
    table.columns(6).search(this.value).draw();
  });

  $(document).on('click','#myDRDataBtn',function(){        
        var dr_id = $(this).attr('data-id');
        if(dr_id !=''){
            $.ajax({
              url:URL+'getAllDRRemark',
              method:'post',
              data:{dr_id:dr_id,'csrf_test_name':csrf_token},
              dataType:'html',
              success:function(res){
                $('#drRemark').html(res);            
              }
            });
        }      
    });

    $(document).on('click','#doctorCSV', function(){
      //$('#doctorCSVDATA').submit();
    });
    
    $(document).on('click','.incorrecttry', function(){
      $user_id= $(this).attr('data-userid');
      $data_try= $(this).attr('data-try');
      if($user_id!=""){
        $.ajax({
              url:URL+'user/user/lockUnlockAccount',
              method:'post',
              data:{'user_id':$user_id,'data_try':$data_try,'csrf_test_name':csrf_token},
              dataType:'html',
              success:function(res){
                $("#"+$user_id).html(res);            
              }
            });
        }
    });

});
</script>