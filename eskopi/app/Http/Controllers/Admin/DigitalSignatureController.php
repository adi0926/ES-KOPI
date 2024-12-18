<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SertifikatDiklat;
use App\Models\SertifikatDiklatItem;
use App\Models\PenggunaDiklat;
use App\Models\PenggunaSertifikat;
use App\Models\Reference;
use App\Models\Diklat;
use App\Models\DiklatAngkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DigitalSignatureController extends Controller
{
    
    public function digitalSignature()
    {
        $diklats = Diklat::with('kategori')
                ->where('publikasi', 'Y')
                ->orderBy('nama_diklat', 'asc')->get();

        $penggunaSertifikat = PenggunaSertifikat::with(['pengguna', 'diklat', 'diklatAngkatan'])->get();
        return view('admin.digitalsignature.signature', compact('penggunaSertifikat','diklats'));
    }

    public function getFilteredSign(Request $request)
    {
        $id_diklat = $request->diklat;
        $id_angkatan = $request->angkatan;
        $filteredDataSign = PenggunaSertifikat::with(['pengguna', 'diklat', 'diklatAngkatan'])
            ->where('id_diklat', $id_diklat)
            ->where('id_angkatan', $id_angkatan)
            ->get();
        return response()->json($filteredDataSign);
    }

    public function sendRequest(Request $request)
    {

        $request->validate([
            'passphrase' => 'required|string'
        ], [
            'passphrase.required' => 'Passphrase wajib diisi'
        ]);

        $id_angkatan = $request->id_angkatan;
        $id_diklat = $request->id_diklat;
        $passphrase = $request->passphrase;

        $penggunaSertifikats = PenggunaSertifikat::where('id_diklat', $id_diklat)
            ->where('id_angkatan', $id_angkatan)
            ->get();

        if ($penggunaSertifikats->isEmpty()) {
            return response()->json(['error' => 'Tidak ada data untuk angkatan ini.'], 404);
        }
        
        $fileBase64Array = [];
        $recordMappings = [];

        foreach ($penggunaSertifikats as $penggunaSertifikat) {
            $filePath = public_path('uploads/sertif-nosign/' . $penggunaSertifikat->file_sertifikat);
    
            if (file_exists($filePath)) {
                $fileBase64 = base64_encode(file_get_contents($filePath));
                $fileBase64Array[] = $fileBase64;
                $recordMappings[] = $penggunaSertifikat;
            }
        }

        if (empty($fileBase64Array)) {
            return response()->json(['error' => 'File tidak ditemukan.'], 404);
        }
    
        $data = [
            "nik" => "0803202100007062",
            "passphrase" => $passphrase,
            "signatureProperties" => array_fill(0, count($fileBase64Array), ["tampilan" => "INVISIBLE"]),
            "file" => $fileBase64Array,
        ];

        $response = Http::withBasicAuth('esign', 'qwerty')
                ->post('http://10.2.237.168/api/v2/sign/pdf', $data);
    
        if ($response->successful()) {
            $responseData = $response->json();

            if (isset($responseData['file']) && is_array($responseData['file'])) {
                foreach ($responseData['file'] as $index => $signedBase64) {
                    if (isset($recordMappings[$index])) {
                        $signedPdf = base64_decode($signedBase64);
    
                        $signedFileName = 'signed_' . basename($recordMappings[$index]->file_sertifikat);
                        $signedFilePath = public_path('uploads/sertif-sign/' . $signedFileName);
    
                        file_put_contents($signedFilePath, $signedPdf);
    
                        $recordMappings[$index]->update([
                            'file_sertifikat_sign' => 'uploads/sertif-sign/' . $signedFileName,
                            'status' => 1,
                        ]);
                    }
                }
    
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menambahkan Tanda Tangan Elektronik',
                ]);
            } else {
                return response()->json(['error' => 'Invalid response from API.'], 500);
            }
        } else {
            return response()->json(['error' => $response->body()], $response->status());
        }
        
    }
}
