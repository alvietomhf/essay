<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>CMS</title>
    <link rel="apple-touch-icon" href="{{ asset('assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/icheck/custom.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/vertical-overlay-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/login-register.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-overlay-menu 1-column  bg-full-screen-image blank-page" data-open="click" data-menu="vertical-overlay-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="branding logo">
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input
                                                oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                oninput="this.setCustomValidity('')"
                                                type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                                <div class="form-control-position">
                                                    <i class="la la-user"></i>
                                                </div>
                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input
                                                    oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                    oninput="this.setCustomValidity('')"
                                                    type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="password">
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                                    <fieldset>
                                                        <input type="checkbox" id="remember-me" class="chk-remember">
                                                        <label for="remember-me"> Ingat Saya</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="javascript:void(0);" class="card-link">Lupa Password?</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-block">Masuk</button>
                                        </form>
                                    </div>
                                    <p class="card-subtitle text-muted text-center font-small-3 mx-2"><span><a href="{{ route('student.code') }}">Saya Peserta Ujian</a></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>