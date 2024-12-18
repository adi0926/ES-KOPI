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
                            <h4 class="title" style="text-align: center;">{{ __('Form Pendaftaran Akun ES-KOPI') }}</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="instructor__profile-form-wrap">
                                    <form action="{{route('postpendaftaran')}}" method="POST" enctype="multipart/form-data" class="instructor__profile-form">
                                        @csrf
                                        @method('POST')
                                        <input type="file" name="avatar" id="avatar" hidden>
                                        <input type="file" name="cover" id="cover-img" hidden>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="nip">{{ __('NIP') }} <code>*</code></label>
                                                    <input id="nip" name="nip" type="text" value="{{ old('nip') }}" placeholder="{{ __('NIP') }}">
                                                    <x-frontend.validation-error name="nip" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="email">{{ __('Email') }} <code>*</code></label>
                                                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                                                    <x-frontend.validation-error name="email" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="name">{{ __('Nama Lengkap') }} <code>*</code></label>
                                                    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="{{ __('Nama Lengkap') }}">
                                                    <x-frontend.validation-error name="name" />
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="password">{{ __('Kata Sandi') }} <code>*</code></label>
                                                    <input id="password" name="password" type="password" value="" placeholder="{{ __('Kata Sandi') }}">
                                                    <x-frontend.validation-error name="password" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="notelp">{{ __('Nomor Telepon (Aktif Whatsapp) ') }} <code>*</code></label>
                                                    <input id="notelp" name="notelp" type="text" value="{{ old('notelp') }}" placeholder="{{ __('Nomor Telepon') }}">
                                                    <x-frontend.validation-error name="notelp" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="passwordconfirm">{{ __('Konfirmasi Kata Sandi') }} <code>*</code></label>
                                                    <input id="passwordconfirm" name="passwordconfirm" type="password" value="" placeholder="{{ __('Konfirmasi Kata Sandi') }}">
                                                    <x-frontend.validation-error name="passwordconfirm" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="gender">{{ __('Jenis Kelamin') }} <code>*</code></label>
                                                    <select name="gender" id="gender" class="form-select">
                                                        <option value="">{{ __('Pilih') }}</option>
                                                        <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>{{ __('Laki-laki') }}</option>
                                                        <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>{{ __('Perempuan') }}</option>
                                                    </select>
                                                    <x-frontend.validation-error name="gender" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="address">{{ __('Alamat') }} <code>*</code></label>
                                                    <textarea id="address" name="address" placeholder="{{ __('Alamat') }}">{{ old('address') }}</textarea>
                                                    <x-frontend.validation-error name="address" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="tempatlahir">{{ __('Tempat Lahir') }} <code>*</code></label>
                                                    <input id="tempatlahir" name="tempatlahir" type="text" value="{{ old('tempatlahir') }}" placeholder="{{ __('Tempat Lahir') }}">
                                                    <x-frontend.validation-error name="tempatlahir" />
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="provinsi">{{ __('Provinsi') }} <code>*</code></label>
                                                    <select name="provinsi" id="provinsi" class="form-select">
                                                        <option value="">{{ __('Pilih') }}</option>
                                                        @foreach($provinsis as $provinsi)
                                                            <option value="{{ $provinsi->id_provinsi }}">{{ $provinsi->nama_provinsi }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-frontend.validation-error name="provinsi" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="tanggallahir">{{ __('Tanggal Lahir') }} <code>*</code></label>
                                                    <input id="tanggallahir" name="tanggallahir" type="date" value="{{ old('tanggallahir') }}" placeholder="{{ __('Tanggal Lahir') }}">
                                                    <x-frontend.validation-error name="tanggallahir" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-grp">
                                                    <label for="kota">{{ __('Kota/Kabupaten') }} <code>*</code></label>
                                                    <select name="kota" id="kota" class="form-select">
                                                        <option value="">{{ __('Pilih') }}</option>
                                                        
                                                    </select>
                                                    <x-frontend.validation-error name="kota" />
                                                </div>
                                            </div>

                                        </div>

                                        <div class="submit-btn mt-25" style="display: flex; justify-content: center;">
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