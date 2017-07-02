<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;
use App\Tag;
use App\WorkTag;
use Illuminate\Support\Facades\Storage;
use Log;

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

	public function detail()
    {
        return view('wk_details');
    }

	public function edit(Work $work)
    {
		$tags=Tag::all();
		$myTags=WorkTag::where('work_id',$work->id)->pluck('tag_id');
        return view('admin.works_edit',["work"=>$work, "tags"=>$tags, 'myTags'=>$myTags]);
    }

	public function store(Request $request)
	{
		Log::info($request);
		$this->validate($request, [
			'fileField' => 'image|max:150|mimes:jpeg,png,gif,svg|dimensions:max_width=640,max_height=430',
			'name_cn' => 'required|max:15',
			'name_en' => 'required|max:40',
			'time' => 'required',
		]);

		$work = Work::find($request->id);
		if(!$work){
			$work=new Work();
			//$work->save();
			Log::info($work);
		}

		$newpath=null;

		if($request->hasFile('fileField')){
			$oldpath = $work->thumb;
			Log::info('old:'.$oldpath);

			$fileName = md5($request->fileField).'.'.$request->file('fileField')->extension();
			var_dump($request->fileField);
			$path = $request->file('fileField')->storeAs('public/works'/*.$work->id*/, $fileName);
			Log::info('path:'.$path);
			$newpath = '/storage'.substr($path, 6);

			if($oldpath && $oldpath != $newpath)
				Storage::delete('/public'.substr($work->thumb, 8));
		}

		$work->thumb=$newpath?$newpath:$work->thumb;
		$work->name_cn=$request->name_cn;
		$work->name_en=$request->name_en;
		$work->time=$request->time;
		$work->save();

		WorkTag::where('work_id',$work->id)->delete();
		foreach($request->tags as $tag=>$value){
			$wt = new WorkTag();
			$wt->work_id = $work->id;
			$wt->tag_id = $tag;
			$wt->save();
		}
Log::info($work);

        return redirect('/admin/works');
	}

	public function del(Request $request)
	{
		$work = Work::find($request->id);
		$this->delFile($work->thumb);
		$work->delete();
        return redirect('/admin/works');
	}

	private function delFile($path)
	{
		Storage::delete('/public'.substr($path, 8));
	}
}
