<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Charts\MonthlyPelabuhanChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(MonthlyPelabuhanChart $chart)
    {
        return view('Pelabuhan.dashboard')->with('chart', $chart->build());
    }
}
