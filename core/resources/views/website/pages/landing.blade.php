@extends('website.layout')

@section('content')
    <section class="section main-section" id="plans" style="background-color: #CCE4FF;">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container mt-5">
            <!-- end row -->
            <div class="row justify-content-between">
                <div class="col-md-7 top-section">
                    <h6 class="mb-4 text-blue fs-18 fw-bold">DIGITAL MARKETING THAT DRIVES REVIEW&#169;</h6>
                    <h1 class="mt-3 main-heading fw-bold">Data-driven revenue marketing</h1>
                    <p class="mt-4 w-75 fs-18">
                        Choose Web Info Tech as your digital marketing agency and propel your
                        business to new heights with our award-winning digital
                        marketing services and proprietary technology platforms.
                    </p>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button class="btn btn-lg btn-primary me-2">See How We Did It</button>
                            <button class="btn btn-lg btn-outline-primary">View All</button>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="d-flex flex-row align-items-center">
                                <div class="">
                                    <img src="{{ asset('assets/images/landing/google-48.svg') }}" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1">
                                    <span class="fs-13">Google Rating</span>
                                    <span class="fs-13">5.0 <div id="basic-rater1" dir="ltr"></div></span>
                                    <span class="fs-13">Sell al our review</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-row align-items-center">
                                <div class="">
                                    <img src="{{ asset('assets/images/landing/google-48.svg') }}" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1">
                                    <span class="fs-13">Google Rating</span>
                                    <span class="fs-13">5.0 <div id="basic-rater2" dir="ltr"></div></span>
                                    <span class="fs-13">Sell al our review</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-md-5">
                    <div class="card card-primary" style="box-shadow: 0 0 30px 0 rgba(0,0,0,0.1);">
                        <div class="card-header border-bottom text-center">
                            <h3 class="text-white">CALL: 01751578150</h3>
                            <h6 class="text-white">Or fill in the form below and we'll call you.</h6>
                        </div>
                        <div class="card-body px-4" style="background-color: #f9f9f9;">
                            <form>
                                <div class="text-center mt-4">
                                    <input type="text" class="form-control wb-form-control mb-3" placeholder="Full Name">
                                    <input type="text" class="form-control wb-form-control mb-3" placeholder="Email Address">
                                    <input type="text" class="form-control wb-form-control mb-3" placeholder="Phone">
                                    <input type="text" class="form-control wb-form-control mb-3" placeholder="Message">
                                    <div class="mt-4 mb-4">
                                        <button class="btn btn-primary w-100 py-3 fs-20 fw-medium">Get A Free Consultation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!-- end container -->
    </section>
{{--   our clients--}}
    <section id="our-clients" class="section bg-light-subtle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="swiper swiper-slider">
                            <div class="swiper-wrapper d-flex flex-row align-items-center">
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <img src="{{ asset('assets/images/landing/cloutech-svg.svg') }}" alt="">
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <img class="w-100" src="{{ asset('assets/images/landing/iso.svg') }}" alt="">
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <img class="w-100" src="{{ asset('assets/images/landing/goodfirms-logo.png') }}" alt="">
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <img class="w-100" src="{{ asset('assets/images/landing/google-partner-300.svg') }}" alt="">
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <img class="w-100" src="{{ asset('assets/images/landing/Hubspot_Partner_Logo.png') }}" alt="">
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <img class="w-100" src="{{ asset('assets/images/landing/Upwork_Logo.png') }}" alt="">
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container" style="box-shadow: 0 4px 30px rgba(50,78,135,.2);;background: #fff;padding: 35px 62px 35px 32px;border-radius: 12px;">
            <!-- end row -->
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <div class="dd_reviews-featured-image-wrapper">
                        <img src="{{ asset('assets/images/landing/witl.png') }}" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row justify-content-end">
                        <div class="col-12">

                            <h1 class="intro_header-title mb-1 text-uppercase" style="font-weight: 400;font-size: 48px;">Web Info Tech LTD.</h1>
                            <h3 class="mt-1 mb-3 wb-subtitle">Web Info Tech LTD is packed with passion-driven tech soldiers to win the race in digital marketing. We will also facilitate the business marketing of these products with our SEO experts so that they become a ready-to-use website and help sell a product from the company.</h3>
                            <div class="row gx-2">
                                <div class="col">
                                    <span class="badge bg-success-subtle text-dark fs-18 fw-normal">25-year track record</span>
                                </div>
                                <div class="col">
                                    <span class="badge bg-success-subtle text-dark fs-18 fw-normal">25-year track record</span>
                                </div>
                                <div class="col">
                                    <span class="badge bg-success-subtle text-dark fs-18 fw-normal">25-year track record</span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="w-100 bg-primary btn mt-5 text-white fs-24">Request Call Back</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
        <!-- end container -->
    </section>

    <section class="bg-light-subtle section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="ids_startform2">
                        <form action="/free-quote-alt/" method="GET" class="card-form">
                            <h4 class="card-title text-white"><strong>Ready to get started? Take your business to the next level with Web Info Tech</strong></h4>
                            <div class="card-body">
                                <input type="text" name="website" class="form-control" placeholder="Enter your website" required="">
                                <button type="submit" class="btn fx-complementary-btn card-btn text-white">Get a Proposal <i class="mdi mdi-arrow-right-thin"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="solved-section big-titles section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="solved-section-title fw-medium">Challenge accepted</h1>
                    <h3 class="solved-section-subtitle text-muted fw-normal">Web Info Tech solves your digital bottlenecks.</h3>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="solved-card">
                                <div class="card-body">
                                    <h4 class="card-title fw-medium">My website isn’t getting enough traffic</h4>
                                    <div class="card-text fs-16">
                                        Without consistent site traffic, you’re missing out on valuable visitors, leads, and revenue. Thankfully, custom SEO solutions can get you back on track by boosting your presence in search engine results, so more people can find and visit your site.
                                    </div>
                                    <div class="card-footer text-start mt-4">
                                        <a href="#" class="btn card-btn ignore-external fw-normal">Explore SEO Services <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="solved-card">
                                <div class="card-body">
                                    <h4 class="card-title fw-medium">My CPL from digital ad campaigns is too high</h4>
                                    <div class="card-text fs-16">
                                        Without consistent site traffic, you’re missing out on valuable visitors, leads, and revenue. Thankfully, custom SEO solutions can get you back on track by boosting your presence in search engine results, so more people can find and visit your site.
                                    </div>
                                    <div class="card-footer text-start mt-4">
                                        <a href="#" class="btn card-btn ignore-external fw-normal">Explore PPC Services <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="solved-card">
                                <div class="card-body">
                                    <h4 class="card-title fw-medium">My website isn’t generating enough leads</h4>
                                    <div class="card-text fw-normal fs-16">
                                        Struggling to get qualified leads in your pipeline? Turn up the dial on your lead generation with digital marketing plans, tailored to your goals and budget.
                                    </div>
                                    <div class="card-footer text-start mt-4">
                                        <a href="#" class="btn card-btn ignore-external fw-normal">Explore Lead Gen Services <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="solved-card">
                                <div class="card-body">
                                    <h4 class="card-title fw-medium">My marketing and sales data is disconnected</h4>
                                    <div class="card-text fw-normal fs-16">
                                        Struggling to get qualified leads in your pipeline? Turn up the dial on your lead generation with digital marketing plans, tailored to your goals and budget.
                                    </div>
                                    <div class="card-footer text-start mt-4">
                                        <a href="#" class="btn card-btn ignore-external fw-normal">Explore MarketingCloudFX <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="solved-card">
                                <div class="card-body">
                                    <h4 class="card-title fw-medium">We’re unable to hit our SQL and revenue goals</h4>
                                    <div class="card-text fw-normal fs-16">
                                        Not happy with lead and revenue numbers? Attract and close more SQLs and watch sales soar with personalized revenue marketing.
                                    </div>
                                    <div class="card-footer text-start mt-4">
                                        <a href="#" class="btn card-btn ignore-external fw-normal">Explore Revenue Marketing Solutions <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="solved-card">
                                <div class="card-body">
                                    <h4 class="card-title fw-medium">Managing digital campaigns takes too much time</h4>
                                    <div class="card-text fw-normal fs-16">
                                        Not happy with lead and revenue numbers? Attract and close more SQLs and watch sales soar with personalized revenue marketing.
                                    </div>
                                    <div class="card-footer text-start mt-4">
                                        <a href="#" class="btn card-btn ignore-external fw-normal">Explore SEO Services <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="by-the-numbers section bg-light-subtle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="px-4 py-3">
                            <h1 class="fs-48 fw-bold text-center">By The Numbers</h1>
                            <h3 class="text-center text-muted fw-normal mt-3 mb-5">Our best-in-class digital marketing agency impresses customers with impactful results and wows them with stellar customer service</h3>
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="block-hero-card">
                                            <h3>Centrak</h3>
                                            <h4 class="card-title fw-normal">Decrease in PPC cost per lead</h4>
                                            <p class="card-value">90%</p>
                                            <a href="javascript:void(0);" class="card-link fs-16 fw-medium">Read Full Case Study<i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                        </div>
                                    </div>
                                <div class="col-md-3">
                                    <div class="block-hero-card">
                                        <h3>HydroWorx</h3>
                                        <h4 class="card-title fw-normal">Increase in organic sessions</h4>
                                        <p class="card-value">236%</p>
                                        <a href="javascript:void(0);" class="card-link fs-16 fw-medium">Read Full Case Study<i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="block-hero-card">
                                        <h3>Net Friends</h3>
                                        <h4 class="card-title fw-normal">Increase in website traffic and leads</h4>
                                        <p class="card-value">2X</p>
                                        <a href="javascript:void(0);" class="card-link fs-16 fw-medium">Read Full Case Study<i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="block-hero-card">
                                        <h3>KOA</h3>
                                        <h4 class="card-title fw-normal">Increase in organic transactions</h4>
                                        <p class="card-value">198%</p>
                                        <a href="javascript:void(0);" class="card-link fs-16 fw-medium">Read Full Case Study<i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-4">
                                <div class="col-md-10">
                                    <form action="#" method="GET" name="quote-form">
                                        <div class="block-hero-quote-form">
                                            <input type="text" class="form-control" placeholder="Enter your website" name="website" required="">
                                            <button type="submit" class="btn fx-complementary-btn card-btn text-white">Get a Proposal <i class="bic-arrow-right-green"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 mb-5">
                    <h1 class="fs-36 fw-bold text-center">World-Class Technology Powering Our Campaigns</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="nav nav-pills flex-column nav-pills-tab world-class-tech-tab card" role="tablist" aria-orientation="vertical">
                                <a class="nav-link ps-4 active show" id="custom-v-pills-home-tab" data-bs-toggle="pill" href="#custom-v-pills-home" role="tab" aria-controls="custom-v-pills-home" aria-selected="true">
                                    <h5 class="text-primary">CRM</h5>
                                    <span class="fw-normal fs-16">Improve customer satisfaction, and make informed decisions based on real-time insights</span>
                                </a>
                                <a class="nav-link" id="custom-v-pills-profile-tab" data-bs-toggle="pill" href="#custom-v-pills-profile" role="tab" aria-controls="custom-v-pills-profile" aria-selected="false" tabindex="-1">
                                    <h5 class="text-primary">Optimizely</h5>
                                    <span class="fw-normal fs-16">This is a software that helps you test and optimize your website, landing pages, and mobile apps for conversion</span>
                                </a>
                                <a class="nav-link" id="custom-v-pills-messages-tab" data-bs-toggle="pill" href="#custom-v-pills-messages" role="tab" aria-controls="custom-v-pills-messages" aria-selected="false" tabindex="-1">
                                    <h5 class="text-primary">Sprout Social</h5>
                                    <span class="fw-normal fs-16">This is a software that helps you manage your social media marketing campaigns, monitor your online reputation.</span>
                                </a>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-lg-6">
                            <div class="tab-content text-muted mt-3 mt-lg-0">
                                <div class="tab-pane fade active show" id="custom-v-pills-home" role="tabpanel" aria-labelledby="custom-v-pills-home-tab">
                                    <div class="d-flex mb-4 flex-column">
                                        <img class="w-100" src="{{ asset('assets/images/landing/world-class-tech-img.png') }}" alt="">
                                        <div class="d-flex w-100 mt-4">
                                            <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light me-4 fs-20 flex-grow-1">Read More</a>
                                            <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light fs-20 flex-grow-1">Watch Video</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane fade" id="custom-v-pills-profile" role="tabpanel" aria-labelledby="custom-v-pills-profile-tab">
                                    <div class="d-flex mb-4 flex-column">
                                        <img class="w-100" src="{{ asset('assets/images/landing/world-class-tech-img.png') }}" alt="">
                                        <div class="d-flex w-100 mt-4">
                                            <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light me-4 fs-20 flex-grow-1">Read More</a>
                                            <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light fs-20 flex-grow-1">Watch Video</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane fade" id="custom-v-pills-messages" role="tabpanel" aria-labelledby="custom-v-pills-messages-tab">
                                    <div class="d-flex mb-4 flex-column">
                                        <img class="w-100" src="{{ asset('assets/images/landing/world-class-tech-img.png') }}" alt="">
                                        <div class="d-flex w-100 mt-4">
                                            <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light me-4 fs-20 flex-grow-1">Read More</a>
                                            <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light fs-20 flex-grow-1">Watch Video</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div> <!-- end col-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light-subtle">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <h1 class="text-dark text-center fs-48 fw-bold">Dedicated Teams to Your Success</h1>
                    <p class="fw-normal fs-18 text-center text-muted mt-4">We have dedicated teams of skilled and experienced professionals who
                        work exclusively on your projects and deliver high-quality results. Our
                        dedicated teams are fully aligned with your goals, requirements, and
                        expectations, and act as an extension of your in-house teams.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-5">
                    <ul class="nav nav-tabs wb-nav-tabs nav-primary nav-justified mb-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-20 active" data-bs-toggle="tab" href="#dedicated-teams" role="tab" aria-selected="true">
                                <div class="down-arrow"></div>
                                Dedicated Teams
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-20" data-bs-toggle="tab" href="#dedicated-manager" role="tab" aria-selected="false" tabindex="-1">
                                <span class="down-arrow"></span>
                                Dedicated Manager
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-20" data-bs-toggle="tab" href="#dedicated-growth-manager" role="tab" aria-selected="false" tabindex="-1">
                                <span class="down-arrow"></span>
                                Dedicated Growth Manager
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" style="padding: 10px;">
                        <div class="tab-pane fade show active" id="dedicated-teams" role="tabpanel">
                            <div class="card mt-1" style="box-shadow: 0 2px 48px rgba(110,123,129,.2);border-radius: 15px;padding: 15px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="h-100 border-end p-2">
                                                <p class="fs-18 text-muted">Our dedicated teams are fully aligned
                                                    with your goals, requirements, and
                                                    expectations, and act as an extension of
                                                    your in-house teams. You have full
                                                    control and flexibility over the
                                                    management and communication of your
                                                    dedicated teams, while we provide them
                                                    with the necessary resources and
                                                    support. Our dedicated teams are the
                                                    best solution for your long-term and
                                                    complex projects that need constant
                                                    attention and adaptation.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile1.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile2.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile3.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile4.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile5.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile6.png') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="dedicated-manager" role="tabpanel">
                            <div class="card mt-1" style="box-shadow: 0 2px 48px rgba(110,123,129,.2);border-radius: 15px;padding: 15px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="h-100 border-end p-2">
                                                <p class="fs-18 text-muted">Our dedicated teams are fully aligned
                                                    with your goals, requirements, and
                                                    expectations, and act as an extension of
                                                    your in-house teams. You have full
                                                    control and flexibility over the
                                                    management and communication of your
                                                    dedicated teams, while we provide them
                                                    with the necessary resources and
                                                    support. Our dedicated teams are the
                                                    best solution for your long-term and
                                                    complex projects that need constant
                                                    attention and adaptation.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile1.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile2.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile3.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile4.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile5.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile6.png') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="dedicated-growth-manager" role="tabpanel">
                            <div class="card mt-1" style="box-shadow: 0 2px 48px rgba(110,123,129,.2);border-radius: 15px;padding: 15px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="h-100 border-end p-2">
                                                <p class="fs-18 text-muted">Our dedicated teams are fully aligned
                                                    with your goals, requirements, and
                                                    expectations, and act as an extension of
                                                    your in-house teams. You have full
                                                    control and flexibility over the
                                                    management and communication of your
                                                    dedicated teams, while we provide them
                                                    with the necessary resources and
                                                    support. Our dedicated teams are the
                                                    best solution for your long-term and
                                                    complex projects that need constant
                                                    attention and adaptation.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile1.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile2.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile3.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile4.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile5.png') }}" alt="">
                                                </div>
                                                <div class="col-md-4 rounded mb-4">
                                                    <img class="w-100 h-100" src="{{ asset('assets/images/landing/Profile6.png') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 mb-5">
                    <h3 class="text-center fs-24">Driving Digital Revenue For Our</h3>
                    <h1 class="text-center fs-36">1000+ Satisfied Customers</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" style="background: #F8FAFD;padding: 15px;border-radius: 6px;">
                    <div class="row" role="tablist">
                        <div class="col-md-3" role="presentation">
                            <div class="card wb-customer-card active">
                                <div class="card-body p-4 text-center">
                                    <a class="active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="mx-auto avatar-md mb-3">
                                            <img src="assets/images/customers/1.png" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <h4 class="fs-14">Coca Cola</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" role="presentation">
                            <div class="card wb-customer-card">
                                <div class="card-body p-4 text-center">
                                    <a class="active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="mx-auto avatar-md mb-3">
                                            <img src="assets/images/customers/2.png" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <h4 class="fs-14">NASA</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" role="presentation">
                            <div class="card wb-customer-card">
                                <div class="card-body p-4 text-center">
                                    <a class="active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="mx-auto avatar-md mb-3">
                                            <img src="assets/images/customers/3.png" alt="" class="img-fluid">
                                        </div>
                                        <h4 class="fs-14">Red Bull</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" role="presentation">
                            <div class="card wb-customer-card">
                                <div class="card-body p-4 text-center">
                                    <a class="active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="mx-auto avatar-md mb-3">
                                            <img src="assets/images/customers/4.png" alt="" class="img-fluid">
                                        </div>
                                        <h4 class="fs-14">Microsoft</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" role="presentation">
                            <div class="card wb-customer-card">
                                <div class="card-body p-4 text-center">
                                    <a class="active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="mx-auto avatar-md mb-3">
                                            <img src="assets/images/customers/5.png" alt="" class="img-fluid">
                                        </div>
                                        <h4 class="fs-14">Animal Planet</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" role="presentation">
                            <div class="card wb-customer-card">
                                <div class="card-body p-4 text-center">
                                    <a class="active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="mx-auto avatar-md mb-3">
                                            <img src="assets/images/customers/6.png" alt="" class="img-fluid">
                                        </div>
                                        <h4 class="fs-14">Macdonald</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" role="presentation">
                            <div class="card wb-customer-card">
                                <div class="card-body p-4 text-center">
                                    <a class="active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="mx-auto avatar-md mb-3">
                                            <img src="assets/images/customers/7.png" alt="" class="img-fluid">
                                        </div>
                                        <h4 class="fs-14">WWF</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" role="presentation">
                            <div class="card wb-customer-card">
                                <div class="card-body p-4 text-center">
                                    <a class="active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="mx-auto avatar-md mb-3 fs-24 fw-bold">
                                            +250
                                        </div>
                                        <h4 class="fs-14">MORE</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 portfolio-tab-content">
                        <div class="tab-content"  id="portfolio-tab-content">
                            <div class="tab-pane fade show active overflow-hidden rounded-4" id="home" role="tabpanel">
                                <div class="profile-intro">
                                    <h4 class="mb-1 text-white fs-20">Rehanul Islam</h4>
                                    <p class="fs-14 mb-1 fst-italic text-muted">Marketing Manager, Coca Cola</p>
                                    <div class="five-star-ratting"></div>
                                </div>
                                <img class="w-100 h-100" src="{{ asset('assets/images/landing/video-background.jpg') }}" alt="">
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel">
                                <div class="profile-intro">
                                    <h4 class="mb-1 text-white fs-12">Rehanul Islam</h4>
                                    <p class="fs-14 mb-1">Marketing Manager, Coca Cola Bangaladesh</p>
                                    <div class="five-star-ratting"></div>
                                </div>
                                <img class="w-100 h-100" src="{{ asset('assets/images/landing/how-to-create-a-writing-portfolio_138340.jpg') }}" alt="">
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel">
                                <div class="profile-intro">
                                    <h4 class="mb-1 text-white">Profile 3 Name Hare</h4>
                                    <p class="fs-14 mb-1">Marketing Manager, New Media Inc.</p>
                                    <div class="five-star-ratting"></div>
                                </div>
                                <img class="w-100 h-100" src="{{ asset('assets/images/landing/how-to-create-a-writing-portfolio_138340.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light-subtle">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <h1 class="text-center fs-36 fw-bold">How we work ?</h1>
                </div>
                <div class="col-md-3">
                    <div class="card align-items-center text-center unique-card py-4 px-2">
                        <div class="image-holder">
                            <div class="tag-label">
                                <img class="free-tag" src="{{ asset('assets/images/landing/free-tag.png') }}" alt="">
                                <img class="arrow" src="{{ asset('assets/images/landing/arrow-direction.svg') }}" alt="">
                            </div>
                            <img class="" src="https://placehold.co/150x100/2389C6/2389C6/png" width="150" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h3 class="mb-2">Process 1</h3>
                            <p class="text-justify fs-14 text-muted"> Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. commodo enim craft beer mlkshk aliquip jean shorts ullamco.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card align-items-center text-center unique-card py-4 px-2">
                        <div class="image-holder">
                            <div class="tag-label">
                                <img class="free-tag" src="{{ asset('assets/images/landing/free-tag.png') }}" alt="">
                                <img class="arrow" src="{{ asset('assets/images/landing/arrow-direction.svg') }}" alt="">
                            </div>
                            <img class="" src="https://placehold.co/150x100/2389C6/2389C6/png" width="150" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h3 class="mb-2">Process 2</h3>
                            <p class="text-justify fs-14 text-muted"> Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. commodo enim craft beer mlkshk aliquip jean shorts ullamco.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card align-items-center text-center unique-card py-4 px-2">
                        <div class="image-holder">
                            <div class="tag-label">
                                <img class="free-tag" src="{{ asset('assets/images/landing/free-tag.png') }}" alt="">
                                <img class="arrow" src="{{ asset('assets/images/landing/arrow-direction.svg') }}" alt="">
                            </div>
                            <img class="" src="https://placehold.co/150x100/2389C6/2389C6/png" width="150" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h3 class="mb-2">Process 3</h3>
                            <p class="text-justify fs-14 text-muted"> Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. commodo enim craft beer mlkshk aliquip jean shorts ullamco.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card align-items-center text-center unique-card py-4 px-2">
                        <div class="image-holder">
                            <img class="" src="https://placehold.co/150x100/2389C6/2389C6/png" width="150" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h3 class="mb-2">Process 4</h3>
                            <p class="text-justify fs-14 text-muted"> Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. commodo enim craft beer mlkshk aliquip jean shorts ullamco.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="ids_startform2">
                        <form action="/free-quote-alt/" method="GET" class="card-form">
                            <h4 class="card-title text-white"><strong>Ready to get started? Take your business to the next level with Web Info Tech</strong></h4>
                            <div class="card-body">
                                <input type="text" name="website" class="form-control" placeholder="Enter your website" required="">
                                <button type="submit" class="btn fx-complementary-btn card-btn text-white">Get a Proposal <i class="mdi mdi-arrow-right-thin"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light-subtle">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-3">
                    <h1 class="text-dark text-center fs-48 fw-bold">Our popular events</h1>
                    <p class="fw-normal fs-18 text-center text-muted mt-4 mb-4">Join our annual digital marketing conference featuring industry experts, case studies, and interactive sessions to unlock growth potential and dominate the digital landscape.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="d-sm-flex">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/small/img-5.jpg" alt="" width="115" class="rounded-1">
                                </div>
                                <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                    <h5><a href="javascript:void(0);">Stack designer Olivia Murphy offers freelancing advice</a></h5>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item"><i class="ri-calendar-2-fill text-success align-middle me-1"></i> 11 Nov, 2021</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-lg-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="d-sm-flex">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/small/img-6.jpg" alt="" width="115" class="rounded-1">
                                </div>
                                <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                    <h5><a href="javascript:void(0);">A day in the of a professional fashion designer</a></h5>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item"><i class="ri-calendar-2-fill text-success align-middle me-1"></i> 14 Nov, 2021</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-lg-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="d-sm-flex">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/small/img-7.jpg" alt="" width="115" class="rounded-1">
                                </div>
                                <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                    <h5><a href="javascript:void(0);">Design your apps in your own way</a></h5>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item"><i class="ri-calendar-2-fill text-success align-middle me-1"></i> 19 Nov, 2021</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-lg-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="d-sm-flex">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/small/img-8.jpg" alt="" width="115" class="rounded-1">
                                </div>
                                <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                    <h5><a href="javascript:void(0);">How apps is changing the IT world</a></h5>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item"><i class="ri-calendar-2-fill text-success align-middle me-1"></i> 10 Aug, 2021</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>

                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0)" class="btn btn-primary text-center btn-lg mt-3">View All Events</a>
                    </div>
                </div>

                <!--end col-->
            </div>
        </div>
    </section>

    <section class="tech-insights mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-dark text-center fs-48 fw-bold">Our Latest Tech Insights</h1>
                    <p class="fw-normal fs-18 text-center text-muted mt-2 mb-4">It's about how to increase your business online</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="box-shadow: 0 2px 48px rgba(110,123,129,.2);">
                                <img src="assets/images/small/img-3.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">How to choose a PPC  Agency?</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="box-shadow: 0 2px 48px rgba(110,123,129,.2);">
                                <img src="assets/images/small/img-2.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">How to Hire a Digital Marketing Agency</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make...</p>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="box-shadow: 0 2px 48px rgba(110,123,129,.2);">
                                <img src="assets/images/small/img-1.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">How to Price PPC Service</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center mt-3">
                                <a href="javascript:void(0)" class="btn btn-primary text-center btn-lg">View All Posts</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="my-5"></div>
@endsection

@section('script')
<script src="{{ asset('assets/libs/rater-js/index.js') }}"></script>
<script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
<script>
    raterJs({
        starSize: 13,
        rating: 3.5,
        element: document.querySelector("#basic-rater1"),
        rateCallback: function (e, t) {
            this.setRating(e), t();

        },
    });
    raterJs({
        starSize: 13,
        rating: 2.5,
        element: document.querySelector("#basic-rater2"),
        rateCallback: function (e, t) {
            this.setRating(e), t();
        },
    });
    raterJs({
        starSize: 14,
        rating: 5,
        element: document.querySelector(".five-star-ratting"),
        rateCallback: function (e, t) {
            return false;
        },
    });
    var swiper = new Swiper(".swiper-slider", {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        autoplay: { delay: 2500, disableOnInteraction: !1 },
        breakpoints: {
            640: { slidesPerView: 3, spaceBetween: 20 },
            768: { slidesPerView: 4, spaceBetween: 40 },
            1024: { slidesPerView: 5, spaceBetween: 50 },
            1200: { slidesPerView: 6, spaceBetween: 50 },
        },
    });
</script>
@endsection
