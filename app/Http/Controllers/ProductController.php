<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
	public function index(){
		return view('admin.product_attribute');
	}

	public function anyData(){
		$atts = \App\ProductAttribute::select('id', 'column')->get();

		$products = \App\Product::orderBy('id', 'desc')->get();
		foreach ($products as $key => $product) {
			foreach ($atts as $key => $att) {
				$cot  = $att->column;
				$product->$cot = \App\ProductValue::where('attribute_id', $att->id)->where('product_id', $product->id)->first()->value;
			}

		}

		return Datatables()->of($products)->addColumn('image', function($product){
			$img = \App\ProductImage::where('product_id', $product->id)->first();


			if(isset($img)){
				$url=asset('').'storage/'. $img->thumbnail;


				return '<div class="imgList">
				<img style="width:30px; height:30px;" src="'.$url.'" alt="">	
				</div>';
			}else{
				return '<div class="imgList"><img style="width:30px; height:30px;" src="http://socaobang.edu.vn/App/images/no-image-news.png" alt=""></div>';
			}
		})
		->addColumn('action', function($product) {
			return '<button class="btn btn-xs btn-primary DetailAdd" product_id="'.$product->id.'" data-toggle="modal" data-target="#addDetail" title="Add Detail" ><i class="fa fa-plus-circle" aria-hidden="true"></i></button> <button class="btn btn-xs btn-success uploadImg" product_id="'.$product->id.'" title="Upload Image" ><i class="fa fa-upload" aria-hidden="true"></i></button> <button class="btn btn-xs btn-info " product_id="'.$product->id.'" data-toggle="modal" data-target="#showProduct" id="showDetail" title="Show Product"><i class="fa fa-eye" aria-hidden="true"></i></button> <button class="btn btn-xs btn-warning editProduct" product_id="'.$product->id.'" data-toggle="modal" data-target="#editProduct" title="Edit Product"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-xs btn-danger deletePro" data-id="'.$product->id.'" title="Delete Product"><i class="fa fa-trash" aria-hidden="true"></i></button>';
		})
		->rawColumns([ 'action','image'])
		->toJson();
	}

	public function editList($id)
	{
		// dd($id);
		$sizecolors = \App\SizeColor::where('product_id',$id)->get();
		// dd($sizecolors);
		return datatables()->of($sizecolors)
		->addColumn('code',function($sizecolor){
			$code=\App\ProductValue::where('product_id',$sizecolor->product_id)->where('attribute_id',4)->first();
			
			if(isset($code)){
				return $code->value ;
			}
			return "" ;
		})
		->addColumn('name',function($sizecolor){
			$product=\App\ProductValue::where('product_id',$sizecolor->product_id)->where('attribute_id',5)->first();
			if(isset($product)){
				return $product->value;
			}
			return "" ;
		})
		->editColumn('color_id',function($sizecolor){
			$color=\App\Color::where('id', $sizecolor->color_id)->first();

			if(isset($color)){
				return '<div style="height:10px;width:100px;background:'. $color->name .'"> </div>';
			}
			return "";	
		})
		->editColumn('size_id',function($sizecolor){
			$size=\App\Size::where('id', $sizecolor->size_id)->first();
			if(isset($size)){
				return '<p>'.$size->name.' </p>';
			}
			return "";
		})
		->addColumn('action', function($sizecolor) {
			// $quantity_id=\App\Quantity::where('size_id',$sizecolor->size_id)->where('color_id',$sizecolor->color_id)->first()->id;
			return ' <button class="btn btn-xs btn-warning editDetail" product_id="'.$sizecolor->id.'" data-toggle="modal" data-target="#editDetail" value="'.$sizecolor->product_id.'"><i class="fa fa-wrench" aria-hidden="true"></i></button> <button class="btn btn-xs btn-danger deleteDe" data-id="'.$sizecolor->id.'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
		})
		->rawColumns([ 'action','name','color_id','size_id','code'])
		->toJson();

	}

	public function upload(Request $request){
		// $disk = 'public';
		// $file = $request->file('file');
		// $folder = '/images';
    
		// $filename = 'shoes-photo-' . time() . '.' . $file->getClientOriginalExtension();

    	
		// $path = $file->storeAs($folder, $filename, $disk);
		
		// // dd($path);
		
		
		
		
		// $proImg = \App\ProductImage::create([
		// 	'product_id'=>$request->product_id,
		// 	'thumbnail'=>$path,
		// ]);
		// return response()->json([
		// 	'data' => $proImg
		// ]);
		$disk = 'public';
		$path=$request->file->storeAs('images','shoes-photo-'.time().'.png', $disk);
		$proImg = \App\ProductImage::create([
			'product_id'=>$request->product_id,
			'thumbnail'=>$path,
		]);
		return response()->json([
			'data' => $proImg
		]);
		
	}

	public function store(StoreProductRequest $request){

		$data = $request->all();
		 // dd($data);
		$data['code'] = 'SP'.time();
		unset($data['_token']);
		$product = \App\Product::create();
		$atts=\App\ProductAttribute::select('id','column')->get();
		foreach ($data as $key => $value) {
			\App\ProductValue::create([
				'product_id'=>$product->id,
				'attribute_id'=>\App\ProductAttribute::where('column',$key)->first()->id,
				'value'=>$value,

			]);
		}
		return response()->json([
			'error'=>false,
			'product_id'=>$product->id,
		]);
	}

	public function destroy($id){
		\App\Product::find($id)->delete();
		\App\ProductImage::where('product_id', $id)->delete();
		\App\ProductValue::where('product_id', $id)->delete();
		$sizecolors = \App\SizeColor::where('product_id', $id)->paginate();
		foreach ($sizecolors as $key => $sizecolor) {
			\App\SizeColor::where('id', $sizecolor->id)->delete();
		}

		return response()->json(['message'=>'Xoa thanh cong']);
	}

	public function show(Request $request,$id){
		$array = array();
		$data=array();
		$atts=\App\ProductAttribute::select('id','column')->get();
		foreach ($atts as  $att) {
			$product=\App\ProductValue::where('product_id',$id)->where('attribute_id',$att->id)->first();
			$name=\App\ProductAttribute::where('id',$product->attribute_id)->first()->column;
			$array[$name]=$product->value;	
		}
		$cate_id=\App\SubCategory::where('id',$array['subcate_id'])->first()->subcategory_id;
		$array['cate']=\App\Category::where('id',$cate_id)->first()->name;
		$array['namecate']=\App\SubCategory::where('id',$array['subcate_id'])->first()->name;
		$sizecolors=\App\SizeColor::where('product_id',$id)->paginate();
		$image=\App\ProductImage::where('product_id',$id)->get();
		// dd($sizecolors);
		$si = [];
		$sc= [];
		foreach ($sizecolors as $key => $value) {
			$size=\App\Size::where('id',$value->size_id)->first();
			$si[$key]=$size->name;
			$color=\App\Color::where('id',$value->color_id)->first();
			$sc[$key]=$color->name;
		}

		$sc=array_unique($sc, 0);
		$si=array_unique($si, 0);
			// dd($image['0']['thumbnail']);
		return response()->json([
			'array'=>$array,
			'data'=>$si,
			'color'=>$sc,
			'image'=>$image,
		]);
	}

	public function edit($id){

		$array = array();
		$atts=\App\ProductAttribute::select('id','column')->get();
		foreach ($atts as  $att) {
			$product=\App\ProductValue::where('product_id',$id)->where('attribute_id',$att->id)->first();
			$name=\App\ProductAttribute::where('id',$product->attribute_id)->first()->column;
			$array[$name]=$product->value;	
		}
		$array['namecate']=\App\SubCategory::where('id',$array['subcate_id'])->first()->name;
		return $array;
	}

	public function update(UpdateProductRequest $request, $id){
		$data=$request->all();
		$array= array();
		foreach ($data as $key => $value) {
			$att=\App\ProductAttribute::where('column',$key)->first();
			if(isset($att)){
				\App\ProductValue::where('product_id',$id)->where('attribute_id',$att->id)->update([
					'value'=>$value,
				]);
			}
		}
		return response()->json([
			'error'=>false,
			
		]);
	}

	public function editdetail($id){
		$detail=\App\SizeColor::find($id);
		$size=\App\Size::where('id',$detail->size_id)->first()->name;
		$color=\App\Color::where('id',$detail->color_id)->first()->name;
		return response()->json([
			'size'=>$size,
			'color'=>$color,
			'quantity'=>$detail->quantity,

		]);
	}

	public function updateDetail(Request $request, $id){
		$result=\App\Color::where('name',$request->color)->first();
		
		if(empty($result)){
			$color=\App\Color::store(['name'=>$request->color]);
			$sizeColor=\App\SizeColor::whereId($id)->update(['product_id'=>$request->product_id,'size_id'=>$request->size,'color_id'=>$color->id,'quantity'=>$request->quantity]);
			
		}else{
			$colors=\App\Color::where('name',$request->color)->first();
			$sizeColor=\App\SizeColor::whereId($id)->update(['product_id'=>$request->product_id,'size_id'=>$request->size,'color_id'=>$colors->id,'quantity'=>$request->quantity]);
			
		}
		
		return response()->json([
			'error'=>false,
		]);
	}

	public function destroyDe($id){
		\App\SizeColor::where('id',$id)->delete();
		return response()->json(['message' => 'Xoa thanh cong']);
	}

}
