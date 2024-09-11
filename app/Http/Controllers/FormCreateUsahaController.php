<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use DB;
use Auth;

class FormCreateUsahaController extends Controller
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

        $snapshot_id = DB::table('area_provinsi')->max('snapshot_id');
        // $provinsi = DB::table('area_provinsi')->where('snapshot_id', $snapshot_id)->get();

        //Cek User
        $user = auth()->user(); // or User::find($id);
        $role = $user->getRoleNames()->first(); // Get the first role
        $role = Role::findByName($role); // Replace 'role_name' with the actual role
        
        
        //Provinsi ?
        if($role->hasPermissionTo('create-new-usaha-provinsi'))
        {
            $provinsi = $provinsi = DB::table('area_provinsi')
            ->where('snapshot_id', $snapshot_id)
            ->where('provinsi_id', $user->provinsi_id)
            ->get();    
        }

        //Kabupaten ?
        else if ($role->hasPermissionTo('create-new-usaha-kabkot'))
        {
            $provinsi = DB::table('area_provinsi')
            ->where('snapshot_id', $snapshot_id)
            ->where('provinsi_id', $user->provinsi_id)
            ->get();

            $kabupaten_kota = DB::table('area_kabupaten_kota')
            ->where('provinsi_id', $user->kabupaten_kota_id)
            ->get();
        }
        
        else{
            // dd("401 Not Authorized ");
        };

        return view('/matchapro/page/form_create', ['breadcrumbs' => $breadcrumbs, 'pageConfigs' => $pageConfigs, 'request' => $request]);
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
