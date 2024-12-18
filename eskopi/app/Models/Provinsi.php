<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Provinsi extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_provinsi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'core_provinsi';

    protected $fillable = ['id_provinsi','nama_provinsi'];

}