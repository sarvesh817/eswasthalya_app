<!-- start: page toolbar -->
<div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
  <div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
      <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="dashboard.html" aria-current="page">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Wallet</li>
        </ol>
      </div>
    </div> <!-- .row end -->
    <div class="row align-items-center">
      <div class="col-auto">
        <h1 class="fs-5 color-900 mt-1 mb-0">Welcome back, Dr. <?php echo $this->session->userdata('name'); ?> !</h1>
        <small class="text-muted">You have 12 new messages and 7 new notifications.</small>
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
            
          <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="card">
                          <div class="card-body d-flex align-items-center">
                            <div class="avatar rounded-circle no-thumbnail bg-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
                                    <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4v1.06Z"/>
                                  </svg>
                            </div>
                            <div class="flex-fill ms-3 text-truncate">
                              <div class="small">Wallet Balance</div>
                              <span class="h5 mb-0">₹ <?php if(isset($walletData[0]['wallet_balance'])) { echo $walletData[0]['wallet_balance']; } ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9 col-sm-6">
                        <div class="btn-right">
                            <a href="#" class="btn btn-primary btn-lg">Deposit</a>
                            <a href="#" class="btn btn-success btn-lg">Withdrawal</a>
                        </div>
                      </div>
                </div>
                <div class="row mt-2 g-2 row-deck">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <h6 class="card-title m-0">Transaction History</h6>
                        </div>
                        <div class="card-body">
                          <table id="transactionHistoryTable" class="table card-table table-hover align-middle mb-0">
                            <thead>
                              <tr>
                                <th>S. No</th>
                                <th>Date Time</th>
                                <th>Transaction ID</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($transactionHistory) && $transactionHistory !='') {
                            $i=1;
                            foreach($transactionHistory as $transactionHistoryData)
                            { ?>    
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php if(isset($transactionHistoryData['created_at']) && $transactionHistoryData['created_at'] !=''){ echo $transactionHistoryData['created_at']; } ?></td>
                                <td><?php if(isset($transactionHistoryData['transaction_id']) && $transactionHistoryData['transaction_id'] !=''){ echo $transactionHistoryData['transaction_id']; } ?></td>
                                <?php if($transactionHistoryData['payment_status'] == 'Completed') { $bg='success'; }else{ $bg='warning';} ?>
                                <td><button class="btn btn-<?php echo $bg; ?>"><?php if(isset($transactionHistoryData['payment_status']) && $transactionHistoryData['payment_status'] !=''){ echo $transactionHistoryData['payment_status']; } ?></button></td>
                                <td>₹<?php if(isset($transactionHistoryData['amount']) && $transactionHistoryData['amount'] !=''){ echo $transactionHistoryData['amount']; } ?></td>
                                <td>
                                  <a href="javascript:void(0);" class="btn btn-danger modal-btn" title="Download"><i class="bi bi-file-earmark-pdf"></i></a>
                                  <a href="javascript:void(0);" class="btn btn-success modal-btn" title="Download"><i class="bi bi-file-earmark-excel"></i></a>
                                </td>
                              </tr>
                            <?php $i++; } } ?>  
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div> <!-- .row end -->
          
          </div>
        </div>
      </div>
    </div> <!-- .row end -->
  </div>
    </div>