<?php

namespace App\Http\Controllers;

use App\Models\Caption;
use Illuminate\Http\Request;
use Datatables;

class CaptionController extends Controller
{
    public function data()
    {
        $caption = Caption::get();
        if (request()->ajax()){
            return datatables()->of($caption)
            ->addColumn('aksi', function ($caption)
            {
                $button = "  <button class='edit btn  btn-sm btn-warning' id='" . $caption->id . "' data-bs-toggle='modal' data-bs-target='#default'>Edit</button>";
                $button .= " <button class='hapus btn  btn-sm btn-danger' id='" . $caption->id . "' >Hapus</button>";
                return $button;
            })
        ->rawColumns(['aksi'])
        ->make(true);
        }
        return view('pages.caption.index');
    }

    public function index()
    {
        return view('pages.caption.index');
    }

    public function store(Request $request)
    {
        $caption = new Caption();
        $caption->caption = $request->caption;
        $simpan = $caption->save();
        if($simpan){
            return response()->json(['data' => $caption,
            'text'=>'caption baru berhasil disimpan'],200);
        } else {
            return response()->json(['data' => $caption,
            'text'=>'caption berhasil disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $caption = Caption::find($id);
        return response()->json(['data' => $caption]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $captions = [
            'caption' => $request->caption,
        ];
        $caption = Caption::find($id);
        $simpan = $caption->update($captions);
        if ($simpan) {
            return response()->json(['text' => 'Berhasil Diubah'], 200);
        } else {
            return response()->json(['text' => 'Gagal diubah'], 422);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $caption = Caption::find($id);
        $caption->delete();
        return response()->json(['text' => 'Berhasil dihapus'], 200);
    }
}
