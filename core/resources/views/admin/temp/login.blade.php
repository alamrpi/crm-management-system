<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Login | {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="assets-path" content="{{ asset('') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('core/resources/css/new.login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.12/iconfont/material-icons.min.css">
</head>
<body>
<body>
<div id="app">
    <div class="Toastify" id="global-notifications-container"></div>
    <div class="SignIn-module_page_wJXDN">
        <div class="SignIn-module_form_194kV" style="padding-top: 30px;">
            <div class="svg-container mx-auto mb-4" style="width: 223px; height: 28px;">
                <img src="https://wbcrm.zillu.net/assets/images/logo-dark.png" alt="">
            </div>
            <div class="container SignInForm-module_container_30zVa">
                <h1 class="Typography-module_jumboTitle1_3OerZ text-center SignInForm-module_title_5Q29N">Your Dedicated
                    Digital Marketing Department</h1>
                <h4 class="Typography-module_h4_2Rn1t Typography-module_bold_keN26 text-uppercase mb-3">Client &amp;
                    Fxer Log In:</h4>
                <div class="d-flex justify-content-between flex-wrap SignInForm-module_signWithWrapper_kiBl_ mb-4">
                    <div id="googleSignIn" class="mb-2 mx-auto ">
                        <div class="S9gUrf-YoZ4jf" style="position: relative;">
                            <div id="container" class="haAclf" style="padding: 2px 10px;">
                                <div tabindex="0" role="button" aria-labelledby="button-label"
                                     class="nsm7Bb-HzV7m-LgbsSe  hJDwNd-SxQuSe i5vt6e-Ia7Qfc uaxL4e-RbRzK"
                                     style="width:245px; max-width:400px; min-width:min-content;">
                                    <div class="nsm7Bb-HzV7m-LgbsSe-MJoBVe"></div>
                                    <div class="nsm7Bb-HzV7m-LgbsSe-bN97Pc-sM5MNb ">
                                        <div class="nsm7Bb-HzV7m-LgbsSe-Bz112c">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                                 class="LgbsSe-Bz112c">
                                                <g>
                                                    <path fill="#EA4335"
                                                          d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                                    <path fill="#4285F4"
                                                          d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                                    <path fill="#FBBC05"
                                                          d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                                    <path fill="#34A853"
                                                          d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                                                    <path fill="none" d="M0 0h48v48H0z"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <span class="nsm7Bb-HzV7m-LgbsSe-BPrWId">Sign in with Google</span><span
                                            class="L6cTce" id="button-label">Sign in with Google</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="googleSignIn" class="mb-2 mx-auto ">
                        <div class="S9gUrf-YoZ4jf" style="position: relative;">
                            <div id="container" class="haAclf" style="padding: 2px 10px;">
                                <div tabindex="0" role="button" aria-labelledby="button-label"
                                     class="nsm7Bb-HzV7m-LgbsSe  hJDwNd-SxQuSe i5vt6e-Ia7Qfc uaxL4e-RbRzK"
                                     style="width:245px; max-width:400px; min-width:min-content;">
                                    <div class="nsm7Bb-HzV7m-LgbsSe-MJoBVe"></div>
                                    <div class="nsm7Bb-HzV7m-LgbsSe-bN97Pc-sM5MNb ">
                                        <div class="nsm7Bb-HzV7m-LgbsSe-Bz112c">
                                            <img
                                                src="https://a.webfx.com/assets/images/_/_/packages/web/common-web/src/assets/images/office365-icon.7e9f8aa2.png"
                                                class="nav-svg" height="22px">
                                        </div>
                                        <span class="nsm7Bb-HzV7m-LgbsSe-BPrWId">Sign in with Office 365</span><span
                                            class="L6cTce" id="button-label">Sign in with Office 365</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <button type="button"--}}
{{--                            class="btn Office365SignInButton-module_office365Button_Ba-gG btn-outline-dark mb-2 d-flex mx-auto align-items-center"><span--}}
{{--                            class="Office365SignInButton-module_office365Icon_2yMYR"><img--}}
{{--                                src="https://a.webfx.com/assets/images/_/_/packages/web/common-web/src/assets/images/office365-icon.7e9f8aa2.png"--}}
{{--                                class="nav-svg" height="22px"></span><span--}}
{{--                            class="Office365SignInButton-module_office365text_1Wrzr">Sign in with Office--}}
{{--                                    365</span></button>--}}
                </div>
                <div class="SignInForm-module_separatorWrapper_1bG3E">
                    <hr>
                    <p
                        class="Typography-module_bold_keN26 Typography-module_uppercase_2A_vw SignInForm-module_separatorText_3DR5G">
                        Or</p>
                    <hr>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div data-fx-name="loginError"></div>
                    <div
                        class="form-group position-relative form-group-lg form-group-embedded has-icon-right mb-3 email-field"
                        data-fx-name="inputGroup"><label for="" class="form-label">Email Address </label>
                        <div class="input-wrapper position-relative">
                            <div class="input-group"><input id="email"
                                                            class="form-control form-control-lg embed-label-control has-icon-right"
                                                            type="email" name="email" placeholder=""
                                                            data-fx-name="email" tabindex="1"
                                                            value=""
                                                            onfocus="this.parentElement.parentElement.parentElement.classList.add('focused')"
                                                            onblur="this.value == '' ? this.parentElement.parentElement.parentElement.classList.remove('focused') : '' ">
                            </div>
                            <span
                                class="input-icon input-icon-right material-icons material-icons-outlined"
                                aria-hidden="true">email</span>
                        </div>
                    </div>
                    <div
                        class="form-group position-relative form-group-lg form-group-embedded has-icon-right mb-3 password-field"
                        data-fx-name="inputGroup"><label for="" class="form-label">Password </label>
                        <div class="input-wrapper position-relative">
                            <div class="input-group"><input id="password"
                                                            class="form-control form-control-lg embed-label-control has-icon-right"
                                                            type="password" name="password" placeholder=""
                                                            data-fx-name="password"
                                                            tabindex="2" value=""
                                                            onfocus="this.parentElement.parentElement.parentElement.classList.add('focused')"
                                                            onblur="this.value == '' ? this.parentElement.parentElement.parentElement.classList.remove('focused') : '' ">
                            </div>
                            <button type="button"
                                    class="input-icon input-icon-btn input-icon-right"><span class="material-icons"
                                                                                             aria-hidden="true">visibility</span>
                            </button>
                        </div>
                    </div>
                    <div class="SignInForm-module_btnWrap_3bqa5" data-fx-name="submit">
                        <button id=""
                                data-fx-name="submit" type="submit"
                                class="btn btn-lg btn-primary btn-block Button-module_uppercase_1mPYG Button-module_jumbo_2N1WC submitButton"><span
                                class="Button-module_contentWrap_1bxch"><span class=""
                                                                              data-fx-name="label">Login</span></span>
                        </button>
                    </div>
                    <div class="SignInForm-module_optionsWrapper_3aebv">
                        <div class="SignInForm-module_rememberLog_34sCi"><label
                                class="d-flex mb-0 align-items-center">
                                <div class="custom-control custom-checkbox"><input type="checkbox"
                                                                                   class="custom-control-input"
                                                                                   id="remember" name="remember"
                                                                                   value="false"><label
                                        class="cursor-pointer custom-control-label"
                                        for="remember" data-fx-name="checkbox"></label></div>
                                <p class="m-0">Keep me logged in</p>
                            </label></div>
                        <button id="" type="button" class="btn btn-link"><span
                                class="Button-module_contentWrap_1bxch"><span class="Button-module_text_EyrMR"
                                                                              data-fx-name="label">Forgot password?</span></span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="d-flex text-center justify-content-center SignIn-module_poweredByWrapper_2-43k">
                <p class="copy-rights mb-0">
                    2023 © Web Info Tech Ltd.
                </p>
                <p class="m-0">Powered by</p><a href="#"
                                                class="ml-2 d-inline-block position-relative" style="top: 2px;">

                </a>
            </div>
        </div>
        <div class="SignIn-module_animation_2FqTG">
            <div class="SignInAnimation-module_wrapper_MsOFu">
                <img class="w-100" src="{{ asset('assets/images/image_2023_12_19T19_54_55_197Z.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
</body>
</body>
</html>
