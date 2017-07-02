<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public function tags(){
		return $this->hasMany('App\WorkTag');
	}
}
