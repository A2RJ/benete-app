<?php

namespace App\Http\Controllers\BMN;

use App\Charts\MonthlyBmnChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(MonthlyBmnChart $chart)
    {
        return view('BMN.dashboard')->with('chart', $chart->build());
    }
}
