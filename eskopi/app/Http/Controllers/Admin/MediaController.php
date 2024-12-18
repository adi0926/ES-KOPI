<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class MediaController extends Controller
{

    public function media()
    {
        $media = Media::orderBy('id_media', 'desc')->get();
        return view('admin.media.media', compact(['media']));
    }

    public function add_media()
    {
        return view('admin.media.add_media');
    }

    public function media_store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required'
           
          ]);
        
        $post = Media::insert([
                    'judul' => $request->judul,
                    'url' => $request->url
                ]);

        return redirect('admin/media')->with('message', 'Media Berhasil Ditambahkan');
    }

    public function edit_media($id)
    {  
        $idmedia = Crypt::decrypt($id);
        $media = Media::where('id_media', '=' , $idmedia)->first();

		return view('admin.media.edit_media', compact(['media']));	    
	}
    public function media_update(Request $request)
    {    	
        $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required'
           
          ]);
          
          $media = Media::find($request->id);
          
          
          $post = $media->update([
                      'judul' => $request->judul,
                      'url'=> $request->url
                     
                  ]);
                  
          if($post){
              $notification = __('Media berhasil diubah');
              $notification = ['messege' => $notification, 'alert-type' => 'success'];
              return redirect('admin/media')->with($notification);
          } else {
              $notification = __('Terjadi kesalahan, gagal mengubah Media');
              $notification = ['messege' => $notification, 'alert-type' => 'error'];
              return redirect()->back()->with($notification);
          }
  
              
	}

    

    public function media_delete($id)
	{   
        $post = Media::findOrFail($id);
        $post->delete();

		return redirect('admin/media')->with('message', 'Media Diklat Berhasil dihapus');
    }

}