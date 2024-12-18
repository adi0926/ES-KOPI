@extends('admin.master_layout')
@section('title')
    <title>{{ __('Bank Soal') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.bank-soal') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Bank Soal') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.bank-soal') }}">{{ __('Bank Soal') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Bank Soal') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah Bank Soal</h4>
                                <div>
                                    <a href="{{ route('admin.bank-soal') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.bank-soal-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf     
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Judul Bank Soal<span class="text-danger">*</span></label>
                                            <input type="text" id="judul_bank_soal" class="form-control" name="judul_bank_soal" value="{{ $bankSoal->judul_bank_soal }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Kategori<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" 
                                                value="{{ $bankSoal->kategori === 'pretest' ? 'Pre Test' : ($bankSoal->kategori === 'posttest' ? 'Post Test' : ($bankSoal->kategori === 'ujian' ? 'Ujian' : 'Random')) }}" 
                                                readonly>
                                            <input type="hidden" name="kategori_bank_soal" value="{{ $bankSoal->kategori }}">
                                        </div>
                                    </div>

                                    @if($bankSoal->kategori == 'ujian')
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Mata Diklat<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $bankSoal->mataDiklat->mata_diklat }}" readonly>
                                            <input type="hidden" name="matadiklat" value="{{ $bankSoal->id_mata_diklat }}">
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-12">
                                        <input type="hidden" id="id_bank_soal" class="form-control" name="id_bank_soal" value="{{ $bankSoal->id_bank_soal }}">
                                            <button class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div></section>
    </div>
@endsection