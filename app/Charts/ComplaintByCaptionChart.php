<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class ComplaintByCaptionChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->setTitle('Top 10 Aduan')
            ->setSubtitle('2022')
            ->addData([40, 50, 30, 12, 12, 2, 24, 36, 17, 8])
            ->setLabels([
                'Bantuan Sosial Tunai (BST)', 
                'Pelanggaran Parkir', 
                'Trotoar',
                'Disabilitas',
                'Kemacetan',
                'Ketertiban Umum',
                'Jalan',
                'Layanan Puskesmas',
                'Organisasi Kemasyarakatan (ORMAS)',
                'Pelayanan Catatan Sipil',
            ]);
    }
}


