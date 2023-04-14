<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JalurController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrupController;
use App\Http\Controllers\PendakiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.action');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(GrupController::class)->group(function () {
    Route::get('/grup', 'index')->middleware('auth')->name('grup.index');
    Route::get('/grup/{id}/status', 'updateStatus')->middleware('auth')->name('grup.status');
    Route::get('/grup/{id}/detail', 'detail')->middleware('auth')->name('grup.detail');
    Route::delete('/grup/{id}', 'destroy')->middleware('auth')->name('grup.destroy');
});

Route::controller(PendakiController::class)->group(function () {
    Route::get('/pendaki', 'index')->middleware('auth')->name('pendaki.index');
    Route::get('/pendaki/cari', 'cari')->middleware('auth')->name('pendaki.cari');
    Route::get('/pendaki/{id}/edit', 'edit')->middleware('auth')->name('pendaki.edit');
    Route::get('/pendaki/{id}/checkout', 'checkout')->middleware('auth')->name('pendaki.checkout');
    Route::put('/pendaki/{id}', 'update')->middleware('auth')->name('pendaki.update');
    Route::delete('/pendaki/{id}', 'destroy')->middleware('auth')->name('pendaki.destroy');
});

Route::resource('admin', AdminController::class)->middleware('auth');
Route::resource('jalur', JalurController::class)->middleware('auth');
Route::get('/jalur/{id}/status', [JalurController::class, 'updateStatus'])->name('jalur.status')->middleware('auth');
