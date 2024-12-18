<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenggunaDiklat;
use App\Models\RegistrasiDiklat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class PesertadiklatController extends Controller
{

    public function show()
    {
        $daftarpeserta = PenggunaDiklat::with(['pengguna', 'diklat', 'diklatAngkatan'])->orderBy('tgl_pendaftaran', 'desc')->get();
        return view('admin.pesertadiklat.pesertadiklat', compact(['daftarpeserta']));
    }
    
    public function detail($id_peserta, $id_registrasi_diklat)
    {
        $penggunadiklat = PenggunaDiklat::where('id_peserta', $id_peserta)
                    ->where('id_registrasi_diklat', $id_registrasi_diklat)
                    ->firstOrFail();
                    
        $detailregistrasidiklat = RegistrasiDiklat::with(['getkota', 'getprovinsi', 'instansi', 'kotaInstansi', 'provinsiInstansi', 'jabatan', 'golongan'])->where('id_registrasi_diklat', $id_registrasi_diklat)->firstOrFail();
    
        return view('admin.pesertadiklat.pesertadiklat-detail', compact('penggunadiklat','detailregistrasidiklat'));
    }
    
    public function approve($id_peserta, $id_registrasi_diklat)
    {
        $affectedRows = PenggunaDiklat::where('id_peserta', $id_peserta)
                                  ->where('id_registrasi_diklat', $id_registrasi_diklat)
                                  ->update(['status' => 1]);
        
        if ($affectedRows) {
            $notification = __('Peserta berhasil disetujui');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect('admin/peserta-diklat')->with($notification);
        } else {
            $notification = __('Terjadi kesalahan, Peserta tidak ditemukan atau sudah disetujui.');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

}