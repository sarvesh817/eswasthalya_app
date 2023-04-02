    
    <?php $getData = $this->db->where('pid',$patient_details->id)->get('tbl_patient_medical_history')->row(); //echo "<pre>"; print_r($getData);  exit;?>
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="dashboard.html">Home</a></li>
              <li class="breadcrumb-item">Consultation History</li>
              <li class="breadcrumb-item active" aria-current="page">Medical History</li>
            </ol>
          </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
          <div class="col-auto">
            <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, <?php echo $this->session->userdata('name'); ?> !</h1>
            <small class="text-muted">You have 12 new messages and 7 new notifications.</small>
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page body -->
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
  <div class="container-fluid">
    <div class="row g-3">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap flex-md-nowrap justify-content-between">
              <div class="doctor-avatar order-0 order-md-1 width10 ta-right">
                <a href="<?php echo base_url(); ?>eclinic/single-patient/<?php echo $patient_details->id; ?>" class="btn btn-dark"><i class="bi bi-arrow-left"></i> Back</a>
              </div>
    
              <div class="doctor-detail order-1 order-md-0 width90 ta-left">
                <h3><?php if(isset($patient_details->full_name) && $patient_details->full_name !=''){ echo $patient_details->full_name; }?> (<?php if(isset($patient_details->id) && $patient_details->id !=''){ echo $PatientCode = "PID".str_pad($patient_details->id, 4, "0", STR_PAD_LEFT);  }?>)</h3>
                <div class="d-flex flex-row flex-wrap align-items-center mb-3 mt-2">
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Age/Sex</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details->age) && $patient_details->age !=''){ echo $patient_details->age; }?>/<?php if(isset($patient_details->gender) && $patient_details->gender !=''){ echo $patient_details->gender; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Spouse Name</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details->relative_name) && $patient_details->relative_name !=''){ echo $patient_details->relative_name; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Contact Details</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details->mobile) && $patient_details->mobile !=''){ echo $patient_details->mobile; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Emergency Contact Details</small>
                    <div class="mb-0"><?php if(isset($patient_details->emergency_person) && $patient_details->emergency_person !=''){ echo $patient_details->emergency_person; }?></div>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details->emergency_contact) && $patient_details->emergency_contact !=''){ echo $patient_details->emergency_contact; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Allergy</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details->allergy) && $patient_details->allergy !=''){ echo $patient_details->allergy; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Marital Status</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details->marital_status) && $patient_details->marital_status !=''){ echo $patient_details->marital_status; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Occupation</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details->occupation) && $patient_details->occupation !=''){ echo $patient_details->occupation; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Health Insurance</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details->health_insurance) && $patient_details->health_insurance !=''){ echo $patient_details->health_insurance; }?></div>
                  </div>
                  <div class="me-3 me-md-5">
                    <small class="text-muted">Address</small>
                    <div class="mb-0 fw-bold"><?php if(isset($patient_details->address) && $patient_details->address !=''){ echo $patient_details->address; }?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <form id="pmhform" method="post" name="pmhform"  enctype="multipart/form-data">
            
            <input type="hidden" name="pid" id="pid" value="<?php if(isset($patient_details->id) && $patient_details->id !=''){ echo $patient_details->id; } ?>">
            <div class="tab-content mt-5 medical-history-patient-form">
          <!-- Tab: Overview -->
          <div class="tab-pane fade active show" id="medicalHistory_record" role="tabpanel">
            <div class="row-title mb-2">
              <h5>Medical History</h5>
            </div>
            <div class="row g-3">
              <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="health-record-container">
                      <!-- Tab: Overview -->
                        <!-- All History -->
                        <div class="row-title mb-2">
                          <h5>All History</h5>
                        </div>
                        <div class="row g-3">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Chief Complaint History</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div id="attributes1" class="clone-container">
                                  <div class="attr1 attr-row">
                                    <div class="row">
                                      <div class="col-sm-4 mb-4">
                                        <label class="form-label">Problem<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Problem" name="problem[]" id="problem">
                                      </div>
                                      <div class="col-sm-6 mb-4"></div>
                                      <div class="col-sm-2">
                                        <div class="btn-row main-btn-row">
                                          <a href="javascript:void(0);" class="btn btn-danger remove1 modal-btn" title="Delete"><i class="bi bi-trash"></i></a>
                                          <a href="javascript:void(0);" class="btn btn-success add1 modal-btn" title="Add"><i class="bi bi-plus"></i></a>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Onset</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Onset" name="onset[]" id="onset">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Site</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="site" name="site[]" id="site">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Progression</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Progression" name="progression[]" id="progression">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Duration</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Duration" name="duration[]" id="duration">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Frequency</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Frequency" name="frequency[]" id="frequency">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">color</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Color" name="color[]" id="color">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Grade</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Grade" name="grade[]" id="grade">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Radiating to</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Radiating to" name="radiatingto[]">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Relieving Factor</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Relieving factor" name="relieving_factor[]" id="relieving_factor">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Aggravating Factor</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Aggravating factor" name="aggravating_factor[]" id="aggravating_factor">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Smell</label>
                                        <input type="text" class="form-control form-control-lg required-entry" placeholder="Smell" name="smell" id="smell[]">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Past Medical History</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div id="attributes2" class="clone-container">
                                  <div class="attr2 attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-5">
                                        <label class="form-label">Past Disease<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="past_disease[]" id="past_disease" placeholder="Past Disease">
                                      </div>
                                      <div class="col-sm-5">
                                        <label class="form-label">Disease Details<span class="required_asterisk">*</span></label>
                                      <input type="text" class="form-control form-control-lg required-entry" name="disease_details[]" id="disease_details" placeholder="Disease Details">
                                      </div>
                                      
                                      <div class="col-sm-2">
                                        <div class="btn-row main-btn-row">
                                          <a href="javascript:void(0);" class="btn btn-danger remove2 modal-btn" title="Delete"><i class="bi bi-trash"></i></a>
                                          <a href="javascript:void(0);" class="btn btn-success add2 modal-btn" title="Add"><i class="bi bi-plus"></i></a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Personal History</h6>
                              </div>

                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Smoking <span class="required_asterisk">*</span></label>
                                        <select class="form-control form-control-lg" name="smoking" id="smoking">
                                          <option value="">- Smoking -</option>
                                          <option value="No" <?php if(isset($getData->smoking) && $getData->smoking !='' && $getData->smoking == "No" ){ echo 'selected'; } ?>>No</option>
                                          <option value="Moderate" <?php if(isset($getData->smoking) && $getData->smoking !='' && $getData->smoking == "Moderate" ){ echo 'selected'; } ?>>Moderate</option>
                                          <option value="Heavy" <?php if(isset($getData->smoking) && $getData->smoking !='' && $getData->smoking == "Heavy" ){ echo 'selected'; } ?>>Heavy</option>
                                        </select>
                                        <span id="smoking_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Alcohol<span class="required_asterisk">*</span></label>
                                        <select class="form-control form-control-lg" name="alcohol" id="alcalcoholohol">
                                          <option value="">- Alcohol -</option>
                                          <option value="No" <?php if(isset($getData->alcohol) && $getData->alcohol !='' && $getData->alcohol == "No" ){ echo 'selected'; } ?>>No</option>
                                          <option value="Moderate" <?php if(isset($getData->alcohol) && $getData->alcohol !='' && $getData->alcohol == "Moderate" ){ echo 'selected'; } ?>>Moderate</option>
                                          <option value="Heavy" <?php if(isset($getData->alcohol) && $getData->alcohol !='' && $getData->alcohol == "Heavy" ){ echo 'selected'; } ?>>Heavy</option>
                                        </select>
                                        <span id="alcohol_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Sleep<span class="required_asterisk">*</span></label>
                                        <select class="form-control form-control-lg" name="sleep" id="sleep">
                                          <option value="">- Sleep -</option>
                                          <option value="Poor" <?php if(isset($getData->sleep) && $getData->sleep !='' && $getData->sleep == "Poor" ){ echo 'selected'; } ?>>Poor</option>
                                          <option value="Good" <?php if(isset($getData->sleep) && $getData->sleep !='' && $getData->sleep == "Good" ){ echo 'selected'; } ?>>Good</option>
                                        </select>
                                        <span id="sleep_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Allergy<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="allergy" id="allergy" placeholder="Allergy" value="<?php if(isset($getData->allergy) && $getData->allergy !=''){ echo $getData->allergy; } ?>">
                                        <span id="allergy_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Bowel and Bladder Habits<span class="required_asterisk">*</span></label>
                                        <select class="form-control form-control-lg" name="bowel_bladder_habits" id="bowel_bladder_habits">
                                          <option value="">- Bowel and bladder habits -</option>
                                          <option value="Both Normal" <?php if(isset($getData->bowel_bladder_habits) && $getData->bowel_bladder_habits !='' && $getData->bowel_bladder_habits == "Both Normal" ){ echo 'selected'; } ?>>Both Normal </option>
                                          <option value="Both Abnormal" <?php if(isset($getData->bowel_bladder_habits) && $getData->bowel_bladder_habits !='' && $getData->bowel_bladder_habits == "Both Abnormal" ){ echo 'selected'; } ?>>Both Abnormal</option>
                                          <option value="Abnormal Bowel" <?php if(isset($getData->bowel_bladder_habits) && $getData->bowel_bladder_habits !='' && $getData->bowel_bladder_habits == "Abnormal Bowel" ){ echo 'selected'; } ?>>Abnormal Bowel</option>
                                          <option value="Abnormal Bladder" <?php if(isset($getData->smbowel_bladder_habitsoking) && $getData->bowel_bladder_habits !='' && $getData->bowel_bladder_habits == "Abnormal Bladder" ){ echo 'selected'; } ?>>Abnormal Bladder</option>
                                        </select>
                                        <span id="bowel_bladder_habits_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Appetite<span class="required_asterisk">*</span></label>
                                        <select class="form-control form-control-lg" name="appetite" id="appetite">
                                          <option value="">- Appetite -</option>
                                          <option value="Good" <?php if(isset($getData->appetite) && $getData->appetite !='' && $getData->appetite == "Good" ){ echo 'selected'; } ?>>Good</option>
                                          <option value="Poor" <?php if(isset($getData->appetite) && $getData->appetite !='' && $getData->appetite == "Poor" ){ echo 'selected'; } ?>>Poor</option>
                                        </select>
                                        <span id="appetite_Err"></span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Family History</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div id="attributes3" class="clone-container">
                                  <div class="attr3 attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-5">
                                        <label class="form-label">Disease<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="disease[]" id="disease" placeholder="Disease">
                                      </div>
                                      <div class="col-sm-5">
                                        <label class="form-label">Disease Details<span class="required_asterisk">*</span></label>
                                        <select class="form-control form-control-lg" name="relation[]" id="disease_details">
                                          <option value="">- Relation -</option>
                                          <option value="Father">Father</option>
                                          <option value="Mother">Mother</option>
                                          <option value="Grand Father">Grand Father</option>
                                          <option value="Grand Mother">Grand Mother</option>
                                        </select>
                                      </div>
                                      <div class="col-sm-2">
                                        <div class="btn-row main-btn-row">
                                          <a href="javascript:void(0);" class="btn btn-danger remove3 modal-btn" title="Delete"><i class="bi bi-trash"></i></a>
                                          <a href="javascript:void(0);" class="btn btn-success add3 modal-btn" title="Add"><i class="bi bi-plus"></i></a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Systemic History</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-12">
                                        <div class="card">
                                          <div class="card-header">
                                            <h6 class="card-title mb-0">Systems : Cardiovascular</h6>
                                          </div>
                                          <div class="card-body no-top-padding">
                                            <div class="clone-container">
                                              <div class="attr-row">
                                                <div class="row g-3">
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Breathlessness</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="breathlessness1" id="breathlessness1" value="<?php if(isset($getData->breathlessness1) && $getData->breathlessness1 !=''){ echo $getData->breathlessness1; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Palpitations</label>
                                                        <input type="text" class="form-control form-control-lg required-entry" name="palpitations" id="palpitations" value="<?php if(isset($getData->palpitations) && $getData->palpitations !=''){ echo $getData->palpitations; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Chest Pain</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="chest_pain" id="chest_pain" value="<?php if(isset($getData->chest_pain) && $getData->chest_pain !=''){ echo $getData->chest_pain; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Fainting</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="fainting1" id="fainting1" value="<?php if(isset($getData->fainting1) && $getData->fainting1 !=''){ echo $getData->fainting1; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Ankle Edema</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="ankle_edema" id="ankle_edema" value="<?php if(isset($getData->ankle_edema) && $getData->ankle_edema !=''){ echo $getData->ankle_edema; } ?>">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="card">
                                          <div class="card-header">
                                            <h6 class="card-title mb-0">Systems : Nervous System</h6>
                                          </div>
                                          <div class="card-body no-top-padding">
                                            <div class="clone-container">
                                              <div class="attr-row">
                                                <div class="row g-3">
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Headache</label>
                                                        <input type="text" class="form-control form-control-lg required-entry" name="headache" id="headache" value="<?php if(isset($getData->headache) && $getData->headache !=''){ echo $getData->headache; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Dizziness</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="dizziness" id="dizziness" value="<?php if(isset($getData->dizziness) && $getData->dizziness !=''){ echo $getData->dizziness; } ?>">
                                                  </div>
                                                  
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Fainting</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="fainting2" id="fainting2" value="<?php if(isset($getData->fainting2) && $getData->fainting2 !=''){ echo $getData->fainting2; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Tremors</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="tremors" id="tremors" value="<?php if(isset($getData->tremors) && $getData->tremors !=''){ echo $getData->tremors; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Seizure</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="seizure" id="seizure" value="<?php if(isset($getData->seizure) && $getData->seizure !=''){ echo $getData->seizure; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Tinnitus</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="tinnitus" id="tinnitus" value="<?php if(isset($getData->tinnitus) && $getData->tinnitus !=''){ echo $getData->tinnitus; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Deafness</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="deafness" id="deafness" value="<?php if(isset($getData->deafness) && $getData->deafness !=''){ echo $getData->deafness; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Vision Loss</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="vision_loss" id="vision_loss" value="<?php if(isset($getData->vision_loss) && $getData->vision_loss !=''){ echo $getData->vision_loss; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Memory Loss</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="memory_loss" id="memory_loss" value="<?php if(isset($getData->memory_loss) && $getData->memory_loss !=''){ echo $getData->memory_loss; } ?>">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="card">
                                          <div class="card-header">
                                            <h6 class="card-title mb-0">Systems : Muskuloskeletal</h6>
                                          </div>
                                          <div class="card-body no-top-padding">
                                            <div class="clone-container">
                                              <div class="attr-row">
                                                <div class="row g-3">
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Joint Pain</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="joint_pain" id="joint_pain" value="<?php if(isset($getData->joint_pain) && $getData->joint_pain !=''){ echo $getData->joint_pain; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Immobility</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="immobility" id="immobility" value="<?php if(isset($getData->immobility) && $getData->immobility !=''){ echo $getData->immobility; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Redness</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="redness" id="redness" value="<?php if(isset($getData->redness) && $getData->redness !=''){ echo $getData->redness; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Swelling</label>
                                                        <input type="text" class="form-control form-control-lg required-entry" name="swelling1" id="swelling1" value="<?php if(isset($getData->swelling1) && $getData->swelling1 !=''){ echo $getData->swelling1; } ?>">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="card">
                                          <div class="card-header">
                                            <h6 class="card-title mb-0">Systems : Genitourinary</h6>
                                          </div>
                                          <div class="card-body no-top-padding">
                                            <div class="clone-container">
                                              <div class="attr-row">
                                                <div class="row g-3">
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Multiple sexual partners</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="multiple_sexual_partners" id="multiple_sexual_partners" value="<?php if(isset($getData->multiple_sexual_partners) && $getData->multiple_sexual_partners !=''){ echo $getData->multiple_sexual_partners; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Libido</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="libido" id="libido" value="<?php if(isset($getData->libido) && $getData->libido !=''){ echo $getData->libido; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Burning Micturition</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="burning_micturition" id="burning_micturition" value="<?php if(isset($getData->burning_micturition) && $getData->burning_micturition !=''){ echo $getData->burning_micturition; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Painful Micturition</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="painful_micturition" id="painful_micturition" value="<?php if(isset($getData->painful_micturition) && $getData->painful_micturition !=''){ echo $getData->painful_micturition; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Overactive Bladder</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="overactive_bladder" id="overactive_bladder" value="<?php if(isset($getData->overactive_bladder) && $getData->overactive_bladder !=''){ echo $getData->overactive_bladder; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Incontinence</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="incontinence" id="incontinence" value="<?php if(isset($getData->incontinence) && $getData->incontinence !=''){ echo $getData->incontinence; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Bloody Urine</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="bloody_urine" id="bloody_urine" value="<?php if(isset($getData->bloody_urine) && $getData->bloody_urine !=''){ echo $getData->bloody_urine; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">LMP</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="lmp" id="lmp" value="<?php if(isset($getData->lmp) && $getData->lmp !=''){ echo $getData->lmp; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">White Discharge</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="white_discharge" id="white_discharge" value="<?php if(isset($getData->white_discharge) && $getData->white_discharge !=''){ echo $getData->white_discharge; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Foul Smelling Secretions</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="foul_smelling_secretions" id="foul_smelling_secretions" value="<?php if(isset($getData->foul_smelling_secretions) && $getData->foul_smelling_secretions !=''){ echo $getData->foul_smelling_secretions; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Itching</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="itching" id="itching" value="<?php if(isset($getData->itching) && $getData->itching !=''){ echo $getData->itching; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Periods Duration</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="periods_duration" id="periods_duration" value="<?php if(isset($getData->periods_duration) && $getData->periods_duration !=''){ echo $getData->periods_duration; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Dysmenorrhoea</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="dysmenorrhoea" id="dysmenorrhoea" value="<?php if(isset($getData->dysmenorrhoea) && $getData->dysmenorrhoea !=''){ echo $getData->dysmenorrhoea; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Painful Coitus</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="painful_coitus" id="painful_coitus" value="<?php if(isset($getData->painful_coitus) && $getData->painful_coitus !=''){ echo $getData->painful_coitus; } ?>">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="card">
                                          <div class="card-header">
                                            <h6 class="card-title mb-0">Systems : Gastrointestinal</h6>
                                          </div>
                                          <div class="card-body no-top-padding">
                                            <div class="clone-container">
                                              <div class="attr-row">
                                                <div class="row g-3">
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Heartburn</label>
                                                        <input type="text" class="form-control form-control-lg required-entry" name="heartburn" id="heartburn" value="<?php if(isset($getData->heartburn) && $getData->heartburn !=''){ echo $getData->heartburn; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Acidity</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="acidity" id="acidity" value="<?php if(isset($getData->acidity) && $getData->acidity !=''){ echo $getData->acidity; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Nausea</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="nausea" id="nausea" value="<?php if(isset($getData->nausea) && $getData->nausea !=''){ echo $getData->nausea; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Vomiting</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="vomiting" id="vomiting" value="<?php if(isset($getData->vomiting) && $getData->vomiting !=''){ echo $getData->vomiting; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Pain Abdomen</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="pain_abdomen" id="pain_abdomen"value="<?php if(isset($getData->pain_abdomen) && $getData->pain_abdomen !=''){ echo $getData->pain_abdomen; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Indigestion</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="indigestion" id="indigestion" value="<?php if(isset($getData->indigestion) && $getData->indigestion !=''){ echo $getData->indigestion; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Change in Stool Color</label>
                                                        <input type="text" class="form-control form-control-lg required-entry" name="change_stool_color" id="change_stool_color" value="<?php if(isset($getData->change_stool_color) && $getData->change_stool_color !=''){ echo $getData->change_stool_color; } ?>">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="card">
                                          <div class="card-header">
                                            <h6 class="card-title mb-0">Systems : Respiratory</h6>
                                          </div>
                                          <div class="card-body no-top-padding">
                                            <div class="clone-container">
                                              <div class="attr-row">
                                                <div class="row g-3">
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Cough</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="cough" id="cough" value="<?php if(isset($getData->cough) && $getData->cough !=''){ echo $getData->cough; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Blood in Sputum</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="blood_sputum" id="blood_sputum" value="<?php if(isset($getData->blood_sputum) && $getData->blood_sputum !=''){ echo $getData->blood_sputum; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Breathlessness</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="breathlessness2" id="breathlessness2" value="<?php if(isset($getData->breathlessness2) && $getData->breathlessness2 !=''){ echo $getData->breathlessness2; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Painful Breathing</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="painful_breathing" id="painful_breathing" value="<?php if(isset($getData->painful_breathing) && $getData->painful_breathing !=''){ echo $getData->painful_breathing; } ?>">
                                                  </div>
                                                  
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-12">
                                        <div class="card">
                                          <div class="card-header">
                                            <h6 class="card-title mb-0">Systems : Endocrine</h6>
                                          </div>
                                          <div class="card-body no-top-padding">
                                            <div class="clone-container">
                                              <div class="attr-row">
                                                <div class="row g-3">
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Heat Intolerance</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="heat_intolerance" id="heat_intolerance" value="<?php if(isset($getData->heat_intolerance) && $getData->heat_intolerance !=''){ echo $getData->heat_intolerance; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Cold Intolerance</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="cold_intolerance" id="cold_intolerance" value="<?php if(isset($getData->cold_intolerance) && $getData->cold_intolerance !=''){ echo $getData->cold_intolerance; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Heavy Sweating</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="heavy_sweating" id="heavy_sweating" value="<?php if(isset($getData->heavy_sweating) && $getData->heavy_sweating !=''){ echo $getData->heavy_sweating; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Polydypsia</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="polydypsia" id="polydypsia" value="<?php if(isset($getData->polydypsia) && $getData->polydypsia !=''){ echo $getData->polydypsia; } ?>">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    <label class="form-label">Polyuria</label>
                                                    <input type="text" class="form-control form-control-lg required-entry" name="polyuria" id="polyuria" value="<?php if(isset($getData->polyuria) && $getData->polyuria !=''){ echo $getData->polyuria; } ?>">
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">GPE Form</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Mental State<span class="required_asterisk">*</span></label>
                                            <select class="form-control form-control-lg" name="mental_state" id="mental_state">
                                            <option value="">- Select Mental State -</option>
                                            <option value="Normal" <?php if(isset($getData->mental_state) && $getData->mental_state !='' && $getData->mental_state == "Normal" ){ echo 'selected'; } ?>>Normal</option>
                                            <option value="Drowsy" <?php if(isset($getData->mental_state) && $getData->mental_state !='' && $getData->mental_state == "Drowsy" ){ echo 'selected'; } ?>>Drowsy</option>
                                          </select>
                                          <span id="mental_state_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Cyanosis<span class="required_asterisk">*</span></label>
                                            <select class="form-control form-control-lg" name="cyanosis" id="cyanosis">
                                            <option value="">- Select cyanosis -</option>
                                            <option value="Present" <?php if(isset($getData->cyanosis) && $getData->cyanosis !='' && $getData->cyanosis == "Present" ){ echo 'selected'; } ?>>Present</option>
                                            <option value="Absent" <?php if(isset($getData->cyanosis) && $getData->cyanosis !='' && $getData->cyanosis == "Absent" ){ echo 'selected'; } ?>>Absent</option>
                                          </select>
                                          <span id="cyanosis_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Clubbing<span class="required_asterisk">*</span></label>
                                            <select class="form-control form-control-lg" name="clubbing" id="clubbing">
                                            <option value="">- Select Clubbing -</option>
                                            <option value="Present" <?php if(isset($getData->clubbing) && $getData->clubbing !='' && $getData->clubbing == "Present" ){ echo 'selected'; } ?>>Present</option>
                                            <option value="Absent" <?php if(isset($getData->clubbing) && $getData->clubbing !='' && $getData->clubbing == "Absent" ){ echo 'selected'; } ?>>Absent</option>
                                          </select>
                                          <span id="clubbing_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Pallor<span class="required_asterisk">*</span></label>
                                            <select class="form-control form-control-lg" name="pallor" id="pallor">
                                            <option value="">- Select Pallor -</option>
                                            <option value="Mild" <?php if(isset($getData->pallor) && $getData->pallor !='' && $getData->pallor == "Mild" ){ echo 'selected'; } ?>>Mild</option>
                                            <option value="Present" <?php if(isset($getData->pallor) && $getData->pallor !='' && $getData->pallor == "Present" ){ echo 'selected'; } ?>>Present</option>
                                            <option value="Absent" <?php if(isset($getData->pallor) && $getData->pallor !='' && $getData->pallor == "Absent" ){ echo 'selected'; } ?>>Absent</option>
                                          </select>
                                          <span id="pallor_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Icterus<span class="required_asterisk">*</span></label>
                                            <select class="form-control form-control-lg" name="icterus" id="icterus">
                                            <option value="">- Select Icterus -</option>
                                            <option value="Mild" <?php if(isset($getData->icterus) && $getData->icterus !='' && $getData->icterus == "Mild" ){ echo 'selected'; } ?>>Mild</option>
                                            <option value="Present" <?php if(isset($getData->icterus) && $getData->icterus !='' && $getData->icterus == "Present" ){ echo 'selected'; } ?>>Present</option>
                                            <option value="Absent" <?php if(isset($getData->icterus) && $getData->icterus !='' && $getData->icterus == "Absent" ){ echo 'selected'; } ?>>Absent</option>
                                          </select>
                                          <span id="icterus_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">lymphadenopathy<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="lymphadenopathy" id="lymphadenopathy" value="<?php if(isset($getData->lymphadenopathy) && $getData->lymphadenopathy !=''){ echo $getData->lymphadenopathy; } ?>">
                                        <span id="lymphadenopathy_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Edema<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="edema" id="edema" value="<?php if(isset($getData->edema) && $getData->edema !=''){ echo $getData->edema; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Body Built<span class="required_asterisk">*</span></label>
                                        <select class="form-control form-control-lg" name="bodybuilt" id="bodybuilt">
                                            <option value="">- Select Body Built -</option>
                                            <option value="Normal" <?php if(isset($getData->bodybuilt) && $getData->bodybuilt !='' && $getData->bodybuilt == "Normal" ){ echo 'selected'; } ?>>Normal</option>
                                            <option value="Obese" <?php if(isset($getData->bodybuilt) && $getData->bodybuilt !='' && $getData->bodybuilt == "Obese" ){ echo 'selected'; } ?>>Obese</option>
                                            <option value="Thin" <?php if(isset($getData->bodybuilt) && $getData->bodybuilt !='' && $getData->bodybuilt == "Thin" ){ echo 'selected'; } ?>>Thin</option>
                                         </select>
                                         <span id="bodybuilt_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Gait<span class="required_asterisk">*</span></label>
                                            <select class="form-control form-control-lg" name="gait" id="gait">
                                            <option value="">- Select Gait -</option>
                                            <option value="Normal" <?php if(isset($getData->gait) && $getData->gait !='' && $getData->gait == "Normal" ){ echo 'selected'; } ?>>Normal</option>
                                            <option value="Abnormal" <?php if(isset($getData->gait) && $getData->gait !='' && $getData->gait == "Abnormal" ){ echo 'selected'; } ?>>Abnormal</option>
                                            <option value="Parkinsonian" <?php if(isset($getData->gait) && $getData->gait !='' && $getData->gait == "Parkinsonian" ){ echo 'selected'; } ?>>Parkinsonian</option>
                                            <option value="Scissor Gait" <?php if(isset($getData->gait) && $getData->gait !='' && $getData->gait == "Scissor Gait" ){ echo 'selected'; } ?>>Scissor Gait</option>
                                            <option value="Waddling Gait" <?php if(isset($getData->gait) && $getData->gait !='' && $getData->gait == "Waddling Gait" ){ echo 'selected'; } ?>>Waddling Gait</option>
                                            <option value="Spastic" <?php if(isset($getData->gait) && $getData->gait !='' && $getData->gait == "Spastic" ){ echo 'selected'; } ?>>Spastic</option>
                                            <option value="Steppage" <?php if(isset($getData->gait) && $getData->gait !='' && $getData->gait == "Steppage" ){ echo 'selected'; } ?>>Steppage</option>
                                          </select>
                                          <span id="gait_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Height<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="height" id="height" value="<?php if(isset($getData->height) && $getData->height !=''){ echo $getData->height; } ?>">
                                        <span id="height_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Weight<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="weight" id="weight" value="<?php if(isset($getData->weight) && $getData->weight !=''){ echo $getData->weight; } ?>">
                                        <span id="weight_Err"></span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row-title mb-2 mt-2">
                          <h5>Vital</h5>
                        </div>
                        <!-- Vital -->
                        <!-- .row end -->
                        <div class="row g-3">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Vitals</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Temperature (°F)<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="temperature" id="temperature" value="<?php if(isset($getData->temperature) && $getData->temperature !=''){ echo $getData->temperature; } ?>">
                                        <span id="temperature_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Pulse (Per Minute)<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="pulse" id="pulse" placeholder="Pulse (Per Minute)" value="<?php if(isset($getData->pulse) && $getData->pulse !=''){ echo $getData->pulse; } ?>">
                                        <span id="pulse_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Blood Pressure (mm hg)<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="blood_pressure" id="blood_pressure" placeholder="Blood Pressure (mm hg)" value="<?php if(isset($getData->blood_pressure) && $getData->blood_pressure !=''){ echo $getData->blood_pressure; } ?>">
                                        <span id="blood_pressure_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Respiratory Rate (Breath Per Minute)<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="respiratory_rate" id="respiratory_rate" placeholder="Respiratory Rate (Breath Per Minute)" value="<?php if(isset($getData->respiratory_rate) && $getData->respiratory_rate !=''){ echo $getData->respiratory_rate; } ?>">
                                        <span id="respiratory_rate_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">RBS (mg/dl)<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="rbs" id="rbs" placeholder="RBS (mg/dl)" value="<?php if(isset($getData->rbs) && $getData->rbs !=''){ echo $getData->rbs; } ?>">
                                        <span id="rbs_Err"></span>
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">SpO2 (%)<span class="required_asterisk">*</span></label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="sp02" id="sp02" placeholder="SpO2 (%)" value="<?php if(isset($getData->sp02) && $getData->sp02 !=''){ echo $getData->sp02; } ?>">
                                        <span id="sp02_Err"></span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Examination -->
                        <!-- .row end -->
                        <div class="row-title mb-2 mt-2">
                          <h5>Systemic Examination</h5>
                        </div>
                        <!-- .row end -->
                        <div class="row g-3">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Cardiovascular System</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Pulse</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="pulse2" id="pulse2" placeholder="Pulse" value="<?php if(isset($getData->pulse2) && $getData->pulse2 !=''){ echo $getData->pulse2; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Heart Sounds</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="heart_sounds" id="heart_sounds" placeholder="Heart Sounds" value="<?php if(isset($getData->heart_sounds) && $getData->heart_sounds !=''){ echo $getData->heart_sounds; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">JVP</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="jvp" id="jvp" placeholder="JVP" value="<?php if(isset($getData->jvp) && $getData->jvp !=''){ echo $getData->jvp; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Chest Wall Abnormalities</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="chest_wall" id="chest_wall" placeholder="Chest Wall Abnormalities" value="<?php if(isset($getData->chest_wall) && $getData->chest_wall !=''){ echo $getData->chest_wall; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Engorged Veins</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="engorged_veins" id="engorged_veins" placeholder="Engorged Veins" value="<?php if(isset($getData->engorged_veins) && $getData->engorged_veins !=''){ echo $getData->engorged_veins; } ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Respiratory System</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Chest Shape</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="chest_shape" id="chest_shape" placeholder="Chest Shape" value="<?php if(isset($getData->chest_shape) && $getData->chest_shape !=''){ echo $getData->chest_shape; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Chest Movement</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="chest_movement" id="chest_movement" placeholder="Chest Movement" value="<?php if(isset($getData->chest_movement) && $getData->chest_movement !=''){ echo $getData->chest_movement; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Auscultation</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="auscultation" id="auscultation" placeholder="Auscultation" value="<?php if(isset($getData->auscultation) && $getData->auscultation !=''){ echo $getData->auscultation; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Percussion</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="percussion1" id="percussion1" placeholder="Percussion" value="<?php if(isset($getData->percussion1) && $getData->percussion1 !=''){ echo $getData->percussion1; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Trachea Position</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="trachea_position" id="trachea_position" placeholder="Trachea Position" value="<?php if(isset($getData->trachea_position) && $getData->trachea_position !=''){ echo $getData->trachea_position; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Vocal Fremitus</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="vocal_fremitus" id="vocal_fremitus" placeholder="vocal fremitus" value="<?php if(isset($getData->vocal_fremitus) && $getData->vocal_fremitus !=''){ echo $getData->vocal_fremitus; } ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Gastrointestinal System</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Palpation</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="palpation" id="palpation" placeholder="Palpation" value="<?php if(isset($getData->palpation) && $getData->palpation !=''){ echo $getData->palpation; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Percussion</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="percussion2" id="percussion2" placeholder="Percussion" value="<?php if(isset($getData->percussion2) && $getData->percussion2 !=''){ echo $getData->percussion2; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Ascitis</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="ascitis" id="ascitis" placeholder="Ascitis" value="<?php if(isset($getData->ascitis) && $getData->ascitis !=''){ echo $getData->ascitis; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Splenomegaly</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="splenomegaly" id="splenomegaly" placeholder="Splenomegaly" value="<?php if(isset($getData->splenomegaly) && $getData->splenomegaly !=''){ echo $getData->splenomegaly; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Hepatomegaly</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="hepatomegaly" id="hepatomegaly" placeholder="Hepatomegaly" value="<?php if(isset($getData->hepatomegaly) && $getData->hepatomegaly !=''){ echo $getData->hepatomegaly; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Tenderness</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="tenderness" id="tenderness" placeholder="Tenderness" value="<?php if(isset($getData->tenderness) && $getData->tenderness !=''){ echo $getData->tenderness; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Hernia</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="hernia1" id="hernia1" placeholder="Hernia" value="<?php if(isset($getData->hernia1) && $getData->hernia1 !=''){ echo $getData->hernia1; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Skin Changes</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="skin_changes" id="skin_changes" placeholder="Skin Changes" value="<?php if(isset($getData->skin_changes) && $getData->skin_changes !=''){ echo $getData->skin_changes; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Swelling</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="swelling2" id="swelling2" placeholder="Swelling" value="<?php if(isset($getData->swelling2) && $getData->swelling2 !=''){ echo $getData->swelling2; } ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Genitourinary System</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Skin Changes</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="skin_changes1" id="skin_changes1" placeholder="skin changes" value="<?php if(isset($getData->skin_changes1) && $getData->skin_changes1 !=''){ echo $getData->skin_changes1; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Phimosis</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="phimosis" id="phimosis" placeholder="Phimosis" value="<?php if(isset($getData->phimosis) && $getData->phimosis !=''){ echo $getData->phimosis; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Paraphimosis</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="paraphimosis" id="paraphimosis" placeholder="Paraphimosis" value="<?php if(isset($getData->paraphimosis) && $getData->paraphimosis !=''){ echo $getData->paraphimosis; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Hypospadias</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="hypospadias" id="hypospadias" placeholder="Hypospadias" value="<?php if(isset($getData->hypospadias) && $getData->hypospadias !=''){ echo $getData->hypospadias; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Undescended tests</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="undescended_tests" id="undescended_tests" placeholder="Undescended tests" value="<?php if(isset($getData->undescended_tests) && $getData->undescended_tests !=''){ echo $getData->undescended_tests; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Hernia</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="hernia2" id="hernia2" placeholder="Hernia" value="<?php if(isset($getData->hernia2) && $getData->hernia2 !=''){ echo $getData->hernia2; } ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Musculoskeletal System</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Skin Changes</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="skin_changes2" id="skin_changes2" placeholder="skin changes" value="<?php if(isset($getData->skin_changes2) && $getData->skin_changes2 !=''){ echo $getData->skin_changes2; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Joint Swelling</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="joint_swelling" id="joint_swelling" placeholder="joint swelling" value="<?php if(isset($getData->joint_swelling) && $getData->joint_swelling !=''){ echo $getData->joint_swelling; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Tenderness</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="tenderness" id="tenderness" placeholder="Tenderness" value="<?php if(isset($getData->tenderness) && $getData->tenderness !=''){ echo $getData->tenderness; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Deformity</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="deformity" id="deformity" placeholder="Deformity" value="<?php if(isset($getData->deformity) && $getData->deformity !=''){ echo $getData->deformity; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Restricted Mobility</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="restricted_mobility" id="restricted_mobility" placeholder="Restricted Mobility" value="<?php if(isset($getData->restricted_mobility) && $getData->restricted_mobility !=''){ echo $getData->restricted_mobility; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Reflexes</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="reflexes" id="reflexes" placeholder="Reflexes" value="<?php if(isset($getData->reflexes) && $getData->reflexes !=''){ echo $getData->reflexes; } ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h6 class="card-title mb-0">Nervous System</h6>
                              </div>
                              <div class="card-body no-top-padding">
                                <div class="clone-container">
                                  <div class="attr-row">
                                    <div class="row g-3">
                                      <div class="col-sm-3">
                                        <label class="form-label">Speech</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="speech" id="speech" placeholder="speech" value="<?php if(isset($getData->speech) && $getData->speech !=''){ echo $getData->speech; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Power of Limbs</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="power_limbs" id="power_limbs" placeholder="power of limbs" value="<?php if(isset($getData->power_limbs) && $getData->power_limbs !=''){ echo $getData->power_limbs; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Touch Sensation</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="touch_sensation" id="touch_sensation" placeholder="touch sensation" value="<?php if(isset($getData->touch_sensation) && $getData->touch_sensation !=''){ echo $getData->touch_sensation; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Knee Jerk Reflex</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="knee_jerk_reflex" id="knee_jerk_reflex" placeholder="Knee Jerk Reflex" value="<?php if(isset($getData->knee_jerk_reflex) && $getData->knee_jerk_reflex !=''){ echo $getData->knee_jerk_reflex; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Ankle Reflex</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="ankle_reflex" id="ankle_reflex" placeholder="Ankle Reflex" value="<?php if(isset($getData->ankle_reflex) && $getData->ankle_reflex !=''){ echo $getData->ankle_reflex; } ?>">
                                      </div>
                                      <div class="col-sm-3">
                                        <label class="form-label">Cranial Nerves Examination</label>
                                        <input type="text" class="form-control form-control-lg required-entry" name="cranial_examination" id="cranial_examination" placeholder="cranial nerves examination" value="<?php if(isset($getData->cranial_examination) && $getData->cranial_examination !=''){ echo $getData->cranial_examination; } ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              
                              
                              <div class="card-footer">
                                <a href="<?php echo base_url(); ?>eclinic/single-patient/<?php echo $patient_details->id; ?>" class="btn btn-dark"><i class="bi bi-arrow-left"></i> Back</a>
                                <input type="button" id="savePatientMedicalHistry" value="submit" class="btn btn-primary"/>
                                <!--<a href="single-patient.html" class="btn btn-primary">Save</a>-->
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- .row end -->
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- Row end  -->
          </div>
        </div>
        </form>
      </div>
    </div> <!-- .row end -->
  </div>
</div>

<div class="modal fade" id="doneeditstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header flex-column">
            <div class="icon-box-confirmed text-success">
                <i class="bi bi-check"></i>
            </div>						
            <h4 class="modal-title w-100" id="editresmessage"></h4>	
            <button type="button" class="btn-close close editclosedBTN" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary editclosedBTN" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.form.js"></script>

<script>
    var URL = "<?=base_url('EclinicPanel/savePmhData')?>";
    
    var URLss = "<?=base_url('eclinic/single-patient/')?>";

    $(document).ready(function(){
        
       	$(document).on('change keyup','#smoking',function(){
    		$('#smoking_Err').html('');
    	});
    	
    	$(document).on('change keyup','#alcohol',function(){
    		$('#alcohol_Err').html('');
    	});
    	
    	$(document).on('change keyup','#sleep',function(){
    		$('#sleep_Err').html('');
    	});
    	
    	$(document).on('change keyup','#allergy',function(){
    		$('#allergy_Err').html('');
    	});
    	
    	$(document).on('change keyup','#bowel_bladder_habits',function(){
    		$('#bowel_bladder_habits_Err').html('');
    	});
    	
    	$(document).on('change keyup','#appetite',function(){
    		$('#appetite_Err').html('');
    	});
    	
    	$(document).on('change keyup','#mental_state',function(){
    		$('#mental_state_Err').html('');
    	});
    	
    	$(document).on('change keyup','#cyanosis',function(){
    		$('#cyanosis_Err').html('');
    	});
    	
    	$(document).on('change keyup','#clubbing',function(){
    		$('#clubbing_Err').html('');
    	});
    	
    	$(document).on('change keyup','#pallor',function(){
    		$('#pallor_err').html('');
    	});
    	
    	$(document).on('change keyup','#icterus',function(){
    		$('#icterus_Err').html('');
    	});
    	
    	$(document).on('change keyup','#lymphadenopathy',function(){
    		$('#lymphadenopathy_Err').html('');
    	});
    	
    	$(document).on('change keyup','#edema',function(){
    		$('#edema_Err').html('');
    	});
    	
    	$(document).on('change keyup','#bodybuilt',function(){
    		$('#bodybuilt_Err').html('');
    	});
    	
    	$(document).on('change keyup','#gait',function(){
    		$('#gait_Err').html('');
    	});
    	
    	$(document).on('change keyup','#height',function(){
    		$('#height_Err').html('');
    	});
    	
    	$(document).on('change keyup','#weight',function(){
    		$('#weight_Err').html('');
    	});
    	
    	$(document).on('change keyup','#temperature',function(){
    		$('#temperature_Err').html('');
    	});
    	
    	$(document).on('change keyup','#pulse',function(){
    		$('#pulse_Err').html('');
    	});
    	
    	$(document).on('change keyup','#blood_pressure',function(){
    		$('#blood_pressure_Err').html('');
    	});
    	
    	$(document).on('change keyup','#respiratory_rate',function(){
    		$('#respiratory_rate_Err').html('');
    	});
    	
    	$(document).on('change keyup','#rbs',function(){
    		$('#rbs_Err').html('');
    	});
    	
    	$(document).on('change keyup','#sp02',function(){
    		$('#sp02_Err').html('');
    	});

    	function Role_validate(){
    		var smoking = $('#smoking').val();
    		var alcohol = $('#alcohol').val();
    		var sleep = $('#sleep').val();
    		var allergy = $('#allergy').val();
    		var bowel_bladder_habits = $('#bowel_bladder_habits').val();
    		var appetite = $('#appetite').val();
    		var mental_state = $('#mental_state').val();
    		var cyanosis = $('#cyanosis').val();
    		var clubbing = $('#clubbing').val();
    		var pallor = $('#pallor').val();
    		var icterus = $('#icterus').val();
    		var lymphadenopathy = $('#lymphadenopathy').val();
    		var edema = $('#edema').val();
    		var bodybuilt = $('#bodybuilt').val();
    		var gait = $('#gait').val();
    		var height = $('#height').val();
    		var weight = $('#weight').val();
    		var temperature = $('#temperature').val();
    		var pulse = $('#pulse').val();
    		var blood_pressure = $('#blood_pressure').val();
    		var respiratory_rate = $('#respiratory_rate').val();
    		var rbs = $('#rbs').val();
    		var sp02 = $('#sp02').val();

    		if(smoking == ''){
    			$('#smoking_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}

    		if(alcohol == ''){
    			$('#alcohol_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(sleep == ''){
    			$('#sleep_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(allergy == ''){
    			$('#allergy_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(bowel_bladder_habits == ''){
    			$('#bowel_bladder_habits_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(appetite == ''){
    			$('#appetite_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(mental_state == ''){
    			$('#mental_state_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(cyanosis == ''){
    			$('#cyanosis_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(clubbing == ''){
    			$('#clubbing_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(pallor == ''){
    			$('#pallor_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(icterus == ''){
    			$('#icterus_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		if(lymphadenopathy == ''){
    			$('#lymphadenopathy_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(edema == ''){
    			$('#edema_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(bodybuilt == ''){
    			$('#bodybuilt_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(gait == ''){
    			$('#gait_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(height == ''){
    			$('#height_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(weight == ''){
    			$('#weight_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(temperature == ''){
    			$('#temperature_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(pulse == ''){
    			$('#pulse_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(blood_pressure == ''){
    			$('#blood_pressure_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(respiratory_rate == ''){
    			$('#respiratory_rate_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(rbs == ''){
    			$('#rbs_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		if(sp02 == ''){
    			$('#sp02_Err').html("<font style='color:red'><b>Required Field</b></font>");
    			return false;
    		}
    		
    		return true;
    	}

        $(document).on('click','#savePatientMedicalHistry',function(){
            
            var valid = Role_validate();
    		if(valid == true){
			$("#pmhform").ajaxSubmit({
				url: URL,
				type: 'post',
				cache: false,
				clearForm: false,
				dataType:'json',
				success: function(res) {
					if(res['status'] == '1'){
	            	   //$("#msgdiplay").html("<br><font style='color:green; font-size:16px'>"+res['msg']+"</font>");
						//setTimeout(function(){
						   
						    $("#editresmessage").html("<br><font style='color:green'>"+res['msg']+"</font>");
    						$('#doneeditstaticBackdrop').modal('show');
    						$('#pmhform')[0].reset();
    						$('.editclosedBTN').click(function(){
    						   $('#doneeditstaticBackdrop').modal('hide'); 
    						   $("#editresmessage").html(""); 
                               //window.location.href = URLss;
                               window.location.href = URLss+res['pid']
    					    }); 

						//},3000);

	                } else{
						$("#msgdiplay").html("<br><font style='color:red; font-size:16px'>"+res['msg']+"</font>");
						setTimeout(function(){
							$(".se-pre-con").fadeOut("slow");
						    $("#msgdiplay").fadeOut("slow");
						     $("#account").addClass("active");
						     $("#personal").addClass("active");
						    $("#confirm").removeClass("active");
						    $('#a1').css('display', 'block' , 'opacity','1');
						    $('#a3').css('display', 'none' , 'position','relative' , 'opacity','0');
						     
						},3000);
						return false;
	                }					
				}
			});
			
    		}
	    });	
    });
    
</script>