<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
class SubCategoryController extends Controller
{
    public function category(){
    	return view('admin.subcategory');
    }

    public function store(StoreSubCategoryRequest $request){
		$category=\App\Category::where('id',$request->subcategory_id)->first()->name;
		$slug=str_slug($request->name).'-'.str_slug($category);			
		$result= \App\SubCategory::where('slug',$slug)->first();	
		if(empty($result)){
			$att=SubCategory::store(['name'=>$request->name,'slug'=>$slug,'subcategory_id'=>$request->subcategory_id]);
			return response()->json([
				'error'=>false,
				'data'=>$att,
			]);
		}
	}

    public function destroy($id) {
		SubCategory::find($id)->delete();
		return response()->json(['message' => 'Xoa thanh cong']);
	}

	public function catelist(){
		$cats = SubCategory::all();
		return datatables()->of($cats)
		->editColumn('subcategory_id',function($cat){
			$category=\App\Category::where('id',$cat->subcategory_id)->first();
			return $category->name;
			
		})
		->addColumn('action', function($cat) {
			return '<button class="btn btn-xs btn-warning" product_id="'.$cat->id.'"><i class="fa fa-wrench" aria-hidden="true"></i></button> <button class="btn btn-xs btn-danger" data-id="'.$cat->id.'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
		})
		->rawColumns([ 'action'])
		->toJson();
	}

	public function catesub($id){
		$subcategories=\App\SubCategory::where('subcategory_id',$id)->paginate();
		return  $subcategories;

		
	}
}
