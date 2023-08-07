<?php

  class templateController extends controller {

  public function __construct() {
  $this->url = $this->site_setting('user-console-site');
  }


  public function head($pages , $req = [])
  {


  $eventID    = "720620230726095130";
  $guestID    = $req[0];

  $template   = $this->getData("template_setting")->get(array("get_single" , array($eventID)));
  $info       = $this->getData("event_info")->get(array("by_event" , array($eventID)));

  if($guestID != ""):

  $guest         = $this->getData("guest")->get(array("by_username" , array($eventID , $pages)));
  $guest_name    = $guest['guest_name'];
  $gest_username = $guest['guest_username'];
  $guestID       = $guest['guestID'];
  $event_list    = $this->getData("guest_activity")->get(array("by_guestID" , array($eventID , $guestID)));

  $formattedDate = date("d F Y", strtotime($info['event_date']));


  endif;

  if($guestID == ""):

  $guest_name = "Tamu Undangan";
  $gest_username = "tamuundangan";
  $event_list = array();

  endif;
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
    <title>J & M Wedding</title>
    <link href="/assets/css/themify-icons.css" rel="stylesheet">
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/flaticon.css" rel="stylesheet">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/magnific-popup.css" rel="stylesheet">
    <link href="/assets/css/animate.css" rel="stylesheet">
    <link href="/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="/assets/css/owl.theme.css" rel="stylesheet">
    <link href="/assets/css/slick.css" rel="stylesheet">
    <link href="/assets/css/slick-theme.css" rel="stylesheet">
    <link href="/assets/css/swiper.min.css" rel="stylesheet">
    <link href="/assets/css/nice-select.css" rel="stylesheet">
    <link href="/assets/css/owl.transitions.css" rel="stylesheet">
    <link href="/assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="/assets/css/odometer-theme-default.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <!-- <script src="/assets/SoundManager2/script/soundmanager2-jsmin.js"></script> -->

    <meta property="og:title" content="UNDANGAN PERNIKAHAN JOHANNES & KOMANG WARMANI  ">
    <meta property="og:description" content="Undangan Pernikahan <?= $info['groom_name'] ?> & <?= $info['bride_name'] ?> pada : <?= $formattedDate ?>">
    <meta property="og:image" content="https://ourwedding.08-09-2023.com/assets/media/<?= $template['background_sec_1'] ?>">
    <meta property="og:url" content="https://ourwedding.08-09-2023.com/<?= $gest_username ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= $template['header_section_title'] ?> <?= $template['header_section_title_small'] ?>">
    <meta property="og:locale" content="id_ID">

</head>
<style>
    /* Gaya untuk tombol */

    .modal-container {
      position: fixed;
      
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.8);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      display: none;
    }

    .modal-content {
      background: url(/assets/images/slider/slide-10.jpg) no-repeat center center;
      background-size: cover;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    .modal-close {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
      font-size: 24px;
    }

    /* Gaya untuk tombol klik */
    .modal-button {
      background-color: #B19A56; /* Warna latar belakang */
      color: #fff; /* Warna teks */
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }


    #toggle-button {
      position: fixed;
      bottom: 15px;
      left: 20px;
      z-index: 999;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 2px solid #ffd700;
      cursor: pointer;
      outline: none;
      background: none;
    }

    #toggle-button i {
      font-size: 20px;
      color: #B19A56;
    }


  </style>

<body class="color12">

<div class="page-wrapper">
        <!-- start preloader -->
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="assets/images/favicon.png" alt="">
                </div>
            </div>
        </div>



  <?php
  }

  public function footer($pages = "" , $req = []){


  ?>

   
</div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <!-- Plugins for this template -->
    <script src="/assets/js/modernizr.custom.js"></script>
    <script src="/assets/js/jquery.dlmenu.js"></script>
    <script src="/assets/js/jquery-plugin-collection.js"></script>
    <!-- Custom script for this template -->
    <script src="/assets/js/script.js"></script>
</body>

</html>

  <?php  } } ?>
