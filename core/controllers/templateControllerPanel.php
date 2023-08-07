<?php

  class templateControllerPanel extends controller {

  public function __construct() {
  $this->url = $this->site_setting('user-console-site');
  }


  public function head($pages , $req = [])
  {

  $menu = true;

  // get company 

  if(isset($_SESSION['parentID']))
{

    $parentID = $this->hashId("dec" , $_SESSION['parentID']);

    if($parentID == 0)
    {

        $clientID    = $this->hashId("dec" , $_SESSION['userID']);


    }else{

        $clientID    = $parentID;


    }

}
  

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="utf-8" />
  <title>CONSOLE WEDDING</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Dytap.id" name="description" />
  <meta content="dytap.id" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="/assets/images/new_fav.ico">

  <link href="/assets/libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />


  <?php if(!empty($req)){ foreach ($req as $key) { ?>
  <?php if($key == "dataTables"): ?>
  <!-- third party css -->
  <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- third party css end -->
  <?php endif; ?>

  <?php if($key == "dataForms"): ?>
  <link href="/assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
  <?php endif; ?>

  <?php if($key == "galery"): ?>
  <link href="/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
  <?php endif; ?>

  <?php if($key == "tinymce"): ?>
  <script src="https://cdn.tiny.cloud/1/9hc2jn1849fni1cjn1p684m5qba1oteac5dmn56ldty81gtu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <?php endif; ?>


  <?php } } ?>


  <!-- Default -->

  <link href="/assets/css/bootstrap-creative.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet"  />
  <link href="/assets/css/app-creative.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet"  />

  <link href="/assets/css/bootstrap-creative-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled  />
  <link href="/assets/css/app-creative-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled   />

  <!-- icons -->
  <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

  </head>

  <?php if($pages == "login"){ $menu = false; ?>
  <body class="authentication-bg authentication-bg-pattern">

  
  <?php }else{ ?>
  <body data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>
  <?php } ?>


  <?php if($menu == true):

  ?>



  <div id="wrapper">

  <!-- Topbar Start -->
  <div class="navbar-custom">
    <div class="container-fluid">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list topbar-dropdown">
          <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <img src="/assets/images/users/user-6.jpg" alt="user-image" class="rounded-circle">
            <span class="pro-user-name ml-1">
            <?= $_SESSION['username'] ?>
            <i class="mdi mdi-chevron-down"></i>
            </span>
          </a>

          <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!-- item-->
            <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome !</h6>
            </div>

            <!-- item-->
            <a href="/myaccount" class="dropdown-item notify-item">
              <i class="fe-user"></i>
              <span>My Account</span>
            </a>

            <div class="dropdown-divider"></div>

            <!-- item-->
            <a href="/gate/singout" class="dropdown-item notify-item">
              <i class="fe-log-out"></i>
              <span>Logout</span>
            </a>

         </div>
      </li>
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
    <a href="/home" class="logo logo-dark text-center">
      <span class="logo-sm">
      <!-- <span class="logo-lg-text-light">UBold</span> -->
      </span>
      <span class="logo-lg">
      <!-- <span class="logo-lg-text-light">U</span> -->
      </span>
    </a>

    <a href="/home" class="logo logo-light text-center">
      <span class="logo-sm">
      </span>
      <span class="logo-lg">
      </span>
    </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
      <li>
        <button class="button-menu-mobile waves-effect waves-light">
        <i class="fe-menu"></i>
        </button>
      </li>

      <li>
        <!-- Mobile menu toggle (Horizontal Layout)-->
        <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
        <div class="lines">
            <span></span>
            <span></span>
            <span></span>
        </div>
        </a>

      </li>
    </ul>
    <div class="clearfix"></div>
    </div>
  </div>

  <div class="topnav shadow-lg">
      <div class="container-fluid">
      <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

          <div class="collapse navbar-collapse" id="topnav-menu-content">
              <ul class="navbar-nav">
                 

                  

                  <li class="nav-item">
                      <a class="nav-link" href="/events" id="topnav-dashboard" role="button">
                      <i class="fe-layers mr-1"></i> Events
                      </a>

                  </li>

                  <?php if($parentID == 0): ?>

                  <li class="nav-item">
                      <a class="nav-link" href="/usermanage" id="topnav-dashboard" role="button">
                      <i class="fe-grid mr-1"></i> user Manage
                      </a>

                  </li>

                  <?php endif; ?>


                </ul>
            </div>

          </nav>
        </div>
    </div>

  <?php endif; ?>


  <?php
  }

  public function footer($pages = "" , $req = []){

   

  ?>

   

  </div>

  <!-- Default -->
  <!-- Vendor js -->
  <script src="/assets/js/vendor.min.js"></script>


  <?php if(!empty($req)){ foreach ($req as $key) { ?>

  <?php if($key == "dataTables"): ?>

  <!-- third party js -->
  <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>


  <!-- third party js ends -->

  <!-- Datatables init -->

  <?php endif; ?>

  <?php if($key == "dataForms"): ?>
  <script src="/assets/libs/selectize/js/standalone/selectize.min.js"></script>
  <script src="/assets/libs/mohithg-switchery/switchery.min.js"></script>
  <script src="/assets/libs/multiselect/js/jquery.multi-select.js"></script>
  <script src="/assets/libs/select2/js/select2.min.js"></script>
  <script src="/assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
  <script src="/assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
  <script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
  <script src="/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
  <script src="/assets/libs/flatpickr/flatpickr.min.js"></script>
  <script src="/assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="/assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
  <script src="/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="/assets/libs/summernote/summernote-bs4.min.js"></script>
  <?php endif; ?>

  <?php if($key == "galery"): ?>
  <script src="/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
  <?php endif; ?>

  <?php if($key == "apexCharts"): ?>
  <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
  <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
  <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
  <?php endif; ?>

  <?php if($key == "Charts"): ?>
  <script src="/assets/libs/chart.js/Chart.bundle.min.js"></script>

  <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
  <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
  <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>

  <?php endif; ?>

  <?php }} ?>

  <script src="/assets/libs/jquery-toast-plugin/jquery.toast.min.js"></script>
  <script src="/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>


  <!-- init js-->
  <!-- <script src="/assets/js/pages/dashboard-1.init.js"></script> -->
  <?php if(!empty($req)){ foreach ($req as $key) { ?>

  <?php if($key == "dataTables"): ?>
  <script src="/assets/js/pages/datatables.init.js"></script>
  <?php endif; ?>

  <?php if($key == "dataForms"): ?>
  <script src="/assets/js/pages/form-advanced.init.js"></script>
  <script src="/assets/js/pages/form-pickers.init.js"></script>
  <script src="/assets/js/pages/form-summernote.init.js"></script>
  <?php endif; ?>

  <?php if($key == "galery"): ?>
  <script src="/assets/js/pages/gallery.init.js"></script>
  <?php endif; ?>

  <?php if($key == "apexCharts"): ?>
  <!-- <script src="/assets/js/pages/apexcharts.init.js"></script> -->
  <?php endif; ?>



  <?php } } ?>
  <!-- App js-->
  <script src="/assets/js/app.min.js"></script>
  <script src="/ajax/appcontroller.js"></script>
  <!--  -->


  </body>
  </html>


  <?php  } } ?>
