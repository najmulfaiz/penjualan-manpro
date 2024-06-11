<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Pembelian::with('satuan');

            return DataTables::eloquent($query)
                                ->addColumn('status', function(Pembelian $pembelian) {
                                    return $pembelian->is_active == 'true' ? '<i class="bx bx-check-circle text-success fs-4"></i>' : '<i class="bx bx-x-circle text-danger fs-4"></i>';
                                })
                                ->addColumn('aksi', function(Pembelian $pembelian) {
                                    return '<a href="' . route('pembelian.show', $pembelian->id) . '" class="btn btn-primary btn-sm"><i class="bx bx-detail"></i></a>
                                            <a href="' . route('pembelian.edit', $pembelian->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                            <button class="btn btn-danger btn-sm btn_delete" data-id="' . $pembelian->id . '"><i class="bx bx-trash"></i></button>';
                                })
                                ->rawColumns(['status', 'aksi'])
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
            'name' => 'required|string',
            'harga' => 'required|numeric',
            'stock' => 'required|numeric',
            'satuan' => 'required|exists:satuans,id',
            'deskripsi' => 'required|string',
            'is_active' => 'nullable|in:true,false',
        ]);

        $pembelian = new Pembelian;
        $pembelian->name      = $request->name;
        $pembelian->harga     = $request->harga;
        $pembelian->stock     = $request->stock;
        $pembelian->satuan_id = $request->satuan;
        $pembelian->deskripsi = $request->deskripsi;
        $pembelian->is_active = $request->has('is_active') && $request->is_active == 'true' ? 'true' : 'false';

        if(!$pembelian->save()) {
            return redirect()->back()->withError('Pembelian gagal di simpan.');
        }

        return redirect()->route('pembelian.index')->withSuccess('Pembelian berhasil di simpan.');
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
