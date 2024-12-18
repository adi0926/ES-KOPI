@extends('admin.master_layout')
@section('title')
    <title>{{ __('Peserta') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Peserta') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Peserta') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Peserta') }}</h4>
                                <div>
                                    <a href="{{ route('admin.add-peserta') }}" class="btn btn-primary">
                                        </i> {{ __('Tambah Peserta') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>{{ __('#') }}</th>
                                                <th>{{ __('Nama') }}</th>
                                                <th>{{ __('Nip') }}</th>
                                                <th>{{ __('Jabatan') }}</th>
                                                <th>{{ __('Bidang') }}</th>
                                                <th>{{ __('Instansi') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('No. HP / WA Aktif') }}</th>
                                                <th>{{ __('Kategori') }}</th>
                                                <th>{{ __('Diklat') }}</th>
                                                <th>{{ __('Angkatan') }}</th>
                                                <th>{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>    
                                            <!-- foreach  -->
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <a href="{{ route('admin.edit-peserta', 1) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData()">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            
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
            $("#deleteForm").attr("action", "{{ url('admin/peserta-delete') }}" + "/" + id)
        }
    </script>
@endpush