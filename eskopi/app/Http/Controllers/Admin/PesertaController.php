<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class PesertaController extends Controller
{

    public function peserta()
    {
        $peserta = Pengguna::orderBy('created_at', 'desc')->get();
        return view('admin.peserta.peserta', compact(['peserta']));
    }

    public function add_peserta()
    {
        return view('admin.peserta.add_peserta');
    }

    public function peserta_store(Request $request)
    {
        $post = Pengguna::insert([
                    'nip' => $request->nip,
                    'email' => $request->email,
                    'notelp' => $request->notelp
                ]);

        return redirect('admin/peserta')->with('message', 'Peserta Berhasil ditambahkan');
    }

    public function edit_peserta($id)
    {  
        $idpeserta = Crypt::decrypt($id);
        $peserta = Pengguna::where('id_pengguna', '=' , $idpeserta)->first();

		return view('admin.peserta.edit_peserta', compact(['peserta']));	    
	}

    public function peserta_update(Request $request)
    {    	
        $post = Pengguna::where('id_pengguna', '=' , $request->id_pengguna)
                ->update([
                    'nip' => $request->nip,
                    'email' => $request->email,
                    'notelp' => $request->notelp
                ]);

		return redirect('admin/peserta')->with('message', 'Peserta Berhasil diubah');
	}

    public function peserta_delete($id)
	{   
        $post = Pengguna::findOrFail($id);
        $post->delete();

		return redirect('admin/peserta')->with('message', 'Peserta Berhasil dihapus');
    }

}