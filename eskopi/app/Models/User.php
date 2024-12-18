<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id';
    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_group',
        'status',
        'forget_password_token'
    ];

    
    
   
}
