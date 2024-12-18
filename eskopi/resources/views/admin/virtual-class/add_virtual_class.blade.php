@extends('admin.master_layout')
@section('title')
    <title>{{ __('Virtual Class') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.virtual-class') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah Virtual Class') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.virtual-class') }}">{{ __('Virtual Class') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah Virtual Class') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah Virtual Class</h4>
                                <div>
                                    <a href="{{ route('admin.virtual-class') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.virtual-class-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf                                 
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="level">Diklat<span class="text-danger">*</span></label>
                                                <select class="form-control" name="level">
                                                    <option value="1">Diklat 1</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="status">Angkatan<span class="text-danger">*</span></label>
                                                <select class="form-control" name="status">
                                                    <option value="1">Angkatan 1</option>
                                                    <option value="2">Angkatan 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="level">Mata Diklat<span class="text-danger">*</span></label>
                                                <select class="form-control" name="level">
                                                    <option value="1">Bidang Usaha</option>
                                                </select>
                                            </div>
                                        </div>                                        
                                        <div class="form-group col-12">
                                            <label>Judul <span class="text-danger">*</span></label>
                                            <input type="text" id="mata_diklat" class="form-control" name="mata_diklat">
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="level">Tipe<span class="text-danger">*</span></label>
                                                <select class="form-control" name="level">
                                                    <option value="1">Tipe 1</option>
                                                </select>
                                            </div>
                                        </div>      
                                        <div class="form-group col-12">
                                            <label>Detail Virtual Class<span class="text-danger">*</span></label>
                                            <textarea type="text" id="username" class="form-control" name="username"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <input type="password" id="mata_diklat" class="form-control" name="mata_diklat">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Mulai Pelaksanaan <span class="text-danger">*</span></label>
                                            <input type="text" id="mata_diklat" class="form-control" name="mata_diklat">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Durasi Pelaksanaan (menit) <span class="text-danger">*</span></label>
                                            <input type="text" id="mata_diklat" class="form-control" name="mata_diklat">
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
        </div></section>
    </div>
@endsection