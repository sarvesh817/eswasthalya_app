<!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="#">Home</a></li>
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
                      <th>S.No</th>
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
                     
                    if(isset($patient_list) && $patient_list !='')
                    {
                        $i=1;
                        foreach($patient_list as $pl)
                        { 

                    ?>   
                  <tr>
                      <td><?=$i; ?></td>
                      <td class="btnSelect" style="color:blue; text-decoration:underline; cursor: pointer;" date-id="<?php echo $userCode = "PID".str_pad($pl['id'], 4, "0", STR_PAD_LEFT); ?>"><?php echo $userCode = "PID".str_pad($pl['id'], 4, "0", STR_PAD_LEFT); ?></td>
                      <!--<td style="display:none!important;"><?php echo $c_id = str_replace(array('PID0000','PID000','PID00','PID0','PID'), '', $userCode); ?></td>-->
                      <td>
                        <div class="d-flex align-items-center">
                            <?php if(isset($pl['profile_photo']) && $pl['profile_photo'] !=''){ ?>
                            <img src="<?php echo base_url() ?>img/eclinic_upload/<?php echo $pl['profile_photo'];?>" class="avatar table-avatar rounded-circle me-3" alt="">
                            <?php } ?>
                            <div>
                              <div class="fw-bold"><?php if(isset($pl['doctor_id']) && $pl['doctor_id'] !=''){ echo $pl['doctor_id']; } ?></div>
                              <span class="small text-muted"><?php if(isset($pl['mobile']) && $pl['mobile'] !=''){ echo $pl['mobile']; } ?></span>          
                            </div>
                          </div>
                      </td>
                      <td><?php if(isset($pl['age']) && $pl['age'] !=''){ echo $pl['age']; } ?><?php if(isset($pl['gender']) && $pl['gender'] !=''){ echo '/ '.$pl['gender']; } ?></td>
                      <td><?php if(isset($pl['email']) && $pl['email'] !=''){ echo $pl['email']; } ?></td>
                      <td><?php if(isset($pl['aadhar_no']) && $pl['aadhar_no'] !=''){ echo $pl['aadhar_no']; } ?></td>
                      <td><?php if(isset($pl['address']) && $pl['address'] !=''){ echo $pl['address']; } ?></td>
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
    
    <div class="modal fade" id="otpstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter Secret PIN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 form_validate" id="form_validate" method="post">
          
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" name="pin1" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" name="pin2" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" name="pin3" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" name="pin4" placeholder="-" maxlength="1">
            </div>
          </div>
          
          <input type="hidden" class="form-control form-control-lg text-center" id="pid" name="pid">
         
        </form>
        <span id="resmessage"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-warning" id="proceedBTn" >Proceed</button>

      </div>
    </div>
  </div>
</div>

<script>
        // Delete Section stat below

        var urls = "<?=base_url('eclinic/single-patient/')?>";
        
        $(document).ready(function(){
	        $('.btnSelect').click(function(){
	            $('#otpstaticBackdrop').modal('show');
	            var currentRow=$(this).closest("tr");
    		    var id=currentRow.find("td:eq(1)").html();
    		    $("#pid").val(id);
    		    
	            $('#proceedBTn').click(function(){
	                var formdata = $("#form_validate input, select").serialize();
	                $.ajax({
        				url:'<?=base_url('EclinicPanel/PatientSecVerify')?>',
        				method:'post',
        				data:{formdata:formdata},
        				dataType:'json',
        				success:function(res){
        					console.log(res);
        					if(res['success'] == "1"){
        						$("#msgheader1").html("<font style='color:green'><b>Success</b></font>");
        						$("#resmessage").html("<br><font style='color:green'>"+res['msg']+"</font>");
        						setTimeout(function(){
        							 $('#otpstaticBackdrop').modal('hide'); 
        						     $("#resmessage").html("");
        						    $('#form_validate')[0].reset();
        						    window.location.href = urls+res['pid'];
        						},2000);
 
        					}else{	
        						$(".se-pre-con").fadeOut("slow");
        						$("#msgheader1").html("<font style='color:red'><b>Fail</b></font>");
        						$("#resmessage").html("<br><font style='color:red'>"+res['msg']+"</font>");
        					    $('#donedeletestaticBackdrop').modal('show');
        					    setTimeout(function(){
        							 $('#otpstaticBackdrop').modal('show'); 
        						     $("#resmessage").html("");
        						     $('#pin1').val();
        						      $('#pin2').val();
        						       $('#pin3').val();
        						        $('#pin4').val();
        						    
        						},2000);    
        						return false;
        					}
				        },
			       });
	                
	             //window.location.href = URL2;
    	        });

	        });
        });

    </script>
    