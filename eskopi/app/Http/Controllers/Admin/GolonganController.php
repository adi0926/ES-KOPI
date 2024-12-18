<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Golongan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class GolonganController extends Controller
{

    public function golongan()
    {
        $golongan = Golongan::orderBy('id_golongan', 'desc')->get();
        return view('admin.golongan.golongan', compact(['golongan']));
    }

    public function add_golongan()
    {
        return view('admin.golongan.add_golongan');
    }

    public function golongan_store(Request $request)
    {
        $request->validate([
            'golongan' => 'required|string|max:255'
           
          ]);
        
        $post = Golongan::insert([
                    'nama_golongan' => $request->golongan
                ]);

        return redirect('admin/golongan')->with('message', 'Golongan Berhasil Ditambahkan');
    }

    public function edit_golongan($id)
    {  
        $idinstasi = Crypt::decrypt($id);
        $golongan = Golongan::where('id_golongan', '=' , $idinstasi)->first();

		return view('admin.golongan.edit_golongan', compact(['golongan']));	    
	}
    public function golongan_update(Request $request)
    {    	
        $request->validate([
            'golongan' => 'required|string|max:255'
           
          ]);
          
          $golongan = Golongan::find($request->id);
          
          
          $post = $golongan->update([
                      'nama_golongan' => $request->golongan
                     
                  ]);
                  
          if($post){
              $notification = __('Golongan berhasil diubah');
              $notification = ['messege' => $notification, 'alert-type' => 'success'];
              return redirect('admin/golongan')->with($notification);
          } else {
              $notification = __('Terjadi kesalahan, gagal mengubah Golongan');
              $notification = ['messege' => $notification, 'alert-type' => 'error'];
              return redirect()->back()->with($notification);
          }
  
              
	}

    

    public function golongan_delete($id)
	{   
        $post = Golongan::findOrFail($id);
        $post->delete();

		return redirect('admin/golongan')->with('message', 'Golongan  Berhasil dihapus');
    }

}