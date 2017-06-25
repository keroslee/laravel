<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function show()
    {
        return view('works');
    }

	public function index()
    {
        return view('admin.works');
    }

	public function detail()
    {
        return view('wk_details');
    }

	public function edit()
    {
        return view('admin.works_edit');
    }
}
