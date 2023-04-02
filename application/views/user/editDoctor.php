<?php 
	/*echo"<pre>";print_r($users);
	echo"<br>";*/
	/*$dd = gowelnextDcrypt($doctorProfile[0]['dr_pan_no']);
	echo"<pre>";
	print_r($dd);
	print_r($doctorProfile);
	exit;*/
?>
<style>
.select2-selection--multiple .select2-selection__rendered { 
   max-height: 50px !important; overflow-y: auto !important;
}
.formFieldHeight{
    background: #dfeef7;
    padding: 5px 5px 5px 5px;
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
				<h3 class="box-title">Edit Doctor Details</h3>
			</div>
			<!--div class="alert alert-danger">Under maintainance!</div-->
			<div class="box-body" style="height: 100%;">
				<!-- <form action="<?php //echo URL.'submitForm';?>" method="post" class="form-horizontal" id="userList_validate"> -->
				<?php echo form_open(URL.'#', array("class"=>"form-horizontal", "id"=>"doctorEditValidate", "method"=>"post","enctype"=>"multipart/form-data")); ?>
					
					<input type="hidden" name="user_id" id="user_id" value="<?php echo $users[0]['user_id'];?>">
					<input type="hidden" name="user_type_id" id="user_type_id" value="<?php echo $users[0]['user_type_id'];?>">
					<div class="col-sm-12">
						<div class="formFieldHeight">
							<label for="name" class="control-label">Doctor Role</label>
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
									<label for="parent_id" class="control-label">Reporting Person <span style="color: red">*</span></label>
									<select class="form-control"  id="parent_id" name="parent_id">
										<option value="">Select Sub Role</option>
										<?php 
											if (!empty($reporting_person)) {
												foreach($reporting_person as $rp => $rpval){
													$parent_id = $users[0]['parent_id'];
													if($parent_id==$rpval['user_id']) {
														echo '<option value="'.$rpval['user_id'].'" selected>'.$rpval['name'].'('.$rpval['subrole'].')'.'</option>';
													} else{
														echo '<option value="'.$rpval['user_id'].'">'.$rpval['name'].'('.$rpval['subrole'].')'.'</option>';	
													}
													
												}
											}
										?>
									</select>
									<p id="parent_id_error" style="color:red;"></p>								
								</div>

								<div class="col-sm-3">
									<label for="doc_type" class="control-label">Doctor MER Type Priority1</label>
									
									<select id="doc_type" name="dr_type[]" class="form-control" style="width: 100%" multiple>
										<option value="">Select Doctor Type</option>
										<?php 
										$mtypes = getMERTypes();
										if(isset($users) && !empty($users)){
											$drTTypeP1 = explode(',',$doctorProfile[0]['dr_type']);
										} else{
											$drTTypeP1 ='';
										}
										
										if (!empty($mtypes) && $mtypes !=false) {
											
											foreach ($mtypes as $MERkey => $MERvalue) {
												if(in_array($MERvalue['mer_type'], $drTTypeP1)){ $sel='selected'; }else{ $sel=''; }
												echo '<option value="'.$MERvalue['mer_type'].'" '.$sel.'>'.$MERvalue['mer_type'].'</option>';
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
									
									<select id="doc_type_priority2" name="dr_type_priority2[]" class="form-control" style="width: 100%" multiple>
										<option value="">Select Doctor Type</option>
										<?php 
										$mtypes = getMERTypes();
										if(isset($users) && !empty($users)){
											$drTTypeP2 = explode(',',$doctorProfile[0]['dr_type_priority2']);
										} else{
											$drTTypeP2 ='';
										}
										
										if (!empty($mtypes) && $mtypes !=false) {
											
											foreach ($mtypes as $MERkey => $MERvalue) {
												if(in_array($MERvalue['mer_type'], $drTTypeP2)){ $sel='selected'; }else{ $sel=''; }
												echo '<option value="'.$MERvalue['mer_type'].'" '.$sel.'>'.$MERvalue['mer_type'].'</option>';
											}
										}
										?>
										
									</select>
									<p id="dc_id_error" style="color:red;"></p>
								</div>	
								<div class="col-md-3" id="ic1">
									<label class="control-label" for="ic">Insurance Company</label>
									<select id="ic_id" name="ic_id[]" class="form-control insurance_company" multiple>
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
										<?php }	} ?>												
									</select>
									<p id="status_error" style="color:red;"></p>
								</div>						
								
								<div class="col-md-3" id="doctor_url">
									<label for="dr_url" class="control-label">Doctor Video URL <span style="color: red">*</span></label>
									<input type="text" class="form-control" id="dr_url" name="dr_url" value="<?php if(isset($doc_url[0]['video_url']) && $doc_url[0]['video_url'] !=''){echo $doc_url[0]['video_url'];}else{echo "";}?>">
									<p id="dr_url_error" style="color:red;"></p>
								</div>

								
							</div>

							<div class="row">
								<div class="col-md-3" id="doctor_url">
									<label for="customer_url" class="control-label">Customer Video URL <span style="color: red">*</span></label>
									<input type="text" class="form-control" id="customer_url" name="customer_url" value="<?php if(isset($doc_url[0]['customer_video_url']) && $doc_url[0]['customer_video_url'] !=''){echo $doc_url[0]['customer_video_url'];}else{echo "";}?>">
									<p id="customer_video_url_error" style="color:red;"></p>
								</div>
								<div class="col-md-3">
									<label class="control-label" for="outboundCall">Outbound call Access <span style="color: red">*</span></label>
									<select id="outboundCall" name="outboundCall" class="form-control" style="width: 100%">
										<option value="YES" <?php if(isset($users[0]['outbound_call']) && $users[0]['outbound_call'] =='YES'){echo "selected";} else{echo "";}?>>YES</option>
										<option value="NO" <?php if(isset($users[0]['outbound_call']) && $users[0]['outbound_call'] =='NO'){echo "selected";} else{echo "";}?>>NO</option>									 
									</select>
									<p id="ic_error" style="color:red;"></p>
								</div>
								<div class="col-md-3">
									<label for="inboundCall" class="control-label">Inbound call Access <span style="color: red">*</span></label>
									<select id="inboundCall" name="inboundCall" class="form-control" style="width: 100%">
										<option value="NO" <?php if(isset($users[0]['inbound_call']) && $users[0]['inbound_call'] =='NO'){ echo "selected"; } else{ echo "";} ?>>NO</option>
										<option value="YES" <?php if(isset($users[0]['inbound_call']) && $users[0]['inbound_call'] =='YES'){ echo "selected" ; } else{ echo "";} ?>>YES</option> 
									</select>
									<p id="status_error" style="color:red;"></p>
								</div>

								<div class="col-md-3">
									<label for="agentCampaignId" class="control-label">Agent Campaign Id</label>
									<input type="text" id="agentCampaignId" name="agentCampaignId" class="form-control" value="<?php if(isset($users[0]['agent_campaign_id']) && $users[0]['agent_campaign_id'] !=''){echo $users[0]['agent_campaign_id'];}else{echo "";}?>">
									<p id="dr_url_error" style="color:red;"></p>
								</div>

								
								
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="password" class="control-label">Login Password</label>
									<input type="text" id="lpassword" name="lpassword" class="form-control" value="">
									<p id="lpassword_error" style="color:red;"></p>
								</div>
								<div class="col-md-3">
									<label for="status" class="control-label">FPBX Caller ID</label>
									<input type="text" class="form-control" id="fpbx_caller_id"  name="fpbx_caller_id" value="<?php echo $users[0]['fpbx_caller_id'];?>" placeholder="International Caller ID">
								</div>


								<div class="col-md-3" id="doctor_url2">
									<label for="dr_url" class="control-label">Doctor Video URL-2 (KLI)<span style="color: red"></span></label>
									<input type="text" class="form-control" id="dr_url2" name="dr_url2" value="<?php if(isset($doc_url[0]['video_url2']) && $doc_url[0]['video_url2'] !=''){echo $doc_url[0]['video_url2'];}else{echo "";}?>">
									<p id="dr_url_error" style="color:red;"></p>
								</div>

								<div class="col-md-3" id="doctor_url2">
									<label for="customer_url" class="control-label">Customer Video URL-2(KLI) <span style="color: red"></span></label>
									<input type="text" class="form-control" id="customer_url2" name="customer_url2" value="<?php if(isset($doc_url[0]['customer_video_url2']) && $doc_url[0]['customer_video_url2'] !=''){echo $doc_url[0]['customer_video_url2'];}else{echo "";}?>">
									<p id="customer_video_url_error2" style="color:red;"></p>
								</div>


							</div>
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="formFieldHeight">
							<label for="name" class="control-label">Doctor Profile</label>
							<div class="row">
								<div class="col-md-3">
									<label for="doc_name" class="control-label">Doctor Name</label>
									<input type="text" class="form-control" id="doc_name"  name="dr_name" value="<?php echo $doctorProfile[0]['dr_name'];?>" placeholder="">
									<p id="name_error" style="color:red;"></p>
								</div>

								<div class="col-md-3">
									<label for="email" class="control-label">Email/Username</label>
									<?php 
									$email ='';
									if(isset($users) && !empty($users)){
										$email = gowelnextDcrypt($users[0]['email']);
										$disable = 'readonly';
									}else{
										$disable = '';
									}
									?>
									<input type="text" class="form-control" id="email"  name="email" value="<?php echo $email;?>" placeholder="" <?php //echo $disable;?>>
									<p id="email_error" style="color:red;"></p>
								</div>

								<div class="col-md-3 contact" id="">
									<label for="doc_contact" class="control-label">Doctor Contact</label>
									<input type="text" class="form-control" id="doc_contact" name="dr_contact" value="<?php echo gowelnextDcrypt($doctorProfile[0]['dr_contact']);?>" placeholder="">
									<p id="doc_contact_error" style="color:red;"></p>
								</div>

								<div class="col-md-3 contact" id="">
									<label for="alt_contact" class="control-label">Alternate Contact No.</label>
									<input type="text" class="form-control" id="alt_contact" name="dr_alt_contact" value="<?php echo gowelnextDcrypt($doctorProfile[0]['dr_alt_contact']);?>" placeholder="">
									<p id="contact_error" style="color:red;"></p>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3">
									<label for="doc_qualification" class="control-label">Doctor Qualification</label>
									<select id="doc_qualification" name="dr_qualification[]" class="form-control" style="width: 100%" multiple>
										<option value="">Select Doctor Qualification</option>
										
										<?php 
											if(isset($users) && !empty($users)){
												$drQUALI = explode(',',$doctorProfile[0]['edu_id']);
											} else{
												$drQUALI ='';
											}
											if(isset($doc_quali) && $doc_quali !=''){
												foreach ($doc_quali as $key => $value) {
													if(in_array($value['edu_id'], $drQUALI)){$sel='selected';}else{$sel='';}
													echo '<option value="'.$value['edu_id'].'" '.$sel.'>'.$value['qualification'].'</option>';
												}	
											}
										?>
									</select>
									<p id="dc_id_error" style="color:red;"></p>
								</div>

								<div class="col-sm-3">
									<label for="doc_lang" class="control-label">Doctor Language</label>
									<select id="doc_lang" name="dr_lang[]" class="form-control" multiple>
										<option value="">Select Doctor Language</option>
										<?php 
										if(isset($users) && !empty($users)){
											$drLANG = explode(',',$doctorProfile[0]['dr_lang']);
										} else{
											$drLANG ='';
										}
										if(isset($doc_language) && $doc_language !=''){
										foreach ($doc_language as $key => $value) {
											if(in_array($value['lang_id'], $drLANG)){$sel='selected';}else{$sel='';}
										?>
											<option value="<?php echo $value['lang_id'];?>" <?php echo $sel;?>><?php echo $value['lang_name'];?></option>
										<?php }	} ?>
									</select>
									<p id="dc_id_error" style="color:red;"></p>
								</div>

								<div class="col-sm-3">
									<label for="doc_regn_no" class="control-label">Doctor Registration No</label>
									<input type="text" id="doc_regn_no" name="dr_regn_no" class="form-control" value="<?php echo $doctorProfile[0]['dr_regn_no'];?>">
									<p id="dc_id_error" style="color:red;"></p>
								</div>

								<div class="col-sm-3">
									<label for="drPanCard" class="control-label">Doctor Pan Card</label>
									<input type="text" id="drPanCard" name="dr_pan_no" class="form-control" value="<?php echo gowelnextDcrypt($doctorProfile[0]['dr_pan_no']);?>">
								</div>
								
							</div>

							<div class="row">							
								<div class="col-sm-3">
									<label for="doc_address" class="control-label">Doctor Address</label>
									<input type="text" id="doc_address" name="dr_address" class="form-control" value="<?php echo $doctorProfile[0]['dr_address'];?>">
									<p id="dc_id_error" style="color:red;"></p>
								</div>

								<div class="col-sm-3">
									<label for="doc_area" class="control-label">Doctor Area</label>
									<input type="text" id="doc_area" name="dr_area" class="form-control" value="<?php echo $doctorProfile[0]['dr_area'];?>">
									<p id="dc_id_error" style="color:red;"></p>
								</div>

								<div class="col-md-3" id="state">
									<label for="welnext_state" class="control-label">State</label>
									<select class="form-control" id="welnext_state" name="dr_state" style="width:100%">
										<option value="">Select State</option>
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

								<div class="col-md-3" id="state">
									<label for="dr_city" class="control-label">City</label>
									<select class="form-control" id="dr_city" name="dr_city">
										<option value="">Select City</option>
										<?php 
										if(!empty($doctorProfile)){
											$cityID = $doctorProfile[0]['dr_city'];
										}else{
											$cityID = '';
										}
										if(!empty($drCity) && $drCity != false){
											foreach ($drCity as $key => $value) {
												if($cityID == $value['id']){$sel = 'selected';}else{$sel ='';}
												echo '<option value="'.$value['id'].'" '.$sel.'>'.$value['name'].'</option>';
											}
										}
										?>
									</select>
									<p id="welnext_state_error" style="color:red;"></p>
								</div>						
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="doc_digi_sign" class="control-label">Doctor Digital Signature</label>
									<input type="file" name="dr_digital_signature" class="form-control" id="doc_digi_sign" accept="image/*"><br>
									<p><img src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_digital_signature'];?>" alt="" height="90px" width="90px"></p>
								</div>

								<div class="col-md-3">
									<label for="doc_profile_pic" class="control-label">Doctor Profile Pic</label>
									<input type="file" name="dr_profile_pic" class="form-control" id="doc_profile_pic" accept="image/*"><br>
									<p><img src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_profile_pic'];?>" alt="" height="90px" width="90px"></p>
								</div>

								<div class="col-md-3">
									<label for="drPanCardCert" class="control-label">Doctor Pan Certificate</label>
									<input type="file" class="form-control" name="dr_pan_card_cert" id="drPanCardCert"><br>
									<p>
									<?php 
									$tmp = explode('.', $doctorProfile[0]['dr_pan_card_cert']);
									$extension = end($tmp);
									if($extension == 'pdf'){?>
										<embed src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_pan_card_cert'];?>#toolbar=0&navpanes=0&scrollbar=1&view=fit,100" type="application/pdf" style="width:100px; height:100px;" /><br /><a style="font-size:20px;float:left;" target="_blank" href="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_pan_card_cert'];?>" title="Download"><i class="fa fa-download" aria-hidden="true"></i></a>
									<?php }else{ ?>
										<img src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_pan_card_cert'];?>" alt="" height="90px" width="90px">
									<?php }	?>
									</p>
								</div>

								<div class="col-md-3">
									<label for="drCancelledCheque" class="control-label">Doctor Cancelled Cheque</label>
									<input type="file" class="form-control" name="dr_cancelled_cheque" id="drCancelledCheque"><br>
									<p>
									<?php 
									$tmp = explode('.', $doctorProfile[0]['dr_cancelled_cheque']);
									$extension = end($tmp);
									if($extension == 'pdf'){?>
										<embed src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_cancelled_cheque'];?>#toolbar=0&navpanes=0&scrollbar=1&view=fit,100" type="application/pdf" style="width:100px; height:100px;" /><br /><a style="font-size:20px;float:left;" target="_blank" href="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_cancelled_cheque'];?>" title="Download"><i class="fa fa-download" aria-hidden="true"></i></a>
									<?php }else{ ?>
										<img src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_cancelled_cheque'];?>" alt="" height="90px" width="90px">
									<?php }	?>
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="drRegnCertificate" class="control-label">Doctor Regn Certificate</label>
									<input type="file" class="form-control" name="dr_regn_cert" id="drRegnCertificate"><br>
									<p>
									<?php 
									$tmp = explode('.', $doctorProfile[0]['dr_regn_cert']);
									$extension = end($tmp);
									if($extension == 'pdf'){?>
										<embed src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_regn_cert'];?>#toolbar=0&navpanes=0&scrollbar=1&view=fit,100" type="application/pdf" style="width:100px; height:100px;" /><br /><a style="font-size:20px;float:left;" target="_blank" href="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_regn_cert'];?>" title="Download"><i class="fa fa-download" aria-hidden="true"></i></a>
									<?php }else{ ?>
										<img src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_regn_cert'];?>" alt="" height="90px" width="90px">
									<?php }	?>
									</p>
								</div>

								<div class="col-md-3">
									<label for="drKYCRegistration" class="control-label">Doctor KYC Registration</label>
									<input type="file" class="form-control" name="dr_kyc_regn" id="drKYCRegistration"><br>
									<p>
									<?php 
									$tmp = explode('.', $doctorProfile[0]['dr_kyc_regn']);
									$extension = end($tmp);
									if($extension == 'pdf'){?>
										<embed src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_kyc_regn'];?>#toolbar=0&navpanes=0&scrollbar=1&view=fit,100" type="application/pdf" style="width:100px; height:100px;" /><br /><a style="font-size:20px;float:left;" target="_blank" href="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_kyc_regn'];?>" title="Download"><i class="fa fa-download" aria-hidden="true"></i></a>
									<?php }else{ ?>
										<img src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_kyc_regn'];?>" alt="" height="90px" width="90px">
									<?php }	?>
									</p>
								</div>

								<div class="col-md-3">
									<label for="drBankDeclaration" class="control-label">Doctor Bank Declaration</label>
									<input type="file" class="form-control" name="dr_bank_declaration" id="drBankDeclaration"><br>
									<p>
									<?php 
									$tmp = explode('.', $doctorProfile[0]['dr_bank_declaration']);
									$extension = end($tmp);
									if($extension == 'pdf'){?>
										<embed src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_bank_declaration'];?>#toolbar=0&navpanes=0&scrollbar=1&view=fit,100" type="application/pdf" style="width:100px; height:100px;" /><br /><a style="font-size:20px;float:left;" target="_blank" href="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_bank_declaration'];?>" title="Download"><i class="fa fa-download" aria-hidden="true"></i></a>
									<?php }else{ ?>
										<img src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_bank_declaration'];?>" alt="" height="90px" width="90px">
									<?php }	?>
									</p>
								</div>

								<div class="col-md-3">
									<label for="drBankDeclaration" class="control-label">Doctor Bank Declaration</label>
									<input type="file" class="form-control" name="dr_pan_declaration" id="drBankDeclaration"><br>
									<p>
									<?php 
									$tmp = explode('.', $doctorProfile[0]['dr_pan_declaration']);
									$extension = end($tmp);
									if($extension == 'pdf'){?>
										<embed src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_pan_declaration'];?>#toolbar=0&navpanes=0&scrollbar=1&view=fit,100" type="application/pdf" style="width:100px; height:100px;" /><br /><a style="font-size:20px;float:left;" target="_blank" href="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_pan_declaration'];?>" title="Download"><i class="fa fa-download" aria-hidden="true"></i></a>
									<?php }else{ ?>
										<img src="<?php echo SITE_URL.'doctorFiles/'.$doctorProfile[0]['dr_pan_declaration'];?>" alt="" height="90px" width="90px">
									<?php }	?>
									</p>
								</div>
	
							</div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="formFieldHeight">
							<label for="name" class="control-label">Bank Details</label>

							<div class="row">
								<div class="col-md-3">
									<label for="accountNo" class="control-label">Account Number</label>
									<input type="text" class="form-control" id="accountNo" name="dr_account_no" value="<?php if(isset($doctorProfile[0]['dr_account_no']) && $doctorProfile[0]['dr_account_no'] !=''){echo $doctorProfile[0]['dr_account_no'];}else{echo "";}?>">
								</div>

								<div class="col-md-3">
									<label for="bankName" class="control-label">Bank Name</label>
									<input type="text" name="dr_bank_name" id="bankName" class="form-control" value="<?php if(isset($doctorProfile[0]['dr_bank_name']) && $doctorProfile[0]['dr_bank_name'] !=''){echo $doctorProfile[0]['dr_bank_name'];}else{echo "";}?>">
								</div>

								<div class="col-md-3">
									<label for="acccountHolderName" class="control-label">Account Holder Name</label>
									<input type="text" class="form-control" name="dr_acccount_holder_name" id="acccountHolderName" value="<?php if(isset($doctorProfile[0]['dr_acccount_holder_name']) && $doctorProfile[0]['dr_acccount_holder_name'] !=''){echo $doctorProfile[0]['dr_acccount_holder_name'];}else{echo "";}?>">
								</div>

								<div class="col-md-3">
									<label for="bankBranch" class="control-label">Bank Branch</label>
									<input type="text" class="form-control" name="dr_bank_branch" id="bankBranch" value="<?php if(isset($doctorProfile[0]['dr_bank_branch']) && $doctorProfile[0]['dr_bank_branch'] !=''){echo $doctorProfile[0]['dr_bank_branch'];}else{echo "";}?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="IFSCCode" class="control-label">IFSC Code</label>
									<input type="text" class="form-control" name="dr_ifsc_code" id="IFSCCode" value="<?php if(isset($doctorProfile[0]['dr_ifsc_code']) && $doctorProfile[0]['dr_ifsc_code'] !=''){echo $doctorProfile[0]['dr_ifsc_code'];}else{echo "";}?>">
								</div>

								<div class="col-md-3">
									<label for="teleRate" class="control-label">Tele Rate</label>
									<input type="text" class="form-control" name="dr_tele_rate" id="teleRate" value="<?php if(isset($doctorProfile[0]['dr_tele_rate']) && $doctorProfile[0]['dr_tele_rate'] !=''){echo $doctorProfile[0]['dr_tele_rate'];}else{echo "";}?>">
								</div>

								<div class="col-md-3">
									<label for="videoRate" class="control-label">Video Rate</label>
									<input type="text" class="form-control" name="dr_video_rate" id="videoRate" value="<?php if(isset($doctorProfile[0]['dr_video_rate']) && $doctorProfile[0]['dr_video_rate'] !=''){echo $doctorProfile[0]['dr_video_rate'];}else{echo "";}?>">
								</div>

								<div class="col-md-3">
									<label for="doc_remark" class="control-label">Doctor Remark</label>
									<textarea class="form-control" rows="3" name="doc_remark" id="doc_remark"></textarea>
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
							<button type="button" class="btn btn-primary" id="updateDoctor" style="margin:0 auto;">Update</button>&nbsp;&nbsp;&nbsp;&nbsp;
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

	<?php if(is_array($users) && !empty($users)) { ?>
		var role_id ="<?php echo $users[0]['role_id'];?>";
		var subrole_id ="<?php echo $users[0]['subrole_id']?>";
		getSubroles(role_id,subrole_id); 
	<?php } ?>

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
			$('#dr_city').html('<option value="">Select City</option>');
		}
		if(stateID !=''){
			$.ajax({
				url : URL+'getCities',
				method : 'post',
				data : {'stateID':stateID,'csrf_test_name':csrf_token},
				dataType : 'html',
				success : function(res){
					if(res !=''){
						$('#dr_city').html(res);
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

	$('#updateDoctor').click(function(){
		var formdata = $("#doctorEditValidate").serialize();
		var valid = Role_validate();
		if(valid == true){
			$(".se-pre-con").show();
			
			$("#doctorEditValidate").ajaxSubmit({
				url: URL+'editDoctorSubmit', 
				type: 'post',
				cache: false,
				clearForm: false,
				//data: {formData:formData,'csrf_test_name':csrf_token},
				dataType:'json',
				
				success: function(res) {

					if(res['status']==200){
						$(".se-pre-con").hide();
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
				}
			});
		}
	});
});
</script>	
