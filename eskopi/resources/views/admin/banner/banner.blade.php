@extends('admin.master_layout')
@section('title')
    <title>{{ __('Banner') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Banner') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Banner') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Banner') }}</h4>
                                <div>
                                    <a href="{{ route('admin.add-banner') }}" class="btn btn-primary">
                                         {{ __('Tambah Banner') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>{{ __('#') }}</th>
                                                <th>{{ __('Nama Banner') }}</th>
                                                <th>{{ __('Urutan') }}</th>
                                                <th>{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>    
                                            @foreach($banner as $index => $b)       
                                            @php 
                                                $id_slider = Crypt::encrypt($b->id_slider);
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $b->nama }}</td>
                                                <td>{{ $b->urutan }}</td>
                                                <td>
                                                    <a href="{{ route('admin.edit-banner', $id_slider) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $b->id_slider }})">
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
            $("#deleteForm").attr("action", "{{ url('admin/banner-delete') }}" + "/" + id)
        }
    </script>
@endpush