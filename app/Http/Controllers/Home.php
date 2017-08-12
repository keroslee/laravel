<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use DB;
use Ramsey\Uuid\Uuid;

class Home extends Controller
{
    public function index(Request $request)
    {
        $myCompanies = $this->getMyCompanies($request);
        
        if ($this->getType($request) == 3) {
            $userId = $request->user()->id;
            $right = DB::table('rights')->where('userid', $userId)->first();
            if ($right)
                return redirect('/terminal/' . $right->companytid);
            else {
                return redirect('/terminal/' . $right->companytid);
            }
        } else if ($this->getType($request) == 1) {
            return redirect('/admin/userright');
        }

        return view('home', [
            'status' => $this->status($myCompanies),
            'userData' => $this->getUserData($request)
        ]);
    }

    public function getStatus(Request $request)
    {
        $myCompanies = $this->getMyCompanies($request);
        $status = $this->status($myCompanies);

        return response()->json($status);
    }

    private function status($myCompanies)
    {
        Log::info($myCompanies);
        $stationsBase = DB::table('T_BASE_TERMINAL t')
            ->leftJoin('T_BASE_COMPANY c', 'c.tid', '=', 't.companytid')
            ->whereIn('c.companyname', $myCompanies)
            ->get();
        Log::info($stationsBase);

        $myStations = DB::table('T_DATA_TERMINAL as d')
            /*->join('T_BASE_TERMINAL as b', function ($join) {
                $join->on('d.pcompany', '=', 'b.companytid')
                    ->on('d.stationname', '=', 'b.terminalname');
            })*/
            ->whereIn('d.pcompany', $myCompanies)
            ->where('d.realtime','>',date('YmdHis', floor(time() / 300) * 300-300))
            ->get();
Log::info($myStations);
        $stations = [];
        foreach ($myStations as $myStation) {
            foreach ($stationsBase as $stationBase) {
                if ($stationBase->companyname == $myStation->pcompany
                    && $stationBase->terminalname == $myStation->stationname
                ) {
                    $stations[] = array(
                        'pcompany' => $myStation->pcompany,
                        'type' => $stationBase->type,
                        'state' => $myStation->state
                    );
                }
            }
        }
        
        $runningCompanies = [];
        $goodCompanies = [];
        $badCompanies = [];
        $companies = [];

        foreach ($stations as $station) {
            if (!in_array($station['pcompany'], $companies)) {
                $companies[] = $station['pcompany'];
            }

            if ($station['type'] == 0
                && $station['state'] == 1
                && !in_array($station['pcompany'], $runningCompanies)
            ) {
                $runningCompanies[] = $station['pcompany'];
            }

           /* if ($station['type'] == 0
                && $station['state'] == 1
            ) {
                foreach ($stations as $station2) {
                    if ($station2['pcompany'] != $station['pcompany'] || $station2['type'] == 0) {
                        continue;
                    }
                    if ($station2['state'] == 0) {
                        $key = array_search($station2['pcompany'],$goodCompanies);
                        if($key!==false){
                            unset($goodCompanies[$key]);
                        }
                        break;
                    } else if ($station2['state'] == 1) {
                        $goodCompanies[] = $station2['pcompany'];
                    }
                }
            }*/

            if ($station['type'] == 0
                && $station['state'] != 1
                && !in_array($station['pcompany'], $badCompanies)
            ) {
                $badCompanies[] = $station['pcompany'];
            }
        }

		$good = DB::table('T_DATA_COMPANY as d')
            ->whereIn('d.companyname', $myCompanies)
			->where('result','1')
            ->where('d.realtime','>',date('YmdHis', floor(time() / 300) * 300-300))
			->count();

		$bad = DB::table('T_DATA_COMPANY as d')
            ->whereIn('d.companyname', $myCompanies)
			->where('result','0')
            ->where('d.realtime','>',date('YmdHis', floor(time() / 300) * 300-300))
			->count();

        return ['total' => count($companies), 'running' => count($runningCompanies), 'good'=>$good, 'bad'=>$bad];
    }

    public function uuid()
    {
        return response()->json(['tid' => Uuid::uuid4()]);
    }
}
