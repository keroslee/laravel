<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class Company extends Controller
{
    public function index(Request $request, $status = null)
    {
        $companyName = $request->companyName;
        $areaTid = $request->area;
        $userId = $request->user()->id;

        $where = [];
        $where[] = ['T_DATA_STATION.realtime', '>', date('YmdHis', floor(time() / 300) * 300-300)];
        if ($companyName != null) {
            $where[] = ['T_DATA_STATION.PCOMPANY', 'like', '%' . $companyName . '%'];
        }
        if ($areaTid != null) {
            $where[] = ['T_BASE_COMPANY.parea', $areaTid];
        }

        $myCompanyNames = DB::table('rights')
            ->leftJoin('T_BASE_COMPANY', 'rights.companytid', '=', 'T_BASE_COMPANY.tid')
            ->where('rights.userid', $userId)
            ->pluck('companyname');
        if($status == 'running') {
            $myCompanyNames = DB::table('T_DATA_COMPANY as d')
                ->whereIn('d.companyname', $myCompanyNames)
                ->where('d.realtime','>',date('YmdHis', floor(time() / 300) * 300-300))
                ->pluck('companyname');
        }elseif($status == 'good') {
            $myCompanyNames = DB::table('T_DATA_COMPANY as d')
                ->whereIn('d.companyname', $myCompanyNames)
                ->where('result','1')
                ->where('d.realtime','>',date('YmdHis', floor(time() / 300) * 300-300))
                ->pluck('companyname');
        }elseif($status == 'bad') {
            $myCompanyNames = DB::table('T_DATA_COMPANY as d')
                ->whereIn('d.companyname', $myCompanyNames)
                ->where('result','0')
                ->where('d.realtime','>',date('YmdHis', floor(time() / 300) * 300-300))
                ->pluck('companyname');
        }

        $result = DB::table('T_DATA_STATION')
            ->leftJoin('T_BASE_COMPANY', 'T_DATA_STATION.PCOMPANY', '=', 'T_BASE_COMPANY.COMPANYNAME')
            ->where($where)
            ->whereIn('T_DATA_STATION.PCOMPANY', $myCompanyNames)
            ->orderBy('T_DATA_STATION.PCOMPANY')
            ->get();

        $companies = [];
        foreach ($result as $index => $res) {
            if (isset($companies[$res->pcompany])) {
                $companies[$res->pcompany]['total'] += 1;
                if ($res->result) {
                    $companies[$res->pcompany]['good'] += 1;
                } else {
                    $companies[$res->pcompany]['bad'] += 1;
                }
                $lastTime = max($res->realtime, $companies[$res->pcompany]['lastTime']);
                $lastTime = date('Y-m-d H:i:s', floor(strtotime($lastTime) / 300) * 300);
                $companies[$res->pcompany]['lastTime'] = $lastTime;
            } else {
                $companies[$res->pcompany]['total'] = 1;
                $companies[$res->pcompany]['running'] = '未运行';
                if ($res->result) {
                    $companies[$res->pcompany]['good'] = 1;
                    $companies[$res->pcompany]['bad'] = 0;
                } else {
                    $companies[$res->pcompany]['good'] = 0;
                    $companies[$res->pcompany]['bad'] = 1;
                }
                $lastTime = date('Y-m-d H:i:s', floor(strtotime($res->realtime) / 300) * 300);
                $companies[$res->pcompany]['lastTime'] = $lastTime;
            }
            if ($res->s_state) {
                $companies[$res->pcompany]['running'] = '正在运行';
            }
            $companies[$res->pcompany]['name'] = $res->pcompany;
            $companies[$res->pcompany]['contact'] = $res->lianxiren;
            $companies[$res->pcompany]['tel'] = $res->lianxitel;
            $companies[$res->pcompany]['tid'] = $res->tid;
        }

        return view('company', [
            'status' => $status,
            'companyName' => $companyName,
            'currentUrl' => $request->url(),
            'companies' => $companies,
            'userData' => $this->getUserData($request)
        ]);
    }

    public function getStatus(Request $request)
    {
        $tids = $request->tids;
        $result = DB::table('T_DATA_STATION')
            ->leftJoin('T_BASE_COMPANY', 'T_DATA_STATION.PCOMPANY', '=', 'T_BASE_COMPANY.COMPANYNAME')
            ->where('realtime', '>', date('YmdHis', floor(time() / 300) * 300-300))
            ->whereIn('T_BASE_COMPANY.tid', $tids)
//            ->whereIn('T_BASE_COMPANY.tid', $myCompanies)
            ->orderBy('T_DATA_STATION.PCOMPANY')
            ->get();

        $companies = [];
        foreach ($result as $index => $res) {
            if (isset($companies[$res->tid])) {
                $companies[$res->tid]['total'] += 1;
                if ($res->result) {
                    $companies[$res->tid]['good'] += 1;
                } else {
                    $companies[$res->tid]['bad'] += 1;
                }
                $lastTime = max($res->realtime, $companies[$res->tid]['lastTime']);
                $lastTime = date('Y-m-d H:i:s', floor(strtotime($lastTime) / 300) * 300);
                $companies[$res->tid]['lastTime'] = $lastTime;
            } else {
                $companies[$res->tid]['total'] = 1;
                $companies[$res->tid]['running'] = '已停止';
                if ($res->result) {
                    $companies[$res->tid]['good'] = 1;
                    $companies[$res->tid]['bad'] = 0;
                } else {
                    $companies[$res->tid]['good'] = 0;
                    $companies[$res->tid]['bad'] = 1;
                }
                $lastTime = date('Y-m-d H:i:s', floor(strtotime($res->realtime) / 300) * 300);
                $companies[$res->tid]['lastTime'] = $lastTime;
            }
            if ($res->s_state) {
                $companies[$res->tid]['running'] = '正在运行';
            }
            $companies[$res->tid]['name'] = $res->pcompany;
            $companies[$res->tid]['contact'] = $res->lianxiren;
            $companies[$res->tid]['tel'] = $res->lianxitel;
            $companies[$res->tid]['tid'] = $res->tid;
        }

        return response()->json($companies);
    }
}
