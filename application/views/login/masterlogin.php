<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="e-Swasthalya is a telemedicine facilities with online video Consultant treatment.">
  <!-- Favicon-->
  <link rel="icon" href="<?php echo base_url() ?>bassets/img/favicon.ico" type="image/x-icon">
  <title>eSwasthalya - Super Admin Login Page</title>

 <link rel="stylesheet" href="<?php echo base_url() ?>bassets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>bassets/css/master.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <!-- Jquery Core Js -->
  <script src="<?php echo base_url() ?>bassets/js/plugins.js"></script>
</head>


<body id="layout-1" data-luno="theme-blue">
  <!-- start: body area -->
  <div class="wrapper">
    <!-- Sign In version 1 -->
    <!-- start: page body -->
    <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
      <div class="container-fluid">
        <div class="row g-0">
          <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
            <div style="max-width: 25rem;">
              <div class="mb-4">
                <img src="<?php echo base_url() ?>bassets/img/logo.png" alt="Logo" class="login-logo">
              </div>
              <div class="mb-5">
                <h2 class="color-900">e-Swasthalya is online video Consultant services:</h2>
              </div>
              <!-- List Checked -->
              <ul class="list-unstyled mb-5">
                <li class="mb-4">
                  <span class="d-block mb-1 fs-4 fw-light">All-in-one best specilities</span>
                  <span class="color-600">Amazing Features to make your life easier & work efficient</span>
                </li>
                <li>
                  <span class="d-block mb-1 fs-4 fw-light">Easily add &amp; manage your services</span>
                  <span class="color-600">It brings good health, projects, timelines, files and more</span>
                </li>
              </ul>
              <div class="mb-2">
                <a href="#" class="me-3 color-600">Home</a>
                <a href="#" class="me-3 color-600">About Us</a>
                <a href="#" class="me-3 color-600">FAQs</a>
              </div>
              <div class="social-icons">
                <a href="#" class="me-3 color-400"><i class="fa fa-facebook-square fa-lg"></i></a>
                <a href="#" class="me-3 color-400"><i class="fa fa-github-square fa-lg"></i></a>
                <a href="#" class="me-3 color-400"><i class="fa fa-linkedin-square fa-lg"></i></a>
                <a href="#" class="me-3 color-400"><i class="fa fa-twitter-square fa-lg"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 d-flex justify-content-center align-items-center">
            <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">
              <!-- Form -->
              <form class="row g-3" action="<?=base_url('masterloginNow')?>" id="form-validate" method="post" enctype="multipart/form-data"> 
                <div class="col-12 text-center">
                  <h1>Super Admin Login</h1>
                </div>
                <div class="col-12 text-center mb-4">
                       <!--<b style='color:red'><?=@$false_msg?></b> -->
                       <b style='color:red' id="flashmsg" ><?php echo $this->session->flashdata('item'); ?></b> 
                </div>
                <div class="col-12">
                  <div class="mb-2">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="name@example.com">
                    <span id="emailerr" style="color:red;"></span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-2">
                    <div class="form-label">
                      <span class="d-flex justify-content-between align-items-center"> Password
                      </span>
                    </div>
                    <input id="password" name="password" class="form-control form-control-lg" type="password"  placeholder="Enter the password">
                    <span id="passworderr" style="color:red;"></span>
                  </div>
                </div>

                <div class="col-12 text-center mt-4">
                <!-- <a class="btn btn-lg btn-block btn-dark lift text-uppercase" href="dashboard.html" title="Signin"> -->
                <button type="button" id="signIN" class="btn btn-lg btn-block btn-dark lift text-uppercase" >SIGN IN</button>
                    <!--<input  class="btn btn-lg btn-block btn-dark lift text-uppercase" type="submit" name="profile_login" value="SIGN IN">-->
                <!-- </a> -->        
                </div>
                
              </form>
              <!-- End Form -->
            </div>    
          </div>
        </div> <!-- End Row -->
      </div>
    </div>
    <script src="<?php echo base_url() ?>bassets/js/password.min.js"></script>
    <script>
      $(function() {
        $('#password').password()
      })
    </script>
    
    
  </div>
  <!-- Modal: Setting -->

  <!-- Jquery Page Js -->
  <!-- Jquery Page Js -->
  <script src="<?php echo base_url() ?>bassets/js/theme.js"></script>
  <!-- Plugin Js -->
  <!-- Vendor Script -->
  
  <script type="text/javascript">
    $("#signIN").click(function(){
      $(".se-pre-con").show();
      var pass  = document.getElementById('password').value;    
      var email = document.getElementById('email').value;   
      if(email==""){ 
        document.getElementById('emailerr').innerHTML='Please enter Username';
        $(".se-pre-con").hide();
        return false;
      }
      if(pass==""){
        document.getElementById('passworderr').innerHTML='Please Enter Password';
        $(".se-pre-con").hide();
        return false;
      } else{     
        $("#form-validate").submit();
      }
  });

  </script>
</body>
</html>