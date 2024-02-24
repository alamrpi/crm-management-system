<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>WITL CRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('css/custom/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .text-blue {
            color: #207DE9 !important;
        }
        .wb-form-control {
            font-size: 18px;
            color: #565656 !important;
            font-weight: 300;
            background: #fff !important;
            /* box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.05); */
            padding: 1rem 1.5rem;
            height: 60px;
            -webkit-box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.05);
            margin-bottom: 10px;
            border: 1px solid transparent;
            outline: none !important;
        }

        .wb-subtitle {
            color: #869298;
            font-size: 18px;
            line-height: 1.667em;
            letter-spacing: -.005em;
        }

        .wb-nav-tabs {
            border-bottom: none;
        }
        .wb-nav-tabs .nav-item {
            padding: 10px;
        }
        .wb-nav-tabs .nav-link {
            color: #869298;
            background-color: #fff;
            padding: 33px;
            font-weight: 900;
            border-radius: 15px;
            border: none;
        }
        .wb-nav-tabs .nav-link.active {
            color: #0E6AD2 !important;
            background-color: #ECF4FF !important;
        }
        .wb-customer-card {
            background-color: #fff;
            border-radius: 15px;
            border: none;
        }
        .wb-customer-card h4 {
            white-space: nowrap;
            overflow: hidden;
        }
        .wb-customer-card:hover , .wb-customer-card:hover h4{
            background-color: #E9EEF6;
            overflow: visible;
        }
        .wb-customer-card.active{
            background-color: #E9EEF6;
        }
        .text-justify {
            text-align: justify !important;
        }
        .navbar-landing {
            -webkit-transition: position 10s;
            -moz-transition: position 10s;
            -ms-transition: position 10s;
            -o-transition: position 10s;
            transition: position 10s;
        }
    </style>

</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

<!-- Begin page -->
<div class="layout-wrapper landing">
    <nav class="navbar navbar-expand-lg navbar-landing" id="navbar">
        <div class="container-fluid">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
            </ul>

            <div class="">
                <a href="#" class="btn btn-link fw-medium text-decoration-none text-body fs-16 py-0"><i class="bx bx-search me-1 position-relative" style="top: 2px;"></i> Search</a>
                <a href="{{ route('login') }}" class="btn btn-link fw-medium text-decoration-none text-body fs-16 py-0"><i class="bx bx-user me-1 position-relative" style="top: 2px;"></i> Login</a>
                <a href="tel:+8801404440010" class="btn btn-link fw-medium text-decoration-none text-primary fw-bold fs-16 py-0"><i class="bx bxs-phone me-1 position-relative" style="top: 2px;"></i> +880 1404 440010</a>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-landing bg-white" id="top-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/logo-dark.png') }}" class="card-logo card-logo-dark" alt="logo dark" height="25">
                <img src="{{ asset('assets/images/logo-dark.png') }}" class="card-logo card-logo-light" alt="logo light" height="25">
            </a>
            <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-nav">

                    <li class="nav-item dropdown dropdown-hover position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-mdb-toggle="dropdown" aria-expanded="false">
                            SEO & Lead Generation
                        </a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu w-100 mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;border-top-right-radius: 0; left: 0;background-color: #F9FBFF; padding: 20px 40px 48px 40px;">
                            <div class="container-fluid">
                                <div class="row my-4">
                                    <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                        <ul class="nav nav-sm flex-column mega-menu">
                                            <li class="nav-item">
                                                <span class="mega-menu-image-wrapper">
                                                    <img src="https://www.webfx.com/wp-content/uploads/2023/05/icon-organic-search.svg">
                                                    <span class="mega-menu-image-wrappe title">Organic Search</span>
                                                </span>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">SEO Services</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Enterprise SEO Services</a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Digital Marketing Services</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Local SEO Services</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Google Local Services Ads Management</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">SEO Audits</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Page Speed Optimization</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                        <ul class="nav nav-sm flex-column mega-menu">
                                            <li class="nav-item">
                                                <span class="mega-menu-image-wrapper">
                                                    <img src="https://www.webfx.com/wp-content/uploads/2023/05/icon-digital-advertising.svg">
                                                    <span class="mega-menu-image-wrappe title">Digital Advertising</span>
                                                </span>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">PPC Management Services</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Enterprise PPC Management Services</a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Social Media Advertising</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Enterprise Social Media Advertising</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Programmatic Advertising Services</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Addressable Geofencing Services</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Connected TV & OTT</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                        <ul class="nav nav-sm flex-column mega-menu">
                                            <li class="nav-item">
                                                <span class="mega-menu-image-wrapper">
                                                    <img src="https://www.webfx.com/wp-content/uploads/2023/05/icon-social-media.svg">
                                                    <span class="mega-menu-image-wrappe title">Ecommerce</span>
                                                </span>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Ecommerce SEO Services</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Ecommerce PPC Services</a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Ecommerce Social Media Advertising</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">B2B Ecommerce Enablement</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Shopping Feed Automation</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Ecommerce Digital Marketing Services</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Ecommerce Marketing Resources</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                                        <ul class="nav nav-sm flex-column mega-menu">
                                            <li class="nav-item">
                                                <span class="mega-menu-image-wrapper">
                                                    <img src="https://www.webfx.com/wp-content/uploads/2023/05/icon-learn-seo.svg">
                                                    <span class="mega-menu-image-wrappe title">Learn</span>
                                                </span>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Our SEO Results</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">Our SEO Case Studies</a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="#" class="nav-link">What Is an SEO Company?</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">How to Find the Best SEO Company</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">SEO Guide for Marketing Managers</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">What Is Digital Marketing?</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">What Is Digital Marketing?</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-hover position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-mdb-toggle="dropdown" aria-expanded="false">
                            Revenue Marketing & CRO
                        </a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu w-100 mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;border-top-right-radius: 0; left: 0;background-color: #F9FBFF; padding: 20px 40px 48px 40px;">

                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-hover position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-mdb-toggle="dropdown" aria-expanded="false">
                            UX & Interactive
                        </a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu w-100 mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;border-top-right-radius: 0; left: 0;background-color: #F9FBFF; padding: 20px 40px 48px 40px;">

                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-hover position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-mdb-toggle="dropdown" aria-expanded="false">
                            Technology
                        </a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu w-100 mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;border-top-right-radius: 0; left: 0;background-color: #F9FBFF; padding: 20px 40px 48px 40px;">

                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-hover position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-mdb-toggle="dropdown" aria-expanded="false">
                            Who We Are
                        </a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu w-100 mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;border-top-right-radius: 0; left: 0;background-color: #F9FBFF; padding: 20px 40px 48px 40px;">

                        </div>
                    </li>

                </ul>

                <div class="">
                    <a href="#" class="btn btn-primary">Get a Proposal</a>
                </div>
            </div>

        </div>
    </nav>
    <!-- end navbar -->
    <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>

    @yield('content')

    <!-- Start footer -->
    <section class="before-footer bg-primary pt-4 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-2 px-2">
                            <div class="avatar-lg mx-auto w-100">
                                <img src="https://i.pravatar.cc/300?img=19" alt="" id="candidate-img" class="img-thumbnail rounded-circle shadow-none">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <p class="ready-to-speak">Ready to speak with a marketing expert? Give us a ring</p>
                            <h1 class="speak-number">888-601-5359</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="number-in-million">1.6 million</h3>
                            <p class="number-in-million-title fw-normal">Hours of Expertise</p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="number-in-million">500+</h3>
                            <p class="number-in-million-title fw-normal">Digital Marketing Masters On Staff</p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="number-in-million">1,600</h3>
                            <p class="number-in-million-title fw-normal">Websites Launched</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="custom-footer bg-dark py-5 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-3 mt-4">
                            <h5 class="text-white mb-0">SERVICES</h5>
                            <div class="text-muted mt-3">
                                <ul class="list-unstyled ff-secondary footer-list fs-14">
                                    <li><a href="">Digital Marketing Services</a></li>
                                    <li><a href="">SEO Services</a></li>
                                    <li><a href="">Competitor Geofencing Services</a></li>
                                    <li><a href="">Web Design Services</a></li>
                                    <li><a href="">Social Media Services</a></li>
                                    <li><a href="">Digital Advertising Services</a></li>
                                    <li><a href="">Content Marketing Services</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-4">
                            <h5 class="text-white mb-0">KNOWLEDGE BASE</h5>
                            <div class="text-muted mt-3">
                                <ul class="list-unstyled ff-secondary footer-list fs-14">
                                    <li><a href="">Digital Marketing</a></li>
                                    <li><a href="">Content Marketing</a></li>
                                    <li><a href="">Social Media</a></li>
                                    <li><a href="">Web Design</a></li>
                                    <li><a href="">SEO</a></li>
                                    <li><a href="">PPC</a></li>
                                    <li><a href="">Amazon</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-4">
                            <h5 class="text-white mb-0">COMPANY</h5>
                            <div class="text-muted mt-3">
                                <ul class="list-unstyled ff-secondary footer-list fs-14">
                                    <li><a href="">Digital Marketing Agency</a></li>
                                    <li><a href="">SEO Agency</a></li>
                                    <li><a href="">PPC Agency</a></li>
                                    <li><a href="">Content Marketing Agency</a></li>
                                    <li><a href="">Social Media Agency</a></li>
                                    <li><a href="">Web Design Agency</a></li>
                                    <li><a href="">Industries We Serve</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-4">
                            <h5 class="text-white mb-0">RESOURCES</h5>
                            <div class="text-muted mt-3">
                                <ul class="list-unstyled ff-secondary footer-list fs-14">
                                    <li><a href="">About Us</a></li>
                                    <li><a href="">Contact Us</a></li>
                                    <li><a href="">Careers</a></li>
                                    <li><a href="">Phishing Scam Alert</a></li>
                                    <li><a href="">Locations</a></li>
                                    <li><a href="">Community Impact</a></li>
                                    <li><a href="">Tools</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row text-center text-sm-start align-items-center mt-5">
                <div class="col-sm-6">

                    <div>
                        <p class="copy-rights mb-0">
                            2023 © Web Info Tech Ltd.
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end mt-3 mt-sm-0">
                        <ul class="list-inline mb-0 footer-social-link">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-facebook-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-github-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-linkedin-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-google-fill"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-dribbble-line"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

</div>
<!-- end layout wrapper -->


<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>

<!--Swiper slider js-->
<script src="assets/libs/swiper/swiper-bundle.min.js"></script>

<!-- landing init -->
<script src="assets/js/pages/landing.init.js"></script>
@yield('script')
</body>

</html>
