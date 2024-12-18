@extends('admin.master_layout')
@section('title')
    <title>{{ __('Peserta') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.peserta') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah Peserta') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.peserta') }}">{{ __('Peserta') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah Peserta') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah Peserta</h4>
                                <div>
                                    <a href="{{ route('admin.peserta') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.peserta-store') }}" method="post" enctype="multipart/form-data">
                                @csrf                              
                                    <div class="row">
                                        
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="slug">NIP<span class="text-danger">*</span></label>
                                                <input type="text" id="nip" name="nip" value="" placeholder="" class="form-control">                                                
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="name">Nama Lengkap<span class="text-danger">*</span></label>
                                                <input type="text" id="nama" name="nama" value="" placeholder="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="status">Jenis Kelamin<span class="text-danger">*</span></label>
                                                <select class="form-control" name="show_at_trending">
                                                    <option value="1">Laki-laki</option>
                                                    <option value="0">Perempuan</option>
                                                </select>                                               
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="name">Tempat Lahir<span class="text-danger">*</span></label>
                                                <input type="text" id="email" name="email" value="" placeholder="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="name">Tanggal Lahir<span class="text-danger">*</span></label>
                                                <input type="text" id="email" name="email" value="" placeholder="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="name">No. HP / WA Aktif<span class="text-danger">*</span></label>
                                                <input type="text" id="email" name="email" value="" placeholder="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="name">Email<span class="text-danger">*</span></label>
                                                <input type="text" id="email" name="email" value="" placeholder="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="name">Kata Sandi<span class="text-danger">*</span></label>
                                                <input type="text" id="email" name="email" value="" placeholder="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="name">Alamat<span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="" id=""></textarea>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="status">Kota/Kabupaten<span class="text-danger">*</span></label>
                                                <select class="form-control" name="status">
                                                    <option value="1">Jakarta Selatan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="status">Provinsi<span class="text-danger">*</span></label>
                                                <select class="form-control" name="status">
                                                    <option value="1">DKI Jakarta</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-center offset-md-2 col-md-8">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
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