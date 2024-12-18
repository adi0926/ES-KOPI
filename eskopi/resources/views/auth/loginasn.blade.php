@extends('layouts.app')

@section('content')

<main class="main-area fix">
    
    <section class="singUp-area section-py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="masuk-wrap">
                        <img src="{{ asset('frontend/img/logo/LOGO.jpeg') }}" alt="Logo" class="logo-login">
                        <div class="text-center">
                            <p>{{ __('Masuk menggunakan Akun SSO') }}</p>
                        </div>
                        <form method="POST" action="{{route('postmasukasn')}}" class="account__form">
                        <form class="account__form">
                            @csrf
                            <div class="form-grp">
                                <label for="nip">{{ __('NIP') }} <code>*</code></label>
                                <input id="nip" type="text" placeholder="NIP" value="{{ old('nip') }}" name="nip">
                                <x-frontend.validation-error name="nip" />
                            </div>
                            <div class="form-grp">
                                <label for="password">{{ __('Kata Sandi') }} <code>*</code></label>
                                <input id="password" type="password" placeholder="password" name="password">
                                <x-frontend.validation-error name="password" />
                            </div>
                            <div class="account__check">
                                <div class="account__check-remember">
                                    <input type="checkbox" class="form-check-input" name="remember" value=""
                                        id="terms-check">
                                    <label for="terms-check" class="form-check-label">{{ __('Ingat Saya') }}</label>
                                </div>
                                <div class="account__check-forgot">
                                    <a href="#">{{ __('Lupa Kata Sandi?') }}</a>
                                </div>
                            </div>
                            
                            <!-- <a href="peserta/dasbor" class="btn btn-two arrow-btn">
                                {{ __('Masuk') }}
                                <img src="{{ asset('frontend/img/icons/right_arrow.svg') }}" alt="img" class="injectable">
                            </a> -->
                            <button type="submit" class="btn btn-two arrow-btn">{{ __('Masuk') }}<img
                                    src="{{ asset('frontend/img/icons/right_arrow.svg') }}" alt="img"
                                    class="injectable"></button>
                        </form>
                        <div class="account__switch">
                            <p>{{ __('Belum memiliki akun?') }}<a href="daftar">{{ __('Daftar') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main>

@endsection