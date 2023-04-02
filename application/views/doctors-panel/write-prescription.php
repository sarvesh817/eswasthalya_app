<?php $getData = $this->db->where('pid',$patient_details->id)->get('tbl_prescription')->row(); //echo "<pre>"; print_r($getData);  exit;?>
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
    <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
            <div class="col">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a class="text-secondary" href="dashboard.html" aria-current="page">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Write Prescription</li>
                </ol>
            </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, Dr. <?php echo $this->session->userdata('name') ?> !</h1>
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
                    <div class="card-header">
                        <h6 class="card-title">Write Prescription</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="#" name="add_prescription" id="prescriptionForm" method="post">
                                    <input type="hidden" name="pid" id="pid" value="<?php if(isset($patient_details->id) && $patient_details->id !=''){ echo $patient_details->id; } ?>">
                                    <input type="hidden" name="appid" id="appid" value="<?php if(isset($appointment_data['id']) && $appointment_data['id'] !=''){ echo $appointment_data['id']; } ?>">
                                    <h6 class="card-title mb-4">Clinical Notes</h6>
                                    <div class="row">
                                        <div class="col-sm-12 mb-4">
                                            <label class="form-label">Add Clinical Notes<span class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->add_clinical_notes) && $getData->add_clinical_notes !=''){ echo $getData->add_clinical_notes; } ?>" name="add_clinical_notes" id="add_clinical_notes" placeholder="Add Clinical Notes">
                                            <span id="add_clinical_notes_Err"></span>
                                        </div>
                                    </div>
                                    <h6 class="card-title mb-4">Differential Diagnose</h6>
                                    <div class="row">
                                        <div class="col-sm-12 mb-4">
                                            <label class="form-label">Add Differential Diagnose<span class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->add_clinical_notes) && $getData->add_clinical_notes !=''){ echo $getData->add_clinical_notes; } ?>" name="differential_diagnose" id="differential_diagnose" placeholder="Add Differential Diagnose">
                                            <span id="differential_diagnose_Err"></span>
                                        </div>
                                    </div>
                                    <h6 class="card-title mb-4">Rx</h6>
                                    <div class="row">
                                        <div class="col-sm-4 mb-4">
                                            <label class="form-label">Medicine<span class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->medicine) && $getData->medicine !=''){ echo $getData->medicine; } ?>" name="medicine" id="medicine" placeholder="Medicine">
                                            <span id="medicine_Err"></span>
                                        </div>
                                        <div class="col-sm-4 mb-4">
                                            <label class="form-label">Strength<span class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->strength) && $getData->strength !=''){ echo $getData->strength; } ?>" name="strength" id="strength" placeholder="Strength">
                                            <span id="strength_Err"></span>
                                        </div>
                                        <div class="col-sm-4 mb-4">
                                            <label class="form-label">Dose<span class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->dose) && $getData->dose !=''){ echo $getData->dose; } ?>" name="dose" id="dose" placeholder="Dose">
                                            <span id="dose_Err"></span>
                                        </div>
                                        <div class="col-sm-4 mb-4">
                                            <label class="form-label">Frequency<span class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->frequency) && $getData->frequency !=''){ echo $getData->frequency; } ?>" name="frequency" id="frequency" placeholder="Frequency">
                                            <span id="frequency_Err"></span>
                                        </div>
                                        <div class="col-sm-4 mb-4">
                                            <label class="form-label">Duration<span Class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->duration) && $getData->duration !=''){ echo $getData->duration; } ?>" name="duration" id="duration" placeholder="Duration">
                                            <span id="duration_Err"></span>
                                        </div>
                                        <div class="col-sm-4 mb-4">
                                            <label class="form-label">Instruction<span class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->instruction) && $getData->instruction !=''){ echo $getData->instruction; } ?>" name="instruction" id="instruction" placeholder="Instruction">
                                            <span id="instruction_Err"></span>
                                        </div>
                                    </div>
                                    <h6 class="card-title mb-4">Advice</h6>
                                    <div class="row">
                                        <div class="col-sm-8 mb-4">
                                            <label class="form-label">Advice<span class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->advice) && $getData->advice !=''){ echo $getData->advice; } ?>" name="advice" id="advice" placeholder="Advice">
                                            <span id="advice_Err"></span>
                                         </div>
                                    </div>
                                    <h6 class="card-title mb-4">Lab Investigation Required</h6>
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 mb-4">
                                            <label class="form-label">Lab Investigation<span class="required_asterisk">*</span></label>
                                            <input type="text" class="form-control form-control-lg required-entry" value="<?php if(isset($getData->lab_investigation) && $getData->lab_investigation !=''){ echo $getData->lab_investigation; } ?>" name="lab_investigation" id="lab_investigation" placeholder="Lab Investigation">
                                            <span id="lab_investigation_Err"></span>
                                        </div>
                                        <div class="col-sm-6 mb-4">
                                            <label class="form-label mb-0 mt-4">Follow Up 2 Days<span class="required_asterisk">*</span></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?php echo base_url(); ?>doctors/dashboard" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                                            <!--<?php  if(!$prescriptionid){ $submit_val="Add Prescription"; }else{ $submit_val="Update Prescription";}?>
                                            <button type="button" name="add_prescription" id="saveData" class="btn btn-primary"><?=$submit_val?></button>-->
                                            <button type="button" name="add_prescription" id="saveData" class="btn btn-primary">Add Prescription</button>
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

<script>
    var URL = "<?=base_url('DoctorsPanel/savePrescriptionData')?>";
    var URLss = "<?=base_url('DoctorsPanel/dashboard')?>";
    
    $(document).ready(function(){
            
    	$(document).on('change keyup','#add_clinical_notes',function(){
    		$('#add_clinical_notes_Err').html('');
    	});
    	
    	$(document).on('keyup','#differential_diagnose',function(){
    		$('#differential_diagnose_Err').html('');
    	});
    	
    	$(document).on('keyup','#medicine',function(){
    		$('#medicine_Err').html('');
    	});
    	
    	$(document).on('keyup','#strength',function(){
    		$('#strength_Err').html('');
    	});
    	
    	$(document).on('keyup','#dose',function(){
    		$('#dose_Err').html('');
    	});
    	
    	$(document).on('keyup','#frequency',function(){
    		$('#frequency_Err').html('');
    	});
    	
    	$(document).on('keyup','#duration',function(){
    		$('#duration_Err').html('');
    	});
    	
    	$(document).on('keyup','#instruction',function(){
    		$('#instruction_Err').html('');
    	});
    	
    	$(document).on('keyup','#advice',function(){
    		$('#advice_Err').html('');
    	});
    	
    	$(document).on('keyup','#lab_investigation',function(){
    		$('#lab_investigation_Err').html('');
    	});
    	
    	function Role_validate(){

    		var add_clinical_notes = $('#add_clinical_notes').val();
    		var differential_diagnose = $('#differential_diagnose').val();
    		var medicine = $('#medicine').val();
    		var strength = $('#strength').val();
    		var dose = $('#dose').val();
    		var frequency = $('#frequency').val();
    		var duration = $('#duration').val();
    		var instruction = $('#instruction').val();
    		var advice = $('#advice').val();
    		var lab_investigation = $('#lab_investigation').val();
    		
    		if(add_clinical_notes == ''){
    			$('#add_clinical_notes_Err').html("<font style='color:red'><b>Enter Clinical Notes</b></font>");
    			return false;
    		}

    		if(differential_diagnose == ''){
    			$('#differential_diagnose_Err').html("<font style='color:red'><b>Enter differential diagnose</b></font>");
    			return false;
    		}
    		
    		if(medicine == ''){
    			$('#medicine_Err').html("<font style='color:red'><b>Enter Medicine</b></font>");
    			return false;
    		}
    		
    		
    		if(strength == ''){
    			$('#strength_Err').html("<font style='color:red'><b>Enter Strength</b></font>");
    			return false;
    		}
    		
    		if(dose == ''){
    			$('#dose_Err').html("<font style='color:red'><b>Enter Dose</b></font>");
    			return false;
    		}
    		
    		if(frequency == ''){
    			$('#frequency_Err').html("<font style='color:red'><b>Enter Frequencye</b></font>");
    			return false;
    		}
    		
    		if(duration == ''){
    			$('#duration_Err').html("<font style='color:red'><b>Enter Duration</b></font>");
    			return false;
    		}
    		
    		if(instruction == ''){
    			$('#instruction_Err').html("<font style='color:red'><b>Enter Instruction</b></font>");
    			return false;
    		}
    		
    		if(advice == ''){
    			$('#advice_Err').html("<font style='color:red'><b>Enter Advice</b></font>");
    			return false;
    		}
    		
    		if(lab_investigation == ''){
    			$('#lab_investigation_Err').html("<font style='color:red'><b>Enter Lab Investigation</b></font>");
    			return false;
    		}

    		return true;
    	}
	        
        $(document).on('click','#saveData',function(){
            //alert();
            var valid = Role_validate();
    		if(valid == true){
			$("#prescriptionForm").ajaxSubmit({
				url: URL,
				type: 'post',
				cache: false,
				clearForm: false,
				dataType:'json',
				success: function(res) {
					if(res['status'] == '1'){
	            	   //$("#msgdiplay").html("<br><font style='color:green; font-size:16px'>"+res['msg']+"</font>");
						//setTimeout(function(){
						   
						    $("#editresmessage").html("<br><font style='color:green'>"+res['msg']+"</font>");
    						$('#doneeditstaticBackdrop').modal('show');
    						$('#prescriptionForm')[0].reset();
    						$('.editclosedBTN').click(function(){
    						   $('#doneeditstaticBackdrop').modal('hide'); 
    						   $("#editresmessage").html(""); 
                               window.location.href = URLss;
                               //window.location.href = URLss+res['pid']
    					    }); 

						//},3000);

	                } else{
						$("#msgdiplay").html("<br><font style='color:red; font-size:16px'>"+res['msg']+"</font>");
						setTimeout(function(){
							$(".se-pre-con").fadeOut("slow");
						    $("#msgdiplay").fadeOut("slow");
						     $("#account").addClass("active");
						     $("#personal").addClass("active");
						    $("#confirm").removeClass("active");
						    $('#a1').css('display', 'block' , 'opacity','1');
						    $('#a3').css('display', 'none' , 'position','relative' , 'opacity','0');
						     
						},3000);
						return false;
	                }					
				}
			});
			
    		}
	    });	
    });
</script>