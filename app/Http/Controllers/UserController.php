<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
class UserController extends Controller
{
    public function index(){
    	return view('user.user');
    }

    public function store(StoreUserRequest $request){
    	$user = User::create([
    		'name'=>$request->name,
    		'email'=>$request->email,
    		'mobile'=>$request->mobile,
    		'password'=>Hash::make($request->password),
    	]);
    	Address::create([
    		'user_id'=>$user->id,
    		'address'=>$request->address,
    	]);	
    	return $user;
    }
    public function anyData(){
    	$users = User::orderBy('id', 'desc');
    	return datatables()->of($users)
		->editColumn('email', function($user) {
			return '<a href="mailto:'. $user->email .'">'. $user->email .'</a>';
		})
		->addColumn('action', function($user){
			return '<button class="btn btn-xs btn-info" user_id="'.$user->id.'" data-toggle="modal" data-target="#showUser" id="show" title="show user"><i class="fa fa-eye" aria-hidden="true"></i></button>  <button class="btn btn-xs btn-warning" user_id="'.$user->id.'" data-toggle="modal" data-target="#editUser" id="edit"  title="edit user"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-xs btn-danger delete" data-id="'.$user->id.'"  title="delete user"><i class="fa fa-trash" aria-hidden="true"></i></button>';
		})
		->rawColumns(['email', 'action'])
		->toJson();

    }

    public function update(UpdateUserRequest $request){
    	User::where('id', $id)->update([
    		'name'=>$request->name,
			'email'=>$request->email,
			'mobile'=>$request->mobile,
			
    	]);
    }

    public function destroy($id){
    	User::find($id)->delete();
    	Address::where('user_id', $id)->delete();
    	return response()->json(['message'=>'Xoa thanh cong']);
    }

    
}
