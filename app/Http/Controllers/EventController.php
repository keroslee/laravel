<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function show()
    {
		$loc=config('app.locale');
		$events = Event::where('lan',$loc)->get();
		$view = $this->isMobile()?'mobile.events':'events';
        return view($view, ['events'=>$events]);
    }

	public function index($loc='cn')
    {
		$events = Event::where('lan',$loc)->get();
        return view('admin.events',['loc'=>$loc, 'events'=>$events]);
    }

	public function store(Request $request)
	{
		if($request->hasFile('fileFields')){
			foreach($request->fileFields as $file){
				$fileName = md5($file).'.'.$file->extension();
				$path = $file->storeAs('public/events'/*.$work->id*/, $fileName);
				$path = '/storage'.substr($path, 6);
				$event = new Event();
				$event->lan = $request->loc;
				$event->path = $path;
				$event->save();
			}
		}

        return $request->id?back()->withInput():redirect('/admin/events/'.$request->loc);
	}

	public function del(Request $request)
	{
		$event = Event::find($request->id);
		$this->delFile($event->path);
		$event->delete();
        return response()->json(['ret'=>true]);
	}

	private function delFile($path)
	{
		return Storage::delete('/public'.substr($path, 8));
	}
}
