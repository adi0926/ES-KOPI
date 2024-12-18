
@php
    $header_admin = Auth::guard('admin')->user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="mode" content="LIVE">
    <!-- Custom Meta -->    
    <title>Es Kopi</title>
    <link rel="icon" href="{{ asset('uploads/website-images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}?v=1.5.0">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/components.css') }}?v=1.5.0">

    <link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/dev.css') }}?v=1.5.0">
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/clockpicker/dist/bootstrap-clockpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/datetimepicker/jquery.datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/nice-select/nice-select.css') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="mr-2 form-inline">
                    <ul class="mr-3 navbar-nav d-flex align-items-center">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </div>
                <div class="mr-auto search-box position-relative"></div>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            @if ($header_admin->image)
                                <img alt="image" src="{{ asset($header_admin->image) }}"
                                    class="mr-1 rounded-circle">
                            @else
                                <img alt="image" src="" class="mr-1 rounded-circle">
                            @endif    
                            <div class="d-sm-none d-lg-inline-block">{{ $header_admin->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('admin.settings') }}" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> {{ __('Settings') }}
                            </a>
                            <a href="{{ route('admin.edit-profile') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> {{ __('Profile') }}
                            </a>
                            <a href="javascript:;" class="dropdown-item has-icon d-flex align-items-center text-danger"
                                onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>
            </nav>

            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/admin/dashboard">
                            <img class="admin_logo" src="{{ asset('uploads/website-images/logo.svg') }}" alt="EsKopi">
                        </a>
                    </div>

                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/admin/dashboard">
                        <img src="{{ asset('uploads/website-images/favicon.png') }}" alt="EsKopi">
                        </a>
                    </div>

                    <ul class="sidebar-menu">
                        <li class="active">
                            <a class="nav-link" href="/admin/dashboard">
                                <i class="fas fa-home"></i><span>Dasbor</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="nav-link" href="/admin/user-level">
                                <i class="fas fa-key"></i><span>User Level</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="nav-link" href="/admin/role-level">
                                <i class="fas fa-lock"></i><span>Role Level</span>
                            </a>
                        </li> 
                        <li class="">
                            <a class="nav-link" href="/admin/banner">
                                <i class="fas fa-swatchbook"></i><span>Banner</span>
                            </a>
                        </li> 
                        <li class="">
                            <a class="nav-link" href="/admin/peserta">
                                <i class="fas fa-users"></i><span>Peserta</span>
                            </a>
                        </li>   
                        <li class="">
                            <a class="nav-link" href="/admin/bank-soal">
                                <i class="fas fa-book"></i><span>Bank Soal</span>
                            </a>
                        </li>                
                        <li class="">
                            <a class="nav-link" href="/admin/mata-diklat">
                                <i class="fas fa-book"></i><span>Mata Diklat</span>
                            </a>
                        </li>   
                        <li class="">
                            <a class="nav-link" href="/admin/diklat">
                                <i class="fas fa-graduation-cap"></i><span>Diklat</span>
                            </a>
                        </li>   
                        <li class="">
                            <a class="nav-link" href="/admin/ujian">
                                <i class="fas fa-file"></i><span>Ujian</span>
                            </a>
                        </li>  
                        <li class="">
                            <a class="nav-link" href="/admin/master-kategori-diklat">
                                <i class="fas fa-file"></i><span>Master Kategori Diklat</span>
                            </a>
                        </li>  
                        <li class="">
                            <a class="nav-link" href="/admin/pretest">
                                <i class="fas fa-puzzle-piece"></i><span>Pretest</span>
                            </a>
                        </li>   
                        <li class="">
                            <a class="nav-link" href="/admin/postest">
                                <i class="fas fa-puzzle-piece"></i><span>Postest</span>
                            </a>
                        </li>  
                        <li class="">
                            <a class="nav-link" href="/admin/evaluasi-penyelenggara">
                                <i class="fas fa-file"></i><span>Evaluasi Penyelenggara</span>
                            </a>
                        </li>  
                        <li class="">
                            <a class="nav-link" href="/admin/evaluasi-pengajar">
                                <i class="fas fa-file"></i><span>Evaluasi Pengajar</span>
                            </a>
                        </li>  
                        <li class="">
                            <a class="nav-link" href="/admin/penilaian">
                                <i class="fas fa-pen"></i><span>Penilaian</span>
                            </a>
                        </li>  
                        <li class="">
                            <a class="nav-link" href="/admin/sertifikat">
                                <i class="fas fa-award"></i><span>E-Sertifikat</span>
                            </a>
                        </li>  
                        <li class="">
                            <a class="nav-link" href="/admin/tanda-tangan-elektronik">
                                <i class="fas fa-sign"></i><span>Tanda Tangan Elektronik</span>
                            </a>
                        </li>  
                        <li class="">
                            <a class="nav-link" href="/admin/akun-zoom">
                                <i class="fas fa-bullhorn"></i><span>Akun Zoom</span>
                            </a>
                        </li>  
                        <li class="">
                            <a class="nav-link" href="/admin/virtual-class">
                                <i class="fas fa-video"></i><span>Virtual Class</span>
                            </a>
                        </li>  
                    </ul>
                </aside>
            </div>

            <div class="main-content">

                <div class="alert alert-danger alert-has-icon alert-dismissible d-none" id="missingCrentialsAlert">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title"></div>
                        <button class="close" id="missingCrentialsAlertClose" data-dismiss="alert">
                            <span><i class="fas fa-times"></i></span>
                        </button>
                        <b>
                            <a class="btn btn-sm btn-outline-warning" href="/admin/crediential-setting">Update</a>
                        </b>
                    </div>
                </div>                    
        
                <section class="section">
                    <div class="section-header">
                        <h1>{{ __('Dashboard') }}</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">                                
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Diklat</h4>
                                        </div>
                                        <div class="card-body">
                                            4
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Pengajar</h4>
                                        </div>
                                        <div class="card-body">
                                            10
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Peserta</h4>
                                        </div>
                                        <div class="card-body">
                                            110
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2024 Kementerian Investasi / BKPM
                </div>
                <div class="footer-right">
                    <span></span>
                </div>
            </footer>

        </div>
    </div>
    
    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Modal -->
    <div class="modal fade dynamic-modal" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop='static'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items:center p-3">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('backend/js/moment.min.js') }}"></script>
    <script src="{{ asset('backend/js/stisla.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}?v=1.5.0"></script>
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/tagify.js') }}"></script>
    <script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap4-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/js/fontawesome-iconpicker.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('backend/clockpicker/dist/bootstrap-clockpicker.js') }}"></script>
    <script src="{{ asset('backend/datetimepicker/jquery.datetimepicker.js') }}"></script>
    <script src="{{ asset('backend/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('backend/js/modules-toastr.js') }}?v=1.5.0"></script>
    <script src="{{ asset('backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('global/nice-select/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('backend/js/default/backend.js') }}?v=1.5.0"></script>
    <script src="{{ asset('backend/js/custom.js') }}?v=1.5.0"></script>

    <!-- File Manager js-->
    <script src="{{ url('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        $('.file-manager').filemanager('file', {prefix: '{{ url("/laravel-filemanager") }}'});
        $('.file-manager-image').filemanager('image', {prefix: '{{ url("/laravel-filemanager") }}'});
    </script>
    <script>        
        var type = "success"
            switch (type) {
                case 'info':
                    toastr.info("Login in berhasil.");
                    break;
                case 'success':
                    toastr.success("Login in berhasil.");
                    break;
                case 'warning':
                    toastr.warning("Login in berhasil.");
                    break;
                case 'error':
                    toastr.error("Login in berhasil.");
                    break;
            }

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            orientation: "bottom auto"
        });
    </script>
    <script>
        $(document).ready(function() {
            "use strict";
            var alertKey = 'missingCrentialsAlert';
            var dismissedTimestamp = localStorage.getItem(alertKey);

            if (!dismissedTimestamp || Date.now() - dismissedTimestamp > 24 * 60 * 60 * 1000) {
                $('#missingCrentialsAlert').removeClass('d-none');
                $('#missingCrentialsAlert').show();
            } else {
                $('#missingCrentialsAlert').hide();
            }

            $('#missingCrentialsAlertClose').on('click', function() {
                $('#missingCrentialsAlert').hide();
                localStorage.setItem(alertKey, Date.now());
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            "use strict";
            var alertKey = 'updateAvailablityAlert';
            var dismissedTimestamp = localStorage.getItem(alertKey);

            if (!dismissedTimestamp || Date.now() - dismissedTimestamp > 24 * 60 * 60 * 1000) {
                $('#updateAvailablityAlert').removeClass('d-none');
                $('#updateAvailablityAlert').show();
            } else {
                $('#updateAvailablityAlert').hide();
            }

            $('#updateAvailablityAlertClose').on('click', function() {
                $('#updateAvailablityAlert').hide();
                localStorage.setItem(alertKey, Date.now());
            });
        });
    </script>

</body>

</html>
