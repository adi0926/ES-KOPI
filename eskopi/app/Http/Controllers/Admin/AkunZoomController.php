<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataDiklat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class AkunZoomController extends Controller
{

    public function akun_zoom()
    {
        $akunZoom = MataDiklat::orderBy('created_at', 'desc')->get();
        return view('admin.akun-zoom.akun_zoom', compact(['akunZoom']));
    }

    public function add_akun_zoom()
    {
        return view('admin.akun-zoom.add_akun_zoom');
    }

    public function akun_zoom_store(Request $request)
    {
        $post = MataDiklat::insert([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

        return redirect('admin/akun-zoom')->with('message', 'Mata Diklat Berhasil ditambahkan');
    }

    public function edit_akun_zoom($id)
    {  
        $idmaster = Crypt::decrypt($id);
        $akunZoom = MataDiklat::where('id_mata_diklat', '=' , $idmaster)->first();

		return view('admin.akun-zoom.edit_akun_zoom', compact(['akunZoom']));	    
	}

    public function akun_zoom_update(Request $request)
    {    	
        $post = MataDiklat::where('id_mata_diklat', '=' , $request->id_mata_diklat)
                ->update([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

		return redirect('admin/akun-zoom')->with('message', 'Mata Diklat Berhasil diubah');
	}

    public function akun_zoom_delete($id)
	{   
        $post = MataDiklat::findOrFail($id);
        $post->delete();

		return redirect('admin/akun-zoom')->with('message', 'Mata Diklat Berhasil dihapus');
    }

}