@extends('admin.master_layout')
@section('title')
    <title>{{ __('Salin Soal') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.bank-soal') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Salin Soal') }}</h1>
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
                    @if($jeniskonten == 'test')
                        <div class="breadcrumb-item active">
                            <a href="{{ route('admin.viewkonten-soal', $id_materi_soal) }}">{{ __('Konten Materi Soal') }}</a>
                        </div>
                    @elseif($jeniskonten == 'evalpenyelenggara')
                        <div class="breadcrumb-item active">
                            <a href="{{ route('admin.viewkonten-evalpenyelenggara', $id_materi_soal) }}">{{ __('Konten Evaluasi Penyelenggara') }}</a>
                        </div>
                    @elseif($jeniskonten == 'evalpengajar')
                        <div class="breadcrumb-item active">
                            <a href="{{ route('admin.viewkonten-evalpenyelenggara', $id_materi_soal) }}">{{ __('Konten Evaluasi Pengajar') }}</a>
                        </div>
                    @endif
                    <div class="breadcrumb-item">{{ __('Salin Soal') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Salin Soal</h4>
                                @if($jeniskonten == 'test')
                                    <div>
                                        <a href="{{ route('admin.viewkonten-soal', $id_materi_soal) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    </div>
                                @elseif($jeniskonten == 'evalpenyelenggara')
                                    <div>
                                        <a href="{{ route('admin.viewkonten-evalpenyelenggara', $id_materi_soal) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    </div>
                                @elseif($jeniskonten == 'evalpengajar')
                                    <div>
                                        <a href="{{ route('admin.viewkonten-evalpenyelenggara', $id_materi_soal) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                            <form id="soalForm" action="{{ route('admin.storecopykonten-soal') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="jeniskonten" value="{{ $jeniskonten }}">
                                <div class="row">
                                    <div class="col-6">
                                        @if($jeniskonten == 'test')
                                            <div class="form-group">
                                                <label>Judul<span class="text-danger">*</span></label>
                                                <input type="text" id="judul_soal" class="form-control" name="judul_soal" value="{{ $materiSoal->judul_soal }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Tipe Soal<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" 
                                                    value="{{ $materiSoal->tipe === 'pretest' ? 'Pre Test' : ($materiSoal->tipe === 'posttest' ? 'Post Test' : ($materiSoal->tipe === 'ujian' ? 'Ujian' : 'Random')) }}" 
                                                    readonly>
                                                <input type="hidden" name="tipe_soal" value="{{ $materiSoal->tipe }}">
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label>Judul<span class="text-danger">*</span></label>
                                                <input type="text" id="judul_soal" class="form-control" name="judul_soal" value="{{ $materiSoal->judul_evaluasi }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Tipe Soal<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" 
                                                    value="Evaluasi" 
                                                    readonly>
                                                <input type="hidden" name="tipe_soal" value="evaluasi">
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="bank_soal">Daftar Bank Soal<span class="text-danger">*</span></label>
                                            <select class="form-control" name="bank_soal" id="bank_soal">
                                                <option value="" selected>Pilih</option>
                                                @if($bankSoal->isEmpty())
                                                    <option value="" disabled>Belum ada Bank Soal untuk Test ini</option>
                                                @else
                                                    @foreach($bankSoal as $bs)
                                                        <option value="{{ $bs->id_bank_soal }}" data-max-soal="{{ $bs->soals_count }}">{{ $bs->judul_bank_soal }} (Total {{ $bs->soals_count }} Soal)</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span id="banksoalNoData" class="text-danger" style="display: none; font-size: 0.75rem;">Tidak ada soal, pilih bank soal lain.</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="metode">Metode Salin<span class="text-danger">*</span></label>
                                            <select class="form-control" name="metode" id="metode">
                                                <option value="" selected>Pilih</option>
                                                <option value="all">Salin Semua</option>
                                                <option value="random">Jumlah Acak</option>
                                                <option value="choose">Pilih Manual</option>
                                            </select>
                                            <span id="chooseManual" class="text-danger" style="display: none; font-size: 0.75rem;">Harap pilih dari daftar soal</span>
                                        </div>

                                        <div class="form-group" style="display: none;" id="jmlhrandom">
                                            <label>Jumlah Soal Acak<span class="text-danger">*</span></label>
                                            <input type="number" id="jumlah_acak" class="form-control" name="jumlah_acak">
                                        </div>
                                        <input type="hidden" name="max_soal" id="max_soal" value="">

                                        <div class="form-group">
                                            <input type="hidden" id="id_materi_soal" name="id_materi_soal" value="{{ $materiSoal->id_materi }}">
                                            <button type="button" id="salinSoal" class="btn btn-primary">{{ __('Salin Soal') }}</button>
                                        </div>
                                    </div>

                                    <!-- Right Column: DataTable -->
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-body">
                                                Daftar Soal
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="tableListSoal" style="font-size: 12px !important ;">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <input type="checkbox" id="selectAll">
                                                                </th>
                                                                <th>{{ __('No') }}</th>
                                                                <th>{{ __('Soal') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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


    <div class="modal fade" id="confirmSalinModal" tabindex="-1" role="dialog" aria-labelledby="confirmSalinModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 10%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmSalinModalLabel" style="margin-left: 18px;">{{ __('Konfirmasi Salin Soal') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Apakah Anda yakin ingin menyalin soal ini?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Batal') }}</button>
                    <button type="button" id="confirmSalinBtn" class="btn btn-primary">{{ __('Ya, Salin') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>

        document.getElementById('metode').addEventListener('change', function () {
            const selectedValue = this.value;
            const jmlhrandom = document.getElementById('jmlhrandom');

            if (selectedValue === 'random') {
                jmlhrandom.style.display = 'block';
            } else {
                jmlhrandom.style.display = 'none';
            }

            if(selectedValue === 'choose') {
                $('#chooseManual').show();
                $('#salinSoal').prop('disabled', true);
            }else{
                $('#chooseManual').hide();
                $('#salinSoal').prop('disabled', false);
            }
        });

        let tableListSoal = $('#tableListSoal').DataTable({
            columnDefs: [
                {
                    orderable: false,
                    targets: 0
                },
                {
                    targets: 1,
                    width: '5%',
                    className: 'text-center'
                },
                {
                    targets: 2,
                    width: '95%'
                }
            ],
            order: [[1, 'asc']],
            paging: true,
            pageLength: 10,
            searching: false,
            lengthChange: false,
            info: true,
            language: {
                "emptyTable": "Tidak Ada Soal",
                "zeroRecords": "Tidak Ada Data yang Cocok",
                "info": "Menampilkan _END_ dari Total _TOTAL_ Soal",
                "infoEmpty": "Menampilkan 0 dari Total 0 Soal",
            },
        });

        $('#bank_soal').on('change', function () {
            const selectedId = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var maxSoal = selectedOption.data('max-soal');

            $('#max_soal').val(maxSoal);
            $('#banksoalNoData').hide();
            $('#salinSoal').prop('disabled', false);

            if (selectedId) {
                $.ajax({
                    url: `{{ url('admin/fetch-soal') }}/${selectedId}`,
                    method: 'GET',
                    success: function (data) {
                        if (data.message === 'nodata') {
                            tableListSoal.clear().draw();
                            $('#tableListSoal').show();
                            $('#banksoalNoData').show();
                            $('#salinSoal').prop('disabled', true);
                        } else {
                            tableListSoal.clear();
                            data.forEach((item, index) => {
                                tableListSoal.row.add([
                                    `<input type="checkbox" name="selected_soal[]" value="${item.id_soal}">`,
                                    index + 1,
                                    item.soal
                                ]);
                            });
                            tableListSoal.draw();
                            $('#tableListSoal').show();
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseJSON);
                        alert('Failed to fetch data. Please try again.');
                    }
                });
            } else {
                tableListSoal.clear().draw();
                $('#tableListSoal').hide();
            }
        });
        
        $('#selectAll').on('change', function () {
            const isChecked = $(this).is(':checked');
            // Check or uncheck all checkboxes in the table body
            $('#tableListSoal tbody input[type="checkbox"]').prop('checked', isChecked);
        });

        $('#tableListSoal').on('change', 'input[type="checkbox"]', function () {
            const selectedValues = [];
            $('#tableListSoal tbody input[type="checkbox"]:checked').each(function () {
                selectedValues.push($(this).val());
            });

            $('#salinSoal').prop('disabled', false);
            $('#chooseManual').hide();
        });
        

        $('#salinSoal').click(function() {
            $('#confirmSalinModal').modal('show');
        });

        $('#confirmSalinBtn').click(function() {
            $('#soalForm').submit();
        });
    </script>
@endpush