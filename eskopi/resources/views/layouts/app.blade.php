<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Es Kopi</title>
    <meta name="description" content="SkillGro - Online Courses & Education Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon-skillgro.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon-skillgro-new.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/default-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tg-cursor.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/frontend.css') }}">
</head>

<body>

    <!--Preloader-->
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('frontend/img/logo/preloader.svg') }}" alt="Preloader"></div>
            </div>
        </div>
    </div>
    <!--Preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="tg-flaticon-arrowhead-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header>
        <div id="header-fixed-height"></div>
        <div id="sticky-header" class="tg-header__area">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="tgmenu__wrap">
                            <nav class="tgmenu__nav">
                                <div class="logo">
                                    <a href="/"><img src="{{ asset('frontend/img/logo/LogoFix.jpg') }}" alt="Logo"></a>
                                </div>
                                <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                    <ul class="navigation">
                                        <li class="@if (Request::segment(1) == '') active @endif"><a href="{{ Auth::check() ? route('peserta.dasbor') : '/' }}">
                                            {{ Auth::check() ? 'Dasbor' : 'Beranda' }}
                                        </a>
                                        @if (Request::segment(1) != 'masukasn' && Request::segment(1) != 'masuknon')
                                        <li class="@if (Request::segment(1) == 'diklat') active @endif"><a href="{{ route('diklat') }}">Diklat</a></li>
                                        <li class="menu-item-has-children"><a href="#">Bantuan</a>
                                            <ul class="sub-menu">
                                                <li class="@if (Request::segment(1) == 'panduanpengguna') active @endif"><a href="{{ route('panduanpengguna') }}">Panduan Pengguna</a></li>
                                                <li class="@if (Request::segment(1) == 'hubungikami') active @endif"><a href="{{ route('hubungikami') }}">Hubungi Kami</a></li>
                                            </ul>
                                        <div class="dropdown-btn"><span class="plus-line"></span></div></li>
                                        @endif
                                    </ul>
                                </div>
                                
                                @if (Request::segment(1) != 'masukasn' && Request::segment(1) != 'masuknon')
                                    @if (Request::segment(1) != 'diklat')
                                    <div class="tgmenu__search d-none d-md-block">
                                        <form action="#" class="tgmenu__search-form">
                                            <div class="input-grp">
                                                <input type="text" placeholder="Cari Diklat. . .">
                                                <button type="submit"><i class="flaticon-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                <div class="tgmenu__action">
                                    <ul class="list-wrap">
                                        @if (Auth::check())
                                            <!-- <li class="mini-cart-icon">
                                                <a href="#" class="cart-count">
                                                    <img src="{{ asset('frontend/img/icons/notif.svg') }}" class="injectable"
                                                        alt="img" style="width: 22px; height: 22px; fill: gray;">
                                                    <span class="mini-cart-count" style="background-color: #49A85E; color: #fff;">1</span>
                                                </a>
                                            </li> -->
                                            <li class="mini-cart-icon user_icon">
                                                <a href="javascript:;" class="cart-count">
                                                    <img src="{{ asset('frontend/img/icons/menu_user.svg') }}"
                                                        alt="img">
                                                </a>
                                                <ul class="menu_user_list">
                                                    <li><a
                                                            href="#">{{ __('Pengaturan Profil') }}</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="text-danger logout-btn" 
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>
                                                    </li>

                                                    <form id="logout-form" action="{{ route('keluar') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </li>
                                        @else
                                            <li class="header-btn login-btn">
                                                <a href="{{ route('masuk') }}">Masuk</a>
                                            </li>
                                            <li class="header-btn login-btn">
                                                <a href="{{ route('daftar') }}">Daftar</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="mobile-login-btn">
                                    <a href="login.html"><img src="{{ asset('frontend/img/icons/user.svg') }}" alt="" class="injectable"></a>
                                </div>
                                @endif
                                <div class="mobile-nav-toggler"><i class="tg-flaticon-menu-1"></i></div>
                            </nav>
                        </div>
                        
                        <!-- Mobile Menu  -->
                        <div class="tgmobile__menu">
                            <nav class="tgmobile__menu-box">
                                <div class="close-btn"><i class="tg-flaticon-close-1"></i></div>
                                <div class="nav-logo">
                                    <a href="index.html"><img src="{{ asset('frontend/img/logo/logo.svg') }}" alt="Logo"></a>
                                </div>
                                <div class="tgmobile__search">
                                    <form action="#">
                                        <input type="text" placeholder="Search here...">
                                        <button><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                                <div class="tgmobile__menu-outer">
                                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                </div>
                                <div class="social-links">
                                    <ul class="list-wrap">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="tgmobile__menu-backdrop"></div>
                        <!-- End Mobile Menu -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area-end -->

    <!-- CONTENT HERE -->
    @yield('content')
    <!-- END CONTENT -->

    @if (Request::segment(1) != 'masukasn' && Request::segment(1) != 'masuknon')
    <!-- footer-area -->
    <footer class="footer__area">
        <div class="footer__top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="footer__widget">
                                <div class="footer__widget-title" >
                                    <a href="/"><img src="{{ asset('frontend/img/logo/LogoFooter.png') }}" alt="Logo Footer" style="margin-left: -40px;margin-top: -40px;"></a>
                                </div>
                            
                            <div class="footer__content">
                                <p>Jl. Gatot Subroto No. 44, Jakarta 12190 <br>P.O. Box 3186 Indonesia</p>
                                <ul class="list-wrap footer__social">
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('frontend/img/icons/facebook.svg') }}" alt="img" class="injectable">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('frontend/img/icons/twitter.svg') }}" alt="img" class="injectable">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('frontend/img/icons/whatsapp.svg') }}" alt="img" class="injectable">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('frontend/img/icons/instagram.svg') }}" alt="img" class="injectable">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <img src="{{ asset('frontend/img/icons/youtube.svg') }}" alt="img" class="injectable">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__widget">
                            <h4 class="footer__widget-title">Tentang</h4>
                            <div class="footer__link">
                                <ul class="list-wrap">
                                    <li><a href="events-details.html">Tentang Pengembangan SDM</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__widget">
                            <h4 class="footer__widget-title">Informasi</h4>
                            <div class="footer__link">
                                <ul class="list-wrap">
                                    <li><a href="contact.html">Program</a></li>
                                    <li><a href="instructor-details.html">FAQ</a></li>
                                    <li><a href="blog.html">EsKopi Mobile</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="copy-right-text">
                            <p>© 2024 Kementerian Investasi Dan Hilirisasi/ BKPM</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="footer__bottom-menu">
                            <ul class="list-wrap">
                                <li><a href="contact.html">Syarat dan Ketentuan</a></li>
                                <li><a href="contact.html">Pemberitahuan Privasi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area-end -->

    @endif

    <!-- JS here -->
    <script src="{{ asset('frontend/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.odometer.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('frontend/js/tween-max.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tg-cursor.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vivus.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ajax-form.js') }}"></script>
    <script src="{{ asset('frontend/js/svg-inject.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.circleType.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('frontend/js/plyr.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
    <script>
        SVGInject(document.querySelectorAll("img.injectable"));
    </script>
    
    <!-- get kota -->
    <script>
        $(document).ready(function() {
            $('#provinsi').change(function() {
                var provinsiId = $(this).val();
                if (provinsiId) {
                    $.ajax({
                        url: '/kota/' + provinsiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kota').empty();
                            $('#kota').append('<option value="">{{ __('Pilih') }}</option>');

                            $.each(data, function(key, value) {
                                $('#kota').append('<option value="' + value.id_kota + '">' + value.nama_kota + '</option>');
                            });
                        }
                    });
                } else {
                    $('#kota').empty();
                    $('#kota').append('<option value="">{{ __('Pilih') }}</option>');
                }
            });
        });
    </script>
    
    <!-- get kota instansi -->
    <script>
        $(document).ready(function() {
            $('#provinsiinstansi').change(function() {
                var provinsiId = $(this).val();
                if (provinsiId) {
                    $.ajax({
                        url: '/kota/' + provinsiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kotainstansi').empty();
                            $('#kotainstansi').append('<option value="">{{ __('Pilih') }}</option>');

                            $.each(data, function(key, value) {
                                $('#kotainstansi').append('<option value="' + value.id_kota + '">' + value.nama_kota + '</option>');
                            });
                        }
                    });
                } else {
                    $('#kotainstansi').empty();
                    $('#kotainstansi').append('<option value="">{{ __('Pilih') }}</option>');
                }
            });
        });
    </script>
    
    <!-- iframe pdf -->
    <script>
      function openPdfAndChangeTitle(pdfUrl, panduanTitle) {
          document.getElementById('pdfViewer').src = pdfUrl;
          document.getElementById('panduanTitle').innerText = panduanTitle;
      }
    </script>
    
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 4000,
            },
        });
    </script>
    
    <!-- filter diklat by kategori -->
    <script>
        $(document).ready(function () {
            $('.form-check-input').on('change', function () {
                console.log('kategori klik');
                let selectedCategories = [];
                $('.form-check-input:checked').each(function () {
                    selectedCategories.push($(this).attr('id').split('_')[1]);
                    console.log(selectedCategories);
                });

                $('.preloader-two').removeClass('d-none');

                $.ajax({
                    url: "{{ route('filterDiklatByCategory') }}",
                    method: "GET",
                    data: {
                        categories: selectedCategories.length > 0 ? selectedCategories : 'all'
                    },
                    success: function (data) {
                        $('.courses-top-left p').text('Total ' + data.count + ' Diklat (' + data.category_names + ')');
                        $('.courses__grid-wrap').html(data.html);
                    },
                    complete: function() {
                        // Hide the preloader
                        $('.preloader-two').addClass('d-none');
                    }
                });
            });
        });
    </script>
   
    <!-- dynamic Toastr Notification -->
    <script>
        "use strict";
        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.options.positionClass = 'toast-bottom-right';

        @session('messege')
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info("{{ $value }}");
                break;
            case 'success':
                toastr.success("{{ $value }}");
                break;
            case 'warning':
                toastr.warning("{{ $value }}");
                break;
            case 'error':
                toastr.error("{{ $value }}");
                break;
        }
        @endsession
    </script>
    
    <script>
        $(document).ready(function() {
            
            $('#asn-button').on('click', function(event) {
                event.preventDefault();
                $('#asn-buttons').slideToggle(300);

                var arrow = $('#arrow-icon');
                if (arrow.hasClass('fa-chevron-down')) {
                    arrow.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    arrow.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                }
            });
        });
    </script>

    <!-- Toastr -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}', null, {
                    timeOut: 10000
                });
            </script>
        @endforeach
    @endif

</body>
</html>
