<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Caption;
use Illuminate\Support\Facades\Auth;

class CaptionController extends Controller
{
    public function all(Request $request)
    {
        $limit = $request->input('limit', 100);
        $caption = Caption::query();

        return ResponseFormatter::success(
            $caption->paginate($limit),
            'Data list all caption berhasil diambil'
        );
    }

    public function addcaption(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'caption' => 'required',
         ]);
        $caption = Caption::create([
            'caption' => $request->caption,
         ]);

        try {
            $caption->save();
            return ResponseFormatter::success($caption, 'Caption Berhasil Ditambahkan');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 'Caption Gagal Disimpan');
        }
    }
}
