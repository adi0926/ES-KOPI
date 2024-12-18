@extends('admin.master_layout')
@section('title')
    <title>{{ __('Laporan') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Laporan') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Laporan') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Filter Laporan') }}</h4>
                                
                            </div>
                            <div class="card-body">
                                <form action="#" method="GET"
                                    onchange="$(this).trigger('submit')" class="form_padding">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <input type="text" name="keyword" value="{{ request()->get('keyword') }}"
                                                class="form-control" placeholder="{{ __('Cari') }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" autocomplete="off" name="date" value="{{ request()->get('date') }}"
                                                class="form-control datepicker" placeholder="{{ __('Tanggal Selesai') }}">
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">{{ __('Diklat') }}</option>
                                                <option {{ request()->get('status') == 'active' ? 'selected' : '' }}
                                                    value="active">{{ __('Published') }}</option>
                                                <option {{ request()->get('status') == 'inactive' ? 'selected' : '' }}
                                                    value="inactive">{{ __('Unpublished') }}</option>
                                                <option {{ request()->get('status') == 'draft' ? 'selected' : '' }}
                                                    value="draft">{{ __('Drafted') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Laporan') }}</h4>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('No.') }}</th>
                                                <th>{{ __('Peserta Diklat') }}</th>
                                                <th>{{ __('NIP') }}</th>
                                                <th>{{ __('Diklat') }}</th>
                                                <th>{{ __('Angkatan') }}</th>
                                                <th>{{ __('No. Sertifikat') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @forelse ($penggunaDiklat as $index => $item)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->pengguna->name ?? 'N/A' }}</td>
                                                    <td>{{ $item->pengguna->nip ?? 'N/A' }}</td>
                                                    <td>{{ $item->diklat->nama_diklat ?? 'N/A' }}</td>
                                                    <td>{{ $item->diklatAngkatan->nama_angkatan ?? 'N/A' }}</td>
                                                    <td> N/A </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">{{ __('No data available') }}</td>
                                                </tr>
                                            @endforelse
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
        
    </script>
@endpush