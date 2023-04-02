<?php 
	$USRDATA = $this->session->userdata('user_id');
	$user_type = $this->session->userdata('user_type');
	if (isset($USRDATA) && $USRDATA !="" && $user_type !="ICUSER") { ?>

<div class="content-wrapper" style="min-height: 901px;">
    <section class="content">
        <div class="row">
        	<div class="col-sm-7" style="top: -10px;margin: 0em 0em 0em 0.5em;font-size: 15px;font-weight: 600;">
          		<a href="<?php echo URL.'home'?>">Home</a> &raquo; User Management &raquo; Available Doctor List  
        	</div>
        	<div class="col-sm-4 pull-right" style="top: -10px;font-size: 15px;font-weight: 600; text-align: right;"> </div>
			<div class="col-xs-12">
			  	<div class="box">
					<div class="box-header">						
						<div class="col-sm-12"> 
							<div class="ibox-content" id="user_list_form">
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Doctor Name" id="column1_search" class="searchInput form-control search-input-text" filtercol="1"/>
								</div>								
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Doctor Qualification" id="column2_search" class="form-control search-input-text" filtercol="2"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Doctor Language" id="column3_search" class="form-control search-input-text" filtercol="3"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="MER Type" id="column4_search" class="form-control search-input-text" filtercol="4"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Inbound Call" id="column6_search" class="form-control search-input-text" filtercol="6"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Availability" id="column8_search" class="form-control search-input-text" filtercol="8"/>
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
										<th>Dr.&nbsp;Code</th>
										<th>Name</th>
										<th>Doctor&nbsp;Qualification</th>
										<th>Doctor&nbsp;Language</th>
										<th>MER&nbsp;Types</th>
										<th>Contact&nbsp;No.</th>
										<th>Inbound&nbsp;Call</th>
										<th>OutBound&nbsp;Call</th>
										<th>Status</th>
										<th>LastLogin&nbsp;DateTime</th>
										
									</tr>
								</thead>
								<tbody>
						<?php
						//print_r($user_list);exit;
						if(!empty($doctor_list) && is_array($doctor_list) && count($doctor_list) >0){
					    	$i = 1;
			            	foreach ($doctor_list as $key => $value) {

							  	echo "<tr>";
								echo "<td>VM0".$value['dr_id']."</td>";
								echo "<td>".$value['name']."</td>";								
								echo "<td>".getDoctorQualification($value['dr_qualification'])."</td>";
								echo "<td>".getLangName($value['dr_lang'])."</td>";
								echo "<td>".$value['dr_type']." <br/> ".$value['dr_type_priority2']."</td>";
								echo "<td>".gowelnextDcrypt($value['contact'])."</td>";								
								echo "<td>".$value['inbound_call']."</td>";
								echo "<td>".$value['outbound_call']."</td>";
								
								echo "<td>";

								$Agentavailability = $value['availability'];
								if($Agentavailability=="Available"){
									$textcolor = "#228B22;";
					              } else if($Agentavailability=="Busy"){
					              	$textcolor = "#F22424;";
					              } else if($Agentavailability=="Away"){
					              	$textcolor = "#ff9900;";
					              } else if($Agentavailability=="Offline"){
					              	$textcolor = "#dad6d9;";
					              }
					            echo '<span style="color:'.$textcolor.';font-weight: bold;"><i class="fa fa-circle"></i>'. $Agentavailability.'</span>'; 
								echo "</td>";				
								echo "<td>".$value['last_loggedin']."</td>";				
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

<?php  } else{ ?>
	 

<div class="content-wrapper" style="min-height: 901px;">
    <section class="content">
        <div class="row">
        	<div class="col-sm-7" style="top: -10px;margin: 0em 0em 0em 0.5em;font-size: 15px;font-weight: 600;">
          		<a href="<?php echo URL.'home'?>">Home</a> &raquo; User Management &raquo; Available Doctor List  
        	</div>
        	<div class="col-sm-4 pull-right" style="top: -10px;font-size: 15px;font-weight: 600; text-align: right;"> </div>
			<div class="col-xs-12">
			  	<div class="box">
					<div class="box-header">						
						<div class="col-sm-12"> 
							<div class="ibox-content" id="user_list_form">
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Doctor Name" id="column1_search" class="searchInput form-control search-input-text" filtercol="1"/>
								</div>								
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Doctor Qualification" id="column2_search" class="form-control search-input-text" filtercol="2"/>
								</div>
								<div class="col-sm-2 filter">
									<input type ="text" placeholder="Doctor Language" id="column3_search" class="form-control search-input-text" filtercol="3"/>
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
										<th>Dr.&nbsp;Code</th>
										<th>Name</th>
										<th>Doctor&nbsp;Qualification</th>
										<th>Doctor&nbsp;Language</th>
										<th>Status</th>
										<th>Video&nbsp;Links</th>
									</tr>
								</thead>
								<tbody>
						<?php
						//print_r($user_list);exit;
						if(!empty($doctor_list) && is_array($doctor_list) && count($doctor_list) >0){
					    	
					    	$i = 1;
			            	foreach ($doctor_list as $key => $value) {

			            		$Agentavailability = $value['availability'];
			            		if($Agentavailability=="Available"){
								  	echo "<tr>";
									echo "<td>VM0".$value['dr_id']."</td>";
									echo "<td>".$value['name']."</td>";								
									echo "<td>".getDoctorQualification($value['dr_qualification'])."</td>";
									echo "<td>".getLangName($value['dr_lang'])."</td>";
									echo "<td>";
									if($Agentavailability=="Available"){
										$textcolor = "#228B22;";
						              } else if($Agentavailability=="Busy"){
						              	$textcolor = "#F22424;";
						              } else if($Agentavailability=="Away"){
						              	$textcolor = "#ff9900;";
						              } else if($Agentavailability=="Offline"){
						              	$textcolor = "#dad6d9;";
						              }
						            echo '<span style="color:'.$textcolor.';font-weight: bold;"><i class="fa fa-circle"></i>'. $Agentavailability.'</span>'; 
									echo "</td>";				
									// echo "<td><button class='btn btn-primary'>Send Link</button> </td>";				
									echo "<td><button class='btn btn-primary'>Join Now</button> </td>";				
							        echo "</tr>";
						        } 
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

<?php  } ?>

<script>
$(document).ready(function() {
	// Restore state
	var table = $('#all_user').DataTable({});
	var state = table.state.loaded();
	if(state){
		table.columns().eq( 0 ).each( function (colIdx ) {
			var colSearch = state.columns[colIdx].search;
			if(colSearch.search){
				$('#column'+colIdx+'_search').val(colSearch.search);
			}
		});
		table.draw();
	}		 
      
   	$('#column1_search').on( 'keyup', function () {
		table.columns(1).search(this.value).draw();
	});
		
	$('#column2_search').on( 'keyup', function () {
		table.columns(2).search(this.value).draw();
	});
		
	$('#column3_search').on( 'keyup', function () {
		table.columns(3).search(this.value).draw();
	});
	
	$('#column4_search').on( 'keyup', function () {
		table.columns(4).search(this.value).draw();
	});
	$('#column6_search').on( 'keyup', function () {
		table.columns(6).search(this.value).draw();
	});
	
	$('#column8_search').on( 'keyup', function () {
		table.columns(8).search(this.value).draw();
	});
	

    
    

});
</script>
