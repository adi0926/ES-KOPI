<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Kontak extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id_kontak';
    protected $table = 'kontak';

    protected $fillable = ['alamat','telepone','email'];

}