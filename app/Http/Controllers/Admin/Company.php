<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use DB;
use Log;

class Company extends Controller
{
    public function index(Request $request)
    {
//        $myCompanies = $this->getMyCompanyTids($request);
        $page = $request->page;

        $where = [];
        if ($request->areaTid) {
            $where[] = 'c.parea=' . $request->areaTid;
        }
        if ($request->companyName) {
            $where[] = 'c.companyname=\'' . $request->companyName . '\'';
        }
        if ($request->tid) {
            $where[] = 'c.tid=\'' . $request->tid . '\'';
        }
        $where = $where ? ' where ' . implode(' and', $where) : '';

//        $rights = DB::table('RIGHTS')
//            ->leftJoin('USERS','USERS.id','=','RIGHTS.userid');

        /*$results = DB::table('T_BASE_COMPANY as c')
            ->leftJoin('T_BASE_AREA as a', 'a.tid', '=', 'c.parea')
            ->where($where)
//            ->whereIn('c.tid', $myCompanies)
//            ->union($rights)
            ->select('c.*', 'a.area as area')
            ->paginate(20);*/

        $results = DB::select('SELECT c.*,a.area area,right.* FROM T_BASE_COMPANY c
LEFT JOIN T_BASE_AREA a ON c.parea=a.tid
LEFT JOIN (SELECT * FROM RIGHTS r LEFT JOIN USERS u ON r.userid=u.id WHERE u.type=3) right ON c.tid=right.companytid' . $where);
//        $results = new Collection($results);
//        ->paginate(20);

//        $perPage = 2;
//        $results = new \Illuminate\Pagination\LengthAwarePaginator(array_slice($results, $page-1, $perPage), count($results), $perPage);
//        $results->setPath('company');

        $pareas = DB::table('T_BASE_AREA')
            ->whereNotNull('PAREA')
            ->get();

        return view('admin.company', [
            'companies' => $results,
            'currentUrl' => $request->url(),
            'companyName' => $request->companyName,
            'areaTid' => $request->areaTid,
            'pareas' => $pareas,
            'userData' => $this->getUserData($request)
        ]);
    }

    public function add(Request $request)
    {
        $json = [];
        $data = $request->data['data'];
        $userData = $request->data['user'];

        $result = DB::table('T_BASE_COMPANY')
            ->insert($data);
        $json['res'] = $result > 0;

        if (DB::table('USERS')->where('email', $userData['acc'])->count() > 0) {
            $json['err'] = '账号已存在';
            $json['res'] = false;
        } else {
            $insertData = [
                'name' => $userData['acc'],
                'email' => $userData['acc'],
                'password' => bcrypt($userData['passwd']),
                'type' => 3
            ];
            $insertUserResult = DB::table('USERS')
                ->insert($insertData);

            $userId = DB::table('USERS')->where('email', $userData['acc'])->value('id');
            $insertData = [
                ['userid' => $userId, 'companytid' => $data['tid']],
                ['userid' => 2, 'companytid' => $data['tid']],
            ];
            $insertRightResult = DB::table('RIGHTS')
                ->insert($insertData);

            if (!$insertUserResult || !$insertRightResult) {
                $json['err'] = '新建企业账号失败';
                $json['res'] = false;
            }
        }

        return response()->json($json);
    }

    public function del(Request $request)
    {
        $tids = $request->tids;

        if (count($tids) > 0) {
            $result = DB::table('T_BASE_COMPANY')
                ->whereIn('TID', $tids)
                ->delete();

            $users = DB::table('RIGHTS')
                ->whereIn('companytid', $tids)
                ->pluck('userid');

            DB::table('RIGHTS')
                ->where('userid', $request->user()->id)
                ->whereIn('companytid', $tids)
                ->delete();

            DB::table('USERS')
                ->whereIn('id', $users)
                ->delete();
        } else {
            $result = 0;
        }

        return response()->json(['res' => $result]);
    }

    public function upd(Request $request)
    {
        $json = [];
        $data = $request->data['data'];
        $userData = $request->data['user'];

        $result = DB::table('T_BASE_COMPANY')
            ->where('TID', $data['tid'])
            ->update($data);
        $json['res'] = $result > 0;

//        if (DB::table('USERS')->where('email', $userData['acc'])->count() > 0) {
//            $json['err'] = '账号已存在';
//            $json['res'] = false;
//        } else {
//            $userId = DB::table('USERS')->where('email', $userData['acc'])->value('id');
            $updateUserResult = DB::table('USERS')
                ->where('id', $userData['userid'])
                ->update(['name' => $userData['acc'], 'email' => $userData['acc'], 'password' => bcrypt($userData['passwd']), 'type' => 3]);
            if (!$updateUserResult) {
                $json['err'] = '修改账号信息失败';
                $json['res'] = false;
            }
//        }

        return response()->json($json);
    }
}