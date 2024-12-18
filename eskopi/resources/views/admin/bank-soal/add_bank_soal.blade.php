@extends('admin.master_layout')
@section('title')
    <title>{{ __('Bank Soal') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.bank-soal') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Tambah Bank Soal') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.bank-soal') }}">{{ __('Bank Soal') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah Bank Soal') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Tambah Bank Soal</h4>
                                <div>
                                    <a href="{{ route('admin.bank-soal') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.bank-soal-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf                                 
                                    <div class="row">

                                        <div class="form-group col-6">
                                            <label>Judul Bank Soal<span class="text-danger">*</span></label>
                                            <input type="text" id="judul_bank_soal" class="form-control" name="judul_bank_soal">
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="form-group col-6">
                                            <label>Kategori Bank Soal<span class="text-danger">*</span></label>
                                            <select class="form-control" name="kategori_bank_soal" id="kategori_bank_soal">
                                                <option value="" selected>Pilih</option>
                                                <option value="pretest">Pre Test</option>
                                                <option value="posttest">Post Test</option>
                                                <option value="ujian">Ujian</option>
                                                <option value="evaluasi">Evaluasi</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row" id="diklat_field" style="display: none;">

                                        <div class="form-group col-6">
                                            <label>Diklat<span class="text-danger">*</span></label>
                                            <select class="form-control" name="diklat" id="diklat">
                                                <option value="">{{ __('Pilih Diklat') }}</option>
                                                @foreach($diklats as $diklat)
                                                    <option value="{{ $diklat->id_diklat }}">{{ $diklat->nama_diklat }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row" id="mata_diklat_field" style="display: none;">

                                        <div class="form-group col-6">
                                            <label>Mata Diklat<span class="text-danger">*</span></label>
                                            <select class="form-control" name="matadiklat" id="matadiklat">
                                                <option value="">{{ __('Pilih') }}</option>
                                                
                                            </select>
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
@push('js')
    <script>

        document.getElementById('kategori_bank_soal').addEventListener('change', function () {
            const selectedValue = this.value;
            const diklatField = document.getElementById('diklat_field');
            const mataDiklatField = document.getElementById('mata_diklat_field');

            if (selectedValue === 'ujian') {
                diklatField.style.display = 'block';
            } else {
                if(mataDiklatField.style.display = 'block'){
                    diklatField.style.display = 'none';
                    mataDiklatField.style.display = 'none';
                } else if(mataDiklatField.style.display = 'none') {
                    diklatField.style.display = 'none';
                }
            }
        });

        $(document).ready(function() {
            const mataDiklatField = document.getElementById('mata_diklat_field');

            $('#diklat').change(function() {
                var id_diklat = $(this).val();
                if (id_diklat) {
                    $.ajax({
                        url: '/admin/getMataDiklat/' + id_diklat,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            mataDiklatField.style.display = 'block';
                            $('#matadiklat').empty();
                            $('#matadiklat').append('<option value="">{{ __('Pilih') }}</option>');

                            $.each(data, function(key, value) {
                                $('#matadiklat').append('<option value="' + value.id_mata_diklat + '">' + value.mata_diklat + '</option>');
                            });
                        }
                    });
                } else {
                    $('#matadiklat').empty();
                    $('#matadiklat').append('<option value="">{{ __('Pilih') }}</option>');
                }
            });
        });
        
        
    </script>
@endpush