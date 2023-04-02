<?php 
	if(!empty($users[0]['subrole_id'])){ 
		$readonly = 'readonly="readonly"'; 
	} else{
		$readonly = ''; 
	} 
?>
<div class="content-wrapper" style="min-height: 901px;">
<section class="content">
<div class="row">
	<div style="padding : 0px 10px;">
        <div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Update Users Roles & Permissions</h3>
			</div>
			<div class="box-body">				
				<?php echo form_open(base_url(), array("class"=>"form-horizontal", "id"=>"userFormData", "enctype"=>"multipart/form-data", "method"=>"post"));?>
					<fieldset>			
						<div class="control-group form-group col-md-4">
							<label for="state" class="control-label">Profile Type</label>
							<div class="controls">
								<select class="form-control"  id="users_type" name="users_type" onchange="getUserRoles(this.value);">
									<option value="">Select</option>
									<?php 
									//$user_type = $this->session->userdata('type');
										if(isset($roles) && !empty($roles)){
										foreach($roles as $roleskey =>$rolesvalue){?>
										<option value="<?php echo $rolesvalue['role_id'];?>"><?php echo $rolesvalue['name'];?></option>
									<?php } } ?>
								</select>
							</div>
						</div>	
						
						<div class="col-md-4">
							<label for="state" class="control-label">User Roles</label>
							<div class="controls">
								<select class="form-control"  id="subroles" name="subroles" onchange="getUserList(this.value);">
									<?php if(!empty($subroles) && $subroles !=false) {
										foreach ($subroles as $subroleskey => $subrolesvalue) {
											echo '<option value="'.$subrolesvalue["subrole_id"].'">'.$subrolesvalue["subrole"].'</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
			
						<div class="control-group form-group col-md-4">
							<label for="state" class="control-label">Select User</label>
							<div class="controls">
								<select class="form-control"  id="users_id" name="users_id" onchange="getSubPermission(this.value);">
									<option value="<?php echo $this->session->userdata('user_id'); ?>"><?php echo $this->session->userdata('name'); ?></option>								
								</select>
							</div>
						</div>						
			
						<div class="control-group form-group col-md-12" id="subpermissionsSec">				
						<?php 
							if(is_array($permissions) && count($permissions) > 0){ 
								
								foreach($permissions as $prkey => $prval){ ?>
									<h4 style="width: 100%; float: left;border-bottom: 1px dotted #e2dcdc">
									<?php 
										if(in_array($prval['permission_id'], $permission_id)) {
											$selc="checked"; 
										} else{
											$selc="";
										} 
									?>
										<input type="checkbox" value="<?php echo $prval['permission_id']; ?>" id="PermID" name="permission_id[<?php echo $prval['permission_id']; ?>]" <?php echo $selc; ?> /><?php echo $prval['permission'];?>
									</h4>
									<ul style="list-style: none;float: left;">
									<?php 
										if(is_array($subpermissions) && count($subpermissions) > 0){

											foreach ($subpermissions as $subprkey => $subprvalue) {

												if($prval['permission_id'] == $subprvalue['permission_id']){							
													echo '<li style="float:left; width:20em;">';
													if(in_array($subprvalue["subpermissions_id"], $subpermissions_id)){
														echo '<input type="checkbox" name="subpermissions_id['.$prval["permission_id"].'][]" value="'.$subprvalue["subpermissions_id"].'" id="subPerID" checked="checked">';
													} else{
														echo '<input type="checkbox" name="subpermissions_id['.$prval["permission_id"].'][]" value="'.$subprvalue["subpermissions_id"].'" id="subPerID">';
													}
													echo $subprvalue["subpermission"].'</li>';
												}
											}					
										} 
									?>					
									</ul><br/>
						<?php } 
							} 
						?>
					</div>
				</fieldset>
				
			
				<div class="col-md-12">
					<div class="box-footer" style="text-align:center;" >
						<button type="button" class="btn btn-primary addsave" id="updateUserRole" style="margin:0 auto; ">Save</button>
						<a href="<?php echo base_url();?>subrole" class="btn btn-primary" style="margin:0 auto; ">Cancel</a>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>	
	</div>
</div>
</section>

</div>
<style>
ul.dc-images {padding-left:0;}
ul.dc-images li {list-style-type:none;display:inline-block;margin:0 5px;}   	
</style>
<script>
var URL = '<?php echo URL;?>';
function getUserRoles(profileT){	
	$.ajax({
		url:URL+"getUserRoles",
		data: {'profileT' : profileT,'csrf_test_name':csrf_token},
		dataType: 'json',
		method:'post',
		success: function(res){	
			console.log(res);						
			$("#subroles").html(res['option']);	
		}
	}); 
}

function getUserList(subrolesid){
	var role_id = $("#users_type").val();
	$.ajax({
		url:URL+"getUserList",
		data: {'role_id':role_id,'subrolesid' : subrolesid,'csrf_test_name':csrf_token},
		dataType: 'json',
		method:'post',
		success: function(res){		
			if(res['status'] == 'success'){
				$("#users_id").html(res['option']);
			}else{
				$("#users_id").html('');
			}
			
		}
	}); 
}


function getSubPermission(user_id){	
	$.ajax({
		url:URL+"getSubPermission",
		data: {'user_id':user_id,'csrf_test_name':csrf_token},
		dataType: 'html',
		method:'post',
		success: function(res){		
			$("#subpermissionsSec").html(res);
		}
	}); 
}

$(document).ready(function(){
	$('#updateUserRole').click(function(){
		$(".se-pre-con").show();
		var formdata = $("#userFormData input, select, checkbox").serialize();
		$.ajax({
			url:  URL+'userPermissionData',
			type: 'post',
			dataType: 'json',
			data:{formdata:formdata,'csrf_test_name':csrf_token},
			success: function(res){
				if(res['status'] == 'success'){
					$(".se-pre-con").hide();
					alert(res['msg']);
					location.reload();
					//window.location = URL+"user-list";
				}else{
					alert('Something went wrong...');
				}				
			}
	    });
	});
});


</script>

