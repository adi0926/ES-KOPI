<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class JawabanEvalpengajar extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_jawaban';
    protected $table = 'core_jawaban_evaluasipengajar';

    protected $fillable = ['id_peserta','id_core_soal_evaluasi_pengajar','jawaban'];

    public function soalEvaluasiPengajar()
    {
        return $this->belongsTo(SoalEvaluasipengajar::class, 'id_core_soal_evaluasi_pengajar', 'id');
    }

}