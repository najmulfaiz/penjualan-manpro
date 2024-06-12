<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Stok;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Pembelian::query();

            return DataTables::eloquent($query)
                                ->addColumn('produk', function(Pembelian $pembelian) {
                                    $list = '';
                                    foreach($pembelian->pembelian_details as $detail)
                                    {
                                        $list .= '<li>' . $detail->produk->name . '</li>';
                                    }

                                    return '<ul>' . $list . '</ul>';
                                })
                                ->addColumn('aksi', function(Pembelian $pembelian) {
                                    return '<a href="' . route('pembelian.edit', $pembelian->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                            <button class="btn btn-danger btn-sm btn_delete" data-id="' . $pembelian->id . '"><i class="bx bx-trash"></i></button>';
                                })
                                ->rawColumns(['produk', 'status', 'aksi'])
                                ->toJson();
        }

        return view('pages.pembelian.index');
    }

    public function create()
    {
        $sidebar_collapse = true;

        return view('pages.pembelian.create', compact('sidebar_collapse'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'faktur'               => 'required|string',
            'tanggal_faktur'       => 'required|date',
            'supplier'             => 'required|exists:suppliers,id',
            'jatuh_tempo'          => 'required|date',
            'diskon_global_persen' => 'nullable|numeric',
            'diskon_global_rupiah' => 'nullable|numeric',
            'total_global'         => 'required|numeric',
            'produk.*'             => 'required|exists:produks,id',
            'harga.*'              => 'required|numeric',
            'qty.*'                => 'required|numeric',
            'diskon_persen.*'      => 'nullable|numeric',
            'diskon_rupiah.*'      => 'nullable|numeric',
            'total.*'              => 'required|numeric',
        ]);

        $pembelian = new Pembelian;
        $pembelian->faktur         = $request->faktur;
        $pembelian->tanggal_faktur = $request->tanggal_faktur;
        $pembelian->supplier       = $request->supplier;
        $pembelian->jatuh_tempo    = $request->jatuh_tempo;
        $pembelian->diskon_persen  = $request->diskon_global_persen;
        $pembelian->diskon_rupiah  = $request->diskon_global_rupiah;
        $pembelian->total          = $request->total_global;

        if(!$pembelian->save()) {
            return response()->json([
                'isError' => true,
                'message' => 'Pembelian gagal di simpan.'
            ]);
        }

        foreach($request->produk as $key => $produk) {
            $pembelian_detail                = new PembelianDetail;
            $pembelian_detail->pembelian_id  = $pembelian->id;
            $pembelian_detail->produk_id     = $produk;
            $pembelian_detail->harga         = $request->harga[$key];
            $pembelian_detail->qty           = $request->qty[$key];
            $pembelian_detail->diskon_persen = $request->diskon_persen[$key];
            $pembelian_detail->diskon_rupiah = $request->diskon_rupiah[$key];
            $pembelian_detail->total         = $request->total[$key];

            if(!$pembelian_detail->save()) {
                return response()->json([
                    'isError' => true,
                    'message' => 'Pembelian gagal di simpan.'
                ]);
            }

            $stok               = new Stok;
            $stok->transaksi_id = $pembelian->id;
            $stok->transaksi    = 'PEMBELIAN';
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
            'message' => 'Pembelian berhasil di simpan.'
        ]);
    }

    public function show(Pembelian $pembelian)
    {
        return view('pages.pembelian.show', compact('pembelian'));
    }

    public function edit(Pembelian $pembelian)
    {
        return view('pages.pembelian.edit', compact('pembelian'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'name' => 'required|string',
            'harga' => 'required|numeric',
            // 'stock' => 'required|numeric',
            'satuan' => 'required|exists:satuans,id',
            'deskripsi' => 'required|string',
            'is_active' => 'nullable|in:true,false',
        ]);

        $pembelian->name      = $request->name;
        $pembelian->harga     = $request->harga;
        // $pembelian->stock     = $request->stock;
        $pembelian->satuan_id = $request->satuan;
        $pembelian->deskripsi = $request->deskripsi;
        $pembelian->is_active = $request->has('is_active') && $request->is_active == 'true' ? 'true' : 'false';

        if(!$pembelian->update()) {
            return redirect()->back()->withError('Pembelian gagal di ubah.');
        }

        return redirect()->route('pembelian.index')->withSuccess('Pembelian berhasil di ubah.');
    }

    public function destroy(Pembelian $pembelian)
    {
        if(!$pembelian->delete()) {
            return response()->json([
                'isError' => true,
                'message' => 'Pembelian gagal di hapus.'
            ]);
        }

        return response()->json([
            'isError' => false,
            'message' => 'Pembelian berhasil di hapus.'
        ]);
    }
}
