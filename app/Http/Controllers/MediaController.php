<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function show()
    {
        return view('media');
    }

	public function index()
    {
        return view('admin.media');
    }
}
