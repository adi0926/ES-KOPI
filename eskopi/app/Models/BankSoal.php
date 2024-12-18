<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class BankSoal extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_bank_soal';
    protected $table = 'bank_soal';

    protected $fillable = ['judul_bank_soal','kategori','id_mata_diklat'];

    public function soals()
    {
        return $this->hasMany(Soal::class, 'id_bank_soal', 'id_bank_soal');
    }

    public function mataDiklat()
    {
        return $this->belongsTo(MataDiklat::class, 'id_mata_diklat', 'id_mata_diklat');
    }

}