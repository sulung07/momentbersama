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

                                        <p>WE INVITE YOU <b style="color:#FFCD00 !important;"><?= strtoupper($guest['guest_name']) ?></b> TO OUR WEDDING CELEBRATION.</p>

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
                                        <img src="assets/img/pic/ch4.jpg" alt="">
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
                    <div class="gallery-portfolio section-margin">
						
                        <a class="link-pop" href="assets/img/pic/Gal001.jpg"
                            data-source="assets/img/pic/Gal001.jpg" >
                            <img src="assets/img/pic/Gal001.jpg" alt="">
                        </a>
						
						
                        <a class="link-pop" href="assets/img/pic/Gal002.jpg"
                            data-source="assets/img/pic/Gal002.jpg" >
                            <img src="assets/img/pic/Gal002.jpg" alt="">
                        </a>
						
						
                        <a class="link-pop" href="assets/img/pic/Gal003.jpg"
                            data-source="assets/img/pic/Gal003.jpg" >
                            <img src="assets/img/pic/Gal003.jpg" alt="">
                        </a>
						
						
                        <a class="link-pop" href="assets/img/pic/Gal004.jpg"
                            data-source="assets/img/pic/Gal004.jpg" >
                            <img src="assets/img/pic/Gal004.jpg" alt="">
                        </a>
						
						
                        <a class="link-pop" href="assets/img/pic/Gal005.jpg"
                            data-source="assets/img/pic/Gal005.jpg" >
                            <img src="assets/img/pic/Gal005.jpg" alt="">
                        </a>
						
						
                        <a class="link-pop" href="assets/img/pic/Gal006.jpg"
                            data-source="assets/img/pic/Gal006.jpg" >
                            <img src="assets/img/pic/Gal006.jpg" alt="">
                        </a>
						
						
                        <a class="link-pop" href="assets/img/pic/Gal007.jpg"
                            data-source="assets/img/pic/Gal007.jpg" >
                            <img src="assets/img/pic/Gal007.jpg" alt="">
                        </a>
						
						
                        <a class="link-pop" href="assets/img/pic/Gal008.jpg"
                            data-source="assets/img/pic/Gal008.jpg" >
                            <img src="assets/img/pic/Gal008.jpg" alt="">
                        </a>
						
						
                        <a class="link-pop" href="assets/img/pic/Gal009.jpg"
                            data-source="assets/img/pic/Gal009.jpg" >
                            <img src="assets/img/pic/Gal009.jpg" alt="">
                        </a>
						
						
                        <a class="link-pop" href="assets/img/pic/Gal010.jpg"
                            data-source="assets/img/pic/Gal010.jpg" >
                            <img src="assets/img/pic/Gal010.jpg" alt="">
                        </a>
						
                    </div>
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
												<div class="messages"></div>
												<div class="input__wrap controls">
												  <div class="form-group">

													<div class="entry">
													  <label>Name :</label>
													  <input id="form_name" type="text" name="name" placeholder="$GUEST_AND_WIFE">
													</div>
												  </div>

												  <div class="form-group">
													<div class="entry">
													  <label>Email :</label>
													  <input id="form_email" type="email" name="email" placeholder="Your Email">
													</div>
												  </div>

															<div class="form-group">
															  <div class="entry">
																<label>Available To Join ?</label>
															  </div>
															</div>
															<div class="radio-container">
															  <div class="radio-circle">
																<input type="radio" name="status" value="reserved" id="yes-radio">
																<label for="yes-radio">Yes</label>
															  </div>
															  <div class="radio-circle">
																<input type="radio" name="status" value="decline" id="no-radio">
																<label for="no-radio">No</label>
															  </div>
															</div>
													
													</div>

												  <div class="image-zoom" style="margin: 30px 0px ;">
													<button>SUBMIT</button>
												  </div>
											  </form>

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
												<div class="messages"></div>
												<div class="input__wrap controls">
												  <div class="form-group">

													<div class="entry">
													  <label>Name :</label>
													  <input id="form_name" type="text" name="name" placeholder="$GUEST_AND_WIFE">
													</div>
												  </div>

												  <div class="form-group">
													<div class="entry">
													  <label>Email :</label>
													  <input id="form_email" type="email" name="email" placeholder="Your Email">
													</div>
												  </div>

													<div class="form-group">
													<div class="entry">
													  <label>Wish :</label>	
															<textarea id="form_message" class="form-control" name="message" placeholder="" style="height: 20px !important;"></textarea>
													
													</div>
													</div>
												  
													</div>

												  <div class="image-zoom">
													<button>BLESSING</button>
												  </div>
											  </form>

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
                            <a href="index.html" class="effect-ajax">
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
                            <div class="link-hover"><a class="link-hover"
                                    data-hover-text="DSN Grid" href="#" target="_blank">Code Dev | Momenbersama + Eirene Solutions</a>
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

    document.addEventListener('DOMContentLoaded', function() {
        showModal();
    });

    function showModal(username) {
        var modal = document.getElementById('myModal');
        // var closeButton = modal.querySelector('.close');
        var openinvitation = modal.querySelector('#openinvitation');

        modal.style.display = 'flex';

        openinvitation.addEventListener('click', function() {

            var guestUsername = $("#guestusername").val();

            $.ajax({

                type : "post",
                url  : "/gate/open/"+guestUsername,
                success:function(response)
                {

                    
                        modal.style.display = 'none';


                }

            })

        });
    }

    // var audio = document.getElementById('song'); // Dapatkan elemen audio dengan ID "song"
    // var userInteracted = false; // Variabel untuk menandai apakah pengguna telah berinteraksi
    // var audioLoaded = false; // Variabel untuk menandai apakah file audio telah dimuat

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
    //   lazyLoadAudio();
    // }

    // // Fungsi untuk lazy load audio
    // function lazyLoadAudio() {
    //   if (!audioLoaded) {
    //     var audioSource = '';
    //     audio.src = audioSource; // Setel sumber audio
    //     audioLoaded = true; // Tandai bahwa audio telah dimuat
    //   }
    //   toggleAudio(); // Mulai pemutaran audio setelah file audio dimuat
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
   
  </script>

   
