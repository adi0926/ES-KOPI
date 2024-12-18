<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diklat;
use App\Models\MataDiklat;
use App\Models\MasterMataDiklat;
use App\Models\DiklatKategori;
use App\Models\DiklatAngkatan;
use App\Models\MataDiklatKonten;
use App\Models\TipeKonten;
use App\Models\MateriVideo;
use App\Models\MateriPdf;
use App\Models\MateriSoal;
use App\Models\MateriLain;
use App\Models\MateriVclass;
use App\Models\MateriEvalpenyelenggara;
use App\Models\MateriEvalpengajar;
use App\Models\SoalMateri;
use App\Models\SoalEvaluasipenyelenggara;
use App\Models\SoalEvaluasipengajar;
use App\Models\Menu;
use App\Models\Soal;
use App\Models\BankSoal;
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
        return view('admin.diklat.diklat', compact(['diklat']));
    }

    public function publish($id)
    {
        $diklat = Diklat::find($id);
        if ($diklat) {
            $diklat->publikasi = 'Y';
            $diklat->save();
            $notification = __('Diklat berhasil dipublish!');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        }

        $notification = __('Terjadi kesalahan, gagal publish diklat');
        $notification = ['messege' => $notification, 'alert-type' => 'error'];
        return redirect()->back()->with($notification);
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
            'jp' => 'required|integer|min:1',
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
                    'jp' => $request->jp,
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
            'jp' => 'required|integer|min:1',
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
                    'jp' => $request->jp,
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

        // auto create konten untuk pembukaan
        $kontenpembukaan = MateriLain::create([
                        'judul_materi' => 'Pembukaan',
                        'id_mata_diklat' => $pembukaan->id_mata_diklat,
                    ]);

        $matadiklatkontenpembukaan = MataDiklatKonten::create([
                    'id_konten' => $kontenpembukaan->id_materi,
                    'id_mata_diklat' => $kontenpembukaan->id_mata_diklat,
                    'id_tipe_konten' => 0,
                    'urutan' => 1,
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
        $masterMataDiklat = MasterMataDiklat::orderBy('mata_diklat','asc')->get();
        
        $hasZeroTipeAngkatan = $diklatAngkatan->contains('tipe_angkatan', 0);
        
        $angkatanIds = $diklatAngkatan->pluck('id_diklat_angkatan');
        
        // $mataDiklatRecords = MataDiklat::with('angkatan')->whereIn('id_angkatan', $angkatanIds)->where('tipekonfig', 'materi')->orderBy('id_angkatan')->orderBy('urutan')->get();
        $mataDiklatRecords = MataDiklat::with('angkatan')->whereIn('id_angkatan', $angkatanIds)->orderBy('id_angkatan')->orderBy('urutan')->get();
  		return view('admin.diklat.matadiklat.matadiklat', compact(['diklat','diklatAngkatan','mataDiklatRecords','tipekontens','hasZeroTipeAngkatan','masterMataDiklat']));	    
  	}

    public function matadiklat_store(Request $request)
    {
        
        $request->validate([
            'angkatan' => 'required|exists:diklat_angkatan,id_diklat_angkatan',
            'mata_diklat' => 'required|string|max:100',
            'publikasi' => 'required|in:Y,N',
        ]);

        $datamaster = MasterMataDiklat::where('id_master_mata_diklat', $request->mata_diklat)->first();
        
        $count = MataDiklat::where('id_angkatan', $request->angkatan)
                ->where('tipekonfig', 'materi')
                ->count();
        
        $urutanValue = $count + 3;
        
        $post = MataDiklat::create([
                    'mata_diklat' => $datamaster->mata_diklat,
                    'deskripsi' => $datamaster->deskripsi,
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
    
    public function matadiklat_store_old_backup(Request $request)
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
                    'url_video' => 'required|string',
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
                'url_pdf' => 'required',
                'durasi_pdf' => 'required|integer'
            ]);
            
            //tambahan adi
            $imagePath = null;
            if ($request->hasFile('url_pdf')) {
                $image = $request->file('url_pdf');
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads/materipdf'), $imageName);
                $imagePath = 'uploads/materipdf/' . $imageName;
            }
            //
            $konten = MateriPdf::create([
                    'judul_materi' => $request->judul_pdf,
                    'url_materi' => $imagePath,
                    'id_mata_diklat' => $request->mata_diklat_id,
                    'durasi' => $request->durasi_pdf,
                ]);
        } elseif ($request->tipe_konten === '9') {
            $request->validate([
                'judul_soal' => 'required|string|max:255',
                'tipe_soal' => 'required|in:pretest,posttest,ujian,evaluasi',
                'durasi_soal' => 'required|integer'
            ]);
            
            $konten = MateriSoal::create([
                    'judul_soal' => $request->judul_soal,
                    'tipe' => $request->tipe_soal,
                    'id_mata_diklat' => $request->mata_diklat_id,
                    'durasi' => $request->durasi_soal,
                ]);
        } elseif ($request->tipe_konten === '0') {
            $request->validate([
                'judul_konten' => 'required|string|max:255',
            ]);
                
            $konten = MateriLain::create([
                'judul_materi' => $request->judul_konten,
                'id_mata_diklat' => $request->mata_diklat_id,
            ]);
                
        } elseif ($request->tipe_konten === '4') {
            $request->validate([
                    'judul_vclass' => 'required|string|max:255',
                    'url_vclass' => 'required|url',
                    'durasi_vclass' => 'required|integer'
                ]);
            
            $konten = MateriVclass::create([
                    'judul_materi' => $request->judul_vclass,
                    'url_materi' => $request->url_vclass,
                    'id_mata_diklat' => $request->mata_diklat_id,
                    'durasi' => $request->durasi_vclass,
                ]);
        } elseif ($request->tipe_konten === '20') {
            $request->validate([
                    'judul_eval_a' => 'required|string|max:255',
                    'penyelenggara' => 'required|string',
                    'durasi_eval_a' => 'required|integer'
                ]);
            
            $konten = MateriEvalpenyelenggara::create([
                    'judul_evaluasi' => $request->judul_eval_a,
                    'penyelenggara' => $request->penyelenggara,
                    'id_mata_diklat' => $request->mata_diklat_id,
                    'durasi' => $request->durasi_eval_a,
                ]);
        } elseif ($request->tipe_konten === '21') {
            $request->validate([
                    'judul_eval_b' => 'required|string|max:255',
                    'pengajar' => 'required|string',
                    'durasi_eval_b' => 'required|integer'
                ]);
            
            $konten = MateriEvalpengajar::create([
                    'judul_evaluasi' => $request->judul_eval_b,
                    'pengajar' => $request->pengajar,
                    'id_mata_diklat' => $request->mata_diklat_id,
                    'durasi' => $request->durasi_eval_b,
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
            ->with(['materiVideo', 'materiPdf', 'materiSoal', 'materiLain', 'materiVclass', 'materiEvalpenyelenggara', 'materiEvalpengajar'])
            ->get()
            ->map(function ($konten) {

                $id_konten_crypt = Crypt::encrypt($konten->id_konten);
                $buttonUrl = null;
                if ($konten->id_tipe_konten == 1) {
                    $buttonUrl = route('admin.viewkonten-video');
                } elseif ($konten->id_tipe_konten == 2) {
                    $buttonUrl = route('admin.viewkonten-pdf', ['id' => $id_konten_crypt]);
                } elseif ($konten->id_tipe_konten == 9) {
                    $buttonUrl = route('admin.viewkonten-soal', ['id' => $id_konten_crypt]);
                } elseif ($konten->id_tipe_konten == 0) {
                    $buttonUrl = route('admin.viewkonten-video');
                } elseif ($konten->id_tipe_konten == 4) {
                    $buttonUrl = route('admin.viewkonten-video');
                } elseif ($konten->id_tipe_konten == 20) {
                    $buttonUrl = route('admin.viewkonten-evalpenyelenggara', ['id' => $id_konten_crypt]);
                } elseif ($konten->id_tipe_konten == 21) {
                    $buttonUrl = route('admin.viewkonten-evalpengajar', ['id' => $id_konten_crypt]);
                }


                return [
                    'id_tipe_konten' => $konten->id_tipe_konten == 1 
                        ? 'Video' 
                        : ($konten->id_tipe_konten == 2 
                            ? 'PDF' 
                            : ($konten->id_tipe_konten == 9 
                                ? 'Soal/Ujian' 
                                : ($konten->id_tipe_konten == 0 
                                    ? 'Pembukaan' 
                                    : ($konten->id_tipe_konten == 4 
                                        ? 'Virtual Class'
                                        : ($konten->id_tipe_konten == 20 
                                            ? 'Evaluasi Penyelenggara'
                                            : ($konten->id_tipe_konten == 21 
                                                ? 'Evaluasi Pengajar'
                                                : 'Unknown')))))),
                    'nama_konten' => $konten->id_tipe_konten == 1 
                        ? $konten->materiVideo->judul_materi 
                        : ($konten->id_tipe_konten == 2 
                            ? $konten->materiPdf->judul_materi 
                            : ($konten->id_tipe_konten == 9 
                                ? $konten->materiSoal->judul_soal 
                                : ($konten->id_tipe_konten == 0 
                                    ? $konten->materiLain->judul_materi 
                                    : ($konten->id_tipe_konten == 4 
                                        ? $konten->materiVclass->judul_materi
                                        : ($konten->id_tipe_konten == 20 
                                            ? $konten->materiEvalpenyelenggara->judul_evaluasi
                                            : ($konten->id_tipe_konten == 21 
                                                ? $konten->materiEvalpengajar->judul_evaluasi 
                                                : 'Unknown')))))),
                    'durasi' => $konten->id_tipe_konten == 1 
                        ? ($konten->materiVideo->durasi ?: 0) 
                        : ($konten->id_tipe_konten == 2 
                            ? ($konten->materiPdf->durasi ?: 0) 
                            : ($konten->id_tipe_konten == 9 
                                ? ($konten->materiSoal->durasi ?: 0) 
                                : ($konten->id_tipe_konten == 0 
                                    ? ($konten->materiLain->durasi ?: 0) 
                                    : ($konten->id_tipe_konten == 4 
                                        ? ($konten->materiVclass->durasi ?: 0)
                                        : ($konten->id_tipe_konten == 20 
                                            ? ($konten->materiEvalpenyelenggara->durasi ?: 0) 
                                            : ($konten->id_tipe_konten == 21 
                                                ? ($konten->materiEvalpengajar->durasi ?: 0) 
                                                : 0)))))),
                    'button_url' => $buttonUrl,
                ];
            });

        return response()->json($matadiklatkonten);
    }

    public function viewkonten_soal($id)
    {
        $id = Crypt::decrypt($id);
        $materisoal = MateriSoal::with(['mataDiklat.angkatan'])
            ->withCount('soals')
            ->where('id_materi', $id)
            ->first();

        $id_diklat = $materisoal?->mataDiklat?->angkatan?->id_diklat;
        
        $bankSoalList = BankSoal::all();

        $listmaterisoal = SoalMateri::where('id_materi_soal', $id)->orderBy('id')->get();
        return view('admin.diklat.konten.viewkonten-soal', compact(['listmaterisoal','materisoal','id_diklat','bankSoalList']));
    }

    public function addkonten_soal($id)
    {
        $idMateriSoal = Crypt::decrypt($id);
        $materiSoal = MateriSoal::with(['mataDiklat.angkatan'])->where('id_materi', '=' , $idMateriSoal)->first();

        $id_diklat = $materiSoal?->mataDiklat?->angkatan?->id_diklat;

        return view('admin.diklat.konten.addkonten-soal', compact(['materiSoal','id_diklat']));
    }

    public function storekonten_soal(Request $request)
    {
        $request->validate([
            'tipesoal' => 'required|in:1,2',
            'pertanyaan' => 'required|string',
            'optA' => 'required|string',
            'optB' => 'required|string',
            'optC' => 'required|string',
            'optD' => 'required|string',
            'optE' => 'required|string',
            'answer' => 'required|in:A,B,C,D,E',
        ], [
            'tipesoal.required' => 'Tipe Soal wajib dipilih',
            'pertanyaan.required' => 'Pertanyaan wajib diisi',
            'optA.required' => 'Pilihan A wajib diisi',
            'optB.required' => 'Pilihan B wajib diisi',
            'optC.required' => 'Pilihan C wajib diisi',
            'optD.required' => 'Pilihan D wajib diisi',
            'optE.required' => 'Pilihan E wajib diisi',
            'answer.required' => 'Kunci Jawaban wajib diisi',
        ]);

        $id_materi_soal = Crypt::encrypt($request->id_materi_soal);

        $post = SoalMateri::create([
            'id_materi_soal' => $request->id_materi_soal,
            'soal' => $request->pertanyaan,
            'pilihan_a' => $request->optA,
            'pilihan_b' => $request->optB,
            'pilihan_c' => $request->optC,
            'pilihan_d' => $request->optD,
            'pilihan_e' => $request->optE,
            'kunci_jawaban' => $request->answer,
            'tipe_soal' => $request->tipesoal,
            
        ]);

        if($post){
            $notification = __('Soal berhasil ditambahkan');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect("admin/viewkonten-soal/{$id_materi_soal}")->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menambah Soal');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }

    public function editkonten_soal($idmateri, $idsoal)
    {
        $idMateriSoal = Crypt::decrypt($idmateri);
        $materiSoal = MateriSoal::with(['mataDiklat.angkatan'])->where('id_materi', '=' , $idMateriSoal)->first();
        $idSoal = Crypt::decrypt($idsoal);
        $Soal = SoalMateri::where('id', '=' , $idSoal)->first();

        $id_diklat = $materiSoal?->mataDiklat?->angkatan?->id_diklat;

		return view('admin.diklat.konten.editkonten-soal', compact(['Soal','materiSoal','id_diklat']));	    
	}

    public function updatekonten_soal(Request $request)
    {
        $status_e = $request->statusE;

        if($status_e === 'active'){
            $request->validate([
                'tipesoal' => 'required|in:1,2',
                'pertanyaan' => 'required|string',
                'optA' => 'required|string',
                'optB' => 'required|string',
                'optC' => 'required|string',
                'optD' => 'required|string',
                'optE' => 'required|string',
                'answer' => 'required|in:A,B,C,D,E',
            ], [
                'tipesoal.required' => 'Tipe Soal wajib dipilih',
                'pertanyaan.required' => 'Pertanyaan wajib diisi',
                'optA.required' => 'Pilihan A wajib diisi',
                'optB.required' => 'Pilihan B wajib diisi',
                'optC.required' => 'Pilihan C wajib diisi',
                'optD.required' => 'Pilihan D wajib diisi',
                'optE.required' => 'Pilihan E wajib diisi',
                'answer.required' => 'Kunci Jawaban wajib diisi',
            ]);
    
            $soal = SoalMateri::find($request->id_soal);
    
            $post = $soal->update([
                'id_materi_soal' => $request->id_materi_soal,
                'soal' => $request->pertanyaan,
                'pilihan_a' => $request->optA,
                'pilihan_b' => $request->optB,
                'pilihan_c' => $request->optC,
                'pilihan_d' => $request->optD,
                'pilihan_e' => $request->optE,
                'kunci_jawaban' => $request->answer,
                'tipe_soal' => $request->tipesoal,
                
            ]);
        } else {
            $request->validate([
                'tipesoal' => 'required|in:1,2',
                'pertanyaan' => 'required|string',
                'optA' => 'required|string',
                'optB' => 'required|string',
                'optC' => 'required|string',
                'optD' => 'required|string',
                'answer' => 'required|in:A,B,C,D,E',
            ], [
                'tipesoal.required' => 'Tipe Soal wajib dipilih',
                'pertanyaan.required' => 'Pertanyaan wajib diisi',
                'optA.required' => 'Pilihan A wajib diisi',
                'optB.required' => 'Pilihan B wajib diisi',
                'optC.required' => 'Pilihan C wajib diisi',
                'optD.required' => 'Pilihan D wajib diisi',
                'answer.required' => 'Kunci Jawaban wajib diisi',
            ]);
    
            $soal = SoalMateri::find($request->id_soal);
    
            $post = $soal->update([
                'id_materi_soal' => $request->id_materi_soal,
                'soal' => $request->pertanyaan,
                'pilihan_a' => $request->optA,
                'pilihan_b' => $request->optB,
                'pilihan_c' => $request->optC,
                'pilihan_d' => $request->optD,
                'pilihan_e' => null,
                'kunci_jawaban' => $request->answer,
                'tipe_soal' => $request->tipesoal,
            ]);
        }

        $id_materi_soal = Crypt::encrypt($request->id_materi_soal);

        if($post){
            $notification = __('Soal berhasil diubah');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect("admin/viewkonten-soal/{$id_materi_soal}")->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal mengubah Soal');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }

    public function deletekonten_soal($idmateri, $idsoal)
	{   
        $post = SoalMateri::findOrFail($idsoal);
        $post->delete();
        
        $id_materi_soal = Crypt::encrypt($idmateri);

		$notification = __('Soal berhasil dihapus');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect("admin/viewkonten-soal/{$id_materi_soal}")->with($notification);
    }


    public function viewkonten_evalpenyelenggara($id)
    {
        $id = Crypt::decrypt($id);
        $materieval = MateriEvalpenyelenggara::with(['mataDiklat.angkatan'])
            ->withCount('soals')
            ->where('id_materi', $id)
            ->first();

        $id_diklat = $materieval?->mataDiklat?->angkatan?->id_diklat;

        $listevalsoal = SoalEvaluasipenyelenggara::where('id_materi_evaluasi_penyelenggara', $id)->orderBy('id')->get();
        return view('admin.diklat.konten.viewkonten-evalpenyelenggara', compact(['listevalsoal','materieval','id_diklat']));
    }

    public function viewkonten_evalpengajar($id)
    {
        $id = Crypt::decrypt($id);
        $materieval = MateriEvalpengajar::with(['mataDiklat.angkatan'])
            ->withCount('soals')
            ->where('id_materi', $id)
            ->first();

        $id_diklat = $materieval?->mataDiklat?->angkatan?->id_diklat;

        $listevalsoal = SoalEvaluasipengajar::where('id_materi_evaluasi_pengajar', $id)->orderBy('id')->get();
        return view('admin.diklat.konten.viewkonten-evalpengajar', compact(['listevalsoal','materieval','id_diklat']));
    }



    public function viewkonten_video()
    {
        return view('underdevelopment');
    }

    public function viewkonten_pdf($id)
    {
        $id = Crypt::decrypt($id);
        $materipdf = MateriPdf::with(['mataDiklat.angkatan'])
           // ->withCount('soals')
            ->where('id_materi', $id)
            ->first();

        $id_diklat = $materipdf?->mataDiklat?->angkatan?->id_diklat;
        
        //$bankSoalList = BankSoal::all();

        //$listmaterisoal = SoalMateri::where('id_materi_soal', $id)->orderBy('id')->get();
        return view('admin.diklat.konten.viewkonten-pdf', compact(['materipdf','id_diklat']));
    }

    public function deletekonten_pdf($idmateri)
	{   
       // Start a transaction
    DB::beginTransaction();

    try {
        // First delete the MateriPdf record by ID
        $post = MateriPdf::findOrFail($idmateri);
        $post->delete();

        // Second delete the record from core_mata_diklat_konten table
        DB::table('core_mata_diklat_konten')
            ->where('id_tipe_konten', 2)
            ->where('id_konten', $idmateri)
            ->delete();

        // If both deletions are successful, commit the transaction
        DB::commit();

        // Return success message after successful deletion
        $notification = __('Materi PDF berhasil dihapus');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect("admin")->with($notification);

        } catch (\Exception $e) {
            // If there's an error, roll back the transaction
            DB::rollBack();

            // Return error message in case of failure
            $notification = __('Something went wrong! Please try again.');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect("admin")->with($notification);
        }
    }
    


    public function fetch_soal($id_bank_soal)
    {
        $soalList = Soal::where('id_bank_soal', $id_bank_soal)->get();
        if ($soalList->isEmpty()) {
            return response()->json(['message' => 'nodata']);
        }
        return response()->json($soalList);
    }

    public function storecopykonten_soal_backup_old(Request $request)
    {
        $validated = $request->validate([
            'id_bank_soal' => 'required|exists:bank_soal,id_bank_soal',
        ]);

        $id_bank_soal = $request->id_bank_soal;
        $id_materi_soal = $request->id_materi_soal;

        $soalRecords = Soal::where('id_bank_soal', $id_bank_soal)->get();

        if ($soalRecords->isEmpty()) {
            return response()->json(['message' => 'No records found to copy.'], 404);
        }

        $allCreated = true;

        foreach ($soalRecords as $soal) {
            $soalMateri = SoalMateri::create([
                'id_materi_soal' => $id_materi_soal,
                'soal' => $soal->soal,
                'pilihan_a' => $soal->pilihan_a,
                'pilihan_b' => $soal->pilihan_b,
                'pilihan_c' => $soal->pilihan_c,
                'pilihan_d' => $soal->pilihan_d,
                'pilihan_e' => $soal->pilihan_e,
                'kunci_jawaban' => $soal->kunci_jawaban,
                'tipe_soal' => $soal->tipe_soal,
            ]);

            if (!$soalMateri) {
                $allCreated = false;
                break;
            }
        }

        if ($allCreated) {
            $notification = __('Soal berhasil disalin');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menyalin Soal');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }
    

    // SALIN BARU
    public function salinkonten_soal($jeniskonten, $id)
    {   
        $jeniskonten = $jeniskonten;
        $idMateri = Crypt::decrypt($id);
        if($jeniskonten === 'test'){
            $materiSoal = MateriSoal::with(['mataDiklat.angkatan'])->where('id_materi', '=' , $idMateri)->first();
            $id_diklat = $materiSoal?->mataDiklat?->angkatan?->id_diklat;

            if ($materiSoal->tipe === 'ujian') {
                $idMataDiklat = $materiSoal->mataDiklat->id_mata_diklat;
                $bankSoal = BankSoal::withCount('soals')
                    ->where('kategori', '=', $materiSoal->tipe)
                    ->where('id_mata_diklat', '=', $idMataDiklat)
                    ->get();
            } else {
                $bankSoal = BankSoal::withCount('soals')
                    ->where('kategori', '=', $materiSoal->tipe)
                    ->get();
            }
        } else if($jeniskonten === 'evalpenyelenggara'){
            $materiSoal = MateriEvalpenyelenggara::with(['mataDiklat.angkatan'])->where('id_materi', '=' , $idMateri)->first();
            $id_diklat = $materiSoal?->mataDiklat?->angkatan?->id_diklat;

            $bankSoal = BankSoal::withCount('soals')
                    ->where('kategori', '=', 'evaluasi')
                    ->get();

        } else if($jeniskonten === 'evalpengajar'){
            $materiSoal = MateriEvalpengajar::with(['mataDiklat.angkatan'])->where('id_materi', '=' , $idMateri)->first();
            $id_diklat = $materiSoal?->mataDiklat?->angkatan?->id_diklat;

            $bankSoal = BankSoal::withCount('soals')
                    ->where('kategori', '=', 'evaluasi')
                    ->get();
        }
        

        return view('admin.diklat.konten.salinkonten-soal', compact(['materiSoal','id_diklat','bankSoal','jeniskonten']));
    }

    public function storecopykonten_soal(Request $request)
    {
        $validated = $request->validate([
            'bank_soal' => 'required|exists:bank_soal,id_bank_soal',
            'metode' => 'required|in:all,random,choose'
        ]);

        $jeniskonten = $request->jeniskonten;
        $metode = $request->metode;
        $max_soal = $request->max_soal;

        if($metode === 'random'){
            $request->validate([
                'jumlah_acak' => 'required|integer|min:1|max:' . $max_soal,
            ]);
        } else if($metode === 'choose'){
            $request->validate([
                'selected_soal' => 'required|array|min:1',
            ]);
        }

        $id_bank_soal = $request->bank_soal;
        $id_materi_soal = $request->id_materi_soal;

        $soalRecords = collect();

        if ($metode === 'all') {
            $soalRecords = Soal::where('id_bank_soal', $id_bank_soal)->get();
        } elseif ($metode === 'random') {
            $jumlahAcak = $request->jumlah_acak;
            $soalRecords = Soal::where('id_bank_soal', $id_bank_soal)
                ->inRandomOrder()
                ->take($jumlahAcak)
                ->get();
        } elseif ($metode === 'choose') {
            $selectedSoalIds = $request->selected_soal;
            $soalRecords = Soal::where('id_bank_soal', $id_bank_soal)
                ->whereIn('id_soal', $selectedSoalIds)
                ->get();
        }

        if ($soalRecords->isEmpty()) {
            return response()->json(['message' => 'No records found to copy.'], 404);
        }

        $allCreated = true;
        $id_materi_soal_encrypted = Crypt::encrypt($id_materi_soal);

        if($jeniskonten === 'test'){
            foreach ($soalRecords as $soal) {
                $soalMateri = SoalMateri::create([
                    'id_materi_soal' => $id_materi_soal,
                    'soal' => $soal->soal,
                    'pilihan_a' => $soal->pilihan_a,
                    'pilihan_b' => $soal->pilihan_b,
                    'pilihan_c' => $soal->pilihan_c,
                    'pilihan_d' => $soal->pilihan_d,
                    'pilihan_e' => $soal->pilihan_e,
                    'kunci_jawaban' => $soal->kunci_jawaban,
                    'tipe_soal' => $soal->tipe_soal,
                ]);
    
                if (!$soalMateri) {
                    $allCreated = false;
                    break;
                }
            }

            if($allCreated){
                $notification = __('Soal berhasil disalin');
                $notification = ['messege' => $notification, 'alert-type' => 'success'];
                return redirect("admin/viewkonten-soal/{$id_materi_soal_encrypted}")->with($notification);
            } else {
                $notification = __('Terjadi kesalahan, gagal menyalin Soal');
                $notification = ['messege' => $notification, 'alert-type' => 'error'];
                return redirect()->back()->with($notification);
            }

        } else if($jeniskonten === 'evalpenyelenggara'){
            foreach ($soalRecords as $soal) {
                $soalMateri = SoalEvaluasipenyelenggara::create([
                    'id_materi_evaluasi_penyelenggara' => $id_materi_soal,
                    'soal' => $soal->soal,
                ]);
    
                if (!$soalMateri) {
                    $allCreated = false;
                    break;
                }
            }

            if($allCreated){
                $notification = __('Soal berhasil disalin');
                $notification = ['messege' => $notification, 'alert-type' => 'success'];
                return redirect("admin/viewkonten-evalpenyelenggara/{$id_materi_soal_encrypted}")->with($notification);
            } else {
                $notification = __('Terjadi kesalahan, gagal menyalin Soal');
                $notification = ['messege' => $notification, 'alert-type' => 'error'];
                return redirect()->back()->with($notification);
            }

        } else if($jeniskonten === 'evalpengajar'){
            foreach ($soalRecords as $soal) {
                $soalMateri = SoalEvaluasipengajar::create([
                    'id_materi_evaluasi_pengajar' => $id_materi_soal,
                    'soal' => $soal->soal,
                ]);
    
                if (!$soalMateri) {
                    $allCreated = false;
                    break;
                }
            }


            if($allCreated){
                $notification = __('Soal berhasil disalin');
                $notification = ['messege' => $notification, 'alert-type' => 'success'];
                return redirect("admin/viewkonten-evalpengajar/{$id_materi_soal_encrypted}")->with($notification);
            } else {
                $notification = __('Terjadi kesalahan, gagal menyalin Soal');
                $notification = ['messege' => $notification, 'alert-type' => 'error'];
                return redirect()->back()->with($notification);
            }
        }


        

    }

}