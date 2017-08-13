<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class CompanySummary extends Controller
{
    public function index(Request $request, $companyId = null)
    {
        $myCompanies = $this->getMyCompanies($request);
        $where = [];
        $companyName = $request->companyName;
        $startTime = $request->startTime;
        $endTime = $request->endTime;

        if ($companyName != null) {
            $where[] = 'pcompany like \'%' . $companyName . '%\'';
        }
        if ($startTime != null) {
            $where[] = 'realtime >=\'' . date('YmdHis', strtotime($startTime)) . '\'';
        }
        if ($endTime != null) {
            $where[] = 'realtime <=\'' . date('YmdHis', strtotime($endTime)+86400) . '\'';
        }
        $where = $where ? implode(' and ', $where) : 'realtime > to_char(sysdate,\'yyyymmdd\')||\'000000\'';
        $where = $where . ' and pcompany in (\'' . implode('\' ,\'', $myCompanies->toArray()) . '\')';

        $results = DB::select('SELECT * FROM T_DATA_STATION
            WHERE ' . $where);

        return view('company_summary', [
            'results' => $results,
            'currentUrl' => $request->url(),
            'companyName' => $companyName,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'userData' => $this->getUserData($request)
        ]);
    }
}
