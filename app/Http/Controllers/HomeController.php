<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{   
    /**
     * Show the landing page.
     *
     * @return void
     */
    public function index()
    {
        return view('index');
    }
}
