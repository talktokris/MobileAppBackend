<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;

use App\Models\Member;

class AuthController extends Controller
{
    // Create use data
 public function register(Request $request){

   // return "hi";



    $validatedData = Validator::make($request->all(),[
        'name' => 'required|string|min:3|max:100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|min:3|max:100',


        ]);

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

       $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return response()->json([
            'message'=>'User registered Successfully',
            'users'=>$user,
        ]);


 }

 // User Login Data

 public function login(Request $request){

    $validatedData = Validator::make($request->all(),[

        'email' => 'required|string|email',
        'password' => 'required|string|min:3|max:100',


        ]);

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        if(!$token= auth()->attempt($validatedData->validated()))
        {
            return response()->json(['error'=>'Unauthorized']);
        }
        return $this->respondWithToken($token);

 }




 protected function respondWithToken($token){

    return response()->json([
        'access_token'=>$token,
        'token_type'=>'bearer',
        'expires_in'=>auth()->factory()->getTTL()*60

    ]);

}

// Profile to fatch all the user data
public function profile(){

    return response()->json(auth()->user());
 }

 // Refresh token it will expire old one and create new one
 public function refresh(){

    return $this->respondWithToken(auth()->refresh());

 }

  // Refresh token it will expire old one and create new one
  public function logout(){

    auth()->logout();
    return response()->json(['message'=>'User Successfully logged out']);

 }

}