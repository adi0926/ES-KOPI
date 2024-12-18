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
                <h1>{{ __('Ubah Diklat') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.diklat') }}">{{ __('Diklat') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Diklat') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <h4>Ubah Diklat</h4>
                                    <div class="btn-group mt-2">
                                        <button type="button" class="btn btn-outline-primary" onclick="showSection('umum')" style="margin-right: 10px;">Umum</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="showSection('angkatan')" style="margin-right: 10px;">Angkatan</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="showSection('mataDiklat')" style="margin-right: 10px;">Mata Diklat</button>
                                        <button type="button" class="btn btn-outline-primary active" onclick="window.location.href='{{ route('admin.kontendiklat') }}'">Konten Diklat</button>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('admin.diklat') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div id="angkatan-section" style="display: block;">
                                    <div class="section-body">
                                        <div class="mt-4 row">
                                            <div class="col">
                                                <div class="card" id="angkatanTableSection">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h4>{{ __('Kontent Diklat ') }}</h4>
                                                        <div>
                                                            <!-- Button to show the "Tambah Angkatan" form -->
                                                            <button id="showTambahAngkatanFormBtn" class="btn btn-primary">
                                                                {{ __('Tambah Angkatan') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="stripe row-border order-column nowrap" id="tableAngkatan">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="2%"></th>
                                                                        <th width="1%">{{ __('No') }}</th>
                                                                        <th>{{ __('Mata Diklat') }}</th>
                                                                        <th>{{ __('Konten') }}</th>
                                                                        <th>{{ __('Tipe Konten') }}</th>
                                                                        <th>{{ __('Urutan') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($matadiklatkonten as $index => $konten)
                                                                    <tr>
                                                                        <td width="2%"></td>
                                                                        <td width="1%">{{ $index + 1 }}</td>
                                                                        <td>{{ $konten->id_mata_diklat }}</td>
                                                                        <td>{{ $konten->id_konten }}</td>
                                                                        <td>{{ $konten->id_tipe_konten }}</td>
                                                                        <td>{{ $konten->urutan }}</td>
                                                                        <td>
                                                                            <a href="javascript:;" class="btn btn-warning btn-sm" onclick="editAngkatan({{ $angkatan->id_diklat_angkatan }})">
    <i class="fa fa-edit" aria-hidden="true"></i>
</a>                                           
                                                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteAngkatan({{ $angkatan->id_diklat_angkatan }})">
                                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
@endsection