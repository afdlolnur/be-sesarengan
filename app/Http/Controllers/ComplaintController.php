<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\UserRequest;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    
    public function index()
    {
        $complaint = Complaint::with(['user','caption'])->get();
        // $user = Complaint::paginate(20);

        // dd($complaint);
        return view('pages.complaints.index', [
            'complaint' => $complaint
        ]);
    }

    public function data()
    {
        // $complaint = Complaint::get();
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
                // $button .= " <button class='hapus btn  btn-sm btn-danger' id='" . $complaint->id . "' >Hapus</button>";
                return $button;
            })
        ->rawColumns(['aksi'])
        ->make(true);
        }
        return view('pages.complaints.index');
        // return $complaint;
    }
    



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data['picturePath'] = $request->file('picturePath')->store('assets/user', 'public');

        User::create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $complaint = Complaint::find($id);
        return response()->json(['data' => $complaint]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        if($request->file('picturePath'))
        {
            $data['picturePath'] = $request->file('picturePath')->store('assets/user', 'public');
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
