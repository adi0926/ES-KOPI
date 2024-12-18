@extends('admin.master_layout')
@section('title')
    <title>{{ __('Banner') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.banner') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah Banner') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.banner') }}">{{ __('Banner') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah Banner') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah Banner</h4>
                                <div>
                                    <a href="{{ route('admin.banner') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.banner-store') }}" method="post" enctype="multipart/form-data">
                                @csrf                              
                                    <div class="row">
                                        
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="slug">Gambar Slider<span class="text-danger">*</span></label>
                                                <input type="file" id="imagepath" name="imagepath" value="" placeholder="" class="form-control">                                                
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="slug">Nama Slider<span class="text-danger">*</span></label>
                                                <input type="text" id="nama" name="nama" placeholder="" class="form-control" value="">                                 
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="tampilkan">Tampilkan<span class="text-danger">*</span></label>
                                                <select class="form-control" name="tampilkan">
                                                  <option value="" selected>Pilih</option>
                                                  <option value="Y">Ya</option>
                                                  <option value="N">Tidak</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-center offset-md-2 col-md-8">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Simpan</button>
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