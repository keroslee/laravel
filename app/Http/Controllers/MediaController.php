<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function show()
    {
		$view = $this->isMobile()?'mobile.media':'media';
        return view($view);
    }

	public function index()
    {
        return view('admin.media');
    }
}
