<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Pelabuhan.dashboard');
    }
}
