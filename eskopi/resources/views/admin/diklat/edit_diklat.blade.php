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
                                    @php 
                                        $id_diklat = Crypt::encrypt($diklat->id_diklat);
                                    @endphp
                                    <div class="btn-group mt-2">
                                        <a href="{{ route('admin.edit-diklat', $id_diklat) }}" class="btn btn-outline-primary active" style="margin-right: 10px;">
                                            Umum
                                        </a>
                                        <a href="{{ route('admin.diklatangkatan', $id_diklat) }}" class="btn btn-outline-primary" style="margin-right: 10px;">
                                            Angkatan
                                        </a>
                                        <a href="{{ route('admin.matadiklat', $id_diklat) }}" class="btn btn-outline-primary" style="margin-right: 10px;">
                                            Mata Diklat
                                        </a>
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
                                                <label>JP<span class="text-danger">*</span></label>
                                                <input type="text" id="jp" class="form-control" name="jp" value="{{ $diklat->jp }}">
                                            </div>
                                            
                                            
                                            <div class="form-group col-12">
                                                <label>Durasi Hari<span class="text-danger">*</span></label>
                                                <input type="text" id="durasi" class="form-control" name="durasi" value="{{ $diklat->durasi }}">
                                            </div>
                                            
                                            @if($diklat->publikasi == 'N')
                                                <input type="hidden" name="publikasi" value="N">
                                            @else
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
                                            @endif
                                            
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

        
        
    </script>
@endpush