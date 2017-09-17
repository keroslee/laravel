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
use Storage;

class Files extends Controller
{
    public function index(Request $request)
    {
        $myCompanies = $this->getMyCompanyTids($request);

        $files = DB::table('FILES f')
            ->leftJoin('T_BASE_COMPANY c','f.companytid','=','c.tid')
            ->select('f.*','c.companyname')
            ->whereIn('c.tid',$myCompanies)
            ->paginate();

        return view('admin.files', [
            'files' => $files,
            'companyName' => $request->companyName,
            'currentUrl' => $request->url(),
            'userData' => $this->getUserData($request)
        ]);
    }

    public function del(Request $request)
    {
        $ids = $request->ids;

        if (count($ids) > 0) {
            $myCompanies = $this->getMyCompanyTids($request);
            if($myCompanies) {
                $companyTid = $myCompanies[0];
                $files = DB::table('FILES')
                    ->where('companytid','=',$companyTid)
                    ->whereIn('ID', $ids)
                    ->pluck('path');
                
                $files2Del = [];
                foreach ($files as $index => $file) {
//                    $files[$index] = substr($file, strlen('/storage/'));//delete($files) fail£¬have to put path to new array
                    $files2Del[] = substr($file, strlen('/storage/'));
                }
                $result = Storage::disk('public')->delete($files2Del);

                if($result) {
                    $result = DB::table('FILES')
                        ->whereIn('ID', $ids)
                        ->delete();
                }
            }
        } else {
            $result = 0;
        }

        return response()->json(['res' => $result]);
    }

    public function upload(Request $request)
    {
        $ret = ['res' => 'fial'];
        $myCompanies = $this->getMyCompanyTids($request);
        if($myCompanies){
            $companyTid = $myCompanies[0];
            if(!Storage::disk('public')->exists($companyTid)){
                Storage::disk('public')->makeDirectory($companyTid);
            }
            $fileName = $request->file->getClientOriginalName();
            $exist = Storage::disk('public')->exists($companyTid.'/'.$fileName);

            $path = $request->file->storeAs($companyTid, $fileName, 'public');
            if($exist) {
                $ret['msg'] = 'file exist';
            }else{
                $path = '/storage/' . $path;
                $mark = $request->mark;
                $mark = $mark?$mark:' ';
                $res = DB::table('FILES')->insert(['companytid' => $companyTid, 'mark' => $mark, 'path' => $path, 'upload_time' => date('Y-m-d h:i:s', time())]);
                if($res){
                    $ret['res'] = 'success';
                }else{
                    $ret['res'] = 'fail';
                    $ret['msg'] = 'insert record fail';
                }
            }
        }
        return $ret;
    }
}