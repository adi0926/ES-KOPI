<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\PenggunaDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class LaporanController extends Controller
{

    public function laporan()
    {
        $penggunaDiklat = PenggunaDiklat::with(['pengguna', 'diklat', 'diklatAngkatan'])
            ->where('status', 1)
            ->get();

        return view('admin.laporan.laporan', compact('penggunaDiklat'));
    }


}