<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Reference extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_reference';
    protected $table = 'core_reference';

    protected $fillable = ['id_peserta','id_mata_diklat_konten','status','urutan','id_mata_diklat','id_diklat','id_angkatan'];

    public function mataDiklatKonten()
    {
        return $this->belongsTo(MataDiklatKonten::class, 'id_mata_diklat_konten', 'id');
    }

}