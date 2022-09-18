<?php

namespace App\Charts;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;
use App\Charts\ComplaintByCaptionChart;

class ComplaintByCaptionChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $data_label = DB::table('complaints')
                ->leftJoin('captions', 'captions.id', '=', 'complaints.caption_id')
                 ->select('captions.caption', DB::raw('count(*) as total'))
                 ->groupBy('captions.caption')
                 ->orderBy('total','desc')
                 ->limit(10)
                 ->pluck('captions.caption')->toArray();
        
        $data_total = DB::table('complaints')
                 ->leftJoin('captions', 'captions.id', '=', 'complaints.caption_id')
                  ->select('captions.caption', DB::raw('count(*) as total'))
                  ->groupBy('captions.caption')
                  ->orderBy('total','desc')
                  ->limit(10)
                  ->pluck('total')->toArray();

        return $this->chart->pieChart()
            ->setTitle('Top 10 Aduan')
            ->setSubtitle('2022')
            ->addData($data_total)
            ->setLabels($data_label);
    }
}


