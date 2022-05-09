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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <div class="card border-grey border-lighten-3 px-1 py-2 m-2">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset('assets/images/logo/logodepan.png') }}" style="width: 70%;object-fit: scale-down;" alt="branding logo">
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form id="join-exam" class="form-horizontal" data-action="{{ route('student.exam.join') }}">
                                            <fieldset class="form-group">
                                                <input
                                                oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                oninput="this.setCustomValidity('')"
                                                type="text" class="form-control mb-1" id="number" name="number" placeholder="Nomor Ujian" value="{{ old('number') }}" style="text-align: center;" required autofocus>
                                                <input
                                                oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                                oninput="this.setCustomValidity('')"
                                                type="text" class="form-control mb-1" id="code" name="code" placeholder="Kode Ujian" value="{{ old('code') }}" style="text-align: center;" required autofocus>
                                                <p class="text-center mt-1">Tanyakan kepada Guru Pengajar apabila belum mendapatkan kode Ujian</p>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary btn-block mt-n2">Masuk</button>
                                        </form>
                                    </div>
                                    <p class="card-subtitle text-muted text-center font-small-3 mx-2"><span><a href="{{ route('login') }}">Masuk sebagai Guru</a></span></p>
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
<script>
    $(document).ready(function () {
        // Store
        $(document).on('submit', '#join-exam', function(e) {
            e.preventDefault()
            const data = $(this).serialize()
            $(document).find('p.text-error').remove()

            $.ajax({
                url: $(this).data('action'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        window.location.href = res.url
                    }
                },
                error: function (res) {
                    $(document).find('#code').after(`<p class="small text-danger text-error text-center">${res.responseJSON.message}</p>`)
                },
            })
        })
    })
</script>

</html>