<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class TipeKonten extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_tipekonten';
    protected $table = 'core_tipekonten';

    protected $fillable = ['nama_tipekonten'];

}