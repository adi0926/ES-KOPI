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
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.peserta-diklat') }}">{{ __('Peserta Diklat') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Detail Peserta Diklat') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Detail Peserta Diklat') }}</h4>
                                <div>
                                    <a href="{{ route('admin.peserta-diklat') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>NIP:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->nip }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Nama:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->nama }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Jenis Kelamin:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->jenis_kelamin }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Tempat Lahir:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->tempat_lahir }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Tanggal Lahir:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->tanggal_lahir }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Email:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->email }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>No HP:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->no_hp }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Alamat:</label>
                                        <textarea class="form-control" readonly>{{ $detailregistrasidiklat->alamat }}</textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Kota:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->getkota->nama_kota ?? '' }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Provinsi:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->getprovinsi->nama_provinsi ?? '' }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Facebook:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->facebook }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Instansi:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->instansi->nama_instansi ?? '' }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Alamat Instansi:</label>
                                        <textarea class="form-control" readonly>{{ $detailregistrasidiklat->alamat_instansi }}</textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Kota Instansi:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->kotaInstansi->nama_kota ?? '' }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Provinsi Instansi:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->provinsiInstansi->nama_provinsi ?? '' }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Telp Instansi:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->telp_instansi }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Fax Instansi:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->fax_instansi }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Website Instansi:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->website_instansi }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Jabatan Peserta:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->jabatan->nama_jabatan ?? '' }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Unit Kerja:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->unit_kerja }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Golongan Peserta:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->golongan->nama_golongan ?? '' }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Nama Atasan:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->nama_atasan }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>No HP Atasan:</label>
                                        <input type="text" class="form-control" value="{{ $detailregistrasidiklat->nohp_atasan }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @if ($penggunadiklat->status == 0)
                                        <form action="{{ route('admin.approve-pesertadiklat', ['id_peserta' => $penggunadiklat->id_peserta, 'id_registrasi_diklat' => $detailregistrasidiklat->id_registrasi_diklat]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Setujui</button>
                                        </form>
                                        @elseif ($penggunadiklat->status == 1)
                                            <button type="button" class="btn btn-secondary" disabled>Sudah disetujui</button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection