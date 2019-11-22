<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\ProductValue;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Size;
use App\Color;
use App\ProductImage;
use App\Order;
use App\User;
use App\Address;
use App\OrderDetail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAccountRequest;
use Mail;

class CartController extends Controller
{
    public function index(){
    	return view('store.cart');
    }

    public function cart(Request $request){
    	
    	$product_id = ProductValue::where('attribute_id',4)->where('value', $request->code)->first()->product_id;
    	$price = ProductValue::where('attribute_id',6 )->where('product_id',$product_id)->first()->value;
    	$name = ProductValue::where('attribute_id',5)->where('product_id',$product_id)->first()->value;
    	$size = Size::where('id',$request->size_id)->first()->name;
    	$color = Color::where('id', $request->color_id)->first()->name;
    	$img=ProductImage::where('product_id',$product_id)->first()->thumbnail;
    	$weight=0;
    	$cart=	Cart::add($request->code, $name, $request->number, $price,$weight,['size' => $size,'color'=> $color,'img'=>$img,'product_id'=>$product_id]);
    	
    	
    }

    public function destroy($id){
    	Cart::remove($id);
    }

    public function order(StoreAccountRequest $request){
    $carts=Cart::content();	
    // dd($carts);


		$code='#'.time();
		$data=$request->all();
		

	
			

		if (Auth::user()==null){
			$email = $data->email;
			
			$orders=Order::create(['code'=>$code,'status'=>0,'address'=>$request->address,'name'=>$request->name,'email'=>$request->email,'mobile'=>$request->mobile]);
		
			$user=User::where('id',$orders->user_id)->first();

			
			foreach ($carts as $key => $cart) {
				$size_id=Size::where('name',$cart->options->size)->first()->id;
				$color_id=Color::where('name',$cart->options->color)->first()->id;
				$order=OrderDetail::create(['order_id'=>$orders->id,'product_id'=>$cart->options->product_id,'number'=>$cart->qty,'size_id'=>$size_id,'color_id'=>$color_id]);

			}
			$orderdetail=\App\OrderDetail::where('order_id',$orders->id)->get();
			foreach ($orderdetail as $key => $detail) {
				$detail->name=\App\ProductValue::where('attribute_id',5)->where('product_id',$detail->product_id)->first()->value;
				$detail->image=\App\ProductImage::where('product_id',$detail->product_id)->first()->thumbnail;
				$detail->size=\App\Size::where('id', $detail->size_id)->first()->name;
				$detail->color=\App\Color::where('id', $detail->color_id)->first()->name;
				$detail->price=\App\ProductValue::where('attribute_id',6)->where('product_id',$detail->product_id)->first()->value;
			}
			Mail::to($request->email)->send(new \App\Mail\Order($orders->id,$orderdetail));

			// if (isset($user)) {
			// 	Mail::to($user->email)->send(new \App\Mail\Order($orders->id,$orderdetail));
			// }
			
		}else{

			
			foreach ($carts as $key => $cart) {
				$users = User::where('email',$request->email)->first();
				$user_id = $users->id;
			
				$orders=Order::create(['code'=>$code,'status'=>0,'user_id'=>$user_id,'address'=>$request->address,'name'=>$request->name,'email'=>$request->email,'mobile'=>$request->mobile]);
		
			$user=User::where('id',$orders->user_id)->first();

				$size_id=Size::where('name',$cart->options->size)->first( )->id;
				$color_id=Color::where('name',$cart->options->color)->first()->id;

				$order=OrderDetail::create(['order_id'=>$orders->id,'product_id'=>$cart->options->product_id,'number'=>$cart->qty,'size_id'=>$size_id,'color_id'=>$color_id]);

			}
			$orderdetail=\App\OrderDetail::where('order_id',$orders->id)->get();
			foreach ($orderdetail as $key => $detail) {
				$detail->name=\App\ProductValue::where('attribute_id',5)->where('product_id',$detail->product_id)->first()->value;
				$detail->image=\App\ProductImage::where('product_id',$detail->product_id)->first()->thumbnail;
				$detail->size=\App\Size::where('id', $detail->size_id)->first()->name;
				$detail->color=\App\Color::where('id', $detail->color_id)->first()->name;
				$detail->price=\App\ProductValue::where('attribute_id',6)->where('product_id',$detail->product_id)->first()->value;
			}
			Mail::to($request->email)->send(new \App\Mail\Order($orders->id,$orderdetail));
			
		}
		$t=[];
		$tong=0;
		$value= ProductValue::where('attribute_id',6)->where('product_id',$order->product_id)->first();
		$ors=OrderDetail::where('order_id',$orders->id)->get();
		foreach ($ors as $key1 => $or) {
			$price=ProductValue::where('attribute_id',6)->where('product_id',$order->product_id)->first()->value;
			$total=$price*$order->number;
			$t[$key1]=$total;
		}
		$tong=array_sum($t);
		Order::where('id',$order->order_id)->update(['total'=>$tong]);
		Cart::destroy();

    }

    public function orderDetail($id){
    	$orders=OrderDetail::where('order_id',$id)->get();
		foreach ($orders as $key => $order) {
			$order->name=ProductValue::where('attribute_id',5)->where('product_id',$order->product_id)->first()->value;
			$order->image=ProductImage::where('product_id',$order->product_id)->first()->thumbnail;
			$order->size=Size::where('id', $order->size_id)->first()->name;
			$order->color=Color::where('id', $order->color_id)->first()->name;
			$order->price=ProductValue::where('attribute_id',6)->where('product_id',$order->product_id)->first()->value;
		}
		
		return $orders;
    }

    public function myaccount(){
    	$address=Address::where('user_id',Auth::user()->id)->get();
		$confirm=Order::where('status',0)->where('user_id',Auth::user()->id)->get();

		$waiting=Order::where('status',1)->where('user_id',Auth::user()->id)->get();
		$delivering=Order::where('status',2)->where('user_id',Auth::user()->id)->get();

		$complete=Order::where('status',3)->where('user_id',Auth::user()->id)->get();
		$delete=Order::where('status',4)->where('user_id',Auth::user()->id)->get();

		return view('store.account',['add'=>$address,'confirm'=>$confirm,'waiting'=>$waiting,'delivering'=>$delivering,'complete'=>$complete,'delete'=>$delete]);
    }


}
