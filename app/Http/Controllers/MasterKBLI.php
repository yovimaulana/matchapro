<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MasterKBLI extends Controller
{
    public function getMasterKategori() {
        $kategori = DB::table('business_ref_kbli_new')
            ->select('Kode', 'Judul')
            ->where('Tahun', env('TAHUN_REF_KBLI'))
            ->whereRaw('len(Kode) = 1')
            ->distinct()
            ->orderBy('Kode')
            ->get();

        return $kategori;
    }

    public function getMasterKBLI(Request $request) {
        $kategori = $request->input('kategori');
        $kbli = DB::table('business_ref_kbli_new')
            ->where('Tahun', env('TAHUN_REF_KBLI'))
            ->where('Kategori', $kategori)
            ->whereRaw('len(Kode) = 5')
            ->orderBy('Kategori')
            ->get();

        return $kbli;
    }

    public function getMasterKBLIByKategori($kategori) {
        $kbli = DB::table('business_ref_kbli_new')
            ->where('Tahun', env('TAHUN_REF_KBLI'))
            ->where('Kategori', $kategori)
            ->whereRaw('len(Kode) = 5')
            ->orderBy('Kode')
            ->get();

        return $kbli;
    }
}
