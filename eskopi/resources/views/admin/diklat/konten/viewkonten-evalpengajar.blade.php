@extends('admin.master_layout')
@section('title')
    <title>{{ __('Konten Evaluasi Pengajar') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                @php 
                    $id_diklat = Crypt::encrypt($id_diklat);
                    $id_materi_eval = Crypt::encrypt($materieval->id_materi);
                @endphp
                <div class="section-header-back">
                    <a href="{{ route('admin.matadiklat', $id_diklat) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Konten Evaluasi Pengajar') }}</h1>
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
                    <div class="breadcrumb-item">{{ __('Konten Evaluasi Pengajar') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4> {{ $materieval->judul_evaluasi }} [Total {{ $materieval->soals_count }} Soal]</h4>
                                <div class="d-flex">
                                    
                                    <div>
                                        <a href="{{ route('admin.salinkonten-soal', ['jeniskonten' => 'evalpengajar', 'id' => $id_materi_eval]) }}" class="btn btn-primary mr-2">
                                                {{ __('Salin dari Bank Soal') }}</a>
                                    </div> 
                                </div>
                            </div>
                            <div class="card-body">
                            @if($listevalsoal->isEmpty())
                                <div class="text-center my-5">
                                    <img src="{{ asset('frontend/img/icons/emptystate.jpg') }}" alt="No Data Icon" class="mb-3" style="width: 100px;">
                                    <p class="text-muted" style="font-size: 18px;">Belum ada soal</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableListKontenEvaluasiPengajar">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('No') }}</th>
                                                <th>{{ __('Soal') }}</th>
                                                <th>{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @foreach($listevalsoal as $index => $soal)  
                                            @php 
                                                $id_soal = Crypt::encrypt($soal->id);
                                            @endphp  
                                            <tr>
                                                <td width="2%"></td>
                                                <td width="2%">{{ ++$index }}</td>
                                                <td>{{ $soal->soal }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="#">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
        function deleteSoal(idmateri, idsoal) {
            $("#deleteForm").attr("action", "{{ url('admin/deletekonten-soal') }}" + "/" + idmateri + "/" + idsoal);
        }


        new DataTable('#tableListKontenEvaluasiPengajar', {
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