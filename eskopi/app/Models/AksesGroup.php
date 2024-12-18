<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class AksesGroup extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id';
    protected $table = 'core_akses_group';

    protected $fillable = [
        'id_menu', 'id_group',
    ];

    
    
}