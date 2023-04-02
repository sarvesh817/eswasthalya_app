<style>
    .labelBottom{
        margin-bottom: 10px;
        margin-top: 10px;
    }
    .select2-selection--multiple .select2-selection__rendered { 
        max-height: 50px !important; overflow-y: auto !important;
    }
</style>

<div class="content-wrapper" style="min-height: 901px;">
    <section class="content">
        <div class="row">
            <div style="padding : 0px 10px;">
                <div class="box box-info">              
                    <div class="box-header with-border">
                        <h3 class="box-title"><span style="font-size: 20px; color: #0a0a0a; margin: 0 516px 0px;">Forgot Password</span></h3>
                    </div>
                </div>
                
                <div class="box box-info box-body">
                    <?php echo form_open(URL.'reset_ProfilePassword', array("class"=>"form-horizontal", "id"=>"resetSubmitForm", "method"=>"post"));?>
                        <input type="hidden" name="key" value="<?php echo $this->session->userdata('user_id');?>">
                        <div class="col-sm-12 form-group">
                            <label for="old_password" class="col-sm-4 form-label">Old Password :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="old_password" name="old_password" value="" placeholder="Enter Old Password" autocomplete="off">
                                <span id="error_old_password" style="color: red"></span>                                   
                            </div>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="new_password" class="col-sm-4 form-label">New Password :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter New Password" autocomplete="off">
                                <span id="error_new_password" style="color: red"></span>                                   
                            </div>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="confirm_password" class="col-sm-4 form-label">Confirm Password :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" autocomplete="off">
                                <span id="error_confirm_password" style="color: red"></span>                                   
                            </div>
                        </div>

                        <div class="col-sm-12 form-group">
                            <p align="center">
                                <button type="button" id="resetSubmit" class="btn btn-primary">Reset Password</button>
                            </p>
                        </div>
                    <?php echo form_close();?>
                </div>
                
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function(){
        $('#resetSubmit').click(function(){
            var old_password = $('#old_password').val();
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();
            var error = false;
            if(old_password == ''){
                $('#error_old_password').html('Please Enter Old Password');
                error = true;
            }
            if(new_password == ''){
                $('#error_new_password').html('Please Enter New Password');
                error = true;
            }
            if(confirm_password == ''){
                $('#error_confirm_password').html('Please Enter Confirm Password');
                error = true;
            }
            if(new_password != confirm_password){
                $('#error_confirm_password').html('New Password is Not Matched with Confirm Password...');
                error = true;
            }
            if(error === false ){
                $('#resetSubmitForm').submit();

            }

        });

        $(document).on('keyup','#old_password',function(){
            $('#error_old_password').html('');
        });
        $(document).on('keyup','#new_password',function(){
            $('#error_new_password').html('');
        });
        $(document).on('keyup','#confirm_password',function(){
            $('#error_confirm_password').html('');
        });

        var URL = '<?php echo URL;?>';
        
        $(document).on('blur','#old_password',function(){
            var old_password = $('#old_password').val();
            var user_id = '<?php echo $this->session->userdata('user_id');?>';
            if(old_password !='' && old_password.length > 6){
                $.ajax({
                    url: URL+'checkOldPassword',
                    type: 'post',
                    data: {old_password:old_password,user_id:user_id,'csrf_test_name':csrf_token},
                    dataType: 'json',
                    success: function(res){
                        if(res['msg'] != 'Password Matched'){
                            setTimeout(function(){
                                $('#error_old_password').html(res['msg']);
                            },500);
                        }                        
                    }
                });
            }
        });
    });
</script>