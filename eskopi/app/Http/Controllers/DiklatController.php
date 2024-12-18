<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\PenggunaDiklat;
use App\Models\Diklat;
use App\Models\MataDiklatKonten;
use App\Models\MataDiklat;
use App\Models\DiklatKategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DiklatController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function diklat()
    {
        $alldiklat = Diklat::with('kategori')
            ->where('publikasi', 'Y') 
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $categories = DiklatKategori::all();

        return view('content.diklat', compact('alldiklat', 'categories'));
    }

    public function showdiklat($id_diklat)
    {
        $id_diklat = Crypt::decrypt($id_diklat);
        $diklat = Diklat::with('angkatan')->findOrFail($id_diklat);
        $userId = 0;
        $check = Auth::user();
        if($check){
            $userId = $check->id_pengguna;
        }
        $registration = PenggunaDiklat::where('id_peserta', $userId)
            ->where('id_diklat', $id_diklat)
            ->first();

        $diklat->registration_status = $registration;
        $diklat->formatted_created_at = \Carbon\Carbon::parse($diklat->created_at)->format('d/M/Y');
        return view('content.diklat-detail', compact('diklat'));
    }

    public function filterDiklatByCategory(Request $request)
    {

        if ($request->categories == 'all') {
            $filteredDiklats = Diklat::all();
            $selectedCategoryNames = 'Semua';
        } else {
            $categories = $request->categories;
            $filteredDiklats = Diklat::whereIn('id_kategori', $categories)->get();
            $selectedCategories = DiklatKategori::whereIn('id_kategori', $categories)->get();
            $selectedCategoryNames = $selectedCategories->pluck('nama_kategori')->implode(', ');
        }

        $html = view('content.partials.diklat-list', compact('filteredDiklats'))->render();

        return response()->json([
            'count' => $filteredDiklats->count(),
            'category_names' => $selectedCategoryNames,
            'html' => $html
        ]);
    }


}
