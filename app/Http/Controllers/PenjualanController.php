<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Stok;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Penjualan::query();

            return DataTables::eloquent($query)
                                ->addColumn('produk', function(Penjualan $penjualan) {
                                    $list = '';
                                    foreach($penjualan->penjualan_details as $detail)
                                    {
                                        $list .= '<li>' . $detail->produk->name . '</li>';
                                    }

                                    return '<ul>' . $list . '</ul>';
                                })
                                ->addColumn('aksi', function(Penjualan $penjualan) {
                                    return '<a href="' . route('penjualan.edit', $penjualan->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                            <button class="btn btn-danger btn-sm btn_delete" data-id="' . $penjualan->id . '"><i class="bx bx-trash"></i></button>';
                                })
                                ->rawColumns(['produk', 'status', 'aksi'])
                                ->toJson();
        }

        return view('pages.penjualan.index');
    }

    public function create()
    {
        $sidebar_collapse = true;

        return view('pages.penjualan.create', compact('sidebar_collapse'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'diskon_global_persen' => 'nullable|numeric',
            'diskon_global_rupiah' => 'nullable|numeric',
            'produk.*'             => 'required|exists:produks,id',
            'harga.*'              => 'required|numeric',
            'qty.*'                => 'required|numeric',
            'total.*'              => 'required|numeric',
            'total_global'         => 'required|numeric',
        ]);

        $penjualan = new Penjualan;
        $penjualan->diskon_persen = $request->diskon_global_persen;
        $penjualan->diskon_rupiah = $request->diskon_global_rupiah;
        $penjualan->total         = $request->total_global;

        if(!$penjualan->save()) {
            return response()->json([
                'isError' => true,
                'message' => 'Penjualan gagal di simpan.'
            ]);
        }

        foreach($request->produk as $key => $produk) {
            $penjualan_detail               = new PenjualanDetail;
            $penjualan_detail->penjualan_id = $penjualan->id;
            $penjualan_detail->produk_id    = $produk;
            $penjualan_detail->qty          = $request->qty[$key];
            $penjualan_detail->harga        = $request->harga[$key];
            $penjualan_detail->total        = $request->total[$key];

            if(!$penjualan_detail->save()) {
                return response()->json([
                    'isError' => true,
                    'message' => 'Penjualan gagal di simpan.'
                ]);
            }

            $stok               = new Stok;
            $stok->transaksi_id = $penjualan->id;
            $stok->transaksi    = 'PENJUALAN';
            $stok->produk_id    = $produk;
            $stok->keluar       = $request->qty[$key];

            if(!$stok->save()) {
                return response()->json([
                    'isError' => true,
                    'message' => 'Penjualan gagal di simpan.'
                ]);
            }
        }

        return response()->json([
            'isError' => false,
            'message' => 'Penjualan berhasil di simpan.'
        ]);
    }

    public function show(Penjualan $penjualan)
    {
        return view('pages.penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        return view('pages.penjualan.edit', compact('penjualan'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'name' => 'required|string',
            'harga' => 'required|numeric',
            // 'stock' => 'required|numeric',
            'satuan' => 'required|exists:satuans,id',
            'deskripsi' => 'required|string',
            'is_active' => 'nullable|in:true,false',
        ]);

        $penjualan->name      = $request->name;
        $penjualan->harga     = $request->harga;
        // $penjualan->stock     = $request->stock;
        $penjualan->satuan_id = $request->satuan;
        $penjualan->deskripsi = $request->deskripsi;
        $penjualan->is_active = $request->has('is_active') && $request->is_active == 'true' ? 'true' : 'false';

        if(!$penjualan->update()) {
            return redirect()->back()->withError('Penjualan gagal di ubah.');
        }

        return redirect()->route('penjualan.index')->withSuccess('Penjualan berhasil di ubah.');
    }

    public function destroy(Penjualan $penjualan)
    {
        if(!$penjualan->delete()) {
            return response()->json([
                'isError' => true,
                'message' => 'Penjualan gagal di hapus.'
            ]);
        }

        return response()->json([
            'isError' => false,
            'message' => 'Penjualan berhasil di hapus.'
        ]);
    }
}
