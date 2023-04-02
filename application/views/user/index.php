<div class="content-wrapper" style="min-height: 901px;">
    <section class="content">
        <div class="row">
        	<div class="col-sm-7" style="top: -10px;margin: 0em 0em 0em 0.5em;font-size: 15px;font-weight: 600;">
          		<a href="<?php echo URL.'home'?>">Home</a> &raquo; User Management &raquo; User List  
        	</div>
        	<div class="col-sm-4 pull-right" style="top: -10px;font-size: 15px;font-weight: 600; text-align: right;">
        	<?php 
        		if ($this->session->userdata('user_id') > 0 && ($this->privilegeduser->hasPrivilege("addUser") || $this->userprivileged->hasUserPrivilege("addUser"))){
        			echo '<a href="'.URL.'add-user" class="btnAdd"> Add User</a>&nbsp;&nbsp;';
				} 				 
			
        		if ( $this->privilegeduser->hasPrivilege("exportDoctorUser") || $this->userprivileged->hasUserPrivilege("exportDoctorUser") ){
        			//echo form_open(base_url('getAllDRData'), array("id"=>"doctorCSVDATA", "method"=>"post"));
						echo '<a href="'.URL.'getAllDRData" class="link" id="doctorCSV">&nbsp;|&nbsp; Export Doctor List</a>';
					//echo form_close();
				}
				
				if ( $this->privilegeduser->hasPrivilege("exportUser") || $this->userprivileged->hasUserPrivilege("exportUser") ){
					echo '<a href="'.URL.'user/User/getAllUsersData" class="link" id="userListCSV">&nbsp;|&nbsp; Export User List</a>';
				}
			?>
        	</div>
			<div class="col-xs-12">
			  	<div class="box">
					<div class="box-header">						
						<div class="col-sm-12"> 
							<div class="ibox-content" id="user_list_form">
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Name" id="column2_search" class="searchInput form-control search-input-text" filtercol="1"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Employee ID/Docr Code" id="column3_search" class="form-control search-input-text" filtercol="2"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Email" id="column4_search" class="form-control search-input-text" filtercol="2"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Contact" id="column5_search"  class="form-control search-input-text" filtercol="4"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Role" id="column6_search"  class="form-control search-input-text" filtercol="3"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="SubRole" id="column7_search"  class="form-control search-input-text" filtercol="4"/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        	<div class="row">
        		<div class="col-xs-12">
          			<div class="box">            
			            <div class="box-body table-responsive">
			              	<table class="table table-striped table-hover" id="all_user" style="font-size: 12px;">
								<thead>
									<tr style="background-color: #52c1e8; color: #FFF;">
										<th>Action</th>
										<th>UserId</th>
										<th>Name</th>
										<th>Emp&nbsp;ID/Doctor&nbsp;Code</th>
										<th>Email</th>
										<th>Contact</th>
										<th>Role</th>
										<th>SubRole</th>
										<th>Status</th>	
										<th>Account&nbsp;Status</th>									
										<th>UserType</th>
										<th>Reporting</th>
										<th>Created&nbsp;At</th>
										<th>Created&nbsp;By</th>
										<th>Updated&nbsp;At</th>
										<th>Updated&nbsp;By</th>
									</tr>
								</thead>
								<tbody>
						<?php
						//print_r($user_list);exit;
			            if(!empty($user_list) && is_array($user_list) && count($user_list) > 0){
							$i = 1;
			            	foreach ($user_list as $key => $value) {						  	
							  	echo "<tr><td>";
							  	
								if($value['subrole_id'] !='16' && ($this->privilegeduser->hasPrivilege("editUserProfile") || $this->userprivileged->hasUserPrivilege("editUserProfile")) ){
									
									$href = base_url()."edit-user?text=".rtrim(strtr(base64_encode("id=".$value['user_id']), '+/', '-_'), '=');
									$remarkUser = base_url()."user-remark-list?text=".rtrim(strtr(base64_encode("id=".$value['user_id']), '+/', '-_'), '=');
									echo '<a href="'. $href.'"><span class="glyphicon glyphicon-pencil"></span></a></br>';
							  		echo '<a href="'.$remarkUser.'" target="_blank"><span class="glyphicon glyphicon-comment"></span></a>';

							  	} else if( $this->privilegeduser->hasPrivilege("editDoctor") || $this->userprivileged->hasUserPrivilege("editDoctor") ){
							  		
							  		$href = base_url()."editDoctorView?text=".rtrim(strtr(base64_encode("id=".$value['user_id']), '+/', '-_'), '=');
							  		echo '<a href="'. $href.'" target="_blank"><span class="glyphicon glyphicon-pencil"></span></a></br>';
							  		echo "<a href='#myDRModal' data-toggle='modal' data-target='#myDRModal' data-id=".$value['user_type_id']." id='myDRDataBtn'><span class='glyphicon glyphicon-comment'></span></a>";

							  	} else{
							  		echo '<span class="glyphicon glyphicon-pencil"></span></br>';
							  	}

							  	//if($this->userprivileged->hasUserPrivilege("viewUserRemark") || $this->privilegeduser->hasPrivilege("viewUserRemark")){ ?>
				                <!-- <a href="<?php //echo  base_url()."user-remark-list?text=".rtrim(strtr(base64_encode("id=".$value['user_id']), '+/', '-_'), '=');?>" title='Remark' target='_blank'><span class='glyphicon glyphicon-comment'></span></a><br> -->
		                    	<?php //}
							  	
							  	echo "</td><td>".$value['user_id']."</td>";
								$i++;
								echo "<td>".$value['name']."</td>";
								echo "<td>";
								if($value['subrole']=="DOCTOR" || $value['subrole_id'] ==15){
									echo "VM0".$value['user_type_id'];
								} else{
									echo $value['gwlempid'];	
								}
								echo "</td>";
								echo "<td>".$this->mastermodel->gowel_crypt($value['email'],"d")."</td>";
								echo "<td>".gowelDcrypt($value['contact'])."</td>";
								echo "<td>".$value['role']."</td>";
								echo "<td>".$value['subrole']."</td>";
								echo "<td>".$value['status']."</td>";
								echo "<td id='".$value['user_id']."'>";
								if($value['incorrect_try']>3){
									echo "<span class='incorrecttry' data-try='UnLocked' data-userid='".$value['user_id']."' title='Click to UnLock' style='cursor: pointer;color:#f70606;'>Locked</span>";
								} else{
									echo "<span class='incorrecttry' data-try='Locked' data-userid='".$value['user_id']."' title='Click to Lock' style='cursor: pointer; color: #52c1e8;'>UnLocked</span>";
								}
								echo "</td>";
								echo "<td>".$value['user_type']."</td>";
								echo "<td>". getUserName($value['parent_id'])."</td>";
								echo "<td>".$value['created_at']."</td>";
								echo "<td>".getUserName($value['created_by'])."</td>";								
						       	echo "<td>".$value['modified_at']."</td>";
								echo "<td>".getUserName($value['modified_by'])."</td>";
						        echo "</tr>";
					        } 
					    } else if(!empty($doctor_list) && is_array($doctor_list) && count($doctor_list) >0){
					    	$i = 1;
			            	foreach ($doctor_list as $key => $value) {							  	
							  	echo "<tr><td>";
							  	$href = base_url()."editDoctorView?text=".rtrim(strtr(base64_encode("id=".$value['user_id']), '+/', '-_'), '=');
							  	echo '<a href="'. $href.'" target="_blank"><span class="glyphicon glyphicon-pencil"></span></a><br>';
							  	echo "<a href='#myDRModal' data-toggle='modal' data-target='#myDRModal' data-id=".$value['user_type_id']." id='myDRDataBtn'><span class='glyphicon glyphicon-comment'></span></a>";
							  	echo "</td><td>".$value['user_id']."</td>";
								$i++;
								echo "<td>".$value['name']."</td>";
								
								echo "<td>VM0".$value['user_type_id']."</td>";

								echo "<td>".$this->mastermodel->gowel_crypt($value['email'],"d")."</td>";
								echo "<td>".gowelDcrypt($value['contact'])."</td>";
								echo "<td>".$value['role']."</td>";
								echo "<td>".$value['subrole']."</td>";
								echo "<td>".$value['status']."</td>";
								echo "<td id='".$value['user_id']."'>";
								if($value['incorrect_try']>3){
									echo "<span class='incorrecttry' data-try='UnLocked' data-userid='".$value['user_id']."' title='Click to UnLock' style='cursor: pointer;color:#f70606;'>Locked</span>";
								} else{
									echo "<span class='incorrecttry' data-try='Locked' data-userid='".$value['user_id']."' title='Click to Lock' style='cursor: pointer; color: #52c1e8;'>Un-Locked</span>";
								}
								echo "</td>";
								echo "<td>".$value['user_type']."</td>";
								echo "<td>NA</td>";
								echo "<td>".$value['created_at']."</td>";
								echo "<td>".getUserName($value['created_by'])."</td>";
								echo "<td>".$value['modified_at']."</td>";
								echo "<td>".getUserName($value['modified_by'])."</td>";
						        echo "</tr>";
					        } 
					    }else{
					    	echo "<tr><td colspan='9'>No Record Found...</td></tr>";
					    }

					    ?>
								</tbody>
			              	</table>
			            </div>
            		</div>
    			</div>
			</div>
		</div>
	</section>
</div>

<!-- TEST MODAL START-->
<!-- Modal -->
  	<div class="modal fade" id="myDRModal" role="dialog">
      	<div class="modal-dialog">              
      	<!-- Modal content-->
          	<div class="modal-content modalWidth">
				<div class="modal-header modalHeaderColor">
				  	<button type="button" class="close mpdalDismissBtn" data-dismiss="modal">&times;</button>
				  	<h4 class="modal-title">Doctor Remark </h4>
				</div>
              	<div class="modal-body">
                  	<p class="scrollData" id="drRemark"></p>
              	</div>
          	</div>
      	</div>
  	</div>
<!-- TEST MODAL END-->

<script>
$(document).ready(function() {
	<?php if($this->privilegeduser->hasPrivilege("exportUser") || $this->userprivileged->hasUserPrivilege("exportUser")){?>
      	var table = $('#all_user').DataTable({
			//stateSave: true,
			dom: 'Bfrtip',
            buttons: [{
            extend : 'csv',
            text : 'Export to CSV',
            exportOptions: {
                    columns: [ 1, 2, 3, 5, 6]
                }
            }]
     	});
	<?php }else{ ?>
		var table = $('#all_user').DataTable({});
	<?php }	?> 
	    // Restore state
		var state = table.state.loaded();
		if(state){
		  	table.columns().eq( 0 ).each( function ( colIdx ) {
				var colSearch = state.columns[colIdx].search;
				if(colSearch.search){
					$('#column'+colIdx+'_search').val(colSearch.search);
				}
		  	});
		    table.draw();
		}		 
      
   	$('#column2_search').on( 'keyup', function () {
		table.columns(2).search(this.value).draw();
	});
		
	$('#column3_search').on( 'keyup', function () {
		table.columns(3).search(this.value).draw();
	});
		
	$('#column4_search').on( 'keyup', function () {
		table.columns(4).search(this.value).draw();
	});
	
	$('#column5_search').on( 'keyup', function () {
		table.columns(5).search(this.value).draw();
	});
	
	$('#column6_search').on( 'keyup', function () {
		table.columns(6).search(this.value).draw();
	});
	$('#column6_search').on( 'keyup', function () {
		table.columns(6).search(this.value).draw();
	});

	$(document).on('click','#myDRDataBtn',function(){        
        var dr_id = $(this).attr('data-id');
        if(dr_id !=''){
          	$.ajax({
	            url:URL+'getAllDRRemark',
	            method:'post',
	            data:{dr_id:dr_id,'csrf_test_name':csrf_token},
	            dataType:'html',
	            success:function(res){
	              $('#drRemark').html(res);            
	            }
          	});
        }      
    });

    $(document).on('click','#doctorCSV', function(){
    	//$('#doctorCSVDATA').submit();
    });
    
    $(document).on('click','.incorrecttry', function(){
    	$user_id= $(this).attr('data-userid');
    	$data_try= $(this).attr('data-try');
    	if($user_id!=""){
    		$.ajax({
	            url:URL+'user/user/lockUnlockAccount',
	            method:'post',
	            data:{'user_id':$user_id,'data_try':$data_try,'csrf_test_name':csrf_token},
	            dataType:'html',
	            success:function(res){
	              $("#"+$user_id).html(res);            
	            }
          	});
        }
    });

});
</script>
