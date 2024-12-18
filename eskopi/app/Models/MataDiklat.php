<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class MataDiklat extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id_mata_diklat';
    protected $table = 'mata_diklat';

    protected $fillable = ['mata_diklat','publikasi','id_angkatan','deskripsi','urutan','tipekonfig'];
    
    public function mataDiklatKonten()
    {
        return $this->hasMany(MataDiklatKonten::class, 'id_mata_diklat', 'id_mata_diklat')->orderBy('id_tipe_konten')->orderBy('urutan');
    }
    
    public function angkatan()
    {
        return $this->belongsTo(DiklatAngkatan::class, 'id_angkatan', 'id_diklat_angkatan');
    }

    public function jumlahKonten()
    {
        return $this->mataDiklatKonten()->count();
    }
}