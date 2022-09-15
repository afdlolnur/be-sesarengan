<?php
namespace App\Http\Controllers;
// use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Charts\ComplaintByCaptionChart;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index(ComplaintByCaptionChart $chart)
    {
        // return view('pages.dashboard');
        return view('pages.dashboard', ['chart' => $chart->build()]);
    }
}
