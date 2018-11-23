<?php

namespace Larapost\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaraPostController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('larapost::home');
    }   

}
