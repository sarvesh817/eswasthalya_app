
<?php //print_r($doctor_info_edit[0]); exit;?>


<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="#">Home</a></li>
          <li class="breadcrumb-item">Doctor</li>
          <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
      </div>
    </div> <!-- .row end -->
    <div class="row align-items-center">
      <div class="col-auto">
    </div> <!-- .row end -->
  </div>
</div>
<!-- start: page body -->
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
  <div class="container-fluid">
    <form action="<?=base_url('doctors/profile-update')?>" enctype="multipart/form-data" method="post">
    <div class="row g-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title mb-0">Basic Information</h6>
            <div class="dropdown morphing scale-left">
              <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
              <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
              <ul class="dropdown-menu shadow border-0 p-2">
                <li><a class="dropdown-item" href="#">File Info</a></li>
                <li><a class="dropdown-item" href="#">Copy to</a></li>
                <li><a class="dropdown-item" href="#">Move to</a></li>
                <li><a class="dropdown-item" href="#">Rename</a></li>
                <li><a class="dropdown-item" href="#">Block</a></li>
                <li><a class="dropdown-item" href="#">Delete</a></li>
              </ul>
            </div>
          </div>

          <div class="card-body">
            <div class="row g-3">

               <div class="col-lg-9">
                <label class="form-label">Upload Photo</label>
                <input type="file" name="photo" value="" class="form-control">
                <input type="hidden" name="oldphoto" value="<?php if(isset($doctor_info_edit[0]['photo'])){ echo $doctor_info_edit[0]['photo']; } ?>" class="form-control">
              </div>
            
              <div class="col-lg-3">
                <?php if(isset($doctor_info_edit[0]['photo']) && $doctor_info_edit[0]['photo'] !=''){  ?>
                <img src="<?php echo base_url() ?>img/doctor_upload/<?php echo $doctor_info_edit[0]['photo']; ?>" style="width: 80px; height: 90px;">
                <?php } ?>
              </div>

              <div class="col-sm-6">
                <label class="form-label">Name</label>
                <input type="text" disabled name="cname" id="name" value="<?php if(!empty($this->session->userdata('name'))) { echo $this->session->userdata('name'); }?>" class="form-control form-control-lg">
              </div>

              <div class="col-sm-6">   
                <label class="form-label">Father/Husband Name</label>
                <input type="text" class="form-control form-control-lg" name="father_name" id="father_name" value="<?php if(isset($doctor_info_edit[0]['father_name'])){ echo $doctor_info_edit[0]['father_name']; } ?>">
              </div>                 

              <div class="col-sm-3">
                <label class="form-label">Gender</label>
                <select class="form-control form-control-lg" name="gender" tabindex="-98">
                  <option value="">- Select -</option>
                  <option value="Male" <?php if(isset($doctor_info_edit[0]['gender']) && $doctor_info_edit[0]['gender'] =='Male'){ echo 'selected'; } ?>>Male</option>
                  <option value="Female" <?php if(isset($doctor_info_edit[0]['gender']) && $doctor_info_edit[0]['gender'] =='Female'){ echo 'selected'; } ?>>Female</option>
                </select>
              </div>
              <div class="col-sm-3">
                <label class="form-label">Marital Status</label>
                <select class="form-control form-control-lg" name="marital_status" tabindex="-98">
                  <option value="">- Select -</option>
                  <option value="Single"<?php if(isset($doctor_info_edit[0]['marital_status']) && $doctor_info_edit[0]['marital_status'] =='Single'){ echo 'selected'; } ?>>Single</option>
                  <option value="Married"<?php if(isset($doctor_info_edit[0]['marital_status']) && $doctor_info_edit[0]['marital_status'] =='Married'){ echo 'selected'; } ?>>Married</option>
                  <option value="Widowed"<?php if(isset($doctor_info_edit[0]['marital_status']) && $doctor_info_edit[0]['marital_status'] =='Widowed'){ echo 'selected'; } ?>>Widowed</option>
                  <option value="Separated"<?php if(isset($doctor_info_edit[0]['marital_status']) && $doctor_info_edit[0]['marital_status'] =='Separated'){ echo 'selected'; } ?>>Separated</option>
                  <option value="Not Specified"<?php if(isset($doctor_info_edit[0]['marital_status']) && $doctor_info_edit[0]['marital_status'] =='Not Specified'){ echo 'selected'; } ?>>Not Specified</option>
                </select>
              </div>

              <div class="col-sm-3">
                <label class="form-label">Blood Group</label>
                <select class="form-control form-control-lg" name="blood_group" tabindex="-98">
                  <option class="option" value="">Select</option>
                    <option value="A+"<?php if(isset($doctor_info_edit[0]['blood_group']) && $doctor_info_edit[0]['blood_group'] =='A+'){ echo 'selected'; } ?>>A+</option>
                    <option value="B+"<?php if(isset($doctor_info_edit[0]['blood_group']) && $doctor_info_edit[0]['blood_group'] =='B+'){ echo 'selected'; } ?>>B+</option>
                    <option value="O+"<?php if(isset($doctor_info_edit[0]['blood_group']) && $doctor_info_edit[0]['blood_group'] =='O+'){ echo 'selected'; } ?>>O+</option>
                    <option value="AB+"<?php if(isset($doctor_info_edit[0]['blood_group']) && $doctor_info_edit[0]['blood_group'] =='AB+'){ echo 'selected'; } ?>>AB+</option>
                    <option value="A-"<?php if(isset($doctor_info_edit[0]['blood_group']) && $doctor_info_edit[0]['blood_group'] =='A-'){ echo 'selected'; } ?>>A-</option>
                    <option value="B-"<?php if(isset($doctor_info_edit[0]['blood_group']) && $doctor_info_edit[0]['blood_group'] =='B-'){ echo 'selected'; } ?>>B-</option>
                    <option value="O-"<?php if(isset($doctor_info_edit[0]['blood_group']) && $doctor_info_edit[0]['blood_group'] =='O-'){ echo 'selected'; } ?>>O-</option>
                    <option value="AB-"<?php if(isset($doctor_info_edit[0]['blood_group']) && $doctor_info_edit[0]['blood_group'] =='AB-'){ echo 'selected'; } ?>>AB-</option>
                </select>
              </div>

              <div class="col-sm-3">
                <label class="form-label">Date of Birth<span class="required_asterisk">*</span><?php echo form_error('birth_date', "<span style='color:red; font-size:13px'>","</span>") ?></label>
                <input type="date" name="birth_date" value="<?php if(isset($doctor_info_edit[0]['birth_date'])){ echo $doctor_info_edit[0]['birth_date']; } ?>" class="form-control form-control-lg" placeholder="Enter here">
              </div> 

              <!--<div class="col-sm-3">
                <label class="form-label">Date Of Joining<span class="required_asterisk"></span><?php echo form_error('joining_date', "<span style='color:red; font-size:13px'>","</span>") ?></label>
                <input type="date" name="joining_date" maxlenth="10" value="<?php if(isset($doctor_info_edit[0]['joining_date'])){ echo $doctor_info_edit[0]['joining_date']; } ?>" class="form-control form-control-lg" placeholder="Enter here">
              </div> -->                 

              <div class="col-sm-3">
                <label class="form-label">Mobile<span class="required_asterisk">*</span><?php echo form_error('contact_no', "<span style='color:red; font-size:13px'>","</span>") ?></label>
                <input type="tel" name="contact_no" id="contact_no" minlength="10" maxlength="10" required value="<?php if(!empty($this->session->userdata('userContact'))) { echo $this->session->userdata('userContact'); }?>" class="form-control form-control-lg" placeholder="Enter here Mobile" pattern="[789][0-9]{9}">
              </div>

              <div class="col-sm-3">
                <label class="form-label">Email Id<span class="required_asterisk">*</span><?php echo form_error('emailid', "<span style='color:red; font-size:13px'>","</span>") ?></label>
                <input type="text" disabled  name="emailid" id="emailid" value="<?php if(!empty($this->session->userdata('email'))) { echo $this->session->userdata('email'); }?>" class="form-control form-control-lg" placeholder="Enter here Email Id">
              </div>

              <div class="col-sm-3">
                <label class="form-label">Specialization</label>
                <select name="specialization" class="form-control form-control-lg" tabindex="-98">
                    <option value="">- Select -</option>
                    <?php 
                    if(isset($specialityData) && $specialityData !='') {
                    foreach($specialityData as $row) { ?>
                        <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $doctor_info_edit[0]['specialization']){ echo "selected"; }?>><?php echo $row['speciality'];?></option>
                    <?php } } ?>    
                </select>
              </div>
              
              <div class="col-sm-3">
                <label class="form-label">Current Address</label>
                <input type="text" name="current_address" id="current_address"  value="<?php if(isset($doctor_info_edit[0]['current_address'])){ echo $doctor_info_edit[0]['current_address']; } ?>"  class="form-control form-control-lg" placeholder="Current Address">
              </div>

              <div class="col-sm-3">
                <label class="form-label">Permanent Address</label>
                <input type="text" name="permanent_address" id="permanent_address"  value="<?php if(isset($doctor_info_edit[0]['permanent_address'])){ echo $doctor_info_edit[0]['permanent_address']; }?>"  class="form-control form-control-lg" placeholder="Permanent Address">
              </div>

              <div class="col-sm-3">
                <label class="form-label">Qualification</label>
                <input type="text" name="qualification" id="qualification" value="<?php if(isset($doctor_info_edit[0]['qualification'])){ echo $doctor_info_edit[0]['qualification']; } ?>"  class="form-control form-control-lg" placeholder="Qualification">
              </div>

              <div class="col-sm-3">
                <label class="form-label">Work Experience</label>
                <input type="text" name="work_experience" id="work_experience" value="<?php if(isset($doctor_info_edit[0]['work_experience'])){ echo $doctor_info_edit[0]['work_experience']; } ?>"  class="form-control form-control-lg" placeholder="Work Experience">
              </div>

              <div class="col-sm-3">
                <label class="form-label">Pan Number</label>
                <input type="text" name="pan_number" id="pan_number" minlength="10" maxlength="10" required value="<?php if(isset($doctor_info_edit[0]['pan_number'])) { echo $doctor_info_edit[0]['pan_number']; } ?>"   class="form-control form-control-lg" placeholder="Enter here Pan Number">
              </div>

              <div class="col-sm-3">
                <label class="form-label">Aadhar Number</label>
                <input type="text" name="aadhar_number" id="aadhar_number" minlength="12" maxlength="12" required value="<?php if(isset($doctor_info_edit[0]['aadhar_number'])){ echo $doctor_info_edit[0]['aadhar_number']; } ?>"   class="form-control form-control-lg" placeholder="Like 000000000000 ">
              </div>

              <div class="col-sm-3">
                <label class="form-label">Basic/Consultant Fees</label>
                <input type="text" name="basic_salary" id="basic_salary" value="<?php if(isset($doctor_info_edit[0]['basic_salary'])){ echo $doctor_info_edit[0]['basic_salary']; } ?>"  class="form-control form-control-lg" placeholder="Enter here">
              </div>

              <div class="col-sm-3">
                <label class="form-label">Contract Type</label>
                <select class="form-control form-control-lg" name="contract_type" tabindex="-98">
                  <option class="option" value="">Select</option>
                    <option value="Permanent" <?php if(isset($doctor_info_edit[0]['contract_type']) && $doctor_info_edit[0]['contract_type'] =='Permanent'){ echo 'selected'; } ?>>Permanent</option>
                    <option value="Consultant" <?php if(isset($doctor_info_edit[0]['contract_type']) && $doctor_info_edit[0]['contract_type'] =='Consultant'){ echo 'selected'; } ?>>Consultant</option>
                    <option value="Non Consultant" <?php if(isset($doctor_info_edit[0]['contract_type']) && $doctor_info_edit[0]['contract_type'] =='Non Consultant'){ echo 'selected'; } ?>>Non-Consultant</option>
                </select>
              </div>

              <div class="col-sm-12">
                <label class="form-label">Description</label>
                <input type="text" name="your_self" id="your_self" value="<?php if(isset($doctor_info_edit[0]['your_self'])){ echo $doctor_info_edit[0]['your_self']; } ?>"  class="form-control form-control-lg" placeholder="Write about your self">
              </div>

                <div class="col-lg-4">
                <label class="form-label">Upload Signature</label>
                <input type="file" name="signature" value=""  class="form-control">
                <input type="hidden" name="oldsignature" value="<?php if(isset($doctor_info_edit[0]['signature'])){ echo $doctor_info_edit[0]['signature']; } ?>" class="form-control">
              </div>

              <div class="col-lg-4">
                <label class="form-label">Upload Joining/Contract Letter</label>
                <input type="file" name="joining_letter"  value="" class="form-control">
                <input type="hidden" name="oldletter" value="<?php if(isset($doctor_info_edit[0]['joining_letter'])){ echo $doctor_info_edit[0]['joining_letter']; } ?>" class="form-control">   
              </div>

              <div class="col-lg-4">
                <label class="form-label">Certificate/Other Documents</label>
                <input type="file" name="other_document" value="" class="form-control">
                <input type="hidden" name="olddocument" value="<?php if(isset($doctor_info_edit[0]['other_document'])){ echo $doctor_info_edit[0]['other_document']; } ?>" class="form-control">   
              </div>


              <div class="col-lg-4">
                <?php if(isset($doctor_info_edit[0]['signature']) && $doctor_info_edit[0]['signature'] !=''){  ?>   
                <img src="<?php echo base_url() ?>img/doctor_upload/<?php echo $doctor_info_edit[0]['signature']; ?>" style="width: 80px; height: 90px;">
                <?php } ?>
              </div>


                <div class="col-lg-4">
                <?php
                if(isset($doctor_info_edit[0]['joining_letter']) && $doctor_info_edit[0]['joining_letter'] !=''){ 
                if(strpos($doctor_info_edit[0]['joining_letter'], "pdf") !== false){ ?>
                <a href="<?php echo base_url('img/doctor_upload/').$doctor_info_edit[0]['joining_letter'] ?>" > Joining  Document </a>
                <?php }else{
                if(isset($doctor_info_edit[0]['joining_letter']) && $doctor_info_edit[0]['joining_letter'] !=''){  ?>
                <img src="<?php echo base_url() ?>img/doctor_upload/<?php echo $doctor_info_edit[0]['joining_letter']; ?>" style="width: 80px; height: 90px;">
                <?php }
                
                } } ?>
              </div>


              <div class="col-lg-4">
                <?php
                if(isset($doctor_info_edit[0]['other_document']) && $doctor_info_edit[0]['other_document'] !=''){
                if(strpos($doctor_info_edit[0]['other_document'], "pdf") !== false){ ?>
                <a href="<?php echo base_url('img/doctor_upload/').$doctor_info_edit[0]['other_document'] ?>" > Other  Document </a>
                <?php }else{
                if(isset($doctor_info_edit[0]['other_document']) && $doctor_info_edit[0]['other_document'] !=''){  ?>
                <img src="<?php echo base_url() ?>img/doctor_upload/<?php echo $doctor_info_edit[0]['other_document']; ?>" style="width: 80px; height: 90px;">
                <?php }
                
                } } ?>
              </div>



              <!-- <div class="col-sm-3">
                <label class="form-label">Doctor Status</label>
                <select class="form-control form-control-lg" name="status" tabindex="-98">
                  <option value="">- Select -</option>
                  <option value="1" <?php echo  set_select('status', '1'); ?>>Available</option>
                  <option value="0" <?php echo  set_select('status', '0'); ?>>Unavailable</option>
                </select>
              </div> -->

            </div>
          </div>              
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title mb-0">Doctor's Bank Account Information</h6>
            
          </div>
          <div class="card-body">
            <div class="row g-3">

              <div class="col-sm-6">
                <label class="form-label">Account Nature</label>
                <input type="text" name="account_title" id="account_title" value="<?php if(isset($doctor_info_edit[0]['account_title'])){ echo $doctor_info_edit[0]['account_title']; } ?>"  class="form-control form-control-lg" placeholder="Enter here Account Nature">
              </div>

              <div class="col-sm-6">
                <label class="form-label">Account Number</label>
                <input type="text" name="bank_account" id="bank_account" value="<?php if(isset($doctor_info_edit[0]['bank_account'])){ echo $doctor_info_edit[0]['bank_account']; } ?>"  class="form-control form-control-lg" placeholder="Enter here Account Number">
              </div>

              <div class="col-sm-6">
                <label class="form-label">Bank Name</label>
                <input type="text" name="bank_name" id="bank_name" value="<?php if(isset($doctor_info_edit[0]['bank_name'])){ echo $doctor_info_edit[0]['bank_name']; } ?>" class="form-control form-control-lg" placeholder="Enter here Bank Name">
              </div>

              <div class="col-sm-6">
                <label class="form-label">IFSC Code</label>
                <input type="text" name="ifsc_code" id="ifsc_code" value="<?php if(isset($doctor_info_edit[0]['ifsc_code'])){ echo $doctor_info_edit[0]['ifsc_code']; } ?>"  class="form-control form-control-lg" placeholder="Enter here IFSC Code">
              </div>

              <div class="col-sm-6">
                <label class="form-label">Branch Name</label>
                <input type="text" name="bank_branch_name" id="bank_branch_name" value="<?php if(isset($doctor_info_edit[0]['bank_branch_name'])){ echo $doctor_info_edit[0]['bank_branch_name']; } ?>"  class="form-control form-control-lg" placeholder="Enter here Branch Name">
              </div>
              
            </div>
          </div>
          <div class="card-footer">
            <input type="submit" name="submit" id="submit" value="Update Details" class="btn btn-primary" style="float:right" />   
            <!-- <button type="submit" class="btn btn-primary">Create</button> -->                                
          </div>
        </div>
      </div>
    </div> <!-- .row end -->
  </form>
  </div>
</div>
   
  