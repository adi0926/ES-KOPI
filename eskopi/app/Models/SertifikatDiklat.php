<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class SertifikatDiklat extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    public $incrementing = false;
   
    protected $table = 'certificate_builders';

    protected $fillable = [
        'title',       // Add 'title' to allow mass assignment
        'sub_title',   // Example of other fillable attributes
        'description',
        'no_certificate',
        'background',
        'signature',
        'signature_name',
    ];

}