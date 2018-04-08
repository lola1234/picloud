<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $fillable =['picimg','user_id'];
	
	public function tags(){
		return $this->belongsToMany('App\Tag');
	}
	
	public function user(){
		return $this->belongsTo('App\User');
	}
}
