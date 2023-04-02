<style type="text/css">
  .col-lg-0{ width: 11% !important; text-align: center; }
</style>
<?php 

echo $user_id = $this->session->userdata('user_id');

/*if($this->userprivileged->hasUserPrivilege("Dashboard")  && $this->session->userdata('user_id') != 248065 || $this->privilegeduser->hasPrivilege("Dashboard")  && $this->session->userdata('user_id') != 248065 ) {
} else {*/ 

?>
<style>
	.imGRounded{
	    border-radius: 30px;
		background-repeat: no-repeat;background-size: cover;height: 520px;
    }
    .imaData{
    	margin-top: 5px;
    	margin-left: 0px;
    	margin-bottom: 15px;
    	height: 100%;;
    	width:100%;
    	overflow: none;

    }
</style>
<div class="content-wrapper">
	<div class="col-sm-12">
		<div class="imaData">
			<img class="img-responsive imGRounded" src="<?php echo SITE_URL.'img/dashboard_images.png'?>" height="100%" width="100%">
		</div>
	</div>
</div>

<?php //} ?>

<script type="text/javascript">
  getPivotalData();
  function getPivotalData(){
    $icname = $("#icnames").val();
    $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/pivotalData", 
        method:'POST',
        dataType:'html',
        data : {'ic_id':$icname,'csrf_test_name':csrf_token},             
        success: function(res){ 
            $("#PivotalDataICwise").html(res);
            $(".se-pre-con").hide();
        }
    });
  }

  $("#icnames").change(function(){
    $icname = $(this).val();
    getPivotalData($icname);
  });

$("#icwisePMCases").click(function(){
  $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/getICWisePMCases", 
        method:'POST',
        dataType:'html',
        data : {'csrf_test_name':csrf_token},             
        success: function(res){ 
            $(".icwisePMCases").html(res);
            $(".se-pre-con").hide();
        }
    });

  });

  $("#branchwisePMCases").click(function(){
    $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/getBranchWisePMCases", 
        method:'POST',
        dataType:'html',
        data : {'csrf_test_name':csrf_token},             
        success: function(res){ 
            $(".branchwisePMCases").html(res);
            $(".se-pre-con").hide();
        }
    });

  });
$("#icwiseVMcases").click(function(){
  $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/getICWiseVMCases", 
        method:'POST',
        dataType:'html',
        data : {'csrf_test_name':csrf_token},             
        success: function(res){ 
            $(".icwiseVMcases").html(res);
            $(".se-pre-con").hide();
        }
    });

  });

$("#medicalwiseVMcases").click(function(){
  $(".se-pre-con").show();
    $.ajax({              
        url:"<?php echo URL;?>home/home/getMedicalWiseVMcases", 
        method:'POST',
        dataType:'html',
        data : {'csrf_test_name':csrf_token},             
        success: function(res){ 
            $(".medicalwiseVMcases").html(res);
            $(".se-pre-con").hide();
        }
    });

  });


</script>

