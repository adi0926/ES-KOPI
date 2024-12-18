<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataDiklat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class PostestController extends Controller
{

    public function postest()
    {
        $postest = MataDiklat::orderBy('created_at', 'desc')->get();
        return view('admin.postest.postest', compact(['postest']));
    }

    public function add_postest()
    {
        return view('admin.postest.add_postest');
    }

    public function postest_store(Request $request)
    {
        $post = MataDiklat::insert([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

        return redirect('admin/postest')->with('message', 'Mata Diklat Berhasil ditambahkan');
    }

    public function edit_postest($id)
    {  
        $idmaster = Crypt::decrypt($id);
        $postest = MataDiklat::where('id_mata_diklat', '=' , $idmaster)->first();

		return view('admin.postest.edit_postest', compact(['postest']));	    
	}

    public function postest_update(Request $request)
    {    	
        $post = MataDiklat::where('id_mata_diklat', '=' , $request->id_mata_diklat)
                ->update([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

		return redirect('admin/postest')->with('message', 'Mata Diklat Berhasil diubah');
	}

    public function postest_delete($id)
	{   
        $post = MataDiklat::findOrFail($id);
        $post->delete();

		return redirect('admin/postest')->with('message', 'Mata Diklat Berhasil dihapus');
    }

}