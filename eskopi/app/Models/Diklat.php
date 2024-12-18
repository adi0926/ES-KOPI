<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Diklat extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'id_diklat';
    protected $table = 'core_diklat';

    protected $fillable = ['nama_diklat','id_kategori','gambar','publikasi','deskripsi','persyaratan','penyelenggara','durasi','jp','yang_dipelajari','yang_diperoleh','file_persyaratan'];
    
    public function kategori()
    {
        return $this->belongsTo(DiklatKategori::class, 'id_kategori');
    }

    public function angkatan()
    {
        return $this->hasMany(DiklatAngkatan::class, 'id_diklat', 'id_diklat');
    }

    public function penggunaDiklat()
    {
        return $this->hasManyThrough(PenggunaDiklat::class, DiklatAngkatan::class, 'id_diklat', 'id_angkatan', 'id_diklat', 'id_diklat_angkatan');
    }

    public function pesertaCount()
    {
        return $this->penggunaDiklat()->where('status', 1)->count();
    }
    
    public function mataDiklat()
    {
        return $this->hasManyThrough(MataDiklat::class, DiklatAngkatan::class, 'id_diklat', 'id_angkatan', 'id_diklat', 'id_diklat_angkatan')->where('publikasi', 'Y')->orderBy('urutan');
    }
    
    public function mataDiklatForSum()
    {
        return $this->hasManyThrough(MataDiklat::class, DiklatAngkatan::class, 'id_diklat', 'id_angkatan', 'id_diklat', 'id_diklat_angkatan')->where('publikasi', 'Y');
    }

    //public function diklatKonten()
    //{
    //    return $this->hasManyThrough(DiklatKonten::class, MataDiklat::class, 'id_angkatan', 'id_mata_diklat', 'id_diklat', 'id_mata_diklat');
    //}

    //public function countSoal()
    //{
    //    return $this->diklatKonten()->where('id_tipekonten', 3)->count();
    //}

    //public function countMateri()
    //{
    //    return $this->diklatKonten()->whereIn('id_tipekonten', [1, 2])->count();
    //}

    //public function sumDurasi()
    //{
    //    $totalMinutes = $this->diklatKonten()->sum('durasi');
    //    $hours = $totalMinutes / 60;
    //    
    //    return number_format($hours, 2);
    //}
    
    public function countMateri()
    {
        return $this->mataDiklat()
            ->join('core_mata_diklat_konten', 'core_mata_diklat_konten.id_mata_diklat', '=', 'mata_diklat.id_mata_diklat')
            ->whereIn('core_mata_diklat_konten.id_tipe_konten', [1, 2, 4])
            ->count();
    }

    public function countSoal()
    {
        return $this->mataDiklat()
            ->join('core_mata_diklat_konten', 'core_mata_diklat_konten.id_mata_diklat', '=', 'mata_diklat.id_mata_diklat')
            ->join('materi_soal', 'materi_soal.id_materi', '=', 'core_mata_diklat_konten.id_konten')
            ->where('core_mata_diklat_konten.id_tipe_konten', 9)
            ->where('materi_soal.tipe', '!=', 'evaluasi')
            ->count();
    }
    
    public function sumDurasi()
    {
        $videoDuration = $this->mataDiklatForSum()
            ->join('core_mata_diklat_konten', 'core_mata_diklat_konten.id_mata_diklat', '=', 'mata_diklat.id_mata_diklat')
            ->leftJoin('materi_video', function ($join) {
                $join->on('materi_video.id_materi', '=', 'core_mata_diklat_konten.id_konten')
                    ->where('core_mata_diklat_konten.id_tipe_konten', 1);
            })
            ->where('mata_diklat.publikasi', 'Y')
            ->sum('materi_video.durasi');
    
        $pdfDuration = $this->mataDiklatForSum()
            ->join('core_mata_diklat_konten', 'core_mata_diklat_konten.id_mata_diklat', '=', 'mata_diklat.id_mata_diklat')
            ->leftJoin('materi_pdf', function ($join) {
                $join->on('materi_pdf.id_materi', '=', 'core_mata_diklat_konten.id_konten')
                    ->where('core_mata_diklat_konten.id_tipe_konten', 2);
            })
            ->where('mata_diklat.publikasi', 'Y')
            ->sum('materi_pdf.durasi');
    
        $totalMinutes = $videoDuration + $pdfDuration;
    
        // $totalHours = number_format($totalMinutes / 60, 2);

        return $totalMinutes;
    }
    
    public function scopePublished($query)
    {
        return $query->where('publikasi', 'Y');
    }

    public function isPublishable()
    {
        $mataDiklat = $this->mataDiklat()->get();

        foreach ($mataDiklat as $mata) {
            if ($mata->mataDiklatKonten()->count() === 0) {
                return false;
            }
        }

        return true;
    }
    
}