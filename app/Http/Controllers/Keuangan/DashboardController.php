<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Keuangan.dashboard');
    }
}
