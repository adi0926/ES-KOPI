@extends('layouts.app')


@section('content')
    <!-- main-area -->
    <main class="main-area fix">

        <!-- banner-area -->
        <section class="image-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide">
                            <img src="{{ asset($slider->imagepath) }}" alt="Banner Image">
                        </div>
                    @endforeach
                </div>
                
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <!-- about-area -->
        <section class="about-area tg-motion-effects section-py-120" style="padding: 60px 0;">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-9">
                        <div class="about__images">
                            <img src="{{ asset('frontend/img/homeimg.png') }}" alt="img" class="main-img">
                            <!-- <img src="{{ asset('frontend/img/logo/Logo EsKopi.png') }}" alt="img" class="shape alltuchtopdown" style="width: 150px"> -->
                            <!-- <a href="https://www.youtube.com/watch?v=b2Az7_lLh3g" class="popup-video">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="28" viewBox="0 0 22 28" fill="none">
                                    <path d="M0.19043 26.3132V1.69421C0.190288 1.40603 0.245303 1.12259 0.350273 0.870694C0.455242 0.6188 0.606687 0.406797 0.79027 0.254768C0.973854 0.10274 1.1835 0.0157243 1.39936 0.00193865C1.61521 -0.011847 1.83014 0.0480663 2.02378 0.176003L20.4856 12.3292C20.6973 12.4694 20.8754 12.6856 20.9999 12.9535C21.1245 13.2214 21.1904 13.5304 21.1904 13.8456C21.1904 14.1608 21.1245 14.4697 20.9999 14.7376C20.8754 15.0055 20.6973 15.2217 20.4856 15.3619L2.02378 27.824C1.83056 27.9517 1.61615 28.0116 1.40076 27.9981C1.18536 27.9847 0.97607 27.8983 0.792638 27.7472C0.609205 27.596 0.457661 27.385 0.352299 27.1342C0.246938 26.8833 0.191236 26.6008 0.19043 26.3132Z" fill="currentcolor" />
                                </svg>
                            </a> -->
                            <!-- <div class="about__enrolled" data-aos="fade-right" data-aos-delay="200">
                                <p class="title"><span>36K+</span> Enrolled Students</p>
                                <img src="{{ asset('frontend/img/logo/Logo EsKopi #6.png') }}" alt="img">
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-8" style="width: 61%;">
                        <div class="about__content">
                            <div class="section__title">
                                <!-- <span class="sub-title">Get More About Us</span> -->
                                <h2 class="title" style="font-size: 18px;">
                                    E-Learning System Kompetensi Aparatur Investasi (ES KOPI)
                                </h2>
                            </div>
                            <p class="desc" style="text-align: justify; font-size: 14px;">Sejak pertengahan tahun 2019, Pusdiklat BKPM telah membangun dan mengembangkan Aplikasi E-Learning System Kompetensi Aparatur Investasi (ES KOPI). ES KOPI merupakan Learning Management System (LMS) di bidang penanaman modal, yang berfungsi sebagai media ajar multimedia interaktif bagi seluruh peserta diklat, memfasilitasi gaya belajar yang beragam serta mengatasi tantangan dan kendala terkait jarak, ruang, dan waktu. <br> ES KOPI merupakan media pembelajaran online dengan program diklat terkait penanaman modal yang bertujuan untuk memenuhi kebutuhan pengembangan kompetensi aparatur pusat dan daerah di bidang penanaman modal (Aparatur Investasi). Dengan adanya ES KOPI diharapkan dapat menjadi salah satu solusi untuk meningkatkan efektivitas dan efisiensi pembelajaran yang dilaksanakan oleh Pusdiklat BKPM.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-area-end -->

         <!-- features-area -->
         <section class="features__area" style="padding: 60px 0;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="section__title white-title text-center mb-50">
                            <!-- <span class="sub-title">How We Start Journey</span> -->
                            <h2 class="title">Fasilitas E-Learning</h2>
                            <!-- <p>Groove’s intuitive shared inbox makesteam members together <br> organize, prioritize and.In this episode.</p> -->
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="{{ asset('frontend/img/icons/features_icon01.svg') }}" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title">Pelatihan Ahli</h4>
                                <p>Pelatihan bersama ahli</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="{{ asset('frontend/img/icons/features_icon02.svg') }}" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title">Pembelajaran Daring</h4>
                                <p>Pembelajaran daring yang mudah di akses kapan saja dan dimana saja</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="{{ asset('frontend/img/icons/features_icon04.svg') }}" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title">Kuis dan Ujian</h4>
                                <p>Sesi kuis dan ujian secara daring untuk setiap pembelajaran</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="features__item">
                            <div class="features__icon">
                                <img src="{{ asset('frontend/img/icons/features_icon03.svg') }}" class="injectable" alt="img">
                            </div>
                            <div class="features__content">
                                <h4 class="title">Sertifikat Diklat</h4>
                                <p>Sertifikat diklat untuk peserta yang sudah menyelesaikan pembelajaran</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- features-area-end -->

        <!-- course-area -->
        <section class="courses-area section-pt-120 section-pb-90" data-background="{{ asset('frontend/img/bg/courses_bg.jpg') }}" style="padding: 60px 0;">
            <div class="container">
                <div class="section__title-wrap">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section__title text-center mb-40">
                                <!-- <span class="sub-title">Top Class Courses</span> -->
                                <h2 class="title">Katalog</h2>
                                <!-- <p class="desc">When known printer took a galley of type scrambl edmake</p> -->
                            </div>
                            <div class="courses__nav">
                                <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button"
                                            role="tab" aria-controls="all-tab-pane" aria-selected="true">
                                            Diklat Terbaru
                                        </button>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="courseTabContent">
                    <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
                        <div class="swiper courses-swiper-active">
                            <div class="swiper-wrapper">
                                @foreach($diklats as $diklat)
                                    @php 
                                        $id_diklat = Crypt::encrypt($diklat->id_diklat);
                                    @endphp
                                    <div class="swiper-slide">
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="{{ route('diklatdetail', $id_diklat) }}" class="shine__animate-link">
                                                    <img src="{{ asset($diklat->gambar) }}" alt="{{ $diklat->nama_diklat }}">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta list-wrap">
                                                    <li class="courses__item-tag">
                                                        <a href="#">{{ $diklat->kategori->nama_kategori }}</a>
                                                    </li>
                                                </ul>
                                                <h5 class="title"><a href="{{ route('diklatdetail', $id_diklat) }}">{{ \Illuminate\Support\Str::limit($diklat->nama_diklat, 50, '...') }}</a></h5>
                                                <p class="author">{{ $diklat->pesertaCount() }} <a href="#">Peserta</a></p>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="{{ route('diklatdetail', $id_diklat) }}">
                                                            <span class="text">Lihat</span>
                                                            <i class="flaticon-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="courses__nav">
                            <div class="courses-button-prev"><i class="flaticon-arrow-right"></i></div>
                            <div class="courses-button-next"><i class="flaticon-arrow-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- course-area-end -->       

        <!-- features-area -->
        <section class="brand-area">
            <div class="container"><div class="marquee_mode"></div></div>
        </section>
                
        <!-- blog-area -->
        <section class="blog__post-area" style="padding: 60px 0;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section__title text-center mb-40">
                            <h2 class="title">Media</h2>
                        </div>
                    </div>
                    <div class="video-container">
                        @if($media)
                            <iframe width="800" height="452" src="{{ $media->url }}" title="YouTube Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        @else
                            <p>No video available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
