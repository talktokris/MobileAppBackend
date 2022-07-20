<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Member_job_preferences_data;

class JobPreferenceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }




    public function store(Request $request)
    {
        $data = $request->only('user_id', 'industry', 'function','country', 'city', 'type');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'industry' => 'required|string|max:255',
            'function' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'type' => 'required|string|max:255',


        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = Member_job_preferences_data::create([
            'user_id' => $request->user_id,
            'industry' => $request->industry,
            'function' => $request->function,
            'country' => $request->country,
            'city' => $request->city,
            'type' => $request->type,
            'status' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Job Preferences created successfully',
            'todo' => $todo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('user_id', 'industry', 'function','country', 'city', 'type');
        $validator = Validator::make($data, [
            'user_id' => 'required|integer',
            'industry' => 'required|string|max:255',
            'function' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $todo = Member_job_preferences_data::find($id);
        $todo->user_id = $request->user_id;
        $todo->industry = $request->industry;
        $todo->function = $request->function;
        $todo->country = $request->country;
        $todo->city = $request->city;
        $todo->type = $request->type;

        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Job Preferences updated successfully',
            'todo' => $todo,
        ]);
    }

    public function destroy($id)
    {
        $todo = Member_job_preferences_data::find($id);
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Job Preferences deleted successfully',
            'todo' => $todo,
        ]);
    }
}
