<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    protected $fillable=['value','size_id','color_id'];
	public static function store($data){
		$quantity=Quantity::create($data);
		return $quantity;
	}
}
