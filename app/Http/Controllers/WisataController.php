<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use Datatables;

class WisataController extends Controller
{
    public function data()
    {
        $wisata = Wisata::get();
        // dd($wisata);
        if (request()->ajax()){
            return datatables()->of($wisata)
            ->addColumn('aksi', function ($wisata)
            {
                $button = "  <button class='edit btn  btn-sm btn-warning' id='" . $wisata->id . "' data-bs-toggle='modal' data-bs-target='#default'>Edit</button>";
                $button .= " <button class='hapus btn  btn-sm btn-danger' id='" . $wisata->id . "' >Hapus</button>";
                return $button;
            })
        ->rawColumns(['aksi'])
        ->make(true);
        }
        return view('pages.wisata.index');
    }

    public function index()
    {
        return view('pages.wisata.index');
    }

    public function store(Request $request)
    {
        $wisata = new Wisata();
        $wisata->name = $request->name;
        $wisata->address = $request->address;
        $wisata->picture_path = $request->picture_path;
        $wisata->description = $request->description;
        $simpan = $wisata->save();
        if($simpan){
            return response()->json(['data' => $wisata,
            'text'=>'wisata baru berhasil disimpan'],200);
        } else {
            return response()->json(['data' => $wisata,
            'text'=>'wisata berhasil disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $wisata = Wisata::find($id);
        return response()->json(['data' => $wisata]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $wisatas = [
            'name' => $request->name,
            'address' => $request->address,
            'picture_path' => $request->picture_path,
            'description' => $request->description,
        ];
        $wisata = Wisata::find($id);
        $simpan = $wisata->update($wisatas);
        if ($simpan) {
            return response()->json(['text' => 'Berhasil Diubah'], 200);
        } else {
            return response()->json(['text' => 'Gagal diubah'], 422);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $wisata = Wisata::find($id);
        $wisata->delete();
        return response()->json(['text' => 'Berhasil dihapus'], 200);
    }
}
