@extends('admin.master_layout')
@section('title')
    <title>{{ __('Tambah Soal') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.bank-soal') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah Soal') }}</h1>
                @php 
                    $id_bank_soal = Crypt::encrypt($bankSoal->id_bank_soal);
                @endphp
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.bank-soal') }}">{{ __('Bank Soal') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.list-soal', $id_bank_soal) }}">{{ __('Daftar Soal') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah Soal') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah Soal</h4>
                                <div>
                                    <a href="{{ route('admin.list-soal', $id_bank_soal) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.soal-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf                                 
                                    <div class="row">
                                        <input type="hidden" name="kategori_bank_soal" value="{{ $bankSoal->kategori }}">

                                        <div class="form-group col-12">
                                            <label>Bank Soal<span class="text-danger">*</span></label>
                                            <input type="text" id="judul_bank_soal" class="form-control" name="judul_bank_soal" value="{{ $bankSoal->judul_bank_soal }}" readonly>
                                        </div>
                                        @if($bankSoal->kategori == "evaluasi")
                                            <div class="form-group col-12">
                                                <label>Pertanyaan Evaluasi<span class="text-danger">*</span></label>
                                                <textarea type="text" id="pertanyaan_evaluasi" class="form-control" name="pertanyaan_evaluasi"></textarea>
                                            </div>
                                        @else
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
                                                <div class="d-flex align-items-center">
                                                    <input type="text" id="optE" class="form-control mr-2" name="optE" style="flex-grow: 1;">

                                                    <input onchange="toggleChange()" id="status_toggle" type="checkbox" checked data-toggle="toggle"
                                                        data-on="{{ __('Aktif') }}" data-off="{{ __('Tidak') }}"
                                                        data-onstyle="success" data-offstyle="danger">
                                                </div>
                                                <input type="hidden" name="statusE" id="statusE_hidden" value="active">
                                            </div>

                                            <div class="form-group col-12">
                                                <label>Pilihan Benar<span class="text-danger">*</span></label>
                                                <br><input type="radio" id="ansA" name="answer" value="A"> A
                                                <br><input type="radio" id="ansB" name="answer" value="B"> B
                                                <br><input type="radio" id="ansC" name="answer" value="C"> C
                                                <br><input type="radio" id="ansD" name="answer" value="D"> D
                                                <br><input type="radio" id="ansE" name="answer" value="E"> <label for="ansE" style="color: #6c757d;">E</label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" id="id_bank_soal" name="id_bank_soal" value="{{ $bankSoal->id_bank_soal }}">
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
@push('js')
    <script>
        function toggleChange(){
            const toggle = document.getElementById("status_toggle");
            const optE = document.getElementById("optE");
            const statusEHidden = document.getElementById("statusE_hidden");

            const ansE = document.getElementById("ansE");
            const ansELabel = document.querySelector('label[for="ansE"]');

            if (toggle.checked) {
                optE.disabled = false;
                statusEHidden.value = "active";

                ansE.style.display = "inline-block";
                ansELabel.style.display = "inline-block";
            } else {
                optE.disabled = true;
                statusEHidden.value = "inactive";

                ansE.style.display = "none";
                ansELabel.style.display = "none";
            }
        }

    </script>
@endpush
