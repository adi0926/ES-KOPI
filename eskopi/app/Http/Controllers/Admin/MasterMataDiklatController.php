<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diklat;
use App\Models\MasterMataDiklat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class MasterMataDiklatController extends Controller
{

    public function master_matadiklat()
    {
        $masterMataDiklat = MasterMataDiklat::orderBy('created_at', 'asc')->get();
        return view('admin.matadiklat.master-matadiklat', compact(['masterMataDiklat']));
    }

    public function add_master_matadiklat()
    {
        return view('admin.matadiklat.add_master-matadiklat');
    }

    public function master_matadiklat_store(Request $request)
    {
        $request->validate([
            'mata_diklat' => 'required|string',
            'deskripsi' => 'required|string',
            'publikasi' => 'required|in:Y,N',
        ]);

        $post = MasterMataDiklat::create([
                    'mata_diklat' => $request->mata_diklat,
                    'deskripsi' => $request->deskripsi,
                    'publikasi' => $request->publikasi
                ]);

        if($post){
            $notification = __('Mata Diklat Berhasil ditambahkan');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect('admin/master-matadiklat')->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menambah mata diklat');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    public function edit_master_matadiklat($id)
    {  
        $idmaster = Crypt::decrypt($id);
        $masterMataDiklat = MasterMataDiklat::where('id_master_mata_diklat', '=' , $idmaster)->first();

		return view('admin.matadiklat.edit_master-matadiklat', compact(['masterMataDiklat']));	    
	}

    public function master_matadiklat_update(Request $request)
    {
        $request->validate([
            'mata_diklat' => 'required|string',
            'deskripsi' => 'required|string',
            'publikasi' => 'required|in:Y,N',
        ]);

        $post = MasterMataDiklat::where('id_master_mata_diklat', '=' , $request->id_master_mata_diklat)
                ->update([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'deskripsi' => $request->deskripsi
                ]);

        if($post){
            $notification = __('Mata Diklat Berhasil diubah');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect('admin/master-matadiklat')->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal mengubah mata diklat');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
	}

    public function master_matadiklat_delete($id)
	{   
        $post = MasterMataDiklat::findOrFail($id);
        $post->delete();

		if($post){
            $notification = __('Mata Diklat Berhasil dihapus');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect('admin/master-matadiklat')->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menghapus mata diklat');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

}