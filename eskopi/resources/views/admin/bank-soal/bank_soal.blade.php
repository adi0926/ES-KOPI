@extends('admin.master_layout')
@section('title')
    <title>{{ __('Bank Soal') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Bank Soal ') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Bank Soal ') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Bank Soal ') }}</h4>
                                <div>
                                    <a href="{{ route('admin.add-bank-soal') }}" class="btn btn-primary">
                                         {{ __('Tambah Bank Soal ') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableBankSoal">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('No') }}</th>
                                                <th>{{ __('Bank Soal') }}</th>
                                                <th>{{ __('Jumlah Soal') }}</th>
                                                <th>{{ __('Kategori') }}</th>
                                                <th>{{ __('Mata Diklat') }}</th>
                                                <th>{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @foreach($bankSoal as $index => $bs)       
                                            @php 
                                                $id_bank_soal = Crypt::encrypt($bs->id_bank_soal);
                                            @endphp
                                            <tr>
                                                <td width="2%"></td>
                                                <td width="2%">{{ ++$index }}</td>
                                                <td>{{ $bs->judul_bank_soal }}</td>
                                                <td>{{ $bs->soals_count }} Soal</td>
                                                <td>
                                                    @switch($bs->kategori)
                                                        @case('pretest')
                                                            Pre Test
                                                            @break
                                                        @case('posttest')
                                                            Post Test
                                                            @break
                                                        @case('ujian')
                                                            Ujian
                                                            @break
                                                        @case('evaluasi')
                                                            Evaluasi
                                                            @break
                                                        @default
                                                            Random
                                                    @endswitch
                                                </td>
                                                <td>{{ Str::limit($bs->mataDiklat->mata_diklat ?? ' -- ', 40, '...') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.list-soal', $id_bank_soal) }}" class="btn btn-success btn-sm">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('admin.edit-bank-soal', $id_bank_soal) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $bs->id_bank_soal }})">
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
        </section>
    </div>

@endsection

@push('js')
    <script>
        function deleteData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/bank-soal-delete') }}" + "/" + id)
        }

        new DataTable('#tableBankSoal', {
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