<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PenggunaDiklat extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'diklat_peserta';

    protected $fillable = ['id_peserta','id_diklat','id_angkatan','id_registrasi_diklat','tgl_pendaftaran','status','tgl_terdaftar','id_sertifikat','no_sertifikat'];

    public function diklatAngkatan()
    {
        return $this->belongsTo(DiklatAngkatan::class, 'id_angkatan', 'id_diklat_angkatan');
    }
    
    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat', 'id_diklat');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_peserta', 'id_pengguna');
    }

    public function sertifikat()
    {
        return $this->belongsTo(PenggunaSertifikat::class, 'id_sertifikat', 'id');
    }
}