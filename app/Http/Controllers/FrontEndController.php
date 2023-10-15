<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    /**
     * Display a index route default response.
     */
    public function index(Request $request)
    {
        return view("index");
    }
}
