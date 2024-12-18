<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class MateriVclass extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_materi';
    protected $table = 'materi_virtual_class';

    protected $fillable = ['judul_materi','url_materi','id_mata_diklat','durasi'];
    
    public function mataDiklatKonten()
    {
        return $this->hasMany(MataDiklatKonten::class, 'id_konten', 'id_materi');
    }

}