<style type="text/css">

hr {margin-top: 0px;margin-bottom: 0px;}
table { 
  width: 100%; 
  border-collapse: collapse; 
}
/* Zebra striping */
/*tr:nth-of-type(odd) { 
  background: #00c0ef; 
}*/

th { 
  background: #00c0ef; 
  color: white; 
  font-weight: bold; 
}
td, th { 
  padding: 6px; 
  border: 1px solid #ccc; 
  text-align: left; 
}


@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	#CaseList table, #CaseList thead, #CaseList tbody, #CaseList th, #CaseList td, #CaseList tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	#CaseList thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	#CaseList tr { border: 1px solid #ccc; }
	
	#CaseList td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	#CaseList td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	#CaseList td:nth-of-type(1):before { content: "Application No."; }
	#CaseList td:nth-of-type(2):before { content: "Case Type"; }
	#CaseList td:nth-of-type(3):before { content: "Customer Name"; }
	#CaseList td:nth-of-type(4):before { content: "Insurance Company"; }
	#CaseList td:nth-of-type(5):before { content: ""; }
	
}

ul.dc-images {padding-left:0;}
ul.dc-images li {list-style-type:none;display:inline-block;margin:0 5px;}   	
.d_id:hover{background-color: #f0f5f5;}
.highlight {border-color: red !important; }

#DCdialog{width: 100% !important ; height: 500px !important;}
#DClist{height: 100%; width: 40%;float: left;overflow: scroll;}
#map{height: 100%; width: 59%; float: left;}
#CurentLocation{display: none;}
@media screen and (max-width: 600px) {
  #map {visibility: hidden;clear: both;float: left;margin: 10px auto 5px 20px;width: 28%;display: none;}
  #DClist{height: 100%; width: 100%;float: left;overflow: scroll;}
  .ui-dialog{height: 600px !important;width: 400px !important;top: 24px;left: 0;display: block;z-index: 101;}
  .ui-dialog-buttonset{text-align: center !important; float: none; }
  #CurentLocation{display: block;}
  .ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset{float: none; text-align: center;}
  .ui-dialog .ui-dialog-buttonpane{text-align: center !important;}
}

</style>

<div class="content-wrapper" style="min-height: 901px;">
    <section class="content">
        <div class="row">
        	<div class="col-sm-12" style="top: -10px;margin: 0em 0em 0em 0.5em;font-size: 15px;font-weight: 600;">
         		<a href="<?php echo URL.'login';?>">Home</a> &raquo; Scheduled Appointment
        	</div>
			<div class="col-sm-12" style="padding : 0px 8px;">
			    <!-- Horizontal Form -->
				<div class="box box-info" id="showafter" style="display: none;">
					<h1 style="text-align: center;">Thank You</h1>
					<h3 style="text-align: center;">Your appointment record has been updated, our customer support team will call you back to reconfirm your medical appointment!</h3>
				</div>
				<div class="box box-info" id="hideafter">
					
				<div class="box-body">	
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6" style="text-align: center;">
							<table id="SerchApplication">
								<tr>
									<td style="text-align: right;">Application No.</td>
									<td><input type="text" name="ApplicationNum" class="form-control" id="ApplicationNum"></td>
									<td><input type="button" name="SearchCaseData" class="btn btn-primary" id="SearchCaseData" value="Search"></td>
								</tr>
							</table>
						</div>
						<div class="col-md-3"></div>
					</div>
					<div class="row">						
						<div class="col-md-1"></div>
						<div class="col-md-10" >							
							<table id="CaseList">
								<thead>
									<tr>
										<th class="info">Application No.</th>
										<th class="info">Tests</th>
										<th class="info">Customer</th>						
										<th class="info">Insurance Company</th>
										<th class="info">Action</th>
									</tr>
								</thead>
								<tbody id="caselistSec"> </tbody>
							</table>
						</div>				
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10" id="displayError"></div>
					</div>
		<!-- ---------------------Physical Medical From Section----------------- -->
		
		<?php echo form_open(base_url(), array("class"=>"form-horizontal", "id"=>"physicalMForm", "enctype"=>"multipart/form-data", "method"=>"post"));?>
					
		<div class="row" id="physicalMsection" style="display: none;">		
			<div class="col-md-2">
				<input type="hidden" id="pmcust_id" name="cust_id" value="">
				<input type="hidden" id="pmc_id" name="c_id" value="">
				<input type="hidden" id="pmic_id" name="ic_id" value="">

			</div>
			<div class="col-md-8">
				<h4> Customer Address <!-- <input type="button" class="btn btn-primary pull-right" id="CurentLocation" onclick="getCurentLocation();" value="Select Current Location" /> --> </h4>
				<div class="row">					
					<div class="col-md-6">
						<label>Area/Locality</label>
						<input type="text" name="area" id="sublocality_level_1" value="" autocomplete="off" class="form-control" placeholder="Area" />
						<input type="hidden" name="lat" id="lat" value="" />
						<input type="hidden" name="lng" id="lng" value=""/>						
					</div>					
					<div class="col-md-6">
						<label>Landmarks</label>
						<input type="text" name="landmark" id="sublocality_level_2" value="" autocomplete="off" class="form-control" placeholder="Enter Landmark"/>					
					</div>
					<div class="col-md-6">
						<label for="state" class="control-label">State</label>
						<input type="text" name="state" id="state" value="" autocomplete="off" class="form-control reqrfld" placeholder="State"/>
					</div>
					<div class="col-md-6">
						<label for="city" class="control-label">City</label>					
						<input type="text" class="form-control reqrfld" name="city" id="cityname" value="" />
					</div>
					<div class="col-md-6" style="display: none;">
						<label style="vertical-align: top;">Address</label>
						<textarea name="address1" id="address1" autocomplete="off" class="form-control reqrfld" rows="3" ></textarea>
					</div>
					<div class="col-md-6">
						<label>Pincode</label><span style="color: red;"> *</span>
						<input type="text" name="pincode" id="postal_code" value="" autocomplete="off" class="form-control reqrfld" placeholder="Pincode"/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<label for="cust_type" class="control-label">Appointment Date</label><span style="color: red;"> *</span>
								<input type='text' class="form-control reqrfld" id='app_date' value="" name="app_date" autocomplete='off' />
							</div>	
							<div class="col-md-6">
								<label for="cust_type" class="control-label">Appointment Time</label><span style="color: red;"> *</span>
								<input type='text' class="form-control reqrfld" id='app_time' value="" name="app_time" autocomplete='off' />
							</div>	
						</div>							
					</div>					
					<div class="col-md-3">
						<label for="cust_type" class="control-label">Visit Type</label><span style="color: red;"> *</span>
						<select class="form-control reqrfld" id="visit_type" name="visit_type" style="width: 100%">							
							<option value="Center">Center</option>
							
						</select>	

					</div>													
					<div class="col-md-2" style="padding: 3%; text-align: center">						
						<input type="button" name="getdclist" id="getdclist" class="btn btn-primary" value="Select Diagnostic Center" onclick="getNearestDC()" >
					</div>					
				</div>
				
				<div class="row ">
					<div class="col-md-6">
						<label>Remarks</label><span style="color: red;"> *</span>
						<textarea id="a_remark" name="a_remark" class="form-control reqrfld" cols="10" rows="3"></textarea>					
					</div>
					<div class="col-md-6 dcaddress">
						<label>DC Address</label><span style="color: red;"> *</span>
						<textarea id="dcaddress" class="form-control reqrfld" disabled="" cols="10" rows="3"></textarea>
						<input type="hidden" name="dc_id" id="dc_id">
					</div>					
				</div>
				
			</div>

			<div class="col-md-12">
				<div class="box-footer" style="text-align:center;" >
					<button type="button" class="btn btn-primary addsave" id="addsave" style="margin:0 aut;" onclick="submitForm()">Save</button>
				</div>	
			</div>	
			<div class="col-md-12" style="margin-left:  10px;color: red">
				<strong>NOTE:</strong> <p># This is a tentatively scheduled date and time, that will be confirmed, post communication with the suitable Medical center near you. Please do not be on Fasting until, you receive confirmation from us. We thank you for your support and understanding</p>
			</div>
		</div>


		<?php echo form_close(); ?>

	<!-- ---------------------End Physical Medical Form ---------------Start MER FOR Section---------------------- -->

	<?php echo form_open(base_url(), array("class"=>"form-horizontal", "id"=>"VMFormSection", "enctype"=>"multipart/form-data", "method"=>"post"));?>

		<div class="row" id="MERAppSection" style="display: none;" >
			<div class="col-md-2">
				<input type="hidden" id="casetype" name="casetype" value="">
				<input type="hidden" id="caseId" name="caseId" value="">
				<input type="hidden" id="vmic_id" name="ic_id" value="">
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-3">
						<label for="prefered_lang" class="control-label">Preferred Language</label>
						<select name="prefered_lang" id="prefered_lang" class="form-control" multiple="" style="width: 100%;">
							<option value="">Select</option>
							<?php if(!empty($preferlang) && $preferlang !=false){
								foreach ($preferlang as $PLkey => $PLvalue) {
									echo '<option value="'.$PLvalue["lang_id"].'">'.$PLvalue["lang_name"].'</option>';
								}
							} ?>
						</select>	
					</div>
					<div class="col-md-3">
						<label for="cust_type" class="control-label">Appointment Date</label>
						<input type='text' class="form-control" id='mer_app_date' value="" name="mer_app_date" autocomplete='off' />
					</div>	
					<div class="col-md-3">
						<label for="cust_type" class="control-label">Appointment Time</label>
						<select class="form-control" id='mer_app_time' name="mer_app_time" style="width:100%">
							<option value="">Select Time Slot</option>
						</select>
					</div>	
					<div class="col-md-3">
						<input type="button" name="updateMERDate" id=updateMERDate value="Update" class="btn btn-primary" style="margin-top:20px; " />
					</div>	
					<div class="col-md-12">
						<p style="color: red;"><b>Note:</b> This is a tentative appointment. Confirmed Date and time details will be shared with the customer shortly.</p>
					</div>		
				</div>
			</div>			

		</div>



	<?php echo form_close(); ?>


	<!-- ---------------------END MER Form Section-------------- -->


	</div>	

	
</div> 
	<div id="DCdialog" style="display: none">	
		<div id="DClist" style=""></div>
		<div id="map" style=""></div>
	</div>	
</div>
    </section>
    
</div>
<link rel="stylesheet" href="<?php echo SITE_URL ?>css/jquery.timepicker.min.css">
<script src="<?php echo SITE_URL ?>js/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL?>js/search_loacation.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_KEY;?>&libraries=places&callback=initialize" async defer ></script>
<style>


</style>

<script type="text/javascript">

	function showLocation(position){
    	var latitude = position.coords.latitude;
    	var longitude = position.coords.longitude;
   		var geocoder = new google.maps.Geocoder();
   		var latlng = new google.maps.LatLng(latitude, longitude);
   		geocoder.geocode(
		{'latLng': latlng}, 
		function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
		            if (results[0]) {
		                var add= results[0].formatted_address ;
		                var  value=add.split(",");		                
		                count   = value.length;		                
		                country = value[count-1];
		                state   = value[count-2];
		                city    = value[count-3];
		                sublocality_level_1 = value[count-4];
		                sublocality_level_2 = value[count-5];
		                state = state.trimLeft();
		                statepost = state.split(' ');
						//console.log(value);console.log(statepost);
		                document.getElementById('lat').value = latitude;
		                document.getElementById('lng').value = longitude;
  						document.getElementById('address1').value = value;
		                document.getElementById('cityname').value = city;
		                document.getElementById('sublocality_level_1').value = sublocality_level_1;
		                document.getElementById('sublocality_level_1').value = sublocality_level_1;
		                document.getElementById('state').value = statepost[0];
		                document.getElementById('postal_code').value = statepost[1];
		            }
		            else  {
		                alert("address not found");
		            }
		    }
		     else {
		        alert("Geocoder failed due to: " + status);
		    }
		});
   }

   function getCurentLocation(){
   	if(navigator.geolocation){	    	
	    navigator.geolocation.getCurrentPosition(showLocation);
	}else{ 
	    alert('Geolocation is not supported by this browser.');
	}
   }

 	$(function () {
        $("#DCdialog").dialog({
            modal: true,
            autoOpen: false,
            resizable: false,            
            title: "Diagnostic Center List",         
            width: $(window).width() > 400 ? 1000 : 'auto',
            height: $(window).height() > 600 ? 600 : 600,
            responsive: true,
            overflow:false,
            buttons: { 'Ok':function() { $( this ).dialog( "close" );}
    			
  			}
        }).prev(".ui-dialog-titlebar").css("background","#52c1e8");       
    });


	function initialize() {	  
	   initAutoComplete();
	}


var map, marker;
function initMap(locations1) {	
	$lat = $("#lat").val();
	$lng = $("#lng").val();		
	if($lat !=""){
		var myLatlng = new google.maps.LatLng($lat, $lng);
	} else{
		var myLatlng = new google.maps.LatLng(20.5937, 78.9629);
	}	
	var myOptions = { 
		zoom: 10,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}  
    map = new google.maps.Map(document.getElementById("map"), myOptions);
    var bounds = new google.maps.LatLngBounds();
    var i;
    for (i = 0; i < locations1.length; i++) {    	
    	var locations = locations1[i].split(',');
    	var dc_id = locations[3];	    	
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[1], locations[2]),
            map: map,
            content: locations[0]
        });

        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, 'click', (function (marker, i, infowindow) {        	
            return function () {
               //console.log('Klick! Marker=' + this.content);
                $("#dc_id").val(dc_id);
    			$("#dcaddress").val(this.content);
    			$(".d_id").css('background-color','#FFFFFF');
    			$("#"+dc_id).css('background-color',"#f0f5f5");
                infowindow.setContent(this.content);                
                infowindow.open(map, this);
            };

        })(marker, i, infowindow));
        bounds.extend(marker.position);
        //google.maps.event.trigger(marker, 'click');
    }

}  




$(document).on('click', '.d_id', function () {    
    var d = $(this).attr('id');
    var addr = $(this).attr('data-addr');
    $("#dc_id").val(d);
    $("#dcaddress").val(addr);
    $(".d_id").css('background-color','#FFFFFF');
    $(this).css('background-color','#f0f5f5');
});

$(document).ready(function() {	

	$("#SearchCaseData").click(function(){
		$("#MERAppSection").hide();
		$("#physicalMsection").hide()
		$("#displayError").html("")
		$appNumber = $("#ApplicationNum").val();
		$appNumber = $appNumber.trim();
		if($appNumber !="" && $appNumber !="0"){
			$(".se-pre-con").show();	
			$.ajax({
				url:"<?php echo base_url();?>login/login/getCaseList",
				data: {'application_no':$appNumber,'csrf_test_name':csrf_token},
				dataType: 'json',
				method:'post',
				success: function(res){			
					$("#caselistSec").html(res['data']);
					$(".se-pre-con").hide();		
				}
			}); 

		}
	});

	 $IC_ID= "";

	$(document).on('click','.Scheduled', function() {
		$Ctype = $(this).attr('data-casetype');
		$C_ID = $(this).attr('id');
		$IC_ID = $(this).attr('data-ic_id');
		$CaseType = $("#"+$C_ID+"type").text();
		//alert($CaseType);
		if($Ctype=="PMEDICAL"){

			$("#MERAppSection").hide();
			$("#pmc_id").val($C_ID);
			$("#pmic_id").val($IC_ID);
			$(".se-pre-con").show();	
			$.ajax({
				url:"<?php echo base_url();?>login/login/getCaseDetails",
				data: {'c_id':$C_ID,'csrf_test_name':csrf_token},
				dataType: 'json',
				method:'post',
				success: function(res){	
					
					$("#pmcust_id").val(res['customer_id']);					
					$("#sublocality_level_1").val(res['area']);					
					$("#lat").val(res['lat']);					
					$("#lng").val(res['lng']);
					$("#sublocality_level_2").val(res['landmark']);
					$("#postal_code").val(res['pincode']);
					$("#state").val(res['state_name']);					
					$("#cityname").val(res['cityName']);					
					$("#address1").val(res['address1']);				
					
					$("#physicalMsection").show();
					$(".se-pre-con").hide();
					/*if($IC_ID == 16){
						$str = '<option value="Center">Center</option><option value="Home">Home</option>';
						$('#visit_type').html($str);
					} */
				}
			}); 

		} else if($Ctype=='TELE'){
			$("#caseId").val($C_ID);
			$("#casetype").val($CaseType);
			$("#vmic_id").val($IC_ID);

			$("#physicalMsection").hide();
			$("#MERAppSection").show();
			updateMERAPPDate($IC_ID);

		} else{
			$("#MERAppSection").hide();
			$("#physicalMsection").hide();
		}

	});



$("#sublocality_level_1").keyup(function(){	
	$("#sublocality_level_2").val("");	
	$("#postal_code").val("");
	$("#lat").val("");
	$("#lng").val("");
});



	var today = new Date();
	var h = today.getHours();
	var d = today.getDay();
	var nextday = 1;
	if(h >= 18){
		nextday = 2;
	}

	function noFollowingMonday(thisDate) { 
	    if(today.getDay() == 0 || today.getDay() == 6){    	
	       	if(thisDate.getDay() == 1 && today.getDate() < thisDate.getDate() && Math.abs(today.getDate() - thisDate.getDate()) <7){
	           // return [false, "", "Unavailable"];
	            return [true, "", "Choose"];   
	        }       
	    }     
	    if(thisDate.getDay() == 0){
	        return [false, "", "Unavailable"];
	    } 	
	    return [true, "", "Choose"];    
	}

	$("#app_date").datepicker({ 
		dateFormat:'dd/mm/yy',
		beforeShowDay: noFollowingMonday,
		minDate: +nextday,
		maxDate: 30,
	 });

	$('#app_time').timepicker({
	    timeFormat: 'h:mm p',
	    interval: 10,
	    minTime: '7',
	    maxTime: '7:30pm',
	    defaultTime: '8',
	    startTime: '7:00',
	    dynamic: false,
	    dropdown: true,
	    scrollbar: true
	});

	// ----------------------

	var vmnextday = 0;
	
function updateMERAPPDate(icid){
	
	if(d==0){
		vmnextday = 0; 			
		getTimeSlot('equality');

	}else if(d==6 && h >= 15){ 
		vmnextday = 2; 		
		getTimeSlot('equality','');

	} else if(h <= 18 && icid ==15) {
		vmnextday = 0
		getTimeSlot('NO','');

	}else if(h >= 15 && icid !=15) {
		vmnextday = 1
		getTimeSlot('NO','');

	} else {
		vmnextday =0; 
		getTimeSlot('NO','');

	}

	$("#mer_app_date").datepicker({ 
		dateFormat:'dd/mm/yy',
		beforeShowDay: noFollowingMonday,
		minDate: +vmnextday,
		maxDate: 30,
	 });
}

	$('#mer_app_date').on('change', function(){ 

		var selectedDate = $(this).val();
	  	var date = new Date();
	  	var currentMonth = date.getMonth();
	  	var currentDate = date.getDate();
	  	var currentYear = date.getFullYear();
	  	var mDate = new Date(currentYear, currentMonth, currentDate + vmnextday);  
	  	var maxDate = new Date(currentYear, currentMonth, currentDate + 30);  
	  	var mDateD = mDate.getDate();
	 	var maxDateD = maxDate.getDate();

	  	$ddd = $(this).val();
	  	$newdate = $ddd.split('/');
	  	var selectMonth = $newdate[1];
	  	var selectDate  = $newdate[0];
	  	var selectYear  = $newdate[2];
	  	var ddd1 = selectMonth+"/"+selectDate+"/"+selectYear;	  	
	  	var ddd2 = new Date(ddd1);
	  	var d2 = ddd2.getDay();
	  	var sDateD = ddd2.getDate();
	  //	console.log(selectedDate+" "+sDateD +"!="+ mDateD);

	  	if(sDateD == mDateD && d !=6){
	  		getTimeSlot('NO',selectedDate);
	  	} else if(sDateD != mDateD){
	  		getTimeSlot('NO',selectedDate);
	  	} else{
	  		getTimeSlot('equality',selectedDate);
	  	}

	});  	
	
});

function getTimeSlot(equality,selectedDate){
	//console.log(equality);
	var vmic_id = $("#vmic_id").val();
	$.ajax({
		url: "<?php echo URL;?>check_status/Check_status/getTimeSlot",
		data: {'equality':equality,'app_date':selectedDate,'vmic_id':vmic_id,'csrf_test_name':csrf_token},
		type: "POST",
		dataType :'json',
		success: function(res){	
			if(res['status']==200){
				$("#mer_app_time").html(res['Data']);
			} else{
				$("#mer_app_time").html(res['Data']);
			}
		}
	});		
}

function getNearestDC() {
	var flag = $("#cityname").val();
	var ic_id = $("#pmic_id").val();	
	var lat = $("#lat").val();
	var lng = $("#lng").val();
	var pincode = $("#postal_code").val();	
	var visit_type = $("#visit_type").val();	

	if((lat =='' || lat =='0') && (pincode =="" || pincode=="0")) {			
		$("#displayError").html("<font color='red'>* Enter valid Pincode to get neasrest Diagnostic Center</font>");
		return false;		
	} 
	else {
	//else if(flag !='' && flag !='0'){
			$(".se-pre-con").show();
			$("#dcaddress").html("");
			$.ajax({
				url:"<?php echo base_url();?>CustAppointment/getNearestDC",
				data: {'flag':flag,'ic_id':ic_id,'lat':lat,'lng':lng,'pincode':pincode,'visit_type':visit_type,'csrf_test_name':csrf_token},
				dataType: 'json',
				method:'post',
				success: function(res){	
					if(res['status']=='success') {
						$("#DClist").html(res['option']);
						$('#DCdialog').dialog('open');						
						$(".se-pre-con").hide();		
						initMap(res['option1']);		
					} else{
						$("#displayError").html("<font color='red'>We are sorry, we are not able to find suitable medical centers near you at this point of time. We request you to kindly contact our helpline.</font>");
						$(".se-pre-con").hide();
					}
					
				
				}
		}); 
	} 
	/*else{
		$("#displayError").html("<font color='red'>Please Enter City name</font>");
		return false;			
	}*/

}

function stepValdation(){  
  var isFormValid = true;
 $(".reqrfld").each(function(){     
     $inpuval = $(this).val();   
    if ($.trim($inpuval).length == 0){      
        $(this).addClass("highlight");
        isFormValid = false;
        $(this).focus();
        return true;
    }
    else{
        $(this).removeClass("highlight");     
    }       
}); 
  return isFormValid;
}


function submitForm(){
	
	$validation = stepValdation();
	if(!$validation){
		$("#displayError").html("<font color='red'>* Please fill all fields properly !</font>");
		return false;
	}
	$("#addsave").hide();
	$(".se-pre-con").show();
	
	var act = "<?php echo base_url() ?>CustAppointment/submitAppForm";
	$("#physicalMForm").ajaxSubmit({
		url: act, 
		type: 'post',
		cache: false,
		clearForm: false,		
		success: function (response) {
			var res = eval('('+response+')');
			if(res['success'] == "1"){
				$("#msgheader").html("<font style='color:green'><b>Success</b></font>");
				$("#msgdiplay").html("<font style='color:green'>"+res['msg']+"</font>");
				$("#openconfirmationmodel").trigger('click');
				setTimeout(function(){
					$(".se-pre-con").fadeOut("slow");					
					$("#hideafter").hide();
					$("#showafter").show();
				},2000);
			}else{	
				$(".se-pre-con").fadeOut("slow");
				$("#msgheader").html("<font style='color:red'><b>Fail</b></font>");
				$("#msgdiplay").html("<font style='color:red'>"+res['msg']+"</font>");
				$("#openconfirmationmodel").trigger('click');
				return false;
			}
		},
		error:function(jqXHR, textStatus, errorThrown, data){
			console.log(errorThrown);
			console.log(data);
			console.log(textStatus);
		}
    });
}


$("#updateMERDate").click(function(){

		$casetype = $("#casetype").val();
		$caseId = $("#caseId").val();
		$appdate = $("#mer_app_date").val();
		$apptime = $("#mer_app_time").val();
		$prefered_lang = $("#prefered_lang").val();

		if($appdate !="" && $apptime !="" && $prefered_lang !="" && $prefered_lang !=null && $prefered_lang !='null'){

			$.ajax({
				url: "<?php echo URL;?>check_status/Check_status/fixedTentetiveapp",
				data: {'app_date':$appdate,'app_time':$apptime,'case_type':$casetype,'caseId':$caseId,'prefered_lang':$prefered_lang,'csrf_test_name':csrf_token},
				type: "POST",
				dataType :'json',
				success: function(res){	
					if(res['status']==200){
						alert(res['Data']);		
						
					} else{
						alert(res['Data']);		
					}
				}
			});

		} else{
			alert("Please Select Prefer Language & Date Time");
		}

	});

</script>

