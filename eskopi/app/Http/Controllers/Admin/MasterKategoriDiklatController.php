<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiklatKategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class MasterKategoriDiklatController extends Controller
{

    public function master_kategori_diklat()
    {
        $masterKategoriDiklat = DiklatKategori::orderBy('id_kategori', 'desc')->get();
        return view('admin.master-kategori-diklat.master_kategori_diklat', compact(['masterKategoriDiklat']));
    }

    public function add_master_kategori_diklat()
    {
        return view('admin.master-kategori-diklat.add_master_kategori_diklat');
    }

    public function master_kategori_diklat_store(Request $request)
    {
        $post = DiklatKategori::insert([
                    'nama_kategori' => $request->nama_kategori,
                    'keterangan' => $request->keterangan
                ]);

        return redirect('admin/master-kategori-diklat')->with('message', 'Mata Diklat Berhasil ditambahkan');
    }

    public function edit_master_kategori_diklat($id)
    {  
        $idmaster = Crypt::decrypt($id);
        $masterKategoriDiklat = DiklatKategori::where('id_kategori', '=' , $idmaster)->first();

		return view('admin.master-kategori-diklat.edit_master_kategori_diklat', compact(['masterKategoriDiklat']));	    
	}

    public function master_kategori_diklat_update(Request $request)
    {    	
        $post = DiklatKategori::where('id_kategori', '=' , $request->id_kategori)
                ->update([
                    'nama_kategori' => $request->nama_kategori,
                    'keterangan' => $request->keterangan
                   
                ]);

		return redirect('admin/master-kategori-diklat')->with('message', 'Kategori Diklat Berhasil diubah');
	}

    public function master_kategori_diklat_delete($id)
	{   
        $post = DiklatKategori::findOrFail($id);
        $post->delete();

		return redirect('admin/master-kategori-diklat')->with('message', 'Kategori Diklat Berhasil dihapus');
    }

}