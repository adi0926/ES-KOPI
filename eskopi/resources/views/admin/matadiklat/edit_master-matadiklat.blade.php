@extends('admin.master_layout')
@section('title')
    <title>{{ __('Mata Diklat') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.master-matadiklat') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Mata Diklat') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.master-matadiklat') }}">{{ __('Mata Diklat') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Mata Diklat') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah Mata Diklat</h4>
                                <div>
                                    <a href="{{ route('admin.master-matadiklat') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.master-matadiklat-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf     
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Mata Diklat<span class="text-danger">*</span></label>
                                            <input type="text" id="mata_diklat" class="form-control" name="mata_diklat" value="{{ $masterMataDiklat->mata_diklat }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Deskripsi<span class="text-danger">*</span></label>
                                            <input type="text" id="deskripsi" class="form-control" name="deskripsi" value="{{ $masterMataDiklat->deskripsi }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="publikasi">Tampilkan<span class="text-danger">*</span></label>
                                            <select class="form-control" name="publikasi">
                                                <option value="">Pilih</option>
                                                <option value="Y" {{ $masterMataDiklat->publikasi == 'Y' ? 'selected' : '' }}>Ya</option>
                                                <option value="N" {{ $masterMataDiklat->publikasi == 'N' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                        <input type="hidden" id="id_master_mata_diklat" class="form-control" name="id_master_mata_diklat" value="{{ $masterMataDiklat->id_master_mata_diklat }}">
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