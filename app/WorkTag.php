<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkTag extends Model
{
    public function tag(){
		return $this->belongsTo('App\Tag');
	}
}
