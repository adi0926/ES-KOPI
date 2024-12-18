<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class MateriEvalpenyelenggara extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_materi';
    protected $table = 'materi_evaluasi_penyelenggara';

    protected $fillable = ['judul_evaluasi','penyelenggara','id_mata_diklat','durasi'];
    
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
        return $this->hasMany(SoalEvaluasipenyelenggara::class, 'id_materi_evaluasi_penyelenggara', 'id_materi');
    }

}