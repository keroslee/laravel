<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class Info extends Controller
{
    public function index(Request $request)
    {
        return $this->company($request);
    }

    public function company(Request $request)
    {
        $where = [];
        $companyName = $request->companyName;

        if ($companyName != null) {
            $where[] = ['companyname', 'like', '%' . $companyName . '%'];
        }

        $myCompanies = $this->getMyCompanyTids($request);

        $results = DB::table('T_BASE_COMPANY c')
            ->leftJoin('T_BASE_AREA a', 'a.tid', '=', 'c.parea')
            ->where($where)
            ->whereIn('c.tid', $myCompanies)
            ->get();

        return view('info_company', [
            'results' => $results,
            'currentUrl' => $request->url(),
            'companyName' => $companyName,
            'companyUrl' => url('/info_company'),
            'judgeUrl' => url('/info_judge'),
            'checkUrl' => url('/info_check'),
            'userData' => $this->getUserData($request)
        ]);
    }

    public function judge(Request $request)
    {
        $where = [];
        $companyName = $request->companyName;

        $myCompanies = $this->getMyCompanyTids($request);

        if ($companyName != null) {
            $where[] = ['companyname', 'like', '%' . $companyName . '%'];
        }

        $results = DB::table('T_MK_SHENPI s')
            ->leftJoin('T_MK_YANSHOU y', 's.TID', '=', 'y.TID')
            ->leftJoin('T_BASE_COMPANY c', 'c.tid', '=', 's.companyTID')
            ->select('s.*', 'y.ysno', 'y.ysbm', 'y.yssj', 'y.CONTENT as yanshou_CONTENT', 'y.MARK as yanshou_MARK', 'c.companyname')
            ->where($where)
            ->whereIn('c.tid', $myCompanies)
            ->get();

        return view('info_judge', [
            'results' => $results,
            'currentUrl' => $request->url(),
            'companyName' => $companyName,
            'companyUrl' => url('/info_company'),
            'judgeUrl' => url('/info_judge'),
            'checkUrl' => url('/info_check'),
            'userData' => $this->getUserData($request)
        ]);
    }

    public function check(Request $request)
    {
        $where = [];
        $companyName = $request->companyName;

        $myCompanies = $this->getMyCompanyTids($request);

        if ($companyName != null) {
            $where[] = ['companyname', 'like', '%' . $companyName . '%'];
        }

        $results = DB::table('T_MK_ZHIFAJIANCHA s')
            ->leftJoin('T_BASE_COMPANY c', 'c.tid', '=', 's.companyTID')
            ->select('s.*', 'c.companyname')
            ->where($where)
            ->whereIn('c.tid', $myCompanies)
            ->orderBy('sj', 'desc')
            ->paginate(20);

        return view('info_check', [
            'results' => $results,
            'currentUrl' => $request->url(),
            'companyName' => $companyName,
            'companyUrl' => url('/info_company'),
            'judgeUrl' => url('/info_judge'),
            'checkUrl' => url('/info_check'),
            'userData' => $this->getUserData($request)
        ]);
    }
}
