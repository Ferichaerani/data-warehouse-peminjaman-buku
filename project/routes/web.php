<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PinjamPdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider.
|--------------------------------------------------------------------------
*/

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Route cetak PDF Pinjams (per transaksi)
Route::get('/pinjams/{id}/cetak', [PinjamPdfController::class, 'cetak'])
    ->name('pinjams.cetak');
