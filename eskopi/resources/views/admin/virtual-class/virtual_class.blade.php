@extends('admin.master_layout')
@section('title')
    <title>{{ __('Virtual Class') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Virtual Class') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Virtual Class') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Virtual Class') }}</h4>
                                <div>
                                    <a href="{{ route('admin.add-virtual-class') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('Tambah Virtual Class') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('#') }}</th>
                                                <th>{{ __('Diklat') }}</th>
                                                <th>{{ __('Angkatan') }}</th>
                                                <th>{{ __('Mata Diklat') }}</th>
                                                <th>{{ __('Judul') }}</th>
                                                <th>{{ __('Tipe') }}</th>
                                                <th>{{ __('Password') }}</th>
                                                <th>{{ __('Mulai Pelaksanaan') }}</th>
                                                <th width="16%">{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @foreach($virtualClass as $index => $md)       
                                            @php 
                                                $id_mata_diklat = Crypt::encrypt($md->id_mata_diklat);
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{ ++$index }}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <a href="{{ route('admin.edit-virtual-class', $id_mata_diklat) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $md->id_mata_diklat }})">
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
            $("#deleteForm").attr("action", "{{ url('admin/virtual-class-delete') }}" + "/" + id)
        }
    </script>
@endpush