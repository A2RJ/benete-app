<?php

namespace App\Http\Controllers\Keuangan;

use App\Charts\MonthlyKeuanganChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(MonthlyKeuanganChart $chart)
    {
        return view('Keuangan.dashboard')->with('chart', $chart->build());
    }
}
