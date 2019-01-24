<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopPerformanceController extends Controller
{
    public function index()
    {
    	return view('top-performance.index');
    }
}
