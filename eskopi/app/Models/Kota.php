<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Kota extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_kota';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $table = 'core_kota';

    protected $fillable = ['id_kota','nama_kota','id_provinsi'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

}