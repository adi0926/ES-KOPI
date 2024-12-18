<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class CoreMenu extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id';
    protected $table = 'core_menu';

    protected $fillable = ['nama_menu','url','icon','parent_id','active_segment','urutan'];

    
    
}