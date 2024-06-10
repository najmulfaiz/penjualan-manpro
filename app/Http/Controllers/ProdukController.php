<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Produk::with('satuan');

            return DataTables::eloquent($query)
                                ->addColumn('status', function(Produk $produk) {
                                    return $produk->is_active == 'true' ? '<i class="bx bx-check-circle text-success fs-4"></i>' : '<i class="bx bx-x-circle text-danger fs-4"></i>';
                                })
                                ->addColumn('aksi', function(Produk $produk) {
                                    return '<a href="' . route('produk.edit', $produk->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                            <button class="btn btn-danger btn-sm btn_delete" data-id="' . $produk->id . '"><i class="bx bx-trash"></i></button>';
                                })
                                ->rawColumns(['status', 'aksi'])
                                ->toJson();
        }

        return view('pages.produk.index');
    }

    public function create()
    {
        return view('pages.produk.create');
    }

    public function store(Request $request)
    {
        return $request->has('is_active') && $request->is_active == 'true' ? 'true' : 'false';
        $request->validate([
            'name' => 'required|string',
            'harga' => 'required|numeric',
            'stock' => 'required|numeric',
            'satuan' => 'required|exists:satuans,id',
            'deskripsi' => 'required|string',
            'is_active' => 'nullable|in:true,false',
        ]);

        $produk = new Produk;
        $produk->name      = $request->name;
        $produk->harga     = $request->harga;
        $produk->stock     = $request->stock;
        $produk->satuan_id = $request->satuan;
        $produk->deskripsi = $request->deskripsi;
        $produk->is_active = $request->has('is_active') && $request->is_active == 'true' ? 'true' : 'false';

        if(!$produk->save()) {
            return redirect()->back()->withError('Produk gagal di simpan.');
        }

        return redirect()->route('produk.index')->withSuccess('Produk berhasil di simpan.');
    }

    public function show(Produk $produk)
    {
        return $produk;
    }

    public function edit(Produk $produk)
    {
        return view('pages.produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'name' => 'required|string',
            'harga' => 'required|numeric',
            // 'stock' => 'required|numeric',
            'satuan' => 'required|exists:satuans,id',
            'deskripsi' => 'required|string',
            'is_active' => 'nullable|in:true,false',
        ]);

        $produk->name      = $request->name;
        $produk->harga     = $request->harga;
        // $produk->stock     = $request->stock;
        $produk->satuan_id = $request->satuan;
        $produk->deskripsi = $request->deskripsi;
        $produk->is_active = $request->has('is_active') && $request->is_active == 'true' ? 'true' : 'false';

        if(!$produk->update()) {
            return redirect()->back()->withError('Produk gagal di ubah.');
        }

        return redirect()->route('produk.index')->withSuccess('Produk berhasil di ubah.');
    }

    public function destroy(Produk $produk)
    {
        if(!$produk->delete()) {
            return response()->json([
                'isError' => true,
                'message' => 'Produk gagal di hapus.'
            ]);
        }

        return response()->json([
            'isError' => false,
            'message' => 'Produk berhasil di hapus.'
        ]);
    }
}
