<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Excel;
use Ramsey\Uuid\Uuid;
use Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use \Crypt;

class Company extends Controller
{
    public function index(Request $request)
    {
//        $myCompanies = $this->getMyCompanyTids($request);
        $page = $request->page;
        $page = $page ? $page : 1;

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

//        $perPage = 10;
//        $results = new \Illuminate\Pagination\LengthAwarePaginator(array_slice($results, $page-1, $perPage), count($results), $perPage);
//        $results->setPath('company');

        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;
        $results = new \Illuminate\Pagination\LengthAwarePaginator(array_slice($results, $offset, $perPage, true), count($results), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

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
                ->where('type',3)
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

        if( strlen($userData['passwd']) == 60 && preg_match('/^\$2y\$/', $userData['passwd'] )){
            $passwd = $userData['passwd'];
        }else{
            $passwd = bcrypt($userData['passwd']);
        }

        $updateUserResult = DB::table('USERS')
            ->where('id', $userData['userid'])
            ->update(['name' => $userData['acc'], 'email' => $userData['acc'], 'password' => $passwd, 'type' => 3]);
        if (!$updateUserResult) {
            $json['err'] = '修改账号信息失败';
            $json['res'] = false;
        }
//        }

        return response()->json($json);
    }

    public function import(Request $request)
    {
        $ret = ['res' => 'fial'];
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            $usersAcc = [];
            $users = [];
            $acc2Tid = [];
            $rights = [];

            if (!empty($data) && $data->count()) {
                foreach ($data->toArray() as $key => $value) {
                    if (!empty($value)) {
                        foreach ($value as $v) {
                            $v['tid'] = Uuid::uuid4()->toString();
                            $usersAcc[] = $v['acc'];
                            $users[] = ['name' => $v['acc'], 'email' => $v['acc'], 'password' => bcrypt($v['password']), 'type'=>3];
                            $acc2Tid[$v['acc']] = $v['tid'];
                            unset($v['acc']);
                            unset($v['password']);
                            $insertData[] = $v;
                        }
                    }
                }
                if (!empty($insertData) && !empty($users)) {
                    try {
                        $result = DB::table('users')->insert($users);
                        if ($result) {
                            $result = DB::table('t_base_company')->insert($insertData);
                            if ($result) {
                                $users = DB::table('users')->whereIn('email', $usersAcc)->get();
                                foreach ($users as $u) {
                                    $rights[] = ['userid' => $u->id, 'companytid' => $acc2Tid[$u->email]];
                                }
                                $result = DB::table('rights')->insert($rights);
                                if ($result) {
                                    $ret['res'] = $result ? 'success' : $ret;
                                } else {
                                    $ret['msg'] = 'insert rights failed';
                                }
                            } else {
                                $ret['msg'] = 'insert companies failed';
                            }
                        } else {
                            $ret['msg'] = 'insert users failed';
                        }
                    } catch (QueryException $e) {
                        $ret['msg'] = $e->getMessage();
                    }
                }
            }
        }
        return $ret;
    }
}