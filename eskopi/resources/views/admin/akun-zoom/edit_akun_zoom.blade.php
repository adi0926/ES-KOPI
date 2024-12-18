@extends('admin.master_layout')
@section('title')
    <title>{{ __('Akun Zoom') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.akun-zoom') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Akun Zoom') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.akun-zoom') }}">{{ __('Akun Zoom') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Akun Zoom') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah Akun Zoom</h4>
                                <div>
                                    <a href="{{ route('admin.akun-zoom') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.akun-zoom-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf     
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Nama Akun Zoom <span class="text-danger">*</span></label>
                                            <input type="text" id="mata_diklat" class="form-control" name="mata_diklat" value="{{ $akunZoom->mata_diklat }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                        <input type="hidden" id="id_mata_diklat" class="form-control" name="id_mata_diklat" value="{{ $akunZoom->id_mata_diklat }}">
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