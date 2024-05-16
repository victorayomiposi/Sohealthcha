<!DOCTYPE html>
<html lang="en">

<head>

    <!-- META ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Sohealthcha" />
    <meta name="author" content="Sohealthcha" />
    <meta name="robots" content="Sohealthcha" />
    <meta name="description" content="Sohealthcha" />
    <meta property="og:title" content="Sohealthcha" />
    <meta property="og:description" content="Sohealthcha" />
    <meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">
    @include('title')

     <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- All PLUGINS CSS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/assets.css') }}">

    <!-- TYPOGRAPHY ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/typography.css') }}">

    <!-- SHORTCODES ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/shortcodes/shortcodes.css') }}">

    <!-- STYLESHEETS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('assets/css/color/color-1.css') }}">

</head>

<body id="bg">
    <div class="page-wraper">
        <div id="loading-icon-bx"></div>
        <!-- Header Top ==== -->
        @include('home.header')
        <!-- header END ==== -->
        <!-- Content -->
        <div class="page-content bg-white">
            <!-- inner page banner -->
            <div class="page-banner ovbl-dark"
                style="background-image:url({{ asset('assets/images/banner/banner1.jpg') }});">
                <div class="container">
                    <div class="page-banner-entry">
                        <h1 class="text-white">{{ $posts->name }}</h1>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb row -->
            <div class="breadcrumb-row">
                <div class="container">
                    <ul class="list-inline">
                        <li><a href="#">Home</a></li>
                        <li>Department</li>
                    </ul>
                </div>
            </div>
            <div class="content-block">
                <!-- Your Faq -->
                <div class="section-area section-sp1">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="heading-bx left">
                                    <h2 class="m-b10 title-head">ABOUT US</h2>
                                </div>
                                <p class="m-b10">{{ $posts->about }}</p>
        <!--                        <div class="ttr-accordion m-b30 faq-bx" id="accordion1">-->
								<!--	<div class="panel">-->
								<!--		<div class="acod-head">-->
								<!--			<h6 class="acod-title"> -->
								<!--				<a data-toggle="collapse" href="#faq1" class="collapsed" data-parent="#faq1">-->
								<!--				Why won t my payment go through? </a> </h6>-->
								<!--		</div>-->
								<!--		<div id="faq1" class="acod-body collapse">-->
								<!--			<div class="acod-content">Web design aorem apsum dolor sit amet, adipiscing elit, sed diam nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>-->
								<!--		</div>-->
								<!--	</div>-->
								<!--	<div class="panel">-->
								<!--		<div class="acod-head">-->
								<!--			<h6 class="acod-title"> -->
								<!--				<a data-toggle="collapse" href="#faq2" class="collapsed" data-parent="#faq2">-->
								<!--				How do I get a refund?</a> </h6>-->
								<!--		</div>-->
								<!--		<div id="faq2" class="acod-body collapse">-->
								<!--			<div class="acod-content">Graphic design aorem apsum dolor sit amet, adipiscing elit, sed diam nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>-->
								<!--		</div>-->
								<!--	</div>-->
								<!--	<div class="panel">-->
								<!--		<div class="acod-head">-->
								<!--			<h6 class="acod-title"> -->
								<!--				<a data-toggle="collapse" href="#faq3" class="collapsed" data-parent="#faq3">-->
								<!--				How do I redeem a coupon? </a> </h6>-->
								<!--		</div>-->
								<!--		<div id="faq3" class="acod-body collapse">-->
								<!--			<div class="acod-content">Developement aorem apsum dolor sit amet, adipiscing elit, sed diam nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>-->
								<!--		</div>-->
								<!--	</div>-->
								<!--	<div class="panel">-->
								<!--		<div class="acod-head">-->
								<!--			<h6 class="acod-title"> -->
								<!--				<a data-toggle="collapse" href="#faq4" class="collapsed" data-parent="#faq4">-->
								<!--				Why aren t my courses showing in my account? </a> </h6>-->
								<!--		</div>-->
								<!--		<div id="faq4" class="acod-body collapse">-->
								<!--			<div class="acod-content">Developement aorem apsum dolor sit amet, adipiscing elit, sed diam nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>-->
								<!--		</div>-->
								<!--	</div>-->
								<!--	<div class="panel">-->
								<!--		<div class="acod-head">-->
								<!--			<h6 class="acod-title"> -->
								<!--				<a data-toggle="collapse" href="#faq5" class="collapsed" data-parent="#faq5">-->
								<!--				Changing account name </a> </h6>-->
								<!--		</div>-->
								<!--		<div id="faq5" class="acod-body collapse">-->
								<!--			<div class="acod-content">Developement aorem apsum dolor sit amet, adipiscing elit, sed diam nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>-->
								<!--		</div>-->
								<!--	</div>-->
								<!--	<div class="panel">-->
								<!--		<div class="acod-head">-->
								<!--			<h6 class="acod-title"> -->
								<!--			<a data-toggle="collapse" href="#faq5" class="collapsed" data-parent="#faq6">-->
								<!--				Changing account name </a></h6>-->
								<!--		</div>-->
								<!--		<div id="faq6" class="acod-body collapse">-->
								<!--			<div class="acod-content">Developement aorem apsum dolor sit amet, adipiscing elit, sed diam nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>-->
								<!--		</div>-->
								<!--	</div>-->
								<!--</div>-->
                                <p class="m-b10">{{ $posts->description }}</p>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <form class="contact-bx dzForm" action="#">
                                    <div class="dzFormMsg"></div>
                                    <div class="heading-bx left">
                                        <h2 class="title-head">Get In <span>Touch</span></h2>
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page</p>
                                    </div>
                                    <div class="row placeani">
                                        <div class="col-lg-6 ">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>Your Name</label>
                                                    <input name="dzName" type="text" required class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>Your Email Address</label>
                                                    <input name="dzEmail" type="email" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>Your Phone</label>
                                                    <input name="dzOther[Phone]" type="text" required
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>Subject</label>
                                                    <input name="dzOther[Subject]" type="text" required
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label>Type Message</label>
                                                    <textarea name="dzMessage" rows="4" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="g-recaptcha"
                                                        data-sitekey="6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN"
                                                        data-callback="verifyRecaptchaCallback"
                                                        data-expired-callback="expiredRecaptchaCallback"></div>
                                                    <input class="form-control d-none" style="display:none;"
                                                        data-recaptcha="true" required
                                                        data-error="Please complete the Captcha">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button name="submit" type="submit" value="Submit"
                                                class="btn button-md"> Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Your Faq End -->
            </div>
            <!-- contact area END -->
        </div>
        <!-- Content END-->
        <!-- Footer ==== -->
        <footer>
            <div class="footer-top">
                <div class="pt-exebar">
                    <div class="container">
                        <div class="d-flex align-items-stretch">
                            <div class="pt-logo mr-auto">
                                <a href="index.html"><img src="assets/images/logo-white.png" alt="" /></a>
                            </div>
                            <div class="pt-social-link">
                                <ul class="list-inline m-a0">
                                    <li><a href="#" class="btn-link"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="btn-link"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="btn-link"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#" class="btn-link"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                            <div class="pt-btn-join">
                                <a href="#" class="btn ">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 footer-col-4">
                            <div class="widget">
                                <h5 class="footer-title">Sign Up For A Newsletter</h5>
                                <p class="text-capitalize m-b20">Weekly Breaking news analysis and cutting edge advices
                                    on job searching.</p>
                                <div class="subscribe-form m-b20">
                                    <form class="subscription-form"
                                        action="http://educhamp.themetrades.com/demo/assets/script/mailchamp.php"
                                        method="post">
                                        <div class="ajax-message"></div>
                                        <div class="input-group">
                                            <input name="email" required="required" class="form-control"
                                                placeholder="Your Email Address" type="email">
                                            <span class="input-group-btn">
                                                <button name="submit" value="Submit" type="submit"
                                                    class="btn"><i class="fa fa-arrow-right"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-md-7 col-sm-12">
                            <div class="row">
                                <div class="col-4 col-lg-4 col-md-4 col-sm-4">
                                    <div class="widget footer_widget">
                                        <h5 class="footer-title">Company</h5>
                                        <ul>
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="about-1.html">About</a></li>
                                            <li><a href="faq-1.html">FAQs</a></li>
                                            <li><a href="contact-1.html">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-4 col-lg-4 col-md-4 col-sm-4">
                                    <div class="widget footer_widget">
                                        <h5 class="footer-title">Get In Touch</h5>
                                        <ul>
                                            <li><a
                                                    href="http://educhamp.themetrades.com/admin/index.html">Dashboard</a>
                                            </li>
                                            <li><a href="blog-classic-grid.html">Blog</a></li>
                                            <li><a href="portfolio.html">Portfolio</a></li>
                                            <li><a href="event.html">Event</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-4 col-lg-4 col-md-4 col-sm-4">
                                    <div class="widget footer_widget">
                                        <h5 class="footer-title">Courses</h5>
                                        <ul>
                                            <li><a href="courses.html">Courses</a></li>
                                            <li><a href="courses-details.html">Details</a></li>
                                            <li><a href="membership.html">Membership</a></li>
                                            <li><a href="profile.html">Profile</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-5 col-sm-12 footer-col-4">
                            <div class="widget widget_gallery gallery-grid-4">
                                <h5 class="footer-title">Our Gallery</h5>
                                <ul class="magnific-image">
                                    <li><a href="assets/images/gallery/pic1.jpg" class="magnific-anchor"><img
                                                src="assets/images/gallery/pic1.jpg" alt=""></a></li>
                                    <li><a href="assets/images/gallery/pic2.jpg" class="magnific-anchor"><img
                                                src="assets/images/gallery/pic2.jpg" alt=""></a></li>
                                    <li><a href="assets/images/gallery/pic3.jpg" class="magnific-anchor"><img
                                                src="assets/images/gallery/pic3.jpg" alt=""></a></li>
                                    <li><a href="assets/images/gallery/pic4.jpg" class="magnific-anchor"><img
                                                src="assets/images/gallery/pic4.jpg" alt=""></a></li>
                                    <li><a href="assets/images/gallery/pic5.jpg" class="magnific-anchor"><img
                                                src="assets/images/gallery/pic5.jpg" alt=""></a></li>
                                    <li><a href="assets/images/gallery/pic6.jpg" class="magnific-anchor"><img
                                                src="assets/images/gallery/pic6.jpg" alt=""></a></li>
                                    <li><a href="assets/images/gallery/pic7.jpg" class="magnific-anchor"><img
                                                src="assets/images/gallery/pic7.jpg" alt=""></a></li>
                                    <li><a href="assets/images/gallery/pic8.jpg" class="magnific-anchor"><img
                                                src="assets/images/gallery/pic8.jpg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center"><a target="_blank"
                                href="https://www.templateshub.net">Templates Hub</a></div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer END ==== -->
        <button class="back-to-top fa fa-chevron-up"></button>
    </div>
    <!-- External JavaScripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('assets/vendors/magnific-popup/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/vendors/counter/waypoints-min.js') }}"></script>
    <script src="{{ asset('assets/vendors/counter/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/imagesloaded/imagesloaded.js') }}"></script>
    <script src="{{ asset('assets/vendors/masonry/masonry.js') }}"></script>
    <script src="{{ asset('assets/vendors/masonry/filter.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    <script src="{{ asset('assets/js/contact.js') }}"></script>
    <script src="{{ asset('assets/vendors/switcher/switcher.js') }}"></script>
</body>

</html>
