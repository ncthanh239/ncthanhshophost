<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategory;
class Category extends Model
{
    protected $table = 'categories';
    protected $fillable =['id','name','slug'];
	public function subcategories(){
		return $this->hasMany('App\SubCategory','subcategory_id');
	}
	public static function store($data){
		
	$categories=Category::create($data);
		return $categories;
	}
}
