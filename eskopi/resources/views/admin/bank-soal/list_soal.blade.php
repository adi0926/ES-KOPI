@extends('admin.master_layout')
@section('title')
    <title>{{ __('Daftar Soal') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Daftar Soal') }}</h1>
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
                    <div class="breadcrumb-item">{{ __('Daftar Soal') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Daftar Soal') }} [ {{ $bankSoal -> judul_bank_soal }} : Total {{ $bankSoal->soals_count }} Soal ]</h4>
                                <div>
                                    <a href="{{ route('admin.add-soal', $id_bank_soal) }}" class="btn btn-primary">
                                         {{ __('Tambah Soal') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                            @if($soals->isEmpty())
                                <div class="text-center my-5">
                                    <img src="{{ asset('frontend/img/icons/emptystate.jpg') }}" alt="No Data Icon" class="mb-3" style="width: 100px;">
                                    <p class="text-muted" style="font-size: 18px;">Belum ada soal</p>
                                </div>
                            @else
                                @if($bankSoal->kategori == "evaluasi")
                                    <div class="table-responsive">
                                        <table class="stripe row-border order-column nowrap" id="tableListEvaluasi">
                                            <thead>
                                                <tr>
                                                    <th width="2%"></th>
                                                    <th width="2%">{{ __('No') }}</th>
                                                    <th>{{ __('Soal') }}</th>
                                                    <th>{{ __('Aksi') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>          
                                                @foreach($soals as $index => $soal)  
                                                @php 
                                                    $id_soal = Crypt::encrypt($soal->id_soal);
                                                @endphp  
                                                <tr>
                                                    <td width="2%"></td>
                                                    <td width="2%">{{ ++$index }}</td>
                                                    <td>{{ $soal->soal }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.edit-soal', ['idbank' => $id_bank_soal, 'idsoal' => $id_soal]) }}" class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteSoal({{ $soal->id_soal }}, {{ $soal->id_bank_soal }})">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    @foreach($soals as $index => $soal)
                                    <div class="card mb-4">
                                        <div class="card-header d-flex justify-content-between">
                                            <h5>Pertanyaan {{ ++$index }}</h5>
                                            <div class="d-flex">
                                                @php 
                                                    $id_soal = Crypt::encrypt($soal->id_soal);
                                                @endphp
                                                <a href="{{ route('admin.edit-soal', ['idbank' => $id_bank_soal, 'idsoal' => $id_soal]) }}" class="btn btn-warning btn-sm  mr-3">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteSoal({{ $soal->id_soal }}, {{ $soal->id_bank_soal }})">
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
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection

@push('js')
    <script>
        function deleteSoal(id_soal, id_bank_soal) {
            $("#deleteForm").attr("action", "{{ url('admin/soal-delete') }}" + "/" + id_soal + "/" + id_bank_soal);
        }


        new DataTable('#tableListEvaluasi', {
            columnDefs: [
                {
                    orderable: false,
                    render: DataTable.render.select(),
                    targets: 0
                }
            ],
            fixedColumns: {
                start: 2
            },
            order: [[1, 'asc']],
            paging: true,
            pageLength: 10,
            scrollCollapse: true,
            scrollX: true,
            scrollY: true,
            select: {
                style: 'os',
                selector: 'td:first-child'
            }
        });
    </script>
    
@endpush