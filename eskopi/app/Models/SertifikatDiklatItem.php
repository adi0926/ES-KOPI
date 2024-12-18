<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class SertifikatDiklatItem extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    public $incrementing = false;
   
    protected $table = 'certificate_builder_items';

    protected $fillable = [
        'element_id',       // Add 'title' to allow mass assignment
        'x_position',   // Example of other fillable attributes
        'y_position',
    ];

}