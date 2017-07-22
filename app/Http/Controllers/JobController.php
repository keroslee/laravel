<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Job;

class JobController extends Controller
{
    public function show()
    {
		$loc=config('app.locale');
		
		if($this->isMobile()){
			$job = Job::find($loc=='cn'?3:4);
		}else{
			$job = Job::find($loc=='cn'?1:2);
		}

		$view = $this->isMobile()?'mobile.jobs':'jobs';
		return view($view, ['job'=>$job]);
    }

	public function index($loc='cn',$mobile=null)
    {
		if($mobile){
			$job = Job::find($loc=='cn'?3:4);
		}else{
			$job = Job::find($loc=='cn'?1:2);
		}
        return view('admin.jobs',['loc'=>$loc, 'job'=>$job, 'mobile'=>$mobile]);
    }

	public function store(Request $request)
	{
		$job=Job::find($request->id);
		if(!$job)
			$job=new Job();
		if($request->hasFile('fileField')){
			$oldpath = $job->path;

			$fileName = md5($request->fileField).'.'.$request->file('fileField')->extension();
			$path = $request->file('fileField')->storeAs('public/jobs'/*.$work->id*/, $fileName);
			$newpath = '/storage'.substr($path, 6);

			if($oldpath && $oldpath != $newpath)
				Storage::delete('/public'.substr($job->path, 8));
		}
		$job->path=$newpath?$newpath:$job->path;
		$job->save();

        return $request->id?back()->withInput():redirect('/admin/jobs/'.$request->loc);
	}

	private function delFile($path)
	{
		return Storage::delete('/public'.substr($path, 8));
	}
}
