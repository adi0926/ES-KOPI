@extends('admin.master_layout')
@section('title')
    <title>{{ __('Dasbor') }}</title>
@endsection

@section('admin-content')
<div class="main-content">
    <!-- <div class="alert alert-danger alert-has-icon alert-dismissible d-none" id="missingCrentialsAlert">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title"></div>
            <button class="close" id="missingCrentialsAlertClose" data-dismiss="alert">
                <span><i class="fas fa-times"></i></span>
            </button>
            <b>
                <a class="btn btn-sm btn-outline-warning" href="/admin/crediential-setting">Update</a>
            </b>
        </div>
    </div>                     -->

    <section class="section">
        <div class="section-header">
            <h1>{{ __('Dasbor') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">                                
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Diklat</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['diklatCount'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pendaftar Diklat</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['penggunaDiklatCountAll'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pendaftar Diklat Disetujui</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['penggunaDiklatCountVerified'] }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pengguna</h4>
                            </div>
                            <div class="card-body">
                                {{ $data['penggunaCount'] }}
                            </div>
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
        $(document).ready(function() {
            "use strict";
            var alertKey = 'missingCrentialsAlert';
            var dismissedTimestamp = localStorage.getItem(alertKey);

            if (!dismissedTimestamp || Date.now() - dismissedTimestamp > 24 * 60 * 60 * 1000) {
                $('#missingCrentialsAlert').removeClass('d-none');
                $('#missingCrentialsAlert').show();
            } else {
                $('#missingCrentialsAlert').hide();
            }

            $('#missingCrentialsAlertClose').on('click', function() {
                $('#missingCrentialsAlert').hide();
                localStorage.setItem(alertKey, Date.now());
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            "use strict";
            var alertKey = 'updateAvailablityAlert';
            var dismissedTimestamp = localStorage.getItem(alertKey);

            if (!dismissedTimestamp || Date.now() - dismissedTimestamp > 24 * 60 * 60 * 1000) {
                $('#updateAvailablityAlert').removeClass('d-none');
                $('#updateAvailablityAlert').show();
            } else {
                $('#updateAvailablityAlert').hide();
            }

            $('#updateAvailablityAlertClose').on('click', function() {
                $('#updateAvailablityAlert').hide();
                localStorage.setItem(alertKey, Date.now());
            });
        });
    </script>
@endpush