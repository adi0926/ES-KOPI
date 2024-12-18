<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class MasterMataDiklat extends Model
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id_master_mata_diklat';
    protected $table = 'master_mata_diklat';

    protected $fillable = ['mata_diklat','publikasi','deskripsi'];
    
}