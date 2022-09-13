<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Complaint;
use App\Models\DetailComplaint;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // post aduan
    public function complaint(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            // 'title' => 'required',
            // 'description' => 'required',
            // 'is_public' => 'required',
            // 'is_anon' => 'required',
            // 'picture_path' => 'required'
         ]);
         

         $complaint = Complaint::create([
            'user_id' => $request->user_id,
            // 'title' => $request->title,
            'description' => $request->description,

            'picture_path' => $request->file('picture_path')->store('asset/photo', 'public'),
            
            // 'picture_path' => $request->file('picture_path'),

            // file_put_content($image, $realImage); 
            // 'picture_path' => $aaa,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'district' => $request->district,
            'is_public' => $request->is_public,
            'is_anon' => $request->is_anon,
            'caption_id' => $request->caption_id,
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

    //get list of aduan/complaint
    public function all(Request $request)
    {
        // $id = $request->input('id');
        $limit = $request->input('limit', 100);
        // $complaint_id = $request->input('complaint_id');
        // $status = $request->input('status');

        // if($id)
        // {
        //     $complaint = Complaint::with(['user'])->find($id);

        //     if($complaint)
        //         return ResponseFormatter::success(
        //             $complaint,
        //             'Data aduan berhasil diambil'
        //         );
        //     else
        //         return ResponseFormatter::error(
        //             null,
        //             'Data aduan tidak ada',
        //             404
        //         );
        // }

        // $complaint = Complaint::with(['user'])->where('user_id', Auth::user()->id);
        //$complaint = Complaint::query();
        $complaint = Complaint::with(['user','caption'])
        ->select([
            'id',
            'description',
            'picture_path',
            'latitude',
            'longitude',
            'district',
            'is_public',
            'is_anon',
            'caption_id',
            'user_id',
            'status',
            'created_at'
        ])->where('is_public', 1)
        ->orderBy('created_at','desc');


        // if($food_id)
        //     $complaint->where('food_id', $food_id);

        // if($status)
        //     $complaint->where('status', $status);

        return ResponseFormatter::success(
            $complaint->paginate($limit),
            'Data list aduan berhasil diambil'
        );
    }
    
    public function detail(Request $request)
    {
       
       
        $detailcomplaint = DetailComplaint::with(['complaint'])->where('complaint_id',$request->id)->orderBy('created_at','desc');
        //$detailcomplaint= DetailComplaint::query();
    //dd($detailcomplaint);

        return ResponseFormatter::success(
            $detailcomplaint->get(),
            'Detail List Aduan Berhasil diambil'
        );
    }
    
    public function complaintdetail(Request $request, $id)
    {
        
        // dd($id);
        if($id){
            $complaint = Complaint::with(['user','caption'])
            ->select([
            'id','description','picture_path','latitude','longitude','district','is_public','is_anon','caption_id','user_id','status','pending_pic','pending_at','created_at'
        ])->find($id);
            
            if($complaint){
                if($complaint->status == 'PENDING'){
                    $data1 = Complaint::select([
                        'id',
                        'is_pending as status',
                        'pending_pic as pic',
                        'pending_at as time'])->find($id);
                    $data = [$data1];
                }
                
                if($complaint->status == 'DITERIMA'){
                    $data1 = Complaint::select([
                        'id',
                        'is_pending as status',
                        'pending_pic as pic',
                        'pending_at as time'])->find($id);
                    $data2 = Complaint::select([
                        'id',
                        'is_diterima as status',
                        'diterima_pic as pic',
                        'diterima_at as time'])->find($id);
                    $data = [$data2, $data1];
                }
                
                if($complaint->status == 'DIKERJAKAN'){
                    $data1 = Complaint::select([
                        'id',
                        'is_pending as status',
                        'pending_pic as pic',
                        'pending_at as time'])->find($id);
                    $data2 = Complaint::select([
                        'id',
                        'is_diterima as status',
                        'diterima_pic as pic',
                        'diterima_at as time'])->find($id);
                    $data3 = Complaint::select([
                        'id',
                        'is_dikerjakan as status',
                        'dikerjakan_pic as pic',
                        'dikerjakan_at as time'])->find($id);
                    $data = [$data3, $data2, $data1];
                }
                
                if($complaint->status == 'SELESAI'){
                    $data1 = Complaint::select([
                        'id',
                        'is_pending as status',
                        'pending_pic as pic',
                        'pending_at as time'])->find($id);
                    $data2 = Complaint::select([
                        'id',
                        'is_diterima as status',
                        'diterima_pic as pic',
                        'diterima_at as time'])->find($id);
                    $data3 = Complaint::select([
                        'id',
                        'is_dikerjakan as status',
                        'dikerjakan_pic as pic',
                        'dikerjakan_at as time'])->find($id);
                    $data4 = Complaint::select([
                        'id',
                        'is_selesai as status',
                        'selesai_pic as pic',
                        'selesai_at as time'])->find($id);
                    $data = [$data4, $data3, $data2, $data1];
                }
                
                return ResponseFormatter::success(
                    $data,
                    'Detail Aduan dengan id '.$id.' Berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Aduan dgn id '.$id.' tidak ada',
                    404
                );
            }
        } else {
            return ResponseFormatter::error(
                null,
                'Data Aduan tsb tidak ada',
                404
            );
        }
        
        
        
        // $detailcomplaint = DetailComplaint::with(['complaint'])->where('complaint_id',$request->id)->orderBy('created_at','desc');
        //$detailcomplaint= DetailComplaint::query();
    //dd($detailcomplaint);

        // return ResponseFormatter::success(
        //     $detailcomplaint->get(),
        //     'Detail List Aduan Berhasil diambil'
        // );
    }
}
