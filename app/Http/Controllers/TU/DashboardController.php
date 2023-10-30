<?php

namespace App\Http\Controllers\TU;

use App\Charts\MonthlyTUChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(MonthlyTUChart $chart)
    {
        return view('TU.dashboard')->with('chart', $chart->build());
    }
}
