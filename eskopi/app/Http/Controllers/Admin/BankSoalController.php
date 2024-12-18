<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataDiklat;
use App\Models\BankSoal;
use App\Models\Soal;
use App\Models\Diklat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class BankSoalController extends Controller
{

    public function bank_soal()
    {
        $bankSoal = BankSoal::withCount('soals')->orderBy('created_at', 'desc')->get();
        return view('admin.bank-soal.bank_soal', compact(['bankSoal']));
    }

    public function add_bank_soal()
    {
        $diklats = Diklat::orderBy('id_diklat', 'desc')->get();
        return view('admin.bank-soal.add_bank_soal', compact('diklats'));
    }

    public function bank_soal_store(Request $request)
    {
        $request->validate([
            'kategori_bank_soal' => 'required',
        ]);

        $kategori = $request->kategori_bank_soal;
    
        if ($kategori === 'ujian') {
            $request->validate([
                'judul_bank_soal' => 'required',
                'matadiklat' => 'required',
            ]);
            $post = BankSoal::create([
                'judul_bank_soal' => $request->judul_bank_soal,
                'kategori' => $kategori,
                'id_mata_diklat' => $request->matadiklat,
            ]);
        } else {
            $request->validate([
                'judul_bank_soal' => 'required',
            ]);
            $post = BankSoal::create([
                'judul_bank_soal' => $request->judul_bank_soal,
                'kategori' => $kategori,
            ]);
        }

        if($post){
            $notification = __('Bank soal berhasil ditambahkan');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect('admin/bank-soal')->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menambah Bank soal');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }

    public function edit_bank_soal($id)
    {
        $idbankSoal = Crypt::decrypt($id);
        $bankSoal = BankSoal::where('id_bank_soal', '=' , $idbankSoal)->first();

		return view('admin.bank-soal.edit_bank_soal', compact(['bankSoal']));	    
	}

    public function bank_soal_update(Request $request)
    {   
        $request->validate([
            'judul_bank_soal' => 'required|string|max:100',
        ]);

        $post = BankSoal::where('id_bank_soal', '=' , $request->id_bank_soal)
                ->update([
                    'judul_bank_soal' => $request->judul_bank_soal,
                ]);

        if($post){
            $notification = __('Bank soal berhasil diubah');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect('admin/bank-soal')->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal mengubah Bank soal');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
	}

    public function bank_soal_delete($id)
	{   
        $post = BankSoal::findOrFail($id);
        $post->delete();

		$notification = __('Bank soal berhasil dihapus');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect('admin/bank-soal')->with($notification);
    }

    public function list_soal($id)
    {
        $idbankSoal = Crypt::decrypt($id);
        $bankSoal = BankSoal::withCount('soals')->where('id_bank_soal', '=' , $idbankSoal)->first();
        $soals = Soal::where('id_bank_soal', '=' , $idbankSoal)->orderBy('id_soal')->get();

        return view('admin.bank-soal.list_soal', compact(['bankSoal','soals']));
    }

    public function add_soal($id)
    {
        $idbankSoal = Crypt::decrypt($id);
        $bankSoal = BankSoal::where('id_bank_soal', '=' , $idbankSoal)->first();

        return view('admin.bank-soal.add_soal', compact(['bankSoal']));
    }

    public function soal_store(Request $request)
    {
        $request->validate([
            'kategori_bank_soal' => 'required',
        ]);

        $kategori_bank = $request->kategori_bank_soal;

        if($kategori_bank === 'evaluasi'){
            $request->validate([
                'pertanyaan_evaluasi' => 'required|string',
            ], [
                'pertanyaan_evaluasi.required' => 'Pertanyaan evaluasi wajib diisi',
            ]);

            $post = Soal::create([
                'id_bank_soal' => $request->id_bank_soal,
                'soal' => $request->pertanyaan_evaluasi,
            ]);
        } else {

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
                
                $post = Soal::create([
                    'id_bank_soal' => $request->id_bank_soal,
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
    
                $post = Soal::create([
                    'id_bank_soal' => $request->id_bank_soal,
                    'soal' => $request->pertanyaan,
                    'pilihan_a' => $request->optA,
                    'pilihan_b' => $request->optB,
                    'pilihan_c' => $request->optC,
                    'pilihan_d' => $request->optD,
                    'kunci_jawaban' => $request->answer,
                    'tipe_soal' => $request->tipesoal,
                ]);
            }
            
            
        }

        $id_bank_soal = Crypt::encrypt($request->id_bank_soal);

        if($post){
            $notification = __('Soal berhasil ditambahkan');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect("admin/list-soal/{$id_bank_soal}")->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal menambah Soal');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }
    
    public function edit_soal($idbank, $idsoal)
    {
        $idbankSoal = Crypt::decrypt($idbank);
        $bankSoal = BankSoal::where('id_bank_soal', '=' , $idbankSoal)->first();
        $idSoal = Crypt::decrypt($idsoal);
        $Soal = Soal::where('id_soal', '=' , $idSoal)->first();

  	  	return view('admin.bank-soal.edit_soal', compact(['Soal','bankSoal']));	    
  	}

    public function soal_update(Request $request)
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
    
            $soal = Soal::find($request->id_soal);
    
            $post = $soal->update([
                'id_bank_soal' => $request->id_bank_soal,
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
    
            $soal = Soal::find($request->id_soal);
    
            $post = $soal->update([
                'id_bank_soal' => $request->id_bank_soal,
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

        $id_bank_soal = Crypt::encrypt($request->id_bank_soal);

        if($post){
            $notification = __('Soal berhasil diubah');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect("admin/list-soal/{$id_bank_soal}")->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, gagal mengubah Soal');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }
    
    public function soal_delete($id_soal, $id_bank_soal)
	  {   
        $post = Soal::findOrFail($id_soal);
        $post->delete();
        
        $id_bank_soal = Crypt::encrypt($id_bank_soal);

		    $notification = __('Soal berhasil dihapus');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect("admin/list-soal/{$id_bank_soal}")->with($notification);
    }

    public function getMataDiklat($id_diklat)
    {
        $mataDiklat = MataDiklat::where('tipekonfig', 'materi')
            ->whereHas('angkatan', function ($query) use ($id_diklat) {
                $query->where('id_diklat', $id_diklat);
            })->get(['id_mata_diklat', 'mata_diklat', 'deskripsi']);

        return response()->json($mataDiklat);
    }
}