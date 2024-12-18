<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\SertifikatDiklatController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DigitalSignatureController;
use App\Http\Controllers\Admin\UserLevelController;
use App\Http\Controllers\Admin\RoleLevelController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\Admin\BankSoalController;
use App\Http\Controllers\Admin\MasterMataDiklatController;
use App\Http\Controllers\Admin\DiklatController;
use App\Http\Controllers\Admin\UjianController;
use App\Http\Controllers\Admin\MasterKategoriDiklatController;
use App\Http\Controllers\Admin\PretestController;
use App\Http\Controllers\Admin\PostestController;
use App\Http\Controllers\Admin\EvaluasiPenyelenggaraController;
use App\Http\Controllers\Admin\EvaluasiPengajarController;
use App\Http\Controllers\Admin\PenilaianController;
//use App\Http\Controllers\Admin\SertifikatController2;
use App\Http\Controllers\Admin\TandaTanganController;
use App\Http\Controllers\Admin\AkunZoomController;
use App\Http\Controllers\Admin\VirtualClassController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PesertadiklatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\GolonganController;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Admin\KotaController;
use App\Http\Controllers\Admin\LaporanController;

use App\Http\Controllers\Global\CloudStorageController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;


Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    /* Start admin auth route */
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('store-login', [AuthenticatedSessionController::class, 'store'])->name('store-login');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forget-password', [PasswordResetLinkController::class, 'custom_forget_password'])->name('forget-password');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'custom_reset_password_page'])->name('password.reset');
    Route::post('/reset-password-store/{token}', [NewPasswordController::class, 'custom_reset_password_store'])->name('password.reset-store');
    /* End admin auth route */

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard']);
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        
        Route::get('getMataDiklat/{id_diklat}', [BankSoalController::class, 'getMataDiklat'])->name('getMataDiklat');
        Route::get('getAngkatan/{id_diklat}', [SertifikatDiklatController::class, 'getAngkatan'])->name('getAngkatan');
        Route::get('/download-template', [SertifikatDiklatController::class, 'downloadCSVTemplate'])->name('download.template');
        Route::post('/upload-csv', [SertifikatDiklatController::class, 'uploadCSV'])->name('upload-csv');
        
        
        Route::controller(UserLevelController::class)->group(function () {
            Route::get('user-level', [UserLevelController::class, 'user_level'])->name('user-level');
            Route::get('add-user-level', [UserLevelController::class, 'add_user_level'])->name('add-user-level');
            Route::post('user-level-store', [UserLevelController::class, 'user_level_store'])->name('user-level-store');
            Route::get('edit-user-level/{id}', [UserLevelController::class, 'edit_user_level'])->name('edit-user-level');
            Route::post('user-level-update', [UserLevelController::class, 'user_level_update'])->name('user-level-update');
            Route::delete('user-level-delete/{id}', [UserLevelController::class, 'user_level_delete'])->name('user-level-delete');
        });

        Route::controller(RoleLevelController::class)->group(function () {
            Route::get('role-level', [RoleLevelController::class, 'role_level'])->name('role-level');
            Route::get('add-role-level', [RoleLevelController::class, 'add_role_level'])->name('add-role-level');
            Route::post('role-level-store', [RoleLevelController::class, 'role_level_store'])->name('role-level-store');
            Route::get('edit-role-level/{id}', [RoleLevelController::class, 'edit_role_level'])->name('edit-role-level');
            Route::post('role-level-update', [RoleLevelController::class, 'role_level_update'])->name('role-level-update');
            Route::delete('role-level-delete/{id}', [RoleLevelController::class, 'role_level_delete'])->name('role-level-delete');
        });
        
        Route::controller(BannerController::class)->group(function () {
            Route::get('banner', [BannerController::class, 'banner'])->name('banner');
            Route::get('add-banner', [BannerController::class, 'add_banner'])->name('add-banner');
            Route::post('banner-store', [BannerController::class, 'banner_store'])->name('banner-store');
            Route::get('edit-banner/{id}', [BannerController::class, 'edit_banner'])->name('edit-banner');
            Route::post('banner-update', [BannerController::class, 'banner_update'])->name('banner-update');
            Route::delete('banner-delete/{id}', [BannerController::class, 'banner_delete'])->name('banner-delete');
        });

        Route::controller(PesertaController::class)->group(function () {
            Route::get('peserta', [PesertaController::class, 'peserta'])->name('peserta');
            Route::get('add-peserta', [PesertaController::class, 'add_peserta'])->name('add-peserta');
            Route::post('peserta-store', [PesertaController::class, 'peserta_store'])->name('peserta-store');
            Route::get('edit-peserta/{id}', [PesertaController::class, 'edit_peserta'])->name('edit-peserta');
            Route::post('peserta-update', [PesertaController::class, 'peserta_update'])->name('peserta-update');
            Route::delete('peserta-delete/{id}', [PesertaController::class, 'peserta_delete'])->name('peserta-delete');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('user', [UserController::class, 'show'])->name('user');
            Route::get('add-user', [UserController::class, 'add_user'])->name('add-user');
            Route::post('user-store', [UserController::class, 'user_store'])->name('user-store');
            Route::get('edit-user/{id}', [UserController::class, 'edit_user'])->name('edit-user');
            Route::post('user-update', [UserController::class, 'user_update'])->name('user-update');
            Route::delete('user-delete/{id}', [UserController::class, 'user_delete'])->name('user-delete');
        });

        Route::controller(LevelController::class)->group(function () {
            Route::get('level', [LevelController::class, 'level'])->name('level');
            Route::get('add-level', [LevelController::class, 'add_level'])->name('add-level');
            Route::post('level-store', [LevelController::class, 'level_store'])->name('level-store');
            Route::get('edit-level/{id}', [LevelController::class, 'edit_level'])->name('edit-level');
            Route::post('level-update', [LevelController::class, 'level_update'])->name('level-update');
            Route::delete('level-delete/{id}', [LevelController::class, 'level_delete'])->name('level-delete');
        });

        Route::controller(InstansiController::class)->group(function () {
            Route::get('instansi', [InstansiController::class, 'instansi'])->name('instansi');
            Route::get('add-instansi', [InstansiController::class, 'add_instansi'])->name('add-instansi');
            Route::post('instansi-store', [InstansiController::class, 'instansi_store'])->name('instansi-store');
            Route::get('edit-instansi/{id}', [InstansiController::class, 'edit_instansi'])->name('edit-instansi');
            Route::post('instansi-update', [InstansiController::class, 'instansi_update'])->name('instansi-update');
            Route::delete('instansi-delete/{id}', [InstansiController::class, 'instansi_delete'])->name('instansi-delete');
        });

        Route::controller(JabatanController::class)->group(function () {
            Route::get('jabatan', [JabatanController::class, 'jabatan'])->name('jabatan');
            Route::get('add-jabatan', [JabatanController::class, 'add_jabatan'])->name('add-jabatan');
            Route::post('jabatan-store', [JabatanController::class, 'jabatan_store'])->name('jabatan-store');
            Route::get('edit-jabatan/{id}', [JabatanController::class, 'edit_jabatan'])->name('edit-jabatan');
            Route::post('jabatan-update', [JabatanController::class, 'jabatan_update'])->name('jabatan-update');
            Route::delete('jabatan-delete/{id}', [JabatanController::class, 'jabatan_delete'])->name('jabatan-delete');
        });

        Route::controller(GolonganController::class)->group(function () {
            Route::get('golongan', [GolonganController::class, 'golongan'])->name('golongan');
            Route::get('add-golongan', [GolonganController::class, 'add_golongan'])->name('add-golongan');
            Route::post('golongan-store', [GolonganController::class, 'golongan_store'])->name('golongan-store');
            Route::get('edit-golongan/{id}', [GolonganController::class, 'edit_golongan'])->name('edit-golongan');
            Route::post('golongan-update', [GolonganController::class, 'golongan_update'])->name('golongan-update');
            Route::delete('golongan-delete/{id}', [GolonganController::class, 'golongan_delete'])->name('golongan-delete');
        });

        Route::controller(ProvinsiController::class)->group(function () {
            Route::get('provinsi', [ProvinsiController::class, 'provinsi'])->name('provinsi');
            Route::get('add-provinsi', [ProvinsiController::class, 'add_provinsi'])->name('add-provinsi');
            Route::post('provinsi-store', [ProvinsiController::class, 'provinsi_store'])->name('provinsi-store');
            Route::get('edit-provinsi/{id}', [ProvinsiController::class, 'edit_provinsi'])->name('edit-provinsi');
            Route::post('provinsi-update', [ProvinsiController::class, 'provinsi_update'])->name('provinsi-update');
            Route::delete('provinsi-delete/{id}', [ProvinsiController::class, 'provinsi_delete'])->name('provinsi-delete');
        });

        Route::controller(KotaController::class)->group(function () {
            Route::get('kota', [KotaController::class, 'kota'])->name('kota');
            Route::get('add-kota', [KotaController::class, 'add_kota'])->name('add-kota');
            Route::post('kota-store', [KotaController::class, 'kota_store'])->name('kota-store');
            Route::get('edit-kota/{id}', [KotaController::class, 'edit_kota'])->name('edit-kota');
            Route::post('kota-update', [KotaController::class, 'kota_update'])->name('kota-update');
            Route::delete('kota-delete/{id}', [KotaController::class, 'kota_delete'])->name('kota-delete');
        });

        Route::controller(BankSoalController::class)->group(function () {
            Route::get('bank-soal', [BankSoalController::class, 'bank_soal'])->name('bank-soal');
            Route::get('add-bank-soal', [BankSoalController::class, 'add_bank_soal'])->name('add-bank-soal');
            Route::post('bank-soal-store', [BankSoalController::class, 'bank_soal_store'])->name('bank-soal-store');
            Route::get('edit-bank-soal/{id}', [BankSoalController::class, 'edit_bank_soal'])->name('edit-bank-soal');
            Route::post('bank-soal-update', [BankSoalController::class, 'bank_soal_update'])->name('bank-soal-update');
            Route::delete('bank-soal-delete/{id}', [BankSoalController::class, 'bank_soal_delete'])->name('bank-soal-delete');
            
            Route::get('edit-soal/{idbank}/{idsoal}', [BankSoalController::class, 'edit_soal'])->name('edit-soal');
            Route::post('soal-update', [BankSoalController::class, 'soal_update'])->name('soal-update');
            Route::get('list-soal/{id}', [BankSoalController::class, 'list_soal'])->name('list-soal');
            Route::get('add-soal/{id}', [BankSoalController::class, 'add_soal'])->name('add-soal');
            Route::post('soal-store', [BankSoalController::class, 'soal_store'])->name('soal-store');
            Route::delete('soal-delete/{id_soal}/{id_bank_soal}', [BankSoalController::class, 'soal_delete'])->name('soal-delete');
        });
        
        Route::controller(LaporanController::class)->group(function () {
            Route::get('laporan', [LaporanController::class, 'laporan'])->name('laporan');
        });

        Route::controller(DigitalSignatureController::class)->group(function () {
            Route::get('digital-signature', [DigitalSignatureController::class, 'digitalSignature'])->name('digital-signature');
            Route::get('getFilteredSign', [DigitalSignatureController::class, 'getFilteredSign'])->name('getFilteredSign');
            Route::post('signature-request', [DigitalSignatureController::class, 'sendRequest'])->name('signature-request');
        });

        Route::controller(MasterMataDiklatController::class)->group(function () {
            Route::get('master-matadiklat', [MasterMataDiklatController::class, 'master_matadiklat'])->name('master-matadiklat');
            Route::get('add-master-matadiklat', [MasterMataDiklatController::class, 'add_master_matadiklat'])->name('add-master-matadiklat');
            Route::post('master-matadiklat-store', [MasterMataDiklatController::class, 'master_matadiklat_store'])->name('master-matadiklat-store');
            Route::get('edit-master-matadiklat/{id}', [MasterMataDiklatController::class, 'edit_master_matadiklat'])->name('edit-master-matadiklat');
            Route::post('master-matadiklat-update', [MasterMataDiklatController::class, 'master_matadiklat_update'])->name('master-matadiklat-update');
            Route::delete('master-matadiklat-delete/{id}', [MasterMataDiklatController::class, 'master_matadiklat_delete'])->name('master-matadiklat-delete');
        });

        Route::controller(DiklatController::class)->group(function () {
            Route::patch('diklat-publish/{id}', [DiklatController::class, 'publish'])->name('diklat-publish');

            Route::get('diklat', [DiklatController::class, 'diklat'])->name('diklat');
            Route::get('add-diklat', [DiklatController::class, 'add_diklat'])->name('add-diklat');
            Route::post('diklat-store', [DiklatController::class, 'diklat_store'])->name('diklat-store');
            Route::get('edit-diklat/{id}', [DiklatController::class, 'edit_diklat'])->name('edit-diklat');
            Route::post('diklat-update', [DiklatController::class, 'diklat_update'])->name('diklat-update');
            Route::delete('diklat-delete/{id}', [DiklatController::class, 'diklat_delete'])->name('diklat-delete');
            
            Route::get('diklatangkatan/{id}', [DiklatController::class, 'diklatangkatan'])->name('diklatangkatan');
            Route::post('diklatangkatan-store', [DiklatController::class, 'diklatangkatan_store'])->name('diklatangkatan-store');
            Route::delete('diklatangkatan-delete/{id}', [DiklatController::class, 'diklatangkatan_delete'])->name('diklatangkatan-delete');
            Route::get('diklatangkatan-edit/{id}', [DiklatController::class, 'diklatangkatan_edit'])->name('diklatangkatan-edit');
            Route::post('diklatangkatan-update/{id}', [DiklatController::class, 'diklatangkatan_update'])->name('diklatangkatan-update');
            
            Route::get('matadiklat/{id}', [DiklatController::class, 'matadiklat'])->name('matadiklat');
            Route::post('matadiklat-store', [DiklatController::class, 'matadiklat_store'])->name('matadiklat-store');
            Route::delete('matadiklat-delete/{id}', [DiklatController::class, 'matadiklat_delete'])->name('matadiklat-delete');
            Route::get('matadiklat-edit/{id}', [DiklatController::class, 'matadiklat_edit'])->name('matadiklat-edit');
            Route::put('matadiklat-update/{id}', [DiklatController::class, 'matadiklat_update'])->name('matadiklat-update');
            
            
            Route::get('kontendiklat/{id}', [DiklatController::class, 'kontendiklat'])->name('kontendiklat');
            Route::post('kontendiklat-store', [DiklatController::class, 'kontendiklat_store'])->name('kontendiklat-store');
            Route::get('viewkonten-video', [DiklatController::class, 'viewkonten_video'])->name('viewkonten-video');
            Route::get('viewkonten-pdf/{id}', [DiklatController::class, 'viewkonten_pdf'])->name('viewkonten-pdf');
            Route::get('editkonten-pdf/{idmateri}', [DiklatController::class, 'editkonten_pdf'])->name('editkonten-pdf');
            Route::delete('deletekonten-pdf/{idmateri}', [DiklatController::class, 'deletekonten_pdf'])->name('deletekonten-pdf');
            
            Route::get('viewkonten-soal/{id}', [DiklatController::class, 'viewkonten_soal'])->name('viewkonten-soal');
            Route::get('addkonten-soal/{id}', [DiklatController::class, 'addkonten_soal'])->name('addkonten-soal');
            Route::post('storekonten-soal', [DiklatController::class, 'storekonten_soal'])->name('storekonten-soal');
            Route::get('editkonten-soal/{idmateri}/{idsoal}', [DiklatController::class, 'editkonten_soal'])->name('editkonten-soal');
            Route::post('updatekonten-soal', [DiklatController::class, 'updatekonten_soal'])->name('updatekonten-soal');
            Route::delete('deletekonten-soal/{idmateri}/{idsoal}', [DiklatController::class, 'deletekonten_soal'])->name('deletekonten-soal');


            Route::get('viewkonten-evalpenyelenggara/{id}', [DiklatController::class, 'viewkonten_evalpenyelenggara'])->name('viewkonten-evalpenyelenggara');
            Route::get('viewkonten-evalpengajar/{id}', [DiklatController::class, 'viewkonten_evalpengajar'])->name('viewkonten-evalpengajar');

            Route::post('storecopykonten-soal', [DiklatController::class, 'storecopykonten_soal'])->name('storecopykonten-soal');
            Route::get('fetch-soal/{id_bank_soal}', [DiklatController::class, 'fetch_soal'])->name('fetch-soal');

            Route::get('salinkonten-soal/{jeniskonten}/{id}', [DiklatController::class, 'salinkonten_soal'])->name('salinkonten-soal');
        });

        Route::controller(UjianController::class)->group(function () {
            Route::get('ujian', [UjianController::class, 'ujian'])->name('ujian');
            Route::get('add-ujian', [UjianController::class, 'add_ujian'])->name('add-ujian');
            Route::post('ujian-store', [UjianController::class, 'ujian_store'])->name('ujian-store');
            Route::get('edit-ujian/{id}', [UjianController::class, 'edit_ujian'])->name('edit-ujian');
            Route::post('ujian-update', [UjianController::class, 'ujian_update'])->name('ujian-update');
            Route::delete('ujian-delete/{id}', [UjianController::class, 'ujian_delete'])->name('ujian-delete');
        });

        Route::controller(MasterKategoriDiklatController::class)->group(function () {
            Route::get('master-kategori-diklat', [MasterKategoriDiklatController::class, 'master_kategori_diklat'])->name('master-kategori-diklat');
            Route::get('add-master-kategori-diklat', [MasterKategoriDiklatController::class, 'add_master_kategori_diklat'])->name('add-master-kategori-diklat');
            Route::post('master-kategori-diklat-store', [MasterKategoriDiklatController::class, 'master_kategori_diklat_store'])->name('master-kategori-diklat-store');
            Route::get('edit-master-kategori-diklat/{id}', [MasterKategoriDiklatController::class, 'edit_master_kategori_diklat'])->name('edit-master-kategori-diklat');
            Route::post('master-kategori-diklat-update', [MasterKategoriDiklatController::class, 'master_kategori_diklat_update'])->name('master-kategori-diklat-update');
            Route::delete('master-kategori-diklat-delete/{id}', [MasterKategoriDiklatController::class, 'master_kategori_diklat_delete'])->name('master-kategori-diklat-delete');
        });

        Route::controller(PretestController::class)->group(function () {
            Route::get('pretest', [PretestController::class, 'pretest'])->name('pretest');
            Route::get('add-pretest', [PretestController::class, 'add_pretest'])->name('add-pretest');
            Route::post('pretest-store', [PretestController::class, 'pretest_store'])->name('pretest-store');
            Route::get('edit-pretest/{id}', [PretestController::class, 'edit_pretest'])->name('edit-pretest');
            Route::post('pretest-update', [PretestController::class, 'pretest_update'])->name('pretest-update');
            Route::delete('pretest-delete/{id}', [PretestController::class, 'pretest_delete'])->name('pretest-delete');
        });
        
        Route::controller(PostestController::class)->group(function () {
            Route::get('postest', [PostestController::class, 'postest'])->name('postest');
            Route::get('add-postest', [PostestController::class, 'add_postest'])->name('add-postest');
            Route::post('postest-store', [PostestController::class, 'postest_store'])->name('postest-store');
            Route::get('edit-postest/{id}', [PostestController::class, 'edit_postest'])->name('edit-postest');
            Route::post('postest-update', [PostestController::class, 'postest_update'])->name('postest-update');
            Route::delete('postest-delete/{id}', [PostestController::class, 'postest_delete'])->name('postest-delete');
        });

        Route::controller(EvaluasiPenyelenggaraController::class)->group(function () {
            Route::get('evaluasi-penyelenggara', [EvaluasiPenyelenggaraController::class, 'evaluasi_penyelenggara'])->name('evaluasi-penyelenggara');
            Route::get('add-evaluasi-penyelenggara', [EvaluasiPenyelenggaraController::class, 'add_evaluasi_penyelenggara'])->name('add-evaluasi-penyelenggara');
            Route::post('evaluasi-penyelenggara-store', [EvaluasiPenyelenggaraController::class, 'evaluasi_penyelenggara_store'])->name('evaluasi-penyelenggara-store');
            Route::get('edit-evaluasi-penyelenggara/{id}', [EvaluasiPenyelenggaraController::class, 'edit_evaluasi_penyelenggara'])->name('edit-evaluasi-penyelenggara');
            Route::post('evaluasi-penyelenggara-update', [EvaluasiPenyelenggaraController::class, 'evaluasi_penyelenggara_update'])->name('evaluasi-penyelenggara-update');
            Route::delete('evaluasi-penyelenggara-delete/{id}', [EvaluasiPenyelenggaraController::class, 'evaluasi_penyelenggara_delete'])->name('evaluasi-penyelenggara-delete');
        });

        Route::controller(EvaluasiPengajarController::class)->group(function () {
            Route::get('evaluasi-pengajar', [EvaluasiPengajarController::class, 'evaluasi_pengajar'])->name('evaluasi-pengajar');
            Route::get('add-evaluasi-pengajar', [EvaluasiPengajarController::class, 'add_evaluasi_pengajar'])->name('add-evaluasi-pengajar');
            Route::post('evaluasi-pengajar-store', [EvaluasiPengajarController::class, 'evaluasi_pengajar_store'])->name('evaluasi-pengajar-store');
            Route::get('edit-evaluasi-pengajar/{id}', [EvaluasiPengajarController::class, 'edit_evaluasi_pengajar'])->name('edit-evaluasi-pengajar');
            Route::post('evaluasi-pengajar-update', [EvaluasiPengajarController::class, 'evaluasi_pengajar_update'])->name('evaluasi-pengajar-update');
            Route::delete('evaluasi-pengajar-delete/{id}', [EvaluasiPengajarController::class, 'evaluasi_pengajar_delete'])->name('evaluasi-pengajar-delete');
        });

        Route::controller(PenilaianController::class)->group(function () {
            Route::get('penilaian', [PenilaianController::class, 'penilaian'])->name('penilaian');
            Route::get('add-penilaian', [PenilaianController::class, 'add_penilaian'])->name('add-penilaian');
            Route::post('penilaian-store', [PenilaianController::class, 'penilaian_store'])->name('penilaian-store');
            Route::get('edit-penilaian/{id}', [PenilaianController::class, 'edit_penilaian'])->name('edit-penilaian');
            Route::post('penilaian-update', [PenilaianController::class, 'penilaian_update'])->name('penilaian-update');
            Route::delete('penilaian-delete/{id}', [PenilaianController::class, 'penilaian_delete'])->name('penilaian-delete');
        });

        // Route::controller(SertifikatController2::class)->group(function () {
        //     Route::get('sertifikat2', [SertifikatController2::class, 'index'])->name('sertifikat2');
        //     Route::get('add-sertifikat', [SertifikatController2::class, 'add_sertifikat'])->name('add-sertifikat');
        //     Route::post('sertifikat-store', [SertifikatController2::class, 'sertifikat_store'])->name('sertifikat-store');
        //     Route::get('edit-sertifikat/{id}', [SertifikatController2::class, 'edit_sertifikat'])->name('edit-sertifikat');
        //     Route::post('sertifikat-update', [SertifikatController::class, 'sertifikat_update'])->name('sertifikat-update');
        //     Route::delete('sertifikat-delete/{id}', [SertifikatController2::class, 'sertifikat_delete'])->name('sertifikat-delete');
        // });

        Route::controller(SertifikatDiklatController::class)->group(function () {
            Route::get('sertifklat', [SertifikatDiklatController::class, 'sertifklat'])->name('sertifklat');
            Route::get('download-certificate', [SertifikatDiklatController::class, 'downloadCertificate'])->name('download-certificate');
            Route::post('certificate-builder/item/update', [SertifikatDiklatController::class, 'updateItem'])->name('certificate-builder.item.update');
            Route::resource('certificate-builder', SertifikatDiklatController::class)->names('certificate-builder');

            Route::get('prosessertif', [SertifikatDiklatController::class, 'prosessertif'])->name('prosessertif');
            Route::get('getFilteredData', [SertifikatDiklatController::class, 'getFilteredData'])->name('getFilteredData');
            Route::post('create-sertifikat', [SertifikatDiklatController::class, 'create_sertifikat'])->name('create-sertifikat');
            
            Route::post('createbulk-sertifikat', [SertifikatDiklatController::class, 'createbulk_sertifikat'])->name('createbulk-sertifikat');
        });

        Route::controller(TandaTanganController::class)->group(function () {
            Route::get('tanda-tangan-elektronik', [TandaTanganController::class, 'tanda_tangan_elektronik'])->name('tanda-tangan-elektronik');
            Route::get('add-tanda-tangan-elektronik', [TandaTanganController::class, 'add_tanda_tangan_elektronik'])->name('add-tanda-tangan-elektronik');
            Route::post('tanda-tangan-elektronik-store', [TandaTanganController::class, 'tanda_tangan_elektronik_store'])->name('tanda-tangan-elektronik-store');
            Route::get('edit-tanda-tangan-elektronik/{id}', [TandaTanganController::class, 'edit_tanda_tangan_elektronik'])->name('edit-tanda-tangan-elektronik');
            Route::post('tanda-tangan-elektronik-update', [TandaTanganController::class, 'tanda_tangan_elektronik_update'])->name('tanda-tangan-elektronik-update');
            Route::delete('tanda-tangan-elektronik-delete/{id}', [TandaTanganController::class, 'tanda_tangan_elektronik_delete'])->name('tanda-tangan-elektronik-delete');
        });
        
        Route::controller(AkunZoomController::class)->group(function () {
            Route::get('akun-zoom', [AkunZoomController::class, 'akun_zoom'])->name('akun-zoom');
            Route::get('add-akun-zoom', [AkunZoomController::class, 'add_akun_zoom'])->name('add-akun-zoom');
            Route::post('akun-zoom-store', [AkunZoomController::class, 'akun_zoom_store'])->name('akun-zoom-store');
            Route::get('edit-akun-zoom/{id}', [AkunZoomController::class, 'edit_akun_zoom'])->name('edit-akun-zoom');
            Route::post('akun-zoom-update', [AkunZoomController::class, 'akun_zoom_update'])->name('akun-zoom-update');
            Route::delete('akun-zoom-delete/{id}', [AkunZoomController::class, 'akun_zoom_delete'])->name('akun-zoom-delete');
        });

        Route::controller(VirtualClassController::class)->group(function () {
            Route::get('virtual-class', [VirtualClassController::class, 'virtual_class'])->name('virtual-class');
            Route::get('add-virtual-class', [VirtualClassController::class, 'add_virtual_class'])->name('add-virtual-class');
            Route::post('virtual-class-store', [VirtualClassController::class, 'virtual_class_store'])->name('virtual-class-store');
            Route::get('edit-virtual-class/{id}', [VirtualClassController::class, 'edit_virtual_class'])->name('edit-virtual-class');
            Route::post('virtual-class-update', [VirtualClassController::class, 'virtual_class_update'])->name('virtual-class-update');
            Route::delete('virtual-class-delete/{id}', [VirtualClassController::class, 'virtual_class_delete'])->name('virtual-class-delete');
        });
        Route::controller(MediaController::class)->group(function () {
            Route::get('media', [MediaController::class, 'media'])->name('media');
            Route::get('add-media', [MediaController::class, 'add_media'])->name('add-media');
            Route::post('media-store', [MediaController::class, 'media_store'])->name('media-store');
            Route::get('edit-media/{id}', [MediaController::class, 'edit_media'])->name('edit-media');
            Route::post('media-update', [MediaController::class, 'media_update'])->name('media-update');
            Route::delete('media-delete/{id}', [MediaController::class, 'media_delete'])->name('media-delete');
        });
        
        Route::controller(PesertadiklatController::class)->group(function () {
            Route::get('peserta-diklat', [PesertadiklatController::class, 'show'])->name('peserta-diklat');
            Route::get('detail-pesertadiklat/{id_peserta}/{id_registrasi_diklat}', [PesertadiklatController::class, 'detail'])->name('detail-pesertadiklat');
            Route::post('approve-pesertadiklat/{id_peserta}/{id_registrasi_diklat}', [PesertadiklatController::class, 'approve'])->name('approve-pesertadiklat');
            
            
        });

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('edit-profile', 'edit_profile')->name('edit-profile');
            Route::put('profile-update', 'profile_update')->name('profile-update');
            Route::put('update-password', 'update_password')->name('update-password');
        });

        Route::get('role/assign', [RolesController::class, 'assignRoleView'])->name('role.assign');
        Route::post('role/assign/{id}', [RolesController::class, 'getAdminRoles'])->name('role.assign.admin');
        Route::put('role/assign', [RolesController::class, 'assignRoleUpdate'])->name('role.assign.update');
        Route::resource('/role', RolesController::class);
        Route::resource('/role', RolesController::class);
    });

    Route::resource('admin', AdminController::class)->except('show');
    Route::put('admin-status/{id}', [AdminController::class, 'changeStatus'])->name('admin.status');
    // Settings routes
    Route::get('settings', [SettingController::class, 'settings'])->name('settings');
    Route::post('cloud/store', [CloudStorageController::class, 'store'])->name('cloud.store');
});