<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Log;

class UserRight extends Controller
{
    protected $table = 'rights';
    protected $view = 'admin.userright';

    public function index(Request $request)
    {

        $users = DB::table('users')->where('type',2)->get();
        $areasBig = DB::table('T_BASE_AREA')->where('parea', null)->get();
        $areasLittle = DB::table('T_BASE_AREA')->whereNotNull('parea')->get();
        $companies = DB::table('T_BASE_COMPANY')->get();

        $data = [
            'currentUrl' => $request->url(),
        ];
        $data['userData'] = $this->getUserData($request);
        if ($this->getType($request) != 1) {
            $data['rightError'] = true;
        } else {
            $data['rightError'] = false;
            $data['users'] = $users;
            $data['areasBig'] = $areasBig;
            $data['areasLittle'] = $areasLittle;
            $data['companies'] = $companies;
        }

        return view($this->view, $data);
    }

    public function upd(Request $request)
    {
        $userId = $request->userId;
        $companyTids = $request->tids;
        $data = [];

        $result = DB::table('rights')->where('userid', $userId)->delete();

        Log::info('del ret' . $request);

        if ($companyTids) {
            foreach ($companyTids as $companyTid) {
                $data[] = [
                    'userid' => $userId,
                    'companytid' => $companyTid
                ];
            }

            $result = DB::table('rights')->insert($data);
            Log::info('insert ret' . $request);
        }

        return response()->json(['res' => $result >= 0]);
    }

    public function userright(Request $request)
    {
        $userId = $request->userId;

        $rights = DB::table('rights')->select('companytid')->where('userid', $userId)->get();

        return response()->json([
            'res' => count($rights) >= 0,
            'rights' => $rights
        ]);
    }
}
