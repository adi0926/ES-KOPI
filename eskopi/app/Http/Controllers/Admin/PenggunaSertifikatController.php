<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\PenggunaSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class PenggunaSertifikatController extends Controller
{

    public function laporan()
    {
        $penggunaSertifikat = PenggunaSertifikat::
            get();

        return view('admin.digitalsignature.signature', compact('penggunaSertifikat'));
    }


}