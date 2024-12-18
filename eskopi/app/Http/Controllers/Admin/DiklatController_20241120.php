<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diklat;
use App\Models\MataDiklat;
use App\Models\DiklatKategori;
use App\Models\DiklatAngkatan;
use App\Models\MataDiklatKonten;
use App\Models\TipeKonten;
use App\Models\MateriVideo;
use App\Models\MateriPdf;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class DiklatController extends Controller
{

    public function diklat()
    {
       //$menu = Menu::whereNull('parent_id')->get(); 
        $diklat = Diklat::with('kategori')->orderBy('id_diklat', 'desc')->get();
        return view('admin.diklat.diklat', compact('diklat'));
    }

    public function add_diklat()
    {
        $kategoris = DiklatKategori::orderBy('id_kategori', 'desc')->get();
        return view('admin.diklat.add_diklat', compact(['kategoris']));
    }

    public function diklat_store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'nama_diklat' => 'required|string|max:255',
            'kategori' => 'required|exists:diklat_kategori,id_kategori',
            'durasi' => 'required|integer|min:1',
            'publikasi' => 'required|in:Y,N',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
        ]);
        
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('frontend/img/diklat'), $imageName);
            $imagePath = 'frontend/img/diklat/' . $imageName;
        }
        
        $post = Diklat::create([
                    'nama_diklat' => $request->nama_diklat,
                    'id_kategori' => $request->kategori,
                    'gambar' => $imagePath,
                    'publikasi' => $request->publikasi,
                    'durasi' => $request->durasi,
                    'deskripsi' => $request->deskripsi,
                    'yang_dipelajari' => $request->yang_dipelajari,
                    'penyelenggara' => 'Kementerian Investasi dan Hilirisasi / BKPM',
                    'persyaratan' => $request->persyaratan,
                    'yang_diperoleh' => $request->yang_diperoleh,
                    'file_persyaratan' => $request->file_persyaratan
                ]);
        
        if($post){
            $notification = __('Diklat berhasil ditambahkan');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect('admin/diklat')->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menambah diklat');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }

    public function edit_diklat($id)
    {  
        $id_diklat = Crypt::decrypt($id);
        $kategoris = DiklatKategori::orderBy('id_kategori', 'desc')->get();
        $diklat = Diklat::where('id_diklat', '=' , $id_diklat)->first();
        
        $tipekontens = TipeKonten::orderBy('id_tipekonten', 'asc')->get(); 
        
        $diklatAngkatan = DiklatAngkatan::where('id_diklat', $id_diklat)->get();
        
        $angkatanIds = $diklatAngkatan->pluck('id_diklat_angkatan');
        
        $mataDiklatRecords = MataDiklat::with('angkatan')->whereIn('id_angkatan', $angkatanIds)->where('tipekonfig', 'materi')->orderBy('id_angkatan')->orderBy('urutan')->get();

  		return view('admin.diklat.edit_diklat', compact(['diklat','kategoris', 'diklatAngkatan','mataDiklatRecords','tipekontens']));	    
  	}

    public function diklat_update(Request $request)
    {   
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'nama_diklat' => 'required|string|max:255',
            'kategori' => 'required|exists:diklat_kategori,id_kategori',
            'durasi' => 'required|integer|min:1',
            'publikasi' => 'required|in:Y,N',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
        ]);
        
        $diklat = Diklat::find($request->id_diklat);
        
        $imagePath = null;
        if ($request->hasFile('gambar')) {
          $image = $request->file('gambar');
          $imageName = time() . '-' . $image->getClientOriginalName();
          $image->move(public_path('frontend/img/diklat'), $imageName);
          $imagePath = 'frontend/img/diklat/' . $imageName;
  
          if ($diklat->gambar && file_exists(public_path($diklat->gambar))) {
              unlink(public_path($diklat->gambar));
          }
  
        } else {
            $imagePath = $diklat->gambar;
        }
        
        
        $post = $diklat->update([
                    'nama_diklat' => $request->nama_diklat,
                    'id_kategori' => $request->kategori,
                    'gambar' => $imagePath,
                    'publikasi' => $request->publikasi,
                    'durasi' => $request->durasi,
                    'deskripsi' => $request->deskripsi,
                    'yang_dipelajari' => $request->yang_dipelajari,
                    'penyelenggara' => 'Kementerian Investasi dan Hilirisasi / BKPM',
                    'persyaratan' => $request->persyaratan,
                    'yang_diperoleh' => $request->yang_diperoleh,
                    'file_persyaratan' => $request->file_persyaratan
                ]);
                
        if($post){
            $notification = __('Diklat berhasil diubah');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect('admin/diklat')->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal mengubah diklat');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

  		  
  	}

    public function diklat_delete($id)
	  {   
        $post = Diklat::findOrFail($id);
        $post->delete();

	    return redirect('admin/diklat')->with('message', 'Diklat Berhasil dihapus');
    }
    

    public function diklatangkatan($id)
    {  
        $id_diklat = Crypt::decrypt($id);

        $diklat = Diklat::where('id_diklat', '=' , $id_diklat)->first();
        $diklatAngkatan = DiklatAngkatan::where('id_diklat', $id_diklat)->get();
        $hasZeroTipeAngkatan = $diklatAngkatan->contains('tipe_angkatan', 0);
        $hasOneTipeAngkatan = $diklatAngkatan->contains('tipe_angkatan', 1);
  		return view('admin.diklat.angkatan.angkatan', compact(['diklat','diklatAngkatan','hasZeroTipeAngkatan','hasOneTipeAngkatan']));	    
  	}

    public function diklatangkatan_store(Request $request)
    {
        $request->validate([
            'nama_angkatan' => 'required|string|max:255',
            'kuota_peserta' => 'required|integer|min:1',
            'tanggal_akhir_pendaftaran' => 'required|date|after_or_equal:today',
            'diklat_mulai' => 'required|date|before:diklat_selesai',
            'diklat_selesai' => 'required|date|after:diklat_mulai',
            'tipe' => 'required|in:0,1',
        ]);
        
        $post = DiklatAngkatan::create([
                    'id_diklat' => $request->id_diklat,
                    'nama_angkatan' => $request->nama_angkatan,
                    'diklat_mulai' => $request->diklat_mulai,
                    'diklat_selesai' => $request->diklat_selesai,
                    'tanggal_akhir_pendaftaran' => $request->tanggal_akhir_pendaftaran,
                    'kuota_peserta' => $request->kuota_peserta,
                    'tipe_angkatan' => $request->tipe
                ]);
        
        $pembukaan = MataDiklat::create([
                    'mata_diklat' => 'Pembukaan',
                    'publikasi' => 'Y',
                    'id_angkatan' => $post->id_diklat_angkatan,
                    'deskripsi' => '',
                    'urutan' => 1,
                    'tipekonfig' => 'fix',
                ]);
                
                
        $pretest = MataDiklat::create([
                    'mata_diklat' => 'Pre Test',
                    'publikasi' => 'Y',
                    'id_angkatan' => $post->id_diklat_angkatan,
                    'deskripsi' => '',
                    'urutan' => 2,
                    'tipekonfig' => 'fix',
                ]);
        
        $posttest = MataDiklat::create([
                    'mata_diklat' => 'Post Test',
                    'publikasi' => 'Y',
                    'id_angkatan' => $post->id_diklat_angkatan,
                    'deskripsi' => '',
                    'urutan' => 100,
                    'tipekonfig' => 'fix',
                ]);
                
        $evalpenyelenggara = MataDiklat::create([
                    'mata_diklat' => 'Evaluasi Penyelenggara',
                    'publikasi' => 'Y',
                    'id_angkatan' => $post->id_diklat_angkatan,
                    'deskripsi' => '',
                    'urutan' => 101,
                    'tipekonfig' => 'fix',
                ]);
                
        $evalpengajar = MataDiklat::create([
                    'mata_diklat' => 'Evaluasi Pengajar',
                    'publikasi' => 'Y',
                    'id_angkatan' => $post->id_diklat_angkatan,
                    'deskripsi' => '',
                    'urutan' => 102,
                    'tipekonfig' => 'fix',
                ]);
                
                        
        if($post){
            $notification = __('Angkatan berhasil ditambahkan');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menambah angkatan');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }
    
    public function diklatangkatan_delete($id)
	  {   
        $post = DiklatAngkatan::findOrFail($id);
        $post->delete();

        $mataDiklats = MataDiklat::where('id_angkatan', $id)->get();

        foreach ($mataDiklats as $mataDiklat) {
            $mataDiklat->delete();
        }

	    if($post){
            $notification = __('Angkatan berhasil dihapus');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menghapus angkatan');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }
    
    public function diklatangkatan_edit($id)
    {
        $angkatan = DiklatAngkatan::find($id);

        if (!$angkatan) {
            return response()->json(['error' => 'Angkatan not found'], 404);
        }

        return response()->json($angkatan);
    }
    
    public function diklatangkatan_update(Request $request, $id)
    {
        $angkatan = DiklatAngkatan::find($id);

        if (!$angkatan) {
            $notification = __('Terjadi kesalahan, Angkatan tidak ada');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $request->validate([
            'nama_angkatan' => 'required|string|max:255',
            'kuota_peserta' => 'required|integer',
            'tanggal_akhir_pendaftaran' => 'required|date',
            'diklat_mulai' => 'required|date',
            'diklat_selesai' => 'required|date',
        ]);

        $angkatan->update([
            'nama_angkatan' => $request->input('nama_angkatan'),
            'kuota_peserta' => $request->input('kuota_peserta'),
            'tanggal_akhir_pendaftaran' => $request->input('tanggal_akhir_pendaftaran'),
            'diklat_mulai' => $request->input('diklat_mulai'),
            'diklat_selesai' => $request->input('diklat_selesai'),
        ]);

        $notification = __('Angkatan berhasil diupdate');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
    
    public function matadiklat($id)
    {  
        $id_diklat = Crypt::decrypt($id);

        $diklat = Diklat::where('id_diklat', '=' , $id_diklat)->first();
        $tipekontens = TipeKonten::orderBy('id_tipekonten', 'asc')->get();
        $diklatAngkatan = DiklatAngkatan::where('id_diklat', $id_diklat)->get();
        $hasZeroTipeAngkatan = $diklatAngkatan->contains('tipe_angkatan', 0);
        $angkatanIds = $diklatAngkatan->pluck('id_diklat_angkatan');
        $mataDiklatRecords = MataDiklat::with('angkatan')->whereIn('id_angkatan', $angkatanIds)->where('tipekonfig', 'materi')->orderBy('id_angkatan')->orderBy('urutan')->get();
  		  return view('admin.diklat.matadiklat.matadiklat', compact(['diklat','diklatAngkatan','mataDiklatRecords','tipekontens','hasZeroTipeAngkatan']));	    
  	}
    
    public function matadiklat_store(Request $request)
    {
        
        $request->validate([
            'angkatan' => 'required|exists:diklat_angkatan,id_diklat_angkatan',
            'mata_diklat' => 'required|string|max:100',
            'publikasi' => 'required|in:Y,N',
        ]);
        
        $count = MataDiklat::where('id_angkatan', $request->angkatan)
                ->where('tipekonfig', 'materi')
                ->count();
        
        $urutanValue = $count + 3;
        
        $post = MataDiklat::create([
                    'mata_diklat' => $request->mata_diklat,
                    'publikasi' => $request->publikasi,
                    'id_angkatan' => $request->angkatan,
                    'urutan' => $urutanValue,
                    'tipekonfig' => 'materi',
                ]);
                
                        
        if($post){
            $notification = __('Mata diklat berhasil ditambahkan');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menambah mata diklat');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }
    
    public function matadiklat_delete($id)
	  {   
        $post = MataDiklat::findOrFail($id);
        $post->delete();

	    	if($post){
            $notification = __('Mata diklat berhasil dihapus');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menghapus mata diklat');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }
    
    
    public function matadiklat_edit($id)
    {
        $matadiklat = MataDiklat::find($id);

        if (!$matadiklat) {
            return response()->json(['error' => 'Mata Diklat not found'], 404);
        }

        return response()->json($matadiklat);
    }
    
    public function matadiklat_update(Request $request, $id)
    {
        $matadiklat = MataDiklat::find($id);

        if (!$matadiklat) {
            $notification = __('Terjadi kesalahan, Mata Diklat tidak ditemukan');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $request->validate([
            'angkatan' => 'required|exists:diklat_angkatan,id_diklat_angkatan',
            'mata_diklat' => 'required|string|max:100',
            'publikasi' => 'required|in:Y,N',
        ]);

        $matadiklat->update([
            'angkatan' => $request->input('angkatan'),
            'mata_diklat' => $request->input('mata_diklat'),
            'publikasi' => $request->input('publikasi'),
        ]);

        $notification = __('Mata diklat berhasil diupdate');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
    
    
    public function kontendiklat_store(Request $request)
    {
        $request->validate([
            'tipe_konten' => 'required',
        ]);
        
        if ($request->tipe_konten === '1') {
            $request->validate([
                    'judul_video' => 'required|string|max:255',
                    'url_video' => 'required|url',
                    'durasi_video' => 'required|integer'
                ]);
                
            $konten = MateriVideo::create([
                    'judul_materi' => $request->judul_video,
                    'url_materi' => $request->url_video,
                    'id_mata_diklat' => $request->mata_diklat_id,
                    'durasi' => $request->durasi_video,
                ]);
                
        } elseif ($request->tipe_konten === '2') {
            $request->validate([
                'judul_pdf' => 'required|string|max:255',
                'url_pdf' => 'required|url',
                'durasi_pdf' => 'required|integer'
            ]);
            
            $konten = MateriPdf::create([
                    'judul_materi' => $request->judul_pdf,
                    'url_materi' => $request->url_pdf,
                    'id_mata_diklat' => $request->mata_diklat_id,
                    'durasi' => $request->durasi_pdf,
                ]);
        }
        
        $maxUrutan = MataDiklatKonten::where('id_mata_diklat', $request->mata_diklat_id)
            ->where('id_tipe_konten', $request->tipe_konten)
            ->max('urutan');
        
        $urutan = $maxUrutan ? $maxUrutan + 1 : 1;
        
        $post = MataDiklatKonten::create([
                'id_konten' => $konten->id_materi,
                'id_mata_diklat' => $request->mata_diklat_id,
                'id_tipe_konten' => $request->tipe_konten,
                'urutan' => $urutan,
            ]);
        
        
                        
        if($post){
            $notification = __('Konten diklat berhasil ditambahkan');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menambah konten diklat');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }
    
    public function kontendiklat($id)
    {
        $matadiklatkonten = MataDiklatKonten::where('id_mata_diklat', $id)
            ->orderBy('id_tipe_konten')
            ->orderBy('urutan')
            ->with(['materiVideo', 'materiPdf'])
            ->get()
            ->map(function ($konten) {
                return [
                    'id_tipe_konten' => $konten->id_tipe_konten == 1 
                        ? 'Video' 
                        : ($konten->id_tipe_konten == 2 ? 'PDF' : 'Unknown'),
                    'nama_konten' => $konten->id_tipe_konten == 1 
                        ? $konten->materiVideo->judul_materi 
                        : ($konten->id_tipe_konten == 2 ? $konten->materiPdf->judul_materi : 'Unknown'),
                    'durasi' => $konten->id_tipe_konten == 1 
                        ? ($konten->materiVideo->durasi ?: 0) 
                        : ($konten->id_tipe_konten == 2 ? ($konten->materiPdf->durasi ?: 0) : 0),
                ];
            });
        return response()->json($matadiklatkonten);
    }
    
    

}