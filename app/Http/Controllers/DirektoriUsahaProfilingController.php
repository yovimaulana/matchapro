<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DirektoriUsahaProfilingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pageConfigs = ['sidebarCollapsed' => false];
        $breadcrumbs = [
            ['link' => "home", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Collapsed menu"]
        ];

        

        if ($request->ajax()) {
            // Fetching businesses with joins and pagination
            $businesses = DB::table('business_perusahaan as bp')
                ->join('area_provinsi as ap', function ($join) {
                    $join->on('ap.id', '=', 'bp.provinsi_id')
                        ->where('ap.snapshot_id', '=', 4);
                })
                ->join('area_kabupaten_kota as akk', 'akk.id', '=', 'bp.kabupaten_kota_id')
                ->join('area_kecamatan as ak', 'ak.id', '=', 'bp.kecamatan_id')
                ->join('area_kelurahan_desa as akd', 'akd.id', '=', 'bp.kelurahan_desa_id')
                ->select(
                    'bp.id as business_id', 'bp.kode as business_kode', 'bp.nama as business_nama', 'bp.nama_komersial as business_nama_komersial', 'bp.alamat as business_alamat',
                    'ap.nama as provinsi_nama',
                    'akk.nama as kabupaten_nama',
                    'ak.nama as kecamatan_nama',
                    'akd.nama as kelurahan_nama'
                );

            $businesses = $businesses->paginate(10);

            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $businesses->total(),
                'recordsFiltered' => $businesses->total(),
                'data' => $businesses->items(),
            ]);
        }

        // Use the new temporary connection
        $businesses = DB::table('business_perusahaan as bp')
            ->join('area_provinsi as ap', function($join) {
                $join->on('ap.id', '=', 'bp.provinsi_id')
                    ->where('ap.snapshot_id', '=', 4);
            })
            ->join('area_kabupaten_kota as akk', 'akk.id', '=', 'bp.kabupaten_kota_id')
            ->join('area_kecamatan as ak', 'ak.id', '=', 'bp.kecamatan_id')
            ->join('area_kelurahan_desa as akd', 'akd.id', '=', 'bp.kelurahan_desa_id')
            ->select(
                'bp.id as business_id', 'bp.kode as business_kode', 'bp.nama as business_nama', 'bp.nama_komersial as business_nama_komersial', 'bp.alamat as business_alamat',
                'ap.id as provinsi_id', 'ap.kode as provinsi_kode', 'ap.nama as provinsi_nama',
                'akk.id as kabupaten_id', 'akk.kode as kabupaten_kode', 'akk.nama as kabupaten_nama',
                'ak.id as kecamatan_id', 'ak.kode as kecamatan_kode', 'ak.nama as kecamatan_nama',
                'akd.id as kelurahan_id', 'akd.kode as kelurahan_kode', 'akd.nama as kelurahan_nama'
            )
            ->paginate(10);

            //redirect ke halaman direktori usaha
            return view('/matchapro/page/direktori_usaha_profiling', 
            ['breadcrumbs' => $breadcrumbs, 
            'pageConfigs' => $pageConfigs,
            'businesses' => $businesses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
