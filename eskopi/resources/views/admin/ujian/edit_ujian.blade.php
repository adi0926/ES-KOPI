@extends('admin.master_layout')
@section('title')
    <title>{{ __('Ujian') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.ujian') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Ujian') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.ujian') }}">{{ __('Ujian') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Ujian') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah Ujian</h4>
                                <div>
                                    <a href="{{ route('admin.ujian') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.ujian-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf     
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="level">Diklat<span class="text-danger">*</span></label>
                                                <select class="form-control" name="level">
                                                    <option value="1">Diklat 1</option>
                                                    <option value="2">Diklat 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="level">Angkatan<span class="text-danger">*</span></label>
                                                <select class="form-control" name="level">
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
                                            <label>Judul<span class="text-danger">*</span></label>
                                            <input type="text" id="username" class="form-control" name="username">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Detail<span class="text-danger">*</span></label>
                                            <textarea type="text" id="username" class="form-control" name="username"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Dimulai Pada<span class="text-danger">*</span></label>
                                            <input type="text" id="username" class="form-control" name="username">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Durasi (menit)<span class="text-danger">*</span></label>
                                            <input type="text" id="username" class="form-control" name="username">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Soal Ujian<span class="text-danger">*</span></label>
                                            <div class="table-responsive" style="border:1px solid #ccc;padding: 20px;">
                                                <div>
                                                    <a href="" class="btn btn-primary">
                                                        {{ __('Tambah Dari Bank Soal') }}
                                                    </a>
                                                    <a href="" class="btn btn-primary">
                                                        {{ __('Tambah Soal Ujian Langsung') }}
                                                    </a>
                                                </div>
                                                <table class="stripe row-border order-column nowrap" id="tableMaster">
                                                    <thead>
                                                        <tr>
                                                            <th width="2%"></th>
                                                            <th width="2%">{{ __('#') }}</th>
                                                            <th>{{ __('No') }}</th>
                                                            <th>{{ __('Tipe') }}</th>
                                                            <th>{{ __('Tipe Soal') }}</th>
                                                            <th>{{ __('Aksi') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>          
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <a href="{{ route('admin.edit-ujian', 1) }}" class="btn btn-warning btn-sm">
                                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                                </a>
                                                                
                                                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData(1)">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                        <input type="hidden" id="id_mata_diklat" class="form-control" name="id_mata_diklat" value="{{ $ujian->id_mata_diklat }}">
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