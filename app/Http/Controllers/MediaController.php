<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Media;

class MediaController extends Controller
{
    public function show()
    {
		//$view = $this->isMobile()?'mobile.media':'media';
        //return view($view);
		$loc=config('app.locale');
		$media = Media::where('lan',$loc)->get();
		$view = $this->isMobile()?'mobile.media':'media';
        return view($view, ['media'=>$media]);
    }

	public function index($loc='cn')
    {
		$media = Media::where('lan',$loc)->orderBy('created_at','desc')->get();
        return view('admin.media',['loc'=>$loc, 'media'=>$media]);
    }

	public function store(Request $request)
	{
		if($request->hasFile('fileFields')){
			foreach($request->fileFields as $file){
				$fileName = md5($file).'.'.$file->extension();
				$path = $file->storeAs('public/media'/*.$work->id*/, $fileName);
				$path = '/storage'.substr($path, 6);
				$media = new Media();
				$media->lan = $request->loc;
				$media->path = $path;
				$media->save();
			}
		}

        return $request->id?back()->withInput():redirect('/admin/media/'.$request->loc);
	}

	public function del(Request $request)
	{
		$media = Media::find($request->id);
		$this->delFile($media->path);
		$media->delete();
        return response()->json(['ret'=>true]);
	}

	private function delFile($path)
	{
		return Storage::delete('/public'.substr($path, 8));
	}
}
