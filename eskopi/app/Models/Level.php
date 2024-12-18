<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Level extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id_role';
    protected $table = 'core_role';

    protected $fillable = ['nama_role'];

    
    
}