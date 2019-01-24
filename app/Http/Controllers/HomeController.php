<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContentService;
use App\SearchTerm;
use App\ContentES;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('agent');
    }
}
