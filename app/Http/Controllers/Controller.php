<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Log;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getType(Request $request)
    {
        $user = DB::table('users')->where('id', $request->user()->id)->first();

        return (int)$user->type;
    }

    private function getAreaList(Request $request)
    {
        $userId = $request->user()->id;
        $myCompanies = DB::table('rights')->where('userid', $userId)->pluck('companytid');

        $areasLittle = DB::table('T_BASE_AREA')->whereNotNull('parea')->get();
        $companies = DB::table('T_BASE_COMPANY')->whereIn('tid', $myCompanies)->get();

        $areaList = [];
        foreach ($companies as $company) {
            foreach ($areasLittle as $areaL) {
                if ($company->parea == $areaL->tid) {
                    if (isset($areaList[$areaL->parea])) {
                        if (!in_array($areaL, $areaList[$areaL->parea])) {
                            $areaList[$areaL->parea][] = $areaL;
                        }
                    } else {
                        $areaList[$areaL->parea] = [
                            $areaL->parea => $areaL
                        ];
                    }
                }
            }
        }

        return $areaList;
    }

    private function getBigArea()
    {
        $areaBig = DB::table('T_BASE_AREA')->where('parea', null)->get();
        $ret = [];
        foreach ($areaBig as $area) {
            $ret[$area->tid] = $area->area;
        }
        return $ret;
    }

    protected function getUserData(Request $request)
    {
        return [
            'type' => $this->getType($request),
            'areaList' => $this->getAreaList($request),
            'areaBigList' => $this->getBigArea()
        ];
    }

    protected function getMyCompanies(Request $request)
    {
        $userId = $request->user()->id;
        $where = [['rights.userid', $userId]];
        if($areaId = $request->area) {
            $where[] = ['T_BASE_COMPANY.parea',$areaId];
        }
        $myCompanies = DB::table('rights')
            ->leftJoin('T_BASE_COMPANY', 'T_BASE_COMPANY.TID', '=', 'rights.companytid')
            ->where($where)
            ->pluck('T_BASE_COMPANY.companyname');
        return $myCompanies;
    }

    protected function getMyCompanyTids(Request $request)
    {
        $userId = $request->user()->id;
        $myCompanies = DB::table('rights')
            ->where('userid', $userId)
//            ->get();
            ->pluck('companytid');
        return $myCompanies;
    }

    public function upload(Request $request)
    {
        $companyFolder = $request->companyTid;
        $companyFolder = $companyFolder ? $companyFolder : 'tmp';

        $path = $request->file->storeAs($companyFolder, $request->file->getClientOriginalName(), 'public');

        $type = $request->file->getClientMimeType();
        if ($type == 'application/pdf') {
            $path = '/pdf/viewer.html?file=../storage/' . $path;
        } elseif (preg_match('/image\/.+/', $type)) {
            $path = '/storage/' . $path;
        }
        
        return response()->json(['path' => $path]);
    }
}
