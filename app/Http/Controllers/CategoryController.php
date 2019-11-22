<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
class CategoryController extends Controller
{
    public function category(){
    	return view('admin.category');
    }

    public function catelist(){
    	$cats = Category::all();
    	return Datatables()->of($cats)
		->addColumn('action', function($cat) {
			return '<button class="btn btn-xs btn-warning" product_id="'.$cat->id.'"><i class="fa fa-wrench" aria-hidden="true"></i></button> <button class="btn btn-xs btn-danger" data-id="'.$cat->id.'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
		})
		->rawColumns([ 'action'])
		->toJson();
    }

    public function store(StoreCategoryRequest $request){
    	$slug=str_slug($request->name);
		$att=Category::store(['name'=>$request->name,'slug'=>$slug]);
		return response()->json([
			'error'=>false,
			'data'=>$att,
		]);
    }

    public function destroy($id){
    	Category::find($id)->delete();
    	return response()->json([
    		'message'=>'Xoa thanh cong'
    	]);
    }
}
