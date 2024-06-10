<?php

use App\Http\Controllers\HomeController;
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
    Route::resource('supplier', SupplierController::class)->except(['show']);
    Route::resource('produk', ProdukController::class);
});
