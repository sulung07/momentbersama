<?php
$design = new templateController();

$eventID    = "720620230726095130";
$pagesCover = true;
$pagesBody  = false;
$guestID    = "";

$template   = $this->getData("template_setting")->get(array("get_single" , array($eventID)));
$slideshow  = $this->getData("template_slide")->get(array("get_all" , array($eventID)));
$info       = $this->getData("event_info")->get(array("by_event" , array($eventID)));
$story      = $this->getData("template_story")->get(array("get_all" , array($eventID)));
$galery     = $this->getData("event_galery")->get(array("get_all" , array($eventID)));

if(!empty($pages))
{

    ## get data 
    $guest         = $this->getData("guest")->get(array("by_username" , array($eventID , $pages)));
    $guest_name    = $guest['guest_name'];
    $gest_username = $guest['guest_username'];
    $guestID       = $guest['guestID'];
    $event_list    = $this->getData("guest_activity")->get(array("by_guestID" , array($eventID , $guestID)));

}else{

    $guest_name    = "TAMU UNDANGAN";
    $gest_username = "";
    $event_list    = array();

}

if(isset($_SESSION['guestID']))
{
    $pagesCover = false;
    $pagesBody  = true;
}


$design->head($pages , array("$pages"));


?>


<?php if($pagesCover): ?>

    <section class="static-hero-s3">
        <div class="hero-container" >
            <div class="hero-inner"  >
                <div class="container" >
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="wpo-event-item" >
                                <div class="wpo-event-text">
                                    <h5>UNDANGAN PERNIKAHAN </h5>
                                    <p class="fw-bold">JOHANNES HERMAN <br> & <br> KOMANG WARMANI</p>
                                    <ul>
                                        <li>Kepada Yang Terhormat : <br> <br>  </li>
                                        <li><span class="fw-bold"><?= $guest_name ?></span> </li>
                                        <li> <a class="popup-gmaps" href="/gate/open/<?= $gest_username ?>">BUKA UNDANGAN</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>


<?php if($pagesBody): ?>

<style type="text/css">

.wpo-cta-section,
.wpo-cta-section-s2,
.wpo-cta-section-s3 {
  padding: 145px 0;
  background: url("/assets/media/<?= $template['background_sec_3'] ?>") no-repeat center center;
  position: relative;
  z-index: 1;
}



</style>


<audio id="song" loop>
    <source src="https://ourwedding.08-09-2023.com/assets/media/<?= $template['music_file'] ?>" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>


<button id="toggle-button" onclick="toggleAudio()"><i class="fa fa-play"></i></button>

 <!-- Modal Selamat Datang -->
 <div class="modal-container" id="modal-welcome">
    <div class="modal-content">
      <h2><br> SELAMAT DATANG DI PERNIKAHAN <br > <br> <span style="color:#B19A56;"> JOHANNES HERMAN <br> & <br>  KOMANG WARMANI </span></h2>
      <br><br><br>
      <button class="modal-button" onclick="startAudio()">Mulai</button>
    </div>
  </div>


    <section class="wpo-hero-slider wpo-hero-style-3">
            <div class="wedding-announcement">
                <div class="couple-text">
                    <h2 class="wow slideInUp" data-wow-duration="1s"><?= $template['header_section_title'] ?></h2>
                    <p class="wow slideInUp" data-wow-duration="1.8s"><?= $template['header_section_title_small'] ?></p>
                 
                </div>
            </div>

            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php if(!empty($slideshow)){ foreach ($slideshow as $key => $list) { ?>
                       
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image" data-background="/assets/media/<?= $list['images'] ?>">
                        </div> <!-- end slide-inner --> 
                    </div>
                    
                    <?php }} ?><!-- end swiper-slide -->

                 <!-- end swiper-slide -->
                </div>
                <!-- end swiper-wrapper -->

                <!-- swipper controls -->
                <div class="swiper-pagination"></div>
                <div class="next-prev-btn">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>

        <section class="wpo-wedding-date section-padding">
            <h2 class="hidden">some</h2>
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12 ">
                        <div class="clock-grids">
                            <div id="clock"></div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>

        

        <!-- end of hero slider -->
        <!-- start couple-section -->
        <section class="couple-section pt-160 section-padding" id="couple">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col col-xs-12">
                        <div class="couple-area clearfix">
                            <div class="text-grid bride">
                                <div class="couple-img">
                                    <img src="/assets/media/<?= $info['groom_pic'] ?>" alt="" loading="lazy">
                                </div>
                                <h3><?= $info['groom_name'] ?></h3>
                                <p><?= $info['groom_desc'] ?></p>
                               
                            </div>
                            <div class="middle-couple-pic">
                                <img src="/assets/media/<?= $template['background_sec_1'] ?>" alt="" loading="lazy">
                                <div class="frame-img"><img src="assets/images/couple/shape.png" alt=""></div>
                            </div>
                            <div class="text-grid groom">
                                <div class="couple-img">
                                    <img src="/assets/media/<?= $info['bride_pic'] ?>" alt="" loading="lazy">
                                </div>
                                <h3><?= $info['bride_name'] ?></h3>
                                <p><?= $info['bride_desc'] ?></p>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end couple-section -->
        <!-- start wpo-video-section -->
        <section class="wpo-video-section-s2">
            <h2 class="hidden">some</h2>
            <div class="wpo-video-item">
                <div class="wpo-video-img">
                    <img src="/assets/media/<?= $template['background_sec_2'] ?>" alt="" loading="lazy">
                    <a href="<?= $template['video_link'] ?>" class="video-btn" data-type="iframe"><i
                            class="fi flaticon-play"></i></a>
                </div>
            </div>
        </section>
        <!-- end wpo-video-section-->

        <!-- start story-section -->
        <section class="story-section section-padding" id="story">
            <div class="container">
                <div class="row">
                    <div class="wpo-section-title-s2">
                        <div class="section-title-simg">
                            <img src="assets/images/section-title2.png" alt="" >
                        </div>
                        <h2>Perjalanan Singkat Hubungan Kami</h2>
                        <div class="section-title-img">
                            <div class="round-ball"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="story-timeline">
                            <div class="round-shape"></div>


                            <?php $no = 0; if(!empty($story)){ foreach ($story as $key => $list) { $no++;    
                                if ($no % 2 === 0) {
                                ?>

                                
                                <div class="row">
                                    <div class="col col-lg-6 col-12">
                                        <div class="img-holder right-align-text left-site">
                                            <img src="/assets/media/<?= $list['story_images'] ?>" alt class="img img-responsive" loading="lazy">
                                            <div class="story-shape-img">
                                                <img src="assets/images/story/shape.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-12 text-holder">
                                        <span class="heart">
                                            <i class="fi flaticon-heart"></i>
                                        </span>
                                        <div class="story-text">
                                            <h3><?= $list['story_title'] ?></h3>
                                            <span class="date"><?= $list['story_date'] ?></span>
                                            <p><small><?= $list['story_desc'] ?></small></p>
                                        </div>
                                    </div>
                                </div>


                                <?php                                        
                                        
                                } else {

                                ?>

                                <div class="row">
                                <div class="col col-lg-6 col-12">
                                    <div class="story-text right-align-text">
                                        <h3><?= $list['story_title'] ?></h3>
                                        <span class="date"><?= $list['story_date'] ?></span>
                                        <p><small><?= $list['story_desc'] ?></small></p>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-12">
                                    <div class="img-holder">
                                        <img src="/assets/media/<?= $list['story_images'] ?>" alt class="img img-responsive" loading="lazy">
                                        <div class="story-shape-img">
                                            <img src="assets/images/story/shape.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <?php
                                    
                                }

                                ?>
                                    

                            <?php } } ?>

                           
                         
                            <div class="row">
                                <div class="col offset-lg-6 col-lg-6 col-12 text-holder">
                                    <span class="heart">
                                        <i class="fi flaticon-wedding-rings"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end story-section -->

        <!-- start wpo-portfolio-section -->
        <section class="wpo-portfolio-section-s3 section-padding" >
            <div class="container">
                <div class="row">
                    <div class="wpo-section-title-s2">
                        <div class="section-title-simg">
                            <img src="assets/images/section-title2.png" alt="">
                        </div>
                        <h2>Moment Bahagia</h2>
                        <div class="section-title-img">
                            <div class="round-ball"></div>
                        </div>
                    </div>
                </div>
                <div class="sortable-gallery">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="portfolio-grids gallery-container clearfix">

                               
                                <?php if(!empty($galery)){ foreach ($galery as $key => $list) { ?>
                                
                              
                                <div class="grid">
                                    <div class="img-holder">
                                        <a href="/assets/media/<?= $list['images'] ?>" class="fancybox" data-fancybox-group="gall-1">
                                            <img src="/assets/media/<?= $list['images'] ?>" alt class="img" loading="lazy">
                                            <div class="hover-content">
                                                <i class="ti-plus"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            

                                <?php } } ?>

                             
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end container -->
        </section>
        <!-- end wpo-portfolio-section -->

        <section class="wpo-event-section section-padding" id="event">
            <div class="container">
                <div class="row">
                    <div class="wpo-section-title-s2">
                        <div class="section-title-simg">
                            <img src="assets/images/section-title2.png" alt="">
                        </div>
                        <h2>Waktu & Tempat <br></h2>
                        <div class="section-title-img">
                            <div class="round-ball"></div>
                        </div>

                        <br>

                        <small class="text-center mt-4">Tanpa Mengurangi Rasa Hormat & Karena Keterbatasan Waktu & Tempat, Kami Mengundang Bapak / Ibu Untuk Bersama - Sama Datang Pada : </small>


                    </div>
                    

                </div>
                <div class="wpo-event-wrap">
                    <div class="row">

                        <?php if(!empty($event_list)){ foreach ($event_list as $key => $list) { ?>

                        <div class="col col-lg-4 col-md-6 col-12">
                            <div class="wpo-event-item">
                                <div class="wpo-event-text">
                                    <h2><?= $list['activity_name'] ?></h2>
                                    <ul>
                                        <li><?= $this->dateIndoHari($list['activity_date']) ?> <br> ( <?= $list['activity_time'] ?> - <?= $list['activity_time_end'] ?> )</li>
                                        <li><?= $list['activity_loc_title'] ?></li>
                                       

                                        <li> <a class="popup-gmaps" href="<?= $list['activity_loc_maps'] ?>">See Location</a></li>
                                    </ul>
                                </div>
                                <div class="event-shape-1">
                                    <img src="/assets/images/event-shape-1.png" alt="">
                                </div>
                                <div class="event-shape-2">
                                    <img src="/assets/images/event-shape-2.png" alt="">
                                </div>
                            </div>
                        </div>
                        
                        <?php } } ?>

                        
                     
                    </div>
                </div>

            </div> <!-- end container -->
        </section>

        <!-- start of wpo-contact-section -->
        <section class="wpo-contact-section section-padding" id="RSVP">
            <div class="container">
                <div class="wpo-contact-section-wrapper">
                    <div class="wpo-contact-form-area">
                        <div class="wpo-section-title-s2">
                            <div class="section-title-simg">
                                <img src="assets/images/section-title2.png" alt="">
                            </div>
                            <h2>RSVP <br> <small><?= $guest_name ?></small></h2>
                            <div class="section-title-img">
                                <div class="round-ball"></div>
                            </div>
                        </div>
                        <form method="post" class="contact-validation-active" id="contact-form-main">
                          
                            <input type="hidden" name="guestID" value="<?= $gest_username ?>">
                            <div>
                                <select name="guest" class="form-control">
                                    <option disabled="disabled" selected>Number Of Guests</option>

                                    <?php
                                    $guestMax = $guest['guest_number'];
                                    ?>

                                    <?php 
                                    for($x = 1; $x <= $guestMax; $x++)
                                    {

                                    ?>

                                    <option value="<?= $x ?>"><?= $x ?></option>

                                    <?php
                                    }
                                    ?>

                                   
                                  
                                </select>
                            </div>
                            <div>
                                <select name="arrival" class="form-control">
                                    <option disabled="disabled" selected>Confirmation of arrival</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                
                                </select>
                            </div>
                            <div class="submit-area">
                                <button type="submit" class="theme-btn-s3">Send RSVP</button>
                                <div id="c-loader">
                                    <i class="ti-reload"></i>
                                </div>
                            </div>
                            <div class="clearfix error-handling-messages">
                                <div id="success">Thank you</div>
                                <div id="error"> Error occurred while sending email. Please try again later.
                                </div>
                            </div>
                        </form>
                        <div class="border-style"></div>
                    </div>
                    <div class="vector-1">
                        <img src="/assets/images/contact/1.png" alt="">
                    </div>
                    <div class="vector-2">
                        <img src="/assets/images/contact/2.png" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- end of wpo-contact-section -->



           <!-- start wpo-cta-section -->

           <div class="wpo-cta-section-s3">
            <div class="conatiner-fluid">
                <div class="wpo-cta-item">
                    <h2>Kami Yang Berbahagia </h2>
                    <p><?= $info['groom_name'] ?> & <?= $info['bride_name'] ?></p>
                    <a class="theme-btn-s2" href="/gate/close/<?= $gest_username ?>">Tutup Undangan</a>

                </div>
            </div>
        </div>

        <!-- end wpo-cta-section -->


      

      
<?php endif; ?>

<?php 
$design->footer($pages , array("")); 
?>

<?php if($pagesBody): ?>

    <script>
    var audio = document.getElementById('song'); // Dapatkan elemen audio dengan ID "song"
    var userInteracted = false; // Variabel untuk menandai apakah pengguna telah berinteraksi
    var audioLoaded = false; // Variabel untuk menandai apakah file audio telah dimuat

    // Fungsi untuk menampilkan modal
    function showModal() {
      document.getElementById('modal-welcome').style.display = 'flex';
    }

    // Fungsi untuk menutup modal
    function closeModal() {
      document.getElementById('modal-welcome').style.display = 'none';
    }

    // Fungsi untuk memulai pemutaran audio setelah modal ditutup atau tombol "Mulai" diklik
    function startAudio() {
      closeModal();
      userInteracted = true; // Setelah tombol "Mulai" diklik, tandai bahwa pengguna telah berinteraksi
      lazyLoadAudio();
    }

    // Fungsi untuk lazy load audio
    function lazyLoadAudio() {
      if (!audioLoaded) {
        var audioSource = 'https://ourwedding.08-09-2023.com/assets/media/<?= $template['music_file'] ?>';
        audio.src = audioSource; // Setel sumber audio
        audioLoaded = true; // Tandai bahwa audio telah dimuat
      }
      toggleAudio(); // Mulai pemutaran audio setelah file audio dimuat
    }

    // Fungsi untuk memulai atau menghentikan pemutaran audio
    function toggleAudio() {
      if (!userInteracted) {
        return; // Jika pengguna belum berinteraksi, jangan coba memulai audio
      }

      if (audio.paused) {
        audio.play();
      } else {
        audio.pause();
      }
      updateToggleButton();
    }

    // Fungsi untuk memperbarui tampilan tombol toggle berdasarkan status pemutaran audio
    function updateToggleButton() {
      var toggleButton = document.getElementById('toggle-button');
      if (audio.paused) {
        toggleButton.innerHTML = '<i class="fa fa-play"></i>';
      } else {
        toggleButton.innerHTML = '<i class="fa fa-stop"></i>';
      }
    }

    // Tampilkan modal ketika dokumen selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
      showModal();
    });
  </script>

    <script>
    // var audio = document.getElementById('song'); // Dapatkan elemen audio dengan ID "song"
    // var userInteracted = false; // Variabel untuk menandai apakah pengguna telah berinteraksi

    // // Fungsi untuk menampilkan modal
    // function showModal() {
    //   document.getElementById('modal-welcome').style.display = 'flex';
    // }

    // // Fungsi untuk menutup modal
    // function closeModal() {
    //   document.getElementById('modal-welcome').style.display = 'none';
    // }

    // // Fungsi untuk memulai pemutaran audio setelah modal ditutup atau tombol "Mulai" diklik
    // function startAudio() {
    //   closeModal();
    //   userInteracted = true; // Setelah tombol "Mulai" diklik, tandai bahwa pengguna telah berinteraksi
    //   toggleAudio();
    // }

    // // Fungsi untuk memulai atau menghentikan pemutaran audio
    // function toggleAudio() {
    //   if (!userInteracted) {
    //     return; // Jika pengguna belum berinteraksi, jangan coba memulai audio
    //   }

    //   if (audio.paused) {
    //     audio.play();
    //   } else {
    //     audio.pause();
    //   }
    //   updateToggleButton();
    // }

    // // Fungsi untuk memperbarui tampilan tombol toggle berdasarkan status pemutaran audio
    // function updateToggleButton() {
    //   var toggleButton = document.getElementById('toggle-button');
    //   if (audio.paused) {
    //     toggleButton.innerHTML = '<i class="fa fa-play"></i>';
    //   } else {
    //     toggleButton.innerHTML = '<i class="fa fa-stop"></i>';
    //   }
    // }

    // // Tampilkan modal ketika dokumen selesai dimuat
    // document.addEventListener('DOMContentLoaded', function() {
    //   showModal();
    // });
  </script>
<?php endif; ?>
