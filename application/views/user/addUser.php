
<style type="text/css">
.select2-selection--multiple .select2-selection__rendered { 
   max-height: 100px !important; overflow-y: auto !important;
}
</style>
<div class="content-wrapper" style="min-height: 901px;">
<section class="content">
<div class="row">
	<div class="col-sm-7" style="top: -10px;margin: 0em 0em 0em 0.5em;font-size: 15px;font-weight: 600;">
  		<a href="<?php echo URL.'home'?>">Home</a> &raquo; User Management &raquo; Add New User  
	</div>
	<div class="col-xs-12">
  		<div class="box">
			<div class="box-header">	
				<!-- <form action="<?php //echo URL.'submitForm';?>" method="post" class="form-horizontal" id="userList_validate"> -->
				<?php echo form_open(base_url(), array("class"=>"form-horizontal", "id"=>"userList_validate", "method"=>"post")); ?>
					<div class="row">
						<div class="col-md-3">
							<label for="name" class="control-label">Role</label>
							<select class="form-control"  id="role_id" name="role_id" >
								<option value="">Select Role</option>
								<?php 
									if(isset($role) && !empty($role) && $role !=''){
									foreach ($role as $roleKey => $roleVal) {
								?>
								<option value="<?php echo $roleVal['role_id'];?>"><?php echo $roleVal['name'];?></option>	
								<?php }
									}
								?>												
							</select>
							<p id="role_id_error" style="color:red;"></p>
						</div>

						<div class="col-md-3">
							<label for="name" class="control-label">Sub Role</label>
							<select class="form-control"  id="subrole_id" name="subrole_id">
								<option value="">Select Sub Role</option>
							</select>
							<p id="subrole_error" style="color:red;"></p>
							
						</div>
						<div class="col-md-3">
							<label for="parent_id" class="control-label">Reporting Person</label>
							<select class="form-control"  id="parent_id" name="parent_id">
								<option value="">Select Reporting Person</option>
								<?php 
									if(!empty($reporting_person) &&  $reporting_person !=false){
										foreach ($reporting_person as $RPkey => $RPvalue) {
											echo '<option value="'.$RPvalue["user_id"].'">'.$RPvalue["name"].' ('.$RPvalue["subrole"].')</option>';
										}
									}
								?>
							</select>
							<p id="subrole_error" style="color:red;"></p>
							
						</div>
						
						<div class="col-md-3 contact" id="">
							<label for="contact" class="control-label">Contact</label>
							<?php 
								$contact ='';
								if(isset($users) && !empty($users)){
									$contact = gowelnextDcrypt($users[0]['contact']);
								}
							?>
							<input type="text" class="form-control" id="contact"  name="contact" value="<?php echo $contact;?>" placeholder="">
							<p id="contact_error" style="color:red;"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3" id="gwlempCode">
							<label class="control-label" for="gwlempid">Employee Id</label>
							<input type="text" id="gwlempid" name="gwlempid" class="form-control" > 
						</div>					

						<div class="col-md-3">
							<label for="name" class="control-label">Name</label>
							<?php 
							$name ='';
							if(isset($users) && !empty($users)){
								$name = $users[0]['name'];
							}
							?>
							<input type="text" class="form-control" id="name"  name="name" value="<?php echo $name;?>" placeholder="">
							<p id="name_error" style="color:red;"></p>
						</div>

						<div class="col-md-3">
							<label for="email" class="control-label">Email/Username</label>
							<?php 
							$email ='';
							if(isset($users) && !empty($users)){
								$email = gowelnextDcrypt($users[0]['email']);
								$disable = 'disabled';
							}else{
								$disable = '';
							}
							?>
							<input type="text" class="form-control" id="email"  name="email" value="<?php echo $email;?>" placeholder="" <?php echo $disable;?>>
							<p id="email_error" style="color:red;"></p>
						</div>

						<div class="col-md-3" id="user_status">
							<label for="status" class="control-label">Status</label>
							<select class="form-control"  id="status" name="status">
						<?php 
							$user_status = array("Pending","Approved","Rejected");
							if(isset($users) && !empty($users)){
								$status = str_replace("'", '', $users[0]['status']);
							} else{
								$status ="";
							}
							if(isset($user_status) && $user_status !=''){
								foreach ($user_status as $key => $value) { 
								$sel = $value === $status ? 'selected="selected"' : '' ;
							?>
								<option value="<?php echo $value;?>" <?php ;echo $sel;?>><?php echo $value;?></option>
							<?php }
								}
							?>												
							</select>
							<p id="status_error" style="color:red;"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label class="control-label" for="designation">Designation</label>
							<input type="text" id="designation" name="designation" class="form-control" > 
						</div>					

						<div class="col-md-3">
							<label for="department" class="control-label">Department</label>
							<input type="text" id="department" name="department" class="form-control" >
						</div>

						<div class="col-md-3">
							<label for="function" class="control-label">Function</label>
							<input type="text" id="function" name="function" class="form-control" >
						</div>

						<div class="col-md-3">
							<label for="worklocation" class="control-label">Work Location</label>
							<input type="text" id="worklocation" name="worklocation" class="form-control" >
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-3" id="state">
							<label for="welnext_state" class="control-label">State</label>
							<select class="form-control" id="state" name="state[]" style="width:100%" multiple>
								<option value="All">All</option>
								<?php 
									if(isset($state) && !empty($state) && $state !=''){
									foreach ($state as $stateKey => $stateVal) {									
								?>
								<option value="<?php echo $stateVal['state_id'];?>"><?php echo $stateVal['state_name'];?></option>
								<?php }
									}
								?>
							</select>
							<p id="state_error" style="color:red;"></p>
							
						</div>							
					
						<div class="col-md-3">
							<label for="welnext_branch" class="control-label">Branch</label>
																	
							<select class="form-control branch"  id="branch" name="branch[]" style="width:100%;" multiple>
								<option value="All">All</option>
								<?php 
								if(isset($branch) && !empty($branch) && $branch !=''){
								foreach ($branch as $WBkey => $WBvalue) { 
								?>
								<option value="<?php echo $WBvalue['branch_name'];?>" <?php echo $sel;?>><?php echo $WBvalue['branch_name'];?></option>
								<?php }
									}
								?>
							</select>
							<p id="welBranch_error" style="color:red;"></p>
						</div>

					</div>

					<div class="row">
						<div class="col-md-3">
							<label>MER Type</label>
							<select class="form-control" id="mer_type_id" name="mer_type_id[]" multiple="">
								<option value="All">All</option>
								<?php 
								if(!empty($mer_types) && $mer_types !=false){
									foreach ($mer_types as $MTkey => $MTvalue) {
										echo '<option value="'.$MTvalue["mer_id"].'"> '.$MTvalue["mer_type"].'</option>';	
									}									
								}
								?>
							</select><p id="mer_type_id_error" style="color:red;"></p>
						</div>
						<div class="col-md-3">
							<label class="control-label" for="gwlempid">Joining date</label>
							 <div class="input-group date" id="joiningdate">
                                            <input type='text' class="form-control" id="joining_date_time" value="" name="joining_date_time" autocomplete="off" />
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> 
                                        </div>
						</div>					

						<div class="col-md-3">
							<label for="name" class="control-label">Relieving Date</label>
							 <div class="input-group date" id="relievingdate">
                                            <input type='text' class="form-control" id="relieving_date_time" value="" name="relieving_date_time" autocomplete="off" />
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> 
                                        </div>
						</div>
						<div class="col-md-3">
							<label>Login Password</label>
							<input type="text" name="lpassword" id="lpassword" class="form-control">
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 form-group">
							<div class="box-footer" style="text-align:center;" >
								<button type="button" class="btn btn-primary" id="saveUser" style="margin:0 auto;">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="<?php echo URL.'user';?>" class="btn btn-primary" style="margin:0 auto;">Cancel</a>
							</div>
						</div>
					</div>		
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
</section>
</div>
<script>
var URL = "<?php echo URL;?>";

function getDignosticCente(){
	var role_id = $('#role_id').val();
	var stateData = $('#state').val();
	if(stateData !='' && stateData !='null' && role_id ==1){
		$.ajax({
			url : URL+'getAllDCNameList',
			method : 'post',
			dataType : 'html',
			data: {stateData:stateData,'csrf_test_name':csrf_token},
			success: function(res){
				if(res !=''){
					$('#dc_id').html(res);
				}																
			}
		});
	}else {
		$('#dc_id').val('').trigger('change')
	}
}

$(document).ready(function(){


	$("#state").change(function(){

		$stsval = $(this).val(); 
		//console.log($stsval);
		$stsval = $stsval.join();
		$.ajax({
			url : URL+'user/user/getBranchList',
			method : 'post',
			data : {'state_id':$stsval,'csrf_test_name':csrf_token},
			dataType : 'html',
			success : function(res){				
				$('#welnext_branch').html(res);
			},
		});
	});


	$(document).on('change','#role_id',function(){
		var role_id = $('#role_id').val();
		
		$('#ubonaRegSec').hide();
		$("#ubonaRegistration").prop('checked',false);

		if(role_id == ''){
			$('#subrole_id').html('<option value="">Select Sub Role</option>');
		}
		if(role_id == 1){
			$('#dc').show();
		} else if(role_id == 2){
			$("#ic_id").removeAttr('multiple');
		}else if(role_id == 3){
			$("#ic_id").attr('multiple','multiple');
			$('#dc').hide();
			$('#ubonaRegSec').show();
		}else{		
			$('#dc').hide();
			$('#dc_id').val('').trigger('change');
		}
		if(role_id !=''){
			$.ajax({
				url : URL+'getSubrole',
				method : 'post',
				data : {role_id:role_id,'csrf_test_name':csrf_token},
				dataType : 'json',
				success : function(res){				
					if(res['status'] =='success'){
						$('#subrole_id').html(res['option']);
						getDignosticCente();
					}else{
						$('#subrole_id').html('');
					}
				},
			});
		}
	});

	$(document).on('change','#state',function(){
		getDignosticCente();
	});

	$(document).on('change keyup','#role_id',function(){
		$('#role_id_error').html('');			
	});

	$(document).on('change keyup','#subrole',function(){
		$('#subrole_error').html('');
	});

	$(document).on('change keyup','#welnext_branch',function(){
		$('#welBranch_error').html('');
	});

	$(document).on('change keyup','#welnext_state',function(){
		$('#welnext_state_error').html('');
	});

	$(document).on('change keyup','#ic_id',function(){
		$('#ic_error').html('');
	});

	$(document).on('change keyup','#business_channel',function(){
		$('#business_channel_error').html('');
	});

	$(document).on('keyup','#contact',function(){
		$('#contact_error').html('');
	});

	$(document).on('keyup','#name',function(){
		$('#name_error').html('');
	});

	$(document).on('keyup','#email',function(){
		$('#email_error').html('');
	});

	$(document).on('change keyup','#status',function(){
		$('#status_error').html('');
	});
	$('#joiningdate').datetimepicker({
		format:'DD/MM/YYYY'  	
        /*format:'DD/MM/YYYY hh:mm A', 
        minDate: moment()*/
    });
    $('#relievingdate').datetimepicker({    	
    	format:'DD/MM/YYYY'
        /*format:'DD/MM/YYYY hh:mm A', 
        minDate: moment()*/
     });

	function Role_validate(){
		var role_id = $('#role_id').val();
		var subrole_id = $('#subrole_id').val();
		var contact = $('#contact').val();
		var status = $('#status').val();
		var branch = $("#branch :selected").length;
		var state = $("#state :selected").length;
		var ic_id = $("#ic_id :selected").length;
		var business_channel = $("#business_channel :selected").length;
		var name = $('#name').val();
		var email = $('#email').val();
		
		if(role_id == ''){
			$('#role_id_error').html('Select Role');
			return false;
		}

		if(subrole_id == ''){
			$('#subrole_error').html('Select SubRole');
			return false;
		}

		if(contact == ''){
			$('#contact_error').html('Enter Contact');
			return false;
		}

		if(status == ''){
			$('#status_error').html('Select Status');
			return false;
		}

		if(state == 0 || state < 0){
			$('#welnext_state_error').html('Select State');
	    	return false;
		}

		if(branch == 0 || branch < 0){
		 	$('#welBranch_error').html('Select WelNext Branch');
	    	return false;
		}


		if(name == ''){
			$('#name_error').html('Enter Name');
			return false;
		}

		if(email == ''){
			$('#email_error').html('Enter Email');
			return false;
		}

		return true;
	}

	$('#saveUser').click(function(){
		var formdata = $("#userList_validate input, select").serialize();
		var valid = Role_validate();
		if(valid == true){
			$.ajax({
				url:URL+'submitForm',
				method:'post',
				data:{formdata:formdata,'csrf_test_name':csrf_token},
				dataType:'json',
				success:function(res){
					console.log(res);
					if(res['success'] == "1"){
						$("#msgheader").html("<font style='color:green'><b>Success</b></font>");
						$("#msgdiplay").html("<font style='color:green'>"+res['msg']+"</font>");
						$("#openconfirmationmodel").trigger('click');
						setTimeout(function(){
							$(".se-pre-con").fadeOut("slow");
							window.location = URL+"user-list";
						},2000);
					}else{	
						$(".se-pre-con").fadeOut("slow");
						$("#msgheader").html("<font style='color:red'><b>Fail</b></font>");
						$("#msgdiplay").html("<font style='color:red'>"+res['msg']+"</font>");
						$("#openconfirmationmodel").trigger('click');
						return false;
					}
				},
			});
		}
	});
});
</script>	
