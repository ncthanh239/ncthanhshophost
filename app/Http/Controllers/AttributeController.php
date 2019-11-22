<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\ProductAttribute;
class AttributeController extends Controller
{
    public function attribute(){
    	return view('admin.attribute');
    }

    public function attlist(){
    	$atts = ProductAttribute::all();
    	return Datatables()->of($atts)->addColumn('action', function($att){
    		return '<button class="btn btn-xs btn-warning" product_id="'.$att->id.'"><i class="fa fa-wrench" aria-hidden="true"></i></button> <button class="btn btn-xs btn-danger" data-id="'.$att->id.'"><i class="fa fa-trash" aria-hidden="true"></i></button>'; 
    	})
    	->rawColumns(['action'])->toJson();
    }

    public function store(StoreAttributeRequest $request){
		$att=ProductAttribute::store(['column'=>$request->column]);
		return response()->json([
			'error'=>false,
			'data'=>$att,
		]);
	}

    public function destroy($id){
    	ProductAttribute::find($id)->delete();
    	return response()->json([
    		'message'=>'Xoa thanh cong'
    	]);

    }
}
