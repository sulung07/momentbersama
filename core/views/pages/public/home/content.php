<?php
$design = new templateController();

$eventID    = "277720230807155913";
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
    $guest_name     = $guest['guest_name'];
    $guest_username = $guest['guest_username'];
    $guestID       = $guest['guestID'];
    $event_list    = $this->getData("guest_activity")->get(array("by_guestID" , array($eventID , $guestID)));

}else{

    $guest_name    = "TAMU UNDANGAN";
    $guest_username = "";
    $event_list    = array();

}

if(isset($_SESSION['guestID']))
{
    $pagesCover = false;
    $pagesBody  = true;
}


$design->head($pages , array("$pages"));

$galery_list = array(
    array('pic' => 'Gal001.jpg', 'id' => '1'),
    array('pic' => 'Gal002.jpg', 'id' => '2'),
    array('pic' => 'Gal003.jpg', 'id' => '3'),
    array('pic' => 'Gal004.jpg', 'id' => '4'),
    array('pic' => 'Gal005.jpg', 'id' => '5'),
    array('pic' => 'Gal006.jpg', 'id' => '6'),
    array('pic' => 'Gal007.jpg', 'id' => '7'),
    array('pic' => 'Gal008.jpg', 'id' => '8'),
    array('pic' => 'Gal009.jpg', 'id' => '9'),
    array('pic' => 'Gal010.jpg', 'id' => '10')
);



$item_count = 5; // Menampilkan 5 item pertama

$remaining_items = array_slice($galery_list, $item_count); // Item yang tersisa
?>



?>



    
<main class="main-root">
        <div id="dsn-scrollbar">
            <div class="dsn-slider demo3" data-dsn-header="project">
                <div class="dsn-root-slider" id="dsn-hero-parallax-img">
                    <div class="slide-inner">
                        <div class="swiper-wrapper">
                            <div class="slide-item swiper-slide">
                                <div class="slide-content">
                                    <div class="slide-content-inner">
                                        <div class="project-metas">
                                            <div class="project-meta-box project-work cat">
                                                <span>THE WEDDING OF</span>
                                            </div>
                                        </div>

                                        <div class="title-text-header">
                                            <div class="title-text-header-inner">
                                                <a href="#" class="effect-ajax" data-dsn-ajax="slider">
                                                    MAHENDRA + FRISKA
                                                </a>
                                            </div>
                                        </div>

                                        <p>WE INVITE YOU <b style="color:#FFCD00 !important;"><?= strtoupper($guest_name) ?></b> TO OUR WEDDING CELEBRATION.</p>

                                    </div>
                                </div>
                                <div class="image-container">
                                    <div class="image-bg cover-bg" data-image-src="assets/img/pic/slider001.jpg"
                                        data-overlay="5">
                                        <img src="assets/img/pic/slider001.jpg" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="slide-item swiper-slide">
                                <div class="slide-content">
                                    <div class="slide-content-inner">
                                        <div class="project-metas">
                                            <div class="project-meta-box project-work cat">
                                                <span>WEDDING VENUE</span>
                                            </div>
                                        </div>

                                        <div class="title-text-header">
                                            <div class="title-text-header-inner">
                                                <a href="#" class="effect-ajax" data-dsn-ajax="slider">
                                                   Alindra Villas
                                                </a>
                                            </div>
                                        </div>

                                        <p>Jl. By Pass Ngurah Rai. Jimbaran - Bali.</p>

                                    </div>
                                </div>
                                <div class="image-container">
                                    <div class="image-bg cover-bg" data-image-src="assets/img/pic/slider002.jpg"
                                        data-overlay="5">
                                        <img src="assets/img/pic/slider002.jpg" alt="">
                                    </div>
                                </div>
                            </div>


                            <div class="slide-item swiper-slide">
                                <div class="slide-content">
                                    <div class="slide-content-inner">
                                        <div class="project-metas">
                                            <div class="project-meta-box project-work cat">
                                                <span>SAVE THE DATE</span>
                                            </div>
                                        </div>

                                        <div class="title-text-header">
                                            <div class="title-text-header-inner">
                                                <a href="#" class="effect-ajax" data-dsn-ajax="slider">
                                                    First December
                                                </a>
                                            </div>
                                        </div>

                                        <p>Friday, 01 December 2023, 4:00 PM</p>

                                    </div>
                                </div>
                                <div class="image-container">
                                    <div class="image-bg cover-bg" data-image-src="assets/img/pic/slider003.jpg"
                                        data-overlay="5">
                                        <img src="assets/img/pic/slider003.jpg" alt="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="dsn-slider-content"></div>


                <div class="nav-slider">
                    <div class="swiper-wrapper" role="navigation">
						
                        <div class="swiper-slide">
                            <div class="image-container">
                                <div class="image-bg cover-bg" data-image-src="assets/img/pic/slider001.jpg"
                                    data-overlay="2">
                                </div>
                            </div>
                            <div class="content">
                            </div>
                        </div>
						
                        <div class="swiper-slide">
                            <div class="image-container">
                                <div class="image-bg cover-bg" data-image-src="assets/img/pic/slider002.jpg"
                                    data-overlay="2">
                                </div>
                            </div>
                            <div class="content">
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="image-container">
                                <div class="image-bg cover-bg" data-image-src="assets/img/pic/slider003.jpg"
                                    data-overlay="2">
                                </div>
                            </div>
                            <div class="content">
                            </div>
                        </div>

                    </div>
                </div>

                <section class="footer-slid" id="descover-holder">
                    <div class="control-num">
                    </div>
                    <div class="control-nav">
                        <div class="prev-container" data-dsn="parallax">
                            <svg viewBox="0 0 40 40">
                                <path class="path circle" d="M20,2A18,18,0,1,1,2,20,18,18,0,0,1,20,2"></path>
                                <polyline class="path" points="14.6 17.45 20 22.85 25.4 17.45"></polyline>
                            </svg>
                        </div>

                        <div class="next-container" data-dsn="parallax">
                            <svg viewBox="0 0 40 40">
                                <path class="path circle" d="M20,2A18,18,0,1,1,2,20,18,18,0,0,1,20,2"></path>
                                <polyline class="path" points="14.6 17.45 20 22.85 25.4 17.45"></polyline>
                            </svg>
                        </div>
                    </div>
                </section>

            </div>

            <div class="wrapper">

                <section class="intro-about section-margin">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="intro-content-text">

                                    <h2 data-dsn-grid="move-section" data-dsn-move="-30" data-dsn-duration="100%"
                                        data-dsn-opacity="1.2" data-dsn-responsive="tablet">
                                        We gather here today in the presence of God
                                    </h2>

                                    <p data-dsn-animate="text">Love is patient, love is kind. It does not envy, it does not boast, it is not proud. It does not dishonor others, it is not self-seeking, it is not easily angered, it keeps no record of wrongs. Love does not delight in evil but rejoices with the truth. It always protects, always trusts, always hopes, always perseveres. Love never fails.</p>

                                    <h6 data-dsn-animate="text"> 1 Corinthians </h6>
                                    <small data-dsn-animate="text">13:4-8a (NIV)</small>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="background-mask">
                        <div class="background-mask-bg"></div>
                        <div class="img-box">
                            <div class="img-cent" data-dsn-grid="move-up">
                                <div class="img-container">
                                    <img data-dsn-y="30%" src="assets/img/pic/pic001.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="our-services-2 section-margin">
                    <div class="container">
                        <div class="one-title" data-dsn-animate="up">
                            <div class="title-sub-container">
                                <p class="title-sub">Our Profiles</p>
                            </div>
                            <h2 class="title-main">Two soul who promise to live forever</h2>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="services-item">
                                    <div class="corner corner-top"></div>
                                    <div class="corner corner-bottom"></div>
                                    <div class="icon">
                                        <img src="assets/img/pic/profile01.jpg" alt="">
                                    </div>
                                    <div class="services-header">
                                        <h3>I Gst Agung Adek Mahendra P</h3>
                                    </div>
                                    <p>The second child of the couple </br>
                                    I Gst Ketut Semarajaya & Jero Putu Sri Artini</p>
                                </div>
                            </div>
					
                            <div class="col-md-4">
                                <div class="services-item">
                                    <div class="corner corner-top"></div>
                                    <div class="corner corner-bottom"></div>
                                    <div class="icon">
                                        <img src="assets/img/pic/profile02.jpg" alt="">
                                    </div>
                                    <div class="services-header">
                                        <h3>Friska Andriani Putri</h3>
                                    </div>
                                    <p>The third daughter of the couple </br>
								Fajar Prayitno & Febe Samiyati</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
	
                <section class="our-news section-margin" data-dsn="color">
                    <div class="container">
                        <div class="one-title" data-dsn-animate="up">
                            <div class="title-sub-container">
                                <p class="title-sub">Our Timeline</p>
                            </div>
                            <h2 class="title-main">The Day Were We Meet</h2>
                        </div>
                        <div class="custom-container">
                            <div class="slick-slider">
								
                                <div class="item-new slick-slide">
                                    <div class="image" data-overlay="3">
                                        <img src="assets/img/pic/ch1.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="background"></div>
                                        <h5>Chapter 01</h5>

                                        <div class="cta" style="margin-bottom: 30px;">
                                            <a href="#">The Beginning</a>
                                        </div>

										<p>
										In January 2015, First time we met each other at the workplace Ricky n Co Photography. During that time, Mahendra held the role of a video editor, while Friska embarked on an internship program as a video editor in the same location. This journey spanned a distance of 740.8 km from the island of Java to Bali. this is where our story begins.
										</p>

                                    </div>
                                </div>

                                <div class="item-new slick-slide">
                                    <div class="image" data-overlay="3">
                                        <img src="assets/img/pic/ch2.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="background"></div>
                                        <h5>Chapter 02</h5>

                                        <div class="cta" style="margin-bottom: 30px;">
                                            <a href="#">After</a>
                                        </div>

										<p>
										After holding a short meeting for 3 months, our hearts crossed each other but have not been able to start a relationship because of the many differences between us, until 1 year later, October 2016 to be precise we met again.
										</p>

                                    </div>
                                </div>
                                <div class="item-new slick-slide">
                                    <div class="image" data-overlay="3">
                                        <img src="assets/img/pic/ch3.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="background"></div>
                                        <h5>Chapter 03</h5>

                                        <div class="cta" style="margin-bottom: 30px;">
                                            <a href="#">First Date</a>
                                        </div>

										<p>
										5 months we often met and spent time together, on 18 February 2017 we finally committed to taking care of each other, to get to know each other more and to share joys and sorrows with the differences we had at that time.
										</p>

                                    </div>
                                </div>
                                <div class="item-new slick-slide">
                                    <div class="image" data-overlay="3">
                                        <img src="/assets/img/pic/ch4.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="background"></div>
                                        <h5>Chapter 04</h5>

                                        <div class="cta" style="margin-bottom: 30px;">
                                            <a href="#">For Good & Bad</a>

                                        </div>

										<p>
										In 2018 we started a new step in our relationship, we founded Shierra Studios, and during those ups and downs in our relationship we went through it together with building our dreams, until now we are working, growing and processing together.
										</p>

                                    </div>
                                </div>
                                <div class="item-new slick-slide">
                                    <div class="image" data-overlay="3">
                                        <img src="assets/img/pic/ch5.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="background"></div>
                                        <h5>Chapter 05</h5>

                                        <div class="cta" style="margin-bottom: 30px;">
                                            <a href="#">The Day Has Come True</a>
                                        </div>

										<p>
										Long story short 2022 we got engaged and a year later we decided to get married, because of all the differences and challenges in our relationship one by one we found common ground, First December 2023 will be a new beginning for our relationship, So they are no longer two, but one flesh. Therefore, what God has joined together, no human being must separate.
										</p>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

                <div class="box-seat box-seat-full section-margin">
                    <div class="container-fluid">
                        <div class="inner-img" data-dsn-grid="move-up">
                            <img src="assets/img/pic/Alindra.jpg" alt="">
                        </div>
                        <div class="pro-text">
                            <h3>Our Special Day <br>at Alindra Villas</h3>
                            <p><i class="fas fa-church"></i> : Ceremony & Reception</p>
                            <p><i class="fas fa-map-marker-alt"></i> : By Pass Ngurah Rai, Jimbaran, South Kuta, Badung Regency, Bali 80363</p>
                            <p><i class="fas fa-calendar-alt"></i> : Friday, 01 December 2023</p>
                            <p><i class="fas fa-clock"></i> : 04:00 PM - END</p>
                            <div class="link-custom">
                                <a class="image-zoom effect-ajax" href="https://goo.gl/maps/wHrabKHQntjsUkm57" target="_blank" data-dsn="parallax">
                                    <span>See Location Maps</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="our-work work-under-header  section-margin" data-dsn-col="3">
                    <div class="container">
                        <div class="one-title">
                            <div class="title-sub-container">
                                <p class="title-sub">Our Gallery</p>
                            </div>
                            <h2 class="title-main">Hope You Remember Us</h2>
                        </div>
                    </div>
                    
                    <div class="gallery-portfolio section-margin" id="galery-data" >

        
                    <?php 
                    if(!empty($galery_list)){ 
                        foreach ($galery_list as $key => $list) {
                            if ($key < $item_count) {
                                ?>
                                <a class="link-pop" href="/assets/img/pic/<?= $list['pic'] ?>"
                                    data-source="/assets/img/pic/<?= $list['pic'] ?>" >
                                    <img src="/assets/img/pic/<?= $list['pic'] ?>" alt="">
                                </a>
                                <?php
                            } else {
                                break;
                            }
                        }
                    }
                    ?>
                
                    </div>

                    <?php if (!empty($remaining_items)) { ?>
                        <div class="col-12 text-center mt-4">
                            <button class="btn btn-light" id="load-more-btn">Load More</button>
                        </div>
                    <?php } ?>

                    
                </section>
                
                <section class="our-news section-margin">
                    <div class="container">
                        <div class="one-title" data-dsn-animate="up">
                            <div class="title-sub-container">
                                <p class="title-sub">Share Your Thoughts</p>
                            </div>
                            <h2 class="title-main">Wishes and Blessings</h2>
                        </div>
                        <div class="custom-container">
                            <div class="slick-slider">
								
                                <div class="item-new slick-slide">
                                    <div class="image" data-overlay="3">
                                        <img src="assets/img/pic/RSVP.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="background"></div>
                                        <h5>RSVP</h5>

                                        <div class="cta" style="margin-bottom: 30px;">
                                            <a href="#">Confirming</a>
                                        </div>

										<form id="rsvp" class="form" method="post" action="#" data-toggle="validator">
                                        <input type="hidden" name="username" value="<?= $guest_username ?>">
												<div class="input__wrap controls">
												  <div class="form-group">

													<div class="entry">
													  <label>Name :</label>
													  <input id="form_name" type="text" name="name" disabled placeholder="<?= $guest_name ?>">
													</div>
												  </div>

												  <!-- <div class="form-group">
													<div class="entry">
													  <label>Email :</label>
													  <input id="form_email" type="email" name="email" placeholder="Your Email">
													</div>
												  </div> -->

															<div class="form-group">
															  <div class="entry">
																<label>Available To Join ?</label>
															  </div>
															</div>
															<div class="radio-container">
															  <div class="radio-circle">
																<input type="radio" name="status" value="reserved" checked id="yes-radio">
																<label for="yes-radio">Yes</label>
															  </div>
															  <div class="radio-circle">
																<input type="radio" name="status" value="decline" id="no-radio">
																<label for="no-radio">No</label>
															  </div>
															</div>
													
													</div>

												 

											  </form>

                                              <div class="image-zoom" style="margin: 30px 0px ;">
													<button onclick="sendrsvp()">SUBMIT</button>
											  </div>

                                              <div id="messages" class="messages mb-1"></div>


                                                 

                                    </div>
                                </div>

                                <div class="item-new slick-slide">
                                    <div class="image" data-overlay="3">
                                        <img src="assets/img/pic/WISH.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="background"></div>
                                        <h5>WISHES</h5>

                                        <div class="cta" style="margin-bottom: 30px;">
                                            <a href="#">Your Blessings</a>
                                        </div>

										<form id="bless" class="form" method="post" action="#" data-toggle="validator">
                                        <input type="hidden" name="username" value="<?= $guest_username ?>">

												<div class="messages"></div>
												<div class="input__wrap controls">
												  <div class="form-group">

													<div class="entry">
													  <label>Name :</label>
													  <input id="form_name" type="text" name="name" disabled placeholder="<?= $guest_name ?>">
													</div>
												  </div>

												  
													<div class="form-group">
													<div class="entry">
													  <label>Wish :</label>	
															<textarea id="form_message" class="form-control" name="message" placeholder="" style="height: 20px !important;"></textarea>
													
													</div>
													</div>
												  
													</div>

												 
											  </form>

                                              <div class="image-zoom">
													<button onclick="sendwish()">BLESSING</button>
												</div>

                                                <div id="messages_wish" class="messages mt-2"></div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
	
	
                <div class=" box-gallery-vertical section-margin section-padding" data-dsn="color">
                    <div class="mask-bg"></div>
                    <div class="container">
                        <div class="row align-items-center h-100">
                            <div class="col-lg-6 ">
                                <div class="box-im" data-dsn-grid="move-up">
                                    <img class="has-top-bottom" src="assets/img/pic/pic002.jpg" alt=""
                                        data-dsn-move="20%">
                                </div>
                            </div>

                            <div class="col-lg-6">


                                <div class="box-info">

                                    <div class="vertical-title" data-dsn-animate="up">
                                        <h2>Moments in Time</h2>
                                    </div>

                                    <h6 data-dsn-animate="up">We don't remember the days, but we remember the moments when we were together.</h6>

                                    <div class="link-custom" data-dsn-animate="up">
                                        <a class="image-zoom effect-ajax" href="https://www.youtube.com/" data-dsn="parallax">
                                            <span>WATCH VIDEO</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <section class="client-see section-margin">
                    <div class="container">
                        <div class="inner">
                            <div class="left">
                                <h2 class="title" data-dsn-grid="move-section" data-dsn-move="-60"
                                    data-dsn-duration="100%" data-dsn-opacity="1" data-dsn-responsive="tablet">
                                    <span class="text">Several Reasons Why We Are Mariage</span>
                                </h2>
                            </div>

                            <div class="items">
                                <div class="bg"></div>
                                <div class="slick-slider">
									
                                    <div class="item">
                                        <div class="quote">
                                            <p>"The Lord God said, 'It is not good for the man to be alone. I will make a helper suitable for him."</p>
                                        </div>
                                        <div class="bottom">
                                            <div class="label">
                                                <div class="cell">- Genesis 2:18 (NIV)</div>
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="item">
                                        <div class="quote">
                                            <p>"Therefore a man shall leave his father and his mother and hold fast to his wife, and they shall become one flesh."</p>
                                        </div>
                                        <div class="bottom">

                                            <div class="label">
                                                <div class="cell">- Genesis 2:24 (ESV)</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="quote">
                                            <p>"Therefore what God has joined together, let no one separate."</p>
                                        </div>
                                        <div class="bottom">

                                            <div class="label">
                                                <div class="cell">- Mark 10:9 (NIV)</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="contact-up section-margin section-padding">
                    <div class="container">
                        <div class="c-wapp">
                            <a href="javascript:window.location.reload();" class="effect-ajax">
                                <span class="hiring">
                                    Your presence on our wedding would be incredibly meaningful to us.
                                </span>
                                <span class="career">
                                    Seal Back Invitation
                                </span>
                            </a>
                        </div>
                    </div>
                </section>

            </div>

            <footer class="footer">
                <div class="container">
                    <div class="copyright">
                        <div class="text-center">
                            <p>© 01.12.2023 Mahendra & Friska</p>
                            <div class="link-hover"><a class="link-hover" data-hover-text="DSN Grid" >Code Dev | Momenbersama + Eirene Solutions</div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>





<?php 
$design->footer($pages , array("")); 
?>

<script>

function gallery() {
        var galleryPortfolio = $( ".gallery-portfolio" );

        if ( galleryPortfolio.length < 1 )
            return;

        galleryPortfolio.justifiedGallery( {
            rowHeight : 300,
            margins : 15,
        } );

        galleryPortfolio.magnificPopup( {
            delegate : "a",
            type : "image",
            closeOnContentClick : false,
            closeBtnInside : false,
            mainClass : "mfp-with-zoom", // this class is for CSS animation below
            gallery : {
                enabled : true,
            },
            zoom : {
                enabled : true,
                duration : 300, // don't foget to change the duration also in CSS
                easing : "ease-in-out", // CSS transition easing function
                opener : function ( element ) {
                    return element.find( "img" );
                },

            },
            callbacks : {
                open : function () {
                    // Will fire when this exact popup is opened
                    // this - is Magnific Popup object
                    $( "html" ).css( { margin : 0 } );
                },
                close : function () {
                    // Will fire when popup is closed
                },
                // e.t.c.
            },

        } );
    }

  $(document).ready(function () {
    var itemCount = <?php echo $item_count; ?>;
    var remainingItems = <?php echo json_encode($remaining_items); ?>;
    var loadCount = 5;
    var galleryLoaded = false; // Tambahkan variabel ini untuk mengontrol apakah galeri sudah dimuat

    $('#load-more-btn').click(function () {
    for (var i = 0; i <= loadCount; i++) {
        if (remainingItems.length > 0) {
            var item = remainingItems.shift();
            var itemHtml =
                '<a class="link-pop" href="assets/img/pic/' + item['pic'] + '"' +
                'data-source="assets/img/pic/' + item['pic'] + '" >' +
                '<img src="assets/img/pic/' + item['pic'] + '" alt="">' +
                '</a>';

            $('#galery-data').append(itemHtml);
            itemCount++;
        } else {
            $('#load-more-btn').hide(); // Sembunyikan tombol "Load More" jika semua item sudah ditampilkan
            break;
        }
    }
    gallery();
});
});

</script>


<script>
var audio = document.getElementById('song');
var userInteracted = false;
var audioLoaded = false;
var isPlaying = false;
var hideTimeout;

document.addEventListener('DOMContentLoaded', function () {
    showModal();
});

function showModal() {
    var modal = document.getElementById('myModal');
    var openinvitation = modal.querySelector('#openinvitation');
    var toggleButton = document.getElementById('toggle-button');

    modal.style.display = 'flex';

    openinvitation.addEventListener('click', function () {
        var guestUsername = $("#guestusername").val();

        $.ajax({
            type: "post",
            url: "/gate/open/" + guestUsername,
            success: function (response) {
                modal.style.display = 'none';
                userInteracted = true;
                isPlaying = true;
                // Mulai menghitung waktu untuk menyembunyikan tombol setelah 3 detik
                hideTimeout = setTimeout(function () {
                    toggleButton.style.left = '-25px';
                }, 3000);

               
                lazyLoadAudio();
                

            }
        });
    });

    toggleButton.addEventListener('click', function () {
        if (!userInteracted) {
            return;
        }

        if (isPlaying) {
            toggleButton.style.left = '20px'; // Tampilkan tombol saat tombol "pause" ditekan
        } else {
            toggleButton.style.left = '-25px'; // Sembunyikan tombol saat tombol "play" ditekan
        }

        isPlaying = !isPlaying; // Toggle status "isPlaying" saat tombol diklik
        toggleAudio();
    });
}

function lazyLoadAudio() {
    if (!audioLoaded) {
        var audioSource = "/assets/media/Goodness_of_God.mp3";
        audio.src = audioSource;
        audioLoaded = true;
        audio.load(); // Memuat audio
      }

      toggleAudio();
}

function toggleAudio() {
    if (!userInteracted) {
        return;
    }

    if (isPlaying) {
        audio.play();
        document.getElementById('toggle-button').style.backgroundImage = 'url("/assets/media/PLAYGIF.gif")';
    } else {
        audio.pause();
        document.getElementById('toggle-button').style.backgroundImage = 'url("/assets/media/PAUSE.png")';
    }
}

    </script>


    <script>

    
    function sendwish()
    {
        var data = $("#bless").serialize();

        $.ajax({

            type : "post",
            url  : "/gate/sendwish",
            data : data,
            success:function(response)
            {
            $("#messages_wish").html("<div class='alert alert-secondary' role='alert'>thank you for your blessing for us</div>");
            }

        })

    }

    function sendrsvp()
    {

        var data = $("#rsvp").serialize();

        $.ajax({

            type : "post",
            url  : "/gate/sendrsvp",
            data : data,
            success:function(response)
            {
            $("#messages").html("<div class='alert alert-secondary' role='alert'>thank you for confirming your rsvp</div>");
            }

        })

    }


</script>



   
