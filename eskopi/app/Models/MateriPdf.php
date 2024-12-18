<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class MateriPdf extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_materi';
    protected $table = 'materi_pdf';

    protected $fillable = ['judul_materi','url_materi','durasi','id_mata_diklat'];
    
    public function mataDiklat()
    {
        return $this->belongsTo(MataDiklat::class, 'id_mata_diklat', 'id_mata_diklat');
    }
    public function mataDiklatKonten()
    {
        return $this->hasMany(MataDiklatKonten::class, 'id_konten', 'id_materi');
    }

}