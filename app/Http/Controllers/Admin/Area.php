<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Log;

class Area extends TableBase
{
    protected $table = 'T_BASE_AREA';
    protected $view = 'admin.area';

    public function index(Request $request)
    {
        $results = DB::table($this->table)
            ->paginate(20);

        return view($this->view, [
            'results' => $results,
            'currentUrl' => $request->url(),
            'userData' => $this->getUserData($request)
        ]);
    }
}
