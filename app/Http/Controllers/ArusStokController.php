<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ArusStokController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Stok::with('produk');

            return DataTables::eloquent($query)
                                ->addColumn('__asd', function(Stok $stok) {

                                })
                                ->toJson();
        }

        return view('pages.arus_stok.index');
    }
}
