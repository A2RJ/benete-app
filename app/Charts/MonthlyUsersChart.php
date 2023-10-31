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
        $user = User::query()
            ->whereYear('created_at', $year)
            ->statistics(); 

        return $this->chart->lineChart()
            ->setTitle("User $year.")
            ->setSubtitle("Jumlah user yang dibuat pada setiap bulan pada tahun $year.")
        ->addData('-', [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,])
            ->addData('Users', array_values($user))
            ->setXAxis(array_keys($user));
    }
}
