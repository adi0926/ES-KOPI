<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class SoalMateri extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'core_soal_materi';

    protected $fillable = ['id_materi_soal','soal','pilihan_a','pilihan_b','pilihan_c','pilihan_d','pilihan_e','kunci_jawaban','tipe_soal'];

}