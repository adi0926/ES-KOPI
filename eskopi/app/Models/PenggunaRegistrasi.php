<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PenggunaRegistrasi extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = 'pengguna_registrasi';
    protected $primaryKey = 'id_registrasi';

    protected $fillable = ['id_pengguna','nama_lengkap','jenis_kelamin','tempat_lahir','tgl_lahir','alamat_detail','alamat_kota','alamat_provinsi','tanggal_registrasi','status_registrasi','id_verifikator','tgl_verifikasi'];
    
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'alamat_kota');
    }
}