<?php 
//echo"<pre>";print_r($users[0]['role_id']);exit;
?>
<style type="text/css">
.select2-selection--multiple .select2-selection__rendered { 
   max-height: 100px !important; overflow-y: auto !important;
}
</style>
<div class="content-wrapper" style="min-height: 901px;">
<section class="content">
<div class="row">
	<div class="col-sx-7" style="top: -10px;margin: 0em 0em 0em 0.5em;font-size: 15px;font-weight: 600;">
    	<a href="<?php echo URL.'home'?>">Home</a> &raquo; User Management &raquo; <a href="<?php echo URL.'user-list'?>">User List </a> &raquo; Edit User Profile
    </div>
	<div class="col-xs-12">
         <div class="box">			
			<div class="box-body">
				<?php echo form_open(base_url(), array("class"=>"form-horizontal", "id"=>"userList_validate", "method"=>"post")); 

					$userid = $this->session->userdata('user_id');
					$users_id = '';
					$sel ="";
					if(isset($users) && !empty($users)){
						$users_id = $users[0]['user_id'];
					}
				?>
					<input type="hidden" id="user_id" name="user_id" value="<?php echo $users_id;?>">
				
					<div class="row">
					
					
						<div class="col-md-3">
							<label for="name" class="control-label">Role</label>
							<select class="form-control"  id="role_id" name="role_id">
								<option value="">Select Role</option>
								<?php 
									$roleID = $users[0]['role_id'];
									if(isset($role) && !empty($role) && $role !=''){
									foreach ($role as $roleKey => $roleVal) {
									if($roleID==$roleVal['role_id']){$sel='selected';} else{$sel='';}
								?>
									<option value="<?php echo $roleVal['role_id'];?>" <?php echo $sel;?>><?php echo $roleVal['name'];?></option>	
								<?php }	} ?>												
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
									$parent_id =  $users[0]['parent_id'];
									if(!empty($reporting_person) &&  $reporting_person !=false){
										foreach ($reporting_person as $RPkey => $RPvalue) {
											if($parent_id ==$RPvalue["user_id"]){
												echo '<option value="'.$RPvalue["user_id"].'" selected="selected">'.$RPvalue["name"].' ('.$RPvalue["subrole"].')</option>';	
											} else{
												echo '<option value="'.$RPvalue["user_id"].'">'.$RPvalue["name"].' ('.$RPvalue["subrole"].')</option>';	
											}											
										}
									}
								?>
							</select>
							<p id="subrole_error" style="color:red;"></p>
							
						</div>
						<!-- <div class="form-group col-sm-12 contact" id="contact_ic" style="display: none;"> -->
						<div class="col-md-3 contact" id="">
							<label for="contact" class="control-label">Contact</label>
							<?php 
							$contact ='';
							if(isset($users) && !empty($users)){
								$contact = gowelDcrypt($users[0]['contact']);
							}
							?>
							<input type="text" class="form-control" id="contact"  name="contact" value="<?php echo $contact;?>" placeholder="">
							<p id="contact_error" style="color:red;"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3" id="gwlempCode">
							<label class="control-label" for="gwlempid">Employee Id</label>
							<input type="text" id="gwlempid" name="gwlempid" class="form-control" value="<?php echo $users[0]['gwlempid']; ?>" > 
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
							if(isset($users) && !empty($users) && $users[0]['email'] !=""){
								$email = gowelDcrypt($users[0]['email']);
								
								if($userid !=51242){$disable = 'disabled';} else{$disable = '';}
								
							} else{
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
									//print_r($value);exit;
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
							<input type="text" id="designation" name="designation" class="form-control" value="<?php echo $users[0]['designation']; ?>" > 
						</div>								

						<div class="col-md-3">
							<label for="department" class="control-label">Department</label>
							<input type="text" class="form-control" id="department"  name="department" value="<?php echo $users[0]['department'];?>" placeholder="">
						</div>

						<div class="col-md-3">
							<label for="function" class="control-label">Function</label>
							<input type="text" class="form-control" id="function"  name="function" value="<?php echo $users[0]['function_area']; ?>" placeholder="">
							
						</div>
						<div class="col-md-3" id="user_status">
							<label for="worklocation" class="control-label">Work Location</label>
							<input type="text" class="form-control" id="worklocation"  name="worklocation" value="<?php echo $users[0]['worklocation']; ?>" placeholder="">
						</div>
					
					</div>
					<div class="row">
						<div class="col-md-3" id="state">
							<label for="welnext_state" class="control-label">State</label>
							<select class="form-control" id="welnext_state" name="welnext_state[]" style="width:100%" multiple>
								<!-- <option value="">Select Branch</option> -->
								<option value="All">All</option>
								<?php 
								if(isset($users) && !empty($users)){
									$state_id = explode(',',$users[0]['state_id']);
								} else{
									$state_id ='';
								}
								if(isset($state) && !empty($state) && $state !=''){
								foreach ($state as $stateKey => $stateVal) {
								$sel = (in_array($stateVal['state_id'], $state_id)) ? 'selected="selected"' : ''; 
								?>
								<option value="<?php echo $stateVal['state_id'];?>" <?php echo $sel;?>><?php echo $stateVal['state_name'];?></option>
								<?php }
									}
								?>
							</select>
							<p id="welnext_state_error" style="color:red;"></p>
							
						</div>							
				
						<div class="col-md-3" id="">
							<label for="welnext_branch" class="control-label">Welnext Branch</label>
																	
							<select class="form-control welnext_branch"  id="welnext_branch" name="welnext_branch[]" style="width:100%;" multiple>
								<option value="All">All</option>
								<?php 
								if(isset($users) && !empty($users)){
									$branch_name = explode(',',$users[0]['branch']);
								} else{
									$branch_name ='';
								}

								if(isset($branch) && !empty($branch) && $branch !=''){
								foreach ($branch as $WBkey => $WBvalue) { 
								$sel = in_array($WBvalue['branch_name'],$branch_name) ? 'selected="selected"' : '' ;

								?>
								<option value="<?php echo $WBvalue['branch_name'];?>" <?php echo $sel;?>><?php echo $WBvalue['branch_name'];?></option>
								<?php }
									}
								?>
							</select>
							<p id="welBranch_error" style="color:red;"></p>
						</div>

						<div class="col-md-3" id="ic1">
							<label class="control-label" for="ic">Insurance Company</label>
							<select id="ic_id" name="ic_id[]" class="form-control insurance_company" <?php if($roleID!=2){echo 'multiple';}?> >
								<!-- <option value="All">All</option> -->
								<?php 
								if(isset($users) && !empty($users)){
									$ic_ic = explode(',',$users[0]['ic_id']);
								} else{
									$ic_ic ='';
								}

								if(isset($ic) && !empty($ic) && $ic !=''){
								foreach ($ic as $icKey => $icVal) {
									if(in_array($icVal['ic_id'], $ic_ic)){$sel ='selected';} else{$sel ='';}		
								?>
								<option value="<?php echo $icVal['ic_id'];?>" <?php echo $sel;?>><?php echo $icVal['name'];?></option>
								<?php }
									}
								?>
							</select>
							<p id="ic_error" style="color:red;"></p>
						</div>

						<div class="col-md-3" id="b_channel" >
							<label for="b_channel" class="control-label">Business Channel</label>								
							<select class="form-control" id="business_channel" name="business_channel[]" multiple>
								<option value="All">All</option>
								<?php 
									$bc_array = str_replace("'", '', $users[0]['business_channel']);
									$bChannel = explode(',',$bc_array);
									if(!empty($business_channel) && $business_channel !="NA" ){
										foreach ($business_channel as $key => $bcvalue) {
											$sel = in_array($bcvalue,$bChannel,TRUE) ? 'selected="selected"' : '' ;
											echo '<option value="'.$bcvalue.'" '.$sel.'>'.$bcvalue.'</option>';
										}
									}
								?>									
							</select>
							<p id="business_channel_error" style="color:red;"></p>
						</div>
					</div>
					<div class="row">
						<?php 
							$usertype = ['ICUSER','SUPERADMIN'];							
							if(!empty($users) && in_array($users[0]['user_type'],$usertype)){ 
								$hidden ='hidden';
							} else{
								$hidden ='';
							}
						?>

							
						<div class="col-md-3" id="dc" <?php echo $hidden;?>>
							<label class="control-label" for="dc">Diagnostic Center</label>
							<select id="dc_id" name="dc_id" class="form-control" style="width: 100%">
								<option value="">Select Diagnostic Center</option>
							<?php 
							if(isset($seldc) && $seldc !=''){
							$seldc = $seldc[0]['dc_id'];
							if(!empty($statewisedc) && $statewisedc !=''){
							foreach ($statewisedc as $dckey => $dcvalue) {
							if($seldc == $dcvalue['dc_id']){ $select ='selected'; } else{ $select ='';} ?>
								<option value="<?php echo $dcvalue['dc_id'];?>" <?php echo $select ;?>><?php echo $dcvalue['center_name'];?></option>
							<?php }	} }?>
							</select>
							<p id="dc_id_error" style="color:red;"></p>
						</div>

						<div class="col-md-3">
							<label class="control-label" for="mfa">MFA</label>
							<select id="mfa_status" name="mfa_status" class="form-control" style="width: 100%">
								<?php $mfa_status = $users[0]['mfa_status']; ?>
								<option value="InActive" <?php echo $mfa_status =='InActive'?'selected':'';?> >InActive</option>
								<option value="Active" <?php echo $mfa_status =='Active'?'selected':'';?>>Active</option> 
							</select><p id="mfa_status_error" style="color:red;"></p>
						</div>
						<div class="col-md-3">
							<label class="control-label" for="outbound_call">Outbound call Access</label>
							<select id="outbound_call" name="outbound_call" class="form-control" style="width: 100%">
								<option value="YES" <?php echo $users[0]['outbound_call']=="YES"?"selected":""; ?> >YES</option>
								<option value="NO" <?php echo $users[0]['outbound_call']=="NO"?"selected":""; ?>>NO</option>
							</select><p id="outbound_call_error" style="color:red;"></p>
						</div>
						<div class="col-md-3">
							<label class="control-label" for="inbound_call">Inbound call Access</label>
							<select id="inbound_call" name="inbound_call" class="form-control" style="width: 100%">
								<option value="NO" <?php echo $users[0]['inbound_call']=="YES"?"selected":""; ?>>NO</option>
								<option value="YES" <?php echo $users[0]['inbound_call']=="YES"?"selected":""; ?> >YES</option>																			 
							</select><p id="inbound_call_error" style="color:red;"></p>
						</div>
						<div class="col-md-3">
							<label class="control-label" for="agent_campaign_id">Agent Campaign Id</label>
							<input type="text" id="agent_campaign_id" name="agent_campaign_id" class="form-control" value="<?php echo $users[0]['agent_campaign_id'] ; ?>">
							<p id="agent_campaign_id_error" style="color:red;"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label>MER Type</label>
							<select class="form-control" id="mer_type_id" name="mer_type_id[]" multiple="">
								<option value="All">All</option>
								<?php 
									$existMerT = explode(',', $users[0]['mer_type_id']);
									if(!empty($mer_types) && $mer_types !=false){
										foreach ($mer_types as $MTkey => $MTvalue) {
											$mer_id = $MTvalue["mer_id"];
											if(in_array($mer_id, $existMerT)){$selectmet ="selected"; } else{$selectmet =""; }
											echo '<option value="'.$mer_id.'" '.$selectmet.'> '.$MTvalue["mer_type"].'</option>';	
										}									
									}
								?>
							</select><p id="mer_type_id_error" style="color:red;"></p>
						</div>
						<div class="col-md-3">
							<label class="control-label" for="joiningdate">Joining date</label>
							 <div class="input-group date" id="joiningdate">
							 	<?php 
							 	if(isset($users[0]['joining_date_time']) && $users[0]['joining_date_time'] !=''){ 
							 		$dateJ = date('d/m/Y', strtotime($users[0]['joining_date_time']));
							 	}else{
							 		$dateJ =  '';
							 	} ?>
								<input type='text' class="form-control" id="joining_date_time" value="<?php echo $dateJ;?>" name="joining_date_time" autocomplete="off" />
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> 
                             </div>
						</div>
						<div class="col-md-3">
							<label for="relievingdate" class="control-label">Relieving Date</label>
							 <div class="input-group date" id="relievingdate">
							 	<?php 
							 	if(isset($users[0]['relieving_date_time']) && $users[0]['relieving_date_time'] !=''){ 
							 		$dateR = date('d/m/Y', strtotime($users[0]['relieving_date_time']));
							 	}else{
							 		$dateR =  '';
							 	} ?>
                                <input type='text' class="form-control" id="relieving_date_time" value="<?php echo $dateR;?>" name="relieving_date_time" autocomplete="off" />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> 
                            </div>
						</div>
						<div class="col-md-3">
							<label>Login Password</label>
							<input type="text" name="lpassword" id="lpassword" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label for="fpbx_caller_id" class="control-label">FPBX Caller ID</label>
							<input type="text" class="form-control" id="fpbx_caller_id"  name="fpbx_caller_id" value="<?php echo $users[0]['fpbx_caller_id']; ?>" placeholder="Internation Caller ID">
						</div>
						<div class="col-md-6" id="ubonaRegSec" <?php if($users[0]['role_id'] !=3){ echo "style='display:none;'";} ?>>
							<label style="margin-top: 20px;"><input type="checkbox" id="ubonaRegistration" name="ubonaRegistration" >  Do you want to update with Ubona Dashboard? </label>							
						</div>
					</div>
					<?php if($users[0]['subrole_id'] ==15){ $style = "style='display:block;'"; } else{$style = "style='display:none;'";} ?>
					<div class="row" <?php echo $style; ?>>
						<div class="col-md-6">
							<label>Doctor Video Link</label>
							<input type="text" name="DoctorVideoLink" class="form-control" id="DoctorVideoLink">
						</div>
						<div class="col-md-6">
							<label>Customer Video Link</label>
							<input type="text" name="customerVideoLink" class="form-control" id="customerVideoLink">
						</div>
						<span id="DoctorVideoLink_error" style="color:red;"></span>
					</div>

							
					<div class="row">
						<div class="col-md-12 form-group">
							<div class="box-footer" style="text-align:center;" >
								<button type="button" class="btn btn-primary" id="saveUser" style="margin:0 auto;">Save</button>
							</div>
						</div>
					</div>
				<!-- </form> -->
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>
</div>
<script>
var URL = "<?php echo URL;?>";
function getSubroles(role_id,subrole_id){
	if(role_id !=''){
		$.ajax({
			url : URL+'getSubrole',
			method : 'post',
			data : {role_id:role_id,subrole_id:subrole_id,'csrf_test_name':csrf_token},
			dataType : 'json',
			success : function(res){				
				if(res['status'] =='success'){
					$('#subrole_id').html(res['option']);
				}
			},
		});
	}
}

function getDignosticCente(){
	var role_id = $('#role_id').val();
	var stateData = $('#welnext_state').val();
	if(stateData !='' && stateData !='null' && role_id ==1){
		$.ajax({
			url : URL+'getAllDCNameList',
			method : 'post',
			dataType : 'html',
			data: {stateData:stateData,'csrf_test_name':csrf_token},//,'csrf_test_name':csrf_token
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
<?php if(is_array($users) && !empty($users)) { ?>
	var role_id ="<?php echo $users[0]['role_id'];?>";
	var subrole_id ="<?php echo $users[0]['subrole_id']?>";
	getSubroles(role_id,subrole_id)	 
<?php } ?>

$("#welnext_state").change(function(){

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


$(document).on('change','#role_id', function(){
	var role_id = $('#role_id').val();
	
	$('#ubonaRegSec').hide();
	$('#ubonaRegistration').prop('checked',false);

	if(role_id == ''){
		$('#subrole_id').html('<option value="">Select Sub Role</option>');
	}
	if(role_id == 1){
		$('#dc').show();				
	}else if(role_id == 2){
		$("#ic_id").removeAttr('multiple');
	}else if(role_id == 3){
		$("#ic_id").attr('multiple','multiple');
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
				}
			},
		});
	}
});

$(document).on('change','#welnext_state',function(){
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
        	//minDate: moment()    	
 });
 $('#relievingdate').datetimepicker({    	
       format:'DD/MM/YYYY'
        	//minDate: moment()    	
 });

function Role_validate(){
	var role_id = $('#role_id').val();
	var subrole_id = $('#subrole_id').val();
	var contact = $('#contact').val();
	var name = $('#name').val();
	var email = $('#email').val();
	var status = $('#status').val();
	var welnext_branch = $("#welnext_branch :selected").length;
	var welnext_state = $("#welnext_state :selected").length;
	var ic_id = $("#ic_id :selected").length;
	var business_channel = $("#business_channel :selected").length;
	if(role_id == ''){
		$('#role_id_error').html('Select Role');
		return false;
	}

	if(subrole_id == ''){
		$('#subrole_error').html('Select SubRole');
		return false;
	}

	if(subrole_id !='' && subrole_id =='15'){
		 
		$docvlink = $("#DoctorVideoLink").val();
		$Custcvlink = $("#customerVideoLink").val();
		/*if($docvlink =="" || $Custcvlink ==""){
			$('#DoctorVideoLink_error').html('Enter Doctor & Customer Video Link');
				return false;
		}*/
	}

	if(contact == ''){
		$('#contact_error').html('Enter Contact');
		return false;
	}

	if(status == ''){
		$('#status_error').html('Select Status');
		return false;
	}

	if(welnext_state == 0 || welnext_state < 0){
		$('#welnext_state_error').html('Select State');
    	return false;
	}

	if(welnext_branch == 0 || welnext_branch < 0){
	 	$('#welBranch_error').html('Select WelNext Branch');
    	return false;
	}

	if(ic_id == 0 || ic_id < 0){
		$('#ic_error').html('Select Insurance Company');
    	return false;
	}
	if(business_channel == 0 || business_channel < 0){
		$('#business_channel_error').html('Select Business Channel');
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
	//var user_id = $('#user_id').val();
	var formdata = $("#userList_validate input, select").serialize();
	var valid = Role_validate();
	//if(role_id !=''){
	if(valid == true){
		$.ajax({
			url:URL+'submitForm',
			method:'post',
			data:{formdata:formdata,'csrf_test_name':csrf_token},
			//data:{role_id:role_id,subrole_id:subrole_id,contact:contact,dc_id:dc_id,name:name,email:email,welnext_branch:welnext_branch,welnext_state:welnext_state,ic_id:ic_id,business_channel:business_channel,status:status},
			dataType:'json',
			success:function(res){
				console.log(res);
				if(res['success'] == "1"){
					$("#msgheader").html("<font style='color:green'><b>Success</b></font>");
					$("#msgdiplay").html("<font style='color:green'>"+res['msg']+"</font>");
					$("#openconfirmationmodel").trigger('click');
					setTimeout(function(){
						$(".se-pre-con").fadeOut("slow");
						// window.location = URL+"user-list";
						location.reload()
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
