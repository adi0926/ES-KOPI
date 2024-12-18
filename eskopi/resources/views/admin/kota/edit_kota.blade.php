@extends('admin.master_layout')
@section('title')
    <title>{{ __('Kota') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.kota') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Kota') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Kota') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.kota') }}">{{ __('Kota') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Kota') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah Kota</h4>
                                <div>
                                    <a href="{{ route('admin.kota') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                           

                            <div class="card-body">
                                <form action="{{ route('admin.kota-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf    
									<div class="row">	
                                    <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi<span class="text-danger">*</span></label>
                                                <select class="form-control" name="provinsi">
                                                <option value="">{{ __('Pilih Provinsi') }}</option>
                                                @foreach($provinsis as $provinsi)
                                                    <option value="{{ $provinsi->id_provinsi }}" 
                                                        {{ $kota->id_provinsi == $provinsi->id_provinsi ? 'selected' : '' }}>
                                                        {{ $provinsi->nama_provinsi }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    </div>
									<div class="row">
                                        <div class="form-group col-12">
                                            <label>Id Kota <span class="text-danger">*</span></label>
                                            <input type="text" id="idkota" name="idkota" placeholder="" class="form-control" value="{{ $kota->id_kota }}">   
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Kota <span class="text-danger">*</span></label>
                                            <input type="text" id="kota" name="kota" placeholder="" class="form-control" value="{{ $kota->nama_kota }}">   
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                        <input type="hidden" id="id" class="form-control" name="id" value="{{ $kota->id_kota }}">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    
    </section>
    </div>
@endsection