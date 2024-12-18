<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Instansi extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_instansi';
    protected $table = 'core_instansi';

    protected $fillable = ['nama_instansi'];

}