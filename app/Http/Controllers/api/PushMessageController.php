<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Push_message_list;
use App\Models\User;

class PushMessageController extends Controller
{

    //

    public function __construct()
    {
      //  $this->middleware('auth:api', ['except' => ['activeResumeGet']]);

       $this->middleware('auth:api');
    }

    public function index($user_id=null){

        return Push_message_list::where([['user_id','=',$user_id],['status','=',1]])->get();

        /*
        return response()->json([
            'status' => 'success',
            'message' => 'Message fatch successfully',
            'todo' => $todo,
        ]);
        */
    }




    public function pushIdUpdate(Request $request, $id)
    {
        $data = $request->only('device_id');
        $validator = Validator::make($data, [
            'device_id' => 'required|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = User::find($id);
        $todo->device_id = $request->device_id;
        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Device ID updated successfully',
            'todo' => $todo,
        ]);
    }
}
