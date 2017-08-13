<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Log;

class TableBase extends Controller
{
    protected $table = '';
    protected $view = '';

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

    public function add(Request $request)
    {
        $data = $request->data;

        $result = DB::table($this->table)
            ->insert($data);

        return response()->json(['res' => $result]);
    }

    public function del(Request $request)
    {
        $tids = $request->tids;

        if (count($tids) > 0) {
            $result = DB::table($this->table)
                ->whereIn('TID', $tids)
                ->delete();
        } else {
            $result = 0;
        }

        return response()->json(['res' => $result]);
    }

    public function upd(Request $request)
    {
        $data = $request->data;
        $result = DB::table($this->table)
            ->where('TID', $data['tid'])
            ->update($data);

        return response()->json(['res' => $result]);
    }
}
