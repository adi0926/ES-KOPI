<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class MataDiklatKonten extends Model
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id';
    protected $table = 'core_mata_diklat_konten';

    protected $fillable = ['id_konten','id_mata_diklat','id_tipe_konten','urutan'];
    
    public function materiVideo()
    {
        return $this->belongsTo(MateriVideo::class, 'id_konten');
    }

    public function materiPdf()
    {
        return $this->belongsTo(MateriPdf::class, 'id_konten');
    }

    public function materiSoal()
    {
        return $this->belongsTo(MateriSoal::class, 'id_konten');
    }

    public function materiLain()
    {
        return $this->belongsTo(MateriLain::class, 'id_konten');
    }

    public function materiVclass()
    {
        return $this->belongsTo(MateriVclass::class, 'id_konten');
    }

    public function materiEvalpenyelenggara()
    {
        return $this->belongsTo(MateriEvalpenyelenggara::class, 'id_konten');
    }

    public function materiEvalpengajar()
    {
        return $this->belongsTo(MateriEvalpengajar::class, 'id_konten');
    }

    public function references()
    {
        return $this->hasMany(Reference::class, 'id_mata_diklat_konten', 'id');
    }

}