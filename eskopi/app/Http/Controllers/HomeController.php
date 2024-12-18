<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Slider;
use App\Models\Diklat;
use App\Models\Kontak;
use App\Models\Panduan;
use App\Models\Media;


class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $sliders = Slider::where('tampilkan', 'Y')->orderBy('urutan')->get();
        $diklats = Diklat::where('publikasi', 'Y')->latest()->take(8)->get();
        $media = Media::first();

        return view('nologincontent.home', compact('sliders', 'diklats', 'media'));
    }

    public function panduanpengguna()
    {
        $panduans = Panduan::all();
        return view('nologincontent.panduan',compact('panduans'));
    }

    public function hubungikami()
    {
        $kontaks = Kontak::all();
        return view('nologincontent.hubungi',compact('kontaks'));
    }

}
