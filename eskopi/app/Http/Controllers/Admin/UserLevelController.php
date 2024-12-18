<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataDiklat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class UserLevelController extends Controller
{

    public function user_level()
    {
        $userLevel = MataDiklat::orderBy('created_at', 'desc')->get();
        return view('admin.user-level.user_level', compact(['userLevel']));
    }

    public function add_user_level()
    {
        return view('admin.user-level.add_user_level');
    }

    public function user_level_store(Request $request)
    {
        $post = MataDiklat::insert([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

        return redirect('admin/user-level')->with('message', 'Mata Diklat Berhasil ditambahkan');
    }

    public function edit_user_level($id)
    {  
        $iduserLevel = Crypt::decrypt($id);
        $userLevel = MataDiklat::where('id_mata_diklat', '=' , $iduserLevel)->first();

		return view('admin.user-level.edit_user_level', compact(['userLevel']));	    
	}

    public function user_level_update(Request $request)
    {    	
        $post = MataDiklat::where('id_mata_diklat', '=' , $request->id_mata_diklat)
                ->update([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->id_angkatan
                ]);

		return redirect('admin/user-level')->with('message', 'Mata Diklat Berhasil diubah');
	}

    public function user_level_delete($id)
	{   
        $post = MataDiklat::findOrFail($id);
        $post->delete();

		return redirect('admin/user-level')->with('message', 'Mata Diklat Berhasil dihapus');
    }

}