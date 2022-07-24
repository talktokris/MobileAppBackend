<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Job_apply_list;

class JobApplyController extends Controller
{
    public function index($user_id=null){


        return Job_apply_list::where([['user_id','=',$user_id],['status','=',1]])->with("getAdsApplyInfo")->get();
    }



    public function store(Request $request)
    {
        $data = $request->only('user_id', 'job_ads_id');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'job_ads_id' => 'required|integer',
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }


        $preCount= Job_apply_list::where([['user_id','=',$request->user_id],['job_ads_id','=',$request->job_ads_id]])->count();

        if($preCount>0){

            return response()->json([
                'status' => 'success',
                'message' => 'You have already applied for this job before',

            ]);


        } else {


        $todo = Job_apply_list::create([
            'user_id' => $request->user_id,
            'job_ads_id' => $request->job_ads_id,
            'status' => 1
        ]);





        return response()->json([
            'status' => 'success',
            'message' => 'Job applied successfully',
            'todo' => $todo,
        ]);

    }
    }

}