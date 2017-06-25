<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show()
    {
        return view('events');
    }

	public function index()
    {
        return view('admin.events');
    }
}
