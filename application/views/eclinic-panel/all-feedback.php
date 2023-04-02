 
    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="#" aria-current="page">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Feedback</li>
            </ol>
          </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
          <div class="col-auto">
            <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, Dr. <?php echo $this->session->userdata('name'); ?></h1>
            <small class="text-muted">You have 12 new messages and 7 new notifications.</small>
          </div>
          <div class="col d-flex justify-content-lg-end mt-2 mt-md-0">
            <div class="p-2 me-md-3">
              <div><span class="h6 mb-0">8.18K</span> <small class="text-secondary"><i class="fa fa-angle-up"></i> 1.3%</small></div>
              <small class="text-muted text-uppercase">Income</small>
            </div>
            <div class="p-2 me-md-3">
              <div><span class="h6 mb-0">1.11K</span> <small class="text-secondary"><i class="fa fa-angle-up"></i> 4.1%</small></div>
              <small class="text-muted text-uppercase">Expense</small>
            </div>
            <div class="p-2 pe-lg-0">
              <div><span class="h6 mb-0">3.66K</span> <small class="text-danger"><i class="fa fa-angle-down"></i> 7.5%</small></div>
              <small class="text-muted text-uppercase">Revenue</small>
            </div>
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
                <div class="row">
                  <div class="col-sm-6">
                      <div class="card-header">
                          <h6 class="card-title m-0">All Feedback</h6>
                        </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="btn-right">
                          <a href="<?=base_url('eclinic/add-feedback')?>" class="btn btn-primary">+ Add Feedback</a>
                      </div>
                  </div>
              </div>
                <table id="feedbackTable" class="table card-table table-hover align-middle mb-0 feedback_table">
                  <thead>
                    <tr>
                      <th>S. No</th>
                      <th>Subject</th>
                      <th>Description</th>
                      <th>Action</th>   
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  
                  if(isset($feedback_list) && $feedback_list !=''){
                  $i=1;
                 foreach($feedback_list as $wl) { ?>
                    <tr>
                    <td><?php echo $i++;?></td>
                      <td><?php echo $wl['subject'];?></td>
                      <td><?php echo $wl['description'];?></td>       
                      <td>
                        <a href="<?=base_url('eclinic/add-feedback')?>?id=<?php echo $wl['id'] ?>" class="btn btn-secondary modal-btn" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pen"></i></a>
                        <a href="#" class="btn btn-danger modal-btn deleteBTn" data-bs-toggle="tooltip" title="Delete" data-id='<?php echo $wl['id'] ?>'><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                    <?php } }?>           
                  </tbody>   
                </table>
              </div>
            </div>
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    
    <!-- ::::::::::::::::::::::::::::::::: Begin Delete ::::::::::::::::::::::::::::::::: -->
<!-- 1. If Delete then please add also deleted confirmed modal -->
    <div class="modal fade" id="deletestaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
              <button type="submit" class="btn btn-warning" id="deleteyesBTN" >Yes, Delete it!</button>
              <!--<button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#donedeletestaticBackdrop">Yes, Delete it!</button>-->
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
                <h4 class="modal-title w-100" id="resmessage"></h4>	
                <button type="button" class="btn-close close closedBTN" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary closedBTN" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
  <!-- ::::::::::::::::::::::::::::::::: End Delete ::::::::::::::::::::::::::::::::: -->
  
  
    <div class="modal fade" id="editstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="bi bi-x"></i>
                </div>						
                <h4 class="modal-title w-100">Are you sure ?</h4>	
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Do you really want to edit these records?.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-warning" id="yesBTN" >Yes, Edit it!</button>
            </div>
          </div>
        </div>
    </div>
    
    
     <div class="modal fade" id="doneeditstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box-confirmed text-success">
                    <i class="bi bi-check"></i>
                </div>						
                <h4 class="modal-title w-100" id="editresmessage"></h4>	
                <button type="button" class="btn-close close editclosedBTN" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary editclosedBTN" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    
    
    <script>
        // Delete Section stat below
        $(document).ready(function(){
	        $('.deleteBTn').click(function(){
	            $('#deletestaticBackdrop').modal('show');
	            var id = $(this).data('id');
	            $('#deleteyesBTN').click(function(){
	                $('#deletestaticBackdrop').modal('hide');
	                $.ajax({
        				url:'<?=base_url('EclinicFeedback/delete_feedback')?>',
        				method:'post',
        				data:{id:id},
        				dataType:'json',
        				success:function(res){
        					console.log(res);
        					if(res['success'] == "1"){
        						$("#msgheader1").html("<font style='color:green'><b>Success</b></font>");
        						$("#resmessage").html("<br><font style='color:green'>"+res['msg']+"</font>");
        						$('#donedeletestaticBackdrop').modal('show');
        						$('.closedBTN').click(function(){
        						   $('#donedeletestaticBackdrop').modal('hide'); 
        						   $("#resmessage").html(""); 
                                   window.location.reload();
        					    }); 
        					}else{	
        						$(".se-pre-con").fadeOut("slow");
        						$("#msgheader1").html("<font style='color:red'><b>Fail</b></font>");
        						$("#resmessage").html("<br><font style='color:red'>"+res['msg']+"</font>");
        					    $('#donedeletestaticBackdrop').modal('show');
        					    $('.closedBTN').click(function(){
        					       $('#donedeletestaticBackdrop').modal('hide'); 
        						   $("#resmessage").html("");
        						   window.location.reload();
        					    });     
        						return false;
        					}
				        },
			       });
	                
	             //window.location.href = URL2;
    	        });

	        });
        });
        
        

    </script>
   