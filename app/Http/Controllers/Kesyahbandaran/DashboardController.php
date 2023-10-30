<?php

namespace App\Http\Controllers\Kesyahbandaran;

use App\Charts\MonthlyKesyahChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(MonthlyKesyahChart $chart)
    {
        return view('Kesya.dashboard')->with('chart', $chart->build());
    }
}
