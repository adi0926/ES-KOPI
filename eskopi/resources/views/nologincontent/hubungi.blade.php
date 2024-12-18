@extends('layouts.app')

@section('content')

<main class="main-area fix">

    <section class="features__area_auth">
        <div class="container">
            <div class="row justify-content-start">
                <span style="font-size: 30px; color: #FFFFFF;">Hubungi Kami</span>
            </div>
        </div>
    </section>

    <section class="contact-area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-info-wrap">
                        <ul class="list-wrap">
                        @foreach ($kontaks as $kontak)
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('frontend/img/icons/map.svg') }}" alt="img" class="injectable">
                                </div>
                                <div class="content">
                                    <h4 class="title">{{ __('Alamat') }}</h4>
                                    <p>{{$kontak->alamat}}</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('frontend/img/icons/contact_phone.svg') }}" alt="img"
                                        class="injectable">
                                </div>
                                <div class="content">
                                    <h4 class="title">{{ __('Kontak Telepon') }}</h4>
                                    <a href="#">{{$kontak->telepone}}</a>
                                    <a href="#">{{$kontak->telepone}}</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('frontend/img/icons/emial.svg') }}" alt="img"
                                        class="injectable">
                                </div>
                                <div class="content">
                                    <h4 class="title">{{ __('Alamat Email') }}</h4>
                                    <a href="#">{{$kontak->email}}</a>
                                    <a href="#">{{$kontak->email}}</a>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-form-wrap">
                        <h4 class="title">{{ __('Kirim Pesan atau Pertanyaan') }}</h4>
                        <p>{{ __('Alamat email anda tidak akan dipublikasikan. Kolom yang wajib diisi ditandai dengan') }} *</p>
                        <form id="contact-form" action="" method="POST">
                            @csrf
                            <div class="form-grp">
                                <textarea name="message" placeholder="{{ __('Pesan') }} *" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-grp">
                                        <input name="subject" type="text" placeholder="{{ __('Judul') }} *" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-grp">
                                        <input name="name" type="text" placeholder="{{ __('Nama') }} *" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-grp">
                                        <input name="email" type="email" placeholder="{{ __('Email') }} *" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-two arrow-btn">{{ __('Kirim') }}<img
                                    src="{{ asset('frontend/img/icons/right_arrow.svg') }}" alt="img"
                                    class="injectable"></button>
                        </form>
                        <p class="ajax-response mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection