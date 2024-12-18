<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class MateriSoal extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_materi';
    protected $table = 'materi_soal';

    protected $fillable = ['judul_soal','tipe','id_mata_diklat','durasi'];

    public function mataDiklat()
    {
        return $this->belongsTo(MataDiklat::class, 'id_mata_diklat', 'id_mata_diklat');
    }
    
    public function mataDiklatKonten()
    {
        return $this->hasMany(MataDiklatKonten::class, 'id_konten', 'id_materi');
    }

    public function soals()
    {
        return $this->hasMany(SoalMateri::class, 'id_materi_soal', 'id_materi');
    }

}