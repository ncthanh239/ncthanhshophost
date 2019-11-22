<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable=['id', 'column'];

    public static function store($data){
    	$att=ProductAttribute::create($data);

    	return $att;
    }
}
