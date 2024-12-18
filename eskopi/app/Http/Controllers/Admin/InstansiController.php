<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class InstansiController extends Controller
{

    public function instansi()
    {
        $instansi = Instansi::orderBy('id_instansi', 'desc')->get();
        return view('admin.instansi.instansi', compact(['instansi']));
    }

    public function add_instansi()
    {
        return view('admin.instansi.add_instansi');
    }

    public function instansi_store(Request $request)
    {
        $request->validate([
            'instansi' => 'required|string|max:255'
           
          ]);
        
        $post = Instansi::insert([
                    'nama_instansi' => $request->instansi
                ]);

        return redirect('admin/instansi')->with('message', 'Instansi Berhasil Ditambahkan');
    }

    public function edit_instansi($id)
    {  
        $idinstasi = Crypt::decrypt($id);
        $instansi = Instansi::where('id_instansi', '=' , $idinstasi)->first();

		return view('admin.instansi.edit_instansi', compact(['instansi']));	    
	}
    public function instansi_update(Request $request)
    {    	
        $request->validate([
            'instansi' => 'required|string|max:255'
           
          ]);
          
          $instansi = Instansi::find($request->id);
          
          
          $post = $instansi->update([
                      'nama_instansi' => $request->instansi
                     
                  ]);
                  
          if($post){
              $notification = __('Instansi berhasil diubah');
              $notification = ['messege' => $notification, 'alert-type' => 'success'];
              return redirect('admin/instansi')->with($notification);
          } else {
              $notification = __('Terjadi kesalahan, gagal mengubah Instansi');
              $notification = ['messege' => $notification, 'alert-type' => 'error'];
              return redirect()->back()->with($notification);
          }
  
              
	}

    

    public function instansi_delete($id)
	{   
        $post = Instansi::findOrFail($id);
        $post->delete();

		return redirect('admin/instansi')->with('message', 'Instansi  Berhasil dihapus');
    }

}