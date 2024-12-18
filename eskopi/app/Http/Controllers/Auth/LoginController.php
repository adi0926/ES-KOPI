<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Pengguna;
use App\Models\PenggunaRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('auth.login');
    }

    public function loginasn()
    {
        return view('auth.loginasn');
    }

    public function loginnon()
    {
        return view('auth.loginnon');
    }

   
    public function postmasukasn(Request $request)
    {
     
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ],[
            'nip.required' => __('NIP wajib diisi'),
            'password.required' => __('Kata Sandi wajib diisi'),
        ]);

      
        $user = Pengguna::where('nip', $request->nip)->first();
        if(!$user){
            return back()->withErrors(['nip' => 'NIP belum terdaftar']);
        }

        $regis = PenggunaRegistrasi::where('id_pengguna', $user->id_pengguna)->first();
        

        if ($regis->status_registrasi == 0) {
            $notification = __('Gagal masuk, Akun anda belum terverifikasi.');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $notification = __('Berhasil masuk');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->route('peserta.dasbor')->with($notification);

        } else {
            return back()->withErrors(['password' => 'Kata Sandi anda salah']);
        }
    }

    
    public function keluar()
    {
        Auth::logout();
        return redirect('/');
    }
    
    public function redirectToSso()
    {
        $tenantId = env('SSO_TENANT_ID');
        $clientId = env('SSO_CLIENT_ID');
        $redirectUri = urlencode(env('SSO_REDIRECT_URI'));

        $authUrl = "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/authorize?" .
            "client_id={$clientId}&response_type=code&redirect_uri={$redirectUri}&response_mode=query&scope=openid%20offline_access%20https%3A%2F%2Fgraph.microsoft.com%2Fmail.read&state=12345";

        return redirect($authUrl);
    }
    
    public function handleSsoCallback(Request $request)
    {
        $code = $request->query('code');

        if (is_null($code)) {
            // abort(404, 'Authorization code is missing or invalid.');
            $notification = __('Tidak ada izin akses, Harap masuk menggunakan Akun SSO');
            $notification = ['messege' => $notification, 'alert-type' => 'warning'];
            return redirect()->route('login')->with($notification);
        }

        $tokenUrl = "https://login.microsoftonline.com/" . env('SSO_TENANT_ID') . "/oauth2/v2.0/token";
        $response = Http::asForm()->post($tokenUrl, [
            'client_id' => env('SSO_CLIENT_ID'),
            'client_secret' => env('SSO_CLIENT_SECRET'),
            'grant_type' => 'authorization_code',
            'redirect_uri' => env('SSO_REDIRECT_URI'),
            'code' => $code,
            'scope' => 'https://graph.microsoft.com/mail.read',
        ]);

        $tokenData = $response->json();
        $accessToken = $tokenData['access_token'];
        
        dd($accessToken);
        //sampesini sudah dapet akses token
        
        

        $userInfo = Http::withToken($accessToken)
            ->get('https://graph.microsoft.com/v1.0/me')
            ->json();

        // kode untuk cek nip hasil dari sso dengan database es kopi
        
        // $user = User::where('email', $userInfo['mail'])->first();

        // if (!$user) {
        //     $user = User::create([
        //         'name' => $userInfo['displayName'],
        //         'email' => $userInfo['mail'],
        //         'password' => bcrypt(str_random(16)),
        //     ]);
        // }

        // Auth::login($user);

        return redirect()->route('peserta.dasbor');
        
    }

}
