<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HelloController;
use App\Http\Controllers\GunungController;
use App\Http\Controllers\PemesananController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(HelloController::class)->group(function () {
    Route::get('/greeting', 'index');
});

Route::controller(GunungController::class)->group(function () {
    Route::get('/informasi-gunung', 'getInformasiGunung');
    Route::get('/jalur', 'getAllJalur');
});

Route::controller(PemesananController::class)->group(function () {
    Route::get('/list-group', 'listGroup');
    Route::get('/cari-grup/{id}', 'cariGrup');
    Route::get('/detail-grup/{id}', 'detailGrup');
    Route::get('/cari-pelanggan/{id}', 'cariPelanggan');

    Route::post('/tambah-grup', 'storeGrup');
    Route::post('/tambah-pelanggan', 'storePelanggan');

    Route::put('/ubah-pelanggan/{id}', 'updatePelanggan');

    Route::delete('/hapus-pelanggan/{id}', 'deletePelanggan');
    Route::delete('/hapus-grup/{id}', 'deleteGrup');
});
