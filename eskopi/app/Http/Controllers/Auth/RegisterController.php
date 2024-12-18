<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Pengguna;
use App\Models\PenggunaRegistrasi;
use Session;

class RegisterController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('auth.register');
    }

    public function formpendaftaran()
    {
        $provinsis = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        return view('auth.registerform', compact('provinsis'));
    }
    
    public function getKota($id)
    {
        $kotas = Kota::where('id_provinsi', $id)->get(['id_kota', 'nama_kota']);
        return response()->json($kotas);
    }

    public function postpendaftaran(Request $request)
    {

        $request->validate([
            'nip' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Pengguna::class],
            'password' => ['required', 'string', 'min:6', 'max:100'],
            'passwordconfirm' => ['required', 'string', 'same:password'],
            'gender' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'tempatlahir' => ['required', 'string', 'max:255'],
            'tanggallahir' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:255'],
            'notelp' => ['required', 'numeric', 'min:1000000000', 'max:9999999999999'],
        ], [
            'nip.required' => __('NIP wajib diisi'),
            'name.required' => __('Nama wajib diisi'),
            'email.required' => __('Email wajib diisi'),
            'email.unique' => __('Email sudah terpakai'),
            'password.required' => __('Kata sandi wajib diisi'),
            'password.min' => __('Minimal kata sandi adalah 6 karakter'),
            'passwordconfirm.required' => __('Konfirmasi kata sandi wajib diisi'),
            'passwordconfirm.same' => __('Konfirmasi kata sandi tidak cocok'),
            'gender.required' => __('Jenis kelamin wajib diisi'),
            'address.required' => __('Alamat wajib diisi'),
            'tempatlahir.required' => __('Tempat lahir wajib diisi'),
            'tanggallahir.required' => __('Tanggal lahir wajib diisi'),
            'kota.required' => __('Kota wajib diisi'),
            'provinsi.required' => __('Provinsi wajib diisi'),
            'notelp.required' => __('Nomor telepon wajib diisi'),
            'notelp.numeric' => __('Nomor telepon harus berupa angka'),
            'notelp.min' => __('Nomor telepon minimal 10 digit'),
            'notelp.max' => __('Nomor telepon maksimal 13 digit'),
        ]);
        

        $pengguna = Pengguna::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_tipe' => 2,
            'id_role' => 0,
            'no_telp' => $request->notelp,
        ]);
            
        
        $registrasi = PenggunaRegistrasi::create([
            'id_pengguna' => $pengguna->id_pengguna,
            'nama_lengkap' => $request->name,
            'jenis_kelamin' => $request->gender,
            'tempat_lahir' => $request->tempatlahir,
            'tgl_lahir' => $request->tanggallahir,
            'alamat_detail' => $request->address,
            'alamat_kota' => $request->kota,
            'alamat_provinsi' => $request->provinsi,
            'tanggal_registrasi' => now()->format('Y-m-d'),
            'status_registrasi' => 1,
        ]);
      

        $notification = __('Registrasi berhasil, menunggu verifikasi. Jika sudah mendapatkan email pemberitahuan akun sudah terverifikasi. Silahkan masuk menggunakan NIP dan Kata Sandi anda pada halaman Masuk');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

}
