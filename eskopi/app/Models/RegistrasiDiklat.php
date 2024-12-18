<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class RegistrasiDiklat extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_registrasi_diklat';
    
    protected $table = 'core_registrasi_diklat';

    protected $fillable = ['nip','nama','jenis_kelamin','tempat_lahir','tanggal_lahir','email','no_hp','alamat','kota','provinsi','facebook','instansi','alamat_instansi','kota_instansi','prov_instansi','telp_instansi','fax_instansi','website_instansi','jabatan_peserta','unit_kerja','golongan_peserta','nama_atasan','nohp_atasan','file_persyaratan'];



    public function getkota()
    {
        return $this->belongsTo(Kota::class, 'kota', 'id_kota');
    }
    
    public function getprovinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi', 'id_provinsi');
    }
    
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi', 'id_instansi');
    }
    
    public function kotaInstansi()
    {
        return $this->belongsTo(Kota::class, 'kota_instansi', 'id_kota');
    }
    
    public function provinsiInstansi()
    {
        return $this->belongsTo(Provinsi::class, 'prov_instansi', 'id_provinsi');
    }
    
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_peserta', 'id_jabatan');
    }
    
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_peserta', 'id_golongan');
    }
}