<?php 
	//echo"<pre>";print_r($doc_quali);exit;
?>
<style>
.select2-selection--multiple .select2-selection__rendered { 
   max-height: 50px !important; overflow-y: auto !important;
}
.formFieldHeight{
    background: #dfeef7;
    padding: 5px 15px 5px 10px;
    border-radius: 5px;
    border: 1px solid #a8b0b7;
    margin-bottom: 7px;
}
</style>
<div class="content-wrapper" style="min-height: 901px;">
<section class="content">
<div class="row">
	<div style="padding : 0px 10px;">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Add Doctor</h3>
			</div>
			<div class="box-body" style="height: 100%;">
				<!-- <form action="<?php //echo URL.'submitForm';?>" method="post" class="form-horizontal" id="userList_validate"> -->
				<?php echo form_open(URL.'addDoctor', array("class"=>"form-horizontal", "id"=>"doctorValidate", "method"=>"post","enctype"=>"multipart/form-data")); ?>
					<div class="col-sm-12">
						<div class="formFieldHeight">
							<label for="name" class="control-label">Doctor Role</label>
							<div class="row">
								<div class="col-md-3">
									<label for="name" class="control-label">Role <span style="color: red">*</span></label>
									<select class="form-control"  id="role_id" name="role_id">
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
									<label for="name" class="control-label">Sub Role <span style="color: red">*</span></label>
									<select class="form-control"  id="subrole_id" name="subrole_id">
										<option value="">Select Sub Role</option>
									</select>
									<p id="subrole_error" style="color:red;"></p>								
								</div>
								<div class="col-md-3">
									<label for="parent_id" class="control-label">Reporting Person<span style="color: red">*</span></label>
									<select class="form-control"  id="parent_id" name="parent_id">
										<option value="">Select</option>
										<?php 
											if (!empty($reporting_person)) {
												foreach($reporting_person as $rp => $rpval){
													echo '<option value="'.$rpval['user_id'].'">'.$rpval['name'].'('.$rpval['subrole'].')'.'</option>';
												}
											}
										?>
									</select>
									<p id="parent_id_error" style="color:red;"></p>								
								</div>

								<div class="col-sm-3">
									<label for="doc_type" class="control-label">Doctor MER Type Priority1 <span style="color: red">*</span></label>
									<select id="doc_type" name="doc_type[]" class="form-control" style="width: 100%" multiple>
										<option value="">Select Doctor Type</option>
										<?php 
											$mtypes = getMERTypes();
											if (!empty($mtypes) && $mtypes !=false) {
												foreach ($mtypes as $MERkey => $MERvalue) {
													echo '<option value="'.$MERvalue['mer_type'].'" >'.$MERvalue['mer_type'].'</option>';
												}
											} 
											?>
									</select>
									<p id="dc_id_error" style="color:red;"></p>
								</div>

							</div>

							<div class="row">

								<div class="col-sm-3">
									<label for="doc_type_priority2" class="control-label">Doctor MER Type Priority2</label>
									<select id="doc_type_priority2" name="doc_type_priority2[]" class="form-control" style="width: 100%" multiple>
										<option value="">Select Doctor Type</option>
										<?php 
											$mtypes = getMERTypes();
											if (!empty($mtypes) && $mtypes !=false) {
												foreach ($mtypes as $MERkey => $MERvalue) {
													echo '<option value="'.$MERvalue['mer_type'].'" >'.$MERvalue['mer_type'].'</option>';
												}
											} 
											?>
									</select>
									<p id="dc_id_error" style="color:red;"></p>
								</div>


								<div class="col-md-3" id="ic1">
									<label class="control-label" for="ic">Insurance Company <span style="color: red">*</span></label>
									<select id="ic_id" name="ic_id[]" class="form-control insurance_company" multiple>
										<!-- <option value="All">All</option> -->
										<?php 
										if(isset($ic) && !empty($ic) && $ic !=''){
										foreach ($ic as $icKey => $icVal) {
										?>
										<option value="<?php echo $icVal['ic_id'];?>"><?php echo $icVal['name'];?></option>
										<?php }
											}
										?>
									</select>
									<p id="ic_error" style="color:red;"></p>
								</div>
								<div class="col-md-3" id="user_status">
									<label for="status" class="control-label">Status <span style="color: red">*</span></label>
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
										<?php }	} ?>												
									</select>
									<p id="status_error" style="color:red;"></p>
								</div>

								<div class="col-md-3" id="doctor_url">
									<label for="status" class="control-label">Doctor Video URL <span style="color: red">*</span></label>
									<input type="text" class="form-control" id="dr_url" name="dr_url">
									<p id="dr_url_error" style="color:red;"></p>
								</div>

							</div>
							<div class="row">

								<div class="col-md-3" id="doctor_url">
									<label for="status" class="control-label">Customer Video URL <span style="color: red">*</span></label>
									<input type="text" class="form-control" id="customer_url" name="customer_url">
									<p id="customer_url_error" style="color:red;"></p>
								</div>
							
								<div class="col-md-3">
									<label class="control-label" for="outboundCall">Outbound call Access</label>
									<select id="outboundCall" name="outboundCall" class="form-control" style="width: 100%">
										<option value="YES">YES</option>
										<option value="NO">NO</option>									 
									</select>
									<p id="ic_error" style="color:red;"></p>
								</div>
								<div class="col-md-3">
									<label for="inboundCall" class="control-label">Inbound call Access</label>
									<select id="inboundCall" name="inboundCall" class="form-control" style="width: 100%">
										<option value="NO">NO</option>
										<option value="YES">YES</option> 
									</select>
									<p id="status_error" style="color:red;"></p>
								</div>

								<div class="col-md-3">
									<label for="agentCampaignId" class="control-label">Agent Campaign Id <span style="color: red">*</span></label>
									<input type="text" id="agentCampaignId" name="agentCampaignId" class="form-control">
									<p id="dr_url_error" style="color:red;"></p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="status" class="control-label">FPBX Caller ID</label>
									<input type="text" class="form-control" id="fpbx_caller_id"  name="fpbx_caller_id" value="" placeholder="International Caller ID">
								</div>

							</div>
						</div>						
					</div>
					
					<div class="col-sm-12">
						<div class="formFieldHeight">
							<label class="control-label" for="ic">Doctor Profile</label>
							<div class="row">
								<div class="col-md-3">
									<label for="doc_name" class="control-label">Doctor Name <span style="color: red">*</span></label>
									<input type="text" class="form-control" id="doc_name"  name="doc_name" value="" placeholder="">
									<p id="name_error" style="color:red;"></p>
								</div>

								<div class="col-md-3">
									<label for="email" class="control-label">Email/Username <span style="color: red">*</span></label>
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

								<div class="col-md-3 contact" id="">
									<label for="doc_contact" class="control-label">Doctor Contact <span style="color: red">*</span></label>
									<input type="text" class="form-control" id="doc_contact" name="doc_contact" value="" placeholder="">
									<p id="doc_contact_error" style="color:red;"></p>
								</div>

								<div class="col-md-3 contact" id="">
									<label for="alt_contact" class="control-label">Alternate Contact No.</label>
									<input type="text" class="form-control" id="alt_contact" name="alt_contact" value="" placeholder="">
									<p id="contact_error" style="color:red;"></p>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3">
									<label for="doc_lang" class="control-label">Doctor Language <span style="color: red">*</span></label>
									<select id="doc_lang" name="doc_lang[]" class="form-control" multiple>
										<option value="">Select Doctor Language</option>
										<?php 
										if(isset($doc_language) && $doc_language !=''){
										foreach ($doc_language as $key => $value) {?>
											<option value="<?php echo $value['lang_id'];?>"><?php echo $value['lang_name'];?></option>
										<?php }	} ?>
									</select>
									<p id="dc_id_error" style="color:red;"></p>
								</div>														

								<div class="col-sm-3">
									<label for="doc_qualification" class="control-label">Doctor Qualification <span style="color: red">*</span></label>
									<select id="doc_qualification" name="doc_qualification[]" class="form-control" style="width: 100%" multiple>
										<option value="">Select Doctor Qualification</option>
										
										<?php 
											if(isset($doc_quali) && $doc_quali !=''){
												foreach ($doc_quali as $key => $value) {
													echo '<option value="'.$value['edu_id'].'">'.$value['qualification'].'</option>';
												}	
											}
										?>
									</select>
									<p id="dc_id_error" style="color:red;"></p>
								</div>

								<div class="col-sm-3">
									<label for="doc_regn_no" class="control-label">Doctor Registration No <span style="color: red">*</span></label>
									<input type="text" id="doc_regn_no" name="doc_regn_no" class="form-control">
									<p id="dc_id_error" style="color:red;"></p>
								</div>

								<div class="col-sm-3">
									<label for="drPanCard" class="control-label">Doctor Pan Card</label>
									<input type="text" id="drPanCard" name="drPanCard" class="form-control">
									<p id="dc_id_error" style="color:red;"></p>
								</div>
								
							</div>

							<div class="row">
								<div class="col-sm-3">
									<label for="doc_address" class="control-label">Doctor Address</label>
									<input type="text" id="doc_address" name="doc_address" class="form-control">
									<p id="dc_id_error" style="color:red;"></p>
								</div>

								<div class="col-sm-3">
									<label for="doc_area" class="control-label">Doctor Area</label>
									<input type="text" id="doc_area" name="doc_area" class="form-control">
									<p id="dc_id_error" style="color:red;"></p>
								</div>

								<div class="col-md-3" id="state">
									<label for="welnext_state" class="control-label">State <span style="color: red">*</span></label>
									<select class="form-control" id="welnext_state" name="welnext_state" style="width:100%">
										<option value="">Select State</option>
										<?php 
											if(isset($state) && !empty($state) && $state !=''){
											foreach ($state as $stateKey => $stateVal) {									
										?>
										<option value="<?php echo $stateVal['state_id'];?>"><?php echo $stateVal['state_name'];?></option>
										<?php }
											}
										?>
									</select>
									<p id="welnext_state_error" style="color:red;"></p>
									
								</div>

								<div class="col-md-3" id="state">
									<label for="doc_city" class="control-label">City <span style="color: red">*</span></label>
									<select class="form-control" id="doc_city" name="doc_city">
										<option value="">Select City</option>
									</select>
									<p id="welnext_state_error" style="color:red;"></p>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="doc_digi_sign" class="control-label">Doctor Digital Signature <span style="color: red">*</span></label>
									<input type="file" class="form-control" name="doc_digi_sign" id="doc_digi_sign">
								</div>

								<div class="col-md-3">
									<label for="doc_profile_pic" class="control-label">Doctor Profile Pic <span style="color: red">*</span></label>
									<input type="file" class="form-control" name="doc_profile_pic" id="doc_profile_pic">
								</div>

								<div class="col-md-3">
									<label for="drPanCardCert" class="control-label">Doctor Pan Certificate</label>
									<input type="file" class="form-control" name="drPanCardCert" id="drPanCardCert">
								</div>

								<div class="col-md-3">
									<label for="drCancelledCheque" class="control-label">Doctor Cancelled Cheque</label>
									<input type="file" class="form-control" name="drCancelledCheque" id="drCancelledCheque">
								</div>

							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="drRegnCertificate" class="control-label">Doctor Regn Certificate</label>
									<input type="file" class="form-control" name="drRegnCertificate" id="drRegnCertificate">
								</div>

								<div class="col-md-3">
									<label for="drKYCRegistration" class="control-label">Doctor KYC Registration</label>
									<input type="file" class="form-control" name="drKYCRegistration" id="drKYCRegistration">
								</div>

								<div class="col-md-3">
									<label for="drBankDeclaration" class="control-label">Doctor Bank Declaration</label>
									<input type="file" class="form-control" name="drBankDeclaration" id="drBankDeclaration">
								</div>

								<div class="col-md-3">
									<label for="drPANDeclaration" class="control-label">Doctor PAN Declaration</label>
									<input type="file" class="form-control" name="drPANDeclaration" id="drPANDeclaration">
								</div>

							</div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="formFieldHeight"> 
							<label for="inputAddress" class="lableFontSize">Bank Details</label>
							<div class="row">
								<div class="col-md-3" id="user_status">
									<label for="accountNo" class="control-label">Account Number</label>
									<input type="text" class="form-control" id="accountNo" name="accountNo">
								</div>

								<div class="col-md-3">
									<label for="bankName" class="control-label">Bank Name</label>
									<input type="text" name="bankName" id="bankName" class="form-control">
								</div>

								<div class="col-md-3">
									<label for="acccountHolderName" class="control-label">Account Holder Name</label>
									<input type="text" class="form-control" name="acccountHolderName" id="acccountHolderName">
								</div>

								<div class="col-md-3">
									<label for="bankBranch" class="control-label">Bank Branch</label>
									<input type="text" class="form-control" name="bankBranch" id="bankBranch">
								</div>								
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="IFSCCode" class="control-label">IFSC Code</label>
									<input type="text" class="form-control" name="IFSCCode" id="IFSCCode">
								</div>
								<div class="col-md-3">
									<label for="teleRate" class="control-label">Tele MER Rate</label>
									<input type="text" class="form-control" name="teleRate" id="teleRate">
								</div>
								<div class="col-md-3">
									<label for="videoRate" class="control-label">Video MER Rate</label>
									<input type="text" class="form-control" name="videoRate" id="videoRate">
								</div>

								<div class="col-md-3">
									<label for="doc_remark" class="control-label">Doctor Remark</label>
									<textarea class="form-control" rows="2" name="doc_remark" id="doc_remark"></textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<?php 
							$usertype = ['ICUSER','SUPERADMIN'];
							if(!empty($users) && in_array($users[0]['user_type'],$usertype)){$hidden ='hidden';} else{$hidden ='';} ?>
							<div class="col-md-3" id="dc" <?php echo $hidden;?> style="display: none;">
								<label class="control-label" for="dc">Diagnostic Center</label>
								<select id="dc_id" name="dc_id" class="form-control" style="width: 100%">
									<option value="">Select Diagnostic Center</option>
									<?php 
									if(isset($statewisedc) && $statewisedc !=''){
										foreach ($statewisedc as $dckey => $dcvalue) { ?>
									<option value="<?php echo $dcvalue['dc_id']?>"><?php echo $dcvalue['center_name'];?></option>
									<?php } } ?>
								</select>
								<p id="dc_id_error" style="color:red;"></p>
							</div>
						</div>
					</div>														

					<div class="col-md-12">
						<div class="box-footer" style="text-align:center;" >
							<button type="submit" class="btn btn-primary" id="saveDoctor" style="margin:0 auto;">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="<?php echo URL.'user';?>" class="btn btn-primary" style="margin:0 auto;">Cancel</a>
						</div>
					</div>				
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>
</div>
<script>
var URL = "<?php echo URL;?>";

function getDignosticCente(){
	var role_id = $('#role_id').val();
	var stateData = $('#welnext_state').val();
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
	$(document).on('change','#role_id',function(){
		var role_id = $('#role_id').val();
		if(role_id == ''){
			$('#subrole_id').html('<option value="">Select Sub Role</option>');
		}
		if(role_id == 1){
			$('#dc').show();				
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

	$(document).on('change','#welnext_state',function(){
		var stateID = $(this).val();
		if(stateID ==''){
			$('#doc_city').html('<option value="">Select City</option>');
		}
		if(stateID !=''){
			$.ajax({
				url : URL+'getCities',
				method : 'post',
				data : {stateID:stateID,'csrf_test_name':csrf_token},
				dataType : 'html',
				success : function(res){
					if(res !=''){
						$('#doc_city').html(res);
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

	function Role_validate(){
		var role_id = $('#role_id').val();
		var subrole_id = $('#subrole_id').val();
		var contact = $('#contact').val();
		var status = $('#status').val();		
		var welnext_state = $("#welnext_state").val();
		//var welnext_state = $("#welnext_state :selected").length;
		var ic_id = $("#ic_id :selected").length;
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

		/*if(welnext_state == 0 || welnext_state < 0){
			$('#welnext_state_error').html('Select State');
	    	return false;
		}*/
		if(welnext_state == ''){
			$('#welnext_state_error').html('Select State');
	    	return false;
		}

		if(ic_id == 0 || ic_id < 0){
			$('#ic_error').html('Select Insurance Company');
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

	/*$('#saveDoctor').click(function(){
		var formdata = $("#doctorValidate input, select").serialize();
		var valid = Role_validate();
		if(valid == true){
			$.ajax({
				url:URL+'addDoctor',
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
	});*/
});
</script>	
