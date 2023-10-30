<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $year = date('Y');
        $statistic = User::query()->whereYear('created_at', $year)->statistics();
        return $this->chart->lineChart()
            ->setTitle("User $year.")
            ->setSubtitle("Jumlah user yang dibuat pada setiap bulan pada tahun $year.")
            ->addData('Users', array_values($statistic))
            ->setXAxis(array_keys($statistic));
    }
}
