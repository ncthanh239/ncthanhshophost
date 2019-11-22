<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['id', 'name'];

    public static function store($data){
    	$size = Size::create($data);
    	return $size;
    }

    public function colors(){
        return $this->belongsToMany('App\Color','size_colors','color_id','size_id');
    }
}
