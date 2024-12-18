@extends('layouts.app')


@section('content')

<!-- main-area -->
<main class="main-area fix">

    <!-- dashboard-area -->
    <section class="dashboard__area section-pb-120">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-3">
                    <div class="regis__sidebar-wrap">
                        <div class="dashboard__sidebar-title mb-20">
                            <h6 class="title" style="font-size: 18px;text-align: center;">{{ __('Syarat Foto') }}</h6>
                        </div>
                        <p style="text-align: center;">
                            Setelah melakukan pendaftaran, silahkan unggah foto anda untuk keperluan sertifikat
                        </p>
                        
                        <h6 style="margin: 20px 0;">Syarat & Ketentuan :</h6>
                        <ol style="padding-left: 20px; margin: 0; list-style-type: decimal;">
                            <li>{{ __('Berwarna') }}</li>
                            <li>{{ __('Latar belakang berwarna merah') }}</li>
                            <li>{{ __('Pakaian bebas rapi') }}</li>
                            <li>{{ __('Foto berukuran 4x6') }}</li>
                            <li>{{ __('Maksimal ukuran 500Kb') }}</li>
                        </ol>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="regis__content-wrap">
                        <div class="dashboard__content-title">
                            <h4 class="title" style="text-align: center;">{{ __('Form Pendaftaran Diklat') }}</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="instructor__profile-form-wrap">
                                    <form action="{{route('peserta.postdaftardiklat')}}" method="POST" enctype="multipart/form-data" class="instructor__profile-form">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="id_diklat" value="{{ $diklat->id_diklat }}">
                                        <input type="file" name="avatar" id="avatar" hidden>
                                        <input type="file" name="cover" id="cover-img" hidden>

                                        <div class="row">

                                            <!-- BIODATA DIRI -->
                                            <div class="col-md-6">
                                                <h5 class="title" style="text-align: center;">{{ __('Biodata Diri') }}</h5>
                                                <div class="form-grp">
                                                    <label for="nip">{{ __('NIP') }} <code>*</code></label>
                                                    <input id="nip" name="nip" type="text" value="{{ Auth::user()->nip }}" placeholder="{{ __('NIP') }}" readonly class="readonly-input">
                                                    <x-frontend.validation-error name="nip" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="name">{{ __('Nama Lengkap') }} <code>*</code></label>
                                                    <input id="name" name="name" type="text" value="{{ Auth::user()->name }}" placeholder="{{ __('Nama Lengkap') }}" readonly class="readonly-input">
                                                    <x-frontend.validation-error name="name" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="email">{{ __('Email') }} <code>*</code></label>
                                                    <input id="email" name="email" type="email" value="{{ Auth::user()->email }}" placeholder="{{ __('Email') }}" readonly class="readonly-input">
                                                    <x-frontend.validation-error name="email" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="notelp">{{ __('Nomor Telepon (Aktif Whatsapp) ') }} <code>*</code></label>
                                                    <input id="notelp" name="notelp" type="text" value="{{ Auth::user()->no_telp }}" placeholder="{{ __('Nomor Telepon') }}" readonly class="readonly-input">
                                                    <x-frontend.validation-error name="notelp" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="gender">{{ __('Jenis Kelamin') }} <code>*</code></label>
                                                    <!-- Visible field displaying the selected gender -->
                                                    <input id="gender_display" type="text" 
                                                        value="{{ $datapeserta->jenis_kelamin == 'M' ? __('Laki-laki') : __('Perempuan') }}" 
                                                        readonly class="readonly-input">
                                                    <!-- Hidden field to submit gender value -->
                                                    <input type="hidden" name="gender" value="{{ $datapeserta->jenis_kelamin }}">
                                                    <x-frontend.validation-error name="gender" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="tempatlahir">{{ __('Tempat Lahir') }} <code>*</code></label>
                                                    <input id="tempatlahir" name="tempatlahir" type="text" value="{{ $datapeserta->tempat_lahir }}" placeholder="{{ __('Tempat Lahir') }}" readonly class="readonly-input">
                                                    <x-frontend.validation-error name="tempatlahir" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="tanggallahir">{{ __('Tanggal Lahir') }} <code>*</code></label>
                                                    <input id="tanggallahir" name="tanggallahir" type="date" value="{{ $datapeserta->tgl_lahir }}" placeholder="{{ __('Tanggal Lahir') }}" readonly class="readonly-input">
                                                    <x-frontend.validation-error name="tanggallahir" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="address">{{ __('Alamat') }} <code>*</code></label>
                                                    <textarea id="address" name="address" placeholder="{{ __('Alamat') }}" maxlength="100" oninput="limitText(this, 100)" readonly class="readonly-input">{{ $datapeserta->alamat_detail }}</textarea>
                                                    <small style="font-size: 0.8em; font-style: italic; color: #6c757d; float: right;">maksimal 100 karakter</small>
                                                    <x-frontend.validation-error name="address" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="kota">{{ __('Kota/Kabupaten') }} <code>*</code></label>
                                                    <!-- Visible field displaying nama_kota -->
                                                    <input id="kota_display" type="text" 
                                                        value="{{ $datapeserta->kota->nama_kota }}" 
                                                        readonly class="readonly-input">
                                                    <!-- Hidden field to submit id_kota -->
                                                    <input type="hidden" name="kota" value="{{ $datapeserta->kota->id_kota }}">
                                                    <x-frontend.validation-error name="kota" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="provinsi">{{ __('Provinsi') }} <code>*</code></label>
                                                    <!-- Visible field displaying nama_provinsi -->
                                                    <input id="provinsi_display" type="text" 
                                                        value="{{ $datapeserta->kota->provinsi->nama_provinsi }}" 
                                                        readonly class="readonly-input">
                                                    <!-- Hidden field to submit id_provinsi -->
                                                    <input type="hidden" name="provinsi" value="{{ $datapeserta->kota->provinsi->id_provinsi }}">
                                                    <x-frontend.validation-error name="provinsi" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="facebook">{{ __('Facebook') }}</label>
                                                    <input id="facebook" name="facebook" type="text" value="" placeholder="{{ __('Facebook') }}">
                                                    <x-frontend.validation-error name="facebook" />
                                                </div>
                                                <div class="form-grp">
                                                    <label for="slug">File Persyaratan<span class="text-danger">*</span></label>
                                                    <input type="file" id="imagepath" name="imagepath" value="" placeholder="" class="form-control">  
                                                    <x-frontend.validation-error name="imagepath" />
                                                </div>
                                            </div>

                                            <!-- INSTANSI -->
                                            <div class="col-md-6">
                                                <h5 class="title" style="text-align: center;">{{ __('Biodata Instansi') }}</h5>
                                                <div class="form-grp">
                                                    <label for="instansi">{{ __('Instansi') }} <code>*</code></label>
                                                    <select name="instansi" id="instansi" class="form-select">
                                                        <option value="">{{ __('Pilih Instansi') }}</option>
                                                        @foreach($instansis as $instansi)
                                                            <option value="{{ $instansi->id_instansi }}">{{ $instansi->nama_instansi }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-frontend.validation-error name="instansi" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="alamatinstansi">{{ __('Alamat Instansi') }} <code>*</code></label>
                                                    <textarea id="alamatinstansi" name="alamatinstansi" placeholder="{{ __('Alamat Instansi') }}" maxlength="100" oninput="limitText(this, 100)"></textarea>
                                                    <small style="font-size: 0.8em; font-style: italic; color: #6c757d; float: right;">maksimal 100 karakter</small>
                                                    <x-frontend.validation-error name="alamatinstansi" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="provinsiinstansi">{{ __('Provinsi') }} <code>*</code></label>
                                                    <select name="provinsiinstansi" id="provinsiinstansi" class="form-select">
                                                        <option value="">{{ __('Pilih') }}</option>
                                                        @foreach($provinsis as $provinsi)
                                                            <option value="{{ $provinsi->id_provinsi }}">{{ $provinsi->nama_provinsi }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-frontend.validation-error name="provinsiinstansi" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="kotainstansi">{{ __('Kota/Kabupaten') }} <code>*</code></label>
                                                    <select name="kotainstansi" id="kotainstansi" class="form-select">
                                                        <option value="">{{ __('Pilih') }}</option>
                                                        
                                                    </select>
                                                    <x-frontend.validation-error name="kotainstansi" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="notelpinstansi">{{ __('Nomor Telepon Kantor') }} <code>*</code></label>
                                                    <input id="notelpinstansi" name="notelpinstansi" type="text" value="{{ old('notelpinstansi') }}" placeholder="{{ __('Nomor Telepon Kantor') }}">
                                                    <x-frontend.validation-error name="notelpinstansi" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="fax">{{ __('Fax') }}</label>
                                                    <input id="fax" name="fax" type="text" value="{{ old('fax') }}" placeholder="{{ __('Fax') }}">
                                                    <x-frontend.validation-error name="fax" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="website">{{ __('Website') }}</label>
                                                    <input id="website" name="website" type="text" value="{{ old('website') }}" placeholder="{{ __('Website') }}">
                                                    <x-frontend.validation-error name="website" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="jabpeserta">{{ __('Jabatan Peserta') }} <code>*</code></label>
                                                    <select name="jabpeserta" id="jabpeserta" class="form-select">
                                                        <option value="">{{ __('Pilih Jabatan Peserta') }}</option>
                                                        @foreach($jabatans as $jabatan)
                                                            <option value="{{ $jabatan->id_jabatan }}">{{ $jabatan->nama_jabatan }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-frontend.validation-error name="jabpeserta" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="unitkerja">{{ __('Bagian / Bidang Unit Kerja') }} <code>*</code></label>
                                                    <input id="unitkerja" name="unitkerja" type="text" value="{{ old('unitkerja') }}" placeholder="{{ __('Bagian / Bidang Unit Kerja') }}">
                                                    <x-frontend.validation-error name="unitkerja" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="golpeserta">{{ __('Golongan Peserta') }} <code>*</code></label>
                                                    <select name="golpeserta" id="golpeserta" class="form-select">
                                                        <option value="">{{ __('Pilih Golongan Peserta') }}</option>
                                                        @foreach($golongans as $golongan)
                                                            <option value="{{ $golongan->id_golongan }}">{{ $golongan->nama_golongan }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-frontend.validation-error name="golpeserta" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="namaatasan">{{ __('Nama Atasan') }} <code>*</code></label>
                                                    <input id="namaatasan" name="namaatasan" type="text" value="{{ old('namaatasan') }}" placeholder="{{ __('Nama Atasan') }}">
                                                    <x-frontend.validation-error name="namaatasan" />
                                                </div>

                                                <div class="form-grp">
                                                    <label for="notelpatasan">{{ __('Nomor Telepon Atasan') }} <code>*</code></label>
                                                    <input id="notelpatasan" name="notelpatasan" type="text" value="{{ old('notelpatasan') }}" placeholder="{{ __('Nomor Telepon Atasan') }}">
                                                    <x-frontend.validation-error name="notelpatasan" />
                                                </div>
                                               

                                            </div>


                                        </div>

                                        <div class="submit-btn mt-25" style="display: flex; justify-content: center;">
                                            <!-- <a href="#" class="btn">{{ __('Daftar') }}</a> -->
                                            <button type="submit" class="btn">{{ __('Daftar') }}</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- regis-area-end -->

</main>
<!-- main-area-end -->

@endsection