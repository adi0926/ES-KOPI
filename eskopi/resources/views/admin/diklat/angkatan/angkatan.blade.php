@extends('admin.master_layout')
@section('title')
    <title>{{ __('Diklat') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.diklat') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Diklat') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.diklat') }}">{{ __('Diklat') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Diklat') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <h4>Ubah Diklat</h4>
                                    @php 
                                        $id_diklat = Crypt::encrypt($diklat->id_diklat);
                                    @endphp
                                    <div class="btn-group mt-2">
                                        <a href="{{ route('admin.edit-diklat', $id_diklat) }}" class="btn btn-outline-primary" style="margin-right: 10px;">
                                            Umum
                                        </a>
                                        <a href="{{ route('admin.diklatangkatan', $id_diklat) }}" class="btn btn-outline-primary active" style="margin-right: 10px;">
                                            Angkatan
                                        </a>
                                        <a href="{{ route('admin.matadiklat', $id_diklat) }}" class="btn btn-outline-primary" style="margin-right: 10px;">
                                            Mata Diklat
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('admin.diklat') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            
                            <div class="card-body">

                                <!-- Angkatan Data Table Section -->
                                <div id="angkatan-section">
                                    <div class="section-body">
                                        <div class="mt-4 row">
                                            <div class="col">
                                                <div class="card" id="angkatanTableSection" style="display: block;">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h4>{{ __('Angkatan Diklat ') }}</h4>
                                                        <div>
                                                            @if (!$hasZeroTipeAngkatan)
                                                                <button id="showTambahAngkatanFormBtn" class="btn btn-primary">
                                                                    {{ __('Tambah Angkatan') }}
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="stripe row-border order-column nowrap" id="tableAngkatan">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="2%"></th>
                                                                        <th width="1%">{{ __('No') }}</th>
                                                                        <th>{{ __('Angkatan') }}</th>
                                                                        <th>{{ __('Judul Diklat') }}</th>
                                                                        <th>{{ __('Kuota') }}</th>
                                                                        <th>{{ __('Akhir Pendaftaran') }}</th>
                                                                        <th>{{ __('Mulai Pada') }}</th>
                                                                        <th>{{ __('Berakhir Pada') }}</th>
                                                                        <th>{{ __('Aksi') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($diklatAngkatan as $index => $angkatan)
                                                                    <tr>
                                                                        <td width="2%"></td>
                                                                        <td width="1%">{{ $index + 1 }}</td>
                                                                        <td>{{ $angkatan->nama_angkatan }}</td>
                                                                        <td>{{ \Illuminate\Support\Str::limit($diklat->nama_diklat, 40) }}</td>
                                                                        <td>{{ $angkatan->kuota_peserta }}</td>
                                                                        <td>{{ $angkatan->tanggal_akhir_pendaftaran }}</td>
                                                                        <td>{{ $angkatan->diklat_mulai }}</td>
                                                                        <td>{{ $angkatan->diklat_selesai }}</td>
                                                                        <td>
                                                                            <a href="javascript:;" class="btn btn-warning btn-sm" onclick="editAngkatan({{ $angkatan->id_diklat_angkatan }})">
                                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                                            </a>                                           
                                                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteAngkatan({{ $angkatan->id_diklat_angkatan }})">
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
                                    </div>
                                </div>
                                
                                <!-- Tambah Angkatan Form Section -->
                                <div id="tambahAngkatanFormSection" class="card" style="display: none;">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4>{{ __('Tambah Angkatan') }}</h4>
                                        <div>
                                            <button id="cancelTambahAngkatanBtn" class="btn btn-primary">
                                                <i class="fa fa-arrow-left"></i> {{ __('Kembali') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.diklatangkatan-store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="tipe">Tipe<span class="text-danger">*</span></label>
                                                @if ($hasOneTipeAngkatan)
                                                    <input type="text" class="form-control" value="Ada Angkatan" readonly>
                                                    <input type="hidden" name="tipe" value="1">
                                                @else
                                                    <select class="form-control" name="tipe" id="tipe">
                                                        <option value="">Pilih</option>
                                                        <option value="1">Ada Angkatan</option>
                                                        <option value="0">Tidak Ada Angkatan</option>
                                                    </select>
                                                @endif
                                            </div>

                                            <div class="form-group" id="namaAngkatanGroup">
                                                <label for="nama_angkatan">Nama Angkatan</label>
                                                <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kuota_peserta">Kuota Peserta</label>
                                                <input type="number" class="form-control" id="kuota_peserta" name="kuota_peserta" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_akhir_pendaftaran">Tanggal Akhir Pendaftaran</label>
                                                <input type="date" class="form-control" id="tanggal_akhir_pendaftaran" name="tanggal_akhir_pendaftaran" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="diklat_mulai">Tanggal Mulai</label>
                                                <input type="date" class="form-control" id="diklat_mulai" name="diklat_mulai" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="diklat_selesai">Tanggal Selesai</label>
                                                <input type="date" class="form-control" id="diklat_selesai" name="diklat_selesai" required>
                                            </div>
                                            
                                            <input type="hidden" id="id_diklat" class="form-control" name="id_diklat" value="{{ $diklat->id_diklat }}">
                                            <button type="submit" class="btn btn-success">Simpan Angkatan</button>
                                            <button type="button" id="cancelTambahAngkatanBtn2" class="btn btn-danger">Batal</button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Edit Angkatan Form Section -->
                                <div id="editAngkatanFormSection" class="card" style="display: none;">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4>{{ __('Edit Angkatan') }}</h4>
                                        <div>
                                            <button id="cancelEditAngkatanBtn" class="btn btn-primary">
                                                <i class="fa fa-arrow-left"></i> {{ __('Kembali') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="editAngkatanForm" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            
                                            <div class="form-group">
                                                <label for="nama_angkatan">Nama Angkatan</label>
                                                <input type="text" class="form-control" id="nama_angkatan_edit" name="nama_angkatan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kuota_peserta">Kuota Peserta</label>
                                                <input type="number" class="form-control" id="kuota_peserta_edit" name="kuota_peserta" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_akhir_pendaftaran">Tanggal Akhir Pendaftaran</label>
                                                <input type="date" class="form-control" id="tanggal_akhir_pendaftaran_edit" name="tanggal_akhir_pendaftaran" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="diklat_mulai">Tanggal Mulai</label>
                                                <input type="date" class="form-control" id="diklat_mulai_edit" name="diklat_mulai" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="diklat_selesai">Tanggal Selesai</label>
                                                <input type="date" class="form-control" id="diklat_selesai_edit" name="diklat_selesai" required>
                                            </div>
                                            <input type="hidden" name="id_diklat" value="{{ $diklat->id_diklat }}">
                                            <button type="submit" class="btn btn-success">Update Angkatan</button>
                                            <button type="button" id="cancelEditAngkatanBtn2" class="btn btn-danger">Batal</button>
                                        </form>
                                    </div>
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

        function deleteAngkatan(id) {
            $("#deleteForm").attr("action", "{{ url('admin/diklatangkatan-delete') }}" + "/" + id)
        }
        
        // var tambah angkatandiklat
        const showTambahAngkatanFormBtn = document.getElementById('showTambahAngkatanFormBtn');
        const angkatanTableSection = document.getElementById('angkatanTableSection');
        const tambahAngkatanFormSection = document.getElementById('tambahAngkatanFormSection');
        const cancelTambahAngkatanBtn = document.getElementById('cancelTambahAngkatanBtn');
        
        // var edit angkatandiklat
        const editAngkatanFormSection = document.getElementById('editAngkatanFormSection');
        const cancelEditAngkatanBtn = document.getElementById('cancelEditAngkatanBtn');
        
        // js tambah angkatandiklat
        if (showTambahAngkatanFormBtn) {
            showTambahAngkatanFormBtn.addEventListener('click', () => {
                angkatanTableSection.style.display = 'none';
                tambahAngkatanFormSection.style.display = 'block';
    
                var tipeSelect = document.getElementById("tipe");
                tipeSelect.addEventListener("change", function() {
                    var value = this.value;
                    var namaAngkatanGroup = document.getElementById("namaAngkatanGroup");
                    var namaAngkatanInput = document.getElementById("nama_angkatan");
    
                    namaAngkatanGroup.style.display = (value === "1") ? "block" : "none";
                    namaAngkatanInput.value = (value === "0") ? "Tidak Ada Angkatan" : "";
                });
            });
        }
    
        cancelTambahAngkatanBtn.addEventListener('click', () => {
            tambahAngkatanFormSection.style.display = 'none';
            angkatanTableSection.style.display = 'block';
        });

        cancelTambahAngkatanBtn2.addEventListener('click', () => {
            tambahAngkatanFormSection.style.display = 'none';
            angkatanTableSection.style.display = 'block';
        });
        
        // js edit angakatandiklat
        function editAngkatan(id) {
            fetch(`/admin/diklatangkatan-edit/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nama_angkatan_edit').value = data.nama_angkatan;
                    document.getElementById('kuota_peserta_edit').value = data.kuota_peserta;
                    document.getElementById('tanggal_akhir_pendaftaran_edit').value = data.tanggal_akhir_pendaftaran;
                    document.getElementById('diklat_mulai_edit').value = data.diklat_mulai;
                    document.getElementById('diklat_selesai_edit').value = data.diklat_selesai;
    
                    document.getElementById('editAngkatanForm').action = `/admin/diklatangkatan-update/${id}`;
                    
                    angkatanTableSection.style.display = 'none';
        
                    editAngkatanFormSection.style.display = 'block';
                })
                .catch(error => console.error('Error fetching angkatan data:', error));
        }

        cancelEditAngkatanBtn.addEventListener('click', () => {
            editAngkatanFormSection.style.display = 'none';
            angkatanTableSection.style.display = 'block';
        });

        cancelEditAngkatanBtn2.addEventListener('click', () => {
            editAngkatanFormSection.style.display = 'none';
            angkatanTableSection.style.display = 'block';
        });
    </script>
@endpush