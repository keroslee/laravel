<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use DB;
use Log;

class Terminal extends Controller
{
    public function index(Request $request)
    {
        $companyName = $request->companyName;
        if ($companyName != null) {
            $tid = DB::table('T_BASE_COMPANY')
                ->where('companyname', 'like', '%' . $companyName . '%')
                ->value('tid');
        } else {
            $tid = $request->tid;
        }

        $status = $this->getStatus($tid);
        $pareaTid = DB::table('T_BASE_COMPANY')->where('tid', $tid)->value('parea');
        $companies = DB::table('T_BASE_COMPANY c')
            ->leftJoin('T_BASE_AREA a', 'c.parea', '=', 'a.tid')
            ->where('c.parea', $pareaTid)
            ->select('c.tid', 'c.companyname')
            ->get();

        return view('terminal', [
            'terminals' => $status['terminals'],
            'status' => $status['status'],
            'companyTid' => $tid,
            'userData' => ['type' => $this->getType($request), 'companiesSameArea' => $companies], 'companyName' => $companyName,
            'currentUrl' => $request->url()]);
    }

    public function status(Request $request)
    {
        return response()->json($this->getStatus($request->tid));
    }

    private function getStatus($tid)
    {

//        $company = DB::table('T_BASE_COMPANY')->where('tid',$tid)->get();
        if ($tid != null) {
            /*$terminals = DB::table('T_DATA_TERMINAL')
                ->leftJoin('T_BASE_COMPANY', 'T_DATA_TERMINAL.PCOMPANY', '=', 'T_BASE_COMPANY.COMPANYNAME')
                ->where('T_BASE_COMPANY.tid', $tid)
                ->select('T_DATA_TERMINAL.*', 'T_BASE_COMPANY.companyname', 'T_BASE_COMPANY.gongyitu')
                ->get();*/
            $terminals = DB::select("select * 
                                      from T_DATA_TERMINAL t 
                                      left join (select * 
                                                  from T_BASE_TERMINAL t 
                                                  left join T_BASE_COMPANY c 
                                                      on c.tid=t.companytid) tc 
                                          on t.pcompany=tc.companyname 
                                              and t.stationname=tc.terminalname 
                                      where t.realtime > to_char(sysdate - interval '5' MINUTE,'yyyyMMddHH24miss')
                                          and tc.companytid='" . $tid . "'
                                      order by tc.type");

            $terminals = new Collection($terminals);

            $status = [
                'time' => 0
            ];
            foreach ($terminals as $terminal) {
                if ($terminal->type == 0 && $terminal->state == 1) {
                    foreach ($terminals as $terminal2) {
                        if ($terminal2->state == 1) {
                            $status['state'] = true;
                        } else {
                            $status['state'] = false;
                            break;
                        }
                    }
                }
                $status['time'] = max($status['time'], strtotime($terminal->realtime));
            }
            $status['state'] = isset($status['state']) && $status['state'];
            $status['time'] = date('Y年m月d日 H时i分s秒', $status['time']);
        } else {
            $terminals = new Collection([]);
            $status = ['state' => false, 'time' => 0];
        }
        return ['terminals' => $terminals, 'status' => $status];
    }
}
