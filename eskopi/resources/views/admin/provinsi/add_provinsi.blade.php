@extends('admin.master_layout')
@section('title')
    <title>{{ __('Provinsi') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.provinsi') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah Provinsi') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.provinsi') }}">{{ __('Provinsi') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah Provinsi') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah Provinsi</h4>
                                <div>
                                    <a href="{{ route('admin.provinsi') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.provinsi-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf   
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Id Provinsi <span class="text-danger">*</span></label>
                                            <input type="text" id="idprovinsi" class="form-control" name="idprovinsi">
                                        </div>
                                    </div>                              
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Provinsi <span class="text-danger">*</span></label>
                                            <input type="text" id="provinsi" class="form-control" name="provinsi">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-success">Simpan</button>
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