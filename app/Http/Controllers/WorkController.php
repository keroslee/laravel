<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;
use App\Tag;
use App\WorkTag;
use App\WorkDetail;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    public function show($tag=null)
    {
		if($tag)
		{
			$workIds = WorkTag::where('tag_id',$tag)->pluck('work_id');
			$works = Work::whereIn('id',$workIds)->get();
		}
		else
		{
			$works = Work::all();
		}
		$tags = Tag::all();
		$loc = config('app.locale');
        return view('works', ['works'=>$works, "tags"=>$tags, 'tagCur'=>$tag, 'loc'=>$loc]);
    }

	public function index($tag=null)
    {
		if($tag)
		{
			$workIds = WorkTag::where('tag_id',$tag)->pluck('work_id');
			$works = Work::whereIn('id',$workIds)->get();
		}
		else
		{
			$works = Work::all();
		}
		$tags=Tag::all();
        return view('admin.works', ['works'=>$works, "tags"=>$tags, 'tagCur'=>$tag]);
    }

	public function detail($workId=null)
	{
		$details = WorkDetail::where('work_id',$workId)->get();
		return view('wk_details', ['details'=>$details]);
    }

	public function edit(Work $work)
    {
		$tags=Tag::all();
		$myTags=WorkTag::where('work_id',$work->id)->pluck('tag_id');
        return view('admin.works_edit',["work"=>$work, "tags"=>$tags, 'myTags'=>$myTags]);
    }

	public function store(Request $request)
	{
		$validate = [
			'fileField' => 'image|max:150|mimes:jpeg,png,gif,svg|dimensions:max_width=640,max_height=430',
			'name_cn' => 'required|max:15',
			'name_en' => 'required|max:40',
			'time' => 'required',
		];
		if(!$request->id){
			$validate['fileField'] .= '|required';
		}
		$this->validate($request, $validate);

		$work = Work::find($request->id);
		if(!$work){
			$work=new Work();
		}

		$newpath=null;

		if($request->hasFile('fileField')){
			$oldpath = $work->thumb;

			$fileName = md5($request->fileField).'.'.$request->file('fileField')->extension();
			$path = $request->file('fileField')->storeAs('public/works'/*.$work->id*/, $fileName);
			$newpath = '/storage'.substr($path, 6);

			if($oldpath && $oldpath != $newpath)
				Storage::delete('/public'.substr($work->thumb, 8));
		}
		
		$work->thumb=$newpath?$newpath:$work->thumb;
		$work->name_cn=$request->name_cn;
		$work->name_en=$request->name_en;
		$work->time=$request->time;
		$work->save();

		if($request->hasFile('fileFields')){
			foreach($request->fileFields as $file){
				$fileName = md5($file).'.'.$file->extension();
				$path = $file->storeAs('public/works'/*.$work->id*/, $fileName);
				$path = '/storage'.substr($path, 6);
				$wd = new WorkDetail();
				$wd->work_id = $work->id;
				$wd->path = $path;
				$wd->save();
			}
		}

		if($request->tags){
			WorkTag::where('work_id',$work->id)->delete();
			foreach($request->tags as $tag=>$value){
				$wt = new WorkTag();
				$wt->work_id = $work->id;
				$wt->tag_id = $tag;
				$wt->save();
			}
		}

        return $request->id?back()->withInput():redirect('/admin/works_edit/'.$work->id);
	}

	public function del(Request $request)
	{
		$work = Work::find($request->id);
		$this->delFile($work->thumb);
		$work->delete();
		
		$workDeatils = WorkDetail::where('work_id',$request->id)->get();
		foreach($workDeatils as $workDeatil){
			$this->delFile($work->path);
			$workDeatil->delete();
		}
        return redirect('/admin/works');
	}

	public function delPic(Request $request)
	{
		$detail = WorkDetail::find($request->id);
		$this->delFile($detail->path);
		$detail->delete();
        return response()->json(['ret'=>true]);
	}

	private function delFile($path)
	{
		return Storage::delete('/public'.substr($path, 8));
	}
}
