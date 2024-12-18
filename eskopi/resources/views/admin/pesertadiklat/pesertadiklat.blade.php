@extends('admin.master_layout')
@section('title')
    <title>{{ __('Peserta Diklat') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Peserta Diklat') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Peserta Diklat') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Daftar Peserta Diklat') }}</h4>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('No') }}</th>
                                                <th>{{ __('Nama Peserta') }}</th>
                                                <th>{{ __('Judul Diklat') }}</th>
                                                <th>{{ __('Angkatan') }}</th>
                                                <th>{{ __('Tanggal Pendaftaran') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @foreach($daftarpeserta as $index => $peserta)       
                                            <tr>
                                                <td width="2%"></td>
                                                <td width="1%">{{ ++$index }}</td>
                                                <td>{{ $peserta->pengguna->name }}</td>
                                                <td>{{ $peserta->diklat->nama_diklat }}</td>
                                                <td>{{ $peserta->diklatAngkatan->nama_angkatan }}</td>
                                                <td>{{ $peserta->tgl_pendaftaran }}</td>
                                                <td>
                                                    @if($peserta->status == 0)
                                                        <span style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px;">Belum Disetujui</span>
                                                    @elseif($peserta->status == 1)
                                                        <span style="background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Disetujui</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.detail-pesertadiklat', ['id_peserta' => $peserta->id_peserta, 'id_registrasi_diklat' => $peserta->id_registrasi_diklat]) }}" 
                                                       class="btn btn-warning btn-sm">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
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
        </section>
    </div>

@endsection