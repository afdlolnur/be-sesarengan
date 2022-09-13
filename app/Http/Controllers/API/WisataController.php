<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Wisata;
// use App\Models\Caption;
use Illuminate\Support\Facades\Auth;

class WisataController extends Controller
{
    public function all(Request $request)
    {
        
        $limit = $request->input('limit', 100);
        $wisata = Wisata::query()->orderBy('name','asc');

        return ResponseFormatter::success(
            $wisata->paginate($limit),
            'Data list all caption berhasil diambil'
        );
    }

    public function addwisata(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'caption' => 'required',
            // 'title',
            // 'name',
            // 'photo',
            // 'address',
            // 'description',
            // 'is_publish'
         ]);
        $caption = Caption::create([
            'name' => $request->name,
            'address' => $request->address,
            'picture_path' => $request->picture_path,
            'description' => $request->description,
         ]);

        try {
            $caption->save();
            return ResponseFormatter::success($caption, 'Caption Berhasil Ditambahkan');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 'Caption Gagal Disimpan');
        }
    }
}
