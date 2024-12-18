<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class SoalEvaluasipenyelenggara extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'core_soal_evaluasi_penyelenggara';

    protected $fillable = ['id_materi_evaluasi_penyelenggara','soal'];

}