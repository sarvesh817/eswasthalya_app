// All JS code below related to Click to call fro VMER and Physical MEdica
	$(function () {
        $("#clicktocalldialog").dialog({
            modal: true,
            autoOpen: false,
            resizable: false,  
            title: "Start Calling...",
            width: 575
           
        });


    });

    $("#UpdateInBoundCallData").click(function(){
		$formValid = false;
		$call_status = $('#inbcase_call_status').val();
		
		$level_one = $('#level_one').is(':checked');
		$level_two = $('#level_two').is(':checked');
		$level_three = $('#level_three').is(':checked');
		$client_lead_email = $('#client_lead_email').is(':checked');
		

		$inbcall_id = $("#inbcall_id").val();
		$inbcasecode = $("#inbcasecode").val();
		$inbcall_sub_category = $("#inbcall_sub_category").val();


		if($call_status == 'Open'){
    		if($client_lead_email == true){
    			if(($level_one == false) && ($level_two == false)){
    				alert('Select Level1 OR Level2 OR Both.');
					$formValid = false;
    			}else{
    				$formValid = true;
    			}					
			}else if(($level_one==true) || ($level_two==true) || ($level_three==true)){
				$formValid = true;
			} else {
				alert('Select Level1 OR Level2 OR Level3.');
				$formValid = false;
			}
		}else if($inbcall_id=="" ){
			$(".Liveerror").html('Call Id not Found Please copy call id from partner dashboard');
			$formValid = false;

		} else if($inbcall_id.length<10){
			$(".Liveerror").html('Call Id is invalid Please copy call id from partner dashboard');
			$formValid = false;

		} else if($inbcasecode ==""){
			$(".Liveerror").html('Case Code not Found Please check manually');
			$formValid = false;

		}else{
			$formValid = true;
		}

		//alert($formValid);

		if($formValid == true){
		 	var formdata = $("#addIBCFormData").serialize();
			$.ajax({
		        type : 'post',
		        url : URL+'customerservice/Addqrc/addIBCallCData', 
		        data :{formdata:formdata,'csrf_test_name':csrf_token},
		        dataType : 'json',
		        beforeSend:function(){
	              	$(".se-pre-con").show();
      				$("#UpdateInBoundCallData").prop('disabled', true);
	            },
		        success: function(data){
		        	//console.log(data); 
		           	if(data['status'] == '200'){
		           		$(".Liveerror").html(data['message']);
                    	if( data['urllocation'] !="" && ($inbcall_sub_category=="Add New Case" || $inbcall_sub_category=="Change in appointment" || $inbcall_sub_category=="Appointment schedule" || $inbcall_sub_category=="Change in Welnext branch")){
                    		 window.location.href = data['urllocation'];
                    	} else{
                    		$(".se-pre-con").hide();
                    		location.reload();		
                    	}
                    }
                }    		        
		    });
		}
		
	});

	/*$("#UpdateInBoundCallData").click(function(){

		$inbcall_id = $("#inbcall_id").val();
		$inbcasecode = $("#inbcasecode").val();
		$inbcall_sub_category = $("#inbcall_sub_category").val();
		if($inbcall_id=="" ){
			$(".Liveerror").html('Call Id not Found Please copy call id from partner dashboard');
			return false;

		} else if($inbcall_id.length<10){
			$(".Liveerror").html('Call Id is invalid Please copy call id from partner dashboard');
			return false;

		} else if($inbcasecode ==""){
			$(".Liveerror").html('Case Code not Found Please check manually');
			return false;

		} else{

			var formdata = $("#addIBCFormData").serialize();
			$.ajax({
		        type : 'post',
		        url : URL+'customerservice/Addqrc/addIBCallCData', 
		        data :{formdata:formdata,'csrf_test_name':csrf_token},
		        dataType : 'json',
		        success: function(data){
		        	//console.log(data); 
		           	if(data['status'] == '200'){
                    	$(".Liveerror").html(data['message']);
                    	if( data['urllocation'] !="" && ($inbcall_sub_category=="Add New Case" || $inbcall_sub_category=="Change in appointment" || $inbcall_sub_category=="Appointment schedule" || $inbcall_sub_category=="Change in Welnext branch")){
                    		 window.location.href = data['urllocation'];
                    	} else{
                    		
                    	}
                    }
                }    		        
		    });
		}
		// else{
		// 	$(".Liveerror").html('Call Id / Case Code not Found Please check manually');
		// }
		
	});*/	
		

		$(document).on('click',".clickToCallCustomer", function(){

			//$attrCasedata = $(this).attr('data-casedata');
	        
	        $customerName = $(this).attr('data-custname');
	        $customer_number = $(this).attr('data-ccnumber');
	        $profile_type = $(this).attr('data-profile_type');

	        $c_id = $(this).attr('data-c_id');
	        $applicationno = $(this).attr('data-application');	        
	        $app_id = $(this).attr('data-app_id');
	        $mer_type = $(this).attr('data-mer_type');
	        $c_type = $(this).attr('data-c_type');

	        $salesName = $(this).attr('data-salesname');
	        $saleNum   =  $(this).attr('data-salenum');

	        $lastNumSales = "XXXXX"+$saleNum.substr($saleNum.length - 5);

	        $icName = $(this).attr('data-icname');
	        $ic_idD = $(this).attr('data-ic_id');	        
	       
	        $attrCasedata = $c_id+'|'+$applicationno+'|'+$app_id+'|'+$customer_number+'|VMER|'+$saleNum+'|'+$profile_type;

	        $("#startCall").parent().find('span').remove();	        

		    if($icName !="" && $icName !=undefined ){
		        $icName = "Start Calling ("+$icName+")";
		    } else{
		    	$icName = "Start Calling";
		    }
		    
		    $("#clicktocalldialog").dialog('option', 'title', $icName);
	       	$("#call_data").val($attrCasedata);	
	       	$("#call_data_sales").val($attrCasedata);	
	        

	        if(($ic_idD=='8' || $ic_idD=='15') && $mer_type=='Video MER' && $saleNum !=''){
	        	//$('.salesAgent').show();
	        	$("#sendLink1").hide();
		    } else if($ic_idD=='16' && ($mer_type=='Video MER' || $mer_type=='Physical Videography') ){
		    	//$('.salesAgent').hide();
		    	$("#sendLink1").show();

		    } else{
		    	//$('.salesAgent').hide();
		    	$("#sendLink1").hide();
		    }

		     if($saleNum !=""){
	        	$('.salesAgent').show();
	        } else{
	        	$('.salesAgent').hide();
	        }
		    

			if($c_type=='NORMAL'){

				$("#taCode").html($c_id);	
				$casetypes = "NORMAL";
				$editURL  = $(this).attr('data-editurl');				
				$("#scheduleDoctor").hide();
				$("#startMERNOW").text("Appointment");
				$("#startMERNOW").css("float",'left');

			} else{
				$("input:checkbox").each(function() {
			    	$("input:checkbox").prop('checked',false);
				});
				$(this).closest('tr').find('input:checkbox').prop('checked',true);

				$("#taCode").html("VM0"+$c_id);
				$("#startMERNOW").text("Start MER");
				$("#scheduleDoctor").show();
				$casetypes = "VMER";
			}	       

	        if($profile_type=="NRI"){  
	        	$("#nri_isdcc").show();
	        	$lastNumb = $customer_number;
	        	getCountryTimeZone($customer_number);

	        } else{
	        	$lastNumb = "XXXXX"+$customer_number.substr($customer_number.length - 5);
	        	$("#nri_isdcc").hide();
	        }

	        $("#Capplication").html($applicationno);
	        $("#customerName").text($customerName);
	        $("#salesName").text($salesName);
	       // $("#ic_idD").val($ic_idD);
	        $("#customer_number").val($customer_number);
	        $("#sales_number").val($saleNum);
	        $("#displayNum").text($lastNumb);
	        $("#displayNumSales").text($lastNumSales);
	        $("#case_type").val($c_type);
	        getCaseStatusforCall($c_type,$c_id);
	        $("#callInProgess").html('Click on green call icon to call ...')
	        $('#clicktocalldialog').dialog('open');

		});

		$("#canceledCall").click(function(){		  	
		  	$("#startCall").show();
		  	$("#canceledCall").hide();
		  	$("#clicktocalldialog").dialog("close");
		});

		$("#canceledCallAgent").click(function(){		  	
		  	//$('#startCall').removeAttr('disabled');
		  	$("#startCallAgent").show();
		  	$("#canceledCallAgent").hide();
		  	$("#clicktocalldialog").dialog("close");
		});


		$("#startCall").click(function(){
			//$(this).attr('disabled','disabled');
			$(this).hide();
			$("#canceledCall").show();

	    	$attrCasedata    = $("#call_data").val();    		
	    	$customer_number = $("#customer_number").val();
	    	$agent_number    = $("#agent_number").val();
	    	$session_user_id = $("#session_user_id").val();

	    	$casedata = $attrCasedata.split('|');
	        $c_id = $casedata[0];
	        $applicationno = $casedata[1];
	        $mer_app_id = $casedata[2];
	        $c_type = $casedata[4];
	        $profile_type = $casedata[6];

	        $cc = $("#countryC").val();
	        if($cc!=""){
	        	$country = $cc;	
	        } else{
	        	$country = "no";
	        }

	        //console.log($country);


		    if(activeCallVendor!='Ubona' && activeCallVendor=='Knowlarity' ){
	        	$callURL = URL+'vendorsapi/Knowalrity/clickToCallCustomer';
	        
	        } else if(activeCallVendor=='Ubona' && activeCallVendor!='Knowlarity'){
	        	$callURL = URL+'vendorsapi/Ubona/clickToCallCustomer';
	        
	        } else if(activeCallVendor=='UbonaNew' && activeCallVendor!='Knowlarity'){
	        	$callURL = URL+'vendorsapi/Ubona/clickToCallManual';
	        } else{
	        	$callURL ="";
	        	alert("call Not Allow");
	        	return false;
	        }

	        //$callURL = URL+'vendorsapi/Ubona/clickToCallCustomer';


	        var formdata = {
		          'c_id': $c_id,
		          'application_no': $applicationno,
		          'app_id': $mer_app_id,          
		          'c_type': $c_type,
		          'customer_number':$customer_number,
		          'agent_number':$agent_number,
		          'CallTo':'CUSTOMER'
		        }

	        if($profile_type !="NRI"){

		        if($customer_number.length >=10 && $agent_number.length>=10){
		        	$triggerCall="OK";
		        } else{
		        	$triggerCall="NO";
				}

	        } else if($profile_type=="NRI" && ($country =="IN" || $country =="India" || $country =="INDIA") ){
	        	
	        	if($customer_number.length >=10 && $agent_number.length>=10){
	        		$triggerCall="OK";
		        } else{
		        	$triggerCall="NO";					
				}

	        } else{

	        	$callURL = URL+'master/master/twilopOutBondCall';
	        	$triggerCall="OK";
	        }

	        if($triggerCall=="OK"){

	        	$.ajax({
		          url:$callURL, 
		          method:'POST',
		          dataType:'json',
		          data : {'formdata':formdata,'csrf_test_name':csrf_token},		          
		          success: function(res){ 
		            if(res['status'] == 'Success'){
		              $("#callInProgess").html(res['call_status']+' Please wait while we connect your Call ');
		            } else{
		              $("#callInProgess").html(res['call_status']);
		            }
		          }
		        });

		    } else{
		    	$("#callInProgess").html('<span style="color:red">Please check Custome/Caller number.. </span>');
		    }

	    });

		

		$("#startCallAgent").click(function(){
			//$(this).attr('disabled','disabled');
			$(this).hide();
			$("#canceledCallAgent").show();

	    	$attrCasedata = $("#call_data").val();    		
	    	//$customer_number = $("#customer_number").val();
	    	$sales_number = $("#sales_number").val();
	    	$agent_number = $("#agent_number").val();
	    	$session_user_id = $("#session_user_id").val();

		 	$casedata = $attrCasedata.split('|');
	        $c_id = $casedata[0];
	        $applicationno = $casedata[1];
	        $mer_app_id = $casedata[2];
	        $c_type = $casedata[4];

			var formdata = {
	          'c_id': $c_id,
	          'application_no': $applicationno,
	          'app_id': $mer_app_id,          
	          'c_type': $c_type,
	          'agent_number':$agent_number,
	          //'salesNumB':$sales_number,
	          'customer_number':$sales_number,
	          'CallTo':'SALES'
	        }
	        

		    if(activeCallVendor!='Ubona' && activeCallVendor=='Knowlarity' ){
	        	$callURL = URL+'vendorsapi/Knowalrity/clickToCallAgent';

	        } else if(activeCallVendor=='Ubona' && activeCallVendor!='Knowlarity'){
	        	$callURL = URL+'vendorsapi/Ubona/clickToCallCustomer';

	        } else if(activeCallVendor=='UbonaNew' && activeCallVendor!='Knowlarity'){
	        	$callURL = URL+'vendorsapi/Ubona/clickToCallManual';
	        	
	        } else{
	        	$callURL ="";
	        	alert("call Not Allow");
	        	return false;
	        }

	        //console.log(formdata);
	        if($customer_number.length >=10 && $agent_number.length>=10){
				$.ajax({
		          url:$callURL, 
		          method:'POST',
		          dataType:'json',
		          data : {'formdata':formdata,'csrf_test_name':csrf_token},		          
		          success: function(res){ 
		            if(res['status'] == 'Success'){
		              $("#callInProgess").html(res['call_status']+' Please wait while we connect your Call ');
		            } else{
		              $("#callInProgess").html(res['call_status']);
		            }
		          }
		        });

			} else{
				$("#callInProgess").html('<span style="color:red">Please check Custome/Caller number.. </span>');
			}
		});



	function getCountryTimeZone(customer_number){

    	$isd_code = customer_number;
    	//console.log($isd_code);
	   	if($isd_code !=""){

	   		$("#startCall").parent().find('span').remove();
	    	$.ajax({
				url:URL+'getcountrytime',
				method:'POST',
				data:{'isd_code':$isd_code,'csrf_test_name':csrf_token},
				dataType:'html',
				success:function(res){
					$Datetime = res.split("|")[0];
					$Hour = res.split("|")[1];			
					$CC = res.split("|")[2];			
					$("#cuntrytime").html($Datetime);
					$("#countryC").val($CC);
					if($Hour>=22 || $Hour <=8){
						$("#startCall").hide();
						$("#startCall").parent().append("<span>Call not allow due to time</span>");
					} else{		
						$("#startCall").show();
					}
				},
			});

 	   } else{
 	   		//$("#startCall").parent().append("<span>Call not allow due to time</span>");
 	   }

    };