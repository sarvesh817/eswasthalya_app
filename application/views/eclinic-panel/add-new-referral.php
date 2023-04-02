<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="dashboard.html" aria-current="page">Home</a></li>
          <li class="breadcrumb-item">Referral</li>
          <li class="breadcrumb-item active" aria-current="page">Add New Referral</li>
        </ol>
      </div>
    </div> <!-- .row end -->
    <div class="row align-items-center">
      <div class="col-auto">
        <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, Dr. <?php echo $this->session->userdata('name'); ?> !</h1>
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
                  <h6 class="card-title">Add New Referral</h6>
                  
                  <span id="msgdiplay"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <form action="<?php echo base_url(); ?>" name="add_referral" id="referral_validate" enctype="multipart/form-data" method="post">
                    
                    <input type="hidden" class="form-control form-control-lg" placeholder="refferal_type_id" name="refferal_type_id" value="1">
                    
                  <div class="row">
                    <div class="col-sm-4 mb-4 text-left">
                      <label class="form-label">Enter PID<span class="required_asterisk">*</span></label>
                      <input type="search" class="form-control form-control-lg required-entry" placeholder="PID" name="pid">
                      <div id="pid_err"></div>
                    </div>
                    <div class="col-sm-4 mb-4 text-left">
                      <label class="form-label">Purpose<span class="required_asterisk">*</span></label>
                        <select class="form-control form-control-lg" name="purpose" id="purpose">
                          <option value="">- Select Purpose -</option>
                          <option value="ABC">ABC</option>
                          <option value="XYZ">XYZ</option>
                          <option value="XYZ">XYZ</option>
                          <option value="XYZ">XYZ</option>
                          <option value="XYZ">XYZ</option>
                          <option value="Other">Other</option>
                        </select>
                        <div id="purpose_err"></div>
                    </div>
                    <div class="col-sm-4 mb-4 text-left">
                      <label class="form-label">Budget<span class="required_asterisk">*</span></label>
                        <select class="form-control form-control-lg" name="budget" id="budget">
                          <option value="">- Select Budget -</option>
                          <option value="Low">Low</option>
                          <option value="Medium">Medium</option>
                          <option value="High">High</option>
                        </select>
                        <div id="budget_err"></div>
                    </div>
                    <div class="col-sm-4 mb-4 text-left">
                      <label class="form-label">Hospital<span class="required_asterisk">*</span></label>
                      <select class="form-control form-control-lg" name="hospital" id="hospital">
                        <option value="">- Select Hospital -</option>
                        <option value="Kailash Hospital">Kailash Hospital</option>
                        <option value="Max Hospital">Max Hospital</option>
                        <option value="AIIMS">AIIMS</option>
                        <option value="Safdarganj Hospital">Safdarganj Hospital</option>
                      </select>
                      <div id="hospital_err"></div>
                    </div>
                    <div class="col-sm-4 mb-4 text-left">
                      <label class="form-label">Upload Document<span class="required_asterisk">*</span></label>
                      <input type="file" class="form-control required-entry" name="document" id="document">
                        <span class="recommend">Upload Document (in pdf)</span>
                    </div>
                    
                    <div class="col-lg-12">
                      <div class="btn-left">
                        <a href="<?php echo base_url(); ?>eclinic/referral" class="btn btn-dark">Back</a>
                        <button type="button" id="saveReferal" name="saveReferal" class="btn btn-primary">Submit</button>
                        <!-- <a href="" class="btn btn-primary">Submit</a>
                        <input type="submit" class="btn btn-primary"> -->
                      </div>
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

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.form.js"></script>
<script>
    var URL = "<?=base_url('EclinicPanel/savenewreferralData')?>";
     
     var redURL = "<?=base_url('eclinic/referral')?>";


    $(document).ready(function(){
        
    	$(document).on('change keyup','#pid',function(){
    		$('#pid_err').html('');
    	});
    	
    	$(document).on('keyup','#purpose',function(){
    		$('#purpose_err').html('');
    	});
    	
    	$(document).on('keyup','#budget',function(){
    		$('#budget_err').html('');
    	});
    	
    	$(document).on('keyup','#hospital',function(){
    		$('#hospital_err').html('');
    	});


       
    });
    
</script>
    
    
<script>
    $(document).on('click','#saveReferal',function(){
            var pid = $('#pid').val();
    		var purpose = $('#purpose').val();
    		var budget = $('#budget').val();
    		var hospital = $('#hospital').val();
    
    		if(pid == ''){
    			$('#pid_err').html("<font style='color:red'><b>Required Field</b></font>");
    			valid = "false";
    		}
    
    		if(purpose == ''){
    			$('#purpose_err').html("<font style='color:red'><b>Required Field</b></font>");
    			valid = "false";
    		}
    		
    		if(budget == ''){
    			$('#budget_err').html("<font style='color:red'><b>Required Field</b></font>");
    			valid = "false";
    		}
    		
    		if(hospital == ''){
    			$('#hospital_err').html("<font style='color:red; font-size:10px;'><b>Required Field</b></font>");
    			valid = "false";
    		}
    
    		valid = "true";
    		
        if(valid == "true"){
			$("#referral_validate").ajaxSubmit({
				url: URL,
				type: 'post',
				cache: false,
				clearForm: false,
				dataType:'json',
				success: function(res) {
					if(res['status'] == '1'){
	            	   $("#msgdiplay").html("<br><font style='color:green; font-size:16px'>"+res['msg']+"</font>");
						setTimeout(function(){
							$(".se-pre-con").fadeOut("slow");
						    $("#msgdiplay").fadeOut("slow");
						    $('#referral_validate')[0].reset();
						    window.location.href = redURL;
						},3000);

	                } else{
						$("#msgdiplay").html("<br><font style='color:red; font-size:16px'>"+res['msg']+"</font>");
						setTimeout(function(){
							$(".se-pre-con").fadeOut("slow");
						    $("#msgdiplay").fadeOut("slow");
						},3000);
						return false;
	                     
	                }					
				}
			});
        }
	});
</script>








