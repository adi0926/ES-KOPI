@extends('admin.master_layout')
@section('title')
    <title>{{ __('Konten Materi Soal') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                @php 
                    $id_diklat = Crypt::encrypt($id_diklat);
                    $id_materi_soal = Crypt::encrypt($materisoal->id_materi);
                @endphp
                <div class="section-header-back">
                    <a href="{{ route('admin.matadiklat', $id_diklat) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Konten Materi Soal') }}</h1>
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
                    <div class="breadcrumb-item">{{ __('Konten Materi Soal') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4> {{ $materisoal->judul_soal }} [Total {{ $materisoal->soals_count }} Soal]</h4>
                                <div class="d-flex">
                                    <!-- HERE, Tambah soal manual dihilangkan dulu karena request pusdiklat -->
                                    <!-- <div>
                                        <a href="{{ route('admin.addkonten-soal', $id_materi_soal) }}" class="btn btn-primary mr-2">
                                                {{ __('Tambah Soal Manual') }}</a>
                                    </div> -->
                                    <!-- HERE, Salin soal old, tidak dihilangkan dulu -->
                                    <!-- <div>
                                        <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#bankSoalModal">
                                            {{ __('Salin dari Bank Soal') }}
                                        </a>
                                    </div> -->
                                    <div>
                                        <a href="{{ route('admin.salinkonten-soal', ['jeniskonten' => 'test', 'id' => $id_materi_soal]) }}" class="btn btn-primary mr-2">
                                                {{ __('Salin dari Bank Soal') }}</a>
                                    </div> 
                                </div>
                            </div>
                            <div class="card-body">
                            @if($listmaterisoal->isEmpty())
                                <div class="text-center my-5">
                                    <img src="{{ asset('frontend/img/icons/emptystate.jpg') }}" alt="No Data Icon" class="mb-3" style="width: 100px;">
                                    <p class="text-muted" style="font-size: 18px;">Belum ada soal</p>
                                </div>
                            @else
                                @foreach($listmaterisoal as $index => $soal)
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5>Pertanyaan {{ ++$index }}</h5>
                                        <div class="d-flex">
                                            @php 
                                                $id_soal = Crypt::encrypt($soal->id);
                                            @endphp
                                            <a href="{{ route('admin.editkonten-soal', ['idmateri' => $id_materi_soal, 'idsoal' => $id_soal]) }}" class="btn btn-warning btn-sm  mr-3">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteSoal({{ $soal->id_materi_soal }}, {{ $soal->id }})">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="question-text">{{ $soal->soal }} ?</p>
                                        
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label {{ $soal->kunci_jawaban == 'A' ? 'correct-answer' : '' }}" for="optionA">A.  {{ $soal->pilihan_a }}</label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label {{ $soal->kunci_jawaban == 'B' ? 'correct-answer' : '' }}" for="optionB">B.  {{ $soal->pilihan_b }}</label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label {{ $soal->kunci_jawaban == 'C' ? 'correct-answer' : '' }}" for="optionC">C.  {{ $soal->pilihan_c }}</label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label {{ $soal->kunci_jawaban == 'D' ? 'correct-answer' : '' }}" for="optionD">D.  {{ $soal->pilihan_d }}</label>
                                            </div>
                                            @if($soal->pilihan_e != null)
                                            <div class="form-check">
                                                <label class="form-check-label {{ $soal->kunci_jawaban == 'E' ? 'correct-answer' : '' }}" for="optionE">E.  {{ $soal->pilihan_e }}</label>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <div class="mt-3">
                                            <strong>Kunci Jawaban :</strong> {{ strtoupper($soal->kunci_jawaban) }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <!-- Modal for Salin dari Bank Soal -->
    <div class="modal fade" id="bankSoalModal" tabindex="-2" role="dialog" aria-labelledby="bankSoalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bankSoalModalLabel" style="margin-left: 18px;">{{ __('Salin Soal') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="soalForm" method="POST" action="{{ route('admin.storecopykonten-soal') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_materi_soal" id="id_materi_soal" value="{{ $materisoal->id_materi }}">
                        <div class="form-group">
                            <label for="banksoalSelect">{{ __('Pilih Bank Soal') }}</label>
                            <select class="form-control" id="banksoalSelect" name="id_bank_soal">
                                <option value="">{{ __('Pilih') }}</option>
                                @foreach($bankSoalList as $banksoal)
                                    <option value="{{ $banksoal->id_bank_soal }}">{{ $banksoal->judul_bank_soal }}</option>
                                @endforeach
                            </select>
                            <!-- Inline error message -->
                            <span id="banksoalError" class="text-danger" style="display: none; font-size: 0.75rem;">Silahkan pilih Bank Soal terlebih dahulu</span>
                            <span id="banksoalNoData" class="text-danger" style="display: none; font-size: 0.75rem;">Tidak ada soal, pilih bank soal lain.</span>
                        </div>
                    </form>

                    <div class="mt-4">
                        <table id="soalTable" class="table table-bordered table-striped" style="width:100%; display: none;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Soal</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Batal') }}</button>
                    <button type="button" id="submitSoalBtn" class="btn btn-primary">{{ __('Salin Soal') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmSalinModal" tabindex="-1" role="dialog" aria-labelledby="confirmSalinModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
        function deleteSoal(idmateri, idsoal) {
            $("#deleteForm").attr("action", "{{ url('admin/deletekonten-soal') }}" + "/" + idmateri + "/" + idsoal);
        }
    </script>
    <script>
        $(document).ready(function () {
            let soalTable = $('#soalTable').DataTable({
                columns: [
                    { title: 'No.'},
                    { title: 'Soal' }              
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '5%',
                        className: 'text-center'
                    },
                    {
                        targets: 1,
                        width: '95%'
                    }
                ],
                paging: true,
                searching: false,
                lengthChange: false,
                info: true,
                language: {
                    "emptyTable": "Tidak Ada Soal",
                    "zeroRecords": "Tidak Ada Data yang Cocok",
                    "info": "Menampilkan _END_ dari Total _TOTAL_ Soal",
                    "infoEmpty": "Menampilkan 0 dari Total 0 Soal",
                }
            });

            $('#banksoalSelect').on('change', function () {
                const selectedId = $(this).val();
                $('#banksoalError').hide();
                $('#banksoalNoData').hide();
                $('#submitSoalBtn').prop('disabled', false);

                if (selectedId) {
                    $.ajax({
                        url: `{{ url('admin/fetch-soal') }}/${selectedId}`,
                        method: 'GET',
                        success: function (data) {
                            if (data.message === 'nodata') {
                                soalTable.clear().draw();
                                $('#soalTable').show();
                                $('#banksoalNoData').show();
                                $('#submitSoalBtn').prop('disabled', true);
                            } else {
                                soalTable.clear();
                                data.forEach((item, index) => {
                                    soalTable.row.add([
                                        index + 1,
                                        item.soal
                                    ]);
                                });
                                soalTable.draw();
                                $('#soalTable').show();
                            }
                        },
                        error: function (xhr) {
                            console.error(xhr.responseJSON);
                            alert('Failed to fetch data. Please try again.');
                        }
                    });
                } else {
                    soalTable.clear().draw();
                    $('#soalTable').hide();
                }
            });
        });

        $('#submitSoalBtn').click(function() {
            var selectedBankSoal = $('#banksoalSelect').val();
            if (selectedBankSoal) {
                $('#confirmSalinModal').modal('show');
            } else {
                $('#banksoalError').show();
            }
        });

        $('#confirmSalinBtn').click(function() {
            $('#soalForm').submit();
        });
    </script>
@endpush