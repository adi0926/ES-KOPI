<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class DiklatKonten extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'diklat_konten';

    protected $fillable = ['id_mata_diklat','id_tipekonten','nama_konten','durasi','jumlah_soal','url'];
}