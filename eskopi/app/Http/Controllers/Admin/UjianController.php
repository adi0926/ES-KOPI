<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataDiklat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class UjianController extends Controller
{

    public function ujian()
    {
        $ujian = MataDiklat::orderBy('created_at', 'desc')->get();
        return view('admin.ujian.ujian', compact(['ujian']));
    }

    public function add_ujian()
    {
        return view('admin.ujian.add_ujian');
    }

    public function ujian_store(Request $request)
    {
        $post = MataDiklat::insert([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

        return redirect('admin/ujian')->with('message', 'Bank Soal Berhasil ditambahkan');
    }

    public function edit_ujian($id)
    {  
        $idujian = Crypt::decrypt($id);
        $ujian = MataDiklat::where('id_mata_diklat', '=' , $idujian)->first();

		return view('admin.ujian.edit_ujian', compact(['ujian']));	    
	}

    public function ujian_update(Request $request)
    {    	
        $post = MataDiklat::where('id_mata_diklat', '=' , $request->id_mata_diklat)
                ->update([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

		return redirect('admin/ujian')->with('message', 'Bank Soal Berhasil diubah');
	}

    public function ujian_delete($id)
	{   
        $post = MataDiklat::findOrFail($id);
        $post->delete();

		return redirect('admin/ujian')->with('message', 'Bank Soal Berhasil dihapus');
    }

}