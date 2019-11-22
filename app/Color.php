<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['id', 'name'];

    public static function store($data){
    	$color = Color::create($data);
    	return $color;
    }

    public function sizes(){
  	return $this->belongsToMany('App\Size','size_colors','size_id','color_id');
  }
}
