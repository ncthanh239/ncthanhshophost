<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SizeColor extends Model
{
    protected $fillable=['product_id', 'size_id', 'color_id', 'quantity'];
    public static function store($data){
    	$sizecolor=SizeColor::create($data);
    	return $sizecolor;
    }
}
