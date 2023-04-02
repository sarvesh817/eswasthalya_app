<style>
	.col-sm-3.filter{margin:10px 0;}
</style>
<div class="content-wrapper" style="min-height: 901px;">
    <section class="content">		
		<div class="row">
			<div class="col-xs-12">
          		<div class="box">
			 		<div class="box-header">
						<div class="col-md-12 col-xs-12 gowelbtns">
							<div class="case-list-title">
				 				<h3 class="box-title">Comment Logs</h3>
							 	<?php 
									$referer = "javascript:history.go(-1)";
									if(isset($_SERVER['HTTP_REFERER'])) {$referer = $_SERVER['HTTP_REFERER'];}				
									echo '<p class="box-title pull-right"><a class="btn btn-primary" style="margin-left: 1035px; margin-top: -60px;" href="'. $referer .'" title="Return to the previous page">Go back</a></p>';				
								?>
							</div>
			 			</div>
            		</div>
		  		</div>
		 	</div>	
		</div>	
<?php //echo"<pre>";print_r($caseremarks);exit;?>
		
	   
	   	<div class="row">
			<div class="col-xs-12" style="background: #fff;margin: 0 15px;">
		   		<div class="box-body table-responsive">
		   			<h5>Case logs</h5>      
		  			<table class="table table-striped table-hover" id="casetable_id">
						<thead>
							<tr>
				  				<th style="width: 1px;">Sr. No.</th>
				  				<th>Comments</th>
				  				<th>Created at</th>
				  				<th>Created by</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(is_array($caseremarks) && count($caseremarks) > 0){
								$count = 1;
								foreach ($caseremarks as $key => $value) {
									echo "<tr>";
									echo "<td style='width: 1px;'>".$count."</td>";
									echo "<td>".$value->user_remark."</td>";
									if($value->created_at != "0000-00-00 00:00:00")
									{
										echo "<td>".date('d/m/Y h:i a',strtotime($value->created_at))."</td>";
									}else
									{
										echo "<td></td>";
									}
									echo "<td>".$value->changed_by."</td>";
							?>
							<?php echo "</tr>";
								$count++;
								} 
							} 
							?>
						</tbody>
		  			</table>
				</div>
			</div>
	   	</div>
    </section>
</div>

<style>
.gowelbtns{margin:20px 0px;	position:relative;}
.case-list-title{position:absolute;left:20;top:0px;}
.case-list-title h3{margin:0;}
.hide{display:none;}		
</style>
<script>
	$(document).ready(function() {		
		var table = $('#dctable_id').DataTable({
			stateSave: true,
			columnDefs: [{"targets":[2], "type":"date-eu"}],
			dom: 'Bfrtip',
			buttons: [{
					extend : 'csv',
					text : 'Export to CSV',
					exportOptions: {
							columns: [ 1, 2, 3, 4]
						}
			}]
		});
		
		var table = $('#apptable_id').DataTable({
			stateSave: true
		});
		
		var table = $('#casetable_id').DataTable({
			stateSave: true
		});
	});
	
</script>
