<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataDiklat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class VirtualClassController extends Controller
{

    public function virtual_class()
    {
        $virtualClass = MataDiklat::orderBy('created_at', 'desc')->get();
        return view('admin.virtual-class.virtual_class', compact(['virtualClass']));
    }

    public function add_virtual_class()
    {
        return view('admin.virtual-class.add_virtual_class');
    }

    public function virtual_class_store(Request $request)
    {
        $post = MataDiklat::insert([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

        return redirect('admin/virtual-class')->with('message', 'Mata Diklat Berhasil ditambahkan');
    }

    public function edit_virtual_class($id)
    {  
        $idmaster = Crypt::decrypt($id);
        $virtualClass = MataDiklat::where('id_mata_diklat', '=' , $idmaster)->first();

		return view('admin.virtual-class.edit_virtual_class', compact(['virtualClass']));	    
	}

    public function virtual_class_update(Request $request)
    {    	
        $post = MataDiklat::where('id_mata_diklat', '=' , $request->id_mata_diklat)
                ->update([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

		return redirect('admin/virtual-class')->with('message', 'Mata Diklat Berhasil diubah');
	}

    public function virtual_class_delete($id)
	{   
        $post = MataDiklat::findOrFail($id);
        $post->delete();

		return redirect('admin/virtual-class')->with('message', 'Mata Diklat Berhasil dihapus');
    }

}