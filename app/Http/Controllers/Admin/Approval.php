<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;

class Approval extends TableBase
{
    protected $table = 'T_MK_SHENPI';
    protected $view = 'admin.approval';

}
