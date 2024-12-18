@extends('admin.master_layout')
@section('title')
    <title>{{ __('User') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.user-level') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah User') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.user-level') }}">{{ __('User') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah User') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah User</h4>
                                <div>
                                    <a href="{{ route('admin.user') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.user-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf                                 
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Nama<span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <input type="text" id="email" class="form-control" name="email">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <input type="text" id="password" class="form-control" name="password">
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="level">Level<span class="text-danger">*</span></label>
                                                <select class="form-control" name="level">
                                                <option value="">{{ __('Pilih Role') }}</option>
                                                        @foreach($levels as $level)
                                                            <option value="{{ $level->id_role }}">{{ $level->nama_role}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="status">Status<span class="text-danger">*</span></label>
                                                <select class="form-control" name="status">
                                                    <option value="active">Aktif</option>
                                                    <option value="nonactive">Tidak Aktif</option>
                                                </select>
                                            </div>
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