@extends('layouts.app')

@section('content')
<main class="main-area fix">

    <section class="features__area_auth">
        <div class="container">
            <div class="row justify-content-start">
                <span style="font-size: 30px; color: #FFFFFF;">Detail Diklat</span>
            </div>
        </div>
    </section>

    <section class="courses__details-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="courses__details-thumb">
                        <img class="w-100" src="{{ asset($diklat->gambar) }}" alt="img">
                    </div>
                    <div class="courses__details-content">
                        <ul class="courses__item-meta list-wrap">
                            <li class="courses__item-tag">
                                <a
                                    href="#">{{ $diklat->kategori->nama_kategori }}</a>
                            </li>
                            
                        </ul>
                        <h2 class="title">{{ $diklat->nama_diklat }}</h2>
                        <div class="courses__details-meta">
                            <ul class="list-wrap">
                                <li class="author-two">
                                    <img src="{{ asset('frontend/img/avatardefault.png') }}" alt="img"
                                        class="instructor-avatar">
                                    {{ __('Oleh') }}
                                    <a
                                        href="#">{{ $diklat->penyelenggara }}</a>
                                </li>
                                <li class="date"><i
                                        class="flaticon-calendar"></i>{{ $diklat->formatted_created_at }}</li>
                                <li><i class="flaticon-mortarboard"></i>{{ $diklat->pesertaCount() }}
                                    {{ __('Peserta') }}</li>
                            </ul>
                        </div>
                        
                        <div class="tab-content" id="informasi">
                            <div class="tab-pane fade show active" id="informasi" role="tabpanel"
                                aria-labelledby="overview-tab" tabindex="0">
                                <div class="courses__overview-wrap">
                                    <h3 class="title">{{ __('Informasi') }}</h3>
                                    {{ $diklat->deskripsi }}

                                </div>
                            </div>
                           
                        </div>

                        <div class="tab-content" id="persyaratan">
                            <div class="tab-pane fade show active" id="persyaratan" role="tabpanel"
                                aria-labelledby="overview-tab" tabindex="0">
                                <div class="courses__overview-wrap">
                                    <h3 class="title">{{ __('Persyaratan Khusus') }}</h3>
                                    {{ $diklat->persyaratan }}

                                </div>
                            </div>
                           
                        </div>
                        
                        <!-- rincian materi -->
                        <div class="tab-content" id="materi">
                            <div class="tab-pane fade show active" id="materi" role="tabpanel" aria-labelledby="overview-tab" tabindex="0">
                                <div class="courses__curriculum-wrap">
                                    <h3 class="title">Materi Diklat</h3>
                                    <p></p>
                                    <div class="accordion" id="accordionExample">
                                        @foreach($diklat->mataDiklat as $mataDiklat)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $mataDiklat->id_mata_diklat }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ $mataDiklat->id_mata_diklat }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse{{ $mataDiklat->id_mata_diklat }}">
                                                        {{ $loop->iteration }}. {{ $mataDiklat->mata_diklat }}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $mataDiklat->id_mata_diklat }}" class="accordion-collapse collapse"
                                                    aria-labelledby="heading{{ $mataDiklat->id_mata_diklat }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul class="list-wrap">
                                                            @foreach($mataDiklat->mataDiklatKonten as $konten)
                                                                <li class="course-item">
                                                                    <a href="javascript:;" class="course-item-link">
                                                                        <span class="item-name">
                                                                            @if($konten->id_tipe_konten == 1)
                                                                                {{ $konten->materiVideo->judul_materi }}
                                                                            @elseif($konten->id_tipe_konten == 2)
                                                                                {{ $konten->materiPdf->judul_materi }}
                                                                            @endif
                                                                        </span>
                                                                        <div class="course-item-meta">
                                                                            <span class="item-meta duration">
                                                                                @if($konten->id_tipe_konten == 1)
                                                                                    {{ $konten->materiVideo->durasi ? gmdate("H:i:s", $konten->materiVideo->durasi * 60) : '--:--:--' }}
                                                                                @elseif($konten->id_tipe_konten == 2)
                                                                                    {{ $konten->materiPdf->durasi ? gmdate("H:i:s", $konten->materiPdf->durasi * 60) : '--:--:--' }}
                                                                                @endif
                                                                            </span>
                                                                            <span class="item-meta course-item-status">
                                                                                <img src="{{ asset('frontend/img/icons/lock.svg') }}" alt="icon">
                                                                            </span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- detail diklat kanan -->
                <div class="col-xl-3 col-lg-4">
                    <div class="courses__details-sidebar">
                        <div class="courses__information-wrap">
                            <h5 class="title">{{ __('Detail Diklat ') }}:</h5>
                            <ul class="list-wrap">
                                <li class="level-wrapper">
                                    <b>
                                        <img src="{{ asset('frontend/img/icons/course_icon01.svg') }}" alt="img"
                                            class="injectable">
                                        {{ __('Angkatan') }}
                                    </b>
                                    <ul class="course-level-list">
                                        @foreach($diklat->angkatan as $angkatan)
                                            <span class="level">{{ $angkatan->nama_angkatan }}</span>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/icons/course_icon02.svg') }}" alt="img"
                                        class="injectable">
                                    {{ __('Durasi') }}
                                    <span>{{ $diklat->sumDurasi() }} menit </span>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/icons/course_icon03.svg') }}" alt="img"
                                        class="injectable">
                                    {{ __('Materi') }}
                                    <span>{{ $diklat->countMateri() }} materi</span>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/icons/course_icon04.svg') }}" alt="img"
                                        class="injectable">
                                    {{ __('Soal Test') }}
                                    <span> -- </span>
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/icons/course_icon05.svg') }}" alt="img"
                                        class="injectable">
                                    {{ __('Sertifikat') }}
                                        <span>{{ __('Ya') }}</span>
                                </li>
                                <li class="level-wrapper">
                                    <b>
                                        <img src="{{ asset('frontend/img/icons/course_icon06.svg') }}" alt="img"
                                            class="injectable">
                                        {{ __('Bahasa') }}
                                    </b>

                                    <ul class="course-language-list">
                                            <span>Indonesia</span>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="courses__details-enroll">
                            <div class="tg-button-wrap">
                            @if ($diklat->registration_status)
                                @if ($diklat->registration_status->status == 0)
                                    <button class="btn btn-two arrow-btn add-to-cart" disabled>
                                        <span class="text">{{ __('Menunggu Verifikasi') }}</span>
                                        <i class="fas fa-lock"></i>
                                    </button>
                                @elseif ($diklat->registration_status->status == 1)
                                    <a href="{{ route('peserta.mulaidiklat')}}" class="btn btn-two arrow-btn add-to-cart">
                                        <span class="text">{{ __('Mulai') }}</span>
                                        <i class="fas fa-play" style="font-size: 15px;"></i>
                                    </a>
                                @else
                                    <a href="{{ route('peserta.daftardiklat', $diklat->id_diklat) }}" class="btn btn-two arrow-btn add-to-cart">
                                        <span class="text">{{ __('Daftar') }}</span>
                                        <i class="flaticon-arrow-right"></i>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('peserta.daftardiklat', $diklat->id_diklat) }}" class="btn btn-two arrow-btn add-to-cart">
                                    <span class="text">{{ __('Daftar') }}</span>
                                    <i class="flaticon-arrow-right"></i>
                                </a>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


</main>
@endsection