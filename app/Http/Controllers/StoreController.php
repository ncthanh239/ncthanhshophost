<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductAttribute;
use App\Productvalue;
use App\SizeColor;
use App\Quantity;
use App\ProductImage;
use App\SubCategory;
use App\Size;
use App\Color;
use App\Category;
class StoreController extends Controller
{
    public function index(){
    	$array=[];
		$data=[];
		$img=[];
		$atts = \App\ProductAttribute::select('id', 'column')->get();

		$products = \App\Product::orderBy('id','desc')->simplePaginate(12);
		foreach ($products as $key => $product) {
			foreach ($atts as $key1 => $att) {
				$cot  = $att->column;
				$product->$cot = \App\ProductValue::where('attribute_id', $att->id)->where('product_id', $product->id)->first()->value;
				$array[$cot]=$product->$cot;
				$array['product_id']=$product->id;
			}
			$sizecolors=SizeColor::where('product_id',$product->id)->get();
			foreach ($sizecolors as $key2 => $sizecolor) {
				$size=Size::where('id',$sizecolor->size_id)->first()->name;
				$color=Color::where('id',$sizecolor->color_id)->first()->name;
				// $quantity=Quantity::where('size_id',$sizecolor->size_id)->where('color_id',$sizecolor->color_id)->first()->value;
				$array['quantity']=$sizecolor->quantity;
				$array['size']=$size;
				$array['color']=$color;
			}
			$images=ProductImage::where('product_id',$product->id)->get();
			if (isset($images)) {
				foreach ($images as $key3 => $image) {
					$img[$key3]=$image->thumbnail;
					$array['images']=$img;
				}
			}else{
				$array['images']= 'http://socaobang.edu.vn/App/images/no-image-news.png';
			}
			
			$data[$key]=$array;
		}
		$categories=\App\Category::select('id','name', 'slug')->get();
		foreach ($categories as $key4 => $category) {

			$category->subcategories =\App\SubCategory::select('name', 'slug')->where('subcategory_id',$category->id)->get();
		}

		return view('store.store',['data'=>$data,'products'=>$products,'categories'=>$categories]);
    }

    public function detail($id){
    	$array=[];

		$img=[];
		$si=[];
		$col=[];
		$atts = \App\ProductAttribute::select('id', 'column')->get();


		foreach ($atts as $key1 => $att) {
			$product=Product::find($id);
			$cot  = $att->column;

			$product->$cot = ProductValue::where('attribute_id', $att->id)->where('product_id', $id)->first()->value;

			$array[$cot]=$product->$cot;
			$array['product_id']=$product->id;
		}
		$sizecolors=SizeColor::where('product_id',$id)->paginate();
		$a=[];
		foreach ($sizecolors as $key2 => $sizecolor) {
			
			
			
			$color=Color::where('id',$sizecolor->color_id)->first()->name;

			
			
			$col['product_id']=$id;
			$result=Color::where('name',$color)->get();
			$col['color']=$color;
			$col['color_id']=$sizecolor->color_id;
			$a['color'][$key2]=$col;

		}
		$array['color']=array_unique($a['color'], 0);
		$images=ProductImage::where('product_id',$id)->paginate();
		foreach ($images as $key3 => $image) {
			$img[$key3]=$image->thumbnail;
			$array['images']=$img;
		}
// dd($array);
		return view('store.detail',['array'=>$array]);
    }

    public function size(Request $request){
    	$s=[];
		$a=[];
		$sizes=SizeColor::where('product_id',$request->product_id)->where('color_id',$request->color_id)->paginate();
		foreach ($sizes as $key => $size) {
			$size_id=$size->size_id;
			$size_name=Size::where('id',$size_id)->first()->name;
			$a['size_id']=$size_id;
			$a['size_name']=$size_name;

			$s[$key]=$a;
			
		}

		return response()->json([
			'size'=>$s,
			'color_id'=>$request->color_id,
			'product_id'=>$request->product_id
		]);
    }

    public function quantity(Request $request){
    	$quantity=SizeColor::where('size_id',$request->size_id)->where('color_id',$request->color_id)->where('product_id',$request->product_id)->first()->quantity;

		return response()->json([
			'size_id'=>$request->size_id,
			'color_id'=>$request->color_id,
			'quantity'=>$quantity

		]);
    }

    public function shop($slug){
    	$pro=[];
		$subcate_id=SubCategory::where('slug',$slug)->first()->id;
		$products=Product::whereIn('id', function($query) use($subcate_id) {
			$query->select('product_id')->from('product_values')->where('attribute_id',9)->where('value',$subcate_id)->groupBy('product_id')->get();
		})->get();

		

		$atts=ProductAttribute::all();
		foreach ($products as $key => $value) {
			foreach ($atts as $key => $value1) {
				$value[$value1->column] = ProductValue::where('attribute_id',$value1->id)->where('product_id',$value->id)->first()->value; 
			}

			$imgs=ProductImage::where('product_id',$value->id)->get();
			foreach ($imgs as $key1 => $img) {
				$pro[$key1]=$img->thumbnail;

				$value['images']=$pro;
			}
			
		}
		
		$categories=\App\Category::select('id','name', 'slug')->get();
		foreach ($categories as $key4 => $category) {

			$category->subcategories =\App\SubCategory::select('name', 'slug')->where('subcategory_id',$category->id)->get();

			
		}
		

		return view('store.categories',['products'=>$products,'categories'=>$categories]);
    }
}
