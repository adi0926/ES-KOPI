<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class KotaController extends Controller
{

    public function kota()
    {
        $kota = Kota::orderBy('id_kota', 'desc')->get();
        return view('admin.kota.kota', compact(['kota']));
    }

    public function add_kota()
    {
        $provinsis = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        return view('admin.kota.add_kota', compact(['provinsis']));
    }

    public function kota_store(Request $request)
    {
        $request->validate([
            'kota' => 'required|string|max:255',
            'idkota' => 'required|string|max:10',
            'provinsi' => 'required|string|max:10'
           
          ]);   
        
        $post = Kota::insert([
                    'id_provinsi' => $request->provinsi,
                    'id_kota' => $request->idkota,
                    'nama_kota' => $request->kota
                ]);

        return redirect('admin/kota')->with('message', 'Kota Berhasil Ditambahkan');
    }

    public function edit_kota($id)
    {  
        $idkota = Crypt::decrypt($id);
        $provinsis = Provinsi::orderBy('id_provinsi', 'desc')->get();
        $kota = Kota::where('id_kota', '=' , $idkota)->first();

		return view('admin.kota.edit_kota', compact(['kota','provinsis']));	    
	}
    public function kota_update(Request $request)
    {    	
        $request->validate([
            'kota' => 'required|string|max:255',
            'idkota' => 'required|string|max:10',
            'provinsi' => 'required|string|max:10'
           
          ]);
          
          $kota = Kota::find($request->id);
          
          
          $post = $kota->update([
                      'id_kota'=> $request->idkota,
                      'nama_kota' => $request->kota,
                      'id_provinsi' => $request->provinsi
                     
                  ]);
                  
          if($post){
              $notification = __('Kota berhasil diubah');
              $notification = ['messege' => $notification, 'alert-type' => 'success'];
              return redirect('admin/kota')->with($notification);
          } else {
              $notification = __('Terjadi kesalahan, gagal mengubah Kota');
              $notification = ['messege' => $notification, 'alert-type' => 'error'];
              return redirect()->back()->with($notification);
          }
  
              
	}

    

    public function kota_delete($id)
	{   
        
        $post = Kota::findOrFail($id);
        $post->delete();

		return redirect('admin/kota')->with('message', 'Kota  Berhasil dihapus');
    }

}