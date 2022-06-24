<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function complaint(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'is_public' => 'required',
            // 'is_secret' => 'required',
         ]);

         $complaint = Complaint::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            // 'picture_path' => $request->picture_path,
            'picture_path' => $request->file('picture_path')->store('assets/photo', 'public'),
            'location' => $request->location,
            'district' => $request->district,
            'is_public' => $request->is_public,
            'is_anon' => $request->is_anon,
            'caption' => $request->caption
         ]);

        //  if ($request->file('file')){
        //     $file = $request->file->store('assets/user', 'public');
        //     $complaint->picture_path = $file;
        //  }
        
            //  $complaint = Complaint::with('user')->find($complaint->id);
        //  dd($complaint);
        try {
            
            $complaint->save();

            // mengembalikan di API
            return ResponseFormatter::success($complaint, 'Laporan Berhasil Ditambahkan');

        } catch (Exception $e) {
            // Mengembalikan data ke API
            return ResponseFormatter::error($e->getMessage(), 'Laporan Gagal Disimpan');
        }
    }
}
