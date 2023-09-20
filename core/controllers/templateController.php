<?php

  class templateController extends controller {

  public function __construct() {
  $this->url = $this->site_setting('user-console-site');
  }


  public function head($pages , $req = [])
  {


  $eventID    = "277720230807155913";
  $guestID    = $req[0];

  $template   = $this->getData("template_setting")->get(array("get_single" , array($eventID)));
  $info       = $this->getData("event_info")->get(array("by_event" , array($eventID)));

  if($guestID != ""):

  $guest         = $this->getData("guest")->get(array("by_username" , array($eventID , $pages)));
  $guest_name    = $guest['guest_name'];
  $guest_username = $guest['guest_username'];
  $guestID       = $guest['guestID'];
  $event_list    = $this->getData("guest_activity")->get(array("by_guestID" , array($eventID , $guestID)));

  $formattedDate = date("d F Y", strtotime($info['event_date']));


  endif;

  if($guestID == ""):

  $guest_name = "Tamu Undangan";
  $guest_username = "tamuundangan";
  $event_list = array();

  endif;
  ?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="discrption" content="Wedding Invitation" />
    <meta name="keyword"
        content="Wedding, Wedding Bali, Mahendra Friska, Our Wedding, Wedding Invitation" />

    <!--  Title -->
    <title>Mahendra & Friska</title>

    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon" />

    <!-- custom styles (optional) -->
    <link href="/assets/css/plugins.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet" />
	
	<script src="https://apis.google.com/js/api.js"></script>

    <meta property="og:title" content="Mahendra & Friska">
    <meta property="og:description" content="We Invite You <?= $guest_name ?>">
    <meta property="og:image" content="https://our.momenbersama.com/assets/img/pic/Logo_invitation.jpg">
    <meta property="og:url" content="https://our.momenbersama.com/<?= $guest_username ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Mahendra & Friska">
    <meta property="og:locale" content="id_ID">

</head>

<style>
/* Gaya untuk tombol Load More
.gallery-portfolio a.link-pop:nth-child(n+6) {
    display: none;
}
*/

    /* Gaya untuk tombol */

        /* Add CSS styles for the modal and overlay */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(121, 121, 121, 1.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            width: 100%;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 20px;
            cursor: pointer;
        }

        #toggle-button {
        position: fixed;
        bottom: 15px;
        left: -25px;
        z-index: 999;
        width: 50px;
        height: 50px;
        background: url('/assets/media/PLAY.png') no-repeat center;
        background-size: cover;
        border-radius: 50%;
        border: 2px solid #ffd700;
        opacity: 0.5;
        cursor: pointer;
        outline: none;
        transition: left 0.3s; /* Add a transition for the left property */
        }

#toggle-button:hover {
  left: 20px; /* Move to left: 20px when hovered */
  opacity: 1;
}


</style>
<!--
<script>
document.addEventListener("DOMContentLoaded", function () {
    const loadMoreButton = document.getElementById("load-more-button");
    const hiddenImages = document.querySelectorAll(".gallery-portfolio a.link-pop:nth-child(n+6)");
    let showingMore = false;

    loadMoreButton.addEventListener("click", function () {
        if (!showingMore) {
            hiddenImages.forEach(function (image) {
                image.style.display = "inline-block";
            });
            loadMoreButton.textContent = "Show Less";
            showingMore = true;
        } else {
            hiddenImages.forEach(function (image) {
                image.style.display = "none";
            });
            loadMoreButton.textContent = "Load More";
            showingMore = false;
        }
    });
});
</script>
-->
<body class="v-light hamburger-menu dsn-effect-scroll dsn-ajax" data-dsn-mousemove="true">


    <div data-dsn-temp="light"></div>

    <div class="preloader">
        <div class="preloader-after"></div>
        <div class="preloader-before"></div>
        <div class="preloader-block">
            <div class="title">Mahendra & Friska</div>
            <div class="percent">0</div>
            <div class="loading">Inviting You</div>
        </div>
        <div class="preloader-bar">
            <div class="preloader-progress"></div>
        </div>
    </div>


    <div class="dsn-nav-bar">
        <div class="site-header">
            <div class="extend-container">
                <div class="inner-header">
                    <div class="main-logo">
                        <a href="index.html">
                            <img class="dark-logo" src="assets/img/logo-dark.png" alt="" />
                            <img class="light-logo" src="assets/img/logo.png" alt="" />
                        </a>
                    </div>
                </div>
                <nav class="accent-menu main-navigation">
                    <ul class="extend-container">
                        <li class="custom-drop-down">
                            <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=Mahendra+%26+Friska+Wedding&dates=20231201T153000/20231201T220000&location=Alindra+Jimbaran+-+Bali&details=We+Invite+You+To+Join+In+Our+Wedding+Celebration+-+Mahendra+%26+Friska%2C+Your+Presence+On+Our+Wedding+Would+Be+Incredibly+Meaningful+To+Us." class="xmenu" onclick="window.open(this.href, '_blank'); return false;" id="addEventLink">Save The Date</a>
                        </li>
                        <li class="custom-drop-down">
                            <a href="https://www.instagram.com/ar/2626676687471099/" class="xmenu" onclick="window.open(this.href, '_blank'); return false;">Instagram Filter</a>
						</li>
                        </ul>
                </nav>
            </div>
        </div>
        <div class="header-top header-top-hamburger">
            <div class="header-container">
                <div class="logo main-logo">
                        <img class="dark-logo" src="assets/img/logo-dark.png" alt="Hendra & Friska" />
                        <img class="light-logo" src="assets/img/logo.png" alt="Hendra & Friska" />
                </div>

                <div class="menu-icon" data-dsn="parallax" data-dsn-move="5">
                    <div class="icon-m">
                        <i class="menu-icon-close fas fa-times"></i>
                        <span class="menu-icon__line menu-icon__line-left"></span>
                        <span class="menu-icon__line"></span>
                        <span class="menu-icon__line menu-icon__line-right"></span>
                    </div>

                    <div class="text-menu">
                        <div class="text-button">Menu</div>
                        <div class="text-open">Open</div>
                        <div class="text-close">Close</div>
                    </div>
                </div>

                <div class="nav">
                    <div class="inner">
                        <div class="nav__content">

                        </div>
                    </div>
                </div>
                <div class="nav-content">
                    <div class="inner-content">
                    </div>	
                </div>
            </div>
        </div>
    </div>
    <!-- End Nav Bar -->


    <audio id="song" loop>
        <source src="/assets/media/Goodness_of_God.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <div onclick="toggleAudio()" id="toggle-button"></div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <img src="assets/img/Logo-Large.png" width="100px" alt="" style="margin:10px 0px -50px 0px; max-width: 30%;height: auto;">
			<h3 style="font-size: 25px; margin-top: 50px;"><?= $guest_name ?></h3>
            <p style="margin-top: 10px !important;">You have a special invitation from us</p>
            <input type="hidden" id="guestusername" value="<?= $guest_username ?>" >
            <button class="btn" id="openinvitation"  style="margin-top: 20px !important; margin-bottom: 50px;">Open Invitation</button>
        </div>
    </div>


  <?php
  }

  public function footer($pages = "" , $req = []){


  ?>

     <!-- Wait Loader -->
     <div class="wait-loader">
        <div class="loader-inner">
            <div class="loader-circle">
                <div class="loader-layer"></div>
            </div>
        </div>
    </div>
    <!-- // Wait Loader -->


    <!-- cursor -->
    <div class="cursor">

        <div class="cursor-helper cursor-view">
            <span>VIEW</span>
        </div>

        <div class="cursor-helper cursor-close">
            <span>Close</span>
        </div>

        <div class="cursor-helper cursor-link"></div>
    </div>
    <!-- End cursor -->

    <!-- Optional JavaScript -->
    <script src="/assets/js/jquery-3.1.1.min.js"></script>
    <script src="/assets/js/plugins.js"></script>
    <script src="/assets/js/dsn-grid.js"></script>
    <script src="/assets/js/custom.js"></script>
	<script src="https://apis.google.com/js/api.js?onload=handleClientLoad"></script>
</body>

</html>

  <?php  } } ?>
