<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable =['tag','user_id'];
	
	public function pics(){
		return $this->belongsToMany('App\Pic');
	}
}
