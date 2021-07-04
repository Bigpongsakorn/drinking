<!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Mirrored from colorlib.com/polygon/admindek/default/auth-sign-in-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:30 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Admindek | Admin Template</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="colorlib" />

    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{url('/css/waves.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{url('/css/feather.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('/css/themify-icons.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('/css/icofont.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('/css/font-awesome.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/pages.css')}}">
</head>

<body themebg-pattern="theme1">

    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="login-block">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Sign In</h3>
                                    </div>
                                </div>

                                <div class="form-group form-primary">

                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Username</label>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        {{-- <strong>{{ $message }}</strong> --}}
                                        <strong>Username ไม่ถูกต้อง</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-primary">

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    <span class="form-bar"></span>
                                    <label class="float-label">Password</label>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Password ไม่ถูกต้อง</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i
                                                        class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="forgot-phone text-right float-right">
                                            <a href="auth-reset-password.html" class="text-right f-w-600"> Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        {{-- <button type="button"
                                            class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button> --}}
                                        <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

        </div>

    </section>

    <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="{{url('/js/jquery.min.js')}}"></script>
    <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="{{url('/js/jquery-ui.min.js')}}"></script>
    <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="{{url('/js/popper.min.js')}}"></script>
    <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="{{url('/js/bootstrap.min.js')}}"></script>

    <script src="{{url('/js/waves.min.js')}}" type="4878d7dfa7bc22a8dfa99416-text/javascript">
        < /script

        <
        script type = "4878d7dfa7bc22a8dfa99416-text/javascript"
        src = "{{url('/js/jquery.slimscroll.js')}}" >

    </script>

    <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="{{url('/js/modernizr.js')}}"></script>
    <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="{{url('/js/css-scrollbars.js')}}"></script>
    <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="{{url('/js/common-pages.js')}}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"
        type="4878d7dfa7bc22a8dfa99416-text/javascript"></script>
    <script type="4878d7dfa7bc22a8dfa99416-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');

    </script>
    <script src="{{url('/js/rocket-loader.min.js')}}" data-cf-settings="4878d7dfa7bc22a8dfa99416-|49" defer=""></script>
</body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/auth-sign-in-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:30 GMT -->

</html>
