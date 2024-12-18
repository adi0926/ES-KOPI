<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataDiklat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class PretestController extends Controller
{

    public function pretest()
    {
        $pretest = MataDiklat::orderBy('created_at', 'desc')->get();
        return view('admin.pretest.pretest', compact(['pretest']));
    }

    public function add_pretest()
    {
        return view('admin.pretest.add_pretest');
    }

    public function pretest_store(Request $request)
    {
        $post = MataDiklat::insert([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

        return redirect('admin/pretest')->with('message', 'Mata Diklat Berhasil ditambahkan');
    }

    public function edit_pretest($id)
    {  
        $idmaster = Crypt::decrypt($id);
        $pretest = MataDiklat::where('id_mata_diklat', '=' , $idmaster)->first();

		return view('admin.pretest.edit_pretest', compact(['pretest']));	    
	}

    public function pretest_update(Request $request)
    {    	
        $post = MataDiklat::where('id_mata_diklat', '=' , $request->id_mata_diklat)
                ->update([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

		return redirect('admin/pretest')->with('message', 'Mata Diklat Berhasil diubah');
	}

    public function pretest_delete($id)
	{   
        $post = MataDiklat::findOrFail($id);
        $post->delete();

		return redirect('admin/pretest')->with('message', 'Mata Diklat Berhasil dihapus');
    }

}