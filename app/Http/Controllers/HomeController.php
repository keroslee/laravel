<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index22()
    {
        return view('home');
    }

    public function show()
    {
        return view('index');
    }

	public function index()
    {
        return view('admin.home');
    }

	public function edit()
    {
        return view('admin.home_edit');
    }
}
