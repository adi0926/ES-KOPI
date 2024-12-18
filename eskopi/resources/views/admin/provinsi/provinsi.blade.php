@extends('admin.master_layout')
@section('title')
    <title>{{ __('Provinsi') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Provinsi') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Provinsi') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Provinsi') }}</h4>
                                <div>
                                    <a href="{{ route('admin.add-provinsi') }}" class="btn btn-primary">
                                        </i> {{ __('Tambah Provinsi') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('#') }}</th>
                                                <th width="30%">{{ __('Id Provinsi') }}</th>
                                                <th width="30%">{{ __('Provinsi') }}</th>
                                                <th width="16%">{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @foreach($provinsi as $index => $md)       
                                            @php 
                                                $id_prov = Crypt::encrypt($md->id_provinsi);
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $md->id_provinsi }}</td>
                                                <td>{{ $md->nama_provinsi }}</td>
                                               
                                    
                                                <td>
                                                    <a href="{{ route('admin.edit-provinsi', $id_prov) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData('{{ $md->id_provinsi }}')">
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
           $("#deleteForm").attr("action", "{{ url('admin/provinsi-delete') }}" + "/" + id)
        }
    </script>
@endpush