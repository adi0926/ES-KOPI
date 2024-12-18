@extends('admin.master_layout')
@section('title')
    <title>{{ __('Digital Signature') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Digital Signature') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Digital Signature') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Pilih Diklat dan Angkatan') }}</h4>
                                
                            </div>
                            <div class="card-body">
                                <form id="filterForm" action="#" method="GET" class="form_padding">
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
                                <h4>{{ __('Tanda Tangan Elektronik') }}</h4>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="stripe row-border order-column nowrap" id="tableMaster">
                                        <thead>
                                            <tr>
                                                <th width="2%"></th>
                                                <th width="2%">{{ __('No.') }}</th>
                                                <th>{{ __('ID Peserta ') }}</th>
                                                <th>{{ __('Diklat') }}</th>
                                                <th>{{ __('Angkatan') }}</th>
                                                <th>{{ __('No. Sertifikat') }}</th>
                                                <th>{{ __('Status Sertifikat') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>          
                                            @foreach ($penggunaSertifikat as $index => $item)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->pengguna->name ?? 'N/A' }}</td>
                                                    <td>{{ $item->diklat->nama_diklat ?? 'N/A' }}</td>
                                                    <td>{{ $item->diklatAngkatan->nama_angkatan ?? 'N/A' }}</td>
                                                    <td>{{ $item->no_sertifikat ?? 'N/A' }}</td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <span style="background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Sudah Tanda Tangan</span>
                                                        @else
                                                            <span style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px;">Belum Tanda Tangan</span>
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

    <div class="modal fade" id="prosesModal" tabindex="-1" role="dialog" aria-labelledby="confirmSalinModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 10%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="margin-left: 18px;">{{ __('Konfirmasi Tanda Tangan Elektronik') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Apakah yakin ingin tanda tangan sertifikat untuk angkatan diklat ini?') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form id="prosesForm" action="" method="POST">
                        @csrf
                        <input type="hidden" name="id_diklat" id="idDiklat">
                        <input type="hidden" name="id_angkatan" id="idAngkatan">
                        <div class="form-group">
                            <label for="passphrase">{{ __('Passphrase') }}</label>
                            <input type="password" name="passphrase" id="passphrase" class="form-control" placeholder="{{ __('Masukkan passphrase') }}">
                        </div>
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

        function prosesSertif(idDiklat, idAngkatan) {
            $("#prosesForm").attr("action", "{{ url('admin/signature-request') }}");
            $("#idDiklat").val(idDiklat);
            $("#idAngkatan").val(idAngkatan);
            $("#prosesModal").modal("show");
            
        }

        // $('#confirmProsesButton').click(function() {
        //     $('#prosesForm').submit();
        // });

        $('#confirmProsesButton').click(function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Mohon tunggu...',
                text: 'Dalam proses pembubuhan Tanda Tangan Elektronik',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            var formData = $('#prosesForm').serialize();

            $.ajax({
                url: $('#prosesForm').attr('action'),
                type: 'POST',
                data: formData,
                success: function (response) {
                    Swal.close();

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1800,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Ada kesalahan sistem. Coba lagi ya.'
                        });
                    }
                },
                error: function () {
                    Swal.close();

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Request gagal. Pastikan sudah mengisi passphrase dan berada dalam jaringan BKPM. Harap coba kembali!'
                    });
                }
            });
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
                    url: '/admin/getFilteredSign',
                    type: 'GET',
                    data: {
                        diklat: diklatId,
                        angkatan: angkatanId,
                    },
                    success: function (response) {
                        updateTable(response);
                        Swal.close();
                        
                        const cardHeader = $('.card-header:contains("Tanda Tangan Elektronik")');
                        cardHeader.find('.d-flex').remove();

                        const dataArray = Object.values(response);
                        const hasProcessed = dataArray.some(item => item.status === '1');
                        const noData = dataArray.length === 0;

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
                            buttonHTML = `
                                <button class="btn btn-success btn-sm mr-2" onclick="prosesSertif(${diklatId}, ${angkatanId})">
                                    Proses Tanda Tangan
                                </button>
                            `;
                        }

                        cardHeader.append(`
                            <div class="d-flex">
                                <div>${buttonHTML}</div>
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
                    let statusHtml = item.status === '0'
                        ? '<span style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px;">Belum Tanda Tangan</span>'
                        : '<span style="background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Sudah Tanda Tangan</span>';
            
                    table.row.add([
                        '',
                        index + 1,
                        item.pengguna?.name || 'N/A',
                        item.diklat?.nama_diklat || 'N/A',
                        item.diklat_angkatan?.nama_angkatan || 'N/A',
                        item.no_sertifikat || '',
                        statusHtml,
                    ]);
                });
            
                table.draw();
            }


            function updateTablexold(data) {
                let tableBody = $('#tableMaster tbody');
                tableBody.empty();

                const dataArray = Object.values(data);

                dataArray.forEach((item, index) => {
                    let statusHtml = item.status === '0'
                            ? '<span style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px;">Belum Tanda Tangan</span>'
                            : '<span style="background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Sudah Tanda Tangan</span>'

                    tableBody.append(`
                        <tr>
                            <td></td>
                            <td>${index + 1}</td>
                            <td>${item.pengguna?.name || 'N/A'}</td>
                            <td>${item.diklat?.nama_diklat || 'N/A'}</td>
                            <td>${item.diklat_angkatan?.nama_angkatan || 'N/A'}</td>
                            <td>${item.no_sertifikat || '' }</td>
                            <td>${statusHtml}</td>
                        </tr>
                    `);
                });
            }

        });
    </script>
@endpush