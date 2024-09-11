<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgressProfilingController;
use App\Http\Controllers\DirektoriUsahaController;
use App\Http\Controllers\ProfilingController;
use App\Http\Controllers\FormCreateUsahaController;
use App\Http\Controllers\FormUpdateUsahaController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//MatchaPro

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');


Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //Progress Profiling
    //Wilayah
    Route::get('profiling/progress/wilayah', [ProgressProfilingController::class, 'wilayah_index'])->name('progress_wilayah.index');
    //Profiler
    Route::get('profiling/progress/profiler', [ProgressProfilingController::class, 'profiler_index'])->name('progress_profiler.index');

    //Direktori Usaha
    Route::get('direktori-usaha', [DirektoriUsahaController::class, 'index'])->name('direktori_usaha.index');

    //Profiling
    Route::get('profiling', [ProfilingController::class, 'index'])->name('profiling.index');
    Route::get('profiling/update/usaha/{perusahaan_id}/{alokasi_id}/history', [FormUpdateUsahaController::class, 'index'])->name('form_update_usaha3.index');
    Route::get('profiling/update/usaha/{perusahaan_id}/{alokasi_id}/cancel', [FormUpdateUsahaController::class, 'index'])->name('form_update_usaha4.index');
    
    //Create Usaha - Form
    Route::get('profiling/create/usaha', [FormCreateUsahaController::class, 'index'])->name('form_create_usaha.index');

    //Update Usaha - Form
    Route::get('profiling/update/usaha/{perusahaan_id}/{alokasi_id}', [FormUpdateUsahaController::class, 'index'])->name('form_update_usaha.index');
    
    //dari direktori usaha
    Route::get('profiling/update/usaha/{perusahaan_id}', [FormUpdateUsahaController::class, 'index'])->name('form_update_usaha2.index');
});

//End Matcha Pro
// ==================================================================================================

//Tempplate
// Route::get('/', [StaterkitController::class, 'home'])->name('home');
// Route::get('home', [StaterkitController::class, 'home'])->name('home');
// Route Components
Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');


// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
