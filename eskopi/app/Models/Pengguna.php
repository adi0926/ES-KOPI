<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'core_pengguna';
    protected $primaryKey = 'id_pengguna';

    protected $fillable = ['name','nip','email','password','id_tipe','id_role','no_telp','fotoprofil'];
}