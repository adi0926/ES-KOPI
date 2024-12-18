<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PenggunaProfil extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna_profil';

    protected $fillable = ['id_pengguna','nama_lengkap','jenis_kelamin','tempat_lahir','tgl_lahir','alamat_detail','alamat_kota','alamat_propinsi','no_telp'];
    
}