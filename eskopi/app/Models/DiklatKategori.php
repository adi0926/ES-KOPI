<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DiklatKategori extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $primaryKey = 'id_kategori';
    protected $table = 'diklat_kategori';

    protected $fillable = ['nama_kategori', 'keterangan'];

    public function diklats()
    {
        return $this->hasMany(Diklat::class, 'id_kategori')->published();
    }
}