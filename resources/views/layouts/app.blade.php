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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/tables/datatable/datatables.min.css') }}">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/feather/style.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-overlay-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-overlay-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('layouts.partials.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('layouts.partials.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                @yield('content-header')
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2022 <a class="text-bold-800 grey darken-2" href="javascript:void(0)">Me, </a>All rights Reserved</span><span class="float-md-right d-none d-lg-block">Hand-crafted & Made with<i class="ft-heart pink"></i><span id="scroll-top"></span></span></p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/js/scripts/tables/datatables/datatable-basic.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/scripts/modal/components-modal.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- END: Page JS-->

    <script>
        $('.btn-modal').on('click', function(e) {
            var t = $(this).data('container')
            $.ajax({
                url: $(this).data('href'),
                dataType: 'html',
                success: function(e) {
                    $(t).html(e).modal('show')
                }
            })
        })
        $('.btn-delete').on('click', function(e) {
            var btn = $(this);
            e.stopPropagation();
            Swal.fire({
                title: 'Anda yakin?',
                text: 'Anda akan menghapus data ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: btn.data('href'),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(res) {
                            if(res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: res.message
                                }).then((result) => {
                                    window.location.href = res.url
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: res.message
                                })
                            }
                        }
                    })
                }
            })
        })
        $('.btn-change').on('click', function(e) {
            var btn = $(this);
            const message = btn.data('message')
            const confirm = btn.data('confirm')
            const value = btn.data('value')
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            e.stopPropagation();
            Swal.fire({
                title: 'Anda yakin?',
                text: `Anda akan ${message}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirm
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: btn.data('href'),
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _method: 'PUT',
                            value,
                        },
                        dataType: 'json',
                        success: function(res) {
                            if(res.status) {
                                Toast.fire({
                                    icon: 'success',
                                    title: res.message
                                }).then((result) => {
                                    window.location.href = res.url
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: res.message
                                })
                            }
                        }
                    })
                }
            })
        })
        function onClickDelete(e) {
            const id = e.id.replace('deletequestion','');
            const questionElement = document.getElementById(`question${id}`)

            if (questionElement != null) {
                questionElement.remove()
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-start',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: false,
                })
                Toast.fire({
                    icon: 'success',
                    iconColor: 'white',
                    background: 'green',
                    title: 'Item dihapus'
                })
            }
        }
        function onClickHide(e) {
            const id = e.id.replace('deletequestion','');
            const questionElement = document.getElementById(`question${id}`)

            if (questionElement) {
                const deleteElement = `<input type="hidden" name="questions[${id}][deleted]" value="1">`
                $(`#question${id}`).append(deleteElement)
                $(`#question${id}`).hide()
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-start',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: false,
                })
                Toast.fire({
                    icon: 'success',
                    iconColor: 'white',
                    background: 'green',
                    title: 'Item dihapus'
                })
            }
        }
        function onClickIconDelete(e) {
            const id = e.id.replace('deleteimage','')
            const hasImage = e.dataset.image
            const status = e.dataset.status
            if (status == 'edit') {
                if (hasImage == 1) {
                    if (!$(`#image_deleted${id}`).length) {
                        const element = `<input type="hidden" id="image_deleted${id}" name="questions[${id}][image_deleted]" value="1">`
                        $(`#question${id}`).append(element)
                    }
                }
            }
            e.style.display = 'none'
            document.getElementById(`rowimage${id}`).style.display = 'none'
            document.getElementById(`image${id}`).value = []
            document.getElementById(`titleimage${id}`).textContent = ''
        }
        function onChangeFile(e) {
            const id = e.id.replace('image','')
            const hasImage = e.dataset.image
            const status = e.dataset.status
            if (status == 'edit') {
                if (hasImage == 1) {
                    if (e.files[0]) {
                        document.getElementById(`titleimage${id}`).textContent = e.files[0].name
                        $(`#titleimage${id}`).attr("href", "javascript:void(0);")
                        $(`#titleimage${id}`).removeAttr('target')
                        document.getElementById(`deleteimage${id}`).style.display = 'inline'
                        document.getElementById(`rowimage${id}`).style.display = 'block'
                    } else {
                        document.getElementById(`rowimage${id}`).style.display = 'none'
                        document.getElementById(`titleimage${id}`).textContent = ''
                        document.getElementById(`deleteimage${id}`).style.display = 'none'
                    }
                } else {
                    if (e.files[0]) {
                        document.getElementById(`rowimage${id}`).style.display = 'block'
                        document.getElementById(`titleimage${id}`).textContent = e.files[0].name
                        document.getElementById(`deleteimage${id}`).style.display = 'inline'
                        $(`#titleimage${id}`).removeAttr('target')
                    } else {
                        document.getElementById(`rowimage${id}`).style.display = 'none'
                        document.getElementById(`titleimage${id}`).textContent = ''
                        document.getElementById(`deleteimage${id}`).style.display = 'none'
                    }
                }
            } else {
                if (e.files[0]) {
                    document.getElementById(`rowimage${id}`).style.display = 'block'
                    document.getElementById(`titleimage${id}`).textContent = e.files[0].name
                    document.getElementById(`deleteimage${id}`).style.display = 'inline'
                } else {
                    document.getElementById(`rowimage${id}`).style.display = 'none'
                    document.getElementById(`titleimage${id}`).textContent = ''
                    document.getElementById(`deleteimage${id}`).style.display = 'none'
                }
            }
        }
    </script>
    <script>
    $('div.alert').not('.alert-warning').delay(5000).fadeOut(350);
    </script>
  
    @yield('js')
</body>
<!-- END: Body-->

</html>