<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
	public function index22()
    {
        return view('home');
    }

    public function show()
    {
		$loc = config('app.locale');
		$homes = Home::select('id','path','name_'.$loc.' as name','desc_'.$loc.' as desc','addr_'.$loc.' as addr','target')->get();
		
		$view = $this->isMobile()?'mobile.index':'index';
        return view($view, ['homes'=>$homes]);
    }

	public function index()
    {
		$homes = Home::all();
        return view('admin.home', ['homes'=>$homes]);
    }

	public function edit($id)
    {
		$home=Home::findOrFail($id);
        return view('admin.home_edit', ['home'=>$home]);
    }

	public function store(Request $request)
    {
		$this->validate($request, [
			'fileField' => 'image|max:200|mimes:jpeg,png,gif,svg|dimensions:max_width=1920,max_height=1080',
			'name_cn' => 'required|max:255',
			'desc_cn' => 'required|max:255',
			'addr_cn' => 'required|max:255',
			'name_en' => 'required|max:255',
			'desc_en' => 'required|max:255',
			'addr_en' => 'required|max:255',
		]);

		$home = Home::find($request->id);

		if($request->hasFile('fileField')){
			if($home){
				$path = substr($home->path, 8);
				Storage::delete('/public'.$path);
			}

			$fileName = 'index_bg'.$request->id.'.'.$request->file('fileField')->extension();
			$path = $request->file('fileField')->storeAs('public/home_img', $fileName);
			$path = '/storage'.substr($path, 6);
		}

		if(!$home)
			$home=new Home();
		
		$home->path=isset($path)?$path:$home->path;
		$home->name_cn=$request->name_cn;
		$home->desc_cn=$request->desc_cn;
		$home->addr_cn=$request->addr_cn;
		$home->name_en=$request->name_en;
		$home->desc_en=$request->desc_en;
		$home->addr_en=$request->addr_en;

		$home->save();

        return back()->withInput();
    }
}
