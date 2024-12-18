<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Panduan extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id_panduan';
    protected $table = 'panduan';

    protected $fillable = ['judul_panduan','tipe_panduan','file_panduan'];

}