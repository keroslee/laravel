<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;

class Check extends TableBase
{
    protected $table = 'T_MK_ZHIFAJIANCHA';
    protected $view = 'admin.check';

    public function index(Request $request)
    {
        $where = [];
        if ($request->companyName) {
            $where[] = ['c.companyname', $request->companyName];
        }
        if ($request->tid) {
            $where[] = ['c.tid', $request->tid];
        }
        $results = DB::table($this->table . ' s')
            ->leftJoin('T_BASE_COMPANY c', 'c.tid', '=', 's.companyTID')
            ->where($where)
            ->select('s.*', 'c.companyname')
            ->orderBy('sj', 'desc')
            ->paginate(20);
        $companies = DB::table('T_BASE_COMPANY')->get();

        return view($this->view, [
            'results' => $results,
            'companies' => $companies,
            'companyName' => $request->companyName,
            'currentUrl' => $request->url(),
            'userData' => $this->getUserData($request)
        ]);
    }
}
