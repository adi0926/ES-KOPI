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
                                        <a href="{{ route('admin.diklatangkatan', $id_diklat) }}" class="btn btn-outline-primary" style="margin-right: 10px;">
                                            Angkatan
                                        </a>
                                        <a href="{{ route('admin.matadiklat', $id_diklat) }}" class="btn btn-outline-primary active" style="margin-right: 10px;">
                                            Mata Diklat
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('admin.diklat') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            
                            <div class="card-body">

                                <div id="mataDiklat-section" >
                                    <div class="section-body">
                                        <div class="mt-4 row">
                                            <div class="col">
                                                <div class="card" id="mataDiklatTableSection" style="display: block;">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h4>{{ __('Mata Diklat ') }}</h4>
                                                        <div>
                                                            <button id="showTambahMataDiklatFormBtn" class="btn btn-primary">
                                                                {{ __('Tambah Mata Diklat') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="stripe row-border order-column nowrap" id="tableMataDiklat">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="2%"></th>
                                                                        <th width="1%">{{ __('No') }}</th>
                                                                        @if (!$hasZeroTipeAngkatan)
                                                                            <th>{{ __('Angkatan') }}</th>
                                                                        @endif
                                                                        <th>{{ __('Mata Diklat') }}</th>
                                                                        <th>{{ __('Jumlah Konten') }}</th>
                                                                        <th>{{ __('Publikasi') }}</th>
                                                                        <th>{{ __('Aksi') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($mataDiklatRecords as $index => $mataDiklat)
                                                                    <tr>
                                                                        <td width="2%"></td>
                                                                        <td width="1%">{{ $index + 1 }}</td>
                                                                        @if (!$hasZeroTipeAngkatan)
                                                                            <td>{{ $mataDiklat->angkatan->nama_angkatan }}</td>
                                                                        @endif
                                                                        <td>{{ $mataDiklat->mata_diklat }}</td>
                                                                        <td>{{ $mataDiklat->jumlahKonten() }} Konten</td>
                                                                        <td>{{ $mataDiklat->publikasi === 'Y' ? 'Ya' : 'Tidak' }}</td>
                                                                        <td>
                                                                            <button class="showTambahKontenFormBtn btn btn-success btn-sm" data-mata-diklat="{{ $mataDiklat->mata_diklat }}" data-id="{{ $mataDiklat->id_mata_diklat }}">
                                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                                            </button>
                                                                            <button class="showListKontenBtn btn btn-success btn-sm" data-mata-diklat-view="{{ $mataDiklat->mata_diklat }}" data-id-view="{{ $mataDiklat->id_mata_diklat }}">
                                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                            </button>
                                                                            <a href="javascript:;" class="btn btn-warning btn-sm" onclick="editMataDiklat({{ $mataDiklat->id_mata_diklat }})">
                                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                                            </a>
                                                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteMataDiklat({{ $mataDiklat->id_mata_diklat }})">
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
                                
                                <!-- Tambah Mata Diklat Form Section -->
                                <div class="card" id="tambahMataDiklatFormSection" style="display: none;">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4>{{ __('Tambah Mata Diklat') }}</h4>
                                        <div>
                                            <button id="cancelTambahMataDiklatBtn" class="btn btn-primary">
                                                <i class="fa fa-arrow-left"></i> {{ __('Kembali') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.matadiklat-store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="angkatan">Angkatan<span class="text-danger">*</span></label>

                                                @if ($hasZeroTipeAngkatan)
                                                    <input type="text" class="form-control" value="{{ $diklatAngkatan->firstWhere('tipe_angkatan', 0)->nama_angkatan }}" readonly>
                                                    <input type="hidden" name="angkatan" value="{{ $diklatAngkatan->firstWhere('tipe_angkatan', 0)->id_diklat_angkatan }}">
                                                @else
                                                    <select class="form-control" name="angkatan" id="angkatan">
                                                        <option value="">{{ __('Pilih') }}</option>
                                                        @foreach($diklatAngkatan as $angkatan)
                                                            <option value="{{ $angkatan->id_diklat_angkatan }}">{{ $angkatan->nama_angkatan }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="mata_diklat">Mata Diklat<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mata_diklat" name="mata_diklat" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="publikasi">Publikasi<span class="text-danger">*</span></label>
                                                <select class="form-control" name="publikasi">
                                                    <option value="" selected>Pilih</option>
                                                    <option value="Y">Ya</option>
                                                    <option value="N">Tidak</option>
                                                </select>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-success">Simpan Mata Diklat</button>
                                            <button type="button" id="cancelTambahMataDiklatBtn2" class="btn btn-danger">Batal</button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Edit Mata Diklat Form Section -->
                                <div class="card" id="editMataDiklatFormSection" style="display: none;">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4>{{ __('Edit Mata Diklat') }}</h4>
                                        <div>
                                            <button id="cancelEditMataDiklatBtn" class="btn btn-primary">
                                                <i class="fa fa-arrow-left"></i> {{ __('Kembali') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="editMataDiklatForm" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <h6>Edit Mata Diklat</h6>
                                            <div class="form-group">
                                                <label for="edit_angkatan">Angkatan<span class="text-danger">*</span></label>
                                                <select class="form-control" name="angkatan" id="edit_angkatan">
                                                    <option value="">{{ __('Pilih') }}</option>
                                                    @foreach($diklatAngkatan as $angkatan)
                                                        <option value="{{ $angkatan->id_diklat_angkatan }}">{{ $angkatan->nama_angkatan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                            <div class="form-group">
                                                <label for="edit_mata_diklat">Mata Diklat<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="edit_mata_diklat" name="mata_diklat" required>
                                            </div>
                                    
                                            <div class="form-group">
                                                <label for="edit_publikasi">Publikasi<span class="text-danger">*</span></label>
                                                <select class="form-control" name="publikasi" id="edit_publikasi">
                                                    <option value="" selected>Pilih</option>
                                                    <option value="Y">Ya</option>
                                                    <option value="N">Tidak</option>
                                                </select>
                                            </div>
                                    
                                            <button type="submit" class="btn btn-success">Update Mata Diklat</button>
                                            <button type="button" id="cancelEditMataDiklatBtn2" class="btn btn-danger">Batal</button>
                                        </form>
                                    </div>
                                </div>
                                
                                
                                <!-- Tambah Konten Form Section -->
                                <div id="tambahKontenFormSection" style="display: none;">
                                    <div class="section-body">
                                        <div class="mt-4 row">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h4>{{ __('Tambah Konten Diklat ') }} ( <span id="mataDiklatName"></span> )</h4>
                                                        <div>
                                                            <button id="cancelTambahKontenBtn" class="btn btn-danger">
                                                                {{ __('Tutup Form') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.kontendiklat-store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" id="mataDiklatId" name="mata_diklat_id">
                                                            <div class="form-group">
                                                                <label for="tipe_konten">Tipe Konten<span class="text-danger">*</span></label>
                                                                <select class="form-control" name="tipe_konten" id="tipe_konten">
                                                                    <option value="" selected>Pilih</option>
                                                                    @foreach($tipekontens as $tipekonten)
                                                                        <option value="{{ $tipekonten->id_tipekonten }}">{{ $tipekonten->nama_tipekonten }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                            <!-- Materi Video Form -->
                                                            <div id="form-video" style="display: none;">
                                                                <div class="form-group">
                                                                    <label for="judul_video">Judul Materi</label>
                                                                    <input type="text" class="form-control" name="judul_video" id="judul_video" placeholder="Masukkan Judul Materi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="url_video">URL Video</label>
                                                                    <input type="text" class="form-control" name="url_video" id="url_video" placeholder="Masukkan URL Materi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="durasi_video">Durasi (dalam menit)</label>
                                                                    <input type="number" class="form-control" name="durasi_video" id="durasi_video" placeholder="Masukkan Durasi Materi">
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Materi PDF Form -->
                                                            <div id="form-pdf" style="display: none;">
                                                                <div class="form-group">
                                                                    <label for="judul_pdf">Judul Materi</label>
                                                                    <input type="text" class="form-control" name="judul_pdf" id="judul_pdf" placeholder="Masukkan Judul Materi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="url_pdf">URL PDF</label>
                                                                    <input type="text" class="form-control" name="url_pdf" id="url_pdf" placeholder="Masukkan URL Materi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="durasi_pdf">Durasi (dalam menit)</label>
                                                                    <input type="number" class="form-control" name="durasi_pdf" id="durasi_pdf" placeholder="Masukkan Durasi Materi">
                                                                </div>
                                                            </div>

                                                            <!-- Materi Soal Form -->
                                                            <div id="form-soal" style="display: none;">
                                                                <div class="form-group">
                                                                    <label for="judul_soal">Judul Soal</label>
                                                                    <input type="text" class="form-control" name="judul_soal" id="judul_soal" placeholder="Masukkan Judul Soal">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="tipe_soal">Tipe Soal<span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="tipe_soal" id="tipe_soal">
                                                                        <option value="" selected>Pilih</option>
                                                                        <option value="pretest">Pre Test</option>
                                                                        <option value="posttest">Post Test</option>
                                                                        <option value="ujian">Ujian Materi</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="durasi_soal">Durasi (dalam menit)</label>
                                                                    <input type="number" class="form-control" name="durasi_soal" id="durasi_soal" placeholder="Masukkan Durasi Soal">
                                                                </div>
                                                            </div>
                                                            
                                                            <button type="submit" class="btn btn-success">Simpan Konten</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Daftar Konten Section -->
                                <div id="listKontenSection" style="display: none;">
                                    <div class="section-body">
                                        <div class="mt-4 row">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h4>{{ __('Daftar Konten Diklat ') }} ( <span id="mataDiklatNameView"></span> )</h4>
                                                        <div>
                                                            <button id="cancelListKontenBtn" class="btn btn-danger">
                                                                {{ __('Tutup List') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="stripe row-border order-column nowrap" id="tableListKonten">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="2%"></th>
                                                                        <th width="1%">{{ __('No') }}</th>
                                                                        <th>{{ __('Nama Konten') }}</th>
                                                                        <th>{{ __('Tipe Konten') }}</th>
                                                                        <th>{{ __('Durasi') }}</th>
                                                                        <th>{{ __('Aksi') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   
                                                                    <tr>
                                                                        <td width="2%"></td>
                                                                        <td width="1%"></td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                    </tr>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
@endsection

@push('js')
    <script>
        function deleteMataDiklat(id) {
            $("#deleteForm").attr("action", "{{ url('admin/matadiklat-delete') }}" + "/" + id)
        }

        // var tambah matadikat
        const showTambahMataDiklatFormBtn = document.getElementById('showTambahMataDiklatFormBtn');
        const mataDiklatTableSection = document.getElementById('mataDiklatTableSection');
        const tambahMataDiklatFormSection = document.getElementById('tambahMataDiklatFormSection');
        const cancelTambahMataDiklatBtn = document.getElementById('cancelTambahMataDiklatBtn');

        // var edit matadiklat
        const editMataDiklatFormSection = document.getElementById('editMataDiklatFormSection');
        const cancelEditMataDiklatBtn = document.getElementById('cancelEditMataDiklatBtn');
        
        // var tambah kontendiklat
        const tambahKontenFormSection = document.getElementById('tambahKontenFormSection');
        const cancelTambahKontenBtn = document.getElementById('cancelTambahKontenBtn');
        const mataDiklatName = document.getElementById('mataDiklatName');
        const mataDiklatIdInput = document.getElementById('mataDiklatId');
        
        // var lihat kontendiklat
        const listKontenSection = document.getElementById('listKontenSection');
        const cancelListKontenBtn = document.getElementById('cancelListKontenBtn');
        const mataDiklatNameView = document.getElementById('mataDiklatNameView');

        // js tambah matadiklat
        showTambahMataDiklatFormBtn.addEventListener('click', () => {
            mataDiklatTableSection.style.display = 'none';
            tambahMataDiklatFormSection.style.display = 'block';
            if(tambahKontenFormSection.style.display = 'block'){
                tambahKontenFormSection.style.display = 'none';
            }
            if(listKontenSection.style.display = 'block'){
                listKontenSection.style.display = 'none';
            }
        });
    
        cancelTambahMataDiklatBtn.addEventListener('click', () => {
            tambahMataDiklatFormSection.style.display = 'none';
            mataDiklatTableSection.style.display = 'block';
        });
        
        cancelTambahMataDiklatBtn2.addEventListener('click', () => {
            tambahMataDiklatFormSection.style.display = 'none';
            mataDiklatTableSection.style.display = 'block';
        });

        // js edit matadiklat       
        function editMataDiklat(id) {
            mataDiklatTableSection.style.display = 'none';
            editMataDiklatFormSection.style.display = 'block';
            if(tambahKontenFormSection.style.display = 'block'){
                tambahKontenFormSection.style.display = 'none';
            }
            if(listKontenSection.style.display = 'block'){
                listKontenSection.style.display = 'none';
            }
        
            fetch(`/admin/matadiklat-edit/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_angkatan').value = data.id_angkatan;
                    document.getElementById('edit_mata_diklat').value = data.mata_diklat;
                    document.getElementById('edit_publikasi').value = data.publikasi;
        
                    document.getElementById('editMataDiklatForm').action = `/admin/matadiklat-update/${id}`;
                });
        }
        
        cancelEditMataDiklatBtn.addEventListener('click', () => {
            editMataDiklatFormSection.style.display = 'none';
            mataDiklatTableSection.style.display = 'block';
        });
        
        cancelEditMataDiklatBtn2.addEventListener('click', () => {
            editMataDiklatFormSection.style.display = 'none';
            mataDiklatTableSection.style.display = 'block';
        });

        // js tambah kontendiklat
        document.querySelectorAll('.showTambahKontenFormBtn').forEach(button => {
            button.addEventListener('click', () => {
                const mataDiklat = button.getAttribute('data-mata-diklat');
                const mataDiklatId = button.getAttribute('data-id');
                mataDiklatName.textContent = mataDiklat;
                mataDiklatIdInput.value = mataDiklatId;
                tambahKontenFormSection.style.display = 'block';
                if(listKontenSection.style.display = 'block'){
                    listKontenSection.style.display = 'none';
                }
            });
        });
    
        cancelTambahKontenBtn.addEventListener('click', () => {
            tambahKontenFormSection.style.display = 'none';
        });
        
        document.getElementById("tipe_konten").addEventListener("change", function() {
            var value = this.value;
            document.getElementById("form-video").style.display = (value === "1") ? "block" : "none";
            document.getElementById("form-pdf").style.display = (value === "2") ? "block" : "none";
            document.getElementById("form-soal").style.display = (value === "3") ? "block" : "none";
        });
        
        // js lihat kontendiklat
        document.querySelectorAll('.showListKontenBtn').forEach(button => {
            button.addEventListener('click', () => {
                const mataDiklatView = button.getAttribute('data-mata-diklat-view');
                const mataDiklatIdView = button.getAttribute('data-id-view');
                mataDiklatNameView.textContent = mataDiklatView;
                listKontenSection.style.display = 'block';
                $('#tableListKonten').DataTable().columns.adjust().draw();
                if(tambahKontenFormSection.style.display = 'block'){
                    tambahKontenFormSection.style.display = 'none';
                }
                
                fetch(`/admin/kontendiklat/${mataDiklatIdView}`)
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.querySelector('#tableListKonten tbody');
                        tableBody.innerHTML = '';
                        
                        if (data.length === 0) {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td colspan="5" class="text-center">Belum ada konten</td>
                            `;
                            tableBody.appendChild(row);
                        } else {
                            data.forEach((konten, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td></td>
                                    <td>${index + 1}</td>
                                    <td>${konten.nama_konten}</td>
                                    <td>Materi ${konten.id_tipe_konten}</td>
                                    <td>${konten.durasi} Menit</td>
                                    <td>
                                      ${konten.button_url 
                                            ? `<a href="${konten.button_url}" class="btn btn-success btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i> 
                                            </a>` 
                                            : ''}
                                    </td>
                                `;
                                tableBody.appendChild(row);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
                
                
            });
        });
    
        cancelListKontenBtn.addEventListener('click', () => {
            listKontenSection.style.display = 'none';
        });
        
        // js active row
        document.querySelectorAll('.showTambahKontenFormBtn, .showListKontenBtn, .btn-warning, .btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.active-row').forEach(row => row.classList.remove('active-row'));
        
                let row = button.closest('tr');
                if (row) {
                    row.classList.add('active-row');
                }
            });
        });
    </script>
@endpush