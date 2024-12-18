<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ProvinsiController extends Controller
{

    public function provinsi()
    {
        $provinsi = Provinsi::orderBy('id_provinsi', 'desc')->get();
        return view('admin.provinsi.provinsi', compact(['provinsi']));
    }

    public function add_provinsi()
    {
        return view('admin.provinsi.add_provinsi');
    }

    public function provinsi_store(Request $request)
    {
        $request->validate([
            'provinsi' => 'required|string|max:255',
            'idprovinsi' => 'required|string|max:10'
           
          ]);
        
        $post = Provinsi::insert([
                    'id_provinsi' => $request->idprovinsi,
                    'nama_provinsi' => $request->provinsi
                ]);

        return redirect('admin/provinsi')->with('message', 'Provinsi Berhasil Ditambahkan');
    }

    public function edit_provinsi($id)
    {  
        $idinstasi = Crypt::decrypt($id);
        $provinsi = Provinsi::where('id_provinsi', '=' , $idinstasi)->first();

		return view('admin.provinsi.edit_provinsi', compact(['provinsi']));	    
	}
    public function provinsi_update(Request $request)
    {    	
        $request->validate([
            'provinsi' => 'required|string|max:255',
            'idprovinsi' => 'required|string|max:10'
           
          ]);
          
          $provinsi = Provinsi::find($request->id);
          
          
          $post = $provinsi->update([
                      'nama_provinsi' => $request->provinsi
                     
                  ]);
                  
          if($post){
              $notification = __('Provinsi berhasil diubah');
              $notification = ['messege' => $notification, 'alert-type' => 'success'];
              return redirect('admin/provinsi')->with($notification);
          } else {
              $notification = __('Terjadi kesalahan, gagal mengubah Provinsi');
              $notification = ['messege' => $notification, 'alert-type' => 'error'];
              return redirect()->back()->with($notification);
          }
  
              
	}

    

    public function provinsi_delete($id)
	{   
        
        $post = Provinsi::findOrFail($id);
        $post->delete();

		return redirect('admin/provinsi')->with('message', 'Provinsi  Berhasil dihapus');
    }

}