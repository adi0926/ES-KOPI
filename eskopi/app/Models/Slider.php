<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Slider extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = 'slider';
    protected $primaryKey = 'id_slider';

    protected $fillable = ['nama','imagepath','tampilkan','urutan'];
}