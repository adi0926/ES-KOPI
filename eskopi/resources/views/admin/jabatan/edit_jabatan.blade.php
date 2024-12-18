@extends('admin.master_layout')
@section('title')
    <title>{{ __('Jabatan') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.jabatan') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Jabatan') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Jabatan') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.jabatan') }}">{{ __('Jabatan') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Jabatan') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah Jabatan</h4>
                                <div>
                                    <a href="{{ route('admin.jabatan') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                           

                            <div class="card-body">
                                <form action="{{ route('admin.jabatan-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf                                 
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Jabatan <span class="text-danger">*</span></label>
                                            <input type="text" id="jabatan" name="jabatan" placeholder="" class="form-control" value="{{ $jabatan->nama_jabatan }}">   
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                        <input type="hidden" id="id" class="form-control" name="id" value="{{ $jabatan->id_jabatan }}">
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