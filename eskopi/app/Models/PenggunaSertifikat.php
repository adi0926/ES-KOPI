<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PenggunaSertifikat extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'pengguna_sertifikat';

    protected $fillable = ['id_peserta','id_diklat','id_angkatan','no_sertifikat','file_sertifikat','status','file_sertifikat_sign'];

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
}