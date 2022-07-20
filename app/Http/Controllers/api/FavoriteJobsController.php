<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Member_favorite_job;

class FavoriteJobsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
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


        $todo = Member_favorite_job::create([
            'user_id' => $request->user_id,
            'job_ads_id' => $request->job_ads_id,
            'status' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Favorite created successfully',
            'todo' => $todo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('user_id', 'job_ads_id');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'job_ads_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $todo = Member_favorite_job::find($id);
        $todo->user_id = $request->user_id;
        $todo->job_ads_id = $request->job_ads_id;

        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Favorite updated successfully',
            'todo' => $todo,
        ]);
    }

    public function destroy($id)
    {
        $todo = Member_favorite_job::find($id);
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Favorite deleted successfully',
            'todo' => $todo,
        ]);
    }
}