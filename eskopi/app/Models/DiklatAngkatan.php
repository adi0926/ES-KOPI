<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DiklatAngkatan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'diklat_angkatan';
    protected $primaryKey = 'id_diklat_angkatan';
    

    protected $fillable = ['id_diklat','nama_angkatan','diklat_mulai','diklat_selesai','kuota_peserta','tanggal_akhir_pendaftaran','tipe_angkatan'];

    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat');
    }

    public function mataDiklat()
    {
        return $this->hasMany(MataDiklat::class, 'id_angkatan', 'id_diklat_angkatan');
    }
}