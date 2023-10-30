<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('BMN.dashboard');
    }
}
