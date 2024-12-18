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
                                        <button type="button" class="btn btn-outline-primary active" onclick="showSection('umum')" style="margin-right: 10px;">Umum</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="showSection('angkatan')" style="margin-right: 10px;">Angkatan</button>
                                        <button type="button" class="btn btn-outline-primary" onclick="showSection('mataDiklat')" style="margin-right: 10px;">Mata Diklat</button>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('admin.diklat') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            
                            <div class="card-body">
                            
                                <div id="umum-section">
                                <form id="form-umum" action="{{ route('admin.diklat-update') }}" method="POST" enctype="multipart/form-data" style="display: block;">
                                    @csrf     
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Gambar Diklat<span class="text-danger">*</span></label>
                                            @if(isset($diklat->gambar) && !empty($diklat->gambar))
                                                <div class="mb-2">
                                                    <img src="{{ asset($diklat->gambar) }}" alt="Current Diklat Image" style="max-width: 100%; height: auto;">
                                                </div>
                                            @endif
                                            
                                            <input type="file" id="gambar" class="form-control" name="gambar">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Nama Diklat<span class="text-danger">*</span></label>
                                            <input type="text" id="nama_diklat" class="form-control" name="nama_diklat" value="{{ $diklat->nama_diklat }}">
                                        </div>
                                        
                                        <div class="form-group col-12">
                                            <label for="kategori">Kategori Diklat<span class="text-danger">*</span></label>
                                            <select class="form-control" name="kategori" id="kategori">
                                                <option value="">{{ __('Pilih Kategori Diklat') }}</option>
                                                @foreach($kategoris as $kategori)
                                                    <option value="{{ $kategori->id_kategori }}" 
                                                        {{ $diklat->id_kategori == $kategori->id_kategori ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-frontend.validation-error name="kategori" />
                                        </div>
                                        
                                        
                                        <div class="form-group col-12">
                                            <label>Durasi Hari<span class="text-danger">*</span></label>
                                            <input type="text" id="durasi" class="form-control" name="durasi" value="{{ $diklat->durasi }}">
                                        </div>
                                        
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="publikasi">Publikasi<span class="text-danger">*</span></label>
                                                <select class="form-control" name="publikasi">
                                                    <option value="">Pilih</option>
                                                    <option value="Y" {{ $diklat->publikasi == 'Y' ? 'selected' : '' }}>Ya</option>
                                                    <option value="N" {{ $diklat->publikasi == 'N' ? 'selected' : '' }}>Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Deskripsi<span class="text-danger">*</span></label>
                                            <textarea type="text" id="deskripsi" class="form-control" name="deskripsi">{{ $diklat->deskripsi }}</textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Persyaratan Khusus<span class="text-danger">*</span></label>
                                            <textarea type="text" id="persyaratan" class="form-control" name="persyaratan">{{ $diklat->persyaratan }}</textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Apa Yang Dipelajari</label>
                                            <textarea type="text" id="yang_dipelajari" class="form-control" name="yang_dipelajari">{{ $diklat->yang_dipelajari }}</textarea>
                                        </div>
                                        
                                        <div class="form-group col-12">
                                            <label>Apa Yang Didapatkan</label>
                                            <textarea type="text" id="yang_diperoleh" class="form-control" name="yang_diperoleh">{{ $diklat->yang_diperoleh }}</textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>File Persyaratan</label>
                                            <input type="file" id="file_persyaratan" class="form-control" name="file_persyaratan">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" id="id_diklat" class="form-control" name="id_diklat" value="{{ $diklat->id_diklat }}">
                                            <button class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <!-- Angkatan Data Table Section -->
                                <div id="angkatan-section" style="display: none;">
                                    <div class="section-body">
                                        <div class="mt-4 row">
                                            <div class="col">
                                                <div class="card" id="angkatanTableSection">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h4>{{ __('Angkatan Diklat ') }}</h4>
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
                                                                        <th>{{ __('Judul Diklat') }}</th>
                                                                        <th>{{ __('Angkatan') }}</th>
                                                                        <th>{{ __('Kuota') }}</th>
                                                                        <th>{{ __('Akhir Pendaftaran') }}</th>
                                                                        <th>{{ __('Mulai Pada') }}</th>
                                                                        <th>{{ __('Berakhir Pada') }}</th>
                                                                        <th>{{ __('Aksi') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($diklatAngkatan as $index => $angkatan)
                                                                    <tr>
                                                                        <td width="2%"></td>
                                                                        <td width="1%">{{ $index + 1 }}</td>
                                                                        <td>{{ \Illuminate\Support\Str::limit($diklat->nama_diklat, 40) }}</td>
                                                                        <td>{{ $angkatan->nama_angkatan }}</td>
                                                                        <td>{{ $angkatan->kuota_peserta }}</td>
                                                                        <td>{{ $angkatan->tanggal_akhir_pendaftaran }}</td>
                                                                        <td>{{ $angkatan->diklat_mulai }}</td>
                                                                        <td>{{ $angkatan->diklat_selesai }}</td>
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
                                
                                <!-- Tambah Angkatan Form Section -->
                                <div id="tambahAngkatanFormSection" class="card-body" style="display: none;">
                                    <form action="{{ route('admin.diklatangkatan-store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <h6>Tambah Angkatan</h6>
                                        <div class="form-group">
                                            <label for="nama_angkatan">Nama Angkatan</label>
                                            <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kuota_peserta">Kuota Peserta</label>
                                            <input type="number" class="form-control" id="kuota_peserta" name="kuota_peserta" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_akhir_pendaftaran">Tanggal Akhir Pendaftaran</label>
                                            <input type="date" class="form-control" id="tanggal_akhir_pendaftaran" name="tanggal_akhir_pendaftaran" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="diklat_mulai">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="diklat_mulai" name="diklat_mulai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="diklat_selesai">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="diklat_selesai" name="diklat_selesai" required>
                                        </div>
                                        
                                        <input type="hidden" id="id_diklat" class="form-control" name="id_diklat" value="{{ $diklat->id_diklat }}">
                                        <button type="submit" class="btn btn-success">Simpan Angkatan</button>
                                        <button type="button" id="cancelTambahAngkatanBtn" class="btn btn-danger">Batal</button>
                                    </form>
                                </div>
                                
                                <!-- Edit Angkatan Form Section -->
                                <div id="editAngkatanFormSection" class="card-body" style="display: none;">
                                    <form id="editAngkatanForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <h6>Edit Angkatan</h6>
                                        <div class="form-group">
                                            <label for="nama_angkatan">Nama Angkatan</label>
                                            <input type="text" class="form-control" id="nama_angkatan_edit" name="nama_angkatan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kuota_peserta">Kuota Peserta</label>
                                            <input type="number" class="form-control" id="kuota_peserta_edit" name="kuota_peserta" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_akhir_pendaftaran">Tanggal Akhir Pendaftaran</label>
                                            <input type="date" class="form-control" id="tanggal_akhir_pendaftaran_edit" name="tanggal_akhir_pendaftaran" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="diklat_mulai">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="diklat_mulai_edit" name="diklat_mulai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="diklat_selesai">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="diklat_selesai_edit" name="diklat_selesai" required>
                                        </div>
                                        <input type="hidden" name="id_diklat" value="{{ $diklat->id_diklat }}">
                                        <button type="submit" class="btn btn-success">Update Angkatan</button>
                                        <button type="button" id="cancelEditAngkatanBtn" class="btn btn-danger">Batal</button>
                                    </form>
                                </div>
                        
                                <!-- Mata Diklat Section -->
                                <div id="mataDiklat-section" style="display: none;">
                                    <div class="section-body">
                                        <div class="mt-4 row">
                                            <div class="col">
                                                <div class="card" id="mataDiklatTableSection">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h4>{{ __('Mata Diklat ') }}</h4>
                                                        <div>
                                                            <button id="showTambahMataDiklatFormBtn" class="btn btn-primary">
                                                                {{ __('Tambah Mata Diklat') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="stripe row-border order-column nowrap" id="tableMataDiklat">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="2%"></th>
                                                                        <th width="1%">{{ __('No') }}</th>
                                                                        <th>{{ __('Angkatan') }}</th>
                                                                        <th>{{ __('Mata Diklat') }}</th>
                                                                        <th>{{ __('Publikasi') }}</th>
                                                                        <th>{{ __('Aksi') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($mataDiklatRecords as $index => $mataDiklat)
                                                                    <tr>
                                                                        <td width="2%"></td>
                                                                        <td width="1%">{{ $index + 1 }}</td>
                                                                        <td>{{ $mataDiklat->angkatan->nama_angkatan }}</td>
                                                                        <td>{{ $mataDiklat->mata_diklat }}</td>
                                                                        <td>{{ $mataDiklat->publikasi === 'Y' ? 'Ya' : 'Tidak' }}</td>
                                                                        <td>
                                                                            <button class="showTambahKontenFormBtn btn btn-success btn-sm" data-mata-diklat="{{ $mataDiklat->mata_diklat }}" data-id="{{ $mataDiklat->id_mata_diklat }}">
                                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                                            </button>
                                                                            <button class="showListKontenBtn btn btn-success btn-sm" data-mata-diklat-view="{{ $mataDiklat->mata_diklat }}" data-id-view="{{ $mataDiklat->id_mata_diklat }}">
                                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                            </button>
                                                                            <a href="javascript:;" class="btn btn-warning btn-sm" onclick="editMataDiklat({{ $mataDiklat->id_mata_diklat }})">
    <i class="fa fa-edit" aria-hidden="true"></i>
</a>
                                                                            
                                                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteMataDiklat({{ $mataDiklat->id_mata_diklat }})">
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
                                
                                <!-- Tambah Mata Diklat Form Section -->
                                <div id="tambahMataDiklatFormSection" class="card-body" style="display: none;">
                                    <form action="{{ route('admin.matadiklat-store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <h6>Tambah Mata Diklat</h6>
                                        <div class="form-group">
                                            <label for="angkatan">Angkatan<span class="text-danger">*</span></label>
                                            <select class="form-control" name="angkatan" id="angkatan">
                                                <option value="">{{ __('Pilih') }}</option>
                                                @foreach($diklatAngkatan as $angkatan)
                                                    <option value="{{ $angkatan->id_diklat_angkatan }}">{{ $angkatan->nama_angkatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="mata_diklat">Mata Diklat<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="mata_diklat" name="mata_diklat" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="publikasi">Publikasi<span class="text-danger">*</span></label>
                                            <select class="form-control" name="publikasi">
                                                <option value="" selected>Pilih</option>
                                                <option value="Y">Ya</option>
                                                <option value="N">Tidak</option>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success">Simpan Mata Diklat</button>
                                        <button type="button" id="cancelTambahMataDiklatBtn" class="btn btn-danger">Batal</button>
                                    </form>
                                </div>
                                
                                <!-- Edit Mata Diklat Form Section -->
                                <div id="editMataDiklatFormSection" class="card-body" style="display: none;">
                                    <form id="editMataDiklatForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <h6>Edit Mata Diklat</h6>
                                        <div class="form-group">
                                            <label for="edit_angkatan">Angkatan<span class="text-danger">*</span></label>
                                            <select class="form-control" name="angkatan" id="edit_angkatan">
                                                <option value="">{{ __('Pilih') }}</option>
                                                @foreach($diklatAngkatan as $angkatan)
                                                    <option value="{{ $angkatan->id_diklat_angkatan }}">{{ $angkatan->nama_angkatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="edit_mata_diklat">Mata Diklat<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_mata_diklat" name="mata_diklat" required>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="edit_publikasi">Publikasi<span class="text-danger">*</span></label>
                                            <select class="form-control" name="publikasi" id="edit_publikasi">
                                                <option value="" selected>Pilih</option>
                                                <option value="Y">Ya</option>
                                                <option value="N">Tidak</option>
                                            </select>
                                        </div>
                                
                                        <button type="submit" class="btn btn-success">Update Mata Diklat</button>
                                        <button type="button" id="cancelEditMataDiklatBtn" class="btn btn-danger">Batal</button>
                                    </form>
                                </div>
                                
                                
                                <!-- Tambah Konten Form Section -->
                                <div id="tambahKontenFormSection" style="display: none;">
                                    <div class="section-body">
                                        <div class="mt-4 row">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h4>{{ __('Tambah Konten Diklat ') }} ( <span id="mataDiklatName"></span> )</h4>
                                                        <div>
                                                            <button id="cancelTambahKontenBtn" class="btn btn-danger">
                                                                {{ __('Tutup Form') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.kontendiklat-store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" id="mataDiklatId" name="mata_diklat_id">
                                                            <div class="form-group">
                                                                <label for="tipe_konten">Tipe Konten<span class="text-danger">*</span></label>
                                                                <select class="form-control" name="tipe_konten" id="tipe_konten">
                                                                    <option value="" selected>Pilih</option>
                                                                    @foreach($tipekontens as $tipekonten)
                                                                        <option value="{{ $tipekonten->id_tipekonten }}">{{ $tipekonten->nama_tipekonten }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                            <!-- Materi Video Form -->
                                                            <div id="form-video" style="display: none;">
                                                                <div class="form-group">
                                                                    <label for="judul_video">Judul Materi</label>
                                                                    <input type="text" class="form-control" name="judul_video" id="judul_video" placeholder="Masukkan Judul Materi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="url_video">URL Video</label>
                                                                    <input type="text" class="form-control" name="url_video" id="url_video" placeholder="Masukkan URL Materi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="durasi_video">Durasi (dalam menit)</label>
                                                                    <input type="number" class="form-control" name="durasi_video" id="durasi_video" placeholder="Masukkan Durasi Materi">
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Materi PDF Form -->
                                                            <div id="form-pdf" style="display: none;">
                                                                <div class="form-group">
                                                                    <label for="judul_pdf">Judul Materi</label>
                                                                    <input type="text" class="form-control" name="judul_pdf" id="judul_pdf" placeholder="Masukkan Judul Materi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="url_pdf">URL PDF</label>
                                                                    <input type="text" class="form-control" name="url_pdf" id="url_pdf" placeholder="Masukkan URL Materi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="durasi_pdf">Durasi (dalam menit)</label>
                                                                    <input type="number" class="form-control" name="durasi_pdf" id="durasi_pdf" placeholder="Masukkan Durasi Materi">
                                                                </div>
                                                            </div>
                                                            
                                                            <button type="submit" class="btn btn-success">Simpan Konten</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Daftar Konten Section -->
                                <div id="listKontenSection" style="display: none;">
                                    <div class="section-body">
                                        <div class="mt-4 row">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h4>{{ __('Daftar Konten Diklat ') }} ( <span id="mataDiklatNameView"></span> )</h4>
                                                        <div>
                                                            <button id="cancelListKontenBtn" class="btn btn-danger">
                                                                {{ __('Tutup List') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="stripe row-border order-column nowrap" id="tableListKonten">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="2%"></th>
                                                                        <th width="1%">{{ __('No') }}</th>
                                                                        <th>{{ __('Nama Konten') }}</th>
                                                                        <th>{{ __('Tipe Konten') }}</th>
                                                                        <th>{{ __('Durasi') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   
                                                                    <tr>
                                                                        <td width="2%"></td>
                                                                        <td width="1%"></td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                    </tr>
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

@push('js')
    <script>

        function deleteAngkatan(id) {
            $("#deleteForm").attr("action", "{{ url('admin/diklatangkatan-delete') }}" + "/" + id)
        }
        
        function deleteMataDiklat(id) {
            $("#deleteForm").attr("action", "{{ url('admin/matadiklat-delete') }}" + "/" + id)
        }
        
        
        // var tambah angkatandiklat
        const showTambahAngkatanFormBtn = document.getElementById('showTambahAngkatanFormBtn');
        const angkatanTableSection = document.getElementById('angkatanTableSection');
        const tambahAngkatanFormSection = document.getElementById('tambahAngkatanFormSection');
        const cancelTambahAngkatanBtn = document.getElementById('cancelTambahAngkatanBtn');
        
        // var tambah matadikat
        const showTambahMataDiklatFormBtn = document.getElementById('showTambahMataDiklatFormBtn');
        const mataDiklatTableSection = document.getElementById('mataDiklatTableSection');
        const tambahMataDiklatFormSection = document.getElementById('tambahMataDiklatFormSection');
        const cancelTambahMataDiklatBtn = document.getElementById('cancelTambahMataDiklatBtn');
        
        // var edit angkatandiklat
        const editAngkatanFormSection = document.getElementById('editAngkatanFormSection');
        const cancelEditAngkatanBtn = document.getElementById('cancelEditAngkatanBtn');
        
        // var edit matadiklat
        const editMataDiklatFormSection = document.getElementById('editMataDiklatFormSection');
        const cancelEditMataDiklatBtn = document.getElementById('cancelEditMataDiklatBtn');
        
        // var tambah kontendiklat
        const tambahKontenFormSection = document.getElementById('tambahKontenFormSection');
        const cancelTambahKontenBtn = document.getElementById('cancelTambahKontenBtn');
        const mataDiklatName = document.getElementById('mataDiklatName');
        const mataDiklatIdInput = document.getElementById('mataDiklatId');
        
        // var lihat kontendiklat
        const listKontenSection = document.getElementById('listKontenSection');
        const cancelListKontenBtn = document.getElementById('cancelListKontenBtn');
        const mataDiklatNameView = document.getElementById('mataDiklatNameView');
        
        // js top button sub page
        function showSection(section) {
            document.getElementById('umum-section').style.display = 'none';
            document.getElementById('angkatan-section').style.display = 'none';
            document.getElementById('mataDiklat-section').style.display = 'none';
           
            
            document.getElementById(section + '-section').style.display = 'block';
    
            document.querySelectorAll('.btn-group .btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            
            if (section === 'umum') {
                if(editMataDiklatFormSection.style.display = 'block'){
                    editMataDiklatFormSection.style.display = 'none';
                }
                if(tambahMataDiklatFormSection.style.display = 'block'){
                    tambahMataDiklatFormSection.style.display = 'none';
                }
                if(tambahKontenFormSection.style.display = 'block'){
                    tambahKontenFormSection.style.display = 'none';
                }
                if(listKontenSection.style.display = 'block'){
                    listKontenSection.style.display = 'none';
                }
                if(editAngkatanFormSection.style.display = 'block'){
                    editAngkatanFormSection.style.display = 'none';
                }
                if(tambahAngkatanFormSection.style.display = 'block'){
                    tambahAngkatanFormSection.style.display = 'none';
                }
            }
            
            if (section === 'angkatan') {
                if(angkatanTableSection.style.display = 'none'){
                    angkatanTableSection.style.display = 'block';
                }
                $('#tableAngkatan').DataTable().columns.adjust().draw();
                if(editMataDiklatFormSection.style.display = 'block'){
                    editMataDiklatFormSection.style.display = 'none';
                }
                if(tambahMataDiklatFormSection.style.display = 'block'){
                    tambahMataDiklatFormSection.style.display = 'none';
                }
                if(tambahKontenFormSection.style.display = 'block'){
                    tambahKontenFormSection.style.display = 'none';
                }
                if(listKontenSection.style.display = 'block'){
                    listKontenSection.style.display = 'none';
                }
            }
                
            if (section === 'mataDiklat') {
                if(mataDiklatTableSection.style.display = 'none'){
                    mataDiklatTableSection.style.display = 'block';
                }
                $('#tableMataDiklat').DataTable().columns.adjust().draw();
                if(editAngkatanFormSection.style.display = 'block'){
                    editAngkatanFormSection.style.display = 'none';
                }
                if(tambahAngkatanFormSection.style.display = 'block'){
                    tambahAngkatanFormSection.style.display = 'none';
                }
            }
        }
        
        // js tambah angkatandiklat
        showTambahAngkatanFormBtn.addEventListener('click', () => {
            angkatanTableSection.style.display = 'none';
            tambahAngkatanFormSection.style.display = 'block';
        });
    
        cancelTambahAngkatanBtn.addEventListener('click', () => {
            tambahAngkatanFormSection.style.display = 'none';
            angkatanTableSection.style.display = 'block';
        });
        
        // js tambah matadiklat
        showTambahMataDiklatFormBtn.addEventListener('click', () => {
            mataDiklatTableSection.style.display = 'none';
            tambahMataDiklatFormSection.style.display = 'block';
            if(tambahKontenFormSection.style.display = 'block'){
                tambahKontenFormSection.style.display = 'none';
            }
            if(listKontenSection.style.display = 'block'){
                listKontenSection.style.display = 'none';
            }
        });
    
        cancelTambahMataDiklatBtn.addEventListener('click', () => {
            tambahMataDiklatFormSection.style.display = 'none';
            mataDiklatTableSection.style.display = 'block';
        });
        
        // js edit angakatandiklat
        function editAngkatan(id) {
            fetch(`/admin/diklatangkatan-edit/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nama_angkatan_edit').value = data.nama_angkatan;
                    document.getElementById('kuota_peserta_edit').value = data.kuota_peserta;
                    document.getElementById('tanggal_akhir_pendaftaran_edit').value = data.tanggal_akhir_pendaftaran;
                    document.getElementById('diklat_mulai_edit').value = data.diklat_mulai;
                    document.getElementById('diklat_selesai_edit').value = data.diklat_selesai;
    
                    document.getElementById('editAngkatanForm').action = `/admin/diklatangkatan-update/${id}`;
                    
                    angkatanTableSection.style.display = 'none';
        
                    editAngkatanFormSection.style.display = 'block';
                })
                .catch(error => console.error('Error fetching angkatan data:', error));
        }
        
        cancelEditAngkatanBtn.addEventListener('click', () => {
            editAngkatanFormSection.style.display = 'none';
            angkatanTableSection.style.display = 'block';
        });
        
        // js edit matadiklat       
        function editMataDiklat(id) {
            mataDiklatTableSection.style.display = 'none';
            editMataDiklatFormSection.style.display = 'block';
            if(tambahKontenFormSection.style.display = 'block'){
                tambahKontenFormSection.style.display = 'none';
            }
            if(listKontenSection.style.display = 'block'){
                listKontenSection.style.display = 'none';
            }
        
            fetch(`/admin/matadiklat-edit/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_angkatan').value = data.id_angkatan;
                    document.getElementById('edit_mata_diklat').value = data.mata_diklat;
                    document.getElementById('edit_publikasi').value = data.publikasi;
        
                    document.getElementById('editMataDiklatForm').action = `/admin/matadiklat-update/${id}`;
                });
        }
        
        cancelEditMataDiklatBtn.addEventListener('click', () => {
            editMataDiklatFormSection.style.display = 'none';
            mataDiklatTableSection.style.display = 'block';
        });
        
        // js tambah kontendiklat
        document.querySelectorAll('.showTambahKontenFormBtn').forEach(button => {
            button.addEventListener('click', () => {
                const mataDiklat = button.getAttribute('data-mata-diklat');
                const mataDiklatId = button.getAttribute('data-id');
                mataDiklatName.textContent = mataDiklat;
                mataDiklatIdInput.value = mataDiklatId;
                tambahKontenFormSection.style.display = 'block';
                if(listKontenSection.style.display = 'block'){
                    listKontenSection.style.display = 'none';
                }
            });
        });
    
        cancelTambahKontenBtn.addEventListener('click', () => {
            tambahKontenFormSection.style.display = 'none';
        });
        
        document.getElementById("tipe_konten").addEventListener("change", function() {
            var value = this.value;
            document.getElementById("form-video").style.display = (value === "1") ? "block" : "none";
            document.getElementById("form-pdf").style.display = (value === "2") ? "block" : "none";
        });
        
        // js lihat kontendiklat
        document.querySelectorAll('.showListKontenBtn').forEach(button => {
            button.addEventListener('click', () => {
                const mataDiklatView = button.getAttribute('data-mata-diklat-view');
                const mataDiklatIdView = button.getAttribute('data-id-view');
                mataDiklatNameView.textContent = mataDiklatView;
                listKontenSection.style.display = 'block';
                $('#tableListKonten').DataTable().columns.adjust().draw();
                if(tambahKontenFormSection.style.display = 'block'){
                    tambahKontenFormSection.style.display = 'none';
                }
                
                fetch(`/admin/kontendiklat/${mataDiklatIdView}`)
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.querySelector('#tableListKonten tbody');
                        tableBody.innerHTML = '';
                        
                        if (data.length === 0) {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td colspan="5" class="text-center">Belum ada konten</td>
                            `;
                            tableBody.appendChild(row);
                        } else {
                            data.forEach((konten, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td></td>
                                    <td>${index + 1}</td>
                                    <td>${konten.nama_konten}</td>
                                    <td>Materi ${konten.id_tipe_konten}</td>
                                    <td>${konten.durasi} Menit</td>
                                `;
                                tableBody.appendChild(row);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
                
                
            });
        });
    
        cancelListKontenBtn.addEventListener('click', () => {
            listKontenSection.style.display = 'none';
        });
        
        
        
        // js active row
        document.querySelectorAll('.showTambahKontenFormBtn, .showListKontenBtn, .btn-warning, .btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.active-row').forEach(row => row.classList.remove('active-row'));
        
                let row = button.closest('tr');
                if (row) {
                    row.classList.add('active-row');
                }
            });
        });
        
    </script>
@endpush