<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use App\Models\Member;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','login']]);
    }


    // Create use data
 public function register(Request $request){

   // return "hi";



   $data = $request->only('name', 'email', 'password','password_confirmation');
   $validator = Validator::make($data, [
        'name' => 'required|string|min:3|max:100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required| min:6| max:25 |confirmed',
        'password_confirmation' => 'required| min:6',



        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

       $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'status'=>1,
            'role'=>0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User registered Successfully',
            'todo' => $user,
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



       // return $request->email;



        $newsEditSave = User::where("email", $request->email)->update(["remember_token" => $token]);

        return $this->respondWithToken($token);

 }




 protected function respondWithToken($token){

    return response()->json([
        'access_token'=>$token,
        'token_type'=>'bearer',
        'expires_in'=>auth()->factory()->getTTL()*60*24*180

    ]);

}

// Profile to fatch all the user data
public function profile(Request $request){

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