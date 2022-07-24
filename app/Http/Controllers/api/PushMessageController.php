<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Push_message_list;

class PushMessageController extends Controller
{
    //
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
}