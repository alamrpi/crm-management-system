@extends('website.layout')

@section('content')
    <div class="auth-page-wrapper d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content overflow-hidden pt-5" style="background: #fff;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden border-0">
                            <div class="row g-0 justify-content-center pt-3">
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="p-lg-5 p-4 auth-one-bg h-100">--}}
{{--                                        <div class="bg-overlay"></div>--}}
{{--                                        <div class="position-relative h-100 d-flex flex-column">--}}
{{--                                            <div class="mb-4" style="background: #204085;text-align: center;padding: 15px 0px;border-radius: 4px;">--}}
{{--                                                <a href="index.html" class="d-block">--}}
{{--                                                    <img src="{{ asset('assets/images/logo.png') }}" alt="" height="40">--}}
{{--                                                </a>--}}

{{--                                                <h3 class="mt-4 text-white-50">Wake Up Digitally Win With WITL.</h3>--}}
{{--                                                <h6 class="text-white-50 mt-3">Read more <a href="https://webinfotechltd.com/" target="_blank">www.webinfotechltd.com</a></h6>--}}

{{--                                            </div>--}}
{{--                                            <div class="mt-auto">--}}
{{--                                                <div class="mb-3">--}}
{{--                                                    <i class="ri-double-quotes-l display-4 text-success"></i>--}}
{{--                                                </div>--}}

{{--                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">--}}
{{--                                                    <div class="carousel-indicators">--}}
{{--                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>--}}
{{--                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>--}}
{{--                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="carousel-inner text-center text-white pb-5">--}}
{{--                                                        <div class="carousel-item active">--}}
{{--                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="carousel-item">--}}
{{--                                                            <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="carousel-item">--}}
{{--                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <!-- end col -->

                                <div class="col-lg-5">
                                    <div class=" card login-card p-lg-5 p-4" style="background: #F6F8FA;">
                                        <div>
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p class="text-muted">Login in to continue to {{ env('APP_NAME') }}.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Login</button>
                                                </div>

                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="{{ url('/register') }}" class="fw-semibold text-primary text-decoration-underline"> Register</a> </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
    </div>
@endsection
