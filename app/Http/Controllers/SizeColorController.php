<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\StoreColorRequest;
class SizeColorController extends Controller
{
   public function size(){
    	return view('admin.size');
    }

    public function sizelist(){
    	$sizes = \App\Size::all();
    	return Datatables()->of($sizes)->addColumn('action', function($size){
    		return '<button class="btn btn-xs btn-warning" product_id="'.$size->id.'"><i class="fa fa-wrench" aria-hidden="true"></i></button> <button class="btn btn-xs btn-danger" data-id="'.$size->id.'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
    	})->rawColumns([ 'action'])
		->toJson();
    }

    public function sizestore(StoreSizeRequest $request){
		$size=\App\Size::store(['name'=>$request->name]);
		return response()->json([
			'error'=>false,
			'data'=>$size,
		]);
	}

    public function sizedestroy($id) {
		\App\Size::find($id)->delete();
		return response()->json(['message' => 'Xoa thanh cong']);
	}


	public function color(){
		return view('admin.color');
	}

	public function colorstore(StoreColorRequest $request){
		$att=\App\Color::store(['name'=>$request->name]);
		return response()->json([
			'error'=>false,
			'data'=>$att,
		]);
	}

	public function colordestroy($id) {
		\App\Color::find($id)->delete();
		return response()->json(['message' => 'Xoa thanh cong']);
	}

	public function colorlist(){
		$atts = \App\Color::all();
		return datatables()->of($atts)
		
		->addColumn('color',function($att){
			return '<div style="height:10px;width:100px;background:'. $att->name .'"> </div>';
		})
		->addColumn('action', function($att) {
			return '<button class="btn btn-xs btn-warning" product_id="'.$att->id.'"><i class="fa fa-wrench" aria-hidden="true"></i></button> <button class="btn btn-xs btn-danger" data-id="'.$att->id.'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
		})
		->rawColumns([ 'action', 'color'])
		->toJson();
	}

	public function adddetail(Request $request){
// dd($request);
		$result=\App\Color::where('name',$request->color)->first();


		if(empty($result)){
			$color=\App\Color::store(['name'=>$request->color]);
			$sizeColor=\App\SizeColor::store(['product_id'=>$request->id,'size_id'=>$request->size,'color_id'=>$color->id,'quantity'=>$request->quantity]);
			
		}else{
			$result1=\App\SizeColor::where('product_id',$request->id)->where('size_id',$request->size)->where('color_id',$result->id)->first();
			if (empty($result1)) {
				$colors=\App\Color::where('name',$request->color)->first();
				$sizeColor=\App\SizeColor::store(['product_id'=>$request->id,'size_id'=>$request->size,'color_id'=>$colors->id,'quantity'=>$request->quantity]);
		
			}else{
				
				$quantity=\App\SizeColor::where('size_id',$request->size)->where('color_id',$result->id)->where('product_id',$request->id)->first();
				if(isset($quantity)){
					$quan=$quantity->quantity+$request->quantity;
					\App\SizeColor::where('size_id',$request->size)->where('color_id',$result->id)->where('product_id',$request->id)->update(['quantity'=>$quan]);
				}
				
			}

		}
		
		return response()->json([
			'error'=>false,
		]);
	}

}
