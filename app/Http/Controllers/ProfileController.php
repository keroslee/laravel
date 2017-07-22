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
		$columnName = $this->isMobile()?'path_mobile as path':'path';
		$profiles = Profile::select('type', $columnName)->where('lan',$loc)->get();
		$profiles = $profiles->keyBy('type');
		$view = $this->isMobile()?'mobile.profile':'profile';

        return view($view,['profiles'=>$profiles, 'lan'=>$loc]);
    }

	public function index($lan=null,$mobile=null)
    {
		$lan = in_array($lan,['en','cn'])?$lan:'cn';
		$columnName = $mobile?'path_mobile as path':'path';
		$profiles = Profile::select('id','type', $columnName)->where('lan',$lan)->get();
		
		return view('admin.profile',['profiles'=>$profiles, 'lan'=>$lan, 'mobile'=>$mobile]);
    }

	public function store(Request $request)
    {
		$this->validate($request, [
			'fileField' => 'image|max:1000|mimes:jpeg,png,gif,svg|dimensions:max_width=1920',
			'id' => 'required',
		]);

		$profile = Profile::find($request->id);
		$newpath=null;

		if($request->hasFile('fileField')){
			if($profile){
				if($request->mobile)
					$oldpath = $profile->path_mobile;
				else
					$oldpath = $profile->path;
			}

			$isMobile=$request->mobile?'-mobile':'';
			$fileName = $request->id.$isMobile.'.'.$request->file('fileField')->extension();
			$path = $request->file('fileField')->storeAs('public/profile', $fileName);
			$newpath = '/storage'.substr($path, 6);

			if($oldpath && $oldpath != $newpath)
				Storage::delete('/public'.substr($oldpath, 8));
		}

		if(!$profile)
			$profile=new Profile();		
		if($request->mobile)
			$profile->path_mobile=$newpath?$newpath:$profile->path;
		else
			$profile->path=$newpath?$newpath:$profile->path;
		$profile->save();

        return back()->withInput();
    }
}
