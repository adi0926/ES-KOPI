<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class LevelController extends Controller
{

    public function level()
    {
        $level = Level::orderBy('id_role', 'desc')->get();
        return view('admin.level.level', compact(['level']));
    }

    public function add_level()
    {
        $diklats = Level::orderBy('id_role', 'asc')->get();
        return view('admin.level.add_level');
    }

    public function level_store(Request $request)
    {
        $request->validate([
           
            'nama_role' => 'required|string|max:255'
           
           
        ]);
        
        $post = Level::insert([
                    'nama_role' => $request->nama_role


                ]);

                if($post){
                    $notification = __('Level berhasil ditambahkan');
                    $notification = ['messege' => $notification, 'alert-type' => 'success'];
                    return redirect('admin/level')->with($notification);
                } else {
                    $notification = __('Terjadi kesalahan, gagal menambah user');
                    $notification = ['messege' => $notification, 'alert-type' => 'Level'];
                    return redirect()->back()->with($notification);
                }
    }

    public function edit_level($id)
    {  
        $id = Crypt::decrypt($id);
        $level = Level::where('id_role', '=' , $id)->first();
       // @dd($user);
		return view('admin.level.edit_level', compact(['level']));	    
	}

    public function level_update(Request $request)
    {    	
        $request->validate([
            'nama_role' => 'required|string|max:255'
           
          ]);
          
          $level = Level::find($request->id);
          
          
          $post = $level->update([
                      'nama_role' => $request->nama_role
                     
                  ]);
                  
          if($post){
              $notification = __('Level berhasil diubah');
              $notification = ['messege' => $notification, 'alert-type' => 'success'];
              return redirect('admin/level')->with($notification);
          } else {
              $notification = __('Terjadi kesalahan, gagal mengubah Level');
              $notification = ['messege' => $notification, 'alert-type' => 'error'];
              return redirect()->back()->with($notification);
          }
  
              
	}

    public function level_delete($id)
	{   
        $post = Level::findOrFail($id);
        $post->delete();

		return redirect('admin/level')->with('message', 'Level Berhasil dihapus');
    }

}