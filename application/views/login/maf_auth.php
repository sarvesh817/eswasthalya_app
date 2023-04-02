<?php 
	$hash = $this->security->get_csrf_hash();
?>
<style>
body  { 
background-image: url("<?php echo SITE_URL;?>public/dist/img/home-banner-doctor.jpg");
background-repeat: no-repeat;
background-size: cover;
height:auto; 
}
.has-feedback label~.form-control-feedback {top: 0;}
label{width:100%;}
.font{ font-family:Verdana;}
.font.show-msg{text-align: center;margin: 0 auto;padding-top:10px;}
.btnCenter{text-align:center;width: 100px;margin: 0 auto;}
.show_msg{color: red;}

</style>
<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="<?php echo SITE_URL;?>public/dist/img/image-logo-welnext.png"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" id="login_form" style="border-radius: 10px !important;background-color: #EFF3FB !important; height: 160px;">
    <p style="text-align:center;font-size: 11px;">OTP send on your registered Email Id Please Inbox/spam folder</p>
  	<p style="text-align: center; color: red;"><strong>Please Enter OTP</strong></p>
  	<?php echo form_open(URL."login/login/mfaAuthentication", array('id' => 'form-validate', 'class'=>'form_validate','autocomplete'=>'off'));?>
    		<input type="password" name="mfa_otp" id="mfa_otp" class="form-control" placeholder="Enter OTP" autocomplete="off" /> <!-- mfa_status  mfa_otp  mfa_validity -->
    		<input type="hidden" name="authotp" id="authotp" value="<?php echo $authotp; ?>" />
    		<input type="hidden" name="emailid" id="emailid" value="<?php echo $emailid; ?>" />
    		<input type="hidden" name="mfapassword" id="mfapassword" value="<?php echo $mfapassword; ?>" /> 
    		<input type="submit" name="mfaValidate" value="Submit" class="btn btn-primary pull-right" style="margin: 10px;" />

    <?php echo form_close(); ?>
    <div class="show_msg" id="err"><?php echo $this->session->flashdata('item'); ?></div>
  </div>
	
</div>


<script type="text/javascript" nonce="<?php echo $hash; ?>">

$("#waiting").click(function() {
		$("#loaddingMess").show();
});


</script>

