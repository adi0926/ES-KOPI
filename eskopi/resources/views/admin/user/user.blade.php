@extends('admin.master_layout')
@section('title')
    <title>{{ __('User') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('User') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('User') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('User') }}</h4>
                                <div>
                                    <a href="{{ route('admin.add-user') }}" class="btn btn-primary">
                                        </i> {{ __('Tambah User') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('#') }}</th>
                                                <th width="30%">{{ __('Nama') }}</th>
                                                <th width="20%">{{ __('Email') }}</th>
                                                <th width="10%">{{ __('Level') }}</th>
                                                <th width="10%">{{ __('Status') }}</th>
                                                <th width="16%">{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @foreach($daftaruser as $index => $md)       
                                            @php 
                                                $id_update = Crypt::encrypt($md->id);
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $md->name }}</td>
                                                <td>{{ $md->email }}</td>
                                                <td>{{ $md->level }}</td>
                                                <td>{{ $md->status }}</td>
                                    
                                                <td>
                                                    <a href="{{ route('admin.edit-user', $id_update) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $md->id }})">
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
            $("#deleteForm").attr("action", "{{ url('admin/user-delete') }}" + "/" + id)
        }
    </script>
@endpush