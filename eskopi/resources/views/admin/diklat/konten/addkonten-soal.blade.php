@extends('admin.master_layout')
@section('title')
    <title>{{ __('Tambah Konten Materi Soal') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.bank-soal') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah Konten Materi Soal') }}</h1>
                @php 
                    $id_diklat = Crypt::encrypt($id_diklat);
                    $id_materi_soal = Crypt::encrypt($materiSoal->id_materi);
                @endphp
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.diklat') }}">{{ __('Diklat') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.matadiklat', $id_diklat) }}">{{ __('Ubah Diklat') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.viewkonten-soal', $id_materi_soal) }}">{{ __('Konten Materi Soal') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah Konten Materi Soal') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah Konten Materi Soal</h4>
                                <div>
                                    <a href="{{ route('admin.viewkonten-soal', $id_materi_soal) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.storekonten-soal') }}" method="POST" enctype="multipart/form-data">
                                    @csrf                                 
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label>Materi Soal<span class="text-danger">*</span></label>
                                            <input type="text" id="judul_soal" class="form-control" name="judul_soal" value="{{ $materiSoal->judul_soal }}" readonly>
                                        </div>

                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="tipesoal">Tipe Soal<span class="text-danger">*</span></label>
                                                <select class="form-control" name="tipesoal">
                                                    <option value="" Selected>Pilih</option>
                                                    <option value="1">Pilihan Ganda</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Pertanyaan<span class="text-danger">*</span></label>
                                            <textarea type="text" id="pertanyaan" class="form-control" name="pertanyaan"></textarea>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Pilihan A<span class="text-danger">*</span></label>
                                            <input type="text" id="optA" class="form-control" name="optA">
                                        </div>
                                        <!-- <div class="form-group col-2">
                                            <div class="form-group">
                                                <label for="statsA"></label>
                                                <select class="form-control" name="statsA">
                                                    <option value="1">Aktif</option>
                                                    <option value="2">Tidak Aktif</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="form-group col-12">
                                            <label>Pilihan B<span class="text-danger">*</span></label>
                                            <input type="text" id="optB" class="form-control" name="optB">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Pilihan C<span class="text-danger">*</span></label>
                                            <input type="text" id="optC" class="form-control" name="optC">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Pilihan D<span class="text-danger">*</span></label>
                                            <input type="text" id="optD" class="form-control" name="optD">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Pilihan E<span class="text-danger">*</span></label>
                                            <input type="text" id="optE" class="form-control" name="optE">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Pilihan Benar<span class="text-danger">*</span></label>
                                            <br><input type="radio" id="ansA" name="answer" value="A"> A
                                            <br><input type="radio" id="ansB" name="answer" value="B"> B
                                            <br><input type="radio" id="ansC" name="answer" value="C"> C
                                            <br><input type="radio" id="ansD" name="answer" value="D"> D
                                            <br><input type="radio" id="ansE" name="answer" value="E"> E
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" id="id_materi_soal" name="id_materi_soal" value="{{ $materiSoal->id_materi }}">
                                            <button class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div
        ></section>
    </div>
@endsection