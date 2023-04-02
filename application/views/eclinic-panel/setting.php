<?php 
    
$userid = $this->session->userdata('user_id');
//$uid = $this->session->userdata('user_id');
    
$userCode = "CL-".str_pad($userid, 5, "0", STR_PAD_LEFT);
     
?>


<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Settings</li>
        </ol>
      </div>
    </div> <!-- .row end -->
    <div class="row align-items-center">
      <div class="col-auto">
        <h1 class="fs-5 color-900 mt-1 mb-0">Settings</h1>
      </div>
      
    </div> <!-- .row end -->
  </div>
</div>
<!-- start: page body -->
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
    <div class="container-fluid">
      <div class="row g-3">
        <div class="col-xxl-3 col-lg-4 col-md-4">
          <div class="list-group list-group-custom sticky-top me-xl-4" style="top: 100px;">
            <a class="list-group-item list-group-item-action" href="#list-item-1">Change Password</a>
            <a class="list-group-item list-group-item-action" href="#list-item-2">Notifications Settings</a>
            <a class="list-group-item list-group-item-action" href="#list-item-3">Change Language</a>
          </div>
        </div>
        <div class="col-xxl-8 col-lg-8 col-md-8">
          
          <div id="list-item-1" class="card fieldset border border-muted mt-5">
            <!-- form: Change Password -->
            
            <span class="fieldset-tile text-muted bg-body">Change Password</span>
            <form class="row g-3"  id="form-validate" method="post" enctype="multipart/form-data"> 
               <div class="card">
              <div class="card-body">
                <div class="row g-3">
                  <div class="col-lg-4 col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?php echo  $userCode; ?>" readonly placeholder="Username">
                      <input type="hidden" class="form-control" value="<?php echo  $userid; ?>" id='dr_id' name='dr_id'>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12">
                    <div class="form-group">
                      <input type="email" class="form-control" id='email' name='email' value="<?php echo $this->session->userdata('email'); ?>" readonly placeholder="Email">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12">
                    <div class="form-group">
                      <input type="number" class="form-control" id='contactNumber' readonly name='contactNumber' value="<?php echo $this->session->userdata('userContact'); ?>" placeholder="Phone Number">
                    </div>
                  </div>
                  <div class="col-12">
                    <h6 class="border-top pt-2 mt-2 mb-3">Change Password</h6>
                    <div class="mb-3">
                      <input type="password" id="current_password" name='current_password' class="form-control form-control-lg" placeholder="Current Password">
                      <span id="current_passworderr"></span>
                    </div>
                    <div class="mb-1"> 
                      <input type="password" id="new_password" name='new_password' class="form-control form-control-lg" placeholder="New Password">
                      <span id="new_passworderr"></span>
                    </div>
                    <div>
                      <input type="password" id="new_cpassword" name='new_cpassword' class="form-control form-control-lg" placeholder="Confirm New Password">
                      <span id="new_cpassworderr"></span>
                      
                      
                      <span class="text-muted small">Minimum 8 characters</span>
                    </div>
                  </div>
                </div>
              </div>

        	
              <div class="card-footer text-end">
                <button class="btn btn-lg btn-light me-2" type="reset">Discard</button>
                <button class="btn btn-lg btn-primary" type="button" id="btnResetpass">Save Changes</button>
              </div>
            </div>
            </form>
          </div>
          <div id="list-item-2" class="card fieldset border border-muted mt-5">
            <!-- form: Notifications Settings -->
            <span class="fieldset-tile text-muted bg-body">Notifications Settings</span>
            <div class="card">
              <div class="card-body table-responsive">
                <table class="table card-table mb-0">
                  <tbody>
                    <tr>
                      <td class="text-muted">Email Notifications</td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="n_email1" checked>
                          <label class="form-check-label" for="n_email1">Email</label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="n_phone1" checked>
                          <label class="form-check-label" for="n_phone1">Phone</label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-muted">Billing Updates</td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="n_email2">
                          <label class="form-check-label" for="n_email2">Email</label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="n_phone2">
                          <label class="form-check-label" for="n_phone2">Phone</label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-muted">New Appointment</td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="n_email3">
                          <label class="form-check-label" for="n_email3">Email</label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="n_phone3">
                          <label class="form-check-label" for="n_phone3">Phone</label>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer text-end">
                <button class="btn btn-lg btn-light me-2" type="reset">Discard</button>
                <button class="btn btn-lg btn-primary" type="submit">Save Changes</button>
              </div>
            </div>
          </div>
          <div id="list-item-3" class="card fieldset border border-muted mt-5">
            <!-- form: Social Profiles -->
            <span class="fieldset-tile text-muted bg-body">Change Language</span>
            <div class="card">
              <div class="card-body">
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-4 col-form-label">Language</label>
                    <div class="col-md-9 col-sm-8">
                      <select class="form-control form-control-lg">
                        <option value="">-- Select Language --</option>
                        <option value="Hindi">Hindi</option>
                        <option value="English">English</option>
                        <option value="Urdu">Urdu</option>
                        <option value="Bengali">Bengali</option>
                        <option value="Malyalam">Malyalam</option>
                      </select>
                    </div>
                  </div>
              </div>
              <div class="card-footer text-end">
                <button class="btn btn-lg btn-light me-2" type="reset">Discard</button>
                <button class="btn btn-lg btn-primary" type="submit">Update Language</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="donepopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box-confirmed text-success">
                    <i class="bi bi-check"></i>
                </div>						
                <h4 class="modal-title w-100" id="changepassmessage"></h4>	
                <button type="button" class="btn-close close editclosedBTN" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary editclosedBTN" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
  
  

  
  
  <script type="text/javascript">
    /*$("#btnResetpass2").click(function(){

        var current_password  = document.getElementById('current_password').value;    
        var new_password = document.getElementById('new_password').value; 
        var new_cpassword = document.getElementById('new_cpassword').value;
   
        if(current_password==""){ 
            document.getElementById('current_passworderr').innerHTML='Please enter Current Login Password';
            return false;
        }
        
        var strongpass = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;

        if(new_password=="" || (!password.match(strongpass))){
            document.getElementById('new_passworderr').innerHTML='Please enter New Login Password';
            return false;
        }
        
        if(new_cpassword==""){ 
            document.getElementById('new_cpassworderr').innerHTML='Please enter New Login Confirm Password';
            return false;
        }
        
        if(new_password !=new_cpassword){
            document.getElementById('new_cpassworderr').innerHTML='Confirm Password not matched!!';
            return false;
        } else{ 

           // $("#form-validate").submit();
        }
        
    });
*/
  </script>
  
  
  <script src="<?php echo base_url() ?>bassets/js/theme.js"></script>

    <script>
        var URLs = "<?=base_url('login/forgotpassword')?>";
        
        var URLss = "<?=base_url('eclinic/setting')?>";
        

        $(document).ready(function(){
            
        	$(document).on('change keyup','#current_password',function(){
        		$('#current_passworderr').html('');
        	});
        	
        	$(document).on('keyup','#new_password',function(){
        		$('#new_passworderr').html('');
        	});
        	
        	$(document).on('keyup','#new_cpassword',function(){
        		$('#new_cpassworderr').html('');
        	});
        	
        	
        	function Role_validate(){

        		var current_password = $('#current_password').val();
        		var new_password = $('#new_password').val();
        		var new_cpassword = $('#new_cpassword').val();


        		if(current_password == ''){
        			$('#current_passworderr').html("<font style='color:red'><b>Enter Current Password</b></font>");
        			return false;
        		}
        		
        		var strongpass = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;
    
        		if(new_password == ''|| (!new_password.match(strongpass))){
        			$('#new_passworderr').html("<font style='color:red'><b>Password between 8 to 16 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</b></font>");
        			return false;
        		}
        		
        		if(new_cpassword == ''){
        			$('#new_cpassworderr').html("<font style='color:red'><b>Enter Confirm Password</b></font>");
        			return false;
        		}
        		
        		
        		if(new_password != new_cpassword){
        			$('#new_cpassworderr').html("<font style='color:red'><b>Password not matched</b></font>");
        			return false;
        		}
        		
        		
        		return true;
        	}

	        $('#btnResetpass').click(function(){

        		var formdata = $("#form-validate input, select, textarea").serialize();
        		var valid = Role_validate();
        		if(valid == true){
        			$.ajax({
        				url:URLs,
        				method:'post',
        				data:{formdata:formdata},
        				dataType:'json',
        				success:function(res){
        					console.log(res);
        					if(res['success'] == "1"){
        						$("#changepassmessage").html("<br><font style='color:green'>"+res['msg']+"</font>");
        						$('#donepopup').modal('show');
        						$('.editclosedBTN').click(function(){
        						   $('#donepopup').modal('hide'); 
        						   $("#changepassmessage").html(""); 
                                   window.location.href = URLss;
        					    }); 
        					}else{	
        						$(".se-pre-con").fadeOut("slow");
        						$("#changepassmessage").html("<br><font style='color:red'>"+res['msg']+"</font>");
        					    $('#donepopup').modal('show');
        					    $('.editclosedBTN').click(function(){
        					       $('#donepopup').modal('hide'); 
        						   $("#changepassmessage").html("");

        					    });     
        					    
        						return false;
        					}
				        },
			       });
		       }
	        });
        });
    </script>
    
    
    