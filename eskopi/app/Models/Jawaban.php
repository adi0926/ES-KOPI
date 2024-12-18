<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Jawaban extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_jawaban';
    protected $table = 'core_jawaban';

    protected $fillable = ['id_peserta','id_core_soal_materi','jawaban'];
    
    public function mataDiklatKonten()
    {
        return $this->hasMany(MataDiklatKonten::class, 'id_konten', 'id_materi');
    }

    public function soalMateri()
    {
        return $this->belongsTo(SoalMateri::class, 'id_core_soal_materi', 'id');
    }

}