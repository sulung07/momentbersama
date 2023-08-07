<?php
session_start();
ob_start();
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
// require_once '/home/u1735803/public_html/tripnavigator.id/core/init.php';
// require_once '/home/u1735803/public_html/tripnavigator.id/core/engine/controller.php';
// require_once '/home/u1735803/public_html/tripnavigator.id/core/controllers/templateController.php';

require_once '../core/init.php';
require_once '../core/engine/controller.php';
require_once '../core/controllers/templateController.php';

$controller  = new controller();

if(isset($_SESSION['userID']))
{
    $userID = $_SESSION['userID'];
}else{

    if($_GET['url'] != "login" && $_GET['url'] != "signup"){
    header("location:../../../login");
    }
    $userID = "";

}


$url  = $controller->site_setting('user-console-site');

if(isset($_GET['url']))
{
    
    $link = $_GET['url'];

}else{

    $link = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Master</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href="<?= $url ?>/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?= $url ?>/assets/libs/chartist/chartist.min.css">
  <link href="<?= $url ?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $url ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" disabled />
  <link href="<?= $url ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" disabled />
  <?php if(isset($_GET['url']) && $_GET['url'] == "login"){  ?>

    <link href="<?= $url ?>/assets/css/bootstrap-modern-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet"  />
    <link href="<?= $url ?>/assets/css/app-modern-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"   />
    <link href="<?= $url ?>/assets/css/bootstrap-modern.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" disabled/>
    <link href="<?= $url ?>/assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" disabled />


    <?php }else{ ?>


    <link href="<?= $url ?>/assets/css/bootstrap-modern-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet"  />
    <link href="<?= $url ?>/assets/css/app-modern-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"   />
    <link href="<?= $url ?>/assets/css/bootstrap-modern.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" disabled/>
    <link href="<?= $url ?>/assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" disabled />



    <!-- <link href="<?= $url ?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet"   />
    <link href="<?= $url ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"     />
    <link href="<?= $url ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" disabled />
    <link href="<?= $url ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" disabled  /> -->

    <?php } ?>
  <link href="<?= $url ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>


<?php if($link == "login" || $link == "signup"){  ?>
<body class="auth-fluid-pages pb-0" data-layout='{"mode": "dark"}'>
<?php  $route = new route_userconsole(); ?>
<?php }else{?>
<body data-layout-mode="detached" data-layout='{"mode": "dark", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>
<div id="preloader">
<div id="status">
<div class="spinner">Loading...</div>
</div>
</div>


<div id="wrapper">
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="../../../assets/images/users/user-6.jpg" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        <?= $_SESSION['username'] ?> <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="../../../myaccount" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="<?= $url ?>/gate/singout" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>



        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="../../../assets/images/logo_sulung.png" alt="" height="40">
                    <!-- <span class="logo-lg-text-light">Master</span> -->
                </span>
                <span class="logo-lg">
                <img src="../../../assets/images/logo_sulung.png" alt="" height="40">
                    <span class="logo-lg-text-light">Master</span>
                </span>
            </a>

            <a href="index.html" class="logo logo-light text-center">
                <span class="logo-sm">
                <img src="../../../assets/images/logo_sulung.png" alt="" height="40">
                </span>
                <span class="logo-lg">
                <img src="../../../assets/images/logo_sulung.png" alt="" height="40">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->

<div class="left-side-menu"  >

    <div class="h-100" data-simplebar>


     <!-- User box -->
     <div class="user-box text-center">

        </div>


        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="/">
                    <i data-feather="airplay"></i>
                        <span class=""> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="#masterdata" data-toggle="collapse">
                        <i data-feather="layers"></i>
                        <span class=""> Master Data </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="masterdata">
                        <ul class="nav-second-level">

                            <li>
                                <a href="/master/company">Company Setting</a>
                            </li>

                            <li>
                                <a href="/master/api-setting">API Setting</a>
                            </li>

                          
                        </ul>
                    </div>
                </li>


                <li>

                <a href="#coari" data-toggle="collapse">
                <i data-feather="layers"></i>
                        <span class="">Coari Codeco </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="coari">
                        <ul class="nav-second-level">

                            <li>
                                <a href="/coari/packaging">Transaksi Kemasan</a>
                            </li>

                            <li>
                                <a href="/coari/out">Transaksi Keluar</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#plp" data-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span class=""> PLP </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="plp">
                        <ul class="nav-second-level">


                            <li>
                                <a href="/plp/request">Permohonan </a>
                            </li>

                            <li>
                                <a href="/plp/approved">persetujuan </a>
                            </li>

                            <li>
                                <a href="/plp/download">Unduh Data</a>
                            </li>

                            <li>
                                <a href="/plp/cancellation">Pembatalan</a>
                            </li>

                            <li>
                                <a href="/plp/approved-cancellation">Persetujuan Pembatalan</a>
                            </li>



                        </ul>
                    </div>
                </li>



                <li>
                    <a href="<?= $url ?>/user">
                    <i data-feather="layers"></i>
                        <span class=""> Management User </span>
                    </a>
                </li>


            </ul>

        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
<?php  $route = new route_userconsole(); ?>
</div>

<?php } ?>



</body>
</html>

</html>
