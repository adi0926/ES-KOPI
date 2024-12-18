<?php

namespace App\Http\Controllers\Peserta;
use Dompdf\Dompdf;
use App\Models\Sertifikat;
use App\Models\SertifikatDiklat;
use App\Models\SertifikatDiklatItem;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Instansi;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\MateriVideo;
use App\Models\Diklat;
use App\Models\MataDiklat;
use App\Models\MataDiklatKonten;
use App\Models\DiklatKategori;
use App\Models\Pengguna;
use App\Models\PenggunaRegistrasi;
use App\Models\PenggunaDiklat;
use App\Models\PenggunaSertifikat;
use App\Models\RegistrasiDiklat;
use App\Models\DiklatAngkatan;
use App\Models\SoalMateri;
use App\Models\MateriSoal;
use App\Models\Jawaban;
use App\Models\JawabanEvalpenyelenggara;
use App\Models\JawabanEvalpengajar;
use App\Models\Reference;
use App\Models\SoalEvaluasipenyelenggara;
use App\Models\SoalEvaluasipengajar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PesertaController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dasbor()
    {
        $user = Auth::user();
        $id = $user->id_pengguna;

        $jumlahDiklat = PenggunaDiklat::where('id_peserta', $id)->count();

        $jumlahSertifikat = PenggunaSertifikat::where('id_peserta', $id)->count();

        return view('peserta.dashboard', [
            'jumlahDiklat' => $jumlahDiklat,
            'jumlahSertifikat' => $jumlahSertifikat
        ]);
    }

    public function diklatsaya()
    {
        $id_peserta = Auth::user()->id_pengguna;

        $diklatsaya = PenggunaDiklat::with(['diklat', 'sertifikat'])
            ->where('id_peserta', $id_peserta)
            ->get();

        $progressData = [];
        foreach ($diklatsaya as $item) {
            $id_diklat = $item->diklat->id_diklat;
    
            $totalReferences = Reference::where('id_peserta', $id_peserta)
                ->where('id_diklat', $id_diklat)
                ->count();
            
            if ($totalReferences > 0) {
                $completedReferences = Reference::where('id_peserta', $id_peserta)
                    ->where('id_diklat', $id_diklat)
                    ->where('status', 1)
                    ->count();
        
                $progressPercentage = round(($completedReferences / $totalReferences) * 100);

            } else {
                $progressPercentage = 0;
            }
    
            $progressData[$id_diklat] = $progressPercentage;
        }
        
        return view('peserta.diklatsaya', compact('diklatsaya', 'progressData'));
    }

    public function sertifikat()
    {
        {   $id_peserta = Auth::user()->id_pengguna;
            $sertifikat = Sertifikat::where('id_peserta', $id_peserta)
                ->get();
            return view('peserta.sertifikat', compact('sertifikat'));
        }

    }

    function downloadCertificate() {
        
        
        
        $certificate = SertifikatDiklat::first();
        $certificateItems = SertifikatDiklatItem::all();
        
        //var_dump($certificate);
        //exit;
       
        $html = view('peserta.sertifikat.index', compact('certificateItems', 'certificate'))->render();

        $html = str_replace('[peserta_diklat]', 'Adi',$html);
        $html = str_replace('[nama_diklat]','Budi', $html);
        $html = str_replace('[nomor_sertifikat]', 'Test', $html);

        // Initialize Dompdf
        $dompdf = new Dompdf(array('enable_remote' => true));

        // Load HTML content
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();
        $dompdf->stream("certificate.pdf");
        return redirect()->back();
    }
    public function semuadiklat()
    {
        $alldiklat = Diklat::with('kategori')->paginate(10);
        $categories = DiklatKategori::all();

        return view('peserta.semuadiklat', compact('alldiklat', 'categories'));
    }

    public function daftardiklat($id_diklat)
    {
        $id = Auth::user()->id_pengguna;
        $diklat = Diklat::findOrFail($id_diklat);
        $provinsis = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        $instansis = Instansi::orderBy('nama_instansi', 'asc')->get();
        $golongans = Golongan::orderBy('nama_golongan', 'asc')->get();
        $jabatans = Jabatan::orderBy('nama_jabatan', 'asc')->get();
        $datapeserta = PenggunaRegistrasi::with('kota.provinsi')->where('id_pengguna', $id)->first();
        
        return view('peserta.regisdiklat', compact('provinsis','datapeserta','instansis','golongans','jabatans','diklat'));
    }

    public function postdaftardiklat(Request $request)
    {

        $request->validate([
            'nip' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'tempatlahir' => ['required', 'string', 'max:255'],
            'tanggallahir' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:255'],
            'notelp' => ['required', 'numeric', 'min:1000000000', 'max:9999999999999'],
            'facebook' => ['nullable', 'string', 'max:255'],
            
            // New validation rules
            'instansi' => ['required', 'exists:core_instansi,id_instansi'],
            'alamatinstansi' => ['required', 'string', 'max:100'],
            'provinsiinstansi' => ['required', 'exists:core_provinsi,id_provinsi'],
            'kotainstansi' => ['required', 'exists:core_kota,id_kota'],
            'notelpinstansi' => ['required', 'numeric', 'min:1000000000', 'max:9999999999999'],
            'fax' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'jabpeserta' => ['required', 'exists:core_jabatan,id_jabatan'],
            'unitkerja' => ['required', 'string', 'max:255'],
            'golpeserta' => ['required', 'exists:core_golongan,id_golongan'],
            'namaatasan' => ['required', 'string', 'max:255'],
            'notelpatasan' => ['required', 'numeric', 'min:1000000000', 'max:9999999999999'],
            'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',

        ], [
            'nip.required' => __('NIP wajib diisi'),
            'name.required' => __('Nama wajib diisi'),
            'email.required' => __('Email wajib diisi'),
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
            'facebook.max' => __('Facebook maksimal 255 karakter'),

            // New validation error messages
            'instansi.required' => __('Instansi wajib dipilih'),
            'instansi.exists' => __('Instansi yang dipilih tidak valid'),
            'alamatinstansi.required' => __('Alamat Instansi wajib diisi'),
            'alamatinstansi.max' => __('Alamat Instansi maksimal 100 karakter'),
            'provinsiinstansi.required' => __('Provinsi Instansi wajib dipilih'),
            'provinsiinstansi.exists' => __('Provinsi yang dipilih tidak valid'),
            'kotainstansi.required' => __('Kota/Kabupaten Instansi wajib dipilih'),
            'kotainstansi.exists' => __('Kota/Kabupaten yang dipilih tidak valid'),
            'notelpinstansi.required' => __('Nomor Telepon Kantor wajib diisi'),
            'notelpinstansi.numeric' => __('Nomor Telepon Kantor harus berupa angka'),
            'notelpinstansi.min' => __('Nomor Telepon Kantor minimal 10 digit'),
            'notelpinstansi.max' => __('Nomor Telepon Kantor maksimal 13 digit'),
            'fax.max' => __('Fax maksimal 255 karakter'),
            'website.url' => __('Website harus berupa URL yang valid'),
            'jabpeserta.required' => __('Jabatan Peserta wajib dipilih'),
            'jabpeserta.exists' => __('Jabatan Peserta yang dipilih tidak valid'),
            'unitkerja.required' => __('Bagian / Bidang Unit Kerja wajib diisi'),
            'golpeserta.required' => __('Golongan Peserta wajib dipilih'),
            'golpeserta.exists' => __('Golongan Peserta yang dipilih tidak valid'),
            'namaatasan.required' => __('Nama Atasan wajib diisi'),
            'notelpatasan.required' => __('Nomor Telepon Atasan wajib diisi'),
            'notelpatasan.numeric' => __('Nomor Telepon Atasan harus berupa angka'),
            'notelpatasan.min' => __('Nomor Telepon Atasan minimal 10 digit'),
            'notelpatasan.max' => __('Nomor Telepon Atasan maksimal 13 digit'),
        ]);
        $imagePath = null;
        if ($request->hasFile('imagepath')) {
            $image = $request->file('imagepath');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('frontend/img/filepersyaratan'), $imageName);
            $imagePath = 'frontend/img/filepersyaratan' . $imageName;
        }
        $registrasiDiklat = RegistrasiDiklat::create([
            'nip' => $request->nip,
            'nama' => $request->name,
            'jenis_kelamin' => $request->gender,
            'tempat_lahir' => $request->tempatlahir,
            'tanggal_lahir' => $request->tanggallahir,
            'email' => $request->email,
            'no_hp' => $request->notelp,
            'alamat' => $request->address,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'facebook' => $request->facebook,
            'instansi' => $request->instansi,
            'alamat_instansi' => $request->alamatinstansi,
            'kota_instansi' => $request->kotainstansi,
            'prov_instansi' => $request->provinsiinstansi,
            'telp_instansi' => $request->notelpinstansi,
            'fax_instansi' => $request->fax,
            'website_instansi' => $request->website,
            'jabatan_peserta' => $request->jabpeserta,
            'unit_kerja' => $request->unitkerja,
            'golongan_peserta' => $request->golpeserta,
            'nama_atasan' => $request->namaatasan,
            'nohp_atasan' => $request->notelpatasan,
            'file_persyaratan' => $imagePath,
        ]);

        $id_diklat = $request->id_diklat;
        $angkatan = DiklatAngkatan::where('id_diklat', $id_diklat)->first();
        $id_angkatan = $angkatan->id_diklat_angkatan;

        $dataPenggunaDiklat = PenggunaDiklat::create([
            'id_peserta' => Auth::user()->id_pengguna,
            'id_angkatan' => $id_angkatan,
            'id_diklat' => $id_diklat,
            'id_registrasi_diklat' => $registrasiDiklat->id_registrasi_diklat,
            'tgl_pendaftaran' => now()->setTimezone('Asia/Jakarta'), 
            'status' => 0,
        ]);
      

        $notification = __('Pendaftaran diklat berhasil, menunggu proses verifikasi.');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->route('peserta.diklatsaya')->with($notification);
    }

    public function mulaidiklat($id_diklat)
    {
        $id_diklat = Crypt::decrypt($id_diklat);
        $diklat = Diklat::with(['angkatan', 'mataDiklat.mataDiklatKonten'])->findOrFail($id_diklat);
        $latestAngkatan = $diklat->angkatan()->latest('created_at')->first();
        $latestAngkatanId = $latestAngkatan->id_diklat_angkatan;

        $user = Auth::user();
        $id_peserta = $user->id_pengguna;

        $existingReferences = Reference::where('id_diklat', $id_diklat)
            ->where('id_peserta', $id_peserta)
            ->where('id_angkatan', $latestAngkatanId)
            ->exists();

        if (!$existingReferences) {
            $currentUrutan = 1;

            $newReferences = $diklat->mataDiklat
                ->sortBy('urutan')
                ->flatMap(function ($mataDiklat) use (&$currentUrutan, $id_diklat, $id_peserta, $latestAngkatanId) {
                    return $mataDiklat->mataDiklatKonten
                        ->sortBy('urutan')
                        ->map(function ($mataDiklatKonten) use (&$currentUrutan, $mataDiklat, $id_diklat, $latestAngkatanId, $id_peserta) {
                            return [
                                'id_peserta' => $id_peserta,
                                'id_mata_diklat' => $mataDiklat->id_mata_diklat,
                                'id_mata_diklat_konten' => $mataDiklatKonten->id,
                                'id_diklat' => $id_diklat,
                                'id_angkatan' => $latestAngkatanId,
                                'status' => 0,
                                'urutan' => $currentUrutan++,
                                'created_at' => now()->timezone('Asia/Jakarta'),
                                'updated_at' => now()->timezone('Asia/Jakarta'),
                            ];
                        });
                })
                ->toArray();

            Reference::insert($newReferences);
        }

        $totalRecords = Reference::where('id_diklat', $id_diklat)->where('id_peserta', $id_peserta)->count();
        $status0Count = Reference::where('id_diklat', $id_diklat)->where('id_peserta', $id_peserta)->where('status', 0)->count();
        $status1Count = Reference::where('id_diklat', $id_diklat)->where('id_peserta', $id_peserta)->where('status', 1)->count();

        $percentage = $totalRecords > 0 ? round(($status1Count / $totalRecords) * 100) : 0;

        $lastCheckpoint = Reference::where('id_diklat', $id_diklat)
            ->where('id_peserta', $id_peserta)
            ->where('status', 0)
            ->orderBy('urutan')
            ->first();

        if ($lastCheckpoint) {
            $lastCheckpointIdMataDiklat = $lastCheckpoint->id_mata_diklat;
            $lastCheckpointIdMataDiklatKonten = $lastCheckpoint->id_mata_diklat_konten;
            $lastCheckpointIdKonten = MataDiklatKonten::where('id', $lastCheckpointIdMataDiklatKonten)->value('id_konten');
            $lastCheckpointIdTipeKonten = MataDiklatKonten::where('id', $lastCheckpointIdMataDiklatKonten)->value('id_tipe_konten');

            if ($lastCheckpointIdTipeKonten == 0) {
                $lastCheckpointType = 'open';
            } elseif ($lastCheckpointIdTipeKonten == 1) {
                $lastCheckpointType = 'video';
            } elseif ($lastCheckpointIdTipeKonten == 2) {
                $lastCheckpointType = 'pdf';
            } elseif ($lastCheckpointIdTipeKonten == 9) {
                $lastCheckpointType = 'soal';
            } elseif ($lastCheckpointIdTipeKonten == 4) {
                $lastCheckpointType = 'vclass';
            } elseif ($lastCheckpointIdTipeKonten == 20) {
                $lastCheckpointType = 'evaluasiA';
            } elseif ($lastCheckpointIdTipeKonten == 21) {
                $lastCheckpointType = 'evaluasiB';
            } else {
                $lastCheckpointType = 'unknown';
            }
        } else {
            $lastCheckpointIdMataDiklat = null;
            $lastCheckpointIdKonten = null;
            $lastCheckpointType = 'completed';
        }


        

        return view('peserta.diklat-player.mulaidiklat', compact('diklat', 'totalRecords', 'status0Count', 'status1Count', 'percentage','lastCheckpointIdMataDiklat','lastCheckpointIdKonten','lastCheckpointType','id_peserta'));
    }

    public function getSoal($id_konten)
    {
        $questions = SoalMateri::where('id_materi_soal', $id_konten)->get();
        return response()->json($questions);
    }

    public function getEval($evaltipe, $id_konten)
    {
        if ($evaltipe === 'evaluasiA') {
            $questions = SoalEvaluasipenyelenggara::where('id_materi_evaluasi_penyelenggara', $id_konten)->get();
        } else if ($evaltipe === 'evaluasiB') {
            $questions = SoalEvaluasipengajar::where('id_materi_evaluasi_pengajar', $id_konten)->get();
        } 
        return response()->json($questions);
    }

    public function saveJawaban(Request $request)
    {
        $user = Auth::user();
        $id = $user->id_pengguna;
        $answers = $request->all();
       
        try {
            $correctAnswersCount = 0;
            $wrongAnswersCount = 0;
            $totalQuestions = count($answers);

            // get data for update status
            $soalMateriId = $answers[0]['id_core_soal_materi'];
            $getsoalMateri = SoalMateri::where('id', $soalMateriId)->first();
            $idMateriSoal = $getsoalMateri->id_materi_soal;
            $getMataDiklatKonten = MataDiklatKonten::where('id_konten', $idMateriSoal)->where('id_tipe_konten', 9)->first();

            $soalMateri = SoalMateri::whereIn('id', array_column($answers, 'id_core_soal_materi'))->get();
            foreach ($answers as $answer) {
                 
                $jawaban = isset($answer['jawaban']) ? strtoupper($answer['jawaban']) : null;

                Jawaban::create(
                    [
                        'id_peserta' => $id,
                        'id_core_soal_materi' => $answer['id_core_soal_materi'],
                        'jawaban' => $jawaban
                    ]
                );

                $soal = $soalMateri->firstWhere('id', $answer['id_core_soal_materi']);
                if ($soal && $jawaban && $jawaban === strtoupper($soal->kunci_jawaban)) {
                    $correctAnswersCount++;
                } else {
                    $wrongAnswersCount++;
                }
            }

            $score = ($correctAnswersCount / $totalQuestions) * 100;
            
            $reference = Reference::where('id_mata_diklat_konten', $getMataDiklatKonten->id)
                              ->where('id_peserta', $id)
                              ->first();
            
            $materiSoal = MateriSoal::with('mataDiklat')->find($idMateriSoal);

            $headerteks = 'Test';

            if ($materiSoal) {
                $tipe = $materiSoal->tipe;
                $mataDiklat = $materiSoal->mataDiklat ? $materiSoal->mataDiklat->mata_diklat : '';

                if ($tipe === 'pretest') {
                    $headerteks = 'Pre Test Diklat ini';
                } elseif ($tipe === 'posttest') {
                    $headerteks = 'Post Test Diklat ini';
                } elseif ($tipe === 'ujian') {
                    $headerteks = "Soal Ujian Materi Diklat $mataDiklat";
                } else {
                    $headerteks = 'Header teks tidak ditemukan';
                }
            }

            if ($reference) {
                $reference->update(['status' => 1]);
            }

            return response()->json([
                'message' => 'Jawaban berhasil disimpan',
                'headerteks' => $headerteks,
                'correct_answers' => $correctAnswersCount,
                'wrong_answers' => $wrongAnswersCount,
                'score' => round($score, 2)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan jawaban'], 500);
        }
    }

    public function saveJawabanEvalPenyelenggara(Request $request)
    {
        $user = Auth::user();
        $id = $user->id_pengguna;
        $answers = $request->all();
       
        try {
            $soalMateriId = $answers[0]['id_core_soal_evaluasi_penyelenggara'];
            $getsoalMateri = SoalEvaluasipenyelenggara::where('id', $soalMateriId)->first();
            $idMateriSoal = $getsoalMateri->id_materi_evaluasi_penyelenggara;
            $getMataDiklatKonten = MataDiklatKonten::where('id_konten', $idMateriSoal)->where('id_tipe_konten', 20)->first();

            $soalMateri = SoalEvaluasipenyelenggara::whereIn('id', array_column($answers, 'id_core_soal_evaluasi_penyelenggara'))->get();
            foreach ($answers as $answer) {
                JawabanEvalpenyelenggara::create(
                    [
                        'id_peserta' => $id,
                        'id_core_soal_evaluasi_penyelenggara' => $answer['id_core_soal_evaluasi_penyelenggara'],
                        'jawaban' => $answer['jawaban']
                    ]
                );
            }
            
            $reference = Reference::where('id_mata_diklat_konten', $getMataDiklatKonten->id)
                              ->where('id_peserta', $id)
                              ->first();

            if ($reference) {
                $reference->update(['status' => 1]);
            }

            return response()->json([
                'message' => 'Jawaban berhasil disimpan',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan jawaban'], 500);
        }
    }

    public function saveJawabanEvalPengajar(Request $request)
    {
        $user = Auth::user();
        $id = $user->id_pengguna;
        $answers = $request->all();
       
        try {
            $soalMateriId = $answers[0]['id_core_soal_evaluasi_pengajar'];
            $getsoalMateri = SoalEvaluasipengajar::where('id', $soalMateriId)->first();
            $idMateriSoal = $getsoalMateri->id_materi_evaluasi_pengajar;
            $getMataDiklatKonten = MataDiklatKonten::where('id_konten', $idMateriSoal)->where('id_tipe_konten', 21)->first();

            $soalMateri = SoalEvaluasipengajar::whereIn('id', array_column($answers, 'id_core_soal_evaluasi_pengajar'))->get();
            foreach ($answers as $answer) {
                JawabanEvalpengajar::create(
                    [
                        'id_peserta' => $id,
                        'id_core_soal_evaluasi_pengajar' => $answer['id_core_soal_evaluasi_pengajar'],
                        'jawaban' => $answer['jawaban']
                    ]
                );
            }
            
            $reference = Reference::where('id_mata_diklat_konten', $getMataDiklatKonten->id)
                              ->where('id_peserta', $id)
                              ->first();

            if ($reference) {
                $reference->update(['status' => 1]);
            }

            return response()->json([
                'message' => 'Jawaban berhasil disimpan',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan jawaban'], 500);
        }
    }

    public function getNilai($id_konten)
    {
        $user = Auth::user();
        $id = $user->id_pengguna;

        try {

            $jawabanUser = Jawaban::where('id_peserta', $id)
                ->whereHas('soalMateri', function ($query) use ($id_konten) {
                    $query->where('id_materi_soal', $id_konten);
                })
                ->get();

            $soalMateri = SoalMateri::where('id_materi_soal', $id_konten)->get()->keyBy('id');

            $correctAnswersCount = 0;
            $wrongAnswersCount = 0;
            $totalQuestions = $jawabanUser->count();

            foreach ($jawabanUser as $jawaban) {
                $soal = $soalMateri->get($jawaban->id_core_soal_materi);

                if ($soal && strtoupper($jawaban->jawaban) === strtoupper($soal->kunci_jawaban)) {
                    $correctAnswersCount++;
                } else {
                    $wrongAnswersCount++;
                }
            }

            $score = ($correctAnswersCount / $totalQuestions) * 100;

            return response()->json([
                'message' => 'Nilai berhasil dihitung',
                'correct_answers' => $correctAnswersCount,
                'wrong_answers' => $wrongAnswersCount,
                'score' => round($score, 2)
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error in getNilai: ' . $e->getMessage(), ['exception' => $e]);
    
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghitung nilai',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function start(Request $request)
    {
        $user = Auth::user();
        $id_peserta = $user->id_pengguna;

        $getMataDiklatKonten = MataDiklatKonten::where('id_konten', $request->id_konten)->where('id_tipe_konten', 0)->first();

        $reference = Reference::where('id_mata_diklat_konten', $getMataDiklatKonten->id)
            ->where('id_peserta', $id_peserta)
            ->first();

        if ($reference) {
            $reference->status = 1;
            $reference->save();

            return response()->json(['message' => 'Status updated successfully'], 200);
        }

        return response()->json(['message' => $request->id_konten], 404);
    }

    public function next(Request $request)
    {
        $user = Auth::user();
        $id_peserta = $user->id_pengguna;

        $tipekonten = $request->tipekonten;
    
        if ($tipekonten === 'video') {
            $id_tipe_konten = 1;
        } elseif ($tipekonten === 'pdf') {
            $id_tipe_konten = 2;
        } elseif ($tipekonten === 'soal') {
            $id_tipe_konten = 9;
        } elseif ($tipekonten === 'vclass') {
            $id_tipe_konten = 4;
        } elseif ($tipekonten === 'evaluasiA') {
            $id_tipe_konten = 20;
        } elseif ($tipekonten === 'evaluasiB') {
            $id_tipe_konten = 21;
        } else {
            $id_tipe_konten = 0;
        }

        $getMataDiklatKonten = MataDiklatKonten::where('id_konten', $request->id_konten)->where('id_tipe_konten', $id_tipe_konten)->first();

        $reference = Reference::where('id_mata_diklat_konten', $getMataDiklatKonten->id)
            ->where('id_peserta', $id_peserta)
            ->first();

        if ($reference) {
            $reference->status = 1;
            $reference->save();

            return response()->json(['message' => 'Status updated successfully'], 200);
        }

        return response()->json(['message' => $request->id_konten], 404);
    }

}
