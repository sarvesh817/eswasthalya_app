<!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="dashboard.html" aria-current="page">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Schedule Working Hours</li>
            </ol>
          </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
          <div class="col-auto">
            <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, Dr. <?php echo $this->session->userdata('name'); ?> !</h1>
            <small class="text-muted">You have 12 new messages and 7 new notifications.</small>
          </div>
          <div class="col d-flex justify-content-lg-end mt-2 mt-md-0">
            <div class="p-2 me-md-3">
              <div><span class="h6 mb-0">8.18K</span> <small class="text-secondary"><i class="fa fa-angle-up"></i> 1.3%</small></div>
              <small class="text-muted text-uppercase">Income</small>
            </div>
            <div class="p-2 me-md-3">
              <div><span class="h6 mb-0">1.11K</span> <small class="text-secondary"><i class="fa fa-angle-up"></i> 4.1%</small></div>
              <small class="text-muted text-uppercase">Expense</small>
            </div>
            <div class="p-2 pe-lg-0">
              <div><span class="h6 mb-0">3.66K</span> <small class="text-danger"><i class="fa fa-angle-down"></i> 7.5%</small></div>
              <small class="text-muted text-uppercase">Revenue</small>
            </div>
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-2 row-deck">
          <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
              <div class="row">
                <div class="col-xxl-6 col-md-4 col-sm-12">
                    <div class="card-header">
                        <h6 class="card-title m-0">Schedule Working Hours</h6>
                    </div>
                </div>
                </div>
                <?php 
               $edit_id=$this->uri->segment(3);    
                if(!$edit_id){ $action_url=base_url('doctors/schedule-working-hours'); }else{ $action_url=base_url('doctors/update-sw/'.$update_sw['id']);}?>   
              <form    action="<?=$action_url?>"  method="post" >    
                <div class="card-body">
                  <div class="row">
                      <div class="col-sm-7 mb-4">
                          <label for="date-week">Select Week Days<span
                              class="required_asterisk">*</span></label>
                              <div class="weekDays-selector">
                              <?php  
                              if(!$edit_id){   
                                  if(is_array(@$working_list)){
                                foreach($working_list as $wl) {
                                  $week_days[]=$wl['week_days'];     
                                } 
                                  }
                              }else{
                                  $week_days[]=$update_sw['week_days'];   
                              }
                                ?>
                                <input type="checkbox" name="week_days[]" id="weekday-mon" <?php if (is_array(@$week_days)) { if (in_array("Monday", $week_days)) { ?> checked<?php  } } ?>  class="weekday" value="Monday" />
                                <label for="weekday-mon">MON</label>
                                <input type="checkbox" name="week_days[]" id="weekday-tue" <?php if (is_array(@$week_days)) {  if (in_array("Tuesday", $week_days)) { ?>checked<?php  } } ?>  class="weekday" value="Tuesday" />
                                <label for="weekday-tue">TUE</label>
                                <input type="checkbox" name="week_days[]" id="weekday-wed" <?php  if (is_array(@$week_days)) {  if (in_array("Wednesday", $week_days)) { ?>checked<?php  } } ?>  class="weekday" value="Wednesday" />
                                <label for="weekday-wed">WED</label>
                                <input type="checkbox" name="week_days[]" id="weekday-thu" <?php  if (is_array(@$week_days)) {  if (in_array("Thursday", $week_days)) { ?>checked<?php  } } ?>  class="weekday" value="Thursday" />
                                <label for="weekday-thu">THU</label>
                                <input type="checkbox" name="week_days[]" id="weekday-fri" <?php if (is_array(@$week_days)) {  if (in_array("Friday", $week_days)) { ?>checked<?php  } } ?>  class="weekday" value="Friday" />
                                <label for="weekday-fri">FRI</label>
                                <input type="checkbox" name="week_days[]" id="weekday-sat" <?php  if (is_array(@$week_days)) {  if (in_array("Saturday", $week_days)) { ?>checked<?php  } } ?>  class="weekday" value="Saturday" />
                                <label for="weekday-sat">SAT</label>
                                <input type="checkbox" name="week_days[]" id="weekday-sun" <?php  if (is_array(@$week_days)) {  if (in_array("Sunday", $week_days)) { ?>checked<?php  } } ?>  class="weekday" value="Sunday" />
                                <label for="weekday-sun">SUN</label>
                                 
                              </div>
                        </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-5 mb-4">
                          <label class="form-label">Select Working Hours<span
                              class="required_asterisk">*</span></label>
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="slot-timing">
                                      <div class="time-range">
                                        <label class="form-label">Start Time<span
                                          class="required_asterisk">*</span></label>
                                          <input type="time" name="start_time" required value="<?php if (isset($update_sw['start_time'])) echo  $update_sw['start_time']?>" class="form-control form-control-lg required-entry" placeholder="Start Time" data-custom-datepicker>
                                      </div>
                                      <div class="time-range">
                                        <label class="form-label">End Time<span
                                          class="required_asterisk">*</span></label>
                                          <input type="time" name="end_time" required value="<?php if (isset($update_sw['end_time'])) echo  $update_sw['end_time']?>" class="form-control form-control-lg required-entry" placeholder="End Time" data-custom-datepicker>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <a href="schedule-working-hours.html" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                          <?php  if(!$edit_id){ $submit_val="Add Working Hours"; }else{ $submit_val="Update Working Hours";}?>
                        <input type="submit" name="submit_schedule" value="<?=$submit_val?>" class="btn btn-primary">  
                      
                      </div>
                      </form>
                      <?php  if(!$edit_id){ ?>
                        <div class="col-sm-12 mb-4">
                          <div class="card-header">
                            <h6 class="card-title m-0">Scheduled Week Days</h6>
                        </div>
                          <div class="card-body">
                            <table class="table card-table table-hover align-middle mb-0">
                              <thead>
                                <tr>
                                  <th>S. NO</th>
                                  <th>Days</th>
                                  <th>Scheduled Working Hours</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $i=1;
                                if(is_array(@$working_list)){
                                foreach($working_list as $wl) { ?>
                                <tr>
                                  <td><?=$i++?></td>
                                  <td> <?=$wl['week_days']?></td>
                                    <td><?=date('h:i A', strtotime($wl['start_time']))?> - <?=date('h:i A', strtotime($wl['end_time']))?></td> 
                                    
                                  <td>
                                    <a href="<?=base_url('/doctors/update-sw/'.$wl['id'])?>" class="btn btn-primary modal-btn" title="Edit"><i class="bi bi-pen"></i></a>
                                    <a href="<?=base_url('/doctors/delete-sw/'.$wl['id'])?>" class="btn btn-danger modal-btn" title="Delete"><i class="bi bi-trash"></i></a>
                                  </td>
                                </tr>
                                <?php } 
                                
                                } ?>
                                     
                              </tbody>
                            </table>     
                          </div>
                        </div>
                        <div class="col-sm-12">
                            <a href="schedule-working-hours.html" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                        </div>
                       
                        <?php } ?>

                  </div>
            
            </div>
            </div>
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->