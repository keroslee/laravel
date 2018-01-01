<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class CouponController extends Controller
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
    public function index($brand = null, $type = null)
    {
        Log::info($brand);
        Log::info($type);
        $where = [];
        if ($brand)
            $where[] = ['brand', '=', $brand];
        if ($type)
            $where[] = ['type', '=', $type];
        $coupons = DB::table('coupon')->where($where)->get();
        $brands = self::getEnumValues('coupon', 'brand');
        $types = self::getEnumValues('coupon', 'type');
        return view('coupon', [
            'coupons' => $coupons,
            'brands' => $brands,
            'types' => $types,
            'sel1' => $brand,
            'sel2' => $type]);
    }

    public static function getEnumValues($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum = array_add($enum, $v, $v);
        }
        return $enum;
    }
}
