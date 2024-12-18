<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Sertifikat extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = 'v_diklat_angkatan_saya';

    //protected $fillable = ['id_peserta','id_sertifikat','url'];
}