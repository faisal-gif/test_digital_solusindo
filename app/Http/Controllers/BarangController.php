<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    function index()
    {
        $data = Barang::latest()->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $edit = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Edit" class="edit btn text-white btn-info btn-sm mt-1 editBarang"><i class="far fa-edit"></i> Edit</a>';
                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Delete" class="delete btn text-white btn-danger btn-sm mt-1 deleteBarang"><i class="fas fa-trash"></i> Delete</a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    function store(Request $request)
    {
        $barang = Barang::create([
            'merek' => $request->merek,
            'jenis' => $request->jenis_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);

        response()->json([
            'success' => 'Data berhasil disimpan',
            'resource' => $barang,
        ]);
    }

    public function edit($id)
    {
        $produk = Barang::find($id);
        return response()->json($produk);
    }
    public function update(Request $request)
    {
     
        $id = $request->id;
        $produk = Barang::findOrFail($id);
     

        $produk->merek = $request->merek;
        $produk->jenis = $request->jenis_produk;
        $produk->keterangan = $request->keterangan;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah',
        ]);
    }

    public function destroy($id)
    {
        $produk = Barang::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }

}
