<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PegawaiController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('barang')->group(function () {
    Route::get('/index', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('{id}/edit', [BarangController::class, 'edit'])->name('produk.edit');
    Route::put('{id}/update', [BarangController::class, 'update'])->name('produk.update');
    Route::get('{id}/destroy', [BarangController::class, 'destroy'])->name('produk.destroy');
});
