<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
    <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
            <div class="col">
                <ol class="breadcrumb bg-transparent mb-0">
                      <li class="breadcrumb-item"><a class="text-secondary" href="index.html">Home</a></li>
                      <li class="breadcrumb-item">Doctor</li>
                      <li class="breadcrumb-item active" aria-current="page">All</li>
                </ol>
            </div>
        </div> <!-- .row end -->
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, <?php echo $this->session->userdata('name'); ?> !</h1>
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
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title m-0">Doctor List</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control">
                                    <option value="">- Select Status -</option>
                                    <option value="Verified">Verified</option>
                                    <option value="Not Verified">Not Verified</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        <table id="myAllDoctor" class="table card-table table-hover align-middle mb-0">
                            <thead>
                            <tr>
                                <th>DR. ID</th>
                                <th>Doctor</th>
                                <th>Specialist</th>
                                <th>Documents</th>
                                <th>Date of Join</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                
                            //echo"<pre>";  print_r($doctorListData); exit;
                            if(isset($doctorListData) && $doctorListData !=''){
                            foreach($doctorListData as $doctorData) { ?>
                                <tr>
                                    <?php $doctorCode = "DR".str_pad($doctorData['id'], 4, "0", STR_PAD_LEFT); ?>
                                    <td><?php echo $doctorCode; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>superadmin/doctor-profile/<?php echo $doctorData['id'] ?>">
                                            <div class="d-flex">
                                                <?php if(isset($doctorData['photo']) && $doctorData['photo'] !=''){ ?>
                                                    <img src="<?php echo base_url() ?>img/doctor_upload/<?php echo $doctorData['photo'];?>" class="avatar rounded-circle me-3" alt="profile-image">
                                                    <?php } else { ?>
                                                    <img src="<?php echo base_url() ?>img/doctor_upload/profile_av.png" class="avatar rounded-circle me-3" alt="profile-image">
                                                <?php } ?>
                                                <div>
                                                    <div class="fw-bold"><?php if(isset($doctorData['name']) && $doctorData['name'] !=''){ echo $doctorData['name']; } ?></div>
                                                    <span class="small text-muted"><?php if(isset($doctorData['contact_no']) && $doctorData['contact_no'] !=''){ echo $doctorData['contact_no']; } ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                    <?php 
                                        if(isset($doctorData['specialization']) && $doctorData['specialization'] !='') { 
                                        $specilityData = $this->db->where('id', $doctorData['specialization'])->get('tbl_speciality')->row();
                                        if($specilityData){
                                            echo $specilityData->speciality;
                                        } 
                                    } 
                                    ?>
                                    </td>
                  
                                    <?php $newDate = date("d-M-Y", strtotime($doctorData['created_at'])); ?>
                                    
                                    <td>
                                    <?php 
                                    $sfileEXT =''; $sfilename ='';
                                    if(isset($doctorData['signature']) && $doctorData['signature'] !=''){
                                        $img = $doctorData['signature'];
                                        $file_extension = explode('.',$img);
                                        $file_extension = strtolower(end($file_extension));
                                        $accepted_formate = array('jpeg','jpg','png');
                                        
                                        $sfilename = $img;
                                        if(in_array($file_extension,$accepted_formate)) {  $sfileEXT = "img";}else{ $sfileEXT = "pdf"; } ?>          
                                    <?php } ?>
                        
                                    <?php 
                                    $jfileEXT =''; $jfilename ='';
                                    if(isset($doctorData['joining_letter']) && $doctorData['joining_letter'] !=''){
                                        $img = $doctorData['joining_letter'];
                                        $file_extension = explode('.',$img);
                                        $file_extension = strtolower(end($file_extension));
                                        $accepted_formate = array('jpeg','jpg','png');
                                        $jfilename = $img;
                                        if(in_array($file_extension,$accepted_formate)) {  $jfileEXT = "img";}else{ $jfileEXT = "pdf"; } ?>          
                                    <?php } ?>

                                    <?php 
                                    $cfileEXT =''; $cfilename ='';
                                    if(isset($doctorData['other_document']) && $doctorData['other_document'] !=''){
                                        $img = $doctorData['other_document'];
                                        $file_extension = explode('.',$img);
                                        $file_extension = strtolower(end($file_extension));
                                        $accepted_formate = array('jpeg','jpg','png');
                                        
                                        $cfilename = $img;
                                        if(in_array($file_extension,$accepted_formate)) {  $cfileEXT = "img";}else{ $cfileEXT = "pdf"; } ?>          
                                    <?php } ?>
                      
                                    <botton type="button" class="btn btn-primary modal-btn viewDocs" title="View All Documents" data-sfilename="<?php echo $sfilename;?>" data-sfileEXT="<?php echo $sfileEXT;?>"  data-jfilename="<?php echo $jfilename;?>" data-jfileEXT="<?php echo $jfileEXT;?>" data-cfilename="<?php echo $cfilename;?>" data-cfileEXT="<?php echo $cfileEXT;?>">Verify Document <i class="bi bi-eye"></i></button>
                                    </td>

                                    <td><?php echo $newDate; ?></td>
                                    <td <?php if($doctorData['status'] == "Approved"){ ?> class="text-success"  <?php }else{?> class="text-danger" <?php }?>> <?php if($doctorData['status'] == "Approved"){ echo "Verified"; }else{ echo "Not Verified"; } ?> </td>
                                    <td>
                                        <?php if($doctorData['status'] == "Approved"){ ?>
                                        <button class="btn btn-success checkboxval" data-id="<?php echo $doctorData['user_id']; ?>" data-status="Pending">Active</button>
                                        <!--<div class="toggle-btn"><input type="checkbox" class="toggle_btn_check checkboxval" checked name="onoff" value="0" data-id="<?php echo $doctorData['user_id']; ?>"></div>-->
                                        <?php }else{ ?>
                                            <button class="btn btn-danger checkboxval" data-id="<?php echo $doctorData['user_id']; ?>" data-status="Approved">In Active</button>
                                            <!--<div class="toggle-btn"><input type="checkbox" class="toggle_btn_check " name="onoff" value="1" ></div>-->
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- .row end -->
    </div>
</div>
<div class="modal fade" id="prescriptionstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Doctor's Documents</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="media-view-container">
                    <div id="sfile"></div>
                </div>
                <div class="media-view-container">
                    <div id="jfile"></div>
                </div>
                <div class="media-view-container">
                    <div id="cfile"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
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

<script>
    $(document).on('click','.checkboxval',function(){
        var status = $(this).data('status');
        var id = $(this).data('id');
        $.ajax({
            url:"<?php echo base_url(); ?>SuperadminDoctor/updateStatus",   
            method:"POST",
            data:{id:id,status:status }, 
            dataType:'json',
            success:function(data)
            {
                console.log(data);
                if(data['success']==0){
                    $('#editresmessage').html(data['msg']);
                    $('#doneeditstaticBackdrop').modal('show');
                    setTimeout(function(){
                        $('#editresmessage').html('');
                        $('#doneeditstaticBackdrop').modal('hide');
                        window.location.reload();
                    },2000);
                    
                }else{
                    $('#editresmessage').html(data['msg']);
                    $('#doneeditstaticBackdrop').modal('show');
                    setTimeout(function(){
                        $('#editresmessage').html('');
                        $('#doneeditstaticBackdrop').modal('hide');
                        window.location.reload();
                    },2000);   
                }
            }
        });
    });
</script>

<script>
    $(document).on('click','.viewDocs',function(){
        var sfilename = $(this).data('sfilename');
        var sfileEXT = $(this).data('sfileext');
        var sdocfile = '';
        if(sfilename !=''){
            if(sfileEXT == "img"){
                sdocfile = '<br><h4 class="document-name">1. Signature</h4> <br> <img src="<?php echo base_url('img/doctor_upload/'); ?>'+sfilename+ '" alt="Patient View" class="patient-media-items"><br>';
            }else{
                sdocfile = '<br><h4 class="document-name">1. Signature</h4> <br> <iframe src="<?php echo base_url('img/doctor_upload/'); ?>'+sfilename+ '" alt="Patient View" class="patient-media-items" width="100%" height="500"></iframe> <br>';
            }
        }else{
            sdocfile = '<br><h4 class="document-name">1. Signature</h4><span class="invalid_doc">Document not available !!</span> <br>';
        }    
        $('#sfile').html(sdocfile);
        
        
        var jfilename = $(this).data('jfilename');
        var jfileEXT = $(this).data('jfileext');
        var jdocfile = '';
        
        if(jfilename !=''){
           if(jfileEXT == "img"){
                jdocfile = '<br><h4 class="document-name">2. Joining/Contract Letter</h4> <br> <img src="<?php echo base_url('img/doctor_upload/'); ?>'+jfilename+ '" alt="Patient View" class="patient-media-items"><br>';
            }else{
                jdocfile = '<br><h4 class="document-name">2. Joining/Contract Letter</h4> <br> <iframe src="<?php echo base_url('img/doctor_upload/'); ?>'+jfilename+ '" alt="Patient View" class="patient-media-items" width="100%" height="500"></iframe><br>';
            } 
            
        }else{
            jdocfile = '<br><h4 class="document-name">2. Joining/Contract Letter</h4> <span class="invalid_doc">Document not available !!</span> <br>';
        }
        $('#jfile').html(jdocfile);
        
        var cfilename = $(this).data('cfilename');
        var cfileEXT = $(this).data('cfileext');
        var cdocfile = '';
        if(cfilename !=''){
            if(cfileEXT == "img"){
                cdocfile = '<br><h4 class="document-name">3. Certificate Letter</h4> <br><img src="<?php echo base_url('img/doctor_upload/'); ?>'+cfilename+ '" alt="Patient View" class="patient-media-items"><br>';
            }else{
                cdocfile = '<br><h4 class="document-name">3. Certificate Letter</h4> <br> <iframe src="<?php echo base_url('img/doctor_upload/'); ?>'+cfilename+ '" alt="Patient View" class="patient-media-items" width="100%" height="500"></iframe><br>';
            }
        }else{
            cdocfile = '<br><h4 class="document-name">3. Certificate Letter</h4> <span class="invalid_doc">Document not available !!</span><br>';
        }    
            
        $('#cfile').html(cdocfile);
        
        $('#prescriptionstaticBackdrop').modal('show');    
    });
</script>