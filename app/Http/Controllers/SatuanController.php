<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SatuanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Satuan::query();

            return DataTables::eloquent($query)
                                ->addColumn('aksi', function(Satuan $satuan) {
                                    return '<a href="' . route('satuan.edit', $satuan->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                            <button class="btn btn-danger btn-sm btn_delete" data-id="' . $satuan->id . '"><i class="bx bx-trash"></i></button>';
                                })
                                ->rawColumns(['aksi'])
                                ->toJson();
        }

        return view('pages.satuan.index');
    }

    public function create()
    {
        return view('pages.satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
        ]);

        $satuan = new Satuan;
        $satuan->name = $request->name;

        if(!$satuan->save()) {
            return redirect()->back()->withError('Satuan gagal di simpan.');
        }

        return redirect()->route('satuan.index')->withSuccess('Satuan berhasil di simpan.');
    }

    public function show(Satuan $satuan)
    {
        return $satuan;
    }

    public function edit(Satuan $satuan)
    {
        return view('pages.satuan.edit', compact('satuan'));
    }

    public function update(Request $request, Satuan $satuan)
    {
        $request->validate(['name'  => 'required|string',
        ]);

        $satuan->name = $request->name;

        if(!$satuan->update()) {
            return redirect()->back()->withError('Satuan gagal di ubah.');
        }

        return redirect()->route('satuan.index')->withSuccess('Satuan berhasil di ubah.');
    }

    public function destroy(Satuan $satuan)
    {
        if(!$satuan->delete()) {
            return response()->json([
                'isError' => true,
                'message' => 'Satuan gagal di hapus.'
            ]);
        }

        return response()->json([
            'isError' => false,
            'message' => 'Satuan berhasil di hapus.'
        ]);
    }

    public function select2(Request $request)
    {
        $satuans = Satuan::all();

        $data = [];
        foreach($satuans->sortBy('name') as $satuan)
        {
            $data[] = [
                'id' => $satuan->id,
                'text' => $satuan->name
            ];
        }

        return response()->json($data);
    }
}
