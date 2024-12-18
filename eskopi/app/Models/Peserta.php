<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $fillable = ['mata_diklat', 'publikasi', 'id_angkatan'];
    protected $table = 'mata_diklat';
}
