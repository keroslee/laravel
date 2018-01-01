<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=null)
    {
        Log::info($type);
        if($type)
        $customers = DB::table('customer')->where('type',$type)->get();
        else
            $customers = DB::table('customer')->get();
        $types = self::getEnumValues('customer', 'type');
        return view('home', ['customers'=>$customers, 'types'=>$types, 'sel'=>$type]);
    }

    public static function getEnumValues($table, $column)
    {
        $type = DB::select( DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'") )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }
        return $enum;
    }
}
