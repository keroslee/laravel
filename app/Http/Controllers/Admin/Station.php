<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Log;

class Station extends TableBase
{
    protected $table = 'T_BASE_STATION';
    protected $view = 'admin.station';

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
            /*->leftJoin('T_BASE_TERMINAL t', 't.tid', '=', 's.stationname')
            ->where('t.type', 0)*/
	    ->where($where)
            ->select('s.*', 'c.companyname'/*, 't.terminalname'*/)
            ->paginate(20);

        $companies = DB::table('T_BASE_COMPANY')->get();

        $allTerminals = DB::table('T_BASE_TERMINAL')->where('type', 1)->get();
        $terminals = [];
        foreach ($allTerminals as $terminal) {
            if (isset($terminals[$terminal->companytid])) {
                $terminals[$terminal->companytid][] = $terminal;
            } else {
                $terminals[$terminal->companytid] = [$terminal];
            }
        }

        return view($this->view, [
            'results' => $results,
            'terminals' => $terminals,
            'companies' => $companies,
            'companyName' => $request->companyName,
            'currentUrl' => $request->url(),
            'userData' => $this->getUserData($request)
        ]);
    }

    public function terminals(Request $request)
    {
        $companyTid = $request->companytid;
        $tid = $request->tid;

        $data = [];
        $allTerminals = DB::table('T_BASE_TERMINAL')
            ->where('companytid', $companyTid)
            ->get();
        $data['allTerminals'] = $allTerminals;
        if ($tid) {
            $myTerminalNames = DB::table('T_BASE_STATION')
                ->where('tid', $tid)
                ->pluck('zlsbs');
            $data['myTerminals'] = explode(',', $myTerminalNames[0]);
        }
        /*$myTerminals = DB::table('T_BASE_TERMINAL')
            ->where('companytid', $companyTid)
            ->where('type', 1)
            ->whereIn('tid', explode(',', $myTerminalNames[0]))
            ->get();*/

        return response()->json($data);
    }
}
