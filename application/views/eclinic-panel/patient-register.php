<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="dashboard.html" aria-current="page">Home</a></li> 
          <li class="breadcrumb-item active" aria-current="page">New Patient Registration</li>
        </ol>
      </div>
    </div> <!-- .row end -->
    <div class="row align-items-center">
      <div class="col-auto">
        <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, CL- (<?php echo $this->session->userdata('name'); ?>)!</h1>
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
            <div class="row">
              <div class="col-sm-6">
                  <div class="card-header">
                      <h6 class="card-title">New Patient Registration</h6>
                    </div>
              </div>
          </div>
            <!-- Wizard Form -->
            <div class="row">
                <div class="col-md-12 mx-0">
                    <form id="msform" method="post"  enctype="multipart/form-data">       
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="account"><strong>Account</strong></li>
                            <li id="personal" class="" ><strong>Personal</strong></li>  
                            <li id="confirm" class="" ><strong>Finish</strong></li>
                        </ul>  
                        <!-- fieldsets -->
                        <fieldset  id="a1">
                            <div class="form-card">
                                <!-- <h2 class="fs-title">Account Information</h2> -->
                                <div class="row">
                                  <div class="col-sm-4 mb-4 text-left">
                                    <label class="form-label">Upload Profile<span class="required_asterisk">*</span></label>   
                                    <input type="file" class="form-control required-entry" name="profile_photo" id="profile_photo"> 
                                    <span id="profile_photo_Err"></span>
                                  </div>
                                  
                                  <div class="col-sm-4 mb-4 text-left">
                                    <label class="form-label">Fullname<span class="required_asterisk">*</span></label> 
                                    <input type="text" class="form-control form-control-lg required-entry" placeholder="Fullname" name="full_name" id="full_name">
                                    <span id="full_name_Err"></span>
                                  </div>
                                  
                                  <div class="col-sm-4 mb-4 text-left">
                                    <label class="form-label">Mobile Number<span class="required_asterisk">*</span></label>
                                    <input type="text" class="form-control form-control-lg required-entry" placeholder="Mobile Number" name="mobile" id="mobile" maxlength="10" pattern="[0-9]+">
                                    <span id="mobile_Err"></span>
                                  </div>
                                  
                                  <div class="col-sm-4 mb-4 text-left">
                                    <label class="form-label">Email<span class="required_asterisk">*</span></label>
                                    <input type="email" class="form-control form-control-lg required-entry" placeholder="Email" name="email" id="email">
                                    <span id="email_Err"></span>
                                  </div>
                                  
                                  <div class="col-sm-4 mb-4 text-left">
                                    <label class="form-label">Aadhar Number<span class="required_asterisk">*</span></label>
                                    <input type="text" class="form-control form-control-lg required-entry" placeholder="Aadhar Number" name="aadhar_no" id="aadhar_no" maxlength="12">
                                    <span id="aadhar_Err"></span>
                                  </div>
                                  
                                  <div class="col-sm-4 mb-4 text-left">
                                    <label class="form-label">Secret PIN<span  class="required_asterisk">*</span></label>
                                    <input type="password" class="form-control form-control-lg required-entry" placeholder="Password" name="secret_pin" id="secret_pin" maxlength="4">
                                    <span id="secret_pin_Err"></span>
                                  </div>
                                  
                                  <div class="col-sm-4 mb-4 text-left">
                                    <label class="form-label">Confirm Secret PIN<span class="required_asterisk">*</span></label>
                                    <input type="password" class="form-control form-control-lg required-entry" placeholder="Confirm Password" name="confirm_secret_pin" id="confirm_secret_pin" maxlength="4">
                                    <span id="confirm_secret_pin_Err"></span>
                                  </div>
                                  
                                </div>
                            </div>
                            
                            <input type="button" name="next" id="nextbtn" class="action-button" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop" value="Next Step"/>
                            
                        </fieldset>
                        <fieldset id="a2">
                          <div class="form-card">
                            <!-- <h2 class="fs-title">Account Information</h2> -->
                            <div class="row">
                              <div class="col-sm-2 mb-4 text-left">
                                <label class="form-label">Age<span class="required_asterisk">*</span></label>
                                <input type="number" class="form-control form-control-lg required-entry" placeholder="Age" name="age" id="age">
                                <span id="age_Err"></span>
                              </div>
                              <div class="col-sm-3 mb-4 text-left">
                                <label class="form-label">Sex<span class="required_asterisk">*</span></label>
                                <select class="form-control form-control-lg" name="gender" id="gender">
                                  <option value="">- Sex -</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                  <option value="Other">Other</option>
                                </select>
                                <span id="gender_Err"></span>
                              </div>
                              <div class="col-sm-4 mb-4 text-left">
                                <label class="form-label">Relative's Name<span class="required_asterisk">*</span></label>
                                <input type="text" class="form-control form-control-lg required-entry" placeholder="Relative Name" name="relative_name" id="relative_name">
                                <span id="relative_name_Err"></span>
                              </div>
                              <div class="col-sm-3 mb-4 text-left">
                                <label class="form-label">Relation<span class="required_asterisk">*</span></label>
                                <select class="form-control form-control-lg" name="relation" id="relation">
                                  <option value="">- Relation -</option>
                                  <option value="Father">Father</option>
                                  <option value="Husband">Husband</option>
                                  <option value="Grand Father">Grand Father</option>
                                  <option value="Grand Mother">Grand Mother</option>
                                  <option value="Daughter">Daughter</option>
                                  <option value="Son">Son</option>
                                </select>
                                <span id="relation_Err"></span>
                              </div>
                              
                              <div class="col-sm-4 mb-4 text-left">
                                <label class="form-label">Emergency Contact Details<span class="required_asterisk">*</span></label>
                                <input type="text" class="form-control form-control-lg required-entry" placeholder="Emergency Contact Details" name="emergency_contact" id="emergency_contact">
                                <span id="emergency_contact_Err"></span>
                              </div>
                              
                              <div class="col-sm-4 mb-4 text-left">
                                <label class="form-label">Emergency Contact Person Name<span class="required_asterisk">*</span></label>
                                <input type="text" class="form-control form-control-lg required-entry" placeholder="Emergency Contact Person Name" name="emergency_person" id="emergency_person">
                                <span id="emergency_person_Err"></span>
                              </div>
                              
                              <div class="col-sm-4 mb-4 text-left">
                                <label class="form-label">Allergy<span class="required_asterisk">*</span></label>
                                <select class="form-control form-control-lg" name="allergy" id="allergy">
                                  <option value="">- Allergy -</option>
                                  <option value="YES">Yes</option>
                                  <option value="N/A">N/A</option>
                                </select>
                                <span id="allergy_Err"></span>
                              </div>
                              
                              <div class="col-sm-4 mb-4 text-left">
                                <label class="form-label">Marital Status<span class="required_asterisk">*</span></label>
                                    <select class="form-control form-control-lg"  name="marital_status" id="marital_status">
                                      <option value="">- Marital Status -</option>
                                      <option value="Single">Single</option>
                                      <option value="Married">Married</option>
                                    </select>
                                    <span id="marital_status_Err"></span>
                              </div>
                              
                              <div class="col-sm-4 mb-4 text-left">
                                <label class="form-label">Occupation<span class="required_asterisk">*</span></label>
                                <select class="form-control form-control-lg" id="occupation" name="occupation">
                                  <option value="">- Occupation -</option>
                                  <option value="Salaried">Salaried</option>
                                  <option value="Business">Business</option>
                                </select>
                                <span id="occupation_Err"></span>
                              </div>
                              
                              <div class="col-sm-4 mb-4 text-left">
                                <label class="form-label">Health Insurance<span class="required_asterisk">*</span></label>
                                <select class="form-control form-control-lg" name="health_insurance" id="health_insurance">
                                  <option value="">- Health Insurance -</option>
                                  <option value="Private">Private</option>
                                  <option value="Corporate ">Corporate </option>
                                  <option value="Govt Panel">Govt Panel </option>
                                  <option value="Ayushman">Ayushman</option>
                                  <option value="No">No</option>
                                </select>
                                <span id="health_insurance_Err"></span>
                              </div>
                              
                              <div class="col-sm-4 mb-4 text-left">
                                <label class="form-label">Address<span
                                    class="required_asterisk">*</span></label>
                                <textarea class="form-control form-control-lg required-entry" rows="5" placeholder="Address" name="address" id="address"></textarea>
                                <span id="address_Err"></span>
                              </div>
                            </div>
                        </div>
                            <input type="button" name="previous" id="previousbtn" class="previous action-button-previous" value="Previous"/>
                            <input type="button" name="next" id="savePatient" value="submit" class="action-button-previous"/>        
                        </fieldset>
                        
                        <fieldset id="a3">
                            <div class="form-card">
                                <h2 class="fs-title text-center text-success">Success !</h2>
                                <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-3">
                                        <img src="<?php echo base_url(); ?>bassets/img/patient-add-user.svg" class="fit-image">
                                    </div>
                                </div>
                                <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5>You Have Successfully Registered</h5>
                                        <a href="<?php echo base_url(); ?>eclinic/patient-list" class="btn btn-primary btn-lg mt-5">Go To Patient Dashboard</a>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- End -->
          </div>
        </div>
      </div>
    </div> <!-- .row end -->
  </div>
</div>

<!-- Enter OTP -->
<div class="modal fade" id="otpstaticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter OTP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="form-field-title">
            <h4 id="messageSec">.</h4>
            <input type="hidden" class="form-control form-control-lg text-center" id="otpid">
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" id="num1" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" id="num2" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" id="num3" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col">
            <div class="mb-2">
              <input type="text" class="form-control form-control-lg text-center" id="num4" placeholder="-" maxlength="1">
            </div>
          </div>
          <div class="col-12">
            <div class="notice-msg">
              <p id="msgdiplay"><strong></strong></p>
            
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary previous action-button-previous" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary"id="verifyBTN">Verify OTP</button>
      </div>
    </div>
  </div>
</div>
<!-- End -->

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.form.js"></script>
<script>
    var URL = "<?=base_url('Patient/savepatientData')?>";
     
     var redURL = "<?=base_url('eclinic/patient-list')?>";


    $(document).ready(function(){
        
    	$(document).on('change keyup','#profile_photo',function(){
    		$('#profile_photo_Err').html('');
    		
    	});
    	
    	$(document).on('keyup','#full_name',function(){
    		$('#full_name_Err').html('');
    	});
    	
    	$(document).on('keyup','#mobile',function(){
    		$('#mobile_Err').html('');
    	});
    	
    	$(document).on('keyup','#email',function(){
    		$('#email_Err').html('');
    	});
    	
    	$(document).on('keyup','#aadhar_no',function(){
    		$('#aadhar_Err').html('');
    	});
    	
    	$(document).on('keyup','#secret_pin',function(){
    		$('#secret_pin_Err').html('');
    	});
    	
    	$(document).on('keyup','#confirm_secret_pin',function(){
    		$('#confirm_secret_pin_Err').html('');
    	});

    	$(document).on('keyup','#age',function(){
    		$('#age_Err').html('');
    	});
    	
    	$(document).on('change keyup','#gender',function(){
    		$('#gender_Err').html('');
    	});
    	
    	$(document).on('keyup','#relative_name',function(){
    		$('#relative_name_Err').html('');
    	});
    	
    	$(document).on('change keyup','#relation',function(){
    		$('#relation_Err').html('');
    	});
    	
    	$(document).on('keyup','#emergency_contact',function(){
    		$('#emergency_contact_Err').html('');
    	});
    	
    	$(document).on('keyup','#emergency_person',function(){
    		$('#emergency_person_Err').html('');
    	});
    	
    	$(document).on('change keyup','#allergy',function(){
    		$('#allergy_pin_Err').html('');
    	});
    	
    	
    	$(document).on('change keyup','#marital_status',function(){
    		$('#marital_status_Err').html('');
    	});
    	
    	$(document).on('change keyup','#occupation',function(){
    		$('#occupation_Err').html('');
    	});
    	
    	$(document).on('change keyup','#health_insurance',function(){
    		$('#health_insurance_Err').html('');
    	});
    	
    	$(document).on('keyup','#address',function(){
    		$('#address_Err').html('');
    	});
    	
	

    	function Role_validate(){
    		var profile_photo = $('#profile_photo').val();
    		var full_name = $('#full_name').val();
    		var mobile = $('#mobile').val();
    		var email = $('#email').val();
    		var aadhar_no = $('#aadhar_no').val();
    		var secret_pin = $('#secret_pin').val();
    		var confirm_secret_pin = $('#confirm_secret_pin').val();
    		
    		if(profile_photo == ''){
    			$('#profile_photo_Err').html("<font style='color:red'><b>Select Profile Photo</b></font>");
    			return false;
    		}

    		if(full_name == ''){
    			$('#full_name_Err').html("<font style='color:red'><b>Enter Full Name</b></font>");
    			return false;
    		}
    		
    		var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    		
    		if(mobile == ''|| (!mobile.match(phoneno))){
    			$('#mobile_Err').html("<font style='color:red'><b>Enter Valid Mobile No. ex: 878XXXXX07</b></font>");
    			return false;
    		}
    		
    		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    		
    		if(email == ''|| (!email.match(mailformat))){
    			$('#email_Err').html("<font style='color:red'><b>Enter Valid Email ex: @example.com</b></font>");
    			return false;
    		}
    		
    		var adharformat = /^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/;
    		if(aadhar_no == ''|| (!aadhar_no.match(adharformat))){
    			$('#aadhar_Err').html("<font style='color:red; font-size=12px;'><b>Enter Valid Aadhar Number ex: 0000 0000 0000</b></font>");
    			return false;
    		}
    		
    		var itIsNumber = /^\d{4}$/;
    		if(secret_pin == ""|| (!secret_pin.match(itIsNumber))){
    			$('#secret_pin_Err').html("<font style='color:red'><b>Enter your Secret Pin only 4 digit Ex.0000</b></font>");
    			return false;
    		}
    		
    		if(confirm_secret_pin == ''){
    			$('#confirm_secret_pin_Err').html("<font style='color:red'><b>Enter your Confirm Secret Pin</b></font>");
    			return false;
    		}
    		
    		if(secret_pin != confirm_secret_pin){
    			$('#confirm_secret_pin_Err').html("<font style='color:red'><b>Secret PIN Not matched</b></font>");
    			return false;
    		}
    		
    		return true;
    	}
    	
    	
    	$(document).on('click','#nextbtn',function(){
    	    var valid = Role_validate();
    		if(valid == true){
                var mobile = $('#mobile').val();
                $.ajax({
                    url:"<?php echo base_url(); ?>EclinicPanel/sendPatientOTP",   
                    method:"POST",
                    data:{mobile:mobile}, 
                    dataType:'json',
                    success:function(data)
                    {
                        console.log(data);
                        if(data['success']==0){
                          $('#patient_names').show();    
                        }else{
                            $('#otpid').val(data['otpid']);
                            $('#messageSec').html(data['msg'] + " OTP ("+data['otp']+")");
                            $('#otpstaticBackdrop2').modal('show');
                            $('#num1').val('');
                            $('#num2').val('');
                            $('#num3').val('');
                            $('#num4').val('');
                            /*$("#nextbtn").addClass("next");
                		    $("#account").removeClass("active");
            			    $("#personal").addClass("active");
            			    $("#confirm").removeClass("active");
            			    $('#a1').css('display', 'none' , 'position','relative' , 'opacity','0');
            			    $('#a2').css('display', 'block' , 'opacity','1');
            			    $('#a2').css('opacity','1');
            			    $('#a3').css('display', 'none' , 'position','relative' , 'opacity','0');*/
                        }
                    }
                });
    		}
    	});
    	
    	$(document).on('click','#previousbtn',function(){
    		    /*$("#nextbtn").removeClass("next");*/
    		    $("#account").addClass("active");
			    $("#personal").removeClass("active");
			    $("#confirm").removeClass("active");
			    $('#a1').css('display', 'block' , 'opacity','1');
			    $('#a1').css('opacity','1');
			    $('#a2').css('display', 'none' , 'position','relative' , 'opacity','0');
			    $('#a3').css('display', 'none' , 'position','relative' , 'opacity','0');
    	});
    	
    	function Role_validate2(){
    	
    	    var age = $('#age').val();
    		var gender = $('#gender').val();
    		var relative_name = $('#relative_name').val();
    		var relation = $('#relation').val();
    		var emergency_contact = $('#emergency_contact').val();
    		var emergency_person = $('#emergency_person').val();
    		var allergy = $('#allergy').val();
    		var marital_status = $('#marital_status').val();
    		var occupation = $('#occupation').val();
    		var health_insurance = $('#health_insurance').val();
    		var address = $('#address').val();
 
    		if(age == ''){
    			$('#age_Err').html("<font style='color:red'><b>Select Age</b></font>");
    			return false;
    		}
    
    		if(gender == ''){
    			$('#gender_Err').html("<font style='color:red'><b>Select Gender</b></font>");
    			return false;
    		}
    		
    		if(relative_name == ''){
    			$('#relative_name_Err').html("<font style='color:red'><b>Enter Relative Name</b></font>");
    			return false;
    		}
    		
    		if(relation == ''){
    			$('#relation_Err').html("<font style='color:red'><b>Enter Relation with Patient</b></font>");
    			return false;
    		}
    		
    		if(emergency_contact == ''){
    			$('#emergency_contact_Err').html("<font style='color:red'><b>Enter Emergency Contact</b></font>");
    			return false;
    		}
    		
    		if(emergency_person == ''){
    			$('#emergency_person_Err').html("<font style='color:red'><b>Enter Emergency Person</b></font>");
    			return false;
    		}
    		
    		if(allergy == ''){
    			$('#allergy_Err').html("<font style='color:red'><b>Enter Allergy</b></font>");
    			return false;
    		}
    		
    		if(marital_status == ''){
    			$('#marital_status_Err').html("<font style='color:red'><b>Enter Marital Status</b></font>");
    			return false;
    		}
    		
    		if(occupation == ''){
    			$('#occupation_Err').html("<font style='color:red'><b>Enter Occupation</b></font>");
    			return false;
    		}
    		
    		if(health_insurance == ''){
    			$('#health_insurance_Err').html("<font style='color:red'><b>Enter Health Insurance</b></font>");
    			return false;
    		}
    	    return true;
    	}
        	
        $(document).on('click','#savePatient',function(){
            var valid2 = Role_validate2();
            if(valid2 == true){
			    $("#msform").ajaxSubmit({
				url: URL,
				type: 'post',
				cache: false,
				clearForm: false,
				dataType:'json',
				success: function(res) {
					if(res['status'] == '1'){
	            	   $("#msgdiplay").html("<br><font style='color:green; font-size:16px'>"+res['msg']+"</font>");
						//setTimeout(function(){
							$(".se-pre-con").fadeOut("slow");
						    $("#msgdiplay").fadeOut("slow");
						    $('#msform')[0].reset();
						    $("#account").removeClass("active");
						    $("#personal").removeClass("active");
						    $("#confirm").addClass("active");

						    $('#a1').css('display', 'none' , 'position','relative' , 'opacity','0');
						    $('#a2').css('display', 'none' , 'position','relative' , 'opacity','0');
						    $('#a3').css('display', 'block' , 'opacity','1');

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
    
    
    
    $(document).on('click','#verifyBTN',function(){
        var otpid = $('#otpid').val();
        var num1 = $('#num1').val();
        var num2 = $('#num2').val();
        var num3 = $('#num3').val();
        var num4 = $('#num4').val();
        
        var otp = num1+num2+num3+num4;
        
        $.ajax({
            url:"<?php echo base_url(); ?>EclinicPanel/verifyPatientOTP",   
            method:"POST",
            data:{otpid:otpid,otp:otp }, 
            dataType:'json',
            success:function(data)
            {
                console.log(data);
                if(data['success']==0){
                    $('#msgdiplay').show();
                    $('#msgdiplay').html(data['msg']);
                    $('#num1').val('');
                    $('#num2').val('');
                    $('#num3').val('');
                    $('#num4').val('');
	                $('#otpstaticBackdrop2').modal('show');
						    
                }else{
                    
                    $('#msgdiplay').html(data['msg']);
                    
                    $('#num1').val('');
                    $('#num2').val('');
                    $('#num3').val('');
                    $('#num4').val('');
                    
                    setTimeout(function(){
                        $('#otpstaticBackdrop2').modal('hide');
                        
                        $("#nextbtn").addClass("next");
            		    $("#account").removeClass("active");
        			    $("#personal").addClass("active");
        			    $("#confirm").removeClass("active");
        			    $('#a1').css('display', 'none' , 'position','relative' , 'opacity','0');
        			    $('#a2').css('display', 'block' , 'opacity','1');
        			    $('#a2').css('opacity','1');
        			    $('#a3').css('display', 'none' , 'position','relative' , 'opacity','0');
                    },3000);   
                }
            }
        });
    });
    
</script>
    


