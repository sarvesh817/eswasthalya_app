<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="#">Home</a></li>
              <li class="breadcrumb-item">Clinic Registration</li>
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
        <form action="<?=base_url('eclinic/update-profile')?>" enctype="multipart/form-data" method="post">
        <div class="row g-3">
          <div class="col-12">
            <div class="card">
              <!-- start: page body -->
              <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
                  <div class="container-fluid">
                    <div class="row g-3">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h6 class="card-title mb-0">Basic Information</h6>
                          </div>
                          <div class="card-body">
                            <div class="row g-3">
                              <div class="col-lg-9">
                                <label class="form-label">Upload Photo</label>
                                <input type="file" name="photo" value="" class="form-control">
                                <input type="hidden" name="oldphoto" value="<?php if(isset($eclinic_info_edit[0]['photo'])){ echo $eclinic_info_edit[0]['photo']; } ?>" class="form-control">
                              </div>
                            
                              <div class="col-lg-3">
                                <?php if(isset($eclinic_info_edit[0]['photo']) && $eclinic_info_edit[0]['photo'] !=''){  ?>
                                <img src="<?php echo base_url() ?>img/eclinic_upload/<?php echo $eclinic_info_edit[0]['photo']; ?>" style="width: 80px; height: 90px;">
                                <?php } ?>
                              </div>

                              <div class="col-sm-4">
                                <label class="form-label">Clinic's Owner Name<span class="required_asterisk">*</span></label>
                                <input type="text" disabled name="name" id="name" value="<?php if(!empty($this->session->userdata('name'))) { echo $this->session->userdata('name'); }?>" class="form-control form-control-lg">
                              </div>
                              <div class="col-sm-4">
                                <label class="form-label">Your Email<span class="required_asterisk">*</span></label>
                                <input type="text" disabled  name="email" id="email" value="<?php if(!empty($this->session->userdata('email'))) { echo $this->session->userdata('email'); }?>" class="form-control form-control-lg" placeholder="Enter here Email Id">
                              </div>
                              <div class="col-sm-4">
                                <label class="form-label">Mobile<span class="required_asterisk">*</span></label>
                                <input type="text" name="mobile" disabled id="mobile" value="<?php if(!empty($this->session->userdata('userContact'))) { echo $this->session->userdata('userContact'); }?>" class="form-control form-control-lg" placeholder="Enter here">
                              </div>
                              
                              <div class="col-sm-4">
                                <label class="form-label">Clinic Facilities<span class="required_asterisk">*</span></label>
                                <select class="form-control form-control-lg" name="facilities" id="facilities">
                                  <option value="">- Select Clinic Facilities -</option>
                                  <option value="Lab Test" <?php if(isset($eclinic_info_edit[0]['facilities']) && $eclinic_info_edit[0]['facilities'] =='Lab Test'){ echo 'selected'; } ?>>Lab Test</option>
                                  <option value="Medical Store" <?php if(isset($eclinic_info_edit[0]['facilities']) && $eclinic_info_edit[0]['facilities'] =='Medical Store'){ echo 'selected'; } ?>>Medical Store</option>
                                  <option value="Physical Doctor Consultation" <?php if(isset($eclinic_info_edit[0]['facilities']) && $eclinic_info_edit[0]['facilities'] =='Physical Doctor Consultation'){ echo 'selected'; } ?>>Physical Doctor Consultation</option>
                                  <option value="Day Care" <?php if(isset($eclinic_info_edit[0]['facilities']) && $eclinic_info_edit[0]['facilities'] =='Day Care'){ echo 'selected'; } ?>>Day Care</option>
                                </select>
                              </div>
                              <!--<div class="col-sm-4">
                                  <label class="form-label">Clinic Facilities<span class="required_asterisk">*</span></label>
                                    <select class="js-select2 multiple_select_dropdown" multiple="multiple" name="facilities" id="facilities">
                        				<option value="" data-badge="">- Select Clinic Facilities -</option>
                        				<option value="Paediatrics" data-badge="">Paediatrics</option>
                        				<option value="General Physician" data-badge="">General Physician</option>
                        				<option value="Diabetologist" data-badge="">Diabetologist</option>
                        				<option value="General Surgeon" data-badge="">General Surgeon</option>
                        				<option value="Medicine" data-badge="">Medicine</option>
                        				<option value="ENT" data-badge="">ENT</option>
                        				<option value="Opthalmology" data-badge="">Opthalmology</option>
                        				<option value="Gastroenterologist" data-badge="">Gastroenterologist</option>
                        				<option value="Obstetrician/Gynaecologist" data-badge="">Obstetrician/Gynaecologist</option>
                        				<option value="Anaesthesia" data-badge="">Anaesthesia</option>
                        				<option value="Pulmonology" data-badge="">Pulmonology</option>
                        				<option value="Endocrinology" data-badge="">Endocrinology</option>
                        				<option value="Neurology" data-badge="">Neurology</option>
                        				<option value="Cardiology" data-badge="">Cardiology</option>
                        				<option value="Psychiatry" data-badge="">Psychiatry</option>
                        				<option value="Psychologist" data-badge="">Psychologist</option>
                        				<option value="BAMS" data-badge="">BAMS</option>
                        				<option value="Dietician" data-badge="">Dietician</option>
                        				<option value="Dentist/BDS" data-badge="">Dentist/BDS</option>
                        				<option value="MDS" data-badge="">MDS</option>
                        		    </select>
                              </div>-->
                              
                              <div class="col-sm-4">
                                <label class="form-label">Qualification<span class="required_asterisk">*</span></label>
                                <input type="text" name="qualification" id="qualification" value="<?php if(isset($eclinic_info_edit[0]['qualification'])){ echo $eclinic_info_edit[0]['qualification']; } ?>" class="form-control form-control-lg" placeholder="Enter here">
                              </div>
                              <div class="col-sm-4">
                                <label class="form-label">Experience<span class="required_asterisk">*</span></label>
                                <input type="text" name="experience" id="experience" value="<?php if(isset($eclinic_info_edit[0]['experience'])){ echo $eclinic_info_edit[0]['experience']; } ?>" class="form-control form-control-lg" placeholder="Enter here">
                              </div>
                              <div class="col-sm-4">
                                <label class="form-label">PAN<span class="required_asterisk">*</span></label>
                                <input type="text" name="pancard" id="pancard" value="<?php if(isset($eclinic_info_edit[0]['pancard'])){ echo $eclinic_info_edit[0]['pancard']; } ?>" class="form-control form-control-lg" placeholder="PAN Number" maxlength="10">
                              </div>
                              <div class="col-sm-4">
                                <label class="form-label">Aadhaar<span class="required_asterisk">*</span></label>
                                <input type="text" name="adhaar_card" id="adhaar_card" value="<?php if(isset($eclinic_info_edit[0]['adhaar_card'])){ echo $eclinic_info_edit[0]['adhaar_card']; } ?>" class="form-control form-control-lg" placeholder="Aadhaar Number" maxlength="12">
                              </div>
                              <div class="col-sm-4">
                                <label class="form-label">Website URL</label>
                                <input type="text" name="website" id="website" value="<?php if(isset($eclinic_info_edit[0]['website'])){ echo $eclinic_info_edit[0]['website']; } ?>" class="form-control form-control-lg" placeholder="Enter here">
                              </div>
                              <div class="col-sm-4">
                                <label class="form-label">Franchisee Agreement upload<span class="required_asterisk">*</span></label>
                                <input type="file" name="franchisee" id="franchisee" value="" class="form-control">
                                <input type="hidden" name="oldfranchisee" value="<?php if(isset($eclinic_info_edit[0]['franchisee'])){ echo $eclinic_info_edit[0]['franchisee']; } ?>" class="form-control">
                              </div>
                              <div class="col-sm-4">
                                <label class="form-label">Qualification documents upload<span class="required_asterisk">*</span></label>
                                <input type="file" name="qualification_documents" id="qualification_documents" class="form-control">
                               <input type="hidden" name="oldqualification_documents" value="<?php if(isset($eclinic_info_edit[0]['qualification_documents'])){ echo $eclinic_info_edit[0]['qualification_documents']; } ?>" class="form-control">
                              </div>
                              <div class="col-sm-4">
                                <label class="form-label">Ownership/Rent Lease Agreement<span class="required_asterisk">*</span></label>
                                <input type="file" name="ownership" id="ownership" class="form-control">
                                <input type="hidden" name="oldownership" value="<?php if(isset($eclinic_info_edit[0]['ownership'])){ echo $eclinic_info_edit[0]['ownership']; } ?>" class="form-control">
                              </div>
                              
                              <div class="col-sm-4">
                                <?php if(isset($eclinic_info_edit[0]['franchisee']) && $eclinic_info_edit[0]['franchisee'] !=''){  ?>   
                                <img src="<?php echo base_url() ?>img/eclinic_upload/<?php echo $eclinic_info_edit[0]['franchisee']; ?>" style="width: 80px; height: 90px;">
                                <?php } ?>
                              </div>
                
                
                            <div class="col-sm-4">
                                <?php
                                if(isset($eclinic_info_edit[0]['qualification_documents']) && $eclinic_info_edit[0]['qualification_documents'] !=''){ 
                                if(strpos($eclinic_info_edit[0]['qualification_documents'], "pdf") !== false){ ?>
                                <a href="<?php echo base_url('img/eclinic_upload/').$eclinic_info_edit[0]['qualification_documents'] ?>" > Joining  Document </a>
                                <?php }else{
                                if(isset($eclinic_info_edit[0]['qualification_documents']) && $eclinic_info_edit[0]['qualification_documents'] !=''){  ?>
                                <img src="<?php echo base_url() ?>img/eclinic_upload/<?php echo $eclinic_info_edit[0]['qualification_documents']; ?>" style="width: 80px; height: 90px;">
                                <?php }
                                
                                } } ?>
                             </div>
                             
                              <div class="col-sm-4">
                                <?php
                                if(isset($eclinic_info_edit[0]['ownership']) && $eclinic_info_edit[0]['ownership'] !=''){
                                if(strpos($eclinic_info_edit[0]['ownership'], "pdf") !== false){ ?>
                                <a href="<?php echo base_url('img/doctor_upload/').$eclinic_info_edit[0]['ownership'] ?>" > Other  Document </a>
                                <?php }else{
                                if(isset($eclinic_info_edit[0]['ownership']) && $eclinic_info_edit[0]['ownership'] !=''){  ?>
                                <img src="<?php echo base_url() ?>img/eclinic_upload/<?php echo $eclinic_info_edit[0]['ownership']; ?>" style="width: 80px; height: 90px;">
                                <?php }
                                
                                } } ?>
                              </div>
                              
                              <div class="col-sm-4">
                                <label class="form-label">Franchisee Validity<span class="required_asterisk">*</span></label>
                                <input type="date" name="franchisee_validity" id="franchisee_validity" value="<?php if(isset($eclinic_info_edit[0]['franchisee_validity'])){ echo $eclinic_info_edit[0]['franchisee_validity']; } ?>" class="form-control form-control-lg">
                              </div>
                              
                              
                              <div class="col-sm-8">
                                <label class="form-label">Clinic Address<span class="required_asterisk">*</span></label>
                                <input type="text" name="address" id="address" value="<?php if(isset($eclinic_info_edit[0]['address'])){ echo $eclinic_info_edit[0]['address']; } ?>" class="form-control form-control-lg" placeholder="Clinic Address">
                              </div>
                              <div class="col-sm-12">
                                <label class="form-label">About<span class="required_asterisk">*</span></label>
                                <textarea rows="4" name="about" id="about" value="" class="form-control no-resize" placeholder="Please type what you want..."><?php if(isset($eclinic_info_edit[0]['about'])){ echo $eclinic_info_edit[0]['about']; } ?></textarea>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h6 class="card-title mb-0">Clinic's Bank Account Information</h6>
                          </div>
                          <div class="card-body">
                            <div class="row g-3">
                              <div class="col-sm-6">
                                <label class="form-label">Account Holder Name</label>
                                <input type="text" name="account_holder" id="account_holder" value="<?php if(isset($eclinic_info_edit[0]['account_holder'])){ echo $eclinic_info_edit[0]['account_holder']; } ?>"  class="form-control form-control-lg" placeholder="Enter here">
                              </div>
                              <div class="col-sm-6">
                                <label class="form-label">Account Number</label>
                                <input type="text" name="account_number" id="account_number" value="<?php if(isset($eclinic_info_edit[0]['account_number'])){ echo $eclinic_info_edit[0]['account_number']; } ?>" class="form-control form-control-lg" placeholder="Enter here">
                              </div>
                              <div class="col-sm-6">
                                <label class="form-label">Bank Name</label>
                                <input type="text" name="bank_name" id="bank_name" value="<?php if(isset($eclinic_info_edit[0]['bank_name'])){ echo $eclinic_info_edit[0]['bank_name']; } ?>" class="form-control form-control-lg" placeholder="Enter here">
                              </div>
                              <div class="col-sm-6">
                                <label class="form-label">IFSC Code</label>
                                <input type="text" name="ifsc_code" id="ifsc_code" value="<?php if(isset($eclinic_info_edit[0]['ifsc_code'])){ echo $eclinic_info_edit[0]['ifsc_code']; } ?>" class="form-control form-control-lg" placeholder="Enter here">
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <input type="submit" name="submit" id="submit" value="Update Details" class="btn btn-primary" style="float:right" /> 
                             
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- .row end -->
                  </div>
                </div>
            </div>
          </div>
        </div>
    </form>
</div>
</div>