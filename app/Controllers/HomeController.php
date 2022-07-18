<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

session_start();

class HomeController extends BaseController
{
    public function index()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        return $request->all();
    }
}