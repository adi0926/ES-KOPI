@extends('admin.master_layout')
@section('title')
    <title>{{ __('Master Kategori Diklat') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.master-kategori-diklat') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah Kategori') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.master-kategori-diklat') }}">{{ __('Kategori') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah Kategori') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah Kategori</h4>
                                <div>
                                    <a href="{{ route('admin.master-kategori-diklat') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.master-kategori-diklat-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf                                 
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Kategori <span class="text-danger">*</span></label>
                                            <input type="text" id="nama_kategori" class="form-control" name="nama_kategori">
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