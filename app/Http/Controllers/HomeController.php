<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produk_count = Produk::count();
        $penjualan_count = Penjualan::whereMonth('created_at', date('m'))
                                    ->whereYear('created_at', date('Y'))
                                    ->sum('total');

        $pembelian_count = Pembelian::whereMonth('created_at', date('m'))
                                    ->whereYear('created_at', date('Y'))
                                    ->sum('total');

        return view('pages.home.index', compact('produk_count', 'penjualan_count', 'pembelian_count'));
    }
}
