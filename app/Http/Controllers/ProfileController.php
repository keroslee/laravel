<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
		$loc = config('app.locale');
		$profiles = Profile::where('lan',$loc)->get();
		$profiles = $profiles->keyBy('type');
        return view('profile',['profiles'=>$profiles, 'lan'=>$loc]);
    }

	public function index($lan=null)
    {
		$lan = in_array($lan,['en','cn'])?$lan:'cn';
		$profiles = Profile::where('lan',$lan)->get();
		$profiles = $profiles->keyBy('type');
        return view('admin.profile',['profiles'=>$profiles, 'lan'=>$lan]);
    }

	public function store(Request $request)
    {
		$this->validate($request, [
			'fileField' => 'image|max:400|mimes:jpeg,png,gif,svg|dimensions:max_width=1920',
			'id' => 'required',
		]);

		$profile = Profile::find($request->id);

		$newpath=null;

		if($request->hasFile('fileField')){
			if($profile){
				$oldpath = $profile->path;
			}

			$fileName = $request->id.'.'.$request->file('fileField')->extension();
			$path = $request->file('fileField')->storeAs('public/profile', $fileName);
			$newpath = '/storage'.substr($path, 6);

			if($oldpath && $oldpath != $newpath)
				Storage::delete('/public'.substr($profile->path, 8));
		}

		if(!$profile)
			$profile=new Profile();
		
		$profile->path=$newpath?$newpath:$profile->path;

		$profile->save();

        return back()->withInput();
    }
}
