 
<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="#" aria-current="page">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php if($feedbackid !=''){ echo "Edit"; }else{ echo "Add"; } ?> Feedback</li>
        </ol>
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
                  <!--<div class="card-header">
                      <h6 class="card-title">Add Feedback</h6>
                    </div>-->
              </div>
          </div>
            <div class="row">
              <div class="col-lg-12">
              <?php 
                   
            if($feedbackid !=''){ $action_url="update_feedbackData"; }else{ $action_url="add_feedbackData";}?>
            
            <input type="hidden" class="form-control form-control-lg required-entry" id="actionURL" value="<?=$action_url?>">

                <form id="feedback_validate" method="post"> 
                
                <input type="hidden" class="form-control form-control-lg required-entry" id="feedbackID" name='feedbackID' value="<?=$feedbackid?>">
                
                    <div class="row">
                        <div class="col-sm-7 mb-4">
                          <label class="form-label">Subject<span
                              class="required_asterisk">*</span></label> 
                            
                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if (isset($feedbackDala->subject))  echo $feedbackDala->subject; ?>" placeholder="Subject" name="subject" id="subject" required>
                            
                            <span id="subjecterr"></span>
                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7 mb-4">
                            <label class="form-label">Description<span class="required_asterisk">*</span></label>
                            <textarea class="form-control form-control-lg required-entry"
                            placeholder="Description" rows="5" cols="10" name="description" id="description" required><?php if (isset($feedbackDala->description))  echo $feedbackDala->description ?></textarea>
                        
                            <span id="descriptionerr"></span>
                        </div>
                        <div class="col-sm-12">
                            <a href="<?=base_url('doctors-panel/all-feedback')?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                            <?php  if(!$feedbackid){ $submit_val="Send Feedback"; }else{ $submit_val="Update Feedback";}?>
                            <button type="button"  name="submit_feedback" id="saveUser" class="btn btn-primary"><?=$submit_val?></button>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .row end -->
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

<script src="<?php echo base_url() ?>bassets/js/theme.js"></script>

<script>
    var URLs = "<?=base_url('doctors/all-feedback')?>";

    $(document).ready(function(){
        
    	$(document).on('change keyup','#subject',function(){
    		$('#subjecterr').html('');
    	});
    	
    	$(document).on('keyup','#description',function(){
    		$('#descriptionerr').html('');
    	});
    	
    	
    	function Role_validate(){

    		var subject = $('#subject').val();
    		var description = $('#description').val();

    		if(subject == ''){
    			$('#subjecterr').html("<font style='color:red'><b>Enter Subject</b></font>");
    			return false;
    		}

    		if(description == ''){
    			$('#descriptionerr').html("<font style='color:red'><b>Enter Description</b></font>");
    			return false;
    		}
    		return true;
    	}

        $('#saveUser').click(function(){

            var actionURL = $('#actionURL').val();
            
            if(actionURL == 'add_feedbackData'){
                var URLss = '<?=base_url('Feedback/')?>'+actionURL;
            }else{
                var URLss = '<?=base_url('Feedback/')?>'+actionURL;
            }
            
    		var formdata = $("#feedback_validate input, select, textarea").serialize();
    		var valid = Role_validate();
    		if(valid == true){
    			$.ajax({
    				url:URLss,
    				method:'post',
    				data:{formdata:formdata},
    				dataType:'json',
    				success:function(res){
    					console.log(res);
    					if(res['success'] == "1"){
    						$("#editresmessage").html("<br><font style='color:green'>"+res['msg']+"</font>");
    						$('#doneeditstaticBackdrop').modal('show');
    						$('.editclosedBTN').click(function(){
    						   $('#doneeditstaticBackdrop').modal('hide'); 
    						   $("#editresmessage").html(""); 
                               window.location.href = URLs;
    					    }); 
    					}else{	
    						$(".se-pre-con").fadeOut("slow");
    						$("#editresmessage").html("<br><font style='color:red'>"+res['msg']+"</font>");
    					    $('#doneeditstaticBackdrop').modal('show');
    					    
    					    $('.editclosedBTN').click(function(){
    					       $('#doneeditstaticBackdrop').modal('hide'); 
    						   $("#editresmessage").html("");

    					    });     
    					    
    						return false;
    					}
			        },
		       });
	       }
        });
    });
</script>


