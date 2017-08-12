<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class AreaSummary extends Controller
{
    public function index(Request $request, $companyId = null)
    {
        $where = [];
        $where2 = [];
        $areaName = $request->areaName;
        $startTime = $request->startTime;
        $endTime = $request->endTime;

        if ($areaName != null) {
            $where[] = 'c.parea like \'%' . $areaName . '%\'';
            $where2 = ' a.area like \'%' . $areaName . '%\'';
        }else{
            $where2 = ' 1=1';
        }
        if ($startTime != null) {
            $startTime = $this->timeReFormat($startTime);
            $where[] = 'c.realtime >=' . $this->timeReFormat($startTime);
        }
        if ($endTime != null) {
            $endTime = $this->timeReFormat($endTime);
            $where[] = 'c.realtime <=' . $this->timeReFormat($endTime);
        }
        $where = $where ? implode(' and ', $where) : 'c.realtime > to_char(sysdate,\'yyyymmdd\')||\'000000\'';

        $goods = DB::select('select parea,count(*) good from
    (select c.parea,c.companyname,count(c.result) count,sum(c.result) sum
    from T_DATA_COMPANY c
    LEFT JOIN T_BASE_AREA a ON c.parea=a.tid
    where ' . $where . '
    group by c.parea,c.companyname)
  group by parea
  having count(case when count=sum then 1 end)>0');

        $totals = DB::select('SELECT c.parea parea,count(*) total,a.area area FROM T_BASE_COMPANY c
LEFT JOIN T_BASE_AREA a
  ON a.tid=c.parea
WHERE ' . $where2 . '
GROUP BY c.parea,a.area');

        $goodCompanies = [];
        foreach ($goods as $good) {
            $goodCompanies[$good->parea] = $good;
        }

        $results = [];
        foreach ($totals as $total) {
            $results[$total->parea] = [];
            $results[$total->parea]['total'] = $total->total;
            $results[$total->parea]['area'] = $total->area;
            if (isset($goodCompanies[$total->parea])) {
                $results[$total->parea]['good'] = $goodCompanies[$total->parea]->good;
            } else {
                $results[$total->parea]['good'] = 0;
            }
        }

        return view('area_summary', [
            'results' => $results,
            'currentUrl' => $request->url(),
            'areaName' => $areaName,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'userData' => $this->getUserData($request)
        ]);
    }

    private function timeReFormat($time)
    {
        return date('YmdHis', strtotime($time));
    }
}
