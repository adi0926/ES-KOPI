@extends('peserta.layouts.master')

@section('dashboard-content')
<div class="dashboard__content-wrap">
    <div class="dashboard__content-title d-flex justify-content-between">
        <h4 class="title">{{ __('Sertifikat') }}</h4>
    </div>
    <div class="row">
        <div class="col-14">
            <div class="row">
                <div class="col-14">
                    <div class="tab-content" id="courseTabContent">
                    <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('#') }}</th>
                                                <th width="15%">{{ __('Nama') }}</th>
                                                <th width="20%">{{ __('Nama Diklat') }}</th>
                                                <th width="15%">{{ __('Kategori') }}</th>
                                                <th width="15%">{{ __('Angkatan') }}</th>
                                                <th width="10%">{{ __('Tanggal') }}</th>
                                                <th width="30%">{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                        @foreach($sertifikat as $index => $md)       
                                            @php 
                                                $id_peserta = Crypt::encrypt($md->id_peserta);
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $md->name }}</td>
                                                <td>{{ $md->nama_diklat }}</td>
                                                <td>{{ $md->nama_kategori }}</td>
                                                <td>{{ $md->nama_angkatan }}</td>
                                                <td>{{ $md->diklat_selesai }}</td>
                                    
                                                <td>
                                                <!-- <a href="{{ route('peserta.download-certificate', $id_peserta) }}" class="btn btn-warning btn-sm"> Download Sertifikat
                                                        
                                                    </a> -->
                                                    <a class="basic-button" href="{{ route('peserta.download-certificate', $id_peserta) }}" style="background-color: #49A85E; color: white;">
                                                                    <i class="fas fa-download" style="color: white;  font-size: 15px;"></i> Unduh Sertifikat
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
        </div>
    </div>
</div>
@endsection
