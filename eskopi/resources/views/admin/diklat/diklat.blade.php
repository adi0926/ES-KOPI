@extends('admin.master_layout')
@section('title')
    <title>{{ __('Diklat') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Diklat ') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Diklat ') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Diklat ') }}</h4>
                                <div>
                                    <a href="{{ route('admin.add-diklat') }}" class="btn btn-primary">
                                        {{ __('Tambah Diklat ') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('No') }}</th>
                                                <th>{{ __('Nama Diklat') }}</th>
                                                <th>{{ __('Kategori') }}</th>
                                                <th>{{ __('Publikasi') }}</tg>
                                                <th>{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @foreach($diklat as $index => $d)       
                                            @php 
                                                $id_diklat = Crypt::encrypt($d->id_diklat);
                                            @endphp
                                            <tr>
                                                <td width="2%"></td>
                                                <td width="1%">{{ ++$index }}</td>
                                                <td>{{ $d->nama_diklat }}</td>
                                                <td>{{ $d->kategori->nama_kategori }}</td>
                                                <td>
                                                    @if($d->publikasi == 'N')
                                                        <span style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px;">Belum Publikasi</span>
                                                    @elseif($d->publikasi == 'Y')
                                                        <span style="background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Sudah Publikasi</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.edit-diklat', $id_diklat) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $d->id_diklat }})">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                    @if($d->publikasi !== 'Y')
                                                        @if($d->isPublishable())
                                                            <button class="btn btn-success btn-sm" onclick="publishDiklat({{ $d->id_diklat }})">
                                                                <i class="fa fa-check" aria-hidden="true"></i> Publish
                                                            </button>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled data-toggle="tooltip" title="Harap lengkapi konten diklat terlebih dahulu">
                                                                <i class="fa fa-check" aria-hidden="true"></i> Publish
                                                            </button>
                                                        @endif
                                                    @endif

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

    <div class="modal fade" id="publishModal" tabindex="-1" role="dialog" aria-labelledby="confirmSalinModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 10%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="margin-left: 18px;">{{ __('Konfirmasi Publish') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Apakah yakin ingin mem-publish diklat ini?') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form id="publishForm" action="" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Tutup') }}</button>
                        <button type="submit" id="confirmPublishButton" class="btn btn-primary">{{ __('Ya, Publish') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        function deleteData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/diklat-delete') }}" + "/" + id)
        }

        function publishDiklat(id) {
            console.log('inside function');
            $("#publishForm").attr("action", "{{ url('admin/diklat-publish') }}" + "/" + id);
            $("#publishModal").modal("show");
        }

        $('#confirmPublishButton').click(function() {
            $('#publishForm').submit();
        });

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@endpush