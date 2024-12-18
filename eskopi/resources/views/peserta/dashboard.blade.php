@extends('peserta.layouts.master')

@section('dashboard-content')
<div class="dashboard__content-wrap dashboard__content-wrap-two mb-60">
    <div class="dashboard__content-title">
        <h4 class="title">{{ __('Dasbor') }}</h4>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('peserta.diklatsaya') }}">
                <div class="dashboard__counter-item">
                    <div class="icon">
                        <i class="flaticon-mortarboard"></i>
                    </div>
                    <div class="content">
                        <span class="count odometer" data-count="{{ $jumlahDiklat }}"></span>
                        <p>{{ __('Diklat Saya') }}</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6">
            <a href="{{ route('peserta.sertifikat') }}">
                <div class="dashboard__counter-item">
                    <div class="icon">
                        <i class="flaticon-mortarboard"></i>
                    </div>
                    <div class="content">
                        <span class="count odometer" data-count="{{ $jumlahSertifikat }}"></span>
                        <p>{{ __('Sertifikat') }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection