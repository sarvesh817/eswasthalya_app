<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="e-Swasthalya is a telemedicine facilities with online video Consultant treatment.">
  <!-- Favicon-->
  <link rel="icon" href="<?php echo base_url() ?>bassets/img/favicon.ico" type="image/x-icon">
  <title>eSwasthalya</title>

  <!-- project css file  -->
  <link rel="stylesheet" href="<?php echo base_url() ?>bassets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>bassets/css/master.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <!-- Jquery Core Js -->
  <script src="<?php echo base_url() ?>bassets/js/plugins.js"></script>
  <style>
     .txterrorcolor{
         color:red;
     } 
  </style>

</head>
      
<body id="layout-1" data-luno="theme-blue">
  <!-- start: body area -->
  <div class="wrapper">
    <!-- Sign In version 1 -->
    <!-- start: page body -->
    <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
      <div class="container-fluid">
        <div class="row g-3">
          <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
            <div style="max-width: 25rem;">
              <div class="mb-4">
                <img src="<?php echo base_url() ?>bassets/img/logo.png" alt="Logo" class="login-logo">
              </div>
              <div class="mb-5">
                <h2 class="color-900">e-Swasthalya is online video Consultant services:</h2>
              </div>
              <!-- List Checked -->
              <ul class="list-unstyled mb-5">
                <li class="mb-4">
                  <span class="d-block mb-1 fs-4 fw-light">All-in-one best specilities</span>
                  <span class="color-600">Amazing Features to make your life easier & work efficient</span>
                </li>
                <li>
                  <span class="d-block mb-1 fs-4 fw-light">Easily add &amp; manage your services</span>
                  <span class="color-600">It brings good health, projects, timelines, files and more</span>
                </li>
              </ul>
              <div class="mb-2">
                <a href="#" class="me-3 color-600">Home</a>
                <a href="#" class="me-3 color-600">About Us</a>
                <a href="#" class="me-3 color-600">FAQs</a>
              </div>
              <div class="social-icons">
                <a href="#" class="me-3 color-400"><i class="fa fa-facebook-square fa-lg"></i></a>
                <a href="#" class="me-3 color-400"><i class="fa fa-youtube-square fa-lg"></i></a>
                <a href="#" class="me-3 color-400"><i class="fa fa-linkedin-square fa-lg"></i></a>
                <a href="#" class="me-3 color-400"><i class="fa fa-twitter-square fa-lg"></i></a>
              </div>
            </div>
          </div>
          
            
            <div class="col-lg-6 justify-content-center align-items-center" id="mainSignupDiv">
                
                
            <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
              <!-- Form -->
              
              <form class="row g-3" action="<?=base_url()?>" id="userList_validate" method="post" enctype="multipart/form-data"> 
                <div class="col-12 text-center mb-2">
                  <h1>Create account</h1>
                  <span>Free access to our dashboard.</span>
                  
                  <span id="msgdiplay"></span>
                </div>
                <div class="col-12">
                  <label class="form-label">Select Your Profile *</label>
                  <select name="profile_type" id="profile_type" class="form-control form-control-lg" name="selectrole">
                    <option value="">Select Profile</option>
                    <option value="ECLINIC">E-Clinic</option>
                    <option value="DOCTOR">Doctor</option>
                    <option value="PATIENT">Patient</option>
                  </select>
                  
                  <div id="profile_type_err"></div>
                </div>
                <div class="col-6">
                  <label class="form-label">Full name*</label>
                  <input type="text" name="first_name" id="first_name" class="form-control form-control-lg" placeholder="John">
                  <div id="first_name_err" class="txterrorcolor"></div>
                </div>
                
                <div class="col-6">
                  <label class="form-label">&nbsp;</label>
                  <input type="text" name="last_name" class="form-control form-control-lg" placeholder="Parker">
                </div>
                <div class="col-6">
                  <label class="form-label">Email address*</label>
                  <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="name@example.com">
                  <div id="email_err" class="txterrorcolor"></div>
                </div>
                <div class="col-6">
                  <label class="form-label">Mobile Number*</label>
                  <input type="email" name="contact" id="contact" class="form-control form-control-lg" placeholder="+91 00000 00000">
                  <div id="contact_err" class="txterrorcolor"></div>
                </div>
                <div class="col-6">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="8+ characters required">
                  <div id="password_err" class="txterrorcolor"></div>
                </div>
                <div class="col-6">
                  <label class="form-label">Confirm password</label>
                  <input type="password" name="confirm_password" id="cpassword" class="form-control form-control-lg" placeholder="8+ characters required">
                  <div id="cpassword_err" class="txterrorcolor"></div>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" name="checked_term_condition" type="checkbox" value="checked" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault"> I accept the <a href="#" title="" class="text-primary">Terms and Conditions</a>
                    </label>
                  </div>
                </div>
                <div class="col-12 text-center mt-4">
                  <button type="button"  id="saveUser" name="profile_submit" class="btn btn-lg btn-block btn-dark lift text-uppercase">SIGN UP</button>
                </div>  
                <div class="col-12 text-center mt-4">
                  <span class="text-muted">Already have an account? <a href="<?php echo base_url(); ?>login">Sign in here</a></span>
                </div>
              </form>
              
              <input type="hidden" class="form-control form-control-lg text-center" value="<?php echo $this->session->userdata('emailverifyuser'); ?>" id="emailveruid">
                
               <input type="hidden" class="form-control form-control-lg text-center" value="<?php echo $this->session->userdata('mobileverifyuser'); ?>" id="mobileveruid"> 
              <!-- End Form -->
            </div>
          </div>
          
          
          
            <div class="col-lg-6 justify-content-center align-items-center" id="emailVerificationDiv" style="display:none!important;" >
                
                
              <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
              <!-- Form -->
              <form class="row g-3" action="<?=base_url()?>" id="email_validate" method="post" enctype="multipart/form-data"> 
                <div class="col-12 text-center mb-5">
                  <img src="assets/img/auth-two-step.svg" class="w240 mb-4" alt="" />
                  <h1>Your OTP</h1>
                  <input type="hidden" class="form-control form-control-lg text-center" value="<?php echo $this->session->userdata('emailverifyuser'); ?>" id="euserid" name="euserid">
                
                  <span class="text-success" id="text_success">Sent the OTP to your registered email address.</span>
                  <br>
                  <span id="msgdiplay1"></span>
                </div>
                <div class="col">
                  <div class="mb-2">
                    <input type="text" class="form-control form-control-lg text-center" id="num1" name="num1" placeholder="-" maxlength="1">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-2">
                    <input type="text" class="form-control form-control-lg text-center" id="num2" name="num2" placeholder="-" maxlength="1">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-2">
                    <input type="text" class="form-control form-control-lg text-center" id="num3" name="num3" placeholder="-" maxlength="1">
                  </div>
                </div>
                <div class="col">
                  <div class="mb-2">
                    <input type="text" class="form-control form-control-lg text-center" id="num4" name="num4" placeholder="-" maxlength="1">
                  </div>
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="button" id="emailVerify" name="everify_submit" class="btn btn-lg btn-block btn-dark lift text-uppercase">Verify Email Address</button>
                </div>
                <div class="col-12 text-center mt-4">
                  <span class="text-muted">Haven't remember it? <a href="#">Resend a new code.</a></span>
                </div>
              </form>
              <!-- End Form -->
            </div>
            </div>
            
            
            <div class="col-lg-6 d-flex justify-content-center align-items-center" id="mobileVerificationDiv" style="display:none!important;" >
                <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
                    <!-- Form -->
                    <form class="row g-3" action="<?=base_url()?>" id="mobile_validate" method="post" enctype="multipart/form-data"> 
                        <div class="col-12 text-center mb-5">
                          <img src="assets/img/auth-two-step.svg" class="w240 mb-4" alt="" />
                          <h1>Your OTP</h1>
                          <input type="hidden" class="form-control form-control-lg text-center" value="<?php echo $this->session->userdata('mobileverifyuser'); ?>" id="muserid" name="muserid">
                        
                          <span class="text-success" id="text_success">Sent the OTP (<?php echo $this->session->userdata('mobileverifyuserotp'); ?>) to your registered mobile number.</span>
                          <br>
                          <span id="msgdiplay2"></span>
                        </div>
                        <div class="col">
                          <div class="mb-2">
                            <input type="text" class="form-control form-control-lg text-center" id="mobnum1" name="num1" placeholder="-" maxlength="1">
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-2">
                            <input type="text" class="form-control form-control-lg text-center" id="mobnum2" name="num2" placeholder="-" maxlength="1">
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-2">
                            <input type="text" class="form-control form-control-lg text-center" id="mobnum3" name="num3" placeholder="-" maxlength="1">
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-2">
                            <input type="text" class="form-control form-control-lg text-center" id="mobnum4" name="num4" placeholder="-" maxlength="1">
                          </div>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="button" id="mobileVerify" name="mverify_submit" class="btn btn-lg btn-block btn-dark lift text-uppercase">Verify Mobile Number</button>
                        </div>
                        <div class="col-12 text-center mt-4">
                          <span class="text-muted">Haven't remember it? <a href="#">Resend a new code.</a></span>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>

        </div> <!-- End Row -->
      </div>
    </div>
  </div>

  <script src="<?php echo base_url() ?>bassets/js/theme.js"></script>

    <script>
        var URL = "<?=base_url('login/')?>";

        emailuid = $('#emailveruid').val();
        mobileuid = $('#mobileveruid').val();
        
        if(emailuid !=''){
            $("#mainSignupDiv").hide();
            $("#mobileVerificationDiv").hide();
        	$("#emailVerificationDiv").show();
        }else if(mobileuid !=''){
           $("#mainSignupDiv").hide();
           $("#mobileVerificationDiv").show();
           $("#emailVerificationDiv").hide(); 
        }else{
           $("#mainSignupDiv").show();
           $("#mobileVerificationDiv").hide();
           $("#emailVerificationDiv").hide();  
        }

        $(document).ready(function(){
            
        	$(document).on('change keyup','#profile_type',function(){
        		$('#profile_type_err').html('');
        	});
        	
        	$(document).on('keyup','#first_name',function(){
        		$('#first_name_err').html('');
        	});
        	
        	$(document).on('keyup','#email',function(){
        		$('#email_err').html('');
        	});
        	
        	$(document).on('keyup','#contact',function(){
        		$('#contact_err').html('');
        	});
        
        	
        	$(document).on('keyup','#password',function(){
        		$('#password_err').html('');
        	});
        
        	$(document).on('keyup','#cpassword',function(){
        		$('#cpassword_err').html('');
        	});
        

        	function Role_validate(){

        		var profile_type = $('#profile_type').val();
        		var first_name = $('#first_name').val();
        		var email = $('#email').val();
        		var contact = $('#contact').val();
        		var password = $('#password').val();
        		var cpassword = $('#cpassword').val();
        
        		if(profile_type == ''){
        			$('#profile_type_err').html("<font style='color:red'><b>Select Profile Type</b></font>");
        			return false;
        		}
    
        		if(first_name == ''){
        			$('#first_name_err').html("<font style='color:red'><b>Enter First Name</b></font>");
        			return false;
        		}
        		
        		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    
        		if(email == ''|| (!email.match(mailformat))){
        			$('#email_err').html("<font style='color:red'><b>Enter Valid Email ex: @example.com</b></font>");
        			return false;
        		}
        		
        		var contactformat = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        		
        		if(contact == ''|| (!contact.match(contactformat))){
        			$('#contact_err').html("<font style='color:red'><b>Enter Valid Mobile No. ex: 878XXXXX07</b></font>");
        			return false;
        		}

    
        		var strongpass = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;

        		if(password == ''|| (!password.match(strongpass))){
        			$('#password_err').html("<font style='color:red; font-size:10px;'><b>Password between 8 to 16 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</b></font>");
        			return false;
        		}

        		if(cpassword == ''){
        			$('#cpassword_err').html("<font style='color:red'><b>Enter Confirm Password</b></font>");
        			return false;
        		}
        		
        		if(password != cpassword){
        			$('#cpassword_err').html("<font style='color:red'><b>Confirm Password Not matched</b></font>");
        			return false;
        		}
        		
        
        		return true;
        	}

	        $('#saveUser').click(function(){
        		var formdata = $("#userList_validate input, select").serialize();
        		var valid = Role_validate();
        		if(valid == true){
        			$.ajax({
        				url:'<?=base_url('user-submitForm')?>',
        				method:'post',
        				data:{formdata:formdata},
        				dataType:'json',
        				success:function(res){
        					console.log(res);
        					if(res['success'] == "1"){
        						$("#msgheader").html("<font style='color:green'><b>Success</b></font>");
        						$("#msgdiplay").html("<br><font style='color:green'>"+res['msg']+"</font>");
        						$("#text_success").html("<br><font style='color:green'>"+res['emailotp']+"</font>");
        						setTimeout(function(){
        							$(".se-pre-con").fadeOut("slow");
        						    $("#msgdiplay").fadeOut("slow");
        						    $('#userList_validate')[0].reset();
        						    $("#mainSignupDiv").hide();
        						    $("#mobileVerificationDiv").hide();
        						    location.reload(true);
        						    $("#emailVerificationDiv").show();
        						    //window.location.href = "<?php base_url('doctors-panel/login')?>";
        						},4000);
        					}else{	
        						$(".se-pre-con").fadeOut("slow");
        						$("#msgheader").html("<font style='color:red'><b>Fail</b></font>");
        						$("#msgdiplay").html("<br><font style='color:red'>"+res['msg']+"</font>");
        						
        						setTimeout(function(){
        							$(".se-pre-con").fadeOut("slow");
        						    $("#msgdiplay").fadeOut("slow");
        						    //$('#userList_validate')[0].reset();
        						    $("#mainSignupDiv").show();
        						    $("#mobileVerificationDiv").hide();
        						    $("#emailVerificationDiv").hide();
        						},4000);
        						return false;
        					}
				        },
			       });
		       }
	        });
        });
    </script>	

    
    <script>
        $(document).ready(function(){
        	$(document).on('change keyup','#num1',function(){
        		$('#num1_err').html('');
        	});
        	
        	$(document).on('keyup','#num2',function(){
        		$('#num2_err').html('');
        	});
        	
        	$(document).on('keyup','#num3',function(){
        		$('#num3_err').html('');
        	});

        	$(document).on('keyup','#num4',function(){
        		$('#num4_err').html('');
        	});
        
        	function Role_validate(){

        		var num1 = $('#num1').val();
        		var num2 = $('#num2').val();
        		var num3 = $('#num3').val();
        		var num4 = $('#num4').val();

        		if(num1 == ''){
        			$('#num1_err').html("<font style='color:red'><b>Enter Textbox1 </b></font>");
        			return false;
        		}
    
        		if(num2 == ''){
        			$('#num2_err').html("<font style='color:red'><b>Enter Textbox2</b></font>");
        			return false;
        		}
        		
        		if(num3 == ''){
        			$('#num3_err').html("<font style='color:red'><b>Enter Textbox3 </b></font>");
        			return false;
        		}
    
        		if(num4 == ''){
        			$('#num2_err').html("<font style='color:red'><b>Enter Textbox4</b></font>");
        			return false;
        		}

        
        		return true;
        	}

	        $('#emailVerify').click(function(){
        		var formdata = $("#email_validate input, select").serialize();
        		var valid = Role_validate();
        		if(valid == true){
        			$.ajax({
        				url:'<?=base_url('emailVerify')?>',
        				method:'post',
        				data:{formdata:formdata},
        				dataType:'json',
        				success:function(res){
        					console.log(res);
        					if(res['success'] == "1"){
        						$("#msgheader1").html("<font style='color:green'><b>Success</b></font>");
        						$("#msgdiplay1").html("<br><font style='color:green'>"+res['msg']+"</font>");
        						setTimeout(function(){
        							$(".se-pre-con").fadeOut("slow");
        						    $("#msgdiplay1").fadeOut("slow");
        						    $('#email_validate')[0].reset();
        						    //window.location.href = URL;
        						    $("#mainSignupDiv").hide();
        						    $("#emailVerificationDiv").hide();
        						    location.reload(true);
        						    $("#mobileVerificationDiv").show();
        						    
        						    
        						},2000);
        					}else{	
        						$(".se-pre-con").fadeOut("slow");
        						$("#msgheader1").html("<font style='color:red'><b>Fail</b></font>");
        						$("#msgdiplay1").html("<br><font style='color:red'>"+res['msg']+"</font>");
        						
        						setTimeout(function(){
        							$(".se-pre-con").fadeOut("slow");
        						    $("#msgdiplay1").fadeOut("slow");
        						    $('#email_validate')[0].reset();
        						    $("#mainSignupDiv").hide();
        						    $("#emailVerificationDiv").show();
        						    $("#mobileVerificationDiv").hide();
        						},4000);
        						
        						return false;
        					}
				        },
			       });
		       }
	        });
        });
    </script>
    
    
    <script>
    
        $(document).ready(function(){

        	$(document).on('change keyup','#mobnum1',function(){
        		$('#mobnum1_err').html('');
        	});
        	
        	$(document).on('keyup','#mobnum2',function(){
        		$('#mobnum2_err').html('');
        	});
        	
        	$(document).on('keyup','#mobnum3',function(){
        		$('#mobnum3_err').html('');
        	});

        	$(document).on('keyup','#mobnum4',function(){
        		$('#mobnum4_err').html('');
        	});
        
        	function Role_validate(){

        		var num1 = $('#mobnum1').val();
        		var num2 = $('#mobnum2').val();
        		var num3 = $('#mobnum3').val();
        		var num4 = $('#mobnum4').val();

        		if(num1 == ''){
        			$('#mobnum1_err').html("<font style='color:red'><b>Enter Textbox1 </b></font>");
        			return false;
        		}
    
        		if(num2 == ''){
        			$('#mobnum2_err').html("<font style='color:red'><b>Enter Textbox2</b></font>");
        			return false;
        		}
        		
        		if(num3 == ''){
        			$('#mobnum3_err').html("<font style='color:red'><b>Enter Textbox3 </b></font>");
        			return false;
        		}
    
        		if(num4 == ''){
        			$('#mobnum2_err').html("<font style='color:red'><b>Enter Textbox4</b></font>");
        			return false;
        		}
        		return true;
        	}

	        $('#mobileVerify').click(function(){
        		var formdata = $("#mobile_validate input, select").serialize();
        		var valid = Role_validate();
        		if(valid == true){
        			$.ajax({
        				url:'<?=base_url('mobileVerify')?>',
        				method:'post',
        				data:{formdata:formdata},
        				dataType:'json',
        				success:function(res){
        					console.log(res);
        					if(res['success'] == "1"){
        						$("#msgheader2").html("<font style='color:green'><b>Success</b></font>");
        						$("#msgdiplay2").html("<br><font style='color:green'>"+res['msg']+"</font>");
        						setTimeout(function(){
        							$(".se-pre-con").fadeOut("slow");
        						    $("#msgdiplay2").fadeOut("slow");
        						    $('#mobile_validate')[0].reset();
        						    window.location.href = URL;
        						},2000);
        					}else{	
        						$(".se-pre-con").fadeOut("slow");
        						$("#msgheader2").html("<font style='color:red'><b>Fail</b></font>");
        						$("#msgdiplay2").html("<br><font style='color:red'>"+res['msg']+"</font>");
        						
        						setTimeout(function(){
        							$(".se-pre-con").fadeOut("slow");
        						    $("#msgdiplay2").fadeOut("slow");
        						    $('#mobile_validate')[0].reset();
        						    $("#mainSignupDiv").hide();
        						    $("#emailVerificationDiv").hide();
        						    $("#mobileVerificationDiv").show();
        						    
        						    
        						},4000);
        						
        						return false;
        					}
				        },
			       });
		       }
	        });
        });
    </script>
    

  
</body>
</html>