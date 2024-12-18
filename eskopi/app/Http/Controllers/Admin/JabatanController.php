<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class JabatanController extends Controller
{

    public function jabatan()
    {
        $jabatan = Jabatan::orderBy('id_jabatan', 'desc')->get();
        return view('admin.jabatan.jabatan', compact(['jabatan']));
    }

    public function add_jabatan()
    {
        return view('admin.jabatan.add_jabatan');
    }

    public function jabatan_store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255'
           
          ]);
        
        $post = Jabatan::insert([
                    'nama_jabatan' => $request->jabatan
                ]);

        return redirect('admin/jabatan')->with('message', 'Jabatan Berhasil Ditambahkan');
    }

    public function edit_jabatan($id)
    {  
        $idinstasi = Crypt::decrypt($id);
        $jabatan = Jabatan::where('id_jabatan', '=' , $idinstasi)->first();

		return view('admin.jabatan.edit_jabatan', compact(['jabatan']));	    
	}
    public function jabatan_update(Request $request)
    {    	
        $request->validate([
            'jabatan' => 'required|string|max:255'
           
          ]);
          
          $jabatan = Jabatan::find($request->id);
          
          
          $post = $jabatan->update([
                      'nama_jabatan' => $request->jabatan
                     
                  ]);
                  
          if($post){
              $notification = __('Jabatan berhasil diubah');
              $notification = ['messege' => $notification, 'alert-type' => 'success'];
              return redirect('admin/jabatan')->with($notification);
          } else {
              $notification = __('Terjadi kesalahan, gagal mengubah Jabatan');
              $notification = ['messege' => $notification, 'alert-type' => 'error'];
              return redirect()->back()->with($notification);
          }
  
              
	}

    

    public function jabatan_delete($id)
	{   
        $post = Jabatan::findOrFail($id);
        $post->delete();

		return redirect('admin/jabatan')->with('message', 'Jabatan  Berhasil dihapus');
    }

}