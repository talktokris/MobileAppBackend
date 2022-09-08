<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailPasswordReset;

use App\Models\Member;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','login','passwordResetCode','passwordResetSave']]);
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



 public function passwordResetCode(Request $request){

    $validatedData = Validator::make($request->all(),[

        'email' => 'required|string|email',


        ]);

        if($validatedData->fails()){
           // return response()->json($validatedData->errors(), 400);
          // return response()->json(['error' => $validator->messages()], 200);
            return response()->json([
                'status' => 'error',
                'message' => $validatedData->messages(),
            ]);
        }




            // return $request->email;
        $checkEmail= User::where('email','=', $request->email)->get()->count();


        if($checkEmail==0){

            return response()->json([
                'status' => 'error',
                'message' => 'No account associated with the email address',
            ]);
        }

        if($checkEmail==1){

            $newResetCode = substr(strtoupper(md5(rand(100000, 9999999))), 0, 6);

            $passCodeSave = User::where("email", $request->email)->update(["reset_code" => $newResetCode]);

            if($passCodeSave){

                $details = [

                    'title' => 'Password reset confirmation code',

                    'body' => 'This is for testing email using smtp',

                    'resetCode'=> $newResetCode,

                ];
                Mail::to($request->email)->send(new MailPasswordReset($details));
             }

            return response()->json([
                'status' => 'success',
                'message' => 'Confirmation code has sent to email address',
               // 'todo' => $passCodeSave,
            ]);



        }
        //eturn response()->json(['check'=>$checkEmail]);

            //  $newsEditSave = User::where("email", $request->email)->update(["remember_token" => $token]);

            //  return $this->respondWithToken($token);

 }


 public function passwordResetSave(Request $request){


    $validatedData = Validator::make($request->all(),[

        'email' => 'required|string|email',
        'confirm_code' => 'required|string|min:3|max:100',
        'password' => 'required| min:6| max:25 |confirmed',
        'password_confirmation' => 'required| min:6',

        ]);

        if($validatedData->fails()){

            return response()->json([
                'status' => 'error',
                'message' => $validatedData->messages(),
            ]);
        }




            // return $request->email;
        $checkEmail= User::where([['email','=', $request->email],['reset_code','=', $request->confirm_code]])->get()->count();


        if($checkEmail==0){

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid confirmation code',
            ]);
        }

        if($checkEmail==1){

            $passWordHash = Hash::make($request->password);

            $passCodeSave = User::where("email", $request->email)->update(["password" => $passWordHash]);


            return response()->json([
                'status' => 'success',
                'message' => 'Your password has been reset successfully, Please login using new password',
               // 'todo' => $passCodeSave,
            ]);



        }

 }



}