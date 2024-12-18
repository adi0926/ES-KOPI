@extends('layouts.app')

@section('content')
<main class="main-area fix">

    <x-frontend.breadcrumb
        :title="__('')"
        :links="[]"
    />

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            <div class="dashboard__top-wrap">
                <div class="dashboard__top-bg"></div>
                <div class="dashboard__instructor-info">
                    <div class="dashboard__instructor-info-left">
                        <div class="thumb">
                            <img src="{{ Auth::user()->fotoprofil ? asset(Auth::user()->fotoprofil) : asset('frontend/img/avatardefault.png') }}" alt="img">
                        </div>
                        <div class="content">
                            <h4 class="title">{{ Auth::user()->name }} ({{ Auth::user()->nip }})</h4>
                            <ul class="list-wrap">
                                <li>
                                    <img src="{{ asset('frontend/img/icons/envelope.svg') }}" alt="img" class="injectable">
                                    {{ Auth::user()->email }}
                                </li>
                                <li>
                                    <img  src="{{ asset('frontend/img/icons/phone.svg') }}" alt="img" class="injectable">
                                    {{ Auth::user()->no_telp }}
                                </li>
                               
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard__sidebar-wrap">
                        <div class="dashboard__sidebar-title mb-20">
                            <h6 class="title">{{ __('Selamat datang, ') }} {{ Auth::user()->name }}</h6>
                        </div>
                        <nav class="dashboard__sidebar-menu">
                            <ul class="list-wrap">
                                
                                <li class="{{ Route::is('peserta.dasbor') ? 'active' : '' }}">
                                    <a href="dasbor">
                                        <i class="flaticon-mortarboard"></i>{{ __('Dasbor') }}</a>
                                </li>

                                <li class="{{ Route::is('peserta.diklatsaya') ? 'active' : '' }}">
                                    <a href="diklatsaya">
                                        <i class="flaticon-mortarboard"></i>
                                        {{ __('Diklat Saya') }}
                                    </a>
                                </li>

                                <li class="{{ Route::is('peserta.sertifikat') ? 'active' : '' }}">
                                    <a href="sertifikat">
                                        <i class="flaticon-mortarboard"></i>{{ __('Sertifikat') }}</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-9">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </section>


</main>
@endsection