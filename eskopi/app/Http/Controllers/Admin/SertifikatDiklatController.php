<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use App\Http\Requests\CertificateUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\SertifikatDiklat;
use App\Models\SertifikatDiklatItem;
use App\Models\PenggunaDiklat;
use App\Models\PenggunaSertifikat;
use App\Models\Reference;
use App\Models\Diklat;
use App\Models\DiklatAngkatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class SertifikatDiklatController extends Controller
{

    public function sertifklat()
    {
        $certificate = SertifikatDiklat::first();
        $certificateItems = SertifikatDiklatItem::all();
        return view('admin.sertifikat-diklat.index', compact('certificate', 'certificateItems'));
    }


    // function downloadCertificate() {
    //     $certificate = SertifikatDiklat::first();
    //     $certificateItems = SertifikatDiklatItem::all();
       
    //     $html = view('peserta.sertifikat.index', compact('certificateItems', 'certificate'))->render();

    //     $html = str_replace('[student_name]', 'Adi',$html);
    //     $html = str_replace('[platform_name]', 'Ok', $html);
    //     $html = str_replace('[course]','Budi', $html);
    //     $html = str_replace('[date]', '20241203 08:00', $html);
    //     $html = str_replace('[instructor_name]', 'Bedul', $html);

    //     // Initialize Dompdf
    //     $dompdf = new Dompdf(array('enable_remote' => true));

    //     // Load HTML content
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');

    //     $dompdf->render();
    //     $dompdf->stream("certificate.pdf");
    //     return redirect()->back();
    // }

    function updateItem(Request $request) {

        
        SertifikatDiklatItem::updateOrCreate(
            ['element_id' => $request->element_id],
            [
             'x_position' => $request->x_position,
             'y_position' => $request->y_position
            ]
         );
 
        return response(['status' => 'success', 'message' => __('Updated successfully')]);

    }
 
     
    public function update(CertificateUpdateRequest $request, $id)
    {
        $certificate = SertifikatDiklat::updateOrCreate(
            ['id' => 1],
            $request->validated()
        );
        if($request->hasFile('background')){
            $file_name = file_upload($request->background, 'uploads/custom-images/', $certificate->image);
            $certificate->background = $file_name;
            $certificate->save();
        }
        if($request->hasFile('signature')){
            $file_name = file_upload($request->signature, 'uploads/custom-images/', $certificate->signature);
            $certificate->signature = $file_name;
            $certificate->save();
        }

        return redirect()->back()->with(['messege' => __('Updated successfully'), 'alert-type' => 'success']);
    }

    public function getAngkatan($id_diklat)
    {
        $angkatan = DiklatAngkatan::where('id_diklat', $id_diklat)->get();

        return response()->json($angkatan);
    }

    public function getFilteredData(Request $request)
    {
        $diklatId = $request->diklat;
        $angkatanId = $request->angkatan;
        
        $filteredData = PenggunaDiklat::with(['pengguna', 'diklat', 'diklatAngkatan','sertifikat'])
            ->where('status', 1)
            ->where('id_diklat', $diklatId)
            ->where('id_angkatan', $angkatanId)
            ->get()
            ->filter(function ($item) {
                $idPeserta = $item->pengguna->id_pengguna;
                $idDiklat = $item->diklat->id_diklat;
                $idAngkatan = $item->diklatAngkatan->id_diklat_angkatan;

                $references = Reference::where('id_peserta', $idPeserta)
                    ->where('id_diklat', $idDiklat)
                    ->where('id_angkatan', $idAngkatan)
                    ->get();

                if ($references->isEmpty()) {
                    return false;
                }
                return $references->every(function ($ref) {
                    return $ref->status == 1;
                });
            });

        return response()->json($filteredData);
    }

    
    public function prosessertif()
    {

        $diklats = Diklat::with('kategori')
                ->where('publikasi', 'Y')
                ->orderBy('nama_diklat', 'asc')->get();

        $penggunaDiklat = PenggunaDiklat::with(['pengguna', 'diklat', 'diklatAngkatan','sertifikat'])
            ->where('status', 1)
            ->get()
            ->filter(function ($item) {
                $idPeserta = $item->pengguna->id_pengguna;
                $idDiklat = $item->diklat->id_diklat;
                $idAngkatan = $item->diklatAngkatan->id_diklat_angkatan;

                $references = Reference::where('id_peserta', $idPeserta)
                    ->where('id_diklat', $idDiklat)
                    ->where('id_angkatan', $idAngkatan)
                    ->get();

                if ($references->isEmpty()) {
                    return false;
                }
                return $references->every(function ($ref) {
                    return $ref->status == 1;
                });
            });

    
        return view('admin.sertifikat-diklat.listpeserta', compact('penggunaDiklat','diklats'));
    }

    public function create_sertifikat(Request $request)
    {
        $request->validate([
            'no_sertif' => 'required|string',
        ], [
            'no_sertif.required' => 'Nomor Sertifikat wajib diisi',
        ]);

        $no_sertif = $request->no_sertif;
        
        $penggunaDiklat = PenggunaDiklat::with(['pengguna', 'diklat', 'diklatAngkatan'])->where('id_peserta', $request->id_pengguna)
            ->where('id_diklat', $request->id_diklat)
            ->where('id_angkatan', $request->id_angkatan)->first();

        $nama_peserta = $penggunaDiklat->pengguna->name;
        $nama_diklat = $penggunaDiklat->diklat->nama_diklat;

        $nama_peserta_sanitized = preg_replace('/[^a-zA-Z0-9-_]/', '_', $nama_peserta);
        $nama_diklat_sanitized = preg_replace('/[^a-zA-Z0-9-_]/', '_', $nama_diklat);
        $random_suffix = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 2);

        // buat sertif dulu
        $fileName = "sertifikat-{$nama_peserta_sanitized}-{$nama_diklat_sanitized}-{$random_suffix}.pdf";

        $certificate = SertifikatDiklat::first();
        $certificateItems = SertifikatDiklatItem::all();
       
        $html = view('peserta.sertifikat.index', compact('certificateItems', 'certificate'))->render();
        $html = str_replace('[peserta_diklat]', $nama_peserta, $html);
        $html = str_replace('[nama_diklat]', $nama_diklat, $html);
        $html = str_replace('[nomor_sertifikat]', $no_sertif, $html);

        $dompdf = new Dompdf(array('enable_remote' => true));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filePath = public_path('uploads/sertif-nosign/' . $fileName);
        File::ensureDirectoryExists(public_path('uploads/sertif-nosign'));
        file_put_contents($filePath, $dompdf->output());


        // store ke db
        $penggunaSertifikat = PenggunaSertifikat::create([
            'id_peserta' => $request->id_pengguna,
            'id_diklat' => $request->id_diklat,
            'id_angkatan' => $request->id_angkatan,
            'no_sertifikat' => $no_sertif,
            'file_sertifikat' => $fileName,
            'status' => 0,
        ]);

        $penggunaDiklat = PenggunaDiklat::where('id_peserta', $request->id_pengguna)
            ->where('id_diklat', $request->id_diklat)
            ->where('id_angkatan', $request->id_angkatan)
            ->update(['id_sertifikat' => $penggunaSertifikat->id]);

        $notification = __('Berhasil');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    public function createbulk_sertifikat(Request $request)
    {
        
        $participants = PenggunaDiklat::with(['pengguna', 'diklat', 'diklatAngkatan','sertifikat'])
            ->where('status', 1)
            ->where('id_diklat', $request->id_diklat)
            ->where('id_angkatan', $request->id_angkatan)
            ->get()
            ->filter(function ($item) {
                $idPeserta = $item->pengguna->id_pengguna;
                $idDiklat = $item->diklat->id_diklat;
                $idAngkatan = $item->diklatAngkatan->id_diklat_angkatan;

                $references = Reference::where('id_peserta', $idPeserta)
                    ->where('id_diklat', $idDiklat)
                    ->where('id_angkatan', $idAngkatan)
                    ->get();

                if ($references->isEmpty()) {
                    return false;
                }
                return $references->every(function ($ref) {
                    return $ref->status == 1;
                });
            });
            

        if ($participants->isEmpty()) {
            return redirect()->back()->with([
                'messege' => __('Tidak ada peserta untuk Diklat dan Angkatan ini'),
                'alert-type' => 'error',
            ]);
        }

        $certificate = SertifikatDiklat::first();
        $certificateItems = SertifikatDiklatItem::all();

        foreach ($participants as $penggunaDiklat) {
            $nama_peserta = $penggunaDiklat->pengguna->name;
            $nama_diklat = $penggunaDiklat->diklat->nama_diklat;
            $no_sertif = $penggunaDiklat->no_sertifikat;

            $nama_peserta_sanitized = preg_replace('/[^a-zA-Z0-9-_]/', '_', $nama_peserta);
            $nama_diklat_sanitized = preg_replace('/[^a-zA-Z0-9-_]/', '_', $nama_diklat);
            $random_suffix = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 2);

            $fileName = "sertifikat-{$nama_peserta_sanitized}-{$nama_diklat_sanitized}-{$random_suffix}.pdf";

            $html = view('peserta.sertifikat.index', compact('certificateItems', 'certificate'))->render();
            $html = str_replace('[peserta_diklat]', $nama_peserta, $html);
            $html = str_replace('[nama_diklat]', $nama_diklat, $html);
            $html = str_replace('[nomor_sertifikat]', $no_sertif, $html);

            $dompdf = new Dompdf(['enable_remote' => true]);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $filePath = public_path('uploads/sertif-nosign/' . $fileName);
            File::ensureDirectoryExists(public_path('uploads/sertif-nosign'));
            file_put_contents($filePath, $dompdf->output());

            $penggunaSertifikat = PenggunaSertifikat::create([
                'id_peserta' => $penggunaDiklat->id_peserta,
                'id_diklat' => $request->id_diklat,
                'id_angkatan' => $request->id_angkatan,
                'no_sertifikat' => $no_sertif,
                'file_sertifikat' => $fileName,
                'status' => 0,
            ]);

            DB::table('diklat_peserta')
              ->where('id_peserta', $penggunaDiklat->id_peserta)
              ->where('id_diklat', $penggunaDiklat->id_diklat)
              ->where('id_angkatan', $penggunaDiklat->id_angkatan)
              ->update(['id_sertifikat' => $penggunaSertifikat->id]);
            
        }

        $notification = __('Berhasil');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }
    
    public function downloadCSVTemplate(Request $request)
    {
        $diklatId = $request->query('diklatId');
        $angkatanId = $request->query('angkatanId');

        $request->validate([
            'diklatId' => 'required|exists:core_diklat,id_diklat',
            'angkatanId' => 'required|exists:diklat_angkatan,id_diklat_angkatan',
        ]);

        $csvContent = "ID Peserta, Nama Peserta, Diklat ID, Nama Diklat, Angkatan ID, Nama Angkatan, No Sertifikat\n";

        $penggunaDiklatList = PenggunaDiklat::with(['diklat', 'diklatAngkatan', 'pengguna'])
            ->where('id_diklat', $diklatId)
            ->where('id_angkatan', $angkatanId)
            ->get();

        foreach ($penggunaDiklatList as $penggunaDiklat) {
            $csvContent .= implode(',', [
                $penggunaDiklat->id_peserta,
                optional($penggunaDiklat->pengguna)->name ?? '',
                $penggunaDiklat->id_diklat,
                optional($penggunaDiklat->diklat)->nama_diklat ?? '',
                $penggunaDiklat->id_angkatan,
                optional($penggunaDiklat->diklatAngkatan)->nama_angkatan ?? '',
                $penggunaDiklat->no_sertifikat,
            ]) . "\n";
        }

        $filename = "Template_PenggunaDiklat.csv";

        return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function uploadCSV(Request $request)
    {

        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:10240',
            'csv_file' => 'required|file|mimetypes:text/csv',
        ]);

        $file = $request->file('csv_file');

        if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
            fgetcsv($handle);

            while (($row = fgetcsv($handle)) !== false) {
                $id_peserta = $row[0];
                $id_diklat = $row[2];
                $id_angkatan = $row[4];
                $no_sertifikat = $row[6];

                PenggunaDiklat::where('id_peserta', $id_peserta)
                    ->where('id_diklat', $id_diklat)
                    ->where('id_angkatan', $id_angkatan)
                    ->update(['no_sertifikat' => $no_sertifikat]);
            }

            fclose($handle);

            $notification = __('Berhasil import nomor sertifikat per angkatan diklat yang dipilih.');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        }

        $notification = __('Proses import nomor sertifikat gagal.');
        $notification = ['messege' => $notification, 'alert-type' => 'error'];
        return redirect()->back()->with($notification);
    }
    

}