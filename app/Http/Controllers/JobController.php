<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function show()
    {
        return view('jobs');
    }

	public function index()
    {
        return view('admin.jobs');
    }
}
