<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class BannerController extends Controller
{

    public function banner()
    {
        $banner = Slider::orderBy('id_slider', 'asc')->get();
        return view('admin.banner.banner', compact(['banner']));
    }

    public function add_banner()
    {
        return view('admin.banner.add_banner');
    }

    public function banner_store(Request $request)
    {
      
      $request->validate([
          'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
          'nama' => 'required|string|max:50',
          'tampilkan' => 'required|in:Y,N',
      ]);
  
      $imagePath = null;
      if ($request->hasFile('imagepath')) {
          $image = $request->file('imagepath');
          $imageName = time() . '-' . $image->getClientOriginalName();
          $image->move(public_path('frontend/img/banner/slider'), $imageName);
          $imagePath = 'frontend/img/banner/slider/' . $imageName;
      }
      
      $sliderCount = Slider::count();
      $urutanlast = $sliderCount + 1;
  
      $post = Slider::create([
          'nama' => $request->nama,
          'imagepath' => $imagePath,
          'tampilkan' => $request->tampilkan,
          'urutan' => $urutanlast,
      ]);
      
      if($post){
          $notification = __('Banner baru berhasil ditambahkan');
          $notification = ['messege' => $notification, 'alert-type' => 'success'];
          return redirect('admin/banner')->with($notification);
      } else {
          $notification = __('Terjadi kesalahan, gagal menambah banner');
          $notification = ['messege' => $notification, 'alert-type' => 'error'];
          return redirect()->back()->with($notification);
      }

      
    }

    public function edit_banner($id)
    {  
      $idslider = Crypt::decrypt($id);
      $banner = Slider::where('id_slider', '=' , $idslider)->first();
  
		  return view('admin.banner.edit_banner', compact(['banner']));	    
  	}

    public function banner_update(Request $request)
    {
      $request->validate([
        'nama' => 'required|string|max:50',
        'imagepath' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
        'tampilkan' => 'required|in:Y,N',
        'urutan' => 'required|integer|min:1',
      ]);
      
      $banner = Slider::find($request->id_slider);
      $imagePath = null;
      if ($request->hasFile('imagepath')) {
        $image = $request->file('imagepath');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('frontend/img/banner/slider'), $imageName);
        $imagePath = 'frontend/img/banner/slider/' . $imageName;

        if ($banner->imagepath && file_exists(public_path($banner->imagepath))) {
            unlink(public_path($banner->imagepath));
        }

      } else {
          $imagePath = $banner->imagepath;
      }
      
      $newOrder = $request->urutan;

      $existingBanner = Slider::where('urutan', $newOrder)->first();
  
      if ($existingBanner) {
          $existingBanner->update(['urutan' => $banner->urutan]);
      }
         	
      $post = $banner->update([
                'nama' => $request->nama,
                'imagepath' => $imagePath,
                'tampilkan' => $request->tampilkan,
                'urutan' => $newOrder,
            ]);
      
      if($post){
          $notification = __('Banner berhasil diubah');
          $notification = ['messege' => $notification, 'alert-type' => 'success'];
          return redirect('admin/banner')->with($notification);
      } else {
          $notification = __('Terjadi kesalahan, gagal mengubah banner');
          $notification = ['messege' => $notification, 'alert-type' => 'error'];
          return redirect()->back()->with($notification);
      }

  	}

    public function banner_delete($id)
	  {   
      $post = Slider::findOrFail($id);
      $post->delete();

		  return redirect('admin/banner')->with('message', 'Banner Berhasil dihapus');
    }

}