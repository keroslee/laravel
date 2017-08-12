<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;

class Acceptance extends TableBase
{
    protected $table = 'T_MK_YANSHOU';
    protected $view = 'admin.acceptance';

}
