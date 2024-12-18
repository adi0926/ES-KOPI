@extends('admin.master_layout')
@section('title')
    <title>{{ __('Diklat') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.diklat') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah Diklat') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.diklat') }}">{{ __('Diklat') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah Diklat') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah Diklat</h4>
                                <div>
                                    <a href="{{ route('admin.diklat') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.diklat-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf                                 
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Gambar Diklat<span class="text-danger">*</span></label>
                                            <input type="file" id="gambar" class="form-control" name="gambar">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Nama Diklat<span class="text-danger">*</span></label>
                                            <input type="text" id="nama_diklat" class="form-control" name="nama_diklat">
                                        </div>
                                        
                                        <div class="form-group col-12">
                                        <label for="diklat">Kategori Diklat<span class="text-danger">*</span></label>
                                                <select class="form-control" name="kategori" id="kategori">
                                                        <option value="">{{ __('Pilih Kategori Diklat') }}</option>
                                                        @foreach($kategoris as $kategori)
                                                            <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                                        @endforeach
                                                </select>
                                        </div>
                                        
                                        <div class="form-group col-12">
                                            <label>JP<span class="text-danger">*</span></label>
                                            <input type="text" id="jp" class="form-control" name="jp">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Durasi Hari<span class="text-danger">*</span></label>
                                            <input type="text" id="durasi" class="form-control" name="durasi">
                                        </div>
                                        
                                        <!-- <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="publikasi">Publikasi<span class="text-danger">*</span></label>
                                                <select class="form-control" name="publikasi">
                                                    <option value="" selected>Pilih</option>
                                                    <option value="Y">Ya</option>
                                                    <option value="N" selected>Tidak</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        
                                        <div class="form-group col-12">
                                            <label>Publikasi<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="Tidak" readonly>
                                            <input type="hidden" name="publikasi" value="N">
                                        </div>


                                        <div class="form-group col-12">
                                            <label>Deskripsi<span class="text-danger">*</span></label>
                                            <textarea type="text" id="deskripsi" class="form-control" name="deskripsi"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Persyaratan Khusus<span class="text-danger">*</span></label>
                                            <textarea type="text" id="persyaratan" class="form-control" name="persyaratan"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Apa Yang Dipelajari</label>
                                            <textarea type="text" id="yang_dipelajari" class="form-control" name="yang_dipelajari"></textarea>
                                        </div>
                                        
                                        <div class="form-group col-12">
                                            <label>Apa Yang Didapatkan</label>
                                            <textarea type="text" id="yang_diperoleh" class="form-control" name="yang_diperoleh"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>File Persyaratan</label>
                                            <input type="file" id="file_persyaratan" class="form-control" name="file_persyaratan">
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