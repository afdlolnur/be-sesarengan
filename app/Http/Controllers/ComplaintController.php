<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\UserRequest;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
   
    public function index()
    {
        $complaint = Complaint::with(['user','caption'])->get();
        return view('pages.complaints.index', [
            'complaint' => $complaint
        ]);
    }

    public function data()
    {
        $complaint = DB::table('complaints')
            ->leftjoin('users', 'complaints.user_id', '=', 'users.id')
            ->leftjoin('captions', 'complaints.caption_id', '=', 'captions.id')
            ->select(
                'complaints.id',
                'captions.caption',
                'complaints.description',
                'complaints.picture_path',
                'complaints.latitude',
                'complaints.longitude',
                'complaints.district',
                'users.name',
                'complaints.is_public',
                'complaints.is_anon',
                'complaints.status',
            )
            ->get();
        // dd($complaint);
        if (request()->ajax()){
            return datatables()->of($complaint)
            ->addColumn('aksi', function ($complaint)
            {
                $button = "  <button class='edit btn  btn-sm btn-dark' id='" . $complaint->id . "' data-bs-toggle='modal' data-bs-target='#default'>Detail</button>";                
                return $button;
            })
            ->addColumn('editstatus', function ($complaint)
            {
                $button2 = "  <button class='edit-status btn  btn-sm btn-warning' id='" . $complaint->id . "' data-bs-toggle='modal' data-bs-target='#default2'>Edit</button>";
                return $button2;
            })
        ->rawColumns(['aksi','editstatus'])
        ->make(true);
        }
        return view('pages.complaints.index');
        // return $complaint;
    }
    

    public function edit(Request $request)
    {
        $id = $request->id;
        $complaint = Complaint::with(['user','caption'])->find($id);
        return response()->json(['data' => $complaint]);
    }

    public function editStatus(Request $request)
    {
        $id = $request->id;
        $complaint = Complaint::with(['user','caption'])->find($id);
        return response()->json(['data' => $complaint]);
    }

    public function updateStatus(Request $request)
    {
        // dd($request->status,);
        $current_date_time = Carbon::now()->toDateTimeString();
        $id = $request->id;

        if($request->status == 'DITERIMA')
        {
            $complaintupdate = [
                'status' => $request->status,
                'diterima_at' => $current_date_time,
                'diterima_pic' => $request->petugas,
            ];   
        } else if ($request->status == 'DIKERJAKAN'){
            $complaintupdate = [
                'status' => $request->status,
                'dikerjakan_at' => $current_date_time,
                'dikerjakan_pic' => $request->petugas,
            ];
        } else {
            $complaintupdate = [
                'status' => $request->status,
                'selesai_at' => $current_date_time,
                'selesai_pic' => $request->petugas,
            ];
        }

        $complaint = Complaint::find($id);
        $simpan = $complaint->update($complaintupdate);

        if ($simpan) {
            return response()->json(['text' => 'Berhasil Diubah'], 200);
        } else {
            return response()->json(['text' => 'Gagal diubah'], 422);
        }
    }
}
