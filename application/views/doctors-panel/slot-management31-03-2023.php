 
    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item"><a class="text-secondary" href="dashboard.html" aria-current="page">Home</a></li>
              <li class="breadcrumb-item">Slot Management</li>
            </ol>
          </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
          <div class="col-auto">
            <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, Dr. <?php echo $this->session->userdata('name')?> !</h1>
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
                    <div class="col-sm-6">
                        <div class="card-header">
                            <h6 class="card-title m-0">Slot Management</h6>
                          </div>
                    </div>
                </div>
              
              
              <div class="card-body">
                  <div class="slot-management-container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row mb-2">
                          <div class="calendar col-md-8 offset-md-2">
                              <div>
                                  <!-- <div class="card-header bg-primary">
                                      <ul>
                                          <li id="month" class="text-white text-uppercase text-center"></li>
                                          <li id="year" class="text-white text-uppercase text-center"></li>
                                      </ul>
                                  </div> -->
                                 <!--  <table class="table calendar table-bordered table-responsive-sm" id="calendar">
                                      <thead>
                                          <tr class="weekdays bg-dark">
                                            <th scope="col" class="text-white text-center">Su</th>
                                            <th scope="col" class="text-white text-center">Mo</th>
                                            <th scope="col" class="text-white text-center">Tu</th>
                                            <th scope="col" class="text-white text-center">We</th>
                                            <th scope="col" class="text-white text-center">Th</th>
                                            <th scope="col" class="text-white text-center">Fr</th>
                                            <th scope="col" class="text-white text-center">Sa</th>
                                          </tr>
                                        </thead>
                                      <tbody class="days bg-light" id="days"></tbody>
                                      <tfoot></tfoot>
                                  </table> -->
                                   <!-- <link> doesn't need a closing tag -->
 
                           
<!--
                              <div id="datepicker1"></div>-->
                             
                              </div>
                          </div>
                      </div>
  
                      <hr>
  
           <div class="row mt-2">
              <div class="col offset-md-1">
              <?php 
               $edit_id=$this->uri->segment(3);   
               if($edit_id){ 
               // echo '<pre>'; print_r($update_sw); die;    
                if(!$edit_id){ /* $action_url=base_url(dp_path.'/home/slot_management'); */ }else{ $action_url=base_url('doctors/update-sm/'.$update_sw['id']);}?>
              <form    action="<?=$action_url?>"  method="post" id="form_create_appointmentss">       
                        <div class="row form-row mb-3">
                          <div class="col-6 form-group">
                              <label class="required">Date</label>
                              <input readonly class="form-control date-input" type="text" name="date" value="<?=base64_decode($this-> uri-> segment(4))?>"  id="date" data-trigger="hover" data-toggle="popover" title="Date" data-content="You can select any date from today clicking on the number in the calendar"  >
                          </div>
                          <div class="col-6 form-group">
                              <label>Availability</label>
                              <select name="availability" id="description" class="form-control">
                                <option value="Select Availability">--Select Availability--</option>
                                <option value="Available" <?php if($update_sw['availability']=="Available") echo "Selected";?>>Available</option>
                                <option value="Busy" <?php if($update_sw['availability']=="Busy") echo "Selected";?>>Busy</option>
                              </select>
                          </div>
                      </div>      
                      <div class="row form-row mb-3">
                          <div class="col-6 form-group">
                              <label class="required">Start Time</label>
                              <input class="form-control time-input" id="start_time" name="start_time" value="<?php if (isset($update_sw['start_time'])) echo  $update_sw['start_time']?>"  type="text"   required>
                          </div>
                          <div class="col-6 form-group">
                              <label class="required">End Time</label>
                              <input class="form-control time-input" id="end_time" name="end_time" value="<?php if (isset($update_sw['end_time'])) echo  $update_sw['end_time']?>"  type="text"   required>      
                          </div>
                      </div>
                      <div class="row form-row">
                         <!--  <div class="col-3 form-group">
                              <button type="button" class="btn btn-warning btn-block" id="clear" onclick="clear_input()">Clear Form</button>
                          </div> -->
                          <div class="col-9 form-group">
                          <?php  if(!$edit_id){ $submit_val="Make Appointment"; }else{ $submit_val="Update Appointment";}?>   
                              <button type="submit" name="submit_slot" class="btn btn-primary btn-block" id="submit"
                                      >  <?=$submit_val?> </button>      
                          </div>
                      </div>
                  </form>
                  <?php } ?>
              </div>
              
              <div class="col offset-md-1">  
                  <div class="row">
                      <div class="appointment_list_heading">
                          <h3>Appointments</h3>
                       
                           <a href="<?=base_url('/doctors/deleteall-slot/')?>" >
                          <button type="button" class="btn btn-danger btn-block" id="btn_clear_storage"  onclick="return confirm('Are you sure you want to delete all Appointments?');">Clear Appointments</button></a>  
                      </div>
                  </div>
                  <table style="width:1000px" class="table table-bordered table-hover table-striped table-sm" id="appointment_listsss">
                      <thead class="thead-dark">
                          <tr>
                              <th scope="col" class="text-center align-middle">Date</th>
                              <th scope="col" class="text-center align-middle">Availability</th>
                              <th scope="col" class="text-center align-middle">Start time</th>
                              <th scope="col" class="text-center align-middle">End time</th>
                              <th scope="col" class="text-center align-middle">Action</th>
                          </tr>
                      </thead>
                      <tbody id="bind_data">      
                      <?php  if(@$slot_management_list){  
                      
                      foreach($slot_management_list as $wl) {   
                        $encoded_date=base64_encode(date('d/m/Y'));
                        ?>
                                <tr>
                                  <td> <?=date('d/m/Y')?></td>
                                  <td> <?=$wl['availability']?></td>
                                  <td><?=$wl['start_time']?></td>       
                                  <td> <?=$wl['end_time']?></td>               
                                  <td>  
                                    <a href="<?=base_url('/doctors/update-sm/'.$wl['id'].'/'.$encoded_date)?>" class="btn btn-primary modal-btn" title="Edit"><i class="bi bi-pen"></i></a>
                                    <a href="<?=base_url('/doctors/delete-sm/'.$wl['id'])?>" class="btn btn-danger modal-btn" title="Delete"><i class="bi bi-trash"></i></a>
                                  </td>
                                </tr>   
                                <?php } 
                                
                      } ?>
                      </tbody>
                  </table>
              </div>
          </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div> <!-- .row end -->
      </div>
    </div>


   
                              
                              

    
   