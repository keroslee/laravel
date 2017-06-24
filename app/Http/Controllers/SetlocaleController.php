<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class SetlocaleController extends Controller
{
    public function index($lang)
    {
        $cookie = Cookie::make('locale', $lang,'10080');
        return Redirect::back()->withCookie($cookie);
    }
}
