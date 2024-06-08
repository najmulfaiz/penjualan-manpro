<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Supplier::query();

            return DataTables::eloquent($query)
                                ->addColumn('aksi', function(Supplier $supplier) {
                                    return '<a href="' . route('supplier.edit', $supplier->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                            <button class="btn btn-danger btn-sm btn_delete" data-id="' . $supplier->id . '"><i class="bx bx-trash"></i></button>';
                                })
                                ->rawColumns(['aksi'])
                                ->toJson();
        }

        return view('pages.supplier.index');
    }

    public function create()
    {
        return view('pages.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'alamat'  => 'nullable|string',
            'telepon' => 'nullable|string|min:10|max:20',
        ]);

        $supplier = new Supplier;
        $supplier->name    = $request->name;
        $supplier->alamat  = $request->alamat;
        $supplier->telepon = $request->telepon;

        if(!$supplier->save()) {
            return redirect()->back()->withError('Supplier gagal di simpan.');
        }

        return redirect()->route('supplier.index')->withSuccess('Supplier berhasil di simpan.');
    }

    public function show(Supplier $supplier)
    {
        return $supplier;
    }

    public function edit(Supplier $supplier)
    {
        return view('pages.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'    => 'required|string',
            'alamat'  => 'nullable|string',
            'telepon' => 'nullable|string|min:10|max:20',
        ]);

        $supplier->name    = $request->name;
        $supplier->alamat  = $request->alamat;
        $supplier->telepon = $request->telepon;

        if(!$supplier->update()) {
            return redirect()->back()->withError('Supplier gagal di ubah.');
        }

        return redirect()->route('supplier.index')->withSuccess('Supplier berhasil di ubah.');
    }

    public function destroy(Supplier $supplier)
    {
        if(!$supplier->delete()) {
            return response()->json([
                'isError' => true,
                'message' => 'Supplier gagal di hapus.'
            ]);
        }

        return response()->json([
            'isError' => false,
            'message' => 'Supplier berhasil di hapus.'
        ]);
    }
}
