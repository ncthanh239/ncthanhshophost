<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategory;
class SubCategory extends Model
{
    protected $table = 'subcategories';
    protected $fillable =['id','subcategory_id','name','slug'];
	public function category(){
		return $this->belongsTo('Category');
	}
	public function posts(){
		return $this->hasMany('App\Post');
	}
	public static function store($data){
	$subcategories=SubCategory::create($data);
		return $subcategories;
	}
}
