<?php
namespace App\Http\Controllers;
// use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;
use App\Charts\ComplaintByCaptionChart;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index(ComplaintByCaptionChart $chart)
    {   
        return view('pages.dashboard', [
            'chart' => $chart->build(),
            'complaint_all' => Complaint::count(),
            'user_all' => User::count(),
            'complaint_dikerjakan' => DB::table('complaints')->where('status','DIKERJAKAN')->count(),
            'complaint_selesai' => DB::table('complaints')->where('status','SELESAI')->count(),
            'complaint_terkini' => Complaint::with(['user','caption'])->orderBy('created_at','desc')->limit(3)->get(),
        ]);
    }
}
