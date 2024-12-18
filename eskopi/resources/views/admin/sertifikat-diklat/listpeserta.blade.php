@extends('admin.master_layout')
@section('title')
    <title>{{ __('Proses Sertifikat') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Proses Sertifikat') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Proses Sertifikat') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Proses Sertifikat') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Proses Sertifikat') }}</h4>
                                
                            </div>
                            <div class="card-body">
                                <form id="filterForm" action="#" method="GET" class="form_padding">
                                <!-- <form action="#" method="GET"
                                    onchange="$(this).trigger('submit')" class="form_padding"> -->
                                    <div class="row">

                                        <div class="col-md-3 form-group">
                                            <select name="diklat" id="diklat" class="form-control">
                                                <option value="">{{ __('Pilih Diklat') }}</option>
                                                @foreach($diklats as $diklat)
                                                    <option value="{{ $diklat->id_diklat }}">{{ $diklat->nama_diklat }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <select name="angkatan" id="angkatan" class="form-control">
                                                <option value="">{{ __('Pilih Angkatan') }}</option>

                                            </select>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <button class="btn btn-success">Pilih</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Daftar Sertifikat Peserta') }}</h4>
                                
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
                                                <th>{{ __('Status Sertifikat') }}</th>
                                                <th>{{ __('Aksi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>     
                                            @foreach ($penggunaDiklat as $index => $item)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->pengguna->name ?? 'N/A' }}</td>
                                                    <td>{{ $item->pengguna->nip ?? 'N/A' }}</td>
                                                    <td>{{ \Illuminate\Support\Str::limit($item->diklat->nama_diklat ?? 'N/A', 50, '...') }}</td>
                                                    <td>{{ $item->diklatAngkatan->nama_angkatan ?? 'N/A' }}</td>
                                                    <td>{{ $item->no_sertifikat }}</td>
                                                    <td>
                                                        @if($item->id_sertifikat)
                                                            @if($item->sertifikat->status == '0')
                                                                <span style="background-color: orange; color: white; padding: 5px 10px; border-radius: 5px;">Menunggu verifikasi</span>
                                                            @else
                                                                <span style="background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Selesai</span>
                                                            @endif
                                                        @else
                                                            <span style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px;">Belum diproses</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->id_sertifikat)
                                                            @if($item->sertifikat->status == '0')
                                                                <a href="#" class="btn btn-success btn-sm">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                </a>
                                                            @endif
                                                        @else
                                                            <a href="#" class="btn btn-secondary btn-sm" disabled data-toggle="tooltip" title="Sertifikat belum tersedia">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                        
                                                        <!-- satuan hide -->
                                                        <!-- <button class="btn btn-success btn-sm" onclick="prosesSertif('{{ $item->diklat->id_diklat }}', '{{ $item->diklatAngkatan->id_diklat_angkatan }}', '{{ $item->pengguna->id_pengguna }}')">
                                                            <i class="fa fa-check" aria-hidden="true"></i> Proses
                                                        </button> -->

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

    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="confirmSalinModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 10%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="margin-left: 18px;">{{ __('Import Nomor Sertifikat') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Upload file csv untuk melengkapi data nomor sertifikat') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form id="importForm" action="{{ route('admin.upload-csv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="csv_file" accept=".csv">
                        <button type="submit" id="confirmImport" class="btn btn-primary">{{ __('Unggah') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="prosesModal" tabindex="-1" role="dialog" aria-labelledby="confirmSalinModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 10%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="margin-left: 18px;">{{ __('Konfirmasi Proses') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Apakah yakin ingin memproses sertifikat untuk angkatan diklat ini?') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form id="prosesForm" action="" method="POST">
                        @csrf
                        <input type="hidden" name="id_diklat" id="idDiklat">
                        <input type="hidden" name="id_angkatan" id="idAngkatan">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Tutup') }}</button>
                        <button type="submit" id="confirmProsesButton" class="btn btn-primary">{{ __('Ya, Proses') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        // satuan hide
        // function prosesSertif(idDiklat, idAngkatan, idPengguna) {
        //     $("#prosesForm").attr("action", "{{ url('admin/create-sertifikat') }}");
        //     $("#idDiklat").val(idDiklat);
        //     $("#idAngkatan").val(idAngkatan);
        //     $("#idPengguna").val(idPengguna);
        //     $("#prosesModal").modal("show");
            
        // }

        // $('#confirmProsesButton').click(function() {
        //     $('#prosesForm').submit();
        // });
        // satuan hide


        function prosesSertif(idDiklat, idAngkatan) {
            $("#prosesForm").attr("action", "{{ url('admin/createbulk-sertifikat') }}");
            $("#idDiklat").val(idDiklat);
            $("#idAngkatan").val(idAngkatan);
            $("#prosesModal").modal("show");
            
        }

        $('#confirmProsesButton').click(function() {
            $('#prosesForm').submit();
        });

        function importData() {
            $("#importModal").modal("show");
        }

        $('#confirmImport').click(function() {
            $('#importForm').submit();
        });


        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function() {
            $('#diklat').change(function() {
                var diklatId = $(this).val();
                if (diklatId) {
                    $.ajax({
                        url: '/admin/getAngkatan/' + diklatId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#angkatan').empty();
                            $('#angkatan').append('<option value="">{{ __('Pilih Angkatan') }}</option>');

                            $.each(data, function(key, value) {
                                $('#angkatan').append('<option value="' + value.id_diklat_angkatan + '">' + value.nama_angkatan + '</option>');
                            });
                        }
                    });
                } else {
                    $('#angkatan').empty();
                    $('#angkatan').append('<option value="">{{ __('Pilih') }}</option>');
                }
            });
        });


        $(document).ready(function () {
            $('#filterForm').on('submit', function (e) {
                e.preventDefault();

                let diklatId = $('#diklat').val();
                let angkatanId = $('#angkatan').val();

                if (!diklatId || !angkatanId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validasi Error',
                        text: 'Harap pillih diklat dan angkatan',
                        confirmButtonText: 'OK',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Mohon tunggu...',
                    text: 'Mendapatkan data',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '/admin/getFilteredData',
                    type: 'GET',
                    data: {
                        diklat: diklatId,
                        angkatan: angkatanId,
                    },
                    success: function (response) {
                        updateTable(response);
                        $('#tableMaster').DataTable().columns.adjust();
                        Swal.close();
                        
                        const cardHeader = $('.card-header:contains("Daftar Sertifikat Peserta")');

                        cardHeader.find('.d-flex').remove();

                        const dataArray = Object.values(response);
                        const hasProcessed = dataArray.some(item => item.id_sertifikat !== null);
                        const noData = dataArray.length === 0;
                        
                        const isNoSertifikatComplete = dataArray.some(item => item.no_sertifikat === null);

                        let buttonHTML = '';

                        if (noData) {
                            buttonHTML = `
                                <button class="btn btn-danger btn-sm mr-2" disabled>
                                    Tidak Dapat di Proses
                                </button>
                            `;
                        } else if (hasProcessed) {
                            buttonHTML = `
                                <button class="btn btn-success btn-sm mr-2" disabled>
                                    Sudah di Proses
                                </button>
                            `;
                        } else {
                            if (isNoSertifikatComplete) {
                                buttonHTML = `
                                    <button class="btn btn-warning btn-sm mr-2" disabled>
                                        Lengkapi No Sertifikat
                                    </button>
                                `;
                            } else {
                                buttonHTML = `
                                    <button class="btn btn-success btn-sm mr-2" onclick="prosesSertif(${diklatId}, ${angkatanId})">
                                        Proses Sertifikat Angkatan
                                    </button>
                                `;
                            }
                        }

                        cardHeader.append(`
                            <div class="d-flex">
                                <div>
                                    <a href="/admin/download-template?diklatId=${diklatId}&angkatanId=${angkatanId}" class="btn btn-primary mr-2">
                                        Unduh Template
                                    </a>
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-sm mr-2" onclick="importData()">
                                        Import No. Sertifikat
                                    </button>
                                </div>
                                <div>
                                    ${buttonHTML}
                                </div>
                            </div>
                        `);
                    },
                    error: function (xhr) {
                        console.error(xhr);
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal mendapatkan data. Harap coba lagi.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    },
                });
            });
            
            function updateTable(data) {
                
                let table = $('#tableMaster').DataTable();
            
                table.clear();
            
                const dataArray = Object.values(data);
                dataArray.forEach((item, index) => {
                    let statusHtml = item.id_sertifikat
                        ? item.sertifikat?.status === '0'
                            ? '<span style="background-color: orange; color: white; padding: 5px 10px; border-radius: 5px;">Menunggu verifikasi</span>'
                            : '<span style="background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Selesai</span>'
                        : '<span style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px;">Belum diproses</span>';
            
                    let actionHtml = item.id_sertifikat && item.sertifikat?.status === '0'
                        ? `<a href="#" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>`
                        : `<a href="#" class="btn btn-secondary btn-sm" disabled data-toggle="tooltip" title="Sertifikat belum tersedia"><i class="fa fa-eye" aria-hidden="true"></i></a>`;
            
                    table.row.add([
                        '',
                        index + 1,
                        item.pengguna?.name || 'N/A',
                        item.pengguna?.nip || 'N/A',
                        item.diklat?.nama_diklat || 'N/A',
                        item.diklat_angkatan?.nama_angkatan || 'N/A',
                        item.no_sertifikat || '',
                        statusHtml,
                        actionHtml,
                    ]);
                });
            
                
                table.draw();
            }


            function updateTablexold(data) {
                let tableBody = $('#tableMaster tbody');
                tableBody.empty();

                const dataArray = Object.values(data);

                dataArray.forEach((item, index) => {
                    let statusHtml = item.id_sertifikat
                        ? item.sertifikat?.status === '0'
                            ? '<span style="background-color: orange; color: white; padding: 5px 10px; border-radius: 5px;">Menunggu verifikasi</span>'
                            : '<span style="background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Selesai</span>'
                        : '<span style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px;">Belum diproses</span>';

                    let actionHtml = item.id_sertifikat && item.sertifikat?.status === '0'
                        ? `<a href="#" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>`
                        : `<a href="#" class="btn btn-secondary btn-sm" disabled data-toggle="tooltip" title="Sertifikat belum tersedia"><i class="fa fa-eye" aria-hidden="true"></i></a>`;

                    tableBody.append(`
                        <tr>
                            <td></td>
                            <td>${index + 1}</td>
                            <td>${item.pengguna?.name || 'N/A'}</td>
                            <td>${item.pengguna?.nip || 'N/A'}</td>
                            <td>${item.diklat?.nama_diklat || 'N/A'}</td>
                            <td>${item.diklat_angkatan?.nama_angkatan || 'N/A'}</td>
                            <td>${item.no_sertifikat || '' }</td>
                            <td>${statusHtml}</td>
                            <td>${actionHtml}</td>
                        </tr>
                    `);
                });
            }

        });

    </script>
@endpush