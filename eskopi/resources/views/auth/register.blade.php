@extends('layouts.app')

@section('content')

<main class="main-area fix">

    <section class="features__area_auth">
        <div class="container">
            <div class="row justify-content-start">
                <span style="font-size: 30px; color: #FFFFFF;">Daftar</span>
            </div>
        </div>
    </section>

    <section class="singUp-area section-py-120">
        <div class="container">
            <div class="row">
            <div class="row align-items-center justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <div class="about__images_auth">
                            <img src="{{ asset('frontend/img/logo/image_login.png') }}" alt="img" class="main-img" style="width: 295px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" alt="img" class="main-img" style="width: 230px">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="about__content_auth" style="width: 100%;">
                            <div class="regis-rectangle-wrap">
                                <h4 class="title" style="font-size: 20px;text-align: center;">{{ __('Silahkan Pilih Jenis Akun ES KOPI') }}</h4>
                                
                                <div class="button-group">
                                    <a href="#" id="asn-button" class="btn btn-border">{{ __('ASN') }} <i class="fa fa-chevron-down" id="arrow-icon"></i></a>
                                    <div id="asn-buttons" style="display:none;">
                                        <a href="{{ route('authsso') }}" class="btn custom-btn">{{ __('BKPM') }}</a>
                                        <a href="pendaftaran" class="btn custom-btn">{{ __('NON BKPM') }}</a>
                                    </div>
                                    <a href="pendaftaran" class="btn btn-border" style="margin-top:20px;">{{ __('NON ASN') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection