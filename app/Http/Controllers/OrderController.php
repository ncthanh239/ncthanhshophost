<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\ProductImage;
use App\ProductValue;
use App\Size;
use App\Color;
use App\User;
use App\Address;
use App\Quantity;
use App\SizeColor;
class OrderController extends Controller
{
	public function index(){
		return view('admin.order');
	}

	public function anyway(){
		$orders = Order::all();
		return datatables()->of($orders)
		->editColumn('status',function($order){
			$sta=$order->status;
			if ($sta==0) {
				return 'Confirm';
			}else if($sta==1){
				return 'Waiting for delivery';
			}else if($sta==2){
				return 'Delivering';
			}else if($sta==3){
				return 'Order Complete';
			}else if($sta==4){
				return 'Deleted';
			}else{
				return 'unknown';
			}
		})
		->addColumn('action', function($order) {
			return '<button type="" class="btn btn-info change" data-toggle="modal" data-target="#ChangingStatus" order_id="'.$order->id.'"><i class="fa fa-cogs" aria-hidden="true"></i></button> <button type="" class="btn btn-success detailOrder" data-toggle="modal" data-target="#orderDetail" order_id="'.$order->id.'"><i class="fa fa-info-circle" aria-hidden="true"></i></button> <button type="" class="btn btn-warning userModal" data-toggle="modal" data-target="#UserModal" order_id="'.$order->id.'"><i class="fa fa-user-circle-o" aria-hidden="true"></i></button>';
		})
		->rawColumns([ 'action','status'])
		->toJson();
	}

	public function updateStatus(Request $request){
		$order=Order::where('id',$request->order_id)->update(['status'=>$request->status]);
		$orders=Order::where('id',$request->order_id)->first();
		if (isset($orders)) {
			if($orders->status==3){
				$orderDetails=OrderDetail::where('order_id',$orders->id)->get();
				foreach ($orderDetails as $key => $orderDetail) {
					$quantity=SizeColor::where('size_id',$orderDetail->size_id)->where('color_id',$orderDetail->color_id)->where('product_id',$orderDetail->product_id)->first();

					$qua=$quantity->quantity-$orderDetail->number;
					SizeColor::where('size_id',$orderDetail->size_id)->where('color_id',$orderDetail->color_id)->where('product_id',$orderDetail->product_id)->update(['quantity'=>$qua]);
				}
				
			}
		}
		
		return $order;
	}

	public function detail($id){
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

	public function deleteOrder($id){
		$a = Order::find($id);
		$a->status = 4;
		$a->save();
		return $a;
	}

	public function status($id){
		$status = Order::find($id);
		return $status->status;
	}

	public function user($id){

	
	}
}
