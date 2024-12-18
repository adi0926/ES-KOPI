@extends('peserta.layouts.master')

@section('dashboard-content')
<div class="dashboard__content-wrap">
    <div class="dashboard__content-title d-flex justify-content-between">
        <h4 class="title">{{ __('Diklat Saya') }}</h4>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="courseTabContent">
                        <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel"
                            aria-labelledby="all-tab" tabindex="0">
                            @if($diklatsaya->isEmpty())
                                <h6 class="text-center">Belum ada diklat</h6>
                            @else
                                @foreach($diklatsaya as $penggunaDiklat)
                                    @php 
                                        $id_diklat = Crypt::encrypt($penggunaDiklat->diklat->id_diklat);
                                    @endphp
                                    <div class="dashboard-courses-active dashboard_courses">
                                        <div class="courses__item courses__item-two shine__animate-item">
                                            <div class="row align-items-center">
                                                <div class="col-xl-5">
                                                    <div class="courses__item-thumb courses__item-thumb-two">
                                                        <a href="{{ route('diklatdetail', $id_diklat) }}" class="shine__animate-link">
                                                            <img src="{{ asset($penggunaDiklat->diklat->gambar) }}" alt="img">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-7">
                                                    <div class="courses__item-content courses__item-content-two">
                                                        <h5 class="title"><a href="{{ route('diklatdetail', $id_diklat) }}">{{ \Illuminate\Support\Str::limit($penggunaDiklat->diklat->nama_diklat, 100, '...') }}</a></h5>
                                                        
                                                        <ul class="courses__item-meta list-wrap">
                                                            <li class="courses__item-tag">
                                                                <a href="javascript:;">{{ $penggunaDiklat->diklat->kategori->nama_kategori }}</a>
                                                            </li>
                                                        </ul>
                                                       
                                                        <div class="progress-item progress-item-two">
                                                            <h6 class="title">
                                                                Progres Diklat<span>{{ $progressData[$penggunaDiklat->diklat->id_diklat] ?? 0 }}%</span>
                                                            </h6>
                                                            <div class="progress" role="progressbar" aria-label="Example with label"
                                                                aria-valuenow="{{ $progressData[$penggunaDiklat->diklat->id_diklat] ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar" style="width: {{ $progressData[$penggunaDiklat->diklat->id_diklat] ?? 0 }}%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="courses__item-bottom-two">
                                                        <ul class="list-wrap">
                                                            <li><i class="flaticon-book"></i>{{ $penggunaDiklat->diklat->countMateri() }}</li>
                                                            <li><i class="flaticon-clock"></i>{{ $penggunaDiklat->diklat->jp }} JP</li>
                                                            <li class="ms-auto">
                                                            @php
                                                                $fileSign = $penggunaDiklat->sertifikat->file_sertifikat_sign ?? null;
                                                            @endphp
                                                            @if($penggunaDiklat->status == '1')
                                                                @if($progressData[$penggunaDiklat->diklat->id_diklat] == '100')
                                                                    @if (is_null($fileSign))
                                                                        <a class="basic-button" href="#" style="background-color: gray; color: white; cursor: not-allowed;">
                                                                            <i class="fas fa-clock" style="color: white; font-size: 15px;"></i> Sertifikat Diproses
                                                                        </a>
                                                                    @else
                                                                        <a class="basic-button" href="{{ asset($fileSign) }}" style="background-color: #49A85E; color: white;">
                                                                            <i class="fas fa-download" style="color: white;  font-size: 15px;"></i> Unduh Sertifikat
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                <a class="basic-button" href="{{ route('peserta.mulaidiklat', $id_diklat)}}" style="background-color: #263D93; color: white;">
                                                                    <i class="fas fa-play" style="color: white;  font-size: 15px;"></i> Mulai
                                                                </a>
                                                                @endif
                                                            @else
                                                                <span class="basic-button" style="background-color: gray; color: white; cursor: not-allowed;">
                                                                    <i class="fas fa-lock" style="color: white; font-size: 15px;"></i> Menunggu Verifikasi
                                                                </span>
                                                            @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                        </div>
                        <!-- If no data -->
                        <!-- <h6 class="text-center">Belum ada diklat</h6> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection