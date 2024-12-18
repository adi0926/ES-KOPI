@extends('admin.master_layout')
@section('title')
    <title>{{ __('Mata Diklat') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Mata Diklat') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Mata Diklat') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Mata Diklat') }}</h4>
                                <div>
                                    <a href="{{ route('admin.add-master-matadiklat') }}" class="btn btn-primary">
                                    </i> {{ __('Tambah Mata Diklat') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('#') }}</th>
                                                <th width="35%">{{ __('Mata Diklat') }}</th>
                                                <th width="40%">{{ __('Deskripsi') }}</th>
                                                <th width="5%">{{ __('Publikasi') }}</th>
                                                <th width="16%">{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @foreach($masterMataDiklat as $index => $md)       
                                            @php 
                                                $id_master_mata_diklat = Crypt::encrypt($md->id_master_mata_diklat);
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $md->mata_diklat }}</td>
                                                <td>{{ $md->deskripsi }}</td>
                                                <td>{{ $md->publikasi === 'Y' ? 'Ya' : 'Tidak' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.edit-master-matadiklat', $id_master_mata_diklat) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $md->id_master_mata_diklat }})">
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
            $("#deleteForm").attr("action", "{{ url('admin/master-matadiklat-delete') }}" + "/" + id)
        }
    </script>
@endpush