<?php

use App\Http\Controllers\ArusStokController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false
]);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::get('satuan/select2', [SatuanController::class, 'select2'])->name('satuan.select2');
    Route::resource('satuan', SatuanController::class)->except(['show']);

    Route::get('supplier/select2', [SupplierController::class, 'select2'])->name('supplier.select2');
    Route::resource('supplier', SupplierController::class)->except(['show']);

    Route::get('produk/select2', [ProdukController::class, 'select2'])->name('produk.select2');
    Route::resource('produk', ProdukController::class);

    Route::resource('pembelian', PembelianController::class)->except(['show']);
    Route::resource('penjualan', PenjualanController::class)->except(['show']);

    Route::resource('arus_stok', ArusStokController::class)->only(['index']);
});
