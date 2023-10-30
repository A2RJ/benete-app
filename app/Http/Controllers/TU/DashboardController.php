<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('TU.dashboard');
    }
}
