@extends('admin.master_layout')
@section('title')
    <title>{{ __('Postest') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.postest') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Postest') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.postest') }}">{{ __('Postest') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Postest') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah Postest</h4>
                                <div>
                                    <a href="{{ route('admin.postest') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.postest-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf     
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="level">Diklat<span class="text-danger">*</span></label>
                                                <select class="form-control" name="level">
                                                    <option value="1">Diklat 1</option>
                                                    <option value="2">Diklat 2</option>
                                                    <option value="3">Diklat 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="level">Setting<span class="text-danger">*</span></label>
                                                <select class="form-control" name="level">
                                                    <option value="1">Setting 1</option>
                                                    <option value="2">Setting 2</option>
                                                    <option value="3">Setting 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Jumlah Pilihan Ganda<span class="text-danger">*</span></label>
                                            <input type="text" id="username" class="form-control" name="username">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                        <input type="hidden" id="id_mata_diklat" class="form-control" name="id_mata_diklat" value="{{ $postest->id_mata_diklat }}">
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